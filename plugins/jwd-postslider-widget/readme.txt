=== JWD PostSlider Widget ===
Contributors: jordachewd
Tags: posts slider, posts carousel, slider, carousel, widget, carousel widget, wordpress post slider widget, wordpress post carousel widget,responsive, responsive post slider, responsive post carousel, responsive slider plugin, custom post types, rotator, carousel, post carousel, post rotator, responsive rotator, jquery slider, javascript slider, jquery rotator, javascript rotator, post slider, posts rotator, wordpress responsive slider, responsive posts slider, wp slider widget, best wordpress widget slider, best widget, best slider widget, best responsive slider widget, best responsive wordpress slider widget, swiper
Requires at least: 4.0
Tested up to: 4.9.4
Stable tag: 1.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display your posts through a full responsive and highly customisable carousel widget. 

== Description ==

**JWD PostSlider Widget** is a powerful widget that allows you to create an infinite number of responsive post slider (carousel) widgets using default Wordpress Posts, Categories & Tags or Custom Post Type and Custom Taxonomies. It also comes with plenty of customization options.

= Main Features =

* Uses any registered post type in your website to create responsive post slider widget.
* JWD PostSlider Featured Image option ( The widget uses native Wordpress Featured Image by default but you can choose to use a different image to be displayed in the slider loop ) 
* Completely responsive (with touch enabled swiping).
* Highly optimised JS/CSS loading so that assets only load on pages where the slider is present.

= Main Widget Options =

* Post Type Selector
* Taxonomy Selector
* Tag Selector
* Exclude posts option
* Custom Query option
* Order By Date
* Number of posts to show
* Display Image options
* Title Position options
* Slide posts in loop mode
* Show/Hide option for each content section/element  
* Button / Font Size & Trim options
* Other

= General Settings =

* Choose post types to be used by the widget; Default: post.
* Infinite color options for main content elements
* Pagination type options
* Show/Hide icons
* Slide effect options
* Custom CSS option

== Installation ==

1. In your admin panel, go to **Appearance > Plugins** and click the **Add New** button.
2. Type in **JWD PostSlider Widget** in the search form and press the **Enter** key on your keyboard.
3. Click on the **Activate** button to use **JWD PostSlider Widget** right away.
4. Go to the **JWD PostSlider** tab at the bottom of your admin menu and do the general settings.
5. Navigate to **Appearance > Widgets** in your admin panel and use it as you want.
6. You'll find the **JWD PostSlider Featured Image** box in all the used post types editor pages. Right under the default Wordpress Featured Image box.

== Screenshots ==

1. Front side appearance (depending of your used theme).
2. Setup Widget - Posts: Define source and other settings.
3. Setup Widget - Settings: Show/Hide elements of the widget; Image display options.
4. Setup Widget - Customize: Define button / font style & word trim for the widget.
5. Custom Featured Image - The widget uses native Wordpress Featured Image by default but you can choose to use a different image to be displayed in the slider loop.
6. General Settings - these settings are applied for all created widgets.

== Upgrade Notice ==

= 1.8.1 =
If you encounter issues after this update go to your Widgets panel and click SAVE for all your JWD PostSlider widgets. If the issue persists please use our SUPPORT section on WORDPRESS.ORG website and let us know.

== Changelog ==


= 1.8.1 =
This version fixes several related bugs and comes with consistent improvements. **UPDATE Immediately**.

**Due to the new options added in this version it is possible to have some PHP notification errors after upgrading from lower versions. Just go to Widgets panel and click SAVE for all JWD PostSlider widgets.**
If the issue persists please use the <a href="https://wordpress.org/support/plugin/jwd-postslider-widget" rel="support" title="Support" target="blank">SUPPORT</a> section and let us know.

* **BUG FIX: Fixed bug that triggered infinite loop when click SAVE after using UI slider buttons. For both WP Customizer and Widgets panel.


= 1.8 =

* **BUG FIX: Slider UI doesn't trigger the Save button on Widgets section. Also doesn't trigger the Refresh on Customizer page.
* **BUG FIX: German translation error: Change "Schließen Sie den aktuellen Beitrag aus der Schleife" with "Aktuellen Beitrag nicht anzeigen" (Don’t show current post).
* **BUG FIX: Styles & Scripts does not work in Customizer.
* **BUG FIX: Fontello icons collide with other third party icons.
* **UPGRADE:** Swiper script to v4.2.0.
* **UPGRADE:** Wordpress v4.9+ - compatibility check.


= 1.7.3 =

* **BUG FIX:** Post content checks for Excerpt first and display it, otherwise display the content. Also strip shortcodes from given content.
* **BUG FIX:** 'Hide post with No Image' option does't work for Tags.
* **BUG FIX:** Removed hidden backlink in generated code on front-side.
* **UPGRADE:** Added Custom Query field so you can list any certain posts in the widget, from any category of a given (pre-selected) post type.
* Translation Updates

= 1.7.2 =

* **UPGRADE:** Added Button Alignment option in General Settings page. Only visible if Button size is set to Auto.
* **UPGRADE:** Added Autoplay option in General Settings page. 
* **UPGRADE:** Added Custom Link option for SEE MORE button in Widgets > JWD PostSlider > Posts (on bottom). 
* **BUG fixed:** CSS Style fix for jQuery UI Slider. There was some cases when it was overwritten by other apps.
* **BUG fixed:** AJAX Get Terms & Taxonomies: There was some cases when it didn't return the correct results after multiple post selection.

= 1.7.1 =

* **UPGRADE:** Added translation support for JWD PostSlider Featured Image ( visible in post edit page ).
* **UPGRADE:** Title Position has been moved in General Settings page.
* **BUG fixed:** CSS Style fix for jQuery UI Slider. There was some cases when it was overwritten by other apps.
* **BUG fixed:** When upgrading from lower version, button_size is not loaded until you click reset on General Settings page.

= 1.7 =

* **UPGRADE:** New options added in Genearal Settings  panel such as: Post title bg color, Post title opacity, "See More" button size.
* **UPGRADE:** New options added in Widget Settings panel such as: Title position, Exclude current post from loop, Display credit link.
* **UPGRADE:** New options added in Widget Customize panel such as: Button height, Button width.
* **UPGRADE:** UI/UX improvement for Widget & Settings panel. Added jQuery slider funtionality for several options.
* **UPGRADE:** Added translation support for: French, Italian, Spanish, Portuguese, Romanian, German, Russian. Default: English(US). Also several label names have been changed (but still intuitive) due to this upgrade.
* **UPGRADE:** Update Swiper jquery plugin to v3.4.2 (from 3.4.0)
* **BUG fixed:** Fatal Error on activation for older than 5.6 PHP versions.
* **BUG fixed:** Duplicated localize_script function in jwdsp_enqueue.php file.
* **BUG fixed:** Window confirm popup now scans the page for changes and fires only if needed.
* **BUG fixed:** Settings validate error when empty fields are encountered.

= 1.6.1 =
* Added rating ads in order to spread the word about **JWD PostSlider Widget** plugin. Thank you!
* Other minor style fixes

= 1.6 =
* Style Fixes & Improvements.

= 1.5.9 =
* MAJOR Update - Fixed SVN version issue
* Other Fixes & Improvements.

= 1.5.8 =
* General Settings panel style updates.
* Added show credit link option on the bottom of the Settings tab of the widget. 
* May need to update your widgets - just hit the SAVE button for all JWD PostSlider widgets.
* Added credit link on the bottom of the widget on the front side.
* Other Fixes & Improvements.

= 1.5.7 =
* Minor style fixes for admin side.
* Other Fixes & Improvements.

= 1.5.6 =
* Added Plugin banner
* Added screenshots

= Up to 1.5.5 =
* First release on WordPress.org;
* Added license.txt file
* Front Side Style & Scripts Fixes
* Admin Style Style & Scripts Fixes
* Admin panel fixes & improvements
* More functionalities added and made them run properly 
* Other Fixes & Improvements

= 1.0 =
* Hello World!

== Credits ==

JWD PostSlider Widget uses <a href="http://idangero.us/swiper/" rel="friend" title="Swiper" target="blank">Swiper</a>.