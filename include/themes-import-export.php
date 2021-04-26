<?php
/**
 * ThemeSetting Import Export Page Content.
 * @package ThemeSetting
 * @since 1.0.19
 * @version 1.1.14
 */

$themes_import_nonce = wp_create_nonce('themes-import-nonce');
$themes_export_nonce = wp_create_nonce('themes-export-nonce');
?>
<div class="themes-import-export-page">
  <h2><?php esc_html_e( 'Import/Export ThemeSetting Settings', 'themes' ); ?></h2>
  <div class=""><?php esc_html_e( "Import/Export your ThemeSetting Settings for/from other sites. This will export/import all the settings including Customizer settings as well.", 'themes' ); ?></div>
  <table class="form-table">
    <tbody>
    <tr class="import_setting">
        <th scope="row">
          <label for="themes_configure[import_setting]"><?php esc_html_e( 'Import Settings:', 'themes' ); ?></label>
        </th>
        <td>
          <input type="file" name="themes_settingsImport" id="themes_settingsImport">
          <input type="button" class="button themes-import" value="<?php esc_html_e( 'Import', 'themes' ); ?>" multiple="multiple" disabled="disabled">
          <input type="hidden" class="themes_import_nonce" name="themes_import_nonce" value="<?php echo $themes_import_nonce; ?>">
          <span class="import-sniper">
            <img src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>">
          </span>
          <span class="import-text"><?php esc_html_e( 'ThemeSetting Settings Imported Successfully.', 'themes' ); ?></span>
          <span class="wrong-import"></span>
          <p class="description"><?php esc_html_e( 'Select a file and click on Import to start processing.', 'themes' ); ?></p>
        </td>
      </tr>
      <tr class="export_setting">
        <th scope="row">
          <label for="themes_configure[export_setting]"><?php esc_html_e( 'Export Settings:', 'themes' ); ?></label>
        </th>
        <td>
          <input type="button" class="button themes-export" value="<?php esc_html_e( 'Export', 'themes' ); ?>">
          <input type="hidden" class="themes_export_nonce" name="themes_export_nonce" value="<?php echo $themes_export_nonce; ?>">
          <span class="export-sniper">
            <img src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>">
          </span>
          <span class="export-text"><?php esc_html_e( 'ThemeSetting Settings Exported Successfully!', 'themes' ); ?></span>
          <p class="description"><?php esc_html_e( 'Export ThemeSetting Settings.', 'themes' ) ?></p>
        </td>
      </tr>
    </tbody>
  </table>
</div>
