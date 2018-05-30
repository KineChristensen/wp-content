<?php

class WPUPG_Grid_Cache {

    public function __construct()
    {
        add_action( 'add_attachment', array( $this, 'updated_attachment' ) );
        add_action( 'edit_attachment', array( $this, 'updated_attachment' ) );
        add_action( 'save_post', array( $this, 'updated_post' ), 11, 2 );
        add_action( 'edited_terms', array( $this, 'updated_term' ), 10, 2 );
        add_action( 'admin_init', array( $this, 'regenerate_grids_check' ) );
    }

    public function updated_attachment( $id )
    {
        $this->update_grids_with_post_type( 'attachment' );
    }

    public function updated_post( $id, $post )
    {
        $update_post_post_type = $post->post_type;

        if( $update_post_post_type == WPUPG_POST_TYPE )
        {
            update_option( 'wpupg_regenerate_grids_check', array( $id ) );
        } else {
            $this->update_grids_with_post_type( $update_post_post_type );
        }
    }

    public function update_grids_with_post_type( $post_type )
    {
        $args = array(
            'post_type' => WPUPG_POST_TYPE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'nopaging' => true,
        );

        $query = new WP_Query( $args );
        $posts = $query->have_posts() ? $query->posts : array();

        $grid_ids = array();
        foreach ( $posts as $grid_post )
        {
            $grid = new WPUPG_Grid( $grid_post );

            if( in_array( $post_type, $grid->post_types() ) ) {
                $grid_ids[] = $grid->ID();
            }
        }

        if( count( $grid_ids ) > 0 ) {
            update_option( 'wpupg_regenerate_grids_check', $grid_ids );
        }
    }

    public function updated_term( $term_id, $taxonomy )
    {
        $args = array(
            'post_type' => WPUPG_POST_TYPE,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'nopaging' => true,
        );

        $query = new WP_Query( $args );
        $posts = $query->have_posts() ? $query->posts : array();

        $grid_ids = array();
        foreach ( $posts as $post )
        {
            $grid = new WPUPG_Grid( $post );

            if( in_array( $taxonomy, $grid->filter_taxonomies() ) ) {
                $grid_ids[] = $grid->ID();
            }
        }

        if( count( $grid_ids ) > 0 ) {
            update_option( 'wpupg_regenerate_grids_check', $grid_ids );
        }
    }

    public function regenerate_grids_check()
    {
        $grid_ids = get_option( 'wpupg_regenerate_grids_check', false );

        if( $grid_ids ) {
            foreach( $grid_ids as $grid_id ) {
                $this->generate( $grid_id );
            }
        }
    }

    public function generate( $grid_id )
    {
        $grid = new WPUPG_Grid( $grid_id );

        // Don't cache term grid
        if( $grid->type() !== 'terms' ) {
            // Check if we're in the middle of generating this grid.
            $temp_cache = get_post_meta( $grid->ID(), 'wpupg_temp_cache', true );

            if ( ! is_array( $temp_cache ) ) {
                // Get posts
                $post_ids = $this->generate_cache_post_ids( $grid );
                
                $temp_cache = array(
                    'todo' => $post_ids,
                    'all' => $post_ids,
                    'posts_per_term' => array(),
                    'terms_per_post' => array(),
                    'filter_terms' => array(),
                );
            }

            $doing = array_splice( $temp_cache['todo'], 0, 50 );

            if ( ! empty( $doing ) ) {
                $terms = $this->generate_cache_terms( $grid, $doing );
    
                // Posts per term should combine the same keys.
                $posts_per_term = array_merge_recursive( $temp_cache['posts_per_term'], $terms['posts_per_term'] );
                $temp_cache['posts_per_term'] = $posts_per_term;

                // Terms per post should keep keys.
                $terms_per_post = $temp_cache['terms_per_post'] + $terms['terms_per_post'];
                $temp_cache['terms_per_post'] = $terms_per_post;

                // Filter terms requires special attention.
                $filter_terms = $terms['filter_terms'];
                unset( $terms['filter_terms'] );
    
                foreach ( $filter_terms as $slug => $term ) {
                    if ( ! array_key_exists( $slug, $temp_cache['filter_terms'] ) ) {
                        $temp_cache['filter_terms'][ $slug ] = $term;
                    } else {
                        $temp_cache['filter_terms'][ $slug ]['count'] += $term['count'];
                    }
                }
            }

            if ( ! empty( $temp_cache['todo'] ) ) {
                // Not finished yet, save current temp cache.
                update_post_meta( $grid->ID(), 'wpupg_temp_cache', $temp_cache );
            } else {
                // Finished getting all the terms, generate filter.
                $filter_cache = $this->generate_cache_filter( $grid, $temp_cache['filter_terms'] );
                
                // Apply filters.
                $posts_cache = array(
                    'all' => $temp_cache['all'],
                    'taxonomies' => $temp_cache['posts_per_term'],
                    'terms' => $temp_cache['terms_per_post'],
                );

                $posts_cache = apply_filters( 'wpupg_grid_cache_posts', $posts_cache, $grid );
                $filter_cache = apply_filters( 'wpupg_grid_cache_filter', $filter_cache, $posts_cache, $grid );

                // Save things.
                update_post_meta( $grid->ID(), 'wpupg_posts', $posts_cache );
                update_post_meta( $grid->ID(), 'wpupg_filter', $filter_cache );

                // Clear temp cache.
                update_post_meta( $grid->ID(), 'wpupg_temp_cache', false );

                // Remove from grids to regenerate.
                $grid_ids = get_option( 'wpupg_regenerate_grids_check', array() );
                $grid_ids_key = array_search( $grid->ID(), $grid_ids );

                if ( false !== $grid_ids_key ) {
                    unset( $grid_ids[ $grid_ids_key ] );
                    update_option( 'wpupg_regenerate_grids_check', $grid_ids );
                }
            }
        }
    }

    public function dynamic_generate( $grid ) {
        // Don't cache term grid
        if( $grid->type() == 'terms' ) {
            return array(
                'cache' => array(),
                'filter' => '',
            );
        }

        // Get posts
        $post_ids = $this->generate_cache_post_ids( $grid );

        // Get post terms
        $terms_cache = $this->generate_cache_terms( $grid, $post_ids );

        // Cache array
        $cache = array(
            'all' => $post_ids,
            'taxonomies' => $terms_cache['posts_per_term'],
            'terms' => $terms_cache['terms_per_post'],
        );

        // Generate Filter
        $filter_terms = $terms_cache['filter_terms'];
        $filter = $this->generate_cache_filter( $grid, $filter_terms );

        // Apply filters
        $cache = apply_filters( 'wpupg_grid_cache_posts', $cache, $grid );
        $filter = apply_filters( 'wpupg_grid_cache_filter', $filter, $cache, $grid );

        return array(
            'cache' => $cache,
            'filter' => $filter,
        );
    }

    public function generate_cache_post_ids( $grid ) {
        $args = array(
            'post_type' => $grid->post_types(),
            'post_status' => $grid->post_status(),
            'posts_per_page' => -1,
            'nopaging' => true,
            'order' => $grid->order(),
            'fields' => 'ids',
        );

        if( $grid->order_by() == 'custom' ) {
            $args['meta_key'] = $grid->order_custom_key();
            $args['orderby'] = $grid->order_custom_key_numeric() ? 'meta_value_num' : 'meta_value';
        } else {
            $args['orderby'] = $grid->order_by();
        }

        // Images Only
        if( $grid->images_only() ) {
            if( in_array( 'attachment', $grid->post_types() ) ) {
                $args['post_mime_type'] = 'image/jpeg,image/gif,image/jpg,image/png';
            } else {
                $args['meta_query'] = array(
                    array(
                        'key' => '_thumbnail_id',
                        'value' => '0',
                        'compare' => '>'
                    ),
                );
            }
        }

        $args = apply_filters( 'wpupg_grid_cache_post_ids_args', $args, $grid );

        $query = new WP_Query( $args );
        $posts = $query->have_posts() ? $query->posts : array();

        $post_ids = array_map( 'intval', $posts );

        $post_ids = apply_filters( 'wpupg_grid_cache_post_ids', $post_ids, $grid );

        // Offset posts
        if( $grid->limit_posts_offset() ) {
            $post_ids = array_slice($post_ids, $grid->limit_posts_offset() );
        }

        // Limit Total # Posts
        if( $grid->limit_posts_number() ) {
            $post_ids = array_slice($post_ids, 0, $grid->limit_posts_number() );
        }

        return $post_ids;
    }

    public function generate_cache_terms( $grid, $post_ids ) {
        $posts_per_term = array();
        $terms_per_post = array();
        $filter_terms = array();

        $taxonomies = $grid->filter_taxonomies();
        $limit_terms = $grid->filter_limit_terms();

        // Loop over all terms
        foreach( $post_ids as $post_id ) {
            if( !isset( $terms_per_post[$post_id] ) ) $terms_per_post[$post_id] = array();

            foreach( $taxonomies as $taxonomy ) {
                if( !isset( $posts_per_term[$taxonomy] ) ) $posts_per_term[$taxonomy] = array();

                $terms = get_the_terms( $post_id, $taxonomy );
                $terms = !$terms || is_wp_error( $terms ) ? array() : $terms;

                // Get parent terms if enabled
                if( $grid->filter_match_parents() ) {
                    $parent_ids = array();
                    $parents = array();

                    foreach( $terms as $term ) {
                        if( $term->parent != 0 ) {
                            $parent_ids[] = $term->parent;
                        }
                    }

                    while( count( $parent_ids ) > 0 )
                    {
                        $children_ids = $parent_ids;
                        $parent_ids = array();

                        foreach( $children_ids as $child ) {
                            $term = get_term( $child, $taxonomy );
                            $parents[] = $term;

                            if( $term->parent != 0 ) {
                                $parent_ids[] = $term->parent;
                            }
                        }
                    }

                    $terms = array_merge( $terms, $parents );
                    $handled_terms = array();
                }

                $post_taxonomy_term_ids = array();

                foreach( $terms as $term ) {
                    // Check if terms are being limited
                    if( $grid->filter_limit() ) {
                        if( $grid->filter_limit_exclude() ) {
                            if( isset( $limit_terms[$taxonomy] ) && in_array( $term->term_id, $limit_terms[$taxonomy] ) ) continue;
                        } else {
                            if( !isset( $limit_terms[$taxonomy] ) || !in_array( $term->term_id, $limit_terms[$taxonomy] ) ) continue;
                        }
                    }

                    $slug = urldecode( $term->slug );

                    // Make sure we only handle each term once
                    if( $grid->filter_match_parents() ) {
                        if( in_array( $slug, $handled_terms ) ) continue;
                        $handled_terms[] = $slug;
                    }

                    // Posts per term
                    if( !isset( $posts_per_term[$taxonomy][$slug] ) ) $posts_per_term[$taxonomy][$slug] = array();
                    $posts_per_term[$taxonomy][$slug][] = $post_id;

                    // Terms per post
                    $post_taxonomy_term_ids[] = $slug;

                    if( !array_key_exists( $slug, $filter_terms ) ) {
                        // Filter terms
                        $filter_terms[$slug] = array(
                            'taxonomy' => $taxonomy,
                            'name' => $term->name,
                            'count' => 1,
                        );
                    } else {
                        $filter_terms[$slug]['count']++;
                    }
                }

                $terms_per_post[$post_id][$taxonomy] = $post_taxonomy_term_ids;
            }
        }

        // Show Empty Terms
        if( $grid->filter_show_empty() ) {
            foreach( $taxonomies as $taxonomy ) {
                $terms = get_terms( $taxonomy, array(
                    'hide_empty' => false,
                ) );

                foreach( $terms as $term ) {
                    // Check if terms are being limited
                    if( $grid->filter_limit() ) {
                        if( $grid->filter_limit_exclude() ) {
                            if( isset( $limit_terms[$taxonomy] ) && in_array( $term->term_id, $limit_terms[$taxonomy] ) ) continue;
                        } else {
                            if( !isset( $limit_terms[$taxonomy] ) || !in_array( $term->term_id, $limit_terms[$taxonomy] ) ) continue;
                        }
                    }

                    $slug = urldecode( $term->slug );

                    if( !isset( $posts_per_term[$taxonomy][$slug] ) ) $posts_per_term[$taxonomy][$slug] = array();

                    if( !array_key_exists( $slug, $filter_terms ) ) {
                        // Filter terms
                        $filter_terms[$slug] = array(
                            'taxonomy' => $taxonomy,
                            'name' => $term->name,
                            'count' => 0,
                        );
                    }
                }
            }
        }

        return array(
            'posts_per_term' => $posts_per_term,
            'terms_per_post' => $terms_per_post,
            'filter_terms' => $filter_terms,
        );
    }

    public function generate_cache_filter( $grid, $filter_terms ) {
        $filter = '';

        if( count( $filter_terms ) > 0 && ($grid->filter_type() == 'isotope' ) || $grid->filter_type() == 'text_isotope') {
            $filter_style = $grid->filter_style();

            // All Button
            if( $filter_style['isotope']['all_button_text'] ) {
                $filter .= '<div class="wpupg-filter-item wpupg-filter-isotope-term wpupg-filter-tag- active" role="button" tabindex="0">' . $filter_style['isotope']['all_button_text'] . '</div>';
            }

            $filter_terms_order = array();

            if( $filter_style['isotope']['term_order'] == 'alphabetical_taxonomies' || $filter_style['isotope']['term_order'] == 'reverse_alphabetical_taxonomies' || $filter_style['isotope']['term_order'] == 'alphabetical_taxonomies_grouped' || $filter_style['isotope']['term_order'] == 'reverse_alphabetical_taxonomies_grouped' ) {
                // Order alphatically per taxonomy
                $terms_per_taxonomy = array();

                foreach( $filter_terms as $slug => $term ) {
                    $taxonomy = $term['taxonomy'];
                    if( !array_key_exists( $taxonomy, $terms_per_taxonomy ) ) {
                        $terms_per_taxonomy[$taxonomy] = array();
                    }
                    $terms_per_taxonomy[$taxonomy][] = $slug;
                }

                foreach( $terms_per_taxonomy as $taxonomy => $terms ) {
                    sort( $terms );
                    $filter_terms_order = array_merge( $filter_terms_order, $terms );
                }
            } else { 
                // Order alphabetically by default
                $filter_terms_order = array_keys( $filter_terms );
                sort( $filter_terms_order );
            }

            if( $filter_style['isotope']['term_order'] == 'reverse_alphabetical_taxonomies' || $filter_style['isotope']['term_order'] == 'reverse_alphabetical' || $filter_style['isotope']['term_order'] == 'reverse_alphabetical_taxonomies_grouped' ) {
                $filter_terms_order = array_reverse( $filter_terms_order );
            }

            $filter_terms_order = apply_filters( 'wpupg_grid_cache_filter_isotope_term_order', $filter_terms_order, $grid );

			$current_taxonomy = '';
            foreach( $filter_terms_order as $slug ) {
                $options = isset( $filter_terms[$slug] ) ? $filter_terms[$slug] : false;

                if( $options ) {
                    if( $grid->filter_count() ) {
                        $name = $options['name'] . ' (' . $options['count'] . ')';
                    } else {
                        $name = $options['name'];
                    }

                    if( $filter_style['isotope']['term_order'] == 'alphabetical_taxonomies_grouped' || $filter_style['isotope']['term_order'] == 'reverse_alphabetical_taxonomies_grouped' ){
                    	if( ( $options['taxonomy'] != $current_taxonomy ) && $current_taxonomy != '' ){
                    		$filter .= '</div>';
                   	 	}
                    	if( $options['taxonomy'] != $current_taxonomy ){
                    		$filter .= '<div class="wpupg-filter-tax-container wpupg-filter-tax-' . $options['taxonomy'] . '">';
                    	}
						$current_taxonomy = $options['taxonomy'];
					}
                    $filter .= '<div class="wpupg-filter-item wpupg-filter-isotope-term wpupg-filter-isotope-term-' . $options['taxonomy'] . ' wpupg-filter-tag-' . $slug . '" data-taxonomy="' . $options['taxonomy'] . '" data-filter="' . $slug . '" role="button" tabindex="0">' . $name . '</div>';
                }
            }

            if( $grid->filter_type() == 'text_isotope' && WPUltimatePostGrid::is_addon_active('filter-text') ) {
                $filter .= WPUltimatePostGrid::addon('filter-text')->get_filter( $grid );
            }
        }

        return $filter;
    }
}