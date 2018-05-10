<?php 
/**
 * Customizer Options.
 * @version 1.1.0
 * @since 1.0.0
 * @package flowershop
 */

	/*
		Add Theme Panel
	*/
	$wp_customize->add_panel( 'flowershop_theme_panel',
		array(
			'title'      => esc_html__( 'Theme Option', 'flowershop' ),
			'priority'   => 90,
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		/*
			 Front Page Options
		*/
		$wp_customize->add_section( 'flowershop_front_page_option',
			array(
				'title'    => esc_html__( 'Front Page Options', 'flowershop' ),
				'priority' => 100,
				'panel'    => 'flowershop_theme_panel',
			)
		);
	}

	/*
		Latest Product Option
	*/
	$wp_customize->add_setting('flowershop_latest_product_disable',array(
			'sanitize_callback' => 'flowershop_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'flowershop_latest_product_disable',array(
			'label' => __('Show or Hide Latest Products','flowershop'),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_latest_product_disable',
			'type'=> 'checkbox',
		)
	));

	// Latest Product Title
	$wp_customize->add_setting( 'flowershop_latest_product_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => __('Latest Products','flowershop')
	) );

	$wp_customize->add_control( 'flowershop_latest_product_title', array(
			'label'	=> __( 'Latest Product Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_latest_product_title',
			'type' => 'text'
	) );

	// Lastest Product Numbers
	$wp_customize->add_setting( 'flowershop_latest_product_number', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_latest_product_number', array(
			'label' => __( 'Numbers of Latest Product', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_latest_product_number',
			'type' => 'number',
	) );
	// Lastest Product Columns Numbers
	$wp_customize->add_setting( 'flowershop_latest_product_column', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_latest_product_column', array(
			'label' => __( 'Latest Product Column Numbers', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_latest_product_column',
			'type' => 'number'
	) );

	/*
		Top Rated Product Option
	*/
	$wp_customize->add_setting('flowershop_top_rated_product_disable',array(
			'sanitize_callback' => 'flowershop_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'flowershop_top_rated_product_disable',array(
			'label' => __('Show or Hide Top Rated Products','flowershop'),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_top_rated_product_disable',
			'type'=> 'checkbox',
		)
	));
	// Top Rated Product Title
	$wp_customize->add_setting( 'flowershop_top_rated_product_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => __('Top Rated Products','flowershop')
	) );

	$wp_customize->add_control( 'flowershop_top_rated_product_title', array(
			'label'	=> __( 'Top Rated Product Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_top_rated_product_title',
			'type' => 'text'
	) );

	// Top Rated Product Numbers
	$wp_customize->add_setting( 'flowershop_top_rated_product_number', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_top_rated_product_number', array(
			'label' => __( 'Numbers of Top Rated Product', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_top_rated_product_number',
			'type' => 'number',
	) );

	// Top Rated Product Columns Numbers
	$wp_customize->add_setting( 'flowershop_top_rated_product_column', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_top_rated_product_column', array(
			'label' => __( 'Top Rated Product Column Numbers', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_top_rated_product_column',
			'type' => 'number'
	) );



	/*
		On Sales Product Option
	*/
	$wp_customize->add_setting('flowershop_on_sales_product_disable',array(
			'sanitize_callback' => 'flowershop_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'flowershop_on_sales_product_disable',array(
			'label' => __('Show or Hide on_sales Products','flowershop'),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_on_sales_product_disable',
			'type'=> 'checkbox',
		)
	));
	// On Sale Product Title
	$wp_customize->add_setting( 'flowershop_on_sales_product_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => __('On Sale Products','flowershop')
	) );

	$wp_customize->add_control( 'flowershop_on_sales_product_title', array(
			'label'	=> __( 'On Sales Product Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_on_sales_product_title',
			'type' => 'text'
	) );

	// On Sale Product Numbers
	$wp_customize->add_setting( 'flowershop_on_sales_product_number', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_on_sales_product_number', array(
			'label' => __( 'Numbers of On Sales Product', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_on_sales_product_number',
			'type' => 'number',
	) );

	// On Sale Product Columns Numbers
	$wp_customize->add_setting( 'flowershop_on_sales_product_column', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 4
	) );

	$wp_customize->add_control( 'flowershop_on_sales_product_column', array(
			'label' => __( 'On Sales Product Column Numbers', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_on_sales_product_column',
			'type' => 'number'
	) );


	/*
		Product Category Option
	*/
	$wp_customize->add_setting('flowershop_product_category_disable',array(
			'sanitize_callback' => 'flowershop_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'flowershop_product_category_disable',array(
			'label' => __('Show or Hide Product Categories','flowershop'),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_category_disable',
			'type'=> 'checkbox',
		)
	));
	// Product Category Title
	$wp_customize->add_setting( 'flowershop_product_category_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => __('Browse By Categories','flowershop')
	) );

	$wp_customize->add_control( 'flowershop_product_category_title', array(
			'label'	=> __( 'Product Category Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_category_title',
			'type' => 'text'
	) );

	// Product Category Sub Title
	$wp_customize->add_setting( 'flowershop_product_category_subtitle', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => ''
	) );

	$wp_customize->add_control( 'flowershop_product_category_subtitle', array(
			'label'	=> __( 'Product Category Sub Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_category_subtitle',
			'type' => 'text'
	) );

	// Product Categories Number
	$wp_customize->add_setting( 'flowershop_product_category_number', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 6
	) );

	$wp_customize->add_control( 'flowershop_product_category_number', array(
			'label' => __( 'Numbers of Product Category', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_category_number',
			'type' => 'number',
	) );

	// Product Category Column Numbers
	$wp_customize->add_setting( 'flowershop_product_category_column', array(
			'sanitize_callback'	=> 'flowershop_sanitize_positive_number',
			'default' => 6
	) );

	$wp_customize->add_control( 'flowershop_product_category_column', array(
			'label' => __( 'Product Category Column Numbers', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_category_column',
			'type' => 'number'
	) );


	/*
		Product Highlight Option
	*/
	$wp_customize->add_setting('flowershop_product_highlight_disable',array(
			'sanitize_callback' => 'flowershop_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'flowershop_product_highlight_disable',array(
			'label' => __('Show or Hide Highlighted Product','flowershop'),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_highlight_disable',
			'type'=> 'checkbox',
		)
	));
	// Product Highlight Title
	$wp_customize->add_setting( 'flowershop_product_highlight_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => ''
	) );

	$wp_customize->add_control( 'flowershop_product_highlight_title', array(
			'label'	=> __( 'Product Highlight Title', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_highlight_title',
			'type' => 'text'
	) );
	// Product Highlight Button Name
	$wp_customize->add_setting( 'flowershop_product_highlight_button_name', array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'default' => __('View Product','flowershop')
	) );

	$wp_customize->add_control( 'flowershop_product_highlight_button_name', array(
			'label'	=> __( 'Product Highlight Button Name', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_highlight_button_name',
			'type' => 'text'
	) );	
	// Product Highlight Button Link
	$wp_customize->add_setting( 'flowershop_product_highlight_button_link', array(
			'sanitize_callback'	=> 'flowershop_sanitize_url',
			'default' => ''
	) );

	$wp_customize->add_control( 'flowershop_product_highlight_button_link', array(
			'label'	=> __( 'Product Highlight Button Link', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_highlight_button_link',
			'type' => 'url'
	) );
	// Product Highlight Background Image Link
	$wp_customize->add_setting( 'flowershop_product_highlight_background_image_link', array(
			'sanitize_callback'	=> 'flowershop_sanitize_url',
			'default' => ''
	) );

	$wp_customize->add_control( 'flowershop_product_highlight_background_image_link', array(
			'label'	=> __( 'Product Highlight Background Image Link', 'flowershop' ),
			'section' => 'flowershop_front_page_option',
			'settings' => 'flowershop_product_highlight_background_image_link',
			'type' => 'url'
	) );
?>