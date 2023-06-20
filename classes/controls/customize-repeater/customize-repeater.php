<?php
/**
 * Alpha Color Picker.
 * @package VW Software Company Pro
 */
if ( ! class_exists( 'WP_Customize_Control' ) ){
	return;
}

/**
 * Sortable Repeater Custom Control
 *
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @link https://github.com/maddisondesigns
 */
class themes_Repeater_Custom_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'sortable_repeater';
	/**
		 * Button labels
		 */
	public $button_labels = array();
	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
		// Merge the passed button labels with our default labels
		$this->button_labels = wp_parse_args( $this->button_labels,
			array(
				'add' => __( 'Add', 'themes' ),
			)
		);
	}
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_style( 'themes_custom_controls_css', CUSTOM_DIR_URL . 'classes/controls/customize-repeater/css/customize-repeater.css', array(), '' ); 
	    wp_enqueue_script( 'themes_custom_controls_js', CUSTOM_DIR_URL . 'classes/controls/customize-repeater/js/customize-repeater.js', array( 'jquery'),'');
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		$section_name = (array) get_option( 'themes_customization' );
		if ( isset( $section_name['section_ordering_settings_repeater'] ) ) {
			$string_array = rtrim(implode(',', $section_name), ',');
		}
		
	?>
	    <div class="sortable_repeater_control">
			<?php if( !empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } ?>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $string_array ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
			<div class="sortable">
				<div class="repeater">
					<input type="text" value="" class="repeater-input" placeholder="" disabled="disabled" /><span class="dashicons dashicons-sort"></span>
				</div>
			</div>
		</div>
	<?php
	}
}