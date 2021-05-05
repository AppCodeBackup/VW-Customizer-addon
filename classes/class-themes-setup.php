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
      //$ttf   = plugins_url( '../themesfonts/themes.ttf?gb7unf', __FILE__ );
      //$woff  = plugins_url( '../themesfonts/themes.woff?gb7unf', __FILE__ );
      //$svg   = plugins_url( '../themesfonts/themes.svg?gb7unf', __FILE__ );
      //$eotie = plugins_url( '../themesfonts/themes.eot?gb7unf#iefix', __FILE__ );
      //$eot   = plugins_url( '../themesfonts/themes.eot?gb7unf', __FILE__ );
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
    add_menu_page( __( 'ThemeSetting', 'themes' ), __( 'ThemeSetting', 'themes' ), 'manage_options', "themes-settings", array( $this, 'plugin_page' ), false, 50 );

    //add_submenu_page( 'themes-settings', __( 'Settings', 'themes' ), __( 'Settings', 'themes' ), 'manage_options', "themes-settings", array( $this, 'plugin_page' ) );

    add_submenu_page( 'themes-settings', __( 'Customizer', 'themes' ), __( 'Customizer', 'themes' ), 'manage_options', "themes", '__return_null' );

    add_submenu_page( 'themes-settings', __( 'Help', 'themes' ), __( 'Help', 'themes' ), 'manage_options', "themes-help", array( $this, 'themes_help_page' ) );

    //add_submenu_page( 'themes-settings', __( 'Import/Export ThemeSetting Settings', 'themes' ), __( 'Import / Export', 'themes' ), 'manage_options', "themes-import-export", array( $this, 'themes_import_export_page' ) );

    //add_submenu_page( 'themes-settings', __( 'Add-Ons', 'themes' ), __( 'Add-Ons', 'themes' ), 'manage_options', "themes-addons", array( $this, 'themes_addons_page' ) );

  }

  // function get_settings_sections() {
  //
  //   $themes_general_tab = array(
  //     array(
  //       'id'    => 'themes_setting',
  //       'title' => __( 'Settings', 'themes' ),
  //       'desc'  => sprintf( __( 'Everything else is customizable through %1$sWordPress Customizer%2$s.', 'themes' ), '<a href="' . admin_url( 'admin.php?page=themes' ) . '">', '</a>' ),
  //     ),
  //   );
  //
  //   /**
  //    * Add Promotion tabs in settings page.
  //    * @since 1.1.22
  //    * @version 1.1.24
  //    */
  //   if ( ! has_action( 'themes_pro_add_template' ) ) {
  //     include CUSTOM_DIR_PATH . 'classes/class-themes-promotion.php';
  //   }
  //
  //   $sections = apply_filters( 'themes_settings_tab', $themes_general_tab );
  //
  //   return $sections;
  // }

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
        'desc'              => __( 'Set the session expiration time in minutes. e.g: 10', 'themes' ), //<br /> When you set the time, here you need to set the expiration cookies. for this, you just need to logout at least one time. After login again, it should be working fine.<br />For removing the session expiration just pass empty value in “Expiration” field and save it. Now clear the expiration cookies by logout at least one time.
        'placeholder'       => __( '10', 'themes' ),
        'min'               => 0,
        // 'max'            => 100,
        'step'              => '1',
        'type'              => 'number',
        'default'           => 'Title',
        'sanitize_callback' => 'abs'
      ),
      // array(
      //   'name'  => 'enable_privacy_policy',
      //   'label' => __( 'Enable Privacy Policy', 'themes' ),
      //   'desc'  => __( 'Enable Privacy Policy checkbox on registration page.', 'themes' ),
      //   'type'  => 'checkbox'
      // ),
      // array(
      //   'name'  => 'privacy_policy',
      //   'label' => __( 'Privacy & Policy', 'themes' ),
      //   'desc'  => __( 'Right down the privacy and policy description.', 'themes' ),
      //   'type'  => 'wysiwyg',
      //   'default' => __( sprintf( __( '%1$sPrivacy Policy%2$s.', 'themes' ), '<a href="' . admin_url( 'admin.php?page=themes-settings' ) . '">', '</a>' ) )
      // ),
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
      // array(
      //   'name'  => 'login_with_email',
      //   'label' => __( 'Login with Email', 'themes' ),
      //   'desc'  => __( 'Force user to login with Email Only Instead Username.', 'themes' ),
      //   'type'  => 'checkbox'
      // ),
      array(
        'name'  => 'reset_settings',
        'label' => __( 'Reset Default Settings', 'themes' ),
        'desc'  => __( 'Remove my custom settings.', 'themes' ),
        'type'  => 'checkbox'
      ),
    );

    // Hide Advertisement in version 1.1.3
    // if ( ! has_action( 'themes_pro_add_template' ) ) {
    //   array_unshift( $_free_fields , array(
    //     'name'  => 'enable_repatcha_promo',
    //     'label' => __( 'Enable reCAPTCHA', 'themes' ),
    //     'desc'  => __( 'Enable ThemeSetting reCaptcha', 'themes' ),
    //     'type'  => 'checkbox'
    //   ) );
    // }

    // Add WooCommerce lostpassword_url field in version 1.1.7
    if ( class_exists( 'WooCommerce' ) ) {
      $_free_fields = $this->themes_woocommerce_lostpasword_url( $_free_fields );
    }

    // Add themes_uninstall field in version 1.1.9
    $_free_fields     = $this->themes_uninstallation_tool( $_free_fields );

    $_settings_fields = apply_filters( 'themes_pro_settings', $_free_fields );

    $settings_fields  = array( 'themes_setting' => $_settings_fields );

    $tab              = apply_filters( 'themes_settings_fields', $settings_fields );

    return $tab;
  }

  function plugin_page() {

      echo '<div class="wrap themes-admin-setting">';
      echo '<h2 style="margin: 20px 0 20px 0;">';
      esc_html_e( 'ThemeSetting - Rebranding your boring WordPress Login pages', 'themes' );
      echo '</h2>';

      $this->settings_api->show_navigation();
      $this->settings_api->show_forms();

      echo '</div>';
  }

  // /**
  //  * [themes_help_page callback function for sub-page Help]
  //  * @since 1.0.19
  //  */
  // function themes_help_page(){
  //
  //   include CUSTOM_DIR_PATH . 'classes/class-themes-log.php';
  //
  //   $html = '<div class="themes-help-page">';
  //   $html .= '<h2>Help & Troubleshooting</h2>';
  //   $html .= sprintf( __( 'Free plugin support is available on the %1$s plugin support forums%2$s.', 'themes' ), '<a href="https://wordpress.org/support/plugin/themes" target="_blank">', '</a>' );
  //   $html .="<br /><br />";
  //
  //   if( ! class_exists('Themes_Setting_Pro')){
  //     $html .= sprintf( __( 'For premium features, add-ons and priority email support, %1$s upgrade to pro%2$s.', 'themes' ), '<a href="https://wpbrigade.com/wordpress/plugins/themes-pro/?utm_source=themes-lite&utm_medium=help-page&utm_campaign=pro-upgrade" target="_blank">', '</a>' );
  //   }else{
  //     $html .= 'For premium features, add-ons and priority email support, Please submit a question <a href="https://themes.pro/contact/" target="_blank">here</a>!';
  //   }
  //
  //   $html .="<br /><br />";
  //   $html .= 'Found a bug or have a feature request? Please submit an issue <a href="https://themes.pro/contact/" target="_blank">here</a>!';
  //   $html .= '<pre><textarea rows="25" cols="75" readonly="readonly">';
  //   $html .= Themes_Setting_Log_Info::get_sysinfo();
  //   $html .= '</textarea></pre>';
  //   $html .= '<input type="button" class="button themes-log-file" value="' . __( 'Download Log File', 'themes' ) . '"/>';
  //   $html .= '<span class="log-file-sniper"><img src="'. admin_url( 'images/wpspin_light.gif' ) .'" /></span>';
  //   $html .= '<span class="log-file-text">ThemeSetting Log File Downloaded Successfully!</span>';
  //   $html .= '</div>';
  //   echo $html;
  // }

  /**
   * [themes_import_export_page callback function for sub-page Import / Export]
   * @since 1.0.19
   */
  // function themes_import_export_page(){
  //
  //   include CUSTOM_DIR_PATH . 'include/themes-import-export.php';
  // }

  /**
   * [themes_addons_page callback function for sub-page Add-ons]
   * @since 1.0.19
   */
  // function themes_addons_page() {
  //
  //   include CUSTOM_DIR_PATH . 'classes/class-themes-addons.php';
  //   $obj_themes_addons	= new Themes_Setting_Addons();
  //   $obj_themes_addons->_addon_html();
  // }

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
