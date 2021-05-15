<?php
  //  =============================
  //  = Section for Latest News    =
  //  =============================
  $wp_customize->add_section( 'customize_latest_news_section', array(
    'title'        => __( 'Latest News', 'themes' ),
    'description'  => __( 'Customize Latest News Section', 'themes' ),
    'priority'     => Null,
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
   'priority'   => Null,
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
    'priority'   => Null,
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
  $wp_customize->add_setting( 'themes_customization[latest_news_small_heading]', array(
    'default'           => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wp_kses_post'
  ) );
  $wp_customize->add_control( 'themes_customization[latest_news_small_heading]', array(
    'label'            => __( 'Section Small Title', 'themes' ),
    'section'          => 'customize_latest_news_section',
    'priority'         => Null,
    'settings'         => 'themes_customization[latest_news_small_heading]',
  ) );
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
  $wp_customize->add_setting( 'themes_customization[latest_news_main_heading_text_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[latest_news_main_heading_text_color]', array(
    'label' => 'Section Main Title Color',
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[latest_news_main_heading_text_color]',
  )));  

  $wp_customize->add_setting('themes_customization[latest_news_main_heading_text_fontfamily]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
   ));
  $wp_customize->add_control(
      'themes_customization[latest_news_main_heading_text_fontfamily]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __( 'Section Main Title Font','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[latest_news_main_heading_text_fontsize]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('themes_customization[latest_news_main_heading_text_fontsize]',array(
      'label' => __('Section Main Title Font Size in px','themes'),
      'section' => 'customize_latest_news_section',
      'setting' => 'themes_customization[latest_news_main_heading_text_fontsize]',
      'type'    => 'text'
    )
  ); 
  $wp_customize->add_setting( 'themes_customization[themes_latest_newsmall_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_newsmall_title_color]', array(
    'label' => __('Sub Heading Color', 'themes'),
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
      'label'    => __('Sub Heading Font','themes'),
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
        'label' => __('Sub Heading Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_latest_newsmall_title_font_size]',
        'type'    => 'text'
      )
  );
  
  $wp_customize->add_setting( 'themes_customization[date_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[date_title_color]', array(
    'label' => __('Date Text Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[date_title_color]',
  )));

  $wp_customize->add_setting('themes_customization[date_title_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[date_title_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Date Text Font','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[date_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[date_title_font_size]',array(
        'label' => __('Date Text Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[date_title_font_size]',
        'type'    => 'text'
      )
  );
  $wp_customize->add_setting( 'themes_customization[date_title_bgcolor]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[date_title_bgcolor]', array(
    'label' => __('Date Box Background Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[date_title_bgcolor]',
  )));
  $wp_customize->add_setting( 'themes_customization[themes_latest_button_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_button_color]', array(
    'label' => __('Button Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_latest_button_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_latest_button_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_latest_button_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Button Font','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_latest_button_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_latest_button_font_size]',array(
        'label' => __('Button Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_latest_button_font_size]',
        'type'    => 'text'
      )
  );
?>