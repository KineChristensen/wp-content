<?php
/********************************
 * JWD Show Posts Slider :: Deprecated Functions & Options
 ********************************/
/********************************
 * Blocking direct access to this file 
 ********************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/********************************
 * Remove Old Trash Please!
 ********************************/
 
/* Remove other old vars -  from v1.5 */
delete_option('jwdsp_accepted_cpt');
delete_option('jwdsp_general_settings[post_types]');
/* Remove Fontawsome & Version VAR -  from v1.4.4.5 */
delete_option('jwdsp_fontawesome');
delete_option('JWDSP_version'); 
delete_option('JWDSP_PLUGIN_PATH');
delete_option('JWDSP_PLUGIN_URL'); 
delete_option('JWDSP Plugin Path');
delete_option('JWDSP Plugin URL'); 
/* Remove Old GitHub updater & options -  from v1.4.4.4 */
delete_option('jwdsp_username');
delete_option('jwdsp_repository');
delete_option('jwdsp_access_token');
/* Remove Old JWDSP_Accepted_Post_Types -  from v1.4.3.5 */
delete_option('JWDSP_Accepted_Post_Types');