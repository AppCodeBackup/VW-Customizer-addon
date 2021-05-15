<?php
/**
* Uninstall ThemeSetting.
*
* @package themes
* @author vwthemes
* @since 1.1.9
*/

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$themes_setting      = get_option( 'themes_setting' );
$themes_uninstall 	 = isset( $themes_setting['themes_uninstall'] ) ? $themes_setting['themes_uninstall'] : 'off';
if ( 'on' != $themes_uninstall ) {
	return;
}

// Load the ThemeSetting file.
require_once 'themes.php';

// Array of Plugin's Option.
$themes_uninstall_options = array(
	'themes_customization',
	'themes_setting',
	'themes_addon_active_time',
	'themes_addon_dismiss_1',
	'themes_review_dismiss',
	'themes_active_time',
	'_themes_optin',
	'themes_friday_sale_active_time',
	'themes_friday_sale_dismiss',
);

if ( ! is_multisite() ) {

	// Delete all plugin Options.
	foreach ( $themes_uninstall_options as $option ) {
		if ( get_option( $option ) ) {
			delete_option( $option );
		}
	}

} else {

	global $wpdb;
	$themes_blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

	foreach ( $themes_blog_ids as $blog_id ) {

		switch_to_blog( $blog_id );

		// Pull the ThemeSetting page from options.
		$themes             = new ThemeSetting();
		$themes_page        = $themes->get_themes_page();
		$themes_page_id     = $themes_page->ID;

		wp_trash_post( $themes_page_id );

		// Delete all plugin Options.
		foreach ( $themes_uninstall_options as $option ) {
			if ( get_option( $option ) ) {
				delete_option( $option );
			}
		}

		restore_current_blog();
	}
}


// Clear any cached data that has been removed.
// wp_cache_flush();
