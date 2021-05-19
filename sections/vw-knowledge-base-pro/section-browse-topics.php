<?php 
	//  =============================
    //  = Section for Browse Topics  =
    //  =============================
    $wp_customize->add_section( 'customize_browse_topics_section', array(
      'title'        => __( 'Browse Topics', 'themes' ),
      'description'  => __( 'Customize Browse Topics Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_browse_topics_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_browse_topics_enable]', array(
     'settings'    => 'themes_customization[radio_browse_topics_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_browse_topics_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[browse_topics_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_browse_topics_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[browse_topics_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[browse_topics_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[browse_topics_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_browse_topics_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[browse_topics_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[browse_topics_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[browse_topics_main_heading]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_browse_topics_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[browse_topics_main_heading]',
    ) );
    $wp_customize->add_setting('themes_customization[browse_topics_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[browse_topics_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_browse_topics_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['browse_topics_number'] )? $this->themes_key['browse_topics_number'] : 4;
    for($i=1; $i<=$aboutchoose; $i++) {

	    $wp_customize->add_setting( 'themes_customization[browse_topics_icon'.$i.']', array(
	      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
	      'type'              => 'option',
	      'capability'        => 'manage_options',
	      'transport'         => 'postMessage',
	      'sanitize_callback' => 'themes_sanitize_image'
	    ) );

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[browse_topics_icon'.$i.']', array(
	      'label'      => __( 'Feature Image ','themes').$i,
	      'section'    => 'customize_browse_topics_section',
	      'priority'   => Null,
	      'settings'   => 'themes_customization[browse_topics_icon'.$i.']',
	      'button_labels' => array(
	         'select'       => __( 'Select Image', 'themes' ),
	    ) ) ) );
    
      $wp_customize->add_setting( 'themes_customization[browse_topics_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[browse_topics_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_browse_topics_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[browse_topics_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[browse_topics_link_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[browse_topics_link_title'.$i.']', array(
        'label'            => __( 'Topics Link Title', 'themes' ),
        'section'          => 'customize_browse_topics_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[browse_topics_link_title'.$i.']',
      ) );
	    $wp_customize->add_setting('themes_customization[browse_topics_link_url'.$i.']',array(
	        'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
	        'sanitize_callback' => 'esc_url_raw'
	    ));
	    $wp_customize->add_control('themes_customization[browse_topics_link_url'.$i.']',array(
	        'label' => __('Topics Link Url','themes').$i,
	        'section' => 'customize_browse_topics_section',
	        'setting' => 'themes_customization[browse_topics_link_url'.$i.']',
	        'type'    => 'url'
	    ));
	    $wp_customize->add_setting(
	        'themes_customization[browse_topics_button_icon'.$i.']',
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
	          'themes_customization[browse_topics_button_icon'.$i.']',
	          array(
	            'settings'    => 'themes_customization[browse_topics_button_icon'.$i.']',
	            'section'   => 'customize_browse_topics_section',
	            'type'      => 'icon',
	            'label'     => esc_html__( 'Button Icon', 'themes' ),
	          )
	        )
	    );
      $wp_customize->add_setting( 'themes_customization[browse_topics_image'.$i.']', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[browse_topics_image'.$i.']', array(
        'label'      => __( 'Topics Hover Image ','themes').$i,
        'section'    => 'customize_browse_topics_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[browse_topics_image'.$i.']',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    $wp_customize->add_setting( 'themes_customization[browse_topics_button_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[browse_topics_button_title]', array(
      'label'            => __( 'Button Title', 'themes' ),
      'section'          => 'customize_browse_topics_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[browse_topics_button_title]',
    ) );
    $wp_customize->add_setting('themes_customization[browse_topics_button_url]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[browse_topics_button_url]',array(
        'label' => __('Button Url','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_button_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting(
        'themes_customization[browse_topics_btn_icon1]',
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
          'themes_customization[browse_topics_btn_icon1]',
          array(
            'settings'    => 'themes_customization[browse_topics_btn_icon1]',
            'section'   => 'customize_browse_topics_section',
            'type'      => 'icon',
            'label'     => esc_html__( 'Button Icon', 'themes' ),
          )
        )
    );
    $wp_customize->add_setting( 'themes_customization[browse_topics_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_small_text_color]', array(
      'label' => 'Browse Topics Small Text Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[browse_topics_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[browse_topics_small_text_fontfamily]', array(
        'section'  => 'customize_browse_topics_section',
        'label'    => __( 'Browse Topics Small Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[browse_topics_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[browse_topics_small_text_font_size]',array(
        'label' => __('Browse Topics Small Text Font Size in px','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_main_text_color]', array(
      'label' => 'Browse Topics Main Text Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[browse_topics_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[browse_topics_main_text_fontfamily]', array(
        'section'  => 'customize_browse_topics_section',
        'label'    => __( 'Browse Topics Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[browse_topics_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[browse_topics_main_text_font_size]',array(
        'label' => __('Browse Topics Main Text Font Size in px','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[browse_topics_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[browse_topics_dicsount_text_fontfamily]', array(
        'section'  => 'customize_browse_topics_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[browse_topics_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[browse_topics_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[browse_topics_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[browse_topics_button_text_fontfamily]', array(
        'section'  => 'customize_browse_topics_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[browse_topics_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[browse_topics_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_last_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_last_button_bg_color]', array(
      'label' => 'Last Button Background Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_last_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_last_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_last_button_text_color]', array(
      'label' => ' Last Button Text Color',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_last_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[browse_topics_last_button_text_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[browse_topics_last_button_text_font_family]', array(
        'section'  => 'customize_browse_topics_section',
        'label'    => __( 'Last Button Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[browse_topics_last_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[browse_topics_last_button_text_font_size]',array(
        'label' => __('Last Button Font Size in px','themes'),
        'section' => 'customize_browse_topics_section',
        'setting' => 'themes_customization[browse_topics_last_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_last_button_bg_color_afterhover]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_last_button_bg_color_afterhover]', array(
      'label' => 'Last Button Background Color after Hover',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_last_button_bg_color_afterhover]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[browse_topics_last_button_text_color_afterhover]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[browse_topics_last_button_text_color_afterhover]', array(
      'label' => ' Last Button Text Color after Hover',
      'section' => 'customize_browse_topics_section',
      'settings' => 'themes_customization[browse_topics_last_button_text_color_afterhover]',
    )));  
?>