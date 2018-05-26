<?php 
/********************************
 * JWD Show Posts Slider :: The Widget Class
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Create The Widget
 ********************************/	
if ( !class_exists('JWDSP_PostSlider')) {
	class JWDSP_PostSlider extends WP_Widget {
	/** Construct */
		function __construct() {
			parent::__construct( 'JWDSP_PostSlider', __('JWD PostSlider', 'jwdsp'), 
				array( 
					'classname' 	=> 'jwdsp_postslider_widget',
					'description' 	=> __('Create responsive post slider widget using default Posts, Categories & Tags or any Custom Post Type and Custom Taxonomies registered.', 'jwdsp') 
				)
			);
		}
	/** Widget */
		function widget($args, $instance) { 
			extract( $args );
			foreach( $instance as $inst_opt=>$inst_val){
				${$inst_opt} = apply_filters('widget_' . str_replace('jwdsp_','',$inst_opt), $instance[$inst_opt]);
			}
			$jwdsp_general_settings = get_option('jwdsp_general_settings');
			/* Start Widget *************************************************************************************************/
			echo $before_widget;
			/* Define post title style */
			if( $jwdsp_posttitle_size){ $posttitle_size = 'style="font-size:'.$jwdsp_posttitle_size.'px;"'; } else{ $posttitle_size = ''; }
			/* Define post content style */
			if( $jwdsp_postcontent_size){ $postcontent_size = 'style="font-size:'.$jwdsp_postcontent_size.'px;"'; } else{ $postcontent_size = ''; }
			/* Define button style */
			$wgbtn_style = 'style="';
				if($jwdsp_btntxt_size){ $wgbtn_style .= 'font-size:'.$jwdsp_btntxt_size.'px;'; } else { $wgbtn_style .= 'font-size:16px;'; }
				if($jwdsp_btnbrd_radius){ $wgbtn_style .= 'border-radius:'.$jwdsp_btnbrd_radius.'px;'; } else { $wgbtn_style .= 'border-radius:2px;'; }
				if($jwdsp_btn_padding){ $wgbtn_style .= 'padding-top:'.$jwdsp_btn_padding.'px;padding-bottom:'.$jwdsp_btn_padding.'px;';} else { $wgbtn_style .= 'padding-top:10px;padding-bottom:10px;'; }
				if($jwdsp_btn_padding_o){ $wgbtn_style .= 'padding-left:'.$jwdsp_btn_padding_o.'px;padding-right:'.$jwdsp_btn_padding_o.'px;';} else { $wgbtn_style .= 'padding-left:10px;padding-right:10px;'; }
			$wgbtn_style .= '"';
			/* Define post meta style */
			if( $jwdsp_postmeta_size ){	
				echo '<style type="text/css"> .'.$this->id.'_postmeta_style, .'.$this->id.'_postmeta_style a{font-size:'.$jwdsp_postmeta_size.'px;} </style>'; 
			}  
			/**/
			$exclude_nothumb = $extra_args = $nothb_x_args = $all_args = array();
			/* Get rid of posts with no thumbnail image */
			if($jwdsp_if_no_thumb == 'true' ) {
				global $post;
				$nothb_args = array('post_type' => $jwdsp_post_type, 'posts_per_page' => '-1');
				if( $jwdsp_post_type != 'post'){ 
					$nothb_x_args['tax_query'] = $jwdsp_tax_term; 
				} else { 
					if($jwdsp_taxonomy == 'category'){ 
						$nothb_x_args['category_name'] = $jwdsp_tax_term; 
					} elseif( $jwdsp_taxonomy == 'post_tag'){ 
						$nothb_x_args['tag'] = $jwdsp_tax_term; 
					}
				}
				$nothb_q = new WP_Query( array_merge($nothb_args, $nothb_x_args) );
				if ($nothb_q && $nothb_q->have_posts()) {
					while ( $nothb_q->have_posts() ) { 
						$nothb_q->the_post();
						$jwdsp_thb = get_post_meta( get_the_ID(), 'jwdsp_thumbnail', true );
						/* Exclude from the loop if the post doesn't have neither the featured image or jwdsp_image thumbnail */
						if( !has_post_thumbnail() && !$jwdsp_thb){ $exclude_nothumb[] = $post->ID; }
					}
					wp_reset_postdata();
				}
			}
			/* Default Query Args */
			$args = array(
				'post_type'        	=> $jwdsp_post_type,
				'posts_per_page'    => $jwdsp_listing,
				'post_status'       => 'publish',
			);
			/* Exclude specific posts from the Query */
			$exclude_posts = explode(',', $jwdsp_exclude_posts);
			/* Exclude current page from loop by default */
			if($jwdsp_exclude_current == 'true'){ $exclude_current = array( get_the_ID()); } else { $exclude_current = array(); }
			$exclude = array_unique( array_merge( $exclude_current, $exclude_posts, $exclude_nothumb ) ); 
			$extra_args['order'] 			= $jwdsp_order;
			$extra_args['post__not_in'] 	= $exclude;
			if($jwdsp_post_type == 'post'){
				if($jwdsp_taxonomy == 'category'){ 
					$extra_args['category_name'] = $jwdsp_tax_term; 
				} elseif ( $jwdsp_taxonomy == 'post_tag'){ 
					$extra_args['tag'] = $jwdsp_tax_term; 
				}
 			} else{
				if($jwdsp_tax_term){
					$extra_args['tax_query'] = array( 
						array( 
							'taxonomy' 	=> $jwdsp_taxonomy, 
							'field' 	=> 'slug', 
							'terms' 	=> $jwdsp_tax_term,
						), 
					);
				} 
			}
			/**/
			$all_args = array_merge($args, $extra_args);
			/* Custom Query Args */ 
			$custom_query = array();
			$cq_posts = explode(',', $jwdsp_custom_query);
			foreach ($cq_posts as $cq_post) { $custom_query[] = (int) $cq_post; }
			$cq_args = array(
				'post_type'			=> $jwdsp_post_type,
				'post__in'			=> array_diff( $custom_query, $exclude ),
				'order'				=> $jwdsp_order,
				'post_status'       => 'publish'
			);
			/* Query Posts */
			if( isset($jwdsp_custom_query) && !empty($jwdsp_custom_query) ) {
				$listings = new WP_Query( $cq_args );
			} else { 
				$listings = new WP_Query( $all_args );
			}
			/* Loop the Posts */	
			if ( $listings && $listings->have_posts()) { 
				if ( $title ) {	echo $before_title . $title . $after_title;	}
				?>			
				<div class="jwdsp_widget swiper-container <?php echo 'swiper-'.$this->id;?>">
					<ul class="jwdsp_widget-list swiper-wrapper">
					<?php while ( $listings->have_posts() ) { $listings->the_post(); ?>
						<li class="jwdsp_widget-list-item swiper-slide">
					<?php	$thbUrl = '';
							$has_post_thumbnail = has_post_thumbnail() && ! post_password_required() && ! is_attachment();
							$jwdsp_thumbnail = get_post_meta( get_the_ID(), 'jwdsp_thumbnail', true );
							$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
							/* Retrive thumbnail image URL */
							if($jwdsp_thumbnail != ''){ $thbUrl = esc_url($jwdsp_thumbnail); } else { $thbUrl = esc_url($thumb_url[0]); }
							/* Define thumbnail image style */
							if($thbUrl != ''){
								$img_style = 'style="';
								$img_style .= 'background-image: url('.$thbUrl.');';
								$img_style .= 'background-size:'.$jwdsp_thumb_bg.';';
								$img_style .= '"';
							} else { $img_style = ''; }
							/* Define title position */
							if( $jwdsp_general_settings['title_position'] == 'over' ){
								/* Title Background Color & Transparency */
								if( $jwdsp_general_settings['title_background'] != ''){ 
									$bg_color = jwdsp_hex2rgba( esc_attr( $jwdsp_general_settings['title_background'] ), true );
									$bg_transpcy = esc_attr( $jwdsp_general_settings['title_background_opacity'] );
									$title_bg = 'style="background-color: rgba(' . $bg_color . ', ' . $bg_transpcy . ');"'; 
								} else { $title_bg = ''; }
							} else { $title_bg = ''; }
							/**/
							if ( $jwdsp_showthumb == 'true') {
								if ($has_post_thumbnail || $jwdsp_thumbnail != '' ){ 
									if($jwdsp_general_settings['title_position'] == 'over'){ ?> 
										<div class="jwdsp_widget-list-image">
											<a href="<?php the_permalink();?>" class="jwdsp_widget-list-thumb" <?php echo $img_style; ?>>&nbsp;</a>
										<?php if($jwdsp_showtitle == 'true'){ ?>
											<h3 class="jwdsp_widget-list-title <?php echo 'jwdsp_title_' . $jwdsp_general_settings['title_position'];?>" <?php echo $title_bg;?>>
												<a href="<?php the_permalink(); ?>" <?php echo $posttitle_size;?>><?php echo wp_trim_words( get_the_title(), $jwdsp_posttitle_trim, ' ... ' ); ?></a>
											</h3>
										</div>
										<?php } 
									} else { ?>
										<div class="jwdsp_widget-list-image"><a href="<?php the_permalink();?>" class="jwdsp_widget-list-thumb" <?php echo $img_style; ?>>&nbsp;</a></div>
										<?php if($jwdsp_showtitle == 'true'){ ?>
											<h3 class="jwdsp_widget-list-title">
												<a href="<?php the_permalink(); ?>" <?php echo $posttitle_size;?>><?php echo wp_trim_words( get_the_title(), $jwdsp_posttitle_trim, ' ... ' ); ?></a>
											</h3>
										<?php } 
									}
								} elseif( $jwdsp_showtitle == 'true' ) { ?>
									<h3 class="jwdsp_widget-list-title">
										<a href="<?php the_permalink(); ?>" <?php echo $posttitle_size;?>><?php echo wp_trim_words( get_the_title(), $jwdsp_posttitle_trim, ' ... ' ); ?></a>
									</h3>
					<?php 		}
							} elseif( $jwdsp_showtitle == 'true' ) { ?>
								<h3 class="jwdsp_widget-list-title">
									<a href="<?php the_permalink(); ?>" <?php echo $posttitle_size;?>><?php echo wp_trim_words( get_the_title(), $jwdsp_posttitle_trim, ' ... ' ); ?></a>
								</h3>
					<?php 	} 
							if($jwdsp_showdate == 'true'){ ?>
								<div class="jwdsp_widget-list-meta <?php echo $this->id;?>_postmeta_style">
									<i class="jwdsp_icon jwdsp_icon-calendar"></i><a href="<?php the_permalink();?>"><?php echo get_the_date(); ?></a>
								</div>
					<?php 	}  
							if($jwdsp_comments == 'true'){ ?>
								<div class="jwdsp_widget-list-meta <?php echo $this->id;?>_postmeta_style">
									<i class="jwdsp_icon jwdsp_icon-comment"></i><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a>
								</div>
					<?php 	}  
							if($jwdsp_showexcerpt == 'true'){ ?>
								<div class="jwdsp_widget-list-excerpt" <?php echo $postcontent_size;?>>
							<?php 	
								$the_excerpt = strip_shortcodes( get_the_excerpt() );
								$the_content = strip_shortcodes( get_the_content() );
								if( $the_excerpt ){
									echo wp_trim_words( $the_excerpt, $jwdsp_postcontent_trim, ' ... ' ); /* Get the Excerpt if not empty */
								} else {
									echo wp_trim_words( $the_content, $jwdsp_postcontent_trim, ' ... ' ); /* Else Get the Content */
								}
							?>
								</div>
					<?php 	} 
							if($jwdsp_categories == 'true'){ 
								if( $jwdsp_post_type != 'post'){ 	
									$categories_list = get_the_term_list( get_the_ID(), jwdsp_get_taxonomy_name($jwdsp_post_type, 'category'), '', ', ' );
								} else{
									$categories_list = get_the_category_list( __( ', ', 'jwdsp'));
								}
								if ( $categories_list ) { ?> 
									<div class="jwdsp_widget-list-meta <?php echo $this->id;?>_postmeta_style"><i class="jwdsp_icon jwdsp_icon-categories"></i><?php echo $categories_list; ?></div>
					<?php 		}
							} 
							if($jwdsp_tags == 'true'){ 
								if( $jwdsp_post_type != 'post'){ 	
									$tag_list = get_the_term_list( get_the_ID(), jwdsp_get_taxonomy_name($jwdsp_post_type, 'post_tag'), '', ', ' );
								} else{	$tag_list = get_the_tag_list('',', ',''); }
								if ( $tag_list ) { ?> 
									<div class="jwdsp_widget-list-meta <?php echo $this->id;?>_postmeta_style"><i class="jwdsp_icon jwdsp_icon-tags"></i><?php echo $tag_list; ?></div> 
					<?php 		}
							} 
					?>	
						</li>
					<?php } /* End Loop */ ?>
					</ul>
					<?php  if( $jwdsp_pager != ''){ ?>
						<div class="swiper-pagination <?php echo $this->id . '-pagination';?>"></div>
					<?php } ?>	
					<?php  if( $jwdsp_controls != ''){ ?>
						<div class="swiper-button-next <?php echo $this->id . '-next';?> jwdsp_icon-next"></div>
						<div class="swiper-button-prev <?php echo $this->id . '-prev';?> jwdsp_icon-prev"></div>
					<?php } ?>	
				</div>	
				<?php if($jwdsp_seemore == 'true'){ ?>	
				<div class="jwdsp_widget-btn" style="text-align:<?php echo $jwdsp_general_settings['button_position']?>;">
					<?php $button_text = $jwdsp_general_settings['button_text']; 
						  $button_size = $jwdsp_general_settings['button_size']; 
						  $jwdsp_seemore_args = array( 'post_type' => $jwdsp_post_type, 'taxonomy' => $jwdsp_taxonomy, 'tax_term'	=> $jwdsp_tax_term, 'custom_link' => $jwdsp_button_link); 
					?>
					<a class="jwdsp_widget-button <?php echo 'jwdsp_btn_'.$button_size . ' '. $this->id;?>_wgbtn_style" <?php echo $wgbtn_style;?> href="<?php echo jwdsp_get_seemore_link($jwdsp_seemore_args); ?> ">
						<?php echo esc_attr($button_text);?>
					</a> 
				</div>
				<?php } 	
					echo jwdsp_slider_script( array( 
						'slider_id' 		=> $this->id, 
						'slider_controls' 	=> $jwdsp_controls, 
						'slider_pager' 		=> $jwdsp_pager, 
						'slider_loop' 		=> $jwdsp_inloop 
					));	
					if($jwdsp_credit == 'true'){ 
				?>
				<div class="jwdsp_widget-credit"><?php echo sprintf( __('Proudly powered by %s','jwdsp'), '<a href="http://jordachewd.com/" target="blank">JordacheWD</a>' ); ?></div>
			<?php }
				/* Restore original Post Data -- WP Query */	
				wp_reset_postdata();
			} 
			echo $after_widget;
			/* End */
		}
	/** Form */
		function form($instance) {
			if ( isset( $instance[ 'title' ] )) { $title = $instance[ 'title' ]; } else { $title = '';}
			if ( isset( $instance[ 'jwdsp_post_type' ] )) { $jwdsp_post_type = esc_attr( $instance[ 'jwdsp_post_type' ] ); } else { $jwdsp_post_type = 'post';}
			if ( isset( $instance[ 'jwdsp_taxonomy' ] )) { $jwdsp_taxonomy = esc_attr( $instance[ 'jwdsp_taxonomy' ] ); } else { $jwdsp_taxonomy = 'category';}
			if ( isset( $instance[ 'jwdsp_tax_term' ] )) { $jwdsp_tax_term = esc_attr( $instance[ 'jwdsp_tax_term' ] ); } else { $jwdsp_tax_term = '';}
			if ( isset( $instance[ 'jwdsp_listing' ] )) { $jwdsp_listing = esc_attr( $instance[ 'jwdsp_listing' ] ); } else { $jwdsp_listing = '5';}
			if ( isset( $instance[ 'jwdsp_order' ] )) { $jwdsp_order = esc_attr( $instance[ 'jwdsp_order' ] ); } else { $jwdsp_order = 'DESC';}
			if ( isset( $instance[ 'jwdsp_exclude_posts' ] )) { $jwdsp_exclude_posts = esc_attr( $instance[ 'jwdsp_exclude_posts' ] ); } else { $jwdsp_exclude_posts = '';}
			if ( isset( $instance[ 'jwdsp_custom_query' ] )) { $jwdsp_custom_query = esc_attr( $instance[ 'jwdsp_custom_query' ] ); } else { $jwdsp_custom_query = '';}
			if ( isset( $instance[ 'jwdsp_button_link' ] )) { $jwdsp_button_link = esc_url( $instance[ 'jwdsp_button_link' ] ); } else { $jwdsp_button_link = '';}
			if ( isset( $instance[ 'jwdsp_btntxt_size' ] )) { $jwdsp_btntxt_size = esc_attr( $instance[ 'jwdsp_btntxt_size' ] ); } else { $jwdsp_btntxt_size = '16';}
			if ( isset( $instance[ 'jwdsp_btnbrd_radius' ] )) { $jwdsp_btnbrd_radius = esc_attr( $instance[ 'jwdsp_btnbrd_radius' ] ); } else { $jwdsp_btnbrd_radius = '2';}
			if ( isset( $instance[ 'jwdsp_btn_padding' ] )) { $jwdsp_btn_padding = esc_attr( $instance[ 'jwdsp_btn_padding' ] ); } else { $jwdsp_btn_padding = '10';}
			if ( isset( $instance[ 'jwdsp_btn_padding_o' ] )) { $jwdsp_btn_padding_o = esc_attr( $instance[ 'jwdsp_btn_padding_o' ] ); } else { $jwdsp_btn_padding_o = '10';}
			if ( isset( $instance[ 'jwdsp_posttitle_size' ] )) { $jwdsp_posttitle_size = esc_attr( $instance[ 'jwdsp_posttitle_size' ] ); } else { $jwdsp_posttitle_size = '20';}
			if ( isset( $instance[ 'jwdsp_postcontent_size' ] )) { $jwdsp_postcontent_size = esc_attr( $instance[ 'jwdsp_postcontent_size' ] ); } else { $jwdsp_postcontent_size = '13';}
			if ( isset( $instance[ 'jwdsp_posttitle_trim' ] )) { $jwdsp_posttitle_trim = esc_attr( $instance[ 'jwdsp_posttitle_trim' ] ); } else { $jwdsp_posttitle_trim = '8';}
			if ( isset( $instance[ 'jwdsp_postcontent_trim' ] )) { $jwdsp_postcontent_trim = esc_attr( $instance[ 'jwdsp_postcontent_trim' ] ); } else { $jwdsp_postcontent_trim = '30';}
			if ( isset( $instance[ 'jwdsp_postmeta_size' ] )) { $jwdsp_postmeta_size = esc_attr( $instance[ 'jwdsp_postmeta_size' ] ); } else { $jwdsp_postmeta_size = '12';}
			if ( isset( $instance[ 'jwdsp_inloop' ] )) { $jwdsp_inloop = esc_attr( $instance[ 'jwdsp_inloop' ] ); } else { $jwdsp_inloop = 'true';}
			if ( isset( $instance[ 'jwdsp_exclude_current' ] )) { $jwdsp_exclude_current = esc_attr( $instance[ 'jwdsp_exclude_current' ] ); } else { $jwdsp_exclude_current = 'true';}
			if ( isset( $instance[ 'jwdsp_seemore' ] )) { $jwdsp_seemore = esc_attr( $instance[ 'jwdsp_seemore' ] ); } else { $jwdsp_seemore = 'true';}
			if ( isset( $instance[ 'jwdsp_credit' ] )) { $jwdsp_credit = esc_attr( $instance[ 'jwdsp_credit' ] ); } else { $jwdsp_credit = 'true';}
			if ( isset( $instance[ 'jwdsp_if_no_thumb' ] )) { $jwdsp_if_no_thumb = esc_attr( $instance[ 'jwdsp_if_no_thumb' ] ); } else { $jwdsp_if_no_thumb = 'true';}
			if ( isset( $instance[ 'jwdsp_controls' ] )) { $jwdsp_controls = esc_attr( $instance[ 'jwdsp_controls' ] ); } else { $jwdsp_controls = 'true';}
			if ( isset( $instance[ 'jwdsp_pager' ] )) { $jwdsp_pager = esc_attr( $instance[ 'jwdsp_pager' ] ); } else { $jwdsp_pager = 'true';}
			if ( isset( $instance[ 'jwdsp_showexcerpt' ] )) { $jwdsp_showexcerpt = esc_attr( $instance[ 'jwdsp_showexcerpt' ] ); } else { $jwdsp_showexcerpt = 'true';}
			if ( isset( $instance[ 'jwdsp_showthumb' ] )) { $jwdsp_showthumb = esc_attr( $instance[ 'jwdsp_showthumb' ] ); } else { $jwdsp_showthumb = 'true';}
			if ( isset( $instance[ 'jwdsp_showtitle' ] )) { $jwdsp_showtitle = esc_attr( $instance[ 'jwdsp_showtitle' ] ); } else { $jwdsp_showtitle = 'true';}
			if ( isset( $instance[ 'jwdsp_showdate' ] )) { $jwdsp_showdate = esc_attr( $instance[ 'jwdsp_showdate' ] ); } else { $jwdsp_showdate = 'true';}
			if ( isset( $instance[ 'jwdsp_comments' ] )) { $jwdsp_comments = esc_attr( $instance[ 'jwdsp_comments' ] ); } else { $jwdsp_comments = 'false';}
			if ( isset( $instance[ 'jwdsp_categories' ] )) { $jwdsp_categories = esc_attr( $instance[ 'jwdsp_categories' ] ); } else { $jwdsp_categories = 'false'; } 
			if ( isset( $instance[ 'jwdsp_tags' ] )) { $jwdsp_tags = esc_attr( $instance[ 'jwdsp_tags' ] ); } else { $jwdsp_tags = 'false'; } 
			if ( isset( $instance[ 'jwdsp_thumb_bg' ] )) { $jwdsp_thumb_bg = esc_attr( $instance[ 'jwdsp_thumb_bg' ] ); } else { $jwdsp_thumb_bg = 'cover'; } 
			$jwdsp_general_settings = get_option('jwdsp_general_settings');
			/* Fields Args */
			$posttype_args = array(
				'id' 			=> $this->get_field_id('jwdsp_post_type'),
				'name'			=> $this->get_field_name('jwdsp_post_type'),
				'selected' 		=> $jwdsp_post_type,
				'class' 		=> 'jwdsp_posttype_selector',
				'style'			=> 'width:100%',
				'allowed_posts' => 	$jwdsp_general_settings['post_types'],
				'description'	=>  sprintf( 
										__( 'Go to %s to define more custom post types.', 'jwdsp' ),
										'<a href="'. esc_url( get_admin_url( null, 'admin.php?page=jwdsp_postslider_page' ) ) .'">'.__('General Settings','jwdsp').'</a>'
									)
			);
			$taxonomy_args = array(
				'id' 			=> $this->get_field_id('jwdsp_taxonomy'),
				'name'			=> $this->get_field_name('jwdsp_taxonomy'),
				'post_type'		=> $jwdsp_post_type,
				'selected' 		=> $jwdsp_taxonomy,
				'class' 		=> 'jwdsp_taxonomy_selector',
				'style'			=> 'width:100%',
				'exclude' 		=> 'post_format',
			);
			$term_args = array(
				'id' 			=> $this->get_field_id('jwdsp_tax_term'),
				'name'			=> $this->get_field_name('jwdsp_tax_term'),
				'post_type'		=> $jwdsp_post_type,
				'selected' 		=> $jwdsp_tax_term,
				'class' 		=> 'jwdsp_taxterm_selector',
				'style'			=> 'width:100%',
				'taxonomy'		=> $jwdsp_taxonomy,
			);
			$per_page_args = array(
				'id' 			=> $this->get_field_id('jwdsp_listing'),
				'name'			=> $this->get_field_name('jwdsp_listing'),
				'label' 		=> __('Posts to show:', 'jwdsp'),
				'style'			=> 'width:40px',
				'value'			=> $jwdsp_listing,
			);
			$date_order_args = array(
				'id' 			=> $this->get_field_id('jwdsp_order'),
				'name'			=> $this->get_field_name('jwdsp_order'),
				'selected'		=> $jwdsp_order,
			);
			$exclude_args = array(
				'id' 			=> $this->get_field_id('jwdsp_exclude_posts'),
				'name'			=> $this->get_field_name('jwdsp_exclude_posts'),
				'label' 		=> __('Exclude', 'jwdsp'),
				'value'			=> $jwdsp_exclude_posts,
				'description'	=> __('Post IDs, separated by commas.', 'jwdsp'),
			);
			$custom_query_args = array(
				'id' 			=> $this->get_field_id('jwdsp_custom_query'),
				'name'			=> $this->get_field_name('jwdsp_custom_query'),
				'label'			=> sprintf( __( 'Custom Query from post type: %s', 'jwdsp'), '<code class="jwdsp_custom_query_post">' . $jwdsp_post_type . '</code>' ),
				'value'			=> $jwdsp_custom_query,
				'description'	=> __('Post IDs, separated by commas.', 'jwdsp'),
				'loader'		=> true
			);
			$btn_link_args = array(
				'id' 			=> $this->get_field_id('jwdsp_button_link'),
				'name'			=> $this->get_field_name('jwdsp_button_link'),
				'label' 		=> __('Button Link', 'jwdsp'),
				'value'			=> $jwdsp_button_link,
				'class'			=> 'btn_link',
				'description'	=> __('Leave empty for default.', 'jwdsp'),
			);
			$titlesize_args = array(
				'id' 			=> $this->get_field_id('jwdsp_posttitle_size'),
				'name'			=> $this->get_field_name('jwdsp_posttitle_size'),
				'label' 		=> __('Post title:', 'jwdsp'),
				'value'			=> $jwdsp_posttitle_size,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'px'
			);
			$contentsize_args = array(
				'id' 			=> $this->get_field_id('jwdsp_postcontent_size'),
				'name'			=> $this->get_field_name('jwdsp_postcontent_size'),
				'label' 		=> __('Post content:', 'jwdsp'),
				'value'			=> $jwdsp_postcontent_size,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'px'
			);
			$metasize_args = array(
				'id' 			=> $this->get_field_id('jwdsp_postmeta_size'),
				'name'			=> $this->get_field_name('jwdsp_postmeta_size'),
				'label' 		=> __('Post meta:', 'jwdsp'),
				'value'			=> $jwdsp_postmeta_size,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'px'
			);
			$btntxtsize_args = array(
				'id' 			=> $this->get_field_id('jwdsp_btntxt_size'),
				'name'			=> $this->get_field_name('jwdsp_btntxt_size'),
				'label' 		=> __('Button text:', 'jwdsp'),
				'value'			=> $jwdsp_btntxt_size,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'px'
			);
			$btnbrdradius_args = array(
				'id' 			=> $this->get_field_id('jwdsp_btnbrd_radius'),
				'name'			=> $this->get_field_name('jwdsp_btnbrd_radius'),
				'label' 		=> __('Button corner radius:', 'jwdsp'),
				'value'			=> $jwdsp_btnbrd_radius,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> ''
			);
			$btnpadding_args = array(
				'id' 			=> $this->get_field_id('jwdsp_btn_padding'),
				'name'			=> $this->get_field_name('jwdsp_btn_padding'),
				'label' 		=> __('Button height:', 'jwdsp'),
				'value'			=> $jwdsp_btn_padding,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> ''
			);
			$btnpadding_o_args = array(
				'id' 			=> $this->get_field_id('jwdsp_btn_padding_o'),
				'name'			=> $this->get_field_name('jwdsp_btn_padding_o'),
				'label' 		=> __('Button width:', 'jwdsp'),
				'value'			=> $jwdsp_btn_padding_o,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> '',
				'description'	=> sprintf(
									'<small>'.__('Only visible if <b>%1$s</b> is set to <b>%2$s</b>.', 'jwdsp').'</small>', 
									'<a href="'. esc_url(get_admin_url(null, 'admin.php?page=jwdsp_postslider_page#button_background_hover' )) .'">'.__('Button size','jwdsp').'</a>', 
									__('Auto', 'jwdsp')
									)
			);
			$titletrim_args = array(
				'id' 			=> $this->get_field_id('jwdsp_posttitle_trim'),
				'name'			=> $this->get_field_name('jwdsp_posttitle_trim'),
				'label' 		=> __('Trim title to ', 'jwdsp').'<i style="font-size:95%;">('.__('words', 'jwdsp').')</i>',
				'value'			=> $jwdsp_posttitle_trim,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'ch'
			);
			$contenttrim_args = array(
				'id' 			=> $this->get_field_id('jwdsp_postcontent_trim'),
				'name'			=> $this->get_field_name('jwdsp_postcontent_trim'),
				'label' 		=> __('Trim excerpt to ', 'jwdsp').'<i style="font-size:95%;">('.__('words', 'jwdsp').')</i>',
				'value'			=> $jwdsp_postcontent_trim,
				'style'			=> 'width:95%;margin:1em 0 1em .25em;',
				'type'			=> 'slider',
				'class'			=> 'jwdsp_slider-input',
				'unit'			=> 'ch'
			);
			$cover_args = array(
				'id' 			=> $this->get_field_id('jwdsp_thumb_bg'),
				'name'			=> $this->get_field_name('jwdsp_thumb_bg'),
				'label' 		=> __('Cover', 'jwdsp'),
				'value'			=> 'cover',
				'style'			=> 'display:inline-block;width:auto',
				'checked' 		=> $jwdsp_thumb_bg,
			);
			$contain_args = array(
				'id' 			=> $this->get_field_id('jwdsp_thumb_bg'),
				'name'			=> $this->get_field_name('jwdsp_thumb_bg'),
				'label' 		=> __('Contain', 'jwdsp'),
				'value'			=> 'contain',
				'style'			=> 'display:inline-block;width:auto',
				'checked' 		=> $jwdsp_thumb_bg,
			);
			$showtitle_args = array(
				'id' 			=> $this->get_field_id('jwdsp_showtitle'),
				'name'			=> $this->get_field_name('jwdsp_showtitle'),
				'label' 		=> __('Display post title', 'jwdsp'),
				'checked' 		=> $jwdsp_showtitle,
			);
			$controls_args = array(
				'id' 			=> $this->get_field_id('jwdsp_controls'),
				'name'			=> $this->get_field_name('jwdsp_controls'),
				'label' 		=> __('Display arrows', 'jwdsp'),
				'checked' 		=> $jwdsp_controls,
			);
			$pager_args = array(
				'id' 			=> $this->get_field_id('jwdsp_pager'),
				'name'			=> $this->get_field_name('jwdsp_pager'),
				'label' 		=> __('Display pagination', 'jwdsp'),
				'checked' 		=> $jwdsp_pager,
			);
			$showdate_args = array(
				'id' 			=> $this->get_field_id('jwdsp_showdate'),
				'name'			=> $this->get_field_name('jwdsp_showdate'),
				'label' 		=> __('Display date', 'jwdsp'),
				'checked' 		=> $jwdsp_showdate,
			);
			$comments_args = array(
				'id' 			=> $this->get_field_id('jwdsp_comments'),
				'name'			=> $this->get_field_name('jwdsp_comments'),
				'label' 		=> __('Display comments', 'jwdsp'),
				'checked' 		=> $jwdsp_comments,
			);
			$showexcerpt_args = array(
				'id' 			=> $this->get_field_id('jwdsp_showexcerpt'),
				'name'			=> $this->get_field_name('jwdsp_showexcerpt'),
				'label' 		=> __('Display excerpt', 'jwdsp'),
				'checked' 		=> $jwdsp_showexcerpt,
			);
			$categories_args = array(
				'id' 			=> $this->get_field_id('jwdsp_categories'),
				'name'			=> $this->get_field_name('jwdsp_categories'),
				'label' 		=> __('Display categories', 'jwdsp'),
				'checked' 		=> $jwdsp_categories,
			);
			$tags_args = array(
				'id' 			=> $this->get_field_id('jwdsp_tags'),
				'name'			=> $this->get_field_name('jwdsp_tags'),
				'label' 		=> __('Display tags', 'jwdsp'),
				'checked' 		=> $jwdsp_tags,
			);
			$inloop_args = array(
				'id' 			=> $this->get_field_id('jwdsp_inloop'),
				'name'			=> $this->get_field_name('jwdsp_inloop'),
				'label' 		=> __('Slide posts in <b>loop mode</b>', 'jwdsp'),
				'checked' 		=> $jwdsp_inloop,
			);
			$excl_curr_args = array(
				'id' 			=> $this->get_field_id('jwdsp_exclude_current'),
				'name'			=> $this->get_field_name('jwdsp_exclude_current'),
				'label' 		=> __('Exclude current post from loop', 'jwdsp'),
				'checked' 		=> $jwdsp_exclude_current,
			);
			$seemore_args = array(
				'id' 			=> $this->get_field_id('jwdsp_seemore'),
				'name'			=> $this->get_field_name('jwdsp_seemore'),
				'label' 		=> __('Display <b>See More</b> button', 'jwdsp'),
				'checked' 		=> $jwdsp_seemore,
			);
			$credit_args = array(
				'id' 			=> $this->get_field_id('jwdsp_credit'),
				'name'			=> $this->get_field_name('jwdsp_credit'),
				'label' 		=> __('Display "Proudly powered by" credit link', 'jwdsp'),
				'checked' 		=> $jwdsp_credit,
			);
			$showthumb_args = array(
				'id' 			=> $this->get_field_id('jwdsp_showthumb'),
				'name'			=> $this->get_field_name('jwdsp_showthumb'),
				'label' 		=> __('Display image', 'jwdsp'),
				'checked' 		=> $jwdsp_showthumb,
			);
			$nothumb_args = array(
				'id' 			=> $this->get_field_id('jwdsp_if_no_thumb'),
				'name'			=> $this->get_field_name('jwdsp_if_no_thumb'),
				'label' 		=> __('<b>Hide</b> posts <b>with no image</b>', 'jwdsp'),
				'checked' 		=> $jwdsp_if_no_thumb,
			);
			/* Get the Fields */
		?>
		<div class="jwdsp_widget_content">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'jwdsp'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<?php if (!preg_match('/__i__/', $this->id)){ echo '<p><small>' .sprintf( __('Use this ID %1$s in your %2$s for this widget.','jwdsp'), '<code>#'. $this->id .'</code>', '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=jwdsp_postslider_page#custom_css' ) ) .'">'.__('Custom css','jwdsp').'</a>'). '</small></p>'; } ?>
			<ul class="jwdsp_tabs">
				<li class="active"><?php _e('Posts', 'jwdsp');?></li>
				<li><?php _e('Settings', 'jwdsp');?></li>
				<li><?php _e('Customize', 'jwdsp');?></li>
			</ul>
			<ul class="jwdsp_tab">
				<!-- Default Posts TAB -->
				<li class="active">
				<?php	
					echo jwdsp_posttype_selector($posttype_args);
					echo jwdsp_taxonomy_selector($taxonomy_args);
					echo jwdsp_term_selector($term_args);
					echo jwdsp_text_field($exclude_args);
					echo jwdsp_text_field($custom_query_args);
					echo jwdsp_date_order_field($date_order_args);
					echo jwdsp_text_field($per_page_args); 
					echo jwdsp_text_field($btn_link_args); 
				?>
				</li>
				<!-- END Posts TAB -->
				<!-- Settings TAB -->
				<li>
					<div class="jwdsp_tab-section">
						<h4><?php _e('Display image as', 'jwdsp'); ?></h4>
						<div class="jwdsp_tab-row jwdsp_switch-field"><?php echo jwdsp_radio_button($cover_args) . jwdsp_radio_button($contain_args); ?></div>
					</div>
					<div class="jwdsp_tab-section">
						<h4><?php _e('Title position', 'jwdsp'); ?></h4>
						<div class="jwdsp_tab-row jwdsp_switch-field"><small><i>
					<?php echo sprintf( 
							__( 'This option has been moved to %s', 'jwdsp' ), 
							'<a href="'. esc_url( get_admin_url(null, 'admin.php?page=jwdsp_postslider_page#title_hover' ) ) .'">'.__('General Settings','jwdsp').'</a>'); 
					?>
						</i></small></div>
					</div>
					<h4><?php _e('Also...', 'jwdsp'); ?></h4>
					<div class="jwdsp_tab-row">
					<?php	
						echo jwdsp_checkbox_button($inloop_args);
						echo jwdsp_checkbox_button($excl_curr_args);
						echo jwdsp_checkbox_button($nothumb_args);
						echo jwdsp_checkbox_button($showtitle_args);
						echo jwdsp_checkbox_button($showthumb_args);
						echo jwdsp_checkbox_button($showdate_args);
						echo jwdsp_checkbox_button($comments_args);
						echo jwdsp_checkbox_button($showexcerpt_args);
						echo jwdsp_checkbox_button($categories_args);
						echo jwdsp_checkbox_button($tags_args);
						echo jwdsp_checkbox_button($controls_args);
						echo jwdsp_checkbox_button($pager_args);
						echo jwdsp_checkbox_button($seemore_args);
						echo jwdsp_checkbox_button($credit_args);
					?>
					</div>
				</li>
				<!-- END Settings TAB -->
				<!-- Customize TAB -->
				<li class="jwdsp_accordion">
					<?php	
						echo '<div class="jwdsp_tab-row"><h4>'.__('Font size', 'jwdsp').'</h4></div>';
						echo jwdsp_text_field($titlesize_args); 
						echo jwdsp_text_field($contentsize_args); 
						echo jwdsp_text_field($metasize_args); 
						echo '<br /><div class="jwdsp_tab-row"><h4>'.__('Button style', 'jwdsp').'</h4></div>';
						echo jwdsp_text_field($btntxtsize_args);
						echo jwdsp_text_field($btnbrdradius_args);
						echo jwdsp_text_field($btnpadding_args);
						echo jwdsp_text_field($btnpadding_o_args);
						echo '<br /><div class="jwdsp_tab-row"><h4>'.__('Trim content', 'jwdsp').'</h4></div>';
						echo jwdsp_text_field($titletrim_args); 
						echo jwdsp_text_field($contenttrim_args ); 	
					?>
					<div class="jwdsp_tab-row"><br />
						<a href="<?php echo esc_url( get_admin_url(null, 'admin.php?page=jwdsp_postslider_page' ) )?>" class="button button-small"><?php _e('Customize More','jwdsp');?></a>
					</div>
				</li>
				<!-- END style TAB -->
			</ul>
			<?php echo jwdsp_get_panel_footer('widget'); ?>
		</div>
<?php   }
	/** Update */
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] 						= ( ! empty( $new_instance['title'] )) ? strip_tags( $new_instance['title'] ) : '';
			$instance['jwdsp_listing'] 				= ( ! empty( $new_instance['jwdsp_listing'] ) && is_numeric($new_instance['jwdsp_listing'])) ? strip_tags( absint($new_instance['jwdsp_listing']) ) : '5';
			$instance['jwdsp_post_type'] 			= ( ! empty( $new_instance['jwdsp_post_type'] )) ? strip_tags( $new_instance['jwdsp_post_type'] ) : '';
			$instance['jwdsp_exclude_posts'] 		= ( ! empty( $new_instance['jwdsp_exclude_posts'] )) ? strip_tags( $new_instance['jwdsp_exclude_posts'] ) : '';
			$instance['jwdsp_custom_query'] 		= ( ! empty( $new_instance['jwdsp_custom_query'] )) ? strip_tags( $new_instance['jwdsp_custom_query'] ) : '';
			$instance['jwdsp_button_link'] 			= ( ! empty( $new_instance['jwdsp_button_link'] )) ? strip_tags( $new_instance['jwdsp_button_link'] ) : '';
			$instance['jwdsp_btntxt_size'] 			= ( ! empty( $new_instance['jwdsp_btntxt_size'] ) && is_numeric($new_instance['jwdsp_btntxt_size'])) ? strip_tags( absint($new_instance['jwdsp_btntxt_size'])) : '16';
			$instance['jwdsp_btnbrd_radius'] 		= ( ! empty( $new_instance['jwdsp_btnbrd_radius'] ) && is_numeric($new_instance['jwdsp_btnbrd_radius'])) ? strip_tags( absint($new_instance['jwdsp_btnbrd_radius']) ) : '2';
			$instance['jwdsp_btn_padding'] 			= ( ! empty( $new_instance['jwdsp_btn_padding'] ) && is_numeric($new_instance['jwdsp_btn_padding'])) ? strip_tags( absint($new_instance['jwdsp_btn_padding']) ) : '0';
			$instance['jwdsp_btn_padding_o'] 		= ( ! empty( $new_instance['jwdsp_btn_padding_o'] ) && is_numeric($new_instance['jwdsp_btn_padding_o'])) ? strip_tags( absint($new_instance['jwdsp_btn_padding_o']) ) : '0';
			$instance['jwdsp_posttitle_size'] 		= ( ! empty( $new_instance['jwdsp_posttitle_size'] ) && is_numeric($new_instance['jwdsp_posttitle_size'])) ? strip_tags( absint($new_instance['jwdsp_posttitle_size']) ) : '20';
			$instance['jwdsp_postcontent_size'] 	= ( ! empty( $new_instance['jwdsp_postcontent_size'] ) && is_numeric($new_instance['jwdsp_postcontent_size'])) ? strip_tags( absint($new_instance['jwdsp_postcontent_size'])) : '13';
			$instance['jwdsp_postmeta_size'] 		= ( ! empty( $new_instance['jwdsp_postmeta_size'] ) && is_numeric($new_instance['jwdsp_postmeta_size'])) ? strip_tags( absint($new_instance['jwdsp_postmeta_size'])) : '12';
			$instance['jwdsp_posttitle_trim'] 		= ( ! empty( $new_instance['jwdsp_posttitle_trim'] ) && is_numeric($new_instance['jwdsp_posttitle_trim'])) ? strip_tags( absint($new_instance['jwdsp_posttitle_trim'])) : '8';	
			$instance['jwdsp_postcontent_trim'] 	= ( ! empty( $new_instance['jwdsp_postcontent_trim'] ) && is_numeric($new_instance['jwdsp_postcontent_trim'])) ? strip_tags( absint($new_instance['jwdsp_postcontent_trim']) ) : '30';	
			$instance['jwdsp_taxonomy'] 			= ( ! empty( $new_instance['jwdsp_taxonomy'] )) ? strip_tags( $new_instance['jwdsp_taxonomy'] ) : '';
			$instance['jwdsp_tax_term'] 			= ( ! empty( $new_instance['jwdsp_tax_term'] )) ? strip_tags( $new_instance['jwdsp_tax_term'] ) : '';
			$instance['jwdsp_order'] 				= ( ! empty( $new_instance['jwdsp_order'] )) ? strip_tags( $new_instance['jwdsp_order'] ) : '';
			$instance['jwdsp_inloop'] 				= ( ! empty( $new_instance['jwdsp_inloop'] )) ? strip_tags( $new_instance['jwdsp_inloop'] ) : '';
			$instance['jwdsp_exclude_current'] 		= ( ! empty( $new_instance['jwdsp_exclude_current'] )) ? strip_tags( $new_instance['jwdsp_exclude_current'] ) : '';
			$instance['jwdsp_seemore'] 				= ( ! empty( $new_instance['jwdsp_seemore'] )) ? strip_tags( $new_instance['jwdsp_seemore'] ) : '';
			$instance['jwdsp_credit'] 				= ( ! empty( $new_instance['jwdsp_credit'] )) ? strip_tags( $new_instance['jwdsp_credit'] ) : '';
			$instance['jwdsp_if_no_thumb'] 			= ( ! empty( $new_instance['jwdsp_if_no_thumb'] )) ? strip_tags( $new_instance['jwdsp_if_no_thumb'] ) : '';
			$instance['jwdsp_controls'] 			= ( ! empty( $new_instance['jwdsp_controls'] )) ? strip_tags( $new_instance['jwdsp_controls'] ) : '';
			$instance['jwdsp_pager'] 				= ( ! empty( $new_instance['jwdsp_pager'] )) ? strip_tags( $new_instance['jwdsp_pager'] ) : '';
			$instance['jwdsp_showexcerpt'] 			= ( ! empty( $new_instance['jwdsp_showexcerpt'] )) ? strip_tags( $new_instance['jwdsp_showexcerpt'] ) : '';
			$instance['jwdsp_showthumb'] 			= ( ! empty( $new_instance['jwdsp_showthumb'] )) ? strip_tags( $new_instance['jwdsp_showthumb'] ) : '';
			$instance['jwdsp_showtitle'] 			= ( ! empty( $new_instance['jwdsp_showtitle'] )) ? strip_tags( $new_instance['jwdsp_showtitle'] ) : '';
			$instance['jwdsp_showdate'] 			= ( ! empty( $new_instance['jwdsp_showdate'] )) ? strip_tags( $new_instance['jwdsp_showdate'] ) : '';
			$instance['jwdsp_comments'] 			= ( ! empty( $new_instance['jwdsp_comments'] )) ? strip_tags( $new_instance['jwdsp_comments'] ) : '';
			$instance['jwdsp_categories'] 			= ( ! empty( $new_instance['jwdsp_categories'] )) ? strip_tags( $new_instance['jwdsp_categories'] ) : '';
			$instance['jwdsp_tags'] 				= ( ! empty( $new_instance['jwdsp_tags'] )) ? strip_tags( $new_instance['jwdsp_tags'] ) : '';
			$instance['jwdsp_thumb_bg'] 			= ( ! empty( $new_instance['jwdsp_thumb_bg'] )) ? strip_tags( $new_instance['jwdsp_thumb_bg'] ) : '';
			return $instance;
		}
	}
}
/** Register and load the widget */
if ( ! function_exists( 'JWDSP_widget_init' ) ) {
	add_action( 'widgets_init', 'JWDSP_widget_init' );	 
	function JWDSP_widget_init() {	register_widget('JWDSP_PostSlider'); }
}