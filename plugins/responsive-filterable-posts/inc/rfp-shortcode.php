<?php
function rfp_shortcode_func( $atts ) {
	ob_start();
    $opts = shortcode_atts( array(
        'id' => '',
    ), $atts );
	
	$postID = $opts['id'];
	
	if(!empty($postID) && 'rfp-scode' == get_post_type($postID))
	{
		$rfp_data = get_post_meta($postID);
		
		// fetch rfp post meta data
		$_rfp_selpost  = !empty($rfp_data['_rfp_selpost'][0]) ? $rfp_data['_rfp_selpost'][0] : '';
		
		// if selected 'post type' exists
		if ( !empty($_rfp_selpost) && post_type_exists($_rfp_selpost) ) 
		{
			$_rfp_seltax   = !empty($rfp_data['_rfp_seltax'][0]) ? $rfp_data['_rfp_seltax'][0] : '';
			$_rfp_taxterms = !empty($rfp_data['_rfp_taxterms'][0]) ? unserialize($rfp_data['_rfp_taxterms'][0]) : array();
			$_rfp_st_dcol  = !empty($rfp_data['_rfp_st_dcol'][0]) ? $rfp_data['_rfp_st_dcol'][0] : '';
			$_rfp_st_tcol  = !empty($rfp_data['_rfp_st_tcol'][0]) ? $rfp_data['_rfp_st_tcol'][0] : '';
			$_rfp_st_pcol  = !empty($rfp_data['_rfp_st_pcol'][0]) ? $rfp_data['_rfp_st_pcol'][0] : '';
			$_rfp_st_size  = !empty($rfp_data['_rfp_st_size'][0]) ? $rfp_data['_rfp_st_size'][0] : '';
			
			wp_reset_query();
			
			// custom query with arguments to fetch project posts
			$rfp_posts_args = array(
				'post_type'			  => $_rfp_selpost,
				'posts_per_page'	  => '-1',
				'post_status'		  => 'publish',
				'ignore_sticky_posts' => true,
				'tax_query'  => array(
					array(
						'taxonomy' => $_rfp_seltax,
						'field'    => 'id',
						'terms'    => unserialize($_rfp_taxterms),
					),
				),
			);
			$filter_posts = new WP_Query( $rfp_posts_args );
			$contentCall  = 'rfp-shortcode-'.$postID;
			?>
			<div id='<?php echo $contentCall; ?>' class='rfp-wrapper <?php echo $contentCall; ?>'><!-- .rfp-wrapper starts -->
				<!-- .rfp-filter -->
				<div class="rfp-filter">
					<ul class="filter rfpfilters">
						<li><a href="JavaScript:void(0);" data-filter="*" class="active"><?php _e('All','rfp'); ?></a></li>
						<?php
						$filter_terms = unserialize($_rfp_taxterms);
						foreach( $filter_terms as $term_id ) 
						{
							$term      = get_term( $term_id, $_rfp_seltax );
							$term_slug = $term->slug;
							$term_name = $term->name; 
							?>
							<li><a href="JavaScript:void(0);" data-filter="<?php echo $term_slug; ?>"><?php echo $term_name; ?></a></li>
							<?php 
						} 
						?>
					</ul>
				</div>
				<div class="rfp-posts rfp-grids">
					<?php
					if ( $filter_posts->have_posts() ) :
					while ( $filter_posts->have_posts() ) : $filter_posts->the_post(); 
						$data_type  = '';
						$postID     = get_the_ID();
						$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), $_rfp_st_size ); 	
						$terms      = get_the_terms( $postID, $_rfp_seltax ); 
						$cat_links  = array();
						foreach ( $terms as $term ) {
							$cat_links[] = $term->slug;
						}
						foreach($cat_links as $itm){
							$data_type .= $itm.' ';
						}
						?>
						<div class="rfp-item item <?php echo $data_type; $data_type = null; ?> rfp-grid <?php echo $_rfp_st_dcol.' '.$_rfp_st_tcol.' '.$_rfp_st_pcol; ?>">
							<?php if(isset($post_thumb[0]) && $post_thumb[0] !=""){ ?><div class="rfp-imgwrap"><img alt="<?php the_title(); ?>" src="<?php echo $post_thumb[0]; ?>" class="rfp-img"></div><?php } ?>
							<a class="rfp-mask" href="<?php the_permalink(); ?>"></a>
							<div class="rfp-item-title"><?php the_title(); ?></div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					else: 	
					_e( 'Sorry, no post items found. Kindly add.','rfp' );
					endif;
					?>
				</div>
				<script>
				jQuery(window).load( function() 
				{
					var $container = jQuery('#<?php echo $contentCall ?> .rfp-posts');
					// initialize isotope
					$container.isotope({
						filter: '*',
						animationOptions: {
							duration: 750,
							easing: 'linear',
							queue: false,
						}
					});
					// filter items when filter link is clicked
					jQuery('#<?php echo $contentCall ?> .rfpfilters a').click(function(){
						var selector = jQuery(this).attr('data-filter');
						if( selector !== '*' ) selector = selector.replace(selector, '.' + selector)
						$container.isotope({ 
							filter: selector ,
							animationOptions: {
								duration: 750,
								easing: 'linear',
								queue: false,	
							}
						});
						return false;
					});
					// set active filter items
					var $optionSets = jQuery('#<?php echo $contentCall ?> .filter'),
					$optionLinks    = $optionSets.find('a');
					$optionLinks.click(function(){
						var $this = jQuery(this);
						// don't proceed if already active
						if ( $this.hasClass('active') ) {
							return false;
						}
						var $optionSet = $this.parents('.filter');
						$optionSet.find('.active').removeClass('active');
						$this.addClass('active'); 
					});
				});	
				</script>
			</div><!-- .rfp-wrapper ends -->
			<?php
		}
		elseif(!empty($_rfp_selpost)){
			_e( 'Sorry, but '.ucwords($_rfp_selpost).' post type does not exists.','rfp' );
		}
	}
	else{
		_e( 'Sorry, RFP shortcode does not exists.','rfp' );
	}
	return ob_get_clean();
}
add_shortcode( 'rfp', 'rfp_shortcode_func' );

// Remove empty p tags for RFP shortcode
add_filter("the_content", "rfp_the_content_filter");

function rfp_the_content_filter($content) 
{
	// array of shortcode requiring the fix 
	$block = join("|",array("rfp"));
	
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	
	return $rep;
}