<?php
	//  =============================
    //  = Section for Our Records    =
    //  =============================
    $wp_customize->add_section( 'customize_records_section', array(
      'title'        => __( 'Our Records', 'themes' ),
      'description'  => __( 'Customize Records Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[records_section_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[records_section_enable]', array(
     'settings'    => 'themes_customization[records_section_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_records_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[records_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[records_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_records_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[records_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[records_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[records_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_records_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[records_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_records_left_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_records_left_image]', array(
        'label'      => __( 'Section Left Image ','themes'),
        'section'    => 'customize_records_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[our_records_left_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[our_records_right_top_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_records_right_top_image]', array(
        'label'      => __( 'Section Right Top Image ','themes'),
        'section'    => 'customize_records_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[our_records_right_top_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[our_records_right_bottom_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_records_right_bottom_image]', array(
        'label'      => __( 'Section Right Bottom Image ','themes'),
        'section'    => 'customize_records_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[our_records_right_bottom_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    if(defined('VW_HEALTH_CARE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_record_main_heading]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_record_main_heading]', array(
        'label'            => __( 'Record Title', 'themes' ),
        'section'          => 'customize_records_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_record_main_heading]',
      ) );
      $wp_customize->add_setting( 'themes_customization[our_record_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_record_text]', array(
        'label'            => __( 'Record Text', 'themes' ),
        'section'          => 'customize_records_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_record_text]',
      ) );
    }
    $wp_customize->add_setting('themes_customization[records_box_number]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[records_box_number]',array(
        'label' => __('Number of Records to show','themes'),
        'section'   => 'customize_records_section',
        'type'      => 'number'
    ));
    $count =  isset( $this->themes_key['records_box_number'] )? $this->themes_key['records_box_number'] : 4;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting( 'themes_customization[our_records_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_records_title'.$i.']', array(
        'label'            => __( 'Record Title', 'themes' ).$i,
        'section'          => 'customize_records_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_records_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[our_records_no'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_records_no'.$i.']', array(
        'label'            => __( 'Record Number', 'themes' ).$i,
        'section'          => 'customize_records_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_records_no'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[our_records_no_suffix'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[our_records_no_suffix'.$i.']', array(
        'label'            => __( 'Record Number Suffix', 'themes' ).$i,
        'section'          => 'customize_records_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_records_no_suffix'.$i.']',
      ) );
      if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')||defined('VW_HEALTH_CARE_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[our_records_image'.$i.']', array(
          'default'       =>  '' ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_records_image'.$i.']', array(
          'label'      => __( 'Record Image ','themes').$i,
          'section'    => 'customize_records_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[our_records_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[records_title_box_number]',array(
          'default'   => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[records_title_box_number]',array(
          'label' => __('Number of Records Title to show','themes'),
          'section'   => 'customize_records_section',
          'type'      => 'number'
      ));
      $count =  isset( $this->themes_key['records_title_box_number'] )? $this->themes_key['records_title_box_number'] : 3;
      for($i=1; $i<=$count; $i++) {
        $wp_customize->add_setting( 'themes_customization[title_box_sufix'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[title_box_sufix'.$i.']', array(
          'label'            => __( 'Record Title Box Suffix', 'themes' ).$i,
          'section'          => 'customize_records_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[title_box_sufix'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[title_box_heading'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[title_box_heading'.$i.']', array(
          'label'            => __( 'Record Title Box Title', 'themes' ).$i,
          'section'          => 'customize_records_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[title_box_heading'.$i.']',
        ) );
      }
    }
    $wp_customize->add_setting( 'themes_customization[themes_our_record_number_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_number_color]', array(
        'label' => __('Record Number Color', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_number_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_our_record_number_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_our_record_number_font_family]', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Record Number Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_number_font_size]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_number_font_size]', array(
        'label' => __('Record Number Font Size in px', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_number_font_size]',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_title_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_title_color]', array(
        'label' => __('Record Title Color', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_title_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_our_record_title_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_our_record_title_font_family]', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Record Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_title_font_size]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_title_font_size]', array(
        'label' => __('Record Title Font Size in px', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_title_font_size]',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_icon_bgcolor]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_icon_bgcolor]', array(
        'label' => __('Icon Background Color', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_icon_bgcolor]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_icon_hover_bgcolor1]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_icon_hover_bgcolor1]', array(
        'label' => __('Icon Hover Background Gradient Color 1', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_icon_hover_bgcolor1]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_icon_hover_bgcolor2]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_icon_hover_bgcolor2]', array(
        'label' => __('Icon Hover Background Gradient Color 1', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_icon_hover_bgcolor2]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_box_bgcolor1]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_box_bgcolor1]', array(
        'label' => __('Box Background Gradient Color 1', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_customization[themes_our_record_box_bgcolor1]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_our_record_box_bgcolor2]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_our_record_box_bgcolor2]', array(
        'label' => __('Box Background Gradient Color 2', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_box_bgcolor2]',
    )));
    $wp_customize->add_setting( 'themes_our_record_heading_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_heading_color', array(
        'label' => __('Record Heading Color', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_heading_color',
    )));
    $wp_customize->add_setting('themes_our_record_heading_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_our_record_heading_font_family', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Record Heading Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_our_record_heading_font_size', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_heading_font_size', array(
        'label' => __('Record Heading Font Size in px', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_heading_font_size',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_our_record_button_text_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_button_text_color', array(
        'label' => __('Record Button Text Color', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_button_text_color',
    )));
    $wp_customize->add_setting('themes_our_record_button_text_font_family',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_our_record_button_text_font_family', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Record Button Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_our_record_button_text_font_size', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_button_text_font_size', array(
        'label' => __('Record Button Text Font Size in px', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_button_text_font_size',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_our_record_button_bgcolor1', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_button_bgcolor1', array(
        'label' => __('Record Button Background Gradient Color 1', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_button_bgcolor1',
    )));
    $wp_customize->add_setting( 'themes_our_record_button_bgcolor2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_button_bgcolor2', array(
        'label' => __('Record Button Background Gradient Color 2', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_button_bgcolor2',
    )));
    $wp_customize->add_setting( 'themes_our_record_image_border_color1', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_image_border_color1', array(
        'label' => __('Record Image Border Gradient Color 1', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_image_border_color1',
    )));
    $wp_customize->add_setting( 'themes_our_record_image_border_color2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_our_record_image_border_color2', array(
        'label' => __('Record Image Border Gradient Color 2', 'themes'),
        'section' => 'customize_records_section',
        'settings' => 'themes_our_record_image_border_color2',
    )));
    $wp_customize->add_setting( 'themes_customization[our_records_num_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_records_num_text_color]', array(
      'label' => 'Number Color',
      'section' => 'customize_records_section',
      'settings' => 'themes_customization[our_records_num_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[our_records_num_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[our_records_num_text_fontfamily]', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Number Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_records_num_text_fontsize]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[our_records_num_text_fontsize]',array(
        'label' => __('Number Font Size in px','themes'),
        'section' => 'customize_records_section',
        'setting' => 'themes_customization[our_records_num_text_fontsize]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[our_records_text1_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_records_text1_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_records_section',
      'settings' => 'themes_customization[our_records_text1_color]',
    )));  

    $wp_customize->add_setting('themes_customization[our_records_text1_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[our_records_text1_fontfamily]', array(
        'section'  => 'customize_records_section',
        'label'    => __( 'Text Font','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[our_records_text1_fontsize]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[our_records_text1_fontsize]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_records_section',
        'setting' => 'themes_customization[our_records_text1_fontsize]',
        'type'    => 'text'
      )
    ); 
?>