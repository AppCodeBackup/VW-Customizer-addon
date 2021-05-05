<?php
/**
* Create ThemeSetting Page.
*
* @package   ThemeSetting
* @author    WPBrigade
* @since     1.1.3
* @version   1.1.25
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
* Create a ThemeSetting page for Multisite.
*/

if ( ! class_exists( 'Themes_Setting_Page_Create' ) ) :

  class Themes_Setting_Page_Create {

    function __construct()
    {
      $this->_init();
      $this->_hooks();
    }

    function _hooks(){
      add_action( 'wpmu_new_blog', array( $this, 'themes_new_site_created' ), 10, 6 );
    }

    public function _init(){
      global $wpdb;

      if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
      }

      if ( is_multisite() ) {

        foreach ( $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs LIMIT 100" ) as $blog_id ) {
          switch_to_blog( $blog_id );
          $this->themes_run_install();
          restore_current_blog();
        }

      } else {
        $this->themes_run_install();
      }
    }

    /**
    * Run the ThemeSetting install process
    *
    * @return void
    */
    public function themes_run_install() {

      /* translators: 1: Name of this plugin */
      $post_content = sprintf( __( '<p>This page is used by %1$s to preview the login page in the Customizer.</p>', 'themes' ), 'ThemeSetting' );

      $pages = apply_filters(
        'themes_create_pages', array(
          'themes' => array(
            'name'    => _x( 'themes', 'Page slug', 'themes' ),
            'title'   => _x( 'ThemeSetting', 'Page title', 'themes' ),
            'content' => $post_content,
          ),
        )
      );

      foreach ( $pages as $key => $page ) {
        $this->themes_create_page( esc_sql( $page['name'] ), 'themes_page', $page['title'], $page['content'] );
      }
    }

    /**
    * Create a page and store the ID in an option.
    *
    * @param mixed  $slug Slug for the new page.
    * @param string $option Option name to store the page's ID.
    * @param string $page_title (default: '') Title for the new page.
    * @param string $page_content (default: '') Content for the new page.
    * @return int   page ID
    */
    public function themes_create_page( $slug, $option = '', $page_title = '', $page_content = '' ) {
      global $wpdb;

      // Set up options.
      $options = array();

      // Pull options from WP.
      $themes_setting = get_option( 'themes_setting', array() );
      if ( ! is_array( $themes_setting ) && empty( $themes_setting ) ) {
        $themes_setting = array();
      }
      $option_value  = array_key_exists( 'themes_page', $themes_setting ) ? $themes_setting['themes_page'] : false;

      if ( $option_value > 0 && ( $page_object = get_post( $option_value ) ) ) {
        if ( 'page' === $page_object->post_type && ! in_array( $page_object->post_status, array( 'pending', 'trash', 'future', 'auto-draft' ), true ) ) {
          // Valid page is already in place.
          return $page_object->ID;
        }
      }

      // Search for an existing page with the specified page slug.
      $themes_page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status NOT IN ( 'pending', 'trash', 'future', 'auto-draft' )  AND post_name = %s LIMIT 1;", $slug ) );

      $themes_page_found = apply_filters( 'themes_create_page_id', $themes_page_found, $slug, $page_content );

      if ( $themes_page_found ) {

        if ( $option ) {

          $options['themes_page']     = $themes_page_found;
          $themes_page_found          = isset( $page_id ) ? $themes_page_found : $option_value;
          $merged_options                 = array_merge( $themes_setting, $options );
          $themes_setting             = $merged_options;

          update_option( 'themes_setting', $themes_setting );
        }
        return $themes_page_found;
      }

      // Search for an existing page with the specified page slug.
      $themes_trashed_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'trash' AND post_name = %s LIMIT 1;", $slug ) );

      if ( $themes_trashed_found ) {
        $page_id   = $themes_trashed_found;
        $page_data = array(
          'ID'          => $page_id,
          'post_status' => 'publish',
        );

        wp_update_post( $page_data );

      } else {

        $page_data = array(
          'post_status'    => 'publish',
          'post_type'      => 'page',
          'post_author'    => 1,
          'post_name'      => $slug,
          'post_title'     => $page_title,
          'post_content'   => $page_content,
          'comment_status' => 'closed',
        );

        $page_id = wp_insert_post( $page_data );
      }

      if ( $option ) {

        $options['themes_page'] = $page_id;
        $page_id                        = isset( $page_id ) ? $page_id : $option_value;
        $merged_options                 = array_merge( $themes_setting, $options );
        $themes_setting             = $merged_options;

        update_option( 'themes_setting', $themes_setting );
      }

      // Assign the ThemeSetting template.
      $this->themes_attach_template_to_page( $page_id, 'template-themes.php' );

      return $page_id;
    }

    /**
    * Attaches the specified template to the page identified by the specified name.
    *
    * @param int|int $page The id of the page to attach the template.
    * @param int|int $template The template's filename (assumes .php' is specified).
    *
    * @returns -1 if the page does not exist; otherwise, the ID of the page.
    */
    public function themes_attach_template_to_page( $page, $template ) {

      // Only attach the template if the page exists.
      if ( -1 !== $page ) {
        update_post_meta( $page, '_wp_page_template', $template );
      }

      return $page;
    }

    /**
    * When a new Blog is created in multisite, check if ThemeSetting is network activated, and run the installer
    *
    * @param int|int     $blog_id The Blog ID created.
    * @param int|int     $user_id The User ID set as the admin.
    * @param string      $domain The URL.
    * @param string      $path Site Path.
    * @param int|int     $site_id The Site ID.
    * @param array|array $meta Blog Meta.
    * @return void
    */
    public function themes_new_site_created( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

      if ( is_plugin_active_for_network( plugin_basename( CUSTOM_ROOT_FILE ) ) ) {

        switch_to_blog( $blog_id );
        $this->_init();
        restore_current_blog();

      }
    }
  }

endif;
?>
