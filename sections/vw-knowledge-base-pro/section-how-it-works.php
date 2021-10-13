<?php 
	//  =============================
    //  = Section for How It Works  =
    //  =============================
    $wp_customize->add_section( 'customize_how_it_work_section', array(
      'title'        => __( 'How It Works', 'themes' ),
      'description'  => __( 'Customize How It Works Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_how_it_work_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_how_it_work_enable]', array(
     'settings'    => 'themes_customization[radio_how_it_work_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_how_it_work_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[how_it_work_bg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_how_it_work_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[how_it_work_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[how_it_work_bg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[how_it_work_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_how_it_work_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[how_it_work_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_HEALTH_CARE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[how_it_work_small_heading]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[how_it_work_small_heading]', array(
        'label'            => __( 'Section Small Title', 'themes' ),
        'section'          => 'customize_how_it_work_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[how_it_work_small_heading]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[how_it_work_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[how_it_work_main_heading]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_how_it_work_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[how_it_work_main_heading]',
    ) );
    if(!defined('VW_HEALTH_CARE_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[how_it_work_title_number]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[how_it_work_title_number]',array(
          'label' => __('Number of Title to show','themes'),
          'section'   => 'customize_how_it_work_section',
          'type'      => 'number',
          'priority'   => Null,
      ));

      $aboutchoose =  isset( $this->themes_key['how_it_work_title_number'] )? $this->themes_key['how_it_work_title_number'] : 2;
      for($i=1; $i<=$aboutchoose; $i++) {
        $wp_customize->add_setting( 'themes_customization[how_it_work_box_title'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[how_it_work_box_title'.$i.']', array(
          'label'            => __( 'Main Text', 'themes' ).$i,
          'section'          => 'customize_how_it_work_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[how_it_work_box_title'.$i.']',
        ) );
      }
    $wp_customize->add_setting('themes_customization[how_it_work_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[how_it_work_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_how_it_work_section',
        'type'      => 'number',
        'priority'   => Null,
    ));

    $aboutchoose =  isset( $this->themes_key['how_it_work_number'] )? $this->themes_key['how_it_work_number'] : 4;
    for($i=1; $i<=$aboutchoose; $i++) {

      $wp_customize->add_setting( 'themes_customization[how_it_work_title_icon'.$i.']', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[how_it_work_title_icon'.$i.']', array(
        'label'      => __( 'Blog Image ','themes').$i,
        'section'    => 'customize_how_it_work_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[how_it_work_title_icon'.$i.']',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    
      $wp_customize->add_setting( 'themes_customization[how_it_work_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[how_it_work_title'.$i.']', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_how_it_work_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[how_it_work_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[how_it_work_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[how_it_work_text'.$i.']', array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_how_it_work_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[how_it_work_text'.$i.']',
      ) );
    }
    }
    if(defined('VW_HEALTH_CARE_PRO_VERSION')){ 
      $wp_customize->add_setting( 'themes_customization[how_it_work_box_title1]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[how_it_work_box_title1]', array(
        'label'            => __( 'Head Text 1', 'themes' ),
        'section'          => 'customize_how_it_work_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[how_it_work_box_title1]',
      ) );

      $wp_customize->add_setting('themes_customization[how_it_work_number1]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[how_it_work_number1]',array(
          'label' => __("Number of do's list to show','themes"),
          'section'   => 'customize_how_it_work_section',
          'type'      => 'number',
          'priority'   => Null,
      ));

    $work_choose1 =  isset( $this->themes_key['how_it_work_number1'] )? $this->themes_key['how_it_work_number1'] : 3;
      for($i=1; $i<=$work_choose1; $i++) {

        $wp_customize->add_setting( 'themes_customization[how_it_work_title_icon1'.$i.']', array(
          // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[how_it_work_title_icon1'.$i.']', array(
          'label'      => __( 'Blog Image 1 ','themes').$i,
          'section'    => 'customize_how_it_work_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[how_it_work_title_icon1'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      
        $wp_customize->add_setting( 'themes_customization[how_it_work_title1'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[how_it_work_title1'.$i.']', array(
          'label'            => __( 'Main Title 1', 'themes' ),
          'section'          => 'customize_how_it_work_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[how_it_work_title1'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[how_it_work_text1'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[how_it_work_text1'.$i.']', array(
          'label'            => __( 'Main Text 2', 'themes' ),
          'section'          => 'customize_how_it_work_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[how_it_work_text1'.$i.']',
        ) );
      }

        
      $wp_customize->add_setting( 'themes_customization[how_it_work_box_title2]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[how_it_work_box_title2]', array(
        'label'            => __( 'Head Text 1', 'themes' ),
        'section'          => 'customize_how_it_work_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[how_it_work_box_title2]',
      ) );

      $wp_customize->add_setting('themes_customization[how_it_work_number2]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[how_it_work_number2]',array(
          'label' => __("Number of Don't list to show",'themes'),
          'section'   => 'customize_how_it_work_section',
          'type'      => 'number',
          'priority'   => Null,
      ));

    $work_choose2 =  isset( $this->themes_key['how_it_work_number2'] )? $this->themes_key['how_it_work_number2'] : 3;
      for($i=1; $i<=$work_choose2; $i++) {

        $wp_customize->add_setting( 'themes_customization[how_it_work_title_icon2'.$i.']', array(
          // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[how_it_work_title_icon2'.$i.']', array(
          'label'      => __( 'Blog Image 2','themes').$i,
          'section'    => 'customize_how_it_work_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[how_it_work_title_icon2'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      
        $wp_customize->add_setting( 'themes_customization[how_it_work_title2'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[how_it_work_title2'.$i.']', array(
          'label'            => __( 'Main Title 2', 'themes' ),
          'section'          => 'customize_how_it_work_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[how_it_work_title2'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[how_it_work_text2'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[how_it_work_text2'.$i.']', array(
          'label'            => __( 'Main Text 2', 'themes' ),
          'section'          => 'customize_how_it_work_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[how_it_work_text2'.$i.']',
        ) );
      }        
    }
    
    $wp_customize->add_setting( 'themes_customization[how_it_work_main_heading_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_main_heading_text_color]', array(
      'label' => 'Main Heading Text Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_main_heading_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[how_it_work_main_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[how_it_work_main_heading_font_family]', array(
        'section'  => 'customize_how_it_work_section',
        'label'    => __( 'Main Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[how_it_work_main_heading_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[how_it_work_main_heading_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_how_it_work_section',
        'setting' => 'themes_customization[how_it_work_main_heading_font_size]',
        'type'    => 'text'
      )
    ); 
   
    
    $wp_customize->add_setting( 'themes_customization[how_it_work_small_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_small_text_color]', array(
      'label' => 'Paragraph Text Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_small_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[how_it_work_small_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[how_it_work_small_text_fontfamily]', array(
        'section'  => 'customize_how_it_work_section',
        'label'    => __( 'Paragraph Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[how_it_work_small_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[how_it_work_small_text_font_size]',array(
        'label' => __('Paragraph Font Size in px','themes'),
        'section' => 'customize_how_it_work_section',
        'setting' => 'themes_customization[how_it_work_small_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[how_it_work_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_main_text_color]', array(
      'label' => 'Sub Heading Text Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[how_it_work_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[how_it_work_main_text_fontfamily]', array(
        'section'  => 'customize_how_it_work_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[how_it_work_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[how_it_work_main_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_how_it_work_section',
        'setting' => 'themes_customization[how_it_work_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[how_it_work_dicsount_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_dicsount_text_color]', array(
      'label' => 'Browse Topics Discount Text Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_dicsount_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[how_it_work_dicsount_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[how_it_work_dicsount_text_fontfamily]', array(
        'section'  => 'customize_how_it_work_section',
        'label'    => __( 'Browse Topics Discount Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[how_it_work_dicsount_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[how_it_work_dicsount_text_font_size]',array(
        'label' => __('Browse Topics Discount Text Font Size in px','themes'),
        'section' => 'customize_how_it_work_section',
        'setting' => 'themes_customization[how_it_work_dicsount_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[how_it_work_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_button_bg_color]', array(
      'label' => 'Browse Topics Button Background Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[how_it_work_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[how_it_work_button_text_color]', array(
      'label' => ' Button Text Color',
      'section' => 'customize_how_it_work_section',
      'settings' => 'themes_customization[how_it_work_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[how_it_work_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[how_it_work_button_text_fontfamily]', array(
        'section'  => 'customize_how_it_work_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[how_it_work_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[how_it_work_button_text_font_size]',array(
        'label' => __('Browse Topics Button Text Font Size in px','themes'),
        'section' => 'customize_how_it_work_section',
        'setting' => 'themes_customization[how_it_work_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>