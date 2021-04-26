<?php

/**
 * This is a ThemeSetting Compatibility to make it compatible for older versions.
 *
 * @since 1.0.22
 * @version 1.3.2
 */


/**
 * Run a compatibility check on 1.0.21 and change the settings.
 *
 */
add_action( 'init', 'themes_upgrade_1_0_22', 1 );


/**
 * themes_upgrade_1_0_22
 * Remove elemant 'login_with_email' from themes_setting array that was defined in 1.0.21
 * and update 'login_order' in themes_setting for compatiblity.
 *
 * @since   1.0.22
 * @return  array update themes_setting
 */
function themes_upgrade_1_0_22() {

  $themes_setting = get_option( 'themes_setting' );
  $login_with_email = isset( $themes_setting['login_with_email'] ) ? $themes_setting['login_with_email'] : '';

  if ( isset( $themes_setting['login_with_email'] ) ) {

    if( 'on' == $login_with_email ) {

      $themes_setting['login_order'] = 'email';
      unset( $themes_setting['login_with_email'] );
      update_option( 'themes_setting', $themes_setting );
    } else if ( 'off' == $login_with_email ) {

      $themes_setting['login_order'] = 'default';
      unset( $themes_setting['login_with_email'] );
      update_option( 'themes_setting', $themes_setting );
    }
  }
}

if ( ! class_exists( 'Themes_Setting_Compatibility' ) ) :

  /**
   * ThemeSetting compatibility Class is used to make ThemeSetting compatibile with other plugins.
   * Remove conflictions.
   * Add CSS Support.
   * @since 1.0.3
   * @version 1.3.2
   */
  class Themes_Setting_Compatibility {

    /**
    * Variable that Check for ThemeSetting Key.
    *
    * @var string
    * @since 1.3.2
    */
    public $themes_key;

    public function __construct() {
      $this->themes_key = get_option( 'themes_customization' );
      $this->dependencies();
    }

    public function dependencies() {
      add_action( 'wp_print_scripts', array( $this, 'dequeue_conflicted_script' ), 100 );
      add_action( 'login_headerurl',  array( $this, 'remove_conflicted_action' ) );
      add_action( 'init',             array( $this, 'enqueue_themes_compatibility_script') );

      /*************************************
        WebArx Compatibility Fix // v1.2.3
      *************************************/
      add_filter( 'wp_redirect',      array( $this, 'wp_redirect_remove_filter' ), 9 );
      add_filter( 'site_url',         array( $this, 'site_url_remove_filter' ) , 9 );
      add_filter( 'network_site_url', array( $this, 'network_site_url_remove_filter' ), 9 );
      add_action( 'plugins_loaded',   array( $this, 'plugins_loaded_remove_action' ), 10 );
      add_action( 'wp_loaded',        array( $this, 'wp_loaded_remove_action' ), 9 );
      add_action( 'init',             array( $this, 'init_remove_action' ), 9 );

			/***************************************
       Login page Compatibility Fix // v1.3.2
			****************************************/
      add_action( 'login_enqueue_scripts', array( $this, 'dequeue_login_page_conflicting_scripts' ), 99 );

			/********************************************
        Oxygen Builder Compatibility Fix // v1.4.0
			*********************************************/
      add_filter( 'template_include', array( $this, 'template_include_ob' ), 100 );

      /***************************************************************
        All In One WP Security & Firewall Compatibility Fix // v1.4.0
      ****************************************************************/
      add_action( 'init',             array( $this, 'aiowps_login_init_remove_action' ) );
    }

		/**
		 * Dequeue login page styles.
		 *
		 * @since 1.3.2
		 * @version 1.4.3
		 */
		function dequeue_login_page_conflicting_scripts() {
      /**
       * Dequeue thrive theme login page styles.
       * @since 1.3.2
       */
			wp_dequeue_style( 'thrive-custom-login' );
      wp_dequeue_script( 'thrive-custom-login' );

      /**
       * Dequeue listingpro theme login page styles.
       * @since 1.4.3
       */
			wp_dequeue_style( 'listable-custom-login' );

    }

		/**
		 * Overide the oxygen template with themes on login customizer screen.
		 *
		 * @since 1.4.0
		 */
		public function template_include_ob( $template ) {
			// Safely exit if methods not defined yet
			if ( ! function_exists( 'is_customize_preview' ) || ! function_exists( 'wp_get_referer' ) ) {
				return $template;
			}

			if ( is_customize_preview() && $template == ABSPATH . 'wp-content/plugins/oxygen/component-framework//oxygen-main-template.php' && ( false !== strpos( wp_get_referer(), 'autofocus[panel]=themes_panel' ) ) ) {
				return ABSPATH . 'wp-content/plugins/themes/include/template-themes.php';
			}

			return $template;
		}

    public function wp_redirect_remove_filter( $location ) {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return $location;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login )  ) {
          remove_filter( 'wp_redirect', array( webarx()->hide_login, 'wp_redirect' ) );
        }
      }
      return $location;
    }

    public function site_url_remove_filter( $url ) {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return $url;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login ) ) {
          remove_filter('site_url', array( webarx()->hide_login, 'site_url' ) ) ;
        }
      }
      return $url;
    }

    public function network_site_url_remove_filter( $url ) {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return $url;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login ) ) {
          remove_filter('network_site_url', array( webarx()->hide_login, 'network_site_url' ) ) ;
        }
      }
      return $url;
    }

    public function plugins_loaded_remove_action() {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login ) ) {
          remove_action( 'plugins_loaded', array( webarx()->hide_login, 'plugins_loaded' ), 9999 ) ;
        }
      }
    }

    public function wp_loaded_remove_action() {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return $url;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login ) ) {
          remove_action( 'wp_loaded', array( webarx()->hide_login, 'wp_loaded' ) );
        }
      }
    }

    public function init_remove_action() {
      if ( class_exists( 'Webarx' ) ) {

        if ( ! function_exists( 'is_user_logged_in' ) ) {
          return $url;
        }

        $webarx_login  = get_option( 'webarx_mv_wp_login' );
        $user_loged_in = is_user_logged_in();

        if ( ( isset( $user_loged_in ) && true === $user_loged_in ) && ( isset( $webarx_login ) && '1' === $webarx_login ) ) {
          remove_action( 'init', array( webarx()->hide_login, 'denyRequestsToWpLogin' ) ) ;
        }
      }
    }


    /**
     * Remove login securty check in customizer screen only.
     * No need for this check as the user is already logged in and using customizer.
     *
     * @since 1.4.0
     */
    public function aiowps_login_init_remove_action() {
      if ( ! is_customize_preview() )
        return;

      if ( ! class_exists( 'AIO_WP_Security' ) )
        return;

      global $aio_wp_security;

      if( ! is_a( $aio_wp_security, 'AIO_WP_Security' ) )
        return;

      if( remove_action( 'wp_loaded', array( $aio_wp_security, 'aiowps_wp_loaded_handler' ) ) ) {
        add_filter( 'option_aio_wp_security_configs', array( $this, 'aiowps_filter_options' ) );
      }
    }

    /**
     * Filter options aio_wp_security_configs.
     *
     * @since 1.4.0
     */
    public function aiowps_filter_options( $option ) {
      unset( $option['aiowps_enable_rename_login_page'] );
      return $option;
    }

    public function enqueue_themes_compatibility_script() {

      /**
       * Enqueue ThemeSetting CSS on Password_Protected plugin.
       *
       * Hooked to the password_protected_login_head action,
       * Head URL & Title on logo as well.
       *
       * so that it is after the script was enqueued.
       * @since 1.0.3
       * @version 1.3.2
       */
      if ( class_exists( 'Password_Protected' ) ) {
        add_action( 'password_protected_login_head', array( $this, 'enqueue_themes_script' ) );
        add_filter( 'password_protected_login_headerurl', array( $this, 'password_protected_login_headerurl_cb' ) );
        add_filter( 'password_protected_login_headertitle', array( $this, 'password_protected_login_headertitle_cb' ) );
      }
    }

    /**
     * dequeue_conflicted_script
     *
     * @since 1.0.3
     */
    public function dequeue_conflicted_script() {

      /**
       * Dequeue the Divi Login script.
       *
       * Hooked to the wp_print_scripts action, with a late priority (100),
       * so that it is after the script was enqueued.
       * @since 1.0.3
       */
      if ( class_exists( 'ET_Divi_100_Custom_Login_Page_Config' ) ) {
         wp_dequeue_style( 'custom-login-pages' );
         wp_dequeue_script( 'custom-login-pages-icon-font' );
         wp_dequeue_script( 'custom-login-pages-scripts' );
       }
    }

    /**
     * remove_conflicted_action
     *
     * @since 1.0.3
     */
    public function remove_conflicted_action() {

      /**
       * Remove the Divi login_footer hook 'print_styles'
       *So that confliction is removed.
       *
       * @since 1.0.3
       */
      if ( class_exists( 'ET_Divi_100_Custom_Login_Page_Config' ) ) {

        remove_action( 'login_footer', array( ET_Divi_100_Custom_Login_Page::instance(), 'print_styles' ) );
      }
    }

    /**
     * Include ThemeSetting CSS for Support with other plugins.
     *
     * @since 1.0.3
     */
    public function enqueue_themes_script() {
      include( CUSTOM_DIR_PATH . 'css/style-presets.php' );
    	include( CUSTOM_DIR_PATH . 'css/style-login.php' );
    }

    /**
     * Password protected plugin compatlibility with logo url.
     *
     * @since 1.3.1
     * @version 1.3.2
     */
    public function password_protected_login_headerurl_cb() {

      $logo_url = $this->themes_key && isset( $this->themes_key['customize_logo_hover'] ) && ! empty( $this->themes_key['customize_logo_hover'] ) ? $this->themes_key['customize_logo_hover'] : home_url( '/' );

      return $logo_url;
    }

    /**
     * Password protected plugin compatlibility with logo title.
     *
     * @since 1.3.2
     */
    public function password_protected_login_headertitle_cb() {

      $logo_title = $this->themes_key && isset( $this->themes_key['customize_logo_hover_title'] ) && ! empty( $this->themes_key['customize_logo_hover_title'] ) ? $this->themes_key['customize_logo_hover_title'] : get_bloginfo( 'name' );

      return $logo_title;
    }

}

endif;

new Themes_Setting_Compatibility;
