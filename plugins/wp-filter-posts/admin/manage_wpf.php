<?php 
if (!defined( 'ABSPATH' ))
     exit;
     
global $wpdb;
$xyz_wpf_grpMessage = '';

if(isset($_GET['msg'])){
	$xyz_wpf_grpMessage = intval($_GET['msg']);
}
if($xyz_wpf_grpMessage==1)
{
	?>
	<div class="system_notice_area_style1" id="system_notice_area">
	New Filter added successfully.!
	&nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
	</div>
	<script type="text/javascript">
		jQuery('#system_notice_area_dismiss').click(function() {
			   window.history.pushState('obj', '', 'admin.php?page=xyz-wpf-filter-manage');
			   return false;
			});
	</script>
	<?php
}
if($xyz_wpf_grpMessage==2)
{
	?>
	<div class="system_notice_area_style1" id="system_notice_area">
	Filter settings edited successfully.!
	&nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
	</div>
	<script type="text/javascript">
	jQuery('#system_notice_area_dismiss').click(function() {
	window.history.pushState('obj', '', 'admin.php?page=xyz-wpf-filter-manage');
	return false;
	});
	</script>
	<?php
}
?>

<fieldset style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
	<legend>
		<h2 class="xyz-wpf-hdr">Manage Filter</h2>
	</legend>
	
	<div style="  margin-bottom: 15px; "> 
		<button class="submit_wpf_new" onClick='document.location.href="<?php echo admin_url('admin.php?page=xyz-wpf-filter-add-new');?>"'>Add New Filter</button>
	</div>
	
	<?php 
	$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
	$limit =get_option('xyz_wpf_page_size');
	$offset = ( $pagenum - 1 ) * $limit;
	$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM ".$wpdb->prefix."xyz_wp_posts_filter" );
	$num_of_pages = ceil( $total / $limit );
	$xyz_wpf_manage_details = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_wp_posts_filter ORDER BY id DESC LIMIT $offset,$limit" );
	$page_links = paginate_links( array(
			'base' => add_query_arg( 'pagenum','%#%'),
			'format' => '',
			'prev_text' =>  '&laquo;',
			'next_text' =>  '&raquo;',
			'total' => $num_of_pages,
			'current' => $pagenum
	) );
	?>
	<table class="widefat" style="width: 100%; margin: 0 auto;  border-color: #CCCCCC ">
		<thead>
			<tr  style="font-weight: bold;background-color: white ;" height="60">
				<th style="text-indent: 12px;" scope="col" width="40%" style="color: #555555; "><b>Name</b></th>
				<th scope="col" width="20%" style="color: #555555"><b>Shortcode</b></th>
				<th scope="col" width="12%" style="color: #555555"><b>Status</b></th>
				<th scope="col" width="15%" style="color: #555555"><b>Actions</b></th>
				<th scope="col" width="5%" style="color: #555555"></th>
			</tr>
		</thead>
		<?php 
		if( count($xyz_wpf_manage_details)>0 )
		{
			$count=1;
			foreach ($xyz_wpf_manage_details as $xyz_wpf_manage_detail)
			{
				$xyz_wpf_filter_id=$xyz_wpf_manage_detail->id;
				$xyz_wpf_filter_name=$xyz_wpf_manage_detail->xyz_wpf_name;
				$xyz_wpf_filter_status=$xyz_wpf_manage_detail->xyz_wpf_status;
				$xyz_wpf_category_select=$xyz_wpf_manage_detail->xyz_wpf_categories;
				$xyz_wpf_category_post_from=$xyz_wpf_manage_detail->xyz_wpf_cat_post_from;
				$xyz_wpf_tag_select=$xyz_wpf_manage_detail->xyz_wpf_tags;
				$xyz_wpf_tag_post_from=$xyz_wpf_manage_detail->xyz_wpf_tag_post_from;
				$xyz_wpf_author_select=$xyz_wpf_manage_detail->xyz_wpf_authors;
				$xyz_wpf_no_of_posts=$xyz_wpf_manage_detail->xyz_wpf_no_of_posts;
				$xyz_wpf_skip_posts=$xyz_wpf_manage_detail->xyz_wpf_skip_posts;
				$xyz_wpf_pagination=$xyz_wpf_manage_detail->xyz_wpf_pagination;
				$xyz_wpf_pagination_limit=$xyz_wpf_manage_detail->xyz_wpf_pagination_limit;
				$xyz_wpf_sortby=$xyz_wpf_manage_detail->xyz_wpf_sort;
				$xyz_wpf_orderby=$xyz_wpf_manage_detail->xyz_wpf_order;
				$xyz_wpf_display_format=$xyz_wpf_manage_detail->xyz_wpf_msg_format;
				
				if($xyz_wpf_filter_status==0)
				{
					$color='red';
					$status='Inactive';
				}
				else 
				{
					$color='green';
					$status='Active';
				}
				?>	
				<tr height="47" id="filter_row_<?php echo $xyz_wpf_filter_id;?>" name="filter_row_<?php echo $xyz_wpf_filter_id;?>">
					<td style="text-indent: 12px; vertical-align: middle !important;" scope="col" width="40%" id="name_td_<?php echo esc_attr($xyz_wpf_filter_id);?>"><?php echo esc_attr($xyz_wpf_filter_name);?></td>
					<td scope="col" style="vertical-align: middle !important;" width="20%"> <?php echo "[xyz_wpf_shortcode id=".$xyz_wpf_filter_id."]"?>  </td>
					<td	id="status_tdid_<?php echo esc_attr($xyz_wpf_filter_id); ?>" scope="col" width="12%" style="vertical-align: middle !important; color: <?php echo esc_attr($color);?>" ><?php echo esc_attr($status);?></td>
					<td scope="col" style="vertical-align: middle !important;" width="15%">
						<?php if($xyz_wpf_filter_status==0){ ?>
							<a onclick="wpf_status_info(<?php echo esc_attr($xyz_wpf_filter_id); ?>)">
							<img  name='statusimage_<?php echo esc_attr($xyz_wpf_filter_id); ?>' id='statusimage_<?php echo esc_attr($xyz_wpf_filter_id); ?>' class="img" title="Activate Filter" src="<?php echo plugins_url('images/activate.png',__FILE__);?>">
							</a>&nbsp;&nbsp;
						<?php }
						else {
						?>
						<a onclick="wpf_status_info(<?php echo $xyz_wpf_filter_id; ?>)">
						<img name='statusimage_<?php echo esc_attr($xyz_wpf_filter_id); ?>' id='statusimage_<?php echo esc_attr($xyz_wpf_filter_id); ?>' class="img" title="Deactivate Filter" src="<?php echo plugins_url('images/blocked.png',__FILE__);?>">
						</a>&nbsp;&nbsp;
						<?php }
						?>
	
						<a href='<?php echo admin_url('admin.php?page=xyz-wpf-filter-manage&action=edit-filter&id='.$xyz_wpf_filter_id); ?>'>
						<img class="img" title="Edit Filter" src="<?php echo plugins_url('images/edit.png',__FILE__);?>">
						</a>&nbsp;&nbsp;
						
						<a onclick="wpf_delete_info(<?php echo $xyz_wpf_filter_id; ?>)" style="cursor:pointer;" id="delete_filter_<?php echo esc_attr($xyz_wpf_filter_id); ?>" >
						<img class="img" title="Delete Filter" src="<?php echo plugins_url('images/delete.png',__FILE__);?>"></a>&nbsp;&nbsp;
					</td>
					<td scope="col" style="vertical-align: middle !important;" width="5%"></td>
					
				</tr>
				<?php
			}
			$count++;
		}
		else 
		{ 
			?>
			<tr>
				<td colspan="5" >Filters not found</td>
			</tr>
			<?php 
		} 
		?>
	</table>
	<?php 
	if ( $page_links ) 
	{
		echo '<div class="tablenav" style="width:99%"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
	}
	?>
	
</fieldset>
	
<script type="text/javascript">

function wpf_delete_info(inf)
{
	if (confirm("Are you sure you want to delete this filter?")) 
    { 
    	<?php $ajax_del_info_nonce = wp_create_nonce( "xyz-del-info" );?>
		var dataString = { 
				action: 'filter_entry_delete', 
				security:'<?php echo $ajax_del_info_nonce; ?>',
				id :inf,
			 };

		jQuery.post(ajaxurl, dataString, function(response) 
		{
			jQuery("#filter_row_"+inf).fadeOut();
			
		});
    }
}

function wpf_status_info(inf)
{
		<?php $ajax_status_info_nonce = wp_create_nonce( "xyz-stat-info" );?>
		var dataString = { 
				action: 'filter_entry_status',
				security:'<?php echo $ajax_status_info_nonce ?>', 
				id :inf,
			 };

		jQuery.post(ajaxurl, dataString, function(response) 
		{
			jQuery("#status_tdid_"+inf).html(response);
			if(response=='Active')
			{
				jQuery("#status_tdid_"+inf).css('color', 'green');
				jQuery("#statusimage_"+inf).attr("src", "<?php echo plugins_url('images/blocked.png',__FILE__);?>");  
			}
			else if(response=='Inactive')
			{
				jQuery("#status_tdid_"+inf).css('color', 'red');
				jQuery("#statusimage_"+inf).attr("src", "<?php echo plugins_url('images/activate.png',__FILE__);?>");  
			}
			
		});
}
</script>