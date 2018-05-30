<?php 
if (!defined( 'ABSPATH' ))
     exit;

global $wpdb;
$id= '';
$ms1="";$ms2="";$ms3="";
if(isset($_GET['id'])){
	$id = intval($_GET['id']);
}

$xyz_wpf_filter_id=$id;
$xyz_wpf_filter_name= '';
$xyz_wpf_filter_status= '';
$xyz_wpf_category_select= '';
$xyz_wpf_category_post_from= '';
$xyz_wpf_tag_select= '';
$xyz_wpf_tag_post_from= '';
$xyz_wpf_author_select= '';
$xyz_wpf_skip_posts="";
$xyz_wpf_no_of_posts= '';
$xyz_wpf_pagination= '';
$xyz_wpf_pagination_limit= '';
$xyz_wpf_sortby= '';
$xyz_wpf_orderby= '';
$xyz_wpf_display_format= '';
$error_pag = $error_postnum = $error_postskip = "";
$f = 0;
?>
<fieldset style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
<legend><h2 class= "xyz-wpf-hdr">Edit Filter</h2></legend>
<span><strong>You have to fill in the following:</strong></span>
<?php
$xyz_wpf_manage_detail=$wpdb->get_row($wpdb->prepare("SELECT * FROM `".$wpdb->prefix."xyz_wp_posts_filter` WHERE `id`=%d ORDER BY id DESC",$id));
	$xyz_wpf_filter_name=$xyz_wpf_manage_detail->xyz_wpf_name;
	$xyz_wpf_filter_status=$xyz_wpf_manage_detail->xyz_wpf_status;
	$xyz_wpf_category_select=$xyz_wpf_manage_detail->xyz_wpf_categories;
	$xyz_wpf_category_post_from=$xyz_wpf_manage_detail->xyz_wpf_cat_post_from;
	$xyz_wpf_tag_select=$xyz_wpf_manage_detail->xyz_wpf_tags;
	$xyz_wpf_tag_post_from=$xyz_wpf_manage_detail->xyz_wpf_tag_post_from;
	$xyz_wpf_author_select=$xyz_wpf_manage_detail->xyz_wpf_authors;
	$xyz_wpf_skip_posts=$xyz_wpf_manage_detail->xyz_wpf_skip_posts;
	$xyz_wpf_no_of_posts=$xyz_wpf_manage_detail->xyz_wpf_no_of_posts;
	$xyz_wpf_pagination=$xyz_wpf_manage_detail->xyz_wpf_pagination;
	$xyz_wpf_pagination_limit=$xyz_wpf_manage_detail->xyz_wpf_pagination_limit;
	$xyz_wpf_sortby=$xyz_wpf_manage_detail->xyz_wpf_sort;
	$xyz_wpf_orderby=$xyz_wpf_manage_detail->xyz_wpf_order;
	$xyz_wpf_display_format=$xyz_wpf_manage_detail->xyz_wpf_msg_format;
	
	
	if(isset($_POST['update_wpf_filter'])){
		if (! isset( $_REQUEST['_wpnonce'] )|| ! wp_verify_nonce( $_REQUEST['_wpnonce'],'fltr-edit_'.$xyz_wpf_filter_id)){
        	wp_nonce_ays( 'fltr-edit_'.$xyz_wpf_filter_id );
        	exit;
    	}
	$xyz_wpf_filter_name_edit=sanitize_text_field($_POST['xyz_wpf_filter_name_edit']);
	$dummy_for_category_edit = sanitize_text_field($_POST['dummy_for_category_edit']) ;
	$xyz_wpf_category_edit_post_from=sanitize_text_field($_POST['xyz_wpf_category_edit_post_from']) ;
	$dummy_for_tag_edit = sanitize_text_field($_POST['dummy_for_tag_edit']) ;
	$xyz_wpf_tag_edit_post_from=sanitize_text_field($_POST['xyz_wpf_tag_edit_post_from']);
	$dummy_for_author_edit = sanitize_text_field($_POST['dummy_for_author_edit']);
	$xyz_wpf_skip_posts_edit = intval($_POST['xyz_wpf_skip_posts_edit']);
	$xyz_wpf_no_of_posts_edit=intval($_POST['xyz_wpf_no_of_posts_edit']);




		$xyz_wpf_pagination_edit =intval($_POST['xyz_wpf_pagination_edit']);
		
		if($xyz_wpf_pagination_edit==0)
			$xyz_wpf_pagination_limit_edit=intval($_POST['xyz_wpf_pagination_limit_edit']);

		$xyz_wpf_sortby_edit =sanitize_text_field($_POST['xyz_wpf_sortby_edit']);
		$xyz_wpf_orderby_edit=sanitize_text_field($_POST['xyz_wpf_orderby_edit']);
		$xyz_wpf_display_format_edit=sanitize_text_field($_POST['xyz_wpf_display_format_edit']);
	
		$filter_lists=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."xyz_wp_posts_filter WHERE id!=%d AND xyz_wpf_name=%s ",array($id,$xyz_wpf_filter_name_edit)));
		if($xyz_wpf_filter_name_edit=="")
		{
			$ms1="Please fill Filter Name.";
			$erf=1;
		}
		else if(count($filter_lists)>0)
		{
			$ms2="Filter Name already exist.";
			$erf=1;
		}
		else if($xyz_wpf_display_format_edit=="")
		{
			$ms3="Please fill Display Format.";
			$erf=1;
		}
		else
		{	
			if($f!=1)
			{	
				$erf=0;
				$update_filter_details = $wpdb->get_results($wpdb->prepare("UPDATE `".$wpdb->prefix."xyz_wp_posts_filter` SET `xyz_wpf_name`=%s,`xyz_wpf_categories`=%s,`xyz_wpf_cat_post_from`=%d,`xyz_wpf_tags`=%s,`xyz_wpf_tag_post_from`=%d,`xyz_wpf_authors`=%s,`xyz_wpf_skip_posts`=%d,`xyz_wpf_no_of_posts`=%d,`xyz_wpf_pagination`=%d,`xyz_wpf_pagination_limit`=%d,`xyz_wpf_sort`=%d,`xyz_wpf_order`=%d,`xyz_wpf_msg_format`=%s WHERE `id`=%d",array($xyz_wpf_filter_name_edit,$dummy_for_category_edit,$xyz_wpf_category_edit_post_from,$dummy_for_tag_edit,$xyz_wpf_tag_edit_post_from,$dummy_for_author_edit,$xyz_wpf_skip_posts_edit,$xyz_wpf_no_of_posts_edit,$xyz_wpf_pagination_edit,$xyz_wpf_pagination_limit_edit,$xyz_wpf_sortby_edit,$xyz_wpf_orderby_edit,$xyz_wpf_display_format_edit,$id)));
						
				header("Location:".admin_url('admin.php?page=xyz-wpf-filter-manage&msg=2'));
				exit();}
		}
		if($erf==1)
		{
			?>
		<div class="system_notice_area_style0" id="system_notice_area">
		<?php
		{echo $ms1;echo $ms2;echo $ms3;}
		?>
		&nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
		</div>
		<?php
		}
	}
	
	?>
	<div id='edit_box_id_<?php echo $xyz_wpf_filter_id; ?>'>
<form method="post" name="edit_form" id="edit_form_<?php echo $xyz_wpf_filter_id; ?>">
					<?php wp_nonce_field( 'fltr-edit_'.$xyz_wpf_filter_id); ?>
					<table class="widefat xyz_wpf_table" style="width: 100%; margin: 0 auto;">
						<tr><td style="height: 5px;"></td></tr>
						<tr style="background-color: white; "><td>Name <span class="mandatory">*</span></td>
							<td>
								<input type="text" id="xyz_wpf_filter_name_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_filter_name_edit" value="<?php if($ms1=="") {echo esc_attr($xyz_wpf_filter_name); }?>">
							</td>
						</tr>
						<tr style="background-color: white; ">
							<td>
								Category  
							</td>
							<td>
								<input type="hidden" name="dummy_for_category_edit" id="dummy_for_category_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" value="">
								<select multiple onClick="xyz_wpf_set_category_edit_select(<?php echo esc_attr($xyz_wpf_filter_id); ?>)" id="xyz_wpf_category_edit_select_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_category_edit_select[]"  >
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
								<select id="xyz_wpf_category_edit_post_from_<?php echo $xyz_wpf_filter_id; ?>" name="xyz_wpf_category_edit_post_from"  >  
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
								<input type="hidden" name="dummy_for_tag_edit" id="dummy_for_tag_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" value="">
								<select multiple onClick="xyz_wpf_set_tag_edit_select(<?php echo esc_attr($xyz_wpf_filter_id); ?>)" id="xyz_wpf_tag_edit_select_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_tag_edit_select[]"  >
								<?php 
								$post_tag='post_tag';
								$tagids_frm_term_tax = $wpdb->get_results($wpdb->prepare("SELECT `term_id` FROM `".$wpdb->prefix."term_taxonomy` WHERE `taxonomy`=%s",$post_tag));
								foreach ($tagids_frm_term_tax as $tagids)
								{
									$tagnames = $wpdb->get_results($wpdb->prepare("SELECT  `term_id`,`name` FROM `".$wpdb->prefix."terms` WHERE `term_id` =%d",$tagids->term_id));
									foreach ($tagnames as $tagname)
									{
										?>
										<option value="<?php echo esc_attr($tagname->term_id) ;?>" ><?php echo esc_html($tagname->name);?></option>
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
								<select id="xyz_wpf_tag_edit_post_from_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_tag_edit_post_from"  >
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
								<input type="hidden" name="dummy_for_author_edit" id="dummy_for_author_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" value="">
								<select multiple onClick="xyz_wpf_set_author_edit_select(<?php echo esc_attr($xyz_wpf_filter_id); ?>)" id="xyz_wpf_author_edit_select_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_author_edit_select[]"  >
								<?php 
								$authornames = $wpdb->get_results("SELECT `ID`,`display_name`  FROM `".$wpdb->base_prefix."users`");
								foreach ($authornames as $authorname)
								{
									?>
									<option value="<?php echo esc_attr($authorname->ID) ;?>" ><?php echo esc_html($authorname->display_name);?></option>
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
								<input type="text" <?php if($xyz_wpf_skip_posts==""){?> value="0" <?php }else{?>value="<?php echo esc_attr($xyz_wpf_skip_posts);?>"<?php }?> id="xyz_wpf_skip_posts_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_skip_posts_edit" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
							</td>
							<td>
								<p style="color:red;" id="error_postnum"><?php echo esc_attr($error_postskip);?></p>
							</td>
						</tr>

						<tr>
							<td>
								Posts to be shown
								<br>
								<span style="color: green;font-size: 11px">[ 0 : Show All Posts ]</span>
							</td>
							<td>
								<input type="text" <?php if($xyz_wpf_no_of_posts==""){?> value="0" <?php }else{?>value="<?php echo esc_attr($xyz_wpf_no_of_posts);?>"<?php }?> id="xyz_wpf_no_of_posts_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_no_of_posts_edit" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
							</td><td><p style="color:red;" id="error_postnum"><?php echo esc_attr($error_postnum);?></p></td>
						</tr>	
						
						<tr>	
							<td>
								Pagination
							</td>
							<td>
								<select id="xyz_wpf_pagination_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_pagination_edit" onchange="xyz_wpf_pagination_edit_function(this.value,<?php echo esc_attr($xyz_wpf_filter_id); ?>)" >
									<option value="0" <?php if($xyz_wpf_pagination==0){?>selected="selected"<?php }?>>Yes</option>
									<option value="1" <?php if($xyz_wpf_pagination==1){?>selected="selected"<?php }?>>No</option>
								</select>
							</td>
						</tr>
						
						<tr id="row_id_pagination_limit_edit_<?php echo $xyz_wpf_filter_id; ?>">
							<td>
								Pagination Limit
							</td>
							<td>
								<input type="text" <?php if($xyz_wpf_pagination_limit==""){?> value="10" <?php }else{?>value="<?php echo esc_attr($xyz_wpf_pagination_limit);?>"<?php }?> id="xyz_wpf_pagination_limit_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_pagination_limit_edit" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'');">
							</td><td><p style="color:red;" id="error_postnum"><?php echo esc_attr($error_pag);?></p></td>
						</tr>
						
						<tr>	
							<td>
								Sortby
							</td>
							<td>
								<select id="xyz_wpf_sortby_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_sortby_edit"  >
									<option value="0" <?php if($xyz_wpf_sortby==0){?>selected="selected"<?php }?>>Publish Date</option>
									<option value="1" <?php if($xyz_wpf_sortby==1){?>selected="selected"<?php }?>>Updated Date</option>
								</select>&nbsp;
								<select id="xyz_wpf_orderby_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_orderby_edit"  >
									<option value="0" <?php if($xyz_wpf_orderby==0){?>selected="selected"<?php }?>>Asc</option>
									<option value="1" <?php if($xyz_wpf_orderby==1){?>selected="selected"<?php }?>>Desc</option>
								</select>
							</td>
						</tr>
						
						<tr>	
							<td>
								Display Format <span class="mandatory">*</span>
							</td>
							<td>
								<select name="xyz_wpf_display_format_edit_select" id="xyz_wpf_display_format_edit_select_<?php echo esc_attr($xyz_wpf_filter_id); ?>" onchange="xyz_wpf_display_format_edit_insert(this,<?php echo $xyz_wpf_filter_id; ?>);">
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
							<td>&nbsp;</td>
							<td>
								<textarea id="xyz_wpf_display_format_edit_<?php echo esc_attr($xyz_wpf_filter_id); ?>" name="xyz_wpf_display_format_edit"><?php if($ms3=="") {echo esc_textarea($xyz_wpf_display_format);}?></textarea> 
							</td> 
						</tr>
						
						<tr>
							<td id="bottomBorderNone">&nbsp;</td>
							<td id="bottomBorderNone" style="height: 50px;">
								<input type="submit" onclick="update_filter_details(<?php echo esc_attr($xyz_wpf_filter_id); ?>);" class="submit_wpf_new" style=" margin-top: 10px; " name="update_wpf_filter" value="Update" />
							</td>
						</tr>
					</table>
				</form>
			</div>
</fieldset>


<script type="text/javascript">

jQuery(document).ready(function() 
{
	var id="<?php echo intval($xyz_wpf_filter_id);?>";
	var selected_category_edit_vals="<?php echo $xyz_wpf_category_select;?>";
	if(selected_category_edit_vals=="")
		jQuery("#xyz_wpf_category_edit_select_"+id+" option[value='1']").prop("selected", true);
	jQuery.each(selected_category_edit_vals.split(","), function(i1,e1){
		jQuery("#xyz_wpf_category_edit_select_"+id+" option[value='" + e1 + "']").prop("selected", true);
	});
	xyz_wpf_set_category_edit_select(id);
	var selected_tag_edit_vals="<?php echo $xyz_wpf_tag_select;?>";
	jQuery.each(selected_tag_edit_vals.split(","), function(i2,e2){
		jQuery("#xyz_wpf_tag_edit_select_"+id+" option[value='" + e2 + "']").prop("selected", true);
	});
	xyz_wpf_set_tag_edit_select(id);
	var selected_author_edit_vals="<?php echo $xyz_wpf_author_select;?>";
	jQuery.each(selected_author_edit_vals.split(","), function(i3,e3){
		jQuery("#xyz_wpf_author_edit_select_"+id+" option[value='" + e3 + "']").prop("selected", true);
	});
	xyz_wpf_set_author_edit_select(id);
	var flag_for_sh_pg_lmt="<?php echo $xyz_wpf_pagination;?>";
	if(flag_for_sh_pg_lmt==1)
		jQuery("#row_id_pagination_limit_edit_"+id).hide();	
	else
		jQuery("#row_id_pagination_limit_edit_"+id).show();
	
});

function xyz_wpf_display_format_edit_insert(inf,id)
{
    var e = document.getElementById("xyz_wpf_display_format_edit_select_"+id);
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_wpf_display_format_edit_"+id).val()+ins_opt;
    jQuery("textarea#xyz_wpf_display_format_edit_"+id).val(str);
    jQuery('#xyz_wpf_display_format_edit_select_'+id+' :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_wpf_display_format_edit_"+id).focus();
}

function xyz_wpf_set_category_edit_select(id)
{
	var sel_category_edit_vals = []; 
	jQuery('#xyz_wpf_category_edit_select_'+id+' :selected').each(function(j1, selected){ 
		sel_category_edit_vals[j1] = jQuery(selected).val(); 
	}); 

	jQuery("#dummy_for_category_edit_"+id).val(sel_category_edit_vals);	
}

function xyz_wpf_set_tag_edit_select(id)
{
	var sel_tag_edit_vals = []; 
	jQuery('#xyz_wpf_tag_edit_select_'+id+' :selected').each(function(j2, selected){ 
		sel_tag_edit_vals[j2] = jQuery(selected).val(); 
	}); 

	jQuery("#dummy_for_tag_edit_"+id).val(sel_tag_edit_vals);	
}

function xyz_wpf_set_author_edit_select(id)
{
	var sel_author_edit_vals = []; 
	jQuery('#xyz_wpf_author_edit_select_'+id+' :selected').each(function(j3, selected){ 
		sel_author_edit_vals[j3] = jQuery(selected).val(); 
	}); 

	jQuery("#dummy_for_author_edit_"+id).val(sel_author_edit_vals);	
}

function xyz_wpf_pagination_edit_function(act,id)
{
	if(act==1)
		jQuery("#row_id_pagination_limit_edit_"+id).hide();	
	else
		jQuery("#row_id_pagination_limit_edit_"+id).show();	
}
</script>