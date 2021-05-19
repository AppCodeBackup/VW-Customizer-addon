<?php
  //  =============================
    //  = Section for Home Conatct =
    //  =============================
    $wp_customize->add_section( 'customize_contact_us_section', array(
      'title'        => __( 'Home Conatct', 'themes' ),
      'description'  => __( 'Customize Home Conatct Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[contact_us_enable]', array(
     'settings'    => 'themes_customization[contact_us_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_contact_us_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_us_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_contact_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[contact_us_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[contact_us_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_contact_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[contact_us_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_sec_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[contact_us_sec_image]', array(
      'label'      => __( 'Section Left Image ','themes'),
      'section'    => 'customize_contact_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[contact_us_sec_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_sec_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[contact_us_sec_title]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_contact_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[contact_us_sec_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_sec_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[contact_us_sec_para]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_contact_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[contact_us_sec_para]',
    ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_sec_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[contact_us_sec_shortcode]', array(
      'label'            => __( 'Add Contact Form Shortcode Here', 'themes' ),
      'section'          => 'customize_contact_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[contact_us_sec_shortcode]',
    ) );
    $wp_customize->add_setting( 'themes_customization[contact_us_title_color_first]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_us_title_color_first]', array(
      'label' => __('Section Title Color', 'themes'),
      'section' => 'customize_contact_us_section',
      'settings' => 'themes_customization[contact_us_title_color_first]',
    )));

    $wp_customize->add_setting('themes_customization[contact_us_title_font_family]',array(
       'default' => '',
       'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[contact_us_title_font_family]', array(
        'section'  => 'customize_contact_us_section',
        'label'    => __('Section Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[contact_us_title_font_size]',array(
      'default' => '',
      'type' => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[contact_us_title_font_size]',array(
      'label' => __('Section Title font size in px','themes'),
      'section' => 'customize_contact_us_section',
      'setting' => 'themes_customization[contact_us_title_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[contact_us_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_us_text_color]', array(
      'label' => __('Text Color', 'themes'),
      'section' => 'customize_contact_us_section',
      'settings' => 'themes_customization[contact_us_text_color]',
    )));

    $wp_customize->add_setting('themes_customization[contact_us_text_font_family]',array(
       'default' => '',
       'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[contact_us_text_font_family]', array(
        'section'  => 'customize_contact_us_section',
        'label'    => __('Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[contact_us_text_font_size]',array(
      'default' => '',
      'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[contact_us_text_font_size]',array(
      'label' => __('Text font size in px','themes'),
      'section' => 'customize_contact_us_section',
      'setting' => 'themes_customization[contact_us_text_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[contact_us_form_button_color]', array(
      'default' => '',
      'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_us_form_button_color]', array(
      'label' => __('Button Text Color', 'themes'),
      'section' => 'customize_contact_us_section',
      'settings' => 'themes_customization[contact_us_form_button_color]',
    )));
    $wp_customize->add_setting('themes_customization[contact_us_form_button_font_family]',array(
       'default' => '',
       'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[contact_us_form_button_font_family]', array(
        'section'  => 'customize_contact_us_section',
        'label'    => __('Button Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[contact_us_form_button_font_size]',array(
      'default' => '',
      'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[contact_us_form_button_font_size]',array(
      'label' => __('Button Text font size in px','themes'),
      'section' => 'customize_contact_us_section',
      'setting' => 'themes_customization[contact_us_form_button_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[contact_us_form_button_bgcolor_first]', array(
      'default' => '',
      'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_us_form_button_bgcolor_first]', array(
      'label' => __('Button Background Color', 'themes'),
      'description' => __('For Gradient color effect select Both Gradient color first and second.','themes'),
      'section' => 'customize_contact_us_section',
      'settings' => 'themes_customization[contact_us_form_button_bgcolor_first]',
    )));
?>