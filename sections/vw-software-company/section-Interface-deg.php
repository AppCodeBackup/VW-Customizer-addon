<?php
  //  =============================
    //  = Section for Interface degines    =
    //  =============================
    $wp_customize->add_section( 'customize_Interface_section', array(
      'title'        => __( 'Interface Designing', 'themes' ),
      'description'  => __( 'Customize Interface Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_interface_deg_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_interface_deg_enable]', array(
     'settings'    => 'themes_customization[radio_interface_deg_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_Interface_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_section_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_deg_section_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_Interface_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[interface_deg_section_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_section_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[interface_deg_section_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_Interface_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[interface_deg_section_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_left_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[interface_deg_left_image]', array(
      'label'      => __( 'Left Image ','themes'),
      'section'    => 'customize_Interface_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[interface_deg_left_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_call_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[interface_deg_call_image]', array(
      'label'      => __( 'Left Call Image ','themes'),
      'section'    => 'customize_Interface_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[interface_deg_call_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_call_no]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_deg_call_no]', array(
      'label'            => __( 'Phone Title', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_deg_call_no]',
    ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_call_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_deg_call_para]', array(
      'label'            => __( 'Phone Samll Title', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_deg_call_para]',
    ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_deg_main_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_deg_main_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[interface_deg_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_deg_para]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_deg_para]',
    ) );
    $wp_customize->add_setting('themes_customization[interface_deg_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[interface_deg_number]',array(
        'label' => __('Number of List to show','themes'),
        'section'   => 'customize_Interface_section',
        'type'      => 'number'
    ));
    $count =  isset( $this->themes_key['interface_deg_number'] )? $this->themes_key['interface_deg_number'] : 5;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting( 'themes_customization[interface_deg_list_para'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[interface_deg_list_para'.$i.']', array(
        'label'            => __( 'Section List Title', 'themes' ).$i,
        'section'          => 'customize_Interface_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[interface_deg_list_para'.$i.']',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[interface_left_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_left_btn_text]', array(
      'label'            => __( 'Left Button Title', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_left_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[interface_left_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[interface_left_btn_url]',array(
        'label' => __('Left Button Link','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_left_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[interface_right_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[interface_right_btn_text]', array(
      'label'            => __( 'Right Button Title', 'themes' ),
      'section'          => 'customize_Interface_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[interface_right_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[interface_right_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[interface_right_btn_url]',array(
        'label' => __('Right Button Link','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_right_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[interface_main_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_main_title_color]', array(
      'label' => 'Main Title Color',
      'section' => 'customize_Interface_section',
      'settings' => 'themes_customization[interface_main_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[interface_main_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[interface_main_title_fontfamily]', array(
        'section'  => 'customize_Interface_section',
        'label'    => __( 'Main Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[interface_main_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[interface_main_title_font_size]',array(
        'label' => __('Main Title Font Size in px','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_main_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[interface_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_Interface_section',
      'settings' => 'themes_customization[interface_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[interface_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[interface_text_fontfamily]', array(
        'section'  => 'customize_Interface_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[interface_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[interface_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[interface_list_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_list_title_color]', array(
      'label' => 'List Title Color',
      'section' => 'customize_Interface_section',
      'settings' => 'themes_customization[interface_list_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[interface_list_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[interface_list_title_fontfamily]', array(
        'section'  => 'customize_Interface_section',
        'label'    => __( 'List Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[interface_list_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[interface_list_title_font_size]',array(
        'label' => __('List Title Font Size in px','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_list_title_font_size]',
        'type'    => 'text'
      )
    );
    
    $wp_customize->add_setting( 'themes_customization[interface_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_button_text_color]', array(
      'label' => 'Button Text Color',
      'section' => 'customize_Interface_section',
      'settings' => 'themes_customization[interface_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[interface_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[interface_button_text_fontfamily]', array(
        'section'  => 'customize_Interface_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[interface_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[interface_button_text_font_size]',array(
        'label' => __('Button Text Font Size in px','themes'),
        'section' => 'customize_Interface_section',
        'setting' => 'themes_customization[interface_button_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[interface_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[interface_button_bg_color]', array(
      'label' => 'Button Background Color',
      'section' => 'customize_Interface_section',
      'settings' => 'themes_customization[interface_button_bg_color]',
    )));
?>