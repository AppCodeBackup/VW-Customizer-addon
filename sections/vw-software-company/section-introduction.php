<?php
  //  =============================
    //  = Section for Introduction    =
    //  =============================
    $wp_customize->add_section( 'customize_introduction_section', array(
      'title'        => __( 'Introduction', 'themes' ),
      'description'  => __( 'Customize Interface Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_introduction_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_introduction_enable]', array(
     'settings'    => 'themes_customization[radio_introduction_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_introduction_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[introduction_section_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_section_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_introduction_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[introduction_section_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[introduction_section_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[introduction_section_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_introduction_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[introduction_section_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[introduction_section_left_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[introduction_section_left_image]', array(
        'label'      => __( 'Right Image ','themes'),
        'section'    => 'customize_introduction_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[introduction_section_left_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[introduction_section_small_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_section_small_title]', array(
        'label'            => __( 'Small Title', 'themes' ),
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_section_small_title]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[introduction_section_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[introduction_section_main_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_introduction_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[introduction_section_main_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[introduction_section_main_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_section_main_title_color]', array(
      'label' => __('Section Main Title Color', 'themes'),
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_section_main_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[introduction_section_main_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[introduction_section_main_title_font_family]', array(
        'section'  => 'customize_introduction_section',
        'label'    => __('Section Title Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[introduction_section_main_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[introduction_section_main_title_font_size]',array(
          'label' => __('Section Title Font size in px','themes'),
          'section' => 'customize_introduction_section',
          'setting' => 'themes_customization[introduction_section_main_title_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_control('themes_customization[introduction_section_main_title_font_size]',array(
      'label' => __('Section Title Font size in px','themes'),
      'section' => 'customize_introduction_section',
      'setting' => 'themes_customization[introduction_section_main_title_font_size]',
      'type'    => 'text'
    ));
    $wp_customize->add_setting( 'themes_customization[introduction_box_bgcolor_afterhover]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_bgcolor_afterhover]', array(
      'label'      => __( 'Box Background Color After Hover:', 'themes' ),
      'section'    => 'customize_introduction_section',
      'priority'   => NULL,
      'settings'   => 'themes_customization[introduction_box_bgcolor_afterhover]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[introduction_box_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_title_color]', array(
      'label' => __('Box Main Title Color', 'themes'),
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[introduction_box_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[introduction_box_title_font_family]', array(
        'section'  => 'customize_introduction_section',
        'label'    => __('Box Main Title Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[introduction_box_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[introduction_box_title_font_size]',array(
          'label' => __('Box Main Font size in px','themes'),
          'section' => 'customize_introduction_section',
          'setting' => 'themes_customization[introduction_box_title_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[introduction_box_title_color_afterhover]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_title_color_afterhover]', array(
      'label' => __('Box Main Title Color after hover', 'themes'),
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_title_color_afterhover]',
    )));
    $wp_customize->add_setting( 'themes_customization[introduction_box_content_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_content_color]', array(
      'label' => __('Box Content Color', 'themes'),
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_content_color]',
    )));

    $wp_customize->add_setting('themes_customization[introduction_box_content_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[introduction_box_content_fontfamily]', array(
        'section'  => 'customize_introduction_section',
        'label'    => __('Box Content Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[introduction_box_content_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[introduction_box_content_font_size]',array(
          'label' => __('Box Content Font size in px','themes'),
          'section' => 'customize_introduction_section',
          'setting' => 'themes_customization[introduction_box_content_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[introduction_box_content_color_afterhover]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_content_color_afterhover]', array(
      'label' => __('Box Content Color after hover', 'themes'),
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_content_color_afterhover]',
    )));
    $wp_customize->add_setting( 'themes_customization[introduction_box_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_button_text_color]', array(
      'label' => 'Button Text Color',
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[introduction_box_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[introduction_box_button_text_fontfamily]', array(
        'section'  => 'customize_introduction_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[introduction_box_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[introduction_box_button_text_font_size]',array(
        'label' => __('Button Text Font Size in px','themes'),
        'section' => 'customize_introduction_section',
        'setting' => 'themes_customization[introduction_box_button_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[introduction_box_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[introduction_box_button_bg_color]', array(
      'label' => 'Button Background Color',
      'section' => 'customize_introduction_section',
      'settings' => 'themes_customization[introduction_box_button_bg_color]',
    )));
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[introduction_section_para]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_section_para]', array(
        'label'            => __( 'Section Text', 'themes' ),
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_section_para]',
      ) );
    }
    $wp_customize->add_setting('themes_customization[introduction_box_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[introduction_box_number]',array(
        'label' => __('Number of List to show','themes'),
        'section'   => 'customize_introduction_section',
        'type'      => 'number'
    ));
    $count =  isset( $this->themes_key['introduction_box_number'] )? $this->themes_key['introduction_box_number'] : 3;
    for($i=1; $i<=$count; $i++) {
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[introduction_box_image'.$i.']', array(
          'default'       =>  '' ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[introduction_box_image'.$i.']', array(
          'label'      => __( 'Left Image ','themes').$i,
          'section'    => 'customize_introduction_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[introduction_box_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
      $wp_customize->add_setting( 'themes_customization[introduction_box_main_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_box_main_title'.$i.']', array(
        'label'            => __( 'List Title', 'themes' ).$i,
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_box_main_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[introduction_box_para'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_box_para'.$i.']', array(
        'label'            => __( 'List Text', 'themes' ).$i,
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_box_para'.$i.']',
      ) );
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[introduction_left_btn_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_left_btn_text]', array(
        'label'            => __( 'Left Button Title', 'themes' ),
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_left_btn_text]',
      ) );
      $wp_customize->add_setting('themes_customization[introduction_left_btn_url]',array(
          'default' => '',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[introduction_left_btn_url]',array(
          'label' => __('Left Button Link','themes'),
          'section' => 'customize_introduction_section',
          'setting' => 'themes_customization[introduction_left_btn_url]',
          'type'    => 'url'
      ));
      $wp_customize->add_setting( 'themes_customization[introduction_right_btn_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[introduction_right_btn_text]', array(
        'label'            => __( 'Right Button Title', 'themes' ),
        'section'          => 'customize_introduction_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[introduction_right_btn_text]',
      ) );
      $wp_customize->add_setting('themes_customization[introduction_right_btn_url]',array(
          'default' => '',
          'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[introduction_right_btn_url]',array(
          'label' => __('Right Button Link','themes'),
          'section' => 'customize_introduction_section',
          'setting' => 'themes_customization[introduction_right_btn_url]',
          'type'    => 'url'
      ));
    }

?>