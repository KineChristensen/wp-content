<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="apmm-settings-main-wrapper how_to_use_page">
  <div class="apmm-header">
  <?php include_once(APMM_PRO_PATH.'/inc/backend/panel_head.php');?>
  </div>
<div class="container wpmm-hot-to-use-container">
<div class="col-sm-9">
   <h3><?php _e('How to Use',APMM_PRO_TD);?></h3>
      <p>       
       <?php 
       _e(' In order to display the mega menu in the frontend for specific menu location, you need to build the menu location first.
        To build menu location and enable WP Mega Menu Pro Settings for specific location, you have to setup options provided 
        on WordPress menu page.',APMM_PRO_TD);?>
      </p>
      
          <p>
      <?php 
       _e('There are seven main settings panels as general settings, image settings, mobile settings ,import and export settings 
       , sticky menu settings, Enable Custom CSS Settings ,Icon Settings that will help you to setup the plugin default setup and for
        the menu display in the frontend, you can set the settings for specific menu from menu location page while creating or editing
         menu which is briefly described below. There is a new features while creating mage menu on this pro plugin. After setting the mega menu as menutype for specific top level menu you can even create mega menu as singleor multiple group wise mega menu
         selecting different column number to specific group number which is described more briefly below on WP Mega Menu Pro Settings tabs options.',APMM_PRO_TD);?>
      </p>
    

      <p><?php _e('For full documentation on the plugin, please visit ',APMM_PRO_TD);?>
      <a href="https://accesspressthemes.com/documentation/responsive-mega-menu-for-wordpress-wp-mega-menu-pro/" target="_blank"><?php _e('View Documentation',APMM_PRO_TD);?></a></p>
      <p><?php _e('For demo on the plugin, please visit ',APMM_PRO_TD);?>
      <a href="http://demo.accesspressthemes.com/wordpress-plugins/wp-mega-menu-pro" target="_blank"><?php _e('View Demo',APMM_PRO_TD);?></a></p>
      <h3>Demo Video Tutorials</h3>
      <a href="https://www.youtube.com/playlist?list=PLdSqn2S_qFxGVq_c93dBuBXbxKmk3jTOO" target="_blank"><?php _e('Check Video Tutorials On Youtube',APMM_PRO_TD);?></a></p>
      <a href="https://demo.accesspressthemes.com/wordpress-plugins/wp-mega-menu-pro/horizontal-mega-menu-video-tutorials/" target="_blank"><?php _e('Demo Video Tutorials',APMM_PRO_TD);?></a></p>

      <h4 class="wpmm_use_menusettings"><?php _e('Menu Settings');?></h4>
       <p>       
       <?php 
       _e('To enable WP Mega Menu Pro for specific menu location, on menu page, you can choose menu location and on left section you can find options settings as Select WP Mega Menu Pro Settings Metabox Options where you
       can enable WP Mega Menu Pro, choose orientation as vertical or horizontal, choose trigger effect (show mega menu on hover or on click effect), transition effect(slide or fade type). Also WP Mega Menu has provided <strong>14 Free Pre Available Skins </strong> or you can even setup your own custom theme design templates and choose it from this section 
       for specific menu location.Wp Mega Menu Pro plugin also includes 10 advanced custom widgets with different styles and layouts.',APMM_PRO_TD);?>
       </p>
       <p><?php _e('To setup mega menu or flyout type for particular menu. On hover menu you can find WP Mega Menu Pro Button where you can setup options menu wise. In these options, you can set mega menu type sub menu for top level menu only.',APMM_PRO_TD);?></p>
     
      <dl>
       <dt><strong><?php _e('Top Level Menu Settings',APMM_PRO_TD);?></strong></dt>  
        <p><?php _e('This level menu includes 8 main settings.',APMM_PRO_TD);?></p>
       <p><?php _e('The tab options are briefly described below:',APMM_PRO_TD);?></p>
        <ul class="prosettingslists">
          <li><strong><?php _e('* WP Mega Menu Pro Settings',APMM_PRO_TD);?></strong>
               <ul><li>
               <p><?php _e('In these Settings, you can set the top level menu as mega menu type or 
                  flyout type for its sub menu display.',APMM_PRO_TD);?></p>
                  <p><?php _e('After choosing mega menu as menu type, there are two select options provided where you can select mega menu as single or multiple group type.',APMM_PRO_TD);?></p>
               
               <ul class="groupwisesettings">    
                 <li><strong><?php _e('Single Group',APMM_PRO_TD);?></strong></strong>
                  <ul><li>
                   <p><?php _e('> After choosing mega menu as menu type for specific menu , here it provides an advanced feature to choose mega menu type as single or multiple type.
                   On choosing single group, you can set single column number and choose any wordpress widgets and set its column which works same as free plugin type mega menu.',APMM_PRO_TD);?></p>
                   </li>
                  </ul>
                 </li>
                  <li><strong><?php _e('Multiple Group',APMM_PRO_TD);?></strong></strong>
                  <ul><li>
                   <p><?php _e('> On choosing multiple group mega menu, you can 
                   even create multiple group tabs and choose each group with different total column number, and even can edit its column number later. 
                   Then you can choose widgets, set widgets on each particular group separatly as per your wish. You can add/edit/delete group for specific menu and choose widgets to set on specific group .You can even sort out the widgets as per you like in an specific order.',APMM_PRO_TD);?></p>
                   </li>
                  </ul>
                 </li>
               </ul>
                <p class="imp_note"><?php _e('Note: In Multiple group settings,it have some limitation that
                   the sub menus will always be listed on first group. You cannot keep the submenu on another
                    group but you can sort its order in first group.',APMM_PRO_TD);?></p>  
               </li>
              </ul>
            </li>
            <li><strong><?php _e('* General Settings',APMM_PRO_TD);?></strong></strong>
               <ul><li>
               <p><?php _e('General Settings where there is multiple options such as active link, hdie arrow ,show menu icons, menu label 
               input field, disable menu text, hide menu on desktop, hide menu on mobile, active single menu useful
                for displaying custom menu, set menu alignment as left or right an sub menu alignment for flyout settings.
                We have feature to set menu label and choose different menu animation with iteration count to different menu label as per menu wise.',APMM_PRO_TD);?></p>
             <p><?php _e('In this settings, you can even choose menu visibility as per loggedin/out status or show specific menu always. So, on choosing this settings, you can set login link to one menu if user is not logged in and set another menu such as My account as menu which can be shown to already logged in users by choosing loggedin users from this settings to specific menu.',APMM_PRO_TD);?></p>
               </li>
              </ul>
             </li>
          <li><strong><?php _e('* Mega Menu Settings',APMM_PRO_TD);?></strong>
           <ul><li>
               <p><?php _e('In these Settings, you can even setup Mega Menu settings for horizontal position and vertical position. In Mega Menu Settings, you can even add extra top and bottom content with only text, only image or use html content to display for mega menu type only.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
          <li><strong><?php _e('* Flyout Settings',APMM_PRO_TD);?></strong>
             <ul><li>
               <p><?php _e('In these Settings, you can set the flyout horizontal or vertical positions.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
          <li><strong><?php _e('* Menu Replacement Settings',APMM_PRO_TD);?></strong>
             <ul><li>
               <p><?php _e('In Menu replacement settings, you can replace the menu in different type such as logo image, search type, register form display type or woocommerce cart total type.  
              If you want to display menu in search form then you can simply choose Menu replacement Settings options and select search type from dropdown button options where you can add shortcode to display search form as inline toggle left or right position or mega menu type. Simply you can use the provided search shortcode in textarea.
              ',APMM_PRO_TD);?></p>
              <p><?php _e('For search type shortcode are provided below as per your requirement you can choose any search form layout and set on search type menu replacement textarea fields:',APMM_PRO_TD);?></p>

               <p><code class="wpmegamenu-highlight-code">Inline Search Toggle Left:  [wp_megamenu_search_form template_type=inline-search style=inline-toggle-left]</code></p>
              <div class="clear"  style="margin-bottom:5px;"></div>
               <p><code class="wpmegamenu-highlight-code">Inline toggle to Right:  [wp_megamenu_search_form template_type=inline-search style=inline-toggle-right]</code></p>
              <div class="clear"  style="margin-bottom:5px;"></div>
               <p><code class="wpmegamenu-highlight-code">Popup Search Form:  [wp_megamenu_search_form template_type=popup-search-form]</code></p>
              <div class="clear"  style="margin-bottom:5px;"></div>
              <p><code class="wpmegamenu-highlight-code">Display Search form on MegaMenu:  [wp_megamenu_search_form template_type=megamenu-type-search]</code></p>
              <div class="clear"  style="margin-bottom:5px;"></div>

              <p><?php _e('Similarly, you can even display login form on popup form with the shortcode provided below:',APMM_PRO_TD);?></p>
              <p><code class="wpmegamenu-highlight-code"> [wp_megamenu_login_form]</code></p>
              <div class="clear"></div>
              <p><?php _e('else you can choose register form menu type where register form will be shown on popup form
               on click the menu being replaced as register type.For register form you can add below shortcode of wp mega menu pro
                plugin.',APMM_PRO_TD);?></p>
                <p><code class="wpmegamenu-highlight-code"> [wp_megamenu_register_form]</code></p>
               <div class="clear" style="margin-bottom:5px;"></div>

               <p><?php _e('Another menu replacement option is custom logo image where you can upload custom logo image to show on menu. Here you can even set specific custom width and height for uploaded custom image.',APMM_PRO_TD);?></p>
              <div class="clear"></div>

               </li>
              </ul>
          </li>
           <li><strong><?php _e('* Icon Settings',APMM_PRO_TD);?></strong>
             <ul><li>
                    <p><?php _e('This Settings also contain Icon Settings where you can choose menu icon from multiple font icons sets. Menu Icon Settings contains 300+ FontAwesome, 160+ Genericon and 100+ Dashicons.Here you can even upload custom icon and set its custom width and height for particular menu.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
            <li><strong><?php _e('* Background Settings',APMM_PRO_TD);?></strong>
             <ul><li>
                    <p><?php _e('In order to upload Background image for specific mega menu, you can enable this settings. There are options to  upload single Background image or double background image.
                    On choosing single background image, you can upload single image to display it on particular mega menu.Or else choosing double background image, you can upload two image and set animation as cross fading type where image will be changed on hover effect or change the first background inage to another uplaoded background image
                    on hover on specific time duration. You can even set time duration for this changes.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
            <li><strong><?php _e('* Other Settings',APMM_PRO_TD);?></strong>
             <ul><li>
                    <p><?php _e('This Settings includes Custom styling options and Roles & Restriction Settings.',APMM_PRO_TD);?></p>
             
                        <ul class="groupwisesettings">    
                             <li><strong><?php _e('Custom Styling Settings',APMM_PRO_TD);?></strong></strong>
                              <ul><li>
                               <p><?php _e('> In this settings, you can set different custom styling for each menu items.
                               This values setup will override the styling setup of available theme as well as custom theme.
                               This includes overriding styling for background color,Background Hover Color,Menu Font Color,Menu Icon Color,Sub Menu Background Color and many more.
                               You can even define <b>Sub Menu Width</b> too from this settings in px.',APMM_PRO_TD);?></p>
                               </li>
                              </ul>
                             </li>
                              <li><strong><?php _e('Roles & Restriction Settings',APMM_PRO_TD);?></strong></strong>
                              <ul><li>
                               <p><?php _e('> From this settings, you can choose any roles or restriction in order to hide specific
                                menu item according to this settings. You can hide the menu item to onlu logged out users or logged in users or all users except administrator or else you can choose specific roles in order to hide specific menu item role wise.',APMM_PRO_TD);?></p>
                               </li>
                              </ul>
                             </li>
                           </ul>
               </li>
              </ul>
          </li>
        </ul>

       <dt><strong><?php _e('Other Level Menu Settings',APMM_PRO_TD);?></strong></dt>  
        <br/>
        <p><?php _e('This level menu includes following tab options:',APMM_PRO_TD);?></p>
        <ul class="prosettingslists">
          <li><strong><?php _e('* Sub Menu Settings',APMM_PRO_TD);?></strong>
               <ul><li>
               <p><?php _e('In this Settings, there is multiple options such as active link, show menu icons, menu label input field, disable menu text, hide menu on desktop, hide menu on mobile, active single menu useful for
                displaying custom menu, set menu alignment as left or right(only for top level menu used) an sub menu alignment for flyout
                 settings for sub menu.We have feature to set menu label and choose different menu animation with iteration count to different menu label as per menu wise.',APMM_PRO_TD);?></p>
               </li>
              </ul>
            </li>
            <li><strong><?php _e('* Icon Settings',APMM_PRO_TD);?></strong>
               <ul><li>
               <p><?php _e('These Settings also contain Icon Settings where you can choose menu icon from multiple font icons sets for sub menus. 
                   Menu Icon Settings contains 300+ FontAwesome, 160+ Genericon and 100+ Dashicons.Also you can upload new/custom icon too from here and define its width and height in px.',APMM_PRO_TD);?></p>
               </li>
              </ul>
             </li>
          <li><strong><?php _e('* Custom Settings',APMM_PRO_TD);?></strong>
           <ul><li>
               <p><?php _e('In these Settings, you can set sub menu as custom settings type where you can extract the post details such as featured image, excerpt, display author, category name, date and read more button. Here, You can even show custom image by choosing custom image and providing
                custom URL link. Similarly, you can display custom or featured image of particular post type sub menu on different position such as top, left or right or only image type on mega menu.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
          <li><strong><?php _e('* Image Settings',APMM_PRO_TD);?></strong>
             <ul><li>
               <p><?php _e('In these image settings, you can choose either default image size settings 
               set from Main Image Settings or simply choose different settings from here for particular post type sub menu featured image or custom image size. Also, if you can use custom image on Custom settings then , you can enable to use default custom image size setup before or fill different image size.',APMM_PRO_TD);?></p>
               </li>
              </ul>
          </li>
        </ul>


    </dl>
      
      <h3 class="wpmm_use_menusettings"><?php _e('Main Settings',APMM_PRO_TD);?></h3>
      <dl>
      <p><?php _e('In general setting, you can setup plugin default settings. This setup includes tab section with general settings, 
      mobile settings,other settings (woocommerce display cart default settings), default image settings,sticky menu settings,
       menu shortcode , export and import custom theme settings and custom css enable settings.
       Also, In this settings, you can set default layout for woocommerce total cart display layout styles.
        Here, You can choose Woocommerce Cart Display type for menu replaced as woocommerce cart for all  menu items as to show only icon or icons & 
        items only or icon & price only or all.. Also you can set text layout style to show item price and item count.',APMM_PRO_TD);?></p>
       
        <dt><strong><?php _e('General settings',APMM_PRO_TD);?></strong></dt>  
        <p><?php _e('In this tab, you can set the default values such as event behavior while clicking event is 
        selected from menu location for specific theme location, menu label animation type with duration, delay, iteration counter.',APMM_PRO_TD);?></p>
         
        <dt><strong><?php _e('Mobile settings',APMM_PRO_TD);?></strong></dt>
        <p><?php _e('In this settings, you can enable megamenu on mobile version, add substractor after menu,
        choose toggle behavior, menu toggle open and close icons as overall menu locations.',APMM_PRO_TD);?></p>
        
        <dt><strong><?php _e('Image settings',APMM_PRO_TD);?></strong></dt>
        <p><?php _e('In this tab you can set default settings regarding the wordpress image size options,
        set custom default width as well as menu icon hide/show and define icon width. You can either enable or disable all menu icons. 
        If you want to change the image size according to image shown on specific menus you can even override the settings from specific 
        menu location page.',APMM_PRO_TD);?></p>
        
        <dt><strong><?php _e('Sticky Menu Settings',APMM_PRO_TD);?></strong></dt>
          <p><?php _e('In order to make any menu sticky, you can select specific menu location from this tab section to make the specific
          menu location as sticky menu. You can even enable sticky menu on mobile, Assign Sticky Opacity, Sticky Zindex and Sticky Offset',APMM_PRO_TD);?></p>

        <dt><strong><?php _e('Shortcode',APMM_PRO_TD);?></strong></dt>
        <p><?php _e('In this tab you can use shortcode provided in any page, post content editor or widgets area.
         You can also use php function instead on your template files which specific menu location generated from shortcode tab. In order to display mega menu of specific menu location, firstly, you must need to enable WP Mega Menu from menu page for specific menu location from left section metabox options.',APMM_PRO_TD);?></p>
        
         <dt><strong><?php _e('Import',APMM_PRO_TD);?></strong></dt>
          <p><?php _e('In this tab, you can import the custom theme json file of this plugin.',APMM_PRO_TD);?></p>

         <dt><strong><?php _e('Export',APMM_PRO_TD);?></strong></dt>
         <p><?php _e('In this tab, you can export the custom theme json file of this plugin.',APMM_PRO_TD);?></p>

        <dt><strong><?php _e('Custom CSS',APMM_PRO_TD);?></strong></dt>
        <p><?php _e('In this tab, you can enable your own custom css and fill the custom css as per your requirement.',APMM_PRO_TD);?></p>
        
        <dt><strong><?php _e('Theme settings',APMM_PRO_TD);?></strong></dt>  
        <p><?php _e('In this sub menu page, you can setup your own custom theme templates with more than 100+ customization options and more than 50+ google fonts available.
        The default custom template is also provided. In a same way, you can create your own custom templates and assign it to specific menu location from admin menu creation page.',APMM_PRO_TD);?></p>
        

      </dl>

      <h4 class="wpmm_tabbed_settings"><?php _e('WPMM PRO : Advanced Menu Items');?></h4>
        <p>
          <?php _e('WP Mega Menu Pro Plugin now provides 2 tabs layout as horizontal and vertical tab. You can find this feature on main admin menu page left section metabox.
           After adding top level menu, to create horizontal tab section, you need to add 
          Horizontal Tabs Block(A group of horizontal tabs). A specific tab menu will be added as sub menu as horizontal tab main wrapper where you need to add its first tab menus/submenu and its respective other content menus. Similarly, you can choose 
          Vertical Tabs Block A group of vertical tabs and do same process in order to display vertical tab inside megamenu. 
          You can also choose trigger effect as on click or on hover effect for tabbed mega menu with animation effect for the content display from backend admin menu page.Here, simply add Vertical or Horizontal Menu Items from WPMM PRO: Advanced Menu Items Metabox Left Section. And on right side after adding specific menu items. On hover
          you can see WP Mega Menu Pro Button, click on the specific button for Tab sub menu only, where you can get the options such as Choose trigger effect for tabbed and animation type for specific tab type. So , you can easily add tab section on your mega menu with hover or clicked event.',APMM_PRO_TD);?>
        </p>

      <h4 class="wpmm_use_menusettings"><?php _e('Widgets Information');?></h4>
       <p>       
       <?php 
       _e('To display WP Mega Menu Pro of specific menu location, WP Mega Menu Pro has provided WP Mega Menu Pro Widget on widget page
        where you can choose particular menu location and set on the widget area. 
        Else you can use provided shortcode generated from shortcode tab on 
        any other page or default Text Widget.',APMM_PRO_TD);?><br/>
           <?php _e('WP Mega Menu Pro Plugin has also provided its own WP Mega Menu Contact Info widgets which is also provided on free version of this plugin 
           where you can setup your contact details with multiple font awesome icon class and any shortcode to display on mega menu.',APMM_PRO_TD);?>
        </p>
        <p>
          <?php _e('WP Mega Menu Pro Plugin now provides different attractive, advanced and useful 10+ pre available custom widgets.',APMM_PRO_TD);?>

        <ul>
         <li>A) <?php _e('Widget Related with Posts Display:',APMM_PRO_TD);?><br/>
             <ul class="wpmm-second-lists">
                 <li>1) <?php _e('WPMM PRO : Advanced Posts Slider Widget',APMM_PRO_TD);?></li>
                 <li>2) <?php _e('WPMM PRO : Display Posts By Category',APMM_PRO_TD);?></li>
                 <li>3) <?php _e('WPMM PRO : Gallery Shortcode Widget',APMM_PRO_TD);?></li>
                 <li>4) <?php _e('WPMM PRO : Posts Format Widget',APMM_PRO_TD);?></li>
                 <li>5) <?php _e('WPMM PRO : Recent Posts Widget',APMM_PRO_TD);?></li>
                 <li>6) <?php _e('WPMM PRO : Posts Timeline',APMM_PRO_TD);?></li>

             </ul>
         </li>
         <li>B) Widget Related with Woocommerce Products Display:<br/>
             <ul class="wpmm-second-lists">
                 <li>7) <?php _e('WPMM PRO : Products Lists Widget',APMM_PRO_TD);?></li>
                 <li>8) <?php _e('WPMM PRO : Recent Products Lists Widget',APMM_PRO_TD);?></li>
                 <li>9) <?php _e('WPMM PRO : Woo Products Layout 2 Widget',APMM_PRO_TD);?></li>
             </ul>
         </li>
         <li>C) Extra Widget:<br/>
             <ul class="wpmm-second-lists">
                 <li>10) <?php _e('WPMM :  Contact Info',APMM_PRO_TD);?></li>
                 <li>11) <?php _e('WPMM PRO : Text Image Widget',APMM_PRO_TD);?></li>
                 <li>12) <?php _e('WPMM PRO : Custom Image Widget',APMM_PRO_TD);?></li>
                 <li>13) <?php _e('WPMM PRO : Featured Box Layout',APMM_PRO_TD);?></li>
                 <li>14) <?php _e('WPMM PRO : HTML Text Widget',APMM_PRO_TD);?>(New Widget)</li>
             </ul>
         </li>
         </ul>
        </p>



      </div>
      </div>
</div>


