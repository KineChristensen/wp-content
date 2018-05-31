<?php

class WPUPG_Privacy {

    public function __construct()
    {
        add_action('admin_init', array($this, 'privacy_policy') );
    }

    public function privacy_policy()
    {
        if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
            return;
        }
     
        $content = __( 'WP Ultimate Post Grid does not collect any data. Fonts in the grid templates will be loaded from the Google Web Font API (fonts.googleapis.com) unless changed in the Template Editor. You will be agreeing to their Terms of Use and Privacy Policy.',
            'wp-ultimate-post-grid' );
     
        wp_add_privacy_policy_content(
            'WP Ultimate Post Grid',
            wp_kses_post( wpautop( $content, false ) )
        );
    }
}