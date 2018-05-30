<?php 
if (!defined( 'ABSPATH' ))
     exit;

if($_POST && isset($_POST['xyz_wpf_credit_link']))
{
	if (! isset( $_REQUEST['_wpnonce'] )|| ! wp_verify_nonce( $_REQUEST['_wpnonce'],'fltr-sttng_')){
		wp_nonce_ays( 'fltr-sttng_' );
		exit;
	}
	$xyz_wpf_credit_link=sanitize_text_field($_POST['xyz_wpf_credit_link']);
	update_option('xyz_wpf_credit_link', $xyz_wpf_credit_link);
}

?>
<div style="margin-top: 10px">
	<table style="float:right; ">
		<tr>

			<td style="float:right;">
				<a class="xyz_wpf_link"  target="_blank" href="http://help.xyzscripts.com/docs/wp-filter-posts/faq/" style="margin-right:12px;">FAQ</a>| 
			</td>
			<td style="float:right;">
				<a class="xyz_wpf_link"  target="_blank" href="http://help.xyzscripts.com/docs/wp-filter-posts/user-guide/">Readme</a> | 
			</td>
			<td style="float:right;">
				<a class="xyz_wpf_link"  target="_blank" href="http://xyzscripts.com/wordpress-plugins/wp-filter-posts">About</a> | 
			</td>
			<td style="float:right;">
				<a class="xyz_wpf_link"  target="_blank" href="http://xyzscripts.com">XYZScripts</a> |
			</td>
		</tr>
	</table>
</div>

<div style="clear: both"></div>

<?php 
if((get_option('xyz_wpf_credit_link')=="0")&&(get_option('xyz_wpf_credit_dismiss')=="0")){
?>
<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;border: 1px solid #E0AB1B" id="xyz_wpf_backlink_div">
	
	Please do a favour by enabling backlink to our site. <a id="xyz_wpf_backlink" style="cursor: pointer;" >Okay, Enable</a>.
	<a id="xyz_wpf_dismiss" style="cursor: pointer;" >Dismiss</a>
<script type="text/javascript">
	var stat = 0;
	jQuery(document).ready(function() {
		jQuery('#xyz_wpf_backlink').click(function() {

			xyz_filter_blink(1)
		});

		jQuery('#xyz_wpf_dismiss').click(function() {

			xyz_filter_blink(-1)
		});
			
			function xyz_filter_blink(stat){ 
				<?php $ajax_fltr_nonce = wp_create_nonce( "xyz-post-fltr" );?>
				var dataString = { 
					action: 'xyz_wpf_ajax_backlink',
					security:'<?php echo $ajax_fltr_nonce; ?>', 
					enable: stat
				};
				jQuery.post(ajaxurl, dataString, function(response) {

					if(response==1){
						jQuery("#xyz_wpf_backlink_div").html('Thank you for enabling backlink!');
					 	jQuery("#xyz_wpf_backlink_div").css('background-color', '#D8E8DA');
						jQuery("#xyz_wpf_backlink_div").css('border', '1px solid #0F801C');
						jQuery("select[id=xyz_gal_credit_link] option[value=gal]").attr("selected", true);
					}
					if(response==-1){
						jQuery("#xyz_wpf_backlink_div").remove();
					 	
					}

				// 	/*if(window.rcheck)
				// 	{
				// 		document.location.reload();
				// 	}*/
				});	
			}
	});
</script>
</div><br />
	<?php 
}
?>