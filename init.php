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

if (!defined('ABSPATH'))
{
    exit;
}
if (!function_exists('activate_awqv_lite'))
{
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-activator.php
     */
    function activate_awqv_lite()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/class-activator.php';
        Awqv_Activator::activate();
        Awqv_Activator::set_plugin_info();
        set_transient('awqv-lite-thankyou-notice', true, 5);
    }
}
//Activation Hook
register_activation_hook(__FILE__, 'activate_awqv_lite');

function awqv_lite_thankyou_notice()
{
	if (get_transient('awqv-lite-thankyou-notice'))
	{
		$msg_title 	= 'Awesome Quick Viewer for WooCommerce Lite';
		$msg_text 	= 'Deactivated Awesome Quick Viewer for WooCommerce Pro while Lite is Activate.';
		$settings 	= '<a class="button button-primary" href="'.wp_customize_url().'">Settings</a>';
?>
		<div class="updated is-dismissible aep-notice">
			<?php echo sprintf(__('<p>Thank you for using <strong>%s</strong>! 
			<strong>%s</strong></p><p>%s</p>', 'awqv' ),$msg_title, $msg_text, $settings); ?>
		</div>
  <?php
		delete_transient('awqv-lite-thankyou-notice');
	}
}

//Plugin Init Class
class Awqv_Lite_Plugin
{
    public $version = '1.0';

    function __construct()
    {
        //Define constants.
        $this->define_constants();
        //Script hook.
        add_action('wp_enqueue_scripts', array(
            $this,
            'awqv_load_scripts'
        ));
        add_action('admin_enqueue_scripts', array(
            $this,
            'awqv_admin_style'
        ));
		//Load Main
        $this->awqv_load();
		// Initialize the filter hooks.
		$this->action_link_filters();
    }
	
    /**
     * Define constants
     *
     * @since 1.0
     */
    public function define_constants()
    {
        $this->define('AWQV_VERSION', $this->version);
        $this->define('AWQV_DIR', untrailingslashit(plugin_dir_path(__FILE__)));
        $this->define('AWQV_INC_DIR', untrailingslashit(plugin_dir_path(__FILE__) . 'includes'));
        $this->define('AWQV_PATH', untrailingslashit(plugins_url(basename(plugin_dir_path(__FILE__)) , basename(__FILE__))));
        $this->define('AWQV_CUSTOMIZER_PATH', untrailingslashit(plugins_url(basename(plugin_dir_path(__FILE__)) , basename(__FILE__)) . '/includes/cutomizer-controls/controls'));
        $this->define('AWQV_BASE', plugin_basename(__FILE__));
    }
    /**
     * Define constant if not already set
     *
     * @param string      $name
     * @param string|bool $value
     */
    public function define($name, $value)
    {
        if (!defined($name))
        {
            define($name, $value);
        }
    }
    /**
     * Add Scripts
     *
     * @since 1.0
     */
    public function awqv_load_scripts()
    {
        wp_enqueue_style('animate_css', AWQV_PATH . '/assets/css/animate.min.css', AWQV_VERSION);
        wp_enqueue_style('font_icon_css', $this->awqv_assets_path() . '/icon-picker/assets/css/fontello.css', AWQV_VERSION);
        wp_enqueue_style('modal_box', AWQV_PATH . '/assets/css/modal-box.css', AWQV_VERSION);
        wp_enqueue_style('owl', AWQV_PATH . '/assets/css/owl.carousel.min.css', AWQV_VERSION);
        wp_enqueue_style('perfect-scroll', AWQV_PATH . '/assets/css/perfect-scrollbar.css', AWQV_VERSION);
        wp_enqueue_style('awqv-style', AWQV_PATH . '/assets/css/awqv-style.css', AWQV_VERSION);
        wp_enqueue_style('awqv_css');

        wp_enqueue_script('jquery');
        wp_enqueue_script('awqv-modal-box', AWQV_PATH . '/assets/js/modal-box.js', AWQV_VERSION);
        wp_enqueue_script('awqv-owl-js', AWQV_PATH . '/assets/js/owl.carousel.min.js', AWQV_VERSION);
        wp_enqueue_script('awqv-perfect-scrollbar-js', AWQV_PATH . '/assets/js/perfect-scrollbar.min.js', AWQV_VERSION);
        wp_enqueue_script('custom-js', AWQV_PATH . '/assets/js/awqv-custom.js', AWQV_VERSION);
    }
	/**
	 * Add plugin action Filter
	 */
	public function action_link_filters() {
		add_filter( 'plugin_action_links', array( $this, 'awqv_plugin_action_links' ), 10, 2 );
	}
	/**
	 * Add plugin action menu
	 *
	 * @param array  $links
	 * @param string $file
	 *
	 * @return array
	 */
	public function awqv_plugin_action_links( $links, $file ) {

		if ( AWQV_BASE == $file ) {
			$new_links = sprintf( '<a href="%s">%s</a>', wp_customize_url(), __( 'Settings', 'awqv' ) );

			array_unshift( $links, $new_links );

			$links['go_pro'] = sprintf( '<a target="_blank" href="%1$s" style="color: #00be28; font-weight: 700;">Go Premium!</a>', 'https://themesbyte.com/quick-viewer/?add-to-cart=3036' );
		}

		return $links;
	}
 

    /**
     * Admin Style
     *
     * @since 1.0
     */
    static function awqv_admin_style()
    {
        wp_enqueue_style('admin-style', AWQV_PATH . '/assets/css/awqv-admin-style.css');
    }
    /**
     * Define Customizer control dir
     *
     * @since 1.0
     */
    static function awqv_dir()
    {
        $controls_dir = AWQV_INC_DIR . '/customizers/cutomizer-controls/controls';
        return $controls_dir;
    }
    /**
     * Define Customizer control path
     *
     * @since 1.0
     */
    static function awqv_assets_path()
    {
        $assets_path = AWQV_PATH . '/includes/customizers/cutomizer-controls/controls/';
        return $assets_path;
    }
    /**
     * WooCommerce activation Check
     *
     * @since 1.0
     */
    public function awqv_load()
    {
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
        {
            require_once AWQV_DIR . '/plugin.php';
            require_once AWQV_DIR . '/includes/admin-notice/class-admin-notice.php';
            require_once AWQV_INC_DIR . '/customizers/customizer.php';
            require_once AWQV_INC_DIR . '/awqv-style.php';
        }
    }
}
new Awqv_Lite_Plugin();
