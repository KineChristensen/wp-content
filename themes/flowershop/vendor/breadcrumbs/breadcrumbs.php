<?php
//https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin

// Breadcrumbs
function flowershop_custom_breadcrumbs() {

	// Settings
	$separator        = '';
	$breadcrums_id    = 'site-breadcrumbs';
	$breadcrums_class = 'breadcrumb';
	$home_title       = __( 'Home', 'flowershop' );

	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy = 'product_cat';

	// Get the query & post information
	global $post, $wp_query;

	// Do not display on the homepage
	if ( ! is_front_page() ) {

		// Build the breadcrums
		echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

		// Home page
		echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home_title ) . '">' . esc_html( $home_title ) . '</a></li>';
		//echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {

			echo '<li class="item-current active item-archive"><span class="bread-current bread-archive">' . post_type_archive_title( '', false ) . '</span></li>';

		} else if ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if ( $post_type != 'post' ) {

				$post_type_object  = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
				//echo '<li class="separator"> ' . $separator . ' </li>';

			}

			$custom_tax_name = get_queried_object()->name;
			echo '<li class="item-current active item-archive"><span class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</span></li>';

		} else if ( is_single() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if ( $post_type != 'post' ) {

				$post_type_object  = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
				//echo '<li class="separator"> ' . $separator . ' </li>';

			}

			// Get post category info
			$category = get_the_category();

			if ( ! empty( $category ) ) {

				// Get last category post is in
				$last_category = $category[ count( $category ) - 1 ];

				// Get parent any categories and create array
				$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
				$cat_parents     = explode( ',', $get_cat_parents );

				// Loop through parent categories and store in variable $cat_display
				$cat_display = '';
				foreach ( $cat_parents as $parents ) {
					$cat_display .= '<li class="item-cat">' . $parents . '</li>';
					//$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
				}

			}

			// If it's a custom post type within a custom taxonomy
			$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
			if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {

				$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
				$cat_id         = $taxonomy_terms[0]->term_id;
				$cat_nicename   = $taxonomy_terms[0]->slug;
				$cat_link       = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
				$cat_name       = $taxonomy_terms[0]->name;

			}

			// Check if the post is in a category
			if ( ! empty( $last_category ) ) {
				echo $cat_display;
				echo '<li class="item-current active item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

				// Else if post is in a custom taxonomy
			} else if ( ! empty( $cat_id ) ) {

				echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . esc_url( $cat_link ) . '" title="' . esc_attr( $cat_name ) . '">' . $cat_name . '</a></li>';
				//echo '<li class="separator"> ' . $separator . ' </li>';
				echo '<li class="item-current active item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

			} else {

				echo '<li class="item-current active item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

			}

		} else if ( is_category() ) {

			// Category page
			echo '<li class="item-current active item-cat"><span class="bread-current bread-cat">' . single_cat_title( '', false ) . '</span></li>';

		} else if ( is_page() ) {

			// Standard page
			if ( $post->post_parent ) {

				// If child page, get parents
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order
				$anc = array_reverse( $anc );

				// Parent page loop
				if ( ! isset( $parents ) ) {
					$parents = null;
				}
				foreach ( $anc as $ancestor ) {
					$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
					//$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
				}

				// Display parent pages
				echo $parents;

				// Current page
				echo '<li class="item-current active item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';

			} else {

				// Just display current page if not parents
				echo '<li class="item-current active item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . esc_html( get_the_title() ) . '</span></li>';

			}

		} else if ( is_tag() ) {

			// Tag page

			// Get tag information
			$term_id       = get_query_var( 'tag_id' );
			$taxonomy      = 'post_tag';
			$args          = 'include=' . $term_id;
			$terms         = get_terms( $taxonomy, $args );
			$get_term_id   = $terms[0]->term_id;
			$get_term_slug = $terms[0]->slug;
			$get_term_name = $terms[0]->name;

			// Display the tag name
			echo '<li class="item-current active item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . esc_html( $get_term_name ) . '</span></li>';

		} elseif ( is_day() ) {

			// Day archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</a></li>';
			//echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

			// Month link
			echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><a class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</a></li>';
			//echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

			// Day display
			echo '<li class="item-current active item-' . get_the_time( 'j' ) . '"><span class="bread-current bread-' . get_the_time( 'j' ) . '"> ' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</span></li>';

		} else if ( is_month() ) {

			// Month Archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</a></li>';
			//echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

			// Month display
			echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><span class="bread-month bread-month-' . get_the_time( 'm' ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</span></li>';

		} else if ( is_year() ) {

			// Display year archive
			echo '<li class="item-current active item-current-' . get_the_time( 'Y' ) . '"><span class="bread-current bread-current-' . get_the_time( 'Y' ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' ' . esc_html( __( 'Archives', 'flowershop' ) ) . '</span></li>';

		} else if ( is_author() ) {

			// Auhor archive

			// Get the author information
			global $author;
			$userdata = get_userdata( $author );

			// Display author name
			echo '<li class="item-current active item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . esc_attr( $userdata->display_name ) . '">' . __( 'Author: ', 'flowershop' ) . esc_html( $userdata->display_name ) . '</span></li>';

		} else if ( get_query_var( 'paged' ) ) {

			// Paginated archives
			echo '<li class="item-current active item-current-' . get_query_var( 'paged' ) . '"><span class="bread-current bread-current-' . get_query_var( 'paged' ) . '" title="' . __( 'Page', 'flowershop' ) . esc_attr( get_query_var( 'paged' ) ) . '">' . __( 'Page', 'flowershop' ) . ' ' . esc_html( get_query_var( 'paged' ) ) . '</span></li>';

		} else if ( is_search() ) {

			// Search results page
			echo '<li class="item-current active item-current"><span class="bread-current bread-current" title="'.esc_attr( __( 'Search results for', 'flowershop' ) ).':'. get_search_query() . '">' . __( 'Search results for', 'flowershop' ) . ': ' . get_search_query() . '</span></li>';

		} elseif ( is_404() ) {

			// 404 page
			echo '<li>' . __( 'Error 404', 'flowershop' ) . '</li>';
		}

		echo '</ol>';

	}

}
