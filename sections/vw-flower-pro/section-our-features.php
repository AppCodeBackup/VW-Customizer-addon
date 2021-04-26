<?php 
	//  =============================
    //  = Section for Our Features  =
    //  =============================
    $wp_customize->add_section( 'customize_features_section', array(
      'title'        => __( 'Our Features', 'themes' ),
      'description'  => __( 'Customize Our Features Section', 'themes' ),
      'priority'     => 3,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_features_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_features_enable]', array(
     'settings'    => 'themes_customization[radio_features_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_features_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_features_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_features_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_features_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_features_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_features_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_features_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_features_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_features_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting('themes_customization[our_features_number]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[our_features_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_features_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['our_features_number'] )? $this->themes_key['our_features_number'] : 3;
    for($i=1; $i<=$aboutchoose; $i++) {

      if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[our_features_bgcolor'.$i.']', array(
  	      // 'default'        => '#ddd5c3',
  	      'type'              => 'option',
  	      'capability'        => 'manage_options',
  	      'transport'         => 'postMessage',
  	      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
  	    ) );

  	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_features_bgcolor'.$i.']', array(
  	      'label'      => __( 'Background Color:', 'themes' ).$i,
  	      'section'    => 'customize_features_section',
  	      'priority'   => Null,
  	      'settings'   => 'themes_customization[our_features_bgcolor'.$i.']'
  	    ) ) );
      }
	    $wp_customize->add_setting( 'themes_customization[our_features_image'.$i.']', array(
	      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
	      'type'              => 'option',
	      'capability'        => 'manage_options',
	      'transport'         => 'postMessage',
	      'sanitize_callback' => 'themes_sanitize_image'
	    ) );

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_features_image'.$i.']', array(
	      'label'      => __( 'Background Image ','themes').$i,
	      'section'    => 'customize_features_section',
	      'priority'   => Null,
	      'settings'   => 'themes_customization[our_features_image'.$i.']',
	      'button_labels' => array(
	         'select'       => __( 'Select Image', 'themes' ),
	    ) ) ) );
      if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[features_small_title'.$i.']', array(
	        'default'           => '',
	        'type'              => 'option',
	        'capability'        => 'manage_options',
	        'transport'         => 'postMessage',
	        'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[features_small_title'.$i.']', array(
	        'label'            => __( 'Small Title', 'themes' ),
	        'section'          => 'customize_features_section',
	        'priority'         => Null,
	        'settings'         => 'themes_customization[features_small_title'.$i.']',
        ) );
      }
      $wp_customize->add_setting( 'themes_customization[features_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[features_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_features_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[features_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[features_discount_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[features_discount_text'.$i.']', array(
        'label'            => __( 'Discount Title', 'themes' ),
        'section'          => 'customize_features_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[features_discount_text'.$i.']',
      ) );
      if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[features_discount_value'.$i.']', array(
	        'default'           => '',
	        'type'              => 'option',
	        'capability'        => 'manage_options',
	        'transport'         => 'postMessage',
	        'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[features_discount_value'.$i.']', array(
	        'label'            => __( 'Discount Value', 'themes' ),
	        'section'          => 'customize_features_section',
	        'priority'         => Null,
	        'settings'         => 'themes_customization[features_discount_value'.$i.']',
        ) );
      }
      $wp_customize->add_setting( 'themes_customization[features_url_text'.$i.']', array(
	      'default'           => '',
	      'type'              => 'option',
	      'capability'        => 'manage_options',
	      'transport'         => 'postMessage',
	      'sanitize_callback' => 'wp_kses_post'
	    ) );

	    $wp_customize->add_control( 'themes_customization[features_url_text'.$i.']', array(
	      'label'            => __( 'Button Text', 'themes' ).$i,
	      'section'          => 'customize_features_section',
	      'priority'         => Null,
	      'settings'         => 'themes_customization[features_url_text'.$i.']',
	    ) );
	    $wp_customize->add_setting('themes_customization[features_feat_url'.$i.']',array(
	        'default' => '',
	        'sanitize_callback' => 'esc_url_raw'
	    ));
	    $wp_customize->add_control('themes_customization[features_feat_url'.$i.']',array(
	        'label' => __('Button Url','themes').$i,
	        'section' => 'customize_features_section',
	        'setting' => 'themes_customization[features_feat_url'.$i.']',
	        'type'    => 'url'
	    ));
	    $wp_customize->add_setting(
	        'themes_customization[features_feat_icon'.$i.']',
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
	          'themes_customization[features_feat_icon'.$i.']',
	          array(
	            'settings'    => 'themes_customization[features_feat_icon'.$i.']',
	            'section'   => 'customize_features_section',
	            'type'      => 'icon',
	            'label'     => esc_html__( 'Features Icon', 'themes' ),
	          )
	        )
	    );
    }
    $wp_customize->add_setting( 'themes_customization[features_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[features_small_text_color]', array(
      'label' => 'Features Small Text Color',
      'section' => 'customize_features_section',
      'settings' => 'themes_customization[features_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[features_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[features_small_text_fontfamily]', array(
        'section'  => 'customize_features_section',
        'label'    => __( 'Features Small Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[features_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[features_small_text_font_size]',array(
        'label' => __('Features Small Text Font Size in px','themes'),
        'section' => 'customize_features_section',
        'setting' => 'themes_customization[features_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[features_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[features_main_text_color]', array(
      'label' => 'Features Main Text Color',
      'section' => 'customize_features_section',
      'settings' => 'themes_customization[features_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[features_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[features_main_text_fontfamily]', array(
        'section'  => 'customize_features_section',
        'label'    => __( 'Features Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[features_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[features_main_text_font_size]',array(
        'label' => __('Features Main Text Font Size in px','themes'),
        'section' => 'customize_features_section',
        'setting' => 'themes_customization[features_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[features_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[features_dicsount_text_color]', array(
      'label' => 'Features Discount Text Color',
      'section' => 'customize_features_section',
      'settings' => 'themes_customization[features_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[features_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[features_dicsount_text_fontfamily]', array(
        'section'  => 'customize_features_section',
        'label'    => __( 'Features Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[features_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[features_dicsount_text_font_size]',array(
        'label' => __('Features Discount Text Font Size in px','themes'),
        'section' => 'customize_features_section',
        'setting' => 'themes_customization[features_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[features_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[features_button_bg_color]', array(
      'label' => 'Features Button Background Color',
      'section' => 'customize_features_section',
      'settings' => 'themes_customization[features_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[features_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[features_button_text_color]', array(
      'label' => 'Features Button Text Color',
      'section' => 'customize_features_section',
      'settings' => 'themes_customization[features_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[features_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[features_button_text_fontfamily]', array(
        'section'  => 'customize_features_section',
        'label'    => __( 'Features Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[features_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[features_button_text_font_size]',array(
        'label' => __('Features Button Text Font Size in px','themes'),
        'section' => 'customize_features_section',
        'setting' => 'themes_customization[features_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>