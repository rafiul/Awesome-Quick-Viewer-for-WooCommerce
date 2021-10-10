<?php
/**
 * Customizer Control: awqv-upsell.
 *
 * @package     Awqv 
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Upsell control
 */
class Awqv_Customizer_Upsell_Section_Control extends WP_Customize_Section {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'awqv-upsell';
	public $url  = '';
	public $id = '';

	/**
	 * JSON.
	 */
	public function json() {
		$json 			= parent::json();
		$json['url'] 	= esc_url( $this->url );
		$json['id'] 	= $this->id;
		return $json;
	}

	/**
	 * Render template
	 *
	 * @access protected
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3>
				<a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a>
			</h3>
		</li>
		<?php
	}
	
}


/**
 * Enqueue control related scripts/styles.
 *
 * @access public
 */
function awqv_upsell_enqueue() {
	$controller_path = AWQV_PATH . '/includes/customizers/cutomizer-controls/controls';
	wp_enqueue_script( 'awqv-upsell', $controller_path . '/upsell-control/upsell.js', array( 'customize-controls' ), false, true );
	wp_enqueue_style( 'awqv-upsell', $controller_path . '/upsell-control/upsell.css', null );
}
add_action( 'customize_controls_enqueue_scripts', 'awqv_upsell_enqueue' );