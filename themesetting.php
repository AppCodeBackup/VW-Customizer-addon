<?php
/*
 * Plugin Name:       VW Customizer Addon
 * Plugin URI:        
 * Description:       ThemeSetting is a Custom Login Page Customizer plugin allows you to easily customize the layout of login, admin login, client login, register pages.
 * Version:           0.0.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            VowelWeb
 * Author URI:        https://www.vowelweb.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vw-customizer-addon
 * Domain Path:       /languages
*/

if ( ! class_exists( 'ThemeSetting' ) ) :

  final class ThemeSetting {

    /**
    * @var string
    */
    public $version = '0.0.3';

    /**
    * @var The single instance of the class
    * @since 1.0.0
    */
    protected static $_instance = null;

    /**
    * @var WP_Session session
    */
    public $session = null;

    /**
    * @var WP_Query $query
    */
    public $query = null;

    /**s
    * @var WP_Countries $countries
    */
    public $countries = null;

    /* * * * * * * * * *
    * Class constructor
    * * * * * * * * * */
    public function __construct() {

      $this->define_constants();
      $this->includes();
      $this->_hooks();

    }

    /**
    * Define ThemeSetting Constants
    */
    private function define_constants() {

      //$this->define( 'CUSTOM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
      $this->define( 'CUSTOM_DIR_PATH', plugin_dir_path( __FILE__ ) );
      $this->define( 'CUSTOM_DIR_URL', plugin_dir_url( __FILE__ ) );
      $this->define( 'CUSTOM_ROOT_PATH',  dirname( __FILE__ ) . '/' );
      $this->define( 'CUSTOM_ROOT_FILE', __FILE__ );
      $this->define( 'CUSTOM_VERSION', $this->version );
      }

    /**
    * Include required core files used in admin and on the frontend.
    * @version 1.1.7
    */

    public function includes() {

      include_once( CUSTOM_DIR_PATH . 'include/compatibility.php' );
      include_once( CUSTOM_DIR_PATH . 'custom.php' );
      include_once( CUSTOM_DIR_PATH . 'classes/class-themes-setup.php' );
      //include_once( CUSTOM_DIR_PATH . 'classes/class-themes-ajax.php' );

      $themes_setting = get_option( 'themes_setting' );

    }

    /**
    * Hook into actions and filters
    * @since  1.0.0
    * @version 1.2.2
    */
    private function _hooks() {

      add_action( 'admin_menu',             array( $this, 'register_options_page' ) );
      add_action( 'plugins_loaded',         array( $this, 'textdomain' ) );
      add_filter( 'plugin_row_meta',        array( $this, '_row_meta'), 10, 2 );
      add_action( 'admin_enqueue_scripts',  array( $this, '_admin_scripts' ) );
      add_action( 'admin_footer',           array( $this, 'add_deactive_modal' ) );
      add_action( 'plugin_action_links',    array( $this, 'themes_action_links' ), 10, 2 );
      add_action( 'admin_init',             array( $this, 'redirect_optin' ) );
      add_filter( 'auth_cookie_expiration', array( $this, '_change_auth_cookie_expiration' ), 10, 3 );
      //add_filter( 'plugins_api',            array( $this, 'get_addon_info_' ) , 100, 3 );
      if ( is_multisite() ) {
        add_action( 'admin_init',             array( $this, 'redirect_themes_edit_page' ) );
        add_action( 'admin_init',             array( $this, 'check_themes_page' ) );
      }

    }

    /**
    * Redirect to Optin page.
    *
    * @since 1.0.15
    */
    function redirect_optin() {

      // delete_option( '_themes_optin' );

      if ( isset( $_POST['themes-submit-optout'] ) ) {

        update_option( '_themes_optin', 'no' );
        $this->_send_data( array(
          'action'  =>  'Skip',
        ) );

      } elseif ( isset( $_POST['themes-submit-optin'] ) ) {

        update_option( '_themes_optin', 'yes' );
        $fields = array(
          'action'          =>  'Activate',
          'track_mailchimp' =>  'yes'
        );
        $this->_send_data( $fields );

      } elseif ( ! get_option( '_themes_optin' ) && isset( $_GET['page'] ) && ( $_GET['page'] === 'themes-settings' || $_GET['page'] === 'themes' || $_GET['page'] === 'abw' ) ) {

        wp_redirect( admin_url('admin.php?page=themes-optin&redirect-page=' . $_GET['page'] ) );
        exit;
      } elseif ( get_option( '_themes_optin' ) && ( get_option( '_themes_optin' ) == 'yes' || get_option( '_themes_optin' ) == 'no' ) && isset( $_GET['page'] ) && $_GET['page'] === 'themes-optin' ) {
         wp_redirect( admin_url( 'admin.php?page=themes-settings' ) );
        exit;
      }
    }


    /**
    * Main Instance
    *
    * @since 1.0.0
    * @static
    * @see themes_settings_loader()
    * @return Main instance
    */
    public static function instance() {
      if ( is_null( self::$_instance ) ) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }


    /**
    * Load Languages
    * @since 1.0.0
    */
    public function textdomain() {

      $plugin_dir =  dirname( plugin_basename( __FILE__ ) ) ;
      load_plugin_textdomain( 'themes', false, $plugin_dir . '/languages/' );
    }

    /**
    * Define constant if not already set
    * @param  string $name
    * @param  string|bool $value
    */
    private function define( $name, $value ) {
      if ( ! defined( $name ) ) {
        define( $name, $value );
      }
    }

    /**
    * Init vwthemes when WordPress Initialises.
    */
    public function init() {
      // Before init action
    }

    /**
     * Create ThemeSetting Page Template.
     *
     * @since 1.1.3
     */
    public function check_themes_page() {

      // Retrieve the ThemeSetting admin page option, that was created during the activation process.
      $option = $this->get_themes_page();

      include CUSTOM_DIR_PATH . 'include/create-themes-page.php';
      // Retrieve the status of the page, if the option is available.
      if ( $option ) {
        $page   = get_post( $option );
        $status = $page->post_status;
      } else {
        $status = null;
      }

      // Check the status of the page. Let's fix it, if the page is missing or in the trash.
      if ( empty( $status ) || 'trash' === $status ) {
        new Themes_Setting_Page_Create();
      }
    }

    /**
     * function for redirect the ThemeSetting page on editing.
     *
     * @since 1.1.3
     */
    public function redirect_themes_edit_page() {
      global $pagenow;

      $page = $this->get_themes_page();

      if ( ! $page ) {
        return;
      }

      $page_url = get_permalink( $page );
      $page_id  = get_post( $page );
      $page_id  = $page->ID;

      // Generate the redirect url.
      $url = add_query_arg(
        array(
          'autofocus[section]' => 'themes_panel',
          'url'                => rawurlencode( $page_url ),
        ),
        admin_url( 'customize.php' )
      );

      /* Check current admin page. */
      if ( $pagenow == 'post.php' && isset( $_GET['post'] ) && $_GET['post'] == $page_id ) {
        wp_safe_redirect( $url );
      }
    }

    /**
    * Add new page in Apperance to customize Login Page
    */
    public function register_options_page() {

      add_submenu_page( null, __( 'Activate', 'themes' ), __( 'Activate', 'themes' ), 'manage_options', 'themes-optin', array( $this, 'render_optin' )  );

      add_theme_page( __( 'ThemeSetting', 'themes' ), __( 'ThemeSetting', 'themes' ), 'manage_options', "abw", '__return_null' );
    }


    /**
     * Show Opt-in Page.
     *
     * @since 1.0.15
     */
    function render_optin() {
      include CUSTOM_DIR_PATH . 'include/themes-optin-form.php';
    }

    /**
    * Wrapper function to send data.
    * @param  [arrays]  $args.
    *
    * @since  1.0.15
    * @version 1.0.23
    */
 function _send_data( $args ) {


 }

   /**
    * Session Expiration
    *
    * @since  1.0.18
    * @version 1.3.2
    */
   function _change_auth_cookie_expiration( $expiration, $user_id, $remember ) {

    $themes_setting = get_option( 'themes_setting' );
    $_expiration        = isset( $themes_setting['session_expiration'] ) ? intval( $themes_setting['session_expiration'] ) : '';

    /**
     * return the WordPress default $expiration time if ThemeSetting Session Expiration time set 0 or empty.
     * @since 1.0.18
     */
    if ( empty( $_expiration ) || '0' == $_expiration ) {
      return $expiration;
    }

    /**
     * $filter_role Use filter `themes_exclude_role_session` for return the role.
     * By default it's false and $expiration time will apply on all user.
     *
     * @return string/array role name.
     * @since 1.3.2
     */
    $filter_role = apply_filters( 'themes_exclude_role_session', false );

    if ( $filter_role ) {
      $user_roles = get_userdata( $user_id )->roles;

      // if $filter_role is array, return the default $expiration for each defined role.
      if ( is_array( $filter_role ) ) {
        foreach ( $filter_role as $role ) {
          if ( in_array( $role, $user_roles ) ) {
            return $expiration;
          }
        }
      } else if ( in_array( $filter_role, $user_roles ) ) {
        return $expiration;
      }
    }

    // Convert Duration (minutes) of the expiration period in seconds.
    $expiration = $_expiration * 60;

    return $expiration;
   }

    /**
     * Load JS or CSS files at admin side and enqueue them
     * @param  string tell you the Page ID
     * @return void
     */
    function _admin_scripts( $hook ) {

      if( $hook == 'toplevel_page_themes-settings' || $hook == 'themes_page_themes-addons' || $hook == 'themes_page_themes-help' || $hook == 'themes_page_themes-import-export' || $hook == 'themes_page_themes-license' ) {

        wp_enqueue_style( 'themes_stlye', plugins_url( 'css/style.css', __FILE__ ), array(), CUSTOM_VERSION );
        wp_enqueue_script( 'themes_js', plugins_url( 'js/admin-custom.js', __FILE__ ), array(), CUSTOM_VERSION );

        // Array for localize.
        $themes_localize = array(
          'plugin_url' => plugins_url(),
        );

        wp_localize_script( 'themes_js', 'themes_script', $themes_localize );
      }

    }

    /**
     * Add rating icon on plugins page.
     *
     * @since 1.0.9
     * @version 1.1.22
     */

    public function _row_meta( $meta_fields, $file ) {

      if ( $file != 'vw-customizer-addon/themesetting.php' ) {

        return $meta_fields;
      }

      echo "<style>.themes-rate-stars { display: inline-block; color: #ffb900; position: relative; top: 3px; }.themes-rate-stars svg{ fill:#ffb900; } .themes-rate-stars svg:hover{ fill:#ffb900 } .themes-rate-stars svg:hover ~ svg{ fill:none; } </style>";

      $plugin_rate   = "https://wordpress.org/support/plugin/themes/reviews/?rate=5#new-post";
      $plugin_filter = "https://wordpress.org/support/plugin/themes/reviews/?filter=5";
      $svg_xmlns     = "https://www.w3.org/2000/svg";
      $svg_icon      = '';

      for ( $i = 0; $i < 5; $i++ ) {
        $svg_icon .= "<svg xmlns='" . esc_url( $svg_xmlns ) . "' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>";
      }

      // Set icon for thumbsup.
      $meta_fields[] = '<a href="' . esc_url( $plugin_filter ) . '" target="_blank"><span class="dashicons dashicons-thumbs-up"></span>' . __( 'Vote!', 'themes' ) . '</a>';

      // Set icon for 5-star reviews. v1.1.22
      $meta_fields[] = "<a href='" . esc_url( $plugin_rate ) . "' target='_blank' title='" . esc_html__( 'Rate', 'themes' ) . "'><i class='themes-rate-stars'>" . $svg_icon . "</i></a>";

      return $meta_fields;
    }

    /**
     * Add deactivate modal layout.
     */
    function add_deactive_modal() {
      global $pagenow;

      if ( 'plugins.php' !== $pagenow ) {
        return;
      }

      include CUSTOM_DIR_PATH . 'include/deactivate_modal.php';
      //include CUSTOM_DIR_PATH . 'include/themes-optout-form.php';
    }

  /**
   * Plugin activation
   *
   * @since  1.0.15
   * @version 1.0.22
   */
  static function plugin_activation() {

    $themes_key     = get_option( 'themes_customization' );
    $themes_setting = get_option( 'themes_setting' );

    // Create a key 'themes_customization' with empty array.
    if ( ! $themes_key ) {
      update_option( 'themes_customization', array() );
    }

    // Create a key 'themes_setting' with empty array.
    if ( ! $themes_setting ) {
      update_option( 'themes_setting', array() );
    }
  }

  // static function plugin_uninstallation() {

  //   $email         = get_option( 'admin_email' );

  //   $fields = array(
  //     'email'             => $email,
  //     'website'           => get_site_url(),
  //     'action'            => 'Uninstall',
  //     'reason'            => '',
  //     'reason_detail'     => '',
  //     'blog_language'     => get_bloginfo( 'language' ),
  //     'wordpress_version' => get_bloginfo( 'version' ),
  //     'php_version'       => PHP_VERSION,
  //     'plugin_version'    => CUSTOM_VERSION,
  //     'plugin_name'       => 'ThemeSetting Free',
  //   );

  //   $response = wp_remote_post( CUSTOM_FEEDBACK_SERVER, array(
  //     'method'      => 'POST',
  //     'timeout'     => 5,
  //     'httpversion' => '1.0',
  //     'blocking'    => false,
  //     'headers'     => array(),
  //     'body'        => $fields,
  //   ) );

  // }



  /**
   * Pull the ThemeSetting page from options.
   *
   * @access public
   * @since 1.1.3
   * @version 1.1.7
   */
  public function get_themes_page() {

    $themes_setting = get_option( 'themes_setting', array() );
    if ( ! is_array( $themes_setting ) && empty( $themes_setting ) ) {
      $themes_setting = array();
    }
    $page = array_key_exists( 'themes_page', $themes_setting ) ? get_post( $themes_setting['themes_page'] ) : false;

    return $page;
  }


  /**
   * Add a link to the settings page to the plugins list
   *
   * @since  1.0.11
   */
  public function themes_action_links( $links, $file ) {

    static $this_plugin;

    if ( empty( $this_plugin ) ) {

      $this_plugin = 'vw-customizer-addon/themesetting.php';
    }

    if ( $file == $this_plugin ) {

      $settings_link = sprintf( esc_html__( '%1$s Settings %2$s | %3$s Customize %4$s', 'themes' ), '<a href="' . admin_url( 'admin.php?page=themes-settings' ) . '">', '</a>', '<a href="' . admin_url( 'admin.php?page=themes' ) . '">', '</a>' );


      if( 'yes' == get_option( '_themes_optin' ) ){
        $settings_link .= sprintf( esc_html__( ' | %1$s Opt Out %2$s ', 'themes'), '<a class="opt-out" href="' . admin_url( 'admin.php?page=themes-settings' ) . '">', '</a>' );
      } else {
        $settings_link .= sprintf( esc_html__( ' | %1$s Opt In %2$s ', 'themes'), '<a href="' . admin_url( 'admin.php?page=themes-optin&redirect-page=' .'themes-settings' ) . '">', '</a>' );
      }

      array_unshift( $links, $settings_link );

      // if ( ! has_action( 'themes_pro_add_template' ) ) :
      //   $pro_link = sprintf( esc_html__( '%1$s %3$s Upgrade Pro %4$s %2$s', 'themes' ),  '<a href="https://vwthemes.com/wordpress/plugins/themes-pro/?utm_source=themes-lite&utm_medium=plugin-action-link&utm_campaign=pro-upgrade" target="_blank">', '</a>', '<span class="themes-dasboard-pro-link">', '</span>' );
      //   array_push( $links, $pro_link );
      // endif;
    }

    return $links;
  }

} // End Of Class.
endif;


/**
* Returns the main instance of WP to prevent the need to use globals.
*
* @since  1.0.0
* @return ThemeSetting
*/
function themes_settings_loader() {
  return ThemeSetting::instance();
}

// Call the function
themes_settings_loader();

/**
* Create the Object of Custom Login Entites and Settings.
*
* @since  1.0.0
*/
new Themes_Setting_Entities();
new Themes_Setting_Settings();