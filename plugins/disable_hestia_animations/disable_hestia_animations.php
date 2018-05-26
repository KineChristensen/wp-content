<?php
/*
Plugin Name: Disable Hestia Animations
Plugin URI: https://themeisle.com
Description: Turns off animations in the Hestia theme
Version: 1.0.0
Author: ThemeIsle
Author URI: https://themeisle.com
License: GPL v2
*/

function hestia_maybe_enable_animations(){
	return false;
}

add_filter( 'hestia_enable_animations', 'hestia_maybe_enable_animations' );
