<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

$dbObj = new raysgrid_Tables();
$allTables = $dbObj->rsgd_select();
$output = '';    
foreach ($allTables[1] as $i) {
    if (empty($i)) {
        $output .= '<div class="tbl no_grids"><i class="dashicons dashicons-no"></i>'.__('No Grids Were Found.', RSGD_SLUG).'</div>';
    } else {
        $output .= '<div class="x_content">';
            $output .= '<table class="rsgd_data_table">';
                $output .= '<thead>';
                    $output .= '<tr>';
                        $output .= '<th class="t-center" style="width: 10px">'.__('ID', RSGD_SLUG).'</th>';
                        $output .= '<th>'.__('Name', RSGD_SLUG).'</th>';
                        $output .= '<th>'.__('Shortcode', RSGD_SLUG).'</th>';
                        $output .= '<th class="t-center lst-th">'.__('Settings', RSGD_SLUG).'</th>';
                    $output .= '</tr>';
                $output .= '</thead>';
                
                $output .= '<tbody>';
                foreach ($allTables[0] as $sel) { 
                    $getDb = $dbObj->rsgd_selectWithId($sel->id);
                    $output .= '<tr>';
                        $output .= '<td class="t-center">'.$sel->id.'</td>';
                        $output .= '<td style="font-weight:bold">'.$sel->title.'</td>';
                        $output .= '<td>'.$sel->shortcode.'</td>';
                        $output .= '<td class="t-center nowrap inline-cell">';
                        
                        if (isset($sel->id)) {
                            
                            $output .= '<a class="edit_btn" href="'.admin_url().'admin.php?page='.RSGD_PFX.'&do=create&id='.$sel->id.'" id="rg-edit-'.$sel->id.'" title="'.__('Edit', RSGD_SLUG).'">
                            <i class="dashicons dashicons-admin-generic"></i></a>';
                            $output .= '<a class="clone_btn" href="#" id="rg-clone-'.$sel->id.'" title="'.__('Duplicate', RSGD_SLUG).'"><i class="dashicons dashicons-admin-page"></i></a>';
                            $output .= '<a class="delete_btn" href="#" id="rg-delete-'.$sel->id.'" title="'.__('Remove', RSGD_SLUG).'"><i class="dashicons dashicons-trash"></i><span class="cs-lod dashicons dashicons-image-rotate"></span></a>';
                            
                        }
                        
                        $output .= '</td>';
                    $output .= '</tr>';
                }
                $output .= '</tbody>';
            $output .= '</table>';
    }
}

echo $output;
