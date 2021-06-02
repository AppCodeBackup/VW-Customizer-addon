<?php 
  //  =============================
    //  = Section for Our team    =
    //  =============================
    $wp_customize->add_section( 'customize_our_team_section', array(
      'title'        => __( 'Our team', 'themes' ),
      'description'  => __( 'Customize our team Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_team_enabledisable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[our_team_enabledisable]', array(
     'settings'    => 'themes_customization[our_team_enabledisable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_our_team_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_team_bg_color]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_our_team_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_team_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_team_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_team_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_our_team_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_team_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization_our_team_option',
        array(
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_choices'
        )
    );
    $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_our_team_option',
        array(
            'label' => __('Our Team Content Settings','themes'),
            'section' => 'customize_our_team_section'
        )
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_customization_our_team_option', array(
        'selector' => '#our-teams .container ',
        'render_callback' => 'themes_customize_partial_themes_customization_our_team_option',
    ) );
    if(defined('VW_HEALTH_CARE_PRO_VERSION')||defined('VW_FACTORY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_team_small_heading]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_team_small_heading]', array(
        'label'            => __( 'Section Small Title', 'themes' ),
        'section'          => 'customize_our_team_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_team_small_heading]',
      ) );  
    }
    $wp_customize->add_setting( 'themes_customization[our_team_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_team_main_heading]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_our_team_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_team_main_heading]',
    ) );   
    $wp_customize->add_setting( 'themes_customization[team_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[team_btn_text]', array(
      'label'            => __( 'Section Button Text', 'themes' ),
      'section'          => 'customize_our_team_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[team_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[team_btn_url]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[team_btn_url]',array(
        'label' => __('Section Button Url','themes'),
        'section' => 'customize_our_team_section',
        'setting' => 'themes_customization[team_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[our_team_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_title_color]', array(
      'label' => __('Section Title Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[our_team_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[our_team_title_font_family]', array(
        'section'  => 'customize_our_team_section',
        'label'    => __('Section Title Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_team_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[our_team_title_font_size]',array(
          'label' => __('Section Title Font size in px','themes'),
          'section' => 'customize_our_team_section',
          'setting' => 'themes_customization[our_team_title_font_size]',
          'type'    => 'text'
        )
    );
    if(defined('VW_HEALTH_CARE_PRO_VERSION')||defined('VW_FACTORY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_team_small_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_small_title_color]', array(
        'label' => __('Section Small Title Color', 'themes'),
        'section' => 'customize_our_team_section',
        'settings' => 'themes_customization[our_team_small_title_color]',
      )));

      $wp_customize->add_setting('themes_customization[our_team_small_title_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[our_team_small_title_font_family]', array(
          'section'  => 'customize_our_team_section',
          'label'    => __('Section Small Title Font family','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[our_team_small_title_font_size]',array(
            'default' => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
          )
      );
      $wp_customize->add_control('themes_customization[our_team_small_title_font_size]',array(
            'label' => __('Section Small Title Font size in px','themes'),
            'section' => 'customize_our_team_section',
            'setting' => 'themes_customization[our_team_small_title_font_size]',
            'type'    => 'text'
          )
      );
    }
    $wp_customize->add_setting( 'themes_customization[our_team_box_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_bg_color]', array(
      'label' => __('Box Background Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_bg_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[our_team_box_hover_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_hover_bgcolor]', array(
      'label' => __('Box Background Hover Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_hover_bgcolor]',
    )));
    $wp_customize->add_setting( 'themes_customization[our_team_box_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_title_color]', array(
      'label' => __('Box Title Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[our_team_box_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[our_team_box_title_font_family]', array(
        'section'  => 'customize_our_team_section',
        'label'    => __('Box Title Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_team_box_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[our_team_box_title_font_size]',array(
          'label' => __('Box Title Font size in px','themes'),
          'section' => 'customize_our_team_section',
          'setting' => 'themes_customization[our_team_box_title_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[our_team_box_content_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_content_color]', array(
      'label' => __('Box Content Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_content_color]',
    )));

    $wp_customize->add_setting('themes_customization[our_team_box_content_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[our_team_box_content_font_family]', array(
        'section'  => 'customize_our_team_section',
        'label'    => __('Box Content Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_team_box_content_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[our_team_box_content_font_size]',array(
          'label' => __('Box Content Font size in px','themes'),
          'section' => 'customize_our_team_section',
          'setting' => 'themes_customization[our_team_box_content_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[our_team_bg_color_afterhover]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_bg_color_afterhover]', array(
      'label'      => __( 'Box Content Hover Color:', 'themes' ),
      'section'    => 'customize_our_team_section',
      'priority'   => NULL,
      'settings'   => 'themes_customization[our_team_bg_color_afterhover]'
    ) ) );

    $wp_customize->add_setting( 'themes_customization[our_team_box_button_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_button_color]', array(
      'label' => __('Button Text Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_button_color]',
    )));

    $wp_customize->add_setting('themes_customization[our_team_box_button_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[our_team_box_button_font_family]', array(
        'section'  => 'customize_our_team_section',
        'label'    => __('Button Text Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_team_box_button_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[our_team_box_button_font_size]',array(
          'label' => __('Button Text Font size in px','themes'),
          'section' => 'customize_our_team_section',
          'setting' => 'themes_customization[our_team_box_button_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[our_team_box_button_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_team_box_button_bgcolor]', array(
      'label' => __('Button Background Color', 'themes'),
      'section' => 'customize_our_team_section',
      'settings' => 'themes_customization[our_team_box_button_bgcolor]',
    )));
?>