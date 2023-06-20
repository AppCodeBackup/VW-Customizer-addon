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
$topbar_bgcolor2 = themes_get_option_key( 'topbar_bgcolor2', $themes_array );
$topbar_bg_image = themes_get_option_key( 'topbar_bg_image', $themes_array );
$themes_topbar_background_img = themes_get_option_key( 'setting_topbar_background', $themes_array );
$themes_topbar_text_color = themes_get_option_key( 'setting_topbar_text_color', $themes_array );
$setting_topbar_text_font_family = themes_get_option_key( 'setting_topbar_text_font_family', $themes_array );
$setting_topbar_text_size = themes_get_option_key( 'setting_topbar_text_size', $themes_array );
$topbar_text_heading = themes_get_option_key( 'topbar_text_heading', $themes_array );
$setting_topbar_icons_color = themes_get_option_key( 'setting_topbar_icons_color', $themes_array );
$setting_topbar_icons_hover_color = themes_get_option_key( 'setting_topbar_icons_hover_color', $themes_array );
$setting_topbar_sicons_bgcolor = themes_get_option_key( 'setting_topbar_sicons_bgcolor', $themes_array );
$setting_topbar_sicons_hoverbgcolor1 = themes_get_option_key( 'setting_topbar_sicons_hoverbgcolor1', $themes_array );
$setting_topbar_sicons_hoverbgcolor2 = themes_get_option_key( 'setting_topbar_sicons_hoverbgcolor2', $themes_array );

$topbar_button_bgcolor = themes_get_option_key( 'topbar_button_bgcolor', $themes_array );
$topbar_button_bgcolor2 = themes_get_option_key( 'topbar_button_bgcolor2', $themes_array );

$themes_commen_gradient_color_1 = themes_get_option_key( 'themes_commen_gradient_color_1', $themes_array );
$themes_commen_gradient_color_2 = themes_get_option_key( 'themes_commen_gradient_color_2', $themes_array );

$latest_news_enabledisable = themes_get_option_key( 'latest_news_enabledisable', $themes_array );
$latest_news_bg_color = themes_get_option_key( 'latest_news_bg_color', $themes_array );
$latest_news_bg_image = themes_get_option_key( 'latest_news_bg_image', $themes_array );
//slider
$slider_enable = themes_get_option_key( 'slider_enable', $themes_array );
$slider_products_enable = themes_get_option_key( 'slider_products_enable', $themes_array );
$slider_products_nav_enable = themes_get_option_key( 'slider_products_nav_enable', $themes_array );
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

$themes_slide_button_gradient_bgcolor2 = themes_get_option_key( 'themes_slide_button_gradient_bgcolor2', $themes_array );

$themes_slidepro_button_gradient_bgcolor1 = themes_get_option_key( 'themes_slidepro_button_gradient_bgcolor1', $themes_array );
$themes_slidepro_button_gradient_bgcolor2 = themes_get_option_key( 'themes_slidepro_button_gradient_bgcolor2', $themes_array );
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
$about_video_icons_color = themes_get_option_key( 'about_video_icons_color', $themes_array );
$about_video_icons_bg_color = themes_get_option_key( 'about_video_icons_bg_color', $themes_array );

$features_button_text_color = themes_get_option_key( 'features_button_text_color', $themes_array );
$features_button_text_fontfamily = themes_get_option_key( 'features_button_text_fontfamily', $themes_array );
$features_button_text_font_size = themes_get_option_key( 'features_button_text_font_size', $themes_array );

$radio_getstarted_blog_enable = themes_get_option_key( 'radio_getstarted_blog_enable', $themes_array );
$getstarted_blog_bg_color = themes_get_option_key( 'getstarted_blog_bg_color', $themes_array );
$getstarted_blog_bg_image = themes_get_option_key( 'getstarted_blog_bg_image', $themes_array );

$radio_browse_topics_enable = themes_get_option_key( 'radio_browse_topics_enable', $themes_array );
$browse_topics_bg_color = themes_get_option_key( 'browse_topics_bg_color', $themes_array );
$browse_topics_bg_image = themes_get_option_key( 'browse_topics_bg_image', $themes_array );

$radio_services_blog_enable = themes_get_option_key( 'radio_services_blog_enable', $themes_array );
$services_blog_bg_color = themes_get_option_key( 'services_blog_bg_color', $themes_array );
$services_blog_bg_image = themes_get_option_key( 'services_blog_bg_image', $themes_array );
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
$our_app_section_bgcolor = themes_get_option_key( 'our_app_section_bgcolor', $themes_array );
$our_app_section_bgimage = themes_get_option_key( 'our_app_section_bgimage', $themes_array );

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
$partnersbg_color = themes_get_option_key( 'partnersbg_color', $themes_array );
$partnersbg_image = themes_get_option_key( 'partnersbg_image', $themes_array );
$our_partners_bg_color = themes_get_option_key( 'our_partners_bg_color', $themes_array );
$our_partners_bg_hovercolor = themes_get_option_key( 'our_partners_bg_hovercolor', $themes_array );

$radio_live_chat_enable = themes_get_option_key( 'radio_live_chat_enable', $themes_array );
$live_chat_bg_color = themes_get_option_key( 'live_chat_bg_color', $themes_array );
$live_chat_bg_image = themes_get_option_key( 'live_chat_bg_image', $themes_array );

$radio_active_articals_enable = themes_get_option_key( 'radio_active_articals_enable', $themes_array );
$active_articals_bg_color = themes_get_option_key( 'active_articals_bg_color', $themes_array );
$active_articals_bg_image = themes_get_option_key( 'active_articals_bg_image', $themes_array );

$radio_our_faq_enable = themes_get_option_key( 'radio_our_faq_enable', $themes_array );
$our_faq_bg_color = themes_get_option_key( 'our_faq_bg_color', $themes_array );
$our_faq_bg_image = themes_get_option_key( 'our_faq_bg_image', $themes_array );

$radio_contact_partners_enable = themes_get_option_key( 'radio_contact_partners_enable', $themes_array );
$contact_partners_bg_color = themes_get_option_key( 'contact_partners_bg_color', $themes_array );
$contact_partners_bg_image = themes_get_option_key( 'contact_partners_bg_image', $themes_array );

$home_page_contact_bg_color = themes_get_option_key( 'home_page_contact_bg_color', $themes_array );
$home_page_contact_bg_image = themes_get_option_key( 'home_page_contact_bg_image', $themes_array );

//Our Services
$services_enabledisable = themes_get_option_key( 'services_enabledisable', $themes_array );
$services_bgcolor = themes_get_option_key( 'services_bgcolor', $themes_array );
$services_bgimage = themes_get_option_key( 'services_bgimage', $themes_array );

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
$features_button_bg_color = themes_get_option_key( 'features_button_bg_color', $themes_array );
$themes_service_box_icons_bg_hovercolor = themes_get_option_key( 'themes_service_box_icons_bg_hovercolor', $themes_array );

$themes_service_box_title_color = themes_get_option_key( 'themes_service_box_title_color', $themes_array );
$themes_service_box_title_font_family = themes_get_option_key( 'themes_service_box_title_font_family', $themes_array );
$themes_service_box_title_font_size = themes_get_option_key( 'themes_service_box_title_font_size', $themes_array );

$themes_service_box_content_color = themes_get_option_key( 'themes_service_box_content_color', $themes_array );
$themes_service_box_content_font_family = themes_get_option_key( 'themes_service_box_content_font_family', $themes_array );
$themes_service_box_content_font_size = themes_get_option_key( 'themes_service_box_content_font_size', $themes_array );

$all_services_button_color = themes_get_option_key( 'all_services_button_color', $themes_array );
$all_services_button_fontfamily = themes_get_option_key( 'all_services_button_fontfamily', $themes_array );
$all_services_button_font_size = themes_get_option_key( 'all_services_button_font_size', $themes_array );
$all_services_button_bgcolor1 = themes_get_option_key( 'all_services_button_bgcolor1', $themes_array );
$all_services_button_bgcolor2 = themes_get_option_key( 'all_services_button_bgcolor2', $themes_array );
$all_services_button_bgcolor = themes_get_option_key( 'all_services_button_bgcolor', $themes_array );
//Degines interface
$radio_interface_deg_enable = themes_get_option_key( 'radio_interface_deg_enable', $themes_array );
$interface_deg_section_bgcolor = themes_get_option_key( 'interface_deg_section_bgcolor', $themes_array );
$interface_deg_section_bgimage = themes_get_option_key( 'interface_deg_section_bgimage', $themes_array );

$interface_main_title_color = themes_get_option_key( 'interface_main_title_color', $themes_array );
$interface_main_title_fontfamily = themes_get_option_key( 'interface_main_title_fontfamily', $themes_array );
$interface_main_title_font_size = themes_get_option_key( 'interface_main_title_font_size', $themes_array );

$interface_text_color = themes_get_option_key( 'interface_text_color', $themes_array );
$interface_text_fontfamily = themes_get_option_key( 'interface_text_fontfamily', $themes_array );
$interface_text_font_size = themes_get_option_key( 'interface_text_font_size', $themes_array );

$interface_list_title_color = themes_get_option_key( 'interface_list_title_color', $themes_array );
$interface_list_title_fontfamily = themes_get_option_key( 'interface_list_title_fontfamily', $themes_array );
$interface_list_title_font_size = themes_get_option_key( 'interface_list_title_font_size', $themes_array );

$interface_button_text_color = themes_get_option_key( 'interface_button_text_color', $themes_array );
$interface_button_text_fontfamily = themes_get_option_key( 'interface_button_text_fontfamily', $themes_array );
$interface_button_text_font_size = themes_get_option_key( 'interface_button_text_font_size', $themes_array );
$interface_button_bg_color = themes_get_option_key( 'interface_button_bg_color', $themes_array );

$radio_introduction_enable = themes_get_option_key( 'radio_introduction_enable', $themes_array );
$introduction_section_bgcolor = themes_get_option_key( 'introduction_section_bgcolor', $themes_array );
$introduction_section_bgimage = themes_get_option_key( 'introduction_section_bgimage', $themes_array );

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

$seller_button_bgcolor = themes_get_option_key( 'seller_button_bgcolor', $themes_array );

$cart_button_bgcolor1 = themes_get_option_key( 'cart_button_bgcolor1', $themes_array );
$cart_button_bgcolor2 = themes_get_option_key( 'cart_button_bgcolor2', $themes_array );
$cart_button_fontfamily = themes_get_option_key( 'cart_button_fontfamily', $themes_array );
$cart_button_font_size = themes_get_option_key( 'cart_button_font_size', $themes_array );
$cart_button_color = themes_get_option_key( 'cart_button_color', $themes_array );

$seller_button_bgcolor1 = themes_get_option_key( 'seller_button_bgcolor1', $themes_array );
$seller_button_bgcolor2 = themes_get_option_key( 'seller_button_bgcolor2', $themes_array );

$seller_batch_bgcolor1 = themes_get_option_key( 'seller_batch_bgcolor1', $themes_array );
$seller_batch_bgcolor2 = themes_get_option_key( 'seller_batch_bgcolor2', $themes_array );

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

$product_title_fontfamily = themes_get_option_key( 'product_title_fontfamily', $themes_array );
$product_title_font_size = themes_get_option_key( 'product_title_font_size', $themes_array );

$product_price_color = themes_get_option_key( 'product_price_color', $themes_array );
$product_price_fontfamily = themes_get_option_key( 'product_price_fontfamily', $themes_array );
$product_price_font_size = themes_get_option_key( 'product_price_font_size', $themes_array );

$product_button_color = themes_get_option_key( 'product_button_color', $themes_array );
$product_button_fontfamily = themes_get_option_key( 'product_button_fontfamily', $themes_array );
$product_button_font_size = themes_get_option_key( 'product_button_font_size', $themes_array );
$product_button_bgcolor = themes_get_option_key( 'product_button_bgcolor', $themes_array );

$product_button_bgcolor1 = themes_get_option_key( 'product_button_bgcolor1', $themes_array );
$product_button_bgcolor2 = themes_get_option_key( 'product_button_bgcolor2', $themes_array );

$tab_tittle_active_color1 = themes_get_option_key( 'tab_tittle_active_color1', $themes_array );
$tab_tittle_active_color2 = themes_get_option_key( 'tab_tittle_active_color2', $themes_array );

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
$themes_testimonial_but_bgcolor1 = themes_get_option_key( 'themes_testimonial_but_bgcolor1', $themes_array );
$themes_testimonial_but_bgcolor2 = themes_get_option_key( 'themes_testimonial_but_bgcolor2', $themes_array );

$video_enable = themes_get_option_key( 'video_enable', $themes_array );
$video_bgcolor = themes_get_option_key( 'video_bgcolor', $themes_array );
$video_bgimage = themes_get_option_key( 'video_bgimage', $themes_array );

$video_sec_main_title_color = themes_get_option_key( 'video_sec_main_title_color', $themes_array );
$video_sec_main_title_font_family = themes_get_option_key( 'video_sec_main_title_font_family', $themes_array );
$video_sec_main_title_font_size = themes_get_option_key( 'video_sec_main_title_font_size', $themes_array );

$video_sec_small_left_title_color = themes_get_option_key( 'video_sec_small_left_title_color', $themes_array );
$video_sec_small_left_title_font_family = themes_get_option_key( 'video_sec_small_left_title_font_family', $themes_array );
$video_sec_small_left_title_font_size = themes_get_option_key( 'video_sec_small_left_title_font_size', $themes_array );

$video_sec_small_right_title_color = themes_get_option_key( 'video_sec_small_right_title_color', $themes_array );
$video_sec_small_right_title_font_family = themes_get_option_key( 'video_sec_small_right_title_font_family', $themes_array );
$video_sec_small_right_title_font_size = themes_get_option_key( 'video_sec_small_right_title_font_size', $themes_array );
$video_sec_small_right_title_bgcolor = themes_get_option_key( 'video_sec_small_right_title_bgcolor', $themes_array );

$video_sec_text_color = themes_get_option_key( 'video_sec_text_color', $themes_array );
$video_sec_text_font_family = themes_get_option_key( 'video_sec_text_font_family', $themes_array );
$video_sec_text_font_size = themes_get_option_key( 'video_sec_text_font_size', $themes_array );

$video_sec_button_text_color = themes_get_option_key( 'video_sec_button_text_color', $themes_array );
$video_sec_button_text_fontfamily = themes_get_option_key( 'video_sec_button_text_fontfamily', $themes_array );
$video_sec_button_text_font_size = themes_get_option_key( 'video_sec_button_text_font_size', $themes_array );
$video_sec_button_bg_color = themes_get_option_key( 'video_sec_button_bg_color', $themes_array );
$video_icons_color = themes_get_option_key( 'video_icons_color', $themes_array );

$video_sec_Main_text_color = themes_get_option_key( 'video_sec_Main_text_color', $themes_array );
$video_sec_Main_text_fontfamily = themes_get_option_key( 'video_sec_Main_text_fontfamily', $themes_array );
$video_sec_Main_text_font_size = themes_get_option_key( 'video_sec_Main_text_font_size', $themes_array );

//Recodes
$themes_our_record_number_color = themes_get_option_key( 'themes_our_record_number_color', $themes_array );
$themes_our_record_number_font_family = themes_get_option_key( 'themes_our_record_number_font_family', $themes_array );
$themes_our_record_number_font_size = themes_get_option_key( 'themes_our_record_number_font_size', $themes_array );

$themes_our_record_title_color = themes_get_option_key( 'themes_our_record_title_color', $themes_array );
$themes_our_record_title_font_family = themes_get_option_key( 'themes_our_record_title_font_family', $themes_array );
$themes_our_record_title_font_size = themes_get_option_key( 'themes_our_record_title_font_size', $themes_array );

$themes_our_record_icon_bgcolor = themes_get_option_key( 'themes_our_record_icon_bgcolor', $themes_array );

$themes_our_record_icon_hover_bgcolor1 = themes_get_option_key( 'themes_our_record_icon_hover_bgcolor1', $themes_array );
$themes_our_record_icon_hover_bgcolor2 = themes_get_option_key( 'themes_our_record_icon_hover_bgcolor2', $themes_array );

$record_sub_title_color = themes_get_option_key( 'record_sub_title_color', $themes_array );
$record_sub_title_font_family = themes_get_option_key( 'record_sub_title_font_family', $themes_array );
$record_sub_title_font_size = themes_get_option_key( 'record_sub_title_font_size', $themes_array );
//pricing planse
$pricing_plan_enable = themes_get_option_key( 'pricing_plan_enable', $themes_array );

$pricing_plan_bgcolor = themes_get_option_key( 'pricing_plan_bgcolor', $themes_array );
$pricing_plan_bgimage = themes_get_option_key( 'pricing_plan_bgimage', $themes_array );
$pricing_plan_bgimage2 = themes_get_option_key( 'pricing_plan_bgimage2', $themes_array );

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

$plan_but_bgcolor1 = themes_get_option_key( 'plan_but_bgcolor1', $themes_array );
$plan_but_bgcolor2 = themes_get_option_key( 'plan_but_bgcolor2', $themes_array );

$records_section_enable = themes_get_option_key( 'records_section_enable', $themes_array );
$records_bgcolor = themes_get_option_key( 'records_bgcolor', $themes_array );
$records_bgimage = themes_get_option_key( 'records_bgimage', $themes_array );

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
$get_in_touch_section_bgcolor2 = themes_get_option_key( 'get_in_touch_section_bgcolor2', $themes_array );
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

  $themes_themes_headermenu_color = themes_get_option_key( 'themes_headermenu_color', $themes_array );
  $themes_themes_headermenu_color_afterhover = themes_get_option_key( 'themes_headermenu_color_afterhover', $themes_array );
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
  $themes_responsive_menu_color = themes_get_option_key( 'themes_responsive_menu_color', $themes_array );

$themes_header_cart_bgcolor = themes_get_option_key( 'themes_header_cart_bgcolor', $themes_array );
$themes_header_cart_color = themes_get_option_key( 'themes_header_cart_color', $themes_array );
$themes_header_cart_count_bgcolor = themes_get_option_key( 'themes_header_cart_count_bgcolor', $themes_array );
$themes_header_cart_font_family = themes_get_option_key( 'themes_header_cart_font_family', $themes_array );
$themes_header_cart_font_size = themes_get_option_key( 'themes_header_cart_font_size', $themes_array );

$themes_header_padding_leftRight = themes_get_option_key( 'themes_header_padding_leftRight', $themes_array );

$themes_header_section_search_font_size = themes_get_option_key( 'themes_header_section_search_font_size', $themes_array );
$themes_header_section_search_color = themes_get_option_key( 'themes_header_section_search_color', $themes_array );

$themes_header_button_text_color = themes_get_option_key( 'themes_header_button_text_color', $themes_array );
$themes_header_button_text_font_size = themes_get_option_key( 'themes_header_button_text_font_size', $themes_array );
$themes_header_button_text_font_family = themes_get_option_key( 'themes_header_button_text_font_family', $themes_array );

$themes_header_button_bg_color = themes_get_option_key( 'themes_header_button_bg_color', $themes_array );
$themes_header_button_bg_color_afterhover = themes_get_option_key( 'header_button_bg_color_afterhover', $themes_array );

$themes_header_category_bar_color = themes_get_option_key( 'themes_header_category_bar_color', $themes_array );
$themes_header_category_box_bg_color = themes_get_option_key( 'themes_header_category_box_bg_color', $themes_array );
$themes_header_category_text_color = themes_get_option_key( 'themes_header_category_text_color', $themes_array );
$themes_header_category_text_font_family = themes_get_option_key( 'themes_header_category_text_font_family', $themes_array );
$themes_header_category_text_font_size = themes_get_option_key( 'themes_header_category_text_font_size', $themes_array );

//Footer Widgets
$themes_footer_widgets_enable = themes_get_option_key( 'themes_footer_widgets_enable', $themes_array );
$themes_footer_widget_bgcolor = themes_get_option_key( 'themes_footer_widget_bgcolor', $themes_array );
$themes_footer_widget_bg_image = themes_get_option_key( 'themes_footer_widget_bg_image', $themes_array );

$themes_footer_widget_heading_color = themes_get_option_key( 'themes_footer_widget_heading_color', $themes_array );
$themes_footer_widget_heading_font_family = themes_get_option_key( 'themes_footer_widget_heading_font_family', $themes_array );
$themes_footer_widget_heading_font_size = themes_get_option_key( 'themes_footer_widget_heading_font_size', $themes_array );

$themes_footer_widget_content_color = themes_get_option_key( 'themes_footer_widget_content_color', $themes_array );
$themes_footer_widget_content_font_family = themes_get_option_key( 'themes_footer_widget_content_font_family', $themes_array );
$themes_footer_widget_content_font_size = themes_get_option_key( 'themes_footer_widget_content_font_size', $themes_array );

$themes_footer_widget_Menu_color = themes_get_option_key( 'themes_footer_widget_Menu_color', $themes_array );
$themes_footer_widget_Menu_font_family = themes_get_option_key( 'themes_footer_widget_Menu_font_family', $themes_array );
$themes_footer_widget_Menu_font_size = themes_get_option_key( 'themes_footer_widget_Menu_font_size', $themes_array );

$themes_spinner_bg_color1 = themes_get_option_key( 'themes_spinner_bg_color1', $themes_array );
$themes_spinner_bg_color2 = themes_get_option_key( 'themes_spinner_bg_color2', $themes_array );

$themes_footer_widget_heading_color1 = themes_get_option_key( 'themes_footer_widget_heading_color1', $themes_array );
$themes_footer_widget_heading_color2 = themes_get_option_key( 'themes_footer_widget_heading_color2', $themes_array );

//Footer Copyright
$themes_footer_section_enable = themes_get_option_key( 'themes_footer_section_enable', $themes_array );
$themes_footer_section_bg_color = themes_get_option_key( 'themes_footer_section_bg_color', $themes_array );
$themes_footer_section_bg_image = themes_get_option_key( 'themes_footer_section_bg_image', $themes_array );

$themes_footer_copy_content_color = themes_get_option_key( 'themes_footer_copy_content_color', $themes_array );
$themes_footer_copy_content_font_family = themes_get_option_key( 'themes_footer_copy_content_font_family', $themes_array );
$themes_footer_copy_content_font_size = themes_get_option_key( 'themes_footer_copy_content_font_size', $themes_array );
$themes_footer_copy_text_alignment = themes_get_option_key( 'themes_footer_copy_text_alignment', $themes_array );
//Contact
$themes_contact_page_heading_color = themes_get_option_key( 'themes_contact_page_heading_color', $themes_array );
$themes_contact_page_heading_font_family = themes_get_option_key( 'themes_contact_page_heading_font_family', $themes_array );
$themes_contact_page_heading_font_size = themes_get_option_key( 'themes_contact_page_heading_font_size', $themes_array );

$themes_contact_page_text_color = themes_get_option_key( 'themes_contact_page_text_color', $themes_array );
$themes_contact_page_text_font_family = themes_get_option_key( 'themes_contact_page_text_font_family', $themes_array );
$themes_contact_page_text_font_size = themes_get_option_key( 'themes_contact_page_text_font_size', $themes_array );

$themes_contact_page_form_title_color = themes_get_option_key( 'themes_contact_page_form_title_color', $themes_array );
$themes_contact_page_contacts_form_title_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_title_font_family', $themes_array );
$themes_contact_page_contacts_form_title_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_title_font_size', $themes_array );

$themes_contact_page_form_text_color = themes_get_option_key( 'themes_contact_page_form_text_color', $themes_array );
$themes_contact_page_contacts_form_text_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_text_font_family', $themes_array );
$themes_contact_page_contacts_form_text_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_text_font_size', $themes_array );

$themes_contact_page_form_button_color = themes_get_option_key( 'themes_contact_page_form_button_color', $themes_array );
$themes_contact_page_contacts_form_button_font_family = themes_get_option_key( 'themes_contact_page_contacts_form_button_font_family', $themes_array );
$themes_contact_page_contacts_form_button_font_size = themes_get_option_key( 'themes_contact_page_contacts_form_button_font_size', $themes_array );
$themes_contact_page_button_bgcolor1 = themes_get_option_key( 'themes_contact_page_button_bgcolor1', $themes_array );

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

$radio4_enable = themes_get_option_key( 'radio4_enable', $themes_array );
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

// Search Banner
$themes_search_banner_main_heading = themes_get_option_key( 'search_banner_main_heading', $themes_array );
$themes_search_banner_text_color = themes_get_option_key( 'search_banner_text_color', $themes_array );
$themes_setting_search_banner_text_font_family = themes_get_option_key( 'setting_search_banner_text_font_family', $themes_array );
$themes_setting_search_banner_text_size = themes_get_option_key( 'setting_search_banner_text_size', $themes_array );
$themes_setting_search_banner_bgcolor = themes_get_option_key( 'setting_search_banner_bgcolor', $themes_array );
$themes_setting_search_banner_border_color = themes_get_option_key( 'setting_search_banner_border_color', $themes_array );
$themes_setting_search_banner_input_text_font_family = themes_get_option_key( 'setting_search_banner_input_text_font_family', $themes_array );
$themes_setting_search_banner_input_text_color = themes_get_option_key( 'setting_search_banner_input_text_color', $themes_array );

$setting_search_banner_smalltext_color = themes_get_option_key( 'setting_search_banner_smalltext_color', $themes_array );
$setting_search_banner_smalltext_font_family = themes_get_option_key( 'setting_search_banner_smalltext_font_family', $themes_array );
$setting_search_banner_smalltext_size = themes_get_option_key( 'setting_search_banner_smalltext_size', $themes_array );

// Our Features
$themes_setting_our_features_main_head_text_color = themes_get_option_key( 'setting_our_features_main_head_text_color', $themes_array );
$themes_our_features_bg_color = themes_get_option_key( 'our_features_bg_color', $themes_array );
$our_features_bg_image = themes_get_option_key( 'our_features_bg_image', $themes_array );
$themes_features_small_text_color = themes_get_option_key( 'features_small_text_color', $themes_array );
$themes_features_small_text_fontfamily = themes_get_option_key( 'features_small_text_fontfamily', $themes_array );
$themes_features_small_text_font_size = themes_get_option_key( 'features_small_text_font_size', $themes_array );
$themes_features_main_text_color = themes_get_option_key( 'features_main_text_color', $themes_array );
$themes_features_main_text_fontfamily = themes_get_option_key( 'features_main_text_fontfamily', $themes_array );
$themes_features_main_text_font_size = themes_get_option_key( 'features_main_text_font_size', $themes_array );

// About Us
$radio_about_enable = themes_get_option_key( 'radio_about_enable', $themes_array );
$about_bgcolor = themes_get_option_key( 'about_bgcolor', $themes_array );
$about_bgimage = themes_get_option_key( 'about_bgimage', $themes_array );

$fetured_product_bg_color = themes_get_option_key( 'fetured_product_bg_color', $themes_array );
$fetured_product_bg_image = themes_get_option_key( 'fetured_product_bg_image', $themes_array );

$themes_about_main_title_color = themes_get_option_key( 'about_main_title_color', $themes_array );
$themes_about_main_title_fontfamily = themes_get_option_key( 'about_main_title_fontfamily', $themes_array );
$themes_about_main_title_font_size = themes_get_option_key( 'about_main_title_font_size', $themes_array );
$themes_about_list_title_color = themes_get_option_key( 'about_list_title_color', $themes_array );
$themes_about_list_title_fontfamily = themes_get_option_key( 'about_list_title_fontfamily', $themes_array );
$themes_about_list_title_font_size = themes_get_option_key( 'about_list_title_font_size', $themes_array );
$why_choose_us_button_text_color = themes_get_option_key( 'why_choose_us_button_text_color', $themes_array );
$themes_about_button_text_fontfamily = themes_get_option_key( 'about_button_text_fontfamily', $themes_array );
$themes_about_button_text_font_size = themes_get_option_key( 'about_button_text_font_size', $themes_array );
$themes_about_button_bg_color = themes_get_option_key( 'about_button_bg_color', $themes_array );

// Browse Topics
$themes_browse_topics_bg_color = themes_get_option_key( 'browse_topics_bg_color', $themes_array );
$themes_browse_topics_main_text_color = themes_get_option_key( 'browse_topics_main_text_color', $themes_array );
$themes_browse_topics_main_text_fontfamily = themes_get_option_key( 'browse_topics_main_text_fontfamily', $themes_array );
$themes_browse_topics_main_text_font_size = themes_get_option_key( 'browse_topics_main_text_font_size', $themes_array );
$themes_browse_topics_button_bg_color = themes_get_option_key( 'browse_topics_button_bg_color', $themes_array );
$themes_browse_topics_button_text_color = themes_get_option_key( 'browse_topics_button_text_color', $themes_array );
$themes_browse_topics_button_text_fontfamily = themes_get_option_key( 'browse_topics_button_text_fontfamily', $themes_array );
$themes_browse_topics_button_text_font_size = themes_get_option_key( 'browse_topics_button_text_font_size', $themes_array );
$themes_browse_topics_button_bg_color = themes_get_option_key( 'browse_topics_button_bg_color', $themes_array );

// Our Services
$themes_services_blog_main_text_color = themes_get_option_key( 'services_blog_main_text_color', $themes_array );
$themes_services_blog_main_text_fontfamily = themes_get_option_key( 'services_blog_main_text_fontfamily', $themes_array );
$themes_services_blog_main_text_font_size = themes_get_option_key( 'services_blog_main_text_font_size', $themes_array );
$themes_services_blog_dicsount_text_color = themes_get_option_key( 'services_blog_dicsount_text_color', $themes_array );
$themes_services_blog_dicsount_text_fontfamily = themes_get_option_key( 'services_blog_dicsount_text_fontfamily', $themes_array );
$themes_services_blog_dicsount_text_font_size = themes_get_option_key( 'services_blog_dicsount_text_font_size', $themes_array );
$themes_services_blog_button_bg_color = themes_get_option_key( 'services_blog_button_bg_color', $themes_array );
$themes_services_blog_button_text_color = themes_get_option_key( 'services_blog_button_text_color', $themes_array );
$themes_services_blog_button_text_fontfamily = themes_get_option_key( 'services_blog_button_text_fontfamily', $themes_array );
$themes_services_blog_button_text_font_size = themes_get_option_key( 'services_blog_button_text_font_size', $themes_array );

// Getting Started
$themes_getstarted_blog_bg_color = themes_get_option_key( 'getstarted_blog_bg_color', $themes_array );
$themes_getstarted_blog_small_text_color = themes_get_option_key( 'getstarted_blog_small_text_color', $themes_array );
$themes_getstarted_blog_small_text_fontfamily = themes_get_option_key( 'getstarted_blog_small_text_fontfamily', $themes_array );
$themes_getstarted_blog_small_text_font_size = themes_get_option_key( 'getstarted_blog_small_text_font_size', $themes_array );
$themes_getstarted_blog_main_text_color = themes_get_option_key( 'getstarted_blog_main_text_color', $themes_array );
$themes_getstarted_blog_main_text_fontfamily = themes_get_option_key( 'getstarted_blog_main_text_fontfamily', $themes_array );
$themes_getstarted_blog_main_text_font_size = themes_get_option_key( 'getstarted_blog_main_text_font_size', $themes_array );
$themes_getstarted_blog_dicsount_text_color = themes_get_option_key( 'getstarted_blog_dicsount_text_color', $themes_array );
$themes_getstarted_blog_dicsount_text_fontfamily = themes_get_option_key( 'getstarted_blog_dicsount_text_fontfamily', $themes_array );
$themes_getstarted_blog_dicsount_text_font_size = themes_get_option_key( 'getstarted_blog_dicsount_text_font_size', $themes_array );
$themes_getstarted_blog_button_bg_color = themes_get_option_key( 'getstarted_blog_button_bg_color', $themes_array );
$themes_getstarted_blog_button_text_color = themes_get_option_key( 'getstarted_blog_button_text_color', $themes_array );
$themes_getstarted_blog_button_text_fontfamily = themes_get_option_key( 'getstarted_blog_button_text_fontfamily', $themes_array );
$themes_getstarted_blog_button_text_font_size = themes_get_option_key( 'getstarted_blog_button_text_font_size', $themes_array );

// How It Works
$radio_how_it_work_enable = themes_get_option_key( 'radio_how_it_work_enable', $themes_array );
$how_it_work_bg_color = themes_get_option_key( 'how_it_work_bg_color', $themes_array );
$how_it_work_bg_image = themes_get_option_key( 'how_it_work_bg_image', $themes_array );
$themes_how_it_work_bg_color = themes_get_option_key( 'how_it_work_bg_color', $themes_array );
$themes_how_it_work_small_text_color = themes_get_option_key( 'how_it_work_small_text_color', $themes_array );
$themes_how_it_work_small_text_fontfamily = themes_get_option_key( 'how_it_work_small_text_fontfamily', $themes_array );
$themes_how_it_work_small_text_font_size = themes_get_option_key( 'how_it_work_small_text_font_size', $themes_array );
$themes_how_it_work_main_text_color = themes_get_option_key( 'how_it_work_main_text_color', $themes_array );
$themes_how_it_work_main_text_fontfamily = themes_get_option_key( 'how_it_work_main_text_fontfamily', $themes_array );
$themes_how_it_work_main_text_font_size = themes_get_option_key( 'how_it_work_main_text_font_size', $themes_array );
$themes_how_it_work_main_heading_text_color = themes_get_option_key( 'how_it_work_main_heading_text_color', $themes_array );
$themes_how_it_work_main_heading_font_family = themes_get_option_key( 'how_it_work_main_heading_font_family', $themes_array );
$themes_how_it_work_main_heading_font_size = themes_get_option_key( 'how_it_work_main_heading_font_size', $themes_array );

// Our Partners
$themes_our_partners_main_heading_text_color = themes_get_option_key( 'our_partners_main_heading_text_color', $themes_array );
$themes_our_partners_main_heading_font_family = themes_get_option_key( 'our_our_partners_main_heading_font_family', $themes_array );
$themes_our_partners_main_heading_font_size = themes_get_option_key( 'our_partners_main_heading_font_size', $themes_array );

$our_partners_small_heading_color = themes_get_option_key( 'our_partners_small_heading_color', $themes_array );
$our_partners_small_heading_font_family = themes_get_option_key( 'our_partners_small_heading_font_family', $themes_array );
$our_partners_small_heading_font_size = themes_get_option_key( 'our_partners_small_heading_font_size', $themes_array );
// timming
$radio_timming_enable = themes_get_option_key( 'radio_timming_enable', $themes_array );
// Our Services
$themes_themes_servicesmall_title_color = themes_get_option_key( 'themes_servicesmall_title_color', $themes_array );
$themes_themes_servicesmall_title_font_family = themes_get_option_key( 'themes_servicesmall_title_font_family', $themes_array );
$themes_themes_servicesmall_title_font_size = themes_get_option_key( 'themes_servicesmall_title_font_size', $themes_array );
$themes_our_services_main_heading_text_color = themes_get_option_key( 'our_services_main_heading_text_color', $themes_array );
$themes_our_services_main_heading_font_family = themes_get_option_key( 'our_services_main_heading_font_family', $themes_array );
$themes_our_services_main_heading_font_size = themes_get_option_key( 'our_services_main_heading_font_size', $themes_array );
$themes_servicesmall_para_color = themes_get_option_key( 'servicesmall_para_color', $themes_array );
$themes_servicesmall_para_font_family = themes_get_option_key( 'servicesmall_para_font_family', $themes_array );
$themes_servicesmall_para_font_size = themes_get_option_key( 'servicesmall_para_font_size', $themes_array );

// Active Articles
$themes_active_articals_features_text_color = themes_get_option_key( 'active_articals_features_text_color', $themes_array );
$themes_active_articals_features_font_family = themes_get_option_key( 'active_articals_features_font_family', $themes_array );
$themes_active_articals_features_font_size = themes_get_option_key( 'active_articals_features_font_size', $themes_array );
$themes_active_articals_main_heading_text_color = themes_get_option_key( 'active_articals_main_heading_text_color', $themes_array );
$themes_active_articals_main_heading_font_family = themes_get_option_key( 'active_articals_main_heading_font_family', $themes_array );
$themes_active_articals_main_heading_font_size = themes_get_option_key( 'active_articals_main_heading_font_size', $themes_array );
$themes_active_articals_features_bgcolor = themes_get_option_key( 'active_articals_features_bgcolor', $themes_array );
$themes_active_articals_button_text_color = themes_get_option_key( 'active_articals_button_text_color', $themes_array );
$themes_active_articals_button_text_fontfamily = themes_get_option_key( 'active_articals_button_text_fontfamily', $themes_array );
$themes_active_articals_button_text_font_size = themes_get_option_key( 'active_articals_button_text_font_size', $themes_array );
$themes_active_articals_button_bg_color = themes_get_option_key( 'active_articals_button_bg_color', $themes_array );
$themes_active_articals_features_bgcolor_afterhover = themes_get_option_key( 'active_articals_features_bgcolor_afterhover', $themes_array );
$themes_active_articals_main_heading_font_color_afterhover = themes_get_option_key( 'active_articals_main_heading_font_color_afterhover', $themes_array );
$themes_active_articals_features_font_color_afterhover = themes_get_option_key( 'active_articals_features_font_color_afterhover', $themes_array );
$themes_active_articals_button_font_color_afterhover = themes_get_option_key( 'active_articals_button_font_color_afterhover', $themes_array );
$themes_active_articals_button_bgcolor_afterhover = themes_get_option_key( 'active_articals_button_bgcolor_afterhover', $themes_array );

// Our team
// why choose us
$our_team_enabledisable = themes_get_option_key( 'our_team_enabledisable', $themes_array );
$themes_our_team_title_color = themes_get_option_key( 'themes_our_team_title_color', $themes_array );
$themes_our_team_title_font_family = themes_get_option_key( 'our_team_title_font_family', $themes_array );
$themes_our_team_title_font_size = themes_get_option_key( 'our_team_title_font_size', $themes_array );

$our_team_small_title_color = themes_get_option_key( 'our_team_small_title_color', $themes_array );
$our_team_small_title_font_family = themes_get_option_key( 'our_team_small_title_font_family', $themes_array );
$our_team_small_title_font_size = themes_get_option_key( 'our_team_small_title_font_size', $themes_array );

$our_team_box_bg_color = themes_get_option_key( 'our_team_box_bg_color', $themes_array );
$our_team_box_hover_bgcolor = themes_get_option_key( 'our_team_box_hover_bgcolor', $themes_array );

$themes_our_team_bg_color = themes_get_option_key( 'our_team_bg_color', $themes_array );
$our_team_bg_image = themes_get_option_key( 'our_team_bg_image', $themes_array );
$themes_our_team_box_title_color = themes_get_option_key( 'our_team_box_title_color', $themes_array );
$themes_our_team_box_title_font_family = themes_get_option_key( 'our_team_box_title_font_family', $themes_array );
$themes_our_team_box_title_font_size = themes_get_option_key( 'our_team_box_title_font_size', $themes_array );
$themes_our_team_box_content_color = themes_get_option_key( 'our_team_box_content_color', $themes_array );
$themes_our_team_box_content_font_family = themes_get_option_key( 'our_team_box_content_font_family', $themes_array );
$themes_our_team_box_content_font_size = themes_get_option_key( 'our_team_box_content_font_size', $themes_array );
$themes_our_team_bg_color_afterhover = themes_get_option_key( 'our_team_bg_color_afterhover', $themes_array );

$our_team_box_button_color = themes_get_option_key( 'our_team_box_button_color', $themes_array );
$our_team_box_button_font_family = themes_get_option_key( 'our_team_box_button_font_family', $themes_array );
$our_team_box_button_font_size = themes_get_option_key( 'our_team_box_button_font_size', $themes_array );
$our_team_box_button_bgcolor = themes_get_option_key( 'our_team_box_button_bgcolor', $themes_array );

// why choose us
$radio_why_choose_us_enable = themes_get_option_key( 'radio_why_choose_us_enable', $themes_array );
$themes_why_choose_us_color = themes_get_option_key( 'why_choose_us_bg_color', $themes_array );
$themes_why_choose_us_small_text_color = themes_get_option_key( 'why_choose_us_small_text_color', $themes_array );
$themes_why_choose_us_small_text_fontfamily = themes_get_option_key( 'why_choose_us_small_text_fontfamily', $themes_array );
$themes_why_choose_us_small_text_font_size = themes_get_option_key( 'why_choose_us_small_text_font_size', $themes_array );
$themes_why_choose_us_main_text_color = themes_get_option_key( 'why_choose_us_main_text_color', $themes_array );
$themes_why_choose_us_main_text_fontfamily = themes_get_option_key( 'why_choose_us_main_text_fontfamily', $themes_array );
$themes_why_choose_us_main_text_font_size = themes_get_option_key( 'why_choose_us_main_text_font_size', $themes_array );
$why_choose_us_main_heading_text_color = themes_get_option_key( 'why_choose_us_main_heading_text_color', $themes_array );
$why_choose_us_main_heading_font_family = themes_get_option_key( 'why_choose_us_main_heading_font_family', $themes_array );
$why_choose_us_main_heading_font_size = themes_get_option_key( 'why_choose_us_main_heading_font_size', $themes_array );

// Introduction

$themes_introduction_section_main_title_color = themes_get_option_key( 'introduction_section_main_title_color', $themes_array );
$themes_introduction_section_main_title_font_family = themes_get_option_key( 'introduction_section_main_title_font_family', $themes_array );
$themes_introduction_section_main_title_font_size = themes_get_option_key( 'introduction_section_main_title_font_size', $themes_array );
$themes_introduction_box_bgcolor = themes_get_option_key( 'introduction_box_bgcolor', $themes_array );
$themes_introduction_box_bgcolor_afterhover = themes_get_option_key( 'introduction_box_bgcolor_afterhover', $themes_array );
$themes_introduction_box_title_color = themes_get_option_key( 'introduction_box_title_color', $themes_array );
$themes_introduction_box_title_font_family = themes_get_option_key( 'introduction_box_title_font_family', $themes_array );
$themes_introduction_box_title_font_size = themes_get_option_key( 'introduction_box_title_font_size', $themes_array );
$themes_introduction_box_title_color_afterhover = themes_get_option_key( 'introduction_box_title_color_afterhover', $themes_array );
$themes_introduction_box_content_color = themes_get_option_key( 'introduction_box_content_color', $themes_array );
$themes_introduction_box_content_fontfamily = themes_get_option_key( 'introduction_box_content_fontfamily', $themes_array );
$themes_introduction_box_content_font_size = themes_get_option_key( 'introduction_box_content_font_size', $themes_array );
$themes_introduction_box_content_color_afterhover = themes_get_option_key( 'introduction_box_content_color_afterhover', $themes_array );

$introduction_box_button_text_color = themes_get_option_key( 'introduction_box_button_text_color', $themes_array );
$introduction_box_button_text_fontfamily = themes_get_option_key( 'introduction_box_button_text_fontfamily', $themes_array );
$introduction_box_button_text_font_size = themes_get_option_key( 'introduction_box_button_text_font_size', $themes_array );
$introduction_box_button_bg_color = themes_get_option_key( 'introduction_box_button_bg_color', $themes_array );

// Pricing Plans

$themes_pricing_plan_main_title_color = themes_get_option_key( 'pricing_plan_main_title_color', $themes_array );
$themes_pricing_plan_main_title_fontfamily = themes_get_option_key( 'pricing_plan_main_title_fontfamily', $themes_array );
$themes_pricing_plan_main_title_fontsize = themes_get_option_key( 'pricing_plan_main_title_fontsize', $themes_array );
$themes_pricing_plan_box_bgcolor = themes_get_option_key( 'pricing_plan_box_bgcolor', $themes_array );
$themes_pricing_plan_box_bgcolor_afterhover = themes_get_option_key( 'pricing_plan_box_bgcolor_afterhover', $themes_array );
$themes_themes_pricing_plan_title_color = themes_get_option_key( 'themes_pricing_plan_title_color', $themes_array );
$themes_themes_pricing_plan_title_font_family = themes_get_option_key( 'themes_pricing_plan_title_font_family', $themes_array );
$themes_themes_pricing_plan_title_font_size = themes_get_option_key( 'themes_pricing_plan_title_font_size', $themes_array );
$themes_themes_pricing_plan_title_bgcolor = themes_get_option_key( 'themes_pricing_plan_title_bgcolor', $themes_array );
$themes_themes_pricing_plan_title_bgcolor_afterhover = themes_get_option_key( 'themes_pricing_plan_title_bgcolor_afterhover', $themes_array );
$themes_pricing_plan_small_title_color = themes_get_option_key( 'pricing_plan_small_title_color', $themes_array );
$themes_pricing_plan_small_title_font_family = themes_get_option_key( 'pricing_plan_small_title_font_family', $themes_array );
$themes_pricing_plan_small_title_font_size = themes_get_option_key( 'pricing_plan_small_title_font_size', $themes_array );
$themes_pricing_plan_small_title_color_afterhover = themes_get_option_key( 'pricing_plan_small_title_color_afterhover', $themes_array );
$themes_pricing_plan_para_color = themes_get_option_key( 'pricing_plan_para_color', $themes_array );
$themes_pricing_plan_para_font_family = themes_get_option_key( 'pricing_plan_para_font_family', $themes_array );
$themes_pricing_plan_para_font_size = themes_get_option_key( 'pricing_plan_para_font_size', $themes_array );
$themes_pricing_plan_para_color_afterhover = themes_get_option_key( 'pricing_plan_para_color_afterhover', $themes_array );
$themes_plan_but_text_color = themes_get_option_key( 'plan_but_text_color', $themes_array );
$themes_plan_but_text_font_size = themes_get_option_key( 'plan_but_text_font_size', $themes_array );
$themes_plan_but_bg_color = themes_get_option_key( 'plan_but_bg_color', $themes_array );
$plan_but_bg_color_aftercolor = themes_get_option_key( 'plan_but_bg_color_aftercolor', $themes_array );

$pricing_plan_bgcolor_one = themes_get_option_key( 'pricing_plan_bgcolor_one', $themes_array );
$pricing_plan_bgcolor_two = themes_get_option_key( 'pricing_plan_bgcolor_two', $themes_array );

// Latest News

$themes_latest_news_main_heading_text_color = themes_get_option_key( 'latest_news_main_heading_text_color', $themes_array );
$themes_latest_news_main_heading_text_fontfamily = themes_get_option_key( 'latest_news_main_heading_text_fontfamily', $themes_array );
$themes_latest_news_main_heading_text_fontsize = themes_get_option_key( 'latest_news_main_heading_text_fontsize', $themes_array );
$themes_themes_latest_newsmall_title_color = themes_get_option_key( 'themes_latest_newsmall_title_color', $themes_array );
$themes_themes_latest_newsmall_title_font_family = themes_get_option_key( 'themes_latest_newsmall_title_font_family', $themes_array );
$themes_themes_latest_newsmall_title_font_size = themes_get_option_key( 'themes_latest_newsmall_title_font_size', $themes_array );
$themes_date_title_color = themes_get_option_key( 'date_title_color', $themes_array );
$themes_date_title_font_family = themes_get_option_key( 'date_title_font_family', $themes_array );
$themes_date_title_font_size = themes_get_option_key( 'date_title_font_size', $themes_array );
$themes_date_title_bgcolor = themes_get_option_key( 'date_title_bgcolor', $themes_array );
$themes_themes_latest_button_color = themes_get_option_key( 'themes_latest_button_color', $themes_array );
$themes_themes_latest_button_font_family = themes_get_option_key( 'themes_latest_button_font_family', $themes_array );
$themes_themes_latest_button_font_size = themes_get_option_key( 'themes_latest_button_font_size', $themes_array );

$themes_latest_button_bgcolor = themes_get_option_key( 'themes_latest_button_bgcolor', $themes_array );

$themes_latest_title_color = themes_get_option_key( 'themes_latest_title_color', $themes_array );
$themes_latest_title_font_family = themes_get_option_key( 'themes_latest_title_font_family', $themes_array );
$themes_latest_title_font_size = themes_get_option_key( 'themes_latest_title_font_size', $themes_array );

$themes_latest_text_color = themes_get_option_key( 'themes_latest_text_color', $themes_array );
$themes_latest_text_font_family = themes_get_option_key( 'themes_latest_text_font_family', $themes_array );
$themes_latest_text_font_size = themes_get_option_key( 'themes_latest_text_font_size', $themes_array );

// Get in Touch

$themes_get_in_touch_main_text_color = themes_get_option_key( 'get_in_touch_main_text_color', $themes_array );
$themes_get_in_touch_main_text_fontfamily = themes_get_option_key( 'get_in_touch_main_text_fontfamily', $themes_array );
$themes_get_in_touch_main_text_font_size = themes_get_option_key( 'get_in_touch_main_text_font_size', $themes_array );
$themes_get_in_touch_text_color = themes_get_option_key( 'get_in_touch_main_text_color', $themes_array );
$themes_get_in_touch_text_fontfamily = themes_get_option_key( 'get_in_touch_main_text_fontfamily', $themes_array );
$themes_get_in_touch_text_font_size = themes_get_option_key( 'get_in_touch_main_text_font_size', $themes_array );

// Contact and Partners

$radio_contact_partners_enable = themes_get_option_key( 'radio_contact_partners_enable', $themes_array );
$themes_contact_partners_main_text_color = themes_get_option_key( 'contact_partners_main_text_color', $themes_array );
$themes_contact_partners_main_text_fontfamily = themes_get_option_key( 'contact_partners_main_text_fontfamily', $themes_array );
$themes_contact_partners_main_text_font_size = themes_get_option_key( 'contact_partners_main_text_font_size', $themes_array );
$themes_contact_partners_sub_text_color = themes_get_option_key( 'contact_partners_sub_text_color', $themes_array );
$themes_contact_partners_sub_text_fontfamily = themes_get_option_key( 'contact_partners_sub_text_fontfamily', $themes_array );
$themes_contact_partners_sub_text_font_size = themes_get_option_key( 'contact_partners_sub_text_font_size', $themes_array );
$themes_contact_partners_text_color = themes_get_option_key( 'contact_partners_text_color', $themes_array );
$themes_contact_partners_text_fontfamily = themes_get_option_key( 'contact_partners_text_fontfamily', $themes_array );
$themes_contact_partners_text_font_size = themes_get_option_key( 'contact_partners_text_font_size', $themes_array );

$contact_partners_button_color = themes_get_option_key( 'contact_partners_button_color', $themes_array );
$contact_partners_button_fontfamily = themes_get_option_key( 'contact_partners_button_fontfamily', $themes_array );
$contact_partners_button_font_size = themes_get_option_key( 'contact_partners_button_font_size', $themes_array );
$contact_partners_button_bgcolor = themes_get_option_key( 'contact_partners_button_bgcolor', $themes_array );

// Our Records
$records_section_enable = themes_get_option_key( 'records_section_enable', $themes_array );
$themes_our_records_num_text_color = themes_get_option_key( 'our_records_num_text_color', $themes_array );
$themes_our_records_num_text_fontfamily = themes_get_option_key( 'our_records_num_text_fontfamily', $themes_array );
$themes_our_records_num_text_fontsize = themes_get_option_key( 'our_records_num_text_fontsize', $themes_array );
$themes_our_records_text1_color = themes_get_option_key( 'our_records_text1_color', $themes_array );
$themes_our_records_text1_fontfamily = themes_get_option_key( 'our_records_text1_fontfamily', $themes_array );
$themes_our_records_text1_fontsize = themes_get_option_key( 'our_records_num_text_fontsize', $themes_array );

// Our Newsletter

$themes_newsletter_content_text_color = themes_get_option_key( 'newsletter_content_text_color', $themes_array );
$themes_newsletter_content_text_fontfamily = themes_get_option_key( 'newsletter_content_text_fontfamily', $themes_array );
$themes_newsletter_content_text_fontsize = themes_get_option_key( 'newsletter_content_text_fontsize', $themes_array );
$themes_newsletter_author_text_color = themes_get_option_key( 'newsletter_author_text_color', $themes_array );
$themes_newsletter_author_text_fontfamily = themes_get_option_key( 'newsletter_author_text_fontfamily', $themes_array );
$themes_newsletter_author_text_fontsize = themes_get_option_key( 'newsletter_author_text_fontsize', $themes_array );
$themes_newsletter_buttonswipe_bgcolor = themes_get_option_key( 'newsletter_buttonswipe_bgcolor', $themes_array );
$themes_newsletter_buttonswipe_text_color = themes_get_option_key( 'newsletter_buttonswipe_text_color', $themes_array );

$themes_newsletter_buttonswipe_bgcolor_afterhover = themes_get_option_key( 'newsletter_buttonswipe_bgcolor_afterhover', $themes_array );
$themes_newsletter_buttonswipe_text_color_afterhover = themes_get_option_key( 'newsletter_buttonswipe_text_color_afterhover', $themes_array );


// Our FAQs

$themes_our_faq_section_title_text_color = themes_get_option_key( 'our_faq_section_title_text_color', $themes_array );
$themes_our_faq_section_title_text_fontfamily = themes_get_option_key( 'our_faq_section_title_text_fontfamily', $themes_array );
$themes_our_faq_section_title_text_fontsize = themes_get_option_key( 'our_faq_section_title_text_fontsize', $themes_array );

$our_faq_section_small_title_color = themes_get_option_key( 'our_faq_section_small_title_color', $themes_array );
$our_faq_section_small_title_fontfamily = themes_get_option_key( 'our_faq_section_small_title_fontfamily', $themes_array );
$our_faq_section_small_title_fontsize = themes_get_option_key( 'our_faq_section_small_title_fontsize', $themes_array );

$themes_our_faq_content_text_color = themes_get_option_key( 'our_faq_content_text_color', $themes_array );
$themes_our_faq_content_text_fontfamily = themes_get_option_key( 'our_faq_content_text_fontfamily', $themes_array );
$themes_our_faq_content_text_fontsize = themes_get_option_key( 'our_faq_content_text_fontsize', $themes_array );
$themes_our_faq_body_text_color = themes_get_option_key( 'our_faq_body_text_color', $themes_array );
$themes_our_faq_body_text_fontfamily = themes_get_option_key( 'our_faq_body_text_fontfamily', $themes_array );
$themes_our_faq_body_text_fontsize = themes_get_option_key( 'our_faq_body_text_fontsize', $themes_array );
$themes_our_faq_body_bgcolor = themes_get_option_key( 'our_faq_body_bgcolor', $themes_array );

$themes_our_faq_button_bgcolor = themes_get_option_key( 'our_faq_button_bgcolor', $themes_array );
$themes_our_faq_button_color = themes_get_option_key( 'our_faq_button_color', $themes_array );

// Live Chat

$themes_live_chat_small_text_color = themes_get_option_key( 'live_chat_small_text_color', $themes_array );
$themes_live_chat_small_text_fontfamily = themes_get_option_key( 'live_chat_small_text_fontfamily', $themes_array );
$themes_live_chat_small_text_font_size = themes_get_option_key( 'live_chat_small_text_font_size', $themes_array );
$themes_live_chat_main_text_color = themes_get_option_key( 'live_chat_main_text_color', $themes_array );
$themes_live_chat_main_text_fontfamily = themes_get_option_key( 'live_chat_main_text_fontfamily', $themes_array );
$themes_live_chat_main_text_font_size = themes_get_option_key( 'live_chat_main_text_font_size', $themes_array );
$themes_live_chat_back_bg_color = themes_get_option_key( 'live_chat_back_bg_color', $themes_array );
$themes_live_chat_back_bg_color_afterhover = themes_get_option_key( 'live_chat_back_bg_color_afterhover', $themes_array );
$themes_live_chat_button_text_color = themes_get_option_key( 'live_chat_button_text_color', $themes_array );
$themes_live_chat_button_text_fontfamily = themes_get_option_key( 'live_chat_button_text_fontfamily', $themes_array );
$themes_live_chat_button_text_font_size = themes_get_option_key( 'live_chat_button_text_font_size', $themes_array );
$themes_live_chat_button_bg_color = themes_get_option_key( 'live_chat_button_bg_color', $themes_array );
$themes_live_chat_button_border_color = themes_get_option_key( 'live_chat_button_border_color', $themes_array );

// Header

$themes_header_button_border_color = themes_get_option_key( 'header_button_border_color', $themes_array );

//  Browse Topics

$themes_browse_topics_last_button_text_color = themes_get_option_key( 'browse_topics_last_button_text_color', $themes_array );
$themes_browse_topics_last_button_text_font_family = themes_get_option_key( 'browse_topics_last_button_text_font_family', $themes_array );
$themes_browse_topics_last_button_text_font_size = themes_get_option_key( 'browse_topics_last_button_text_font_size', $themes_array );
$themes_browse_topics_last_button_bg_color = themes_get_option_key( 'browse_topics_last_button_bg_color', $themes_array );
$themes_browse_topics_last_button_bg_color_afterhover = themes_get_option_key( 'browse_topics_last_button_bg_color_afterhover', $themes_array );
$themes_browse_topics_last_button_text_color_afterhover = themes_get_option_key( 'browse_topics_last_button_text_color_afterhover', $themes_array );

// symptoms
$radio_symptoms_us_enable = themes_get_option_key( 'radio_symptoms_us_enable', $themes_array );
$themes_symptoms_us_bg_color = themes_get_option_key( 'symptoms_us_bg_color', $themes_array );
$symptoms_us_small_text_color = themes_get_option_key( 'symptoms_us_small_text_color', $themes_array );
$symptoms_us_small_text_fontfamily = themes_get_option_key( 'symptoms_us_small_text_fontfamily', $themes_array );
$symptoms_us_small_text_font_size = themes_get_option_key( 'symptoms_us_small_text_font_size', $themes_array );
$symptoms_us_main_text_color = themes_get_option_key( 'symptoms_us_main_text_color', $themes_array );
$symptoms_us_main_text_fontfamily = themes_get_option_key( 'symptoms_us_main_text_fontfamily', $themes_array );
$symptoms_us_main_text_font_size = themes_get_option_key( 'symptoms_us_main_text_font_size', $themes_array );
$symptoms_us_main_heading_text_color = themes_get_option_key( 'symptoms_us_main_heading_text_color', $themes_array );
$symptoms_us_main_heading_font_family = themes_get_option_key( 'symptoms_us_main_heading_font_family', $themes_array );
$symptoms_us_main_heading_font_size = themes_get_option_key( 'symptoms_us_main_heading_font_size', $themes_array );

//emergency_contact

$radio_emergency_contact_enable = themes_get_option_key( 'radio_emergency_contact_enable', $themes_array );
$themes_emergency_contact_color = themes_get_option_key( 'emergency_contact_bg_color', $themes_array );
$emergency_contact_sub_text_color = themes_get_option_key( 'emergency_contact_sub_text_color', $themes_array );
$emergency_contact_sub_text_fontfamily = themes_get_option_key( 'emergency_contact_sub_text_fontfamily', $themes_array );
$emergency_contact_sub_text_font_size = themes_get_option_key( 'emergency_contact_sub_text_font_size', $themes_array );
$emergency_contact_main_text_color = themes_get_option_key( 'emergency_contact_main_text_color', $themes_array );
$emergency_contact_main_text_fontfamily = themes_get_option_key( 'emergency_contact_main_text_fontfamily', $themes_array );
$emergency_contact_main_text_font_size = themes_get_option_key( 'emergency_contact_main_text_font_size', $themes_array );
$emergency_contact_text_color = themes_get_option_key( 'emergency_contact_text_color', $themes_array );
$emergency_contact_text_fontfamily = themes_get_option_key( 'emergency_contact_text_fontfamily', $themes_array );
$emergency_contact_text_font_size = themes_get_option_key( 'emergency_contact_text_font_size', $themes_array );
$radio_search_banner_enable = themes_get_option_key( 'radio_search_banner_enable', $themes_array );
/*-------------Gallery------------*/
$themes_gallery_title_color_first = themes_get_option_key( 'themes_gallery_title_color_first', $themes_array );
$themes_gallery_title_font_family = themes_get_option_key( 'themes_gallery_title_font_family', $themes_array );
$themes_gallery_title_font_size = themes_get_option_key( 'themes_gallery_title_font_size', $themes_array );

$gallery_main_text_color = themes_get_option_key( 'gallery_main_text_color', $themes_array );
$gallery_main_text_fontfamily = themes_get_option_key( 'gallery_main_text_fontfamily', $themes_array );
$gallery_main_text_fontsize = themes_get_option_key( 'gallery_main_text_fontsize', $themes_array );


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
/* #browse-topics {
    padding: 5% 2%;
    background-image: linear-gradient(20deg, #4f94df 0%,  100%);
    position: relative;
    margin: 5% 0;
} */
#symptoms{
	<?php if ( ! empty( $radio_symptoms_us_enable ) && true == $radio_symptoms_us_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_symptoms_us_background_color ) ) : ?>
	background-color: <?php echo $themes_symptoms_us_background_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_topbar_background_img ) ) : ?>
	background-image: url(<?php echo $themes_symptoms_us_background_img; ?>);
	<?php endif; ?>
}
#symptoms{
	<?php if ( ! empty( $symptoms_us_bgcolor ) ) : ?>
	background: linear-gradient(90deg, <?php echo $symptoms_us_bgcolor; ?> 55%, <?php echo $symptoms_us_bgcolor; ?> 0%, <?php echo $symptoms_us_bgcolor; ?> 45%);
	<?php endif; ?>
	<?php if ( ! empty( $symptoms_us_bg_image ) ) : ?>
	background-image: url(<?php echo $symptoms_us_bg_image; ?>);
	<?php endif; ?>
}
.symptoms-content h2{
  <?php if ( ! empty( $symptoms_us_main_heading_text_color ) ) : ?>
  color: <?php echo $symptoms_us_main_heading_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_main_heading_font_family ) ) : ?>
  font-family: <?php echo $symptoms_us_main_heading_font_family; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_main_heading_font_size ) ) : ?>
  font-size: <?php echo $symptoms_us_main_heading_font_size; ?>;
  <?php endif; ?>
}
.symptoms-content p{
  <?php if ( ! empty( $symptoms_us_small_text_color ) ) : ?>
  color: <?php echo $symptoms_us_small_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_small_text_fontfamily ) ) : ?>
  font-family: <?php echo $symptoms_us_small_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_small_text_font_size ) ) : ?>
  font-size: <?php echo $symptoms_us_small_text_font_size; ?>;
  <?php endif; ?>
}
.symptoms-content span{
  <?php if ( ! empty( $symptoms_us_main_text_color ) ) : ?>
  color: <?php echo $symptoms_us_main_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_main_text_fontfamily ) ) : ?>
  font-family: <?php echo $symptoms_us_main_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $symptoms_us_main_text_font_size ) ) : ?>
  font-size: <?php echo $symptoms_us_main_text_font_size; ?>;
  <?php endif; ?>
}
#symptoms span, #symptoms .side-navigation a{
	<?php if ( ! empty( $themes_symptoms_us_text_color ) ) : ?>
	color: <?php echo $themes_symptoms_us_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_symptoms_us_text_font_family ) ) : ?>
	font-family: <?php echo $setting_symptoms_us_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_symptoms_us_text_size ) ) : ?>
	font-size: <?php echo $setting_symptoms_us_text_size; ?>;
	<?php endif; ?>
}
.side-navigation li a:hover,.side-navigation ul>li.menu-item-has-children>a:after{
	<?php if ( ! empty(  $themes_themes_headermenu_color_afterhover ) ) : ?>
	color: <?php echo $themes_themes_headermenu_color_afterhover ; ?> !important;
	<?php endif; ?>
}
.side-navigation li a{
	<?php if ( ! empty(   $themes_themes_headermenu_color ) ) : ?>
	color: <?php echo   $themes_themes_headermenu_color ; ?>!important;
	<?php endif; ?>
}
#footer{
	<?php if ( ! empty( $themes_footer_widget_bgcolor )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_footer_widget_bgcolor ; ?> 0%, <?php echo $themes_footer_widget_bgcolor ; ?> 100%);
	<?php endif; ?>
}
#testimonial .owl-nav i:hover{
	<?php if ( ! empty( $themes_newsletter_buttonswipe_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_newsletter_buttonswipe_bgcolor_afterhover ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_buttonswipe_text_color_afterhover ) ) : ?>
	color: <?php echo $themes_newsletter_buttonswipe_text_color_afterhover ; ?>;
	<?php endif; ?>
}
#testimonial .owl-nav i{
	<?php if ( ! empty( $themes_newsletter_buttonswipe_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_newsletter_buttonswipe_bgcolor ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_buttonswipe_text_color ) ) : ?>
	color: <?php echo $themes_newsletter_buttonswipe_text_color ; ?>;
	<?php endif; ?>
}
#how-it-work{
	<?php if ( ! empty( $radio_how_it_work_enable ) && true == $radio_how_it_work_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $how_it_work_bg_color ) ) : ?>
	background-color: <?php echo $how_it_work_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $how_it_work_bg_image ) ) : ?>
	background-image: url(<?php echo $how_it_work_bg_image; ?>);
	<?php endif; ?>
}
#how-it-work{
	<?php if ( ! empty( $themes_how_it_work_bg_color )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_how_it_work_bg_color ; ?> 0%, <?php echo $themes_how_it_work_bg_color ; ?> 100%);
	<?php endif; ?>
}
#getstarted-blog{
	<?php if ( ! empty( $themes_getstarted_blog_bg_color )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_getstarted_blog_bg_color ; ?> 0%, <?php echo $themes_getstarted_blog_bg_color ; ?> 100%);
	<?php endif; ?>
}
#browse-topics .blank-div{
	<?php if ( ! empty( $themes_browse_topics_bg_color )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_browse_topics_bg_color ; ?> 0%, <?php echo $themes_browse_topics_bg_color ; ?> 100%);
	<?php endif; ?>
}
#browse-topics{
	<?php if ( ! empty( $themes_browse_topics_bg_color )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_browse_topics_bg_color ; ?> 0%, <?php echo $themes_browse_topics_bg_color ; ?> 100%);
	<?php endif; ?>
}
#browse-topics .all-topics-links a:hover{
	<?php if ( ! empty( $themes_browse_topics_last_button_bg_color_afterhover  ) ) : ?>
	background-color: <?php echo $themes_browse_topics_last_button_bg_color_afterhover ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_last_button_text_color_afterhover ) ) : ?>
	color: <?php echo $themes_browse_topics_last_button_text_color_afterhover ; ?>;
	<?php endif; ?>
}
#browse-topics .all-topics-links a{
	<?php if ( ! empty( $themes_browse_topics_last_button_bg_color  ) ) : ?>
	background-color: <?php echo $themes_browse_topics_last_button_bg_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_last_button_text_color ) ) : ?>
	color: <?php echo $themes_browse_topics_last_button_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_last_button_text_font_family ) ) : ?>
	font-family: <?php echo $themes_browse_topics_last_button_text_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_last_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_browse_topics_last_button_text_font_size ; ?>;
	<?php endif; ?>
}
.site-header .header-logo p{
	<?php if ( ! empty( $themes_header_section_logo_sub_title_color ) ) : ?>
	color: <?php echo $themes_header_section_logo_sub_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_sub_title_font_family ) ) : ?>
	font-family: <?php echo $themes_header_section_logo_sub_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_logo_sub_title_font_size ) ) : ?>
	font-size: <?php echo $themes_header_section_logo_sub_title_font_siz ; ?>;
	<?php endif; ?>
}
#live-chat-blog .live-chat-content a{
	<?php if ( ! empty( $themes_live_chat_button_bg_color ) ) : ?>
	background-color: <?php echo $themes_live_chat_button_bg_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_button_text_color ) ) : ?>
	color: <?php echo $themes_live_chat_button_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_live_chat_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_live_chat_button_text_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_button_border_color ) ) : ?>
	border-color: <?php echo $themes_live_chat_button_border_color ; ?>;
	<?php endif; ?>
}
#live-chat-blog .live-chat-content:hover{
	<?php if ( ! empty( $themes_live_chat_back_bg_color_afterhover ) ) : ?>
	background-color: <?php echo $themes_live_chat_back_bg_color_afterhover ; ?>;
	<?php endif; ?>
}
#live-chat-blog .live-chat-content{
	<?php if ( ! empty( $themes_live_chat_back_bg_color ) ) : ?>
	background-color: <?php echo $themes_live_chat_back_bg_color ; ?>;
	<?php endif; ?>
}
#live-chat-blog .live-chat-content span{
	<?php if ( ! empty( $themes_live_chat_main_text_color ) ) : ?>
	color: <?php echo $themes_live_chat_main_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_live_chat_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_live_chat_main_text_font_size ; ?>;
	<?php endif; ?>
}
#live-chat-blog .live-chat-content p{
	<?php if ( ! empty( $themes_live_chat_small_text_color ) ) : ?>
	color: <?php echo $themes_live_chat_small_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_small_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_live_chat_small_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_live_chat_small_text_font_size ) ) : ?>
	font-size: <?php echo $themes_live_chat_small_text_font_size ; ?>;
	<?php endif; ?>
}
#our-faq .card .card-header i,#our-faq .accordion-item .accordion-header i{
	<?php if ( ! empty( $themes_our_faq_button_bgcolor ) ) : ?>
	background-color: <?php echo $themes_our_faq_button_bgcolor ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_button_color ) ) : ?>
	color: <?php echo $themes_our_faq_button_color ; ?> !important;
	<?php endif; ?>
}
#our-faq .accordion-header a,#our-faq .accordion-item{
	<?php if ( ! empty( $themes_our_faq_body_bgcolor ) ) : ?>
	background-color: <?php echo $themes_our_faq_body_bgcolor ; ?>;
	<?php endif; ?>
}
#our-faq .card .card-body,#our-faq .accordion-item .accordion-body{
	<?php if ( ! empty( $themes_our_faq_body_text_color ) ) : ?>
	color: <?php echo $themes_our_faq_body_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_body_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_our_faq_body_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_body_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_faq_body_text_fontsize ; ?>;
	<?php endif; ?>
}
#our-faq .card .card-header a,#our-faq .accordion-header a{
	<?php if ( ! empty( $themes_our_faq_content_text_color ) ) : ?>
	color: <?php echo $themes_our_faq_content_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_content_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_our_faq_content_text_fontfamily   ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_content_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_faq_content_text_fontsize ; ?>;
	<?php endif; ?>
}
#our-faq h2,#our-faq h2 {
	<?php if ( ! empty( $themes_our_faq_section_title_text_color ) ) : ?>
	color: <?php echo $themes_our_faq_section_title_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_section_title_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_our_faq_section_title_text_fontfamily   ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_faq_section_title_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_faq_section_title_text_fontsize ; ?>;
	<?php endif; ?>
}
#our-faq span{
	<?php if ( ! empty( $our_faq_section_small_title_color ) ) : ?>
	color: <?php echo $our_faq_section_small_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_faq_section_small_title_fontfamily  ) ) : ?>
	font-family: <?php echo $our_faq_section_small_title_fontfamily   ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_faq_section_small_title_fontsize ) ) : ?>
	font-size: <?php echo $our_faq_section_small_title_fontsize ; ?>;
	<?php endif; ?>
}
#testimonial .testi-title a{
	<?php if ( ! empty( $themes_newsletter_author_text_color ) ) : ?>
	color: <?php echo $themes_newsletter_author_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_author_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_newsletter_author_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_author_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_newsletter_author_text_fontsize ; ?>;
	<?php endif; ?>
}
#newsletter .news-p p,#newsletter input::placeholder {
	<?php if ( ! empty( $themes_newsletter_content_text_color ) ) : ?>
	color: <?php echo $themes_newsletter_content_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_content_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_newsletter_content_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_newsletter_content_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_newsletter_content_text_fontsize ; ?>;
	<?php endif; ?>
}
#our-records .record-title {
	<?php if ( ! empty( $themes_our_records_text1_color ) ) : ?>
	color: <?php echo $themes_our_records_text1_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_text1_fontfamily ) ) : ?>
	font-family: <?php echo $themes_our_records_text1_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_text1_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_records_text1_fontsize ; ?>;
	<?php endif; ?>
}
#our-records .our-records-content span{
	<?php if ( ! empty( $themes_our_records_num_text_color ) ) : ?>
	color: <?php echo $themes_our_records_num_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_num_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_our_records_num_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_num_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_records_num_text_fontsize ; ?>;
	<?php endif; ?>
}
#our-records .our-records-content span{
	<?php if ( ! empty( $themes_our_records_num_text_color ) ) : ?>
	color: <?php echo $themes_our_records_num_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_num_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_our_records_num_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_records_num_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_our_records_num_text_fontsize ; ?>;
	<?php endif; ?>
}
#contact-partners .our-partners p{
	<?php if ( ! empty( $themes_contact_partners_text_color ) ) : ?>
	color: <?php echo $themes_contact_partners_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_contact_partners_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_text_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_partners_text_font_size ; ?>;
	<?php endif; ?>
}
#contact-partners .home-contact-us .contact-sub-title,#appointment .appointment-content span{
	<?php if ( ! empty( $themes_contact_partners_sub_text_color ) ) : ?>
	color: <?php echo $themes_contact_partners_sub_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_sub_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_contact_partners_sub_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_sub_text_font_size ) ) : ?>
	font-size: <?php echo$themes_contact_partners_sub_text_font_size ; ?>;
	<?php endif; ?>
}
#contact-partners .home-contact-us h2,#appointment .appointment-content h2{
	<?php if ( ! empty( $themes_contact_partners_main_text_color   ) ) : ?>
	color: <?php echo $themes_contact_partners_main_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_main_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_contact_partners_main_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_partners_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_partners_main_text_font_size ; ?>;
	<?php endif; ?>
}
#appointment .appointment-shortcode input[type="submit"]{
	<?php if ( ! empty( $contact_partners_button_color   ) ) : ?>
	color: <?php echo $contact_partners_button_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_partners_button_fontfamily ) ) : ?>
	font-family: <?php echo $contact_partners_button_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_partners_button_font_size ) ) : ?>
	font-size: <?php echo $contact_partners_button_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_partners_button_bgcolor ) ) : ?>
	background-color: <?php echo $contact_partners_button_bgcolor ; ?>;
	<?php endif; ?>
}
#get-in-touch a.read-more {
	<?php if ( ! empty( $get_in_touch_button_bg_color  ) ) : ?>
	background-color: <?php echo $get_in_touch_button_bg_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_color   ) ) : ?>
	color: <?php echo $get_in_touch_button_text_color  ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_fontfamily   ) ) : ?>
	font-family: <?php echo $get_in_touch_button_text_fontfamily  ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $get_in_touch_button_text_font_size ) ) : ?>
	font-size: <?php echo $get_in_touch_button_text_font_size ; ?>;
	<?php endif; ?>
}
#get-in-touch p{
	<?php if ( ! empty( $themes_get_in_touch_text_color  ) ) : ?>
	color: <?php echo $themes_get_in_touch_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_get_in_touch_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_get_in_touch_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_latest_button_font_size ) ) : ?>
	font-size: <?php echo $themes_themes_latest_button_font_size ; ?>;
	<?php endif; ?>
}
#get-in-touch h3 {
	<?php if ( ! empty( $themes_get_in_touch_main_text_color  ) ) : ?>
	color: <?php echo $themes_get_in_touch_main_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_get_in_touch_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_get_in_touch_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_get_in_touch_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_get_in_touch_main_text_font_size ; ?>;
	<?php endif; ?>
}
#latest-news .link-title,#our-blogs a.link-title{
	<?php if ( ! empty( $themes_themes_latest_button_color  ) ) : ?>
	color: <?php echo $themes_themes_latest_button_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_latest_button_font_family  ) ) : ?>
	font-family: <?php echo $themes_themes_latest_button_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_latest_button_font_size ) ) : ?>
	font-size: <?php echo $themes_themes_latest_button_font_size ; ?>;
	<?php endif; ?>
}
#latest-news .link-title,#our-blogs a.link-title{
	<?php if ( ! empty( $themes_latest_button_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_latest_button_bgcolor ; ?>;
	<?php endif; ?>
}
#our-blogs .our-blogs-contents h5 a{
	<?php if ( ! empty( $themes_latest_title_color  ) ) : ?>
	color: <?php echo $themes_latest_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_latest_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_title_font_size ) ) : ?>
	font-size: <?php echo $themes_latest_title_font_size ; ?>;
	<?php endif; ?>
}
#our-blogs .blog_text,#our-blogs .our-blogs-contents .blogs-title{
	<?php if ( ! empty( $themes_latest_text_color  ) ) : ?>
	color: <?php echo $themes_latest_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_text_font_family  ) ) : ?>
	font-family: <?php echo $themes_latest_text_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_text_font_size ) ) : ?>
	font-size: <?php echo $themes_latest_text_font_size ; ?>;
	<?php endif; ?>
}
#latest-news .news-image span,#our-blogs .our-blogs-contents span, #our-blogs .our-blogs-contents span a{
	<?php if ( ! empty( $themes_date_title_color  ) ) : ?>
	color: <?php echo $themes_date_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_date_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_date_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_date_title_font_size ) ) : ?>
	font-size: <?php echo $themes_date_title_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_date_title_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_date_title_bgcolor ; ?>;
	<?php endif; ?>
}
#latest-news .news-title,.our-blogs-head span,#our-blogs .our-blogs-head span {
	<?php if ( ! empty( $themes_themes_latest_newsmall_title_color  ) ) : ?>
	color: <?php echo $themes_themes_latest_newsmall_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_latest_newsmall_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_themes_latest_newsmall_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_latest_newsmall_title_font_size ) ) : ?>
	font-size: <?php echo $themes_themes_latest_newsmall_title_font_size ; ?>;
	<?php endif; ?>
}
#latest-news h2,.our-blogs-head h2,#our-blogs .our-blogs-head h2{
	<?php if ( ! empty( $themes_latest_news_main_heading_text_color  ) ) : ?>
	color: <?php echo $themes_latest_news_main_heading_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_news_main_heading_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_latest_news_main_heading_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_latest_news_main_heading_text_fontsize ) ) : ?>
	font-size: <?php echo $themes_latest_news_main_heading_text_fontsize ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content:hover a{
	<?php if ( ! empty( $plan_but_bg_color_aftercolor  ) ) : ?>
	background-color: <?php echo $plan_but_bg_color_aftercolor ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content a{
	<?php if ( ! empty( $themes_plan_but_text_color  ) ) : ?>
	color: <?php echo $themes_plan_but_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_plan_but_text_font_size ) ) : ?>
	font-size: <?php echo $themes_plan_but_text_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_plan_but_bg_color  ) ) : ?>
	background-color: <?php echo $themes_plan_but_bg_color ; ?>;
	<?php endif; ?>
}
.pricing-plan-content a.read-more{
	<?php if ( ! empty( $plan_but_bgcolor1  ) || ! empty( $plan_but_bgcolor2  )) : ?>
	background-image: linear-gradient(90deg, <?php echo $plan_but_bgcolor1 ; ?> 0%, <?php echo $plan_but_bgcolor2 ; ?> 100%);
	<?php endif; ?>
}
.pricing-plan-box{
	<?php if ( ! empty( $pricing_plan_bgcolor_one  ) || ! empty( $pricing_plan_bgcolor_two  )) : ?>
	background-image: linear-gradient(90deg, <?php echo $pricing_plan_bgcolor_one ; ?> 0%, <?php echo $pricing_plan_bgcolor_two ; ?> 100%);
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content:hover ul li{
	<?php if ( ! empty( $themes_pricing_plan_para_color_afterhover  ) ) : ?>
	color: <?php echo $themes_pricing_plan_para_color_afterhover ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content ul li{
	<?php if ( ! empty( $themes_pricing_plan_para_color  ) ) : ?>
	color: <?php echo $themes_pricing_plan_para_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_para_font_family  ) ) : ?>
	font-family: <?php echo $themes_pricing_plan_para_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_para_font_size ) ) : ?>
	font-size: <?php echo $themes_pricing_plan_para_font_size ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content:hover h4{
	<?php if ( ! empty( $themes_pricing_plan_small_title_color_afterhover  ) ) : ?>
	color: <?php echo $themes_pricing_plan_small_title_color_afterhover ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content h4{
	<?php if ( ! empty( $themes_pricing_plan_small_title_color  ) ) : ?>
	color: <?php echo $themes_pricing_plan_small_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_small_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_pricing_plan_small_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_small_title_font_size ) ) : ?>
	font-size: <?php echo $themes_pricing_plan_small_title_font_size ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content:hover span{
	<?php if ( ! empty( $themes_themes_pricing_plan_title_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_themes_pricing_plan_title_bgcolor_afterhover ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content span{
	<?php if ( ! empty( $themes_themes_pricing_plan_title_color  ) ) : ?>
	color: <?php echo $themes_themes_pricing_plan_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_pricing_plan_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_themes_pricing_plan_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_pricing_plan_title_font_size ) ) : ?>
	font-size: <?php echo $themes_themes_pricing_plan_title_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_pricing_plan_title_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_themes_pricing_plan_title_bgcolor ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content:hover,.icons-img{
	<?php if ( ! empty( $themes_pricing_plan_box_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_pricing_plan_box_bgcolor_afterhover ; ?>;
	<?php endif; ?>
}
#pricing-plans .pricing-plans-content,.pricing-plan-content, .plans_data2 .pricing-plan-content{
	<?php if ( ! empty( $themes_pricing_plan_box_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_pricing_plan_box_bgcolor ; ?>;
	<?php endif; ?>
}
#pricing-plans h2 ,#pricing-plan h2 span{
	<?php if ( ! empty( $themes_pricing_plan_main_title_color  ) ) : ?>
	color: <?php echo $themes_pricing_plan_main_title_color ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_main_title_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_pricing_plan_main_title_fontfamily ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_pricing_plan_main_title_fontsize ) ) : ?>
	font-size: <?php echo $themes_pricing_plan_main_title_fontsize ; ?> !important;
	<?php endif; ?>
}
#pricing-plan h2 span:before, #pricing-plan h2 span:after{
	<?php if ( ! empty( $themes_pricing_plan_main_title_color  ) ) : ?>
	background-color: <?php echo $themes_pricing_plan_main_title_color ; ?> !important;
	<?php endif; ?>
}
#introduction .intro-box:hover .text-box p{
	<?php if ( ! empty( $themes_introduction_box_content_color_afterhover  ) ) : ?>
	color: <?php echo $themes_introduction_box_content_color_afterhover ; ?> !important;
	<?php endif; ?>
}
#introduction .text-box p,#introduction p{
	<?php if ( ! empty( $themes_introduction_box_content_color  ) ) : ?>
	color: <?php echo $themes_introduction_box_content_color ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_box_content_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_introduction_box_content_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_box_content_font_size ) ) : ?>
	font-size: <?php echo $themes_introduction_box_content_font_size ; ?>;
	<?php endif; ?>
}
#introduction .intro-box:hover .text-box h3{
	<?php if ( ! empty( $themes_introduction_box_title_color_afterhover  ) ) : ?>
	color: <?php echo $themes_introduction_box_title_color_afterhover ; ?> !important;
	<?php endif; ?>
}
#introduction .text-box h3{
	<?php if ( ! empty( $themes_introduction_box_title_color  ) ) : ?>
	color: <?php echo $themes_introduction_box_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_box_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_introduction_box_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_box_title_font_size ) ) : ?>
	font-size: <?php echo $themes_introduction_box_title_font_size ; ?>;
	<?php endif; ?>
}
#introduction .intro-box:hover{
	<?php if ( ! empty( $themes_introduction_box_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_introduction_box_bgcolor_afterhover ; ?>;
	<?php endif; ?>
}
#introduction .text-box{
	<?php if ( ! empty( $themes_introduction_box_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_introduction_box_bgcolor ; ?>;
	<?php endif; ?>
}
#introduction .intro-right-box h3.head_white,#introduction span.head_white{
	<?php if ( ! empty( $themes_introduction_section_main_title_color  ) ) : ?>
	color: <?php echo $themes_introduction_section_main_title_color ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_section_main_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_introduction_section_main_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_introduction_section_main_title_font_size ) ) : ?>
	font-size: <?php echo $themes_introduction_section_main_title_font_size ; ?>;
	<?php endif; ?>
}
#introduction .left-read,#introduction .right-read{
	<?php if ( ! empty( $introduction_box_button_text_color  ) ) : ?>
	color: <?php echo $introduction_box_button_text_color ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $introduction_box_button_text_fontfamily  ) ) : ?>
	font-family: <?php echo $introduction_box_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $introduction_box_button_text_font_size ) ) : ?>
	font-size: <?php echo $introduction_box_button_text_font_size ; ?>;
	<?php endif; ?>
}
#introduction .left-read,#introduction .right-read{
	<?php if ( ! empty( $introduction_box_button_bg_color  ) ) : ?>
	background-color: <?php echo $introduction_box_button_bg_color ; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $introduction_box_button_bg_color  ) ) : ?>
	border-color: <?php echo $introduction_box_button_bg_color ; ?> !important;
	<?php endif; ?>
}
#our-team,#our-teams{
	<?php if ( ! empty( $our_team_enabledisable ) && true == $our_team_enabledisable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_bg_color ) ) : ?>
	background-color: <?php echo $our_team_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_bg_image ) ) : ?>
	background-image: url(<?php echo $our_team_bg_image; ?>);
	<?php endif; ?>
}
.team-title span,.sidebar-cont p,.sidebar-cont .social-profiles a{
	<?php if ( ! empty( $themes_our_team_box_content_color  ) ) : ?>
	color: <?php echo $themes_our_team_box_content_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_box_content_font_family  ) ) : ?>
	font-family: <?php echo $themes_our_team_box_content_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_box_content_font_size ) ) : ?>
	font-size: <?php echo $themes_our_team_box_content_font_size ; ?>;
	<?php endif; ?>
}
#our-teams .our-teams-contents:hover .sidebar-cont p,#our-teams .our-teams-contents:hover .sidebar-cont .social-profiles a{
	<?php if ( ! empty( $themes_our_team_bg_color_afterhover  ) ) : ?>
	color: <?php echo $themes_our_team_bg_color_afterhover ; ?>;
	<?php endif; ?>
}
#our-teams a.left-read{
	<?php if ( ! empty( $our_team_box_button_color  ) ) : ?>
	color: <?php echo $our_team_box_button_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_box_button_font_family  ) ) : ?>
	font-family: <?php echo $our_team_box_button_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_box_button_font_size ) ) : ?>
	font-size: <?php echo $our_team_box_button_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_box_button_bgcolor  ) ) : ?>
	background-color: <?php echo $our_team_box_button_bgcolor ; ?>;
	<?php endif; ?>
}
#our-team .team-title h5 a,#our-teams a.teams-title{
	<?php if ( ! empty( $themes_our_team_box_title_color  ) ) : ?>
	color: <?php echo $themes_our_team_box_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_box_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_our_team_box_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_box_title_font_size ) ) : ?>
	font-size: <?php echo $themes_our_team_box_title_font_size ; ?>;
	<?php endif; ?>
}
#our-team {
	<?php if ( ! empty( $themes_our_team_bg_color  ) ) : ?>
	background-color: <?php echo $themes_our_team_bg_color ; ?>;
	<?php endif; ?>
}
#our-team .our-team-head h3,#our-teams .section-content h2,#our-teams .our-teams-head h2{
	<?php if ( ! empty( $themes_our_team_title_color  ) ) : ?>
	color: <?php echo $themes_our_team_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_our_team_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_team_title_font_size ) ) : ?>
	font-size: <?php echo $themes_our_team_title_font_size ; ?>;
	<?php endif; ?>
}
#our-teams .section-content span,#our-teams .our-teams-head span{
	<?php if ( ! empty( $our_team_small_title_color  ) ) : ?>
	color: <?php echo $our_team_small_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_small_title_font_family  ) ) : ?>
	font-family: <?php echo $our_team_small_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_team_small_title_font_size ) ) : ?>
	font-size: <?php echo $our_team_small_title_font_size ; ?>;
	<?php endif; ?>
}
#our-teams .sidebar-cont{
	<?php if ( ! empty( $our_team_box_bg_color  ) ) : ?>
	background-color: <?php echo $our_team_box_bg_color ; ?>;
	<?php endif; ?>
}
#our-teams .our-teams-contents:hover .sidebar-cont{
	<?php if ( ! empty( $our_team_box_hover_bgcolor  ) ) : ?>
	background-color: <?php echo $our_team_box_hover_bgcolor ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content:hover a{
	<?php if ( ! empty( $themes_active_articals_button_font_color_afterhover  ) ) : ?>
	color: <?php echo $themes_active_articals_button_font_color_afterhover ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_button_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_active_articals_button_bgcolor_afterhover ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content:hover li{
	<?php if ( ! empty( $themes_active_articals_features_font_color_afterhover  ) ) : ?>
	color: <?php echo $themes_active_articals_features_font_color_afterhover ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content:hover h3{
	<?php if ( ! empty( $themes_active_articals_main_heading_font_color_afterhover  ) ) : ?>
	color: <?php echo $themes_active_articals_main_heading_font_color_afterhover ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content a {
	<?php if ( ! empty( $themes_active_articals_button_text_color  ) ) : ?>
	color: <?php echo $themes_active_articals_button_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_button_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_active_articals_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_active_articals_button_text_font_size ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_button_bg_color  ) ) : ?>
	background-color: <?php echo $themes_active_articals_button_bg_color ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content{
	<?php if ( ! empty( $themes_active_articals_features_bgcolor  ) ) : ?>
	background-color: <?php echo $themes_active_articals_features_bgcolor ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content:hover{
	<?php if ( ! empty( $themes_active_articals_features_bgcolor_afterhover  ) ) : ?>
	background-color: <?php echo $themes_active_articals_features_bgcolor_afterhover ; ?>;
	<?php endif; ?>
}
#Active-articals h3{
	<?php if ( ! empty( $themes_active_articals_main_heading_text_color  ) ) : ?>
	color: <?php echo $themes_active_articals_main_heading_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_main_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_active_articals_main_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_active_articals_main_heading_font_size ; ?>;
	<?php endif; ?>
}
#Active-articals .articals-content li{
	<?php if ( ! empty( $themes_active_articals_features_text_color  ) ) : ?>
	color: <?php echo $themes_active_articals_features_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_features_font_family  ) ) : ?>
	font-family: <?php echo $themes_active_articals_features_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_active_articals_features_font_size ) ) : ?>
	font-size: <?php echo $themes_active_articals_features_font_size ; ?>;
	<?php endif; ?>
}
#our-services .our-services-content .services-text{
	<?php if ( ! empty( $themes_servicesmall_para_color  ) ) : ?>
	color: <?php echo $themes_servicesmall_para_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_servicesmall_para_font_family  ) ) : ?>
	font-family: <?php echo $themes_servicesmall_para_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_servicesmall_para_font_size ) ) : ?>
	font-size: <?php echo $themes_servicesmall_para_font_size ; ?>;
	<?php endif; ?>
}
#our-services .our-services-content a,#our-services .services-small-title{
	<?php if ( ! empty( $themes_themes_servicesmall_title_color  ) ) : ?>
	color: <?php echo $themes_themes_servicesmall_title_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_themes_servicesmall_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_themes_servicesmall_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_services_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_our_services_main_heading_font_size ; ?>;
	<?php endif; ?>
}
#our-services .our-services-head h2,#our-services .section-content h2,.service-main-content h2{
	<?php if ( ! empty( $themes_our_services_main_heading_text_color  ) ) : ?>
	color: <?php echo $themes_our_services_main_heading_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_services_main_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_our_services_main_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_services_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_our_services_main_heading_font_size ; ?>;
	<?php endif; ?>
}
#our_partners h2 {
	<?php if ( ! empty( $themes_our_partners_main_heading_text_color  ) ) : ?>
	color: <?php echo $themes_our_partners_main_heading_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_partners_main_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_our_partners_main_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_partners_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_our_partners_main_heading_font_size; ?>;
	<?php endif; ?>
}
.partners_inner span{
	<?php if ( ! empty( $our_partners_small_heading_color  ) ) : ?>
	color: <?php echo $our_partners_small_heading_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_partners_small_heading_font_family  ) ) : ?>
	font-family: <?php echo $our_partners_small_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_partners_small_heading_font_size ) ) : ?>
	font-size: <?php echo $our_partners_small_heading_font_size; ?>;
	<?php endif; ?>
}
#how-it-work h2{
	<?php if ( ! empty( $themes_how_it_work_main_heading_text_color  ) ) : ?>
	color: <?php echo $themes_how_it_work_main_heading_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_main_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_how_it_work_main_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_how_it_work_main_heading_font_size; ?>;
	<?php endif; ?>
}
#how-it-work span{
	<?php if ( ! empty( $themes_how_it_work_main_text_color  ) ) : ?>
	color: <?php echo $themes_how_it_work_main_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_how_it_work_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_how_it_work_main_text_font_size; ?>;
	<?php endif; ?>
}
#how-it-work p{
	<?php if ( ! empty( $themes_how_it_work_small_text_color  ) ) : ?>
	color: <?php echo $themes_how_it_work_small_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_small_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_how_it_work_small_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_how_it_work_small_text_font_size ) ) : ?>
	font-size: <?php echo $themes_how_it_work_small_text_font_size; ?>;
	<?php endif; ?>
}
#getstarted-blog a {
	<?php if ( ! empty( $themes_getstarted_blog_button_bg_color  ) ) : ?>
	background-color: <?php echo $themes_getstarted_blog_button_bg_color ; ?>;
	<?php endif; ?>
    <?php if ( ! empty( $themes_getstarted_blog_button_text_color  ) ) : ?>
	color: <?php echo $themes_getstarted_blog_button_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_button_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_getstarted_blog_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_getstarted_blog_button_text_font_size; ?>;
	<?php endif; ?>
}
#getstarted-blog p{
	<?php if ( ! empty( $themes_getstarted_blog_dicsount_text_color ) ) : ?>
	color: <?php echo $themes_getstarted_blog_dicsount_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_dicsount_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_getstarted_blog_dicsount_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_dicsount_text_font_size ) ) : ?>
	font-size: <?php echo $themes_getstarted_blog_dicsount_text_font_size; ?>;
	<?php endif; ?>
}
#getstarted-blog span{
	<?php if ( ! empty( $themes_getstarted_blog_main_text_color ) ) : ?>
	color: <?php echo $themes_getstarted_blog_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_getstarted_blog_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_getstarted_blog_main_text_font_size; ?>;
	<?php endif; ?>
}
#getstarted-blog li {
	<?php if ( ! empty( $themes_getstarted_blog_small_text_color ) ) : ?>
	color: <?php echo $themes_getstarted_blog_small_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_small_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_getstarted_blog_small_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_getstarted_blog_small_text_font_size ) ) : ?>
	font-size: <?php echo $themes_getstarted_blog_small_text_font_size; ?>;
	<?php endif; ?>
}
#services-blog .sblog-head span{
	<?php if ( ! empty( $themes_services_blog_main_text_color ) ) : ?>
	color: <?php echo $themes_services_blog_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_services_blog_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_services_blog_main_text_font_size; ?>;
	<?php endif; ?>
}
#services-blog p{
	<?php if ( ! empty( $themes_services_blog_dicsount_text_color ) ) : ?>
	color: <?php echo $themes_services_blog_dicsount_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_dicsount_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_services_blog_dicsount_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_dicsount_text_font_size ) ) : ?>
	font-size: <?php echo $themes_services_blog_dicsount_text_font_size; ?>;
	<?php endif; ?>
}
#services-blog a{
	<?php if ( ! empty( $themes_services_blog_button_bg_color  ) ) : ?>
	background-color: <?php echo $themes_services_blog_button_bg_color ; ?>;
	<?php endif; ?>
    <?php if ( ! empty( $themes_services_blog_button_text_color  ) ) : ?>
	color: <?php echo $themes_services_blog_button_text_color ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_button_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_services_blog_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_services_blog_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_services_blog_button_text_font_size; ?>;
	<?php endif; ?>
}
#browse-topics .browse-topics-content span{
	<?php if ( ! empty( $themes_browse_topics_main_text_color ) ) : ?>
	color: <?php echo $themes_browse_topics_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_browse_topics_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_main_text_font_size ) ) : ?>
	font-size: <?php echo $themes_browse_topics_main_text_font_size; ?>;
	<?php endif; ?>
}
#browse-topics .browse-topics-content a {
	<?php if ( ! empty( $themes_browse_topics_button_bg_color  ) ) : ?>
	background-color: <?php echo $themes_browse_topics_button_bg_color ; ?>;
	<?php endif; ?>
    <?php if ( ! empty( $themes_browse_topics_button_text_color ) ) : ?>
	color: <?php echo $themes_browse_topics_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_button_text_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_browse_topics_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_browse_topics_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_browse_topics_button_text_font_size; ?>;
	<?php endif; ?>
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
	<?php if ( ! empty( $topbar_bgcolor )) : ?>
	background: linear-gradient(90deg, <?php echo $topbar_bgcolor; ?> 55%, <?php echo $topbar_bgcolor2; ?> 0%, <?php echo $topbar_bgcolor2; ?> 45%);
	<?php endif; ?>
	<?php if ( ! empty( $topbar_bg_image ) ) : ?>
	background-image: url(<?php echo $topbar_bg_image; ?>);
	<?php endif; ?>
}
#topbar span, #topbar .side-navigation a{
	<?php if ( ! empty( $themes_topbar_text_color ) ) : ?>
	color: <?php echo $themes_topbar_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $setting_topbar_text_font_family ) ) : ?>
	font-family: <?php echo $setting_topbar_text_font_family; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $setting_topbar_text_size ) ) : ?>
	font-size: <?php echo $setting_topbar_text_size; ?> !important;
	<?php endif; ?>
}
.vwsmp_front a{
	<?php if ( ! empty( $setting_topbar_icons_color ) ) : ?>
	color: <?php echo $setting_topbar_icons_color; ?> !important;
	<?php endif; ?>
}
#topbar .vwsmp_front a:hover,#content_header .vwsmp_front a:hover{
	<?php if ( ! empty( $setting_topbar_icons_hover_color ) ) : ?>
	color: <?php echo $setting_topbar_icons_hover_color; ?> !important;
	<?php endif; ?>
}
#topbar .vwsmp_front a,#content_header .vwsmp_front a{
	<?php if ( ! empty( $setting_topbar_sicons_bgcolor ) ) : ?>
	background-color: <?php echo $setting_topbar_sicons_bgcolor; ?> !important;
	<?php endif; ?>
}
#topbar .vwsmp_front a:hover,#content_header .vwsmp_front a:hover{
	<?php if ( ! empty( $setting_topbar_sicons_hoverbgcolor1 ) || ! empty( $setting_topbar_sicons_hoverbgcolor2 )) : ?>
	background-image: linear-gradient(57deg, <?php echo $setting_topbar_sicons_hoverbgcolor1; ?> 0%, <?php echo $setting_topbar_sicons_hoverbgcolor2; ?> 100%);
	<?php endif; ?>
}
#topbar .topbtn a{
	<?php if ( ! empty( $topbar_button_bgcolor ) || ! empty( $topbar_button_bgcolor2 )) : ?>
	background-image: linear-gradient(90deg, <?php echo $topbar_button_bgcolor; ?> 0%, <?php echo $topbar_button_bgcolor2; ?> 100%);
	<?php endif; ?>
}
.about-content h2 span.left-text,.about-content .left-read,#featured-update h2 span.left-text,.adjust1 a.button,#our-app span.head_white,#services span.head_center,.deg-right-box i,#interface-deg .left-read,#introduction span.head_white,#introduction .left-read,#newsletter .news-heading span,#newsletter input[type="submit"],#testimonials h2 span,#our-video span.left-text,#our-video .left-read,.pricing-plan-head span.left-text,#featured-update li a:active,.client_inner:hover img.alt-img{
	<?php if ( ! empty( $themes_commen_gradient_color_1 ) || ! empty( $themes_commen_gradient_color_2 )) : ?>
	background-image: linear-gradient(57deg, <?php echo $themes_commen_gradient_color_1; ?> 0%, <?php echo $themes_commen_gradient_color_2; ?> 100%);
	<?php endif; ?>
}
#header{
	<?php if ( ! empty( $themes_header_display ) && true == $themes_header_display ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_background_color ) ) : ?>
	background-color: <?php echo $themes_header_background_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_background_img ) ) : ?>
	background-image: url(<?php echo $themes_header_background_img; ?>);
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
#search-banner .search-banner-content h1 {
	<?php if ( ! empty( $themes_search_banner_text_color ) ) : ?>
	color: <?php echo $themes_search_banner_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_setting_search_banner_text_font_family ) ) : ?>
	font-family: <?php echo $themes_setting_search_banner_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_setting_search_banner_text_size ) ) : ?>
	font-size: <?php echo $themes_setting_search_banner_text_size; ?>;
	<?php endif; ?>
}
#search-banner .search-banner-content p {
	<?php if ( ! empty( $setting_search_banner_smalltext_color ) ) : ?>
	color: <?php echo $setting_search_banner_smalltext_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_search_banner_smalltext_font_family ) ) : ?>
	font-family: <?php echo $setting_search_banner_smalltext_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $setting_search_banner_smalltext_size ) ) : ?>
	font-size: <?php echo $setting_search_banner_smalltext_size; ?>;
	<?php endif; ?>
}
#search-banner .search-banner-content input[type="search"]{
	<?php if ( ! empty( $themes_setting_search_banner_bgcolor ) ) : ?>
	background-color: <?php echo $themes_setting_search_banner_bgcolor; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_setting_search_banner_border_color ) ) : ?>
	border-color: <?php echo $themes_setting_search_banner_border_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_setting_search_banner_input_text_font_family ) ) : ?>
	font-family: <?php echo $themes_setting_search_banner_input_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_setting_search_banner_input_text_color ) ) : ?>
	color: <?php echo $themes_setting_search_banner_input_text_color; ?>;
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
#pricing-plans{
	<?php if ( ! empty( $pricing_plan_enable ) && true == $pricing_plan_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $pricing_plan_bgcolor ) ) : ?>
	background-color: <?php echo $pricing_plan_bgcolor; ?>;
	<?php elseif ( ! empty( $pricing_plan_bgimage ) ) : ?>
	background-image: url(<?php echo $pricing_plan_bgimage; ?>);
	<?php endif; ?>
}
#pricing-plans{
	<?php if ( ! empty( $pricing_plan_bgimage2 ) ) : ?>
	background-image: url(<?php echo $pricing_plan_bgimage2; ?>);
	<?php endif; ?>
}
#latest-news,#our-blogs{
	<?php if ( ! empty( $latest_news_enabledisable ) && true == $latest_news_enabledisable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $latest_news_bg_color ) ) : ?>
	background-color: <?php echo $latest_news_bg_color; ?>;
	<?php elseif ( ! empty( $latest_news_bg_image ) ) : ?>
	background-image: url(<?php echo $latest_news_bg_image; ?>);
	<?php endif; ?>
}
#services-blog{
	<?php if ( ! empty( $radio_services_blog_enable ) && true == $radio_services_blog_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $services_blog_bg_color ) ) : ?>
	background-color: <?php echo $services_blog_bg_color; ?>;
	<?php elseif ( ! empty( $services_blog_bg_image ) ) : ?>
	background-image: url(<?php echo $services_blog_bg_image; ?>);
	<?php endif; ?>
}
#browse-topics{
	<?php if ( ! empty( $radio_browse_topics_enable ) && true == $radio_browse_topics_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $browse_topics_bg_color ) ) : ?>
	background-color: <?php echo $browse_topics_bg_color; ?>;
	<?php elseif ( ! empty( $browse_topics_bg_image ) ) : ?>
	background-image: url(<?php echo $browse_topics_bg_image; ?>);
	<?php endif; ?>
}
#getstarted-blog{
	<?php if ( ! empty( $radio_getstarted_blog_enable ) && true == $radio_getstarted_blog_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $getstarted_blog_bg_color ) ) : ?>
	background-color: <?php echo $getstarted_blog_bg_color; ?>;
	<?php elseif ( ! empty( $getstarted_blog_bg_image ) ) : ?>
	background-image: url(<?php echo $getstarted_blog_bg_image; ?>);
	<?php endif; ?>
}
#getstarted-blog {
	<?php if ( ! empty( $getstarted_blog_bg_color ) ) : ?>
	background-image: linear-gradient( 20deg, <?php echo $getstarted_blog_bg_color; ?> 14%, <?php echo $getstarted_blog_bg_color; ?> 100%);
	<?php endif; ?>
}
#our-feature,#our-features{
	<?php if ( ! empty( $radio_features_enable ) && true == $radio_features_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_features_bg_color ) ) : ?>
	background-color: <?php echo $themes_our_features_bg_color; ?>;
	<?php elseif ( ! empty( $our_features_bg_image ) ) : ?>
	background-image: url(<?php echo $our_features_bg_image; ?>);
	<?php endif; ?>
}
#appointment .appointment-shortcode{
	<?php if ( ! empty( $radio_features_enable ) && true == $radio_features_enable ) : ?>
	position: unset;
	<?php endif; ?>
}
#our-features .feature-main-content span {
	<?php if ( ! empty( $themes_features_small_text_color ) ) : ?>
	color: <?php echo $themes_features_small_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_features_small_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_features_small_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_features_small_text_font_size ) ) : ?>
	font-size: <?php echo $themes_features_small_text_font_size; ?>;
	<?php endif; ?>
}
#our-features .feature-main-content h2 {
	<?php if ( ! empty( $features_main_text_color ) ) : ?>
	color: <?php echo $features_main_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_main_text_fontfamily  ) ) : ?>
	font-family: <?php echo $features_main_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_main_text_font_size ) ) : ?>
	font-size: <?php echo $features_main_text_font_size; ?>;
	<?php endif; ?>
}
#why-choose-us{
	<?php if ( ! empty( $radio_why_choose_us_enable ) && true == $radio_why_choose_us_enable) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#why-choose-us .choose-inner span{
  <?php if ( ! empty( $why_choose_us_main_heading_text_color ) ) : ?>
  color: <?php echo $why_choose_us_main_heading_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $why_choose_us_main_heading_font_family  ) ) : ?>
  font-family: <?php echo $why_choose_us_main_heading_font_family ; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $why_choose_us_main_heading_font_size ) ) : ?>
  font-size: <?php echo $why_choose_us_main_heading_font_size; ?>;
  <?php endif; ?>
}
#why-choose-us .choose-inner h2{
  <?php if ( ! empty( $why_choose_us_main_heading_text_color ) ) : ?>
  color: <?php echo $why_choose_us_main_heading_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $why_choose_us_main_heading_font_family  ) ) : ?>
  font-family: <?php echo $why_choose_us_main_heading_font_family ; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $why_choose_us_main_heading_font_size ) ) : ?>
  font-size: <?php echo $why_choose_us_main_heading_font_size; ?>;
  <?php endif; ?>
}
#why-choose-us .why-choose-us-content h2{
	<?php if ( ! empty( $themes_about_main_title_color ) ) : ?>
	color: <?php echo $themes_about_main_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_main_title_fontfamily  ) ) : ?>
	font-family: <?php echo $themes_about_main_title_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_main_title_font_size ) ) : ?>
	font-size: <?php echo $themes_about_main_title_font_size; ?>;
	<?php endif; ?>
}
#why-choose-us .why-choose-us-content ul li{
	<?php if ( ! empty( $themes_about_list_title_color ) ) : ?>
	color: <?php echo $themes_about_list_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_list_title_fontfamily ) ) : ?>
	font-family: <?php echo $themes_about_list_title_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_list_title_font_size ) ) : ?>
	font-size: <?php echo $themes_about_list_title_font_size; ?>;
	<?php endif; ?>
}
#why-choose-us .why-choose-us-content a{
	<?php if ( ! empty( $why_choose_us_button_text_color ) ) : ?>
	color: <?php echo $why_choose_us_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $themes_about_button_text_fontfamily ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_about_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_about_button_bg_color ) ) : ?>
	background-color: <?php echo $themes_about_button_bg_color; ?>;
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
	font-family: <?php echo $themes_headermenu_font_family; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_headermenu_font_size ) ) : ?>
	font-size: <?php echo $themes_headermenu_font_size; ?> !important;
	<?php endif; ?>
}
.main-header .side-navigation ul li a:hover{
	<?php if ( ! empty( $themes_header_menuhover_color ) ) : ?>
	color: <?php echo $themes_header_menuhover_color; ?> !important;
	<?php endif; ?>
	filter: drop-shadow(4.5px 7.794px 13.5px <?php echo $themes_header_menuhover_bgcolor; ?>);
    background-image: linear-gradient(57deg, <?php echo $themes_header_menuhover_bgcolor; ?> 0%, <?php echo $themes_header_menuhover_bgcolor_t; ?> 100%);
}
.main-header .side-navigation ul ul,.side-navigation ul ul{
	<?php if ( ! empty( $themes_dropdownbg_color ) ) : ?>
	background-color: <?php echo $themes_dropdownbg_color; ?>;
	<?php endif; ?>
}
.main-header .side-navigation ul ul a{
	<?php if ( ! empty( $themes_dropdownbg_itemcolor ) ) : ?>
	color: <?php echo $themes_dropdownbg_itemcolor; ?> !important;
	<?php endif; ?>
}
.side-navigation li.current_page_item a{
	<?php if ( ! empty( $themes_header_menu_active_color ) ) : ?>
	color: <?php echo $themes_header_menu_active_color; ?>!important;
	<?php endif; ?>
}
#sidebar1,amp-sidebar#sidebar1{
	<?php if ( ! empty( $themes_dropdownbg_responsivecolor ) ) : ?>
	background: <?php echo $themes_dropdownbg_responsivecolor; ?>!important;
	<?php endif; ?>
}
#sidebar1 ul li a{
	<?php if ( ! empty( $themes_responsive_menu_color ) ) : ?>
	color: <?php echo $themes_responsive_menu_color; ?>!important;
	<?php endif; ?>
}
#cartbx{
	<?php if ( ! empty( $themes_header_cart_bgcolor ) ) : ?>
	background: <?php echo $themes_header_cart_bgcolor; ?>;
	<?php endif; ?>
}
.menubar .cart .currentcont{
	<?php if ( ! empty( $themes_header_cart_count_bgcolor ) ) : ?>
		background: linear-gradient(0deg,<?php echo $themes_header_cart_count_bgcolor; ?> 0%,<?php echo $themes_header_cart_count_bgcolor; ?> 100%) !important;
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
.side-navigation li a,.main-header .side-navigation li{
	<?php if ( ! empty( $themes_header_padding_leftRight ) ) : ?>
	padding-left: <?php echo $themes_header_padding_leftRight; ?>;
	padding-right: <?php echo $themes_header_padding_leftRight; ?>;
	<?php endif; ?>
}
#header-menu button[type=submit] i{
	<?php if ( ! empty( $themes_header_section_search_color ) ) : ?>
	background-image: linear-gradient(20deg, <?php echo $themes_header_section_search_color; ?> 0%, <?php echo $themes_header_section_search_color; ?> 100%);
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_section_search_font_size ) ) : ?>
	font-size: <?php echo $themes_header_section_search_font_size; ?>;
	<?php endif; ?>
}
.menubar .login-link a:hover,.menubar .topbtn{
	<?php if ( ! empty( $themes_header_button_bg_color_afterhover ) ) : ?>
	background-color: <?php echo $themes_header_button_bg_color_afterhover; ?>;
	<?php endif; ?>
}
.menubar .login-link a,.menubar .topbtn,.header-button a,#topbar .topbtn a{
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
	<?php if ( ! empty( $themes_header_button_border_color ) ) : ?>
	border-color: <?php echo $themes_header_button_border_color; ?>;
	<?php endif; ?>
}
div#cat_togglee i{
	<?php if ( ! empty( $themes_header_category_bar_color ) ) : ?>
	color: <?php echo $themes_header_category_bar_color; ?>;
	<?php endif; ?>
}
#catg_animate{
	<?php if ( ! empty( $themes_header_category_box_bg_color ) ) : ?>
	background-color: <?php echo $themes_header_category_box_bg_color; ?>;
	<?php endif; ?>
}
#catg_animate ul.product-categories li a{
	<?php if ( ! empty( $themes_header_category_text_color ) ) : ?>
	color: <?php echo $themes_header_category_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_category_text_font_family ) ) : ?>
	font-family: <?php echo $themes_header_category_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_category_text_font_size ) ) : ?>
	font-size: <?php echo $themes_header_category_text_font_size; ?>;
	<?php endif; ?>
}
.header-button a i{
	<?php if ( ! empty( $themes_header_button_text_color ) ) : ?>
	color: <?php echo $themes_header_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_text_font_size ) ) : ?>
	font-size: <?php echo $themes_header_button_text_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_bg_color ) ) : ?>
	background-color: <?php echo $themes_header_button_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_header_button_border_color ) ) : ?>
	border-color: <?php echo $themes_header_button_border_color; ?>;
	<?php endif; ?>
}
#slider{
	<?php if ( ! empty( $slider_enable ) && true == $slider_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#productslide{
	<?php if ( ! empty( $slider_products_enable ) && true == $slider_products_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#productslide .owl-nav{
	<?php if ( ! empty( $slider_products_nav_enable ) && true == $slider_products_nav_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#slider .prop_desc p,#slider .slider-box span{
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
#slider .slider-box h1,#productslide .products-box .product-content a,#slider .prop_desc p,.slider-box h1 span{
	<?php if ( ! empty( $themes_main_heading_color ) ) : ?>
	color: <?php echo $themes_main_heading_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_main_heading_font_family ) ) : ?>
	font-family: <?php echo $themes_main_heading_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_main_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_main_heading_font_size; ?>;
	<?php endif; ?>
}
#slider li a.active,#slider li a,#slider .slider-box p,#productslide .products-box .product-content p{
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
#slider .search-submit,#slider .slider-button-1,#productslide .products-box .product-content .icon_link a{
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
}
#slider .search-submit,#slider .slider-button{
	<?php if ( ! empty( $themes_slide_button_gradient_bgcolor1 )|| ! empty( $themes_slide_button_gradient_bgcolor2 )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_slide_button_gradient_bgcolor1; ?> 0%, <?php echo $themes_slide_button_gradient_bgcolor2; ?> 100%);
	<?php endif; ?>
}
#productslide .products-box .product-content .icon_link a,#productslide .products-box .featured-cart a{
	<?php if ( ! empty( $themes_slidepro_button_gradient_bgcolor1 )|| ! empty( $themes_slidepro_button_gradient_bgcolor2 )) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_slidepro_button_gradient_bgcolor1; ?> 0%, <?php echo $themes_slidepro_button_gradient_bgcolor2; ?> 100%);
	<?php endif; ?>
}
#our-feature{
	<?php if ( ! empty( $radio_features_enable ) && true == $radio_features_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#our-feature p{
	<?php if ( ! empty( $features_small_text_color ) ) : ?>
	color: <?php echo $features_small_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $features_small_text_fontfamily ) ) : ?>
	font-family: <?php echo $features_small_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $features_small_text_font_size ) ) : ?>
	font-size: <?php echo $features_small_text_font_size; ?>;
	<?php endif; ?>
}
#our-feature p{
	<?php if ( ! empty( $features_small_text_color ) ) : ?>
	background: linear-gradient(91deg,<?php echo $features_small_text_color; ?> 75%,<?php echo $features_small_text_color; ?> 100%);
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
	<?php endif; ?>
}
#our-feature h3{
	<?php if ( ! empty( $features_main_text_color ) ) : ?>
	color: <?php echo $features_main_text_color; ?> !important;
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
	color: <?php echo $features_dicsount_text_color; ?> !important;
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
#why-choose-us .why-video-wrap span i,.video-img i{
	<?php if ( ! empty( $about_video_icons_color ) ) : ?>
	color: <?php echo $about_video_icons_color; ?> ;
	<?php endif; ?>
}
#why-choose-us .why-video-wrap span{
	<?php if ( ! empty( $about_video_icons_bg_color ) ) : ?>
	background-color: <?php echo $about_video_icons_bg_color; ?> ;
	<?php endif; ?>
}
.video-img i{
	<?php if ( ! empty( $about_video_icons_bg_color ) ) : ?>
	border-color: <?php echo $about_video_icons_bg_color; ?> ;
	<?php endif; ?>
}
#our-feature a,#our-feature a{
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
#emergency-contact{
	<?php if ( ! empty( $radio_emergency_contact_enable ) && true == $radio_emergency_contact_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#emergency-contact .left-box h3{
  <?php if ( ! empty( $emergency_contact_main_text_color ) ) : ?>
  color: <?php echo $emergency_contact_main_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_main_text_fontfamily ) ) : ?>
  font-family: <?php echo $emergency_contact_main_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_main_text_font_size ) ) : ?>
  font-size: <?php echo $emergency_contact_main_text_font_size; ?>;
  <?php endif; ?>
}
#emergency-contact .left-box span{
  <?php if ( ! empty( $emergency_contact_sub_text_color ) ) : ?>
  color: <?php echo $emergency_contact_sub_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_sub_text_fontfamily ) ) : ?>
  font-family: <?php echo $emergency_contact_sub_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_sub_text_font_size ) ) : ?>
  font-size: <?php echo $emergency_contact_sub_text_font_size; ?>;
  <?php endif; ?>
}
#emergency-contact .left-box p{
  <?php if ( ! empty( $emergency_contact_text_color ) ) : ?>
  color: <?php echo $emergency_contact_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_text_fontfamily ) ) : ?>
  font-family: <?php echo $emergency_contact_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $emergency_contact_text_font_size ) ) : ?>
  font-size: <?php echo $emergency_contact_text_font_size; ?>;
  <?php endif; ?>
}
#search-banner{
	<?php if ( ! empty( $radio_search_banner_enable ) && true == $radio_search_banner_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#about,#about-us{
	<?php if ( ! empty( $radio_about_enable) && true == $radio_about_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#about,#about-us{
	<?php if ( ! empty( $about_bgcolor ) ) : ?>
	background-color: <?php echo $about_bgcolor; ?>;
	<?php elseif ( ! empty( $about_bgimage ) ) : ?>
	background-image: url(<?php echo $about_bgimage; ?>);
	<?php endif; ?>
}
#about,#about-us{
	<?php if ( ! empty( $about_bgcolor ) ) : ?>
	background-color: <?php echo $about_bgcolor; ?>;
	<?php elseif ( ! empty( $about_bgimage ) ) : ?>
	background-image: url(<?php echo $about_bgimage; ?>);
	<?php endif; ?>
}
#featured-update{
	<?php if ( ! empty( $fetured_product_bg_color ) ) : ?>
	background-color: <?php echo $fetured_product_bg_color; ?>;
	<?php elseif ( ! empty( $fetured_product_bg_image ) ) : ?>
	background-image: url(<?php echo $fetured_product_bg_image; ?>);
	<?php endif; ?>
}
.about-content h2 span.left-text,#about-us .section-content span,#about-us .about-us-content span{
	<?php if ( ! empty( $about_smalltitle_left_color ) ) : ?>
	color: <?php echo $about_smalltitle_left_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_left_fontfamily ) ) : ?>
	font-family: <?php echo $about_smalltitle_left_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_left_font_size ) ) : ?>
	font-size: <?php echo $about_smalltitle_left_font_size; ?>;
	<?php endif; ?>
}
.about-content h2 span.right-text{
	<?php if ( ! empty( $about_smalltitle_right_color ) ) : ?>
	color: <?php echo $about_smalltitle_right_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_right_fontfamily ) ) : ?>
	font-family: <?php echo $about_smalltitle_right_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_smalltitle_right_font_size ) ) : ?>
	font-size: <?php echo $about_smalltitle_right_font_size; ?>;
	<?php endif; ?>
}
.about-content h3,#about h3,#about-us .section-content h2,#about-us .about-us-content h2{
	<?php if ( ! empty( $about_main_title_color ) ) : ?>
	color: <?php echo $about_main_title_color; ?> !important;
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
	color: <?php echo $about_list_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $about_list_title_fontfamily ) ) : ?>
	font-family: <?php echo $about_list_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_list_title_font_size ) ) : ?>
	font-size: <?php echo $about_list_title_font_size; ?>;
	<?php endif; ?>
}
#about .about-content p,#about-us .section-content p,#about .about-content ,
#about-us .about-us-content p{
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
.about-content .right-read,.about-content .left-read, .about-content .right-read,#about-us .section-content a,#about-us .about-us-content a{
	<?php if ( ! empty( $about_button_text_color ) ) : ?>
	color: <?php echo $about_button_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $about_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $about_button_text_fontfamily; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $about_button_text_font_size ) ) : ?>
	font-size: <?php echo $about_button_text_font_size; ?> !important;
	<?php endif; ?>
}
.about-content .right-read, .about-content .right-read,#about-us .section-content a,#about-us .about-us-content a{
	<?php if ( ! empty( $about_button_bg_color ) ) : ?>
	background-image: linear-gradient(180deg, <?php echo $about_button_bg_color; ?> 0%, <?php echo $about_button_bg_color; ?> 100%);
	<?php endif; ?>
}
.about-video p,.left-bg p,.right-img-bg p{
	<?php if ( ! empty( $about_extra_text_color ) ) : ?>
	color: <?php echo $about_extra_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $about_extra_text_fontfamily ) ) : ?>
	font-family: <?php echo $about_extra_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $about_extra_text_font_size ) ) : ?>
	font-size: <?php echo $about_extra_text_font_size; ?>;
	<?php endif; ?>
}
.right-img-bg,.img-outer:after,.img-outer:before{
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
	color: <?php echo $pro_main_title_color; ?> !important;
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
#featured-update .price-featured-car h3 a,#category-products h3 a{
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
#our-app,#newsletter .right-box{
	<?php if ( ! empty( $our_app_section_bgcolor ) ) : ?>
	background-color: <?php echo $our_app_section_bgcolor; ?>;
	<?php elseif ( ! empty( $our_app_section_bgimage ) ) : ?>
	background-image: url(<?php echo $our_app_section_bgimage; ?>);
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
	color: <?php echo $app_main_title_color; ?> !important;
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
	color: <?php echo $app_main_text_color; ?> !important;
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
#our_partners{
	<?php if ( ! empty( $partnersbg_color ) ) : ?>
	background-color: <?php echo $partnersbg_color; ?>;
	<?php elseif ( ! empty( $partnersbg_image ) ) : ?>
	background-image: url(<?php echo $partnersbg_image; ?>);
	<?php endif; ?>
}

#live-chat-blog{
	<?php if ( ! empty( $radio_live_chat_enable ) && true == $radio_live_chat_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $live_chat_bg_color ) ) : ?>
	background-color: <?php echo $live_chat_bg_color; ?>;
	<?php elseif ( ! empty( $live_chat_bg_image ) ) : ?>
	background-image: url(<?php echo $live_chat_bg_image; ?>);
	<?php endif; ?>
}

#Active-articals{
	<?php if ( ! empty( $radio_active_articals_enable ) && true == $radio_active_articals_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $active_articals_bg_color ) ) : ?>
	background-color: <?php echo $active_articals_bg_color; ?>;
	<?php elseif ( ! empty( $active_articals_bg_image ) ) : ?>
	background-image: url(<?php echo $active_articals_bg_image; ?>);
	<?php endif; ?>
}

#our-partners,#appointment{
	<?php if ( ! empty( $radio_contact_partners_enable ) && true == $radio_contact_partners_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $contact_partners_bg_color ) ) : ?>
	background-color: <?php echo $contact_partners_bg_color; ?>;
	<?php elseif ( ! empty( $contact_partners_bg_image ) ) : ?>
	background-image: url(<?php echo $contact_partners_bg_image; ?>);
	<?php endif; ?>
}

#our-partners .home-contact-us{
	<?php if ( ! empty( $home_page_contact_bg_color ) ) : ?>
	background-color: <?php echo $home_page_contact_bg_color; ?>;
	<?php elseif ( ! empty( $home_page_contact_bg_image ) ) : ?>
	background-image: url(<?php echo $home_page_contact_bg_image; ?>);
	<?php endif; ?>
}

#our-faq{
	<?php if ( ! empty( $radio_our_faq_enable ) && true == $radio_our_faq_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $our_faq_bg_color ) ) : ?>
	background-color: <?php echo $our_faq_bg_color; ?>;
	<?php elseif ( ! empty( $our_faq_bg_image ) ) : ?>
	background-image: url(<?php echo $our_faq_bg_image; ?>);
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
#services,#our-services{
	<?php if ( ! empty( $services_enabledisable ) && true == $services_enabledisable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#services,#our-services{
	<?php if ( ! empty( $services_bgcolor ) ) : ?>
	background-color: <?php echo $services_bgcolor; ?>;
	<?php elseif ( ! empty( $services_bgimage ) ) : ?>
	background-image: url(<?php echo $services_bgimage; ?>);
	<?php endif; ?>
}
#services span.head_center,#services p.small-text,#our-services .services-small-title{
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
#services h3,#our-services .section-content span{
	<?php if ( ! empty( $themes_service_title_color ) ) : ?>
	color: <?php echo $themes_service_title_color; ?> !important;
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
	color: <?php echo $themes_service_subtext_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_text_font_family ) ) : ?>
	font-family: <?php echo $themes_service_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_text_font_size ) ) : ?>
	font-size: <?php echo $themes_service_text_font_size; ?>;
	<?php endif; ?>
}
.services-image img,.our-services-image{
	<?php if ( ! empty( $themes_service_box_icons_bg_color ) ) : ?>
	background-color: <?php echo $themes_service_box_icons_bg_color; ?>;
	<?php endif; ?>
}
#services a.bottom-link i,#our-feature a, #our-feature a{
	<?php if ( ! empty( $features_button_bg_color ) ) : ?>
	background-color: <?php echo $features_button_bg_color; ?>;
	<?php endif; ?>
}
.service-box:hover .services-image img{
	<?php if ( ! empty( $themes_service_box_icons_bg_hovercolor ) ) : ?>
	background-color: <?php echo $themes_service_box_icons_bg_hovercolor; ?>;
	<?php endif; ?>
}
#services h4 a,#our-services .our-services-content a{
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
#services .services_content,#our-services .services-post,#our-services .our-services-content .services-text{
	<?php if ( ! empty( $themes_service_box_content_color ) ) : ?>
	color: <?php echo $themes_service_box_content_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_content_font_family ) ) : ?>
	font-family: <?php echo $themes_service_box_content_font_family; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_service_box_content_font_size ) ) : ?>
	font-size: <?php echo $themes_service_box_content_font_size; ?> !important;
	<?php endif; ?>
}
#services .themeBbutton a,#our-services .all-services a{
	<?php if ( ! empty( $all_services_button_color ) ) : ?>
	color: <?php echo $all_services_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $all_services_button_fontfamily ) ) : ?>
	font-family: <?php echo $all_services_button_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $all_services_button_font_size ) ) : ?>
	font-size: <?php echo $all_services_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $all_services_button_bgcolor ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $all_services_button_bgcolor; ?> 25%, <?php echo $all_services_button_bgcolor; ?> 100%);
	<?php endif; ?>
}
#services .themeBbutton a{
	<?php if ( ! empty( $all_services_button_bgcolor1 ) || ! empty( $all_services_button_bgcolor2 )) : ?>
	background-image: linear-gradient( 80deg, <?php echo $all_services_button_bgcolor1; ?> 25%, <?php echo $all_services_button_bgcolor2; ?> 100%);
	<?php endif; ?>
}

#interface-deg{
	<?php if ( ! empty( $radio_interface_deg_enable ) && true == $radio_interface_deg_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#interface-deg{
	<?php if ( ! empty( $interface_deg_section_bgcolor ) ) : ?>
	background-color: <?php echo $interface_deg_section_bgcolor; ?>;
	<?php elseif ( ! empty( $interface_deg_section_bgimage ) ) : ?>
	background-image: url(<?php echo $interface_deg_section_bgimage; ?>);
	<?php endif; ?>
}
.deg-right-box h3,.deg-bottom .head_white{
	<?php if ( ! empty( $interface_main_title_color ) ) : ?>
	color: <?php echo $interface_main_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $interface_main_title_fontfamily ) ) : ?>
	font-family: <?php echo $interface_main_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_main_title_font_size ) ) : ?>
	font-size: <?php echo $interface_main_title_font_size; ?>;
	<?php endif; ?>
}
.deg-right-box p,.deg-bottom p{
	<?php if ( ! empty( $interface_text_color ) ) : ?>
	color: <?php echo $interface_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $interface_text_fontfamily ) ) : ?>
	font-family: <?php echo $interface_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_text_font_size ) ) : ?>
	font-size: <?php echo $interface_text_font_size; ?>;
	<?php endif; ?>
}
.deg-right-box li{
	<?php if ( ! empty( $interface_list_title_color ) ) : ?>
	color: <?php echo $interface_list_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_list_title_fontfamily ) ) : ?>
	font-family: <?php echo $interface_list_title_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_list_title_font_size ) ) : ?>
	font-size: <?php echo $interface_list_title_font_size; ?>;
	<?php endif; ?>
}
#interface-deg .right-read,#interface-deg .left-read{
	<?php if ( ! empty( $interface_button_text_color ) ) : ?>
	color: <?php echo $interface_button_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $interface_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_button_text_font_size ) ) : ?>
	font-size: <?php echo $interface_button_text_font_size; ?>;
	<?php endif; ?>
}
#interface-deg .right-read,#interface-deg .left-read,.deg-bottom{
	<?php if ( ! empty( $interface_button_bg_color ) ) : ?>
	background-color: <?php echo $interface_button_bg_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $interface_button_bg_color ) ) : ?>
	border-color: <?php echo $interface_button_bg_color; ?>;
	<?php endif; ?>
}
#introduction{
	<?php if ( ! empty( $radio_introduction_enable ) && true == $radio_introduction_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#introduction{
	<?php if ( ! empty( $introduction_section_bgcolor ) ) : ?>
	background-color: <?php echo $introduction_section_bgcolor; ?>;
	<?php elseif ( ! empty( $introduction_section_bgimage ) ) : ?>
	background-image: url(<?php echo $introduction_section_bgimage; ?>);
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
	color: <?php echo $best_seller_main_text_color; ?> !important;
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
#best-seller h2 span{
	<?php if ( ! empty( $best_seller_small_text_color ) ) : ?>
	color: <?php echo $best_seller_small_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_small_text_fontfamily ) ) : ?>
	font-family: <?php echo $best_seller_small_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $best_seller_small_text_font_size ) ) : ?>
	font-size: <?php echo $best_seller_small_text_font_size; ?>;
	<?php endif; ?>
}
#best-seller h2 span:after, #best-seller h2 span:before{
	<?php if ( ! empty( $best_seller_small_text_color ) ) : ?>
	background-color: <?php echo $best_seller_small_text_color; ?>;
	<?php endif; ?>
}
#best-seller .product-box h5 a,#best-seller h5 a{
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
	color: <?php echo $seller_price_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $seller_price_fontfamily ) ) : ?>
	font-family: <?php echo $seller_price_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $seller_price_font_size ) ) : ?>
	font-size: <?php echo $seller_price_font_size; ?>;
	<?php endif; ?>
}
#best-seller .product-over a.add_to_cart_button{
	<?php if ( ! empty( $seller_button_bgcolor ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $seller_button_bgcolor; ?> 25%, <?php echo $seller_button_bgcolor; ?> 100%);
	<?php endif; ?>
}
#best-seller .product-over a.add_to_cart_button{
	<?php if ( ! empty( $cart_button_color ) ) : ?>
	color: <?php echo $cart_button_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $cart_button_fontfamily ) ) : ?>
	font-family: <?php echo $cart_button_fontfamily; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $cart_button_font_size ) ) : ?>
	font-size: <?php echo $cart_button_font_size; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $cart_button_bgcolor1 ) ||  ! empty( $cart_button_bgcolor2 ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $cart_button_bgcolor1; ?> 25%, <?php echo $cart_button_bgcolor2; ?> 100%) !important;
	<?php endif; ?>
}
#best-seller a.view-all{
	<?php if ( ! empty( $seller_button_bgcolor1 ) || ! empty( $seller_button_bgcolor2 )) : ?>
	background-image: linear-gradient( 80deg, <?php echo $seller_button_bgcolor1; ?> 25%, <?php echo $seller_button_bgcolor2; ?> 100%);
	<?php endif; ?>
}
#best-seller span.product-sale-tag .onsale{
	<?php if ( ! empty( $seller_batch_bgcolor1 ) || ! empty( $seller_batch_bgcolor2 )) : ?>
	background-image: linear-gradient( 80deg, <?php echo $seller_batch_bgcolor1; ?> 25%, <?php echo $seller_batch_bgcolor2; ?> 100%);
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
	color: <?php echo $tab_tittle_active_color; ?>;
	<?php endif; ?>
}
#category-products ul a.nav-link.active{
	<?php if ( ! empty( $tab_tittle_active_color1 ) ||  ! empty( $tab_tittle_active_color2 )) : ?>
	background: linear-gradient( 91deg,<?php echo $tab_tittle_active_color1; ?> 47%,<?php echo $tab_tittle_active_color2; ?> 100%);
	-webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
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
#category-products a.view-all{
	<?php if ( ! empty( $product_button_color ) ) : ?>
	color: <?php echo $product_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_button_fontfamily ) ) : ?>
	font-family: <?php echo $product_button_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $product_button_font_size ) ) : ?>
	font-size: <?php echo $product_button_font_size; ?>;
	<?php endif; ?>
}
#category-products a.view-all{
	<?php if ( ! empty( $product_button_bgcolor1 ) || ! empty( $product_button_bgcolor2 )) : ?>
	background-image: linear-gradient( 80deg, <?php echo $product_button_bgcolor1; ?> 25%, <?php echo $product_button_bgcolor2; ?> 100%);;
	<?php endif; ?>
}
.recode-prod-content a.add_to_cart_button, #best-seller .product-over a.add_to_cart_button, #category-products .product-over a.add_to_cart_button{
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
.recode-prod-content a.add_to_cart_button, #best-seller .product-over a.add_to_cart_button, #category-products .product-over a.add_to_cart_button{
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
	color: <?php echo $themes_newsletter_title_color_first; ?> !important;
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
#newsletter input[type="submit"]{
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
#testimonials h2 span,#testimonials h2{
	<?php if ( ! empty( $themes_testimonial_title_color ) ) : ?>
	color: <?php echo $themes_testimonial_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_title_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_title_font_family; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_title_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_title_font_size; ?> !important;
	<?php endif; ?>
}
#testimonials h2 span:before, #testimonials h2 span:after{
	<?php if ( ! empty( $themes_testimonial_title_color ) ) : ?>
	background-color: <?php echo $themes_testimonial_title_color; ?> !important;
	<?php endif; ?>
}
#testimonials h3,#testimonials span{
	<?php if ( ! empty( $themes_testimonial_subtext_color ) ) : ?>
	color: <?php echo $themes_testimonial_subtext_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_subtext_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_subtext_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_subtext_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_subtext_font_size; ?>;
	<?php endif; ?>
}
.testimonial-text-out h4.testimonial_name a,#testimonials a{
	<?php if ( ! empty( $themes_testimonial_name_color ) ) : ?>
	color: <?php echo $themes_testimonial_name_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_name_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_name_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_name_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_name_font_size; ?>;
	<?php endif; ?>
}
.testimonial-text-out h4.testimonial_name cite,#testimonials .testimonials-contents span{
	<?php if ( ! empty( $themes_testimonial_des_color ) ) : ?>
	color: <?php echo $themes_testimonial_des_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_des_font_family ) ) : ?>
	font-family: <?php echo $themes_testimonial_des_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_testimonial_des_font_size ) ) : ?>
	font-size: <?php echo $themes_testimonial_des_font_size; ?>;
	<?php endif; ?>
}
.testimonial_box .qoute_text,#testimonials p{
	<?php if ( ! empty( $themes_testimonial_qoute_color ) ) : ?>
	color: <?php echo $themes_testimonial_qoute_color; ?> !important;
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
}
#testimonials a.left-read{
	<?php if ( ! empty( $themes_testimonial_but_bgcolor1 ) ) : ?>
	background-image: linear-gradient( 80deg, <?php echo $themes_testimonial_but_bgcolor1; ?> 25%, <?php echo $themes_testimonial_but_bgcolor2; ?> 100%);
	<?php endif; ?>
}
#our-video{
	<?php if ( ! empty( $video_enable ) && true == $video_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#our-video{
	<?php if ( ! empty( $video_bgcolor ) ) : ?>
	background-color: <?php echo $video_bgcolor; ?>;
	<?php elseif ( ! empty( $video_bgimage ) ) : ?>
	background-image: url(<?php echo $video_bgimage; ?>);
	<?php endif; ?>
}
#our-video span.left-text{
	<?php if ( ! empty( $video_sec_small_left_title_color ) ) : ?>
	color: <?php echo $video_sec_small_left_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_small_left_title_font_family ) ) : ?>
	font-family: <?php echo $video_sec_small_left_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_small_left_title_font_size ) ) : ?>
	font-size: <?php echo $video_sec_small_left_title_font_size; ?>;
	<?php endif; ?>
}
#our-video span.right-text{
	<?php if ( ! empty( $video_sec_small_right_title_color ) ) : ?>
	color: <?php echo $video_sec_small_right_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_small_right_title_font_family ) ) : ?>
	font-family: <?php echo $video_sec_small_right_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_small_right_title_font_size ) ) : ?>
	font-size: <?php echo $video_sec_small_right_title_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_small_right_title_bgcolor ) ) : ?>
	background-color: <?php echo $video_sec_small_right_title_bgcolor; ?>;
	<?php endif; ?>
}
#our-video h3{
	<?php if ( ! empty( $video_sec_main_title_color ) ) : ?>
	color: <?php echo $video_sec_main_title_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_main_title_font_family ) ) : ?>
	font-family: <?php echo $video_sec_main_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_main_title_font_size ) ) : ?>
	font-size: <?php echo $video_sec_main_title_font_size; ?>;
	<?php endif; ?>
}
#our-video p{
	<?php if ( ! empty( $video_sec_text_color ) ) : ?>
	color: <?php echo $video_sec_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_text_font_family ) ) : ?>
	font-family: <?php echo $video_sec_text_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_text_font_size ) ) : ?>
	font-size: <?php echo $video_sec_text_font_size; ?>;
	<?php endif; ?>
}
#our-video .left-read,#our-video .right-read{
	<?php if ( ! empty( $video_sec_button_text_color ) ) : ?>
	color: <?php echo $video_sec_button_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_button_text_fontfamily ) ) : ?>
	font-family: <?php echo $video_sec_button_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_button_text_font_size ) ) : ?>
	font-size: <?php echo $video_sec_button_text_font_size; ?>;
	<?php endif; ?>
}
#our-video .left-read,#our-video .right-read,#our-video .slider-video-box a{
	<?php if ( ! empty( $video_sec_button_bg_color ) ) : ?>
	background-color: <?php echo $video_sec_button_bg_color; ?>;
	<?php endif; ?>
}
#our-video .left-read,#our-video .right-read{
	<?php if ( ! empty( $video_sec_button_bg_color ) ) : ?>
	border-color: <?php echo $video_sec_button_bg_color; ?>;
	<?php endif; ?>
}
#our-video .slider-video-box i{
	<?php if ( ! empty( $video_icons_color ) ) : ?>
	color: <?php echo $video_icons_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_icons_color ) ) : ?>
	border-color: <?php echo $video_icons_color; ?>;
	<?php endif; ?>
}
#our-video .video_content h2, #our-video .video_content p{
	<?php if ( ! empty( $video_sec_Main_text_color ) ) : ?>
	color: <?php echo $video_sec_Main_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_Main_text_fontfamily ) ) : ?>
	font-family: <?php echo $video_sec_Main_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $video_sec_Main_text_font_size ) ) : ?>
	font-size: <?php echo $video_sec_Main_text_font_size; ?>;
	<?php endif; ?>
}
#our-records .our-records-wrapper .record-count-no span{
	<?php if ( ! empty( $themes_our_record_number_color ) ) : ?>
		color: <?php echo $themes_our_record_number_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_record_number_font_family ) ) : ?>
	font-family: <?php echo $themes_our_record_number_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_record_number_font_size ) ) : ?>
	font-size: <?php echo $themes_our_record_number_font_size; ?>;
	<?php endif; ?>
	-webkit-text-fill-color: #fffffff;
    -webkit-background-clip: text
}
#our_records .record-text,p.record-count-title{
	<?php if ( ! empty( $themes_our_record_title_color ) ) : ?>
		color: <?php echo $themes_our_record_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_record_title_font_family ) ) : ?>
	font-family: <?php echo $themes_our_record_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_our_record_title_font_size ) ) : ?>
	font-size: <?php echo $themes_our_record_title_font_size; ?>;
	<?php endif; ?>
}
.record_box1, .record_box2, .record_box3, .record_box4{
	<?php if ( ! empty( $themes_our_record_icon_bgcolor ) ) : ?>
	background-color: <?php echo $themes_our_record_icon_bgcolor; ?>;
	<?php endif; ?>
}
.record_box1:hover, .record_box2:hover, .record_box3:hover, .record_box4:hover{
	<?php if ( ! empty( $themes_our_record_icon_hover_bgcolor1 )|| ! empty( $themes_our_record_icon_hover_bgcolor2 ) ) : ?>
	background-image: linear-gradient(90deg, <?php echo $themes_our_record_icon_hover_bgcolor1; ?> 0%, <?php echo $themes_our_record_icon_hover_bgcolor2; ?> 100%);
	<?php endif; ?>
}
.rtitle-box .sufix-head,.rtitle-box .sufix-title,#our-records .our-records-wrapper .record-count-title{
	<?php if ( ! empty( $record_sub_title_color ) ) : ?>
		color: <?php echo $record_sub_title_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $record_sub_title_font_family ) ) : ?>
	font-family: <?php echo $record_sub_title_font_family; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $record_sub_title_font_size ) ) : ?>
	font-size: <?php echo $record_sub_title_font_size; ?>;
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
	color: <?php echo $plan_but_text_color; ?> !important;
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
#our_records,#our-records{
	<?php if ( ! empty( $records_section_enable ) && true == $records_section_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#our_records,#our-records .record-box{
	<?php if ( ! empty( $records_bgcolor ) ) : ?>
	background-color: <?php echo $records_bgcolor; ?>;
	<?php elseif ( ! empty( $records_bgimage ) ) : ?>
	background-image: url(<?php echo $records_bgimage; ?>);
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
	color: <?php echo $instagram_main_text_color; ?> !important;
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
	color: <?php echo $instagram_text_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_text_fontfamily ) ) : ?>
	font-family: <?php echo $instagram_text_fontfamily; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $instagram_text_font_size ) ) : ?>
	font-size: <?php echo $instagram_text_font_size; ?>;
	<?php endif; ?>
}
#instagramsec .insta-content h2:before, #instagramsec .insta-content h2:after{
	<?php if ( ! empty( $instagram_text_color ) ) : ?>
	background-color: <?php echo $instagram_text_color; ?> !important;
	<?php endif; ?>
}
#get-in-touch{
	<?php if ( ! empty( $radio_get_in_touch_enable ) && true == $radio_get_in_touch_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#contact_partners,#appointment{
	<?php if ( ! empty( $radio_contact_partners_enable ) && true == $radio_contact_partners_enable ) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
<?php if(!defined('VW_SOFTWARE_COMPANY_PRO_VERSION')){ ?>
#get-in-touch{
	<?php if ( ! empty( $get_in_touch_section_bgcolor ) ) : ?>
	background: linear-gradient(135deg,<?php echo $get_in_touch_section_bgcolor; ?> 0%,<?php echo $get_in_touch_section_bgcolor2; ?> 100%);
	<?php elseif ( ! empty( $get_in_touch_section_bgimage ) ) : ?>
	background-image: url(<?php echo $get_in_touch_section_bgimage; ?>);
	<?php endif; ?>
}
<?php } ?>
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
#timming{
	<?php if ( ! empty( $radio_timming_enable ) && true == $radio_timming_enable) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
}
#footer{
	<?php if ( ! empty( $themes_footer_widgets_enable ) && true == $themes_footer_widgets_enable) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_bgcolor ) ) : ?>
	background-color: <?php echo $themes_footer_widget_bgcolor ; ?>;
	<?php elseif ( ! empty( $themes_footer_widget_bgcolor ) ) : ?>
	background: linear-gradient(20deg, <?php echo $themes_footer_widget_bgcolor ; ?> 0%, <?php echo $themes_footer_widget_bgcolor ; ?> 100%);
	<?php elseif ( ! empty( $themes_footer_widget_bg_image ) ) : ?>
	background-image: url(<?php echo $themes_footer_widget_bg_image; ?>);
	<?php endif; ?>
}

/*-----------Gallery----------*/
#our-gallery .our-gallery-head span{
  <?php if ( ! empty( $themes_gallery_title_color_first ) ) : ?>
  color: <?php echo $themes_gallery_title_color_first; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $themes_gallery_title_font_family ) ) : ?>
  font-family: <?php echo $themes_gallery_title_font_family; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $themes_gallery_title_font_size ) ) : ?>
  font-size: <?php echo $themes_gallery_title_font_size; ?>;
  <?php endif; ?>
}

#our-gallery .our-gallery-head h2{
  <?php if ( ! empty( $gallery_main_text_color ) ) : ?>
  color: <?php echo $gallery_main_text_color; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $gallery_main_text_fontfamily ) ) : ?>
  font-family: <?php echo $gallery_main_text_fontfamily; ?>;
  <?php endif; ?>
  <?php if ( ! empty( $gallery_main_text_fontsize ) ) : ?>
  font-size: <?php echo $gallery_main_text_fontsize; ?>;
  <?php endif; ?>
}
/*----------------End Gallery------------------*/

#footer h3{
	<?php if ( ! empty( $themes_footer_widget_heading_color ) ) : ?>
	color: <?php echo $themes_footer_widget_heading_color; ?> !important;
	-webkit-text-fill-color:<?php echo $themes_footer_widget_heading_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_footer_widget_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_footer_widget_heading_font_size; ?>;
	<?php endif; ?>
}
#footer h3{
	<?php if ( ! empty( $themes_footer_widget_heading_color1 ) || ! empty( $themes_footer_widget_heading_color2 )) : ?>
	background: linear-gradient(to top, <?php echo $themes_footer_widget_heading_color1; ?> 20%,<?php echo $themes_footer_widget_heading_color2; ?> 60%);
	-webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
	<?php endif; ?>
}
#footer .textwidget p, #footer .widget p, #footer .post-content a,#footer a,#footer .textwidget p, #footer .widget p, #footer .post-content a, #footer .about_me p, #footer .about_me .dempar,#footer ul li a,#footer .footer-cols .phone-text a,#footer .about_me table p{
	<?php if ( ! empty( $themes_footer_widget_content_color ) ) : ?>
	color: <?php echo $themes_footer_widget_content_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_content_font_family  ) ) : ?>
	font-family: <?php echo $themes_footer_widget_content_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_content_font_size ) ) : ?>
	font-size: <?php echo $themes_footer_widget_content_font_size; ?>;
	<?php endif; ?>
}
#footer .footer_menu ul li a{
	<?php if ( ! empty( $themes_footer_widget_Menu_color ) ) : ?>
	color: <?php echo $themes_footer_widget_Menu_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_Menu_font_family  ) ) : ?>
	font-family: <?php echo $themes_footer_widget_Menu_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_widget_Menu_font_size ) ) : ?>
	font-size: <?php echo $themes_footer_widget_Menu_font_size; ?>;
	<?php endif; ?>
}
#preloader{
	<?php if ( ! empty( $themes_spinner_bg_color1 ) || ! empty( $themes_spinner_bg_color2 )) : ?>
	background: linear-gradient(90deg, <?php echo $themes_spinner_bg_color1; ?> 0%, <?php echo $themes_spinner_bg_color2; ?> 100%) !important;
	<?php endif; ?>
}
#footer .about_me i{
	<?php if ( ! empty( $themes_footer_widget_content_color ) ) : ?>
	color: <?php echo $themes_footer_widget_content_color; ?>;
	<?php endif; ?>
}
.copyright{
	<?php if ( ! empty( $themes_footer_section_enable ) && true == $themes_footer_section_enable) : ?>
	display: none <?php echo themes_important(); ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_section_bg_color ) ) : ?>
	background-color: <?php echo $themes_footer_section_bg_color ; ?>;
	<?php elseif ( ! empty( $themes_footer_section_bg_image ) ) : ?>
	background-image: url(<?php echo $themes_footer_section_bg_image; ?>);
	<?php endif; ?>
}
.copyright p,.copyright p a,#footer .copy_privacy_policy a{
	<?php if ( ! empty( $themes_footer_copy_content_color ) ) : ?>
	color: <?php echo $themes_footer_copy_content_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_copy_content_font_family  ) ) : ?>
	font-family: <?php echo $themes_footer_copy_content_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_footer_copy_content_font_size ) ) : ?>
	font-size: <?php echo $themes_footer_copy_content_font_size; ?>;
	<?php endif; ?>
}
.contact-page-details h2{
	<?php if ( ! empty( $themes_contact_page_heading_color ) ) : ?>
	color: <?php echo $themes_contact_page_heading_color; ?> !important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_heading_font_family  ) ) : ?>
	font-family: <?php echo $themes_contact_page_heading_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_heading_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_heading_font_size; ?>;
	<?php endif; ?>
}
.contact-page-details p{
	<?php if ( ! empty( $themes_contact_page_text_color ) ) : ?>
	color: <?php echo $themes_contact_page_text_color; ?>!important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_text_font_family  ) ) : ?>
	font-family: <?php echo $themes_contact_page_text_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_text_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_text_font_size; ?>;
	<?php endif; ?>
}
.contact-box .vw-minima-contact-box i{
	<?php if ( ! empty( $themes_contact_page_text_color ) ) : ?>
	color: <?php echo $themes_contact_page_text_color; ?>!important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_text_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_text_font_size; ?>;
	<?php endif; ?>
}
.contact-page-details h3{
	<?php if ( ! empty( $themes_contact_page_form_title_color ) ) : ?>
	color: <?php echo $themes_contact_page_form_title_color; ?>!important;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_title_font_family  ) ) : ?>
	font-family: <?php echo $themes_contact_page_contacts_form_title_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_title_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_contacts_form_title_font_size; ?>;
	<?php endif; ?>
}
.contact-page-details .contac_form label,.contact-page-details .contac_form input::placeholder{
	<?php if ( ! empty( $themes_contact_page_form_text_color ) ) : ?>
	color: <?php echo $themes_contact_page_form_text_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_text_font_family  ) ) : ?>
	font-family: <?php echo $themes_contact_page_contacts_form_text_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_text_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_contacts_form_text_font_size; ?>;
	<?php endif; ?>
}
.contact-page-details .contac_form input[type="submit"]{
	<?php if ( ! empty( $themes_contact_page_form_button_color ) ) : ?>
	color: <?php echo $themes_contact_page_form_button_color; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_button_font_family  ) ) : ?>
	font-family: <?php echo $themes_contact_page_contacts_form_button_font_family ; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_contacts_form_button_font_size ) ) : ?>
	font-size: <?php echo $themes_contact_page_contacts_form_button_font_size; ?>;
	<?php endif; ?>
	<?php if ( ! empty( $themes_contact_page_button_bgcolor1 ) ) : ?>
	background-color: <?php echo $themes_contact_page_button_bgcolor1; ?>;
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
