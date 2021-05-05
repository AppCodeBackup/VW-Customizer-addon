<?php
/**
 * Get the Template and implement it's design.
 * @since  1.0.9
 */
$selected_preset = get_option( 'customize_presets_settings', true );

if ( $selected_preset == 'default1' ) {
	include_once CUSTOM_ROOT_PATH . 'css/themes/default-1.php';
	echo first_presets();
} else {
	do_action( 'themes_add_pro_theme', $selected_preset );
}
?>
