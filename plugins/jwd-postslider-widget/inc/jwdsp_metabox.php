<?php
/********************************
 * JWD Show Posts Slider :: Image Metabox
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Add metaboxes 
 ********************************/
if ( ! function_exists( 'jwdsp_metaboxes' ) ) { 
	add_action('add_meta_boxes', 'jwdsp_metaboxes');
	function jwdsp_metaboxes() { 
  		global $post_type;
		$jwdsp_general_settings = get_option('jwdsp_general_settings');
		$acceptedPosts = $jwdsp_general_settings['post_types'];
		$thumbnail_support = current_theme_supports( 'post-thumbnails', $post_type ) && post_type_supports( $post_type, 'thumbnail' );
		if ( $thumbnail_support && current_user_can( 'upload_files' ) ){
			foreach($acceptedPosts as $accepted){
				add_meta_box( 'jwdsp_featured_image', __( 'Featured image for JWD PostSlider Widget', 'jwdsp' ), 'jwdsp_featured_image', $accepted, 'side', 'low' );
			}
		}   
	}  
}
/********************************
 * Metabox callback function
 ********************************/
if ( ! function_exists( 'jwdsp_featured_image' ) ) {
	function jwdsp_featured_image( $post ) {
		wp_nonce_field( plugin_basename( __FILE__ ) , 'jwdsp_image_nonce' );
		$jwdsp_thumbnail = get_post_meta( $post->ID, 'jwdsp_thumbnail', true );
		$output = '<h5 style="margin-bottom:.5em;">' . __('Add featured image to be used by the JWD PostSlider Widget','jwdsp') . '</h5>';
		$output .= '<span style="font-size:95%;display:block;position:relative;font-style: italic;">' . __('Square shape; Minimum size: 800x800 px','jwdsp') . '</span>';
		$output .= '<p id="jwdsp_slider_image" style="text-align:center;">';
		if($jwdsp_thumbnail != ''){ 
			$output .= '<img class="jwdsp_thumbnail_upload" src="'.esc_url( $jwdsp_thumbnail ).'" style="width:auto;max-width:100%;cursor:pointer;margin-bottom:1em" />'; 
			$output .= '<span class="button jwdsp_thumbnail_remove">'.__('Remove Image','jwdsp').'</span>'; 
		} else { 
			$output .= '<span class="button jwdsp_thumbnail_upload">'.__('Add Image','jwdsp').'</span>'; 
		}
		$output .= '<input id="jwdsp_thumbnail_'.$post->ID.'_input" name="jwdsp_thumbnail" type="hidden" value="' . esc_url( $jwdsp_thumbnail ) . '"/></p>';
		echo $output;
	}
}
/********************************
 * Save metadata
 ********************************/
if ( ! function_exists( 'jwdsp_save_metadata' ) ) { 
	add_action('save_post', 'jwdsp_save_metadata', 10, 2);
	function jwdsp_save_metadata($id) {
		$jwdsp_general_settings = get_option('jwdsp_general_settings');
		if( in_array( get_post_type( $id ), $jwdsp_general_settings['post_types'])){
			/* Security Check */
			if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $id; } 
			if( !isset( $_POST['jwdsp_image_nonce'] ) || !wp_verify_nonce( $_POST['jwdsp_image_nonce'], plugin_basename( __FILE__ ) ) )  { return $id; } 
			if ( !current_user_can('edit_post', $id) ) { return $id; } 
			/* END Security Check */
			/* Get the posted data and sanitize it for use as an HTML class. */
			$new_meta_value = ( isset( $_POST['jwdsp_thumbnail'] ) ? $_POST['jwdsp_thumbnail'] : '' );
			/* Get the meta key. */
			$meta_key = 'jwdsp_thumbnail';
			/* Get the meta value of the custom field key. */
			$meta_value = get_post_meta( $id, $meta_key, true );
			/* If a new meta value was added and there was no previous value, add it. */
			if ( $new_meta_value && '' == $meta_value ) { add_post_meta( $id, $meta_key, $new_meta_value, true ); }
			/* If the new meta value does not match the old value, update it. */
			elseif ( $new_meta_value && $new_meta_value != $meta_value ) { update_post_meta( $id, $meta_key, $new_meta_value ); }
			/* If there is no new meta value but an old value exists, delete it. */
			elseif ( '' == $new_meta_value && $meta_value ) { delete_post_meta( $id, $meta_key, $meta_value ); }
 		}
	}  
}