<?php 
if ( ! defined( 'ABSPATH' ) )
    exit;
global $wpdb;
$xyz_wpf_filter_name="";
$category_selectedOptions="";
$xyz_wpf_category_select="";
$tag_selectedOptions="";
$xyz_wpf_category_post_from="";
$xyz_wpf_tag_select="";
$author_selectedOptions="";
$xyz_wpf_tag_post_from="";
$xyz_wpf_author_select="";
$xyz_wpf_no_of_posts="";
$xyz_wpf_skip_posts="";
$xyz_wpf_pagination="";
$xyz_wpf_pagination_limit="";
$xyz_wpf_sortby="";
$xyz_wpf_orderby="";
$xyz_wpf_display_format="";
$xyz_wpf_status="";
$dummy_for_category="";
$dummy_for_tag="";
$dummy_for_author="";
$flag_for_sh_pg_lmt= $f = 0;
if($_POST)
{
    if (! isset( $_REQUEST['_wpnonce'] )|| !wp_verify_nonce( $_REQUEST['_wpnonce'],'fltr-add_')){
        wp_nonce_ays( 'fltr-add_' );
        exit;
    }
    if(isset($_POST['dummy_for_category']))
        $dummy_for_category=sanitize_text_field($_POST['dummy_for_category']);
    if(isset($_POST['dummy_for_tag']))
        $dummy_for_tag=sanitize_text_field($_POST['dummy_for_tag']);
    if(isset($_POST['dummy_for_author']))
        $dummy_for_author=sanitize_text_field($_POST['dummy_for_author']);
    if(isset($_POST['xyz_wpf_filter_name']))
        $xyz_wpf_filter_name=sanitize_text_field($_POST['xyz_wpf_filter_name']);
    if(isset($_POST['xyz_wpf_category_select']))
    {
        foreach ($_POST['xyz_wpf_category_select'] as $category_selectedOption)
            $category_selectedOptions.=$category_selectedOption.",";
        $xyz_wpf_category_select=rtrim($category_selectedOptions,',');
    }
    if(isset($_POST['xyz_wpf_category_post_from']))
        $xyz_wpf_category_post_from=sanitize_text_field($_POST['xyz_wpf_category_post_from']);
    if(isset($_POST['xyz_wpf_tag_select']))
    {
        foreach ($_POST['xyz_wpf_tag_select'] as $tag_selectedOption)
            $tag_selectedOptions.=$tag_selectedOption.",";
        $xyz_wpf_tag_select=rtrim($tag_selectedOptions,',');
    }
    if(isset($_POST['xyz_wpf_tag_post_from']))
        $xyz_wpf_tag_post_from=sanitize_text_field($_POST['xyz_wpf_tag_post_from']);
    if(isset($_POST['xyz_wpf_author_select']))
    {
        foreach ($_POST['xyz_wpf_author_select'] as $author_selectedOption)
            $author_selectedOptions.=$author_selectedOption.",";
        $xyz_wpf_author_select=rtrim($author_selectedOptions,',');
    }
    if(isset($_POST['xyz_wpf_skip_posts']))
        $xyz_wpf_skip_posts=intval($_POST['xyz_wpf_skip_posts']);

    

    if(isset($_POST['xyz_wpf_no_of_posts']))
        $xyz_wpf_no_of_posts=intval($_POST['xyz_wpf_no_of_posts']);

    
    if(isset($_POST['xyz_wpf_pagination']))
    {
        $xyz_wpf_pagination=intval($_POST['xyz_wpf_pagination']);
        if($xyz_wpf_pagination==0)
        {
            if(isset($_POST['xyz_wpf_pagination_limit']))
            {
                $flag_for_sh_pg_lmt=0;
                $xyz_wpf_pagination_limit=intval($_POST['xyz_wpf_pagination_limit']);
                
            }
        }
        else 
            $flag_for_sh_pg_lmt=1;
    }
    if(isset($_POST['xyz_wpf_sortby']))
        $xyz_wpf_sortby=sanitize_text_field($_POST['xyz_wpf_sortby']);
    if(isset($_POST['xyz_wpf_orderby']))
        $xyz_wpf_orderby=sanitize_text_field($_POST['xyz_wpf_orderby']);
    if(isset($_POST['xyz_wpf_display_format']))
        $xyz_wpf_display_format=sanitize_text_field($_POST['xyz_wpf_display_format']);

    $xyz_wpf_status=0;
    $ms1="";$erf=0;
    if($xyz_wpf_filter_name=="")
    {
        $ms1="Please fill Filter Name.";
        $erf=1;
    }
    else if($xyz_wpf_display_format=="")
    {
        $ms1="Please fill Display Format..!!";
        $erf=1;
    }
    else 
    {	
        if($f!=1)
        {
            $erf=0;
            $ms1="New Filter added successfully.!";
            $wpdb->query($wpdb->prepare("INSERT INTO `".$wpdb->prefix."xyz_wp_posts_filter`(`xyz_wpf_name`, `xyz_wpf_categories`, `xyz_wpf_cat_post_from`, `xyz_wpf_tags`, `xyz_wpf_tag_post_from`, `xyz_wpf_authors`, `xyz_wpf_skip_posts`, `xyz_wpf_no_of_posts`, `xyz_wpf_pagination`, `xyz_wpf_pagination_limit`, `xyz_wpf_sort`, `xyz_wpf_order`, `xyz_wpf_msg_format`, `xyz_wpf_status`) VALUES (%s,%s,%d,%s,%d,%s,%d,%d,%d,%d,%d,%d,%s,%d)",$xyz_wpf_filter_name,$xyz_wpf_category_select,$xyz_wpf_category_post_from,$xyz_wpf_tag_select,$xyz_wpf_tag_post_from,$xyz_wpf_author_select,$xyz_wpf_skip_posts,$xyz_wpf_no_of_posts,$xyz_wpf_pagination,$xyz_wpf_pagination_limit,$xyz_wpf_sortby,$xyz_wpf_orderby,$xyz_wpf_display_format,$xyz_wpf_status));
            header("Location:".admin_url('admin.php?page=xyz-wpf-filter-manage&msg=1'));
            exit();
        }
    }
    if($erf==1)
    {
?>
<div class="system_notice_area_style0" id="system_notice_area">
    <?php
        echo esc_attr($ms1);
    ?>
    &nbsp;&nbsp;&nbsp;
    <span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
    }
}
?>
<form method="post">
    <?php wp_nonce_field('fltr-add_'); ?>
    <fieldset style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
        <legend>
            <h2 class= "xyz-wpf-hdr">
                Add New Filter
            </h2>
        </legend>
        <span><strong>You have to fill in the following:</strong></span>
        <table class="widefat xyz_wpf_table" style="width: 100%; margin: 0 auto; border-bottom:none; ">
            <tr>
                <td>
                    <div style=" margin-top: 15px; ">
                        Name 
                        <span class="mandatory">*</span>
                    </div>
                </td>
                <td>
                    <input type="text" value="
<?php echo esc_attr($xyz_wpf_filter_name);?>" id="xyz_wpf_filter_name" name="xyz_wpf_filter_name" style=" margin-top: 15px; ">
                </td>
            </tr>
            <tr>
                <td>
                    Category  
                </td>
                <td>
                    <input type="hidden" name="dummy_for_category" id="dummy_for_category" value="">
                    <select multiple onClick="xyz_wpf_set_category_select()" id="xyz_wpf_category_select" name="xyz_wpf_category_select[]"  >
                        <?php $pid=0;$i=0;$taxonomy='category';$catid='';
echo xyz_wpf_get_category_display($pid,$i,$catid,$taxonomy);
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Show category posts from  
                </td>
                <td>
                    <select id="xyz_wpf_category_post_from" name="xyz_wpf_category_post_from"  >  
                        <option value="0" <?php if($xyz_wpf_category_post_from==0){?>selected="selected"<?php }?>>Any Selected Category</option>
                        <option value="1" <?php if($xyz_wpf_category_post_from==1){?>selected="selected"<?php }?>>All Selected Category</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Tag  
                </td>
                <td>
                    <input type="hidden" name="dummy_for_tag" id="dummy_for_tag" value="">
                    <select multiple onClick="xyz_wpf_set_tag_select()" id="xyz_wpf_tag_select" name="xyz_wpf_tag_select[]"  >
                        <?php 
$post_tag='post_tag';
$tagids_frm_term_tax = $wpdb->get_results($wpdb->prepare("SELECT `term_id` FROM `".$wpdb->prefix."term_taxonomy` WHERE `taxonomy`=%s",$post_tag));
foreach ($tagids_frm_term_tax as $tagids)
{
    $tagnames = $wpdb->get_results($wpdb->prepare("SELECT  `term_id`,`name` FROM `".$wpdb->prefix."terms` WHERE `term_id` =%d",$tagids->term_id));
    foreach ($tagnames as $tagname)
    {
                        ?>
                        <option value="<?php echo esc_attr($tagname->term_id);?>" ><?php echo esc_html($tagname->name);?></option>
                        <?php 
    }
}
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Show tag posts from  
                </td>
                <td>
                    <select id="xyz_wpf_tag_post_from" name="xyz_wpf_tag_post_from"  >
                        <option value="0" <?php if($xyz_wpf_tag_post_from==0){?>selected="selected"<?php }?>>Any Selected Tag</option>
                        <option value="1" <?php if($xyz_wpf_tag_post_from==1){?>selected="selected"<?php }?>>All Selected Tag</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Author 
                </td>
                <td>
                    <input type="hidden" name="dummy_for_author" id="dummy_for_author" value="">
                    <select multiple onClick="xyz_wpf_set_author_select()" id="xyz_wpf_author_select" name="xyz_wpf_author_select[]"  >
                        <?php 
$authornames = $wpdb->get_results("SELECT `ID`,`display_name`  FROM `".$wpdb->base_prefix."users`");
foreach ($authornames as $authorname)
{
                        ?>
                        <option value="<?php echo esc_attr($authorname->ID);?>" ><?php echo esc_html($authorname->display_name);?></option>
                        <?php
}
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Posts to be skipped
                </td>
                <td>
                    <input type="text" 
                    <?php if($xyz_wpf_skip_posts==""){?> value="0" 
                    <?php }else{?>value="
<?php echo esc_attr($xyz_wpf_skip_posts);?>"
                    <?php }?> id="xyz_wpf_skip_posts" name="xyz_wpf_skip_posts" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
                </td>
               
            </tr>
            <tr>
                <td>
                    Posts to be shown
                    <br>
                    <span style="color: green;font-size: 11px">[ 0 : Show All Posts ]</span>
                </td>
                <td>
                    <input type="text" 
                    <?php if($xyz_wpf_no_of_posts==""){?> value="0" 
                    <?php }else{?>value="
<?php echo esc_attr($xyz_wpf_no_of_posts);?>"
                    <?php }?> id="xyz_wpf_no_of_posts" name="xyz_wpf_no_of_posts" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
                </td>

            </tr>
            <tr>
                <td>
                    Pagination
                </td>
                <td>
                    <select id="xyz_wpf_pagination" name="xyz_wpf_pagination" onchange="xyz_wpf_pagination_function(this.value)" >
                        <option value="0" <?php if($xyz_wpf_pagination==0){?>selected="selected"<?php }?>>Yes</option>
                        <option value="1" <?php if($xyz_wpf_pagination==1){?>selected="selected"<?php }?>>No</option>
                    </select>
                </td>
            </tr>
            <tr id="row_id_pagination_limit">
                <td>
                    Pagination Limit
                </td>
                <td>
                    <input type="text" 
                    <?php if($xyz_wpf_pagination_limit==""){?> value="20" 
                    <?php }else{?>value="
<?php echo $xyz_wpf_pagination_limit;?>"
                    <?php }?> id="xyz_wpf_pagination_limit" name="xyz_wpf_pagination_limit" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
                </td>

            </tr>
            <tr>
                <td>
                    Sortby
                </td>
                <td>
                    <select id="xyz_wpf_sortby" name="xyz_wpf_sortby"  >
                        <option value="0" <?php if($xyz_wpf_sortby==0){?>selected="selected"<?php }?>>Publish Date</option>
                        <option value="1" <?php if($xyz_wpf_sortby==1){?>selected="selected"<?php }?>>Updated Date</option>
                    </select>
                    &nbsp;
                    <select id="xyz_wpf_orderby" name="xyz_wpf_orderby"  >
                        <option value="0" <?php if($xyz_wpf_orderby==0){?>selected="selected"<?php }?>>Asc</option>
                        <option value="1" <?php if($xyz_wpf_orderby==1){?>selected="selected"<?php }?>>Desc</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Display Format 
                    <span class="mandatory">*</span>
                </td>
                <td>
                    <select name="xyz_wpf_display_format_select" id="xyz_wpf_display_format_select" onchange="xyz_wpf_display_format_insert(this);">
                        <option value ="0" selected="selected">Select</option>
                        <option value ="1">{POST_TITLE}  </option>
                        <option value ="2">{PERMALINK} </option>
                        <option value ="3">{POST_EXCERPT}  </option>
                        <option value ="4">{POST_CONTENT}   </option>
                        <option value ="5">{BLOG_TITLE}   </option>
                        <option value ="6">{USER_NICENAME}   </option>
                        <option value ="7">{POST_ID}    </option>
                        <option value ="8">{POST_TAGS}    </option>
                        <option value ="9">{POST_CATEGORY}    </option>
                        <option value ="10">{POST_FEATURED_IMAGE}    </option>
                        <option value ="11">{POST_PUBLISH_DATE}</option>
                        <option value ="12">{POST_UPDATE_DATE}</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    <textarea id="xyz_wpf_display_format" name="xyz_wpf_display_format"	><?php echo esc_textarea($xyz_wpf_display_format);?></textarea>
                </td>
            </tr>
            <tr>
                <td id="bottomBorderNone">
                    &nbsp;
                </td>
                <td id="bottomBorderNone" style="height: 50px">
                    <input type="submit" class="submit_wpf_new" style=" margin-top: 10px; " name="submit_wpf_new_filter" value="Save" />
                </td>
            </tr>
        </table>
    </fieldset>
</form>
<script type="text/javascript">
    jQuery(document).ready(function() 
                           {
                               var selected_category_vals="<?php echo $dummy_for_category;?>";
                               if(selected_category_vals=="")
                                   jQuery("#xyz_wpf_category_select option[value='1']").prop("selected", true);
                               jQuery.each(selected_category_vals.split(","), function(i1,e1)
                                           {
                                               jQuery("#xyz_wpf_category_select option[value='" + e1 + "']").prop("selected", true);
                                           }
                                          );
                               xyz_wpf_set_category_select();
                               var selected_tag_vals="<?php echo $dummy_for_tag;?>";
                               jQuery.each(selected_tag_vals.split(","), function(i2,e2)
                                           {
                                               jQuery("#xyz_wpf_tag_select option[value='" + e2 + "']").prop("selected", true);
                                           }
                                          );
                               xyz_wpf_set_tag_select();
                               var selected_author_vals="<?php echo $dummy_for_author;?>";
                               jQuery.each(selected_author_vals.split(","), function(i3,e3)
                                           {
                                               jQuery("#xyz_wpf_author_select option[value='" + e3 + "']").prop("selected", true);
                                           }
                                          );
                               xyz_wpf_set_author_select();
                               var flag_for_sh_pg_lmt="<?php echo $flag_for_sh_pg_lmt;?>";
                               if(flag_for_sh_pg_lmt==1)
                                   jQuery("#row_id_pagination_limit").hide();
                               else
                                   jQuery("#row_id_pagination_limit").show();
                           }
                          );
    function xyz_wpf_display_format_insert(inf)
    {
        var e = document.getElementById("xyz_wpf_display_format_select");
        var ins_opt = e.options[e.selectedIndex].text;
        if(ins_opt=="0")
            ins_opt="";
        var str=jQuery("textarea#xyz_wpf_display_format").val()+ins_opt;
        jQuery("textarea#xyz_wpf_display_format").val(str);
        jQuery('#xyz_wpf_display_format_select :eq(0)').prop('selected', true);
        jQuery("textarea#xyz_wpf_display_format").focus();
    }
    function xyz_wpf_set_category_select()
    {
        var sel_category_vals = [];
        jQuery('#xyz_wpf_category_select :selected').each(function(j1, selected){
            sel_category_vals[j1] = jQuery(selected).val();
        }
                                                         );
        jQuery("#dummy_for_category").val(sel_category_vals);
    }
    function xyz_wpf_set_tag_select()
    {
        var sel_tag_vals = [];
        jQuery('#xyz_wpf_tag_select :selected').each(function(j2, selected){
            sel_tag_vals[j2] = jQuery(selected).val();
        }
                                                    );
        jQuery("#dummy_for_tag").val(sel_tag_vals);
    }
    function xyz_wpf_set_author_select()
    {
        var sel_author_vals = [];
        jQuery('#xyz_wpf_author_select :selected').each(function(j3, selected){
            sel_author_vals[j3] = jQuery(selected).val();
        }
                                                       );
        jQuery("#dummy_for_author").val(sel_author_vals);
    }
    function xyz_wpf_pagination_function(act)
    {
        if(act==1)
            jQuery("#row_id_pagination_limit").hide();
        else
            jQuery("#row_id_pagination_limit").show();
    }
</script>
<?php ?>