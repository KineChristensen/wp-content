<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

class raysgrid_Form {

    public function rsgd_display_form() {
        
        $do         = isset($_GET['do']) ? $_GET['do'] : '';
        $action     = isset($_GET['action']) ? $_GET['action'] : '';
        $id         = isset($_GET['id']) ? $_GET['id'] : '';
        $rsgd_tbls  = new raysgrid_Tables();
                
        require_once(RSGD_DIR . 'includes/admin/views/header.php');
            
        if ( empty($do) ) {
            
            require_once(RSGD_DIR . 'includes/admin/views/grids-list.php');
            
        } elseif ( $do == 'create' ) {
            
            require_once(RSGD_DIR . 'includes/admin/views/main-form.php');
            
        }
        
        require_once(RSGD_DIR . 'includes/admin/views/footer.php');
        
        if ( $action == 'save' && empty($id) ) {
            $rsgd_tbls->rsgd_insert_update($id);
        }

        if ( $do == 'clone' && !empty($id) ) {
            $rsgd_tbls->rsgd_duplicate_row(RSGD_TBL, $id);
        }
        
        if ( $do == 'delete' && !empty($id) ) {
            $rsgd_tbls->rsgd_delRow($id);
        }
              
    }

}

new raysgrid_Form();
