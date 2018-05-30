<?php

/* Plugin Name: Searchy
Plugin URI: 
Description: Ajax Form Engine for searching into your site. Use [searchy_filter] and [searchy_results] shortcodes in a WordPress page to get started.
Version: 1,0
Plugin Author: DopeWP
Author URI: http://wwww.dopewp.com/
*/



if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}



require_once("searchybits/options-panel.php");

 

function searchy_add_head_scripts() {//INCLUDE JS LIBRARIES AND STUFF
	
	//IF USER HAS SELECTED ONLY SOME PAGES , exit in other ones!
	if (get_option( 'sy_active_frontend_pages' )!="" & !is_page(preg_split('/\n|\r\n?/', get_option( 'sy_active_frontend_pages' )))) return;
	
	wp_enqueue_script('searchy-js', plugins_url('/searchy.js', __FILE__),  array( 'jquery','jquery-form' ),   false, true);
	wp_enqueue_style('searchy-css', plugins_url('/searchy.css', __FILE__));  
	 }    
 
add_action('wp_enqueue_scripts', 'searchy_add_head_scripts');  

add_action( 'wp_loaded', 'searchy_ajax_check_submission_and_process' );

function searchy_ajax_check_submission_and_process() {
	
	 if (isset($_GET['searchy_ajax_results'])) {  include("searchybits/perform-search.php");  die; }

}


 function searchy_html_callback($buffer)
{
 global $searchy_callback_html_store;
 $searchy_callback_html_store=$buffer;
  return;
}


////////////////////////////////////////////////////////////// SHORTCODES//////////////////////////////////////


////////////////// SEARCH FILTER SHOWING  SHORTCODE ///////////////////////////
function searchy_filters_func( $atts ) {
	 global $searchy_callback_html_store;
	$searchy_callback_html_store="";
	ob_start("searchy_html_callback");
		
	require_once("searchybits/search_filters.php");
		   
	ob_end_flush();
	
	return $searchy_callback_html_store;
}
add_shortcode( 'searchy_filter', 'searchy_filters_func' );

////WIDGETED VERSION
function searchy_filters_widgetfunc($args) {
	
	//IF USER HAS SELECTED ONLY SOME PAGES , exit in other ones!
	if (get_option( 'sy_active_frontend_pages' )!="" & !is_page(preg_split('/\n|\r\n?/', get_option( 'sy_active_frontend_pages' )))) return;
	
	
	echo $args['before_widget'];
	// Title is not needed generally
	// echo $args['before_title'] . 'My Unique Widget' .  $args['after_title'];
	
	// print some HTML for the widget to display here
	echo do_shortcode("[searchy_filter]");
	echo $args['after_widget'];
}

wp_register_sidebar_widget(
    'searchy_widget_1',        // your unique widget id
    'Searchy Widget',          // widget name
    'searchy_filters_widgetfunc',  // callback function
    array(                  // options
        'description' => 'Search Filters'
    )
);


////////////////// SORTING TOOLS & SEARCH RESULTS SHOWING  SHORTCODE ///////////////////////////

//Easily extendable
if (!function_exists("searchy_results_func")):
function searchy_results_func( $atts ) {
	
	//Prepare sorting elements for selected custom fields
	 $sorters_html="";
	  $custom_fields_setting = preg_split('/\n|\r\n?/', get_option( 'sy_custom_fields_sorting' ));
      if (is_array($custom_fields_setting)) foreach($custom_fields_setting as $cf_name):
        if ($cf_name=="") continue;
		$sorters_html.='
		<label class="btn btn-primary">
		  <input type="radio" name="options-sorting" data-sortby="meta_value_num"  data-sortby-field="'. $cf_name .'" autocomplete="off">'.   ucwords(str_replace('-',' ',$cf_name)).'
		</label>';
	  endforeach; 
		 
	
	return '
	<!-- sorting filters -->
	<div id="searchy-sorting" class="pull-right">
	  Sort by:
	  <div class="btn-group" data-toggle="buttons">  
		<label class="btn btn-primary active">
		  <input type="radio" name="options-sorting" data-sortby="post_date" autocomplete="off" checked> Date
		</label>
		<label class="btn btn-primary">
		  <input type="radio" name="options-sorting" data-sortby="post_title" autocomplete="off"> Name
		</label>
		'.$sorters_html.'
	  </div>
	</div>
	<!-- search results -->
	<div class="clearfix"></div>
	
	<div class="searchy-load-bubble"> <span id="searchy-load-bubble_1"> </span> <span id="searchy-load-bubble_2"> </span> <span id="searchy-load-bubble_3"> </span> </div>
	
	<div id="searchy-search-results"> </div>
	
	<div id="searchy-filter-overlayer"></div>
	'; //end

}//end function
endif; 
add_shortcode( 'searchy_results', 'searchy_results_func' );








////////////////// SEARCH RESULTS TEMPLATING ///////////////////////////////////////////////////////////////////////////////////////////

//DEMO EXTEND EXAMPLE: HOW TO BUILD YOUR OWN SEARCH RESULTS TEMPLATE - Put this sample function in your theme's functions.php file to get started
//  function searchy_display_post_element($post) { echo $post->post_title  } //end searchy_display_post_element function


if (!function_exists("searchy_display_post_element")):
function searchy_display_post_element($post)
{ ?>
 
 <article role="article" id="post_<?php echo $post->ID ?>"  >
   <header>
	   <h2><a target="_blank" href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title ?></a></h2>
	    <?php // if (is_array(wp_get_post_categories($post->ID))) foreach(wp_get_post_categories($post->ID) as $cat) { echo $cat->name . ', '; } ?>
	   <?php  if (is_array(get_the_tags($post->ID))) foreach(get_the_tags($post->ID) as $tag) { echo $tag->name . '  '; } ?>  
   </header>
   <div class="row">
	  <div class="col-sm-3 col-md-3">
	  <?php echo get_the_post_thumbnail(  $post->ID , 'thumbnail', array( 'class' => 'img-responsive searchy-res-thumb' ) ); ?>
	  </div> <!-- close col -->
	    <div class="col-sm-9 col-md-9">
			<?php  echo balanceTags(substr($post->post_content,0,450 ),TRUE) ?>
		 </div> <!-- close col -->
   </div><!-- close row -->
	
	
 </article>

<?php } //end searchy_display_post_element function
endif; 