/*
  RFP : ADMIN SCRIPT
*/
function rfp_get_taxonomies(thisele){
	var selectedVal = thisele.find('option:selected').val();
	var rfpstring = jQuery('#rfpstring').val();

	if(selectedVal !=""){
		jQuery.ajax({
			url  : ajaxurl,
			type : "POST",
			data : {
				action   : 'rfp_call_taxonomies',
				security : rfpstring,
				posttype : selectedVal
			},
			beforeSend: function(){
				jQuery('#rfp_selterms').html('');
				jQuery('.rfp_loader').fadeIn();
				jQuery('#rfp_seltax').css("pointer-events", "none");
				thisele.css("pointer-events", "none");
			},
			success : function( response ) {
				if(response){
					thisele.css("pointer-events", "auto");
					jQuery('#rfp_seltax').html(response).css("pointer-events", "auto");
					jQuery('.rfp_loader').hide();
				}
			}
		});
	}else{
		var defaultHtml = '<option value="">Select</option>';
		jQuery('#rfp_seltax').html(defaultHtml);
		jQuery('#rfp_selterms').html('');
	}
}

jQuery('#rfp_selpost').change(function(){
	rfp_get_taxonomies(jQuery(this));
});

function rfp_get_taxo_terms(thisele){
	var selectedVal = thisele.find('option:selected').val();
	var rfpstring = jQuery('#rfpstring').val();

	if(selectedVal !=""){
		jQuery.ajax({
			url  : ajaxurl,
			type : "POST",
			data : {
				action   : 'rfp_call_taxonomy_terms',
				security : rfpstring,
				taxonomy : selectedVal
			},
			beforeSend: function(){
				jQuery('.rfp_loader').fadeIn();
				jQuery('#rfp_selterms').css("pointer-events", "none");
				thisele.css("pointer-events", "none");
			},
			success : function( response ) {
				if(response){
					thisele.css("pointer-events", "auto");
					jQuery('#rfp_selterms').html(response).css("pointer-events", "auto");
					jQuery('.rfp_loader').hide();
				}
			}
		});
	}else{
		jQuery('#rfp_selterms').html('');	
	}
}

jQuery('#rfp_seltax').change(function(){
	rfp_get_taxo_terms(jQuery(this));
});