<?php
/**
 * ThemeSetting Settings
 *
 * @since 1.0.9
 * @version 1.1.23
 */
if ( ! class_exists( 'Themes_Setting_Settings' ) ):

class Themes_Setting_Settings {

  private $settings_api;

  function __construct() {

    include_once( CUSTOM_ROOT_PATH . '/classes/class-themes-settings-api.php' );
    $this->settings_api = new Themes_Setting_Settings_API;

    add_action( 'admin_init', array( $this, 'themes_setting_init' ) );
    add_action( 'admin_menu', array( $this, 'themes_setting_menu' ) );
  }

  function themes_setting_init() {

    //set the settings.
    //$this->settings_api->set_sections( $this->get_settings_sections() );
    $this->settings_api->set_fields( $this->get_settings_fields() );

    //initialize settings.
    $this->settings_api->admin_init();

    //reset settings.
    $this->load_default_settings();
  }

  function load_default_settings() {

    $_themes_Setting = get_option( 'themes_setting' );
    if ( isset( $_themes_Setting['reset_settings'] ) && 'on' == $_themes_Setting['reset_settings'] ) {

       $themes_last_reset = array( 'last_reset_on' => date('Y-m-d') );
       update_option( 'themes_customization', $themes_last_reset );
       update_option( 'customize_presets_settings', 'default1' );
       $_themes_Setting['reset_settings'] = 'off';
       update_option( 'themes_setting', $_themes_Setting );
       add_action( 'admin_notices', array( $this, 'settings_reset_message' ) );
    }
  }

  function settings_reset_message() {

    $class = 'notice notice-success';
    $message = __( 'Default Settings Restored', 'themes' );

    printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
  }

  // Code for add themes icon
  function themes_setting_menu() {
    add_action('admin_head', 'themesicon'); // admin_head is a hook themesicon is a function we are adding it to the hook


    function themesicon() {
      echo "<style>

      .icon-themes-dashicon:before {
        content: '\\e560';
        color: #fff;
      }

      #adminmenu li#toplevel_page_themes-settings>a>div.wp-menu-image:before{
        content: '\\e560';
        font-family: 'themes' !important;
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;

        /* Better Font Rendering =========== */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      </style>";
    }
    add_menu_page( __( 'Theme Setting', 'themes' ), __( 'Theme Setting', 'themes' ), 'manage_options', "themes-settings", array( $this, 'plugin_page' ), false, 50 );

    add_submenu_page( 'themes-settings', __( 'Customizer', 'themes' ), __( 'Customizer', 'themes' ), 'manage_options', "themes", '__return_null' );

  }

  /**
   * Returns all the settings fields
   *
   * @return array settings fields
   */
  function get_settings_fields() {

    /**
     * [$_free_fields array of free fields]
     * @var array
     */
    $_free_fields = array(
      array(
        'name'              => 'session_expiration',
        'label'             => __( 'Session Expire', 'themes' ),
        'desc'              => __( 'Set the session expiration time in minutes. e.g: 10', 'themes' ), 
        'placeholder'       => __( '10', 'themes' ),
        'min'               => 0,
        // 'max'            => 100,
        'step'              => '1',
        'type'              => 'number',
        'default'           => 'Title',
        'sanitize_callback' => 'abs'
      ),
      
      array(
        'name'  => 'auto_remember_me',
        'label' => __( 'Auto Remember Me', 'themes' ),
        'desc'  => __( 'Keep remember me option always checked on login page', 'themes' ),
        'type'  => 'checkbox'
      ),
      array(
        'name'  => 'enable_reg_pass_field',
        'label' => __( 'Custom Password Fields', 'themes' ),
        'desc'  => __( 'Enable custom password fields on registration form.', 'themes' ),
        'type'  => 'checkbox'
      ),
      array(
        'name'    => 'login_order',
        'label'   => __( 'Login Order', 'themes' ),
        'desc'    => __( 'Enable users to login using their username and/or email address.', 'themes' ),
        'type'    => 'radio',
        'default' => 'default',
        'options' => array(
            'default'  => 'Both Username Or Email Address',
            'username' => 'Only Username',
            'email'    => 'Only Email Address'
        )
      ),
      array(
        'name'  => 'reset_settings',
        'label' => __( 'Reset Default Settings', 'themes' ),
        'desc'  => __( 'Remove my custom settings.', 'themes' ),
        'type'  => 'checkbox'
      ),
    );


    // Add WooCommerce lostpassword_url field in version 1.1.7
    if ( class_exists( 'WooCommerce' ) ) {
      $_free_fields = $this->themes_woocommerce_lostpasword_url( $_free_fields );
    }

    // Add themes_uninstall field in version 1.1.9
    //$_free_fields     = $this->themes_uninstallation_tool( $_free_fields );

    $_settings_fields = apply_filters( 'themes_pro_settings', $_free_fields );

    $settings_fields  = array( 'themes_setting' => $_settings_fields );

    $tab              = apply_filters( 'themes_settings_fields', $settings_fields );

    return $tab;
  }

  function plugin_page() {

      echo '<div class="wrap themes-admin-setting">';
      echo '<h2 style="margin: 20px 0 20px 0;">';
      esc_html_e( 'VW Themes Customizer Addon', 'themes' );
      echo '<h2>';
      esc_html_e( 'Thanks for installing VW Themes Customizer Addon, you rock!', 'themes' ); 
      echo '</h2>';
      echo '</h2>';

      $this->settings_api->show_navigation();
      $this->settings_api->show_forms();

      echo '</div>';
  }

  /**
   * Get all the pages
   *
   * @return array page names with key value pairs
   */
  function get_pages() {
    $pages = get_pages();
    $pages_options = array();
    if ( $pages ) {
        foreach ($pages as $page) {
            $pages_options[$page->ID] = $page->post_title;
        }
    }

    return $pages_options;
  }

  /**
   * themes_woocommerce_lostpasword_url [merge a woocommerce lostpassword url field with the last element of array.]
   * @param  array $fields_list
   * @since 1.1.7
   * @return array
   */
  function themes_woocommerce_lostpasword_url( $fields_list ) {

    $array_elements   = array_slice( $fields_list, 0, -1 ); //slice a last element of array.
    $last_element     = end( $fields_list ); // last element of array.
    $lostpassword_url = array(
      'name'  => 'lostpassword_url',
      'label' => __( 'Lost Password URL', 'themes' ),
      'desc'  => __( 'Use WordPress default lost password URL instead of WooCommerce custom lost password URL.', 'themes' ),
      'type'  => 'checkbox'
    );
    $last_two_elements = array_merge( array( $lostpassword_url, $last_element ) ); // merge last 2 elements of array.
    return array_merge( $array_elements, $last_two_elements ); // merge an array and return.
  }

  /**
   * themes_uninstallation_filed [merge a uninstall themes field with array of element.]
   * @param  array $fields_list
   * @since 1.1.9
   * @return array
   */
  function themes_uninstallation_filed( $fields_list ) {

    $themes_page_check = '';
    if ( is_multisite() ) {
      $themes_page_check = __( 'and ThemeSetting page', 'themes' );
    }

    $themes_db_check = array( array(
      'name'  => 'themes_uninstall',
      'label' => __( 'Remove Settings on Uninstall', 'themes' ),
      'desc'  => sprintf( esc_html__( 'This tool will remove all ThemeSetting settings %1$s upon uninstall.', 'themes' ), $themes_page_check ),
      'type'  => 'checkbox'
    ) );
    return array_merge( $fields_list, $themes_db_check ); // merge an array and return.
  }

  /**
   * themes_uninstallation_tool [Pass return true in themes_multisite_uninstallation_tool filter's callback for enable uninsatalltion control on each site.]
   * @param  array $_free_fields
   * @since 1.1.9
   * @return array
   */
  function themes_uninstallation_tool( $_free_fields ) {

    if ( is_multisite() && ! apply_filters( 'themes_multisite_uninstallation_tool', false ) ) {
      if ( get_current_blog_id() == '1' ) {
        $_free_fields = $this->themes_uninstallation_filed( $_free_fields );
      }
    } else {
      $_free_fields = $this->themes_uninstallation_filed( $_free_fields );
    }

    return $_free_fields;
  }

}
endif;
