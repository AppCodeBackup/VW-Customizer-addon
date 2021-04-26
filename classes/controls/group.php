<?php

/**
* Class for Group.
*
* @since  1.1.3
* @access public
*/
class Themes_Setting_Group_Control extends WP_Customize_Control {

  /**
  * The type of customize control being rendered.
  *
  * @since  1.1.3
  * @access public
  * @var    string
  */
  public $type = 'group';

  /**
  * Information text for the Group.
  *
  * @since  1.1.3
  * @access public
  * @var    string
  */
  public $info_text;

  /**
  * Enqueue scripts/styles.
  *
  * @since  1.0.17
  * @access public
  * @return void
  */
  public function enqueue() {
		wp_enqueue_style( 'themes-group-control-css', CUSTOM_DIR_URL . 'css/controls/themes-group-control.css', array(), CUSTOM_VERSION );
  }

  /**
  * Displays the control content.
  *
  * @since  1.0.17
  * @access public
  * @return void
  */
  public function render_content() {
    ?>

    <div id="input_<?php echo $this->id; ?>" class="themes-group-wrapper">
      <h3 class="themes-group-heading"><?php echo esc_attr( $this->label ); ?></h3>
      <div class="themes-group-info">
        <p><span class="themes-group-badge badges"><?php esc_html_e( 'Info:', 'themes' ) ?></span><?php echo esc_html( $this->info_text ); ?></p>
      </div>
    </div>


  <?php }


}
?>
