
<form id="wpmm_login" class="ajax-auth" action="login" method="post">
    <!-- <h3>New to site? <input type="button" id="wpmm_pop_signup" value="Create an Account"/></h3>
    <hr /> -->
    <h1><?php _e('Login',APMM_PRO_TD);?></h1>
    <p class="status"></p>  
    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>  
    <label for="username"><?php _e('Username',APMM_PRO_TD);?></label>
    <input id="username" type="text" class="required" name="username">
    <label for="password"><?php _e('Password',APMM_PRO_TD);?></label>
    <input id="password" type="password" class="required" name="password">
    <!-- <input type="button" class="text-link" href="<?php echo wp_lostpassword_url(); ?>">Lost password?</a> -->
    <input class="submit_button" type="submit" value="<?php _e('LOGIN',APMM_PRO_TD);?>">
	<button type="button" class="close"/><i class="fa fa-close"></i></button>      
</form>
<form id="wpmm_register" class="ajax-auth"  action="register" method="post">
	<!-- <h3>Already have an account? 
	<input type="button" id="wpmm_pop_login"  value="Login"/>
	</h3> -->
    <!-- <hr /> -->
    <h1><?php _e('Signup',APMM_PRO_TD);?></h1>
    <p class="status"></p>
    <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>         
    <label for="signonname"><?php _e('Username',APMM_PRO_TD);?></label>
    <input id="signonname" type="text" name="signonname" class="required">
    <label for="email"><?php _e('Email',APMM_PRO_TD);?></label>
    <input id="email" type="text" class="required email" name="email">
    <label for="signonpassword"><?php _e('Password',APMM_PRO_TD);?></label>
    <input id="signonpassword" type="password" class="required" name="signonpassword" >
    <label for="password2"><?php _e('Confirm Password',APMM_PRO_TD);?></label>
    <input type="password" id="password2" class="required" name="password2">
    <input class="submit_button" type="submit" value="<?php _e('SIGNUP',APMM_PRO_TD);?>">
    <button type="button" class="close"/><i class="fa fa-close"></i></button>    
   
</form>
