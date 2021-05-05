<?php 
	//  =============================
    //  = Section for Timming  =
    //  =============================
    $wp_customize->add_section( 'customize_timming_section', array(
      'title'        => __( 'Timming', 'themes' ),
      'description'  => __( 'Customize Timming Section', 'themes' ),
      'priority'     => 3,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_timming_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_timming_enable]', array(
     'settings'    => 'themes_customization[radio_timming_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_timming_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[timming_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_timming_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[timming_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[timming_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[timming_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_timming_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[timming_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    
    $wp_customize->add_setting('themes_customization[number_timming_to_show]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[number_timming_to_show]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_timming_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['number_timming_to_show'] )? $this->themes_key['number_timming_to_show'] : 6;
    for($i=1; $i<=$aboutchoose; $i++) {
    
      $wp_customize->add_setting( 'themes_customization[timming_day'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[timming_day'.$i.']', array(
        'label'            => __( 'Day Title', 'themes' ),
        'section'          => 'customize_timming_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[timming_day'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[timming_hour'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[timming_hour'.$i.']', array(
        'label'            => __( 'Hour Text', 'themes' ),
        'section'          => 'customize_timming_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[timming_hour'.$i.']',
      ) );
    }
    
    $wp_customize->add_setting( 'themes_customization[timming_main_heading_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_main_heading_text_color]', array(
      'label' => 'Main Heading Text Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_main_heading_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[timming_main_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[timming_main_heading_font_family]', array(
        'section'  => 'customize_timming_section',
        'label'    => __( 'Main Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[timming_main_heading_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[timming_main_heading_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_timming_section',
        'setting' => 'themes_customization[timming_main_heading_font_size]',
        'type'    => 'text'
      )
    ); 
   
    
    $wp_customize->add_setting( 'themes_customization[timming_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_small_text_color]', array(
      'label' => 'Paragraph Text Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[timming_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[timming_small_text_fontfamily]', array(
        'section'  => 'customize_timming_section',
        'label'    => __( 'Paragraph Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[timming_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[timming_small_text_font_size]',array(
        'label' => __('Paragraph Font Size in px','themes'),
        'section' => 'customize_timming_section',
        'setting' => 'themes_customization[timming_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[timming_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_main_text_color]', array(
      'label' => 'Sub Heading Text Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[timming_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[timming_main_text_fontfamily]', array(
        'section'  => 'customize_timming_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[timming_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[timming_main_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_timming_section',
        'setting' => 'themes_customization[timming_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[timming_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[timming_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[timming_dicsount_text_fontfamily]', array(
        'section'  => 'customize_timming_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[timming_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[timming_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_timming_section',
        'setting' => 'themes_customization[timming_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[timming_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[timming_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[timming_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_timming_section',
      'settings' => 'themes_customization[timming_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[timming_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[timming_button_text_fontfamily]', array(
        'section'  => 'customize_timming_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[timming_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[timming_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_timming_section',
        'setting' => 'themes_customization[timming_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>