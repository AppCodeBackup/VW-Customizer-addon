<?php
class Themes_Setting_Entities {

  /**
  * Variable that Check for ThemeSetting Key.
  *
  * @var string
  * @since 1.0.0
  * @version 1.2.0
  */
  public $themes_key;

  /**
  * Class constructor
  */
  public function __construct() {    
      $this->themes_key = get_option( 'themes_customization' );
      $this->_hooks();
  }

  /**
  * Hook into actions and filters
  *
  * @since 1.0.0
  * @version 1.4.0
  */
  private function _hooks() {

    if ( version_compare( $GLOBALS['wp_version'], '5.2', '<' ) ) {
      add_filter( 'login_headertitle',array( $this, 'login_page_logo_title' ) );
    } else {
      add_filter( 'login_headertext',	array( $this, 'login_page_logo_title' ) );
    }
    add_action( 'customize_register', array( $this, 'customize_login_panel' ) );
    add_action( 'wp_head',				 	array( $this, 'login_page_custom_head' ) );
    add_action( 'init',							 	array( $this, 'redirect_to_custom_page' ) );

    /**
     * This function enqueues scripts and styles in the Customizer.
     */
    add_action( 'customize_controls_enqueue_scripts', 	array( $this,  'themes_customizer_js' ) );

    /**
     * This function is triggered on the initialization of the Previewer in the Customizer.
     * We add actions that pertain to the Previewer window here.
     * The actions added here are triggered only in the Previewer and not in the Customizer.
     * @since 1.0.23
     */
    add_action( 'customize_preview_init',               array( $this, 'themes_customizer_previewer_js' ) );
    add_filter( 'woocommerce_process_login_errors',     array( $this, 'themes_woo_login_errors' ), 10, 3 );

  }


  /**
  * Enqueue jQuery and use wp_localize_script.
  *
  * @since 1.0.9
  * @version 1.2.1
  */
  function themes_customizer_js() {

    wp_enqueue_script('jquery');
    wp_enqueue_script( 'themes-customize-control', plugins_url(  'js/customize-controls.js' , CUSTOM_ROOT_FILE  ), array( 'jquery' ), CUSTOM_VERSION, true );
    wp_enqueue_script( 'social-icon', plugins_url(  'js/customize-controls.js' , CUSTOM_ROOT_FILE  ), array( 'jquery' ), CUSTOM_VERSION, true );

    /*
  	 * Our Customizer script
  	 *
  	 * Dependencies: Customizer Controls script (core)
  	 */
  	wp_enqueue_script( 'themes-control-script', plugins_url(  'js/customizer.js' , CUSTOM_ROOT_FILE  ), array( 'customize-controls' ), CUSTOM_VERSION, true );

    // Get Background URL for use in Customizer JS.
    $user              = wp_get_current_user();
    $name              = empty( $user->user_firstname ) ? ucfirst( $user->display_name ) : ucfirst( $user->user_firstname );
    $themes_bg     = get_option( 'themes_customization');
    $themes_st     = get_option( 'themes_setting');
    $cap_type          = isset( $themes_st['recaptcha_type'] ) ? $themes_st['recaptcha_type'] : 'v2-robot'; // 1.2.1
    //$themes_bg_url = $themes_bg['setting_background'] ? $themes_bg['setting_background'] : false;

    if( isset( $_GET['autofocus'] ) && $_GET['autofocus'] == 'themes_panel' ) { // 1.2.0
      $themes_auto_focus = true;
    } else {
      $themes_auto_focus = false;
    }

    // Array for localize.
    $themes_localize = array(
      'admin_url'         => admin_url(),
      'ajaxurl'           => admin_url( 'admin-ajax.php' ),
      'plugin_url'        => plugins_url(),
      'login_theme'       => get_option( 'customize_presets_settings', true ),
      //'themes_bg_url' => $themes_bg_url,
      'preset_nonce'      => wp_create_nonce( 'themes-preset-nonce' ),
      'attachment_nonce'  => wp_create_nonce( 'themes-attachment-nonce' ),
      'preset_loader'     => includes_url( 'js/tinymce/skins/lightgray/img/loader.gif' ),
      'autoFocusPanel'    => $themes_auto_focus,
      'recaptchaType'     => $cap_type,
      'filter_bg'         => apply_filters( 'themes_default_bg', '' ),
    );

    wp_localize_script( 'themes-customize-control', 'themes_script', $themes_localize );

  }

  /**
   * This function is called only on the Previwer and enqueues scripts and styles.
   * Our Customizer script
   *
   * Dependencies: Customizer Preview script (core)
   * @since 1.0.23
   */
  function themes_customizer_previewer_js() {

    wp_enqueue_style( 'themes-customizer-previewer-style', plugins_url(  'css/style-previewer.css' , CUSTOM_ROOT_FILE  ), array(), CUSTOM_VERSION );

  	wp_enqueue_script( 'themes-customizer-previewer-script', plugins_url(  'js/customizer-previewer.js' , CUSTOM_ROOT_FILE  ), array( 'customize-preview' ), CUSTOM_VERSION, true );

  }
  /**
   * Create a method of setting and control for Themes_Setting_Range_Control.
   * @param  object $wp_customize
   * @param  string $control
   * @param  string $default
   * @param  string $label
   * @param  array $input_attr
   * @param  array $unit
   * @param  int $index
   * @return object
   * @since  1.1.3
   */

  function themes_rangle_seting( $wp_customize, $control, $default, $label, $input_attr, $unit, $section, $index, $priority = '' ){

    $wp_customize->add_setting( "themes_customization[{$control[$index]}]", array(
      'default'               => $default[$index],
      'type' 			            => 'option',
      'capability'		        => 'manage_options',
      'transport'             => 'postMessage',
      'sanitize_callback'     => 'absint',
    ) );

    $wp_customize->add_control( new Themes_Setting_Range_Control( $wp_customize, "themes_customization[{$control[$index]}]", array(
      'type'           => 'themes-range',
      'label'          => $label[$index],
      'section'        => $section,
      'priority'		   => $priority,
      'settings'       => "themes_customization[{$control[$index]}]",
      'default'        => $default[$index],
      'input_attrs'    => $input_attr[$index],
      'unit'           => $unit[$index],
    ) ) );
  }

  /**
   * Create a method of setting and control for Themes_Setting_Group_Control.
   * @param  object $wp_customize
   * @param  string $control
   * @param  string $label
   * @param  string $section
   * @param  string $info_test
   * @param  int $index
   * @return object
   * @since 1.1.3
   */
  function themes_group_setting( $wp_customize, $control, $label, $info_test, $section, $index, $priority = '' ){

    $wp_customize->add_setting( "themes_customization[{$control[$index]}]", array(
      'type'					=> 'option',
      'capability'		=> 'manage_options',
      'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( new Themes_Setting_Group_Control( $wp_customize, "themes_customization[{$control[$index]}]", array(
      'settings'	  => "themes_customization[{$control[$index]}]",
      'label'		    => $label[$index],
      'section'	    => $section,
      'type'        => 'group',
      'info_text'   => $info_test[$index],
      'priority'		=> $priority,
    ) ) );
  }

  /**
   * Create a method of setting and control for WP_Customize_Color_Control.
   * @param  object $wp_customize
   * @param  string $control
   * @param  string $label
   * @param  string $section
   * @param  int $index
   * @return object
   * @since 1.1.3
   */
  function themes_color_setting( $wp_customize, $control, $label, $section, $index, $priority = '' ){

    $wp_customize->add_setting( "themes_customization[{$control[$index]}]", array(
      // 'default'				=> $form_color_default[$form_color],
      'type'					    => 'option',
      'capability'		    => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "themes_customization[{$control[$index]}]", array(
      'label'		    => $label[$index],
      'section'	    => $section,
      'settings'	  => "themes_customization[{$control[$index]}]",
      'priority'		=> $priority,
    ) ) );
  }

  function themes_hr_setting( $wp_customize, $control, $section, $index, $priority = '' ){

    $wp_customize->add_setting( "themes_customization[{$control[$index]}]", array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Themes_Setting_Misc_Control( $wp_customize, "themes_customization[{$control[$index]}]", array(
      'section'     => $section,
      'type'        => 'hr',
      'priority'	  => $priority,
    ) ) );
  }

  /**
  * Register plugin settings Panel in WP Customizer
  *
  * @param	$wp_customize
  * @since	1.0.0
  */
  public function customize_login_panel( $wp_customize ) {
    include CUSTOM_ROOT_PATH . 'classes/controls/customize-repeater/customize-repeater.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/slider-line-control/slider-line-control.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/social-icons/social-icon-picker.php';

    include CUSTOM_ROOT_PATH . 'classes/control-presets.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/background-gallery.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/range.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/group.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/radio-button.php';

    include CUSTOM_ROOT_PATH . 'classes/controls/miscellaneous.php';

    include CUSTOM_ROOT_PATH . 'include/customizer-strings.php';

    include CUSTOM_ROOT_PATH . 'include/customizer-validation.php';
    if(defined('VW_CUSTOMIZER_ADDON_THEME')){
    //	=============================
    //	= Panel for the ThemeSetting	=
    //	=============================
    $wp_customize->add_panel( 'themes_panel', array(
      'title'						=> __( 'Theme Extra Settings', 'themes' ),
      'description'			=> __( 'Customize Your WordPress Login Page with ThemeSetting :)', 'themes' ),
      'priority'				=> 30,
    ) );

  }
    $font_array = array(
        '' => __( 'No Fonts', 'themes' ),
        'Abril Fatface' =>  __( 'Abril Fatface', 'themes' ),
        'Acme' => __( 'Acme', 'themes' ),
        'Anton' => __( 'Anton', 'themes' ),
        'Architects Daughter' => __( 'Architects Daughter', 'themes' ),
        'Arimo' => __( 'Arimo', 'themes' ),
        'Arsenal' => __( 'Arsenal', 'themes' ),
        'Arvo' => __( 'Arvo', 'themes' ),
        'Alegreya' => __( 'Alegreya', 'themes' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'themes' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'themes' ),
        'Bangers' => __( 'Bangers', 'themes' ),
        'Boogaloo' => __( 'Boogaloo', 'themes' ),
        'Bad Script' => __( 'Bad Script', 'themes' ),
        'Bitter' => __( 'Bitter', 'themes' ),
        'Bree Serif' => __( 'Bree Serif', 'themes' ),
        'BenchNine' => __( 'BenchNine', 'themes' ),
        'Cabin' => __( 'Cabin', 'themes' ),
        'Cardo' => __( 'Cardo', 'themes' ),
        'Courgette' => __( 'Courgette', 'themes' ),
        'Cherry Swash' => __( 'Cherry Swash', 'themes' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'themes' ),
        'Crimson Text' => __( 'Crimson Text', 'themes' ),
        'Cuprum' => __( 'Cuprum', 'themes' ),
        'Cookie' => __( 'Cookie', 'themes' ),
        'Chewy' => __( 'Chewy', 'themes' ),
        'Days One' => __( 'Days One', 'themes' ),
        'Dosis' => __( 'Dosis', 'themes' ),
        'Economica' => __( 'Economica', 'themes' ),
        'Fredoka One' => __( 'Fredoka One', 'themes' ),
        'Fjalla One' => __( 'Fjalla One', 'themes' ),
        'Francois One' => __( 'Francois One', 'themes' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'themes' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'themes' ),
        'Great Vibes' => __( 'Great Vibes', 'themes' ),
        'Handlee' => __( 'Handlee', 'themes' ),
        'Hammersmith One' => __( 'Hammersmith One', 'themes' ),
        'Inconsolata' => __( 'Inconsolata', 'themes' ),
        'Indie Flower' => __( 'Indie Flower', 'themes' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'themes' ),
        'Julius Sans One' => __( 'Julius Sans One', 'themes' ),
        'Josefin Slab' => __( 'Josefin Slab', 'themes' ),
        'Josefin Sans' => __( 'Josefin Sans', 'themes' ),
        'Kanit' => __( 'Kanit', 'themes' ),
        'Lobster' => __( 'Lobster', 'themes' ),
        'Lato' => __( 'Lato', 'themes' ),
        'Lora' => __( 'Lora', 'themes' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'themes' ),
        'Lobster Two' => __( 'Lobster Two', 'themes' ),
        'Merriweather' => __( 'Merriweather', 'themes' ),
        'Monda' => __( 'Monda', 'themes' ),
        'Montserrat' => __( 'Montserrat', 'themes' ),
        'Muli' => __( 'Muli', 'themes' ),
        'Marck Script' => __( 'Marck Script', 'themes' ),
        'Noto Serif' => __( 'Noto Serif', 'themes' ),
        'Open Sans' => __( 'Open Sans', 'themes' ),
        'Overpass' => __( 'Overpass', 'themes' ),
        'Overpass Mono' => __( 'Overpass Mono', 'themes' ),
        'Oxygen' => __( 'Oxygen', 'themes' ),
        'Orbitron' => __( 'Orbitron', 'themes' ),
        'Patua One' => __( 'Patua One', 'themes' ),
        'Pacifico' => __( 'Pacifico', 'themes' ),
        'Padauk' => __( 'Padauk', 'themes' ),
        'Playball' => __( 'Playball', 'themes' ),
        'Playfair Display' => __( 'Playfair Display', 'themes' ),
        'PT Sans' => __( 'PT Sans', 'themes' ),
        'Philosopher' => __( 'Philosopher', 'themes' ),
        'Permanent Marker' => __( 'Permanent Marker', 'themes' ),
        'Poiret One' => __( 'Poiret One', 'themes' ),
        'Quicksand' => __( 'Quicksand', 'themes' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'themes' ),
        'Raleway' => __( 'Raleway', 'themes' ),
        'Rubik' => __( 'Rubik', 'themes' ),
        'Rokkitt' => __( 'Rokkitt', 'themes' ),
        'Russo One' => __( 'Russo One', 'themes' ),
        'Righteous' => __( 'Righteous', 'themes' ),
        'Slabo' => __( 'Slabo', 'themes' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'themes' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'themes'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'themes' ),
        'Sacramento' => __( 'Sacramento', 'themes' ),
        'Shrikhand' => __( 'Shrikhand', 'themes' ),
        'Tangerine' => __( 'Tangerine', 'themes' ),
        'Ubuntu' => __( 'Ubuntu', 'themes' ),
        'VT323' => __( 'VT323', 'themes' ),
        'Varela Round' => __( 'Varela Round', 'themes' ),
        'Vampiro One' => __( 'Vampiro One', 'themes' ),
        'Vollkorn' => __( 'Vollkorn', 'themes' ),
        'Volkhov' => __( 'Volkhov', 'themes' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'themes' )
    );

    /**
    * =============================
    *	= Section for Presets		=
    * =============================
    *
    * @since	1.0.9
    * @version 1.1.16
    */
    $wp_customize->add_section( 'section_ordering_settings', array(
      'title'          => __( 'Section Reordering', 'themes' ),
      'description'    => __( 'Section Reordering Settings', 'themes' ),
      'priority'       => 1,
      'panel'          => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[section_ordering_settings_repeater]',
        array(
          'default' => '',
          'type'              => 'option',
          'capability'         => 'manage_options',
          'transport' => 'refresh',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new themes_Repeater_Custom_Control( $wp_customize, 'themes_customization[section_ordering_settings_repeater]',
        array(
          'label' => __( 'Section Reordering','vw-furniture-carpenter-pro' ),
          'section' => 'section_ordering_settings',
          'button_labels' => array(
            'add' => __( 'Add Row','themes' ), 
          )
        )
    ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_section( 'customize_presets', array(
        'title'				   => __( 'Top Bar', 'themes' ),
        'description'	   => __( 'Topbar Settings', 'themes' ),
        'priority'			 => 1,
        'panel'				   => 'themes_panel',
      ) );

      $wp_customize->add_setting( 'themes_customization[setting_topbar_display]', array(
        'default'           => false,
        'type'              => 'option',
        'capability'		     => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_checkbox'
      ) );

      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[setting_topbar_display]', array(
       'settings'    => 'themes_customization[setting_topbar_display]',
    		'label'	      => __( 'Disable Topbar:', 'themes'),
    		'section'     => 'customize_presets',
       'priority'	  => 2,
    		'type'        => 'ios', // light, ios, flat
      ) ) );
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[setting_topbar_background_color]', array(
          // 'default'        => '#ddd5c3',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[setting_topbar_background_color]', array(
          'label'      => __( 'Topbar Background Color:', 'themes' ),
          'section'    => 'customize_presets',
          'priority'   => 5,
          'settings'   => 'themes_customization[setting_topbar_background_color]'
        ) ) );
      }
      if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[topbar_bgcolor]', array(
          // 'default'        => '#ddd5c3',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[topbar_bgcolor]', array(
          'label'      => __( 'Topbar Background Color:', 'themes' ),
          'section'    => 'customize_presets',
          'priority'   => 5,
          'settings'   => 'themes_customization[topbar_bgcolor]'
        ) ) );
        $wp_customize->add_setting( 'themes_customization[topbar_bg_image]', array(
          // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[topbar_bg_image]', array(
          'label'      => __( 'Topbar Background Image:', 'themes' ),
          'section'    => 'customize_presets',
          'priority'   => 6,
          'settings'   => 'themes_customization[topbar_bg_image]',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
      $wp_customize->add_setting( 'themes_customization[topbar_text_heading]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[topbar_text_heading]', array(
        'label'            => __( 'Topbar Heading', 'themes' ),
        'section'          => 'customize_presets',
        'priority'         => 10,
        'settings'         => 'themes_customization[topbar_text_heading]',
      ) );

      $wp_customize->add_setting( 'themes_customization[setting_topbar_text_color]', array(
        // 'default'        => '#ddd5c3',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[setting_topbar_text_color]', array(
        'label'      => __( 'Topbar Text Color:', 'themes' ),
        'section'    => 'customize_presets',
        'priority'   => 5,
        'settings'   => 'themes_customization[setting_topbar_text_color]'
      ) ) );
      $wp_customize->add_setting( 'themes_customization[setting_topbar_text_font_family]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'

      ) );
      $wp_customize->add_control( 'themes_customization[setting_topbar_text_font_family]', array(
        'settings'        => 'themes_customization[setting_topbar_text_font_family]',
        'label'           => __( 'Text Font Family:', 'themes' ),
        'section'         => 'customize_presets',
        'type'            => 'select',
        'choices'         => $font_array,
      ) );
      $wp_customize->add_setting('themes_customization[setting_topbar_text_size]',array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
        ));
      $wp_customize->add_control('themes_customization[setting_topbar_text_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_presets',
        'setting' => 'themes_customization[setting_topbar_text_size]',
      )); 
    }
    //	=============================
    //	= Section for Login Logo		=
    //	=============================
    $wp_customize->add_section( 'customize_header_section', array(
      'title'        => __( 'Header', 'themes' ),
      'description'  => __( 'Customize Header Section', 'themes' ),
      'priority'     => 2,
      'panel'        => 'themes_panel',
    ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[content_header_address_img]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[content_header_address_img]', array(
        'label'      => __( 'Header Address Image:', 'themes' ),
        'section'    => 'customize_header_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[content_header_address_img]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );

      $wp_customize->add_setting( 'themes_customization[content_header_address_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_address_title]', array(
        'label'            => __( 'Header Address Title', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_address_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[content_header_address_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_address_text]', array(
        'label'            => __( 'Header Address Text', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_address_text]',
      ) );

      $wp_customize->add_setting( 'themes_customization[content_header_contact_img]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[content_header_contact_img]', array(
        'label'      => __( 'Header Contact Image:', 'themes' ),
        'section'    => 'customize_header_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[content_header_contact_img]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[content_header_contact_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_contact_title]', array(
        'label'            => __( 'Header Contact Title', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_contact_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[content_header_contact_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_contact_text]', array(
        'label'            => __( 'Header Contact Text', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_contact_text]',
      ) );

      $wp_customize->add_setting( 'themes_customization[content_header_email_img]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[content_header_email_img]', array(
        'label'      => __( 'Header Email Image:', 'themes' ),
        'section'    => 'customize_header_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[content_header_email_img]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );

      $wp_customize->add_setting( 'themes_customization[content_header_email_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_email_title]', array(
        'label'            => __( 'Header Email Title', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_email_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[content_header_email_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[content_header_email_text]', array(
        'label'            => __( 'Header Email Text', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[content_header_email_text]',
      ) );      
    }
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[topbar_social_icons_shortcode]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[topbar_social_icons_shortcode]', array(
        'label'            => __( 'Socail Icons', 'themes' ),
        'section'          => 'customize_header_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[topbar_social_icons_shortcode]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[header_button_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[header_button_text]', array(
      'label'            => __( 'Header Button Text', 'themes' ),
      'section'          => 'customize_header_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[header_button_text]',
    ) );
    $wp_customize->add_setting( 'themes_customization[header_button_url]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[header_button_url]', array(
      'label'            => __( 'Header Button Url', 'themes' ),
      'section'          => 'customize_header_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[header_button_url]',
    ) );
    $wp_customize->selective_refresh->add_partial( 'themes_header_section_youtube_link', array(
      'selector' => '.menubar .container',
      'render_callback' => 'themes_customize_partial_themes_header_section_youtube_link',
    ));
    $wp_customize->add_setting( 'themes_header_section_sticky',
    array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'themes_switch_sanitization'
    ));
 
    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_header_section_sticky',
     array(
        'label' => esc_html__( 'Sticky Header On/Off', 'themes' ),
        'section' => 'customize_header_section'
    )));
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_header_cart_enable',
      array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'themes_switch_sanitization'
      ));
      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_header_cart_enable',
       array(
          'label' => esc_html__( 'Show or Hide Cart', 'themes' ),
          'section' => 'customize_header_section'
      )));
    }
    $wp_customize->add_setting( 'themes_customization[themes_header_section_skip_link]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[themes_header_section_skip_link]', array(
      'label'            => __( 'Skip Links Title', 'themes' ),
      'section'          => 'customize_header_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[themes_header_section_skip_link]',
    ) );

    $wp_customize->add_setting( 'themes_customization[themes_header_section_logo_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_section_logo_title_color]', array(
          'label' => __('Logo Title Color', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_header_section_logo_title_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_section_logo_title_font_family]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'

    ) );
    $wp_customize->add_control( 'themes_customization[themes_header_section_logo_title_font_family]', array(
      'settings'        => 'themes_customization[themes_header_section_logo_title_font_family]',
      'label'           => __( 'Logo Title Font Family:', 'themes' ),
      'section'         => 'customize_header_section',
      'type'            => 'select',
      'choices'         => $font_array,
    ) );
    $wp_customize->add_setting('themes_customization[themes_header_section_logo_title_font_size]',array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
      ));
    $wp_customize->add_control('themes_customization[themes_header_section_logo_title_font_size]',array(
      'label' => __('Logo Title Font Size in px','themes'),
      'section' => 'customize_header_section',
      'setting' => 'themes_customization[themes_header_section_logo_title_font_size]',
      )); 
    $wp_customize->add_setting( 'themes_customization[themes_header_section_logo_sub_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_section_logo_sub_title_color]', array(
          'label' => __('Logo Sub Title Color', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_header_section_logo_sub_title_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_section_logo_sub_title_font_family]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'

    ) );
    $wp_customize->add_control( 'themes_customization[themes_header_section_logo_sub_title_font_family]', array(
      'settings'        => 'themes_customization[themes_header_section_logo_sub_title_font_family]',
      'label'           => __( 'Logo Sub Title Font Family:', 'themes' ),
      'section'         => 'customize_header_section',
      'type'            => 'select',
      'choices'         => $font_array,
    ) );
    $wp_customize->add_setting('themes_customization[themes_header_section_logo_sub_title_font_size]',array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
      ));
    $wp_customize->add_control('themes_customization[themes_header_section_logo_sub_title_font_size]',array(
      'label' => __('Logo Sub Title Font Size in px','themes'),
      'section' => 'customize_header_section',
      'setting' => 'themes_customization[themes_header_section_logo_sub_title_font_size]',
    ));
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[header_contact_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[header_contact_title_color]', array(
            'label' => __('Contact Title Color', 'themes'),
            'section' => 'customize_header_section',
            'settings' => 'themes_customization[header_contact_title_color]',
      )));
      $wp_customize->add_setting( 'themes_customization[header_contact_title_font_family]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'

      ) );
      $wp_customize->add_control( 'themes_customization[header_contact_title_font_family]', array(
        'settings'        => 'themes_customization[header_contact_title_font_family]',
        'label'           => __( 'Contact Title Font Family:', 'themes' ),
        'section'         => 'customize_header_section',
        'type'            => 'select',
        'choices'         => $font_array,
      ) );
      $wp_customize->add_setting('themes_customization[header_contact_title_font_size]',array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
        ));
      $wp_customize->add_control('themes_customization[header_contact_title_font_size]',array(
        'label' => __('Contact Title Font Size in px','themes'),
        'section' => 'customize_header_section',
        'setting' => 'themes_customization[header_contact_title_font_size]',
        ));

      $wp_customize->add_setting( 'themes_customization[header_contact_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[header_contact_text_color]', array(
            'label' => __('Contact Text Color', 'themes'),
            'section' => 'customize_header_section',
            'settings' => 'themes_customization[header_contact_text_color]',
      )));
      $wp_customize->add_setting( 'themes_customization[header_contact_text_font_family]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'

      ) );
      $wp_customize->add_control( 'themes_customization[header_contact_text_font_family]', array(
        'settings'        => 'themes_customization[header_contact_text_font_family]',
        'label'           => __( 'Contact Text Font Family:', 'themes' ),
        'section'         => 'customize_header_section',
        'type'            => 'select',
        'choices'         => $font_array,
      ) );
      $wp_customize->add_setting('themes_customization[header_contact_text_font_size]',array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
        ));
      $wp_customize->add_control('themes_customization[header_contact_text_font_size]',array(
        'label' => __('Contact Text Font Size in px','themes'),
        'section' => 'customize_header_section',
        'setting' => 'themes_customization[header_contact_text_font_size]',
        ));
    }
    $wp_customize->add_setting( 'themes_customization[themes_headermenu_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_headermenu_color]', array(
          'label' => __('Menu Item Color', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_headermenu_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_headermenu_font_family]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'

    ) );
    $wp_customize->add_control( 'themes_customization[themes_headermenu_font_family]', array(
      'settings'        => 'themes_customization[themes_headermenu_font_family]',
      'label'           => __( 'Menu Item Font Family:', 'themes' ),
      'section'         => 'customize_header_section',
      'type'            => 'select',
      'choices'         => $font_array,
    ) );
    $wp_customize->add_setting('themes_customization[themes_headermenu_font_size]',array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
      ));
    $wp_customize->add_control('themes_customization[themes_headermenu_font_size]',array(
      'label' => __('Menu Item Font Size in px','themes'),
      'section' => 'customize_header_section',
      'setting' => 'themes_customization[themes_headermenu_font_size]',
      ));
    $wp_customize->add_setting( 'themes_customization[themes_header_menuhover_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_menuhover_color]', array(
          'label' => __('Menu Item Hover Color', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_header_menuhover_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_menuhover_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_menuhover_bgcolor]', array(
          'label' => __('Menu Item Hover Background Color One', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_header_menuhover_bgcolor]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_menuhover_bgcolor_t]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_menuhover_bgcolor_t]', array(
          'label' => __('Menu Item Hover Background Color Two', 'themes'),
          'section' => 'customize_header_section',
          'settings' => 'themes_customization[themes_header_menuhover_bgcolor_t]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_dropdownbg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_dropdownbg_color]', array(
      'label' => __('Menu DropDown Background Color', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_dropdownbg_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_dropdownbg_itemcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_dropdownbg_itemcolor]', array(
      'label' => __('Menu DropDown Item Color', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_dropdownbg_itemcolor]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_menu_active_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_menu_active_color]', array(
      'label' => __('Active Menu Item Color', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_header_menu_active_color]',
    )));
    //In Responsive
    $wp_customize->add_setting( 'themes_customization[themes_dropdownbg_responsivecolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_dropdownbg_responsivecolor]', array(
      'label' => __('Responsive Menu Background Color', 'themes'),
      'description' => __('This Background Color Will Apply Only To Toggle Menu', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_dropdownbg_responsivecolor]',
    )));
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_header_cart_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_cart_color]', array(
            'label' => __('Cart Text Color', 'themes'),
            'section' => 'customize_header_section',
            'settings' => 'themes_customization[themes_header_cart_color]',
      )));
      $wp_customize->add_setting( 'themes_customization[themes_header_cart_font_family]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'

      ) );
      $wp_customize->add_control( 'themes_customization[themes_header_cart_font_family]', array(
        'settings'        => 'themes_customization[themes_header_cart_font_family]',
        'label'           => __( 'Cart Text Font Family:', 'themes' ),
        'section'         => 'customize_header_section',
        'type'            => 'select',
        'choices'         => $font_array,
      ) );
      $wp_customize->add_setting('themes_customization[themes_header_cart_font_size]',array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
        ));
      $wp_customize->add_control('themes_customization[themes_header_cart_font_size]',array(
        'label' => __('Cart Text Font Size in px','themes'),
        'section' => 'customize_header_section',
        'setting' => 'themes_customization[themes_header_cart_font_size]',
        ));
      $wp_customize->add_setting( 'themes_customization[themes_header_cart_bgcolor]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_cart_bgcolor]', array(
        'label' => __('Cart Box Background Color', 'themes'),
        'section' => 'customize_header_section',
        'settings' => 'themes_customization[themes_header_cart_bgcolor]',
      )));
    }
    $wp_customize->add_setting('themes_customization[themes_header_padding_leftRight]',array(
      'default'   => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[themes_header_padding_leftRight]',array(
      'label' => __('Menu Left & Right Padding','themes'),
      'description' => __('Add Padding Top Either in Percentage or Pixels ( Example 10px or 10%)','themes'),
      'section' => 'customize_header_section',
      'setting'   => 'themes_customization[themes_header_padding_leftRight]',
      'type'  => 'text'
    ));
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_header_section_search_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_section_search_color]', array(
            'label' => __('Seacrch Color', 'themes'),
            'section' => 'customize_header_section',
            'settings' => 'themes_customization[themes_header_section_search_color]',
      )));
      $wp_customize->add_setting( 'themes_customization[themes_header_section_search_font_family]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'

      ) );
      $wp_customize->add_control( 'themes_customization[themes_header_section_search_font_family]', array(
        'settings'        => 'themes_customization[themes_header_section_search_font_family]',
        'label'           => __( 'Seacrch Font Family:', 'themes' ),
        'section'         => 'customize_header_section',
        'type'            => 'select',
        'choices'         => $font_array,
      ) );
      $wp_customize->add_setting('themes_customization[themes_header_section_search_font_size]',array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
        ));
      $wp_customize->add_control('themes_customization[themes_header_section_search_font_size]',array(
        'label' => __('Search Font Size in px','themes'),
        'section' => 'customize_header_section',
        'setting' => 'themes_customization[themes_header_section_search_font_size]',
        ));
      }
      $wp_customize->add_setting('themes_customization[themes_header_button_text_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
          'themes_customization[themes_header_button_text_font_family]', array(
          'section'  => 'customize_header_section',
          'label'    => __( 'Header Button Font Family','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_header_button_text_font_size]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
      ));
    $wp_customize->add_control('themes_customization[themes_header_button_text_font_size]',array(
      'label' => __('Header Button Font Size in px','themes'),
      'section' => 'customize_header_section',
      'setting' => 'themes_customization[themes_header_button_text_font_size]',
      'type'    => 'text'
      )); 
    $wp_customize->add_setting( 'themes_customization[themes_header_button_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_button_text_color]', array(
      'label' => __('Header Button Color', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_header_button_text_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_header_button_bg_color', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_header_button_bg_color]', array(
      'label' => __('Header Button Background Color', 'themes'),
      'section' => 'customize_header_section',
      'settings' => 'themes_customization[themes_header_button_bg_color]',
    )));
    //  =============================
    //  = Section for Slider    =
    //  =============================
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_section( 'customize_slider_section', array(
        'title'        => __( 'Slider', 'themes' ),
        'description'  => __( 'Customize Slider Section', 'themes' ),
        'priority'     => 3,
        'panel'        => 'themes_panel',
      ) );
      $wp_customize->add_setting( 'themes_customization[slider_enabledisable]', array(
        'default'           => false,
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_checkbox'
      ) );
      
      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[slider_enabledisable]', array(
       'settings'    => 'themes_customization[slider_enabledisable]',
        'label'       => __( 'Disable Slider:', 'themes'),
        'section'     => 'customize_slider_section',
       'priority'   => 2,
        'type'        => 'ios', // light, ios, flat
      ) ) );
      $wp_customize->add_setting( 'themes_customization[slider_bg_image]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[slider_bg_image]', array(
        'label'      => __( 'Slider Background Image ','themes'),
        'section'    => 'customize_slider_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[slider_bg_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting('themes_customization[slide_number]',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[slide_number]',array(
          'label' => __('Slider Number','themes'),
          'section'   => 'customize_slider_section',
          'type'      => 'number'
      ));

      $count =  isset( $this->themes_key['slide_number'] )? $this->themes_key['slide_number'] : 3;
      for($i=1; $i<=$count; $i++) {
        $wp_customize->add_setting( 'themes_customization[slide_image'.$i.']', array(
          // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[slide_image'.$i.']', array(
          'label'      => __( 'Slider Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
          'section'    => 'customize_slider_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[slide_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
        if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
          $wp_customize->add_setting( 'themes_customization[slide_right_image'.$i.']', array(
            // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_image'
          ) );

          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[slide_right_image'.$i.']', array(
            'label'      => __( 'Slider Right Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
            'section'    => 'customize_slider_section',
            'priority'   => Null,
            'settings'   => 'themes_customization[slide_right_image'.$i.']',
            'button_labels' => array(
               'select'       => __( 'Select Image', 'themes' ),
          ) ) ) );
        }
        $wp_customize->add_setting( 'themes_customization[slide_heading'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[slide_heading'.$i.']', array(
          'label'            => __( 'Slide Main Heading', 'themes' ),
          'section'          => 'customize_slider_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[slide_heading'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[slide_heading_first'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[slide_heading_first'.$i.']', array(
          'label'            => __( 'Slide Main Heading Two', 'themes' ),
          'section'          => 'customize_slider_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[slide_heading_first'.$i.']',
        ) );
        if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
          $wp_customize->add_setting( 'themes_customization[slide_iconsimage'.$i.']', array(
            // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_image'
          ) );

          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[slide_iconsimage'.$i.']', array(
            'label'      => __( 'Title Icons Image ','themes').$i.__(' (60px * 56px)', 'themes' ),
            'section'    => 'customize_slider_section',
            'priority'   => Null,
            'settings'   => 'themes_customization[slide_iconsimage'.$i.']',
            'button_labels' => array(
               'select'       => __( 'Select Image', 'themes' ),
          ) ) ) );
        }
        $wp_customize->add_setting( 'themes_customization[slide_text'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[slide_text'.$i.']', array(
          'label'            => __( 'Slide Text', 'themes' ),
          'section'          => 'customize_slider_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[slide_text'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[slide_btntext'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[slide_btntext'.$i.']', array(
          'label'            => __( 'Slide Button Title', 'themes' ),
          'section'          => 'customize_slider_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[slide_btntext'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[slide_btnurl'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[slide_btnurl'.$i.']', array(
          'label'            => __( 'Slide Button Url', 'themes' ),
          'section'          => 'customize_slider_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[slide_btnurl'.$i.']',
        ) );
        if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
          $wp_customize->add_setting('themes_customization[slide_tab_number'.$i.']',array(
              'default'   => '',
              'sanitize_callback' => 'sanitize_textarea_field',
          ));
          $wp_customize->add_control('themes_customization[slide_tab_number'.$i.']',array(
              'label' => __('Number of Tabs to show','themes'),
              'section'   => 'customize_slider_section',
              'type'      => 'number'
          ));
          $count1 =  isset( $this->themes_key['slide_tab_number'.$i] )? $this->themes_key['slide_tab_number'.$i] : 3;
          for($j=1; $j<=$count1; $j++) {
            $wp_customize->add_setting( 'themes_customization[slide_tab_title'.$i.$j.']', array(
              'default'           => '',
              'type'              => 'option',
              'capability'        => 'manage_options',
              'transport'         => 'postMessage',
              'sanitize_callback' => 'wp_kses_post'
            ) );

            $wp_customize->add_control( 'themes_customization[slide_tab_title'.$i.$j.']', array(
              'label'            => __( 'Tab Title', 'themes' ),
              'section'          => 'customize_slider_section',
              'priority'         => Null,
              'settings'         => 'themes_customization[slide_tab_title'.$i.$j.']',
            ) );
          }
        }
      }
      $wp_customize->add_setting('themes_customization[themes_slide_delay]',array(
        'default' => 10000,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control('themes_customization[themes_slide_delay]',array(
        'label' => __('Slide Delay','themes'),
        'section' => 'customize_slider_section',
        'description' => __('interval is in milliseconds. 1000 = 1 second -> so 1000 * 10 = 10 seconds', 'themes'),
        'type'    => 'number'
      ));
      $wp_customize->add_setting( 'themes_customization[themes_slide_remove_fade]',
         array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'themes_switch_sanitization'
      ));
      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[themes_slide_remove_fade]',
         array(
            'label' => esc_html__( 'Fade Effect', 'themes' ),
            'section' => 'customize_slider_section'
      ))); 
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_slider_dots',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'themes_switch_sanitization'
        ));
        $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_slider_dots',
         array(
            'label' => esc_html__( 'Show/Hide Slider Dots', 'themes' ),
            'section' => 'customize_slider_section'
        )));  
      }
      $wp_customize->add_setting( 'themes_slider_nav',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'themes_switch_sanitization'
      ));
      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_slider_nav',
       array(
          'label' => esc_html__( 'Show/Hide Slider Nav', 'themes' ),
          'section' => 'customize_slider_section'
      )));  
      if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting('themes_customization[slider_products_number]',array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('themes_customization[slider_products_number]',array(
            'label' => __('Number of Products to show','themes'),
            'section'   => 'customize_slider_section',
            'type'      => 'number'
        ));
        $aboutchoose =  isset( $this->themes_key['slider_products_number'] )? $this->themes_key['slider_products_number'] : 4;
        $args = array(
          'type'                     => 'product',
          'child_of'                 => 0,
          'parent'                   => '',
          'orderby'                  => 'term_group',
          'order'                    => 'ASC',
          'hide_empty'               => false,
          'hierarchical'             => 1,
          'number'                   => '',
          'taxonomy'                 => 'product_cat',
          'pad_counts'               => false
        );
        $categories = get_categories( $args );
        $cats = array();
        $i = 0;
        foreach($categories as $category){
          $cats[$category->name] = $category->name;
        }
        $wp_customize->add_setting('themes_customization[slider_products_category]',array(
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_select',
        ));
        $wp_customize->add_control('themes_customization[slider_products_category]',array(
          'type'    => 'select',
          'choices' => $cats,
          'label' => __('Select Category','themes'),
          'section' => 'customize_slider_section',
          'settings' => 'themes_customization[slider_products_category]',
        ));
      }
      $wp_customize->add_setting( 'themes_customization[themes_slider_small_Heading_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_slider_small_Heading_color]', array(
        'label' => __('Slider Small Heading Color', 'themes'),
        'section' => 'customize_slider_section',
        'settings' => 'themes_customization[themes_slider_small_Heading_color]',
      )));
      $wp_customize->add_setting('themes_customization[themes_slider_small_Heading_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[themes_slider_small_Heading_font_family]', array(
          'section'  => 'customize_slider_section',
          'label'    => __( 'Slider Small Heading Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_slider_small_heading_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        ));
      $wp_customize->add_control('themes_customization[themes_slider_small_heading_font_size]',array(
          'label' => __('Small Heading Font Size in px','themes'),
          'section' => 'customize_slider_section',
          'setting' => 'themes_customization[themes_slider_small_heading_font_size]',
          'type'    => 'text'
        ));
      $wp_customize->add_setting( 'themes_customization[themes_main_heading_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_main_heading_color]', array(
        'label' => __('Slider Main Heading Color', 'themes'),
        'section' => 'customize_slider_section',
        'settings' => 'themes_customization[themes_main_heading_color]',
      )));
      $wp_customize->add_setting('themes_customization[themes_main_heading_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[themes_main_heading_font_family]', array(
          'section'  => 'customize_slider_section',
          'label'    => __( 'Slider Main Heading Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_main_heading_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control('themes_customization[themes_main_heading_font_size]',array(
        'label' => __('Main Heading Font Size in px','themes'),
        'section' => 'customize_slider_section',
        'setting' => 'themes_customization[themes_main_heading_font_size]',
        'type'    => 'text'
      ));
      $wp_customize->add_setting( 'themes_customization[themes_slider_section_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_slider_section_text_color]', array(
        'label' => __('Slider Text Color', 'themes'),
        'section' => 'customize_slider_section',
        'settings' => 'themes_customization[themes_slider_section_text_color]',
      )));
      $wp_customize->add_setting('themes_customization[themes_slider_section_text_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[themes_slider_section_text_font_family]', array(
          'section'  => 'customize_slider_section',
          'label'    => __( 'Slider Text Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_slider_section_text_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control('themes_customization[themes_slider_section_text_font_size]',array(
          'label' => __('Slider Text Font Size in px','themes'),
          'section' => 'customize_slider_section',
          'setting' => 'themes_customization[themes_slider_section_text_font_size]',
          'type'    => 'text'
        )
      );
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
        // Button color settings
        $wp_customize->add_setting( 'themes_customization[themes_slide_tabcolor]', array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_slide_tabcolor]', array(
          'label' => 'Tab Background Color',
          'section' => 'customize_slider_section',
          'settings' => 'themes_customization[themes_slide_tabcolor]',
        )));  
      }
      // Button color settings
      $wp_customize->add_setting( 'themes_customization[themes_slide_buttoncolor]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_slide_buttoncolor]', array(
        'label' => 'Button Text Color',
        'section' => 'customize_slider_section',
        'settings' => 'themes_customization[themes_slide_buttoncolor]',
      )));  

      $wp_customize->add_setting('themes_customization[themes_button_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[themes_button_fontfamily]', array(
          'section'  => 'customize_slider_section',
          'label'    => __( 'Button Text Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_slide_button_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[themes_slide_button_font_size]',array(
          'label' => __('Button Text Font Size in px','themes'),
          'section' => 'customize_slider_section',
          'setting' => 'themes_customization[themes_slide_button_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[themes_slide_button_gradient_bgcolor1', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_slide_button_gradient_bgcolor1', array(
        'label' => 'Button Background Color 1',
        'section' => 'customize_slider_section',
        'settings' => 'themes_customization[themes_slide_button_gradient_bgcolor1]',
      )));
    }
    //  =============================
    //  = Section for Main Search banner    =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      $wp_customize->add_section( 'customize_search_banner_section', array(
        'title'        => __( 'Search banner', 'themes' ),
        'description'  => __( 'Customize Search banner Section', 'themes' ),
        'priority'     => 3,
        'panel'        => 'themes_panel',
      ) );
      $wp_customize->add_setting( 'themes_customization[radio_search_banner_enable]', array(
        'default'           => false,
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_checkbox'
      ) );

      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_search_banner_enable]', array(
       'settings'    => 'themes_customization[radio_search_banner_enable]',
        'label'       => __( 'Disable Section:', 'themes'),
        'section'     => 'customize_search_banner_section',
       'priority'   => 2,
        'type'        => 'ios', // light, ios, flat
      ) ) );
      $wp_customize->add_setting( 'themes_customization[search_banner_image]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[search_banner_image]', array(
        'label'      => __( 'Background Image ','themes'),
        'section'    => 'customize_search_banner_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[search_banner_image]',
        'button_labels' => array(
           'select'       => __( 'Select Banner Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[search_banner_main_heading]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[search_banner_main_heading]', array(
        'label'            => __( 'Main Title', 'themes' ),
        'section'          => 'customize_search_banner_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[search_banner_main_heading]',
      ) );
      $wp_customize->add_setting( 'themes_customization[search_banner_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[search_banner_text]', array(
        'label'            => __( 'Main Text', 'themes' ),
        'section'          => 'customize_search_banner_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[search_banner_text]',
      ) );
    }
    //  =============================
    //  = Section for Our Features  =
    //  =============================
    if(defined('VW_FLOWER_SHOP_PRO_VERSION') || defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-flower-pro/section-our-features.php';
    }
    //  =============================
    //  = Section for About Us    =
    //  =============================
    $wp_customize->add_section( 'customize_about_us_section', array(
      'title'        => __( 'About Us', 'themes' ),
      'description'  => __( 'Customize About Us Section', 'themes' ),
      'priority'     => 3,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_about_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_about_enable]', array(
     'settings'    => 'themes_customization[radio_about_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_about_us_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[about_bgcolor]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_about_us_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[about_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[about_bgimage]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[about_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_about_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[about_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[about_left_bgimage]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[about_left_bgimage]', array(
        'label'      => __( 'About Left Image ','themes'),
        'section'    => 'customize_about_us_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[about_left_bgimage]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    $wp_customize->add_setting( 'themes_customization[about_section_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[about_section_image]', array(
      'label'      => __( 'About Image ','themes'),
      'section'    => 'customize_about_us_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[about_section_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[about_left_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_left_title]', array(
        'label'            => __( 'About Image Left Title', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_left_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[about_right_title]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[about_right_title]', array(
        'label'      => __( 'About Image Right Title ','themes').$i.__(' (1600px * 562px)', 'themes' ),
        'section'    => 'customize_about_us_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[about_right_title]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[about_sec_left_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_sec_left_title]', array(
        'label'            => __( 'Section Main Left Title', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_sec_left_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[about_sec_right_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_sec_right_title]', array(
        'label'            => __( 'Section Main Right Title', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_sec_right_title]',
      ) );
    }
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[about_title_image]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_title_image]', array(
        'label'            => __( 'Section Title Image', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_title_image]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[about_sec_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[about_sec_title]', array(
      'label'            => __( 'Section Title', 'themes' ),
      'section'          => 'customize_about_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[about_sec_title]',
    ) );
    $wp_customize->add_setting('themes_customization[about_icon_box_number]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[about_icon_box_number]',array(
        'label' => __('Number of list to show','themes'),
        'section'   => 'customize_about_us_section',
        'type'      => 'number'
    ));

    $aboutchoose =  isset( $this->themes_key['about_icon_box_number'] )? $this->themes_key['about_icon_box_number'] : 2;
    for($i=1; $i<=$aboutchoose; $i++) {
      $wp_customize->add_setting( 'themes_customization[about_title'.$i.']', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_title'.$i.']', array(
        'label'            => __( 'Title', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_title'.$i.']',
      ) );
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[about_deg_para]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_deg_para]', array(
        'label'            => __( 'Section Text', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_deg_para]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[about_left_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_control( 'themes_customization[about_left_btn_text]', array(
      'label'            => __( 'Button Left Text', 'themes' ),
      'section'          => 'customize_about_us_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[about_left_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[about_left_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[about_left_btn_url]',array(
        'label' => __('Button Left Url','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_left_btn_url]',
        'type'    => 'url'
    ));
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[about_right_btn_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[about_right_btn_text]', array(
        'label'            => __( 'Button Right Text', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[about_right_btn_text]',
      ) );
      $wp_customize->add_setting('themes_customization[about_right_btn_url]',array(
          'default' => '',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[about_right_btn_url]',array(
          'label' => __('Button Right Url','themes'),
          'section' => 'customize_about_us_section',
          'setting' => 'themes_customization[about_right_btn_url]',
          'type'    => 'url'
      ));
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')|| defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
     if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
       $wp_customize->add_setting( 'themes_customization[about_video_bgimage]', array(
          // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[about_video_bgimage]', array(
          'label'      => __( 'About Video Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
          'section'    => 'customize_about_us_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[about_video_bgimage]',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
      $wp_customize->add_setting( 'themes_customization[video_link]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[video_link]', array(
        'label'            => __( 'Enter embed video Link', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[video_link]',
      ) );
      $wp_customize->add_setting( 'themes_customization[video_desc]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[video_desc]', array(
        'label'            => __( 'Video Text', 'themes' ),
        'section'          => 'customize_about_us_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[video_desc]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[about_smalltitle_left_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_smalltitle_left_color]', array(
      'label' => 'Small Title Left Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_smalltitle_left_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_smalltitle_left_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_smalltitle_left_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Small Title Left Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_smalltitle_left_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_smalltitle_left_font_size]',array(
        'label' => __('Small Title Left Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_smalltitle_left_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_smalltitle_left_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_smalltitle_left_bgcolor]', array(
      'label' => 'Small Title Left Background Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_smalltitle_left_bgcolor]',
    )));  
    $wp_customize->add_setting( 'themes_customization[about_smalltitle_right_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_smalltitle_right_color]', array(
      'label' => 'Small Title right Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_smalltitle_right_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_smalltitle_right_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_smalltitle_right_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Small Title right Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_smalltitle_right_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_smalltitle_right_font_size]',array(
        'label' => __('Small Title right Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_smalltitle_right_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_smalltitle_right_bgcolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_smalltitle_right_bgcolor]', array(
      'label' => 'Small Title right Background Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_smalltitle_right_bgcolor]',
    )));  
    $wp_customize->add_setting( 'themes_customization[about_main_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_main_title_color]', array(
      'label' => 'Main Title Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_main_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_main_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_main_title_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Main Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_main_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_main_title_font_size]',array(
        'label' => __('Main Title Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_main_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_list_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_list_title_color]', array(
      'label' => 'List Title Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_list_title_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_list_title_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_list_title_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'List Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_list_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_list_title_font_size]',array(
        'label' => __('List Title Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_list_title_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_text_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_button_text_color]', array(
      'label' => 'Button Text Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_button_text_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_button_text_font_size]',array(
        'label' => __('Button Text Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_button_text_font_size]',
        'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[about_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_button_bg_color]', array(
      'label' => 'Button Background Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[about_extra_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_extra_text_color]', array(
      'label' => 'Extra Text Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_extra_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[about_extra_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[about_extra_text_fontfamily]', array(
        'section'  => 'customize_about_us_section',
        'label'    => __( 'Extra Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[about_extra_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
      );
      $wp_customize->add_control('themes_customization[about_extra_text_font_size]',array(
        'label' => __('Extra Text Font Size in px','themes'),
        'section' => 'customize_about_us_section',
        'setting' => 'themes_customization[about_extra_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[about_extra_text_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[about_extra_text_bg_color]', array(
      'label' => 'Extra Background Color',
      'section' => 'customize_about_us_section',
      'settings' => 'themes_customization[about_extra_text_bg_color]',
    ))); 
    
    //  =============================
    //  = Section for Featured Products    =
    //  =============================
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_section( 'customize_Products_section', array(
        'title'        => __( 'Featured Products', 'themes' ),
        'description'  => __( 'Customize Products Section', 'themes' ),
        'priority'     => 4,
        'panel'        => 'themes_panel',
      ) );
      $wp_customize->add_setting( 'themes_customization[radio4_enable]', array(
        'default'           => false,
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_checkbox'
      ) );

      $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio4_enable]', array(
       'settings'    => 'themes_customization[radio4_enable]',
        'label'       => __( 'Disable Section:', 'themes'),
        'section'     => 'customize_Products_section',
       'priority'   => 2,
        'type'        => 'ios', // light, ios, flat
      ) ) );
      $wp_customize->add_setting( 'themes_customization[fetured_product_bg_color]', array(
        // 'default'        => '#ddd5c3',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[fetured_product_bg_color]', array(
        'label'      => __( 'Background Color:', 'themes' ),
        'section'    => 'customize_Products_section',
        'priority'   => 5,
        'settings'   => 'themes_customization[fetured_product_bg_color]'
      ) ) );
      $wp_customize->add_setting( 'themes_customization[fetured_product_bg_image]', array(
        // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[fetured_product_bg_image]', array(
        'label'      => __( 'Background Image ','themes'),
        'section'    => 'customize_Products_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[fetured_product_bg_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      $wp_customize->add_setting( 'themes_customization[fetured_product_left_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[fetured_product_left_title]', array(
        'label'            => __( 'Section Main Title 1', 'themes' ),
        'section'          => 'customize_Products_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[fetured_product_left_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[fetured_product_right_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[fetured_product_right_title]', array(
        'label'            => __( 'Section Main Title 2', 'themes' ),
        'section'          => 'customize_Products_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[fetured_product_right_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[featued_tittle]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[featued_tittle]', array(
        'label'            => __( 'Section Title', 'themes' ),
        'section'          => 'customize_Products_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[featued_tittle]',
      ) );
      $wp_customize->add_setting( 'themes_customization[featued_tittle]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_setting('themes_customization[fetured_product_number]',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[fetured_product_number]',array(
          'label' => __('Number of Tabs to show','themes'),
          'section'   => 'customize_Products_section',
          'type'      => 'number'
      ));

      $aboutchoose =  isset( $this->themes_key['fetured_product_number'] )? $this->themes_key['fetured_product_number'] : 4;
      $args = array(
        'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
      );
      $categories = get_categories( $args );
      $cats = array();
      $i = 0;
      foreach($categories as $category){
        $cats[$category->name] = $category->name;
      }
      for($i=1; $i<=$aboutchoose; $i++) {
        $wp_customize->add_setting( 'themes_customization[fetured_product_sec_title'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );

        $wp_customize->add_control( 'themes_customization[fetured_product_sec_title'.$i.']', array(
          'label'            => __( 'Title', 'themes' ),
          'section'          => 'customize_Products_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[fetured_product_sec_title'.$i.']',
        ) );
        $wp_customize->add_setting('themes_customization[featured_products_category'.$i.']',array(
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_select',
        ));
        $wp_customize->add_control('themes_customization[featured_products_category'.$i.']',array(
          'type'    => 'select',
          'choices' => $cats,
          'label' => __('Select Category','themes'),
          'section' => 'customize_Products_section',
          'settings' => 'themes_customization[featured_products_category'.$i.']',
        ));

      }
      $wp_customize->add_setting( 'themes_customization[pro_small_left_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_small_left_title_color]', array(
        'label' => 'Small Title Left Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_small_left_title_color]',
      )));  

      $wp_customize->add_setting('themes_customization[pro_small_left_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[pro_small_left_title_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Small Title Left Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[pro_small_left_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[pro_small_left_title_font_size]',array(
          'label' => __('Small Title Left Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[pro_small_left_title_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[pro_small_left_titlebg_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_small_left_titlebg_color]', array(
        'label' => 'Small Title Left Background Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_small_left_titlebg_color]',
      ))); 
      $wp_customize->add_setting( 'themes_customization[pro_small_right_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_small_right_title_color]', array(
        'label' => 'Small Title Right Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_small_right_title_color]',
      )));  

      $wp_customize->add_setting('themes_customization[pro_small_right_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[pro_small_right_title_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Small Title Right Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[pro_small_right_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[pro_small_right_title_font_size]',array(
          'label' => __('Small Title Right Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[pro_small_right_title_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[pro_small_right_titlebg_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_small_right_titlebg_color]', array(
        'label' => 'Small Title Right Background Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_small_right_titlebg_color]',
      ))); 
      $wp_customize->add_setting( 'themes_customization[pro_main_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_main_title_color]', array(
        'label' => 'Main Title Right Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_main_title_color]',
      )));  

      $wp_customize->add_setting('themes_customization[pro_main_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[pro_main_title_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Main Title Right Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[pro_main_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[pro_main_title_font_size]',array(
          'label' => __('Main Title Right Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[pro_main_title_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[pro_tab_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_tab_title_color]', array(
        'label' => 'Tab Title Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_tab_title_color]',
      )));  

      $wp_customize->add_setting('themes_customization[pro_tab_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[pro_tab_title_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Tab Title Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[pro_tab_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control('themes_customization[pro_tab_title_font_size]',array(
          'label' => __('Tab Title Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[pro_tab_title_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[pro_tab_title_active_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_tab_title_active_color]', array(
        'label' => 'Active Tab Title Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_tab_title_active_color]',
      )));  

      $wp_customize->add_setting('themes_customization[pro_tab_title_active_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[pro_tab_title_active_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Active Tab Title Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[pro_tab_title_active_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
      );
      $wp_customize->add_control('themes_customization[pro_tab_title_active_font_size]',array(
          'label' => __('Active Tab Title Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[pro_tab_title_active_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[pro_tab_title_active_bgcolor]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pro_tab_title_active_bgcolor]', array(
        'label' => 'Active Tab Title Background Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[pro_tab_title_active_bgcolor]',
      ))); 
      $wp_customize->add_setting( 'themes_customization[product_background_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_background_color]', array(
        'label' => 'Product Background Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_background_color]',
      ))); 
      $wp_customize->add_setting( 'themes_customization[product_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_title_color]', array(
        'label' => 'Product Title Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_title_color]',
      ))); 
      $wp_customize->add_setting('themes_customization[product_title_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[product_title_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Product Title Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[product_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[product_title_font_size]',array(
          'label' => __('Product Title Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[product_title_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[product_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_text_color]', array(
        'label' => 'Product Text Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_text_color]',
      ))); 
      $wp_customize->add_setting('themes_customization[product_text_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[product_text_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Product Text Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[product_text_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[product_text_font_size]',array(
          'label' => __('Product Text Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[product_text_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[product_price_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_price_text_color]', array(
        'label' => 'Product Price Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_price_text_color]',
      ))); 
      $wp_customize->add_setting('themes_customization[product_price_text_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[product_price_text_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Product Price Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[product_price_text_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[product_price_text_font_size]',array(
          'label' => __('Product Price Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[product_price_text_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[product_button_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_text_color]', array(
        'label' => 'Product Button Text Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_button_text_color]',
      ))); 
      $wp_customize->add_setting('themes_customization[product_button_text_fontfamily]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
       ));
      $wp_customize->add_control(
          'themes_customization[product_button_text_fontfamily]', array(
          'section'  => 'customize_Products_section',
          'label'    => __( 'Product Button Text Fonts','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[product_button_text_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
        );
        $wp_customize->add_control('themes_customization[product_button_text_font_size]',array(
          'label' => __('Product Button Text Font Size in px','themes'),
          'section' => 'customize_Products_section',
          'setting' => 'themes_customization[product_button_text_font_size]',
          'type'    => 'text'
        )
      );
      $wp_customize->add_setting( 'themes_customization[product_button_bg_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[product_button_bg_color]', array(
        'label' => 'Product Button Background Color',
        'section' => 'customize_Products_section',
        'settings' => 'themes_customization[product_button_bg_color]',
      )));
    }
    //  =============================
    //  = Section for Our App    =
    //  =============================
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-software-company/section-our-app.php';
    }
    //  =============================
    //  = Section for partner    =
    //  =============================
    $wp_customize->add_section( 'customize_Partners_section', array(
      'title'        => __( 'Our Partners', 'themes' ),
      'description'  => __( 'Customize Partners Section', 'themes' ),
      'priority'     => 6,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_our_partners_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_our_partners_enable]', array(
     'settings'    => 'themes_customization[radio_our_partners_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_Partners_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[partnersbg_color]', array(
      // 'default'        => '#ddd5c3',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[partnersbg_color]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_Partners_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[partnersbg_color]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[partnersbg_image]', array(
      // 'default'       =>  plugins_url( 'img/bg.jpg', CUSTOM_ROOT_FILE ) ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[partnersbg_image]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_Partners_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[partnersbg_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[our_partners_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );

      $wp_customize->add_control( 'themes_customization[our_partners_title]', array(
        'label'            => __( 'Section Title', 'themes' ),
        'section'          => 'customize_Partners_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[our_partners_title]',
      ) );
    }
    $wp_customize->add_setting('themes_customization[our_partners_number]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[our_partners_number]',array(
        'label' => __('Number of Images to show','themes'),
        'section'   => 'customize_Partners_section',
        'type'      => 'number'
    ));

    $count =  isset( $this->themes_key['our_partners_number'] )? $this->themes_key['our_partners_number'] : 5;
    for($i=1; $i<=$count; $i++) {
      $wp_customize->add_setting( 'themes_customization[our_partners_image'.$i.']', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_partners_image'.$i.']', array(
        'label'      => __( 'Partner Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
        'section'    => 'customize_Partners_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[our_partners_image'.$i.']',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[our_partners_alt_image'.$i.']', array(
          'default'       =>  '' ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[our_partners_alt_image'.$i.']', array(
          'label'      => __( 'Partner Alter Image ','themes').$i.__(' (1600px * 562px)', 'themes' ),
          'section'    => 'customize_Partners_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[our_partners_alt_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
      }
      $wp_customize->add_setting('themes_customization[our_partners_link'.$i.']',array(
          'default' => '',
          'sanitize_callback' => 'esc_url_raw'
      ));
      $wp_customize->add_control('themes_customization[our_partners_link'.$i.']',array(
          'label' => __('Partner Link','themes'),
          'section' => 'customize_Partners_section',
          'setting' => 'themes_customization[our_partners_link'.$i.']',
          'type'    => 'url'
      ));
    }
    $wp_customize->add_setting( 'themes_customization[our_partners_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_partners_bg_color]', array(
      'label' => 'Partner Background Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[our_partners_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[our_partners_bg_hovercolor]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[our_partners_bg_hovercolor]', array(
      'label' => 'Partner Background Hover Color',
      'section' => 'customize_our_app_section',
      'settings' => 'themes_customization[our_partners_bg_hovercolor]',
    ))); 
    //  =============================
    //  = Section for Our Services    =
    //  =============================
    $wp_customize->add_section( 'customize_services_section', array(
      'title'        => __( 'Our Services', 'themes' ),
      'description'  => __( 'Customize Services Section', 'themes' ),
      'priority'     => 7,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[services_enabledisable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[services_enabledisable]', array(
     'settings'    => 'themes_customization[services_enabledisable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_services_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[services_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[services_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_services_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[services_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[services_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[services_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_services_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[services_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[services_small_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[services_small_title]', array(
        'label'            => __( 'Section Small Title', 'themes' ),
        'section'          => 'customize_services_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[services_small_title]',
      ) );
    }
    $wp_customize->add_setting( 'themes_customization[services_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[services_main_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_services_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[services_main_title]',
    ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[services_desc]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[services_desc]', array(
        'label'            => __( 'Section Description', 'themes' ),
        'section'          => 'customize_services_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[services_desc]',
      ) );
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[service_number]',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[service_number]',array(
          'label' => __('Number of Services to show','themes'),
          'section'   => 'customize_services_section',
          'type'      => 'number'
      ));
      $wp_customize->add_setting( 'themes_customization[services_excerpt_no]',
        array(
          'default' => 20,
          'transport' => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
      ));
      $wp_customize->add_control( new themes_Slider_Custom_Control( $wp_customize, 'themes_customization[services_excerpt_no]',
          array(
            'label' => __( 'Services Excerpt Number (Limit 50 Words)', 'themes' ),
            'section' => 'customize_services_section',
            'input_attrs' => array(
              'min' => 5, // Required. Minimum value for the slider
              'max' => 50, // Required. Maximum value for the slider
              'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
      )));
    }
    $wp_customize->add_setting( 'themes_customization[themes_servicesmall_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_servicesmall_title_color]', array(
      'label' => __('Section Small Title Color', 'themes'),
      'section' => 'customize_services_section',
      'settings' => 'themes_customization[themes_servicesmall_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_servicesmall_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_servicesmall_title_font_family]', array(
        'section'  => 'customize_services_section',
        'label'    => __('Section Small Title Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_servicesmall_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_servicesmall_title_font_size]',array(
          'label' => __('Section Small Title Font size in px','themes'),
          'section' => 'customize_services_section',
          'setting' => 'themes_customization[themes_servicesmall_title_font_size]',
          'type'    => 'text'
        )
    );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_servicesmall_title_bgcolor]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_servicesmall_title_bgcolor]', array(
        'label' => __('Section Small Title Background Color', 'themes'),
        'section' => 'customize_services_section',
        'settings' => 'themes_customization[themes_servicesmall_title_bgcolor]',
      )));
    }
    $wp_customize->add_setting( 'themes_customization[themes_service_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_title_color]', array(
      'label' => __('Section Title Color', 'themes'),
      'section' => 'customize_services_section',
      'settings' => 'themes_customization[themes_service_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_service_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_service_title_font_family]', array(
        'section'  => 'customize_services_section',
        'label'    => __('Section Title Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_service_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_service_title_font_size]',array(
          'label' => __('Section Title Font size in px','themes'),
          'section' => 'customize_services_section',
          'setting' => 'themes_customization[themes_service_title_font_size]',
          'type'    => 'text'
        )
    );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_service_subtext_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_subtext_color]', array(
        'label' => __('Section SubText Color', 'themes'),
        'section' => 'customize_services_section',
        'settings' => 'themes_customization[themes_service_subtext_color]',
      )));

      $wp_customize->add_setting('themes_customization[themes_service_text_font_family]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[themes_service_text_font_family]', array(
          'section'  => 'customize_services_section',
          'label'    => __('SubText Font family','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_service_text_font_size]',array(
            'default' => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
          )
      );
      $wp_customize->add_control('themes_customization[themes_service_text_font_size]',array(
            'label' => __('SubText Font size in px','themes'),
            'section' => 'customize_services_section',
            'setting' => 'themes_customization[themes_service_text_font_size]',
            'type'    => 'text'
          )
      );
    }
    $wp_customize->add_setting( 'themes_customization[themes_service_box_icons_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_icons_bg_color]', array(
      'label' => __('Box Icons Background Color', 'themes'),
      'section' => 'customize_services_section',
      'settings' => 'themes_customization[themes_service_box_icons_bg_color]',
    )));
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_service_box_icons_bg_hovercolor]', array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_icons_bg_hovercolor]', array(
        'label' => __('Box Icons Hover Background Color', 'themes'),
        'section' => 'customize_services_section',
        'settings' => 'themes_customization[themes_service_box_icons_bg_hovercolor]',
      )));
    }
    $wp_customize->add_setting( 'themes_customization[themes_service_box_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_title_color]', array(
      'label' => __('Box Title Color', 'themes'),
      'section' => 'customize_services_section',
      'settings' => 'themes_customization[themes_service_box_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_service_box_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_service_box_title_font_family]', array(
        'section'  => 'customize_services_section',
        'label'    => __('Box Title Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_service_box_title_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_service_box_title_font_size]',array(
          'label' => __('Box Title Font size in px','themes'),
          'section' => 'customize_services_section',
          'setting' => 'themes_customization[themes_service_box_title_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[themes_service_box_content_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_service_box_content_color]', array(
      'label' => __('Box Content Color', 'themes'),
      'section' => 'customize_services_section',
      'settings' => 'themes_customization[themes_service_box_content_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_service_box_content_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_service_box_content_font_family]', array(
        'section'  => 'customize_services_section',
        'label'    => __('Box Content Font family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_service_box_content_font_size]',array(
          'default' => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_service_box_content_font_size]',array(
          'label' => __('Box Content Font size in px','themes'),
          'section' => 'customize_services_section',
          'setting' => 'themes_customization[themes_service_box_content_font_size]',
          'type'    => 'text'
        )
    );
    //  =============================
    //  = Section for Browse Topics    =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-browse-topics.php';
    }
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-services-blog.php';
    }
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-getstarted-blog.php';
    }
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-how-it-works.php';
    }
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-our-team.php';
    }
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-flower-pro/section-best-seller.php';
    } 
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-flower-pro/section-home-contact.php';
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-software-company/section-Interface-deg.php';
    }  
    //  =============================
    //  = Section for Introduction  =
    //  =============================
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-software-company/section-introduction.php';
    }    
    //  =============================
    //  = Section for Newsletter    =
    //  =============================
    $wp_customize->add_section( 'customize_newsletter_section', array(
      'title'        => __( 'Newsletter', 'themes' ),
      'description'  => __( 'Customize Newsletter Section', 'themes' ),
      'priority'     => 9,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[newsletter_enable]', array(
     'settings'    => 'themes_customization[newsletter_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_newsletter_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[newsletter_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_newsletter_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[newsletter_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[newsletter_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_newsletter_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[newsletter_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_small_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[newsletter_small_title]', array(
      'label'            => __( 'Section Small Title', 'themes' ),
      'section'          => 'customize_newsletter_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[newsletter_small_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[newsletter_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_newsletter_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[newsletter_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[newsletter_title]', array(
      'label'            => __( 'Section Main Title', 'themes' ),
      'section'          => 'customize_newsletter_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[newsletter_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[newsletter_shortcode]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[newsletter_shortcode]', array(
      'label'            => __( 'Add Contact Form Shortcode Here', 'themes' ),
      'section'          => 'customize_newsletter_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[newsletter_shortcode]',
    ) );
    $wp_customize->add_setting( 'themes_customization[themes_newsletter_title_color_first]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_newsletter_title_color_first]', array(
      'label' => __('Section Title Color', 'themes'),
      'section' => 'customize_newsletter_section',
      'settings' => 'themes_customization[themes_newsletter_title_color_first]',
    )));

    $wp_customize->add_setting('themes_customization[themes_newsletter_title_font_family]',array(
       'default' => '',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_newsletter_title_font_family]', array(
        'section'  => 'customize_newsletter_section',
        'label'    => __('Section Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[themes_newsletter_title_font_size]',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[themes_newsletter_title_font_size]',array(
      'label' => __('Section Title font size in px','themes'),
      'section' => 'customize_newsletter_section',
      'setting' => 'themes_customization[themes_newsletter_title_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[themes_newsletter_text_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_newsletter_text_color]', array(
      'label' => __('Text Color', 'themes'),
      'section' => 'customize_newsletter_section',
      'settings' => 'themes_customization[themes_newsletter_text_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_newsletter_text_font_family]',array(
       'default' => '',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_newsletter_text_font_family]', array(
        'section'  => 'customize_newsletter_section',
        'label'    => __('Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[themes_newsletter_text_font_size]',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[themes_newsletter_text_font_size]',array(
      'label' => __('Text font size in px','themes'),
      'section' => 'customize_newsletter_section',
      'setting' => 'themes_customization[themes_newsletter_text_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[themes_newsletter_form_button_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_newsletter_form_button_color]', array(
      'label' => __('Button Text Color', 'themes'),
      'section' => 'customize_newsletter_section',
      'settings' => 'themes_customization[themes_newsletter_form_button_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_newsletter_form_button_font_family]',array(
       'default' => '',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_newsletter_form_button_font_family]', array(
        'section'  => 'customize_newsletter_section',
        'label'    => __('Button Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));

    $wp_customize->add_setting('themes_customization[themes_newsletter_form_button_font_size]',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('themes_customization[themes_newsletter_form_button_font_size]',array(
      'label' => __('Button Text font size in px','themes'),
      'section' => 'customize_newsletter_section',
      'setting' => 'themes_customization[themes_newsletter_form_button_font_size]',
      'type'    => 'text'
      )
    );
    $wp_customize->add_setting( 'themes_customization[themes_newsletter_form_button_bgcolor_first]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_newsletter_form_button_bgcolor_first]', array(
      'label' => __('Button Background Color', 'themes'),
      'description' => __('For Gradient color effect select Both Gradient color first and second.','themes'),
      'section' => 'customize_newsletter_section',
      'settings' => 'themes_customization[themes_newsletter_form_button_bgcolor_first]',
    )));
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-flower-pro/section-daliy-deals.php';
    }    
    //  =============================
    //  = Section for Testimonial Section    =
    //  =============================
    $wp_customize->add_section( 'customize_testimonial_section', array(
      'title'        => __( 'Testimonial Section', 'themes' ),
      'description'  => __( 'Customize Testimonial Section', 'themes' ),
      'priority'     => 11,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_testimonial_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_testimonial_enable]', array(
     'settings'    => 'themes_customization[radio_testimonial_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_testimonial_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[testimonial_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[testimonial_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_testimonial_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[testimonial_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[testimonial_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[testimonial_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_testimonial_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[testimonial_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[testimonial_left_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[testimonial_left_title]', array(
        'label'            => __( 'Section Main Title 1', 'themes' ),
        'section'          => 'customize_testimonial_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[testimonial_left_title]',
      ) );
      $wp_customize->add_setting( 'themes_customization[testimonial_main_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[testimonial_main_text]', array(
        'label'            => __( 'Section Main Title', 'themes' ),
        'section'          => 'customize_testimonial_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[testimonial_main_text]',
      ) );
      if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
        $wp_customize->add_setting( 'themes_customization[testimonial_text]', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[testimonial_text]', array(
          'label'            => __( 'Section Text', 'themes' ),
          'section'          => 'customize_testimonial_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[testimonial_text]',
        ) );
      }
    }
    $wp_customize->add_setting( 'themes_customization[testimonial_quates_image]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[testimonial_quates_image]', array(
      'label'      => __( 'Testimonial Quote Image ','themes'),
      'section'    => 'customize_testimonial_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[testimonial_quates_image]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[testimonial_round_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[testimonial_round_image]', array(
        'label'      => __( 'Testimonial Rotted Image ','themes'),
        'section'    => 'customize_testimonial_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[testimonial_round_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    $wp_customize->add_setting( 'themes_customization[testimonial_excerpt_no]',
      array(
        'default' => 20,
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new themes_Slider_Custom_Control( $wp_customize, 'themes_customization[testimonial_excerpt_no]',
        array(
          'label' => __( 'Services Excerpt Number (Limit 50 Words)', 'themes' ),
          'section' => 'customize_testimonial_section',
          'input_attrs' => array(
            'min' => 5, // Required. Minimum value for the slider
            'max' => 50, // Required. Maximum value for the slider
            'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
          ),
    )));
    $wp_customize->add_setting( 'themes_customization[themes_testimonial_title_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_title_color]', array(
          'label' => __('Section Title Color', 'themes'),
          'section' => 'themes_testimonial',
          'settings' => 'themes_customization[themes_testimonial_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_testimonial_title_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_testimonial_title_font_family]', array(
        'section'  => 'customize_testimonial_section',
        'label'    => __( 'Section Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_testimonial_title_font_size]',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_testimonial_title_font_size]',array(
          'label' => __('Section Title size in px','themes'),
          'section' => 'customize_testimonial_section',
          'setting' => 'themes_customization[themes_testimonial_title_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[themes_testimonial_subtext_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_subtext_color]', array(
          'label' => __('Section Subtext Color', 'themes'),
          'section' => 'customize_testimonial_section',
          'settings' => 'themes_customization[themes_testimonial_subtext_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_testimonial_subtext_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_testimonial_subtext_font_family]', array(
        'section'  => 'customize_testimonial_section',
        'label'    => __( 'Section Subtext Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_testimonial_subtext_font_size]',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_testimonial_subtext_font_size]',array(
          'label' => __('Section Subtext size in px','themes'),
          'section' => 'customize_testimonial_section',
          'setting' => 'themes_customization[themes_testimonial_subtext_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[themes_testimonial_name_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_name_color]', array(
          'label' => __('Testimonial Name Color', 'themes'),
          'section' => 'customize_testimonial_section',
          'settings' => 'themes_customization[themes_testimonial_name_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_testimonial_name_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_testimonial_name_font_family]', array(
        'section'  => 'customize_testimonial_section',
        'label'    => __( 'Testimonial Name Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_testimonial_name_font_size]',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_testimonial_name_font_size]',array(
          'label' => __('Testimonial Name size in px','themes'),
          'section' => 'customize_testimonial_section',
          'setting' => 'themes_customization[themes_testimonial_name_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[themes_testimonial_des_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_des_color]', array(
          'label' => __('Testimonial Designation', 'themes'),
          'section' => 'customize_testimonial_section',
          'settings' => 'themes_customization[themes_testimonial_des_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_testimonial_des_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_testimonial_des_font_family]', array(
        'section'  => 'customize_testimonial_section',
        'label'    => __( 'Testimonial Designation Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_testimonial_des_font_size]',array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_testimonial_des_font_size]',array(
          'label' => __('Testimonial Designation Name size in px','themes'),
          'section' => 'customize_testimonial_section',
          'setting' => 'themes_customization[themes_testimonial_des_font_size]',
          'type'    => 'text'
        )
    );
    $wp_customize->add_setting( 'themes_customization[themes_testimonial_qoute_color]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_qoute_color]', array(
          'label' => __('Testimonial Quote Color', 'themes'),
          'section' => 'customize_testimonial_section',
          'settings' => 'themes_customization[themes_testimonial_qoute_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_testimonial_qoute_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_testimonial_qoute_font_family]', array(
        'section'  => 'customize_testimonial_section',
        'label'    => __( 'Testimonial Quote Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_testimonial_qoute_font_size]', array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('themes_customization[themes_testimonial_qoute_font_size]',array(
          'label' => __('Testimonial Quote Name size in px','themes'),
          'section' => 'customize_testimonial_section',
          'setting' => 'themes_customization[themes_testimonial_qoute_font_size]',
          'type'    => 'text'
        )
    );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_testimonial_boxbg_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_boxbg_color]', array(
            'label' => __('Testimonial Box Background Color', 'themes'),
            'section' => 'customize_testimonial_section',
            'settings' => 'themes_customization[themes_testimonial_boxbg_color]',
      )));

      $wp_customize->add_setting( 'themes_customization[themes_testimonial_boxhv_bgcolor]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_boxhv_bgcolor]', array(
            'label' => __('Hover Box Background Color', 'themes'),
            'section' => 'customize_testimonial_section',
            'settings' => 'themes_customization[themes_testimonial_boxhv_bgcolor]',
      )));

      $wp_customize->add_setting( 'themes_customization[themes_testimonial_box_text_hvcolor]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_box_text_hvcolor]', array(
            'label' => __('Hover Content Color', 'themes'),
            'section' => 'customize_testimonial_section',
            'settings' => 'themes_customization[themes_testimonial_box_text_hvcolor]',
      )));
    }
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[themes_testimonial_button_text_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_button_text_color]', array(
            'label' => __('Testimonial Button Text Color', 'themes'),
            'section' => 'customize_testimonial_section',
            'settings' => 'themes_customization[themes_testimonial_button_text_color]',
      )));

      $wp_customize->add_setting('themes_customization[themes_testimonial_button_text_font_family]',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'themes_sanitize_select_font'
      ));
      $wp_customize->add_control(
          'themes_customization[themes_testimonial_button_text_font_family]', array(
          'section'  => 'customize_testimonial_section',
          'label'    => __( 'Testimonial Button Text Font Family','themes'),
          'type'     => 'select',
          'choices'  => $font_array,
      ));
      $wp_customize->add_setting('themes_customization[themes_testimonial_button_text_font_size]', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
          )
      );
      $wp_customize->add_control('themes_customization[themes_testimonial_button_text_font_size]',array(
            'label' => __('Testimonial Button Text size in px','themes'),
            'section' => 'customize_testimonial_section',
            'setting' => 'themes_customization[themes_testimonial_button_text_font_size]',
            'type'    => 'text'
          )
      );
      $wp_customize->add_setting( 'themes_customization[themes_testimonial_but_bg_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_testimonial_but_bg_color]', array(
            'label' => __('Testimonial Button Background Color', 'themes'),
            'section' => 'customize_testimonial_section',
            'settings' => 'themes_customization[themes_testimonial_but_bg_color]',
      )));
    }
    //  =============================
    //  = Section for Our video =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-home-contact-partners.php';
    }  
    //  =============================
    //  = Section for Our Faq =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-our-faq.php';
    }  
    //  =============================
    //  = Section for Our Faq =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-live-chat.php';
    }   
    //  =============================
    //  = Section for Active Articals =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-active-articals.php';
    }    
    //  =============================
    //  = Section for Our video =
    //  =============================
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-software-company/section-our-video.php';
    }    
    //  =============================
    //  = Section for Pricing Plans =
    //  =============================
    $wp_customize->add_section( 'customize_pricing_plan_section', array(
      'title'        => __( 'Pricing Plans', 'themes' ),
      'description'  => __( 'Customize Records Section', 'themes' ),
      'priority'     => 12,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[pricing_plan_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[pricing_plan_enable]', array(
     'settings'    => 'themes_customization[pricing_plan_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_pricing_plan_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[pricing_plan_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_pricing_plan_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[pricing_plan_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[pricing_plan_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[pricing_plan_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_pricing_plan_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[pricing_plan_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[pricing_plan_title_image]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[pricing_plan_title_image]', array(
        'label'      => __( 'Title Image ','themes'),
        'section'    => 'customize_pricing_plan_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[pricing_plan_title_image]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    $wp_customize->add_setting( 'themes_customization[pricing_plan_left_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[pricing_plan_left_title]', array(
      'label'            => __( 'Small Left Title', 'themes' ),
      'section'          => 'customize_pricing_plan_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[pricing_plan_left_title]',
    ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[pricing_plan_right_title]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[pricing_plan_right_title]', array(
        'label'            => __( 'Small Right Title', 'themes' ),
        'section'          => 'customize_pricing_plan_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[pricing_plan_right_title]',
      ) );
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[pricing_plan_main_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[pricing_plan_main_text]', array(
        'label'            => __( 'Section Main Title', 'themes' ),
        'section'          => 'customize_pricing_plan_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[pricing_plan_main_text]',
      ) );
      $wp_customize->add_setting( 'themes_customization[pricing_plan_text]', array(
        'default'           => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
      ) );
      $wp_customize->add_control( 'themes_customization[pricing_plan_text]', array(
        'label'            => __( 'Section Text', 'themes' ),
        'section'          => 'customize_pricing_plan_section',
        'priority'         => Null,
        'settings'         => 'themes_customization[pricing_plan_text]',
      ) );
    }
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[pricing_plan_number]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[pricing_plan_number]',array(
          'label' => __('Number of Pricing Plans to show','themes'),
          'section'   => 'customize_pricing_plan_section',
          'type'      => 'number'
      ));
      $planscount =  isset( $this->themes_key['pricing_button_number'] )? $this->themes_key['pricing_button_number'] : 3;
      for($i=1; $i<=$planscount; $i++) {
          $wp_customize->add_setting( 'themes_customization[pricing_plan_main_title'.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_main_title'.$i.']', array(
            'label'            => __( 'Plan Main Title', 'themes' ).$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_main_title'.$i.']',
          ) );
          $wp_customize->add_setting( 'themes_customization[pricing_plan_para'.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_para'.$i.']', array(
            'label'            => __( 'Plan Text', 'themes' ).$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_para'.$i.']',
          ) );
          $wp_customize->add_setting('themes_customization[pricing_plan_features_number'.$i.']',array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_textarea_field',
          ));
          $wp_customize->add_control('themes_customization[pricing_plan_features_number'.$i.']',array(
              'label' => __('Number of Pricing Plans to show','themes').$i,
              'section'   => 'customize_pricing_plan_section',
              'type'      => 'number'
          ));
          $planscount =  isset( $this->themes_key['pricing_plan_features_number'.$i] )? $this->themes_key['pricing_plan_features_number'.$i] : 6;
          for($j=1; $j<=$planscount; $j++) {
            $wp_customize->add_setting( 'themes_customization[pricing_plan_features'.$i.$j.']', array(
              'default'           => '',
              'type'              => 'option',
              'capability'        => 'manage_options',
              'transport'         => 'postMessage',
              'sanitize_callback' => 'wp_kses_post'
            ) );
            $wp_customize->add_control( 'themes_customization[pricing_plan_features'.$i.$j.']', array(
              'label'            => __( 'Plan Main Title', 'themes' ).$i.$j,
              'section'          => 'customize_pricing_plan_section',
              'priority'         => Null,
              'settings'         => 'themes_customization[pricing_plan_features'.$i.$j.']',
            ) );
          }
          $wp_customize->add_setting(
            'themes_customization[pricing_plans_link_icon'.$i.']',
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
              'themes_customization[pricing_plans_link_icon'.$i.']',
              array(
                'settings'    => 'themes_customization[pricing_plans_link_icon'.$i.']',
                'section'   => 'customize_pricing_plan_section',
                'type'      => 'icon',
                'label'     => esc_html__( 'Box Icon', 'themes' ),
              )
            )
          );
          $wp_customize->add_setting('themes_customization[pricing_plan_btn_url'.$i.']',array(
              'default' => '',
              'sanitize_callback' => 'esc_url_raw'
          ));
          $wp_customize->add_control('themes_customization[pricing_plan_btn_url'.$i.']',array(
              'label' => __('Plan Button Url','themes').$i,
              'section' => 'customize_pricing_plan_section',
              'setting' => 'themes_customization[pricing_plan_btn_url'.$i.']',
              'type'    => 'url'
          ));
      }
    }
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[pricing_button_number]',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[pricing_button_number]',array(
          'label' => __('Number of Pricing Plans Tab to show','themes'),
          'section'   => 'customize_pricing_plan_section',
          'type'      => 'number'
      ));
      $tabcount =  isset( $this->themes_key['pricing_button_number'] )? $this->themes_key['pricing_button_number'] : 2;
      for($f=1; $f<=$tabcount; $f++) {
        $wp_customize->add_setting( 'themes_customization[pricing_plan_tab_text'.$f.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_tab_text'.$f.']', array(
          'label'            => __( 'Plan Tab Title', 'themes' ).$f,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_tab_text'.$f.']',
        ) );
        $wp_customize->add_setting('themes_customization[pricing_plan_number'.$f.']',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('themes_customization[pricing_plan_number'.$f.']',array(
            'label' => __('Number of Pricing Plans to show','themes').$f,
            'section'   => 'customize_pricing_plan_section',
            'type'      => 'number'
        ));
        $planscount =  isset( $this->themes_key['pricing_button_number'.$f] )? $this->themes_key['pricing_button_number'.$f] : 3;
        for($i=1; $i<=$planscount; $i++) {
          $wp_customize->add_setting( 'themes_customization[pricing_plan_main_title'.$f.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_main_title'.$f.$i.']', array(
            'label'            => __( 'Plan Main Title', 'themes' ).$f.$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_main_title'.$f.$i.']',
          ) );
          $wp_customize->add_setting( 'themes_customization[pricing_plan_para'.$f.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_para'.$f.$i.']', array(
            'label'            => __( 'Plan Text', 'themes' ).$f.$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_para'.$f.$i.']',
          ) );
          $wp_customize->add_setting( 'themes_customization[pricing_plan_price'.$f.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_price'.$f.$i.']', array(
            'label'            => __( 'Plan Price Text', 'themes' ).$f.$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_price'.$f.$i.']',
          ) );
          $wp_customize->add_setting( 'themes_customization[pricing_plan_link_title'.$f.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_link_title'.$f.$i.']', array(
            'label'            => __( 'Plan Link Text', 'themes' ).$f.$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_link_title'.$f.$i.']',
          ) );
          $wp_customize->add_setting( 'themes_customization[pricing_plan_icons_image'.$f.$i.']', array(
            'default'       =>  '' ,
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_image'
          ) );

          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[pricing_plan_icons_image'.$f.$i.']', array(
            'label'      => __( 'Plans Icons Image ','themes').$f.$i,
            'section'    => 'customize_pricing_plan_section',
            'priority'   => Null,
            'settings'   => 'themes_customization[pricing_plan_icons_image'.$f.$i.']',
            'button_labels' => array(
               'select'       => __( 'Select Image', 'themes' ),
          ) ) ) );
          $wp_customize->add_setting('themes_customization[pricing_plan_features_number'.$f.$i.']',array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_textarea_field',
          ));
          $wp_customize->add_control('themes_customization[pricing_plan_features_number'.$f.$i.']',array(
              'label' => __('Number of Pricing Plans to show','themes').$f.$i,
              'section'   => 'customize_pricing_plan_section',
              'type'      => 'number'
          ));
          $planscount =  isset( $this->themes_key['pricing_plan_features_number'.$f.$i] )? $this->themes_key['pricing_plan_features_number'.$f.$i] : 6;
          for($j=1; $j<=$planscount; $j++) {
            $wp_customize->add_setting( 'themes_customization[pricing_plan_features'.$f.$i.$j.']', array(
              'default'           => '',
              'type'              => 'option',
              'capability'        => 'manage_options',
              'transport'         => 'postMessage',
              'sanitize_callback' => 'wp_kses_post'
            ) );
            $wp_customize->add_control( 'themes_customization[pricing_plan_features'.$f.$i.$j.']', array(
              'label'            => __( 'Plan Main Title', 'themes' ).$f.$i.$j,
              'section'          => 'customize_pricing_plan_section',
              'priority'         => Null,
              'settings'         => 'themes_customization[pricing_plan_features'.$f.$i.$j.']',
            ) );
          }
          $wp_customize->add_setting( 'themes_customization[pricing_plan_btn_text'.$f.$i.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_btn_text'.$f.$i.']', array(
            'label'            => __( 'Plan Button Title', 'themes' ).$f.$i,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_btn_text'.$f.$i.']',
          ) );
          $wp_customize->add_setting('themes_customization[pricing_plan_btn_url'.$f.$i.']',array(
              'default' => '',
              'sanitize_callback' => 'esc_url_raw'
          ));
          $wp_customize->add_control('themes_customization[pricing_plan_btn_url'.$f.$i.']',array(
              'label' => __('Plan Button Url','themes').$f.$i,
              'section' => 'customize_pricing_plan_section',
              'setting' => 'themes_customization[pricing_plan_btn_url'.$f.$i.']',
              'type'    => 'url'
          ));
          $wp_customize->add_setting( 'themes_customization[plan_bottom_image'.$f.$i.']', array(
            'default'       =>  '' ,
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'themes_sanitize_image'
          ) );

          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[plan_bottom_image'.$f.$i.']', array(
            'label'      => __( 'Plans Bottom Image ','themes').$f.$i,
            'section'    => 'customize_pricing_plan_section',
            'priority'   => Null,
            'settings'   => 'themes_customization[plan_bottom_image'.$f.$i.']',
            'button_labels' => array(
               'select'       => __( 'Select Image', 'themes' ),
          ) ) ) );
        }
      }
    }
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting('themes_customization[pricing_plan_number]',array(
          'default'   => '',
          'sanitize_callback' => 'sanitize_textarea_field',
      ));
      $wp_customize->add_control('themes_customization[pricing_plan_number]',array(
          'label' => __('Number of Pricing Plans to show','themes'),
          'section'   => 'customize_pricing_plan_section',
          'type'      => 'number'
      ));
      $count =  isset( $this->themes_key['pricing_plan_number'] )? $this->themes_key['pricing_plan_number'] : 3;
      for($i=1; $i<=$count; $i++) {
        $wp_customize->add_setting( 'themes_customization[pricing_plan_color'.$i.']', array(
          'default'        => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_color'.$i.']', array(
          'label'      => __( 'Plan Background Color:', 'themes' ).$i,
          'section'    => 'customize_pricing_plan_section',
          'priority'   => 5,
          'settings'   => 'themes_customization[pricing_plan_color'.$i.']'
        ) ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_image'.$i.']', array(
          'default'       =>  '' ,
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'themes_sanitize_image'
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[pricing_plan_image'.$i.']', array(
          'label'      => __( 'Plan Background Image ','themes').$i,
          'section'    => 'customize_pricing_plan_section',
          'priority'   => Null,
          'settings'   => 'themes_customization[pricing_plan_image'.$i.']',
          'button_labels' => array(
             'select'       => __( 'Select Image', 'themes' ),
        ) ) ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_price'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_price'.$i.']', array(
          'label'            => __( 'Plan Price', 'themes' ).$i,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_price'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_caption'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_caption'.$i.']', array(
          'label'            => __( 'Plan Title', 'themes' ).$i,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_caption'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_link_title'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_link_title'.$i.']', array(
          'label'            => __( 'Plan Button Title', 'themes' ).$i,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_link_title'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_para'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_para'.$i.']', array(
          'label'            => __( 'Plan Box Text', 'themes' ).$i,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_para'.$i.']',
        ) );
        $wp_customize->add_setting( 'themes_customization[pricing_plan_main_title'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_main_title'.$i.']', array(
          'label'            => __( 'Plan Box Title', 'themes' ).$i,
          'section'          => 'customize_pricing_plan_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_main_title'.$i.']',
        ) );
        $wp_customize->add_setting('themes_customization[pricing_plan_features_number'.$i.']',array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('themes_customization[pricing_plan_features_number'.$i.']',array(
            'label' => __('No Of Features To Show','themes').$i,
            'section'   => 'customize_pricing_plan_section',
            'type'      => 'number'
        ));
        $pricing_fea =  isset( $this->themes_key['pricing_plan_features_number'] )? $this->themes_key['pricing_plan_features_number'] : 3;
        for($j=1; $j<=$pricing_fea; $j++) {
          $wp_customize->add_setting( 'themes_customization[pricing_plan_features'.$i.$j.']', array(
            'default'           => '',
            'type'              => 'option',
            'capability'        => 'manage_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post'
          ) );
          $wp_customize->add_control( 'themes_customization[pricing_plan_features'.$i.$j.']', array(
            'label'            => __( 'Plan Features', 'themes' ).$i.$j,
            'section'          => 'customize_pricing_plan_section',
            'priority'         => Null,
            'settings'         => 'themes_customization[pricing_plan_features'.$i.$j.']',
          ) );
        }
        $wp_customize->add_setting( 'themes_customization[pricing_plan_btn_text'.$i.']', array(
          'default'           => '',
          'type'              => 'option',
          'capability'        => 'manage_options',
          'transport'         => 'postMessage',
          'sanitize_callback' => 'wp_kses_post'
        ) );
        $wp_customize->add_control( 'themes_customization[pricing_plan_btn_text'.$i.']', array(
          'label'            => __( 'Plan Button Title', 'themes' ).$i,
          'section'          => 'customize_introduction_section',
          'priority'         => Null,
          'settings'         => 'themes_customization[pricing_plan_btn_text'.$i.']',
        ) );
        $wp_customize->add_setting('themes_customization[pricing_plan_btn_url'.$i.']',array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('themes_customization[pricing_plan_btn_url'.$i.']',array(
            'label' => __('Plan Button Url','themes').$i,
            'section' => 'customize_introduction_section',
            'setting' => 'themes_customization[pricing_plan_btn_url'.$i.']',
            'type'    => 'url'
        ));
      }
    }
    $wp_customize->add_setting( 'themes_customization[themes_pricing_plan_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_pricing_plan_title_color]', array(
      'label' => 'Section Title Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[themes_pricing_plan_title_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_pricing_plan_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[themes_pricing_plan_title_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Section Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[themes_pricing_plan_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[themes_pricing_plan_title_font_size]',array(
        'label' => __('Section Title Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[themes_pricing_plan_title_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[pricing_plan_small_title_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_small_title_color]', array(
      'label' => 'Section Small Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_small_title_color]',
    )));
    $wp_customize->add_setting('themes_customization[pricing_plan_small_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[pricing_plan_small_title_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Section Small Title Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[pricing_plan_small_title_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[pricing_plan_small_title_font_size]',array(
        'label' => __('Section Small Title Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[pricing_plan_small_title_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[pricing_plan_para_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_para_color]', array(
      'label' => 'Section Text Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_para_color]',
    )));
    $wp_customize->add_setting('themes_customization[pricing_plan_para_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[pricing_plan_para_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Section Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[pricing_plan_para_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[pricing_plan_para_font_size]',array(
        'label' => __('Section Text Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[pricing_plan_para_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[pricing_plan_tab_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_tab_color]', array(
      'label' => 'Plans Tab Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_tab_color]',
    )));
    $wp_customize->add_setting('themes_customization[pricing_plan_tab_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[pricing_plan_tab_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Plans Tab Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[pricing_plan_tab_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[pricing_plan_tab_font_size]',array(
        'label' => __('Plans Tab Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[pricing_plan_tab_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[pricing_plan_top_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_top_text_color]', array(
      'label' => 'Plans Top Text Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_top_text_color]',
    )));
    $wp_customize->add_setting('themes_customization[pricing_plan_top_text_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[pricing_plan_top_text_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Plans Top Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[pricing_plan_top_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[pricing_plan_top_text_font_size]',array(
        'label' => __('Plans Top Text Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[pricing_plan_top_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[pricing_plan_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_bg_color]', array(
      'label' => 'Plans background Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_bg_color]',
    )));

    $wp_customize->add_setting( 'themes_customization[plan_list_icons_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[plan_list_icons_color]', array(
      'label' => 'Plans List Icons Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[plan_list_icons_color]',
    )));
    $wp_customize->add_setting('themes_customization[plan_list_icons_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[plan_list_icons_font_size]',array(
        'label' => __('Plans List Icons Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[plan_list_icons_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[pricing_plan_list_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[pricing_plan_list_color]', array(
      'label' => 'Plans List Text Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[pricing_plan_list_color]',
    )));
    $wp_customize->add_setting('themes_customization[pricing_plan_list_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[pricing_plan_list_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Plans List Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[pricing_plan_list_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[pricing_plan_list_font_size]',array(
        'label' => __('Plans List Text Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[pricing_plan_list_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[plan_but_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[plan_but_text_color]', array(
      'label' => 'Plans Button Text Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[plan_but_text_color]',
    )));
    $wp_customize->add_setting('themes_customization[plan_but_text_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[plan_but_text_font_family]', array(
        'section'  => 'customize_pricing_plan_section',
        'label'    => __( 'Plans Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[plan_but_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[plan_but_text_font_size]',array(
        'label' => __('Plans Button Text Font Size in px','themes'),
        'section' => 'customize_pricing_plan_section',
        'setting' => 'themes_customization[plan_but_text_font_size]',
        'type'    => 'text'
      )
    ); 

    $wp_customize->add_setting( 'themes_customization[plan_but_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[plan_but_bg_color]', array(
      'label' => 'Plans Button Background Color',
      'section' => 'customize_pricing_plan_section',
      'settings' => 'themes_customization[plan_but_bg_color]',
    )));
    //  =============================
    //  = Section for Our Records    =
    //  =============================
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION') || defined('VW_KNOWLEDGE_BASE_PRO_VERSION') ){
      include CUSTOM_ROOT_PATH . 'sections/vw-software-company/section-our-recodes.php';
    }
    //  =============================
    //  = Section for Our Features  =
    //  =============================
    if(defined('VW_FLOWER_SHOP_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-flower-pro/section-instagram.php';
    }
    //  =============================
    //  = Section for Get In Touch  =
    //  =============================
    $wp_customize->add_section( 'customize_get_in_touch_section', array(
      'title'        => __( 'Get In Touch', 'themes' ),
      'description'  => __( 'Customize Get In Section', 'themes' ),
      'priority'     => 14,
      'panel'        => 'themes_panel',
    ) );
    $wp_customize->add_setting( 'themes_customization[radio_get_in_touch_enable]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[radio_get_in_touch_enable]', array(
     'settings'    => 'themes_customization[radio_get_in_touch_enable]',
      'label'       => __( 'Disable Section:', 'themes'),
      'section'     => 'customize_get_in_touch_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[get_in_touch_section_bgcolor]', array(
      'default'        => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color' // validates 3 or 6 digit HTML hex color code.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[get_in_touch_section_bgcolor]', array(
      'label'      => __( 'Background Color:', 'themes' ),
      'section'    => 'customize_get_in_touch_section',
      'priority'   => 5,
      'settings'   => 'themes_customization[get_in_touch_section_bgcolor]'
    ) ) );
    $wp_customize->add_setting( 'themes_customization[get_in_touch_section_bgimage]', array(
      'default'       =>  '' ,
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[get_in_touch_section_bgimage]', array(
      'label'      => __( 'Background Image ','themes'),
      'section'    => 'customize_get_in_touch_section',
      'priority'   => Null,
      'settings'   => 'themes_customization[get_in_touch_section_bgimage]',
      'button_labels' => array(
         'select'       => __( 'Select Image', 'themes' ),
    ) ) ) );
    if(defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){
      $wp_customize->add_setting( 'themes_customization[get_in_touch_left_bgimage]', array(
        'default'       =>  '' ,
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'themes_sanitize_image'
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themes_customization[get_in_touch_left_bgimage]', array(
        'label'      => __( 'Right Box Background Image ','themes'),
        'section'    => 'customize_get_in_touch_section',
        'priority'   => Null,
        'settings'   => 'themes_customization[get_in_touch_left_bgimage]',
        'button_labels' => array(
           'select'       => __( 'Select Image', 'themes' ),
      ) ) ) );
    }
    $wp_customize->add_setting( 'themes_customization[get_in_touch_main_title]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[get_in_touch_main_title]', array(
      'label'            => __( 'Section Main Heading', 'themes' ),
      'section'          => 'customize_get_in_touch_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[get_in_touch_main_title]',
    ) );
    $wp_customize->add_setting( 'themes_customization[get_in_touch_para]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[get_in_touch_para]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'customize_get_in_touch_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[get_in_touch_para]',
    ) );
    $wp_customize->add_setting( 'themes_customization[get_in_touch_btn_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );
    $wp_customize->add_control( 'themes_customization[get_in_touch_btn_text]', array(
      'label'            => __( 'Section Button Title', 'themes' ),
      'section'          => 'customize_get_in_touch_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[get_in_touch_btn_text]',
    ) );
    $wp_customize->add_setting('themes_customization[get_in_touch_btn_url]',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('themes_customization[get_in_touch_btn_url]',array(
        'label' => __('Section Button Url','themes'),
        'section' => 'customize_get_in_touch_section',
        'setting' => 'themes_customization[get_in_touch_btn_url]',
        'type'    => 'url'
    ));
    $wp_customize->add_setting( 'themes_customization[get_in_touch_main_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[get_in_touch_main_text_color]', array(
      'label' => 'Main Text Color',
      'section' => 'customize_get_in_touch_section',
      'settings' => 'themes_customization[get_in_touch_main_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[get_in_touch_main_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[get_in_touch_main_text_fontfamily]', array(
        'section'  => 'customize_get_in_touch_section',
        'label'    => __( 'Main Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[get_in_touch_main_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[get_in_touch_main_text_font_size]',array(
        'label' => __('Main Text Font Size in px','themes'),
        'section' => 'customize_get_in_touch_section',
        'setting' => 'themes_customization[get_in_touch_main_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[get_in_touch_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[get_in_touch_text_color]', array(
      'label' => 'Text Color',
      'section' => 'customize_get_in_touch_section',
      'settings' => 'themes_customization[get_in_touch_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[get_in_touch_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[get_in_touch_text_fontfamily]', array(
        'section'  => 'customize_get_in_touch_section',
        'label'    => __( 'Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[get_in_touch_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[get_in_touch_text_font_size]',array(
        'label' => __('Text Font Size in px','themes'),
        'section' => 'customize_get_in_touch_section',
        'setting' => 'themes_customization[get_in_touch_text_font_size]',
        'type'    => 'text'
      )
    ); 
    $wp_customize->add_setting( 'themes_customization[get_in_touch_button_bg_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[get_in_touch_button_bg_color]', array(
      'label' => 'Button Background Color',
      'section' => 'customize_get_in_touch_section',
      'settings' => 'themes_customization[get_in_touch_button_bg_color]',
    ))); 
    $wp_customize->add_setting( 'themes_customization[get_in_touch_button_text_color]', array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[get_in_touch_button_text_color]', array(
      'label' => 'Button Text Color',
      'section' => 'customize_get_in_touch_section',
      'settings' => 'themes_customization[get_in_touch_button_text_color]',
    )));  

    $wp_customize->add_setting('themes_customization[get_in_touch_button_text_fontfamily]',array(
      'default' => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
     ));
    $wp_customize->add_control(
        'themes_customization[get_in_touch_button_text_fontfamily]', array(
        'section'  => 'customize_get_in_touch_section',
        'label'    => __( 'Button Text Fonts','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting('themes_customization[get_in_touch_button_text_font_size]',array(
        'default' => '',
        'type'              => 'option',
        'capability'        => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control('themes_customization[get_in_touch_button_text_font_size]',array(
        'label' => __('Button Text Font Size in px','themes'),
        'section' => 'customize_get_in_touch_section',
        'setting' => 'themes_customization[get_in_touch_button_text_font_size]',
        'type'    => 'text'
      )
    ); 
    //  =============================
    //  = Section for Latest News  =
    //  =============================
    if(defined('VW_KNOWLEDGE_BASE_PRO_VERSION')){
      include CUSTOM_ROOT_PATH . 'sections/vw-knowledge-base-pro/section-latest-news.php';
    }
    //  =============================
    //  = Section for Blog Page   =
    //  =============================
    $wp_customize->add_section( 'customize_blog_category_section', array(
      'title'        => __( 'Blog Page', 'themes' ),
      'description'  => __( 'Customize Blog Page', 'themes' ),
      'priority'     => 15,
      'panel'        => 'themes_panel',
    ) );
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
      if($i==0){
        $default = $category->slug;
        $i++;
      }
      $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('themes_customization[category_setting]',array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[category_setting]',array(
      'type'    => 'select',
      'choices' => $cats,
      'label' => __('Blog page (select category to show selected post)','themes'),
      'section' => 'customize_blog_category_section',
    )); 
    $wp_customize->add_setting( 'themes_customization[toggle_auther]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[toggle_auther]', array(
     'settings'    => 'themes_customization[toggle_auther]',
      'label'       => __( 'Author Name:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[toggle_comments]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[toggle_comments]', array(
     'settings'    => 'themes_customization[toggle_comments]',
      'label'       => __( 'Comment:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[toggle_date]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[toggle_date]', array(
     'settings'    => 'themes_customization[toggle_date]',
      'label'       => __( 'Hide Date:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[toggle_sharing]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[toggle_sharing]', array(
     'settings'    => 'themes_customization[toggle_sharing]',
      'label'       => __( 'Hide Social Media:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[products_shop_page_sidebar]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[products_shop_page_sidebar]', array(
     'settings'    => 'themes_customization[products_shop_page_sidebar]',
      'label'       => __( 'Hide Shop Page Sidebar:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[products_single_page_sidebar]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[products_single_page_sidebar]', array(
     'settings'    => 'themes_customization[products_single_page_sidebar]',
      'label'       => __( 'Hide Product Page Sidebar:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[post_category]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[post_category]', array(
     'settings'    => 'themes_customization[post_category]',
      'label'       => __( 'Show or Hide Category:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );
    $wp_customize->add_setting( 'themes_customization[post_sidebar]', array(
      'default'           => false,
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_checkbox'
    ) );

    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[post_sidebar]', array(
     'settings'    => 'themes_customization[post_sidebar]',
      'label'       => __( 'Single Post Sidebar:', 'themes'),
      'section'     => 'customize_blog_category_section',
     'priority'   => 2,
      'type'        => 'ios', // light, ios, flat
    ) ) );

    //Page Title layout
    $wp_customize->add_setting('themes_page_title_option',array(
        'default' => __('Left','themes'),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Themes_Setting_Radio_Control($wp_customize, 'themes_page_title_option', array(
          'type' => 'select',
          'label' => __('Page Title Layouts','themes'),
          'section' => 'customize_blog_category_section',
          'choices' => array(
              'Left' => get_template_directory_uri().'/assets/images/header-layout1.png',
              'Center' => get_template_directory_uri().'/assets/images/header-layout2.png',
              'Right' => get_template_directory_uri().'/assets/images/header-layout3.png',
    ))));

    //Blog layout
    $wp_customize->add_setting('themes_blog_option',array(
      'default' => __('two_col','themes'),
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('themes_blog_option',array(
      'type' => 'select',
      'label' => __('Post Layout','themes'),
      'description' => __('Here you can change the Posts layout for Blog Pages. ','themes'),
      'section' => 'customize_blog_category_section',
      'choices' => array(
          'one_col' => __('One Columns','themes'),
          'two_col' => __('Two Columns','themes')
      ),  
    ) ); 
    $wp_customize->add_setting( 'themes_blog_featured_image_border_radius', array(
      'default'              => "",
      'type'                 => 'theme_mod',
      'transport'        => 'refresh',
      'sanitize_callback'    => 'absint',
      'sanitize_js_callback' => 'absint',
  ) );
  $wp_customize->add_control( 'themes_blog_featured_image_border_radius', array(
      'label'       => esc_html__( 'Featured Image Border Radius','themes' ),
      'section'     => 'customize_blog_category_section',
      'type'        => 'range',
      'input_attrs' => array(
        'step'             => 1,
        'min'              => 1,
        'max'              => 50,
  ),) );
  $wp_customize->add_setting('themes_blog_featured_image_box_shadow',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_blog_featured_image_box_shadow',array(
        'label' => __('Featured Image Box Shadow','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'text'
    )); 

    $wp_customize->add_setting('themes_blog_category_prev_title',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_blog_category_prev_title',array(
        'label' => __('Previous Title','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'text'
    ));

    $wp_customize->add_setting('themes_blog_category_next_title',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_blog_category_next_title',array(
        'label' => __('Next Title','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'text'
    ));
  $wp_customize->add_setting( 'themes_products_spinner_enable',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'themes_switch_sanitization'
  ));
  $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_products_spinner_enable',
     array(
        'label' => esc_html__( 'Spinner Enable/Disable', 'themes' ),
        'section' => 'customize_blog_category_section'
  )));
  $wp_customize->add_setting( 'themes_products_spinner_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_products_spinner_bgcolor', array(
    'label' => __('Spinner Background Color', 'themes'),
    'section' => 'customize_blog_category_section',
    'settings' => 'themes_products_spinner_bgcolor',
  )));
   /* --------- Spinner Opacity  ----------- */

  $wp_customize->add_setting('themes_spinner_opacity_color',array(
      'default'              => '1',
      'sanitize_callback' => 'themes_sanitize_select_font'
  ));

  $wp_customize->add_control( 'themes_spinner_opacity_color', array(
    'label'       => esc_html__( 'Spinner  Opacity Color','themes' ),
    'section'     => 'customize_blog_category_section',
    'type'        => 'select',
    'settings'    => 'themes_spinner_opacity_color',
    'choices' => array(
        '0' =>  esc_attr('0','themes'),
        '0.1' =>  esc_attr('0.1','themes'),
        '0.2' =>  esc_attr('0.2','themes'),
        '0.3' =>  esc_attr('0.3','themes'),
        '0.4' =>  esc_attr('0.4','themes'),
        '0.5' =>  esc_attr('0.5','themes'),
        '0.6' =>  esc_attr('0.6','themes'),
        '0.7' =>  esc_attr('0.7','themes'),
        '0.8' =>  esc_attr('0.8','themes'),
        '0.9' =>  esc_attr('0.9','themes'),
        '1' =>  esc_attr('1','themes')
    ),
  ));
  $wp_customize->add_setting( 'themes_hide_show_scroll',array(
      'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'themes_switch_sanitization'
    ));  
  $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_hide_show_scroll',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','themes' ),
      'section' => 'customize_blog_category_section'
  )));
$wp_customize->add_setting( 'themes_general_scroll_top_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_general_scroll_top_bgcolor', array(
    'label' => __('Scroll Top Background Color', 'themes'),
    'section' => 'customize_blog_category_section',
    'settings' => 'themes_general_scroll_top_bgcolor',
  )));
  $wp_customize->add_setting( 'themes_general_scroll_top_hover_bgcolor', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_general_scroll_top_hover_bgcolor', array(
    'label' => __('Scroll Top Hover Background Color', 'themes'),
    'section' => 'customize_blog_category_section',
    'settings' => 'themes_general_scroll_top_hover_bgcolor',
  )));
  $wp_customize->add_setting('themes_scroll_to_top_icon',array(
  'default' => 'fas fa-angle-up',
  'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new themes_Fontawesome_Icon_Chooser(
      $wp_customize,'themes_scroll_to_top_icon',array(
  'label' => __('Add Scroll to Top Icon','themes'),
  'transport' => 'refresh',
  'section' => 'customize_blog_category_section',
  'setting' => 'themes_scroll_to_top_icon',
  'type'    => 'icon'
  )));
  $wp_customize->add_setting('themes_scroll_top_alignment',array(
        'default' => __('Right','themes'),
        'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control(new Themes_Setting_Radio_Control($wp_customize, 'themes_scroll_top_alignment', array(
    'type' => 'select',
    'label' => __('Scroll To Top','themes'),
    'section' => 'customize_blog_category_section',
    'settings' => 'themes_scroll_top_alignment',
    'choices' => array(
        'Left' => get_template_directory_uri().'/assets/images/header-layout1.png',
        'Center' => get_template_directory_uri().'/assets/images/header-layout2.png',
        'Right' => get_template_directory_uri().'/assets/images/header-layout3.png'
    ))));
  $wp_customize->add_setting('themes_site_frame_width',array(
      'default'   => '',
      'sanitize_callback' => 'sanitize_textarea_field',
  ));
  $wp_customize->add_control('themes_site_frame_width',array(
      'label' => __('Frame Width','themes'),
      'section'   => 'customize_blog_category_section',
      'type'      => 'number'
  ));

  $wp_customize->add_setting('themes_site_frame_type',array(
        'default' => __('','themes'),
        'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('themes_site_frame_type',array(
        'type' => 'select',
        'label' => __('Frame Type','themes'),
        'section' => 'customize_blog_category_section',
        'choices' => array(
            '' => __('','themes'),
            'solid' => __('Solid','themes'),
            'dashed' => __('Dashed','themes'),
            'double' => __('Double','themes'),
            'groove' => __('Groove','themes'),
            'ridge' => __('Ridge','themes'),
            'inset' => __('Inset','themes')
        ),  
   ) );

  $wp_customize->add_setting( 'themes_site_frame_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_site_frame_color', array(
      'label' => __('Frame Color', 'themes'),
      'section' => 'customize_blog_category_section',
      'settings' => 'themes_site_frame_color',
  )));
  // ------------- Button Settings ----------


    $wp_customize->add_setting('themes_button_top_bottom_padding',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_button_top_bottom_padding',array(
        'label' => __('Button Padding Top and Bottom','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('themes_button_left_right_padding',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_button_left_right_padding',array(
        'label' => __('Button Padding Left and Right','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('themes_button_setting_radius',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_button_setting_radius',array(
        'label' => __('Button Border Radius','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));
    // ------------- Search Padding Settings ----------


    $wp_customize->add_setting('themes_Search_top_bottom_padding',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_Search_top_bottom_padding',array(
        'label' => __('Search Padding Top and Bottom','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('themes_Search_left_right_padding',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_Search_left_right_padding',array(
        'label' => __('Search Padding Left and Right','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('themes_Search_setting_radius',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_Search_setting_radius',array(
        'label' => __('Search Border Radius','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    // ----------- Social Icon Setting -------------

    $wp_customize->add_setting('themes_social_icon_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_social_icon_font_size',array(
        'label' => __('Social Icon Font Size','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('themes_social_icon_border_radius',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_social_icon_border_radius',array(
        'label' => __('Social Icon Border Radius','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));

    // ------------ Breadcrumb -----------

    
    $wp_customize->add_setting( 'themes_site_breadcrumb_enable',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'themes_switch_sanitization'
    ));  
    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_site_breadcrumb_enable',array(
          'label' => esc_html__( 'Show / Hide Breadcrumb','themes' ),
          'section' => 'customize_blog_category_section'
    )));

    $wp_customize->add_setting( 'themes_site_breadcrumb_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_site_breadcrumb_color', array(
        'label' => __('Breadcrumb Color', 'themes'),
        'section' => 'customize_blog_category_section',
        'settings' => 'themes_site_breadcrumb_color',
    )));

    $wp_customize->add_setting('themes_site_breadcrumb_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_site_breadcrumb_font_size',array(
        'label' => __('Breadcrumb Font Size','themes'),
        'section'   => 'customize_blog_category_section',
        'type'      => 'number'
    ));
    $wp_customize->add_setting('themes_post_content_blog',array(
        'default' => __('Excerpt Content','themes'),
          'sanitize_callback' => 'themes_sanitize_select_font'
  ));
  $wp_customize->add_control('themes_post_content_blog',array(
          'type' => 'radio',
          'label' => __('Post Content Type','themes'),
          'section' => 'customize_blog_category_section',
          'choices' => array(
              'No Content' => __('No Content','themes'),
              'Full Content' => __('Full Content','themes'),
              'Excerpt Content' => __('Excerpt Content','themes'),
          ),
  ) );
  $wp_customize->add_setting( 'themes_excerpt_length', array(
      'default'              => 25,
      'sanitize_callback' => 'sanitize_text_field'
  ) );
  $wp_customize->add_control( 'themes_excerpt_length', array(
      'label' => esc_html__( 'Post Excerpt Length','themes' ),
      'section'  => 'customize_blog_category_section',
      'type'  => 'number',
      'settings' => 'themes_excerpt_length',
      'input_attrs' => array(
        'step'             => 1,
        'min'              => 0,
        'max'              => 50,
      ),
  ) );

  $wp_customize->add_setting( 'themes_button_excerpt_suffix', array(
      'default'   => '[...]',
      'sanitize_callback' => 'sanitize_text_field'
  ) );
  $wp_customize->add_control( 'themes_button_excerpt_suffix', array(
      'label'       => esc_html__( 'Excerpt Suffix','themes' ),
      'section'     => 'customize_blog_category_section',
      'type'        => 'text',
      'settings' => 'themes_button_excerpt_suffix'
  ) );
  $wp_customize->add_setting( 'themes_related_posts',array(
      'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'themes_switch_sanitization'
    ));  
    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_related_posts',array(
        'label' => esc_html__( 'Enable / Disable Related Posts','themes' ),
        'section' => 'customize_blog_category_section'
    )));

    $wp_customize->add_setting('themes_related_posts_title',array(
       'default' => 'Related Posts',
       'sanitize_callback'  => 'sanitize_text_field'
    ));
    $wp_customize->add_control('themes_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','themes'),
       'section' => 'customize_blog_category_section'
    ));

    $wp_customize->add_setting( 'themes_related_post_count', array(
      'default' => 3,
      'sanitize_callback' => 'sanitize_text_field'
  ) );
  $wp_customize->add_control( 'themes_related_post_count', array(
      'label' => esc_html__( 'Related Posts Count','themes' ),
      'section' => 'customize_blog_category_section',
      'type' => 'number',
      'settings' => 'themes_related_post_count',
      'input_attrs' => array(
        'step'             => 1,
        'min'              => 0,
        'max'              => 6,
    ),) );

  /*------------------- Footer Sections ----------------------*/
    $wp_customize->add_section('themes_footer_widget_section',array(
        'title' => __('Footer Widgets','themes'),
        'description'   => __('Edit footer Widgets sections','themes'),
        'panel' => 'themes_panel',
    ));
    $wp_customize->add_setting('themes_footer_widgets_enable',
    array(
        'default' => 'Enable',
        'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control('themes_footer_widgets_enable',
    array(
        'type' => 'radio',
        'label' => 'Do you want this section',
        'section' => 'themes_footer_widget_section',
        'choices' => array(
            'Enable' => __('Enable', 'themes'),
            'Disable' => __('Disable', 'themes')
        ),
    ));

    $wp_customize->selective_refresh->add_partial( 'themes_footer_widgets_enable', array(
      'selector' => '#footer .container',
      'render_callback' => 'themes_customize_partial_themes_footer_widgets_enable',
    ) );

    // add color picker setting
    $wp_customize->add_setting( 'themes_footer_widget_bgcolor', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_footer_widget_bgcolor', array(
        'label' => __('Background Color', 'themes'),
        'description'   => __('Either add background color or background image, if you add both background color will be top most priority','themes'),
        'section' => 'themes_footer_widget_section',
        'settings' => 'themes_footer_widget_bgcolor',
    )));
    $wp_customize->add_setting('themes_footer_widget_section_bg_image',array(
      'default'   => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'themes_footer_widget_section_bg_image',array(
          'label' => __('Background Image ','themes'),
          'description' => __('Dimension (1600px * 700px)','themes'),
          'section' => 'themes_footer_widget_section',
          'settings' => 'themes_footer_widget_section_bg_image'
    )));

    $wp_customize->add_setting('themes_customization[themes_footer_widget_heading_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_widget_heading_color]', array(
        'label' => __('Footer Heading Color', 'themes'),
        'section' => 'themes_footer_widget_section',
        'settings' => 'themes_customization[themes_footer_widget_heading_color]',
    )));
    
    $wp_customize->add_setting('themes_customization[themes_footer_widget_heading_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_footer_widget_heading_font_family]', array(
        'section'  => 'themes_footer_widget_section',
        'label'    => __( 'Footer Heading Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_footer_widget_heading_font_size]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_widget_heading_font_size]', array(
        'label' => __('Footer Heading Font Size in px', 'themes'),
        'section' => 'themes_footer_widget_section',
        'settings' => 'themes_customization[themes_footer_widget_heading_font_size]',
        'type'  => 'text',
    )));
    $wp_customize->add_setting('themes_customization[themes_footer_widget_content_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_widget_content_color]', array(
        'label' => __('Footer Content Color', 'themes'),
        'section' => 'themes_footer_widget_section',
        'settings' => 'themes_customization[themes_footer_widget_content_color]',
    )));
    
    $wp_customize->add_setting('themes_customization[themes_footer_widget_content_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_footer_widget_content_font_family]', array(
        'section'  => 'themes_footer_widget_section',
        'label'    => __( 'Footer Content Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_footer_widget_content_font_size]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_widget_content_font_size]', array(
      'label' => __('Footer Content Font Size in px', 'themes'),
      'section' => 'themes_footer_widget_section',
      'settings' => 'themes_customization[themes_footer_widget_content_font_size]',
      'type'  => 'text',
    )));
    /*----------------- Footer Copyright --------------*/

    $wp_customize->add_section('themes_footer_section',array(
        'title' => __('Footer Text','themes'),
        'description'   => __('Add some text for footer like copyright etc.','themes'),
        'priority'  => null,
        'panel' => 'themes_panel',
    ));

    $wp_customize->add_setting('themes_footer_section_enable',
    array(
        'default' => 'Enable',
        'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control('themes_footer_section_enable',
    array(
        'type' => 'radio',
        'label' => 'Do you want this section',
        'section' => 'themes_footer_section',
        'choices' => array(
            'Enable' => __('Enable', 'themes'),
            'Disable' => __('Disable', 'themes')
        ),
    ));
    $wp_customize->selective_refresh->add_partial( 'themes_footer_section_enable', array(
      'selector' => '.copyright .container',
      'render_callback' => 'themes_customize_partial_themes_footer_section_enable',
    ) );
    $wp_customize->add_setting('themes_customization[themes_footer_section_bg_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_section_bg_color]',array(
        'label' => __('Background Color', 'themes'),
        'description'   => __('Either add background color or background image, if you add both background color will be top most priority','themes'),
        'section' => 'themes_footer_section',
        'settings' => 'themes_customization[themes_footer_section_bg_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_footer_section_bg_image]',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'themes_customization[themes_footer_section_bg_image]',array(
        'label' => __('Background image ','themes'),
        'description' => __('Dimension (1600px * 200px)','themes'),
        'section' => 'themes_footer_section',
        'settings' => 'themes_customization[themes_footer_section_bg_image]'
    )));

    $wp_customize->add_setting('themes_customization[themes_footer_copy_year]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[themes_footer_copy_year]',array(
        'label' => __('Copyright Text Year','themes'),
        'section'   => 'themes_customization[themes_footer_section',
        'type'      => 'textarea'
    ));
     $wp_customize->add_setting('themes_customization[themes_footer_copy_themename]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[themes_footer_copy_themename]',array(
        'label' => __('Copyright Theme Name Text ','themes'),
        'section'   => 'themes_footer_section',
        'type'      => 'textarea'
    ));
    $wp_customize->add_setting('themes_customization[themes_footer_copy]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('themes_customization[themes_footer_copy]',array(
        'label' => __('Copyright Text','themes'),
        'section'   => 'themes_footer_section',
        'type'      => 'textarea'
    ));
    $wp_customize->add_setting('themes_customization[themes_footer_copy_text_alignment]',array(
          'default' => __('Center','themes'),
          'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(new Themes_Setting_Radio_Control($wp_customize, 'themes_customization[themes_footer_copy_text_alignment]', array(
      'type' => 'select',
      'label' => __('Copyright Text Alignment','themes'),
      'section' => 'themes_footer_section',
      'settings' => 'themes_customization[themes_footer_copy_text_alignment]',
      'choices' => array(
          'Left' => get_template_directory_uri().'/assets/images/header-layout1.png',
          'Center' => get_template_directory_uri().'/assets/images/header-layout2.png',
          'Right' => get_template_directory_uri().'/assets/images/header-layout3.png'
      ))));
    $wp_customize->selective_refresh->add_partial( 'themes_footer_copy', array(
      'selector' => '.copy-text',
      'render_callback' => 'themes_customize_partial_themes_footer_copy',
    ) );

    $wp_customize->add_setting( 'themes_customization[themes_footer_copy_content_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_copy_content_color]', array(
        'label' => __('Content Color', 'themes'),
        'section' => 'themes_footer_section',
        'settings' => 'themes_customization[themes_footer_copy_content_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_footer_copy_content_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_footer_copy_content_font_family]', array(
        'section'  => 'themes_footer_section',
        'label'    => __( 'Content Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_footer_copy_content_font_size]', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_copy_content_font_size]', array(
        'label' => __('Footer Content Font Size in px', 'themes'),
        'section' => 'themes_footer_section',
        'settings' => 'themes_customization[themes_footer_copy_content_font_size]',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_footer_copy_border_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_footer_copy_border_color]', array(
        'label' => __('Border Top Color', 'themes'),
        'section' => 'themes_footer_section',
        'settings' => 'themes_customization[themes_footer_copy_border_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_hide_show_credit_link]',
     array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'themes_switch_sanitization'
     ));
   
    $wp_customize->add_control( new Themes_Setting_Radio_Control( $wp_customize, 'themes_customization[themes_hide_show_credit_link]',
       array(
          'label' => esc_html__( 'Show or Hide Credit Link', 'themes' ),
          'section' => 'themes_footer_section'
    )));
    /*---------------Contact Page section-------------*/

    $wp_customize->add_section('themes_contact_page_section',array(
        'title' => __('Contact','themes'),
        'description'   => __('Add contact page settings here).','themes'),
        'priority'  => null,
        'panel' => 'themes_panel',
    ));
    $wp_customize->add_setting('themes_customization[contactpage_form_title]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[contactpage_form_title]',array(
        'label' => __('Contact Form Title','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contactpage_form_title]',
        'type'  => 'text'
    ));
    $wp_customize->selective_refresh->add_partial( 'contactpage_form_title', array(
        'selector' => '.contact-box .container',
        'render_callback' => 'themes_customize_partial_contactpage_form_title',
    ));
    $wp_customize->add_control( 'themes_customization[contactpage_form_text]', array(
      'label'            => __( 'Section Text', 'themes' ),
      'section'          => 'themes_contact_page_section',
      'priority'         => Null,
      'settings'         => 'themes_customization[contactpage_form_text]',
    ) );
    $wp_customize->add_setting( 'themes_customization[contactpage_form_text]', array(
      'default'           => '',
      'type'              => 'option',
      'capability'        => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'wp_kses_post'
    ) );

    $wp_customize->add_setting('themes_customization[contact_page_address_longitude]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('themes_customization[contact_page_address_longitude]',array(
        'label' => __('Longitude','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_address_longitude]',
        'type'=>'text'
    ));
    $wp_customize->add_setting('themes_customization[contact_page_address_latitude]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('themes_customization[contact_page_address_latitude]',array(
        'label' => __('Latitude','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_address_latitude]',
        'type'=>'text'
    ));
    $wp_customize->add_setting(
      'themes_customization[contact_page_sec_email_icon]',
      array(
        'default'     => 'far fa-envelope-open',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control(
      new themes_Fontawesome_Icon_Chooser(
        $wp_customize,
        'themes_customization[contact_page_sec_email_icon]',
        array(
          'settings'    => 'themes_customization[contact_page_sec_email_icon]',
          'section'   => 'themes_contact_page_section',
          'type'      => 'icon',
          'label'     => esc_html__( 'Choose Email Icon', 'themes' ),
        )
      )
    );
    $wp_customize->add_setting('themes_customization[contact_page_sec_email]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[contact_page_sec_email]',array(
        'label' => __('Email Title','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_sec_email]',
        'type'  => 'text'
    ));
    $wp_customize->add_setting(
      'themes_customization[contact_page_sec_address_icon]',
      array(
        'default'     => 'fas fa-map-marker-alt',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );
    $wp_customize->add_control(
      new themes_Fontawesome_Icon_Chooser(
        $wp_customize,
        'themes_customization[contact_page_sec_address_icon]',
        array(
          'settings'    => 'themes_customization[contact_page_sec_address_icon]',
          'section'   => 'themes_contact_page_section',
          'type'      => 'icon',
          'label'     => esc_html__( 'Choose Address Icon', 'themes' ),
        )
      )
    );
    $wp_customize->add_setting('themes_customization[contact_page_sec_address]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[contact_page_sec_address]',array(
        'label' => __('Address Title','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_sec_address]',
        'type'  => 'text'
    ));
    $wp_customize->add_setting('themes_customization[contact_page_sec_phone_icon]',
      array(
        'default'     => 'fas fa-phone',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new themes_Fontawesome_Icon_Chooser($wp_customize,'themes_customization[contact_page_sec_phone_icon]',
        array(
          'settings'    => 'themes_contact_page_section_phone_icon',
          'section'   => 'themes_customization[contact_page_sec_phone_icon]',
          'type'      => 'icon',
          'label'     => esc_html__( 'Choose Phone Icon', 'themes' ),
    )));
    $wp_customize->add_setting('themes_customization[contact_page_sec_phone]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[contact_page_sec_phone]',array(
        'label' => __('Phone Title','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_sec_phone]',
        'type'  => 'text'
    ));
    $wp_customize->add_setting('themes_customization[contact_page_right_form_title]',array(
        'default'   => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[contact_page_right_form_title]',array(
        'label' => __('Contact Form Title','themes'),
        'section' => 'themes_contact_page_section',
        'setting'   => 'themes_customization[contact_page_right_form_title]',
        'type'  => 'text'
    ));

    $wp_customize->add_setting( 'themes_customization[themes_contact_page_heading_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    // add color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_heading_color]', array(
        'label' => __('Section Heading Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_heading_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_contact_page_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_heading_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Section Heading Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_heading_font_size]', array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_heading_font_size]', array(
      'label' => __('Heading Font Size in px', 'themes'),
      'section' => 'themes_contact_page_section',
      'settings' => 'themes_customization[themes_contact_page_heading_font_size]',
      'type'  => 'text',
  )));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_icon_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));   
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_icon_color]', array(
        'label' => __('Contact Icon Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_icon_color]',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_right_heading_color]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    // add color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_right_heading_color]', array(
        'label' => __('Contact Form Title Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_right_heading_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_contact_page_right_heading_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_right_heading_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Contact Right Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_right_heading_font_size]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_right_heading_font_size]', array(
        'label' => __('Contact Right Title Font Size in px', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_right_heading_font_size]',
        'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    // add color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_text_color]', array(
        'label' => __('Contact Text Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_text_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_contact_page_text_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_text_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Contact Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
   $wp_customize->add_setting( 'themes_customization[themes_contact_page_text_font_size]', array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_text_font_size]', array(
      'label' => __('Contact Text Font Size in px', 'themes'),
      'section' => 'themes_contact_page_section',
      'settings' => 'themes_customization[themes_contact_page_text_font_size]',
      'type'  => 'text',
  )));
    // add color picker control
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_form_title_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));   
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_form_title_color]', array(
        'label' => __('Contact Form Title Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_form_title_color]',
    )));

    $wp_customize->add_setting('themes_customization[themes_contact_page_contacts_form_title_font_family]',array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_contacts_form_title_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Contact Form Title Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
   $wp_customize->add_setting( 'themes_customization[themes_contact_page_contacts_form_title_font_size]', array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_contacts_form_title_font_size]', array(
      'label' => __('Contact Form Title Font Size in px', 'themes'),
      'section' => 'themes_contact_page_section',
      'settings' => 'themes_customization[themes_contact_page_contacts_form_title_font_size]',
      'type'  => 'text',
    )));
 
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_form_text_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));   
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_form_text_color]', array(
        'label' => __('Contact Form Text Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_form_text_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_contact_page_contacts_form_text_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_contacts_form_text_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Contact Form Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_contacts_form_text_font_size]', array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_contacts_form_text_font_size]', array(
      'label' => __('Contact Form Text Font Size in px', 'themes'),
      'section' => 'themes_contact_page_section',
      'settings' => 'themes_customization[themes_contact_page_contacts_form_text_font_size]',
      'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_form_button_color]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));   
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_form_button_color]', array(
        'label' => __('Contact Form Button Text Color', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_form_button_color]',
    )));
    $wp_customize->add_setting('themes_customization[themes_contact_page_contacts_form_button_font_family]',array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'themes_sanitize_select_font'
    ));
    $wp_customize->add_control(
        'themes_customization[themes_contact_page_contacts_form_button_font_family]', array(
        'section'  => 'themes_contact_page_section',
        'label'    => __( 'Contact Form Button Text Font Family','themes'),
        'type'     => 'select',
        'choices'  => $font_array,
    ));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_contacts_form_button_font_size]', array(
      'default' => '',
      'type'              => 'option',
      'capability'         => 'manage_options',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_contacts_form_button_font_size]', array(
      'label' => __('Contact Form Button Text Font Size in px', 'themes'),
      'section' => 'themes_contact_page_section',
      'settings' => 'themes_customization[themes_contact_page_contacts_form_button_font_size]',
      'type'  => 'text',
    )));
    $wp_customize->add_setting( 'themes_customization[themes_contact_page_button_bgcolor1]', array(
        'default' => '',
        'type'              => 'option',
        'capability'         => 'manage_options',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    // add color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_button_bgcolor1]', array(
        'label' => __('Form Button Background Color 1', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_button_bgcolor1]',
    )));
     $wp_customize->add_setting( 'themes_customization[themes_contact_page_button_bgcolor2]', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    // add color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themes_customization[themes_contact_page_button_bgcolor2]', array(
        'label' => __('Form Button Background Color 2', 'themes'),
        'section' => 'themes_contact_page_section',
        'settings' => 'themes_customization[themes_contact_page_button_bgcolor2]',
    )));

    //Shortcode Section
    $wp_customize->add_section('themes_shortcode_section',array(
        'title' => __('Shortcode Settings','themes'),
        'description'   => __('Use below shortcode here.','themes'),
        'priority'  => null,
        'panel' => 'themes_panel',
    ));
    $wp_customize->add_setting('themes_customization[themes_shortcode]',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('themes_customization[themes_shortcode]',array(
        'label' => __('Shortcodes','themes'),
        'description' => __('Below  shortcodes are present in the theme. Simply copy and paste into any page or post and get their listing <br><br> <ul><li><strong>[vw-flower-shop-pro-slider]</strong></li></ul>','themes' ),
        'section' => 'themes_shortcode_section',
        'setting'   => 'themes_customization[themes_shortcode]',
        'type'  => ''
    ));
    
  }

  /**
  * Manage the Login Head
  *
  * @since	1.0.0
  * @version 1.2.2
  * * * * * * * * * * * */
  public function login_page_custom_head() {

    $themes_setting = get_option( 'themes_setting' );
    $lostpassword_url 	= isset( $themes_setting['lostpassword_url'] ) ? $themes_setting['lostpassword_url'] : 'off';

		add_filter( 'gettext', array( $this, 'change_lostpassword_message' ), 20, 3 );
    add_filter( 'gettext', array( $this, 'change_username_label' ), 20, 3 );
    // add_filter( 'gettext', array( $this, 'change_password_label' ), 20, 3 );
    // Include CSS File in heared.
    if ( isset( $this->themes_key['themes_custom_js'] ) && ! empty( $this->themes_key['themes_custom_js'] ) ) { // 1.2.2
      wp_enqueue_script( 'jquery' );
    }
    include( CUSTOM_DIR_PATH . 'css/style-presets.php' );
    include( CUSTOM_DIR_PATH . 'css/style-login.php' );

    do_action( 'themes_header_menu' );
    // do_action( 'themes_header_wrapper' );

    if ( 'on' == $lostpassword_url ) {
      remove_filter( 'lostpassword_url', 'wc_lostpassword_url', 10 );
    }
  }
  


  /**
  * Set hover Title of Logo
  *
  * @since	1.0.0
  * @return mixed
  * * * * * * * * * * * * */
  public function login_page_logo_title() {

    if ( $this->themes_key && array_key_exists( 'customize_logo_hover_title', $this->themes_key ) && ! empty( $this->themes_key['customize_logo_hover_title'] ) ) {
      return $this->themes_key["customize_logo_hover_title"];
    } else {
      return home_url();
    }
  }


  /**
  * Change Lost Password Text from Form
  *
  * @param	$text
  * @since	1.0.0
  * @version 1.0.21
  * @return mixed
  * * * * * * * * * * * * * * * * * * */
  public function change_lostpassword_message( $translated_text, $text, $domain ) {

		if ( is_array( $this->themes_key ) && array_key_exists( 'login_footer_text', $this->themes_key ) && $text == 'Lost your password?'  && 'default' == $domain && trim( $this->themes_key['login_footer_text'] ) ) {

			return trim( $this->themes_key['login_footer_text'] );
		}

    return $translated_text;
  }
  /**
   * Change Label of the Username from login Form.
   * @param  [type] $translated_text [description]
   * @param  [type] $text            [description]
   * @param  [type] $domain          [description]
   * @return string
   * @since 1.1.3
   * @version 1.1.7
   */
  public function change_username_label( $translated_text, $text, $domain ){

    $themes_setting = get_option( 'themes_setting' );

    if ( $themes_setting ) {

      $default = 'Username or Email Address';
  		// $options = $this->themes_key;
  		// $label   = array_key_exists( 'form_username_label', $options ) ? $options['form_username_label'] : '';
      $login_order 	= isset( $themes_setting['login_order'] ) ? $themes_setting['login_order'] : '';

  		// If the option does not exist, return the text unchanged.
  		if ( ! $themes_setting && $default === $text ) {
  			return $translated_text;
  		}

  		// If options exsit, then translate away.
  		if ( $themes_setting && $default === $text ) {

  			// Check if the option exists.
  			if ( '' != $login_order && 'default' != $login_order ) {
          if ( 'username' == $login_order ) {
            $label = __( 'Username', 'themes' );
          } elseif ( 'email' == $login_order ) {
            $label = __( 'Email Address', 'themes' );
          } else {
            $label = 'Username or Email Address';
          }
  				$translated_text = esc_html( $label );
  			} else {
  				return $translated_text;
  			}
  		}
    }
    return $translated_text;
  }
  /**
   * Change Password Label from Form.
   * @param  [type] $translated_text [description]
   * @param  [type] $text            [description]
   * @param  [type] $domain          [description]
   * @return string
   * @since 1.1.3
   */
  public function change_password_label( $translated_text, $text, $domain ) {

			if ( $this->themes_key ) {
        $default = 'Password';
        $options = $this->themes_key;
        $label   = array_key_exists( 'form_password_label', $options ) ? $options['form_password_label'] : '';

  			// If the option does not exist, return the text unchanged.
  			if ( ! $options && $default === $text ) {
  				return $translated_text;
  			}

  			// If options exsit, then translate away.
  			if ( $options && $default === $text ) {

  				// Check if the option exists.
  				if ( array_key_exists( 'form_password_label', $options ) ) {
  					$translated_text = esc_html( $label );
  				} else {
  					return $translated_text;
  				}
  			}
      }
      return $translated_text;
		}


  /**
  * Hook to Redirect Page for Customize
  *
  * @since	1.1.3
  * * * * * * * * * * * * * * * * * * */
  public function redirect_to_custom_page() {
    if ( ! empty($_GET['page'] ) ) {

      if( ( $_GET['page'] == "abw" ) || ( $_GET['page'] == "themes" ) ) {

        if ( is_multisite() ) { // if subdirectories are used in multisite.

          $themes_obj 	= new ThemeSetting();
      		$themes_page = $themes_obj->get_themes_page();

					$page = get_permalink( $themes_page );

					// Generate the redirect url.
					$url = add_query_arg(
						array(
							'autofocus[panel]' => 'themes_panel',
							'url'              => rawurlencode( $page ),
						),
						admin_url( 'customize.php' )
					);

					wp_safe_redirect( $url );

        } else {

          wp_redirect( get_admin_url() . "customize.php?url=" . get_home_url() . '&autofocus=themes_panel' );
         }
      }
    }
  }

}
?>
