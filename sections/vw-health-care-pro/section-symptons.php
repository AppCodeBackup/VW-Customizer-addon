<?php 
	//  =============================
    //  = Section for Why Choose Us  =
    //  =============================
    $wp_customize->add_section( 'customize_symptoms_us_section', array(
      'title'        => __( 'Coronavirus Symptoms', 'themes' ),
      'description'  => __( 'Customize Coronavirus Symptoms Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_symptoms_us_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_symptoms_us_enable]', array(
     'settings'    => 'themes_customization[radio_symptoms_us_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_symptoms_us_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[symptoms_us_bgcolor]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_symptoms_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[symptoms_us_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[symptoms_us_bgimage]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[symptoms_us_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_symptoms_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[symptoms_us_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization_symptoms_option',
      array(
          'default' => '',
          'transport' => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_choices'
      )
    );
    $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_symptoms_option',
        array(
            'label' => __('Symptoms Content Settings','themes'),
            'section' => 'customize_symptoms_us_section'
        )
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_customization_symptoms_option', array(
        'selector' => '#symptoms-us .container-fluid',
        'render_callback' => 'themes_customize_partial_themes_customization_symptoms_option',
    ) );
    $wp_customize->add_setting( 'themes_customization[symptoms_left_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[symptoms_left_image]', array(
      'label'      => __( 'Side Image ','themes'),
      'section'    => 'customize_symptoms_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[symptoms_left_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[covid_symptoms_left_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[covid_symptoms_left_title]', array(
      'label'            => __( 'Section Small Title', 'themes' ),
      'section'          => 'customize_symptoms_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[covid_symptoms_left_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[covid_symptoms_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[covid_symptoms_title]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_symptoms_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[covid_symptoms_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[covid_symptoms_sec_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[covid_symptoms_sec_text]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_symptoms_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[covid_symptoms_sec_text]',
    ) );
    $wp_customize->add_setting('themes_customization[covid_symptoms_box_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[covid_symptoms_box_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_symptoms_us_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['covid_symptoms_box_number'] )? $this->themes_key['covid_symptoms_box_number'] : 3;
    for($i=1; $i<=$aboutchoose; $i++) {
    
      $wp_customize->add_setting( 'themes_customization[covid_symptoms_image'.$i.']', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[covid_symptoms_image'.$i.']', array(
        'label'      => __( 'Blog Image ','themes').$i,
        'section'    => 'customize_symptoms_us_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[covid_symptoms_image'.$i.']',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[covid_symptoms_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[covid_symptoms_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_symptoms_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[covid_symptoms_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[covid_symptoms_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[covid_symptoms_text'.$i.']', array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_symptoms_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[covid_symptoms_text'.$i.']',
      ) );
    }
    
    $wp_customize->add_setting( 'themes_customization[symptoms_us_main_heading_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_main_heading_text_color]', array(
      'label' => 'Main Heading Text Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_main_heading_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[symptoms_us_main_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[symptoms_us_main_heading_font_family]', array(
        'section'  => 'customize_symptoms_us_section',
        'label'    => __( 'Main Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[symptoms_us_main_heading_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[symptoms_us_main_heading_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_symptoms_us_section',
        'setting' => 'themes_customization[symptoms_us_main_heading_font_size]',
        'type'    => 'text'
      )
    );    
    
    $wp_customize->add_setting( 'themes_customization[symptoms_us_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_small_text_color]', array(
      'label' => 'Paragraph Text Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[symptoms_us_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[symptoms_us_small_text_fontfamily]', array(
        'section'  => 'customize_symptoms_us_section',
        'label'    => __( 'Paragraph Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[symptoms_us_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[symptoms_us_small_text_font_size]',array(
        'label' => __('Paragraph Font Size in px','themes'),
        'section' => 'customize_symptoms_us_section',
        'setting' => 'themes_customization[symptoms_us_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[symptoms_us_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_main_text_color]', array(
      'label' => 'Sub Heading Text Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[symptoms_us_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[symptoms_us_main_text_fontfamily]', array(
        'section'  => 'customize_symptoms_us_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[symptoms_us_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[symptoms_us_main_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_symptoms_us_section',
        'setting' => 'themes_customization[symptoms_us_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[symptoms_us_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[symptoms_us_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[symptoms_us_dicsount_text_fontfamily]', array(
        'section'  => 'customize_symptoms_us_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[symptoms_us_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[symptoms_us_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_symptoms_us_section',
        'setting' => 'themes_customization[symptoms_us_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[symptoms_us_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[symptoms_us_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[symptoms_us_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_symptoms_us_section',
      'settings' => 'themes_customization[symptoms_us_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[symptoms_us_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[symptoms_us_button_text_fontfamily]', array(
        'section'  => 'customize_symptoms_us_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[symptoms_us_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[symptoms_us_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_symptoms_us_section',
        'setting' => 'themes_customization[symptoms_us_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>