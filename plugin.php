<?php
if (!defined('ABSPATH')) exit;
class Awqv_Lite_front
{

    function __construct()
    {

        add_action('wp_ajax_get_product', array(
            $this,
            'awqv_get_product_callback'
        ));
        // If you want not logged in users to be allowed to use this function as well, register it again with this function:
        add_action('wp_ajax_nopriv_get_product', array(
            $this,
            'awqv_get_product_callback'
        ));
        add_action('awqv_before_modal', array(
            $this,
            'awqv_before_modal',
            20
        ));
        add_action('awqv_after_modal', array(
            $this,
            'awqv_after_modal',
            20
        ));
        add_action('wp_footer', array(
            $this,
            'awqv_add_ajax_script'
        ));
        add_action('wp_footer', array(
            $this,
            'awqv_modal'
        ));
        add_action('woocommerce_after_shop_loop_item', array(
            $this,
            'awqv_modal_button'
        ));

        //WooCommerce Hook
        add_action('awqv_show_product_sale_flash', 'woocommerce_show_product_sale_flash');
        add_action('awqv_product_content', 'woocommerce_template_single_title', 5);
        add_action('awqv_product_content', 'woocommerce_template_single_rating', 10);
        add_action('awqv_product_content', 'woocommerce_template_single_price', 15);
        add_action('awqv_product_content', 'woocommerce_template_single_excerpt', 20);
        add_action('awqv_product_content', 'woocommerce_template_single_add_to_cart', 25);

        add_action('awqv_product_content', 'woocommerce_template_single_meta', 30);
        //Action for Add to cart
        add_action('wp_enqueue_scripts', array(
            $this,
            'awqv_woocommerce_ajax_add_to_cart_js'
        ));
        add_action('wp_ajax_woocommerce_ajax_add_to_cart', array(
            $this,
            'awqv_woocommerce_ajax_add_to_cart'
        ));
        add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', array(
            $this,
            'awqv_woocommerce_ajax_add_to_cart'
        ));

        add_action('awqv_view_product_image', array(
            $this,
            'awqv_image'
        ) , 20);
    }

    // add the action
    public function awqv_modal_button()
    {
        global $product;
        $product_id = $product->get_id();
        $qv_button_label = get_option('qv_button_label', '');
?>
		<div class="btn-container">
			<button type="button" class="open-modal" 
			data-id="<?php echo esc_attr($product_id); ?>" >
				<i class="<?php echo esc_attr(get_option('awqv_general_section', '')); ?>"></i>
				<?php echo esc_html($qv_button_label, 'awqv') ?> 
			</button>
		</div>
	<?php
    }

    public function awqv_get_product_callback()
    {
        // retrieve post_id, and sanitize it to enhance security
        if (!isset($_POST['id']))
        {
            die();
        }
        $product_id = intval($_POST['id']);

        wp('p=' . $product_id . '&post_type=product');
?>
		<?php
        ob_start();

        include_once ('includes/awqv-content.php');

        echo ob_get_clean();

        // Must die() the function
        die();
    }
    public static function awqv_image()
    {
        include_once ('includes/awqv-image.php');
    }
    public function awqv_modal()
    {
        $icon = get_option('awqv_icon_picker', '');
        $close_container = ($icon == 'default') ? '<div class="wg-modal-close">&times;</div>' : '<div class="wg-modal-close"><i class="' . $icon . '"></i></div>';

        echo '<div id="my-modal" class="my-modal">
			' . $close_container . '
			<div id="modal_container"></div>
		</div>';
    }
    public function awqv_woocommerce_ajax_add_to_cart_js()
    {

        if (function_exists('is_product') && is_product())
        {
            wp_enqueue_script('woocommerce-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/js/woo-ajax-add-to-cart.js', array(
                'jquery'
            ) , '', true);
        }
    }
    public function awqv_woocommerce_ajax_add_to_cart()
    {

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
        $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
        $variation_id = absint($_POST['variation_id']);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
        $product_status = get_post_status($product_id);

        if ($passed_validation && WC()
            ->cart
            ->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status)
        {

            do_action('woocommerce_ajax_added_to_cart', $product_id);

            if ('yes' === get_option('woocommerce_cart_redirect_after_add'))
            {
                wc_add_to_cart_message(array(
                    $product_id => $quantity
                ) , true);
            }

            WC_AJAX::get_refreshed_fragments();
        }
        else
        {

            $data = array(
                'error' => true,
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id) , $product_id)
            );

            echo wp_send_json($data);
        }

        wp_die();
    }

    public static function awqv_animation()
    {
        return ['default' => 'Default', 'fadeInUp' => 'fadeInUp', 'fadeInUp' => 'fadeInUp', 'fadeInDown' => 'fadeInDown', 'bounceIn' => 'bounceIn', 'bounceInUp' => 'bounceInUp', 'bounceInDown' => 'bounceInDown', 'bounceInRight' => 'bounceInRight', 'bounceInLeft' => 'bounceInLeft', 'backInDown' => 'backInDown', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'jackInTheBox' => 'jackInTheBox', 'slideInUp' => 'slideInUp', 'slideInDown' => 'slideInDown', 'rollIn' => 'rollIn', 'zoomIn' => 'zoomIn', 'zoomInUp' => 'zoomInUp', 'zoomInDown' => 'zoomInDown', ];
    }
    public function awqv_add_ajax_script()
    {
        global $woocommerce;
?>
		<script>
			jQuery(".open-modal").click(function () {
			var $id =  jQuery(this).data('id');
			jQuery(this).append('<div class="loader-wrap"><div id="loader"></div></div>');
			
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					'id': $id,
					'action': 'get_product' //this is the name of the AJAX method called in WordPress
				},
				success: function (result) {
				   jQuery('#modal_container').html(result); 
					var modal = jQuery(".my-modal").wgModal({
						onBeforeOpen    : function(e) {
							jQuery('body').css('overflow','hidden');
						},
						onAfterClose: function (e) {
							jQuery('body').css('overflow','auto');
						},
					});
					modal.openModal();
					jQuery('.loader-wrap').remove();
					var owl;
					owl = jQuery(".slider").owlCarousel({
						items:1,
						smartSpeed:1200,
						dots:<?php echo get_option('awqv_slider_dot_switch', '') ? 'true' : 'false'; ?>,
						nav:<?php echo get_option('awqv_slider_nav_switch', '') ? 'true' : 'false'; ?>,
						lazyLoad :true,
						navText: ["<i class='<?php echo get_option('awqv_slider_prev_icon', ''); ?>'></i>", "<i class='<?php echo get_option('awqv_slider_next_icon', ''); ?>'></i>"]
					});
					 const ps = new PerfectScrollbar('.qv-inner', {});
				},
				complete: function(){
					awqvLoadVariationScript();
				},
				error: function() {
					console.log("error");
				}
				
			});
			function awqvLoadVariationScript() {
				jQuery.getScript('<?php echo $woocommerce->plugin_url(); ?>/assets/js/frontend/add-to-cart-variation.min.js');
				jQuery.getScript('<?php echo plugin_dir_url(__FILE__); ?>/assets/js/woo-ajax-add-to-cart.js');
			}
		});
		</script>
		<?php
    }

} //End Class
new Awqv_Lite_front();