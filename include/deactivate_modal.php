<?php
/**
 * ThemeSetting deactivation Content.
 * @package ThemeSetting
 * @version 1.1.14
 */

$themes_deactivate_nonce = wp_create_nonce( 'themes-deactivate-nonce' ); ?>
<style>
    .themes-hidden{

      overflow: hidden;
    }
    .themes-popup-overlay .themes-internal-message{
      margin: 3px 0 3px 22px;
      display: none;
    }
    .themes-reason-input{
      margin: 3px 0 3px 22px;
      display: none;
    }
    .themes-reason-input input[type="text"]{

      width: 100%;
      display: block;
    }
  .themes-popup-overlay{

    background: rgba(0,0,0, .8);
    position: fixed;
    top:0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1000;
    overflow: auto;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .themes-popup-overlay.themes-active{
    opacity: 1;
    visibility: visible;
  }
  .themes-serveypanel{
    width: 600px;
    background: #fff;
    margin: 0 auto 0;
    border-radius: 3px;
  }
  .themes-popup-header{
    background: #f1f1f1;
    padding: 20px;
    border-bottom: 1px solid #ccc;
  }
  .themes-popup-header h2{
    margin: 0;
    text-transform: uppercase;
  }
  .themes-popup-body{
      padding: 10px 20px;
  }
  .themes-popup-footer{
    background: #f9f3f3;
    padding: 10px 20px;
    border-top: 1px solid #ccc;
  }
  .themes-popup-footer:after{

    content:"";
    display: table;
    clear: both;
  }
  .action-btns{
    float: right;
  }
  .themes-anonymous{

    display: none;
  }
  .attention, .error-message {
    color: red;
    font-weight: 600;
    display: none;
  }
  .themes-spinner{
    display: none;
  }
  .themes-spinner img{
    margin-top: 3px;
  }
  .themes-pro-message{
    padding-left: 24px;
    color: red;
    font-weight: 600;
    display: none;
  }
  .themes-popup-header{
    background: none;
        padding: 18px 15px;
    -webkit-box-shadow: 0 0 8px rgba(0,0,0,.1);
    box-shadow: 0 0 8px rgba(0,0,0,.1);
    border: 0;
}
.themes-popup-body h3{
    margin-top: 0;
    margin-bottom: 30px;
        font-weight: 700;
    font-size: 15px;
    color: #495157;
    line-height: 1.4;
    text-tranform: uppercase;
}
.themes-reason{
    font-size: 13px;
    color: #6d7882;
    margin-bottom: 15px;
}
.themes-reason input[type="radio"]{
margin-right: 15px;
}
.themes-popup-body{
padding: 30px 30px 0;

}
.themes-popup-footer{
background: none;
    border: 0;
    padding: 29px 39px 39px;
}
</style>
<div class="themes-popup-overlay">
  <div class="themes-serveypanel">
    <form action="#" method="post" id="themes-deactivate-form">
    <div class="themes-popup-header">
      <h2><?php _e( 'Quick feedback about ThemeSetting', 'themes' ); ?></h2>
    </div>
    <div class="themes-popup-body">
      <h3><?php _e( 'If you have a moment, please let us know why you are deactivating:', 'themes' ); ?></h3>
      <input type="hidden" class="themes_deactivate_nonce" name="themes_deactivate_nonce" value="<?php echo $themes_deactivate_nonce; ?>">
      <ul id="themes-reason-list">
        <li class="themes-reason themes-reason-pro" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="pro">
            </span>
            <span><?php _e( " I upgraded to ThemeSetting Pro", 'themes' ); ?></span>
          </label>
          <div class="themes-pro-message"><?php _e( 'No need to deactivate this ThemeSetting Core version. Pro version works as an add-on with Core version.', 'themes' ); ?></div>
        </li>
        <li class="themes-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="1">
            </span>
            <span><?php _e( 'I only needed the plugin for a short period', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
        </li>
        <li class="themes-reason has-input" data-input-type="textfield">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="2">
            </span>
            <span><?php _e( 'I found a better plugin', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
          <div class="themes-reason-input"><span class="message error-message "><?php _e( 'Kindly tell us the Plugin name.', 'themes' ); ?></span><input type="text" name="better_plugin" placeholder="What's the plugin's name?"></div>
        </li>
        <li class="themes-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="3">
            </span>
            <span><?php _e( 'The plugin broke my site', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
        </li>
        <li class="themes-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="4">
            </span>
            <span><?php _e( 'The plugin suddenly stopped working', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
        </li>
        <li class="themes-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="5">
            </span>
            <span><?php _e( 'I no longer need the plugin', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
        </li>
        <li class="themes-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="6">
            </span>
            <span><?php _e( "It's a temporary deactivation. I'm just debugging an issue.", 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
        </li>
        <li class="themes-reason has-input" data-input-type="textfield" >
          <label>
            <span>
              <input type="radio" name="themes-selected-reason" value="7">
            </span>
            <span><?php _e( 'Other', 'themes' ); ?></span>
          </label>
          <div class="themes-internal-message"></div>
          <div class="themes-reason-input"><span class="message error-message "><?php _e( 'Kindly tell us the reason so we can improve.', 'themes' ); ?></span><input type="text" name="other_reason" placeholder="Kindly tell us the reason so we can improve."></div>
        </li>
      </ul>
    </div>
    <div class="themes-popup-footer">
      <label class="themes-anonymous"><input type="checkbox" /><?php _e( 'Anonymous feedback', 'themes' ); ?></label>
        <input type="button" class="button button-secondary button-skip themes-popup-skip-feedback" value="<?php _e( 'Skip & Deactivate', 'themes'); ?>" >
      <div class="action-btns">
        <span class="themes-spinner"><img src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt=""></span>
        <input type="submit" class="button button-secondary button-deactivate themes-popup-allow-deactivate" value="<?php _e( 'Submit & Deactivate', 'themes'); ?>" disabled="disabled">
        <a href="#" class="button button-primary themes-popup-button-close"><?php _e( 'Cancel', 'themes' ); ?></a>

      </div>
    </div>
  </form>
    </div>
  </div>


  <script>
    (function( $ ) {

      $(function() {

        var pluginSlug = 'themes';
        // Code to fire when the DOM is ready.

        $(document).on('click', 'tr[data-slug="' + pluginSlug + '"] .deactivate', function(e){
          e.preventDefault();
          $('.themes-popup-overlay').addClass('themes-active');
          $('body').addClass('themes-hidden');
        });
        $(document).on('click', '.themes-popup-button-close', function () {
          close_popup();
        });
        $(document).on('click', ".themes-serveypanel,tr[data-slug='" + pluginSlug + "'] .deactivate",function(e){
            e.stopPropagation();
        });

        $(document).click(function(){
          close_popup();
        });
        $('.themes-reason label').on('click', function(){
          if($(this).find('input[type="radio"]').is(':checked')){
            //$('.themes-anonymous').show();
            $(this).next().next('.themes-reason-input').show().end().end().parent().siblings().find('.themes-reason-input').hide();
          }
        });
        $('input[type="radio"][name="themes-selected-reason"]').on('click', function(event) {
          $(".themes-popup-allow-deactivate").removeAttr('disabled');
          $(".themes-popup-skip-feedback").removeAttr('disabled');
          $('.message.error-message').hide();
          $('.themes-pro-message').hide();
        });

        $('.themes-reason-pro label').on('click', function(){
          if($(this).find('input[type="radio"]').is(':checked')){
            $(this).next('.themes-pro-message').show().end().end().parent().siblings().find('.themes-reason-input').hide();
            $(this).next('.themes-pro-message').show()
            $('.themes-popup-allow-deactivate').attr('disabled', 'disabled');
            $('.themes-popup-skip-feedback').attr('disabled', 'disabled');
          }
        });
        $(document).on('submit', '#themes-deactivate-form', function(event) {
          event.preventDefault();

          var _reason =  $('input[type="radio"][name="themes-selected-reason"]:checked').val();
          var _reason_details = '';

          var deactivate_nonce = $('.themes_deactivate_nonce').val();

          if ( _reason == 2 ) {
            _reason_details = $("input[type='text'][name='better_plugin']").val();
          } else if ( _reason == 7 ) {
            _reason_details = $("input[type='text'][name='other_reason']").val();
          }

          if ( ( _reason == 7 || _reason == 2 ) && _reason_details == '' ) {
            $('.message.error-message').show();
            return ;
          }
          $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
              action        : 'themes_deactivate',
              reason        : _reason,
              reason_detail : _reason_details,
              security      : deactivate_nonce
            },
            beforeSend: function(){
              $(".themes-spinner").show();
              $(".themes-popup-allow-deactivate").attr("disabled", "disabled");
            }
          })
          .done(function() {
            $(".themes-spinner").hide();
            $(".themes-popup-allow-deactivate").removeAttr("disabled");
            window.location.href =  $("tr[data-slug='"+ pluginSlug +"'] .deactivate a").attr('href');
          });

        });

        $('.themes-popup-skip-feedback').on('click', function(e){
          // e.preventDefault();
          window.location.href =  $("tr[data-slug='"+ pluginSlug +"'] .deactivate a").attr('href');
        })

        function close_popup() {
          $('.themes-popup-overlay').removeClass('themes-active');
          $('#themes-deactivate-form').trigger("reset");
          $(".themes-popup-allow-deactivate").attr('disabled', 'disabled');
          $(".themes-reason-input").hide();
          $('body').removeClass('themes-hidden');
          $('.message.error-message').hide();
          $('.themes-pro-message').hide();
        }
        });

        })( jQuery ); // This invokes the function above and allows us to use '$' in place of 'jQuery' in our code.
  </script>
