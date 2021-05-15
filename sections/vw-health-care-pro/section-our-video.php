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
    $wp_customize->add_setting( 'themes_customization[our_video_bg_color]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_video_bg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_video_bg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[our_video_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_video_bg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[our_video_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[vedio_icon_bg_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[vedio_icon_bg_image]', array(
      'label'      => __( 'Icons Background Image ','themes'),
      'section'    => 'customize_video_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[vedio_icon_bg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[our_video_small_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_video_small_heading]', array(
      'label'            => __( 'Section Small Title', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_video_small_heading]',
    ) );
    $wp_customize->add_setting( 'themes_customization[our_video_main_heading]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[our_video_main_heading]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_video_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[our_video_main_heading]',
    ) );
    $wp_customize->add_setting('themes_customization[our_video_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[our_video_url]',array(
        'label' => __('Video Link','themes'),
        'section' => 'customize_video_section',
        'setting' => 'themes_customization[our_video_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting(
      'themes_customization[our_video_play_icon]',
      array(
        'default'     => '',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control(
      new themes_Fontawesome_Icon_Chooser(
        $wp_customize,
        'themes_customization[our_video_play_icon]',
        array(
          'settings'    => 'themes_customization[our_video_play_icon]',
          'section'   => 'customize_video_section',
          'type'      => 'icon',
          'label'     => esc_html__( 'Video Play Icon', 'themes' ),
        )
      )
    );
?>