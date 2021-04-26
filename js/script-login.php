<?php

/**
 * script-login.php is created for adding JS code in login page footer.
 * @since 1.2.2
 * @version 1.2.3
 */

function themes_custom_js( $themes_key ) {

  $themes_array  = (array) get_option( 'themes_customization' );
	if ( array_key_exists( $themes_key, $themes_array ) ) {

		if ( 'themes_custom_js' == $themes_key ) {
			return $themes_array[ $themes_key ];
		}

	}
}

$themes_setting   = get_option( 'themes_setting' );
$themes_autorm    = isset( $themes_setting['auto_remember_me'] ) ? $themes_setting['auto_remember_me'] : 'off';
$themes_capslock  = __( 'Caps Lock is on', 'themes' );
$themes_custom_js = themes_custom_js( 'themes_custom_js' );

if ( ! empty( $themes_custom_js ) ) : ?>
  <script>
    <?php echo $themes_custom_js; ?>
  </script>
<?php endif; ?>

<script>

document.addEventListener( 'DOMContentLoaded', function() {
    if (navigator.userAgent.indexOf("Firefox") != -1) {
      var body = document.body;
      body.classList.add("firefox");
    }
    // your code goes here
    if ( document.getElementById('user_pass') ) {
      var themes_user_pass = document.getElementById('user_pass');
      var themes_wrapper   = document.createElement('div');
      themes_wrapper.classList.add('user-pass-fields');
      // insert wrapper before el in the DOM tree
      user_pass.parentNode.insertBefore(themes_wrapper, themes_user_pass);

      // move el into wrapper
      themes_wrapper.appendChild(themes_user_pass);
      var themes_user_ps  = document.getElementsByClassName('user-pass-fields');
      var themes_node     = document.createElement("div");
      themes_node.classList.add('themes-caps-lock');
      var themes_textnode = document.createTextNode('<?php echo $themes_capslock; ?>');
      themes_node.appendChild(themes_textnode);
      themes_user_ps[0].appendChild(themes_node);
    }

  }, false );
  window.onload = function(e) {

    var capsLock      = 'off';
    var passwordField = document.getElementById("user_pass");
    if ( passwordField ) {
      passwordField.onkeydown = function(e) {
        var el   = this;
        var caps = event.getModifierState && event.getModifierState( 'CapsLock' );
        if ( caps ) {

          capsLock = 'on';
          el.nextElementSibling.style.display = "block";
        } else {

          capsLock = 'off';
          el.nextElementSibling.style.display = "none";
        }
      };

      passwordField.onblur = function(e) {

        var el = this;
        el.nextElementSibling.style.display = "none";
      };

      passwordField.onfocus = function(e) {

        var el = this;
        if ( capsLock == 'on' ) {

          el.nextElementSibling.style.display = "block";
        }else{

          el.nextElementSibling.style.display = "none";
        }
      };
    }


    // if ( document.getElementById("loginform") ) {
    //   document.getElementById("loginform").addEventListener( "submit", _Themes_SettingFormSubmitLoader );
    // }
    // if ( document.getElementById("registerform") ) {
    //   document.getElementById("registerform").addEventListener( "submit", _Themes_SettingFormSubmitLoader );
    // }
    // if ( document.getElementById("lostpasswordform") ) {
    //   document.getElementById("lostpasswordform").addEventListener( "submit", _Themes_SettingFormSubmitLoader );
    // }


    function _Themes_SettingFormSubmitLoader() {

      var subButton = document.getElementsByClassName("submit");
      var myButton  = document.getElementById("wp-submit");
      var image     = document.createElement("img");

      myButton.setAttribute('disabled', 'disabled');
      image.setAttribute( "src", "<?php echo admin_url( 'images/loading.gif' ); ?>" );
      image.setAttribute( "width", "20" );
      image.setAttribute( "height", "20" );
      image.setAttribute( "alt", "Login Loader" );
      image.setAttribute( "style", "display: block;margin: 0 auto;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" );
      subButton[0].appendChild(image);
    }

  };

  <?php if ( 'off' != $themes_autorm ) : ?>
      var _Themes_SettingRMChecked = document.getElementById("rememberme");
      if ( null != _Themes_SettingRMChecked ) {
        _Themes_SettingRMChecked.checked = true;
      }
  <?php endif; ?>
</script>
