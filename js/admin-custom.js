(function($) {
  'use strict';

  $( function() {

    /**
     * Install ThemeSetting Add-Ons on one click.
     * @since 1.2.2
     */
		$(document).on( 'change', '.themes-install-pro-addon', function (e) {

			e.preventDefault();
      e.stopPropagation();
      var addonBtn     = $(this);
      var addonWrapper = $(this).closest('.themes-extension');
			var nonce        = addonWrapper.find('input[name="themes_pro_addon_nonce"]').val();
			var pluginSlug   = addonWrapper.find('input[name="themes_pro_addon_slug"]').val();
			var pluginID     = addonWrapper.find('input[name="themes_pro_addon_id"]').val();

			$.ajax({
				type: 'GET',
				url : 'update.php',
				data: {
					action  : 'install-plugin',
					plugin  : pluginSlug,
					lgp     : 1,
					id      : pluginID,
					_wpnonce: nonce
        },
        beforeSend: function(){
          addonWrapper.find('.themes-addon-enable').show();
        },
				success: function (res) {
					activateAddon( pluginSlug, nonce, addonWrapper, addonBtn );
				},
				error  : function (res) {
					// console.log(res);
          addonWrapper.find('.themes-uninstalling').hide();
          addonWrapper.find('.themes-uninstall').hide();
          addonWrapper.find('.themes-addon-enable').hide();
          addonWrapper.find('.themes-wrong').show();
          setTimeout( function() {
            addonWrapper.find('.themes-wrong').hide();
          }, 2000);
				}
			});

    });

    /**
     * Deactivate ThemeSetting Add-Ons on one click.
     * @since 1.2.2
     */
    $(document).on( 'change', '.themes-uninstall-pro-addon', function (e) {

      e.preventDefault();
      e.stopPropagation();
      var addonBtn     = $(this);
      var addonWrapper = $(this).closest('.themes-extension');
      var nonce        = addonWrapper.find('input[name="themes_pro_addon_nonce"]').val();
      var pluginSlug   = addonWrapper.find('input[name="themes_pro_addon_slug"]').val();

      $.ajax({
        type: 'POST',
        url : ajaxurl,
        data: {
          action  : 'themes_deactivate_addon',
          slug    : pluginSlug,
          _wpnonce: nonce
        },
        beforeSend: function(){
          addonWrapper.find('.themes-uninstalling').show();
        },
        success: function (res) {
          var newNonce = res;

          addonWrapper.find('input[name="themes_pro_addon_nonce"]').val(newNonce);
          addonWrapper.find('.themes-uninstalling').hide();
          addonWrapper.find('.themes-uninstall').show();
          addonBtn.addClass('themes-active-pro-addon').removeClass('themes-install-pro-addon themes-uninstall-pro-addon').html('Activate Plugin');
          setTimeout( function() {
            addonWrapper.find('.themes-uninstall').hide();
          }, 3000);
        },
        error: function (res) {
          // console.log(res);
          addonWrapper.find('.themes-uninstalling').hide();
          addonWrapper.find('.themes-uninstall').hide();
          addonWrapper.find('.themes-wrong').show();
          setTimeout( function() {
            addonWrapper.find('.themes-wrong').hide();
          }, 2000);
        }
      });

    });

    /**
     * Activate ThemeSetting Add-Ons on one click.
     * @since 1.2.2
     */
		$(document).on( 'change', '.themes-active-pro-addon', function (e) {

			e.preventDefault();
			e.stopPropagation();
      var addonBtn     = $(this);
      var addonWrapper = $(this).closest('.themes-extension');
      var nonce        = addonWrapper.find('input[name="themes_pro_addon_nonce"]').val();
			var pluginSlug   = addonWrapper.find('input[name="themes_pro_addon_slug"]').val();

      activateAddon( pluginSlug, nonce, addonWrapper, addonBtn );

		});

    /**
     * Activate ThemeSetting Add-Ons.
     * @param  string pluginSlug
     * @param  string nonce
     * @param  string addonWrapper
     * @param  string addonBtn
     * @since 1.2.2
     */
		function activateAddon( pluginSlug, nonce, addonWrapper, addonBtn ) {

			$.ajax({
				url : ajaxurl,
				type: 'POST',
				data: {
					slug  : pluginSlug,
          action: 'themes_activate_addon',
          _wpnonce: nonce
				},
        beforeSend: function(){
          addonWrapper.find('.themes-addon-enable').show();
        },
        success: function (res) {
          var newNonce = res;

          addonWrapper.find('.themes-addon-enable').hide();
          addonWrapper.find('.themes-install').show();
          addonBtn.addClass('themes-uninstall-pro-addon').removeClass('themes-install-pro-addon themes-active-pro-addon').html('Uninstall');
          addonWrapper.find('input[name="themes_pro_addon_nonce"]').val(newNonce);

          setTimeout( function() {
            addonWrapper.find('.themes-install').hide();
          }, 3000);
				},
				error  : function ( xhr, textStatus, errorThrown ) {
					// console.log('Ajax Not Working');
          addonWrapper.find('.themes-uninstalling').hide();
          addonWrapper.find('.themes-uninstall').hide();
          addonWrapper.find('.themes-wrong').show();
          setTimeout( function() {
            addonWrapper.find('.themes-wrong').hide();
          }, 2000);
				}
			});

		}

    // Code to fire when the DOM is ready.
    $('.vwthemes-video-link').on( 'click', function(e) {
      e.preventDefault();
      var target = $(this).data('video-id');
      $( '#' + target ).fadeIn();
    } );
    $('.vwthemes-close-popup').on('click', function(e) {
      $(this).parent().parent().fadeOut();
      $('.vwthemes-video-wrapper iframe').attr( 'src', 'https://www.youtube.com/embed/GMAwsHomJlE' );
    });

    // $("#wpb-themes_setting\\[enable_repatcha_promo\\]").on('click', function() {
    //
    //   var promotion = $('#wpb-themes_setting\\[enable_repatcha_promo\\]');
    //   if ( promotion.is(":checked") ) {
    //     $('tr.recapthca-promo-img').show();
    //   } else {
    //     $('tr.recapthca-promo-img').hide();
    //   }
    // }); // on click promo checkbox.

    // Remove Disabled attribute from Import Button.
    $('#themes_settingsImport').on('change', function(event) {

      event.preventDefault();
      var themesFileImp = $('#themes_settingsImport').val();
      var themesFileExt = themesFileImp.substr(
        themesFileImp.lastIndexOf('.') + 1);

      $('.themes-import').attr( "disabled", "disabled" );

      if ( 'json' == themesFileExt ) {
        $(".import_setting .wrong-import").html("");
        $('.themes-import').removeAttr("disabled");
      } else {
        $(".import_setting .wrong-import").html(
          "Choose ThemeSetting settings file only.");
      }
    });

    $("#wpb-themes_setting\\[enable_privacy_policy\\]").on( 'click', function() {

        var privacy_editor = $(
          '#wpb-themes_setting\\[enable_privacy_policy\\]');
        if (privacy_editor.is(":checked")) {
          $('tr.privacy_policy').show();
        } else {
          $('tr.privacy_policy').hide();
        }
      }); // on click promo checkbox.

    $(window).on('load', function() {

      $( '<tr class="recapthca-promo-img"><th class="recapthca-promo" colspan="2"><img src="' + themes_script.plugin_url + '/themes/img/promo/recaptcha_promo.png"><a class="recapthca-promo-link" href="https://vwthemes.com/wordpress/plugins/themes-pro/?utm_source=themes-lite&amp;utm_medium=recaptcha-settings&amp;utm_campaign=pro-upgrade" target="_blank"><span>Unlock Premium Feature</span></a></th></tr>' ).insertAfter($(".enable_repatcha_promo").closest('tr'));

      var promotion = $(
        '#wpb-themes_setting\\[enable_repatcha_promo\\]');
      if (promotion.is(":checked")) {
        $('tr.recapthca-promo-img').show();
      }

      var privacy_editor = $(
        '#wpb-themes_setting\\[enable_privacy_policy\\]');
      if (privacy_editor.is(":checked")) {
        $('tr.privacy_policy').show();
      }

    }); // Window on load.

    $('.themes-log-file').on('click', function(event) {

      event.preventDefault();

      $.ajax({

        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'themes_help',
        },
        beforeSend: function() {
          $(".log-file-sniper").show();
        },
        success: function(response) {

          $(".log-file-sniper").hide();
          $(".log-file-text").show();

          if (!window.navigator.msSaveOrOpenBlob) { // If msSaveOrOpenBlob() is supported, then so is msSaveBlob().
            $("<a />", {
                "download": "themes-log.txt",
                "href": "data:text/plain;charset=utf-8," +
                  encodeURIComponent(response),
              }).appendTo("body")
              .click(function() {
                $(this).remove()
              })[0].click()
          } else {
            var blobObject = new Blob([response]);
            window.navigator.msSaveBlob(blobObject,
              'themes-log.txt');
          }

          setTimeout(function() {
            $(".log-file-text").fadeOut()
          }, 3000);
        }
      });

    });

    $('.themes-export').on('click', function(event) {

      event.preventDefault();

      var dateObj = new Date();
      var month = dateObj.getUTCMonth() + 1; //months from 1-12
      var day = dateObj.getUTCDate();
      var year = dateObj.getUTCFullYear();
      var newdate = year + "-" + month + "-" + day;
      var export_nonce = $('.themes_export_nonce').val();

      $.ajax({

        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'themes_export',
          security: export_nonce,
        },
        beforeSend: function() {
          $(".export_setting .export-sniper").show();
        },
        success: function(response) {

          $(".export_setting .export-sniper").hide();
          $(".export_setting .export-text").show();

          if (!window.navigator.msSaveOrOpenBlob) { // If msSaveOrOpenBlob() is supported, then so is msSaveBlob().
            $("<a />", {
                "download": "themes-export-" + newdate +
                  ".json",
                "href": "data:application/json;charset=utf-8," +
                  encodeURIComponent(response),
              }).appendTo("body")
              .click(function() {
                $(this).remove()
              })[0].click()
          } else {
            var blobObject = new Blob([response]);
            window.navigator.msSaveBlob(blobObject,
              "themes-export-" + newdate + ".json");
          }

          setTimeout(function() {
            $(".export_setting .export-text").fadeOut()
          }, 3000);
        }
      });
    });

    $('.themes-import').on('click', function(event) {
      event.preventDefault();

      var file = $('#themes_settingsImport');
      var import_nonce = $('.themes_import_nonce').val();
      var fileObj = new FormData();
      var content = file[0].files[0];

      fileObj.append('file', content);
      fileObj.append('action', 'themes_import');
      fileObj.append('security', import_nonce);

      $.ajax({

        processData: false,
        contentType: false,
        url: ajaxurl,
        type: 'POST',
        data: fileObj, // file and action append into variable fileObj.
        beforeSend: function() {
          $(".import_setting .import-sniper").show();
          $(".import_setting .wrong-import").html("");
          $('.themes-import').attr("disabled", "disabled");
        },
        success: function(response) {
          // console.log(response);
          $(".import_setting .import-sniper").hide();
          // $(".import_setting .import-text").fadeIn();
          if ('error' == response) {
            $(".import_setting .wrong-import").html(
              "JSON File is not Valid.");
          } else {
            $(".import_setting .import-text").show();
            setTimeout(function() {
              $(".import_setting .import-text").fadeOut();
              // $(".import_setting .wrong-import").html("");
              file.val('');
            }, 3000);
          }

        }
      }); //!ajax.
    });

  });
})(jQuery); // This invokes the function above and allows us to use '$' in place of 'jQuery' in our code.
