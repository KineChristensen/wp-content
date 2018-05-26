<?php defined('ABSPATH') or die("No script kiddies please!");?>
<div class="apmega_left_content_wrapper custom_css">

<div class="apmm-header1 wpmega-css"><?php _e("Custom CSS", APMM_PRO_TD); ?></div>
<table>
    <tr>
        <td class='apmega-name'>
            <label for="enable_custom_css"><?php _e('Enable Custom CSS',APMM_PRO_TD);?>
            <p class="description"><?php _e('Enable Custom CSS and add css below to override any theme or plugin css code.',APMM_PRO_TD);?></p>
        </td>
        <td class='apmega-value'>
           <div class="wpmm-switch">
              <input type="checkbox" name="enable_custom_css" id="enable_custom_css" value="1" <?php if($enable_custom_css  == 1) echo "checked";?>/>
             <label for="enable_custom_css"></label>
           </div>
           <p class="description"><?php _e('Do you want to enable below custom css?',APMM_PRO_TD)?></p>
        </td>
    </tr>
        
    </tr>
</table>
<textarea name="custom_css" id="wpmm_custom_css" class="wpmm_custom large-text code" dir="ltr" style="width:100%;height:350px;"><?php echo $custom_css;?></textarea>
<p class="description"><?php _e( 'Please write your custom css here that you want to be included for wp mega menu pro.', APMM_PRO_TD ); ?> </p>


<div class="apmm-header1 wpmega-css"><?php _e("Custom JS", APMM_PRO_TD); ?></div>
<table>
    <tr>
        <td class='apmega-name'>
            <label for="enable_custom_js"><?php _e('Enable Custom JS',APMM_PRO_TD);?>
            <p class="description"><?php _e('Enable Custom JS and add javascript below.',APMM_PRO_TD);?></p>
        </td>
        <td class='apmega-value'>
           <div class="wpmm-switch">
              <input type="checkbox" name="enable_custom_js" id="enable_custom_js" value="1" <?php if($enable_custom_js  == 1) echo "checked";?>/>
             <label for="enable_custom_js"></label>
           </div>
           <p class="description"><?php _e('Do you want to enable below custom js?',APMM_PRO_TD)?></p>
        </td>
    </tr>
        
    </tr>
</table>
<textarea name="custom_js" id="wpmm_custom_js" class="wpmm_custom large-text code" dir="ltr" style="width:100%;height:350px;"><?php echo $custom_js;?></textarea>
<p class="description"><?php _e( 'Please write your custom js here that you want to be included for wp mega menu pro.', APMM_PRO_TD ); ?> </p>
<code class="wpmegamenu-highlight-code clear">
        <span class="wpmegamenu-code-snippet-type">Starting JS Method        
        <p class="description">Copy below js code and paste it in above textarea. You can add your custom js code inside it.</p></span>
         <span class="highlightcode">
         jQuery(function ($) {
            /* Add your custom javascript code here*/
           });
        </span>
</code>
<div class="clear" style="margin-bottom:12px;"></div>


</div>