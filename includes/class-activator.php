<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0
 * @package    awesome_quick_viwer
 * @subpackage awesome_quick_viwer/includes
 */
class Awqv_Activator {
	/**
	 * When plugin activate work activate function.
	 *
	 * @since      1.0
	 */
	public static function activate() {
		deactivate_plugins( 'awesome-woo-quick-viewer-pro/init.php' );
	}
	public static function set_plugin_info(){
		update_option( 'awqv_lite_activation_date', current_time( 'timestamp' ) );
		update_option( 'awqv_lite_version', AWQV_VERSION );
	}
}