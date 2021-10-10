<?php
/**
 * Plugin Name: Awesome Quick Viewer for WooCommerce Lite
 * Plugin URI: https://themesbyte.com/qiuck-viewer
 * Description: Quick view WooCommerce product.
 * Version: 1.0
 * Author: ThemesByte
 * Author URI: https://themesbyte.com
 * Requires at least: 5.2
 * Tested up to: 5.5
 * Requires PHP: 7.0
 * Text Domain: awqv
 * Domain Path: /languages/
 * License: GPL2+
 *
 * @package awesome_quick_viwer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_activation_hook(__FILE__, function(){
	$lite = plugin_basename( __FILE__ );
	if( is_plugin_inactive($lite) ){
		add_action('update_option_active_plugins', function($lite){
			deactivate_plugins('awesome-woo-quick-viewer-pro/init.php');
		});
		 set_transient( 'awqv-thankyou-notice', true, 5 );
	}
});

add_action( 'admin_notices', 'awqv_lite_thankyou_notice' );
function awqv_lite_thankyou_notice(){
	if( get_transient( 'awqv-thankyou-notice' ) ){
		$msg1='Awesome Quick Viewer for WooCommerce Lite';
		$msg2='Deactivated Awesome Quick Viewer for WooCommerce Pro while Lite is Activate.';
		?>
		<div class="updated notice is-dismissible">
			<?php printf('<p>Thank you for using <strong>%s</strong>! 
			<strong>%s</strong></p>', $msg1, $msg2 );?>
		</div>
		<?php
		delete_transient( 'awqv-admin-notice' );
	}
}
// Define constants
define( 'AWQV_LITE_VERSION', '1.0' );
define( 'AWQV_LITE_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'AWQV_LITE_INC_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) . 'includes' ) );
define( 'AWQV_LITE_PATH', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
define( 'AWQV_LITE_CUSTOMIZER_PATH', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) . '/includes/cutomizer-controls/controls' ) );
define( 'AWQV_LITE_BASE', plugin_basename( __FILE__ ) );

add_action('wp_enqueue_scripts', 'awqv_lite_load_scripts');
function awqv_lite_load_scripts() {
	wp_enqueue_style( 'animate_css', AWQV_LITE_PATH . '/assets/css/animate.min.css', AWQV_LITE_VERSION);
	wp_enqueue_style( 'font_icon_css', awqv_lite_assets_path() . '/icon-picker/assets/css/fontello.css', AWQV_LITE_VERSION);
	wp_enqueue_style( 'modal_box', AWQV_LITE_PATH . '/assets/css/modal-box.css', AWQV_LITE_VERSION);
	wp_enqueue_style( 'owl', AWQV_LITE_PATH . '/assets/css/owl.carousel.min.css', AWQV_LITE_VERSION);
	wp_enqueue_style( 'perfect-scroll', AWQV_LITE_PATH . '/assets/css/perfect-scrollbar.css', AWQV_LITE_VERSION);
	wp_enqueue_style( 'awqv-style', AWQV_LITE_PATH . '/assets/css/awqv-style.css', AWQV_LITE_VERSION);
	wp_enqueue_style ( 'awqv_lite_css' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'modal-box', AWQV_LITE_PATH . '/assets/js/modal-box.js', AWQV_LITE_VERSION);
	wp_enqueue_script( 'owl-js', AWQV_LITE_PATH . '/assets/js/owl.carousel.min.js', AWQV_LITE_VERSION);
	wp_enqueue_script( 'perfect-scrollbar-js', AWQV_LITE_PATH . '/assets/js/perfect-scrollbar.min.js', AWQV_LITE_VERSION);
	wp_enqueue_script( 'custom-js', AWQV_LITE_PATH . '/assets/js/awqv-custom.js', AWQV_LITE_VERSION);
}
add_action( 'admin_enqueue_scripts', 'awqv_lite_admin_style');

function awqv_lite_admin_style() {
	wp_enqueue_style( 'admin-style', AWQV_LITE_PATH . '/assets/css/awqv-admin-style.css' );
}
function awqv_lite_dir(){
	$controls_dir = AWQV_LITE_INC_DIR . '/customizers/cutomizer-controls/controls';
	return $controls_dir;
}
function awqv_lite_assets_path(){
	 $assets_path = AWQV_LITE_PATH . '/includes/customizers/cutomizer-controls/controls/';
	 return $assets_path;
}
 
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once AWQV_LITE_DIR .'/awqv.php';
	require_once ( awqv_lite_dir() .'/icon-picker/icon-picker-control.php' );
	require_once AWQV_LITE_INC_DIR .'/customizers/customizer.php';
	require_once AWQV_LITE_INC_DIR .'/qv-style.php';
}