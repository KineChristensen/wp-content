<?php if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

if ( ! class_exists('WP_Mega_Menu_Widget_PRO') ) :

/**
 * Outputs a registered menu location using wp_nav_menu
 */
class WP_Mega_Menu_Widget_PRO extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmegamenu_widget', // Base ID
                                'WP Mega Menu Pro Widget', // Name
                                 array('description' => __('Display WP Mega Menu PRO Location on selected area.', APMM_PRO_TD)));
        }

    /**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );

        if ( isset( $instance['location'] ) ) {
            $location = $instance['location'];

            $title = apply_filters( 'widget_title', $instance['title'] );

            echo $before_widget;

            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }

            if ( has_nav_menu( $location ) ) {
                 wp_nav_menu( array( 'theme_location' => $location ) );
            }

            echo $after_widget;
        }
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['location'] = strip_tags( $new_instance['location'] );
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     * @see WP_Widget::form()
     * @param array   $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $selected_location = 0;
        $title = "";
        $locations = get_registered_nav_menus();

        if ( isset( $instance['location'] ) ) {
            $selected_location = $instance['location'];
        }

        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        ?>
        <p>
            <?php if ( $locations ) { ?>
                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', APMM_PRO_TD); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
                <label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php _e( 'Menu Location:', APMM_PRO_TD); ?></label>
                <select id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>">
                    <?php
                        foreach ( $locations as $location => $description ) {
                            echo "<option value='{$location}'" . selected($location, $selected_location) . ">{$description}</option>";
                        }
                    ?>
                </select>
            <?php } else {
            _e( 'No menu locations found', APMM_PRO_TD);
            } ?>
        </p>
        <?php
    }
}

endif;

if ( ! class_exists('WP_Mega_Menu_PRO_Contact_Info') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_Contact_Info extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmegamenu_contact_info', // Base ID
                                'WPMM :  Contact Info', // Name
                                 array('description' => __('Display WP Mega Menu Pro Contact Information.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        echo "<div class='wpmegamenu-contact-info'>";

        if(isset($instance['address_font_icon']) || isset($instance['address'])){
              echo "<p>";
                if(isset($instance['address_font_icon']) && $instance['address_font_icon']!=''){
                    echo "<i class='".$instance['address_font_icon']."'></i>";
                }
                if(isset($instance['address']) && $instance['address']!=''){
                    echo $instance['address'];
                }
              echo "</p>";
        }

       if(isset($instance['phone_font_icon']) || isset($instance['phone'])){
              echo "<p>";
                if(isset($instance['phone_font_icon']) && $instance['phone_font_icon']!=''){
                    echo "<i class='".$instance['phone_font_icon']."'></i>";
                }
                if(isset($instance['phone']) && $instance['phone']!=''){
                    echo $instance['phone'];
                }
              echo "</p>";
        }

      if(isset($instance['email_font_icon']) || isset($instance['email'])){
              echo "<p>";
                if(isset($instance['email_font_icon']) && $instance['email_font_icon']!=''){
                    echo "<i class='".$instance['email_font_icon']."'></i>";
                }
                if(isset($instance['email']) && $instance['email']!=''){
                    echo $instance['email'];
                }
              echo "</p>";
        }

      if(isset($instance['website_font_icon']) || isset($instance['website'])){
              echo "<p>";
                if(isset($instance['website_font_icon']) && $instance['website_font_icon']!=''){
                    echo "<i class='".$instance['website_font_icon']."'></i>";
                }
                if(isset($instance['website']) && $instance['website']!=''){
                    echo $instance['website'];
                }
              echo "</p>";
        }

        if(isset($instance['custom_shortcode_title']) && $instance['custom_shortcode_title'] != '' || (isset($instance['custom_shortcode'])) && $instance['custom_shortcode'] != ''){
            echo "<div class='wpmm-social-shortcodes'>";
            echo "<h4>".$instance['custom_shortcode_title']."</h4>";
            if( $instance['custom_shortcode']!=''){
            echo do_shortcode($instance['custom_shortcode']);
            }
            echo "</div>";
        }
         
         echo "</div>";
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        $instance['address_font_icon'] = strip_tags( $new_instance['address_font_icon'] );
        $instance['phone'] = strip_tags( $new_instance['phone'] );
        $instance['phone_font_icon'] = strip_tags( $new_instance['phone_font_icon'] );
        $instance['email'] = strip_tags( $new_instance['email'] );
        $instance['email_font_icon'] = strip_tags( $new_instance['email_font_icon'] );
        $instance['website'] = strip_tags( $new_instance['website'] );
        $instance['website_font_icon'] = strip_tags( $new_instance['website_font_icon'] );
        $instance['custom_shortcode'] = strip_tags( $new_instance['custom_shortcode'] );
        $instance['custom_shortcode_title'] = strip_tags( $new_instance['custom_shortcode_title'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = '';
        }
         if(isset($instance['address']))
        {
            $address = $instance['address'];
        }
        else
        {
            $address = '';
        }
         if(isset($instance['address_font_icon']))
        {
            $address_font_icon = $instance['address_font_icon'];
        }
        else
        {
            $address_font_icon = '';
        }
         if(isset($instance['phone']))
        {
            $phone = $instance['phone'];
        }
        else
        {
            $phone = '';
        }
          if(isset($instance['phone_font_icon']))
        {
            $phone_font_icon = $instance['phone_font_icon'];
        }
        else
        {
            $phone_font_icon = '';
        }
          if(isset($instance['email']))
        {
            $email = $instance['email'];
        }
        else
        {
            $email = '';
        }
          if(isset($instance['email_font_icon']))
        {
            $email_font_icon = $instance['email_font_icon'];
        }
        else
        {
            $email_font_icon = '';
        }
                  if(isset($instance['website']))
        {
            $website = $instance['website'];
        }
        else
        {
            $website = '';
        }
                    if(isset($instance['website_font_icon']))
        {
            $website_font_icon = $instance['website_font_icon'];
        }
        else
        {
            $website_font_icon = '';
        }
        if(isset($instance['custom_shortcode']))
        {
            $custom_shortcode = $instance['custom_shortcode'];
        }
        else
        {
            $custom_shortcode = '';
        }
          if(isset($instance['custom_shortcode_title']))
        {
            $custom_shortcode_title = $instance['custom_shortcode_title'];
        }
        else
        {
            $custom_shortcode_title = '';
        }
        ?>
          <p>
        
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'address_font_icon' ); ?>"><?php _e( 'Address Icon:' ,APMM_PRO_TD); ?></label> 
        <p class="description"><?php _e('Use Fontawesome Class for Address Icon such as fa fa-home',APMM_PRO_TD);?></p>
        <input class="widefat" id="<?php echo $this->get_field_id( 'address_font_icon' ); ?>" name="<?php echo $this->get_field_name( 'address_font_icon' ); ?>" type="text" value="<?php echo esc_attr( $address_font_icon ); ?>" placeholder="<?php _e('E.g., fa fa-home',APMM_PRO_TD);?>">
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('address');?>"><?php _e('Address',APMM_PRO_TD)?></label>
         <textarea class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo esc_attr( $address ); ?></textarea>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'phone_font_icon' ); ?>"><?php _e( 'Phone Icon:' ,APMM_PRO_TD); ?></label> 
        <p class="description"><?php _e('Use Fontawesome Class for Phone Icon such as fa fa-phone',APMM_PRO_TD);?></p>
        <input class="widefat" id="<?php echo $this->get_field_id( 'phone_font_icon' ); ?>" name="<?php echo $this->get_field_name( 'phone_font_icon' ); ?>" type="text" value="<?php echo esc_attr( $phone_font_icon ); ?>" placeholder="<?php _e('E.g., fa fa-phone',APMM_PRO_TD);?>">
        </p>
        <p>
        
        <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'email_font_icon' ); ?>"><?php _e( 'Email Icon:' ,APMM_PRO_TD); ?></label> 
        <p class="description"><?php _e('Use Fontawesome Class for Email Icon such as fa fa-phone',APMM_PRO_TD);?></p>
        <input class="widefat" id="<?php echo $this->get_field_id( 'email_font_icon' ); ?>" name="<?php echo $this->get_field_name( 'email_font_icon' ); ?>" type="text" value="<?php echo esc_attr( $email_font_icon ); ?>" placeholder="<?php _e('E.g., fa fa-email',APMM_PRO_TD);?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>">
        </p>
       
         <p>
        
        <label for="<?php echo $this->get_field_id( 'website_font_icon' ); ?>"><?php _e( 'Website Icon:' ,APMM_PRO_TD); ?></label> 
        <p class="description"><?php _e('Use Fontawesome Class for Website Icon such as fa fa-phone',APMM_PRO_TD);?></p>
        <input class="widefat" id="<?php echo $this->get_field_id( 'website_font_icon' ); ?>" name="<?php echo $this->get_field_name( 'website_font_icon' ); ?>" type="text" value="<?php echo esc_attr( $website_font_icon ); ?>" placeholder="<?php _e('E.g., fa fa-globe',APMM_PRO_TD);?>">
        </p>
         <p>
        <label for="<?php echo $this->get_field_id( 'website' ); ?>"><?php _e( 'Website:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" type="text" value="<?php echo esc_attr( $website ); ?>">
        </p>



          <p>
          <label for="<?php echo $this->get_field_id('custom_shortcode_title');?>"><?php _e('Custom Title',APMM_PRO_TD)?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_shortcode_title' ); ?>" name="<?php echo $this->get_field_name( 'custom_shortcode_title' ); ?>" value="<?php echo esc_attr( $custom_shortcode_title ); ?>"/>
        </p>

          <p>
          <label for="<?php echo $this->get_field_id('custom_shortcode');?>"><?php _e('Custom Shortcode',APMM_PRO_TD)?></label>
         <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_shortcode' ); ?>" name="<?php echo $this->get_field_name( 'custom_shortcode' ); ?>"><?php echo esc_attr( $custom_shortcode ); ?></textarea>
         </p>

        <?php 
    }
}

endif;

//======================================= Woocommerce Widget Start ==================================================//

if ( ! class_exists('WPMMPro_prodlist_widget_area') ) :
class WPMMPro_prodlist_widget_area extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmm_pro_productlist_widget_area', // Base ID
                      'WPMM PRO :  Products Lists Widget', // Name
                       array('description' => __('A widget that shows WooCommerce products.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
            extract($args);
            extract($instance);
          
            $display_title = esc_attr( $instance['display_title'] );
            $product_type = esc_attr( $instance['product_list_type'] );
            $product_category = esc_attr( $instance['product_list_category'] );
            $product_number = intval( $instance['product_list_number'] );
            $post_length = (isset($instance['product_post_length']) && $instance['product_post_length'] != '')?esc_attr( $instance['product_post_length'] ):'0';
            $product_show_description = esc_attr( $instance['product_show_description'] );
            //$link_name = (isset($instance['link_name']) && $instance['link_name'] != '')?esc_attr( $instance['link_name'] ):'';
            $product_show_category = (isset($instance['product_show_category']) && $instance['product_show_category'] != '')?esc_attr( $instance['product_show_category'] ):'0';
            $image_layout = (isset($instance['image_layout']) && $instance['image_layout'] != '')?esc_attr( $instance['image_layout'] ):'';
            $show_addtocart = (isset($instance['show_addtocart']) && $instance['show_addtocart'] != '')?esc_attr( $instance['show_addtocart'] ):'0';
            $product_show_image = (isset($instance['product_show_image']) && $instance['product_show_image'] != '')?esc_attr( $instance['product_show_image'] ):'0';
            $rating  = (isset($instance['rating']) && $instance['rating'] != '')?esc_attr( $instance['rating'] ):'0';
            // featured image options
            $image_size  = (isset($instance['image_size']) && $instance['image_size'] != '')?esc_attr( $instance['image_size'] ):'large';
            $custom_width  = (isset($instance['custom_width']) && $instance['custom_width'] != '')?esc_attr( $instance['custom_width'] ):'';
            $custom_height  = (isset($instance['custom_height']) && $instance['custom_height'] != '')?esc_attr( $instance['custom_height'] ):'';
 $product_visibility_term_ids = wc_get_product_visibility_term_ids();  
          if($product_type == 'category'){
            if($product_category == "all"){
                 $product_args = array(
                     'post_type' => 'product',
                     'posts_per_page' => $product_number
                 );
            }else{

                 $product_args = array(
                     'post_type' => 'product',
                     'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                     'posts_per_page' => $product_number
                 );

            }
             }
             
             elseif($product_type == 'latest_product'){
                 $product_label_custom = __('New', APMM_PRO_TD);
                 if($product_category == "all"){
                 $product_args = array(
                     'post_type' => 'product',
                     'posts_per_page' => $product_number,
                     'orderby' => 'date',
                     'order' =>'desc'
                 );
              }else{
                 $product_args = array(
                       'post_type' => 'product',                
                          'tax_query' => array(
                           array('taxonomy'  => 'product_cat',
                            'field'     => 'id', 
                            'terms'     => $product_category                                                                 
                           )
                       ),
                       'posts_per_page' => $product_number
                   );
              }
                
             }
             
             else if($product_type == 'feature_product'){
              if($product_category == "all"){
                 //  $meta_query[] = array(
                 //      'key'   => '_featured',
                 //      'value' => 'yes'
                 //  );
                 // $product_args = array(
                 //     'post_type' => 'product',
                 //     'posts_per_page' => $product_number,
                 //      'orderby'     =>  'date',
                 //      'order'       =>  'DESC',
                 //      'meta_query'  =>  $meta_query
                 // );
                
                 // from woocommerce new version updates of 3.0.4
                 $product_args = array(  
                  'post_type' => 'product',  
                  'posts_per_page' => $product_number,
                  'meta_query'     => array(),
                  'tax_query'      => array(
                    'relation' => 'AND',
                  ),
                 ); 
                 $product_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => $product_visibility_term_ids['featured'],
              );
              }else{
                    $product_args = array(  
                  'post_type' => 'product',  
                  'posts_per_page' => $product_number,
                  'meta_query'     => array(),
                  'tax_query'      => array(
                    'relation' => 'AND',
                  ),
                 ); 
                 $product_args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'id',
                'terms'    => $product_category   
              );
                 
                 // $product_args = array(
                 //     'post_type'        => 'product',  
                 //     'meta_key'         => '_featured',  
                 //     'meta_value'       => 'yes',
                 //        'tax_query' => array(
                 //         array('taxonomy'  => 'product_cat',
                 //          'field'     => 'id', 
                 //          'terms'     => $product_category                                                                 
                 //         )
                 //     ),
                 //     'posts_per_page'   => $product_number   
                 // );
               }
             }
         
             elseif($product_type == 'upsell_product'){
               if($product_category == "all"){
                 $product_args = array(
                     'post_type' => 'product',
                     'posts_per_page' => $product_number,
                     'meta_key'          => 'total_sales',
                     'orderby'           => 'meta_value_num'
                 );
              }else{
                 $product_args = array(
                     'post_type'         => 'product',
                     'meta_key'          => 'total_sales',
                     'orderby'           => 'meta_value_num',
                        'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                     'posts_per_page'    => $product_number
                 );
               }
             }
         
             else if($product_type == 'on_sale'){
              if($product_category == "all"){
                 $product_args = array(
                     'post_type' => 'product',
                     'posts_per_page' => $product_number,
                      'meta_query'     => array(
                     'relation' => 'OR',
                     array( // Simple products type
                         'key'           => '_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     ),
                     array( // Variable products type
                         'key'           => '_min_variation_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     )
                   )
                 );
              }else{
                 $product_args = array(
                 'post_type'      => 'product',
                 'posts_per_page'    => $product_number,
                    'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                 'meta_query'     => array(
                     'relation' => 'OR',
                     array( // Simple products type
                         'key'           => '_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     ),
                     array( // Variable products type
                         'key'           => '_min_variation_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     )
                 )
                 );
              }
             }
            echo $before_widget;  ?>

              <div class="wpmm-pro-productlist-wrap">
    
                    <div class="wpmmstore-container">

                        <div id="product-list" class="product-list-area clearfix">
                            
                            <div class="product-block-title-wrap clearfix">
                             <?php  if (!empty($instance['display_title'])) {
                                    echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
                                }
                                ?>
                             </div>
                            
                            <ul class="all-product-list wpmm-<?php echo $image_layout;?>">
                                <?php             

                                    $query = new WP_Query($product_args);
                              
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                  <li <?php post_class(); ?>>
                                 <div class="wpmm-product-wrap wpmegamenupro-clearfix">
                                   <!-- show featured image -->
                                  <div class="wpmm-prodimage">
                                    
                                        <?php
                                         if(isset($product_show_image) && $product_show_image ==1){
                                          if ( has_post_thumbnail() ) {
                                             woocommerce_show_product_loop_sale_flash();
                                            if($image_size == "custom_size"){
                                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'large');
                                            }else{
                                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), $image_size );  
                                            }
                                         
                                             
                                              if ( ! empty( $large_image_url[0] ) ) {
                                                 echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
                                                  if($image_size != "custom_size"){
                                                  echo get_the_post_thumbnail( get_the_ID(), $image_size  ); 
                                                }else{
                                                 echo "<div style='width:".$custom_width.";height:".$custom_height."'><img src='".esc_url( $large_image_url[0] )."' alt='".the_title_attribute( array( 'echo' => 0 ) )."'/></div>";
                                                }
                                                echo '</a>';
                                              }else{  
                                            //  echo '<a href="#" title="' . get_the_title() . '">';
                                              if($image_size == "custom_size"){?>
                                               <a href="<?php the_permalink(); ?>">
                                               <?php 
                                               echo "<div style='width:".$custom_width.";height:".$custom_height."'><img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail' /></div>";
                                                ?>
                                                </a>
                                                <?php 
                                              }else{
                                                switch($image_size){
                                                  case 'full':
                                                  $width = "263";
                                                  $height = "192";
                                                  break;
                                                  case 'large':
                                                  $width = "263";
                                                  $height = "192";
                                                  break;
                                                    case 'thumbnail':
                                                  $width = "150";
                                                  $height = "150";
                                                  break;
                                                    case 'medium-large':
                                                  $width = "263";
                                                  $height = "192";
                                                  break;
                                                }
                                              ?>
                                              <a href="<?php the_permalink(); ?>"> 
                                              <?php
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail' width='".$width."' height='".$height."'/>";
                                              ?></a>
                                              <?php }
                                            
                                             }
                                          }else{
                                            if($image_size == "custom_size"){
                                                  $cwidth = $width;
                                                  $cheight = $height;
                                            }else{
                                                switch($image_size){
                                                  case 'full':
                                                  $cwidth = "263";
                                                  $cheight = "192";
                                                  break;
                                                  case 'large':
                                                  $cwidth = "263";
                                                  $cheight = "192";
                                                  break;
                                                    case 'thumbnail':
                                                  $cwidth = "150";
                                                  $cheight = "150";
                                                  break;
                                                    case 'medium-large':
                                                  $cwidth = "263";
                                                  $cheight = "192";
                                                  break;
                                                }

                                            }
                                             ?>
                                              <a href="<?php the_permalink(); ?>"> 
                                              <?php
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail' width='".$cwidth."' height='".$cheight."'/>";
                                              ?></a>
                                              <?php 
                                          }
                                          } ?>
                                     
                                  </div>
                                  
                                  <div class="wpmm-second-wrapper">

                                          <div class="wpmm-woo-category-lists">
                                              <!-- show category -->
                                              <?php 
                                              if(isset($product_show_category) && $product_show_category == 1){
                                              if($product_type == "category" && $product_category != 'all'){
                                                $term = get_term($product_category, 'product_cat' );
                                                  // Name
                                                 $name =  $term->name;?>
                                                   <span class="product_category_title"><?php echo $name; ?></span>
                                              <?php }else{ 
                                                     $prod_terms = get_the_terms(get_the_ID(), 'product_cat' );
                                                     if(isset($prod_terms) && !empty($prod_terms)){ ?>
                                                     <?php 
                                                       foreach ($prod_terms as $key => $value) {
                                                        echo "<span class='product_category_title'>";
                                                        echo $value->name;
                                                        echo "</span>";
                                                        }?>
                                                      <?php  
                                                     }
                                                 } 
                                              }
                                              ?>
                                         </div>
                                           <!-- show title -->
                                          <div class="wpmm-woo-content">
                                          <a href="<?php the_permalink(); ?>">
                                          <?php woocommerce_template_loop_product_title(); ?>
                                           </a>
                                       
                                          <?php 
                                               if($product_show_description == 1){ ?>
                                                     <!-- show description -->
                                              <?php       
                                                echo "<div class='product-desc'>";
                                                $desc = WPMM_Libary::wpmm_get_excerptbyid(get_the_ID(),$post_length);
                                                echo "<p class='all-product-desc'>".$desc."</p>";
                                               echo "</div>";
                                            }           
                                           ?>
                                          
                                          <?php 
                                          if($rating == 1){ ?>
                                           <!-- show rating -->
                                           <?php woocommerce_template_loop_rating();
                                          }
                                            woocommerce_template_loop_price(); ?>
                                          
                                         
                                          <?php if(isset($show_addtocart) && $show_addtocart == 1){?>
                                            <!-- show add to cart -->
                                          <?php woocommerce_template_loop_add_to_cart(); ?>
                                          <?php } ?>
                                         
                                           </div>
                                      </div>
                                    </div>
                                  </li>
                                <?php
                               } } wp_reset_query(); ?>                    
                            </ul>
                          
                        </div>
                    </div>
    
            </div><!-- End Products --> 
            <?php
             echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
        $instance['display_title'] = strip_tags( $new_instance['display_title'] );
        $instance['product_list_category'] = strip_tags( $new_instance['product_list_category'] );
        $instance['product_list_type'] = strip_tags( $new_instance['product_list_type'] );
        $instance['product_list_number'] = strip_tags( $new_instance['product_list_number'] );
        $instance['product_post_length'] = strip_tags( $new_instance['product_post_length'] );
        $instance['product_show_description'] = strip_tags( $new_instance['product_show_description'] );
        $instance['product_show_category'] = strip_tags( $new_instance['product_show_category'] );
        $instance['image_layout'] = strip_tags( $new_instance['image_layout'] );
        $instance['product_show_image'] =  strip_tags( $new_instance['product_show_image'] );
        $instance['show_addtocart'] =  strip_tags( $new_instance['show_addtocart'] );
        $instance['rating']   = strip_tags( $new_instance['rating'] );
        $instance['image_size']   = strip_tags( $new_instance['image_size'] );
        $instance['custom_height']   = strip_tags( $new_instance['custom_height'] );
        $instance['custom_width']   = strip_tags( $new_instance['custom_width'] );





        return $instance;
    }

      

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
         $prod_type = array(
                'category' => __('Category', APMM_PRO_TD),
                'latest_product' => __('Latest Product', APMM_PRO_TD),
                'upsell_product' => __('UpSell Product', APMM_PRO_TD),
                'feature_product' => __('Featured Product', APMM_PRO_TD),
                'on_sale' => __('On Sale Product', APMM_PRO_TD)
            );
          $image_layout = array(
                'left_image_with_content' => __('Image On Left of Content', APMM_PRO_TD),
                // 'right_image_with_content' => __('Image On Right of Content', APMM_PRO_TD),
                'top_image_with_content' => __('Image On Top of Content', APMM_PRO_TD)
            );
           $imagesize = array(
                'full' => __('Full', APMM_PRO_TD),
                'thumbnail' => __('Thumbnail', APMM_PRO_TD),
                'medium' => __('Medium', APMM_PRO_TD),
                'medium-large' => __('Medium Large', APMM_PRO_TD),
                'large' => __('Large', APMM_PRO_TD),
                'post-thumbnail' => __('Post Thumbnail', APMM_PRO_TD),
                'custom_size' => __('Custom Image Size', APMM_PRO_TD)
            );

              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories['all'] = 'Select Any Product';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
              
            $display_title = isset($instance['display_title'])?$instance['display_title']:'';
            $product_list_type = isset($instance['product_list_type'])?$instance['product_list_type']:'';
            $product_list_category = isset($instance['product_list_category'])?$instance['product_list_category']:'';
            $product_list_number = isset($instance['product_list_number'])?$instance['product_list_number']:'';
            $product_post_length = isset($instance['product_post_length'])?$instance['product_post_length']:'';
            $product_show_description = isset($instance['product_show_description'])?$instance['product_show_description']:'0';
            $featuredimage_layout = isset($instance['image_layout'])?$instance['image_layout']:'';
            $product_show_category = isset($instance['product_show_category'])?$instance['product_show_category']:'0';
            $product_show_image = isset($instance['product_show_image'])?$instance['product_show_image']:'0';
            $show_addtocart = isset($instance['show_addtocart'])?$instance['show_addtocart']:'0';
            $rating = isset($instance['rating'])?$instance['rating']:'0';
            
            $image_size  = (isset($instance['image_size']) && $instance['image_size'] != '')?esc_attr( $instance['image_size'] ):'large';
            $custom_width  = (isset($instance['custom_width']) && $instance['custom_width'] != '')?esc_attr( $instance['custom_width'] ):'';
            $custom_height  = (isset($instance['custom_height']) && $instance['custom_height'] != '')?esc_attr( $instance['custom_height'] ):'';
            ?>
   
              <p>
              <label for="<?php echo $this->get_field_id('display_title');?>"><?php _e('Title',APMM_PRO_TD)?> :</label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display_title' ); ?>" 
             name="<?php echo $this->get_field_name( 'display_title' ); ?>" value="<?php echo esc_attr( $display_title ); ?>"/>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('product_list_type'); ?>">
                <?php _e('Select Product Type',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('product_list_type'); ?>" 
                id="<?php echo $this->get_field_id('product_list_type'); ?>" class="widefat wpmmpro-listtype">
                    <?php foreach ($prod_type as $p_type => $type) { ?>
                        <option value="<?php echo $p_type; ?>" <?php selected($p_type, $product_list_type); ?>>
                        <?php echo $type; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p class="wpmm-listcatgory-field">
                <label for="<?php echo $this->get_field_id('product_list_category'); ?>">
                <?php _e('Select Product Category',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('product_list_category'); ?>" 
                id="<?php echo $this->get_field_id('product_list_category'); ?>" class="widefat wpmmpro-listcategory">
                    <?php 
                    foreach ($woocommerce_categories as $c_type => $ctype) { ?>
                        <option value="<?php echo $c_type; ?>" <?php selected($c_type, $product_list_category); ?>>
                        <?php echo $ctype; ?></option>
                    <?php } ?>
                </select>
            </p>
             <p class="smallfield">
             <!-- for input number type add attr step="3" min="1"  -->
                <label for="<?php echo $this->get_field_id('product_list_number'); ?>"><?php _e('Post Per Page',APMM_PRO_TD)?></label><br />
                <input name="<?php echo $this->get_field_name('product_list_number'); ?>" type="number" id="<?php echo $this->get_field_id('product_list_number'); ?>"
                value="<?php echo esc_attr($product_list_number); ?>" class="widefat" />
            </p>
            
            <p class="smallfield">
              <label for="<?php echo $this->get_field_id('product_show_description');?>"><?php _e('Show Excerpt',APMM_PRO_TD)?></label>
             <br/><input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'product_show_description' ); ?>"
             name="<?php echo $this->get_field_name( 'product_show_description' ); ?>" value="1" <?php checked($product_show_description,'1'); ?>/>
            </p>

             <p class="smallfield">
              <label for="<?php echo $this->get_field_id('product_post_length');?>"><?php _e('Excerpt Length',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'product_post_length' ); ?>"
             name="<?php echo $this->get_field_name( 'product_post_length' ); ?>" value="<?php echo esc_attr( $product_post_length ); ?>"/>
            </p>

            <p>
              <label for="<?php echo $this->get_field_id('product_show_category');?>"><?php _e('Show Category',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'product_show_category' ); ?>"
             name="<?php echo $this->get_field_name( 'product_show_category' ); ?>" value="1" <?php checked($product_show_category,'1'); ?>/>
            </p>
            
            <p>
              <label for="<?php echo $this->get_field_id('rating');?>"><?php _e('Show Rating',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'rating' ); ?>"
             name="<?php echo $this->get_field_name( 'rating' ); ?>" value="1" <?php checked($rating,'1'); ?>/>
            </p>

             <p>
              <label for="<?php echo $this->get_field_id('show_addtocart');?>"><?php _e('Show Add To Cart Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_addtocart' ); ?>"
             name="<?php echo $this->get_field_name( 'show_addtocart' ); ?>" value="1" <?php checked($show_addtocart,'1'); ?>/>
            </p>

             <p>
              <label for="<?php echo $this->get_field_id('product_show_image');?>"><?php _e('Show Featured Image',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat wpmmshowimg" id="<?php echo $this->get_field_id( 'product_show_image' ); ?>"
             name="<?php echo $this->get_field_name( 'product_show_image' ); ?>" value="1" <?php checked($product_show_image,'1'); ?>/>
            </p>
            <div class="show_image_options">
            <p>
                <label for="<?php echo $this->get_field_id('image_size'); ?>">
                <?php _e('Image Size',APMM_PRO_TD)?></label>
                <select name="<?php echo $this->get_field_name('image_size'); ?>" 
                id="<?php echo $this->get_field_id('image_size'); ?>" class="widefat wpmmpro-listsize">
                    <?php if(isset($imagesize)){
                     foreach ($imagesize as $custom_imgsize => $imgsize) { ?>
                        <option value="<?php echo $custom_imgsize; ?>" <?php selected($custom_imgsize, $image_size); ?>>
                        <?php echo $imgsize; ?></option>
                          
                    <?php   } } ?>
                </select>
            </p>

              <?php 

              if($image_size == "custom_size"){
                 $style= '';
                }else{
                  $style= 'style="display:none;"';
              }
              ?>
             <p class="smallfieldsize" <?php echo $style;?>>
              <label for="<?php echo $this->get_field_id('custom_width');?>"><?php _e('Width',APMM_PRO_TD)?> :</label>
             <input type="text" class="widefat custom" id="<?php echo $this->get_field_id( 'custom_width' ); ?>"
             name="<?php echo $this->get_field_name( 'custom_width' ); ?>" placeholder="<?php _e('E.g., 120px',APMM_PRO_TD);?>" value="<?php echo esc_attr($custom_width); ?>"/>
              <label for="<?php echo $this->get_field_id('custom_height');?>"><?php _e('Height',APMM_PRO_TD)?> :</label>
              <input type="text" class="widefat custom" id="<?php echo $this->get_field_id( 'custom_height' ); ?>"
              name="<?php echo $this->get_field_name( 'custom_height' ); ?>" placeholder="<?php _e('E.g., 120px',APMM_PRO_TD);?>" value="<?php echo esc_attr($custom_height); ?>"/>
            </p>

              <p>
                <label for="<?php echo $this->get_field_id('image_layout'); ?>">
                <?php _e('Select Image Layout Type',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('image_layout'); ?>" 
                id="<?php echo $this->get_field_id('image_layout'); ?>" class="widefat">
                    <?php foreach ($image_layout as $img_type => $img) { ?>
                        <option value="<?php echo $img_type; ?>" <?php selected($img_type, $featuredimage_layout); ?>>
                        <?php echo $img; ?></option>
                    <?php } ?>
                </select>
            </p>
            </div>
          <style type="text/css">
            .smallfield {
              display: inline-block;
              float: left;
              margin: 11px;
              width: 69px;
          }
          .widefat.custom {
              width: 89px;
          }
          </style>
     

            <?php 
       
    }
}

endif;

if ( ! class_exists('WPMMPro_Recent_Products_widget_area') ) :
class WPMMPro_Recent_Products_widget_area extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmm_pro_recent_products_widget_area', // Base ID
                      'WPMM PRO :  Recent Products Lists Widget', // Name
                       array('description' => __('A widget that shows WooCommerce Recent/On Sale/Featured/Upsell Products.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
            extract($args);
            extract($instance);
          
            $display_title = (isset($instance['display_title']) && $instance['display_title'] != '')?esc_attr( $instance['display_title'] ):'';
            $product_type = (isset($instance['product_list_type']) && $instance['product_list_type'] != '')?esc_attr( $instance['product_list_type'] ):'category';
            $product_category = (isset($instance['product_list_category']) && $instance['product_list_category'] != '')?esc_attr( $instance['product_list_category'] ):'all';
            $product_number = (isset($instance['product_list_number']) && $instance['product_list_number'] != '')?esc_attr( $instance['product_list_number'] ):'3';
            $display_title = (isset($instance['show_addtocart']) && $instance['show_addtocart'] != '')?esc_attr( $instance['show_addtocart'] ):'0';
            $product_show_category = (isset($instance['product_show_category']) && $instance['product_show_category'] != '')?esc_attr( $instance['product_show_category'] ):'0';  
            $show_addtocart = (isset($instance['show_addtocart']) && $instance['show_addtocart'] != '')?esc_attr( $instance['show_addtocart'] ):'0';
            $rating  = (isset($instance['rating']) && $instance['rating'] != '')?esc_attr( $instance['rating'] ):'0';
            $show_price  = (isset($instance['show_price']) && $instance['show_price'] != '')?esc_attr( $instance['show_price'] ):'0';
            $show_button = (isset($instance['show_button']) && $instance['show_button'] != '')?esc_attr( $instance['show_button'] ):'0';
            $link_name = (isset($instance['link_name']) && $instance['link_name'] != '')?esc_attr( $instance['link_name'] ):'';
            $order_by =(isset($instance['order_by']) && $instance['order_by'] != '')?esc_attr( $instance['order_by'] ):'date';
            $ordertype =(isset($instance['ordertype']) && $instance['ordertype'] != '')?esc_attr( $instance['ordertype'] ):'desc';

          if($product_type == 'category'){
                if($product_category == "all"){
                    $product_args = array(
                         'post_type' => 'product',
                         'posts_per_page' => $product_number,
                         'orderby' => $order_by,
                         'order' => $ordertype
                     );

                }else{
                          $product_args = array(
                         'post_type' => 'product',
                         'tax_query' => array(
                             array('taxonomy'  => 'product_cat',
                              'field'     => 'id', 
                              'terms'     => $product_category                                                                 
                             )
                         ),
                         'posts_per_page' => $product_number
                     );

                }
             }else if($product_type == 'latest_product'){
                 $product_label_custom = __('New', APMM_PRO_TD);
                if($product_category == "all"){
                  $product_args = array(
                       'post_type' => 'product',
                       'posts_per_page' => $product_number,
                       'orderby' => $order_by,
                       'order' => $ordertype
                   );
                 }else{
                 $product_args = array(
                     'post_type' => 'product',                
                        'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                     'posts_per_page' => $product_number,
                     'orderby' => $order_by,
                     'order' => $ordertype
                 );
               }
             }
             
             elseif($product_type == 'feature_product'){
               if($product_category == "all"){
                  $product_args = array(
                       'post_type' => 'product',
                       'meta_key'         => '_featured',  
                       'meta_value'       => 'yes',
                       'posts_per_page' => $product_number,
                       'orderby' => $order_by,
                       'order' => $ordertype
                   );
                 }else{
                 $product_args = array(
                     'post_type'        => 'product',  
                     'meta_key'         => '_featured',  
                     'meta_value'       => 'yes',
                        'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                     'posts_per_page'   => $product_number,
                      'orderby' => $order_by,
                      'order' => $ordertype  
                 );
               }
             }
         
             elseif($product_type == 'upsell_product'){
              if($product_category == "all"){
                  $product_args = array(
                       'post_type' => 'product',
                       'meta_key'          => 'total_sales',
                       'orderby'           => 'meta_value_num',
                       'posts_per_page' => $product_number,
                       'order' => $ordertype
                   );
                 }else{
                 $product_args = array(
                     'post_type'         => 'product',
                     'meta_key'          => 'total_sales',
                     'orderby'           => 'meta_value_num',
                        'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                     'posts_per_page'    => $product_number,
                     'order' => $ordertype
                 );
               }
             }
         
             elseif($product_type == 'on_sale'){
               if($product_category == "all"){
                  $product_args = array(
                       'post_type' => 'product',
                       'meta_key'          => 'total_sales',
                       'orderby'           => 'meta_value_num',
                       'posts_per_page' => $product_number,
                       'order' => $ordertype,
                    'meta_query'     => array(
                     'relation' => 'OR',
                     array( // Simple products type
                         'key'           => '_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     ),
                     array( // Variable products type
                         'key'           => '_min_variation_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     )
                 ));
                
                 }else{
                 $product_args = array(
                 'post_type'      => 'product',
                 'posts_per_page'    => $product_number,
                 'orderby' => $order_by,
                 'order' => $ordertype,
                  'tax_query' => array(
                         array('taxonomy'  => 'product_cat',
                          'field'     => 'id', 
                          'terms'     => $product_category                                                                 
                         )
                     ),
                 'meta_query'     => array(
                     'relation' => 'OR',
                     array( // Simple products type
                         'key'           => '_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     ),
                     array( // Variable products type
                         'key'           => '_min_variation_sale_price',
                         'value'         => 0,
                         'compare'       => '>',
                         'type'          => 'numeric'
                     )
                 ));
               }
             }
            echo $before_widget;  ?>

              <div class="wpmm-pro-recent-product-widget">
                        <div id="rec-product-list" class="rec-product-list-area clearfix">
                            
                            <div class="rprod-block-title clearfix">
                             <?php  if (!empty($instance['display_title'])) {
                                    echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
                                }
                                ?>
                             </div>
                            
                            <ul class="all-re-product-list">
                                <?php             

                                    $query = new WP_Query($product_args);
                              
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                  <li <?php post_class(); ?>>
                                  <div class="wpmm-recent-product-image-section wpmegamenupro-clearfix">
                                  <!-- show featured image -->
                                  <div class="wpmm-recentpro-left-section">
                                     <a href="<?php the_permalink(); ?>">
                                        <?php
                                          if ( has_post_thumbnail() ) {
                                             woocommerce_show_product_loop_sale_flash();
                                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full');
                                              if ( ! empty( $large_image_url[0] ) ) { 
                                                echo "<img src='".esc_url( $large_image_url[0] )."' alt='".the_title_attribute( array( 'echo' => 0 ) )."'/>";
                                              }else{  
                                                woocommerce_show_product_loop_sale_flash();
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                             }
                                            }else{   
                                              woocommerce_show_product_loop_sale_flash();
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                             } ?>
                                      </a>
                                  </div>
                                  <!-- left section end -->
                                  <div class="wpmm-recentpro-right-section">
                                  <!-- show category -->
                                    <?php if(isset($product_show_category) && $product_show_category == 1){
                                    if($product_type == "category" && $product_category != 'all'){
                                      $term = get_term($product_category, 'product_cat' );
                                         $name =  $term->name;?>
                                         <span class="recent_product_category_title"><?php echo $name; ?></span>
                                    <?php }else{ 
                                           $prod_terms = get_the_terms(get_the_ID(), 'product_cat' );
                                           if(isset($prod_terms) && !empty($prod_terms)){ ?>
                                           <?php 
                                             foreach ($prod_terms as $key => $value) {
                                              echo "<span class='recent_product_category_title'>";
                                              echo $value->name;
                                              echo "</span>";
                                              }?>
                                            <?php  
                                           }
                                       } 
                                    }?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php woocommerce_template_loop_product_title(); ?>
                                    </a>
                                    <?php 
                                    if($show_price == 1){ 
                                       // <!-- show price -->
                                      woocommerce_template_loop_price();
                                      }
                                      if($rating == 1){ 
                                       // <!-- show rating -->
                                      woocommerce_template_loop_rating();
                                      }

                                     if(isset($show_button) && $show_button != 1 && $link_name != ''){
                                          echo "<a class='all-product-link' href='".get_the_permalink()."'>".$link_name."</a>";
                                       } ?>

                                      <?php if(isset($show_addtocart) && $show_addtocart == 1){?>
                                        <!-- show add to cart -->
                                      <?php woocommerce_template_loop_add_to_cart(); ?>
                                      <?php } ?>
                                    </div> <!-- right section end -->

                                    </div>
                                  </li>
                                <?php
                               } } wp_reset_query(); ?>                    
                            </ul>
                          
                        </div>
    
            </div><!-- End Products --> 
            <?php
             echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['display_title'] = strip_tags( $new_instance['display_title'] );
        $instance['product_list_category'] = strip_tags( $new_instance['product_list_category'] );
        $instance['product_list_type'] = strip_tags( $new_instance['product_list_type'] );
        $instance['product_list_number'] = strip_tags( $new_instance['product_list_number'] );
        $instance['link_name'] = strip_tags( $new_instance['link_name'] );
        $instance['show_button'] = strip_tags($new_instance['show_button']);
        $instance['product_show_category'] = strip_tags( $new_instance['product_show_category'] );
        $instance['show_addtocart'] =  strip_tags( $new_instance['show_addtocart'] );
        $instance['rating']   = strip_tags( $new_instance['rating'] );
        $instance['show_price']   = strip_tags( $new_instance['show_price'] );
        $instance['order_by']       = strip_tags( $new_instance['order_by'] );
        $instance['ordertype']      = strip_tags( $new_instance['ordertype'] );
        return $instance;
    }

      

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
         $prod_type = array(
                'category' => __('Category', APMM_PRO_TD),
                'latest_product' => __('Recent Product', APMM_PRO_TD),
                'upsell_product' => __('UpSell Product', APMM_PRO_TD),
                'feature_product' => __('Featured Product', APMM_PRO_TD),
                'on_sale' => __('On Sale Product', APMM_PRO_TD),
            );


         
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $order_by      = isset($instance[ 'order_by' ])?$instance[ 'order_by' ]:'date';  
              $ordertype       = isset($instance[ 'ordertype' ])?$instance[ 'ordertype' ]:'desc';
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $order_by,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              $woocommerce_categories['all'] = 'Show Any Category Product';
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }
              
            $display_title = isset($instance['display_title'])?$instance['display_title']:'';
            $product_list_type = isset($instance['product_list_type'])?$instance['product_list_type']:'';
            $product_list_category = isset($instance['product_list_category'])?$instance['product_list_category']:'';
            $product_list_number = isset($instance['product_list_number'])?$instance['product_list_number']:'';
            $link_name = isset($instance['link_name'])?$instance['link_name']:'';
            $featuredimage_layout = isset($instance['image_layout'])?$instance['image_layout']:'';
            $product_show_category = isset($instance['product_show_category'])?$instance['product_show_category']:'0';
            $show_addtocart = isset($instance['show_addtocart'])?$instance['show_addtocart']:'0';
            $rating = isset($instance['rating'])?$instance['rating']:'0';
            $show_price = isset($instance['show_price'])?$instance['show_price']:'0';
            $show_button = isset($instance['show_button'])?$instance['show_button']:'0';
           

            ?>
   
            <p>
              <label for="<?php echo $this->get_field_id('display_title');?>"><?php _e('Title',APMM_PRO_TD)?> :</label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display_title' ); ?>" 
             name="<?php echo $this->get_field_name( 'display_title' ); ?>" value="<?php echo esc_attr( $display_title ); ?>"/>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('product_list_type'); ?>">
                <?php _e('Select Product Type',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('product_list_type'); ?>" 
                id="<?php echo $this->get_field_id('product_list_type'); ?>" class="widefat wpmmpro-listtype">
                    <?php foreach ($prod_type as $p_type => $type) { ?>
                        <option value="<?php echo $p_type; ?>" <?php selected($p_type, $product_list_type); ?>>
                        <?php echo $type; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p class="wpmm-listcatgory-field">
                <label for="<?php echo $this->get_field_id('product_list_category'); ?>">
                <?php _e('Select Product Category',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('product_list_category'); ?>" 
                id="<?php echo $this->get_field_id('product_list_category'); ?>" class="widefat wpmmpro-listcategory">
                    <?php 
                    foreach ($woocommerce_categories as $c_type => $ctype) { ?>
                        <option value="<?php echo $c_type; ?>" <?php selected($c_type, $product_list_category); ?>>
                        <?php echo $ctype; ?></option>
                    <?php } ?>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('product_list_number'); ?>"><?php _e('Post Per Page',APMM_PRO_TD)?></label><br />
                <input name="<?php echo $this->get_field_name('product_list_number'); ?>" type="number" id="<?php echo $this->get_field_id('product_list_number'); ?>"
                value="<?php echo esc_attr($product_list_number); ?>" class="widefat" />
            </p>
           <div class="clear" style="clear:both;margin-top:5px;"></div>
            <p>
              <label for="<?php echo $this->get_field_id('show_button');?>"><?php _e('Show Button Name',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_button' ); ?>"
             name="<?php echo $this->get_field_name( 'show_button' ); ?>" value="1" <?php checked($show_button,'1'); ?>/>
            </p>
              <div class="clear" style="clear:both;"></div>
             <p>
                <label for="<?php echo $this->get_field_id('link_name'); ?>"><?php _e('Button Name',APMM_PRO_TD)?></label><br />
                <input name="<?php echo $this->get_field_name('link_name'); ?>" placeholder="<?php _e('E.g., Read More',APMM_PRO_TD);?>" type="text" id="<?php echo $this->get_field_id('link_name'); ?>"
                value="<?php echo esc_attr($link_name); ?>" class="widefat" />
             </p>

            <p>
              <label for="<?php echo $this->get_field_id('product_show_category');?>"><?php _e('Show Category',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'product_show_category' ); ?>"
             name="<?php echo $this->get_field_name( 'product_show_category' ); ?>" value="1" <?php checked($product_show_category,'1'); ?>/>
            </p>
            
            <p>
              <label for="<?php echo $this->get_field_id('rating');?>"><?php _e('Show Rating',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'rating' ); ?>"
             name="<?php echo $this->get_field_name( 'rating' ); ?>" value="1" <?php checked($rating,'1'); ?>/>
            </p>

              <p>
              <label for="<?php echo $this->get_field_id('show_price');?>"><?php _e('Show Price',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_price' ); ?>"
             name="<?php echo $this->get_field_name( 'show_price' ); ?>" value="1" <?php checked($show_price,'1'); ?>/>
            </p>

            <p>
              <label for="<?php echo $this->get_field_id('show_addtocart');?>"><?php _e('Show Add To Cart Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_addtocart' ); ?>"
             name="<?php echo $this->get_field_name( 'show_addtocart' ); ?>" value="1" <?php checked($show_addtocart,'1'); ?>/>
            </p>

             <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>">
                <?php _e('Select Order By',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order_by'); ?>" 
                id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat">
                        <option value="ID" <?php selected('ID', $order_by); ?>>ID</option>
                        <option value="title" <?php selected('title', $order_by); ?>>Title</option>
                        <option value="name" <?php selected('name', $order_by); ?>>Name</option>
                        <option value="date" <?php selected('date', $order_by); ?>>Date</option>
                        <option value="rand" <?php selected('rand', $order_by); ?>>Random Number</option>
                        <option value="menu_order" <?php selected('menu_order', $order_by); ?>>Menu Order</option>
                        <option value="author" <?php selected('author', $order_by); ?>>Author</option>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('ordertype'); ?>">
                <?php _e('Select Order',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('ordertype'); ?>" 
                id="<?php echo $this->get_field_id('ordertype'); ?>" class="widefat">type) { ?>
                        <option value="asc" <?php selected('asc', $ordertype); ?>>ASC</option>
                        <option value="desc" <?php selected('desc', $ordertype); ?>>DESC</option>  
                </select>
            </p>
            
           
            <?php 
       
    }
}

endif;


if ( ! class_exists('WPMMPro_Products_With_Cart_widget_area') ) :
class WPMMPro_Products_With_Cart_widget_area extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmm_pro_products_cart_widget_area', // Base ID
                      'WPMM PRO : Woo Products Layout 2 Widget', // Name
                       array('description' => __('A widget that shows WooCommerce Products With Add to Cart Button on different layouts.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
            extract($args);
            extract($instance);
            $display_title = esc_attr( $instance['display_title'] );
            $product_number = (isset($instance['product_number']) && $instance['product_number'] != '')?intval( $instance['product_number'] ):'3';
            $show_add_to_cart = (isset($instance['show_add_to_cart']) && $instance['show_add_to_cart'] != '')?esc_attr( $instance['show_add_to_cart'] ):'0';
            $rating  = (isset($instance['rating']) && $instance['rating'] != '')?esc_attr( $instance['rating'] ):'0';
            $show_price  = (isset($instance['show_price']) && $instance['show_price'] != '')?esc_attr( $instance['show_price'] ):'0';
            $order_by =(isset($instance['order_by']) && $instance['order_by'] != '')?esc_attr( $instance['order_by'] ):'date';
            $ordertype =(isset($instance['ordertype']) && $instance['ordertype'] != '')?esc_attr( $instance['ordertype'] ):'desc';
            $pargs = array(
                       'post_type' => 'product',
                       'posts_per_page' => $product_number,
                       'orderby' => $order_by,
                       'order' => $ordertype
                   );
  
            echo $before_widget;  ?>

              <div class="wpmm-pro-woo-product-widget">
                        <div id="new-layout-product-list" class="new-layout-product-list-area clearfix">
                            
                            <div class="new-layout-block-title clearfix">
                             <?php  if (!empty($instance['display_title'])) {
                                    echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
                                }
                                ?>
                             </div>
                            
                            <ul class="all-woo-product-new-layout">
                                <?php             

                                    $query = new WP_Query($pargs);
                              
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                  <li <?php post_class(); ?>>
                                  <div class="wpmm-wooproduct-image-section wpmegamenupro-clearfix">
                                  <!-- show featured image -->
                                  <div class="wpmm-new-layout-top-section">
                                        <?php
                                          if ( has_post_thumbnail() ) {
                                             woocommerce_show_product_loop_sale_flash();
                                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'full');
                                              if ( ! empty( $large_image_url[0] ) ) { 
                                                echo "<img src='".esc_url( $large_image_url[0] )."' alt='".the_title_attribute( array( 'echo' => 0 ) )."'/>";
                                              }else{  
                                                woocommerce_show_product_loop_sale_flash();
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                             }
                                            }else{   
                                              woocommerce_show_product_loop_sale_flash();
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                             } ?>
                                       <?php if(isset($show_add_to_cart) && $show_add_to_cart == 1){?>
                                        <!-- show add to cart -->
                                      <?php woocommerce_template_loop_add_to_cart(); ?>
                                      <?php } ?>
                                  </div>
                                  <!-- top section end -->
                                  <div class="wpmm-new-layout-bottom-section">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php woocommerce_template_loop_product_title(); ?>
                                    </a>
                                    <?php 
                                     if($rating == 1){ 
                                       // <!-- show rating -->
                                      woocommerce_template_loop_rating();
                                      }
                                    if($show_price == 1){ 
                                       // <!-- show price -->
                                      woocommerce_template_loop_price();
                                      }
                                     ?>

                                    </div> <!-- bottom section end -->

                                    </div>
                                  </li>
                                <?php
                               } } wp_reset_query(); ?>                    
                            </ul>
                          
                        </div>
    
            </div><!-- End Products --> 
            <?php
             echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
        $instance['display_title'] = strip_tags( $new_instance['display_title'] );
        $instance['product_number'] = strip_tags( $new_instance['product_number'] );
        $instance['show_add_to_cart'] =  strip_tags( $new_instance['show_add_to_cart'] );
        $instance['rating']   = strip_tags( $new_instance['rating'] );
        $instance['show_price']   = strip_tags( $new_instance['show_price'] );
        $instance['ordertype']   = strip_tags( $new_instance['ordertype'] );
        $instance['order_by']   = strip_tags( $new_instance['order_by'] );

        return $instance;
    }

      

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
            $display_title = isset($instance['display_title'])?$instance['display_title']:'';
            $product_number = isset($instance['product_number'])?$instance['product_number']:'';
            $rating = isset($instance['rating'])?$instance['rating']:'0';
            $show_price = isset($instance['show_price'])?$instance['show_price']:'0';
            $order_by = isset($instance['order_by'])?$instance['order_by']:'date';
            $ordertype = isset($instance['ordertype'])?$instance['ordertype']:'desc';
            $show_add_to_cart = isset($instance['show_add_to_cart'])?$instance['show_add_to_cart']:'0';

            ?>
   
            <p>
              <label for="<?php echo $this->get_field_id('display_title');?>"><?php _e('Title',APMM_PRO_TD)?> :</label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display_title' ); ?>" 
             name="<?php echo $this->get_field_name( 'display_title' ); ?>" value="<?php echo esc_attr( $display_title ); ?>"/>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('product_number'); ?>"><?php _e('Post Per Page',APMM_PRO_TD)?></label><br />
                <input name="<?php echo $this->get_field_name('product_number'); ?>" type="number" id="<?php echo $this->get_field_id('product_number'); ?>"
                value="<?php echo esc_attr($product_number); ?>" class="widefat" />
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('rating');?>"><?php _e('Show Rating',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'rating' ); ?>"
             name="<?php echo $this->get_field_name( 'rating' ); ?>" value="1" <?php checked($rating,'1'); ?>/>
            </p>

              <p>
              <label for="<?php echo $this->get_field_id('show_price');?>"><?php _e('Show Price',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_price' ); ?>"
             name="<?php echo $this->get_field_name( 'show_price' ); ?>" value="1" <?php checked($show_price,'1'); ?>/>
            </p>

            <p>
              <label for="<?php echo $this->get_field_id('show_add_to_cart');?>"><?php _e('Show Add To Cart Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_add_to_cart' ); ?>"
             name="<?php echo $this->get_field_name( 'show_add_to_cart' ); ?>" value="1" <?php checked($show_add_to_cart,'1'); ?>/>
            </p>

             <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>">
                <?php _e('Select Order By',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order_by'); ?>" 
                id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat">
                        <option value="ID" <?php selected('ID', $order_by); ?>>ID</option>
                        <option value="title" <?php selected('title', $order_by); ?>>Title</option>
                        <option value="name" <?php selected('name', $order_by); ?>>Name</option>
                        <option value="date" <?php selected('date', $order_by); ?>>Date</option>
                        <option value="rand" <?php selected('rand', $order_by); ?>>Random Number</option>
                        <option value="menu_order" <?php selected('menu_order', $order_by); ?>>Menu Order</option>
                        <option value="author" <?php selected('author', $order_by); ?>>Author</option>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('ordertype'); ?>">
                <?php _e('Select Order',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('ordertype'); ?>" 
                id="<?php echo $this->get_field_id('ordertype'); ?>" class="widefat">type) { ?>
                        <option value="asc" <?php selected('asc', $ordertype); ?>>ASC</option>
                        <option value="desc" <?php selected('desc', $ordertype); ?>>DESC</option>  
                </select>
            </p>
            
           
            <?php 
       
    }
}

endif;

//======================================= Woocommerce Widget END ==================================================//

if ( ! class_exists('WPMMPro_Simple_Recent_Posts') ) :
class WPMMPro_Simple_Recent_Posts extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmm_pro_simple_recent_posts_widget_area', // Base ID
                      'WPMM PRO : Recent Posts Widget', // Name
                       array('description' => __('A widget that shows recent posts by order on 3 different layouts.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
      
   public function widget($args, $instance) {
            extract($args);
            extract($instance);
            $display_title =(isset($instance['display_title']) && $instance['display_title'] != '')?esc_attr( $instance['display_title'] ):'';
            $posts_number = (isset($instance['posts_number']) && $instance['posts_number'] != '')?intval( $instance['posts_number'] ):'3';
            $show_category = (isset($instance['show_category']) && $instance['show_category'] != '')?esc_attr( $instance['show_category'] ):'0';
            $show_comment_number  = (isset($instance['show_comment_number']) && $instance['show_comment_number'] != '')?esc_attr( $instance['show_comment_number'] ):'0';
            //$show_posts_views  = (isset($instance['show_posts_views']) && $instance['show_posts_views'] != '')?esc_attr( $instance['show_posts_views'] ):'0';
            $show_date  = (isset($instance['show_date']) && $instance['show_date'] != '')?esc_attr( $instance['show_date'] ):'0';
            $enable_button  = (isset($instance['enable_button']) && $instance['enable_button'] != '')?esc_attr( $instance['enable_button'] ):'0';
            $btntarget  = (isset($instance['btntarget']))?esc_attr( $instance['btntarget'] ):'_self';
            $button_name  = (isset($instance['button_name']) && $instance['button_name'] != '')?esc_attr( $instance['button_name'] ):'';
            $order_by =(isset($instance['order_by']) && $instance['order_by'] != '')?esc_attr( $instance['order_by'] ):'date';
            $ordertype =(isset($instance['ordertype']) && $instance['ordertype'] != '')?esc_attr( $instance['ordertype'] ):'desc';
            $posts_hover_layout_type =(isset($instance['posts_hover_layout_type']) && $instance['posts_hover_layout_type'] != '')?esc_attr( $instance['posts_hover_layout_type'] ):'hoverlayout1';
            $pargs = array(
                       'post_type' => 'post',
                       'posts_per_page' => $posts_number,
                       'orderby' => $order_by,
                       'order' => $ordertype
                   );
  
            echo $before_widget;  ?>

              <div class="wpmm-pro-recent-posts-widget">
                        <div id="wpmm-recent-post-lists">
                            
                            <div class="new-layout-block-title clearfix">
                             <?php  if (!empty($instance['display_title'])) {
                                    echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
                                }
                                ?>
                             </div>
                             <?php 
                             if( $posts_hover_layout_type == "hoverlayout1"){
                                 $hoverclass = "layout1";
                             }else if( $posts_hover_layout_type == "hoverlayout2"){
                                 $hoverclass = "layout2";
                             }else{
                                $hoverclass = "layout3";
                             }?>
                            
                            <ul class="wpmm-pro-recent-posts <?php echo $hoverclass;?>">
                                <?php             

                                    $query = new WP_Query($pargs);
                              
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                  <li <?php post_class(); ?>>
                                  <div class="wpmm-recentposts-section wpmegamenupro-clearfix">
                                  <!-- show featured image -->
                                  <a href="<?php the_permalink(); ?>" target="<?php echo $btntarget;?>" class="wpmm-recent-posts-title">
                                  <div class="wpmm-image-left-section">
                                        <?php
                                          if ( has_post_thumbnail() ) {
                                              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'thumbnail');
                                              if ( ! empty( $large_image_url[0] ) ) {
                                                echo "<img src='".esc_url( $large_image_url[0] )."' alt='".the_title_attribute( array( 'echo' => 0 ) )."'/>";
                                              }else{ 
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                              }
                                            }else{   
                                               echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                                           } ?>
                                  </div>
                                  </a>
                                  <!-- left section end -->
                                  <div class="wpmm-content-right-section">
                                     <?php
                                     if($show_category){  ?>
                                    <div class="wpmm-posts-category-lists">
                                     <?php
                                       $category_detail = get_the_category( get_the_ID() ,array( 'fields' => 'names' ));//$post->ID
                                     if(isset($category_detail) && !empty($category_detail )):
                                      foreach($category_detail as $cd){
                                        echo "<span class='wpmm-cat'>".$cd->name."</span>";
                                        }
                                      endif;
                                   ?>
                                   </div>
                                   <?php
                                     }
                                     if($show_date){ 
                                       $format = 'F j, Y';
                                       $pfx_datee = get_the_date( $format, get_the_ID() );
                                      echo "<span class='wpmm-display-date'>".$pfx_datee."</span>";
                                       } ?>
                                    <a href="<?php the_permalink(); ?>" target="<?php echo $btntarget;?>" class="wpmm-recent-posts-title">
                                      <?php the_title(); ?>
                                    </a>
                                    <?php 
                                     if($show_comment_number){ 
                                      $comment_in_number2 = get_comments_number(get_the_ID());
                                      echo "<span class='wpmm-comment-number'>".$comment_in_number2."</span>";
                                      } 

// if($show_posts_views){ 
// $ap_menu = new APMM_Class_Pro();
// echo $ap_menu->wpb_set_post_views(get_the_ID());
// }
                                     if($enable_button){ ?>
                                     <a href="<?php the_permalink(); ?>" target="<?php echo $btntarget;?>" class="wpmm-readmore-btn">
                                         <span><?php echo $button_name;?></span>
                                     </a>

                                     <?php }
                                      ?>
                                   

                                    </div> <!-- right section end -->

                                    </div>
                                  </li>
                                <?php
                               } } wp_reset_query(); ?>                    
                            </ul>
                          
                        </div>
    
            </div><!-- End Products --> 
            <?php
             echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['display_title'] = strip_tags( $new_instance['display_title'] );
        $instance['posts_number'] = strip_tags( $new_instance['posts_number'] );
        $instance['posts_hover_layout_type'] =  strip_tags( $new_instance['posts_hover_layout_type'] );
        $instance['show_category']   = strip_tags( $new_instance['show_category'] );
        $instance['show_comment_number']   = strip_tags( $new_instance['show_comment_number'] );
        //$instance['show_posts_views']   = strip_tags( $new_instance['show_posts_views'] );
        $instance['ordertype']   = strip_tags( $new_instance['ordertype'] );
        $instance['order_by']   = strip_tags( $new_instance['order_by'] );
        $instance['show_date']   = strip_tags( $new_instance['show_date'] );
        $instance['enable_button']   = strip_tags( $new_instance['enable_button'] );
        $instance['btntarget']   = strip_tags( $new_instance['btntarget'] );
        $instance['button_name']   = strip_tags( $new_instance['button_name'] );

        return $instance;
    }

      

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
            $display_title = isset($instance['display_title'])?$instance['display_title']:'';
            $posts_hover_layout_type = isset($instance['posts_hover_layout_type'])?$instance['posts_hover_layout_type']:'hoverlayout1';
            $posts_number = isset($instance['posts_number'])?$instance['posts_number']:'';
            $show_category = isset($instance['show_category'])?$instance['show_category']:'0';
            $show_date = isset($instance['show_date'])?$instance['show_date']:'0';
            $order_by = isset($instance['order_by'])?$instance['order_by']:'date';
            $ordertype = isset($instance['ordertype'])?$instance['ordertype']:'desc';
            $show_comment_number = isset($instance['show_comment_number'])?$instance['show_comment_number']:'0';
           // $show_posts_views = isset($instance['show_posts_views'])?$instance['show_posts_views']:'0';
            $enable_button = isset($instance['enable_button'])?$instance['enable_button']:'0';
            $btntarget = isset($instance['btntarget'])?$instance['btntarget']:'_self';
            $button_name = isset($instance['button_name'])?$instance['button_name']:'';

            ?>
    <div class="wpmm-post-display-section2">
            <p>
              <label for="<?php echo $this->get_field_id('display_title');?>"><?php _e('Title',APMM_PRO_TD)?> :</label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display_title' ); ?>" 
             name="<?php echo $this->get_field_name( 'display_title' ); ?>" value="<?php echo esc_attr( $display_title ); ?>"/>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('posts_number'); ?>"><?php _e('Post Per Page',APMM_PRO_TD)?></label><br />
                <input name="<?php echo $this->get_field_name('posts_number'); ?>" type="number" id="<?php echo $this->get_field_id('posts_number'); ?>"
                value="<?php echo esc_attr($posts_number); ?>" class="widefat" />
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_category');?>"><?php _e('Show Category',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_category' ); ?>"
             name="<?php echo $this->get_field_name( 'show_category' ); ?>" value="1" <?php checked($show_category,'1'); ?>/>
            </p>

              <p>
              <label for="<?php echo $this->get_field_id('show_date');?>"><?php _e('Show Date',APMM_PRO_TD)?> :</label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_date' ); ?>"
             name="<?php echo $this->get_field_name( 'show_date' ); ?>" value="1" <?php checked($show_date,'1'); ?>/>
            </p>

            <p>
              <label for="<?php echo $this->get_field_id('show_comment_number');?>"><?php _e('Show Comment Number',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_comment_number' ); ?>"
             name="<?php echo $this->get_field_name( 'show_comment_number' ); ?>" value="1" <?php checked($show_comment_number,'1'); ?>/>
            </p>
        <!--      <p>
              <label for="<?php echo $this->get_field_id('show_posts_views');?>"><?php _e('Show Posts Views',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_posts_views' ); ?>"
             name="<?php echo $this->get_field_name( 'show_posts_views' ); ?>" value="1" <?php checked($show_posts_views,'1'); ?>/>
            </p> -->

           <p class="posts-layout2">
                <label for="<?php echo $this->get_field_id('posts_hover_layout_type'); ?>">
                   <?php _e('Select Layout Type',APMM_PRO_TD)?>:</label>
                  <select name="<?php echo $this->get_field_name('posts_hover_layout_type'); ?>" 
                      id="<?php echo $this->get_field_id('posts_hover_layout_type'); ?>" class="widefat wpmm-posts-layout2">
                       <option value="hoverlayout1" <?php selected('hoverlayout1', $posts_hover_layout_type); ?>>Hover Layout 1</option>                                      
                       <option value="hoverlayout2" <?php selected('hoverlayout2', $posts_hover_layout_type); ?>>Hover Layout 2</option>                                      
                       <option value="hoverlayout3" <?php selected('hoverlayout3', $posts_hover_layout_type); ?>>Hover Layout 3</option>                                      
                  </select>

                <div id="hoverlayout1" class="layout_preview2" <?php if($posts_hover_layout_type == "hoverlayout1") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout4.PNG"/>
                </div>
                 <div id="hoverlayout2" class="layout_preview2" <?php if($posts_hover_layout_type == "hoverlayout2") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout5.PNG"/>
                </div>
                 <div id="hoverlayout3" class="layout_preview2" <?php if($posts_hover_layout_type == "hoverlayout3") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout6.PNG"/>
                </div>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('enable_button');?>"><?php _e('Show Link Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_button' ); ?>"
             name="<?php echo $this->get_field_name( 'enable_button' ); ?>" value="1" <?php checked($enable_button,'1'); ?>/>
            </p>
              <p>
                <label for="<?php echo $this->get_field_id('btntarget'); ?>">
                <?php _e('Select Posts Link Target',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('btntarget'); ?>" 
                id="<?php echo $this->get_field_id('btntarget'); ?>" class="widefat">
                         <option value="_blank"  <?php selected('_blank', $btntarget); ?>><?php _e('_blank',APMM_PRO_TD);?></option>
                         <option value="_self"  <?php selected('_self', $btntarget); ?>><?php _e('_self',APMM_PRO_TD);?></option>
                         <option value="_parent" <?php selected('_parent', $btntarget); ?>><?php _e('_parent',APMM_PRO_TD);?></option>
                         <option value="_top"  <?php selected('_top', $btntarget); ?>><?php _e('_top',APMM_PRO_TD);?></option>
                </select>
            </p>
                

            <p>
              <label for="<?php echo $this->get_field_id('button_name');?>"><?php _e('Button Name',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_name' ); ?>"
             name="<?php echo $this->get_field_name( 'button_name' ); ?>" value="<?php echo esc_attr($button_name);?>"/>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>">
                <?php _e('Select Order By',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order_by'); ?>" 
                id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat">
                        <option value="ID" <?php selected('ID', $order_by); ?>>ID</option>
                        <option value="title" <?php selected('title', $order_by); ?>>Title</option>
                        <option value="name" <?php selected('name', $order_by); ?>>Name</option>
                        <option value="date" <?php selected('date', $order_by); ?>>Date</option>
                        <option value="rand" <?php selected('rand', $order_by); ?>>Random Number</option>
                        <option value="menu_order" <?php selected('menu_order', $order_by); ?>>Menu Order</option>
                        <option value="author" <?php selected('author', $order_by); ?>>Author</option>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('ordertype'); ?>">
                <?php _e('Select Order',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('ordertype'); ?>" 
                id="<?php echo $this->get_field_id('ordertype'); ?>" class="widefat">type) { ?>
                        <option value="asc" <?php selected('asc', $ordertype); ?>>ASC</option>
                        <option value="desc" <?php selected('desc', $ordertype); ?>>DESC</option>  
                </select>
            </p>
            
          </div> 
            <?php 
       
    }
}

endif;



if ( ! class_exists('WP_Mega_Menu_Posts_Heading_Widget') ) :
class WP_Mega_Menu_Posts_Heading_Widget extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmm_pro_post_heading_widget', // Base ID
                      'WPMM PRO : Display Posts By Category', // Name
                       array('description' => __('A widget that shows Posts category wise with featured image.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
            extract($args);
            extract($instance);

            $display_title = esc_attr( $instance['display_title'] );
            
            $enable_excerpt = intval( $instance['enable_excerpt'] );
            $post_length = (isset($instance['post_length']) && $instance['post_length'] != '')?esc_attr( $instance['post_length'] ):'20'; // featured image options
            $postsperpage =(isset($instance['postsperpage']) && $instance['postsperpage'] != '')?esc_attr( $instance['postsperpage'] ):'3';//Posts per page
            $show_added_date = (isset($instance['show_added_date']) && $instance['show_added_date'] == 1)?'1':'0';
            $show_comment_number = (isset($instance['show_comment_number']) && $instance['show_comment_number'] == 1)?'1':'0';

            $order_by = isset($instance['order_by'])?$instance['order_by']:'id';
            $order = isset($instance['order'])?$instance['order']:'asc';
            $enable_featured_image = (isset($instance['enable_featured_image']) && $instance['enable_featured_image'] == 1)?'1':'0';
            //$column_no = isset($instance['column_no'])?$instance['column_no']:'1';
            $enable_button = (isset($instance['enable_button']) && $instance['enable_button'] == 1)?'1':'0';
            $button_name = (isset($instance['button_name']) )?$instance['button_name']:'';
            $btntarget = (isset($instance['btntarget']) )?$instance['btntarget']:'_blank';
            $category_id = $instance['category_id'];
            $explode = explode('=',$category_id);
            $category_type = $explode[0];
            $cat_slug      = $explode[1];

            $show_author_name = (isset($instance['show_author_name']) && $instance['show_author_name'] == 1)?'1':'0';
            $show_cat_name = (isset($instance['show_cat_name']) && $instance['show_cat_name'] == 1)?'1':'0';
            $posts_layout_type = isset($instance['posts_layout_type'])?$instance['posts_layout_type']:'layout1';
            $feature_image_size = isset($instance['feature_image_size'])?$instance['feature_image_size']:'large';

              if($category_type == 'category'){
               $arguments = array(
                        'post_type'      =>  array( 'post', 'post_type'),
                        'post_status'    =>  array( 'publish' ),
                        'orderby'        =>  $order_by,
                        'order'          =>  $order,
                        'posts_per_page' =>  $postsperpage,
                        'cat'            =>  $cat_slug
                );
                 $query = new WP_Query( $arguments );
             }else if($category_type == 'terms'){
              $taxonomy = $cat_slug;
              $terms_slug = $explode[2];
              $argss = array(
                                'post_status'    => array( 'publish' ),
                                'posts_per_page' =>  $postsperpage,
                                'tax_query' =>array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' =>  $terms_slug
                                        ),
                                    )
                               
                            );
                        $query = new WP_Query($argss);

             }else{
               $arguments = array(
                        'post_type'      =>  array( 'post', 'post_type'),
                        'post_status'    =>  array( 'publish' ),
                        'orderby'        =>  $order_by,
                        'order'          =>  $order,
                        'posts_per_page' =>  $postsperpage
                );
                 $query = new WP_Query( $arguments );

             }
              
                         echo $before_widget;  ?>

              <div class="wpmmpro-postslist-wrapper">
    
                    <div class="wpmm-container">

                        <div id="wpmmpro-posts-list" class="posts-list-area clearfix">
                            
                        <?php if (!empty($instance['display_title'])) {
                              echo $args['before_title'] . apply_filters('widget_title', $instance['display_title']) . $args['after_title'];
                          }?>
                            
                            <div class="wpmmpro-posts-list <?php echo 'wpmm-'.$posts_layout_type;?>">
                                <?php             
                                    if($query->have_posts()) { while ($query->have_posts()) : $query->the_post();
                                        $posts_name = get_the_title();
                                        $posts_id = get_the_ID();
                                        $author_name = get_the_author();
                                        $category_detail = get_the_category( $posts_id ,array( 'fields' => 'names' ));//$post->ID
                                       
                                     //     echo "<pre>";
                                     // print_r($category_detail);
                                     // echo "</pre>";
                                ?>

                                 <!-- show featured image -->
                                  <?php
                                         if(isset($enable_featured_image) && $enable_featured_image ==1){
                                                if ( has_post_thumbnail() ) {
                                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), $feature_image_size);  
                                                  }                                         
                                            }

                                    ?>
                                   <a href="<?php the_permalink(); ?>" target="<?php echo $btntarget;?>" class="wpmegamenu_post_item">
                                    
                                     
                                     <?php 
                                     if($posts_layout_type == "layout1"){
                                     if ( ! empty( $large_image_url[0] ) ) { ?>
                                     <div class="wpmmpro_post_img">
                                       <img src="<?php echo esc_url( $large_image_url[0] );?>" title="<?php echo $posts_name;?>"/>
                                     </div>
                                     <?php }
                                     }
                                      ?>


                                     <?php 
                                     if($show_cat_name == 1){ ?>
                                     <div class="show-category">
                                     <?php 
                                    
                                     if(isset($category_detail) && !empty($category_detail )):
                                      foreach($category_detail as $cd){
                                        echo "<span>".$cd->name."</span>";
                                        }
                                      endif;
                                     ?></div>
                                     <?php }?>

                                     <span class="wpmm-posts-title"><?php echo $posts_name; ?></span>
                                    
                                    <div class="posts-extra-details">
                                      <?php
                                     if(isset($show_author_name) && $show_author_name == 1){?>
                                    <span class="wpmm-author-name"><span>by</span> <?php echo $author_name; ?></span>
                                    <?php }

                                     ?>
                                     <?php if(isset($posts_layout_type) && $posts_layout_type != "layout3"){
                                     if($show_added_date == 1){?>
                                    <span class="wpmm-entry-date"><span>on</span> <?php echo get_the_date(); ?></span>
                                    <?php }  
                                     if($show_comment_number == 1){
                                        $my_var = get_comments_number( $posts_id );?>
                                       <span class="comment_in_number"><?php echo $my_var; ?></span>
                                    <?php } 
                                      } ?>
                                      </div>

                                 
                                  <?php 
                                     if($posts_layout_type != "layout1"){
                                     if ( ! empty( $large_image_url[0] ) ) { ?>
                                     <div class="wpmmpro_post_img">
                                       <img src="<?php echo esc_url( $large_image_url[0] );?>" title="<?php echo $posts_name;?>"/>
                                     </div>
                                     <?php }
                                     }
                                      ?>



                                    <?php if(isset($enable_excerpt) && $enable_excerpt == 1){
                                           $desc = WPMM_Libary::wpmm_get_excerptbyid(get_the_ID(),$post_length);?>
                                     <div class="wpmmpro_post_content">
                                          <p><?php echo $desc;?></p>    
                                     </div>
                                     <?php } ?>
                                     <?php if(isset($enable_button)  && $enable_button == 1 && $button_name != ''){ ?>
                                     <div class="posts-last-section">
                                         <?php 
                                          if(isset($enable_button) && $enable_button == 1 && $button_name != ''){
                                                //echo "<a class='btn-posts' href='".get_the_permalink()."' target='".$btntarget."'>".$button_name."</a>";
                                                echo "<span>".$button_name."</span>";
                                               }
                                         ?>
                                        
                                     
                                         <?php if(isset($posts_layout_type) && $posts_layout_type == "layout3"){
                                         if($show_added_date == 1){?>
                                         <span class="wpmm-entry-date"><?php echo get_the_date(); ?></span>
                                        <?php }  
                                         if($show_comment_number == 1){
                                            $my_var = get_comments_number( $posts_id );?>
                                           <span class="comment_in_number"><?php echo $my_var; ?></span>
                                        <?php } 
                                          } ?>
                                      </div>
                                     <?php } ?>
                                   </a>
            
                                  
                                <?php 
                                   endwhile;
                                 }
                               ?>                    
                            </div>
                          
                        </div>
                    </div>
    
            </div><!-- End Posts --> 
            <?php
             echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
        $instance['display_title'] = strip_tags( $new_instance['display_title'] );
        $instance['category_id'] = strip_tags( $new_instance['category_id'] );
        $instance['enable_excerpt'] = strip_tags( $new_instance['enable_excerpt'] );
        $instance['post_length'] = strip_tags( $new_instance['post_length'] );
        $instance['postsperpage'] = strip_tags( $new_instance['postsperpage'] );
        $instance['show_added_date'] = strip_tags( $new_instance['show_added_date'] );
        $instance['show_comment_number'] = strip_tags( $new_instance['show_comment_number'] );
        $instance['order_by'] = strip_tags( $new_instance['order_by'] );
        $instance['order'] = strip_tags( $new_instance['order'] );   
        $instance['enable_featured_image'] = strip_tags( $new_instance['enable_featured_image'] ); 
       // $instance['column_no'] =  strip_tags( $new_instance['column_no'] );
        $instance['enable_button'] = strip_tags( $new_instance['enable_button'] ); 
        $instance['button_name'] = strip_tags( $new_instance['button_name'] );
        $instance['btntarget'] =  strip_tags( $new_instance['btntarget'] );

        $instance['show_author_name'] =  strip_tags( $new_instance['show_author_name'] );
        $instance['show_cat_name'] =  strip_tags( $new_instance['show_cat_name'] );
        $instance['posts_layout_type'] =  strip_tags( $new_instance['posts_layout_type'] );
        $instance['feature_image_size'] =  strip_tags( $new_instance['feature_image_size'] );

        return $instance;
    }

      

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
            $image_sizes = WPMM_Libary::wpmm_get_image_sizes();
            $display_title = isset($instance['display_title'])?$instance['display_title']:'';
            $category_id = isset($instance['category_id'])?$instance['category_id']:'';
            $enable_excerpt = (isset($instance['enable_excerpt']) &&  $instance['enable_excerpt'] == 1)?'1':'0';
            $post_length = isset($instance['post_length'])?$instance['post_length']:'';
            $postsperpage = isset($instance['postsperpage'])?$instance['postsperpage']:'3';
            $show_added_date = (isset($instance['show_added_date']) && $instance['show_added_date'] == 1)?'1':'0';
            $show_comment_number = (isset($instance['show_comment_number']) && $instance['show_comment_number'] == 1)?'1':'0';
            $order_by = isset($instance['order_by'])?$instance['order_by']:'id';
            $order = isset($instance['order'])?$instance['order']:'asc';
            $enable_featured_image = (isset($instance['enable_featured_image']) && $instance['enable_featured_image'] == 1)?'1':'0';
           // $column_no = isset($instance['column_no'])?$instance['column_no']:'1';
            $enable_button = (isset($instance['enable_button']) && $instance['enable_button'] == 1)?'1':'0';
            $button_name = (isset($instance['button_name']) )?$instance['button_name']:'';
            $btntarget = (isset($instance['btntarget']) )?$instance['btntarget']:'_blank';
            $show_author_name = (isset($instance['show_author_name']) && $instance['show_author_name'] == 1)?'1':'0';
            $show_cat_name = (isset($instance['show_cat_name']) && $instance['show_cat_name'] == 1)?'1':'0';
            $posts_layout_type = (isset($instance['posts_layout_type']))?$instance['posts_layout_type']:'layout1';
            $feature_image_size = (isset($instance['feature_image_size']))?$instance['feature_image_size']:'large';

            ?>

            <div class="wpmm-post-display-section">
                  <p>
                    <label for="<?php echo $this->get_field_id('display_title');?>"><?php _e('Title',APMM_PRO_TD)?> :</label>
                   <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display_title' ); ?>" 
                   name="<?php echo $this->get_field_name( 'display_title' ); ?>" value="<?php echo esc_attr( $display_title ); ?>"/>
                  </p>
                <p class="wpmm-listcatgory-field">
                   <label for="<?php echo $this->get_field_id('product_list_category'); ?>">
                   <?php _e('Select Category',APMM_PRO_TD)?>:</label>
                   <?php 
                    $categories = get_categories(array('hide_empty' => 0));
                    $taxonomies = WPMM_Libary::get_all_taxonomy_lists(); 
                    ?>

                    <select name="<?php echo $this->get_field_name('category_id'); ?>" 
                      id="<?php echo $this->get_field_id('category_id'); ?>" class="widefat wpmmpro-category">
                                            <option value="all">All</option>
                                            <optgroup label="Category">
                                                <?php
                                                    foreach($categories as $category => $cat){
                                                        ?>
                                                            <option value="<?php echo 'category='.$cat->term_id;?>" <?php selected('category='.$cat->term_id, $category_id); ?>><?php echo $cat->name?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </optgroup> 
                                            <optgroup label="Terms">
                                                <?php
                                                    foreach($taxonomies as $tax) {
                                                      $ex_taxonomy = explode(' ',$tax);
                                                      $imp_taxonomy = strtolower(implode('_',$ex_taxonomy));
                                                       $imp_taxonomy = strtolower(implode('-',$ex_taxonomy));
                                                        $args = array( 'parent'=>'0','hide_empty' => 0);
                                                        $terms = get_terms( $tax, $args );
                                                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                                            foreach ( $terms as $term ) { 
                                                      
                                                              ?>
                                                      <option value="<?php echo 'terms='.$imp_taxonomy.'='.$term->slug;?>" <?php selected('terms='.$imp_taxonomy.'='.$term->slug, $category_id); ?>><?php echo $term->name;?></option>
                                                            <?php }
                                                        }
                                                    }
                                                ?>
                                            </optgroup>                         
                  </select>
            </p>
            <p class="posts-layout">
                <label for="<?php echo $this->get_field_id('posts_layout_type'); ?>">
                   <?php _e('Select Layout Type',APMM_PRO_TD)?>:</label>
                  <select name="<?php echo $this->get_field_name('posts_layout_type'); ?>" 
                      id="<?php echo $this->get_field_id('posts_layout_type'); ?>" class="widefat wpmm-posts-layout">
                       <option value="layout1" <?php selected('layout1', $posts_layout_type); ?>>Layout 1</option>                                      
                       <option value="layout2" <?php selected('layout2', $posts_layout_type); ?>>Layout 2</option>                                      
                       <option value="layout3" <?php selected('layout3', $posts_layout_type); ?>>Layout 3</option>                                      
                  </select>
                <div id="my_layout1" class="layout_preview" <?php if($posts_layout_type == "layout1") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout1.PNG"/>
                </div>
                 <div id="my_layout2" class="layout_preview" <?php if($posts_layout_type == "layout2") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout2.PNG"/>
                </div>
                 <div id="my_layout3" class="layout_preview" <?php if($posts_layout_type == "layout3") echo "style='display:block;'"; else echo "style='display:none;'"; ?>>
                  <img src="<?php echo APMM_PRO_IMG_DIR;?>/widget-images/postlayout3.PNG"/>
                </div>
            </p>
           <p>
              <label for="<?php echo $this->get_field_id('postsperpage');?>"><?php _e('Posts Per Page',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'postsperpage' ); ?>"
             name="<?php echo $this->get_field_name( 'postsperpage' ); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('enable_featured_image');?>"><?php _e('Show Featured Image',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_featured_image' ); ?>"
             name="<?php echo $this->get_field_name( 'enable_featured_image' ); ?>" value="1" <?php checked($enable_featured_image,'1'); ?>/>
            </p>
               <p class="posts-layout">
                <label for="<?php echo $this->get_field_id('feature_image_size'); ?>">
                   <?php _e('Select Featured Image Size',APMM_PRO_TD)?>:</label>
                  <select name="<?php echo $this->get_field_name('feature_image_size'); ?>" 
                      id="<?php echo $this->get_field_id('feature_image_size'); ?>">
                      <?php if(isset($image_sizes) && !empty($image_sizes)):
                         foreach ($image_sizes as $size_name => $key): ?>
                       <option value="<?php echo $size_name;?>" <?php selected($size_name, $feature_image_size); ?>><?php echo ucwords($size_name);?></option>                                                                         
                       <?php endforeach; endif; ?>
                  </select>
            </p>

             <p>
              <label for="<?php echo $this->get_field_id('show_author_name');?>"><?php _e('Show Author Name',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_author_name' ); ?>"
             name="<?php echo $this->get_field_name( 'show_author_name' ); ?>" value="1" <?php checked($show_author_name,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_cat_name');?>"><?php _e('Show Category Name',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_cat_name' ); ?>"
             name="<?php echo $this->get_field_name( 'show_cat_name' ); ?>" value="1" <?php checked($show_cat_name,'1'); ?>/>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('enable_excerpt');?>"><?php _e('Show Excerpt',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_excerpt' ); ?>"
             name="<?php echo $this->get_field_name( 'enable_excerpt' ); ?>" value="1" <?php checked($enable_excerpt,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('post_length');?>"><?php _e('Excerpt Length',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'post_length' ); ?>"
             name="<?php echo $this->get_field_name( 'post_length' ); ?>" value="<?php echo esc_attr( $post_length ); ?>"/>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('show_added_date');?>"><?php _e('Show Posts Date',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_added_date' ); ?>"
             name="<?php echo $this->get_field_name( 'show_added_date' ); ?>" value="1" <?php checked($show_added_date,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_comment_number');?>"><?php _e('Show Comment In Number',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_comment_number' ); ?>"
             name="<?php echo $this->get_field_name( 'show_comment_number' ); ?>" value="1" <?php checked($show_comment_number,'1'); ?>/>
            </p>

           <!--  <p>
              <label for="<?php echo $this->get_field_id('column_no');?>"><?php _e('Column Number',APMM_PRO_TD)?></label>
          
             <select name="<?php echo $this->get_field_name('column_no'); ?>" 
                id="<?php echo $this->get_field_id('column_no'); ?>" class="widefat"> ?>
                        <option value="1" <?php selected(1, $column_no); ?>>1</option>
                        <option value="2" <?php selected(2, $column_no); ?>>2</option>
                        <option value="3" <?php selected(3, $column_no); ?>>3</option>
                </select>
             <p class="description"><?php _e('Display posts by column wise.',APMM_PRO_TD);?></p>
            </p> -->

             <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>">
                <?php _e('Select Order By',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order_by'); ?>" 
                id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat wpmmpro-listtype">
                        <option value="none" <?php selected('none', $order_by); ?>>None</option>
                        <option value="ID" <?php selected('ID', $order_by); ?>>ID</option>
                        <option value="title" <?php selected('title', $order_by); ?>>Title</option>
                        <option value="name" <?php selected('name', $order_by); ?>>Name</option>
                        <option value="date" <?php selected('date', $order_by); ?>>Date</option>
                        <option value="rand" <?php selected('rand', $order_by); ?>>Random Number</option>
                        <option value="menu_order" <?php selected('menu_order', $order_by); ?>>Menu Order</option>
                        <option value="author" <?php selected('author', $order_by); ?>>Author</option>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('order'); ?>">
                <?php _e('Select Order',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order'); ?>" 
                id="<?php echo $this->get_field_id('order'); ?>" class="widefat wpmmpro-listtype">type) { ?>
                        <option value="asc" <?php selected('asc', $order); ?>>ASC</option>
                        <option value="desc" <?php selected('desc', $order); ?>>DESC</option>  
                </select>
            </p>

             <p>
              <label for="<?php echo $this->get_field_id('enable_button');?>"><?php _e('Show Link Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'enable_button' ); ?>"
             name="<?php echo $this->get_field_name( 'enable_button' ); ?>" value="1" <?php checked($enable_button,'1'); ?>/>
            </p>
              <p>
                <label for="<?php echo $this->get_field_id('btntarget'); ?>">
                <?php _e('Select Posts Link Target',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('btntarget'); ?>" 
                id="<?php echo $this->get_field_id('btntarget'); ?>" class="widefat">
                         <option value="_blank"  <?php selected('_blank', $btntarget); ?>><?php _e('_blank',APMM_PRO_TD);?></option>
                         <option value="_self"  <?php selected('_self', $btntarget); ?>><?php _e('_self',APMM_PRO_TD);?></option>
                         <option value="_parent" <?php selected('_parent', $btntarget); ?>><?php _e('_parent',APMM_PRO_TD);?></option>
                         <option value="_top"  <?php selected('_top', $btntarget); ?>><?php _e('_top',APMM_PRO_TD);?></option>
                </select>
            </p>
                

            <p>
              <label for="<?php echo $this->get_field_id('button_name');?>"><?php _e('Button Name',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_name' ); ?>"
             name="<?php echo $this->get_field_name( 'button_name' ); ?>" value="<?php echo esc_attr($button_name);?>"/>
            </p>

      </div>
          
     

            <?php 
       
    }
}

endif;
/**
 * Outputs a contact information from widget
 */
if ( ! class_exists('WP_Mega_Menu_PRO_PostsTimeline') ) :
class WP_Mega_Menu_PRO_PostsTimeline extends WP_Widget{

        public function __construct() {
            parent::__construct('wpmegamenu_pro_poststimeline', // Base ID
                                'WPMM PRO : Posts Timeline', // Name
                                 array('description' => __('A widget that shows posts title with post date as timeline layout.', APMM_PRO_TD)));
        }

    /**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

         $posttype =(isset($instance['posttype']) && $instance['posttype'] != '')?esc_attr( $instance['posttype'] ):'post';
         $postperpage =(isset($instance['postperpage']) && $instance['postperpage'] != '')?intval( $instance['postperpage'] ):'';
         $order_by =(isset($instance['order_by']) && $instance['order_by'] != '')?esc_attr( $instance['order_by'] ):'ID';
         $ordertype =(isset($instance['ordertype']) && $instance['ordertype'] != '')?esc_attr( $instance['ordertype'] ):'asc';
       
         $date_format =(isset($instance['date_format']) && $instance['date_format'] != '')?esc_attr( $instance['date_format'] ):'format3';
         $time_format =(isset($instance['time_format']) && $instance['time_format'] != '')?esc_attr( $instance['time_format'] ):'tformat1';
         $custom_tformat =(isset($instance['custom_tformat']) && $instance['custom_tformat'] != '')?esc_attr( $instance['custom_tformat'] ):'g:i A';
         $custom_format =(isset($instance['custom_format']) && $instance['custom_format'] != '')?esc_attr( $instance['custom_format'] ):'d/m/Y';
         $arg = array(
                        'post_type'      =>  array( $posttype ),
                        'post_status'    =>  array( 'publish' ),
                        'orderby'        =>  $order_by,
                        'order'          =>  $ordertype,
                        'posts_per_page' =>  $postperpage
                );

        $query = new WP_Query( $arg );
        // WPMM_Libary::displayArr($query);
         if($query->have_posts()) { 
         echo "<div class='wpmm-posts-timeline'><ul>";
        while($query->have_posts()) { $query->the_post();
        $post_title = get_the_title();  
        $post_id = get_the_ID();
        switch ($time_format) {
           case 'tformat1':
              $tformat = 'g:i A';
              $pfx_time = get_the_time( $tformat, $post_id );
             break;
              case 'tformat2':
               $tformat = 'g:i a';
               $pfx_time = get_the_time( $tformat, $post_id );
             break;
              case 'tformat3':
               $tformat = 'H:i';
               $pfx_time = get_the_time( $tformat, $post_id );
             break;
              case 'customtformat':
               $tformat = $custom_tformat;
               $pfx_time = get_the_time( $tformat, $post_id );
             break;
           default:
              $tformat = 'g:i A';
              $pfx_time = get_the_time( $tformat, $post_id );
             break;
         }
        switch ($date_format) {
           case 'format1':
              $format = 'F j, Y';
              $pfx_date = get_the_date( $format, $post_id );
             break;
              case 'format2':
               $format = 'Y-m-d';
               $pfx_date = get_the_date( $format, $post_id );
             break;
              case 'format3':
               $format = 'm/d/Y';
               $pfx_date = get_the_date( $format, $post_id );
             break;
              case 'format4':
               $format = 'd/m/Y';
               $pfx_date = get_the_date( $format, $post_id );
             break;
              case 'format5':
               $format = 'd M Y';
               $pfx_date = get_the_date( $format, $post_id );
             break;
              case 'customformat':
               $format = $custom_format;
               $pfx_date = get_the_date( $format, $post_id );
             break;
           default:
              $format = 'd/m/Y';
              $pfx_date = get_the_date( $format, $post_id );
             break;
         } ?>
         <li>
           <div class="post-date-format wpmegamenupro-clearfix">
            <span class="wpmm-post-date"><?php echo $pfx_date;?></span>
            <span class="wpmm-post-time"><?php echo $pfx_time;?></span>
           </div>
           <span class="wpmm-post-datetime-divider"></span>
           <span class="wpmm-timeline-post-title"><?php echo $post_title;?></span>
         </li>

         <?php
           }
         echo "</ul></div>";
          }
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        //$instance = array();
         $instance = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['posttype']       = strip_tags( $new_instance['posttype'] );
        $instance['date_format']    = strip_tags( $new_instance['date_format'] );
        $instance['time_format']    = strip_tags( $new_instance['time_format'] );
        $instance['custom_format']  = strip_tags( $new_instance['custom_format'] );
        $instance['custom_tformat'] = strip_tags( $new_instance['custom_tformat'] );
        $instance['postperpage']    = strip_tags( $new_instance['postperpage'] );
        $instance['order_by']       = strip_tags( $new_instance['order_by'] );
        $instance['ordertype']      = strip_tags( $new_instance['ordertype'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $posttype        = isset($instance[ 'posttype' ])?$instance[ 'posttype' ]:'';
            $date_format     = isset($instance[ 'date_format' ])?$instance[ 'date_format' ]:'';
            $time_format     = isset($instance[ 'time_format' ])?$instance[ 'time_format' ]:'';
            $custom_format   = isset($instance[ 'custom_format' ])?$instance[ 'custom_format' ]:'';
            $custom_tformat  = isset($instance[ 'custom_tformat' ])?$instance[ 'custom_tformat' ]:'';
            $postsperpage    = isset($instance[ 'postperpage' ])?$instance[ 'postperpage' ]:'';
            $order_by        = isset($instance[ 'order_by' ])?$instance[ 'order_by' ]:'';
            $ordertype       = isset($instance[ 'ordertype' ])?$instance[ 'ordertype' ]:'';


        ?>
      <p>  
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
     <?php
       $posttypes =  WPMM_Libary::wpmm_get_registered_post_types();
       // WPMM_Libary::displayArr( $posttypes);
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'phone_font_icon' ); ?>"><?php _e( 'Select Posts Type:' ,APMM_PRO_TD); ?></label> 
         <select name="<?php echo $this->get_field_name('posttype'); ?>" id="<?php echo $this->get_field_id('posttype'); ?>" class="widefat">                   
             <?php if(isset($posttypes) && !empty($posttypes)){
              foreach ($posttypes as $key => $value) {
                ?>
                 <option value="<?php echo $value;?>"  <?php selected($value, $posttype); ?>><?php echo ucfirst($value);?></option>
                <?php 
              }
             } ?>

           </select>
        </p>
        <p>  
          <label for="<?php echo $this->get_field_id( 'date_format' ); ?>"><?php _e( 'Date Format:' ,APMM_PRO_TD); ?></label> 
         <br/> <input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="format1" <?php checked( $date_format , 'format1'); ?>/>December 11, 2016 (F j, Y)
           <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="format2" <?php checked($date_format,'format2'); ?>/>2016-12-11 (Y-m-d)
            <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="format3" <?php checked($date_format, 'format3'); ?>/>12/11/2016 (m/d/Y)
            <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="format4" <?php checked($date_format,'format4'); ?>/>11/12/2016 (d/m/Y)
            <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="format5" <?php checked($date_format,'format5'); ?>/>11 Jun 2016 (d M Y)
           <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'date_format' ); ?>" type="radio" value="customformat" <?php checked($date_format,'customformat'); ?>/>Custom
          <input type="text" placeholder="F j, Y" name="<?php echo $this->get_field_name( 'custom_format' ); ?>" type="text" width="50" id="<?php echo $this->get_field_id( 'custom_format' ); ?>" 
          value="<?php echo esc_attr( $custom_format ); ?>">
        </p>
           <p>  
          <label for="<?php echo $this->get_field_id( 'time_format' ); ?>"><?php _e( 'Time Format:' ,APMM_PRO_TD); ?></label> 
         <br/> <input class="widefat" id="<?php echo $this->get_field_id( 'time_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'time_format' ); ?>" type="radio" value="tformat1" <?php checked($time_format,'tformat1'); ?>/>3:32 AM (g:i A)
           <br/><input class="widefat" id="<?php echo $this->get_field_id( 'time_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'time_format' ); ?>" type="radio" value="tformat2" <?php checked($time_format,'tformat2'); ?>/>3:32 am (g:i a)
            <br/><input class="widefat" id="<?php echo $this->get_field_id( 'time_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'time_format' ); ?>" type="radio" value="tformat3" <?php checked($time_format,'tformat3'); ?>/>03:32 (H:i)
             <br/><input class="widefat" id="<?php echo $this->get_field_id( 'date_format' ); ?>" 
          name="<?php echo $this->get_field_name( 'time_format' ); ?>" type="radio" value="customtformat" <?php checked('customtformat', $time_format); ?>/>Custom
          <input type="text" placeholder="H:i" name="<?php echo $this->get_field_name( 'custom_tformat' ); ?>" type="text" width="50" id="<?php echo $this->get_field_id( 'custom_tformat' ); ?>" 
          value="<?php echo esc_attr( $custom_tformat ); ?>">
        </p>
       
           <p>
              <label for="<?php echo $this->get_field_id('postperpage');?>"><?php _e('Posts Per Page',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'postperpage' ); ?>"
             name="<?php echo $this->get_field_name( 'postperpage' ); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('order_by'); ?>">
                <?php _e('Select Order By',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('order_by'); ?>" 
                id="<?php echo $this->get_field_id('order_by'); ?>" class="widefat">
                        <option value="none" <?php selected('none', $order_by); ?>>None</option>
                        <option value="ID" <?php selected('ID', $order_by); ?>>ID</option>
                        <option value="title" <?php selected('title', $order_by); ?>>Title</option>
                        <option value="name" <?php selected('name', $order_by); ?>>Name</option>
                        <option value="date" <?php selected('date', $order_by); ?>>Date</option>
                        <option value="rand" <?php selected('rand', $order_by); ?>>Random Number</option>
                        <option value="menu_order" <?php selected('menu_order', $order_by); ?>>Menu Order</option>
                        <option value="author" <?php selected('author', $order_by); ?>>Author</option>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('ordertype'); ?>">
                <?php _e('Select Order',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('ordertype'); ?>" 
                id="<?php echo $this->get_field_id('ordertype'); ?>" class="widefat">type) { ?>
                        <option value="asc" <?php selected('asc', $ordertype); ?>>ASC</option>
                        <option value="desc" <?php selected('desc', $ordertype); ?>>DESC</option>  
                </select>
            </p>


        <?php 
    }
}

endif;

if ( ! class_exists('WP_Mega_Menu_PRO_PostsFormat') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_PostsFormat extends WP_Widget {

        public function __construct() {
            parent::__construct('wpmegamenu_pro_blogformat', // Base ID
                                'WPMM PRO : Posts Format Widget', // Name
                                 array('description' => __('A widget to show posts with post format type with featured images.', APMM_PRO_TD)));
        }

    /**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
     public function widget($args, $instance) {
          echo $args['before_widget'];
          if (!empty($instance['title'])) {
              echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
          }

         $post_type =(isset($instance['posttype']) && $instance['posttype'] != '')?esc_attr( $instance['posttype'] ):'post';
         $postperpage =(isset($instance['postperpage']) && $instance['postperpage'] != '')?intval( $instance['postperpage'] ):'';
         $showdate =(isset($instance['showdate']) && $instance['showdate'] == 1)?1:0;
         $show_comment_num =(isset($instance['show_comment_num']) && $instance['show_comment_num'] == 1)?1:0;
         $show_post_title =(isset($instance['show_post_title']) && $instance['show_post_title'] == 1)?1:0;
         $readmorebtn =(isset($instance['readmorebtn']) && $instance['readmorebtn'] == 1)?1:0;
         $readmorebtnname =(isset($instance['readmorebtnname']) && $instance['readmorebtnname'] != '')?$instance['readmorebtnname']:'';
         $argumentss = array(
                        'post_type'      =>  array( $post_type ),
                        'post_status'    =>  array( 'publish' ),
                        'posts_per_page' =>  $postperpage
                );
        $query = new WP_Query( $argumentss );
        // WPMM_Libary::displayArr($query);
        if($query->have_posts()) { ?>
       <div class='wpmm-featured-post-title'>
        <ul>
        <?php
          while($query->have_posts()) { $query->the_post();  
            $post_id = get_the_ID();
            $format = get_post_format(  $post_id ) ? get_post_format(  $post_id ) : 'standard';
             if ( has_post_thumbnail() ) {
              $imageurl = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), 'large');  
              }else{
                $imageurl[0] = '';
              }   
              $width = 'width:55%';
              ?>
              <li>
               <div class="wpmm_lists_posts wpmegamenupro-clearfix">
                 <a href="<?php the_permalink();?>" target="_blank"/>
                    <div class="wpmm-hover-icon">
                     <?php 
                        if($format == "image"){
                          echo '<i class="dashicons dashicons-format-image" aria-hidden="true"></i>';
                         }else if($format == "chat") {
                           echo '<i class="dashicons dashicons-format-chat" aria-hidden="true"></i>';
                         }else if($format == "gallery") {
                           echo '<i class="dashicons dashicons-format-gallery" aria-hidden="true"></i>';
                         }else if($format == "link") {
                           echo '<i class="dashicons dashicons-editor-unlink" aria-hidden="true"></i>';
                         }else if($format == "quote") {
                           echo '<i class="fa fa-plus-circle" aria-hidden="true"></i>';
                         }else if($format == "status") {
                           echo '<i class="dashicons dashicons-format-status" aria-hidden="true"></i>';
                         }else if($format == "video") {
                           echo '<i class="dashicons dashicons-format-video" aria-hidden="true"></i>';
                         }else if($format == "audio") {
                           echo '<i class="dashicons dashicons-format-audio" aria-hidden="true"></i>';
                         }else if($format == "aside") {
                           echo '<i class="dashicons dashicons-format-aside" aria-hidden="true"></i>';
                         }else{
                           echo '<i class="dashicons dashicons-admin-post" aria-hidden="true"></i>';
                         }
                         ?>
                      </div>
                  <?php 

                      if ( ! empty( $imageurl[0] ) ) {
                        echo "<div class='wpmm-featured' style='width=".$width."'>";
                        echo '<img src="'. esc_url( $imageurl[0] ).'" alt="'.the_title_attribute( array( 'echo' => 0 ) ).'">';
                        echo "</div>";
                     }else{
                      echo "<div class='wpmm-featured' style='width=".$width."'>";
                      echo "<img src='".APMM_PRO_IMG_DIR."/thumbnail-default.jpg' alt='thumbnail'/>";
                      echo "</div>";
                     }
                  ?>
                   <div class="wpmm-postformat-title">
                       <div class="span-wrapper">
                         <?php if($showdate == 1){ $posts_date = get_the_date('F j, Y', $post_id ); ?>
                           <span><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $posts_date; ?></span>
                         <?php } ?>
                         <?php if($show_comment_num == 1){ $commentnum = get_comments_number( $post_id ); ?>
                               <span><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo $commentnum; ?></span>
                         <?php } ?>
                         <div class="clear"></div>
                       </div>
                       <?php if($show_post_title == 1){?>
                        <h4><?php the_title();?></h4>
                        <?php } ?>
                        <?php if($readmorebtn == 1 &&  $readmorebtnname != ''){?>
                          <!-- <a href="<?php echo get_the_permalink();?>" target="_blank"/> -->
                          <span class="featured-btn"><?php echo $readmorebtnname;?></span>
                          <!-- </a> -->
                        <?php } ?>
                   </div>
                 </a>
               </div>
              </li>
              
             <?php   }?>
           </ul>
           </div>
          <?php
        }
         echo $args['after_widget'];
      }


    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']            = strip_tags( $new_instance['title'] );
        $instance['posttype']         = strip_tags( $new_instance['posttype'] );
        $instance['postperpage']      = strip_tags( $new_instance['postperpage'] );
        $instance['showdate']         = strip_tags( $new_instance['showdate'] );
        $instance['show_comment_num'] = strip_tags( $new_instance['show_comment_num'] );
        $instance['show_post_title']  = strip_tags( $new_instance['show_post_title'] );
        $instance['readmorebtn']      = strip_tags( $new_instance['readmorebtn'] );
        $instance['readmorebtnname']  = strip_tags( $new_instance['readmorebtnname'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $posttype        = isset($instance[ 'posttype' ])?$instance[ 'posttype' ]:'';
            $postsperpage    = isset($instance[ 'postperpage' ])?$instance[ 'postperpage' ]:'';
            $showdate    = (isset($instance[ 'showdate' ]) && $instance[ 'showdate' ] == 1)?'1':'0';
            $show_comment_num    = (isset($instance[ 'show_comment_num' ]) && $instance[ 'show_comment_num' ] == 1)?'1':'0';
            $show_post_title    = (isset($instance[ 'show_post_title' ]) && $instance[ 'show_post_title' ] == 1)?'1':'0';
            $readmorebtn    = (isset($instance[ 'readmorebtn' ]) && $instance[ 'readmorebtn' ] == 1)?'1':'0';
            $readmorebtnname    = (isset($instance[ 'readmorebtnname' ]) && $instance[ 'readmorebtnname' ] != '')?$instance[ 'readmorebtnname' ]:'';
            

        ?>
      <p>  
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
     <?php
       $posttypes =  WPMM_Libary::wpmm_get_registered_post_types();
       // WPMM_Libary::displayArr( $posttypes);
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'phone_font_icon' ); ?>"><?php _e( 'Select Posts Type:' ,APMM_PRO_TD); ?></label> 
         <select name="<?php echo $this->get_field_name('posttype'); ?>" id="<?php echo $this->get_field_id('posttype'); ?>" class="widefat">                   
             <?php if(isset($posttypes) && !empty($posttypes)){
              foreach ($posttypes as $key => $value) {
                ?>
                 <option value="<?php echo $value;?>"  <?php selected($value, $posttype); ?>><?php echo ucfirst($value);?></option>
                <?php 
              }
             } ?>

           </select>
        </p>
           <p>
              <label for="<?php echo $this->get_field_id('postperpage');?>"><?php _e('Posts Per Page',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'postperpage' ); ?>"
             name="<?php echo $this->get_field_name( 'postperpage' ); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"/>
            </p>
           <p>
              <label for="<?php echo $this->get_field_id('showdate');?>"><?php _e('Show Posts Date',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'showdate' ); ?>"
             name="<?php echo $this->get_field_name( 'showdate' ); ?>" value="1" <?php checked($showdate,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_comment_num');?>"><?php _e('Show Comment In Number',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_comment_num' ); ?>"
             name="<?php echo $this->get_field_name( 'show_comment_num' ); ?>" value="1" <?php checked($show_comment_num,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_post_title');?>"><?php _e('Show Post Title',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_post_title' ); ?>"
             name="<?php echo $this->get_field_name( 'show_post_title' ); ?>" value="1" <?php checked($show_post_title,'1'); ?>/>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('readmorebtn');?>"><?php _e('Show Link Button',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'readmorebtn' ); ?>"
             name="<?php echo $this->get_field_name( 'readmorebtn' ); ?>" value="1" <?php checked($readmorebtn,'1'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('readmorebtnname');?>"><?php _e('Link Button Name',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'readmorebtnname' ); ?>"
             name="<?php echo $this->get_field_name( 'readmorebtnname' ); ?>" value="<?php echo esc_attr($readmorebtnname);?>" placeholder="<?php _e('READ MORE',APMM_PRO_TD);?>"/>
            </p>
        <?php 
    }
}

endif;

if ( ! class_exists('WP_Mega_Menu_PRO_TextImage') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_TextImage extends WP_Widget {

    
        public function __construct() {
            parent::__construct('wpmegamenu_pro_textimage', // Base ID
                                'WPMM PRO : Text Image Widget', // Name
                                 array('description' => __('A widget to show title ,description with image.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

         $sub_title =(isset($instance['sub_title']) && $instance['sub_title'] != '')?$instance['sub_title']:'';
         $description =(isset($instance['description']) && $instance['description'] != '')?$instance['description']:'';
         $url_link =(isset($instance['url_link']) && $instance['url_link'] != '')?$instance['url_link']:'#';
         $button_name =(isset($instance['button_name']) && $instance['button_name'] != '')?$instance['button_name']:'';
         $image =(isset($instance['image']) && $instance['image'] != '')?$instance['image']:'';

       ?>
          
           <div class='wpmm-text-widgets'>
           <div class="thumb">
           <a href="<?php echo esc_url($url_link);?>" target="_blank">
             <?php if($image  != ''){ ?>
             <img src="<?php echo esc_url($image);?>"
            class="image-responsive wpmm-post-image" alt="custom-image" width="250" height="250">
            <?php } ?>
            <div class="wpmegamenupro-overlay"></div>
            </a>
            </div>
            <div class="wpmm-header">
            <?php if($sub_title != ''){ ?>
                <h2 class="entry-title"><a href="<?php echo esc_url($url_link);?>">
                <?php echo $sub_title; ?></a></h2>
                <?php } ?>
            <?php if($description != ''){ ?>
                <p class="wpmm-desc"><?php echo do_shortcode($description); ?></p>
                <?php } ?>
                 <?php if($button_name != ''){ ?>
                <div class="wwpmm-linkbtn"><a href="<?php echo esc_url($url_link);?>" target="_blank"><?php echo esc_attr($button_name);?></a></div>
                <?php } ?>
            </div>
            </div>
       <?php 
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */

     function update( $new_instance, $old_instance ) {
     $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['sub_title'] = strip_tags($new_instance['sub_title']);
    $instance['description'] = strip_tags($new_instance['description']);
    $instance['url_link'] = strip_tags($new_instance['url_link']);
    $instance['button_name'] = strip_tags($new_instance['button_name']);
    $instance['image'] = strip_tags($new_instance['image']);

    return $instance;
}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $sub_title        = isset($instance[ 'sub_title' ])?$instance[ 'sub_title' ]:'';
            $description    = isset($instance[ 'description' ])?$instance[ 'description' ]:'';
            $url_link    = isset($instance[ 'url_link' ])?$instance[ 'url_link' ]:'';
            $button_name    = isset($instance[ 'button_name' ])?$instance[ 'button_name' ]:'';
            $image    = (isset($instance[ 'image' ]) && $instance[ 'image' ] != '')?$instance[ 'image' ]:APMM_PRO_IMG_DIR.'/no_preview.jpg';


        ?>
       <p>  
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
           <p>
              <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sub_title' ); ?>"
             name="<?php echo $this->get_field_name( 'sub_title' ); ?>" value="<?php echo esc_attr( $sub_title ); ?>"/>
            </p>
           <p>
              <label for="<?php echo $this->get_field_id('description');?>"><?php _e('Description',APMM_PRO_TD)?></label>
             <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>"
             name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('url_link');?>"><?php _e('URL Link',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'url_link' ); ?>"
             name="<?php echo $this->get_field_name( 'url_link' ); ?>" value="<?php echo esc_url( $url_link ); ?>"/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('button_name');?>"><?php _e('Button Name',APMM_PRO_TD)?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_name' ); ?>"
             name="<?php echo $this->get_field_name( 'button_name' ); ?>" placeholder="<?php _e('BUY NOW',APMM_PRO_TD);?>" 
             value="<?php echo esc_attr( $button_name ); ?>"/>
            </p>
           
            <p>
            <label for="<?php echo $this->get_field_id('image');?>"><?php _e('Choose Image',APMM_PRO_TD)?></label>
             <input type="hidden" class="widefat wpmm-image-url" id="<?php echo $this->get_field_id( 'image' ); ?>"
             name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url( $image ); ?>"/>
            <input type="button" class="wpmm_image_url button button-primary button-large"
             id="<?php echo $this->get_field_id( 'image' ); ?>" name="wpmm_image_url"  value="Upload Image" 
            size="25"/> 
            <br/>
            <img style="width: 22%;" class="wpmm-image" src="<?php echo esc_url( $image ); ?>">
   
            </p>
        <?php 
    }
}

endif;




if ( ! class_exists('WP_Mega_Menu_PRO_FeatureBox') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_FeatureBox extends WP_Widget {

  /**
   * Specifies the classname and description, instantiates the widget,
   * loads localization files, and includes necessary stylesheets and JavaScript.
   */
  public function __construct() {

    parent::__construct('wpmm-featured-box-layout',
        __( 'WPMM PRO : Featured Box Layout',APMM_PRO_TD),
        array(
          'classname'   =>  'widget_wpmm_featuredbox_widget wpmm-fbox',
          'description' =>  __( 'A widget display featured box layout',APMM_PRO_TD)
        )
      );
  } // end constructor


  /**
   * Outputs the content of the widget.
   *
   * @param array args    The array of form elements
   * @param array instance  The current instance of the widget
   */
  public function widget( $args, $instance ) {

        echo $args['before_widget'];
        if (!empty($instance['heading_title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['heading_title']) . $args['after_title'];
        }

    $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();
    $link_target = ( ! empty( $instance['link_target'] ) ) ? $instance['link_target'] : '_self';
    $font_icon_size = ( ! empty( $instance['font_icon_size'] ) ) ? $instance['font_icon_size'] : '';
    $font_icon_margin = ( ! empty( $instance['font_icon_margin'] ) ) ? $instance['font_icon_margin'] : '';
    $featured_type = ( ! empty( $instance['featured_type'] ) && $instance['featured_type'] == "horiontal") ? 'wpmm-featured-horizontal-type' : 'wpmm-featured-vertical-type';
    // echo $before_widget;
?>
    <div class="wpmm-featuredbox wpmm-section <?php echo $featured_type;?>">

    <?php foreach( $features as $feature ) { 
   ?>
          <div class="wpmm-featured-box-section">
                <div class="wpmm-featuredbox">
                <?php if($feature['firstlink'] != ''){?>
                <a href="<?php echo esc_url($feature['firstlink']);?>" target="<?php echo $link_target;?>">
                <?php } ?>
                <?php if(!empty($feature['fonticon_class'])) : ?>
                  <div class="wpmm-icon-text-icon">
                    <i class="<?php echo $feature['fonticon_class']; ?>" <?php 
                    if($font_icon_size != ''){ echo 'style="font-size:'.$font_icon_size.'px;margin:'.$font_icon_margin.'"'; } ?>></i>
                  </div>
                 <?php  endif; ?>
                  <div class="wpmm-feature-box-info">
                    <?php if(!empty($feature['titletag'])) : ?>
                      <span class="wpmm-title-tag"><?php echo $feature['titletag']; ?></span>
                    <?php endif;
                     if(!empty($feature['description'])) : echo $feature['description'];
                      endif; ?>
                  </div>
                
                <?php if($feature['firstlink'] != ''){?>
                  </a>
                <?php } ?>

                </div>
            </div>
    <?php } ?>
  </div>
<?php echo $args['after_widget'];
  } 

  public function update( $new_instance, $old_instance ) {

     $instance = $old_instance;
    
    $instance['heading_title'] = sanitize_text_field($new_instance['heading_title']);
    $instance['featured_type'] = sanitize_text_field($new_instance['featured_type']);
    $instance['link_target'] = sanitize_text_field($new_instance['link_target']);
    $instance['font_icon_size'] = sanitize_text_field($new_instance['font_icon_size']);
    $instance['font_icon_margin'] = sanitize_text_field($new_instance['font_icon_margin']);

    foreach($new_instance['features'] as $feature){   
      $feature['titletag'] = sanitize_text_field($feature['titletag']);
      $feature['fonticon_class'] = sanitize_text_field($feature['fonticon_class']);
      $feature['description'] = sanitize_text_field($feature['description']);
      $feature['firstlink'] = sanitize_text_field($feature['firstlink']);
     
    }
    $instance['features'] = $new_instance['features'];


    return $instance;

  } 

  public function form( $instance ) {
  $heading_title           = isset($instance[ 'heading_title' ])?$instance[ 'heading_title' ]:'';
  $featured_type           = isset($instance[ 'featured_type' ])?$instance[ 'featured_type' ]:'';
  $font_icon_size          = isset($instance[ 'font_icon_size' ])?$instance[ 'font_icon_size' ]:'';
  $link_target           = isset($instance[ 'link_target' ])?$instance[ 'link_target' ]:'_self';
  $font_icon_margin       = isset($instance[ 'font_icon_margin' ])?$instance[ 'font_icon_margin' ]:'';
    $featured_types = array(
                'vertical' => __('Vertical Type', APMM_PRO_TD),
                'horiontal' => __('Horiontal Type', APMM_PRO_TD)
            );
  $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); ?>
      <p>  
        <label for="<?php echo $this->get_field_id( 'heading_title' ); ?>"><?php _e( 'Heading Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'heading_title' ); ?>"
         name="<?php echo $this->get_field_name( 'heading_title' ); ?>" type="text" value="<?php echo esc_attr( $heading_title ); ?>">
      </p>

        <p>
          <label for="<?php echo $this->get_field_id('featured_type'); ?>">
                <?php _e('Select Featured Lists Type',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('featured_type'); ?>" 
                id="<?php echo $this->get_field_id('featured_type'); ?>" class="widefat wpmmpro-featured-listtype">
                    <?php foreach ($featured_types as $f_type => $type) { ?>
                        <option value="<?php echo $f_type; ?>" <?php selected($f_type, $featured_type); ?>>
                        <?php echo $type; ?></option>
                    <?php } ?>
                </select>
            </p>
             <p>
                <label for="<?php echo $this->get_field_id('link_target'); ?>">
                <?php _e('Select Posts Link Target',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('link_target'); ?>" 
                id="<?php echo $this->get_field_id('link_target'); ?>" class="widefat">
                         <option value="_blank"  <?php selected('_blank', $link_target); ?>><?php _e('_blank',APMM_PRO_TD);?></option>
                         <option value="_self"  <?php selected('_self', $link_target); ?>><?php _e('_self',APMM_PRO_TD);?></option>
                         <option value="_parent" <?php selected('_parent', $link_target); ?>><?php _e('_parent',APMM_PRO_TD);?></option>
                         <option value="_top"  <?php selected('_top', $link_target); ?>><?php _e('_top',APMM_PRO_TD);?></option>
                </select>
            </p>
      <p>  
        <label for="<?php echo $this->get_field_id( 'font_icon_size' ); ?>"><?php _e( 'Font Icon Size:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'font_icon_size' ); ?>"
         name="<?php echo $this->get_field_name( 'font_icon_size' ); ?>" type="number" value="<?php echo esc_attr( $font_icon_size ); ?>">
      </p>
      <p class="description"><?php _e('Set custom font size for font awesome icons.Number Value set as px.',APMM_PRO_TD);?></p>
       <p>  
        <label for="<?php echo $this->get_field_id( 'font_icon_margin' ); ?>"><?php _e( 'Font Icon Margin:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'font_icon_margin' ); ?>"
         name="<?php echo $this->get_field_name( 'font_icon_margin' ); ?>" type="text" value="<?php echo esc_attr( $font_icon_margin ); ?>" placeholder="For E.g.,2px 4px 5px 6px">
      </p>
      <p class="description"><?php _e('Set custom font marign for font awesome icons.For example: margin:10px 5px 15px 20px;
      Here,  top margin is 10px, right margin is 5px, bottom margin is 15px and left margin is 20px',APMM_PRO_TD);?></p>
      

<!-- widget-wpmm-featured-box-layout[2][features][][fonticon_class]  
 widget-wpmm-featured-box-layout-2-features--fonticon_class -->

    <span class="wpmm-additional">
    <?php
    $c = 0;
    if ( count( $features ) > 0 ) {
        foreach( $features as $feature ) {
            //if ( isset( $feature['title'] ) || isset( $feature['description'] ) ) { ?>
              <div class="wpmm-featured-section">
              <div class="sub-option section widget-icon-class">
                <h3>Box <?php echo $c + 1;?></h3>
                <label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][fonticon_class]'; ?>"><?php _e( 'Font Icon Class :' ); ?></label>
                <input class="widefat wpmm-font-class" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-fonticon_class'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][fonticon_class]'; ?>" type="text" 
                value="<?php echo $feature['fonticon_class']; ?>" placeholder="fa fa-home" />

                <label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][titletag]'; ?>"><?php _e( 'Title Tag :' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-titletag'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][titletag]'; ?>" type="text" value="<?php echo $feature['titletag']; ?>" />
                
                <label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][firstlink]'; ?>"><?php _e( 'URL Link :' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-firstlink'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][firstlink]'; ?>" type="text" value="<?php echo $feature['firstlink']; ?>" />

                

                <label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][description]'; ?>"><?php _e( 'Description :' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-description'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][description]'; ?>" ><?php echo $feature['description']; ?></textarea>

             
                <a class="wpmegamenu-remove delete">Remove Section</a>
                  </div>
              </div>
              <?php
              $c++;
           // }
        }
    }

    ?>
</span>
<a class="wpmm-add-featuredbox button"><?php _e('Add New Featured Box'); ?></a>
<?php 
} // end form

} // end class

endif;



if ( ! class_exists('WP_Mega_Menu_PRO_Posts_Slider_Widget') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_Posts_Slider_Widget extends WP_Widget {

    
        public function __construct() {
            parent::__construct('wpmegamenu_pro_advanced_postslider', // Base ID
                                'WPMM PRO : Advanced Posts Slider Widget', // Name
                                 array('description' => __('A widget to show title ,description with featured image as slider.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
         $showposttitle =(isset($instance['showposttitle']) && $instance['showposttitle'] != '')?$instance['showposttitle']:'';
         $show_date =(isset($instance['show_date']) && $instance['show_date'] != '')?$instance['show_date']:'0';
         $postsperpage =(isset($instance['postsperpage']) && $instance['postsperpage'] != '')?$instance['postsperpage']:'3';
         $show_slider_controls =(isset($instance['show_slider_controls']) && $instance['show_slider_controls'] != '')?$instance['show_slider_controls']:'false';
         $speed =(isset($instance['speed']) && $instance['speed'] != '')?$instance['speed']:'1000';
         $duration =(isset($instance['duration']) && $instance['duration'] != '')?$instance['duration']:'1000';
         $autoslide =(isset($instance['autoslide']) && $instance['autoslide'] != '')?$instance['autoslide']:'true';
         $slider_mode =(isset($instance['slider_mode']) && $instance['slider_mode'] != '')?$instance['slider_mode']:'fade';
         $random_num = rand(10000,99999);
          
            $cateid = (isset($instance['cateid']) && $instance['cateid'] != '')?$instance['cateid']:'';
            $explode = explode('=',$cateid);
            $category_type = $explode[0];
            $cat_slug      = $explode[1];
        if($category_type == 'category'){
               $get_posts = array(
                        'post_type'      =>  array( 'post', 'post_type'),
                        'post_status'    =>  array( 'publish' ),
                        'orderby'        =>  'date',
                        'order'          =>  'desc',
                        'posts_per_page' =>  $postsperpage,
                        'cat'       =>  $cat_slug
                );  
             }else if($category_type == 'terms'){
              $taxonomy = $cat_slug;
              $terms_slug = $explode[2];
              $get_posts = array(
                                'post_status'    => array( 'publish' ),
                                'posts_per_page' =>  $postsperpage,
                                'tax_query' =>array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' =>  $terms_slug
                                        ),
                                    )
                               
                            );
             }else{
               $get_posts = array(
                        'post_type'      =>  array( 'post', 'post_type'),
                        'post_status'    =>  array( 'publish' ),
                        'orderby'        =>  'date',
                        'order'          =>  'desc',
                        'posts_per_page' =>  $postsperpage
                );
             }

        $query = new WP_Query( $get_posts ); 
       ?>           
           <div class='wpmm-posts-slider-widgets'>
           <ul class="wpmega-posts-slider" data-id="<?php echo $random_num; ?>" data-auto-slide='<?php echo $autoslide; ?>' data-speed='<?php echo $speed; ?>'
            data-duration='<?php echo $duration; ?>' data-controls='<?php echo $show_slider_controls; ?>' data-mode="<?php echo $slider_mode; ?>">
           <?php 
            while($query->have_posts()) { $query->the_post();  
            $post_id = get_the_ID();
             if ( has_post_thumbnail() ) {
              $imageurl = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), 'large');   ?>
              

            <?php  }else{
                $imageurl[0] = '';
              }   
               if ( ! empty( $imageurl[0] ) ) { ?>
                    <li>
                      <img src="<?php echo esc_url( $imageurl[0] );?>" alt="<?php the_title_attribute( array( 'echo' => 0 ) );?>">
                        <div class="wpmm-caption-wrapper">
                            <?php if($show_date == 1){ 
                                $posts_date = get_the_date('F j, Y', $post_id ); 
                              ?>
                               <span class="posts-slider-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $posts_date; ?></span>
                             <?php } ?>

                            <?php if($showposttitle == 1){ 
                              ?>
                              <h3 class="wpmm-posts-title">
                              <a href="<?php echo get_the_permalink();?>" target="_blank"><?php the_title(); ?></a>
                              </h3>
                              <?php }?>
                           </div>
                    </li>
                      
                      
                  <?php
                       
                     }
            }
            ?>

              </ul>
            </div>
       <?php 
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */

     function update( $new_instance, $old_instance ) {
       $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['showposttitle'] = strip_tags($new_instance['showposttitle']);
      $instance['cateid'] = strip_tags( $new_instance['cateid'] );
      $instance['show_date'] = strip_tags($new_instance['show_date']);
      $instance['postsperpage'] = strip_tags($new_instance['postsperpage']);
      $instance['show_slider_controls'] = strip_tags($new_instance['show_slider_controls']);
      $instance['speed'] = strip_tags($new_instance['speed']);
      $instance['duration'] = strip_tags($new_instance['duration']);
      $instance['autoslide'] = strip_tags($new_instance['autoslide']);
      $instance['slider_mode'] = strip_tags($new_instance['slider_mode']);

      return $instance;
}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $showposttitle   = isset($instance[ 'showposttitle' ])?$instance[ 'showposttitle' ]:'1';
            $cateid          = isset($instance[ 'cateid' ])?$instance[ 'cateid' ]:'';
            $show_date       = isset($instance[ 'show_date' ])?$instance[ 'show_date' ]:'1';
            $postsperpage    = isset($instance[ 'postsperpage' ])?$instance[ 'postsperpage' ]:'3';
            $show_slider_controls    = isset($instance[ 'show_slider_controls' ])?$instance[ 'show_slider_controls' ]:'false';
            $speed    = isset($instance[ 'speed' ])?$instance[ 'speed' ]:'1000';
            $duration    = isset($instance[ 'duration' ])?$instance[ 'duration' ]:'1000';
            $autoslide    = isset($instance[ 'autoslide' ])?$instance[ 'autoslide' ]:'true';
            $slider_mode    = isset($instance[ 'slider_mode' ])?$instance[ 'slider_mode' ]:'fade';
  
        ?>
             <p>  
              <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Slider Title:' ,APMM_PRO_TD); ?></label> 
              <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
              name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
             <?php
           $posttypes =  WPMM_Libary::wpmm_get_registered_post_types();
            ?>
              <p>
                   <label for="<?php echo $this->get_field_id('cateid'); ?>">
                   <?php _e('Select Category',APMM_PRO_TD)?>:</label>
                   <?php 
                    $categories = get_categories(array('hide_empty' => 0));
                    $taxonomies = WPMM_Libary::get_all_taxonomy_lists(); 
                    ?>

                    <select name="<?php echo $this->get_field_name('cateid'); ?>" 
                      id="<?php echo $this->get_field_id('cateid'); ?>" class="widefat">
                                            <optgroup label="Category">
                                                <?php
                                                    foreach($categories as $category => $cat){
                                                        ?>
                                                            <option value="<?php echo 'category='.$cat->term_id;?>" <?php selected('category='.$cat->term_id, $cateid); ?>><?php echo $cat->name?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </optgroup> 
                                            <optgroup label="Terms">
                                                <?php
                                                    foreach($taxonomies as $tax) {
                                                      $ex_taxonomy = explode(' ',$tax);
                                                      $imp_taxonomy = strtolower(implode('_',$ex_taxonomy));
                                                       $imp_taxonomy = strtolower(implode('-',$ex_taxonomy));
                                                        $args = array( 'parent'=>'0','hide_empty' => 0);
                                                        $terms = get_terms( $tax, $args );
                                                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                                            foreach ( $terms as $term ) { 
                                                      
                                                              ?>
                                                      <option value="<?php echo 'terms='.$imp_taxonomy.'='.$term->slug;?>" <?php selected('terms='.$imp_taxonomy.'='.$term->slug, $cateid); ?>><?php echo $term->name;?></option>
                                                            <?php }
                                                        }
                                                    }
                                                ?>
                                            </optgroup>                         
                  </select>
            </p>

             <p>
              <label for="<?php echo $this->get_field_id('showposttitle');?>"><?php _e('Show Post Title',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'showposttitle' ); ?>"
             name="<?php echo $this->get_field_name( 'showposttitle' ); ?>" value="1" <?php checked($showposttitle,'1'); ?>/>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('show_date');?>"><?php _e('Show Posts Date',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_date' ); ?>"
             name="<?php echo $this->get_field_name( 'show_date' ); ?>" value="1" <?php checked($show_date,'1'); ?>/>
            </p>
              <p>
              <label for="<?php echo $this->get_field_id('postsperpage');?>"><?php _e('Posts Per Page',APMM_PRO_TD)?></label>
             <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'postsperpage' ); ?>"
             name="<?php echo $this->get_field_name( 'postsperpage' ); ?>" value="<?php echo esc_attr( $postsperpage ); ?>"/>
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('slider_mode');?>"><?php _e('Slider Mode',APMM_PRO_TD)?></label>
             <select name="<?php echo $this->get_field_name('slider_mode'); ?>" 
                id="<?php echo $this->get_field_id('slider_mode'); ?>" class="widefat">
                         <option value="horizontal"  <?php selected('horizontal', $slider_mode); ?>><?php _e('Horizontal',APMM_PRO_TD);?></option>
                         <option value="vertical"  <?php selected('vertical', $slider_mode); ?>><?php _e('Vertical',APMM_PRO_TD);?></option>
                         <option value="fade"  <?php selected('fade', $slider_mode); ?>><?php _e('Fade',APMM_PRO_TD);?></option>
                </select>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('show_slider_controls');?>"><?php _e('Show Slider Controls',APMM_PRO_TD)?></label>
             <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_slider_controls' ); ?>"
             name="<?php echo $this->get_field_name( 'show_slider_controls' ); ?>" value="true" <?php checked($show_slider_controls,'true'); ?>/>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('speed');?>"><?php _e('Slider Speed',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>"
             name="<?php echo $this->get_field_name( 'speed' ); ?>" value="<?php echo esc_attr( $speed ); ?>"/>
            </p>
            
            <p>
              <label for="<?php echo $this->get_field_id('duration');?>"><?php _e('Slider Pause Duration',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'duration' ); ?>"
             name="<?php echo $this->get_field_name( 'duration' ); ?>" value="<?php echo esc_attr( $duration ); ?>" />
            </p>
             <p class="description"><?php _e('Note: Duration between each slide in milliseconds(pause) in ms.',APMM_PRO_TD);?></p>
             <p>
              <label for="<?php echo $this->get_field_id('autoslide');?>"><?php _e('Auto Slide',APMM_PRO_TD)?></label>
             <select name="<?php echo $this->get_field_name('autoslide'); ?>" 
                id="<?php echo $this->get_field_id('autoslide'); ?>" class="widefat">
                         <option value="true"  <?php selected('true', $autoslide); ?>><?php _e('True',APMM_PRO_TD);?></option>
                         <option value="false"  <?php selected('false', $autoslide); ?>><?php _e('False',APMM_PRO_TD);?></option>
                </select>
            </p>
             <p class="descritpion"><?php _e('Note: If Choose true, slides will automatically transition. Default Value:true',APMM_PRO_TD);?></p>

           
        <?php 
    }
}

endif;


if ( ! class_exists('WP_Mega_Menu_PRO_LinkImage') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_LinkImage extends WP_Widget {

    
        public function __construct() {
            parent::__construct('wpmegamenu_pro_linkimage', // Base ID
                                'WPMM PRO : Custom Image Widget', // Name
                                 array('description' => __('A widget to show uploaded image with url link.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

         $linktarget =(isset($instance['linktarget']) && $instance['linktarget'] != '')?$instance['linktarget']:'';
         $url_link =(isset($instance['url_link']) && $instance['url_link'] != '')?$instance['url_link']:'#';
         $customimage =(isset($instance['customimage']) && $instance['customimage'] != '')?$instance['customimage']:'';
         $cwidth =(isset($instance['cwidth']) && $instance['cwidth'] != '')?$instance['cwidth']:'';
         $cheight =(isset($instance['cheight']) && $instance['cheight'] != '')?$instance['cheight']:'';
       if($customimage != ''){
       ?>
       <div class="wpmm-image-link-wrapper">
        <a href="<?php echo esc_url($url_link);?>" target="<?php echo esc_attr($linktarget);?>">
                      <img src="<?php echo esc_url($customimage);?>" class="wpmm-custom-image" <?php if($cwidth != '' || $cheight != '') 
           echo 'style="width:'.$cwidth.'px;height:'.$cheight.'px"';?>>
        </a>
      </div>
       <?php 
     }
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */

     function update( $new_instance, $old_instance ) {
     $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['linktarget'] = strip_tags($new_instance['linktarget']);
    $instance['url_link'] = strip_tags($new_instance['url_link']);
    $instance['customimage'] = strip_tags($new_instance['customimage']);
    $instance['cwidth'] = strip_tags($new_instance['cwidth']);
    $instance['cheight'] = strip_tags($new_instance['cheight']);

    return $instance;
}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $linktarget        = isset($instance[ 'linktarget' ])?$instance[ 'linktarget' ]:'';
            $url_link    = isset($instance[ 'url_link' ])?$instance[ 'url_link' ]:'';
           $customimage    = (isset($instance[ 'customimage' ]) && $instance[ 'customimage' ] != '') ?$instance[ 'customimage' ]:APMM_PRO_IMG_DIR.'/no_preview.jpg';
            $cwidth    = isset($instance[ 'cwidth' ])?$instance[ 'cwidth' ]:'';
            $cheight    = isset($instance[ 'cheight' ])?$instance[ 'cheight' ]:'';


        ?>
       <p>  
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>

            <p>
              <label for="<?php echo $this->get_field_id('url_link');?>"><?php _e('URL Link',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'url_link' ); ?>"
             name="<?php echo $this->get_field_name( 'url_link' ); ?>" value="<?php echo esc_url( $url_link ); ?>"/>
            </p> 
            <p>
                <label for="<?php echo $this->get_field_id('linktarget'); ?>">
                <?php _e('Select Image Link Target',APMM_PRO_TD)?>:</label>
                <select name="<?php echo $this->get_field_name('linktarget'); ?>" 
                id="<?php echo $this->get_field_id('linktarget'); ?>" class="widefat">
                         <option value="_blank"  <?php selected('_blank', $linktarget); ?>><?php _e('_blank',APMM_PRO_TD);?></option>
                         <option value="_self"  <?php selected('_self', $linktarget); ?>><?php _e('_self',APMM_PRO_TD);?></option>
                         <option value="_parent" <?php selected('_parent', $linktarget); ?>><?php _e('_parent',APMM_PRO_TD);?></option>
                         <option value="_top"  <?php selected('_top', $linktarget); ?>><?php _e('_top',APMM_PRO_TD);?></option>
                </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('customimage');?>"><?php _e('Choose Custom Image',APMM_PRO_TD)?></label>
             <input type="hidden" class="widefat wpmm-image-url" id="<?php echo $this->get_field_id( 'customimage' ); ?>"
             name="<?php echo $this->get_field_name( 'customimage' ); ?>" value="<?php echo esc_url( $customimage ); ?>"/>
            <input type="button" class="wpmm_image_url button button-primary button-large"
             id="<?php echo $this->get_field_id( 'customimage' ); ?>" name="wpmm_image_url"  value="Upload Image" 
            size="25"/> 
            <br/>
            <img style="width: 15%;" class="wpmm-image" src="<?php echo esc_url( $customimage ); ?>">
   
            </p>
             <p>
              <label for="<?php echo $this->get_field_id('cwidth');?>"><?php _e('Custom Width',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'cwidth' ); ?>"
             name="<?php echo $this->get_field_name( 'cwidth' ); ?>" value="<?php echo esc_attr( $cwidth ); ?>"/>
            </p> 
             <p>
              <label for="<?php echo $this->get_field_id('cheight');?>"><?php _e('Custom Height',APMM_PRO_TD)?></label>
             <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'cheight' ); ?>"
             name="<?php echo $this->get_field_name( 'cheight' ); ?>" value="<?php echo esc_attr( $cheight ); ?>"/>
            </p> 
        <?php 
    }
}

endif;

if ( ! class_exists('WP_Mega_Menu_PRO_GalleryImageWidget') ) :

/**
 * Outputs a contact information from widget
 */
class WP_Mega_Menu_PRO_GalleryImageWidget extends WP_Widget {

    
        public function __construct() {
            parent::__construct('wpmegamenu_pro_gallery_image', // Base ID
                                'WPMM PRO : Gallery Shortcode Widget', // Name
                                 array('description' => __('A widget to display gallery images using shortcode.', APMM_PRO_TD)));
        }

     /**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
     public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

         $gallery_shortcode =(isset($instance['gallery_shortcode']) && $instance['gallery_shortcode'] != '')?$instance['gallery_shortcode']:'';

       ?>
       <div class="wpmm-image-gallery-widget">
        
          <?php echo do_shortcode($gallery_shortcode);?>
        
      </div>
       <?php 
        echo $args['after_widget'];
    }

   /*
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
    */ 

     function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['gallery_shortcode'] = strip_tags($new_instance['gallery_shortcode']);

    return $instance;
}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $gallery_shortcode        = isset($instance[ 'gallery_shortcode' ])?$instance[ 'gallery_shortcode' ]:'';


        ?>

         <p>  
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
         </p>
         <div class="wpmm-description-steps">
          <h4><?php _e('Follow the below to step to get gallery shortcode.',APMM_PRO_TD);?></h4>
          <ul>
          <?php $admin_url = admin_url();?>
            <li>> <?php _e('Go to Admin add new posts from here ',APMM_PRO_TD);?> <a href="<?php echo $admin_url;?>post-new.php" target="_blank"><?php _e('Add New Posts',APMM_PRO_TD);?></a></li>
            <li>> <?php _e('Click on Add Media Button and then create gallery options tab on Insert Media popup form.',APMM_PRO_TD);?></li>
            <li>> <?php _e('Then Choose multiple images and click on create a new gallery button below.',APMM_PRO_TD);?></li>
            <li>> <?php _e('Click on Insert Gallery Button after all images have been selected as per requirement.',APMM_PRO_TD);?></li>
            <li>> <?php _e('You will get the gallery shortcode on editor area such as [gallery ids="479,441"] with selected images id.',APMM_PRO_TD);?></li>
            <li>> <?php _e('Copy the shortcode and paste on below shortcode textarea.',APMM_PRO_TD);?></li>
          </ul>
         </div>
          <p>
            <label for="<?php echo $this->get_field_id('gallery_shortcode');?>"><?php _e('Gallery Shortcode',APMM_PRO_TD)?></label><br/>
           <textarea id="<?php echo $this->get_field_id( 'gallery_shortcode' ); ?>"
           name="<?php echo $this->get_field_name( 'gallery_shortcode' ); ?>" cols="60" rows="5"><?php echo esc_attr( $gallery_shortcode ); ?></textarea>
          </p> 
           
          
             
        <?php 
    }
}

endif;


if ( ! class_exists('WP_Mega_Menu_PRO_HtmlText') ) :
/**
 * Outputs a html text from widget
 */
class WP_Mega_Menu_PRO_HtmlText extends WP_Widget {

    
        public function __construct() {
            parent::__construct('wpmegamenu_pro_html_text', // Base ID
                                'WPMM PRO : HTML Text Widget', // Name
                                 array('description' => __('A widget to show html text content.', APMM_PRO_TD)));
        }

/**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */
   public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
         $content =(isset($instance['content']) && $instance['content'] != '')?$instance['content']:'';
         $text = apply_filters( 'widget_text',$content, $instance, $this );
       ?>
          
         <div class="textwidget"><?php echo $text; ?></div>
       <?php 
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $allowed_tags = wp_kses_allowed_html('post');
    $allowed_tags['iframe'] = array(
        'src' => 1,
        'width' => 1,
        'height' => 1,
        'frameborder' => 1,
        'style' => 1,
        'allowfullscreen' => 1
        );
    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['content'] =  wp_kses(stripslashes_deep($new_instance['content']), $allowed_tags);
    return $instance;
}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

            $title           = isset($instance[ 'title' ])?$instance[ 'title' ]:'';
            $content   = isset($instance[ 'content' ])?$instance[ 'content' ]:'';
        ?>
       <p>  
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,APMM_PRO_TD); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
          
        <p>
              <label for="<?php echo $this->get_field_id('content');?>"><?php _e('Content',APMM_PRO_TD)?></label>
             <textarea rows="16" cols="20" class="widefat text wp-editor-area" style="height: 200px" id="<?php echo $this->get_field_id( 'content' ); ?>"
             name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo esc_attr( $content ); ?></textarea>
         </p>
        <?php 
    }
}

endif;






      