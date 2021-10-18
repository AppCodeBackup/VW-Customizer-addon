<?php
/**
 * ThemeSetting optout Content.
 * @package ThemeSetting
 * @version 1.1.14
 */

$themes_optout_nonce = wp_create_nonce('themes-optout-nonce');
?>
<style media="screen">
.themes-modal.active {
  display: block;
}
.themes-modal {
    position: fixed;
    overflow: auto;
    height: 100%;
    width: 100%;
    top: 0;
    z-index: 100000;
    display: none;
    background: rgba(0,0,0,0.6);
}
.themes-modal.active .themes-modal-dialog {
    top: 10%;
}
.themes-modal .themes-modal-dialog {
    background: transparent;
    position: absolute;
    left: 50%;
    margin-left: -298px;
    padding-bottom: 30px;
    top: -100%;
    z-index: 100001;
    width: 596px;
}
.themes-modal .themes-modal-header {
    border-bottom: #eeeeee solid 1px;
    background: #fbfbfb;
    padding: 15px 20px;
    position: relative;
    margin-bottom: -10px;
}
.themes-modal .themes-modal-body {
    border-bottom: 0;
}
.themes-modal .themes-modal-body, .themes-modal .themes-modal-footer {
    border: 0;
    background: #fefefe;
    padding: 20px;
}
.themes-modal .themes-modal-body>div {
    margin-top: 10px;
}
.themes-modal .themes-modal-body>div h2 {
    font-weight: bold;
    font-size: 20px;
    margin-top: 0;
}
.themes-modal .themes-modal-body p {
    font-size: 14px;
}
.themes-modal .themes-modal-footer {
    border-top: #eeeeee solid 1px;
    text-align: right;
}
.themes-modal .themes-modal-footer>.button:first-child {
    margin: 0;
}
.themes-modal .themes-modal-footer>.button {
    margin: 0 7px;
}
.themes-modal .themes-modal-body>div h2 {
    font-weight: bold;
    font-size: 20px;
    margin-top: 0;
}
.themes-modal .themes-modal-body h2 {
    font-size: 20px;
     line-height: 1.5em;
}
.themes-modal .themes-modal-header h4 {
    margin: 0;
    padding: 0;
    text-transform: uppercase;
    font-size: 1.2em;
    font-weight: bold;
    color: #cacaca;
    text-shadow: 1px 1px 1px #fff;
    letter-spacing: 0.6px;
    -webkit-font-smoothing: antialiased;
}

.themes-optout-spinner{
    display: none;
}
</style>


<div class="themes-modal themes-modal-opt-out">
  <div class="themes-modal-dialog">
    <div class="themes-modal-header">
      <h4><?php _e( 'Opt Out', 'themes' ); ?></h4>
    </div>
    <div class="themes-modal-body">
      <div class="themes-modal-panel active">
        <input type="hidden" class="themes_optout_nonce" name="themes_optout_nonce" value="<?php echo $themes_optout_nonce; ?>">
        <h2><?php _e( 'We appreciate your help in making the plugin better by letting us track some usage data.', 'themes' ); ?></h2>
        <div class="notice notice-error inline opt-out-error-message" style="display: none;">
          <p></p>
        </div>
        <p><?php echo sprintf( __( 'Usage tracking is done in the name of making %1$s ThemeSetting %2$s better. Making a better user experience, prioritizing new features, and more good things. We\'d really appreciate if you\'ll reconsider letting us continue with the tracking.', 'themes' ), '<strong>', '</strong>') ?></p>
        <p><?php echo sprintf( __( 'By clicking "Opt Out", we will no longer be sending any data to %1$s ThemeSetting%2$s.', 'themes' ), '<a href="https://vwthemes.com" target="_blank">', '</a>' ); ?></p>
      </div>
    </div>
    <div class="themes-modal-footer">
      <form class="" action="<?php echo admin_url( 'plugins.php' ) ?>" method="post">
        <span class="themes-optout-spinner"><img src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt=""></span>
        <button type='submit' name='themes-submit-optout' id='themes_optout_button'  class="button button-secondary button-opt-out" tabindex="1"><?php _e( 'Opt Out', 'themes' ) ?></button>
        <button class="button button-primary button-close" tabindex="2"><?php _e( 'On second thought - I want to continue helping', 'themes' ); ?></button>
      </form>
    </div>
  </div>
</div>



<script type="text/javascript">

(function( $ ) {

  $(function() {
    var pluginSlug = 'themes';
    var optout_nonce = $('.themes_optout_nonce').val();
    // Code to fire when the DOM is ready.

    $(document).on('click', 'tr[data-slug="' + pluginSlug + '"] .opt-out', function(e){
        e.preventDefault();
        $('.themes-modal-opt-out').addClass('active');
    });

    $(document).on('click', '.button-close', function(event) {
      event.preventDefault();
      $('.themes-modal-opt-out').removeClass('active');
    });

    $(document).on('click','#themes_optout_button', function(event) {
      event.preventDefault();
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action    : 'themes_optout_yes',
          security  : optout_nonce,
        },
        beforeSend: function(){
          $(".themes-optout-spinner").show();
          $(".themes-popup-allow-deactivate").attr("disabled", "disabled");
        }
      })
      .done(function() {
        $(".themes-optout-spinner").hide();
        $('.themes-modal-opt-out').removeClass('active');
        location.reload();
      });

    });

  });

})( jQuery ); // This invokes the function above and allows us to use '$' in place of 'jQuery' in our code.
</script>
