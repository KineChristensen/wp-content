<?php
/*
  RFP : CUSTOM POST TYPE
*/
class RFP_Shortcode_CusotmPostType {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();

		// RFP Shortcode
		$args['post-type-shortcode'] = array(
			'labels' => array(
				'name' => __( 'RFP Shortcode', 'rfp' ),
				'singular_name' => __( 'RFP Shortcode', 'rfp' ),
				'all_items' => 'RFP Shortcode',
				'add_new' => __( 'Add New', 'rfp' ),
				'add_new_item' => __( 'Add New RFP Shortcode', 'rfp' ),
				'edit_item' => __( 'Edit RFP Shortcode', 'rfp' ),
				'new_item' => __( 'New RFP Shortcode', 'rfp' ),
				'view_item' => __( 'View RFP Shortcode', 'rfp' ),
				'search_items' => __( 'Search Through RFP Shortcode Items', 'rfp' ),
				'not_found' => __( 'No shortcodes found', 'rfp' ),
				'not_found_in_trash' => __( 'No shortcodes found in Trash', 'rfp' ),
				'parent_item_colon' => __( 'Parent RFP Shortcode :', 'rfp' ),
				'menu_name' => __( 'RFP Shortcode', 'rfp' ),
			),	
				'public' => false,  
				'publicly_queriable' => true,  
				'show_ui' => true, 
				'exclude_from_search' => true,  
				'show_in_nav_menus' => false, 
				'has_archive' => false, 
				'rewrite' => false, 
				'hierarchical' => false,
				'can_export' => false,
				'menu_position' => 20,
				'description' => __( 'Add a Shortcode item', 'rfp' ),
				'supports' => array( 'title'),
				'menu_icon' =>  'dashicons-filter',
			);

		register_post_type('rfp-scode', $args['post-type-shortcode']);
	}
}

function rfp_init_shortcodecpt() { new RFP_Shortcode_CusotmPostType(); }
add_action( 'init', 'rfp_init_shortcodecpt' );

#-----------------------------------------------------------------#
# SORTABLE (ID) COLUMN
#-----------------------------------------------------------------#

add_filter('manage_edit-rfp-scode_columns', 'rfp_register_rfpscode_columns');
function rfp_register_rfpscode_columns($columns){

	$new_columns = array(
		'cb'     => '<input type="checkbox" />',
		'title'  => 'Name',
		'_rfp_shcode' => 'Shortcode'
	);
	return array_merge($new_columns,$columns);
}

add_action('manage_posts_custom_column', 'rfp_handle_rfpscode_columns', 10, 2 );

function rfp_handle_rfpscode_columns( $column ){

	global $post;
	if( $post->post_type != 'rfp-scode' ) return;	
	elseif( $column == '_rfp_shcode' ){
		$_rfp_shcode = get_post_meta( $post->ID, '_rfp_shcode', true );
		echo "<input type='text' class='rfp-textsc' onClick='this.select();' value='$_rfp_shcode' readonly='readonly'>";
	}
}

#-----------------------------------------------------------------#
# FETCH ALL REGISTRED IMAGE SIZES
#-----------------------------------------------------------------#

function rfp_image_sizes( $name, $value )
{
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {

			$width 		= get_option( "{$_size}_size_w" );
			$height 	= get_option( "{$_size}_size_h" );
			$crop 		= (bool) get_option( "{$_size}_crop" ) ? 'hard' : 'soft';

			$sizes[$_size]   = "{$_size} - {$width}x{$height}";

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$width 		= $_wp_additional_image_sizes[ $_size ]['width'];
			$height 	= $_wp_additional_image_sizes[ $_size ]['height'];
			$crop 		= $_wp_additional_image_sizes[ $_size ]['crop'] ? 'hard' : 'soft';

			$sizes[$_size]   = "{$_size} - {$width}x{$height}";
		}
	}

	$sizes = array_merge($sizes, array('full' => 'original uploaded image'));

	$table = sprintf('<select name="%1$s" class="regular-text select2">', $name );
	foreach( $sizes as $key => $option ){
		$selected = ( $value == $key ) ? ' selected="selected"' : '';
		$table .= sprintf('<option value="%1$s" %3$s>%2$s</option>',$key, $option, $selected);
	}
	$table .= '</select>';

	return $table;
}

#-----------------------------------------------------------------#
# RFP METABOXES & META FIELDS
#-----------------------------------------------------------------#

add_action( 'add_meta_boxes', 'rfp_add_scodeopts_metabox' );
add_action( 'add_meta_boxes', 'rfp_add_settings_metabox' );
add_action( 'add_meta_boxes', 'rfp_add_right_side_custom_metabox' );
add_action( 'save_post', 'rfp_save_meta_fields' );

function rfp_add_scodeopts_metabox() {
    add_meta_box('rfp_metabox', __( 'Post Settings', 'rfp' ),'rfp_scopts_meta_fields','rfp-scode','normal','default');
}

function rfp_add_settings_metabox() {
    add_meta_box('rfp_set_metabox', __( 'Appearance Settings', 'rfp' ),'rfp_settings_meta_fields','rfp-scode','normal','default');
}

function rfp_add_right_side_custom_metabox() {
    add_meta_box('rfp_rs_metabox', __( 'Shortcode', 'rfp' ),'rfp_scode_meta_field','rfp-scode','side','default');
}

// Create Meta Fields Function
function rfp_scopts_meta_fields( $post ) 
{
	wp_nonce_field( plugin_basename( __FILE__ ), 'rfp_noncename' );
	$_rfp_selpost  = get_post_meta( $post->ID, '_rfp_selpost', true );
	$_rfp_seltax   = get_post_meta( $post->ID, '_rfp_seltax', true );
	$_rfp_taxterms = get_post_meta( $post->ID, '_rfp_taxterms', true );
	
	// Sanitiz the meta fields
	$_rfp_selpost  = !empty($_rfp_selpost) ? $_rfp_selpost : '';
	$_rfp_seltax   = !empty($_rfp_seltax) ? $_rfp_seltax : '';
	$_rfp_taxterms = !empty($_rfp_taxterms) ? unserialize($_rfp_taxterms) : array();
	
	$args = array('public' => true);
	$output   = 'names'; 
	$operator = 'and'; 
	$inner_Html ='';
	
	$taxonomies = get_taxonomies( $args, $output, $operator ); 
	if ( $taxonomies ) {
		foreach ( $taxonomies  as $taxonomy ) {
			if(is_taxonomy_hierarchical( $taxonomy ) ){
				$taxObject = get_taxonomy($taxonomy);
				$postTypesArray[] = $taxObject->object_type[0];
			}
		}
	}
	$uniquePtypes = array_unique($postTypesArray);
	
	$post_ddown  = '<select name="_rfp_selpost" id="rfp_selpost"><option value="">Select</option>';
	foreach($uniquePtypes as $ptype){
		$post_ddown .= '<option '.selected($_rfp_selpost, $ptype, 0).' value='.$ptype.'>'.ucwords($ptype).'</option>';
	}
	$post_ddown .= '<select>';
	
	if(!empty($_rfp_selpost))
	{
		$taxonomy_obj = get_object_taxonomies( $_rfp_selpost );
		$taxonomy_Arr = (array) $taxonomy_obj;
		$taxo_ddown   = '<select name="_rfp_seltax" id="rfp_seltax"><option value="">Select</option>';
		
		foreach ( $taxonomy_Arr as $term ) { 
			if(is_taxonomy_hierarchical( $term ) ){
				$taxo_ddown .= '<option '.selected($_rfp_seltax, $term, 0).' value="' . $term . '" >' . ucwords($term) . '</option>'; 
			}
		} 
		
		$taxo_ddown .= '<select>';
		
	}else{
		$taxo_ddown  = '<select name="_rfp_seltax" id="rfp_seltax"><option value="">Select</option></select>';
	}
	
	if(!empty($_rfp_seltax))
	{
		$taxonomy  = $_rfp_seltax;
        $taxterms  = get_terms( $taxonomy, 'orderby=count&offset=1&hide_empty=0&fields=all');
		
		foreach ( $taxterms as $term ) { 
		
			if( in_array( $term->term_id, $_rfp_taxterms) ){ 
				$checked = 'checked="checked"';
			}else{
				$checked = '';
			}
		
			$inner_Html .= '<label><input type="checkbox" '.$checked. ' name="_rfp_taxterms[]" value="' . $term->term_id . '" />' . ucwords($term->name) . '</label>'; 
		} 
		
		$terms_html  = '<div id="rfp_selterms">'.$inner_Html.'</div>';
		
	}else{
		$terms_html  = '<div id="rfp_selterms"></div>';
	}
	
	// Add Ajax Loader
	echo '<div class="rfp_loader"></div>';

	// Select Post Type Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Select Post Type',$post_ddown);
	
	// Select Category/Taxonomy Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Select Category / Taxonomy',$taxo_ddown);
	
	// Choose Category/Taxonomy Items
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Select Category / Taxonomy Terms',$terms_html);

	// Create Security Nonce Data
	echo '<input type="hidden" id="rfpstring" value="'.wp_create_nonce( 'rfp-security-data' ).'" />';
}

// Create Meta Fields Function
function rfp_settings_meta_fields( $post ) 
{
	wp_nonce_field( plugin_basename( __FILE__ ), 'rfp_noncename' );
	$_rfp_st_dcol = get_post_meta( $post->ID, '_rfp_st_dcol', true );
	$_rfp_st_tcol = get_post_meta( $post->ID, '_rfp_st_tcol', true );
	$_rfp_st_pcol = get_post_meta( $post->ID, '_rfp_st_pcol', true );
	$_rfp_st_size = get_post_meta( $post->ID, '_rfp_st_size', true );
	
	// Sanitiz the meta fields
	$_rfp_st_dcol = !empty($_rfp_st_dcol) ? $_rfp_st_dcol : '';
	$_rfp_st_tcol = !empty($_rfp_st_tcol) ? $_rfp_st_tcol : '';
	$_rfp_st_pcol = !empty($_rfp_st_pcol) ? $_rfp_st_pcol : '';
	$_rfp_st_size = !empty($_rfp_st_size) ? $_rfp_st_size : '';
	
	$column_desk_dd = '<select name="_rfp_st_dcol">
		<option '.selected($_rfp_st_dcol, 'md12', 0).' value="md12">1 Column</option>
		<option '.selected($_rfp_st_dcol, 'md6', 0).' value="md6">2 Columns</option>
		<option '.selected($_rfp_st_dcol, 'md4', 0).' value="md4">3 Columns</option>
		<option '.selected($_rfp_st_dcol, 'md3', 0).' value="md3">4 Columns</option>
	</select>&nbsp;<span class="description">The number of items you want to see on the Desktop Layout.</span>';
	
	$column_tablet_dd = '<select name="_rfp_st_tcol">
		<option '.selected($_rfp_st_tcol, 'sm12', 0).' value="sm12">1 Column</option>
		<option '.selected($_rfp_st_tcol, 'sm6', 0).' value="sm6">2 Columns</option>
		<option '.selected($_rfp_st_tcol, 'sm4', 0).' value="sm4">3 Columns</option>
		<option '.selected($_rfp_st_tcol, 'sm3', 0).' value="sm3">4 Columns</option>
	</select>&nbsp;<span class="description">The number of items you want to see on the Tablet Layout.</span>';
	
	$column_phone_dd = '<select name="_rfp_st_pcol">
		<option '.selected($_rfp_st_pcol, 'xs12', 0).' value="xs12">1 Column</option>
		<option '.selected($_rfp_st_pcol, 'xs6', 0).' value="xs6">2 Columns</option>
		<option '.selected($_rfp_st_pcol, 'xs4', 0).' value="xs4">3 Columns</option>
		<option '.selected($_rfp_st_pcol, 'xs3', 0).' value="xs3">4 Columns</option>
	</select>&nbsp;<span class="description">The number of items you want to see on the Mobile Layout.</span>';
	
	$imageSizes_dd = rfp_image_sizes('_rfp_st_size',$_rfp_st_size);
	

	// Select Columns : Desktop Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Columns : Desktop',$column_desk_dd);
	
	// Select Columns : Tablet Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Columns : Tablet',$column_tablet_dd);
	
	// Select Columns : Phone Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Columns : Phone',$column_phone_dd);
	
	// Select Image Size Dropdown
	echo sprintf('<div class="rfp-item"><label class="rfp-label">%s</label><div class="rfp-field">%s</div></div>','Image Size',$imageSizes_dd);
}

// Create Meta Fields Function
function rfp_scode_meta_field( $post ) 
{
	wp_nonce_field( plugin_basename( __FILE__ ), 'rfp_noncename' );
	
	$_rfp_selpost  = get_post_meta( $post->ID, '_rfp_selpost', true );
	$_rfp_seltax   = get_post_meta( $post->ID, '_rfp_seltax', true );
	$_rfp_taxterms = get_post_meta( $post->ID, '_rfp_taxterms', true );
	$_rfp_shcode   = get_post_meta( $post->ID, '_rfp_shcode', true );
	
	// Sanitiz the meta fields
	$_rfp_selpost  = !empty($_rfp_selpost) ? $_rfp_selpost : '';
	$_rfp_seltax   = !empty($_rfp_seltax) ? $_rfp_seltax : '';
	$_rfp_taxterms = !empty($_rfp_taxterms) ? unserialize($_rfp_taxterms) : array();
	$_rfp_shcode   = !empty($_rfp_shcode) ? $_rfp_shcode : '';
	
	echo "<label>Copy shortcode after saving RFP Item.</label>";
	echo "<input type='text' name='_rfp_shcode' class='rfp-textsc' onClick='this.select();' value='$_rfp_shcode' readonly='readonly'>";
}


// Save Meta Fields Function
function rfp_save_meta_fields( $post_id ) 
{
	if ( !empty($_POST['post_type']) && 'rfp-scode' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
		return;
	}

	if ( ! isset( $_POST['rfp_noncename'] ) || ! wp_verify_nonce( $_POST['rfp_noncename'], plugin_basename( __FILE__ ) ) )
	return;

	$post_ID = $_POST['post_ID'];
	$_rfp_selpost  = !empty($_POST['_rfp_selpost']) ? $_POST['_rfp_selpost'] : '';
	$_rfp_seltax   = !empty($_POST['_rfp_seltax']) ? $_POST['_rfp_seltax'] : '';
	$_rfp_taxterms = !empty($_POST['_rfp_taxterms']) ? $_POST['_rfp_taxterms'] : '';
	$_rfp_st_dcol  = !empty($_POST['_rfp_st_dcol']) ? $_POST['_rfp_st_dcol'] : '';
	$_rfp_st_tcol  = !empty($_POST['_rfp_st_tcol']) ? $_POST['_rfp_st_tcol'] : '';
	$_rfp_st_pcol  = !empty($_POST['_rfp_st_pcol']) ? $_POST['_rfp_st_pcol'] : '';
	$_rfp_st_size  = !empty($_POST['_rfp_st_size']) ? $_POST['_rfp_st_size'] : '';
	
	update_post_meta($post_ID, '_rfp_selpost', $_rfp_selpost);
	update_post_meta($post_ID, '_rfp_seltax', $_rfp_seltax);
	update_post_meta($post_ID, '_rfp_st_dcol', $_rfp_st_dcol);
	update_post_meta($post_ID, '_rfp_st_tcol', $_rfp_st_tcol);
	update_post_meta($post_ID, '_rfp_st_pcol', $_rfp_st_pcol);
	update_post_meta($post_ID, '_rfp_st_size', $_rfp_st_size);
	
	if(isset($_POST['_rfp_taxterms'])){
		$data = serialize($_POST['_rfp_taxterms']);
		update_post_meta($post_ID, '_rfp_taxterms', $data);
	}else{
		update_post_meta($post_ID, '_rfp_taxterms', '');
	}
	
	if(!empty($_rfp_taxterms)){
		$_rfp_taxterms = implode(",",$_rfp_taxterms);
	}else{
		$_rfp_taxterms = '';
	}
	
	$_generate_scode = '[rfp id="'.$post_ID.'"]';
	update_post_meta($post_ID, '_rfp_shcode', $_generate_scode);
}
?>