<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }
        
        $output = '</div>';
        
        wp_nonce_field( 'rsgd_nonce_fields' , 'rsgd_nonce_fields' );
        
    $output .= '</form>';
$output .= '</div>';

echo $output;