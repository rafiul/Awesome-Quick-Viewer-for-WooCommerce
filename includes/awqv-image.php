<?php
/**
 * Quick view image template.
 *
 * @package Awesome Quick Viewr WordPress Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product, $woocommerce; ?>

<div class="qv-image">
	<div class="slider owl-carousel awqv-theme">
		
			<?php
			if ( has_post_thumbnail() ) {
				$attachment_ids = $product->get_gallery_image_ids();
				$props          = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image          = get_the_post_thumbnail(
					$post->ID,
					'shop_single',
					array(
						'title' => $props['title'],
						'alt'   => $props['alt'],
					)
				);

				echo sprintf(
					'<div class="%s">%s</div>',
					'qv-thumbnail woocommerce-product-gallery__image',
					$image // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);

				if ( $attachment_ids ) {
					$loop = 0;

					foreach ( $attachment_ids as $attachment_id ) {

						$props = wc_get_product_attachment_props( $attachment_id, $post );

						if ( ! $props['url'] ) {
							continue;
						}

						echo sprintf(
							'<div class="%s">%s</div>',
							'qv-thumbnail woocommerce-product-gallery__image',
							wp_get_attachment_image( $attachment_id, 'shop_single', 0, $props )
						);

						$loop++;
					}
				}
			} else {
				echo sprintf( '<div><img src="%s" alt="%s" /></div>', wc_placeholder_img_src(), __( 'Placeholder', 'oceanwp' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
	</div>
</div>