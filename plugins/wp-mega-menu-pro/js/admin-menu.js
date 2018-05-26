/**
 * WP Mega Menu Pro jQuery Plugin
*/

jQuery(function ($) {
    "use strict";
     var AjaxUrl = apmm_variable.ajax_url;
     var admin_nonce = apmm_variable.ajax_nonce;
     var saved_success_message = apmm_variable.success_msg;
     var menu_lightbox = apmm_variable.menu_lightbox;
     var checked_disabled_error = apmm_variable.checked_disabled_error;
     var saving_data = apmm_variable.saving_msg;
     var plugin_javascript_path = apmm_variable.plugin_javascript_path;
     var depth_check = apmm_variable.depth_check_message;
     var editmsg = apmm_variable.group_edit_message;

  
    //WP Mega Menu Pro Settings submit button save data
    $(".ap-mega-menu-save").on('click', function(e) {
        e.preventDefault();
        // retrieve the widget settings form
          var wpmm_settings = JSON.stringify($( "[name^='apmegamenu_meta']" ).serializeArray());
          $.ajax({
                    url: AjaxUrl,
                    type: 'post',
                    data: {
                        action: "wpmmsavesettings",
                        wp_menu_id: $('#menu').val(),
                        wp_megamenu_meta: wpmm_settings,
                        wp_nonce: admin_nonce
                    },
                    beforeSend: function() {
                         $(".nav-menu-theme-apmegamenus .apmm_loader").css('display', 'block');
                    },
                    complete: function() {
                         $(".nav-menu-theme-apmegamenus .apmm_loader").css('display', 'none');
                         $(".nav-menu-theme-apmegamenus .apmm_success").show();
                    },
                    success: function(res) {
                       $(".nav-menu-theme-apmegamenus .apmm_loader").css('display', 'none');
                       $(".nav-menu-theme-apmegamenus .apmm_success").html(saved_success_message).delay(5000).fadeOut('slow');
                    }
                });

    });

  /* checked if wp mega menu is enabled or not and add body class */
   var wpmm_enabled_class = function() {
        if ( $('input.apmegamenu_enabled:checked') && $('input.apmegamenu_enabled:checked').length ) {
            $('body').addClass('wp_megamenu_enabled');
        } else {
            $('body').removeClass('wp_megamenu_enabled');
        }
    }

    $('input.apmegamenu_enabled').on('change', function() {
        wpmm_enabled_class();
    });

    wpmm_enabled_class();

    $('#apmegamenu_accordion').accordion({
        heightStyle: "content",
        collapsible: true,
        active: false,
        animate: 200
    });

$('#menu-to-edit li.menu-item').each(function() {
var menu_item = $(this);
var menu_id = $('input#menu').val();
var menu_title = menu_item.find('.menu-item-title').text();
if ( ! menu_title ) {
    menu_title = menu_item.find('.item-title').text();
}
var id = parseInt(menu_item.attr('id').match(/[0-9]+/)[0], 10);
var button = $("<span>").addClass("wpmm_launch")
 .html(menu_lightbox)
 .on('click', function(e) {
        e.preventDefault();
 
     if ( ! $('body').hasClass('wp_megamenu_enabled') ) {
        alert(checked_disabled_error);
        return;
    }
       
       var depth = menu_item.attr('class').match(/\menu-item-depth-(\d+)\b/)[1];
  
         $.ajax({
            url: AjaxUrl,
            type: 'post',
            data: {
                action: "wpmm_show_lightbox_html",
                menu_item_id: id,
                menu_item_title: menu_title,
                menu_item_depth : depth,
                menu_id: menu_id,
                wp_nonce: admin_nonce,
            },
            cache: false,
        beforeSend: function() {
                 $('.wpmm_menu_wrapper .wpmm_overlay').css('display','block');
                 $('.wpmm_menu_wrapper .close_btn').css('display','block');
            },
            complete: function() {
                $('.wpmm_overlay').css('display','block');
                $('#wpmm_menu_settings_frame').css('display','block');
                $('.wpmm_menu_wrapper .close_btn').css('display','block');
            },
        success: function(res) {
             // fix for WordPress 4.8 widgets when lightbox is opened, closed and reopened
            if (wp.textWidgets !== undefined) {
                wp.textWidgets.widgetControls = {}; // WordPress 4.8 Text Widget
            }

            if (wp.mediaWidgets !== undefined) {
                wp.mediaWidgets.widgetControls = {}; // WordPress 4.8 Media Widgets
            }

            if (wp.customHtmlWidgets !== undefined) {
                wp.customHtmlWidgets.widgetControls = {}; // WordPress 4.9 Custom HTML Widgets
            }
            $('.wpmm_menu_wrapper .wpmm_main_content').html(res);
            var depth_class = $('#wpmm_menu_'+id).attr('data-depth');    

    $('#wpmm_menu_'+id+' .apmm-color-picker').wpColorPicker(); 
                                 
    /*
    * CKEDITOR HTML CONTENT FOR TOP AND BOTTOM SECTION
    */
     if(depth_class == "depth_0"){
     
          var editor =  CKEDITOR.replace( 'wpmm_html_content',{
                uiColor: '#dfdfdf',
                stylesSet: 'my_custom_style',
                allowedContent: true,
                width: '600px',
                height: '200px',
                filebrowserBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                filebrowserWindowWidth : '1000',
                filebrowserWindowHeight : '700'
            });


          var changesCount = 0;
          var changesCount2 = 0;
           editor.on( 'change', function ( ev ) {
                 changesCount++;
                 // document.getElementById( 'content2' ).style.display = '';
                 document.getElementById( 'changes' ).innerHTML = changesCount.toString();
                 document.getElementById( 'tophtmlcontent' ).innerHTML = editor.getData();
            } );

             var beditor =  CKEDITOR.replace( 'wpmm_html_content2',{
                                        uiColor: '#dfdfdf',
                                        stylesSet: 'my_custom_style',
                                        allowedContent: true,
                                        width: '600px',
                                        height: '200px',
                                        filebrowserBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html',
                                        filebrowserImageBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowseUrl : plugin_javascript_path+'/ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        filebrowserImageUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl : plugin_javascript_path+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                        filebrowserWindowWidth : '1000',
                                        filebrowserWindowHeight : '700'
                                    });

         beditor.on( 'change', function ( ev ) {
                 changesCount2++;
                 document.getElementById( 'changes2' ).innerHTML = changesCount2.toString();
                 document.getElementById( 'bottomhtmlcontent' ).innerHTML = beditor.getData();
            } );
     }
      /*CKEDITOR HTML CONTENT FOR TOP AND BOTTOM SECTION END*/


      if(depth_class != "depth_0"){
            $(".wpmm_menu_align").prop('disabled', 'disabled');
            $('.depth_check').html(depth_check);
            $('.hide_fortopmenu').show();
            if($('.wpmm_menu_item_title').val() == "[Tabs]" || $('.wpmm_menu_item_title').val() == "[HTabs]"){
                $('.show_for_tabbed').show();
            }
       }else{
        $('.hide_fortopmenu').hide();
         $('.show_for_tabbed').hide();
       }

        /*
        *  TABS MENU
        */  
        $( '#wpmm_menu_'+id+' .wpmm_tabs' ).on('click', function() {
        $('#wpmm_menu_'+id+' .wpmm_tabs').removeClass('active');
         var tab_id = $(this).attr('id');

         if(tab_id == "wp_mega_menu"){
               $('.main_submit_section').hide();
         }else{
               $('.main_submit_section').show();
             }
         $(this).addClass('active');
         $('#wpmm_menu_'+id+' .tab-pane').css('display','none');
         $('#wpmm_menu_'+id+' .wpmm_content_rtsection #tab_'+tab_id).css('display','block');
        });

         $('#wpmm_menu_'+id+' .wpmm_tabs').each(function() {
          if($( this).hasClass( "active" )){
            var tabid = $(this).attr('id');
             if(tabid == "wp_mega_menu"){
              $('.main_submit_section').hide();
             }else{
               $('.main_submit_section').show();
             }
            $('#wpmm_menu_'+id+' .tab-pane').css('display','none');
            $('#wpmm_menu_'+id+' .wpmm_content_rtsection #tab_'+tabid).css('display','block');
          } 

        });
            /* tabs menu closed*/

 /************************************* ROLES AND RESTRICTION TABS SECTION START ****************************************/
     $('.wpmm-by-role').hide();
     $('#wpmm_menu_'+id+' .wpmm_display_mode').on('change',function(){
        var mode = $(this).val();
        if(mode == "by_role"){
         $('#wpmm_menu_'+id+' .wpmm-by-role').show();
        }else{
         $('#wpmm_menu_'+id+' .wpmm-by-role').hide();
        }

    });
       var rmode = $('#wpmm_menu_'+id+' .wpmm_display_mode option:selected').val();
       // alert(rmode);
       if(rmode == "by_role"){
         $('#wpmm_menu_'+id+' .wpmm-by-role').show();
        }else{
         $('#wpmm_menu_'+id+' .wpmm-by-role').hide();
        }

 /************************************* CHOOSE GROUP AND SAVE DATA START ****************************************/
 var grpwidgets = new Array();
      var group_results = new Array();

    /* 
    * Check if multiple group or not and check if new sub menu items added recently.
    */
    
          var groupwisewidgets = new Array();


         var selected_grptype = $('#wpmm_menu_'+id+' #wpmmm_choose_group option:selected').val();
         if(selected_grptype == "single"){
            $('#wpmm_menu_'+id+' .wpmm_single_group_section').css('display','block');
            $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple').css('display','none');
            $('.multiple_button').hide();
           }else{
            $('#wpmm_menu_'+id+' .wpmm_single_group_section').css('display','none');
            $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple').css('display','block');
            $('.multiple_button').show();
           }
          if(selected_grptype == "multiple"){
                        var group_ref = 1;
                        var group_fields = new Array();
                        $('.wpmm_widgets_setup[data-group-ref="' + group_ref + '"] .wpmm_widget_areaa').each(function () {
                            var field_name = $(this).attr('data-id');
                            group_fields.push(field_name);

                        });

                      var setwidgets = group_fields.join();
                      $('input[data-group-widget-ref="1"]').val(setwidgets);
                        $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                            var groupnum = $(this).attr('data-group-widget-ref');
                             var widgets_det = $(this).val();
                             groupwisewidgets.push({group_no: groupnum,  lists:  widgets_det});

                        });
                       // console.log(groupwisewidgets);
                       
                         var widgetdata = {
                             action: "wpmm_add_selected_widget_lists",
                                 menu_item_id: id, //menu_item_id
                                 widget_details: groupwisewidgets,
                                 group_type: 'multiple',
                             _wpnonce: admin_nonce,
                          // dataType: 'html'
                             };

                         $.post(AjaxUrl, widgetdata, function (response) {
                             $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                             groupwisewidgets = [];
                         });
           }

       $('#wpmm_menu_'+id+' #wpmmm_choose_group').change(function(){
           var grouptype = $(this).val();
           // alert($('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple .wpmm-groups-lists').children().length);
           // return false;

                   if(grouptype == "single"){
                    $('#wpmm_menu_'+id+' .wpmm_single_group_section').css('display','block');
                    $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple').css('display','none');
                    $('.multiple_button').hide();
                   }else{
                    $('#wpmm_menu_'+id+' .wpmm_single_group_section').css('display','none');
                    $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple').css('display','block');
                    $('.multiple_button').show();
                   }


                   $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                   $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                   var menutypee = $('#wpmm_menu_'+id+' #wpmm_enable_mega_menu').val();

                   if(grouptype == "multiple"){
                      $('#wpmm_menu_'+id+' .wpmm-groups-lists .wpmm-group-trigger').each(function(){
                        var group_num = $(this).attr('data-group-ref');
                        var group_column = $(this).attr('data-columns');
                         group_results.push({group_no: group_num,  column:  group_column});
                    });
                    // $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple .wpmm-groups-lists').children().length >= 1 && 
                    
                    // group_results.push({group_no: 1,  column:  2});

                   }  

                 
                 /* insert sub menu data for first time as multiple group selected start*/
                    var first_group_fields = new Array();
                    $('.wpmm_widgets_setup[data-group-ref=1] .wpmm_widget_areaa').each(function () {
                        var field_name = $(this).attr('data-id');
                        first_group_fields.push(field_name);

                    });

                  var setwidgets = first_group_fields.join();
                  $('input[data-group-widget-ref="1"]').val(setwidgets);
                   /* insert sub menu data for first time as multiple group selected end*/

                  $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                        var groupnum = $(this).attr('data-group-widget-ref');
                         var widgets_det = $(this).val();
                         grpwidgets.push({group_no: groupnum,  lists:  widgets_det});

                    });

                // console.log(grpwidgets);
                // console.log(grpwidgets.length);

                if (typeof grpwidgets !== 'undefined' && grpwidgets.length > 0) {
               // the array is defined and has at least one element
                 var ww = grpwidgets;
                 var checked = "grouplists";
                }else{
                    var ww = $('.wpmm_widgetlists').val();
                    var checked = "nogrouplists";
                }



      
            var menu_type_data = {
                action: "wpmm_save_menuitem_settings",
                 wpmm_settings: { 
                 menu_type: menutypee,
                 group_type: grouptype,
                 total_results : group_results,
                 submenulists: ww,
                 checked_lists: checked
             },
                wpmm_menu_item_id: id,
                _wpnonce: admin_nonce
            };
            $.post(AjaxUrl, menu_type_data, function (new_response) {
                group_results = [];
                grpwidgets = [];
                first_group_fields = [];
                 $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');           
            });
       
         });   


         /* CASE 1 END */
   

/**************************************** GROUP SECTION CODE START *************************************************************/


    /*
    *  GROUP COLUMN WISE ADD JQUERY SECTION (ADD)
    */
       $('#wpmm_menu_'+id+' .multiple_button .add-mulitple-group').on('click', function() { 
            $('#wpmm-popup-wrap-'+id).fadeIn(500);
            $('#wpmm-popup-wrap-'+id+' .wpmm-group-title').focus();
            $('#wpmm-popup-wrap-'+id+' #popup_type').val('add');
            $('#wpmm-popup-wrap-'+id+' .wpmm-add-group-btn').val('ADD GROUP');
            $('#wpmm-popup-wrap-'+id+' #wpmm_columns-num option[value=2]').attr('selected','selected');
            var totl_group =  $('#wpmm_menu_'+id+' .wpmm-field-total-group').val();
            var totalset_count = $("#wpmm_menu_"+id+" .wpmm-groups-lists li").length;

             if(totalset_count == 0){
                var new_group = parseInt(totl_group) + 1;
             }else{
                 var new_group = parseInt(totalset_count) + 1;
             }
             $('#wpmm-popup-wrap-'+id+' .wpmm-group-title').val('Group '+new_group);
       });
    /*
    *  GROUP COLUMN WISE ADD JQUERY SECTION (EDIT)
    */
   $('#wpmm_menu_'+id+' .wpmm-groups-lists').on('click','span.wpmm-group-column-editer', function(){
        var groupnumber = $(this).parent().attr('data-group-name');
        var groupinnumber = $(this).parent().attr('data-group-ref');
        var original_groupcol = $(this).parent().attr('data-columns');
            $('#wpmm-popup-wrap-'+id).fadeIn(500);
            $('#wpmm-popup-wrap-'+id+' .wpmm-group-title').focus();
            $('#wpmm-popup-wrap-'+id+' #popup_type').val('edit');
            $('#wpmm-popup-wrap-'+id+' .wpmm-group-title').val(groupnumber);
            $('#wpmm-popup-wrap-'+id+' .wpmm_group_in_number').val(groupinnumber);
            $('#wpmm-popup-wrap-'+id+' .wpmm-add-group-btn').val('EDIT GROUP');
            $('#wpmm-popup-wrap-'+id+' #wpmm_columns-num option[value='+original_groupcol+']').attr('selected','selected');

    });
    /*
    *  GROUP COLUMN WISE ADD JQUERY SECTION (Hide overlay)
    */
        $('#wpmm_menu_'+id+' .wpmm-overlay').click(function () {
            $('#wpmm_menu_'+id+' .wpmm-popup-wrap').fadeOut(200);
        });

       $('#wpmm_menu_'+id+' .wpmm-add-widget-tool_by_grp').on('click', function() {
        $('#wpmm_menu_'+id).find('.wpmm_widget_iframe').show();
       });

        /*
         *  GROUP COLUMN WISE ADD JQUERY SECTION (SAVE ADDED/EDITED GROUP WISE COLUMN DATA)
        */
        var group_colum_array = new Array();
       var group_widgets = new Array();
       var results = new Array();
       var groups_widgs = new Array();
       $('#wpmm_menu_'+id+' #wpmm-popup-wrap-'+id+' .wpmm-add-group-btn').on('click', function() { 
           var popup_type = $('#wpmm-popup-wrap-'+id+' .wpmm_popup_type').val();
          
               if(popup_type == "edit"){
                var group_numm = $('#wpmm-popup-wrap-'+id+' .wpmm_group_in_number').val();
                 var new_group_column = $('#wpmm_menu_'+id+' #wpmm_columns-num').val();
            
               //multiple
                $('.wpmm-groups-lists li[data-group-ref="'+group_numm+'"]').attr('data-columns',new_group_column);
                $('.wpmm-groups-lists li[data-group-ref="'+group_numm+'"]').find('span.wpmm-group-col').html('( Column '+new_group_column+')');
                $('.wpmm_field_groups[data-group-fields-ref="'+group_numm+'"]').attr('data-group-column-ref',new_group_column);

                $('#wpmm_menu_'+id+' .wpmm_group_add_components').find(".wpmm_widgets_setup[data-group-ref='"+group_numm+"']").attr('data-columns',new_group_column);
                $('#wpmm_menu_'+id+' .wpmm_group_add_components').find(".wpmm_widgets_setup[data-group-ref='"+group_numm+"']").find(".wpmm_widget-total-cols").html(new_group_column);
             

                 $('.wpmm_field_groups').each(function(){
                  var groupnumber = $(this).attr('data-group-fields-ref');
                  var column_number = $(this).attr('data-group-column-ref');
                   group_colum_array.push({group_no: groupnumber,  column:  column_number});
               });

                 $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                        var groupnum = $(this).attr('data-group-widget-ref');
                         var widgets_det = $(this).val();
                         group_widgets.push({group_no: groupnum,  lists:  widgets_det});

                    });
                var total_group = $('#wpmm-group-num-'+id).val();
                 var hide_popup = $(this).parent().parent().parent().attr('class');
                $('.'+hide_popup).fadeOut(200);

                $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                   $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                 var post_data = {
                        action: "wpmm_edit_menu_group_settings",
                        wpmm_group_settings: { totgroup: total_group,
                                              groupwidgets: group_widgets, 
                                             total_group_columns: group_colum_array },
                        wpmm_menu_item_id: id,
                        _wpnonce: admin_nonce
                    };

                      $.post(AjaxUrl, post_data, function (response) {
                         $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                       
                         group_widgets = [];
                         group_colum_array = [];
                      });

         }else{
           //ADD 
                     var total_groups = $('#wpmm_menu_'+id+' .wpmm-field-total-group').val();
                var totalset_count = $("#wpmm_menu_"+id+" .wpmm-groups-lists li").length;
                 if(totalset_count == 0){
                        var new_group = parseInt(total_groups) + 1;
                     }else{
                         var new_group = parseInt(totalset_count) + 1;
                     }

                $('#wpmm_menu_'+id+' .wpmm_mega_settings_multiple').css('display','block');
                var tot_group_column = $('#wpmm_menu_'+id+' #wpmm_columns-num').val();
                if(new_group == 1){
                    var newclass = "wpmm-grp-active-trigger";
                    var style = "";      

                }else{
                    var newclass = '';
                    var style = "style='display:none;'";
                }
      

                var group_trigger_html = '<li data-group-ref="' + new_group + '" data-columns="' + tot_group_column + '" data-group-name="Group '+new_group+'" class="wpmm-group-trigger '+newclass+'">Group ' + new_group + '<br/><span class="wpmm-group-col">( Column '+tot_group_column+' )</span><span class="wpmm-group-column-editer" title='+editmsg+'><i class="fa fa-pencil-square-o"></i></span></li>';
                var group_fields_html = '<input type="hidden" class="wpmm_field_groups" name="wpmm_settings[field_groups][group' + new_group + '_fields]" data-group-fields-ref="' + new_group + '" data-group-column-ref="' + tot_group_column + '" >';
                var group_fields_html2 = '<input type="hidden" class="wpmm_groups_widgets_lists" name="wpmm_settings[widget_groups][group' + new_group + ']" data-group-widget-ref="' + new_group + '">';
               
               
                /*total group modified*/
                $('#wpmm_menu_'+id+' .wpmm-group-field-holder').append(group_fields_html);
                $('#wpmm_menu_'+id+' .wpmm-group-field-holder').append(group_fields_html2);

                $('#wpmm_menu_'+id+' .wpmm-field-total-group').val(new_group);
               
                $('.wpmm-groups-lists').append(group_trigger_html);
               var megatype =  $('#wpmm_menu_'+id+' #wpmm_enable_mega_menu').val();
                 if(megatype == "megamenu"){
                 var classtype = "enabled_megamenu";
               }else{
                 var classtype  = "disabled";
               }
                 var group_details_html =
              '<div id="wpmm_widgets_setup_'+tot_group_column+'" class="wpmm_widgets_setup ui-sortable '+classtype+'" data-group-ref="' + new_group + '" data-columns="'+tot_group_column+'" '+style+'></div>';
               $('#wpmm_menu_'+id+' .wpmm_group_add_components').append(group_details_html);
            
                var cl = $(this).parents().parents().parents().attr('class');
                $('.'+cl).fadeOut(200);

               $('.wpmm_field_groups').each(function(){
                  var groupnumber = $(this).attr('data-group-fields-ref');
                  var column_number = $(this).attr('data-group-column-ref');
                   results.push({group_no: groupnumber,  column:  column_number});
               });
                 $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                    var groupnum = $(this).attr('data-group-widget-ref');
                     var widgets_det = $(this).val();
                     groups_widgs.push({group_no: groupnum,  lists:  widgets_det});

                });

                 //console.log(results);
                   $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                   $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
               /* save added group into db */
                  var post_data = {
                            action: "wpmm_save_menu_group_settings",
                            wpmm_group_settings: { totgroup: new_group, total_results: results ,act : 'add',widget_details:groups_widgs},
                            wpmm_menu_item_id: id,
                            _wpnonce: admin_nonce
                        };

                        $.post(AjaxUrl, post_data, function (response) {
                          $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                          results = [];
                          groups_widgs = [];
                  });

            }

          }); 


         /**
         * Groups Change Trigger
         */
        var resultss = new Array();
        var groups_widgets2 = new Array();
        $('body').on('click', '.wpmm-group-trigger', function () {
            $('.wpmm-group-trigger').removeClass('wpmm-grp-active-trigger');
            $(this).addClass('wpmm-grp-active-trigger');
            var group_ref = $(this).data('group-ref');

            $('#wpmm_menu_'+id+' .wpmm_group_add_components .wpmm_widgets_setup').hide();
            $('#wpmm_menu_'+id+' .wpmm_group_add_components .wpmm_widgets_setup[data-group-ref="' + group_ref + '"]').show();
        });

        /**
         * Group Remover
         */
        $('body').on('click', '.wpmm-group-remover', function () {
             var total_groups = $('#wpmm_menu_'+id+' .wpmm-field-total-group').val();
            // var new_groups = parseInt(total_groups) - 1;
           var new_groups = total_groups;

            if(new_groups == 1){
                 alert('Sorry!!Cannot delete first group.');
            }else{
            var confirmation_message = $(this).data('confirm-message');
            if (confirm(confirmation_message)) {
             
            if (new_groups != 1) {
                $('li[data-group-ref="' + total_groups + '"]').remove();
                $('input[data-group-fields-ref="' + total_groups + '"]').remove();
                $('input[data-group-widget-ref="' + total_groups + '"]').remove();
                  /* delete all widget of this group too */
                    $('.wpmm_widgets_setup[data-group-ref="'+total_groups+'"] .wpmm_widget_areaa').each(function(){
                       var dataid = $(this).attr('data-id');
                       var data = {
                                action: "wpmm_delete_widget",
                                widget_id_base: dataid,
                                _wpnonce: admin_nonce
                            };
                             $.post(AjaxUrl, data, function (delete_response) {
                            });
                    });

                $('div.wpmm_widgets_setup[data-group-ref="' + total_groups + '"]').remove();
                var new_deleted_groups = parseInt(new_groups) - 1;
                $('#wpmm_menu_'+id+' .wpmm-field-total-group').val(new_deleted_groups);
                $('#wpmm_menu_'+id+' .wpmm-group-trigger[data-group-ref="'+new_deleted_groups+'"]').addClass('wpmm-grp-active-trigger');
                $('#wpmm_menu_'+id+' .wpmm_widgets_setup[data-group-ref="'+new_deleted_groups+'"]').show();
             }

               $('.wpmm_field_groups').each(function(){
                  var groupnumber = $(this).attr('data-group-fields-ref');
                  var column_number = $(this).attr('data-group-column-ref');
                   resultss.push({group_no: groupnumber,  column:  column_number});
               });

                $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                        var groupnum = $(this).attr('data-group-widget-ref');
                         var widgets_det = $(this).val();
                         groups_widgets2.push({group_no: groupnum,  lists:  widgets_det});

                    });
           
                   /* save deleted group into db */
                      var post_data = {
                                action: "wpmm_save_menu_group_settings",
                                wpmm_group_settings: { totgroup: new_groups, total_results: resultss ,widget_details: groups_widgets2 ,act : 'delete'},
                                wpmm_menu_item_id: id,
                                _wpnonce: admin_nonce
                            };

                      $.post(AjaxUrl, post_data, function (response) {
                         $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                         $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                        
                         resultss = [];
                         groups_widgets2 = [];
                      });

             } //confirmation_message check end

            }

        });
      
    /**************************************** GROUP SECTION CODE END *************************************************************/

    /* sub menu extra settings*/
       /* $('#wpmm_menu_'+id+' #wpmm_content_type').on('change',function(){
            var vall = $(this).val();
            if(vall == "description_field"){
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','block');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','none');
            }else if(vall == "shortcodes"){
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','block');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','none');
            }else{
                $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','none');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','none');
            }
        });
              var changeval2 =  $('#wpmm_menu_'+id+' #wpmm_content_type option:selected').val();
                if(changeval2 == "description_field"){
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','block');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','none');
            }else if(changeval2 == "shortcodes"){
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','block');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','none');
            }else{
                $('#wpmm_menu_'+id+' .wpmm-extra .toggle_description').css('display','none');
             $('#wpmm_menu_'+id+' .wpmm-extra .toggle_shortcodes').css('display','none');
            }
     */
    /* end*/
                       
     /**************************************** MENU REPLACEMENT JS START *************************************************************/ 
        $('#wpmm_menu_'+id+' #wpmm_choose_menu_type').on('change',function(){
            var change_value = $(this).val();
              fn_check_replacement(id,change_value);
        });
        var changeval =  $('#wpmm_menu_'+id+' #wpmm_choose_menu_type option:selected').val();
        fn_check_replacement(id,changeval);
        /* Case 1: Logo image */
        $('.wpmm_logo_url_button').on('click', function(e){
             e.preventDefault();
             var btnClicked = $( this );
             var text;
             var btnClickedid = $(this).attr('id');
             if(btnClickedid == "customimage"){
              text = "Insert Custom Icon";
             }else{
               text = "Insert Logo Image";
             }
             var image = wp.media({ 
             title: text,
             button: {text: text},
             library: { type: 'image'},
             multiple: false
             }).open()
           .on('select', function(e){

             var uploaded_image = image.state().get('selection').first();
             // console.log(uploaded_image);
             var logo_url = uploaded_image.toJSON().url;
       if(btnClickedid == "customimage"){
            $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-custom-image' ).attr('src',logo_url);
                 $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-customimage-url' ).val(logo_url);
                 if( $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-customimage-url' ).val(logo_url)!=''){
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview3').show(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview3 .remove_custom_image_url').show(); 
                 }
                 else{
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview3').hide(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview3 .remove_custom_image_url').hide(); 
                 } 
           }else{
            $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-logo-image' ).attr('src',logo_url);
                 $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-logo-url' ).val(logo_url);
                 if( $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-logo-url' ).val(logo_url)!=''){
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview2').show(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview2 .remove_logo_image').show(); 
                 }
                 else{
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview2').hide(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview2 .remove_logo_image').hide(); 
                 } 
           }
          });
        });
         $("#wpmm_menu_"+id+" .remove_logo_image").each(function() {
              $(this).on('click',function(e){
                e.preventDefault();
                $(this).parent().find('img').attr('src','');
                $(this).parent().parent().find('.wpmm-logo-url').val('');
                $(this).css('display','none');
                $(this).parent().hide();

             });
           });
         $("#wpmm_menu_"+id+" .remove_custom_image_url").each(function() {
                  $(this).on('click',function(e){
                    e.preventDefault();
                    $(this).parent().find('img').attr('src','');
                    $(this).parent().parent().find('.wpmm-customimage-url').val('');
                    $(this).css('display','none');
                    $(this).parent().hide();

                 });
          });

         /* ADD SINGLE BACKGROUND IMAGE*/
        $('#wpmm_menu_'+id+' .wpmm_bgimage_type').on('change',function(){
                var bgtype = $(this).val();
                if(bgtype == "single_image"){
                    $('#wpmm_menu_'+id+' #wpmm_single_image').show();
                    $('#wpmm_menu_'+id+' .toggle_double_image').hide();
                    $('#wpmm_menu_'+id+' #wpmm_single_image1').show();
                }else{
                    $('#wpmm_menu_'+id+' #wpmm_single_image').hide();
                    $('#wpmm_menu_'+id+' .toggle_double_image').show();
                    $('#wpmm_menu_'+id+' #wpmm_single_image1').hide();
                }
        });
         var selected_bgtype = $('#wpmm_menu_'+id+' .wpmm_bgimage_type option:selected').val();
          if(selected_bgtype == "single_image"){
                $('#wpmm_menu_'+id+' #wpmm_single_image').show();
                $('#wpmm_menu_'+id+' #wpmm_double_image').hide();
                $('#wpmm_menu_'+id+' #wpmm_single_image1').show();
                $('#wpmm_menu_'+id+' .toggle_double_image').hide();
            }else{
                $('#wpmm_menu_'+id+' #wpmm_single_image').hide();
                $('#wpmm_menu_'+id+' #wpmm_single_image1').hide();
                $('#wpmm_menu_'+id+' #wpmm_double_image').show();
                $('#wpmm_menu_'+id+' .toggle_double_image').show();
            }

             $(document).on("click",".wpmm_bgimage_btn",function(e) {
                   e.preventDefault();
                   var btnClicked = $( this );
                   var btnClickedid = $(this).attr('id');
                   var image = wp.media({ 
                   title: 'Insert Background Image',
                   button: {text: 'Insert Background Image'},
                   library: { type: 'image'},
                   multiple: false
                   }).open()
                 .on('select', function(e){
                   var uploaded_image = image.state().get('selection').first();
                   // console.log(uploaded_image);
                   var image_url = uploaded_image.toJSON().url;
                     if(btnClickedid == 'wpmm_doubleimage-1'){
                        
                         $( btnClicked ).parent().find( '.wpmm-sbg-image1' ).attr('src',image_url);
                         $( btnClicked ).parent().find( '.wpmm-sbgimage1' ).val(image_url);
                         if( $( btnClicked ).parent().find( '.wpmm-sbgimage1' ).val(image_url)!=''){
                           $(btnClicked).parent().find('.wpmm-bgimage-preview1').show();
                         }
                         else{
                           $(btnClicked).parent().find('.wpmm-bgimage-preview1').hide();
                         }
                     }else if(btnClickedid == 'wpmm_doubleimage-2'){
                         $( btnClicked ).parent().find( '.wpmm-sbg-image2' ).attr('src',image_url);
                         $( btnClicked ).parent().find( '.wpmm-sbgimage2' ).val(image_url);
                         if( $( btnClicked ).parent().find( '.wpmm-sbgimage2' ).val(image_url)!=''){
                           $(btnClicked).parent().find('.wpmm-bgimage-preview2').show();
                         }
                         else{
                           $(btnClicked).parent().find('.wpmm-bgimage-preview1').hide();
                         }
                     }else{
                         $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-sbg-image' ).attr('src',image_url);
                         $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-sbgimage' ).val(image_url);
                         if( $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-sbgimage' ).val(image_url)!=''){
                           $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-bgimage-preview').show(); 
                         }
                         else{
                           $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-bgimage-preview').hide(); 
                         }
                     }
                   });
                 });
             $("#wpmm_menu_"+id+" .remove_sbg_image_url").each(function() {
                 $(this).on('click',function(e){
                    e.preventDefault();
                    $(this).parent().find('img').attr('src','');
                    $(this).parent().parent().find('.wpmm-sbgimage').val('');
                    $(this).parent().hide(); 
                   // $(this).css('display','none');

                 });
               });
 /**************************************** MENU REPLACEMENT JS END *************************************************************/ 
 /**************************************** TOP SECTION CONTENT FOR MEGAMENU JS START *******************************************/ 
            $('#wpmm_menu_'+id+' #wpmm_choose_topcontent_type').on('change',function(){
                var change_value = $(this).val();
                if(change_value == "text_only"){
                    $('#wpmm_menu_'+id+' .toggle_toptext').show();
                    $('#wpmm_menu_'+id+' .toggle_topimage').hide();
                     $('#wpmm_menu_'+id+' .toggle_html').hide();
                }else if(change_value == "image_only"){
                    $('#wpmm_menu_'+id+' .toggle_toptext').hide();
                    $('#wpmm_menu_'+id+' .toggle_topimage').show();
                     $('#wpmm_menu_'+id+' .toggle_html').hide();
                }else{
                     $('#wpmm_menu_'+id+' .toggle_toptext').hide();
                    $('#wpmm_menu_'+id+' .toggle_topimage').hide();
                     $('#wpmm_menu_'+id+' .toggle_html').show();
                }
            });

            var changeval =  $('#wpmm_menu_'+id+' #wpmm_choose_topcontent_type option:selected').val();
             if(changeval == "text_only"){
                    $('#wpmm_menu_'+id+' .toggle_toptext').show();
                    $('#wpmm_menu_'+id+' .toggle_topimage').hide();
                     $('#wpmm_menu_'+id+' .toggle_html').hide();
                }else if(changeval == "image_only"){
                    $('#wpmm_menu_'+id+' .toggle_toptext').hide();
                    $('#wpmm_menu_'+id+' .toggle_topimage').show();
                     $('#wpmm_menu_'+id+' .toggle_html').hide();
                }else{
                     $('#wpmm_menu_'+id+' .toggle_toptext').hide();
                    $('#wpmm_menu_'+id+' .toggle_topimage').hide();
                     $('#wpmm_menu_'+id+' .toggle_html').show();
                }

            $('.wpmm_image_url_button').on('click', function(e){
                 e.preventDefault();
                 var btnClicked = $( this );
                 var btnClickedid = $(this).attr('id');
                 var image = wp.media({ 
                 title: 'Insert Top Content Image',
                 button: {text: 'Insert Top Content Image'},
                 library: { type: 'image'},
                 multiple: false
                 }).open()
               .on('select', function(e){
                 var uploaded_image = image.state().get('selection').first();
                 // console.log(uploaded_image);
                 var image_url = uploaded_image.toJSON().url;

                 $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-top-image' ).attr('src',image_url);
                 $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-image-url' ).val(image_url);
                 if( $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-image-url' ).val(image_url)!=''){
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview').show(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview .remove_top_image').show(); 
                 }
                 else{
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview').hide(); 
                   $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-image-preview .remove_top_image').hide(); 
                 }  
                 });
               });
        $('#wpmm_menu_'+id+' .wpmm-image-url').each(function(){
             if($(this).val() == ''){
              //  alert($(this).parent().find('.wpmm-image-preview').attr('class'));
                $(this).parent().find('.wpmm-image-preview').hide();
              }else{
                $(this).parent().find('.wpmm-image-preview').show();
              }

        });
 /**************************************** TOP SECTION CONTENT FOR MEGAMENU JS END *******************************************/ 
/**************************************** BOTTOM SECTION CONTENT FOR MEGAMENU JS START ***************************************/ 
        $('#wpmm_menu_'+id+' #wpmm_choose_bottomcontent_type').on('change',function(){
            var change_value = $(this).val();
            if(change_value == "text_only"){
                $('#wpmm_menu_'+id+' .toggle_bottomtext').show();
                $('#wpmm_menu_'+id+' .toggle_bimage').hide();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').hide();
            }else if(change_value == "image_only"){
                $('#wpmm_menu_'+id+' .toggle_bottomtext').hide();
                $('#wpmm_menu_'+id+' .toggle_bimage').show();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').hide();
            }else{
                 $('#wpmm_menu_'+id+' .toggle_bottomtext').hide();
                $('#wpmm_menu_'+id+' .toggle_bimage').hide();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').show();
            }
        });

        var changeval =  $('#wpmm_menu_'+id+' #wpmm_choose_bottomcontent_type option:selected').val();
         if(changeval == "text_only"){
                $('#wpmm_menu_'+id+' .toggle_bottomtext').show();
                $('#wpmm_menu_'+id+' .toggle_bimage').hide();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').hide();
            }else if(changeval == "image_only"){
                $('#wpmm_menu_'+id+' .toggle_bottomtext').hide();
                $('#wpmm_menu_'+id+' .toggle_bimage').show();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').hide();
            }else{
                 $('#wpmm_menu_'+id+' .toggle_bottomtext').hide();
                $('#wpmm_menu_'+id+' .toggle_bimage').hide();
                 $('#wpmm_menu_'+id+' .toggle_bhtml').show();
            }

          $('.wpmm_image_url_bottom').on('click', function(e){
             e.preventDefault();
             var btnClicked = $( this );
             var btnClickedid = $(this).attr('id');
            
             var image = wp.media({ 
             title: 'Insert Bottom Content Image',
             button: {text: 'Insert Bottom Content Image'},
             library: { type: 'image'},
             multiple: false
             }).open()
           .on('select', function(e){
             var uploaded_image = image.state().get('selection').first();
             //console.log(uploaded_image);
             var image_url = uploaded_image.toJSON().url;

             $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-bottom-image' ).attr('src',image_url);
             $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-bimage-url' ).val(image_url);
             if( $( btnClicked ).closest('#wpmm_menu_'+id+' tr#'+btnClickedid).find( '.wpmm-bimage-url' ).val(image_url)!=''){
               $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-bimage-preview').show(); 
             }
             else{
               $('#wpmm_menu_'+id+' tr#'+btnClickedid+' .wpmm-bimage-preview').hide(); 
             }  


             });
           });

            $('#wpmm_menu_'+id+' .wpmm-bimage-url').each(function(){
                   // alert($(this).val());
                   
                     if($(this).val() == ''){
                      //  alert($(this).parent().find('.wpmm-image-preview').attr('class'));
                        $(this).parent().find('.wpmm-bimage-preview').hide();
                      }else{
                        $(this).parent().find('.wpmm-bimage-preview').show();
                      }

             });
                       
           $("#wpmm_menu_"+id+" .remove_top_image").each(function() {
             $(this).on('click',function(e){
                e.preventDefault();
                $(this).parent().find('img').attr('src','');
                $(this).parent().parent().find('.wpmm-image-url').val('');
                $(this).css('display','none');

             });
           });

         $("#wpmm_menu_"+id+" .remove_bottom_image").each(function() {
         $(this).on('click',function(e){
            e.preventDefault();
            $(this).parent().find('img').attr('src','');
            $(this).parent().parent().find('.wpmm-bimage-url').val('');
            $(this).css('display','none');

         });
       });

            megamenu_preview_position(id);
                                           
         /* 
         * Save On click button :id means menu_item_id
         */
         $('#wpmm_menu_'+id+' form').on("submit", function (e) {
           e.preventDefault();
            $('#wpmm_menu_'+id).find('.save_ajax_data').show();
           $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
          var data = $(this).serialize();
          
          var content = $( 'textarea#wpmm_html_content2' ).val();
          var content2 = $( 'textarea#wpmm_html_content1' ).val();
         
         // data = data + '&html_content='+content+'&html_content1='+content2;
           // console.log(data);
           // return false;
          $.post(AjaxUrl, data, function (submit_response) {
          $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
           });
        });
 /**************************************** BOTTOM SECTION CONTENT FOR MEGAMENU JS END ***************************************/                                      
 /**************************************** ICON PICKER TABS SECTION JS START ***************************************/ 
           $('#wpmm_menu_'+id+' .icon-preview').on('click',function(){
            $(this).next('.icon-main').show().slideDown('slow');   
           });
           $('#wpmm_menu_'+id+' .select-icon').on('change',function(){
                var idd = $(this).attr('id');
                if($(this).val()==1){
                    $('.font-awesome-icon').show();
                    $('.genericon-icon').hide();
                    $('.dash-icon').hide();
                    $('.ico-icon').hide();
                      $('.line-icon').hide();
                }else if($(this).val()==2){
                    $('.font-awesome-icon').hide();
                    $('.genericon-icon').show();
                    $('.dash-icon').hide();
                      $('.ico-icon').hide();
                      $('.line-icon').hide();
                }else if($(this).val()==3){
                    $('.font-awesome-icon').hide();
                    $('.genericon-icon').hide();
                    $('.dash-icon').show();
                      $('.ico-icon').hide();
                       $('.line-icon').hide();
                }else if($(this).val()==4){
                    $('.ico-moon').show();
                    $('.genericon-icon').hide();
                    $('.dash-icon').hide();
                    $('.font-awesome-icon').hide();
                    $('.line-icon').hide();
                }
                else if($(this).val()== 5){
                    $('.line-icon').show();
                    $('.ico-moon').hide();
                    $('.genericon-icon').hide();
                    $('.dash-icon').hide();
                  $('.font-awesome-icon').hide();
                }
                $('.icon').show();
                $('.search_icons').val('');
            });

            $('#wpmm_menu_'+id+' .icon').click(function(){
                var class_name =$(this).children().attr('class');
                $('.icon-preview i').attr({'class':class_name});
                $('#wpmm_menu_'+id+' #icon_picker_icon1').val(class_name);
                $('.icon-main').slideToggle('fast');
                $('.search_icons').val('');

            });

            $('#wpmm_menu_'+id+' .search_icons').keyup(function() {
                   var defaultText = $(this).val();
                   var idd = $(this).attr('id');
                   if(defaultText == ''){
                          if(idd == "search_faicons"){
                           $('.font-awesome-icon .icon').show();
                           }else if(idd== "search_gicons"){
                              $('.genericon-icon .icon').show();
                           }else if(idd == "search_icomoonicons"){
                                $('.ico-moon .icon').show();
                           }else if(idd == "search_lineicons"){
                              $('.line-icon .icon').show();
                           }
                           else{
                              $('.dash-icon .icon').show();
                           }

                   }else{
                           if(idd == "search_faicons"){
                            $('.font-awesome-icon .icon').hide();
                            $('.font-awesome-icon #icon-'+defaultText).show();
                           }else if(idd== "search_gicons"){
                            $('.genericon-icon .icon').hide();
                            $('.genericon-icon #icon-'+defaultText).show();
                           }else if(idd == "search_icomoonicons"){
                              $('.ico-moon .icon').hide();
                            $('.ico-moon #icon-'+defaultText).show();
                           }else if(idd == "search_lineicons"){
                              $('.line-icon .icon').hide();
                            $('.line-icon #icon-'+defaultText).show();
                           }
                           else{
                            $('.dash-icon .icon').hide();
                            $('.dash-icon #icon-'+defaultText).show();
                           }
                  }
                
                });

          $(document).mouseup(function (e)
            {
                var container = $(".icon-main");

                if (!container.is(e.target) 
                    && container.has(e.target).length === 0)
                    {
                        container.slideUp('fast');
                        $('.search_icons').val('');
                        $('.icon').show();
                    }
            });
    /**************************************** ICON PICKER TABS SECTION JS END ***************************************/ 
    /**************************************** CHECK MEGAMENU OR FLYOUT TYPE START ***********************************/
     /* 
     * Check Menu type If Megamenu or FLyout And Save Automatic
     */
         var menutype = $('#wpmm_menu_'+id).find('#wpmm_enable_mega_menu').val();
         if(menutype== "megamenu"){
             $('.wpmm_grp_select').show();
            var grouptype = $('#wpmmm_choose_group option:selected').val();
               if(grouptype == 'single'){
                $('.main_widget').show();
                $('.wpmm_single_group_section').show();
               }else{
                 $('.main_widget').show();
               }
         }else{
             $('.wpmm_grp_select').hide();
                $('.main_widget').hide();
                $('.wpmm_single_group_section').hide();
         }
        /* On change Mega menu type as mega menu or flyout Event */
            var menu_type = $('#wpmm_menu_'+id).find('#wpmm_enable_mega_menu');
            menu_type.on('change', function() {
                if ( $(this).val() == 'megamenu' ) { //megamenu
                    $('.wpmm_grp_select').show();
                   var grouptype = $('#wpmmm_choose_group option:selected').val();
                   if(grouptype == 'single'){
                    $('.main_widget').show();
                    $('.wpmm_single_group_section').show();
                   }else{
                     $('.main_widget').show();
                   }
                    
                    $("#wpmm_widgets_setup").removeClass('disabled').addClass('enabled_megamenu');
                   
                    $("#wpmm_widgets_setup2").removeClass('disabled').addClass('enabled_megamenu');
                    $(".wpmm_add_components").removeClass('disabled');
                    $(".wpmm_group_add_components").removeClass('disabled');

                     $(".wpmm_mega_settings_multiple").removeClass('disabled').addClass('enabled_megamenu'); //multiple group
             
                } else { //flyout
                    $('.wpmm_grp_select').hide();
                    $('.main_widget').hide();
                    $('.wpmm_single_group_section').hide();
                    $("#wpmm_widgets_setup").addClass('disabled').removeClass('enabled_megamenu');
                    $("#wpmm_widgets_wpmm_widgets_setup2setup").addClass('disabled').removeClass('enabled_megamenu');
                    $(".wpmm_add_components").addClass('disabled');
                    $(".wpmm_group_add_components").addClass('disabled');

                     $(".wpmm_mega_settings_multiple").addClass('disabled').removeClass('enabled_megamenu'); //multiple group
                    // $('select[name="select-states"]').attr('disabled', 'disabled');
                }

                $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);

                var menu_type_data = {
                    action: "wpmm_save_menuitem_settings",
                    wpmm_settings: { menu_type: $(this).val(), panel_columns: $('#wpmm_menu_'+id+' #wpmm_number_of_columns option:selected').val() },
                    wpmm_menu_item_id: id,
                    _wpnonce: admin_nonce
                };
                $.post(AjaxUrl, menu_type_data, function (new_response) {
                     $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');  
                });

            });
    /**************************************** CHECK MEGAMENU OR FLYOUT TYPE END ***********************************/
   
   /**************************************** CHANGE SINGLE GROUP COLUMN WISE VALUE TO DATABASE START *****************************/
        var get_total_no_of_columns = $('#wpmm_menu_'+id).find('select#wpmm_number_of_columns');
            get_total_no_of_columns.on('change', function() {
            var group_type = $('#wpmm_menu_'+id+' #wpmmm_choose_group option:selected').val();
            var group_no = $('li.wpmm-grp-active-trigger').attr('data-group-ref');   
             if(group_type == "single"){
                $('#wpmm_menu_'+id+' .wpmm_add_components').find("#wpmm_widgets_setup").attr('data-columns', $(this).val());
                $('#wpmm_menu_'+id+' .wpmm_add_components').find(".wpmm_widget-total-cols").html($(this).val());
                $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                var menutype = $('#wpmm_menu_'+id+' #wpmm_enable_mega_menu option:selected').val();
                var post_data = {
                    action: "wpmm_save_menuitem_settings",
                    wpmm_settings: { panel_columns: $(this).val(), menu_type: menutype },
                    wpmm_menu_item_id: id,
                    _wpnonce: admin_nonce
                };
              }else{
                //multiple
               var group_total_column =  $('#wpmm_menu_'+id+' .wpmm_group_add_components').find(".wpmm_widgets_setup").attr('data-columns');
                $('#wpmm_menu_'+id).find(".wpmm_widget-total-cols").html(group_total_column);
                $('#wpmm_menu_'+id+' .wpmm_group_add_components').find('.save_ajax_data').show(); 
                $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                var menutype = $('#wpmm_menu_'+id+' #wpmm_enable_mega_menu option:selected').val();
                var post_data = {
                    action: "wpmm_save_menuitem_settings",
                    wpmm_settings: { group_type: 'multiple', menu_type: menutype  },
                    wpmm_menu_item_id: id,
                    _wpnonce: admin_nonce
                };
            }
             $.post(AjaxUrl, post_data, function (response) {
              $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
            });
        });
  /**************************************** CHANGE SINGLE GROUP COLUMN WISE VALUE TO DATABASE END *****************************/

add_widget_on_click(id);

/**************************************** EACH WIDGETS SORTABLE IN ORDER START **********************************************/

var grptype = $('#wpmm_menu_'+id+' #wpmmm_choose_group option:selected').val();
    

            var widget_area = $('#wpmm_menu_'+id).find('#wpmm_widgets_setup'); //single
            var widget_areaa = $('#wpmm_menu_'+id+' .wpmm_group_add_components').find('.wpmm_widgets_setup'); //multiple
             /* sortable for single group method*/
             widget_area.bind("wpmm_sortupdate_widgets", function () {
              $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
                  $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);
                    var items = [];
                 
                    $(".wpmm_widget_area").each(function() {
                        items.push({
                            'type'  : $(this).attr('data-type'),
                            'order' : $(this).index() + 1,
                            'id'    : $(this).attr('data-id'),
                            'parent_menu_item_id' :id
                        });
                    });
                    $.post(AjaxUrl, {
                        action: "wpmm_reorder_widget_items",
                        menuitems: items,
                        _wpnonce: admin_nonce
                    }, function (wpmm_move_response) {
                        $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow'); 
                    });
            });

           /* sortable for mulitple group method*/
             widget_areaa.sortable({
                    forcePlaceholderSize: true,
                    // containment: "parent",
                    items : '.wpmm_widget_areaa:not(.sub_menu)',
                    cursor: "move",
                    placeholder: "drop-area",
                    update: function (event, ui) {
                        var group_ref = $(this).closest('.wpmm_widgets_setup').data('group-ref');
                        var group_fields_array = [];
                        var count = 0;
                        $('.wpmm_widgets_setup[data-group-ref="' + group_ref + '"] .wpmm_widget_areaa').each(function () {
                            count++;
                            var field_name = $(this).attr('data-id');
                            group_fields_array.push(field_name);

                        });
                        //console.log(group_fields_array);
                     var group_fields = group_fields_array.join();
                     $('input[data-group-widget-ref="'+group_ref+'"]').val(group_fields);

                        $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                            var groupnum = $(this).attr('data-group-widget-ref');
                             var widgets_det = $(this).val();
                             grpwidgets.push({group_no: groupnum,  lists:  widgets_det});

                        });
                       
                         var wdata = {
                                action: "wpmm_add_selected_widget_lists",
                                menu_item_id: id, //menu_item_id
                                widget_details: grpwidgets,
                                group_type: 'multiple',
                                _wpnonce: admin_nonce,
                               // dataType: 'html'
                            };

                        $.post(AjaxUrl, wdata, function (response) {
                            $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                            grpwidgets = [];
                        });
                    }
                }); 

             widget_area.sortable({
                    forcePlaceholderSize: true,
                    // containment: "parent",
                    items : '.wpmm_widget_area:not(.sub_menu)',
                    cursor: "move",
                    placeholder: "drop-area",
                start: function (event, ui) {
                    $(".wpmm_widget_area").removeClass("wpmm_open");
                    ui.item.data('start_position', ui.item.index());
                },
                stop: function (event, ui) {
                    // clean up
                    ui.item.removeAttr('style');

                    var start_position = ui.item.data('start_position');

                    if (start_position !== ui.item.index()) {
                        widget_area.trigger("wpmm_sortupdate_widgets");

                    }
                }
          });

/**************************************** EACH WIDGETS SORTABLE IN ORDER END **********************************************/
/****************************** ADD WIDGETS SECTION ACCORDING TO SINGLE OR MULTIPLE GROUP START *************************/
 var groups_widgets = new Array();
$('#wpmm_menu_'+id+' .wpmm_all_wp_widgets').each(function() {
$(this).on('click', function() { 
    var id_bases =$(this).attr('data-value');
    var widget_title =$(this).attr('data-text');

    $('#wpmm_menu_'+id).find('.save_ajax_data').show(); 
    $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);

    var group_type = $('#wpmm_menu_'+id+' #wpmmm_choose_group option:selected').val();  
    var group_no = $('li.wpmm-grp-active-trigger').attr('data-group-ref'); //visible group number
    var widgets_postdata = {
                action: "wpmm_add_selected_widget",
                id_base: id_bases,
                menu_item_id: id, //menu_item_id
                title: widget_title,
                group_type: group_type,
                group_no: group_no,
                _wpnonce: admin_nonce,
                //dataType: 'html'
            };

      $.post(AjaxUrl, widgets_postdata, function (response) {
         var success = response.success; //display widgets by json
    if(success){
         var widget = $(response.data); //display widgets by json
         if(group_type == "multiple"){
            //multiple
                  var number_of_columns = $('.wpmm-grp-active-trigger').attr('data-columns');
                  widget.find("span.wpmm_widget-total-cols").html(number_of_columns);
                  wpmm_add_events_to_widget(widget,id,group_type);
                  $('#wpmm_menu_'+id+' .wpmm_widgets_setup').find('span.message').hide();
                  $('#wpmm_menu_'+id+' .wpmm_widgets_setup[data-group-ref='+group_no+']').append(widget);
                /**
                 * Group Widgets Builder functionality
                 */
                var widgetid = widget.attr('data-id');
                var active_group_fields = $('input[data-group-widget-ref="' + group_no + '"]').val();
                    if (active_group_fields == '') {
                        $('input[data-group-widget-ref="' + group_no + '"]').val(widgetid);
                    } else {
                        var active_group_fields_array = active_group_fields.split(',');
                        active_group_fields_array.push(widgetid);
                        active_group_fields = active_group_fields_array.join();
                        $('input[data-group-widget-ref="' + group_no + '"]').val(active_group_fields);
                    }  

                   $('.wpmm_widgets_setup').sortable({
                     forcePlaceholderSize: true,
                    // containment: "parent",
                    items : '.wpmm_widget_areaa:not(.sub_menu)',
                    cursor: "move",
                    placeholder: "drop-area",
                    update: function (event, ui) {
                        var group_ref = $(this).closest('.wpmm_widgets_setup').data('group-ref');
                        var group_fields_array = [];
                        var count = 0;
                        $('.wpmm_widgets_setup[data-group-ref="' + group_ref + '"] .wpmm_widget_areaa').each(function () {
                            count++;
                            var field_name = $(this).attr('data-id');
                            group_fields_array.push(field_name);

                        });
                        //console.log(group_fields_array);
                     var group_fields = group_fields_array.join();
                     $('input[data-group-widget-ref="'+group_ref+'"]').val(group_fields);

                       //widget_area.trigger("wpmm_sortupdate_widgets"); // to make sortable widgets

                        $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                            var groupnum = $(this).attr('data-group-widget-ref');
                             var widgets_det = $(this).val();
                             grpwidgets.push({group_no: groupnum,  lists:  widgets_det});

                        });
                       
                         var wdata = {
                                action: "wpmm_add_selected_widget_lists",
                                menu_item_id: id, //menu_item_id
                                widget_details: grpwidgets,
                                group_type: 'multiple',
                                _wpnonce: admin_nonce,
                               // dataType: 'html'
                            };

                        $.post(AjaxUrl, wdata, function (response) {
                            //$('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                            grpwidgets = [];
                        });
                    }
                    });

                    $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                        var groupnum = $(this).attr('data-group-widget-ref');
                         var widgets_det = $(this).val();
                         groups_widgets.push({group_no: groupnum,  lists:  widgets_det});

                    });


                  var widgetsdata = {
                        action: "wpmm_add_selected_widget_lists",
                        menu_item_id: id, //menu_item_id
                        widget_details: groups_widgets,
                        group_type: group_type,
                        _wpnonce: admin_nonce,
                       // dataType: 'html'
                    };

                    $.post(AjaxUrl, widgetsdata, function (response) {
                        $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                        groups_widgets = [];
                    });

            
              

               }else{
                //single
                       var number_of_columns = $('#wpmm_menu_'+id).find('#wpmm_number_of_columns option:selected').val();
                        widget.find("span.wpmm_widget-total-cols").html(number_of_columns);
                            wpmm_add_events_to_widget(widget,id,group_type);
                            $('#wpmm_menu_'+id+' #wpmm_widgets_setup').find('span.message').hide();
                            $('#wpmm_menu_'+id+' #wpmm_widgets_setup').append(widget);
                             widget_area.trigger("wpmm_sortupdate_widgets");
                            $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
             }

         }

            }); 

        });

      }); 


              $('.wpmm_widget_area', widget_area).each(function() {
                 wpmm_add_events_to_widget($(this),id,'single');
               });

                $('.wpmm_widget_areaa', widget_areaa).each(function() {
                 wpmm_add_events_to_widget($(this),id,'multiple');
               });
                               
            // fix for WordPress 4.8 widgets when lightbox is opened, closed and reopened
                    if (wp.textWidgets !== undefined) {
                        wp.textWidgets.widgetControls = {}; // WordPress 4.8 Text Widget
                    }

                    if (wp.mediaWidgets !== undefined) {
                        wp.mediaWidgets.widgetControls = {}; // WordPress 4.8 Media Widgets
                    }

            }
        });
    });

    $('.item-title', menu_item).append(button);
    });  // menu item each end
 /****************************** ADD WIDGETS SECTION ACCORDING TO SINGLE OR MULTIPLE GROUP END *************************/
 /************************************* PREVIEW POSITION OF MEGAMENU **************************************************/
    function megamenu_preview_position(id){
         $('#wpmm_menu_'+id+' select.wpmm_position').on('change',function(){
            $('#wpmm_menu_'+id+' .show_megamenu_position_type').show('slow'); 
            var previewid = $(this).val();
            $('#wpmm_menu_'+id+' .wpmm_preview_position').css('display','none');
            $('#wpmm_menu_'+id+' .wpmm_preview_position#preview_'+previewid).show();
         });

        var positionid = $('#wpmm_menu_'+id+' select.wpmm_position').val();
        $('#wpmm_menu_'+id+' .show_megamenu_position_type').show('slow');
        $('#wpmm_menu_'+id+' .wpmm_preview_position').css('display','none');
        $('#wpmm_menu_'+id+' .wpmm_preview_position#preview_'+positionid).show();


        //megamenu vertical preview
          $('#wpmm_menu_'+id+' select.wpmm_vposition').on('change',function(){
                $('#wpmm_menu_'+id+' .show_megamenu_vposition_type').show('slow');
                var previewid2 = $(this).val();
                $('#wpmm_menu_'+id+' .wpmm_preview_vposition').css('display','none');
                $('#wpmm_menu_'+id+' .wpmm_preview_vposition#preview_'+previewid2).show();
             });

        var positionid2 = $('#wpmm_menu_'+id+' select.wpmm_vposition').val();
        $('#wpmm_menu_'+id+' .show_megamenu_vposition_type').show('slow');
        $('#wpmm_menu_'+id+' .wpmm_preview_vposition').css('display','none');
        $('#wpmm_menu_'+id+' .wpmm_preview_vposition#preview_'+positionid2).show();

         //flyout horizontal preview
          $('#wpmm_menu_'+id+' select.wpmm_flyposition').on('change',function(){
                $('#wpmm_menu_'+id+' .show_flyposition_type').show('slow');
                var previewid3 = $(this).val();
                $('#wpmm_menu_'+id+' .wpmm_preview_flyposition').css('display','none');
                $('#wpmm_menu_'+id+' .wpmm_preview_flyposition#preview2_'+previewid3).show();
             });

            var positionid3 = $('#wpmm_menu_'+id+' select.wpmm_flyposition').val();
            $('#wpmm_menu_'+id+' .show_flyposition_type').show('slow');
            $('#wpmm_menu_'+id+' .wpmm_preview_flyposition').css('display','none');
            $('#wpmm_menu_'+id+' .wpmm_preview_flyposition#preview2_'+positionid3).show();

           //flyout vertical preview
              $('#wpmm_menu_'+id+' select.wpmm_flyoutvposition').on('change',function(){
              $('#wpmm_menu_'+id+' .show_megamenu_flyvposition_type').show('slow');
              var previewid4 = $(this).val();
              $('#wpmm_menu_'+id+' .wpmm_preview_flyvposition').css('display','none');
              $('#wpmm_menu_'+id+' .wpmm_preview_flyvposition#preview3_'+previewid4).show();
         });

    var positionid4 = $('#wpmm_menu_'+id+' select.wpmm_flyoutvposition').val();
    $('#wpmm_menu_'+id+' .show_megamenu_flyvposition_type').show('slow');
    $('#wpmm_menu_'+id+' .wpmm_preview_flyvposition').css('display','none');
    $('#wpmm_menu_'+id+' .wpmm_preview_flyvposition#preview3_'+positionid4).show();

         /* icon settings start*/
         $('#wpmm_menu_'+id+' a.wpmm_iconpicker').on('click',function(){
             if($("#wpmm_menu_"+id+ " .show_available_icons").is(':visible'))
            {
             $(this).parent().find('.show_available_icons').animate({ width: 'hide' });
            }
            else
            {
             $(this).parent().find('.show_available_icons').animate({ width: 'show' });
            }
          
          });

           $('#wpmm_menu_'+id+' .show_available_icons a').click(function (e) {
                e.preventDefault();
                $('#wpmm_menu_'+id+' .show_available_icons a').removeClass('active_icons');
                $(this).addClass('active_icons');
                var attr_class = $(this).find('i').attr('class').replace('fa-3x', '');
                $('#wpmm_menu_'+id+' .wpmm_show_choosed_icons').css('display','block');
                var append_html = '<i class="' + attr_class + '"></i>';
                $('#wpmm_menu_'+id+' .wpmm_show_choosed_icons').html(append_html);
                $('#wpmm_menu_'+id+' input#selected_font_icon').val(attr_class);

                
                
            });
         /* icon settings end */
         /* upload sub menu image */
            $('#wpmm_menu_'+id+' select.wpmm_textposition').on('change',function(){
                    $('#wpmm_menu_'+id+' .show_text_position').show('slow');
                    var textposition = $(this).val();
                    $('#wpmm_menu_'+id+' .wpmm_preview_textposition').css('display','none');
                    $('#wpmm_menu_'+id+' .wpmm_preview_textposition#preview_'+textposition).show();
          });

    var txt_position = $('#wpmm_menu_'+id+' select.wpmm_textposition').val();
    $('#wpmm_menu_'+id+' .show_text_position').show('slow');
    $('#wpmm_menu_'+id+' .wpmm_preview_textposition').css('display','none');
    $('#wpmm_menu_'+id+' .wpmm_preview_textposition#preview_'+txt_position).show();  


    }
  /************************************* PREVIEW POSITION OF MEGAMENU END **************************************************/
 /************************************* SHOW WIDGETS LISTS FRAME ON CLICK ADD WIDGET BUTTON START *************************/
function add_widget_on_click (id) {
      $('#wpmm_menu_'+id+' .wpmm-add-widget-tool').on('click', function() {
      $('#wpmm_menu_'+id).find('.wpmm_widget_iframe').show();
      });

      $('#wpmm_menu_'+id+' .btn_close_me > span').on('click', function() {
         $(this).parent().parent().parent().parent().parent().find('.wpmm_widget_iframe').hide('slow');
      });

        $( '#wpmm_menu_'+id+' .wpmm_tabss' ).on('click', function() {
              $('.wpmm_tabss').removeClass('active');
             var tab_id = $(this).attr('id');
             $(this).addClass('active');
             $('#wpmm_menu_'+id+' .tab-panes').css('display','none');
             $('#wpmm_menu_'+id+' .widget_right_section #tabs_'+tab_id).css('display','block');
       });
       $('#wpmm_menu_'+id+' .wpmm_tabss').each(function() {
              if($( this).hasClass( "active" )){
                var tabid = $(this).attr('id');
                $('#wpmm_menu_'+id+' .tab-panes').css('display','none');
                $('#wpmm_menu_'+id+' .widget_right_section #tabs_'+tabid).css('display','block');
              }

            });
    } 
        /****************** END******************/
 /************************************* EACH WIDGET EXPAND/DELETE/SAVE/EDITCONTRACT PROCESS START *************************/
     var wpmm_add_events_to_widget = function (widget,id,grouptypee) {
            var widget_title = widget.find(".widget_title span.wptitle");
            var widget_id = widget.attr("data-id");
            var type = widget.attr('data-type');


            widget.find(".wpmm_widget-expand").on("click", function () {
                var grptypee = $('#wpmmm_choose_group').val();  
                var columns = parseInt(widget.attr("data-columns"), 10);  // current colums of widget
                
                if(grptypee == "single"){
                  var maximum_columns = parseInt($("#wpmm_number_of_columns option:selected").val(), 10); //total columns
                }else{
                  var maximum_columns = parseInt($(".wpmm-groups-lists .wpmm-grp-active-trigger").attr('data-columns'), 10); //total columns
                }
                if (maximum_columns > columns) {
                    columns = columns + 1;

                    widget.attr("data-columns", columns);

                    $('.wpmm_widget-num-cols', widget).html(columns);

                         $('#wpmm_menu_'+id).find('.save_ajax_data').show();
                         $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);

                    if (type == 'wp_widget') {
                        $.post(AjaxUrl, {
                            action: "wpmm_selected_update_widget",
                            widget_unique_id: widget_id,
                            columns: columns,
                            group_type: grptypee,
                            _wpnonce: admin_nonce
                        }, function (expandresponse) {
                            $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                        });

                    }
                    if (type == 'wpmm_menu_subitem' ) {
                        $.post(AjaxUrl, {
                            action: "wpmm_update_menu_item_columns",
                            sub_menu_id: widget_id,
                            columns: columns,
                             group_type: grptypee,
                            _wpnonce: admin_nonce
                        }, function (contract_response) {
                           $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');

                        });

                    }

                }
            });

             widget.find(".wpmm_widget-contract").on('click',function(){
               
                  var columns = parseInt(widget.attr("data-columns"), 10);
                
                
                // account for widgets that have say 8 columns but the panel is only 6 wide
                var grptypee = $('#wpmmm_choose_group').val();  

                if(grptypee == "single"){
                  var maxcols = parseInt($("#wpmm_number_of_columns option:selected").val(), 10); //total columns
                }else{
                  var maxcols = parseInt($(".wpmm-groups-lists .wpmm-grp-active-trigger").attr('data-columns'), 10); //total columns
                }

                if (columns > maxcols) {
                    columns = maxcols;
                }

                if (columns > 1) {
                    columns = columns - 1;
                    widget.attr("data-columns", columns);

                    $('.wpmm_widget-num-cols', widget).html(columns);
                } else {
                    return;
                }

             $('#wpmm_menu_'+id).find('.save_ajax_data').show();
             $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);

                if (type == 'wp_widget') {
               
                    $.post(ajaxurl, {
                        action: "wpmm_selected_update_widget",
                        widget_unique_id: widget_id,
                        columns: columns,
                        group_type: grptypee,
                        _wpnonce: admin_nonce
                    }, function (contract_response) {
                     if(contract_response){
                         $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                     }
                       
                    });

                }

                if (type == 'wpmm_menu_subitem') {
  
                    $.post(AjaxUrl, {
                        action: "wpmm_update_menu_item_columns",
                        sub_menu_id: widget_id,
                        columns: columns,
                        group_type: grptypee,
                        _wpnonce: admin_nonce
                    }, function (cresponse) {
                         $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                    });

                }

             });
            var grp_widgets = new Array();
            // for edit widget data
        
              widget.find(".wpmm_widget-action").on('click',function(){
                //console.log(widget);
               // $abc = widget;
               
                // $abc.trigger('widget-added');

                    if (! widget.hasClass("wpmm_open") && ! widget.data("wpmm_loaded")) {
                    widget_title.addClass('wpmm_loading');
                    // widget.addClass('wpmm_open');
            
                    // retrieve the widget settings form
                    $.post(AjaxUrl, {
                        action: "wpmm_edit_widget_data",
                        widget_id_base: widget_id,
                        _wpnonce: admin_nonce,
                        dataType : 'html'
                    }, function (response) {
                        //alert(response);

                        var $response = $(response);
                        var $form = $response.find('form');


                        // bind delete button action
                        $(".wpmm_delete", $form).on("click", function (e) {
                            e.preventDefault();
                            
                            var data = {
                                action: "wpmm_delete_widget",
                                widget_id_base: widget_id,
                                _wpnonce: admin_nonce
                            };

                            $.post(AjaxUrl, data, function (delete_response) {
                               
                                if(grouptypee == "multiple"){
                                 var grpno = $('li.wpmm-grp-active-trigger').attr('data-group-ref'); //visible group number
                                 var widget_lists = $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists[data-group-widget-ref="'+grpno+'"]').val();
                                 var returndata = removeValue(widget_lists, widget_id);
                                 $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists[data-group-widget-ref="'+grpno+'"]').val(returndata);
                                    widget.remove();
                             $('#wpmm_menu_'+id+' .wpmm_groups_widgets_lists').each(function(){
                                    var groupnum = $(this).attr('data-group-widget-ref');
                                     var widgets_det = $(this).val();
                                     grp_widgets.push({group_no: groupnum,  lists:  widgets_det});

                                });
                               //console.log(grp_widgets);
                                    var wdata = {
                                    action: "wpmm_add_selected_widget_lists",
                                    menu_item_id: id, //menu_item_id
                                    widget_details: grp_widgets,
                                    group_type: grouptypee,
                                    _wpnonce: admin_nonce,
                                   // dataType: 'html'
                                };

                                $.post(AjaxUrl, wdata, function (response) {

                                    $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                                    grp_widgets = [];

                                });

                                }else{
                                    widget.remove();
                                }
                                
                               
                              
                            });

                        });

                        // bind close button action
                        $(".wpmm_close", $form).on("click", function (e) {
                            e.preventDefault();
                            widget.toggleClass("wpmm_open");
                        });

                        // bind save button action
                        $form.on("submit", function (e) {
                            e.preventDefault();

                            var dataa = $(this).serialize();
                            // alert(dataa);

                             $('#wpmm_menu_'+id).find('.save_ajax_data').show();
                             $('#wpmm_menu_'+id).find('.saving_message').text(saving_data);

                            $.post(AjaxUrl, dataa, function (submit_response) {
                               // console.log(submit_response);
                                $('#wpmm_menu_'+id).find('.save_ajax_data').fadeOut('slow');
                               
                            });

                        });

                        widget.find(".wpmm_widget_inner").html($response);

                        widget.data("wpmm_loaded", true).toggleClass("wpmm_open");

                        widget_title.removeClass('wpmm_loading');


                        // Init Black Studio TinyMCE
                        if ( widget.is( '[id^=black-studio-tinymce]' ) ) {
                            bstw( widget ).deactivate().activate();
                        }

                        // setTimeout(function(){
                        //     //$(document).trigger("widget-added", [widget]);
                        //     $(document).on('widget-added', function(event, widget){
                        //         var widget_id = $(widget).attr('id');
                        //         // any code that needs to be run when a new widget gets added goes here
                        //         // widget_id holds the ID of the actual widget that got added
                        //         // be sure to only run the code if one of your widgets got added
                        //         // otherwise the code will be run when any widget is added
                        //         console.log(widget_id);
                        //     });
                        // }, 100);

                        var editorId = widget.find('textarea').attr('id');
                        widget.find('input.title').attr('type','text').addClass('widefat');

                        if ( widget.is( '[id^=text-]' ) ) {
                            if (tinymce.get(editorId)) {
                                wp.editor.remove(editorId);
                            }

                            wp.editor.initialize(editorId, {
                                tinymce: {
                                    wpautop: true,
                                    setup: function (editor) {
                                        editor.on('change', function () {
                                            editor.save();
                                        });
                                    }
                                },
                                quicktags: true
                            });
                        }

                        
                        $('#'+editorId).removeAttr("hidden");


                      // $( document ).trigger( 'widget-added', [widget]);

                    });

                } else {
                 
                    widget.toggleClass("wpmm_open");
                }

                // close all other widgets
                $(".wpmm_widget_area").not(widget).removeClass("wpmm_open");
                $(".wpmm_widget_areaa").not(widget).removeClass("wpmm_open");
                    
              }); 
                 return widget;
        };

 /************************************* EACH WIDGET EXPAND/DELETE/SAVE/EDITCONTRACT PROCESS END *********************************/      

$('.wpmm_menu_wrapper .wpmm_overlay').click(function(){
  $(this).css('display','none');
  $('#wpmm_menu_settings_frame').css('display','none');
  $('.wpmm_menu_wrapper .close_btn').css('display','none');
});
$('.wpmm_menu_wrapper .close_btn').click(function(){
  $(this).css('display','none');
  $('#wpmm_menu_settings_frame').css('display','none');
  $('.wpmm_menu_wrapper .wpmm_overlay').css('display','none');
});


function fn_check_replacement (id,change_value) {
switch(change_value){
        case 'search_type':
           $('#wpmm_menu_'+id+' .toggle_search_form').show();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
        case 'logo_image':
           $('#wpmm_menu_'+id+' .toggle_logo_image').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
         case 'shortcode':
           $('#wpmm_menu_'+id+' .toggle_shortcode').show();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
             case 'woo_cart_total':
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
        case 'woo_wishlist':
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
        case 'login_form':
            $('#wpmm_menu_'+id+' .toggle_login_form').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
        case 'register_form':
           $('#wpmm_menu_'+id+' .toggle_register_form').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
            break;
        case 'fpassword_form':
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').show();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
            break;
       default:
           $('#wpmm_menu_'+id+' .toggle_fpassword_form').hide();
           $('#wpmm_menu_'+id+' .toggle_search_form').hide();
           $('#wpmm_menu_'+id+' .toggle_logo_image').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_cart_total').hide();
           $('#wpmm_menu_'+id+' .toggle_shortcode').hide();
           $('#wpmm_menu_'+id+' .toggle_woo_wishlist').hide();
           $('#wpmm_menu_'+id+' .toggle_login_form').hide();
           $('#wpmm_menu_'+id+' .toggle_register_form').hide();
       break;
        }
}

function removeValue(list, value) {
  return list.replace(new RegExp(",?" + value + ",?"), function(match) {
      var first_comma = match.charAt(0) === ',',
          second_comma;

      if (first_comma &&
          (second_comma = match.charAt(match.length - 1) === ',')) {
        return ',';
      }
      return '';
    });
};



});

