<?php
class Rfp_Class
{
	function __construct()
	{
		//ADD STYLE AND SCRIPT IN HEAD SECTION
		add_action('admin_init', array(&$this,'rfp_backend_script'));
		add_action('wp_enqueue_scripts', array(&$this,'rfp_frontend_script'));
		add_action('wp_ajax_rfp_call_taxonomies', array( $this, 'rfp_fetch_taxonomies' ) );
		add_action('wp_ajax_rfp_call_taxonomy_terms', array( $this, 'rfp_fetch_taxonomy_terms' ) );
		add_filter('post_row_actions', array( $this, 'rfp_remove_row_actions' ),10, 2  );
	}
	
	// BACKEND SCRIPT
	function rfp_backend_script(){
		if(is_admin()){
			wp_enqueue_script('rfp-admin-script', plugins_url('assets/js/rfp-admin.js', __FILE__ ), array( 'jquery' ), false, true);	
			wp_enqueue_style('rfp-admin-style',plugins_url('assets/css/rfp-admin.css',__FILE__));	
		}
	}

	// FRONTEND SCRIPT
	function rfp_frontend_script(){
		if(!is_admin()){
			wp_enqueue_script('rfp-isotope-script', plugins_url('assets/js/jquery.isotope.min.js', __FILE__ ), array( 'jquery' ), false, true);
			wp_enqueue_style('rfp-admin-style',plugins_url('assets/css/rfp-front.css',__FILE__));
		}
	}
	
	// FETCH ALL REGISTERED TAXONOMIES 
	function rfp_fetch_taxonomies()
	{
		check_ajax_referer( 'rfp-security-data', 'security' );

		$get_ddHtml   = "<option value=''>Select</option>";
		$posttype     = $_POST['posttype'];
		$taxonomy_obj = get_object_taxonomies( $posttype );
		$taxonomy_Arr = (array) $taxonomy_obj;
		
		foreach ( $taxonomy_Arr as $term ) { 
			if(is_taxonomy_hierarchical( $term ) ){
				$get_ddHtml .= '<option value="' . $term . '" >' . ucwords($term) . '</option>'; 
			}
		} 

		echo $get_ddHtml;
		wp_die();
    }
	
	// FETCH REGISTERED TAXONOMY TERMS
	function rfp_fetch_taxonomy_terms()
	{
		check_ajax_referer( 'rfp-security-data', 'security' );

		$taxonomy   = $_POST['taxonomy'];
        $taxterms   = get_terms( $taxonomy, 'orderby=count&offset=1&hide_empty=0&fields=all');
		
		foreach ( $taxterms as $term ) { 
			$get_ddHtml .= '<label><input type="checkbox" name="_rfp_taxterms[]" value="' . $term->term_id . '" />' . ucwords($term->name) . '</label>'; 
		} 

		echo $get_ddHtml;
		wp_die();
    }
	
	// REMOVE QUICK EDIT OPTION
	function rfp_remove_row_actions( $actions, $post ){
		global $current_screen;
		if( $current_screen->post_type != 'rfp-scode' ) return $actions;
		unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
		return $actions;
	}
}