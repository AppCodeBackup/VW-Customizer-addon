<?php 
	//  =============================
    //  = Section for Contact & Partners =
    //  =============================
    $wp_customize->add_section( 'customize_contact_partners_section', array(
      'title'        => __( 'Contact & Partners', 'themes' ),
      'description'  => __( 'Customize Contact & Partners Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_contact_partners_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_contact_partners_enable]', array(
     'settings'    => 'themes_customization[radio_contact_partners_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_contact_partners_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization_contact_partners_option',
        array(
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_choices'
        )
    );
    $wp_customize->add_control( new Themes_Seperator_custom_Control( $wp_customize, 'themes_customization_contact_partners_option',
        array(
            'label' => __('Contact & Partner Content Settings','themes'),
            'section' => 'customize_contact_partners_section'
        )
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_customization_contact_partners_option', array(
        'selector' => '#appointment .container',
        'render_callback' => 'themes_customize_partial_themes_customization_contact_partners_option',
    ) );
    $wp_customize->add_setting( 'themes_customization[contact_partners_bg_color]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_contact_partners_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[contact_partners_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[contact_partners_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[contact_partners_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_contact_partners_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[contact_partners_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[home_page_contact_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[home_page_contact_main_heading]', array(
      'label'            => __( 'Contact Main Heading', 'themes' ),
      'section'          => 'customize_contact_partners_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[home_page_contact_main_heading]',
    ) );
    $wp_customize->add_setting( 'themes_customization[home_page_contact_sub_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[home_page_contact_sub_heading]', array(
      'label'            => __( 'Contact Sub Heading', 'themes' ),
      'section'          => 'customize_contact_partners_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[home_page_contact_sub_heading]',
    ) );
    
    $wp_customize->add_setting( 'themes_customization[home_page_contact_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[home_page_contact_shortcode]', array(
      'label'            => __( 'Contact Shortcode', 'themes' ),
      'section'          => 'customize_contact_partners_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[home_page_contact_shortcode]',
    ) );
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[home_page_contact_bg_color]', array(
        'default'        => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[home_page_contact_bg_color]', array(
        'label'      => __( 'Contact Background Color:', 'themes' ),
        'section'    => 'customize_contact_partners_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[home_page_contact_bg_color]'
      ) ) );
      $wp_customize->add_setting( 'themes_customization[home_page_contact_bg_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[home_page_contact_bg_image]', array(
        'label'      => __( 'Contact Background Image ','themes'),
        'section'    => 'customize_contact_partners_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[home_page_contact_bg_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[contact_our_partners_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[contact_our_partners_text]', array(
        'label'            => __( 'Main Heading', 'themes' ),
        'section'          => 'customize_contact_partners_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[contact_our_partners_text]',
      ) );
      $wp_customize->add_setting('themes_customization[contact_our_partners_number]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[contact_our_partners_number]',array(
          'label' => __('Number of Images to show','themes'),
          'section'   => 'customize_contact_partners_section',
          'type'      => 'number'
      ));

      $count =  isset( $this->themes_key['contact_our_partners_number'] )? $this->themes_key['contact_our_partners_number'] : 8;
      for($i=1; $i<=$count; $i++) {
        $wp_customize->add_setting( 'themes_customization[contact_our_partners_image'.$i.']', array(
          'default'       =>  '' ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[contact_our_partners_image'.$i.']', array(
          'label'      => __( 'Partner Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
          'section'    => 'customize_contact_partners_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[contact_our_partners_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
    }
    $wp_customize->add_setting( 'themes_customization[contact_partners_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_main_text_color]', array(
      'label' => 'Main Text Color',
      'section' => 'customize_contact_partners_section',
      'settings' => 'themes_customization[contact_partners_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[contact_partners_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[contact_partners_main_text_fontfamily]', array(
        'section'  => 'customize_contact_partners_section',
        'label'    => __( 'Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[contact_partners_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[contact_partners_main_text_font_size]',array(
        'label' => __('Main Text Font Size in px','themes'),
        'section' => 'customize_contact_partners_section',
        'setting' => 'themes_customization[contact_partners_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[contact_partners_sub_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_sub_text_color]', array(
      'label' => 'Sub Heading Color',
      'section' => 'customize_contact_partners_section',
      'settings' => 'themes_customization[contact_partners_sub_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[contact_partners_sub_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[contact_partners_sub_text_fontfamily]', array(
        'section'  => 'customize_contact_partners_section',
        'label'    => __( 'Sub Heading Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[contact_partners_sub_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[contact_partners_sub_text_font_size]',array(
        'label' => __('Sub Heading Font Size in px','themes'),
        'section' => 'customize_contact_partners_section',
        'setting' => 'themes_customization[contact_partners_sub_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[contact_partners_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_contact_partners_section',
      'settings' => 'themes_customization[contact_partners_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[contact_partners_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[contact_partners_text_fontfamily]', array(
        'section'  => 'customize_contact_partners_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[contact_partners_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[contact_partners_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_contact_partners_section',
        'setting' => 'themes_customization[contact_partners_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[contact_partners_button_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_button_color]', array(
        'label' => 'Contact Button Color',
        'section' => 'customize_contact_partners_section',
        'settings' => 'themes_customization[contact_partners_button_color]',
      )));  

      $wp_customize->add_setting('themes_customization[contact_partners_button_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[contact_partners_button_fontfamily]', array(
          'section'  => 'customize_contact_partners_section',
          'label'    => __( 'Contact Button Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[contact_partners_button_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control('themes_customization[contact_partners_button_font_size]',array(
          'label' => __('Contact Button Font Size in px','themes'),
          'section' => 'customize_contact_partners_section',
          'setting' => 'themes_customization[contact_partners_button_font_size]',
          'type'    => 'text'
        )
      ); 
      $wp_customize->add_setting( 'themes_customization[contact_partners_button_bgcolor]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[contact_partners_button_bgcolor]', array(
          'label' => 'Contact Button Background Color',
          'section' => 'customize_contact_partners_section',
          'settings' => 'themes_customization[contact_partners_button_bgcolor]',
        )));
?>