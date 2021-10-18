<?php 
	//  =============================
    //  = Section for Emergency Contact =
    //  =============================
    $wp_customize->add_section( 'customize_emergency_contact_section', array(
      'title'        => __( 'Emergency Contact', 'themes' ),
      'description'  => __( 'Customize Emergency Contact Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_emergency_contact_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_emergency_contact_enable]', array(
     'settings'    => 'themes_customization[radio_emergency_contact_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_emergency_contact_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[emergency_contact_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_emergency_contact_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[emergency_contact_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[emergency_contact_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_emergency_contact_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[emergency_contact_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_left_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[emergency_contact_left_image]', array(
      'label'      => __( 'Left Side Image ','themes'),
      'section'    => 'customize_emergency_contact_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[emergency_contact_left_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_pattern_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[emergency_contact_pattern_image]', array(
      'label'      => __( 'Left Side Small Image ','themes'),
      'section'    => 'customize_emergency_contact_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[emergency_contact_pattern_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_small_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_small_title]', array(
      'label'            => __( 'Contact Small Heading', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_small_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_title]', array(
      'label'            => __( 'Contact Main Heading', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_text]', array(
      'label'            => __( 'Contact Main Text', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_text]',
    ) );
    
    $wp_customize->add_setting( 'themes_customization[emergency_contact_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_shortcode]', array(
      'label'            => __( 'Contact Shortcode', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_shortcode]',
    ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_main_title]', array(
      'label'            => __( 'COVID Test Heading', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_main_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[emergency_contact_main_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[emergency_contact_main_para]', array(
      'label'            => __( 'COVID Test Text', 'themes' ),
      'section'          => 'customize_emergency_contact_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[emergency_contact_main_para]',
    ) );

    if(!defined('VW_HEALTH_CARE_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[emergency_contact_app_number]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[emergency_contact_app_number]',array(
          'label' => __('Number of Test to show','themes'),
          'section'   => 'customize_emergency_contact_section',
          'type'      => 'number'
      ));
    } 

    $count =  isset( $this->themes_key['emergency_contact_app_number'] )? $this->themes_key['emergency_contact_app_number'] : 2;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting(
        'themes_customization[emergency_contact_app_icon'.$i.']',
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
          'themes_customization[emergency_contact_app_icon'.$i.']',
          array(
            'settings'    => 'themes_customization[emergency_contact_app_icon'.$i.']',
            'section'   => 'customize_emergency_contact_section',
            'type'      => 'icon',
            'label'     => esc_html__( 'Box Icon', 'themes' ),
          )
        )
      );
      $wp_customize->add_setting( 'themes_customization[emergency_contact_app_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[emergency_contact_app_title'.$i.']', array(
        'label'            => __( 'Section Text One', 'themes' ).$i,
        'section'          => 'customize_emergency_contact_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[emergency_contact_app_title'.$i.']',
      ) );
      
      if(defined('VW_HEALTH_CARE_PRO_VERSION')){

        if ( $i == 1 ) {

         $wp_customize->add_setting( 'themes_customization[emergency_contact_app_call_number'.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[emergency_contact_app_call_number'.$i.']', array(
            'label'            => __( 'Number', 'themes' ),
            'section'          => 'customize_emergency_contact_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[emergency_contact_app_call_number'.$i.']',
          ) );
        } else if( $i == 2) {
         $wp_customize->add_setting('themes_customization[emergency_contact_app_title_url'.$i.']',array(
            'default' => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control( 'themes_customization[emergency_contact_app_title_url'.$i.']', array(
          'label'            => __( 'Button URL', 'themes' ),
          'section'          => 'customize_emergency_contact_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[emergency_contact_app_title_url'.$i.']',
        ) );
        }
      }
    }
    
    $wp_customize->add_setting( 'themes_customization[emergency_contact_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[emergency_contact_main_text_color]', array(
      'label' => 'Main Text Color',
      'section' => 'customize_emergency_contact_section',
      'settings' => 'themes_customization[emergency_contact_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[emergency_contact_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[emergency_contact_main_text_fontfamily]', array(
        'section'  => 'customize_emergency_contact_section',
        'label'    => __( 'Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[emergency_contact_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[emergency_contact_main_text_font_size]',array(
        'label' => __('Main Text Font Size in px','themes'),
        'section' => 'customize_emergency_contact_section',
        'setting' => 'themes_customization[emergency_contact_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[emergency_contact_sub_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[emergency_contact_sub_text_color]', array(
      'label' => 'Sub Heading Color',
      'section' => 'customize_emergency_contact_section',
      'settings' => 'themes_customization[emergency_contact_sub_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[emergency_contact_sub_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[emergency_contact_sub_text_fontfamily]', array(
        'section'  => 'customize_emergency_contact_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[emergency_contact_sub_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[emergency_contact_sub_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_emergency_contact_section',
        'setting' => 'themes_customization[emergency_contact_sub_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[emergency_contact_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[emergency_contact_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_emergency_contact_section',
      'settings' => 'themes_customization[emergency_contact_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[emergency_contact_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[emergency_contact_text_fontfamily]', array(
        'section'  => 'customize_emergency_contact_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[emergency_contact_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[emergency_contact_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_emergency_contact_section',
        'setting' => 'themes_customization[emergency_contact_text_font_size]',
        'type'    => 'text'
      )
    ); 
?>