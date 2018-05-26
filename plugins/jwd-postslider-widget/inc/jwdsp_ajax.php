<?php 
/********************************
 * JWD Show Posts Slider :: AJAX Calls
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * AJAX Callback for retriving terms/categories of selected post type
 ********************************/
if ( ! function_exists( 'jwdsp_getCategories_cbk' ) ) { 
	add_action( 'wp_ajax_jwdsp_getCategories', 'jwdsp_getCategories_cbk' ); 
	function jwdsp_getCategories_cbk() {
		/* Security Check */
		check_ajax_referer( 'jwdsp-ajaxObject-nonce', 'jwdsp_nonce' );
		/* Ok, Now we can go on. */
		ob_start();
		/* Vars */
		if( isset( $_POST['offset'] ) && $_POST['offset'] != '' ){ $offset = $_POST['offset']; } else { $offset = ''; }
		if( isset( $_POST['post_type'] ) && $_POST['post_type'] != '' ){ $post_type = $_POST['post_type']; } else { $post_type = ''; }
		$taxonomy_objects 	= get_object_taxonomies( $post_type, 'objects' );
		$taxonomy_names 	= array_keys($taxonomy_objects);
		$output_taxs 		= $output_terms = '';
		/* Provide the correct Taxonomy name for Get Terms */
		if( in_array( jwdsp_getWgSettings( $offset, 'jwdsp_taxonomy'), $taxonomy_names) ){ 
			$tax_name = jwdsp_getWgSettings( $offset, 'jwdsp_taxonomy'); 
		} else { $tax_name = $taxonomy_names[0]; }
		/* Do the magic now! */
		if( !empty($post_type) ){
			$output_taxs .= jwdsp_getTaxsList( $taxonomy_objects, jwdsp_getWgSettings( $offset, 'jwdsp_taxonomy') );
			$output_terms .= jwdsp_getTermsList( $tax_name, jwdsp_getWgSettings( $offset, 'jwdsp_tax_term') );
		} else {
			$output_taxs .= '<option value="">'.__('ERROR: Invalid Post Type!','jwdsp').'</option>';
			$output_terms .= '<option value="">'.__('ERROR: Invalid Post Type!','jwdsp').'</option>';
		}
		/* Return results */
		$return = array( 'taxonomies' => $output_taxs, 'terms' => $output_terms );
		echo ob_get_clean();
		wp_send_json($return);
	}
}
/********************************
 * AJAX Callback for retriving terms of selected taxonomy
 ********************************/
if ( ! function_exists( 'jwdsp_getTaxonomies_cbk' ) ) { 
	add_action( 'wp_ajax_jwdsp_getTaxonomies', 'jwdsp_getTaxonomies_cbk' ); 
	function jwdsp_getTaxonomies_cbk() {
		/* Security Check */
		check_ajax_referer( 'jwdsp-ajaxObject-nonce', 'jwdsp_nonce' );
		/* Ok, Now we can go on. */
		ob_start();
		$taxonomy = $offset = '';
		if( isset( $_POST['tx_selected'] ) && $_POST['tx_selected'] != '' ){ $taxonomy = $_POST['tx_selected']; } 
		if( isset( $_POST['offset'] ) && $_POST['offset'] != '' ){ $offset = $_POST['offset']; }  
		$return = array( 'taxonomies' => jwdsp_getTermsList( $taxonomy, jwdsp_getWgSettings( $offset, 'jwdsp_tax_term') ) );
		echo ob_get_clean();
		wp_send_json($return);
	}
}