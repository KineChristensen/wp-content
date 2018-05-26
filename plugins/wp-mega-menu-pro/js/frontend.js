/**
 * WP Mega Menu Pro jQuery Plugin
*/
jQuery(function ($) {
var is_mobile;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  is_mobile = true;
}else{
  is_mobile = false;
}


  var mobile_toggle_option = wp_megamenu_params.wpmm_mobile_toggle_option; //toggle_standard or toggle_accordion
  var event_behavior = wp_megamenu_params.wpmm_event_behavior;
  var ajaxurl = wp_megamenu_params.wpmm_ajaxurl;
  var ajax_nonce = wp_megamenu_params.wpmm_ajax_nonce;
  var check_woocommerce_enabled = wp_megamenu_params.check_woocommerce_enabled;
  var enable_mobile = wp_megamenu_params.enable_mobile;
  var enable_rtl = wp_megamenu_params.wpmm_enable_rtl;

    $('body').addClass('wpmm_megamenu');

    if(enable_rtl === 1){
      $('body').addClass('wpmm_enable_rtl');
    }


    //search box
        var submitIcon = $('.wpmm-search-inline');
        var inputBox = $('.wpmm-search-icon .search-field');
        var isOpen = false;

        submitIcon.click(function(e){
          e.preventDefault();
          if($(this).next().find('.wpmm-search-icon').hasClass('inline-search')){
          if(isOpen === false){
             $(this).next().find('.inline-search').addClass('searchbox-open').removeClass('searchbox-closed');
            inputBox.focus();
            isOpen = true;
          } else {
             $(this).next().find('.inline-search').removeClass('searchbox-open').addClass('searchbox-closed');
            inputBox.focusout();
            isOpen = false;
          }
           }
        });


        var isOpen2 = false;

         $('.wpmm-search-popup').click(function(e){
            e.preventDefault();
            if($(this).parent().find('.wpmm-search-icon').hasClass('popup-search-form')){
             if(isOpen2 === false){
                 $(this).parent().find('.popup-search-form').addClass('popup-searchbox-open').removeClass('popup-searchbox-closed');
                inputBox.focus();
                isOpen2 = true;
              } else {
                 $(this).parent().find('.popup-search-form').removeClass('popup-searchbox-open').addClass('popup-searchbox-closed');
                inputBox.focusout();
                isOpen2 = false;
              }
             }
          });

         $('.closepopup,.wpmm-search-overlay').click(function(){
            $(this).parent().removeClass('popup-searchbox-open').addClass('popup-searchbox-closed');
        });

                       
 
     // $(".wpmm-search-popup").colorbox({inline:true, width:"50%",transition:"fade"});



    if(check_woocommerce_enabled === 'true'){
      $('.wp-megamenu-main-wrapper').each(function(){
         $(this).addClass('woocommerce');
      });
    }

          
    var submenu_open = event_behavior; // check event behavior as follow link on second click or toggle menu on second click



       var linkk;
       $('.wp-mega-menu-link').click(function(){
           var parentclass = $(this).parent().attr('class');
           if(parentclass === 'wpmmreadmorelink'){
              linkk = $(this).attr('href');
            window.open(linkk,'_self');
           }else if(parentclass === 'wpmm-custom-postimage'){
              linkk = $(this).attr('href');
            window.open(linkk,'_self');
           }

         });


     var target;
       $('body').on( 'click','.wpmm-onclick .wp-mega-menu-link', function(e) {
        e.preventDefault();              
        var link = $(this).attr('href');

       if($(this).parent().find('.wpmm-sub-menu-wrap').length > 0 || $(this).parent().find('.wpmm-sub-menu-wrapper').length > 0){
           if(submenu_open === 'follow_link'){
           //Open submenu on first click and follow link on second click.
            if(!$(this).hasClass('clicked')){
               if($(this).closest('.wp-megamenu-main-wrapper').hasClass('wpmm-fade')){
                 //effect as fade
                if($(this).parent().hasClass('wpmega-menu-megamenu')){ 
                 //megamenu         
                 if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-open-fade')){

                      $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').removeClass('clicked');  
                      $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                      $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
                      $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                      
                 }else{

                       $('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                       $('.wp-mega-menu-link').removeClass('clicked');  
                       $('.wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
                       $('.wpmm-mega-wrapper').find('li').removeClass('active-show');

                      $(this).parent().find('.wpmm-sub-menu-wrap').addClass('wpmm-open-fade');
                      $(this).parent().find('.wpmm-sub-menu-wrapper').addClass('wpmm-open-fade');
                      $(this).parent().find('.wp-mega-menu-link').addClass('clicked');  
                      $(this).parent().addClass('active-show');

                 }
             
                }else{
                    //flyout
                       $(this).siblings('.wpmm-sub-menu-wrapper').toggleClass('wpmm-open-fade');
                       $(this).parent().addClass('active-show');
                      if(!$(this).siblings('.wpmm-sub-menu-wrapper').hasClass('wpmm-open-fade')){
                       $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade'); 
                       $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').not($(this)).removeClass('clicked');
                       $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').removeClass('clicked');
                       $(this).parent().removeClass('active-show');
                     }
                  }
              }else{
                
                  //slide
                  if($(this).parent().hasClass('wpmega-menu-megamenu')){
                      if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-mega-slidedown')){
                       
                         $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown').addClass('wpmm-mega-slideup');
                         $(this).parent().removeClass('active-show');
                      }else{
                         
                        $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').removeClass('clicked');  
                        $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                         $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown');
                         $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                         $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                         $(this).parent().addClass('active-show');
                        }
                    }else{
                      //flyout
                       if($(this).parent().find('.wpmm-sub-menu-wrapper').hasClass('wpmm-mega-slidedown')){
                         $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                           $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                      }else{

                          $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                           $(this).parent().addClass('active-show');
                        
                        }
                    }
                 }
              $(this).addClass('clicked');                            
          }else{
           
           if(!link || link === '#') {      
                         $(this).removeClass('clicked');  

                          if($(this).parent().hasClass('wpmega-menu-megamenu')){
                            if($('.wp-megamenu-main-wrapper').hasClass('wpmm-fade')){
                              $( this ).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                              $(this).parent().removeClass('active-show');
                            }else{

                               if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-mega-slidedown')){
                                 $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown').addClass('wpmm-mega-slideup');
                                 $(this).parent().removeClass('active-show');
                              }else{
                                $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').removeClass('clicked');  
                                $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                                 $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown');
                                 $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                                 $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                                 $(this).parent().addClass('active-show');
                                }

                              // $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown').addClass('wpmm-mega-slideup');
                               // $(this).parent().addClass('active-show');
                                // $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                            }
                          }else{
                            //flyout
                             if($('.wp-megamenu-main-wrapper').hasClass('wpmm-fade')){
                              //fade open
                               $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
                               $(this).parent().removeClass('active-show');
                            }else{
                              //slide
                               if($(this).parent().find('.wpmm-sub-menu-wrapper').hasClass('wpmm-mega-slidedown')){
                                     $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                                       $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                                  }else{

                                      $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                                       $(this).parent().addClass('active-show');
                                    
                                    }

                                // $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                                // $(this).parent().addClass('active-show');
                            }

                          }
                        return false; 
                  }else{
                   
                    if($(this).hasClass('clicked')){
                      target = $(this).attr('target');
                    //  alert(target);
                    if(target === '_blank'){
                      window.open(link,target);
                    }else{
                       window.location= link;
                     }
                    
                    }else{
                      $(this).closest('.wpmm-mega-wrapper').find('.wp-mega-menu-link').removeClass('clicked');  
                      $(this).addClass('clicked');          
                    }
                    
                  }             
      }

        }else{
            //submenu_click
            //Open Submenu on first click and close on second click.
                 $(this).removeClass('clicked'); 

                 if($(this).closest('.wp-megamenu-main-wrapper').hasClass('wpmm-fade')){
                  //fade effect
                   if($(this).parent().hasClass('wpmega-menu-megamenu')){
                   // alert('megamenu');
                    //megamennu
                     if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-open-fade')){
                        $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                        $(this).parent().removeClass('active-show');
                      }else{
                        $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                        $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                        $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
                        $(this).parent().find('.wpmm-sub-menu-wrap').addClass('wpmm-open-fade');
                        $(this).parent().addClass('active-show');
                      }
                    }else{
                      //flyout
                   
                        if($(this).siblings('.wpmm-sub-menu-wrapper').hasClass('wpmm-open-fade')){
                          $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
                          $(this).parent().removeClass('active-show');
                        }else{
                           $(this).siblings('.wpmm-sub-menu-wrapper').addClass('wpmm-open-fade');
                           $(this).parent().addClass('active-show');
                        }

                    }

                   
          }else{
                //    alert('yes_slide');
                //slide effect
                   if($(this).parent().hasClass('wpmega-menu-megamenu')){
                        if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-mega-slidedown')){
                           $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown');
                            $(this).parent().removeClass('active-show');
                        }else{
                           $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown');
                           $(this).closest('.wpmm-mega-wrapper').find('li').removeClass('active-show');
                           $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                           $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                            $(this).parent().addClass('active-show');
                          }
                      }else{
                        //flyout
                         if($(this).siblings('.wpmm-sub-menu-wrapper').hasClass('wpmm-mega-slidedown')){
                            $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slidedown');
                            $(this).parent().removeClass('active-show');
                        }else{
                            $(this).siblings('.wpmm-sub-menu-wrapper').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
                            $(this).parent().addClass('active-show');
                         }

                
                      }
                   }
           }
        }else{
                target = $(this).attr('target');
                 if(target === ''){
                  target = '_self';
                 }
                  //  alert(target);
                  if(target === '_blank'){
                    window.open(link,target);
                  }else{
                     window.location= link;
                   }

        } 
    });


     $(document).on('click', function (e) {
          if ($(e.target).closest('.wp-megamenu-main-wrapper').length === 0) {
              $('.wp-megamenu-main-wrapper .wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
              $('.wp-megamenu-main-wrapper li').removeClass('active-show');
              $('.wp-megamenu-main-wrapper .wpmm-search-form .wpmm-search-icon').addClass('searchbox-closed');
              $('.wp-megamenu-main-wrapper .wpmm-sub-menu-wrapper').removeClass('wpmm-open-fade');
              $('.wp-megamenu-main-wrapper .wp-mega-menu-link').removeClass('clicked');
          }
      });


    /* Responsive Settings Toggle Bar*/

    $('.wpmega-closeblock').click(function() {
         $(this).parent().parent().parent().find('.wpmm-mega-wrapper').slideToggle(1000,function(){
         $(this).parent().parent().parent().find('.wpmm-mega-wrapper').addClass('hide-menu'); 
        });
         $(this).parent().parent().parent().find('.wpmega-openblock').show();  
         $(this).hide(); 
         $(this).closest('.wp-megamenu-main-wrapper').find('.wpmega-responsive-closebtn').hide();
      }); 

      $('.wpmega-openblock').click(function() {
        $(this).parent().parent().parent().find('.wpmm-mega-wrapper').slideToggle(1000,function(){
        $(this).parent().parent().parent().find('.wpmm-mega-wrapper').removeClass('hide-menu');  
        });
         $(this).parent().parent().parent().find('.wpmega-closeblock').show();
         $(this).closest('.wp-megamenu-main-wrapper').find('.wpmega-responsive-closebtn').show(); 
         $(this).hide(); 
      }); 



     var wrapperid;
if(enable_mobile === '1'){
      $( window ).resize(function() {
       $('.wp-megamenu-main-wrapper').each(function(){
         // wrapperid = $(this).parent().attr('class').split(' ')[0];
         var responsive_breakingpoint = $(this).find('.wpmegamenu-toggle').attr('data-responsive-breakpoint');
                  responsive_breakingpoint = responsive_breakingpoint.replace('px', '');
                   if(responsive_breakingpoint === ''){
                    responsive_breakingpoint = '910';
                  }
           if($(window).width() <= responsive_breakingpoint){ 
             if($(this).hasClass('wpmm-onhover')){
                  $(this).removeClass('wpmm-onhover');
                  $(this).addClass('wpmm-onclick');
             }
           }
       });
      }).resize();


       $( window ).resize(function() {
        $('.wpmegamenu-toggle').each(function(){
                  var responsive_breakingpoint = $(this).attr('data-responsive-breakpoint');
                  responsive_breakingpoint = responsive_breakingpoint.replace('px', '');
                   if(responsive_breakingpoint === ''){
                    responsive_breakingpoint = '910';
                  }
         
    
                if($(window).width() <= responsive_breakingpoint){

                  if($(this).parent().hasClass('wpmm-orientation-vertical')){
                  if($(window).width() <= responsive_breakingpoint){
                      $(this).show();
                      $(this).find('.wpmega-openblock').show();
                      $(this).find('.wpmega-closeblock').hide();
                      $(this).parent().find('.wpmm-mega-wrapper').addClass('hide-menu');    
                      $(this).parent().find('.wpmega-responsive-closebtn').hide();
                  }else{
                      $(this).hide();
                      $(this).find('.wpmega-openblock').hide();
                      $(this).find('.wpmega-closeblock').hide();
                      $(this).parent().find('.wpmm-mega-wrapper').removeClass('hide-menu');    
                      $(this).parent().find('.wpmega-responsive-closebtn').hide();
                  }
                }else{
                      $(this).show();
                      $(this).find('.wpmega-openblock').show();
                      $(this).find('.wpmega-closeblock').hide();
                      $(this).parent().find('.wpmm-mega-wrapper').addClass('hide-menu');    
                      $(this).parent().find('.wpmega-responsive-closebtn').hide();
                }
            
             // wrapperid = $(this).parent().attr('class').split(' ')[0];
         
             //    if($('.'+wrapperid).hasClass('wpmm-onhover')){
             //     $('.'+wrapperid).removeClass('wpmm-onhover');
             //      $('.'+wrapperid).addClass('wpmm-onclick');
             //    }

                $('.wpmega-tabs').each(function(){
                  if($(this).hasClass('wpmm-tabbed-onhover')){
                       $(this).removeClass('wpmm-tabbed-onhover');
                         $(this).addClass('wpmm-tabbed-onclick');
                  }

                });

            }else{
               wrapperid = $(this).parent().find('.wpmm-mega-wrapper').attr('id');
                 var wrapperidd = $(this).parent().attr('class').split(' ')[0];
               // if(is_mobile){
               if($(window).width() <= 960){
                   if($('.'+wrapperidd).hasClass('wpmm-onhover')){
                  $('.'+wrapperidd).removeClass('wpmm-onhover');
                   $('.'+wrapperidd).addClass('wpmm-onclick');
                  }


               }else{
                if($('.'+wrapperid).attr('data-trigger-effect') === 'wpmm-onhover'){
                    $('.'+wrapperidd).addClass('wpmm-onhover');
                    $('.'+wrapperidd).removeClass('wpmm-onclick');
                  }
                }
               $(this).hide();
               $(this).parent().find('.wpmm-mega-wrapper').removeClass('hide-menu');    
               $(this).parent().find('.wpmega-responsive-closebtn').hide(); 
             }

           });

      }).resize();

            $('.wpmega-responsive-closebtn').click(function(){

             $(this).closest('.wp-megamenu-main-wrapper').find('.wpmm-mega-wrapper').slideUp('slow');
             $(this).closest('.wp-megamenu-main-wrapper').find('.wpmega-closeblock').hide();
             $(this).closest('.wp-megamenu-main-wrapper').find('.wpmega-openblock').show();
             $(this).hide();
        });


       }else{
         $( window ).resize(function() {
           var responsive_bp = '910';
           if($(window).width() <= responsive_bp){
            $('.wp-megamenu-main-wrapper').css('display','none');
           }else{
            $('.wp-megamenu-main-wrapper').css('display','block');
           }
         }).resize();

       }

     /* searchtype onclick function 
     wpmega-searchdown*/
    $('.wpmm-onclick').on('click','.wpmm-csingle-menu',function(e){
     e.preventDefault();
    if($(this).closest('.wp-megamenu-main-wrapper').hasClass('wpmm-fade')){
          //fade
          if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-open-fade')){
                $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
          }else{
                $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-open-fade');
                $(this).parent().find('.wpmm-sub-menu-wrap').addClass('wpmm-open-fade');
          }
            $(this).parent().find('.wpmm-sub-menu-wrap').css('overflow','visible');
     }else{
         //slide
          if($(this).parent().find('.wpmm-sub-menu-wrap').hasClass('wpmm-mega-slidedown')){
              $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown').addClass('wpmm-mega-slideup');
              $(this).parent().find('.wpmm-mega-slideup').slideUp('slow');
            }else{
              $(this).closest('.wpmm-mega-wrapper').find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slidedown');
              $(this).parent().find('.wpmm-sub-menu-wrap').removeClass('wpmm-mega-slideup').addClass('wpmm-mega-slidedown');
              $(this).parent().find('.wpmm-mega-slidedown').slideDown('slow');
  
            }
           // $(this).parent().find('.wpmm-sub-menu-wrap').css('overflow','visible');
     }
     });


var win_width = $(window).width();
if(!is_mobile){
  if( win_width > 980){
    $('.wpmm-orientation-vertical > .wpmm-mega-wrapper > li > .wpmm-sub-menu-wrap > .wpmm-sub-menu-wrapper').each(function(){
                var height1 = $(this).outerHeight();
       var height5 = $(this).prev().outerHeight();
         var height4 = $(this).next().outerHeight();
         var height2 = $(this).prev().prev().outerHeight();
    
        var height3 = $(this).next().next().outerHeight();
         var height = parseInt(height1,10) + parseInt(height2,10) + parseInt(height3,10) + parseInt(height5,10) + parseInt(height4,10);
         //var height = parseInt(height1) + parseInt(height2) + parseInt(height3) + parseInt(height5) + parseInt(height4);
        $(this).parent('.wpmm-sub-menu-wrap').height(height);

         
    });
  }
     $( window ).resize(function() {
       $('.wpmm-orientation-vertical').each(function(){
               
                if(win_width < 1200){
                  var menu_width = $(this).width();
                  //var total_width = parseInt(win_width) - parseInt(menu_width)- 70;
               var total_width = parseInt(win_width,10) - parseInt(menu_width,10);
                  $(this).find('.wpmm-sub-menu-wrap').width(total_width);

                }
                
       });
            
      }).resize();
 }


 /*  if(!is_mobile){
   
       $('.wpmm-orientation-vertical > .wpmm-mega-wrapper > li > .wpmm-sub-menu-wrap > .wpmm-sub-menu-wrapper').each(function(){
         var height1 = $(this).outerHeight();
         var height2 = $(this).prev().prev().outerHeight();
         var height3 = $(this).next().next().outerHeight();
         var height = parseInt(height1) + parseInt(height2) + parseInt(height3);
         // var height = parseInt(Total) + parseInt(height1);
         $(this).parent('.wpmm-sub-menu-wrap').height(height);

         
    });

   /* $('.wpmm-orientation-vertical > .wpmm-mega-wrapper > li > .wpmm-sub-menu-wrap > .wpmm-sub-menu-wrapper').each(function(){
         var height1 = $(this).outerHeight();


         // var height2 = $(this).prev().prev().outerHeight();
         // var height3 = $(this).next().next().outerHeight();
         // var height = parseInt(height1) + parseInt(height2) + parseInt(height3);
  
        var h1 = $(this).prev().outerHeight();
        var h2 = $(this).prev().prev().outerHeight();
        var h3 = $(this).next().outerHeight();
        var h4 = $(this).next().next().outerHeight();
       // if(h1 != "undefined" && h2 != "undefined"){
          var t1 = parseInt(h1) + parseInt(h2);
       // }else if(h1 != "undefined" && h2 == "undefined"){
         //  var t1 = parseInt(h1);
       // }else if(h1 == "undefined" && h2 != "undefined"){
         // var t1 = parseInt(h2);
       // }else{
         // var t1 = 0;
       // }

         //if(h3 != "undefined" && h4 != "undefined"){
          var t2 = parseInt(h3) + parseInt(h4);
       // }else if(h3 != "undefined" && h4 == "undefined"){
           //var t2 = parseInt(h3);
        //}else if(h3 == "undefined" && h4 != "undefined"){
         // var t2 = parseInt(h4);
      //  }else{
        //  var t2 = 0;
       // }
      

         var Total = parseInt(t1) +  parseInt(t2);
         var height = parseInt(Total) + parseInt(height1);

         $(this).parent('.wpmm-sub-menu-wrap').height(height);

         
    });

     $( window ).resize(function() {
       $('.wpmm-orientation-vertical').each(function(){
                var win_width = $(window).width();
                if(win_width < 1200){
                  var menu_width = $(this).width();
                  var total_width = parseInt(win_width) - parseInt(menu_width)- 70;
               
                  $(this).find('.wpmm-sub-menu-wrap').width(total_width);

                }
                
       });
            
      }).resize();
   } 

*/
  /* Tabs Javascript */

    $('.wpmega-tabs').find('.wp-mega-sub-menu li').addClass('wpmm-tabs-section');
    // Example Hints: http://jsfiddle.net/uyvUZ/2/
    $('.wpmega-tabs > .wpmm-sub-menu-wrapper ul.wp-mega-sub-menu').each(function(i) {
        $(this).addClass('wpmm-tab-groups');
     });
    $('.wpmega-tabs > .wpmm-sub-menu-wrapper ul.wp-mega-sub-menu > li .wp-mega-sub-menu').each(function(i) {
     $(this).addClass('wpmm-tab-groups-panel');
     $(this).removeClass('wpmm-tab-groups');
    });

      $('.wpmm-tabs-section').removeClass('show_tab');
      $('.wpmega-tabs .wpmm-sub-menu-wrapper ul.wp-mega-sub-menu.wpmm-tab-groups').each(function() {
          $(this).find('li:first').addClass('show_tab');
          $(this).nextAll('.wp-mega-sub-menu:first').find('.wpmm-tabs-section:first').addClass('show_tab');
      });

   


     $(".wpmega-tabs.wpmm-tabbed-onhover .wpmm-sub-menu-wrapper ul.wp-mega-sub-menu.wpmm-tab-groups > li > a").on('hover',function() {
        var cTab = $(this).closest('li');
       var animated = cTab.closest('.wpmega-tabs').attr('data-animation');
        cTab.siblings('li').removeClass("show_tab");
        $('.wpmm-tab-groups-panel').removeClass(animated);
        cTab.addClass("show_tab");
        cTab.find('.wpmm-tab-groups-panel').addClass('animated '+animated);
        cTab.closest('ul.wp-mega-sub-menu').nextAll('.wp-mega-sub-menu:first').find('.wpmm-tabs-section').removeClass('show_tab'); 
        $(this).parent().parent().css('height', '');
        var hH2 =  $(this).parent().find('.wpmm-tab-groups-panel').actual( 'outerHeight' );
        var linkHh = $(this).actual( 'outerHeight' ) + 10;
        $(this).closest('.wpmm-tab-groups').height(hH2 + linkHh);
        return false;
    });

    $('.wpmega-tabs.wpmm-tabbed-onclick .wpmm-sub-menu-wrapper ul.wp-mega-sub-menu.wpmm-tab-groups > li > a').on('click',function() {
        var cTab = $(this).closest('li');
        var animated = cTab.closest('.wpmega-tabs').attr('data-animation');
        var hH2 =  $(this).parent().find('.wpmm-tab-groups-panel').actual( 'outerHeight' );
        
        if(hH2 > 0){
        cTab.siblings('li').removeClass('show_tab');
        $('.wpmm-tab-groups-panel').removeClass(animated);
        cTab.addClass('show_tab');
        cTab.find('.wpmm-tab-groups-panel').addClass('animated '+animated);
        cTab.closest('ul.wp-mega-sub-menu').nextAll('.wp-mega-sub-menu:first').find('.wpmm-tabs-section').removeClass('show_tab'); 
        $(this).parent().parent().css('height', '');
        
        var linkHh = $(this).actual( 'outerHeight' ) + 10;
        $(this).closest('.wpmm-tab-groups').height(hH2 + linkHh);
        return false;
       }else{  
            var target = $(this).attr('target');
          if(target == "_blank"){
            window.open(link,target);
          }else{
             window.location = link;
           }
       }
    });
     
    setTimeout(function(){
      $('.wpmega-tabs > .wpmm-sub-menu-wrapper ul.wpmm-tab-groups').each(function(){
        var height = $(this).actual( 'outerHeight' );
        $(this).css('min-height',height);
        var content_height = $(this).children('li').first().find('.wpmm-tab-groups-panel').actual( 'outerHeight' );
        var TablinkHeight = $(this).children('li').first().find('.wp-mega-menu-link').actual( 'outerHeight' );
        // var total_height = parseInt(content_height + parseInt(TablinkHeight) + 10);
        var total_height = parseInt(content_height + parseInt(TablinkHeight,10) + 10,10);
        $(this).css('height',total_height);
      });
    },2000);

   /* tabs end */

  //sticky menu 
    var sticky_opacity = wp_megamenu_params.wpmm_sticky_opacity;
    var sticky_offset = wp_megamenu_params.wpmm_sticky_offset;

    if(sticky_offset === ''){
      sticky_offset = '0px';
    }else{
      sticky_offset = parseInt(sticky_offset,10) + 'px';
    }

    var sticky_zindex = wp_megamenu_params.wpmm_sticky_zindex;
    
      if($('.wp-megamenu-main-wrapper').hasClass( 'wpmm-pro-sticky' )){

     // $this = $('.wpmm-pro-sticky');
            // Check the initial Poistion of the Sticky Header
            var stickyHeaderTop = $('.wpmm-pro-sticky').offset().top;
            $(window).scroll(function(){
                    if( $(window).scrollTop() > stickyHeaderTop ) {

                            $('.wpmm-pro-sticky').addClass('navbar-fixed-top');
                            $('.navbar-fixed-top').css({'top': sticky_offset, 'z-index' : sticky_zindex});
                            $('.navbar-fixed-top').css('opacity', sticky_opacity);
                    } else {
                           $('.wpmm-pro-sticky').removeClass('navbar-fixed-top');
                    }
            });
          }
   // sticky menu end

   $('.wp-megamenu-main-wrapper .wpmm-sub-menu-wrap').each(function(){
    var nextimage = $(this).attr('data-nextimage');
    var nextimage1 = $(this).attr('data-nextimage1');
    var repeat = $(this).attr('data-repeat');
    var position = $(this).attr('data-position');
     if(nextimage !== '' && nextimage !== undefined){
   
      $(this).hover(function(){ 
      $(this).addClass('wpmm-fadeOut');
      $(this).css('background-image', 'url("+nextimage+")'); 
      $(this).css('background-repeat',repeat);
      $(this).css('background-position',position);
      $(this).css('background-size','cover');
      //$(this).css("transition",'2.5s');
       
      }).mouseleave(function(){
      $(this).removeClass('wpmm-fadeOut');
       $(this).css('background-image', 'url("'+nextimage1+'")'); 
       $(this).css('background-repeat',repeat);
       $(this).css('background-position',position);
       $(this).css('background-size','cover');
       //$(this).css("transition",'0s');
      });

    }

   });


   $('.wpmm-original-submenus').each(function(){
    var id = $(this).find('li').attr('id');
    var appended_html = $(this).html();
    $(this).parent().find('.wpmm-group1').find('.wpmm-clone-submenus').find('li#'+id).parent().replaceWith(appended_html);
    $(this).remove();
   });


    /* widget posts slider*/
    $('.wpmega-posts-slider').each(function(){
       // var selector = $(this);
        var speed = $(this).data('speed');
        var auto = $(this).data('auto-slide');
        var slider_duration = $(this).data('duration');
        var controls = $(this).data('controls');
        //var id = $(this).data('id');
        var mode = $(this).data('mode');
       $(this).bxSlider({
          speed: speed,
          pause: slider_duration,
          auto: auto,
          pager: false,
          mode: mode,
          controls: controls,
          infiniteLoop: false,
          adaptiveHeight:true
        });

    });

    $('.wpmm-sub-menu-wrap').each(function(){
      if($(this).find('.wpmm-single-bgimage').length  > 0){
        var bgimage = $(this).find('.wpmm-single-bgimage img').attr('src');
        var bgstyle = $(this).find('.wpmm-single-bgimage img').attr('style');
        bgstyle = bgstyle+'background:url('+bgimage+');';
        $(this).attr('style', bgstyle);
        $(this).find('.wpmm-single-bgimage').remove();
        $(this).addClass('zoom');
      }
    });



});