(function($) {
  /**
   * This file handling some LIVE to the ThemeSetting Customizer live preview.
   */
   /**
   * [themes_manage_customizer_controls description]
   * @param  [array/string] controler controler name.
   * @param  boolean action    Trun on/off the customizer control.
   * @return string           CSS code.
   */
   function themes_manage_customizer_controls( controler, action ) {

    if ( Array.isArray( controler ) ) {
      controler.forEach( function ( item, index ) {
        if ( 'on' == action ) {
          $( '#customize-control-themes_customization-' + item ).fadeIn().css( 'display', 'list-item' );
        } else {
          $( '#customize-control-themes_customization-' + item ).fadeOut().css( 'display', 'none' );
        }
      } );
    } else {
      if ( 'on' == action ) {
        $( '#customize-control-themes_customization-' + controler ).fadeIn().css( 'display', 'list-item' );
      } else {
        $( '#customize-control-themes_customization-' + controler ).fadeOut().css( 'display', 'none' );
      }
    }
  }
  var formbg;
jQuery(document).ready(function($) {

    // Update gallery default thumbnail on load. @since 1.1.3
    var defaultThumbnails = jQuery('.customize-control-checkbox-multiple input[type="radio"]:checked').next('label').find('img').attr('src');
    $('.themes_gallery_thumbnails:first-child').find('img').attr({'src': defaultThumbnails,'title': defaultThumbnails});

  /**
   * Presets Settings
   * @param  {[type]} ) {               checkbox_values [checkbox value]
   * @return {[type]}   [description]
   * @since 1.0.9
   * @version 1.1.3
   */
  jQuery( '.customize-control-checkbox-multiple input[type="radio"]' ).on( 'change', function() {

    checkbox_values = jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="radio"]:checked' )
    .val();

    style_values = jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="radio"]:checked' )
    .data('style');

    var val = [];
    val.push(checkbox_values);
    val.push(style_values);
    // console.log(val);
    jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="hidden"]' )
    .val(checkbox_values)
    .delay(500)
    .trigger( 'change' );

    // Update gallery default thumbnail on presets change. @since 1.1.3
    var defaultThumbnails = jQuery(this).next('label').find('img').attr('src');
    $('.themes_gallery_thumbnails:first-child').find('img').attr({'src': defaultThumbnails,'title': defaultThumbnails});
    // if theme is not Company remove label controls.
    if(checkbox_values == 'default2'){
      $('#customize-control-themes_customization-textfield_label_color,#customize-control-themes_customization-customize_form_label').hide();
    }else{
      $('#customize-control-themes_customization-textfield_label_color,#customize-control-themes_customization-customize_form_label').show();
    }
    if(checkbox_values == 'default18') {
      themes_manage_customizer_controls( ['setting_logo', 'customize_logo_width', 'customize_logo_height'], 'off' );
    } else {
      themes_manage_customizer_controls( ['setting_logo', 'customize_logo_width', 'customize_logo_height'], 'on' );
    }
    formbg = $('#customize-preview iframe').contents().find( '#login' ).css( 'background');
  } );
} ); // jQuery( document ).ready


(function($) {

  /**
   * [themes_find find CSS classes in WordPress customizer]
   * @param  {String} [finder='#themes-customize'] [find class in customizer]
   * @return {[type]}                                  [iframe content finder]
   * @since 1.1.0
   * @version 1.1.3
   */
  function themes_find( finder = '#themes-customize' ) {

      var customizer_finder = $('#customize-preview iframe').contents().find( finder );
      return customizer_finder;
  }

  // function for change ThemeSetting CSS in real time...
  function themes_css_property( setting, target, property, em = false ) {
    // Update the login logo width in real time...
    wp.customize( setting, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).css( property, em );
        } else {
          themes_find( target ).css( property, themes_settingsVal );
        }
      } );
    } );
  } // finish themes_css_property();

  // function for change ThemeSetting CSS in real time...
  function themes_new_css_property( setting, target, property, suffix ) {
    // Update the login logo width in real time...
    wp.customize( setting, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).css( property, '' );
        } else {
          themes_find( target ).css( property, themes_settingsVal + suffix );
        }
      } );
    } );
  } // finish themes_css_property();

  // Declare Variable values for button shadow and button Opacity. Since 1.1.3

  // function for change ThemeSetting attribute in real time...
  function themes_attr_property( setting, target, property ) {
    wp.customize( setting, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).attr( property, '' );
        } else {
          themes_find( target ).attr( property, themes_settingsVal );
        }
      } );
    } );
  }


  // function for change ThemeSetting error and welcome messages in real time...
  /**
   * [themes_text_message ThemeSetting (Error + Welcome) Message live Control.]
   * @param  id       [Unique ID of the section. ]
   * @param  target   [CSS Property]
   * @return string   [CSS property]
   */
  function themes_text_message( id, target ) {
    wp.customize( id, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).html('');
          themes_find( target ).css( 'display', 'none' );
        } else {
          themes_find( target ).html( themes_settingsVal );
          themes_find( target ).css( 'display', 'block' );
        }
      } );
    } );
  }

  /**
   * themes_change_form_label ThemeSetting (Label) Text live Control.
   * @param  id       [Unique ID of the section. ]
   * @param  target   [CSS Property]
   * @since 1.1.3
   * @return string   [CSS property]
   */
  function themes_change_form_label( id, target ) {
    wp.customize( id, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).html('');
        } else {
          themes_find( target ).html( themes_settingsVal );
        }
      } );
    } );
  }

  var change_theme;

  /**
   * Change the ThemeSetting Presets Theme.
   * @param  {[type]} value [Customized value from user.]
   * @return {[type]}       [Theme ID]
   */
  wp.customize( 'customize_presets_settings', function(value) {
    value.bind( function(themes_settingsVal) {

      change_theme = themes_settingsVal;

    });
  });

  // themes_background_img( 'themes_customization[]', 'body.login' );
  $('.customize-controls-close').on('click', function() {
    // localStorage.removeItem("themes_bg_check");
    // localStorage.removeItem("themes_bg");
  });
  wp.customize( 'themes_customization[setting_topbar_display]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#topbar').fadeOut();
				$('#customize-control-themes_customization-setting_topbar_display').nextAll().hide();
				$('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#topbar').fadeIn();
        $('#customize-control-themes_customization-setting_topbar_display').nextAll().show();
      }
    });
  });


  wp.customize( 'themes_customization[radio_contact_partners_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#contact_partners').fadeOut();
        $('#customize-control-themes_customization-radio_contact_partners_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#contact_partners').fadeIn();
        $('#customize-control-themes_customization-radio_contact_partners_enable').nextAll().show();
      }
    });
  });


  wp.customize( 'themes_customization[setting_topbar_background_color]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('#topbar').css( 'background-color', '#f1f7ff' );
      } else {
        themes_find('#topbar').css( 'background-color', themes_settingsVal );
      }
    });
  });
  wp.customize( 'themes_customization[topbar_bgcolor]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('#topbar').css( 'background', '' );
      } else {
        themes_find('#topbar').css( 'background', themes_settingsVal );
      }
    });
  });
  // Update the WordPress login logo in real time...
  wp.customize( 'themes_customization[topbar_bg_image]', function(value) {
    value.bind( function(themes_settingsVal) {

      if ( themes_settingsVal == '' ) {
        themes_find('#topbar').css( 'background-image', 'url(' + themes_script.admin_url + ')' );
      } else {
        themes_find('#topbar').css( 'background-image', 'url(' + themes_settingsVal + ')' );
      }
    });
  });
  // Update the WordPress login logo in real time...
  wp.customize( 'themes_customization[setting_topbar_background]', function(value) {
    value.bind( function(themes_settingsVal) {

      if ( themes_settingsVal == '' ) {
        themes_find('#topbar').css( 'background-image', 'url(' + themes_script.admin_url + ')' );
      } else {
        themes_find('#topbar').css( 'background-image', 'url(' + themes_settingsVal + ')' );
      }
    });
  });
  wp.customize( 'themes_customization[topbar_text_heading]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('#topbar span').html('');
      }else {
        themes_find('#topbar span').html(themes_settingsVal);
      }
    });
  });

  wp.customize( 'themes_customization[slider_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#slider').fadeOut();
        $('#customize-control-themes_customization-slider_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#slider').fadeIn();
        $('#customize-control-themes_customization-slider_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio4_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our-feature').fadeOut();
        $('#customize-control-themes_customization-radio4_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our-feature').fadeIn();
        $('#customize-control-themes_customization-radio_radio4_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_Instagram_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#instagramsec').fadeOut();
        $('#customize-control-themes_customization-radio_Instagram_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#instagramsec').fadeIn();
        $('#customize-control-themes_customization-radio_Instagram_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_about_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#about').fadeOut();
        $('#customize-control-themes_customization-radio_about_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#about').fadeIn();
        $('#customize-control-themes_customization-radio_about_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[our_team_enabledisable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our_team').fadeOut();
        $('#customize-control-themes_customization-our_team_enabledisable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our_team').fadeIn();
        $('#customize-control-themes_customization-our_team_enabledisable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio4_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#featured-update').fadeOut();
        $('#customize-control-themes_customization-radio4_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#featured-update').fadeIn();
        $('#customize-control-themes_customization-radio4_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_our_app_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our-app').fadeOut();
        $('#customize-control-themes_customization-radio_our_app_enable').nextAll().hide();
        $('#customize-controur_themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our-app').fadeIn();
        $('#customize-control-themes_customization-radio_our_app_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_active_articals_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#Active-articals').fadeOut();
        $('#customize-control-themes_customization-radio_active_articals_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#Active-articals').fadeIn();
        $('#customize-control-themes_customization-radio_active_articals_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_contact_partners_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#contact-partners').fadeOut();
        $('#customize-control-themes_customization-radio_contact_partners_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#contact-partners').fadeIn();
        $('#customize-control-themes_customization-radio_contact_partners_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_live_chat_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#live-chat-blog').fadeOut();
        $('#customize-control-themes_customization-radio_live_chat_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#live-chat-blog').fadeIn();
        $('#customize-control-themes_customization-radio_live_chat_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_our_faq_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our-faq').fadeOut();
        $('#customize-control-themes_customization-radio_our_faq_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our-faq').fadeIn();
        $('#customize-control-themes_customization-radio_our_faq_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_our_partners_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our_partners').fadeOut();
        $('#customize-control-themes_customization-radio_our_partners_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our_partners').fadeIn();
        $('#customize-control-themes_customization-radio_our_partners_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[services_enabledisable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#services').fadeOut();
        $('#customize-control-themes_customization-services_enabledisable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#services').fadeIn();
        $('#customize-control-themes_customization-services_enabledisable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_browse_topics_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#browse-topics').fadeOut();
        $('#customize-control-themes_customization-radio_browse_topics_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#browse-topics').fadeIn();
        $('#customize-control-themes_customization-radio_browse_topics_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_services_blog_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#services-blog').fadeOut();
        $('#customize-control-themes_customization-radio_services_blog_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#services-blog').fadeIn();
        $('#customize-control-themes_customization-radio_services_blog_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_interface_deg_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#interface-deg').fadeOut();
        $('#customize-control-themes_customization-radio_interface_deg_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#interface-deg').fadeIn();
        $('#customize-control-themes_customization-radio_interface_deg_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_introduction_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#introduction').fadeOut();
        $('#customize-control-themes_customization-radio_introduction_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#introduction').fadeIn();
        $('#customize-control-themes_customization-radio_introduction_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_best_seller_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#best-seller').fadeOut();
        $('#customize-control-themes_customization-radio_best_seller_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#best-seller').fadeIn();
        $('#customize-control-themes_customization-radio_best_seller_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[contact_us_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#connect_withus').fadeOut();
        $('#customize-control-themes_customization-contact_us_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#connect_withus').fadeIn();
        $('#customize-control-themes_customization-newsletter_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_category_products_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#category-products').fadeOut();
        $('#customize-control-themes_customization-radio_category_products_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#category-products').fadeIn();
        $('#customize-control-themes_customization-newsletter_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[newsletter_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#newsletter').fadeOut();
        $('#customize-control-themes_customization-newsletter_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#newsletter').fadeIn();
        $('#customize-control-themes_customization-newsletter_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_testimonial_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#testimonials').fadeOut();
        $('#customize-control-themes_customization-radio_testimonial_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#testimonials').fadeIn();
        $('#customize-control-themes_customization-radio_testimonial_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[video_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#video').fadeOut();
        $('#customize-control-themes_customization-video_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#video').fadeIn();
        $('#customize-control-themes_customization-video_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[pricing_plan_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#pricing-plan').fadeOut();
        $('#customize-control-themes_customization-pricing_plan_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#pricing-plan').fadeIn();
        $('#customize-control-themes_customization-pricing_plan_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[records_section_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our_records,#our-records').fadeOut();
        $('#customize-control-themes_customization-records_section_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our_records,#our-records').fadeIn();
        $('#customize-control-themes_customization-records_section_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_getstarted_blog_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#getstarted-blog').fadeOut();
        $('#customize-control-themes_customization-radio_getstarted_blog_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#getstarted-blog').fadeIn();
        $('#customize-control-themes_customization-radio_getstarted_blog_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_emergency_contact_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#emergency_contact').fadeOut();
        $('#customize-control-themes_customization-radio_emergency_contact_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#emergency_contact').fadeIn();
        $('#customize-control-themes_customization-radio_emergency_contact_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_search_banner_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#search-banner').fadeOut();
        $('#customize-control-themes_customization-radio_search_banner_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#search-banner').fadeIn();
        $('#customize-control-themes_customization-radio_search_banner_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[pricing_plan_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#pricing-plans').fadeOut();
        $('#customize-control-themes_customization-pricing_plan_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#pricing-plans').fadeIn();
        $('#customize-control-themes_customization-pricing_plan_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_features_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#our-feature,#our-features').fadeOut();
        $('#customize-control-themes_customization-radio_features_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#our-feature,#our-features').fadeIn();
        $('#customize-control-themes_customization-radio_features_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[latest_news_enabledisable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#latest-news').fadeOut();
        $('#customize-control-themes_customization-latest_news_enabledisable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#latest-news').fadeIn();
        $('#customize-control-themes_customization-latest_news_enabledisable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_get_in_touch_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#get-in-touch').fadeOut();
        $('#customize-control-themes_customization-radio_get_in_touch_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#get-in-touch').fadeIn();
        $('#customize-control-themes_customization-radio_get_in_touch_enable').nextAll().show();
      }
    });
  });  
   wp.customize( 'themes_customization[radio_why_choose_us_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#why-choose-us').fadeOut();
        $('#customize-control-themes_customization-radio_why_choose_us_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#why-choose-us').fadeIn();
        $('#customize-control-themes_customization-radio_why_choose_us_enable').nextAll().show();
      }
    });
  });
     wp.customize( 'themes_customization[radio_symptoms_us_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#symptons').fadeOut();
        $('#customize-control-themes_customization-radio_symptoms_us_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#symptons').fadeIn();
        $('#customize-control-themes_customization-radio_symptoms_us_enable').nextAll().show();
      }
    });
  });

  wp.customize( 'themes_customization[themes_header_section_logo_title_color]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('#header .header-logo a').css( 'color', '#f1f7ff' );
      } else {
        themes_find('#header .header-logo a').css( 'color', themes_settingsVal );
      }
    });
  });
  wp.customize( 'themes_customization[themes_header_section_logo_title_font_family]', function(value) {
    value.bind( function(themes_settingsVal) {
      console.log(themes_settingsVal);
      console.log("themes_find('#header .header-logo a')", themes_find('#header .header-logo a'));
      if ( themes_settingsVal == '' ) {
        themes_find('#header .header-logo a').css( 'font-family', 'No Font' );
      } else {
        themes_find('#header .header-logo a').css( 'font-family', themes_settingsVal );
      }
    });
  });
  wp.customize( 'themes_customization[themes_headermenu_color]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('.side-navigation a').css( 'color', '#f1f7ff' );
      } else {
        themes_find('.side-navigation a').css( 'color', themes_settingsVal );
      }
    });
  });

  wp.customize( 'themes_customization[themes_headermenu_color]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == '' ) {
        themes_find('.side-navigation a').css( 'color', '#f1f7ff' );
      } else {
        themes_find('.side-navigation a').css( 'color', themes_settingsVal );
      }
    });
  });
  wp.customize( 'themes_customization[radio_how_it_work_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#how-it-work').fadeOut();
        $('#customize-control-themes_customization-radio_how_it_work_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#how-it-work').fadeIn();
        $('#customize-control-themes_customization-radio_how_it_work_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[radio_timming_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('#timming').fadeOut();
        $('#customize-control-themes_customization-radio_radio_timming_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('#timming').fadeIn();
        $('#customize-control-themes_customization-radio_radio_timming_enable').nextAll().show();
      }
    });
  });
  wp.customize( 'themes_customization[themes_footer_section_enable]', function(value) {
    value.bind( function(themes_settingsVal) {
      if ( themes_settingsVal == true ) {
        themes_find('.copyright').fadeOut();
        $('#customize-control-themes_customization-themes_footer_section_enable').nextAll().hide();
        $('#customize-control-themes_customization-customize_login_page_title').show();
      } else {
        themes_find('.copyright').fadeIn();
        $('#customize-control-themes_customization-themes_footer_section_enable').nextAll().show();
      }
    });
  });
  /**
   * function for change ThemeSetting CSS in real time with !important...
   * @param  string setting  [Name of the setting]
   * @param  string target   [Targeted CSS class/ID]
   * @param  string property [CSS property]
   * @param  string suffix   [unit value]
   *
   * @return string          [CSS property in real time]
   * @since 1.4.6
   */
  function themes_css_property_imp( setting, target, property, suffix ) {
    // Update the login logo width in real time...
    wp.customize( setting, function( value ) {
      value.bind( function( themes_settingsVal ) {

        if ( themes_settingsVal == '' ) {
          themes_find( target ).css( property, '' );
        } else {
          themes_find( target )[0].style.setProperty(property , themes_settingsVal + suffix , 'important' );
        }
      } );
    } );
  }

  /**
   * @since 1.0.9
   * @version 1.0.12
   */
  window.addEventListener('load', function() { 
    if ( themes_script.autoFocusPanel ) { // Auto Focus on ThemeSetting Panel // 1.2.0
      wp.customize.panel("themes_panel").focus();
    }
  }, false);
  // $(window).on('load', function() {
   
  //   if ( themes_script.autoFocusPanel ) { // Auto Focus on ThemeSetting Panel // 1.2.0
  //     wp.customize.panel("themes_panel").focus();
  //   }

  // });

})(jQuery);

})(jQuery);
