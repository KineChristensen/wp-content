jQuery(document).ready(function ($) {


    $('.wpmega-user-login-form').on('click',function(e){
          $(this).find('.wpmm-login-form').addClass('wpmm_show_form');
          // $('form#wpmm_login').fadeIn(500);
          $('form#wpmm_login').show();
          $('form#wpmm_register').hide();
        });

      $('.wpmega-user-register-form').on('click',function(){
          $(this).find('.wpmm-login-form').addClass('wpmm_show_form');
          // $('form#wpmm_register').fadeIn(500);
          $('form#wpmm_register').show();
          $('form#wpmm_login').hide();
        });


    // Display form from link inside a popup
	/*$('#wpmm_pop_login, #wpmm_pop_signup').live('click', function (e) {
        formToFadeOut = $('form#wpmm_register');
        formtoFadeIn = $('form#wpmm_login');
        if ($(this).attr('id') == 'wpmm_pop_signup') {
            formToFadeOut = $('form#wpmm_login');
            formtoFadeIn = $('form#wpmm_register');
        }
        formToFadeOut.fadeOut(500, function () {
            formtoFadeIn.fadeIn();
        })
        return false;
    });*/
	// Close popup
    $(document).on('click', '.wpmm_login_overlay, .close', function () {
        $('.ajax-auth').fadeOut();
        $('.wpmm-login-form').removeClass('wpmm_show_form');
    });

	// Perform AJAX login/register on form submit
	$('form#wpmm_login, form#wpmm_register').on('submit', function (e) {
        if (!$(this).valid()) return false;
        $('p.status', this).show().text(wp_megamenu_ajax_auth_object.loadingmessage);
		action = 'ajaxlogin';
		username = 	$('form#wpmm_login #username').val();
		password = $('form#wpmm_login #password').val();
		email = '';
		security = $('form#wpmm_login #security').val();
		if ($(this).attr('id') == 'wpmm_register') {
			action = 'ajaxregister';
			username = $('#signonname').val();
			password = $('#signonpassword').val();
        	email = $('#email').val();
        	security = $('#signonsecurity').val();	
		}  
		ctrl = $(this);
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: wp_megamenu_ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'username': username,
                'password': password,
				'email': email,
                'security': security
            },
            success: function (data) {
				$('p.status', ctrl).text(data.message);
				if (data.loggedin == true) {
                    document.location.href = wp_megamenu_ajax_auth_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });
	
	// Client side form validation
    if (jQuery("#wpmm_register").length) 
		jQuery("#wpmm_register").validate(
		{ 
			rules:{
			password2:{ equalTo:'#signonpassword' 
			}	
		}}
		);
    else if (jQuery("#wpmm_login").length) 
		jQuery("#wpmm_login").validate();
});