<?php
/**
* Class for Radio Button Control.
*
* @since  1.0.23
* @access public
* @version 1.1.7
*/
class Themes_Setting_Radio_Control extends WP_Customize_Control {

	/**
	* The type of customize control being rendered.
	*
	* @since  1.0.23
	* @access public
	* @var    string
	*/
	public $type = 'ios';

	/**
	* The loader of customize control being rendered.
	*
	* @since  1.1.7
	* @access public
	* @var    bolean
	*/
	public $loader = false;

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0.23
   * @access public
   * @return void
	 */
	public function enqueue() {

		wp_enqueue_script( 'themes-radio-control-js', CUSTOM_DIR_URL . 'js/controls/themes-radio-button-control.js', array( 'jquery' ), CUSTOM_VERSION, true );
		wp_enqueue_style( 'themes-radio-control-css', CUSTOM_DIR_URL . 'css/controls/themes-radio-button-control.css', array(), CUSTOM_VERSION );

		$css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].themes-radio-light:checked + .themes-radio-btn {
				background: #0085ba;
			}
			input[type=checkbox].themes-radio-light + .themes-radio-btn {
			  background: #a0a5aa;
			}
			input[type=checkbox].themes-radio-light + .themes-radio-btn:after {
			  background: #f7f7f7;
			}

			input[type=checkbox].themes-radio-ios:checked + .themes-radio-btn {
			  background: #0085ba;
			}

			input[type=checkbox].themes-radio-flat:checked + .themes-radio-btn {
			  border: 4px solid #0085ba;
			}
			input[type=checkbox].themes-radio-flat:checked + .themes-radio-btn:after {
			  background: #0085ba;
			}
			';
		wp_add_inline_style( 'themes-radio-control-css' , $css );
	}

	/**
  * Displays the control content.
  *
  * @since  1.0.23
  * @access public
  * @return void
  * @version 1.1.7
  */
	public function render_content() {
		?>
		<label>
			<div style="display:flex;flex-direction: row;justify-content: flex-start;">
				<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( true == $this->loader ) : ?><span class="customize-radio-control-loader"><img src="<?php echo admin_url( 'images/loading.gif' ); ?>" alt="loader"></span><?php endif; ?>
				<input id="cb<?php echo $this->instance_number ?>" type="checkbox" class="themes-radio themes-radio-<?php echo $this->type?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
				<label for="cb<?php echo $this->instance_number ?>" class="themes-radio-btn"></label>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}
/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'themes_switch_sanitization' ) ) {
		function themes_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}