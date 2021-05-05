<?php
  //  =============================
    //  = Section for Gallery    =
    //  =============================
    $wp_customize->add_section( 'customize_gallery_section', array(
      'title'        => __( 'Gallery', 'themes' ),
      'description'  => __( 'Customize Gallery Section', 'themes' ),
      'priority'     => 9,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[gallery_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[gallery_enable]', array(
     'settings'    => 'themes_customization[gallery_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_gallery_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_gallery_bg_color]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_gallery_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_gallery_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[our_gallery_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_gallery_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_gallery_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_gallery_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_gallery_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[our_gallery_small_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_gallery_small_heading]', array(
      'label'            => __( 'Section Small Title', 'themes' ),
      'section'          => 'customize_gallery_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_gallery_small_heading]',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_gallery_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_gallery_main_heading]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_gallery_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_gallery_main_heading]',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_gallery_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_gallery_shortcode]', array(
      'label'            => __( 'Add Gallery Shortcode Here', 'themes' ),
      'section'          => 'customize_gallery_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_gallery_shortcode]',
    ) );
    $wp_customize->add_setting( 'themes_customization[themes_gallery_title_color_first]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_gallery_title_color_first]', array(
      'label' => __('Section Title Color', 'themes'),
      'section' => 'customize_gallery_section',
      'settings' => 'themes_customization[themes_gallery_title_color_first]',
    )));

    $wp_customize->add_setting('themes_customization[themes_gallery_title_font_family]',array(
       'default' => '',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_gallery_title_font_family]', array(
        'section'  => 'customize_gallery_section',
        'label'    => __('Section Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[themes_gallery_title_font_size]',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[themes_gallery_title_font_size]',array(
      'label' => __('Section Title font size in px','themes'),
      'section' => 'customize_gallery_section',
      'setting' => 'themes_customization[themes_gallery_title_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[themes_gallery_text_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_gallery_text_color]', array(
      'label' => __('Text Color', 'themes'),
      'section' => 'customize_gallery_section',
      'settings' => 'themes_customization[themes_gallery_text_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_gallery_text_font_family]',array(
       'default' => '',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_gallery_text_font_family]', array(
        'section'  => 'customize_gallery_section',
        'label'    => __('Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[themes_gallery_text_font_size]',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[themes_gallery_text_font_size]',array(
      'label' => __('Text font size in px','themes'),
      'section' => 'customize_gallery_section',
      'setting' => 'themes_customization[themes_gallery_text_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[gallery_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[gallery_main_text_color]', array(
      'label' => 'Main Head Color',
      'section' => 'customize_gallery_section',
      'settings' => 'themes_customization[gallery_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[gallery_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[gallery_main_text_fontfamily]', array(
        'section'  => 'customize_gallery_section',
        'label'    => __( 'Main Head Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[gallery_main_text_fontsize]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[gallery_main_text_fontsize]',array(
        'label' => __('Mani Head Font Size in px','themes'),
        'section' => 'customize_gallery_section',
        'setting' => 'themes_customization[gallery_main_text_fontsize]',
        'type'    => 'text'
      )
    ); 
?>