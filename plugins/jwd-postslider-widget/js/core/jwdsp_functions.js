/********************************
 * JWD Show Posts Slider Widget:: Admin Side jQuery functions
 ********************************/
jQuery(document).ready(function(){
	/** Switch Tabs */
	jQuery.fn.jwdspSwitchTabs = function() {
		var thisTab = jQuery(this);
        if (!thisTab.hasClass('active')) {
			var theCont = thisTab.parent().parent(); 
            var tabNum = thisTab.index();
            var nthChild = tabNum+1;
			theCont.find('.jwdsp_tabs li.active').removeClass('active');
            thisTab.addClass('active');
			theCont.find('.jwdsp_tab li.active').removeClass('active');
			theCont.find('.jwdsp_tab li:nth-child('+nthChild+')').addClass('active');
        }
		return false; 
	}
	/* END Switch Tabs*/
	/** Post Type Selector */
	jQuery.fn.jwdspPostTypeSelector = function() {
		var thisSelector 	= jQuery(this);
		var thisID 			= thisSelector.attr('id');
		var thisParent 		= thisSelector.parent().parent();
		var spinner 		= thisParent.find('.jwdsp_loader');
		var thisTax 		= thisParent.find('.jwdsp_taxonomy_selector').prop('disabled', 'disabled');
		var thisTerm 		= thisParent.find('.jwdsp_taxterm_selector').prop('disabled', 'disabled');
		var offset 			= thisID.replace ( /[^\d.]/g, '' );
		var exclude 		= thisID.replace('jwdsp_post_type', 'jwdsp_exclude_posts');
		var custom_query	= thisID.replace('jwdsp_post_type', 'jwdsp_custom_query');
		/**/
		spinner.addClass('show');
		jQuery('#'+exclude).val('');
		jQuery('#'+custom_query).val('');
		jQuery('.jwdsp_custom_query_post').html( thisSelector.val() );
		jQuery.ajax({
			type: 'post',
			url: jwdsp_ajaxObject.ajax_url,
			data: {
				action: 'jwdsp_getCategories',
				jwdsp_nonce:jwdsp_ajaxObject.jwdsp_ajaxObject_nonce,
				offset:offset,
				post_type:thisSelector.val(),
			}, 
			success: function(resp) {
				thisTax.html(resp.taxonomies).prop('disabled', false);
				thisTerm.html(resp.terms).prop('disabled', false);
				spinner.removeClass('show');
			}
		});
		return false; 
	}
	/* END Post Type Selector */
	/** Taxonomy Selector */
	jQuery.fn.jwdspTaxonomySelector = function() {
		var thisSelector = jQuery(this);
		var thisID = thisSelector.attr('id');
		var thisParent = thisSelector.parent().parent();
		var thisTarget = thisParent.find('.jwdsp_taxterm_selector').prop('disabled', 'disabled');
		var offset = thisID.replace ( /[^\d.]/g, '' );
		var wg_id = thisID.replace('-'+offset+'-jwdsp_taxonomy', '');
		var exclude = thisID.replace('jwdsp_taxonomy', 'jwdsp_exclude_posts');
		var spinner = thisParent.find('.jwdsp_loader-term');
		/**/
		spinner.addClass('show');
		jQuery('#'+exclude).val('');
		jQuery.ajax({
			type: 'post',
			url: jwdsp_ajaxObject.ajax_url,
			data: {
				action:'jwdsp_getTaxonomies',
				jwdsp_nonce:jwdsp_ajaxObject.jwdsp_ajaxObject_nonce,
				offset:offset,
				wg_id:wg_id,
				tx_selected:thisSelector.val(),
			}, success: function(response) {
				thisTarget.html(response.taxonomies).prop('disabled', false);
				spinner.removeClass('show');
			}
		});
		return false; 
	}
	/* END Taxonomy Selector */
	/** Check if there are any changes in the page 
	 *  before redirecting to the link destination 
	 */
	jQuery.fn.jwdspConfirmExit = function() {
		var url = jQuery(this).attr('href');
		var response = confirm( jwdsp_ajaxObject.jwdspConfirmMsg );
		if (response == true) { window.location.href = url; }
		return false; 
	}
	/**  
	 *  Apply UI Slider to items
	 */
	jQuery.fn.jwdspSliderUI = function() {
		var jwdspSlider = jQuery(this);
		var unit		= jwdspSlider.attr('data-jwdsp_unit');
		var handle 		= jwdspSlider.find( ".jwdsp_slider-handle" );
		var input 		= jwdspSlider.parent().find( ".jwdsp_slider-input" );
		switch(unit){
			case 'ch': /* Characters/Words  */
				jwdspSlider.slider({
					range: "min", min: 5, max: 50, value: input.val(),
					create: function() { handle.text( jQuery( this ).slider( 'value' )); },
					slide: function( event, ui ) { 
						handle.text( ui.value); 
						input.val( ui.value ); 
						input.trigger('change');
					}
				});
			break;
			case 'op': /* Opacity */
				jwdspSlider.slider({
					min: 0, max: 1, step: 0.1, value: input.val(),
					create: function() { 
						var slider_val = jQuery( this ).slider( 'value' );
						if( slider_val > 0){
							handle.text( slider_val*100 + '%'); 
							handle.removeClass('jwdsp_disabled');
						} else {
							handle.text('OFF');
							handle.addClass('jwdsp_disabled');
						}
					},
					slide: function( event, ui ) { 
						if(ui.value > 0){
							handle.text( ui.value*100 + '%');
							handle.removeClass('jwdsp_disabled');						
						} else {
							handle.text('OFF');
							handle.addClass('jwdsp_disabled');
						}
						input.val( ui.value ); 
						input.trigger('change');
					}
				});
			break;
			case 'px': /* Pixels: range 8 to 50 */
				jwdspSlider.slider({
					range: "min", min: 8, max: 50, value: input.val(),
					create: function() { handle.text( jQuery( this ).slider( 'value' ) + 'px'); },
					slide: function( event, ui ) { 
						handle.text( ui.value + 'px'); 
						input.val( ui.value ); 
						input.trigger('change');
					}
				});
			break;
			case 'sec': /* Seconds: range 0 to 10 */
				jwdspSlider.slider({
					min: 0, max: 10000, step: 1000, value: input.val(),
					create: function() { 
						var slider_val = jQuery( this ).slider( 'value' );
						if( slider_val > 0){
							handle.text( slider_val/1000 + 's'); 
							handle.removeClass('jwdsp_disabled');
						} else {
							handle.text('OFF');
							handle.addClass('jwdsp_disabled');
						}
					},
					slide: function( event, ui ) { 
						if(ui.value > 0){
							handle.text( ui.value/1000 + 's');
							handle.removeClass('jwdsp_disabled');						
						} else {
							handle.text('OFF');
							handle.addClass('jwdsp_disabled');
						}
						input.val( ui.value ); 
						input.trigger('change');
					}
				});
			break;
			default: /* Pixels: range 0 to 100 */
				jwdspSlider.slider({
					range: "min", min: 0, max: 100, value: input.val(),
					create: function() { handle.text( jQuery( this ).slider( 'value' ) + 'px'); },
					slide: function( event, ui ) { 
						handle.text( ui.value + 'px'); 
						input.val( ui.value ); 
						input.trigger('change');
					}
				});
		}
		return false; 
	}
});
/** END */