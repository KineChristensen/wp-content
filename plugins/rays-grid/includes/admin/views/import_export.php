<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

require_once(RSGD_DIR . 'includes/admin/views/header.php');        

$output = '<ul class="rsgd_tabs">';
    $output .= '<li class="active"><a href="#export_gr" data-toggle="tab"><i class="dashicons dashicons-upload"></i>'.__('Export Grids', RSGD_SLUG).'</a></li>';
    $output .= '<li><a href="#import_gr" data-toggle="tab"><i class="dashicons dashicons-download"></i>'.__('Import Grids', RSGD_SLUG).'</a></li>';
$output .= '</ul>';

$output .= '<div class="rsgd_tab_content">';

    $output .= '<div class="tab-pane active" id="export_gr">';
        $output .= '<div class="x_content">';
            $output .= '<div class="item form-group">';
                $output .= '<div class="lbl"><label class="opt-lbl">Export Grids</label><small class="description">'.__('Click the button below to export all available grids.', RSGD_SLUG).'</small></div>';
                $output .= '<div class="control-input">';
                    $output .= '<button type="submit" name="export" class="btn btn-success rsgd_lg_btn">'.__('Export Grids', RSGD_SLUG).'</button>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    $output .= '<div class="tab-pane" id="import_gr">';
        $output .= '<div class="x_content">';
                $output .= '<div class="item form-group">';
                    $output .= '<div class="lbl"><label class="opt-lbl">'.__('Upload .json file:', RSGD_SLUG).'</label>
                        <small class="description">'.__('Click the file upload below to import a .json file from your PC.', RSGD_SLUG).'</small></div>';
                    $output .= '<div class="control-input">';
                        $output .= '<input type="file" class="form-control" name="importfile" id="impFile" />';
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="item form-group">';
                    $output .= '<div class="lbl"><label class="opt-lbl">'.__('Upload', RSGD_SLUG).'</label><small class="description">'.__('Click the button below to import from the file you uploaded.', RSGD_SLUG).'</small></div>';
                    $output .= '<div class="control-input">';
                        $output .= '<button type="submit" name="import" class="btn btn-success imp_btn rsgd_lg_btn">'.__('Import Grids', RSGD_SLUG).'</button>';
                    $output .= '</div>';
                $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

$output .= '</div>';

$output .= '<span class="hidden adm">'.esc_attr(admin_url()).'</span>';

echo $output;

require_once(RSGD_DIR . 'includes/admin/views/footer.php');

