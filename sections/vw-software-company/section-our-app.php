<?php
  $wp_customize->add_section( 'customize_our_app_section', array(
      'title'        => __( 'Our App', 'themes' ),
      'description'  => __( 'Customize Our App Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_our_app_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_our_app_enable]', array(
     'settings'    => 'themes_customization[radio_our_app_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_our_app_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_app_section_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_app_section_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_our_app_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_app_section_bgcolor]'
    ) ) );


    $wp_customize->add_setting( 'themes_customization[our_app_section_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_app_section_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_our_app_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_app_section_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );

    if(!defined('VW_HEALTH_CARE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_app_left_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_app_left_image]', array(
        'label'      => __( 'Our App Left Image ','themes'),
        'section'    => 'customize_our_app_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[our_app_left_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }

    $wp_customize->add_setting( 'themes_customization[our_app_main_small_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_app_main_small_title]', array(
      'label'            => __( 'Small Title', 'themes' ),
      'section'          => 'customize_our_app_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_app_main_small_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_app_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_app_main_title]', array(
      'label'            => __( 'Main Title', 'themes' ),
      'section'          => 'customize_our_app_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_app_main_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_app_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_app_para]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_our_app_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_app_para]',
    ) );
    $wp_customize->add_setting('themes_customization[our_app_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[our_app_number]',array(
        'label' => __('Number of Images to show','themes'),
        'section'   => 'customize_our_app_section',
        'type'      => 'number'
    ));

    $count =  isset( $this->themes_key['our_app_number'] )? $this->themes_key['our_app_number'] : 2;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting(
        'themes_customization[our_app_icon'.$i.']',
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
          'themes_customization[our_app_icon'.$i.']',
          array(
            'settings'    => 'themes_customization[our_app_icon'.$i.']',
            'section'   => 'customize_our_app_section',
            'type'      => 'icon',
            'label'     => esc_html__( 'Box Icon', 'themes' ),
          )
        )
      );
      $wp_customize->add_setting( 'themes_customization[our_app_box_one_para'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_app_box_one_para'.$i.']', array(
        'label'            => __( 'Section Text One', 'themes' ).$i,
        'section'          => 'customize_our_app_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_app_box_one_para'.$i.']',
      ) );

      if(defined('VW_HEALTH_CARE_PRO_VERSION')){
        $wp_customize->add_setting('themes_customization[app_box_one_para_url'.$i.']',array(
            'default' => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control( 'themes_customization[app_box_one_para_url'.$i.']', array(
          'label'            => __( 'Button URL', 'themes' ).$i,
          'section'          => 'customize_our_app_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[app_box_one_para_url'.$i.']',
        ) );
      }

      $wp_customize->add_setting( 'themes_customization[our_app_box_two_para'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_app_box_two_para'.$i.']', array(
        'label'            => __( 'Section Text Two', 'themes' ).$i,
        'section'          => 'customize_our_app_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_app_box_two_para'.$i.']',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[app_small_left_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_small_left_title_color]', array(
      'label' => 'Small Title Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_small_left_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[app_small_left_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[app_small_left_title_fontfamily]', array(
        'section'  => 'customize_our_app_section',
        'label'    => __( 'Small Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[app_small_left_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[app_small_left_title_font_size]',array(
        'label' => __('Small Title Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_small_left_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[app_small_titlebg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_small_titlebg_color]', array(
      'label' => 'Small Title Background Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_small_titlebg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[app_main_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_main_title_color]', array(
      'label' => 'Main Title Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_main_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[app_main_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[app_main_title_fontfamily]', array(
        'section'  => 'customize_our_app_section',
        'label'    => __( 'Main Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[app_main_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[app_main_title_font_size]',array(
        'label' => __('Main Title Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_main_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[app_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_main_text_color]', array(
      'label' => 'Main Text Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[app_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[app_main_text_fontfamily]', array(
        'section'  => 'customize_our_app_section',
        'label'    => __( 'Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[app_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[app_main_text_font_size]',array(
        'label' => __('Main Text Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_main_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[app_box_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_box_bg_color]', array(
      'label' => 'App Box Background Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_box_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[app_box_icons_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_box_icons_color]', array(
      'label' => 'App Box Background Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_box_icons_color]',
    ))); 
    $wp_customize->add_setting('themes_customization[app_box_icons_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[app_box_icons_font_size]',array(
        'label' => __('App Box Icons Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_box_icons_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[app_box_icons_hovercolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_box_icons_hovercolor]', array(
      'label' => 'App Box Icons Hover Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_box_icons_hovercolor]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[app_box_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_box_title_color]', array(
      'label' => 'App Box Title Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_box_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[app_box_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[app_box_title_fontfamily]', array(
        'section'  => 'customize_our_app_section',
        'label'    => __( 'App Box Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[app_box_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[app_box_title_font_size]',array(
        'label' => __('App Box Title Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_box_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[app_box_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[app_box_text_color]', array(
      'label' => 'App Box Text Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[app_box_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[app_box_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[app_box_text_fontfamily]', array(
        'section'  => 'customize_our_app_section',
        'label'    => __( 'App Box Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[app_box_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[app_box_text_font_size]',array(
        'label' => __('App Box Text Font Size in px','themes'),
        'section' => 'customize_our_app_section',
        'setting' => 'themes_customization[app_box_text_font_size]',
        'type'    => 'text'
      )
    );
?>