<?php
if ( ! defined( 'ABSPATH' ) ) {
  // Exit if accessed directly.
  exit;
}

/**
* Handling all the AJAX calls in ThemeSetting.
*
* @since 1.0.19
* @version 1.2.2
* @class Themes_Setting_AJAX
*/

if ( ! class_exists( 'Themes_Setting_AJAX' ) ) :

  class Themes_Setting_AJAX {

    /* * * * * * * * * *
    * Class constructor
    * * * * * * * * * */
    public function __construct() {

      $this::init();
    }
    public static function init() {

      $ajax_calls = array(
        'export'           => false,
        'import'           => false,
        'help'             => false,
        'deactivate'       => false,
        'optout_yes'       => false,
        'presets'          => false,
				'video_url'        => false,
				'activate_addon'   => false,
				'deactivate_addon' => false
      );

      foreach ( $ajax_calls as $ajax_call => $no_priv ) {
        // code...
        add_action( 'wp_ajax_themes_' . $ajax_call, array( __CLASS__, $ajax_call ) );

        if ( $no_priv ) {
          add_action( 'wp_ajax_nopriv_themes_' . $ajax_call, array( __CLASS__, $ajax_call ) );
        }
      }
		}

    /**
     * Activate Plugins.
     * @since 1.2.2
     */
		function activate_addon() {

      $plugin = esc_html( $_POST['slug'] );

      check_ajax_referer( 'install-plugin_' . $plugin, '_wpnonce' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

			if ( ! is_plugin_active( $plugin ) ) {
				activate_plugin( $plugin );
      }

      echo wp_create_nonce( 'uninstall_' . $plugin );

			wp_die();
		}

    /**
     * Deactivate Plugins.
     * @since 1.2.2
     */
		function deactivate_addon() {

      $plugin = esc_html( $_POST['slug'] );

      check_ajax_referer( 'uninstall_' . $plugin, '_wpnonce' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      deactivate_plugins( $plugin );

      echo wp_create_nonce( 'install-plugin_' . $plugin );

			wp_die();
		}

    /**
    * [Import ThemeSetting Settings]
    * @return [array] [update settings meta]
    * @since 1.0.19
    * @version 1.1.14
    */
    public function import() {

      check_ajax_referer( 'themes-import-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      $lg_imp_tmp_name =  $_FILES['file']['tmp_name'];
      $lg_file_content = file_get_contents( $lg_imp_tmp_name );
      $themes_json = json_decode( $lg_file_content, true );

      if ( json_last_error() == JSON_ERROR_NONE ) {

        foreach ( $themes_json as $object => $array ) {

          // Check for ThemeSetting customizer images.
          if ( 'themes_customization' == $object ) {

            update_option( $object, $array );

            foreach ( $array as $key => $value ) {

              // Array of themes customizer images.
              $imagesCheck = array( 'setting_logo', 'setting_background', 'setting_form_background', 'forget_form_background', 'gallery_background' );

              /**
              * [if json fetched data has array of $imagesCheck]
              * @var [array]
              */
              if ( in_array( $key, $imagesCheck ) ) {

                global $wpdb;
                // Count the $value of that $key from {$wpdb->posts}.
                // $query = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE guid='$value'";
                $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->posts} WHERE guid='%s'", $value ) );

                if ( $count < 1 && ! empty( $value ) ) {
                  $file = array();
                  $file['name'] = basename( $value );
                  $file['tmp_name'] = download_url( $value ); // Downloads a url to a local temporary file.

                  if ( is_wp_error( $file['tmp_name'] ) ) {
                    @unlink( $file['tmp_name'] );
                    // return new WP_Error( 'lpimgurl', 'Could not download image from remote source' );
                  } else {
                    $id  = media_handle_sideload( $file, 0 ); // Handles a sideloaded file.
                    $src = wp_get_attachment_url( $id ); // Returns a full URI for an attachment file.
                    $themes_options = get_option( 'themes_customization' ); // Get option that was updated previously.

                    // Change the options array properly.
                    $themes_options["$key"] = $src;

                    // Update entire array again for save the attachment w.r.t $key.
                    update_option( $object, $themes_options );
                  }
                } // media_upload.
              } // images chaeck.
            } // inner foreach.
          } // themes_customization check.

          if ( 'themes_setting' == $object ) {

            $themes_options = get_option( 'themes_setting' );
            // Check $themes_options is exists.
            if ( isset( $themes_options ) && ! empty( $themes_options ) ) {

              foreach ( $array as $key => $value ) {

                // Array of themes Settings that import.
                $setting_array = array( 'session_expiration', 'login_with_email' );

                if ( in_array( $key, $setting_array ) ) {

                  // Change the options array properly.
                  $themes_options["$key"] = $value;
                  // Update array w.r.t $key exists.
                  update_option( $object, $themes_options );
                }
              } // inner foreach.
            } else {

              update_option( $object, $array );
            }
          } // themes_setting check.

          if ( 'customize_presets_settings' == $object ) {

            update_option( 'customize_presets_settings', $array );

          }
        } // endforeach.
      } else {
        echo "error";
      }
      wp_die();
    }

    /**
    * [Export ThemeSetting Settings]
    * @return [string] [return settings in json formate]
    * @since 1.0.19
    * @version 1.1.14
    */
    public function export(){

      check_ajax_referer( 'themes-export-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      $themes_db            = array();
      $themes_setting_opt   = array();
      $themes_customization = get_option( 'themes_customization' );
      $themes_setting       = get_option( 'themes_setting' );
      $themes_preset        = get_option( 'customize_presets_settings' );
      $themes_setting_fetch = array( 'session_expiration', 'login_with_email' );

      if ( $themes_customization ) {

        $themes_db['themes_customization'] = $themes_customization;
      }
      if ( $themes_setting ) {

        foreach ( $themes_setting as $key => $value) {
          if ( in_array( $key, $themes_setting_fetch ) ) {
            $themes_setting_opt[$key] = $value;
          }
        }
        $themes_db['themes_setting'] = $themes_setting_opt;
      }

      if ( $themes_preset ) {

        $themes_db['customize_presets_settings'] = $themes_preset;
      }

      $themes_db = json_encode( $themes_db );

      echo $themes_db;

      wp_die();
    }

    /**
    * [Download file from help information tab]
    * @return [string] [description]
    * @since 1.0.19
    */
    public function help() {

      include CUSTOM_DIR_PATH . 'classes/class-themes-log.php';

      echo Themes_Setting_Log_Info::get_sysinfo();

      wp_die();
    }

    /**
     * [deactivate get response from user on deactivating plugin]
     * @return [string] [response]
     * @since   1.0.15
     * @version 1.1.14
     */
    public function deactivate() {

      check_ajax_referer( 'themes-deactivate-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      $email         = get_option( 'admin_email' );
      $_reason       = sanitize_text_field( wp_unslash( $_POST['reason'] ) );
      $reason_detail = sanitize_text_field( wp_unslash( $_POST['reason_detail'] ) );
      $reason        = '';

      if ( $_reason == '1' ) {
        $reason = 'I only needed the plugin for a short period';
      } elseif ( $_reason == '2' ) {
        $reason = 'I found a better plugin';
      } elseif ( $_reason == '3' ) {
        $reason = 'The plugin broke my site';
      } elseif ( $_reason == '4' ) {
        $reason = 'The plugin suddenly stopped working';
      } elseif ( $_reason == '5' ) {
        $reason = 'I no longer need the plugin';
      } elseif ( $_reason == '6' ) {
        $reason = 'It\'s a temporary deactivation. I\'m just debugging an issue.';
      } elseif ( $_reason == '7' ) {
        $reason = 'Other';
      }
      $fields = array(
        'email' 		        => $email,
        'website' 			    => get_site_url(),
        'action'            => 'Deactivate',
        'reason'            => $reason,
        'reason_detail'     => $reason_detail,
        'blog_language'     => get_bloginfo( 'language' ),
        'wordpress_version' => get_bloginfo( 'version' ),
        'php_version'       => PHP_VERSION,
        'plugin_version'    => CUSTOM_VERSION,
        'plugin_name' 			=> 'ThemeSetting Free',
      );

      $response = wp_remote_post( CUSTOM_FEEDBACK_SERVER, array(
        'method'      => 'POST',
        'timeout'     => 5,
        'httpversion' => '1.0',
        'blocking'    => false,
        'headers'     => array(),
        'body'        => $fields,
      ) );

      wp_die();
    }

    /**
     * Opt-out
     * @since  1.0.15
     */
    function optout_yes() {

      check_ajax_referer( 'themes-optout-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      update_option( '_themes_optin', 'no' );
      wp_die();
    }

    static function presets() {

      check_ajax_referer( 'themes-preset-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      $selected_preset = get_option( 'customize_presets_settings', true );

      if ( $selected_preset == 'default1' ) {
      	include_once CUSTOM_ROOT_PATH . 'css/themes/default-1.php';
      	echo first_presets();
      } else {
      	do_action( 'themes_add_pro_theme', $selected_preset );
      }
      wp_die();
    }

    /**
     * [video_url description]
     * @since 1.1.22
     * @version 1.1.23
     * @return string attachment URL.
     */
    static function video_url(){

      check_ajax_referer( 'themes-attachment-nonce', 'security' );

      if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'No cheating, huh!' );
      }

      echo wp_get_attachment_url( $_POST['src'] );

      wp_die();
    }
  }

endif;
new Themes_Setting_AJAX();
?>
