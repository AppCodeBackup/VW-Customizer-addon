<?php
/**
 * Get option and check the key exists in it.
 *
 * @since 1.0.0
 * @version 1.4.3
 * * * * * * * * * * * * * * * */


 /**
 * @var themes_array get_option
 * @since 1.0.0
 */
$themes_array  = (array) get_option( 'themes_customization' );
$themes_preset = get_option( 'customize_presets_settings', 'default1' );

function themes_get_option_key( $themes_key, $themes_array ) {

	if ( array_key_exists( $themes_key, $themes_array ) ) {

		if ( 'themes_custom_css' == $themes_key ) {
			return $themes_array[ $themes_key ];
		} else {
			return esc_js( $themes_array[ $themes_key ] );
		}

	}
}

/**
 * [themes_bg_option Check the background image of the template.]
 * @param  string $themes_key   [description]
 * @param  array $themes_array [description]
 * @return string                   [description]
 * @since 1.1.0
 * @version 1.1.1
 */
function themes_bg_option( $themes_key, $themes_array ) {

	if ( array_key_exists( $themes_key, $themes_array ) ) {

		return $themes_array[ $themes_key ];
	} else {
    return true;
  }
}

/**
 * [themes_check_px Return the value with 'px']
 * @param  string $value [description]
 * @return string        [description]
 * @since 1.1.0
 */
function themes_check_px( $value ) {

  if ( strpos( $value, "px" ) ) {
    return $value;
  } else {
		if ( ! empty( $value ) ) {
			return $value . 'px';
		}
  }
}

/**
 * [themes_check_percentage Return the value with '%']
 * @param  string $value [description]
 * @return string        [description]
 * @since 1.1.0
 */
function themes_check_percentage( $value ) {

  if ( strpos( $value, "%" ) ) {
    return $value;
  } else {
		if ( ! empty( $value ) ) {
			return $value . '%';
		}
  }
}

/**
 * [if for login page background]
 * @since 1.1.0
 * @version 1.1.2
 * @return string
 */
$themes_custom_background  = themes_get_option_key( 'setting_background', $themes_array );
$themes_gallery_background = themes_get_option_key( 'gallery_background', $themes_array );
if ( ! empty ( $themes_custom_background ) ) { // Use Custom Background
	$themes_background_img = $themes_custom_background;
} else if ( ! empty ( $themes_gallery_background ) ) { // Background from Gallery Control.
	if ( CUSTOM_DIR_URL . 'img/gallery/img-1.jpg' == $themes_gallery_background ) { // If user select 1st image from gallery control then show template's default image.
		$themes_background_img = '';
	} else { // Use selected image from gallery control.
		$themes_background_img = $themes_gallery_background;
	}
} else { // exceptional case (use default image).
	$themes_background_img = '';
}

/**
 * Add !important with property's value. To avoid overriding from theme.
 * @return string
 * @since 1.1.2
 */
function themes_important() {

	$important = '';
	if ( ! is_customize_preview() ) { // Avoid !important in customizer previewer.
		$important = ' !important';
	}
	return $important;
}
?>
<?php
$themes_topbar_display = themes_get_option_key( 'setting_topbar_display', $themes_array );
$themes_topbar_background_color = themes_get_option_key( 'setting_topbar_background_color', $themes_array );
$topbar_bgcolor = themes_get_option_key( 'topbar_bgcolor', $themes_array );
$topbar_bg_image = themes_get_option_key( 'topbar_bg_image', $themes_array );
$themes_topbar_background_img = themes_get_option_key( 'setting_topbar_background', $themes_array );
$themes_topbar_text_color = themes_get_option_key( 'setting_topbar_text_color', $themes_array );
$setting_topbar_text_font_family = themes_get_option_key( 'setting_topbar_text_font_family', $themes_array );
$setting_topbar_text_size = themes_get_option_key( 'setting_topbar_text_size', $themes_array );
$topbar_text_heading = themes_get_option_key( 'topbar_text_heading', $themes_array );
//slider
$slider_enabledisable = themes_get_option_key( 'slider_enabledisable', $themes_array );
$themes_slider_small_Heading_color = themes_get_option_key( 'themes_slider_small_Heading_color', $themes_array );
$themes_slider_small_Heading_font_family = themes_get_option_key( 'themes_slider_small_Heading_font_family', $themes_array );
$themes_slider_small_heading_font_size = themes_get_option_key( 'themes_slider_small_heading_font_size', $themes_array );

$themes_main_heading_color = themes_get_option_key( 'themes_main_heading_color', $themes_array );
$themes_main_heading_font_family = themes_get_option_key( 'themes_main_heading_font_family', $themes_array );
$themes_main_heading_font_size = themes_get_option_key( 'themes_main_heading_font_size', $themes_array );

$themes_slider_section_text_color = themes_get_option_key( 'themes_slider_section_text_color', $themes_array );
$themes_slider_section_text_font_family = themes_get_option_key( 'themes_slider_section_text_font_family', $themes_array );
$themes_slider_section_text_font_size = themes_get_option_key( 'themes_slider_section_text_font_size', $themes_array );

$themes_slide_tabcolor = themes_get_option_key( 'themes_slide_tabcolor', $themes_array );

$themes_slide_buttoncolor = themes_get_option_key( 'themes_slide_buttoncolor', $themes_array );
$themes_button_fontfamily = themes_get_option_key( 'themes_button_fontfamily', $themes_array );
$themes_slide_button_font_size = themes_get_option_key( 'themes_slide_button_font_size', $themes_array );
$themes_slide_button_gradient_bgcolor1 = themes_get_option_key( 'themes_slide_button_gradient_bgcolor1', $themes_array );
//Our Features
$radio_features_enable = themes_get_option_key( 'radio_features_enable', $themes_array );
$features_small_text_color = themes_get_option_key( 'features_small_text_color', $themes_array );
$features_small_text_fontfamily = themes_get_option_key( 'features_small_text_fontfamily', $themes_array );
$features_small_text_font_size = themes_get_option_key( 'features_small_text_font_size', $themes_array );
$features_main_text_color = themes_get_option_key( 'features_main_text_color', $themes_array );
$features_main_text_fontfamily = themes_get_option_key( 'features_main_text_fontfamily', $themes_array );
$features_main_text_font_size = themes_get_option_key( 'features_main_text_font_size', $themes_array );
$features_dicsount_text_color = themes_get_option_key( 'features_dicsount_text_color', $themes_array );
$features_dicsount_text_fontfamily = themes_get_option_key( 'features_dicsount_text_fontfamily', $themes_array );
$features_dicsount_text_font_size = themes_get_option_key( 'features_dicsount_text_font_size', $themes_array );
//about us
$radio_about_enable = themes_get_option_key( 'radio_about_enable', $themes_array );

$about_smalltitle_left_color = themes_get_option_key( 'about_smalltitle_left_color', $themes_array );
$about_smalltitle_left_fontfamily = themes_get_option_key( 'about_smalltitle_left_fontfamily', $themes_array );
$about_smalltitle_left_font_size = themes_get_option_key( 'about_smalltitle_left_font_size', $themes_array );
$about_smalltitle_left_bgcolor = themes_get_option_key( 'about_smalltitle_left_bgcolor', $themes_array );

$about_smalltitle_right_color = themes_get_option_key( 'about_smalltitle_right_color', $themes_array );
$about_smalltitle_right_fontfamily = themes_get_option_key( 'about_smalltitle_right_fontfamily', $themes_array );
$about_smalltitle_right_font_size = themes_get_option_key( 'about_smalltitle_right_font_size', $themes_array );
$about_smalltitle_right_bgcolor = themes_get_option_key( 'about_smalltitle_right_bgcolor', $themes_array );

$about_main_title_color = themes_get_option_key( 'about_main_title_color', $themes_array );
$about_main_title_fontfamily = themes_get_option_key( 'about_main_title_fontfamily', $themes_array );
$about_main_title_font_size = themes_get_option_key( 'about_main_title_font_size', $themes_array );

$about_list_title_color = themes_get_option_key( 'about_list_title_color', $themes_array );
$about_list_title_fontfamily = themes_get_option_key( 'about_list_title_fontfamily', $themes_array );
$about_list_title_font_size = themes_get_option_key( 'about_list_title_font_size', $themes_array );

$about_text_color = themes_get_option_key( 'about_text_color', $themes_array );
$about_text_fontfamily = themes_get_option_key( 'about_text_fontfamily', $themes_array );
$about_text_font_size = themes_get_option_key( 'about_text_font_size', $themes_array );

$about_button_text_color = themes_get_option_key( 'about_button_text_color', $themes_array );
$about_button_text_fontfamily = themes_get_option_key( 'about_button_text_fontfamily', $themes_array );
$about_button_text_font_size = themes_get_option_key( 'about_button_text_font_size', $themes_array );
$about_button_bg_color = themes_get_option_key( 'about_button_bg_color', $themes_array );

$about_extra_text_color = themes_get_option_key( 'about_extra_text_color', $themes_array );
$about_extra_text_fontfamily = themes_get_option_key( 'about_extra_text_fontfamily', $themes_array );
$about_extra_text_font_size = themes_get_option_key( 'about_extra_text_font_size', $themes_array );
$about_extra_text_bg_color = themes_get_option_key( 'about_extra_text_bg_color', $themes_array );

//product sec
$radio4_enable = themes_get_option_key( 'radio4_enable', $themes_array );

$pro_small_left_title_color = themes_get_option_key( 'pro_small_left_title_color', $themes_array );
$pro_small_left_title_fontfamily = themes_get_option_key( 'pro_small_left_title_fontfamily', $themes_array );
$pro_small_left_title_font_size = themes_get_option_key( 'pro_small_left_title_font_size', $themes_array );
$pro_small_left_titlebg_color = themes_get_option_key( 'pro_small_left_titlebg_color', $themes_array );

$pro_small_right_title_color = themes_get_option_key( 'pro_small_right_title_color', $themes_array );
$pro_small_right_title_fontfamily = themes_get_option_key( 'pro_small_right_title_fontfamily', $themes_array );
$pro_small_right_title_font_size = themes_get_option_key( 'pro_small_right_title_font_size', $themes_array );
$pro_small_right_titlebg_color = themes_get_option_key( 'pro_small_right_titlebg_color', $themes_array );

$pro_main_title_color = themes_get_option_key( 'pro_main_title_color', $themes_array );
$pro_main_title_fontfamily = themes_get_option_key( 'pro_main_title_fontfamily', $themes_array );
$pro_main_title_font_size = themes_get_option_key( 'pro_main_title_font_size', $themes_array );

$pro_tab_title_color = themes_get_option_key( 'pro_tab_title_color', $themes_array );
$pro_tab_title_fontfamily = themes_get_option_key( 'pro_tab_title_fontfamily', $themes_array );
$pro_tab_title_font_size = themes_get_option_key( 'pro_tab_title_font_size', $themes_array );

$pro_tab_title_active_color = themes_get_option_key( 'pro_tab_title_active_color', $themes_array );
$pro_tab_title_active_fontfamily = themes_get_option_key( 'pro_tab_title_active_fontfamily', $themes_array );
$pro_tab_title_active_font_size = themes_get_option_key( 'pro_tab_title_active_font_size', $themes_array );
$pro_tab_title_active_bgcolor = themes_get_option_key( 'pro_tab_title_active_bgcolor', $themes_array );

$product_background_color = themes_get_option_key( 'product_background_color', $themes_array );

$product_title_color = themes_get_option_key( 'product_title_color', $themes_array );
$product_title_fontfamily = themes_get_option_key( 'product_title_fontfamily', $themes_array );
$product_title_font_size = themes_get_option_key( 'product_title_font_size', $themes_array );

$product_text_color = themes_get_option_key( 'product_text_color', $themes_array );
$product_text_fontfamily = themes_get_option_key( 'product_text_fontfamily', $themes_array );
$product_text_font_size = themes_get_option_key( 'product_text_font_size', $themes_array );

$product_price_text_color = themes_get_option_key( 'product_price_text_color', $themes_array );
$product_price_text_fontfamily = themes_get_option_key( 'product_price_text_fontfamily', $themes_array );
$product_price_text_font_size = themes_get_option_key( 'product_price_text_font_size', $themes_array );

$product_button_text_color = themes_get_option_key( 'product_button_text_color', $themes_array );
$product_button_text_fontfamily = themes_get_option_key( 'product_button_text_fontfamily', $themes_array );
$product_button_text_font_size = themes_get_option_key( 'product_button_text_font_size', $themes_array );
$product_button_bg_color = themes_get_option_key( 'product_button_bg_color', $themes_array );
//our app
$radio_our_app_enable = themes_get_option_key( 'radio_our_app_enable', $themes_array );

$app_small_left_title_color = themes_get_option_key( 'app_small_left_title_color', $themes_array );
$app_small_left_title_fontfamily = themes_get_option_key( 'app_small_left_title_fontfamily', $themes_array );
$app_small_left_title_font_size = themes_get_option_key( 'app_small_left_title_font_size', $themes_array );
$app_small_titlebg_color = themes_get_option_key( 'app_small_titlebg_color', $themes_array );

$app_main_title_color = themes_get_option_key( 'app_main_title_color', $themes_array );
$app_main_title_fontfamily = themes_get_option_key( 'app_main_title_fontfamily', $themes_array );
$app_main_title_font_size = themes_get_option_key( 'app_main_title_font_size', $themes_array );

$app_main_text_color = themes_get_option_key( 'app_main_text_color', $themes_array );
$app_main_text_fontfamily = themes_get_option_key( 'app_main_text_fontfamily', $themes_array );
$app_main_text_font_size = themes_get_option_key( 'app_main_text_font_size', $themes_array );

$app_box_bg_color = themes_get_option_key( 'app_box_bg_color', $themes_array );

$app_box_icons_color = themes_get_option_key( 'app_box_icons_color', $themes_array );
$app_box_icons_font_size = themes_get_option_key( 'app_box_icons_font_size', $themes_array );
$app_box_icons_hovercolor = themes_get_option_key( 'app_box_icons_hovercolor', $themes_array );

$app_box_title_color = themes_get_option_key( 'app_box_title_color', $themes_array );
$app_box_title_fontfamily = themes_get_option_key( 'app_box_title_fontfamily', $themes_array );
$app_main_text_font_size = themes_get_option_key( 'app_box_title_font_size', $themes_array );

$app_box_text_color = themes_get_option_key( 'app_box_text_color', $themes_array );
$app_box_text_fontfamily = themes_get_option_key( 'app_box_text_fontfamily', $themes_array );
$app_box_text_font_size = themes_get_option_key( 'app_box_text_font_size', $themes_array );
//Our Partner
$radio_our_partners_enable = themes_get_option_key( 'radio_our_partners_enable', $themes_array );
$our_partners_bg_color = themes_get_option_key( 'our_partners_bg_color', $themes_array );
$our_partners_bg_hovercolor = themes_get_option_key( 'our_partners_bg_hovercolor', $themes_array );
//Our Services
$services_enabledisable = themes_get_option_key( 'services_enabledisable', $themes_array );

$themes_servicesmall_title_color = themes_get_option_key( 'themes_servicesmall_title_color', $themes_array );
$themes_servicesmall_title_font_family = themes_get_option_key( 'themes_servicesmall_title_font_family', $themes_array );
$themes_servicesmall_title_font_size = themes_get_option_key( 'themes_servicesmall_title_font_size', $themes_array );

$themes_servicesmall_title_bgcolor = themes_get_option_key( 'themes_servicesmall_title_bgcolor', $themes_array );

$themes_service_title_color = themes_get_option_key( 'themes_service_title_color', $themes_array );
$themes_service_title_font_family = themes_get_option_key( 'themes_service_title_font_family', $themes_array );
$themes_service_title_font_size = themes_get_option_key( 'themes_service_title_font_size', $themes_array );

$themes_service_subtext_color = themes_get_option_key( 'themes_service_subtext_color', $themes_array );
$themes_service_text_font_family = themes_get_option_key( 'themes_service_text_font_family', $themes_array );
$themes_service_text_font_size = themes_get_option_key( 'themes_service_text_font_size', $themes_array );

$themes_service_box_icons_bg_color = themes_get_option_key( 'themes_service_box_icons_bg_color', $themes_array );
$themes_service_box_icons_bg_hovercolor = themes_get_option_key( 'themes_service_box_icons_bg_hovercolor', $themes_array );

$themes_service_box_title_color = themes_get_option_key( 'themes_service_box_title_color', $themes_array );
$themes_service_box_title_font_family = themes_get_option_key( 'themes_service_box_title_font_family', $themes_array );
$themes_service_box_title_font_size = themes_get_option_key( 'themes_service_box_title_font_size', $themes_array );

$themes_service_box_content_color = themes_get_option_key( 'themes_service_box_content_color', $themes_array );
$themes_service_box_content_font_family = themes_get_option_key( 'themes_service_box_content_font_family', $themes_array );
$themes_service_box_content_font_size = themes_get_option_key( 'themes_service_box_content_font_size', $themes_array );
//Degines interface
$radio_interface_deg_enable = themes_get_option_key( 'radio_interface_deg_enable', $themes_array );

$interface_main_title_color = themes_get_option_key( 'interface_main_title_color', $themes_array );
$interface_main_title_fontfamily = themes_get_option_key( 'interface_main_title_fontfamily', $themes_array );
$interface_main_title_font_size = themes_get_option_key( 'interface_main_title_font_size', $themes_array );

$radio_introduction_enable = themes_get_option_key( 'radio_introduction_enable', $themes_array );

//Home Contact
$contact_us_enable = themes_get_option_key( 'contact_us_enable', $themes_array );
$contact_us_bgcolor = themes_get_option_key( 'contact_us_bgcolor', $themes_array );
$contact_us_bgimage = themes_get_option_key( 'contact_us_bgimage', $themes_array );

$contact_us_title_color_first = themes_get_option_key( 'contact_us_title_color_first', $themes_array );
$contact_us_title_font_family = themes_get_option_key( 'contact_us_title_font_family', $themes_array );
$contact_us_title_font_size = themes_get_option_key( 'contact_us_title_font_size', $themes_array );

$contact_us_text_color = themes_get_option_key( 'contact_us_text_color', $themes_array );
$contact_us_text_font_family = themes_get_option_key( 'contact_us_text_font_family', $themes_array );
$contact_us_text_font_size = themes_get_option_key( 'contact_us_text_font_size', $themes_array );

$contact_us_form_button_color = themes_get_option_key( 'contact_us_form_button_color', $themes_array );
$contact_us_form_button_font_family = themes_get_option_key( 'contact_us_form_button_font_family', $themes_array );
$contact_us_form_button_font_size = themes_get_option_key( 'contact_us_form_button_font_size', $themes_array );
$contact_us_form_button_bgcolor_first = themes_get_option_key( 'contact_us_form_button_bgcolor_first', $themes_array );

//Best Products
$radio_best_seller_enable = themes_get_option_key( 'radio_best_seller_enable', $themes_array );
$best_seller_bgcolor = themes_get_option_key( 'best_seller_bgcolor', $themes_array );
$best_seller_bgimage = themes_get_option_key( 'best_seller_bgimage', $themes_array );

$best_seller_main_text_color = themes_get_option_key( 'best_seller_main_text_color', $themes_array );
$best_seller_main_text_fontfamily = themes_get_option_key( 'best_seller_main_text_fontfamily', $themes_array );
$best_seller_main_text_font_size = themes_get_option_key( 'best_seller_main_text_font_size', $themes_array );

$best_seller_small_text_color = themes_get_option_key( 'best_seller_small_text_color', $themes_array );
$best_seller_small_text_fontfamily = themes_get_option_key( 'best_seller_small_text_fontfamily', $themes_array );
$best_seller_small_text_font_size = themes_get_option_key( 'best_seller_small_text_font_size', $themes_array );

$seller_sale_title_color = themes_get_option_key( 'seller_sale_title_color', $themes_array );
$seller_sale_title_fontfamily = themes_get_option_key( 'seller_sale_title_fontfamily', $themes_array );
$seller_sale_title_font_size = themes_get_option_key( 'seller_sale_title_font_size', $themes_array );
$seller_sale_bg_color = themes_get_option_key( 'seller_sale_bg_color', $themes_array );

$seller_title_color = themes_get_option_key( 'seller_title_color', $themes_array );
$seller_title_fontfamily = themes_get_option_key( 'seller_title_fontfamily', $themes_array );
$seller_title_font_size = themes_get_option_key( 'seller_title_font_size', $themes_array );

$seller_price_color = themes_get_option_key( 'seller_price_color', $themes_array );
$seller_price_fontfamily = themes_get_option_key( 'seller_price_fontfamily', $themes_array );
$seller_price_font_size = themes_get_option_key( 'seller_price_font_size', $themes_array );

$seller_button_color = themes_get_option_key( 'seller_button_color', $themes_array );
$seller_button_fontfamily = themes_get_option_key( 'seller_button_fontfamily', $themes_array );
$seller_button_font_size = themes_get_option_key( 'seller_button_font_size', $themes_array );
$seller_button_bgcolor = themes_get_option_key( 'seller_button_bgcolor', $themes_array );

//Category Products
$radio_category_products_enable = themes_get_option_key( 'radio_category_products_enable', $themes_array );
$category_products_bgcolor = themes_get_option_key( 'category_products_bgcolor', $themes_array );
$category_products_bgimage = themes_get_option_key( 'category_products_bgimage', $themes_array );

$sec_main_text_color = themes_get_option_key( 'sec_main_text_color', $themes_array );
$sec_main_text_fontfamily = themes_get_option_key( 'sec_main_text_fontfamily', $themes_array );
$sec_main_text_font_size = themes_get_option_key( 'sec_main_text_font_size', $themes_array );

$clock_tittle_text_color = themes_get_option_key( 'clock_tittle_text_color', $themes_array );
$clock_tittle_fontfamily = themes_get_option_key( 'clock_tittle_fontfamily', $themes_array );
$clock_tittle_font_size = themes_get_option_key( 'clock_tittle_font_size', $themes_array );

$clock_bg_color = themes_get_option_key( 'clock_bg_color', $themes_array );

$tab_tittle_text_color = themes_get_option_key( 'tab_tittle_text_color', $themes_array );
$tab_tittle_fontfamily = themes_get_option_key( 'tab_tittle_fontfamily', $themes_array );
$tab_tittle_font_size = themes_get_option_key( 'tab_tittle_font_size', $themes_array );

$tab_tittle_active_color = themes_get_option_key( 'tab_tittle_active_color', $themes_array );

$product_sale_title_color = themes_get_option_key( 'product_sale_title_color', $themes_array );
$product_sale_title_fontfamily = themes_get_option_key( 'product_sale_title_fontfamily', $themes_array );
$product_sale_title_font_size = themes_get_option_key( 'product_sale_title_font_size', $themes_array );

$product_sale_bg_color = themes_get_option_key( 'product_sale_bg_color', $themes_array );

$product_title_color = themes_get_option_key( 'product_title_color', $themes_array );
$product_title_fontfamily = themes_get_option_key( 'product_title_fontfamily', $themes_array );
$product_title_font_size = themes_get_option_key( 'product_title_font_size', $themes_array );

$product_price_color = themes_get_option_key( 'product_price_color', $themes_array );
$product_price_fontfamily = themes_get_option_key( 'product_price_fontfamily', $themes_array );
$product_price_font_size = themes_get_option_key( 'product_price_font_size', $themes_array );

$product_button_color = themes_get_option_key( 'product_button_color', $themes_array );
$product_button_fontfamily = themes_get_option_key( 'product_button_fontfamily', $themes_array );
$product_button_font_size = themes_get_option_key( 'product_button_font_size', $themes_array );
$product_button_bgcolor = themes_get_option_key( 'product_button_bgcolor', $themes_array );

//Newsletter
$newsletter_enable = themes_get_option_key( 'newsletter_enable', $themes_array );
$newsletter_bgcolor = themes_get_option_key( 'newsletter_bgcolor', $themes_array );
$newsletter_bgimage = themes_get_option_key( 'newsletter_bgimage', $themes_array );

$themes_newsletter_title_color_first = themes_get_option_key( 'themes_newsletter_title_color_first', $themes_array );
$themes_newsletter_title_font_family = themes_get_option_key( 'themes_newsletter_title_font_family', $themes_array );
$themes_newsletter_title_font_size = themes_get_option_key( 'themes_newsletter_title_font_size', $themes_array );

$themes_newsletter_text_color = themes_get_option_key( 'themes_newsletter_text_color', $themes_array );
$themes_newsletter_text_font_family = themes_get_option_key( 'themes_newsletter_text_font_family', $themes_array );
$themes_newsletter_text_font_size = themes_get_option_key( 'themes_newsletter_text_font_size', $themes_array );

$themes_newsletter_form_button_color = themes_get_option_key( 'themes_newsletter_form_button_color', $themes_array );
$themes_newsletter_form_button_font_family = themes_get_option_key( 'themes_newsletter_form_button_font_family', $themes_array );
$themes_newsletter_form_button_font_size = themes_get_option_key( 'themes_newsletter_form_button_font_size', $themes_array );
$themes_newsletter_form_button_bgcolor_first = themes_get_option_key( 'themes_newsletter_form_button_bgcolor_first', $themes_array );

$radio_testimonial_enable = themes_get_option_key( 'radio_testimonial_enable', $themes_array );
$testimonial_bgcolor = themes_get_option_key( 'testimonial_bgcolor', $themes_array );
$testimonial_bgimage = themes_get_option_key( 'testimonial_bgimage', $themes_array );
$themes_testimonial_title_color = themes_get_option_key( 'themes_testimonial_title_color', $themes_array );
$themes_testimonial_title_font_family = themes_get_option_key( 'themes_testimonial_title_font_family', $themes_array );
$themes_testimonial_title_font_size = themes_get_option_key( 'themes_testimonial_title_font_size', $themes_array );

$themes_testimonial_subtext_color = themes_get_option_key( 'themes_testimonial_subtext_color', $themes_array );
$themes_testimonial_subtext_font_family = themes_get_option_key( 'themes_testimonial_subtext_font_family', $themes_array );
$themes_testimonial_subtext_font_size = themes_get_option_key( 'themes_testimonial_subtext_font_size', $themes_array );

$themes_testimonial_name_color = themes_get_option_key( 'themes_testimonial_name_color', $themes_array );
$themes_testimonial_name_font_family = themes_get_option_key( 'themes_testimonial_name_font_family', $themes_array );
$themes_testimonial_name_font_size = themes_get_option_key( 'themes_testimonial_name_font_size', $themes_array );

$themes_testimonial_des_color = themes_get_option_key( 'themes_testimonial_des_color', $themes_array );
$themes_testimonial_des_font_family = themes_get_option_key( 'themes_testimonial_des_font_family', $themes_array );
$themes_testimonial_des_font_size = themes_get_option_key( 'themes_testimonial_des_font_size', $themes_array );

$themes_testimonial_qoute_color = themes_get_option_key( 'themes_testimonial_qoute_color', $themes_array );
$themes_testimonial_qoute_font_family = themes_get_option_key( 'themes_testimonial_qoute_font_family', $themes_array );
$themes_testimonial_qoute_font_size = themes_get_option_key( 'themes_testimonial_qoute_font_size', $themes_array );

$themes_testimonial_button_text_color = themes_get_option_key( 'themes_testimonial_button_text_color', $themes_array );
$themes_testimonial_button_text_font_family = themes_get_option_key( 'themes_testimonial_button_text_font_family', $themes_array );
$themes_testimonial_button_text_font_size = themes_get_option_key( 'themes_testimonial_button_text_font_size', $themes_array );
$themes_testimonial_but_bg_color = themes_get_option_key( 'themes_testimonial_but_bg_color', $themes_array );

$video_enable = themes_get_option_key( 'video_enable', $themes_array );

//pricing planse
$pricing_plan_enable = themes_get_option_key( 'pricing_plan_enable', $themes_array );

$pricing_plan_bgcolor = themes_get_option_key( 'pricing_plan_bgcolor', $themes_array );
$pricing_plan_bgimage = themes_get_option_key( 'pricing_plan_bgimage', $themes_array );

$themes_pricing_plan_title_color = themes_get_option_key( 'themes_pricing_plan_title_color', $themes_array );
$themes_pricing_plan_title_font_family = themes_get_option_key( 'themes_pricing_plan_title_font_family', $themes_array );
$themes_pricing_plan_title_font_size = themes_get_option_key( 'themes_pricing_plan_title_font_size', $themes_array );

$pricing_plan_small_title_color = themes_get_option_key( 'pricing_plan_small_title_color', $themes_array );
$pricing_plan_small_title_font_family = themes_get_option_key( 'pricing_plan_small_title_font_family', $themes_array );
$pricing_plan_small_title_font_size = themes_get_option_key( 'pricing_plan_small_title_font_size', $themes_array );

$pricing_plan_para_color = themes_get_option_key( 'pricing_plan_para_color', $themes_array );
$pricing_plan_para_font_family = themes_get_option_key( 'pricing_plan_para_font_family', $themes_array );
$pricing_plan_para_font_size = themes_get_option_key( 'pricing_plan_para_font_size', $themes_array );

$pricing_plan_tab_color = themes_get_option_key( 'pricing_plan_tab_color', $themes_array );
$pricing_plan_tab_font_family = themes_get_option_key( 'pricing_plan_tab_font_family', $themes_array );
$pricing_plan_tab_font_size = themes_get_option_key( 'pricing_plan_tab_font_size', $themes_array );

$pricing_plan_top_text_color = themes_get_option_key( 'pricing_plan_top_text_color', $themes_array );
$pricing_plan_top_text_font_family = themes_get_option_key( 'pricing_plan_top_text_font_family', $themes_array );
$pricing_plan_top_text_font_size = themes_get_option_key( 'pricing_plan_top_text_font_size', $themes_array );

$pricing_plan_bg_color = themes_get_option_key( 'pricing_plan_bg_color', $themes_array );

$plan_list_icons_color = themes_get_option_key( 'plan_list_icons_color', $themes_array );
$plan_list_icons_font_size = themes_get_option_key( 'plan_list_icons_font_size', $themes_array );

$pricing_plan_list_color = themes_get_option_key( 'pricing_plan_list_color', $themes_array );
$pricing_plan_list_font_family = themes_get_option_key( 'pricing_plan_list_font_family', $themes_array );
$pricing_plan_list_font_size = themes_get_option_key( 'pricing_plan_list_font_size', $themes_array );

$plan_but_text_color = themes_get_option_key( 'plan_but_text_color', $themes_array );
$plan_but_text_font_family = themes_get_option_key( 'plan_but_text_font_family', $themes_array );
$plan_but_text_font_size = themes_get_option_key( 'plan_but_text_font_size', $themes_array );

$records_section_enable = themes_get_option_key( 'records_section_enable', $themes_array );

$radio_Instagram_enable = themes_get_option_key( 'radio_Instagram_enable', $themes_array );
$instagram_bg_color = themes_get_option_key( 'instagram_bg_color', $themes_array );
$instagram_bg_image = themes_get_option_key( 'instagram_bg_image', $themes_array );
$instagram_main_text_color = themes_get_option_key( 'instagram_main_text_color', $themes_array );
$instagram_main_text_fontfamily = themes_get_option_key( 'instagram_main_text_fontfamily', $themes_array );
$instagram_main_text_font_size = themes_get_option_key( 'instagram_main_text_font_size', $themes_array );

$instagram_text_color = themes_get_option_key( 'instagram_text_color', $themes_array );
$instagram_text_fontfamily = themes_get_option_key( 'instagram_text_fontfamily', $themes_array );
$instagram_text_font_size = themes_get_option_key( 'instagram_text_font_size', $themes_array );

$radio_get_in_touch_enable = themes_get_option_key( 'radio_get_in_touch_enable', $themes_array );
$get_in_touch_section_bgcolor = themes_get_option_key( 'get_in_touch_section_bgcolor', $themes_array );
$get_in_touch_section_bgimage = themes_get_option_key( 'get_in_touch_section_bgimage', $themes_array );
$get_in_touch_main_text_color = themes_get_option_key( 'get_in_touch_main_text_color', $themes_array );
$get_in_touch_main_text_fontfamily = themes_get_option_key( 'get_in_touch_main_text_fontfamily', $themes_array );
$get_in_touch_main_text_font_size = themes_get_option_key( 'get_in_touch_main_text_font_size', $themes_array );

$get_in_touch_text_color = themes_get_option_key( 'get_in_touch_text_color', $themes_array );
$get_in_touch_text_fontfamily = themes_get_option_key( 'get_in_touch_text_fontfamily', $themes_array );
$get_in_touch_text_font_size = themes_get_option_key( 'get_in_touch_text_font_size', $themes_array );

$get_in_touch_button_bg_color = themes_get_option_key( 'get_in_touch_button_bg_color', $themes_array );
$get_in_touch_button_text_color = themes_get_option_key( 'get_in_touch_button_text_color', $themes_array );
$get_in_touch_button_text_fontfamily = themes_get_option_key( 'get_in_touch_button_text_fontfamily', $themes_array );
$get_in_touch_button_text_font_size = themes_get_option_key( 'get_in_touch_button_text_font_size', $themes_array );

//middle header
  $themes_header_section_logo_title_color = themes_get_option_key( 'themes_header_section_logo_title_color', $themes_array );
  $themes_header_section_logo_title_font_family = themes_get_option_key( 'themes_header_section_logo_title_font_family', $themes_array );
  $themes_header_section_logo_title_font_size = themes_get_option_key( 'themes_header_section_logo_title_font_size', $themes_array );

  $themes_header_section_logo_sub_title_color = themes_get_option_key( 'themes_header_section_logo_sub_title_color', $themes_array );
  $themes_header_section_logo_sub_title_font_family = themes_get_option_key( 'themes_header_section_logo_sub_title_font_family', $themes_array );
  $themes_header_section_logo_sub_title_font_size = themes_get_option_key( 'themes_header_section_logo_sub_title_font_size', $themes_array );

  $header_contact_title_color = themes_get_option_key( 'header_contact_title_color', $themes_array );
  $header_contact_title_font_family = themes_get_option_key( 'header_contact_title_font_family', $themes_array );
  $header_contact_title_font_size = themes_get_option_key( 'header_contact_title_font_size', $themes_array );

  $header_contact_text_color = themes_get_option_key( 'header_contact_text_color', $themes_array );
  $header_contact_text_font_family = themes_get_option_key( 'header_contact_text_font_family', $themes_array );
  $header_contact_text_font_size = themes_get_option_key( 'header_contact_text_font_size', $themes_array );

  $themes_headermenu_color = themes_get_option_key( 'themes_headermenu_color', $themes_array );
  $themes_headermenu_font_family = themes_get_option_key( 'themes_headermenu_font_family', $themes_array );
  $themes_headermenu_font_size = themes_get_option_key( 'themes_headermenu_font_size', $themes_array );
  $themes_header_menuhover_color = themes_get_option_key( 'themes_header_menuhover_color', $themes_array );
  $themes_header_menuhover_bgcolor = themes_get_option_key( 'themes_header_menuhover_bgcolor', $themes_array );
  $themes_header_menuhover_bgcolor_t = themes_get_option_key( 'themes_header_menuhover_bgcolor_t', $themes_array );
  $themes_dropdownbg_color = themes_get_option_key( 'themes_dropdownbg_color', $themes_array );
  $themes_dropdownbg_itemcolor = themes_get_option_key( 'themes_dropdownbg_itemcolor', $themes_array );
  $themes_dropdownbg_item_hovercolor = themes_get_option_key( 'themes_dropdownbg_item_hovercolor', $themes_array );
  $themes_header_menu_active_color = themes_get_option_key( 'themes_header_menu_active_color', $themes_array );
  $themes_dropdownbg_responsivecolor = themes_get_option_key( 'themes_dropdownbg_responsivecolor', $themes_array );

$themes_header_cart_bgcolor = themes_get_option_key( 'themes_header_cart_bgcolor', $themes_array );
$themes_header_cart_color = themes_get_option_key( 'themes_header_cart_color', $themes_array );
$themes_header_cart_font_family = themes_get_option_key( 'themes_header_cart_font_family', $themes_array );
$themes_header_cart_font_size = themes_get_option_key( 'themes_header_cart_font_size', $themes_array );

$themes_header_padding_leftRight = themes_get_option_key( 'themes_header_padding_leftRight', $themes_array );

$themes_header_section_search_font_family = themes_get_option_key( 'themes_header_section_search_font_family', $themes_array );
$themes_header_section_search_font_size = themes_get_option_key( 'themes_header_section_search_font_size', $themes_array );
$themes_header_section_search_color = themes_get_option_key( 'themes_header_section_search_color', $themes_array );

$themes_header_button_text_color = themes_get_option_key( 'themes_header_button_text_color', $themes_array );
$themes_header_button_text_font_size = themes_get_option_key( 'themes_header_button_text_font_size', $themes_array );
$themes_header_button_text_font_family = themes_get_option_key( 'themes_header_button_text_font_family', $themes_array );

$themes_header_button_bg_color = themes_get_option_key( 'themes_header_button_bg_color', $themes_array );

//Footer Widgets
$themes_footer_widget_heading_color = themes_get_option_key( 'themes_footer_widget_heading_color', $themes_array );
$themes_footer_widget_heading_font_family = themes_get_option_key( 'themes_footer_widget_heading_font_family', $themes_array );
$themes_footer_widget_heading_font_size = themes_get_option_key( 'themes_footer_widget_heading_font_size', $themes_array );

$themes_footer_widget_content_color = themes_get_option_key( 'themes_footer_widget_content_color', $themes_array );
$themes_footer_widget_content_font_family = themes_get_option_key( 'themes_footer_widget_content_font_family', $themes_array );
$themes_footer_widget_content_font_size = themes_get_option_key( 'themes_footer_widget_content_font_size', $themes_array );

$themes_footer_widget_bgcolor = themes_get_option_key( 'themes_footer_widget_bgcolor', $themes_array );
$themes_footerw_social_icon_color = themes_get_option_key( 'themes_footerw_social_icon_color', $themes_array );
$themes_footer_social_icon_bgcolor = themes_get_option_key( 'themes_footer_social_icon_bgcolor', $themes_array );
$themes_footer_social_icon_hvr_color = themes_get_option_key( 'themes_footer_social_icon_hvr_color', $themes_array );
$themes_footer_social_icon_hvr_bgcolor = themes_get_option_key( 'themes_footer_social_icon_hvr_bgcolor', $themes_array );
$themes_footer_svg_color = themes_get_option_key( 'themes_footer_svg_color', $themes_array );
//Footer Copyright
$themes_footer_copy_content_color = themes_get_option_key( 'themes_footer_copy_content_color', $themes_array );
$themes_footer_copy_content_font_family = themes_get_option_key( 'themes_footer_copy_content_font_family', $themes_array );
$themes_footer_copy_content_font_size = themes_get_option_key( 'themes_footer_copy_content_font_size', $themes_array );
$themes_footer_copy_border_color = themes_get_option_key( 'themes_footer_copy_border_color', $themes_array );
//Contact
$themes_contact_page_heading_color = themes_get_option_key( 'themes_contact_page_heading_color', $themes_array );
$themes_contact_page_heading_font_family = themes_get_option_key( 'themes_contact_page_heading_font_family', $themes_array );
$themes_contact_page_heading_font_size = themes_get_option_key( 'themes_contact_page_heading_font_size', $themes_array );

$themes_contact_page_text_color = themes_get_option_key( 'themes_contact_page_text_color', $themes_array );
$themes_contact_page_text_font_family = themes_get_option_key( 'themes_contact_page_text_font_family', $themes_array );
$themes_contact_page_text_font_size = themes_get_option_key( 'themes_contact_page_text_font_size', $themes_array );
$themes_contact_page_content_title_color = themes_get_option_key( 'themes_contact_page_content_title_color', $themes_array );
$themes_contact_page_content_title_font_family = themes_get_option_key( 'themes_contact_page_content_title_font_family', $themes_array );
$themes_contact_page_content_title_font_size = themes_get_option_key( 'themes_contact_page_content_title_font_size', $themes_array );

$themes_contact_page_form_title_color = themes_get_option_key( 'themes_contact_page_form_title_color', $themes_array );
$themes_contact_page_contacts_form_title_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_title_font_family', $themes_array );
$themes_contact_page_contacts_form_title_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_title_font_size', $themes_array );

$themes_contact_page_form_text_color = themes_get_option_key( 'themes_contact_page_form_text_color', $themes_array );
$themes_contact_page_contacts_form_text_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_text_font_family', $themes_array );
$themes_contact_page_contacts_form_text_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_text_font_size', $themes_array );

$themes_contact_page_form_button_color = themes_get_option_key( 'themes_contact_page_form_button_color', $themes_array );
$themes_contact_page_contacts_form_button_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_button_font_family', $themes_array );
$themes_contact_page_contacts_form_button_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_button_font_size', $themes_array );

$themes_contact_page_icon_color = themes_get_option_key( 'themes_contact_page_icon_color', $themes_array );
$themes_contact_page_button_bgcolor1 = themes_get_option_key( 'themes_contact_page_button_bgcolor1', $themes_array );
$themes_contact_page_button_bgcolor2 = themes_get_option_key( 'themes_contact_page_button_bgcolor2', $themes_array );
$themes_contact_page_right_heading_color = themes_get_option_key( 'themes_contact_page_right_heading_color', $themes_array );
$themes_contact_page_right_heading_font_family = themes_get_option_key( 'themes_contact_page_right_heading_font_family', $themes_array );
$themes_contact_page_right_heading_font_size = themes_get_option_key( 'themes_contact_page_right_heading_font_size', $themes_array );

// ----------- Spinner --------------

$themes_general_scroll_top_bgcolor = themes_get_option_key( 'themes_general_scroll_top_bgcolor', $themes_array );
$themes_general_scroll_top_icon_color = themes_get_option_key( 'themes_general_scroll_top_icon_color', $themes_array );
$themes_general_scroll_top_hover_iconcolor = themes_get_option_key( 'themes_general_scroll_top_hover_iconcolor', $themes_array );
$themes_general_scroll_top_hover_bgcolor = themes_get_option_key( 'themes_general_scroll_top_hover_bgcolor', $themes_array );
$themes_spinner_opacity_color = themes_get_option_key( 'themes_spinner_opacity_color', $themes_array );
/* -------------- Frame Setting ------------*/
$themes_site_frame_width = themes_get_option_key( 'themes_site_frame_width', $themes_array );
$themes_site_frame_type = themes_get_option_key( 'themes_site_frame_type', $themes_array );
$themes_site_frame_color = themes_get_option_key( 'themes_site_frame_color', $themes_array );
/* -------------- post images Setting ------------*/
$themes_blog_featured_image_border_radius = themes_get_option_key( 'themes_blog_featured_image_border_radius', $themes_array );
$themes_blog_featured_image_box_shadow = themes_get_option_key( 'themes_blog_featured_image_box_shadow', $themes_array );
/* ------------- Button Settings -------------- */
$themes_button_padding_top = themes_get_option_key( 'themes_button_padding_top', $themes_array );
$themes_button_padding_left = themes_get_option_key( 'themes_button_padding_left', $themes_array );
$themes_button_border_radius = themes_get_option_key( 'themes_button_border_radius', $themes_array );
// ---------- BreadCrumb ------------- 
$themes_site_breadcrumb_color = themes_get_option_key( 'themes_site_breadcrumb_color', $themes_array );
$themes_site_breadcrumb_font_size = themes_get_option_key( 'themes_site_breadcrumb_font_size', $themes_array );
$themes_social_icon_font_size = themes_get_option_key( 'themes_social_icon_font_size', $themes_array );
$themes_social_icon_border_radius = themes_get_option_key( 'themes_social_icon_border_radius', $themes_array );
// -------- 404 Page ---------
$themes_404_page_heading_color = themes_get_option_key( 'themes_404_page_heading_color', $themes_array );
$themes_404_page_heading_font_family = themes_get_option_key( 'themes_404_page_heading_font_family', $themes_array );
$themes_404_page_heading_font_size = themes_get_option_key( 'themes_404_page_heading_font_size', $themes_array );
$themes_404_page_small_heading_color = themes_get_option_key( 'themes_404_page_small_heading_color', $themes_array );
$themes_404_page_small_heading_font_family = themes_get_option_key( 'themes_404_page_small_heading_font_family', $themes_array );
$themes_404_page_small_heading_font_size = themes_get_option_key( 'themes_404_page_small_heading_font_size', $themes_array );
$themes_404_page_text_color = themes_get_option_key( 'themes_404_page_text_color', $themes_array );
$themes_404_page_text_font_family = themes_get_option_key( 'themes_404_page_text_font_family', $themes_array );
$themes_404_page_text_font_size = themes_get_option_key( 'themes_404_page_text_font_size', $themes_array );
$themes_404_page_button_color = themes_get_option_key( 'themes_404_page_button_color', $themes_array );
$themes_404_page_button_font_family = themes_get_option_key( 'themes_404_page_button_font_family', $themes_array );
$themes_404_page_button_font_size = themes_get_option_key( 'themes_404_page_button_font_size', $themes_array );
$themes_404_page_button_bgcolor = themes_get_option_key( 'themes_404_page_button_bgcolor', $themes_array );


/**
 * themes_box_shadow [if user pass 0 then we're not going to set the value of box-shedow because it effects the pro templates.]
 * @param  integer $shadow         [Shadow Value]
 * @param  integer $opacity        [Opacity Value]
 * @param  integer $default_shadow [Sset shadow's default value]
 * @param  boolean $inset 				 [description]
 * @return string                  [box-border value]
 * @since 1.1.3
 */
//$themes_inset = $themes_login_form_inset ? true : false; //var_dump($themes_inset);
function themes_box_shadow( $shadow, $opacity, $default_shadow = 0, $inset = false ) {

	$themes_shadow  = ! empty( $shadow )  ? $shadow  : $default_shadow;
	$themes_opacity = ! empty( $opacity ) ? $opacity : 80;
	$inset              = $inset ? ' inset'              : '';
	$opacity_convertion = $themes_opacity / 100;
	$themes_rgba    = 'rgba( 0,0,0,' . $opacity_convertion . ' )';

	return '0 0 ' . $themes_shadow . 'px ' . $themes_rgba . $inset . ';';
}
// ob_start();
?>
<style type="text/css">
*{
	box-sizing: border-box;
}
#topbar{
	<?php if ( ! empty( $themes_topbar_display ) && true == $themes_topbar_display ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_topbar_background_color ) ) : ?>
	background-color: <?php echo $themes_topbar_background_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_topbar_background_img ) ) : ?>
	background-image: url(<?php echo $themes_topbar_background_img; ?>);
	<?php endif; ?>
}
#topbar{
	<?php if ( ! empty( $topbar_bgcolor ) ) : ?>
	background: linear-gradient(90deg, <?php echo $topbar_bgcolor; ?> 55%, <?php echo $topbar_bgcolor; ?> 0%, <?php echo $topbar_bgcolor; ?> 45%);
	<?php endif; ?>
	<?php if ( ! empty( $topbar_bg_image ) ) : ?>
	background-image: url(<?php echo $topbar_bg_image; ?>);
	<?php endif; ?>
}
#topbar span, #topbar .side-navigation a{
	<?php if ( ! empty( $themes_topbar_text_color ) ) : ?>
	color: <?php echo $themes_topbar_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_topbar_text_font_family ) ) : ?>
	font-family: <?php echo $setting_topbar_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_topbar_text_size ) ) : ?>
	font-size: <?php echo $setting_topbar_text_size; ?>;
	<?php endif; ?>
}
#header .header-logo a{
	<?php if ( ! empty( $themes_header_section_logo_title_color ) ) : ?>
	color: <?php echo $themes_header_section_logo_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_title_font_family ) ) : ?>
	font-family: <?php echo $themes_header_section_logo_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_title_font_size ) ) : ?>
	font-size: <?php echo $themes_header_section_logo_title_font_size; ?>;
	<?php endif; ?>
}
#header .header-logo p.tagline{
	<?php if ( ! empty( $themes_header_section_logo_sub_title_color ) ) : ?>
	color: <?php echo $themes_header_section_logo_sub_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_sub_title_font_family ) ) : ?>
	font-family: <?php echo $themes_header_section_logo_sub_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_sub_title_font_size ) ) : ?>
	font-size: <?php echo $themes_header_section_logo_sub_title_font_size; ?>;
	<?php endif; ?>
}
.top-content .contentbx h5{
	<?php if ( ! empty( $header_contact_title_color ) ) : ?>
	color: <?php echo $header_contact_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $header_contact_title_font_family ) ) : ?>
	font-family: <?php echo $header_contact_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $header_contact_title_font_size ) ) : ?>
	font-size: <?php echo $header_contact_title_font_size; ?>;
	<?php endif; ?>
}
.top-content .contentbx p{
	<?php if ( ! empty( $header_contact_text_color ) ) : ?>
	color: <?php echo $header_contact_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $header_contact_text_font_family ) ) : ?>
	font-family: <?php echo $header_contact_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $header_contact_text_font_size ) ) : ?>
	font-size: <?php echo $header_contact_text_font_size; ?>;
	<?php endif; ?>
}
.side-navigation a{
	<?php if ( ! empty( $themes_headermenu_color ) ) : ?>
	color: <?php echo $themes_headermenu_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_headermenu_font_family ) ) : ?>
	font-family: <?php echo $themes_headermenu_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_headermenu_font_size ) ) : ?>
	font-size: <?php echo $themes_headermenu_font_size; ?>;
	<?php endif; ?>
}
.main-header .side-navigation ul li a:hover{
	<?php if ( ! empty( $themes_header_menuhover_color ) ) : ?>
	color: <?php echo $themes_header_menuhover_color; ?>;
	<?php endif; ?>
	filter: drop-shadow(4.5px 7.794px 13.5px <?php echo $themes_header_menuhover_bgcolor; ?>);
    background-image: linear-gradient(57deg, <?php echo $themes_header_menuhover_bgcolor; ?> 0%, <?php echo $themes_header_menuhover_bgcolor_t; ?> 100%);
}
.main-header .side-navigation ul ul{
	<?php if ( ! empty( $themes_dropdownbg_color ) ) : ?>
	background-color: <?php echo $themes_dropdownbg_color; ?>;
	<?php endif; ?>
}
.main-header .side-navigation ul ul a{
	<?php if ( ! empty( $themes_dropdownbg_itemcolor ) ) : ?>
	color: <?php echo $themes_dropdownbg_itemcolor; ?>;
	<?php endif; ?>
}
.side-navigation li.current_page_item a{
	<?php if ( ! empty( $themes_header_menu_active_color ) ) : ?>
	color: <?php echo $themes_header_menu_active_color; ?>;
	<?php endif; ?>
}
#sidebar1{
	<?php if ( ! empty( $themes_dropdownbg_responsivecolor ) ) : ?>
	background: <?php echo $themes_dropdownbg_responsivecolor; ?>;
	<?php endif; ?>
}
#cartbx{
	<?php if ( ! empty( $themes_header_cart_bgcolor ) ) : ?>
	background: <?php echo $themes_header_cart_bgcolor; ?>;
	<?php endif; ?>
}
.menubar .cart .currentcont{
	<?php if ( ! empty( $themes_header_cart_color ) ) : ?>
	color: <?php echo $themes_header_cart_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_cart_font_family ) ) : ?>
	font-family: <?php echo $themes_header_cart_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_cart_font_size ) ) : ?>
	font-size: <?php echo $themes_header_cart_font_size; ?>;
	<?php endif; ?>
}
.side-navigation li a{
	<?php if ( ! empty( $themes_header_padding_leftRight ) ) : ?>
	padding-left: <?php echo $themes_header_padding_leftRight; ?>;
	padding-right: <?php echo $themes_header_padding_leftRight; ?>;
	<?php endif; ?>
}
.menubar input[type="search"]::placeholder{
	<?php if ( ! empty( $themes_header_section_search_color ) ) : ?>
	color: <?php echo $themes_header_section_search_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_search_font_family ) ) : ?>
	font-family: <?php echo $themes_header_section_search_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_search_font_size ) ) : ?>
	font-size: <?php echo $themes_header_section_search_font_size; ?>;
	<?php endif; ?>
}
.menubar .topbtn{
	<?php if ( ! empty( $themes_header_button_text_color ) ) : ?>
	color: <?php echo $themes_header_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_text_font_family ) ) : ?>
	font-family: <?php echo $themes_header_button_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_header_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_bg_color ) ) : ?>
	background-color: <?php echo $themes_header_button_bg_color; ?>;
	<?php endif; ?>
}
#slider{
	<?php if ( ! empty( $slider_enabledisable ) && true == $slider_enabledisable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#slider .prop_desc p,#slider .slider-box span,#slider .slider-box p,#productslide .products-box .product-content p{
	<?php if ( ! empty( $themes_slider_small_Heading_color ) ) : ?>
	color: <?php echo $themes_slider_small_Heading_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slider_small_Heading_font_family ) ) : ?>
	font-family: <?php echo $themes_slider_small_Heading_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slider_small_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_slider_small_heading_font_size; ?>;
	<?php endif; ?>
}
#slider h1,#productslide .products-box .product-content a{
	<?php if ( ! empty( $themes_main_heading_color ) ) : ?>
	color: <?php echo $themes_main_heading_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_main_heading_font_family ) ) : ?>
	font-family: <?php echo $themes_main_heading_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_main_heading_font_size; ?>;
	<?php endif; ?>
}
#slider li a.active,#slider li a{
	<?php if ( ! empty( $themes_slider_section_text_color ) ) : ?>
	color: <?php echo $themes_slider_section_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slider_section_text_font_family ) ) : ?>
	font-family: <?php echo $themes_slider_section_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slider_section_text_font_size ) ) : ?>
	font-size: <?php echo $themes_slider_section_text_font_size; ?>;
	<?php endif; ?>
}
#slider li a.active,#slider .tab-content{
	<?php if ( ! empty( $themes_slide_tabcolor )) : ?>
	background-color: <?php echo $themes_slide_tabcolor; ?>;
	<?php endif; ?>
}
#slider .search-submit,#slider .slider-button,#productslide .products-box .product-content .icon_link a{
	<?php if ( ! empty( $themes_slide_buttoncolor ) ) : ?>
	color: <?php echo $themes_slide_buttoncolor; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_button_fontfamily ) ) : ?>
	font-family: <?php echo $themes_button_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slide_button_font_size ) ) : ?>
	font-size: <?php echo $themes_slide_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slide_button_gradient_bgcolor1 )) : ?>
	background-color: <?php echo $themes_slide_button_gradient_bgcolor1; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_slide_button_gradient_bgcolor1 )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_slide_button_gradient_bgcolor1; ?> 0%, <?php echo $themes_slide_button_gradient_bgcolor1; ?> 100%);
	<?php endif; ?>
}
#our-feature{
	<?php if ( ! empty( $radio_features_enable ) && true == $radio_features_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#our-feature p{
	<?php if ( ! empty( $features_small_text_color ) ) : ?>
	color: <?php echo $features_small_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_small_text_fontfamily ) ) : ?>
	font-family: <?php echo $features_small_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_small_text_font_size ) ) : ?>
	font-size: <?php echo $features_small_text_font_size; ?>;
	<?php endif; ?>
}
#our-feature h3{
	<?php if ( ! empty( $features_main_text_color ) ) : ?>
	color: <?php echo $features_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $features_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_main_text_font_size ) ) : ?>
	font-size: <?php echo $features_main_text_font_size; ?>;
	<?php endif; ?>
}
#our-feature span{
	<?php if ( ! empty( $features_dicsount_text_color ) ) : ?>
	color: <?php echo $features_dicsount_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_dicsount_text_fontfamily ) ) : ?>
	font-family: <?php echo $features_dicsount_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_dicsount_text_font_size ) ) : ?>
	font-size: <?php echo $features_dicsount_text_font_size; ?>;
	<?php endif; ?>
}
#our-feature a{
	<?php if ( ! empty( $about_extra_text_bg_color ) ) : ?>
	background: linear-gradient(0, <?php echo $about_extra_text_bg_color; ?> 0%, <?php echo $about_extra_text_bg_color; ?> 90%);
	<?php endif; ?>
}
#our-feature a{
	<?php if ( ! empty( $features_button_text_color ) ) : ?>
	color: <?php echo $features_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $features_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_button_text_font_size ) ) : ?>
	font-size: <?php echo $features_button_text_font_size; ?>;
	<?php endif; ?>
}
#about{
	<?php if ( ! empty( $radio_about_enable ) && true == $radio_about_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
.about-content h2 span.left-text,#about p{
	<?php if ( ! empty( $about_smalltitle_left_color ) ) : ?>
	color: <?php echo $about_smalltitle_left_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_left_fontfamily ) ) : ?>
	font-family: <?php echo $about_smalltitle_left_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_left_font_size ) ) : ?>
	font-size: <?php echo $about_smalltitle_left_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_left_bgcolor )) : ?>
	background-image: linear-gradient(57deg, <?php echo $about_smalltitle_left_bgcolor; ?> 0%, <?php echo $about_smalltitle_left_bgcolor; ?> 100%);
	<?php endif; ?>
}
.about-content h2 span.right-text,#about p{
	<?php if ( ! empty( $about_smalltitle_right_color ) ) : ?>
	color: <?php echo $about_smalltitle_right_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_right_fontfamily ) ) : ?>
	font-family: <?php echo $about_smalltitle_right_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_right_font_size ) ) : ?>
	font-size: <?php echo $about_smalltitle_right_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_right_bgcolor )) : ?>
	background-image: linear-gradient(57deg, <?php echo $about_smalltitle_right_bgcolor; ?> 0%, <?php echo $about_smalltitle_right_bgcolor; ?> 100%);
	<?php endif; ?>
}
.about-content h3,#about h3{
	<?php if ( ! empty( $about_main_title_color ) ) : ?>
	color: <?php echo $about_main_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_main_title_fontfamily ) ) : ?>
	font-family: <?php echo $about_main_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_main_title_font_size ) ) : ?>
	font-size: <?php echo $about_main_title_font_size; ?>;
	<?php endif; ?>
}
.about-content li p,#about ol p{
	<?php if ( ! empty( $about_list_title_color ) ) : ?>
	color: <?php echo $about_list_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_list_title_fontfamily ) ) : ?>
	font-family: <?php echo $about_list_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_list_title_font_size ) ) : ?>
	font-size: <?php echo $about_list_title_font_size; ?>;
	<?php endif; ?>
}
.about-content p{
	<?php if ( ! empty( $about_text_color ) ) : ?>
	color: <?php echo $about_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_text_fontfamily ) ) : ?>
	font-family: <?php echo $about_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_text_font_size ) ) : ?>
	font-size: <?php echo $about_text_font_size; ?>;
	<?php endif; ?>
}
.about-content .left-read,.about-content .right-read,.about-content .left-read, .about-content .right-read{
	<?php if ( ! empty( $about_button_text_color ) ) : ?>
	color: <?php echo $about_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $about_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_button_text_font_size ) ) : ?>
	font-size: <?php echo $about_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_button_bg_color ) ) : ?>
	background-image: linear-gradient(180deg, <?php echo $about_button_bg_color; ?> 0%, <?php echo $about_button_bg_color; ?> 100%);
	<?php endif; ?>
}
.about-video p,.left-bg p,.right-img-bg p{
	<?php if ( ! empty( $about_extra_text_color ) ) : ?>
	color: <?php echo $about_extra_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_extra_text_fontfamily ) ) : ?>
	font-family: <?php echo $about_extra_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_extra_text_font_size ) ) : ?>
	font-size: <?php echo $about_extra_text_font_size; ?>;
	<?php endif; ?>
}
.right-img-bg p{
	<?php if ( ! empty( $about_extra_text_bg_color ) ) : ?>
	background-color: <?php echo $about_extra_text_bg_color; ?>;
	<?php endif; ?>
}
#featured-update{
	<?php if ( ! empty( $radio4_enable ) && true == $radio4_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#featured-update h2 span.left-text{
	<?php if ( ! empty( $pro_small_left_title_color ) ) : ?>
	color: <?php echo $pro_small_left_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_left_title_fontfamily ) ) : ?>
	font-family: <?php echo $pro_small_left_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_left_title_font_size ) ) : ?>
	font-size: <?php echo $pro_small_left_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_left_titlebg_color ) ) : ?>
	background-image: linear-gradient(57deg, <?php echo $pro_small_left_titlebg_color; ?> 0%, <?php echo $pro_small_left_titlebg_color; ?> 100%);
	<?php endif; ?>
}
#featured-update h2 span.right-text{
	<?php if ( ! empty( $pro_small_right_title_color ) ) : ?>
	color: <?php echo $pro_small_right_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_right_title_fontfamily ) ) : ?>
	font-family: <?php echo $pro_small_right_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_right_title_font_size ) ) : ?>
	font-size: <?php echo $pro_small_right_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_small_right_titlebg_color ) ) : ?>
	background-image: linear-gradient(57deg, <?php echo $pro_small_right_titlebg_color; ?> 0%, <?php echo $pro_small_right_titlebg_color; ?> 100%);
	<?php endif; ?>
}
#featured-update .about-inner h3{
	<?php if ( ! empty( $pro_main_title_color ) ) : ?>
	color: <?php echo $pro_main_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_main_title_fontfamily ) ) : ?>
	font-family: <?php echo $pro_main_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_main_title_font_size ) ) : ?>
	font-size: <?php echo $pro_main_title_font_size; ?>;
	<?php endif; ?>
}
#featured-update li a{
	<?php if ( ! empty( $pro_tab_title_color ) ) : ?>
	color: <?php echo $pro_tab_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_tab_title_fontfamily ) ) : ?>
	font-family: <?php echo $pro_tab_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_tab_title_font_size ) ) : ?>
	font-size: <?php echo $pro_tab_title_font_size; ?>;
	<?php endif; ?>
}
#featured-update li a:active{
	<?php if ( ! empty( $pro_tab_title_active_color ) ) : ?>
	color: <?php echo $pro_tab_title_active_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_tab_title_active_fontfamily ) ) : ?>
	font-family: <?php echo $pro_tab_title_active_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_tab_title_active_font_size ) ) : ?>
	font-size: <?php echo $pro_tab_title_active_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pro_tab_title_active_bgcolor ) ) : ?>
	background-image: linear-gradient(57deg, <?php echo $pro_tab_title_active_bgcolor; ?> 0%, <?php echo $pro_tab_title_active_bgcolor; ?> 100%);
	<?php endif; ?>
}
#featured-update .adjust1{
	<?php if ( ! empty( $product_background_color ) ) : ?>
	background-color: <?php echo $product_background_color; ?>;
	<?php endif; ?>
}
#featured-update .price-featured-car h3 a{
	<?php if ( ! empty( $product_title_color ) ) : ?>
	color: <?php echo $product_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_title_fontfamily ) ) : ?>
	font-family: <?php echo $product_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_title_font_size ) ) : ?>
	font-size: <?php echo $product_title_font_size; ?>;
	<?php endif; ?>
}
#featured-update .price-featured-car p{
	<?php if ( ! empty( $product_text_color ) ) : ?>
	color: <?php echo $product_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_text_fontfamily ) ) : ?>
	font-family: <?php echo $product_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_text_font_size ) ) : ?>
	font-size: <?php echo $product_text_font_size; ?>;
	<?php endif; ?>
}
#featured-update .adjust1 ins{
	<?php if ( ! empty( $product_price_text_color ) ) : ?>
	color: <?php echo $product_price_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_text_fontfamily ) ) : ?>
	font-family: <?php echo $product_price_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_text_font_size ) ) : ?>
	font-size: <?php echo $product_price_text_font_size; ?>;
	<?php endif; ?>
}
.adjust1 a.button{
	<?php if ( ! empty( $product_button_text_color ) ) : ?>
	color: <?php echo $product_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $product_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_button_text_font_size ) ) : ?>
	font-size: <?php echo $product_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_button_bg_color ) ) : ?>
	background-image: linear-gradient(180deg, <?php echo $product_button_bg_color; ?> 0%, <?php echo $product_button_bg_color; ?> 100%);
	<?php endif; ?>
}
#our-app{
	<?php if ( ! empty( $radio_our_app_enable ) && true == $radio_our_app_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#our-app span.head_white{
	<?php if ( ! empty( $app_small_left_title_color ) ) : ?>
	color: <?php echo $app_small_left_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_small_left_title_fontfamily ) ) : ?>
	font-family: <?php echo $app_small_left_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_small_left_title_font_size ) ) : ?>
	font-size: <?php echo $app_small_left_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_small_titlebg_color ) ) : ?>
	background-image: linear-gradient(57deg, <?php echo $app_small_titlebg_color; ?> 0%, <?php echo $app_small_titlebg_color; ?> 100%);
	<?php endif; ?>
}
#our-app h3{
	<?php if ( ! empty( $app_main_title_color ) ) : ?>
	color: <?php echo $app_main_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_main_title_fontfamily ) ) : ?>
	font-family: <?php echo $app_main_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_main_title_font_size ) ) : ?>
	font-size: <?php echo $app_main_title_font_size; ?>;
	<?php endif; ?>
}
#our-app p{
	<?php if ( ! empty( $app_main_text_color ) ) : ?>
	color: <?php echo $app_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $app_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_main_text_font_size ) ) : ?>
	font-size: <?php echo $app_main_text_font_size; ?>;
	<?php endif; ?>
}
#our-app .left-inner{
	<?php if ( ! empty( $app_box_bg_color ) ) : ?>
	background-color: <?php echo $app_box_bg_color; ?>;
	border-color: <?php echo $app_box_bg_color; ?>;
	<?php endif; ?>
}
#our-app .icon-b-inner i{
	<?php if ( ! empty( $app_box_icons_color ) ) : ?>
	color: <?php echo $app_box_icons_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_box_icons_font_size ) ) : ?>
	font-size: <?php echo $app_box_icons_font_size; ?>;
	<?php endif; ?>
}
#our-app .text-b-inner p.first-p{
	<?php if ( ! empty( $app_box_title_color ) ) : ?>
	color: <?php echo $app_box_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_box_title_fontfamily ) ) : ?>
	font-family: <?php echo $app_box_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_box_title_font_size ) ) : ?>
	font-size: <?php echo $app_box_title_font_size; ?>;
	<?php endif; ?>
}
#our-app .text-b-inner p.last-p{
	<?php if ( ! empty( $app_box_text_color ) ) : ?>
	color: <?php echo $app_box_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_box_text_fontfamily ) ) : ?>
	font-family: <?php echo $app_box_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $app_box_text_font_size ) ) : ?>
	font-size: <?php echo $app_box_text_font_size; ?>;
	<?php endif; ?>
}
#our-app .left-inner:hover .icon-b-inner i{
	<?php if ( ! empty( $app_box_icons_hovercolor ) ) : ?>
	color: <?php echo $app_box_icons_hovercolor; ?>;
	<?php endif; ?>
}
#our_partners{
	<?php if ( ! empty( $radio_our_partners_enable ) && true == $radio_our_partners_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
.client_inner:hover img.main-img{
	<?php if ( ! empty( $our_partners_bg_color ) ) : ?>
	background-color: <?php echo $our_partners_bg_color; ?>;
	<?php endif; ?>
}
.client_inner:hover img.main-img{
	<?php if ( ! empty( $our_partners_bg_hovercolor ) ) : ?>
	filter: drop-shadow(4.5px 7.794px 13.5px <?php echo $our_partners_bg_hovercolor; ?>);
    background-image: linear-gradient(57deg, <?php echo $our_partners_bg_hovercolor; ?> 0%, <?php echo $our_partners_bg_hovercolor; ?> 100%);
	<?php endif; ?>
}
#services{
	<?php if ( ! empty( $services_enabledisable ) && true == $services_enabledisable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#services span.head_center,#services p.small-text{
	<?php if ( ! empty( $themes_servicesmall_title_color ) ) : ?>
	color: <?php echo $themes_servicesmall_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_servicesmall_title_font_family ) ) : ?>
	font-family: <?php echo $themes_servicesmall_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_servicesmall_title_font_size ) ) : ?>
	font-size: <?php echo $themes_servicesmall_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_servicesmall_title_bgcolor ) ) : ?>
    background-image: linear-gradient(57deg, <?php echo $themes_servicesmall_title_bgcolor; ?> 0%, <?php echo $themes_servicesmall_title_bgcolor; ?> 100%);
	<?php endif; ?>
}
#services h3{
	<?php if ( ! empty( $themes_service_title_color ) ) : ?>
	color: <?php echo $themes_service_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_title_font_family ) ) : ?>
	font-family: <?php echo $themes_service_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_title_font_size ) ) : ?>
	font-size: <?php echo $themes_service_title_font_size; ?>;
	<?php endif; ?>
}
#services p{
	<?php if ( ! empty( $themes_service_subtext_color ) ) : ?>
	color: <?php echo $themes_service_subtext_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_text_font_family ) ) : ?>
	font-family: <?php echo $themes_service_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_text_font_size ) ) : ?>
	font-size: <?php echo $themes_service_text_font_size; ?>;
	<?php endif; ?>
}
.services-image img,#services a.bottom-link i{
	<?php if ( ! empty( $themes_service_box_icons_bg_color ) ) : ?>
	background-color: <?php echo $themes_service_box_icons_bg_color; ?>;
	<?php endif; ?>
}
.service-box:hover .services-image img{
	<?php if ( ! empty( $themes_service_box_icons_bg_hovercolor ) ) : ?>
	background-color: <?php echo $themes_service_box_icons_bg_hovercolor; ?>;
	<?php endif; ?>
}
#services h4 a{
	<?php if ( ! empty( $themes_service_box_title_color ) ) : ?>
	color: <?php echo $themes_service_box_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_title_font_family ) ) : ?>
	font-family: <?php echo $themes_service_box_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_title_font_size ) ) : ?>
	font-size: <?php echo $themes_service_box_title_font_size; ?>;
	<?php endif; ?>
}
#services .services_content{
	<?php if ( ! empty( $themes_service_box_content_color ) ) : ?>
	color: <?php echo $themes_service_box_content_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_content_font_family ) ) : ?>
	font-family: <?php echo $themes_service_box_content_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_content_font_size ) ) : ?>
	font-size: <?php echo $themes_service_box_content_font_size; ?>;
	<?php endif; ?>
}
#interface-deg{
	<?php if ( ! empty( $radio_interface_deg_enable ) && true == $radio_interface_deg_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#introduction{
	<?php if ( ! empty( $radio_introduction_enable ) && true == $radio_introduction_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
/*------------Home contact---------------*/
#connect_withus{
	<?php if ( ! empty( $contact_us_enable ) && true == $contact_us_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#connect_withus{
	<?php if ( ! empty( $contact_us_bgcolor ) ) : ?>
	background-color: <?php echo $contact_us_bgcolor; ?>;
	<?php elseif ( ! empty( $contact_us_bgimage ) ) : ?>
	background-image: url(<?php echo $contact_us_bgimage; ?>);
	<?php endif; ?>
}
.contact-text h3{
	<?php if ( ! empty( $contact_us_title_color_first ) ) : ?>
	color: <?php echo $contact_us_title_color_first; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_title_font_family ) ) : ?>
	font-family: <?php echo $contact_us_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_title_font_size ) ) : ?>
	font-size: <?php echo $contact_us_title_font_size; ?>;
	<?php endif; ?>
}
.contact-text p{
	<?php if ( ! empty( $contact_us_text_color ) ) : ?>
	color: <?php echo $contact_us_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_text_font_family ) ) : ?>
	font-family: <?php echo $contact_us_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_text_font_size ) ) : ?>
	font-size: <?php echo $contact_us_text_font_size; ?>;
	<?php endif; ?>
}
.flower-submit-btn input.wpcf7-form-control.wpcf7-submit{
	<?php if ( ! empty( $contact_us_form_button_color ) ) : ?>
	color: <?php echo $contact_us_form_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_form_button_font_family ) ) : ?>
	font-family: <?php echo $contact_us_form_button_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_form_button_font_size ) ) : ?>
	font-size: <?php echo $contact_us_form_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_us_form_button_bgcolor_first ) ) : ?>
	background: linear-gradient(80deg, <?php echo $contact_us_form_button_bgcolor_first; ?> 25%, <?php echo $contact_us_form_button_bgcolor_first; ?> 100%);
	<?php endif; ?>
}
/*------------Best Seller products---------------*/
#best-seller{
	<?php if ( ! empty( $radio_best_seller_enable ) && true == $radio_best_seller_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#best-seller{
	<?php if ( ! empty( $best_seller_bgcolor ) ) : ?>
	background-color: <?php echo $best_seller_bgcolor; ?>;
	<?php elseif ( ! empty( $best_seller_bgimage ) ) : ?>
	background-image: url(<?php echo $best_seller_bgimage; ?>);
	<?php endif; ?>
}
#best-seller h3{
	<?php if ( ! empty( $best_seller_main_text_color ) ) : ?>
	color: <?php echo $best_seller_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $best_seller_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_main_text_font_size ) ) : ?>
	font-size: <?php echo $best_seller_main_text_font_size; ?>;
	<?php endif; ?>
}
#best-seller span.product-sale-tag .onsale{
	<?php if ( ! empty( $seller_sale_title_color ) ) : ?>
	color: <?php echo $seller_sale_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_sale_title_fontfamily ) ) : ?>
	font-family: <?php echo $seller_sale_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_sale_title_font_size ) ) : ?>
	font-size: <?php echo $seller_sale_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_sale_bg_color ) ) : ?>
	background: linear-gradient( 80deg, <?php echo $seller_sale_bg_color; ?> 25%, <?php echo $seller_sale_bg_color; ?> 100%);
	<?php endif; ?>
}
#best-seller h2 span,#best-seller h2 span:after, #best-seller h2 span:before{
	<?php if ( ! empty( $best_seller_small_text_color ) ) : ?>
	color: <?php echo $best_seller_small_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_small_text_fontfamily ) ) : ?>
	font-family: <?php echo $best_seller_small_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_small_text_font_size ) ) : ?>
	font-size: <?php echo $best_seller_small_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_small_text_color ) ) : ?>
	background-color: <?php echo $best_seller_small_text_color; ?>;
	<?php endif; ?>
}
#best-seller .product-box h5 a{
	<?php if ( ! empty( $seller_title_color ) ) : ?>
	color: <?php echo $seller_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_title_fontfamily ) ) : ?>
	font-family: <?php echo $seller_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_title_font_size ) ) : ?>
	font-size: <?php echo $seller_title_font_size; ?>;
	<?php endif; ?>
}
#best-seller ins,#best-seller del{
	<?php if ( ! empty( $seller_price_color ) ) : ?>
	color: <?php echo $seller_price_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_price_fontfamily ) ) : ?>
	font-family: <?php echo $seller_price_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_price_font_size ) ) : ?>
	font-size: <?php echo $seller_price_font_size; ?>;
	<?php endif; ?>
}
#best-seller .product-over a.add_to_cart_button,#best-seller a.view-all{
	<?php if ( ! empty( $seller_button_color ) ) : ?>
	color: <?php echo $seller_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_button_fontfamily ) ) : ?>
	font-family: <?php echo $seller_button_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_button_font_size ) ) : ?>
	font-size: <?php echo $seller_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_button_bgcolor ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $seller_button_bgcolor; ?> 25%, <?php echo $seller_button_bgcolor; ?> 100%);
	<?php endif; ?>
}
/*------------category products---------------*/
#category-products{
	<?php if ( ! empty( $radio_category_products_enable ) && true == $radio_category_products_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#category-products{
	<?php if ( ! empty( $category_products_bgcolor ) ) : ?>
	background-color: <?php echo $category_products_bgcolor; ?>;
	<?php elseif ( ! empty( $category_products_bgimage ) ) : ?>
	background-image: url(<?php echo $category_products_bgimage; ?>);
	<?php endif; ?>
}
#category-products h3{
	<?php if ( ! empty( $sec_main_text_color ) ) : ?>
	color: <?php echo $sec_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $sec_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $sec_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $sec_main_text_font_size ) ) : ?>
	font-size: <?php echo $sec_main_text_font_size; ?>;
	<?php endif; ?>
}
#category-products p#timer .numbers,#category-products .numbers span{
	<?php if ( ! empty( $clock_tittle_text_color ) ) : ?>
	color: <?php echo $clock_tittle_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $clock_tittle_fontfamily ) ) : ?>
	font-family: <?php echo $clock_tittle_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $clock_tittle_font_size ) ) : ?>
	font-size: <?php echo $clock_tittle_font_size; ?>;
	<?php endif; ?>
}
#category-products p#timer .numbers{
	<?php if ( ! empty( $clock_bg_color ) ) : ?>
	background-color: <?php echo $clock_bg_color; ?>;
	<?php endif; ?>
}
#category-products ul a.nav-link{
	<?php if ( ! empty( $tab_tittle_text_color ) ) : ?>
	color: <?php echo $tab_tittle_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $tab_tittle_fontfamily ) ) : ?>
	font-family: <?php echo $tab_tittle_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $tab_tittle_font_size ) ) : ?>
	font-size: <?php echo $tab_tittle_font_size; ?>;
	<?php endif; ?>
}
#category-products ul a.nav-link.active{
	<?php if ( ! empty( $tab_tittle_active_color ) ) : ?>
	background: linear-gradient( 91deg,<?php echo $tab_tittle_active_color; ?> 47%,<?php echo $tab_tittle_active_color; ?> 100%);
	<?php endif; ?>
}
#category-products span.product-sale-tag .onsale{
	<?php if ( ! empty( $product_sale_title_color ) ) : ?>
	color: <?php echo $product_sale_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_sale_title_fontfamily ) ) : ?>
	font-family: <?php echo $product_sale_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_sale_title_font_size ) ) : ?>
	font-size: <?php echo $product_sale_title_font_size; ?>;
	<?php endif; ?>
}
#category-products span.product-sale-tag .onsale{
	<?php if ( ! empty( $product_sale_bg_color ) ) : ?>
	background: linear-gradient( 80deg, <?php echo $product_sale_bg_color; ?> 25%, <?php echo $product_sale_bg_color; ?> 100%);
	<?php endif; ?>
}
#category-products h5 a{
	<?php if ( ! empty( $product_sale_title_color ) ) : ?>
	color: <?php echo $product_sale_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_sale_title_fontfamily ) ) : ?>
	font-family: <?php echo $product_sale_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_sale_title_font_size ) ) : ?>
	font-size: <?php echo $product_sale_title_font_size; ?>;
	<?php endif; ?>
}
#category-products ins,#category-products del{
	<?php if ( ! empty( $product_price_color ) ) : ?>
	color: <?php echo $product_price_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_fontfamily ) ) : ?>
	font-family: <?php echo $product_price_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_font_size ) ) : ?>
	font-size: <?php echo $product_price_font_size; ?>;
	<?php endif; ?>
}
.recode-prod-content a.add_to_cart_button, #best-seller .product-over a.add_to_cart_button, #category-products .product-over a.add_to_cart_button,#category-products a.view-all{
	<?php if ( ! empty( $product_price_color ) ) : ?>
	color: <?php echo $product_price_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_fontfamily ) ) : ?>
	font-family: <?php echo $product_price_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_price_font_size ) ) : ?>
	font-size: <?php echo $product_price_font_size; ?>;
	<?php endif; ?>
}
.recode-prod-content a.add_to_cart_button, #best-seller .product-over a.add_to_cart_button, #category-products .product-over a.add_to_cart_button,#category-products a.view-all{
	<?php if ( ! empty( $product_button_bgcolor ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $product_button_bgcolor; ?> 25%, <?php echo $product_button_bgcolor; ?> 100%);
	<?php endif; ?>
}
/*------------Newsletter---------------*/
#newsletter{
	<?php if ( ! empty( $newsletter_enable ) && true == $newsletter_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#newsletter{
	<?php if ( ! empty( $newsletter_bgcolor ) ) : ?>
	background-color: <?php echo $newsletter_bgcolor; ?>;
	<?php elseif ( ! empty( $newsletter_bgimage ) ) : ?>
	background-image: url(<?php echo $newsletter_bgimage; ?>);
	<?php endif; ?>
}
#newsletter h3{
	<?php if ( ! empty( $themes_newsletter_title_color_first ) ) : ?>
	color: <?php echo $themes_newsletter_title_color_first; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_title_font_family ) ) : ?>
	font-family: <?php echo $themes_newsletter_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_title_font_size ) ) : ?>
	font-size: <?php echo $themes_newsletter_title_font_size; ?>;
	<?php endif; ?>
}
#newsletter span{
	<?php if ( ! empty( $themes_newsletter_text_color ) ) : ?>
	color: <?php echo $themes_newsletter_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_text_font_family ) ) : ?>
	font-family: <?php echo $themes_newsletter_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_text_font_size ) ) : ?>
	font-size: <?php echo $themes_newsletter_text_font_size; ?>;
	<?php endif; ?>
}
#newsletter span{
	<?php if ( ! empty( $themes_newsletter_form_button_color ) ) : ?>
	color: <?php echo $themes_newsletter_form_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_form_button_font_family ) ) : ?>
	font-family: <?php echo $themes_newsletter_form_button_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_form_button_font_size ) ) : ?>
	font-size: <?php echo $themes_newsletter_form_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_form_button_bgcolor_first ) ) : ?>
	background: linear-gradient(80deg, <?php echo $themes_newsletter_form_button_bgcolor_first; ?> 25%, <?php echo $themes_newsletter_form_button_bgcolor_first; ?> 100%);
	<?php endif; ?>
	
}
#testimonials{
	<?php if ( ! empty( $radio_testimonial_enable ) && true == $radio_testimonial_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#testimonials{
	<?php if ( ! empty( $testimonial_bgcolor ) ) : ?>
	background-color: <?php echo $testimonial_bgcolor; ?>;
	<?php elseif ( ! empty( $testimonial_bgimage ) ) : ?>
	background-image: url(<?php echo $testimonial_bgimage; ?>);
	<?php endif; ?>
}
#testimonials h2 span,#testimonials h2 span:before, #testimonials h2 span:after{
	<?php if ( ! empty( $themes_testimonial_title_color ) ) : ?>
	color: <?php echo $themes_testimonial_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_title_color ) ) : ?>
	background-color: <?php echo $themes_testimonial_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_title_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_title_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_title_font_size; ?>;
	<?php endif; ?>
}
.testimonial-text-out h3{
	<?php if ( ! empty( $themes_testimonial_subtext_color ) ) : ?>
	color: <?php echo $themes_testimonial_subtext_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_subtext_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_subtext_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_subtext_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_subtext_font_size; ?>;
	<?php endif; ?>
}
.testimonial-text-out h4.testimonial_name a{
	<?php if ( ! empty( $themes_testimonial_name_color ) ) : ?>
	color: <?php echo $themes_testimonial_name_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_name_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_name_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_name_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_name_font_size; ?>;
	<?php endif; ?>
}
.testimonial-text-out h4.testimonial_name cite{
	<?php if ( ! empty( $themes_testimonial_des_color ) ) : ?>
	color: <?php echo $themes_testimonial_des_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_des_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_des_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_des_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_des_font_size; ?>;
	<?php endif; ?>
}
.testimonial_box .qoute_text{
	<?php if ( ! empty( $themes_testimonial_qoute_color ) ) : ?>
	color: <?php echo $themes_testimonial_qoute_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_qoute_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_qoute_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_qoute_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_qoute_font_size; ?>;
	<?php endif; ?>
}
#testimonials a.left-read{
	<?php if ( ! empty( $themes_testimonial_button_text_color ) ) : ?>
	color: <?php echo $themes_testimonial_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_button_text_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_button_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_but_bg_color ) ) : ?>
	background-color: <?php echo $themes_testimonial_but_bg_color; ?>;
	<?php endif; ?>
}
#video{
	<?php if ( ! empty( $video_enable ) && true == $video_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
/*-----Pricing planse-------*/
#pricing-plan{
	<?php if ( ! empty( $pricing_plan_enable ) && true == $pricing_plan_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#pricing-plan{
	<?php if ( ! empty( $pricing_plan_bgcolor ) ) : ?>
	background-color: <?php echo $pricing_plan_bgcolor; ?>;
	<?php elseif ( ! empty( $pricing_plan_bgimage ) ) : ?>
	background-image: url(<?php echo $pricing_plan_bgimage; ?>);
	<?php endif; ?>
}
#pricing-plan .pricing-plan-head h3{
	<?php if ( ! empty( $themes_pricing_plan_title_color ) ) : ?>
	color: <?php echo $themes_pricing_plan_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_title_font_family ) ) : ?>
	font-family: <?php echo $themes_pricing_plan_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_title_font_size ) ) : ?>
	font-size: <?php echo $themes_pricing_plan_title_font_size; ?>;
	<?php endif; ?>
}
#pricing-plan h2 span,#pricing-plan h2 span:before, #pricing-plan h2 span:after{
	<?php if ( ! empty( $pricing_plan_small_title_color ) ) : ?>
	color: <?php echo $pricing_plan_small_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_small_title_font_family ) ) : ?>
	font-family: <?php echo $pricing_plan_small_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_small_title_font_size ) ) : ?>
	font-size: <?php echo $pricing_plan_small_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_small_title_color ) ) : ?>
	background-color: <?php echo $pricing_plan_small_title_color; ?>;
	<?php endif; ?>
}
#pricing-plan .pricing-plan-head p{
	<?php if ( ! empty( $pricing_plan_para_color ) ) : ?>
	color: <?php echo $pricing_plan_para_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_para_font_family ) ) : ?>
	font-family: <?php echo $pricing_plan_para_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_para_font_size ) ) : ?>
	font-size: <?php echo $pricing_plan_para_font_size; ?>;
	<?php endif; ?>
}
.prising_toggle ul a{
	<?php if ( ! empty( $pricing_plan_tab_color ) ) : ?>
	color: <?php echo $pricing_plan_tab_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_tab_font_family ) ) : ?>
	font-family: <?php echo $pricing_plan_tab_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_tab_font_size ) ) : ?>
	font-size: <?php echo $pricing_plan_tab_font_size; ?>;
	<?php endif; ?>
}
.pricing-plan-box h3, .pricing-plan-box p, .pricing-plan-box h5 sup, .pricing-plan-box h5 sub{
	<?php if ( ! empty( $pricing_plan_top_text_color ) ) : ?>
	color: <?php echo $pricing_plan_top_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_top_text_font_family ) ) : ?>
	font-family: <?php echo $pricing_plan_top_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_top_text_font_size ) ) : ?>
	font-size: <?php echo $pricing_plan_top_text_font_size; ?>;
	<?php endif; ?>
}
.pricing-plan-content,.plans_data2 .pricing-plan-content{
	<?php if ( ! empty( $pricing_plan_bg_color ) ) : ?>
	background-color: <?php echo $pricing_plan_bg_color; ?>;
	<?php endif; ?>
}
.bottom-box li{
	<?php if ( ! empty( $pricing_plan_list_color ) ) : ?>
	color: <?php echo $pricing_plan_list_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_list_font_family ) ) : ?>
	font-family: <?php echo $pricing_plan_list_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_list_font_size ) ) : ?>
	font-size: <?php echo $pricing_plan_list_font_size; ?>;
	<?php endif; ?>
}
.bottom-box ul i{
	<?php if ( ! empty( $plan_list_icons_color ) ) : ?>
	color: <?php echo $plan_list_icons_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $plan_list_icons_font_size ) ) : ?>
	font-size: <?php echo $plan_list_icons_font_size; ?>;
	<?php endif; ?>
}
.bottom-box a{
	<?php if ( ! empty( $plan_but_text_color ) ) : ?>
	color: <?php echo $plan_but_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $plan_but_text_font_family ) ) : ?>
	font-family: <?php echo $plan_but_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $plan_but_text_font_size ) ) : ?>
	font-size: <?php echo $plan_but_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $plan_but_bg_color ) ) : ?>
	background-color: <?php echo $plan_but_bg_color; ?>;
	<?php endif; ?>
}
#our_records{
	<?php if ( ! empty( $records_section_enable ) && true == $records_section_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#instagramsec{
	<?php if ( ! empty( $radio_Instagram_enable ) && true == $radio_Instagram_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#instagramsec{
	<?php if ( ! empty( $instagram_bg_color ) ) : ?>
	background-color: <?php echo $instagram_bg_color; ?>;
	<?php elseif ( ! empty( $instagram_bg_image ) ) : ?>
	background-image: url(<?php echo $instagram_bg_image; ?>);
	<?php endif; ?>
}
#instagramsec .insta-content h3{
	<?php if ( ! empty( $instagram_main_text_color ) ) : ?>
	color: <?php echo $instagram_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $instagram_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_main_text_font_size ) ) : ?>
	font-size: <?php echo $instagram_main_text_font_size; ?>;
	<?php endif; ?>
}
#instagramsec .insta-content h2,#instagramsec .insta-content h2:before, #instagramsec .insta-content h2:after{
	<?php if ( ! empty( $instagram_text_color ) ) : ?>
	color: <?php echo $instagram_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_text_color ) ) : ?>
	background-color: <?php echo $instagram_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_text_fontfamily ) ) : ?>
	font-family: <?php echo $instagram_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_text_font_size ) ) : ?>
	font-size: <?php echo $instagram_text_font_size; ?>;
	<?php endif; ?>
}
#get-in-touch{
	<?php if ( ! empty( $radio_get_in_touch_enable ) && true == $radio_get_in_touch_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#get-in-touch{
	<?php if ( ! empty( $get_in_touch_section_bgcolor ) ) : ?>
	background: linear-gradient(135deg,<?php echo $get_in_touch_section_bgcolor; ?> 0%,<?php echo $get_in_touch_section_bgcolor; ?> 100%);
	<?php elseif ( ! empty( $get_in_touch_section_bgimage ) ) : ?>
	background-image: url(<?php echo $get_in_touch_section_bgimage; ?>);
	<?php endif; ?>
}
#get-in-touch h3{
	<?php if ( ! empty( $get_in_touch_main_text_color ) ) : ?>
	color: <?php echo $get_in_touch_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $get_in_touch_main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_main_text_font_size ) ) : ?>
	font-size: <?php echo $get_in_touch_main_text_font_size; ?>;
	<?php endif; ?>
}
#get-in-touch p{
	<?php if ( ! empty( $get_in_touch_text_color ) ) : ?>
	color: <?php echo $get_in_touch_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_text_fontfamily ) ) : ?>
	font-family: <?php echo $get_in_touch_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_text_font_size ) ) : ?>
	font-size: <?php echo $get_in_touch_text_font_size; ?>;
	<?php endif; ?>
}
#get-in-touch a.read-more{
	<?php if ( ! empty( $get_in_touch_button_bg_color ) ) : ?>
	background-color: <?php echo $get_in_touch_button_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_color ) ) : ?>
	color: <?php echo $get_in_touch_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $get_in_touch_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_font_size ) ) : ?>
	font-size: <?php echo $get_in_touch_button_text_font_size; ?>;
	<?php endif; ?>
}
<?php if ( ! empty( $themes_custom_css ) ) : ?>
<?php echo $themes_custom_css; ?>
<?php endif; ?>

.wp-core-ui .button-primary{
text-shadow: none;
}
</style>

<?php // $content = ob_get_clean(); ?>
<?php if ( isset( $themes_display_bg_video ) && $themes_display_bg_video && ! empty( $themes_bg_video ) ) : ?>
<?php if ( ( $themes_theme_tem == 'default6' || $themes_theme_tem == 'default10' || $themes_theme_tem == 'default17' ) ) : ?>
	<script>
	document.addEventListener( 'DOMContentLoaded', function(){
			// document.body.innerHTML="<video autoplay loop id=\"themes_video-background\" muted playsinline>\n" + "<source src=\"<?php // echo $themes_bg_video;?>\">\n" + "</video>\n"+document.body.innerHTML;
			// '"<video autoplay loop id=\"themes_video-background\" muted playsinline>\n" + "<source src=\"<?php // echo $themes_bg_video;?>\">\n" + "</video>\n"'.
			// document.getElementById("login").appendChild("<video autoplay loop id=\"themes_video-background\" muted playsinline>\n" + "<source src=\"<?php  // echo $themes_bg_video;?>\">\n" + "</video>\n");
			// (function($){
			// 	$('<div id="themes_video-background-wrapper"><video autoplay loop id="themes_video-background" <?php echo $themes_video_voice; ?> playsinline><source src="<?php //echo $themes_bg_video;?>"></video></div>').appendTo($('#login'));
			// }(jQuery));
			var el = document.getElementById('login');
			var elChild = document.createElement('div');
			elChild.setAttribute( 'id', 'themes_video-background-wrapper' );
			elChild.innerHTML = '<video autoplay loop id=\"themes_video-background\" <?php echo $themes_video_voice; ?> playsinline>\n" + "<source src=\"<?php echo $themes_bg_video; ?>\">\n" + "</video>';

			// Prepend it
			el.appendChild(elChild);
		}, false );
	</script>
<?php else: ?>
	<script>
	<?php if ( $themes_theme_tem == 'default17' ) : ?>
	document.addEventListener( 'DOMContentLoaded', function(){
			var el = document.getElementsByClassName('login')[0];
			var elChild = document.createElement('div');
			elChild.setAttribute( 'id', 'themes_video-background-wrapper' );
			elChild.innerHTML = '<video autoplay loop id=\"themes_video-background\" <?php echo $themes_video_voice; ?> playsinline>\n" + "<source src=\"<?php echo $themes_bg_video; ?>\">\n" + "</video>';

			// Prepend it
			el.appendChild(elChild);
		}, false );
	<?php endif; ?>
	<?php if ( $themes_theme_tem == 'default8' ) : ?>
	document.addEventListener( 'DOMContentLoaded', function(){
			var el = document.getElementsByClassName('login')[0];
			var elChild = document.createElement('div');
			elChild.setAttribute( 'id', 'themes_video-background-wrapper' );
			elChild.innerHTML = '<video autoplay loop id=\"themes_video-background\" <?php echo $themes_video_voice; ?> playsinline>\n" + "<source src=\"<?php echo $themes_bg_video; ?>\">\n" + "</video>';

			// Prepend it
			el.appendChild(elChild);
		}, false );
	<?php endif; ?>
	<?php if ( $themes_theme_tem != 'default17' && $themes_theme_tem != 'default8' ) : ?>
	document.addEventListener( 'DOMContentLoaded', function(){
			var el = document.getElementsByClassName('login')[0];
			var elChild = document.createElement('div');
			elChild.setAttribute( 'id', 'themes_video-background-wrapper' );
			elChild.innerHTML = '<video autoplay loop id=\"themes_video-background\" <?php echo $themes_video_voice; ?> playsinline>\n" + "<source src=\"<?php echo $themes_bg_video; ?>\">\n" + "</video>';

			// Prepend it
			el.appendChild(elChild);
		}, false );
	<?php endif; ?>
	</script>
<?php endif; ?>
<?php endif; ?>