<?php

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awqv_lite_customize_preview_js() {
	wp_enqueue_script( 'awqv-customizer', AWQV_PATH . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'awqv_lite_customize_preview_js' );

function awqv_lite_custom_css_output() {
	$padding_top 	=  get_option( 'btn_padding_top_bottom', '' );
	$padding_left   = get_option( 'btn_padding_left_right', '' );
	
	?>
  <style type="text/css" id="awqv-plugin-css">
		.owl-nav i{
			color: <?php echo esc_attr(get_option( 'awqv_nav_color', '' )) ;?>;
		}
		.awqv-theme .owl-nav [class*='owl-']:hover i{
			color: <?php echo esc_attr(get_option( 'awqv_nav_hover_color', '' )) ;?>;
		}
		.awqv-theme .owl-dots .owl-dot.active span, 
		.owl-theme .owl-dots .owl-dot:hover span{
			background: <?php echo esc_attr(get_option( 'awqv_dot_color', '' ))  ;?>;
		}
		.woocommerce .qv-description button.button.alt{
			padding: <?php echo esc_attr($padding_top .'px' . " ". $padding_left .'px');?>
		}
		.woocommerce .qv-description .added_to_cart.wc-forward{
			padding: <?php echo esc_attr($padding_top .'px');?>
		}
	  .wg-modal-close i{
		  color: <?php echo esc_attr(get_option( 'awqv_icon_color', '' ));?>
	  }
	  .woocommerce .qv-col span.onsale{
		  background: <?php echo esc_attr(get_option( 'awqv_sale_flash_bg', '' ));?>
	  }
	  .woocommerce .qv-description button.button.alt, 
	  .woocommerce-cart .qv-description button.button.alt{
		  background: <?php echo esc_attr(get_option( 'awqv_cart_button_bg', '' ));?>
	  }
	  .woocommerce .qv-description a.added_to_cart.wc-forward{
		  background: <?php echo esc_attr(get_option( 'awqv_view_cart_button_bg', '' ));?>
	  }
	  .qv-row{
		  background: <?php echo esc_attr(get_option( 'awqv_window_bg', '' ));?>
	  }
	  .qv-description .product_title{
		  color: <?php echo esc_attr(get_option( 'awqv_title_color', '' ));?>
	  }
	  .bg-wg-modal .wg-modal {
			animation-name: <?php echo esc_attr(get_option( 'qv_animation', '' ));?>;
			animation-duration: 0.4s;
		}
		.qv-description .woocommerce-product-details__short-description, .qv-description .stock.out-of-stock {
			color: <?php echo esc_attr(get_option( 'awqv_desc_color', '' ));?>;
		}
		.qv-description .product_meta {
			color: <?php echo esc_attr(get_option( 'awqv_product_meta_color', '' ));?>;
		}
		.qv-description .product_meta a {
			color: <?php echo esc_attr(get_option( 'awqv_product_meta_link_color', '' ));?>;
		}
		.qv-description .woocommerce-product-rating .star-rating, .qv-description .woocommerce-product-rating a {
			color: <?php echo esc_attr(get_option( 'awqv_product_review_color', '' ));?>;
		}
		.qv-description p.price {
			color: <?php echo esc_attr(get_option( 'awqv_product_price_color', '' ));?>;
		}
  </style>
<?php }
add_action( 'wp_head', 'awqv_lite_custom_css_output');