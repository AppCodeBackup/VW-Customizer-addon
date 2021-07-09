<?php 
	//  =============================
    //  = Section for Best Seller  =
    //  =============================
    $wp_customize->add_section( 'customize_best_seller_section', array(
      'title'        => __( 'Best Seller', 'themes' ),
      'description'  => __( 'Customize Best Seller Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_best_seller_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_best_seller_enable]', array(
     'settings'    => 'themes_customization[radio_best_seller_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_best_seller_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[best_seller_bgcolor]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[best_seller_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_best_seller_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[best_seller_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[best_seller_bgimage]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[best_seller_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_best_seller_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[best_seller_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization_best_seller_option',
        array(
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_choices'
        )
    );
    $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_best_seller_option',
        array(
            'label' => __('Best Seller Content Settings','themes'),
            'section' => 'customize_best_seller_section'
        )
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_customization_best_seller_option', array(
        'selector' => '#best-seller .container',
        'render_callback' => 'themes_customize_partial_themes_customization_best_seller_option',
    ) );
    $wp_customize->add_setting( 'themes_customization[best_seller_title_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[best_seller_title_image]', array(
      'label'      => __( 'Best Seller Title Image ','themes'),
      'section'    => 'customize_best_seller_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[best_seller_title_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[best_seller_left_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[best_seller_left_title]', array(
      'label'            => __( 'Best Seller Small Text', 'themes' ),
      'section'          => 'customize_best_seller_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[best_seller_left_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[best_seller_main_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[best_seller_main_text]', array(
      'label'            => __( 'Best Seller Main Heading', 'themes' ),
      'section'          => 'customize_best_seller_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[best_seller_main_text]',
    ) );
    if(defined('VW_FACTORY_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[best_seller_products_number]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[best_seller_products_number]',array(
          'label' => __('Number of Products to show','themes'),
          'section'   => 'customize_best_seller_section',
          'type'      => 'number',
          'priority'   => Null,
      ));
    }
    $args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('themes_customization[best_seller_products_category]',array(
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select',
    ));
    $wp_customize->add_control('themes_customization[best_seller_products_category]',array(
      'type'    => 'select',
      'choices' => $cats,
      'label' => __('Select Category','themes'),
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[best_seller_products_category]',
    ));
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[best_seller_prod_button_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );    
      $wp_customize->add_control( 'themes_customization[best_seller_prod_button_title]', array(
        'label'            => __( 'Section Button Text', 'themes' ),
        'section'          => 'customize_best_seller_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[best_seller_prod_button_title]',
      ) );
      $wp_customize->add_setting('themes_customization[best_seller_prod_button_url]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[best_seller_prod_button_url]',array(
          'label' => __('Section Button Url','themes'),
          'section' => 'customize_best_seller_section',
          'setting' => 'themes_customization[best_seller_prod_button_url]',
          'type'    => 'url'
      ));
    }
    $wp_customize->add_setting( 'themes_customization[best_seller_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[best_seller_main_text_color]', array(
      'label' => 'Main Title Color',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[best_seller_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[best_seller_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[best_seller_main_text_fontfamily]', array(
        'section'  => 'customize_best_seller_section',
        'label'    => __( 'Main Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[best_seller_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[best_seller_main_text_font_size]',array(
        'label' => __('Main Title Font Size in px','themes'),
        'section' => 'customize_best_seller_section',
        'setting' => 'themes_customization[best_seller_main_text_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[best_seller_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[best_seller_small_text_color]', array(
      'label' => 'Small Title Color',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[best_seller_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[best_seller_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[best_seller_small_text_fontfamily]', array(
        'section'  => 'customize_best_seller_section',
        'label'    => __( 'Small Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[best_seller_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[best_seller_small_text_font_size]',array(
        'label' => __('Small Title Font Size in px','themes'),
        'section' => 'customize_best_seller_section',
        'setting' => 'themes_customization[best_seller_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[seller_sale_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_sale_title_color]', array(
        'label' => 'Sale Title Color',
        'section' => 'customize_best_seller_section',
        'settings' => 'themes_customization[seller_sale_title_color]',
      )));  

      $wp_customize->add_setting('themes_customization[seller_sale_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[seller_sale_title_fontfamily]', array(
          'section'  => 'customize_best_seller_section',
          'label'    => __( 'Sale Title Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[seller_sale_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control('themes_customization[seller_sale_title_font_size]',array(
          'label' => __('Sale Title Font Size in px','themes'),
          'section' => 'customize_best_seller_section',
          'setting' => 'themes_customization[seller_sale_title_font_size]',
          'type'    => 'text'
        )
      ); 
    }
    $wp_customize->add_setting( 'themes_customization[seller_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_title_color]', array(
      'label' => 'Products Title Color',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[seller_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[seller_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[seller_title_fontfamily]', array(
        'section'  => 'customize_best_seller_section',
        'label'    => __( 'Products Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[seller_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[seller_title_font_size]',array(
        'label' => __('Products Title Font Size in px','themes'),
        'section' => 'customize_best_seller_section',
        'setting' => 'themes_customization[seller_title_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[seller_price_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_price_color]', array(
      'label' => 'Products Price Color',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[seller_price_color]',
    )));  

    $wp_customize->add_setting('themes_customization[seller_price_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[seller_price_fontfamily]', array(
        'section'  => 'customize_best_seller_section',
        'label'    => __( 'Products Price Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[seller_price_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[seller_price_font_size]',array(
        'label' => __('Products Price Font Size in px','themes'),
        'section' => 'customize_best_seller_section',
        'setting' => 'themes_customization[seller_price_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[cart_button_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[cart_button_color]', array(
      'label' => 'Products Cart Button Color',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[cart_button_color]',
    )));  

    $wp_customize->add_setting('themes_customization[cart_button_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[cart_button_fontfamily]', array(
        'section'  => 'customize_best_seller_section',
        'label'    => __( 'Products Cart Button Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[cart_button_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[cart_button_font_size]',array(
        'label' => __('Products Cart Button Font Size in px','themes'),
        'section' => 'customize_best_seller_section',
        'setting' => 'themes_customization[cart_button_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[cart_button_bgcolor1]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[cart_button_bgcolor1]', array(
      'label' => 'Cart Background Button Color 1',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[cart_button_bgcolor1]',
    )));
    $wp_customize->add_setting( 'themes_customization[cart_button_bgcolor2]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[cart_button_bgcolor2]', array(
      'label' => 'Cart Background Button Color 2',
      'section' => 'customize_best_seller_section',
      'settings' => 'themes_customization[cart_button_bgcolor2]',
    )));
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[seller_batch_bgcolor1]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_batch_bgcolor1]', array(
          'label' => __('Sale Background Color 1', 'themes'),
          'section' => 'customize_best_seller_section',
          'settings' => 'themes_customization[seller_batch_bgcolor1]',
      )));
      $wp_customize->add_setting('themes_customization[seller_batch_bgcolor2]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_batch_bgcolor2]', array(
          'label' => __('Sale Background Color 2', 'themes'),
          'section' => 'customize_best_seller_section',
          'settings' => 'themes_customization[seller_batch_bgcolor2]',
      )));
      $wp_customize->add_setting('themes_customization[seller_button_bgcolor1]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_button_bgcolor1]', array(
          'label' => __('Products Button Background Color 1', 'themes'),
          'section' => 'customize_best_seller_section',
          'settings' => 'themes_customization[seller_button_bgcolor1]',
      )));
      $wp_customize->add_setting('themes_customization[seller_button_bgcolor2]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_button_bgcolor2]', array(
          'label' => __('Products Button Background Color 2', 'themes'),
          'section' => 'customize_best_seller_section',
          'settings' => 'themes_customization[seller_button_bgcolor2]',
      )));
    }else{
      $wp_customize->add_setting( 'themes_customization[seller_button_bgcolor]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_button_bgcolor]', array(
        'label' => 'Products Button Background Color',
        'section' => 'customize_best_seller_section',
        'settings' => 'themes_customization[seller_button_bgcolor]',
      )));
      $wp_customize->add_setting( 'themes_customization[seller_sale_bg_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[seller_sale_bg_color]', array(
        'label' => 'Sale Background Color',
        'section' => 'customize_best_seller_section',
        'settings' => 'themes_customization[seller_sale_bg_color]',
      )));
    }
?>