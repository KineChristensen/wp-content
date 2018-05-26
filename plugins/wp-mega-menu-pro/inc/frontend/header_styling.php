<?php 
//WPMM_Libary::displayArr(  $get_custom_styling_details );
$menuid = $value['menuid'];
if($check){
	$orientation = $value['orientation'];
	if($orientation == "horizontal"){
      $oclass = "wpmm-orientation-horizontal";
	}else{
      $oclass = "wpmm-orientation-vertical";
	}
  $enable_menu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_bg_color']:'false';
  $menu_background_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_background_color']) && $get_custom_styling_details[0]['custom_styling']['menu_background_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_background_color']:'';


  $enable_menu_bg_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_bg_hover_color']:'false';

  $menu_bg_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_bg_hover_color']:'';
  
  $enable_menu_font_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_font_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_font_color']:0;
  $menu_font_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_font_color']) && $get_custom_styling_details[0]['custom_styling']['menu_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_font_color']:'';
  $enable_menu_font_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_font_hover_color']:0;
  $menu_font_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_font_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_font_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_font_hover_color']:'';
  $enable_submenu_megamenu_width = (isset($get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width']) && $get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_submenu_megamenu_width']:'false';

  $submenu_megamenu_width = (isset($get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width']) && $get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_megamenu_width']:'';
  $enable_submenu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_submenu_bg_color']:'false';

  $submenu_bg_color = (isset($get_custom_styling_details[0]['custom_styling']['submenu_bg_color']) && $get_custom_styling_details[0]['custom_styling']['submenu_bg_color'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_bg_color']:'';

  $enable_sub_cfont_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color']) && $get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_sub_cfont_color']:0;
  $submenu_cfont_color = (isset($get_custom_styling_details[0]['custom_styling']['submenu_cfont_color']) && $get_custom_styling_details[0]['custom_styling']['submenu_cfont_color'] != '')?$get_custom_styling_details[0]['custom_styling']['submenu_cfont_color']:'';
  $enable_sub_heading_font_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color']) && $get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_sub_heading_font_color']:'false';
  $sub_heading_font_color = (isset($get_custom_styling_details[0]['custom_styling']['sub_heading_font_color']) && $get_custom_styling_details[0]['custom_styling']['sub_heading_font_color'] != '')?$get_custom_styling_details[0]['custom_styling']['sub_heading_font_color']:'';
  $enable_menu_icon_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_icon_color']:'false';
  $menu_icon_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_icon_color']) && $get_custom_styling_details[0]['custom_styling']['menu_icon_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_icon_color']:'';
  $enable_menu_icon_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color']) && $get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['enable_menu_icon_hover_color']:'false';
  $menu_icon_hover_color = (isset($get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color']) && $get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color'] != '')?$get_custom_styling_details[0]['custom_styling']['menu_icon_hover_color']:'';

if($enable_menu_bg_color == 'true' && $menu_background_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>{
	background-color: <?php echo $menu_background_color;?> !important;
}
<?php } ?>
<?php /* on menu hover icon menu bg color change */
if($enable_menu_bg_hover_color  == 'true' && $menu_bg_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>:hover{
	background: <?php echo $menu_bg_hover_color;?> !important;
}
<?php } 
/* on menu hover icon color change */
if($enable_menu_icon_color  && $menu_icon_color != ''){ ?>
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-mega-menu-icon{
color: <?php echo $menu_icon_color;?> !important;
}
<?php } 
if($enable_menu_icon_hover_color  && $menu_icon_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?>:hover .wpmm-mega-menu-icon {
	color: <?php echo $menu_icon_hover_color;?> !important;
}
<?php } ?>

<?php if($enable_menu_font_color && $menu_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > a{
	color: <?php echo $menu_font_color;?> !important;
}
<?php } ?>
<?php if($enable_menu_font_hover_color && $menu_font_hover_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > a:hover{
	color: <?php echo $menu_font_hover_color;?> !important;
}
<?php } ?>
<?php if($enable_submenu_megamenu_width  && $submenu_megamenu_width != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > .wpmm-sub-menu-wrap,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> ul{
	width: <?php echo $submenu_megamenu_width;?> !important;
}
<?php } ?>
<?php if($enable_submenu_bg_color  && $submenu_bg_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> > .wpmm-sub-menu-wrap,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> ul{
    background-color: <?php echo $submenu_bg_color;?> !important;
}
<?php } ?>
<?php if($enable_sub_heading_font_color  && $sub_heading_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li h4.wpmm-mega-block-title::before,
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li.wp-mega-menu-header > a.wp-mega-menu-link::before{
	background: <?php echo $sub_heading_font_color;?> !important;
}
<?php } ?>
<?php if($enable_sub_heading_font_color  && $sub_heading_font_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li h4.wpmm-mega-block-title{
	color: <?php echo $sub_heading_font_color;?> !important;
}
<?php } ?>
<?php if($enable_sub_cfont_color  && $submenu_cfont_color != ''){ ?>
.wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu li .wpmm-sub-menu-wrapper.wpmm_menu_1 li::before,
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_pages li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_categories li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_archive li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_meta li::before, 
 .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_recent_comments li::before,
  .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_recent_entries li::before,
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_product_categories ul.product-categories li a::before, 
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_categories li::before, 
   .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wp-mega-sub-menu .widget_archive li::before{
color: <?php echo $submenu_cfont_color;?> !important;
}

.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li a:focus,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li a,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li div,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrap ul li span.wpmm-mega-menu-href-title,
.wpmm_megamenu .wp-megamenu-main-wrapper.<?php echo $oclass;?> ul.wpmm-mega-wrapper li#wp_nav_menu-item-<?php echo $menuid;?> .wpmm-sub-menu-wrapper ul li span.wpmm-mega-menu-href-title{
	color: <?php echo $submenu_cfont_color;?> !important;
}
<?php } ?>
<?php 
 }
?>