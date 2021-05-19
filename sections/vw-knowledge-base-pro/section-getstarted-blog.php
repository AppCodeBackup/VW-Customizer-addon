<?php 
	//  =============================
    //  = Section for Getstarted Blog  =
    //  =============================
    $wp_customize->add_section( 'customize_getstarted_blog_section', array(
      'title'        => __( 'Getstarted Blog', 'themes' ),
      'description'  => __( 'Customize Getstarted Blog Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_getstarted_blog_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_getstarted_blog_enable]', array(
     'settings'    => 'themes_customization[radio_getstarted_blog_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_getstarted_blog_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_getstarted_blog_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[getstarted_blog_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[getstarted_blog_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_getstarted_blog_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[getstarted_blog_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting('themes_customization[getstarted_blog_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[getstarted_blog_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_getstarted_blog_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['getstarted_blog_number'] )? $this->themes_key['getstarted_blog_number'] : 4;
    for($i=1; $i<=$aboutchoose; $i++) {

	    $wp_customize->add_setting( 'themes_customization[getstarted_blog_title_icon'.$i.']', array(
	      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
	      'type'              => 'option',
	      'capability'        => 'manage_options',
	      'transport'         => 'postMessage',
	      'sanitize_callback' => 'themes_sanitize_image'
	    ) );

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[getstarted_blog_title_icon'.$i.']', array(
	      'label'      => __( 'Blog Image ','themes').$i,
	      'section'    => 'customize_getstarted_blog_section',
	      'priority'   => Null,
	      'settings'   => 'themes_customization[getstarted_blog_title_icon'.$i.']',
	      'button_labels' => array(
	         'select'       => __( 'Select Image', 'themes' ),
	    ) ) ) );
    
      $wp_customize->add_setting( 'themes_customization[getstarted_blog_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[getstarted_blog_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_getstarted_blog_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[getstarted_blog_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[getstarted_blog_text'.$i.']', array(
        //'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control(new themes_customization_Editor_Control($wp_customize,'themes_customization[getstarted_blog_text'.$i.']',array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_getstarted_blog_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[getstarted_blog_text'.$i.']',
      ) ));
      $wp_customize->add_setting('themes_customization[getstarted_feature_no'.$i.']',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[getstarted_feature_no'.$i.']',array(
          'label' => __('Number of Plans to show','themes').$i,
          'section'   => 'customize_getstarted_blog_section',
          'type'      => 'number'
      ));
      $planscount =  isset( $this->themes_key['getstarted_feature_no'.$i] )? $this->themes_key['getstarted_feature_no'.$i] : 6;
      for($j=1; $j<=$planscount; $j++) {
        $wp_customize->add_setting( 'themes_customization[getstarted_feature_title'.$i.$j.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[getstarted_feature_title'.$i.$j.']', array(
          'label'            => __( 'Plan Main Title', 'themes' ).$i.$j,
          'section'          => 'customize_getstarted_blog_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[getstarted_feature_title'.$i.$j.']',
        ) );
      }
      $wp_customize->add_setting( 'themes_customization[getstarted_blog_link_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[getstarted_blog_link_title'.$i.']', array(
        'label'            => __( 'Button Text', 'themes' ),
        'section'          => 'customize_getstarted_blog_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[getstarted_blog_link_title'.$i.']',
      ) );
	    $wp_customize->add_setting('themes_customization[getstarted_blog_link_url'.$i.']',array(
	        'default' => '',
          'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
	        'sanitize_callback' => 'esc_url_raw'
	    ));
	    $wp_customize->add_control('themes_customization[getstarted_blog_link_url'.$i.']',array(
	        'label' => __('Button Link Url','themes').$i,
	        'section' => 'customize_getstarted_blog_section',
	        'setting' => 'themes_customization[getstarted_blog_link_url'.$i.']',
	        'type'    => 'url'
	    ));
	    $wp_customize->add_setting(
	        'themes_customization[getstarted_blog_button_icon'.$i.']',
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
	          'themes_customization[getstarted_blog_button_icon'.$i.']',
	          array(
	            'settings'    => 'themes_customization[getstarted_blog_button_icon'.$i.']',
	            'section'   => 'customize_getstarted_blog_section',
	            'type'      => 'icon',
	            'label'     => esc_html__( 'Button Icon', 'themes' ),
	          )
	        )
	    );
    }
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_button_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[getstarted_blog_button_title]', array(
      'label'            => __( 'Button Title', 'themes' ),
      'section'          => 'customize_getstarted_blog_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[getstarted_blog_button_title]',
    ) );
    $wp_customize->add_setting('themes_customization[getstarted_blog_button_url]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[getstarted_blog_button_url]',array(
        'label' => __('Button Url','themes'),
        'section' => 'customize_getstarted_blog_section',
        'setting' => 'themes_customization[getstarted_blog_button_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting(
        'themes_customization[getstarted_blog_btn_icon1]',
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
          'themes_customization[getstarted_blog_btn_icon1]',
          array(
            'settings'    => 'themes_customization[getstarted_blog_btn_icon1]',
            'section'   => 'customize_getstarted_blog_section',
            'type'      => 'icon',
            'label'     => esc_html__( 'Button Icon', 'themes' ),
          )
        )
    );
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_small_text_color]', array(
      'label' => 'Browse Topics Small Text Color',
      'section' => 'customize_getstarted_blog_section',
      'settings' => 'themes_customization[getstarted_blog_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[getstarted_blog_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[getstarted_blog_small_text_fontfamily]', array(
        'section'  => 'customize_getstarted_blog_section',
        'label'    => __( 'Browse Topics Small Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[getstarted_blog_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[getstarted_blog_small_text_font_size]',array(
        'label' => __('Browse Topics Small Text Font Size in px','themes'),
        'section' => 'customize_getstarted_blog_section',
        'setting' => 'themes_customization[getstarted_blog_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_main_text_color]', array(
      'label' => 'Browse Topics Main Text Color',
      'section' => 'customize_getstarted_blog_section',
      'settings' => 'themes_customization[getstarted_blog_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[getstarted_blog_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[getstarted_blog_main_text_fontfamily]', array(
        'section'  => 'customize_getstarted_blog_section',
        'label'    => __( 'Browse Topics Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[getstarted_blog_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[getstarted_blog_main_text_font_size]',array(
        'label' => __('Browse Topics Main Text Font Size in px','themes'),
        'section' => 'customize_getstarted_blog_section',
        'setting' => 'themes_customization[getstarted_blog_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_getstarted_blog_section',
      'settings' => 'themes_customization[getstarted_blog_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[getstarted_blog_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[getstarted_blog_dicsount_text_fontfamily]', array(
        'section'  => 'customize_getstarted_blog_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[getstarted_blog_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[getstarted_blog_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_getstarted_blog_section',
        'setting' => 'themes_customization[getstarted_blog_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_getstarted_blog_section',
      'settings' => 'themes_customization[getstarted_blog_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[getstarted_blog_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[getstarted_blog_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_getstarted_blog_section',
      'settings' => 'themes_customization[getstarted_blog_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[getstarted_blog_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[getstarted_blog_button_text_fontfamily]', array(
        'section'  => 'customize_getstarted_blog_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[getstarted_blog_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[getstarted_blog_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_getstarted_blog_section',
        'setting' => 'themes_customization[getstarted_blog_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>