<?php 
	//  =============================
    //  = Section for Products Tabs =
    //  =============================
    $wp_customize->add_section( 'customize_category_products_section', array(
      'title'        => __( 'Products Tabs', 'themes' ),
      'description'  => __( 'Customize Products Tabs Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_category_products_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_category_products_enable]', array(
     'settings'    => 'themes_customization[radio_category_products_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_category_products_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[category_products_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[category_products_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_category_products_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[category_products_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[category_products_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[category_products_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_category_products_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[category_products_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[deals_clock_tittle]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[deals_clock_tittle]', array(
      'label'            => __( 'Daily Deals Text', 'themes' ),
      'section'          => 'customize_category_products_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[deals_clock_tittle]',
    ) );
    $wp_customize->add_setting( 'themes_customization[deals_clock_timer_end]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[deals_clock_timer_end]', array(
      'label'            => __( 'Timer Text', 'themes' ),
      'section'          => 'customize_category_products_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[deals_clock_timer_end]',
    ) );
    $wp_customize->add_setting('themes_customization[recodes_product_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[recodes_product_number]',array(
        'label' => __('Number of Products to show','themes'),
        'section'   => 'customize_category_products_section',
        'type'      => 'number'
    ));
    $aboutchoose =  isset( $this->themes_key['recodes_product_number'] )? $this->themes_key['recodes_product_number'] : 2;
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
      $cats[$category->name] = $category->name;
    }
    $wp_customize->add_setting('themes_customization[recodes_product_category]',array(
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select',
    ));
    $wp_customize->add_control('themes_customization[recodes_product_category]',array(
      'type'    => 'select',
      'choices' => $cats,
      'label' => __('Select Category','themes'),
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[recodes_product_category]',
    ));
    $wp_customize->add_setting( 'themes_customization[featued_tittle]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[featued_tittle]', array(
      'label'            => __( 'Our Products Text', 'themes' ),
      'section'          => 'customize_category_products_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[featued_tittle]',
    ) );
    $wp_customize->add_setting('themes_customization[fetured_product_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[fetured_product_number]',array(
        'label' => __('Number of Products to show','themes'),
        'section'   => 'customize_category_products_section',
        'type'      => 'number'
    ));
    $aboutchoose =  isset( $this->themes_key['fetured_product_number'] )? $this->themes_key['fetured_product_number'] : 4;
    for($i=1; $i<=$aboutchoose; $i++) {
      $wp_customize->add_setting( 'themes_customization[fetured_product_sec_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[fetured_product_sec_title'.$i.']', array(
        'label'            => __( 'Tab Title', 'themes' ),
        'section'          => 'customize_category_products_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[fetured_product_sec_title'.$i.']',
      ) );
      $wp_customize->add_setting('themes_customization[featured_products_category'.$i.']',array(
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select',
      ));
      $wp_customize->add_control('themes_customization[featured_products_category'.$i.']',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Category','themes'),
        'section' => 'customize_category_products_section',
        'settings' => 'themes_customization[featured_products_category'.$i.']',
      ));

    }
    $wp_customize->add_setting( 'themes_customization[category_products_button_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[category_products_button_title]', array(
      'label'            => __( 'Section Button Text', 'themes' ),
      'section'          => 'customize_category_products_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[category_products_button_title]',
    ) );
    $wp_customize->add_setting('themes_customization[category_products_button_url]',array(
        'default' => '',
        'type'              => 'option',
              'capability'        => 'manage_options',
              'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[category_products_button_url]',array(
        'label' => __('Section Button Url','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[category_products_button_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[sec_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[sec_main_text_color]', array(
      'label' => 'Main Title Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[sec_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[sec_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[sec_main_text_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Main Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[sec_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[sec_main_text_font_size]',array(
        'label' => __('Main Title Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[sec_main_text_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[clock_tittle_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[clock_tittle_text_color]', array(
      'label' => 'Timer Title Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[clock_tittle_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[clock_tittle_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[clock_tittle_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Timer Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[clock_tittle_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[clock_tittle_font_size]',array(
        'label' => __('Timer Title Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[clock_tittle_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[clock_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[clock_bg_color]', array(
      'label' => 'Timer Background Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[clock_bg_color]',
    ))); 

    $wp_customize->add_setting( 'themes_customization[tab_tittle_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[tab_tittle_text_color]', array(
      'label' => 'Tab Title Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[tab_tittle_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[tab_tittle_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[tab_tittle_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Tab Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[tab_tittle_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[tab_tittle_font_size]',array(
        'label' => __('Tab Title Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[tab_tittle_font_size]',
        'type'    => 'text'
      )
    ); 
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[tab_tittle_active_color1]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[tab_tittle_active_color1]', array(
          'label' => __('Tab Active Title Color 1', 'themes'),
          'section' => 'customize_category_products_section',
          'settings' => 'themes_customization[tab_tittle_active_color1]',
      )));
      $wp_customize->add_setting('themes_customization[tab_tittle_active_color2]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[tab_tittle_active_color2]', array(
          'label' => __('Tab Active Title Color 2', 'themes'),
          'section' => 'customize_category_products_section',
          'settings' => 'themes_customization[tab_tittle_active_color2]',
      )));
    }else{
      $wp_customize->add_setting( 'themes_customization[tab_tittle_active_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[tab_tittle_active_color]', array(
        'label' => 'Tab Active Title Color',
        'section' => 'customize_category_products_section',
        'settings' => 'themes_customization[tab_tittle_active_color]',
      )));  
    }
    $wp_customize->add_setting( 'themes_customization[product_sale_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_sale_title_color]', array(
      'label' => 'Sale Title Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_sale_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[product_sale_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[product_sale_title_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Sale Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[product_sale_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[product_sale_title_font_size]',array(
        'label' => __('Sale Title Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[product_sale_title_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[product_sale_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_sale_bg_color]', array(
      'label' => 'Sale Background Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_sale_bg_color]',
    )));

    $wp_customize->add_setting( 'themes_customization[product_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_title_color]', array(
      'label' => 'Products Title Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[product_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[product_title_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Products Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[product_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[product_title_font_size]',array(
        'label' => __('Products Title Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[product_title_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[product_price_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_price_color]', array(
      'label' => 'Products Price Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_price_color]',
    )));  

    $wp_customize->add_setting('themes_customization[product_price_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[product_price_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Products Price Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[product_price_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[product_price_font_size]',array(
        'label' => __('Products Price Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[product_price_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[product_button_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_color]', array(
      'label' => 'Products Button Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_button_color]',
    )));  

    $wp_customize->add_setting('themes_customization[product_button_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[product_button_fontfamily]', array(
        'section'  => 'customize_category_products_section',
        'label'    => __( 'Products Button Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[product_button_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[product_button_font_size]',array(
        'label' => __('Products Button Font Size in px','themes'),
        'section' => 'customize_category_products_section',
        'setting' => 'themes_customization[product_button_font_size]',
        'type'    => 'text'
      )
    ); 
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[product_button_bgcolor1]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_bgcolor1]', array(
          'label' => __('Products Button Background Color 1', 'themes'),
          'section' => 'customize_category_products_section',
          'settings' => 'themes_customization[product_button_bgcolor1]',
      )));
      $wp_customize->add_setting('themes_customization[product_button_bgcolor2]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_bgcolor2]', array(
          'label' => __('Products Button Background Color 2', 'themes'),
          'section' => 'customize_category_products_section',
          'settings' => 'themes_customization[product_button_bgcolor2]',
      )));
    }
    $wp_customize->add_setting( 'themes_customization[product_button_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_bgcolor]', array(
      'label' => 'Products Button Background Color',
      'section' => 'customize_category_products_section',
      'settings' => 'themes_customization[product_button_bgcolor]',
    )));
    
?>