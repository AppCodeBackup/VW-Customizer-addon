<?php
  //  =============================
  //  = Section for Latest News    =
  //  =============================
  $wp_customize->add_section( 'customize_latest_news_section', array(
    'title'        => __( 'Latest News', 'themes' ),
    'description'  => __( 'Customize Latest News Section', 'themes' ),
    'priority'     => 15,
    'panel'        => 'themes_panel',
  ) );
  $wp_customize->add_setting( 'themes_customization[latest_news_enabledisable]', array(
    'default'           => false,
    'type'              => 'option',
    'capability'         => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_checkbox'
  ) );

  $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[latest_news_enabledisable]', array(
   'settings'    => 'themes_customization[latest_news_enabledisable]',
    'label'       => __( 'Disable Section:', 'themes'),
    'section'     => 'customize_latest_news_section',
   'priority'   => 2,
    'type'        => 'ios', // light, ios, flat
  ) ) );
  $wp_customize->add_setting( 'themes_customization[latest_news_bg_color]', array(
    'default'        => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[latest_news_bg_color]', array(
    'label'      => __( 'Background Color:', 'themes' ),
    'section'    => 'customize_latest_news_section',
    'priority'   => 5,
    'settings'   => 'themes_customization[latest_news_bg_color]'
  ) ) );
  $wp_customize->add_setting( 'themes_customization[latest_news_bg_image]', array(
    'default'       =>  '' ,
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_image'
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[latest_news_bg_image]', array(
    'label'      => __( 'Background Image ','themes'),
    'section'    => 'customize_latest_news_section',
    'priority'   => Null,
    'settings'   => 'themes_customization[latest_news_bg_image]',
    'button_labels' => array(
       'select'       => __( 'Select Image', 'themes' ),
  ) ) ) );
  $wp_customize->add_setting( 'themes_customization[latest_news_main_heading]', array(
    'default'           => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wp_kses_post'
  ) );
  $wp_customize->add_control( 'themes_customization[latest_news_main_heading]', array(
    'label'            => __( 'Section Main Title', 'themes' ),
    'section'          => 'customize_latest_news_section',
    'priority'         => Null,
    'settings'         => 'themes_customization[latest_news_main_heading]',
  ) );
  $wp_customize->add_setting( 'themes_customization[themes_latest_newsmall_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_newsmall_title_color]', array(
    'label' => __('Section Small Title Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_latest_newsmall_title_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_latest_newsmall_title_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_latest_newsmall_title_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Section Small Title Font family','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_latest_newsmall_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_latest_newsmall_title_font_size]',array(
        'label' => __('Section Small Title Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_latest_newsmall_title_font_size]',
        'type'    => 'text'
      )
  );
  
  $wp_customize->add_setting( 'themes_customization[themes_service_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_title_color]', array(
    'label' => __('Section Title Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_service_title_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_service_title_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_service_title_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Section Title Font family','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_service_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_service_title_font_size]',array(
        'label' => __('Section Title Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_service_title_font_size]',
        'type'    => 'text'
      )
  );
  $wp_customize->add_setting( 'themes_customization[themes_service_box_icons_bg_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_icons_bg_color]', array(
    'label' => __('Box Icons Background Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_service_box_icons_bg_color]',
  )));
  
  $wp_customize->add_setting( 'themes_customization[themes_service_box_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_title_color]', array(
    'label' => __('Box Title Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_service_box_title_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_service_box_title_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_service_box_title_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Box Title Font family','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_service_box_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_service_box_title_font_size]',array(
        'label' => __('Box Title Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_service_box_title_font_size]',
        'type'    => 'text'
      )
  );
  $wp_customize->add_setting( 'themes_customization[themes_service_box_content_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_content_color]', array(
    'label' => __('Box Content Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_service_box_content_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_service_box_content_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_service_box_content_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Box Content Font family','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_service_box_content_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_service_box_content_font_size]',array(
        'label' => __('Box Content Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_service_box_content_font_size]',
        'type'    => 'text'
      )
  );
?>