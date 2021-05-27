<?php 
	//  =============================
    //  = Section for Why Choose Us  =
    //  =============================
    $wp_customize->add_section( 'customize_why_choose_us_section', array(
      'title'        => __( 'Why Choose Us', 'themes' ),
      'description'  => __( 'Customize Why Choose Us Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_why_choose_us_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_why_choose_us_enable]', array(
     'settings'    => 'themes_customization[radio_why_choose_us_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_why_choose_us_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[why_choose_us_bgcolor]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_why_choose_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[why_choose_us_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[why_choose_us_bgimage]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[why_choose_us_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_why_choose_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[why_choose_us_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[why_choose_us_right_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[why_choose_us_right_image]', array(
      'label'      => __( 'Right Image ','themes'),
      'section'    => 'customize_why_choose_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[why_choose_us_right_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[why_choose_us_left_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[why_choose_us_left_title]', array(
      'label'            => __( 'Section Small Title', 'themes' ),
      'section'          => 'customize_why_choose_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[why_choose_us_left_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[why_choose_us_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[why_choose_us_title]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_why_choose_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[why_choose_us_title]',
    ) );
    $wp_customize->add_setting('themes_customization[why_choose_us_box_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[why_choose_us_box_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_why_choose_us_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['why_choose_us_box_number'] )? $this->themes_key['why_choose_us_box_number'] : 3;
    for($i=1; $i<=$aboutchoose; $i++) {
    
      $wp_customize->add_setting( 'themes_customization[why_choose_us_box_no_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[why_choose_us_box_no_text'.$i.']', array(
        'label'            => __( 'Box Number', 'themes' ),
        'section'          => 'customize_why_choose_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[why_choose_us_box_no_text'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[why_choose_us_box_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[why_choose_us_box_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_why_choose_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[why_choose_us_box_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[why_choose_us_box_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[why_choose_us_box_text'.$i.']', array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_why_choose_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[why_choose_us_box_text'.$i.']',
      ) );
    }
    
    $wp_customize->add_setting( 'themes_customization[why_choose_us_main_heading_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_main_heading_text_color]', array(
      'label' => 'Main Heading Text Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_main_heading_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[why_choose_us_main_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[why_choose_us_main_heading_font_family]', array(
        'section'  => 'customize_why_choose_us_section',
        'label'    => __( 'Main Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[why_choose_us_main_heading_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[why_choose_us_main_heading_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_why_choose_us_section',
        'setting' => 'themes_customization[why_choose_us_main_heading_font_size]',
        'type'    => 'text'
      )
    );    
    
    $wp_customize->add_setting( 'themes_customization[why_choose_us_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_small_text_color]', array(
      'label' => 'Paragraph Text Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[why_choose_us_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[why_choose_us_small_text_fontfamily]', array(
        'section'  => 'customize_why_choose_us_section',
        'label'    => __( 'Paragraph Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[why_choose_us_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[why_choose_us_small_text_font_size]',array(
        'label' => __('Paragraph Font Size in px','themes'),
        'section' => 'customize_why_choose_us_section',
        'setting' => 'themes_customization[why_choose_us_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[why_choose_us_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_main_text_color]', array(
      'label' => 'Sub Heading Text Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[why_choose_us_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[why_choose_us_main_text_fontfamily]', array(
        'section'  => 'customize_why_choose_us_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[why_choose_us_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[why_choose_us_main_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_why_choose_us_section',
        'setting' => 'themes_customization[why_choose_us_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[why_choose_us_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[why_choose_us_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[why_choose_us_dicsount_text_fontfamily]', array(
        'section'  => 'customize_why_choose_us_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[why_choose_us_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[why_choose_us_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_why_choose_us_section',
        'setting' => 'themes_customization[why_choose_us_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[why_choose_us_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[why_choose_us_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[why_choose_us_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_why_choose_us_section',
      'settings' => 'themes_customization[why_choose_us_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[why_choose_us_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[why_choose_us_button_text_fontfamily]', array(
        'section'  => 'customize_why_choose_us_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[why_choose_us_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[why_choose_us_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_why_choose_us_section',
        'setting' => 'themes_customization[why_choose_us_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>