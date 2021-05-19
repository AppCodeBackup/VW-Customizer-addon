<?php 
	//  =============================
    //  = Section for Live chat  =
    //  =============================
    $wp_customize->add_section( 'customize_live_chat_section', array(
      'title'        => __( 'Live chat', 'themes' ),
      'description'  => __( 'Customize Live chat Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_live_chat_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_live_chat_enable]', array(
     'settings'    => 'themes_customization[radio_live_chat_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_live_chat_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[live_chat_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_live_chat_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[live_chat_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[live_chat_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[live_chat_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_live_chat_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[live_chat_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    
    $wp_customize->add_setting('themes_customization[live_chat_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[live_chat_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_live_chat_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['live_chat_number'] )? $this->themes_key['live_chat_number'] : 2;
    for($i=1; $i<=$aboutchoose; $i++) {

	    $wp_customize->add_setting( 'themes_customization[live_chat_title_icon'.$i.']', array(
	      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
	      'type'              => 'option',
	      'capability'        => 'manage_options',
	      'transport'         => 'postMessage',
	      'sanitize_callback' => 'themes_sanitize_image'
	    ) );

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[live_chat_title_icon'.$i.']', array(
	      'label'      => __( 'Live Chat Image ','themes').$i,
	      'section'    => 'customize_live_chat_section',
	      'priority'   => Null,
	      'settings'   => 'themes_customization[live_chat_title_icon'.$i.']',
	      'button_labels' => array(
	         'select'       => __( 'Select Image', 'themes' ),
	    ) ) ) );
    
      $wp_customize->add_setting( 'themes_customization[live_chat_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[live_chat_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_live_chat_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[live_chat_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[live_chat_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[live_chat_text'.$i.']', array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_live_chat_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[live_chat_text'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[live_chat_link_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[live_chat_link_title'.$i.']', array(
        'label'            => __( 'Button Text', 'themes' ),
        'section'          => 'customize_live_chat_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[live_chat_link_title'.$i.']',
      ) );
      $wp_customize->add_setting('themes_customization[live_chat_link_url'.$i.']',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[live_chat_link_url'.$i.']',array(
          'label' => __('Button Link Url','themes').$i,
          'section' => 'customize_live_chat_section',
          'setting' => 'themes_customization[live_chat_link_url'.$i.']',
          'type'    => 'url'
      ));
      $wp_customize->add_setting(
          'themes_customization[live_chat_button_icon'.$i.']',
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
            'themes_customization[live_chat_button_icon'.$i.']',
            array(
              'settings'    => 'themes_customization[live_chat_button_icon'.$i.']',
              'section'   => 'customize_live_chat_section',
              'type'      => 'icon',
              'label'     => esc_html__( 'Button Icon', 'themes' ),
            )
          )
      );
    }
    
    $wp_customize->add_setting( 'themes_customization[live_chat_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_small_text_color]', array(
      'label' => 'Content Text Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[live_chat_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[live_chat_small_text_fontfamily]', array(
        'section'  => 'customize_live_chat_section',
        'label'    => __( 'Content Text Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[live_chat_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[live_chat_small_text_font_size]',array(
        'label' => __('Content Text Font Size in px','themes'),
        'section' => 'customize_live_chat_section',
        'setting' => 'themes_customization[live_chat_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[live_chat_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_main_text_color]', array(
      'label' => 'Main Heading Text Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[live_chat_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[live_chat_main_text_fontfamily]', array(
        'section'  => 'customize_live_chat_section',
        'label'    => __( 'Main Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[live_chat_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[live_chat_main_text_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_live_chat_section',
        'setting' => 'themes_customization[live_chat_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[live_chat_back_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_back_bg_color]', array(
      'label' => 'Box Background Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_back_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[live_chat_back_bg_color_afterhover]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_back_bg_color_afterhover]', array(
      'label' => 'Box Background Color AfterHover',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_back_bg_color_afterhover]',
    )));
    $wp_customize->add_setting( 'themes_customization[live_chat_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[live_chat_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[live_chat_dicsount_text_fontfamily]', array(
        'section'  => 'customize_live_chat_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[live_chat_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[live_chat_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_live_chat_section',
        'setting' => 'themes_customization[live_chat_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[live_chat_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[live_chat_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[live_chat_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[live_chat_button_text_fontfamily]', array(
        'section'  => 'customize_live_chat_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[live_chat_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[live_chat_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_live_chat_section',
        'setting' => 'themes_customization[live_chat_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[live_chat_button_border_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[live_chat_button_border_color]', array(
      'label' => ' Border Color',
      'section' => 'customize_live_chat_section',
      'settings' => 'themes_customization[live_chat_button_border_color]',
    )));  
?>