 //////////////////////
// SEARCHY JS  - http://www.dopewp.com/searchy/
//////////////////////
// DOCUMENT READY
/////////////////////////////////////////////

jQuery( document ).ready(function(){
			// AJAX FORM FOR MAIN SEARCH FORM
			var options = { 
							target:     '#searchy-search-results',		 
								url: '?searchy_ajax_results=1',
								beforeSubmit: function() {
												jQuery("#searchy-search-results").html("");
												jQuery(".searchy-load-bubble").show();
												jQuery("#searchy-filter-overlayer").show();
											},
							success:    function() { 
												jQuery(".searchy-load-bubble").hide();
												jQuery("#searchy-filter-overlayer").fadeOut();
											} 
						}; 
			
			jQuery('.searchy-search-form').ajaxForm(options);	
	
			//  AT PAGE LOADING...
			jQuery(".searchy-trigger-search").click().hide(); //TRIGGER SEARCH
			
			// AT FILTER CHANGE ...
			jQuery("body").on("change",".searchy-search-form select,.searchy-search-form input",function() {
						jQuery(".searchy-last-added-filter").removeClass("searchy-last-added-filter");
						jQuery(this).addClass("searchy-last-added-filter");
						
						jQuery(".searchy-trigger-search").click(); //TRIGGER SEARCH
									});
				
				// AT SORTING  CHANGE ...
			jQuery("body").on("change","#searchy-sorting input",function() {
						jQuery(".searchy-last-added-filter").removeClass("searchy-last-added-filter");
						jQuery(this).addClass("searchy-last-added-filter");
						
						jQuery("input[name=searchy_sortby_hidden]").val(jQuery(this).attr("data-sortby"));
						jQuery("input[name=searchy_sortby_field_hidden]").val(jQuery(this).attr("data-sortby-field"));
						
						jQuery(".searchy-trigger-search").click(); //TRIGGER SEARCH
					});
					
			// CLICK UNDO LAST FILTER/SORTING  ...
			jQuery("body").on("click",".searchy-undo-last",function(e) {
						e.preventDefault();
						//if it's a Filter checkbox, undo last checkbox
						if (jQuery(".searchy-last-added-filter").is(':checkbox')) 	jQuery(".searchy-last-added-filter").click();
						//if it's a input field, clear
						if (jQuery(".searchy-last-added-filter").is(':text')) 	jQuery(".searchy-last-added-filter").val("").change();
						//if it's a radio field, clear sorting and use first (default) sorting
						if (jQuery(".searchy-last-added-filter").is(':radio')) 	jQuery("#searchy-sorting .btn:first").click();
						});
			
}); //END DOC READY
 