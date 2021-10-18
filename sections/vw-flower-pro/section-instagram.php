<?php 
	//  =============================
    //  = Section for Instagram =
    //  =============================
    $wp_customize->add_section( 'customize_Instagram_section', array(
      'title'        => __( 'Instagram', 'themes' ),
      'description'  => __( 'Customize Instagram Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_Instagram_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_Instagram_enable]', array(
     'settings'    => 'themes_customization[radio_Instagram_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_Instagram_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[instagram_bg_color]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[instagram_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_Instagram_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[instagram_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[instagram_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[instagram_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_Instagram_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[instagram_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization_instagram_option',
        array(
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_choices'
        )
    );
    $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_instagram_option',
        array(
            'label' => __('Instagram Content Settings','themes'),
            'section' => 'customize_Instagram_section'
        )
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_customization_instagram_option', array(
        'selector' => '#instagramsec .container ',
        'render_callback' => 'themes_customize_partial_themes_customization_instagram_option',
    ) );
    $wp_customize->add_setting( 'themes_customization[instagram_title_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[instagram_title_image]', array(
      'label'      => __( 'Instagram Title Image ','themes'),
      'section'    => 'customize_Instagram_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[instagram_title_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[instagram_small_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[instagram_small_heading]', array(
      'label'            => __( 'Instagram Small Text', 'themes' ),
      'section'          => 'customize_Instagram_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[instagram_small_heading]',
    ) );
    $wp_customize->add_setting( 'themes_customization[instagram_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[instagram_main_heading]', array(
      'label'            => __( 'Section Main Heading', 'themes' ),
      'section'          => 'customize_Instagram_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[instagram_main_heading]',
    ) );
    
    $wp_customize->add_setting( 'themes_customization[instagram_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[instagram_shortcode]', array(
      'label'            => __( 'Instagram Shortcode', 'themes' ),
      'section'          => 'customize_Instagram_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[instagram_shortcode]',
    ) );
    $wp_customize->add_setting( 'themes_customization[instagram_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[instagram_main_text_color]', array(
      'label' => 'Main Text Color',
      'section' => 'customize_Instagram_section',
      'settings' => 'themes_customization[instagram_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[instagram_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[instagram_main_text_fontfamily]', array(
        'section'  => 'customize_Instagram_section',
        'label'    => __( 'Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[instagram_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[instagram_main_text_font_size]',array(
        'label' => __('Main Text Font Size in px','themes'),
        'section' => 'customize_Instagram_section',
        'setting' => 'themes_customization[instagram_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[instagram_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[instagram_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_Instagram_section',
      'settings' => 'themes_customization[instagram_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[instagram_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[instagram_text_fontfamily]', array(
        'section'  => 'customize_Instagram_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[instagram_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[instagram_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_Instagram_section',
        'setting' => 'themes_customization[instagram_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>