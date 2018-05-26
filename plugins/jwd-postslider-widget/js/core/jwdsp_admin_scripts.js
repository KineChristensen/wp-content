/********************************
 * JWD Show Posts Slider Widget:: Admin Side Scripts
 ********************************/
jQuery(document).bind('ready widget-added widget-updated', function(e){	
	/* Detect input changes */
	var jwdsp_formChanged = false;
	/* Tabs Selector*/
	jQuery('.widget').on('click', '.jwdsp_tabs li', function(e){
		e.preventDefault();
		jQuery(this).jwdspSwitchTabs();
		return false;
	});
	/* Post Type Selector*/
	jQuery('.widget').on('change', '.jwdsp_posttype_selector', function(e){
		e.preventDefault();
		jQuery(this).jwdspPostTypeSelector();
		return false;
	});
	/* Taxonomy Selector*/
	jQuery('.widget').on('change', '.jwdsp_taxonomy_selector', function(e){
		e.preventDefault();
		jQuery(this).jwdspTaxonomySelector();
		return false;
	});
	/* Color Piker ( For Settings page) */
	jQuery('#widgets-right .jwdsp_color_picker, .inactive-sidebar .jwdsp_color_picker, .jwdsp_panel_color_piker .jwdsp_color_picker').wpColorPicker({ 
		change: function (event, ui) { jwdsp_formChanged = true; return true;}
	});
	/* Check if there are any changes on the form before leaving the page */
	jQuery('.jwdsp_panel-wrap, .jwdsp_widget_content').on('keyup change', 'input, select, textarea', function(){ jwdsp_formChanged = true; });
	jQuery('.toplevel_page_jwdsp_postslider_page, .jwdsp_widget_content').on('click', 'a', function(e){
		if( jwdsp_formChanged == true ){
			e.preventDefault();
			jQuery(this).jwdspConfirmExit();
		}
	});
	/* Run UI Slider */
	jQuery('.jwdsp_slider-bg').each(function(){
		jQuery(this).jwdspSliderUI();
	});
	/*********************************************************************
     * Reload scripts after ajax is complete on Widgets page 
	 */
	jQuery(document).ajaxComplete(function() { 
		/* Color Piker */
		jQuery('#widgets-right .jwdsp_color_picker, .inactive-sidebar .jwdsp_color_picker').wpColorPicker({ 
			change: function (event, ui) { jwdsp_formChanged = true; return true;}
		}); 
		/* UI Slider */
		jQuery('#widgets-right .jwdsp_slider-bg, .inactive-sidebar .jwdsp_slider-bg').each(function(){
			jQuery(this).jwdspSliderUI();
		});
	});/** END ajaxComplete */
});/** END bind ready */