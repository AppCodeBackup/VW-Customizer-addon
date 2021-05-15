<?php 
	//  =============================
    //  = Section for Video Section =
    //  =============================
    $wp_customize->add_section( 'customize_video_section', array(
      'title'        => __( 'Video Section', 'themes' ),
      'description'  => __( 'Customize Video Section', 'themes' ),
      'priority'     => Null,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[video_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[video_enable]', array(
     'settings'    => 'themes_customization[video_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_video_section',
     'priority'   => Null,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[video_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[video_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[video_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[video_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[video_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[video_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[video_left_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_left_title]', array(
      'label'            => __( 'Section Main Title Left', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_left_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[video_right_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_right_title]', array(
      'label'            => __( 'Section Main Title Right', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_right_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[video_sec_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_sec_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_sec_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[video_sec_desc]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_sec_desc]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_sec_desc]',
    ) );
    $wp_customize->add_setting( 'themes_customization[video_sec_left_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_sec_left_btn_text]', array(
      'label'            => __( 'Left Button Title', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_sec_left_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[video_sec_left_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[video_sec_left_btn_url]',array(
        'label' => __('Left Button Link','themes'),
        'section' => 'customize_video_section',
        'setting' => 'themes_customization[video_sec_left_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[video_sec_right_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[video_sec_right_btn_text]', array(
      'label'            => __( 'Right Button Title', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[video_sec_right_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[video_sec_right_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[video_sec_right_btn_url]',array(
        'label' => __('Right Button Link','themes'),
        'section' => 'customize_video_section',
        'setting' => 'themes_customization[video_sec_right_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[video_top_on_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[video_top_on_image]', array(
      'label'      => __( 'Video Dotted Image ','themes'),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[video_top_on_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[video_top_off_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[video_top_off_image]', array(
      'label'      => __( 'Video Circle Image ','themes'),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[video_top_off_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting('themes_customization[video_slider_numbers]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[video_slider_numbers]',array(
        'label' => __('Number of Video to show','themes'),
        'section'   => 'customize_video_section',
        'type'      => 'number'
    ));
    $count =  isset( $this->themes_key['video_slider_numbers'] )? $this->themes_key['video_slider_numbers'] : 4;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting( 'themes_customization[video_slider_url]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[video_slider_url]', array(
        'label'            => __( 'Video Url', 'themes' ).$i,
        'section'          => 'customize_video_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[video_slider_url]',
      ) );
      $wp_customize->add_setting( 'themes_customization[video_image'.$i.']', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[video_image'.$i.']', array(
        'label'      => __( 'Video Image ','themes').$i,
        'section'    => 'customize_video_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[video_image'.$i.']',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting(
        'themes_customization[video_slider_play_icon'.$i.']',
        array(
          'default'     => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control(
        new themes_Fontawesome_Icon_Chooser(
          $wp_customize,
          'themes_customization[video_slider_play_icon'.$i.']',
          array(
            'settings'    => 'themes_customization[video_slider_play_icon'.$i.']',
            'section'   => 'customize_video_section',
            'type'      => 'icon',
            'label'     => esc_html__( 'Video Play Icon', 'themes' ),
          )
        )
      );
      $wp_customize->add_setting( 'themes_customization[video_slider_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[video_slider_title'.$i.']', array(
        'label'            => __( 'Video Title', 'themes' ).$i,
        'section'          => 'customize_video_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[video_slider_title'.$i.']',
      ) );
      $wp_customize->add_setting( 'themes_customization[video_slider_text'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[video_slider_text'.$i.']', array(
        'label'            => __( 'Video Text', 'themes' ).$i,
        'section'          => 'customize_video_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[video_slider_text'.$i.']',
      ) );
    }
?>