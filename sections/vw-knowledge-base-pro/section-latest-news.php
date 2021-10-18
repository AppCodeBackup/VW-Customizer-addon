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
  $wp_customize->add_setting( 'themes_customization_latest_news_option',
      array(
          'default' => '',
          'transport' => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_choices'
      )
  );
  $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_latest_news_option',
      array(
          'label' => __('Best Seller Content Settings','themes'),
          'section' => 'customize_latest_news_section'
      )
  ) );
  $wp_customize->selective_refresh->add_partial( 'themes_customization_latest_news_option', array(
      'selector' => '#our-blogs .container',
      'render_callback' => 'themes_customize_partial_themes_customization_latest_news_option',
  ) );
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
  $wp_customize->add_setting( 'themes_customization[latest_news_link_title]', array(
    'default'           => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'wp_kses_post'
  ) );

  $wp_customize->add_control( 'themes_customization[latest_news_link_title]', array(
    'label'            => __( 'Button Title', 'themes' ),
    'section'          => 'customize_latest_news_section',
    'priority'         => Null,
    'settings'         => 'themes_customization[latest_news_link_title]',
  ) );
  $wp_customize->add_setting(
    'themes_customization[latest_news_btn_icon1]',
    array(
      'default'     => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
    new themes_Fontawesome_Icon_Chooser(
      $wp_customize,
      'themes_customization[latest_news_btn_icon1]',
      array(
        'settings'    => 'themes_customization[latest_news_btn_icon1]',
        'section'   => 'customize_latest_news_section',
        'type'      => 'icon',
        'label'     => esc_html__( 'Button Icon', 'themes' ),
      )
    )
  );
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
    'label' => __('Meta Text Color', 'themes'),
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
      'label'    => __('Meta Text Font','themes'),
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
        'label' => __('Meta Text Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[date_title_font_size]',
        'type'    => 'text'
      )
  );
  if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
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
  $wp_customize->add_setting( 'themes_customization[themes_latest_button_bgcolor]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_button_bgcolor]', array(
    'label' => __('Button Background Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_latest_button_bgcolor]',
  )));
  $wp_customize->add_setting( 'themes_customization[themes_latest_title_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_title_color]', array(
    'label' => __('Post Title Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_latest_title_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_latest_title_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_latest_title_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Post Title Font','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_latest_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_latest_title_font_size]',array(
        'label' => __('Post Title Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_latest_title_font_size]',
        'type'    => 'text'
      )
  );
}
  $wp_customize->add_setting( 'themes_customization[themes_latest_text_color]', array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_latest_text_color]', array(
    'label' => __('Post Text Color', 'themes'),
    'section' => 'customize_latest_news_section',
    'settings' => 'themes_customization[themes_latest_text_color]',
  )));

  $wp_customize->add_setting('themes_customization[themes_latest_text_font_family]',array(
    'default' => '',
    'type'              => 'option',
    'capability'        => 'manage_options',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(
      'themes_customization[themes_latest_text_font_family]', array(
      'section'  => 'customize_latest_news_section',
      'label'    => __('Post Text Font','themes'),
      'type'     => 'select',
      'choices'  => $font_array,
  ));
  $wp_customize->add_setting('themes_customization[themes_latest_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
  );
  $wp_customize->add_control('themes_customization[themes_latest_text_font_size]',array(
        'label' => __('Post Text Font size in px','themes'),
        'section' => 'customize_latest_news_section',
        'setting' => 'themes_customization[themes_latest_text_font_size]',
        'type'    => 'text'
      )
  );
?>