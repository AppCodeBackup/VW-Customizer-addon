<?php
	
	/**
	 * Toggle Switch Custom Control
	 *
	 *  */


	class themes_Slider_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
		<?php
		}
	}

	function themes_slider_line_script() {

		wp_enqueue_style( 'custom-toggle-swtch', CUSTOM_DIR_URL . 'classes/controls/slider-line-control/slider-line-control.css', array(), '' ); 
	    wp_enqueue_script( 'custom-toggle-swtch-js', CUSTOM_DIR_URL . 'classes/controls/slider-line-control/slider-line-control.js', array( 'jquery'),'');
	    
	}
	add_action( 'customize_controls_enqueue_scripts', 'themes_slider_line_script' );

?>