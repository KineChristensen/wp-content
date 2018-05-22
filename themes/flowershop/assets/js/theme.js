/**
 * Main Theme JavaScript File
 * Theme.al
 */

( function( $ ) {

    //---- Fix body padding related to navbar ----
    function fixBodyPadding(){
        jQuery('body').css('paddingTop',jQuery('#nav-primary').height());
    }
    $( window ).resize(function() {
        fixBodyPadding();
    });
    $( window ).trigger('resize');
    // -------------------------------------------

	// - initialize Bootstrap tooltips and popovers
  $('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

  // Swipebox jQuery Plugin
  // Used for product images gallery lightbox
  if ( $.isFunction($.fn.swipebox) ) {
    $( '.swipebox' ).swipebox ( {
  		hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
  		removeBarsOnMobile : false, // false will show top bar on mobile devices
  		hideBarsDelay : 5000, // delay before hiding bars on desktop
  		videoMaxWidth : 1140, // videos max width
  		loopAtEnd: false // true will return to the first image after the last image is reached
  	} );
  };

  // Navbar Toggle
  // enhance default bootstrap mobile navigation
  $('.navbar-collapse').on('show.bs.collapse', function () {
    $('#nav-primary .navbar-toggle').addClass('navbar-toggle-expanded');
    $('#site-header').addClass('navbar-toggle-expanded');
  });

  $('.navbar-collapse').on('hide.bs.collapse', function () {
    $('#site-header').removeClass('navbar-toggle-expanded');
    $('#nav-primary .navbar-toggle').removeClass('navbar-toggle-expanded');
  });

  // Navbar mobile height
  // fix mobile navigation in mobile mode
  var navHeight = $('#nav-primary .navbar-header').outerHeight(true);
  $('.navbar-fixed-top .navbar-collapse').css({'padding-bottom':navHeight});

  // Toogle for widget on responsive mode
  // Used in footer wigets to make them collapisble
  $('.widget-title').on('click', function(e) {
    $(this).parent().toggleClass("widget-collapsed"); //you can list several class names
    $('#site-footer').trigger('footerRevealResize');
    e.preventDefault();
  });

} )( jQuery );


jQuery( document ).ready(function( $ ) {

  // - Footer Reveal jQuery Plugin
  // A parallax effect for Footer when you scroll
  $('.footer-reveal').footerReveal( {
    shadow: true,
    shadowOpacity: .5,
    zIndex: -101
  } );


  $(window).scroll(function(){

    // Parallax effect for images
    s = $(this).scrollTop();
    $(".carousel-inner .item img").css("-webkit-transform","translateY(" +  (s/2) + "px)");
    // $(".background-image-parallax").css("background-position", "center calc(50% + " +(s*.5) + "px");

  });




});
