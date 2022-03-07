<?php
/**
* Class for Radio Button Control.
*
* @since  1.0.23
* @access public
*/
class Themes_Setting_Misc_Control extends WP_Customize_Control {

	/**
	* The type of customize control being rendered.
	*
	* @since  1.0.23
	* @access public
	* @var    string
	*/
	public $type = '';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0.23
   * @access public
   * @return void
	 */
	public function enqueue() {

		// wp_enqueue_script( 'themes-miscellaneous-control-js', CUSTOM_DIR_URL . 'js/controls/themes-miscellaneous-control.js', array( 'jquery' ), CUSTOM_VERSION, true );
		// wp_enqueue_style( 'themes-miscellaneous-control-css', CUSTOM_DIR_URL . 'css/controls/themes-miscellaneous-control.css', array(), CUSTOM_VERSION );

	}

	/**
  * Displays the control content.
  *
  * @since  1.0.23
  * @access public
  * @return void
  */
	public function render_content() {

		switch ( $this->type ) {
            default:

            case 'hr' :
                echo '<hr />';
                break;
        }
	}
}
