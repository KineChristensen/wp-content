<?php 
if (!defined( 'ABSPATH' ))
     exit;
     
if(isset($_POST['bsettngs']))
{
	if (! isset( $_REQUEST['_wpnonce'] )|| ! wp_verify_nonce( $_REQUEST['_wpnonce'],'fltr-sttng_')){
		wp_nonce_ays( 'fltr-sttng_' );
		exit;
	}
	$fl=1;$msg="";
	$xyz_wpf_page_size=intval($_POST['xyz_wpf_page_size']);
	
	if($xyz_wpf_page_size=="")
	{
		$fl=0;
		$msg="Please fill page size";
	}
	if(!(is_numeric( $xyz_wpf_page_size ) && strpos( $xyz_wpf_page_size, '.' ) === false) && $fl==1)
	{
		$fl=0;
		$msg="Please fill a valid page size";
	}
	if($fl==1)
	{
		$xyz_wpf_credit_link=sanitize_text_field($_POST['xyz_wpf_credit_link']);
		update_option('xyz_wpf_credit_link', $xyz_wpf_credit_link);
		update_option('xyz_wpf_page_size',$xyz_wpf_page_size);
		$msg="Basic settings updated successfully";
	}
}

$xyz_wpf_credit_link=esc_html(get_option('xyz_wpf_credit_link'));
$xyz_wpf_page_size=esc_html(get_option('xyz_wpf_page_size'));
if(isset($_POST['bsettngs']) && $msg!="")
{
	if($fl==0)
		$cl="system_notice_area_style0";
	else if($fl==1)
		$cl="system_notice_area_style1";
	?>
	<div class="<?php  echo $cl; ?>" id="system_notice_area">
	<?php
	echo $msg;
	?> &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
	</div>
	<?php
}
?>

<h2 class="xyz-wpf-hdr">Basic Settings</h2>
<form method="post" >
<?php wp_nonce_field('fltr-sttng_'); ?>
	<table  class="widefat xyz_wpf_table" style="width:98%;padding-top: 10px;">
		<tr valign="top">
			<td scope="row" >Page Size	<span class="mandatory">*</span>	
			</td>
			<td>
			<input id="xyz_wpf_page_size"  name="xyz_wpf_page_size" type="text" value="<?php echo esc_attr($xyz_wpf_page_size);?>"/>
			</td>
		</tr>
		
		<tr valign="top">
			<td scope="row" colspan="1">Enable credit link to author	<span class="mandatory">*</span>	</td><td><select name="xyz_wpf_credit_link" id="xyz_wpf_credit_link" >
			<option value ="wpf" <?php if($xyz_wpf_credit_link=='wpf') echo 'selected'; ?> >Yes </option>
			<option value ="<?php echo $xyz_wpf_credit_link!='wpf'?$xyz_wpf_credit_link:0;?>" <?php if($xyz_wpf_credit_link!='wpf') echo 'selected'; ?> >No </option>
			</select> 
			</td>
		</tr>
		<tr>
		    <td   id="bottomBorderNone">&nbsp;</td>
		    <td   id="bottomBorderNone" style="height: 50px">
			<input type="submit" class="submit_wpf_new" style=" margin-top: 10px;" name="bsettngs" value="Update Settings" />
		    </td>
		</tr>
	</table>
</form>





