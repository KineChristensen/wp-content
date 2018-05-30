<?php
// if called directly, abort.
if (!defined('WPINC')) { die; }

function rsgd_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
        'title'   => '',
        'alias'   => '',
    ), $atts));
    
    $output = '';
    $output .= '['.RSGD_PFX.' alias="'.$alias.'"]';
    
    return $output; 
 
}
add_shortcode('rsgd', 'rsgd_shortcode');