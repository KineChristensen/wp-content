/********************************
 * JWD Show Posts Slider Widget:: Add custom post thumbnail image
 ********************************/
jQuery(document).ready(function(){	
	/** Add Image */
	jQuery('#jwdsp_slider_image').on('click', '.jwdsp_thumbnail_upload', function(e){
		e.preventDefault();
		var file_frame;
		var thisCont = jQuery(this).parent();
		/* If the media frame already exists, reopen it. */
		if ( file_frame ) { file_frame.open(); return; }
		/* Create the media frame. */
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jwdsp_postThb.jwdspAddImgTitleMsg,
			button: { text: jwdsp_postThb.jwdspAddImgBtnMsg },
			library: { type: 'image' },
			multiple: false   
		});
		/* When an image is selected, run a callback. */
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			thisCont.prepend('<img class="jwdsp_thumbnail_upload" src="'+attachment.url+'" style="width:auto;max-width:100%;cursor:pointer;margin-bottom:1em" />');
			thisCont.find('.button').removeClass('jwdsp_thumbnail_upload').addClass('jwdsp_thumbnail_remove').html(jwdsp_postThb.jwdspRemoveImgMsg);
			thisCont.find('input[name="jwdsp_thumbnail"]').val(attachment.url);
		});
		/* Finally, open the modal */
		file_frame.open();
		return false;
	});
	/** Remove Image */
	jQuery('#jwdsp_slider_image').on('click','.jwdsp_thumbnail_remove', function(e){
		e.preventDefault();
		var thisCont = jQuery(this).parent();
		thisCont.find('img').remove();
		thisCont.find('.button').removeClass('jwdsp_thumbnail_remove').addClass('jwdsp_thumbnail_upload').html(jwdsp_postThb.jwdspAddImgMsg);
		thisCont.find('input[name="jwdsp_thumbnail"]').val('');
		return false;
	});
});