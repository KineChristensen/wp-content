<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }
$id          = isset( $_GET['id'] ) ? $_GET['id'] : '';
$do          = isset($_GET['do']) ? $_GET['do'] : '';
$rsgd_tbls   = new raysgrid_Tables();
$allTables   = $rsgd_tbls->rsgd_selectWithId($id);
$impexp      = ( isset($_GET["page"]) && trim($_GET["page"]) == 'raysgrid-exp' ) ? trim ($_GET["page"]) : '';
$strs = $cl = $sync = '';

if( $impexp ){
    $cl = 'rsgd_import_form';
    $strs = '-exp&do=import';
    $sync = ' enctype="multipart/form-data"';
} else if (empty($id) && !empty($do) ) {
    $strs = '&do=create&action=save';
    $cl = 'rsgd_form';
} else if ( !empty($id) && !empty($do) ){
    $strs = '&do=create&action=edit&id='.$id;
    $cl = 'rsgd_form';
} else{
    $cl = 'list_form';
}

$output = '<div class="'.RSGD_SLUG.'-form">';
        
    $output .= "<form action='".admin_url()."admin.php?page=".RSGD_PFX."{$strs}'{$sync} method='post' class='{$cl}' novalidate>";

        $output .= '<div class="rsgd_logo">';
            $output .= '<img alt="'.__('RAYS Grid', RSGD_SLUG).'" src="'.RSGD_URI .'assets/admin/images/logo.png" />';
            
            $output .= '<div class="top-btns">';
                if ( empty($id) && !empty($do) ) {
                    $output .= '<span class="rsgd_error_list"></span>';
                    $output .= '<button type="submit" name="rsgd_save_btn" id="rsgd_save_btn" class="btn-success rsgd_save_btn"><i class="dashicons dashicons-thumbs-up"></i> '.__('Save', RSGD_SLUG).'</button>';
                    $output .= '<a href="'.admin_url().'admin.php?page='.RSGD_PFX.'" id="rsgd_save_btn" class="rsgd_cancel_btn"><i class="dashicons dashicons-no-alt"></i> '.__('Cancel', RSGD_SLUG).'</a>';
                } else if ( !empty($id) && !empty($do) ){
                    $output .= '<span class="rsgd_error_list"></span>';
                    $output .= '<button type="submit" name="rsgd_edit_btn" id="rsgd_edit_btn" class="btn-success rsgd_edit_btn"><i class="dashicons dashicons-edit"></i>'.__('Save', RSGD_SLUG).'</button>';
                    $output .= '<a href="'.admin_url().'admin.php?page='.RSGD_PFX.'" id="rsgd_save_btn" class="rsgd_cancel_btn"><i class="dashicons dashicons-no-alt"></i> '.__('Cancel', RSGD_SLUG).'</a>';
                } else {
                    $output .= '<a href="'.admin_url().'admin.php?page='.RSGD_PFX.'&do=create" name="rsgd_add_new" id="rsgd_add_new" class="btn-success add_new"><i class="dashicons dashicons-plus-alt"></i>'.__('New', RSGD_SLUG).'</a>';
                    $output .= '<a class="top_exp" href="'.admin_url().'admin.php?page='.RSGD_PFX.'-exp"><i class="dashicons dashicons-download"></i>'.__('Import / Export', RSGD_SLUG).'</a>';
                    $output .= '<a class="top_help" href="http://www.it-rays.net/docs/raysgrid/" target="_blank"><i class="dashicons dashicons-info"></i>'.__('Help', RSGD_SLUG).'</a>';
                }
                
            $output .= '</div>';
            
        $output .= '</div>';
        
        $output .= '<div class="rsgd_form_title">';
            $output .= '<h2>';
                if( $impexp ){
                    $output .= '<i class="dashicons dashicons-admin-tools"></i>'.__('Import / Export Grids', RSGD_SLUG); 
                } else if ( empty($do) ) {
                    $output .= '<i class="dashicons dashicons-dashboard"></i>'.__('Grids', RSGD_SLUG).' <small>'.__('List of available grids', RSGD_SLUG).'</small>';
                } else {
                     if (empty($id)) {
                        $output .= '<i class="dashicons dashicons-menu"></i>' . __('Create New Grid', RSGD_SLUG) . '<small>' . __('Choose from the following options', RSGD_SLUG) . '</small>';
                    } else {
                        $output .= '<i class="dashicons dashicons-edit"></i>' . __('Edit Grid', RSGD_SLUG) . '<small>'.$allTables[0]->title.'</small>';
                    }
                }
            $output .= '</h2>';
        $output .= '</div>';
        
        $output .= '<div class="x_panel">';
    
echo $output;