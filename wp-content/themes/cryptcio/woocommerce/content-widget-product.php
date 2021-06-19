<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<div class="product-img">
		<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo wp_kses($product->get_image(),array(
				'img'=> array(
					'class'=> array(),
					'width'=> array(),
					'height'=> array(),
					'alt'	=> array(),
					'src'	=> array(),
				),
			)); ?>
		</a>
	</div>
	<div class="product-content">
		<a class="product-title" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo esc_html($product->get_title()); ?>
		</a>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
		<div class="price">
			<?php echo wp_kses($product->get_price_html(),array(
				'div'=> array(
					'class'=> array(),
				),
				'span'=> array(
					'class'=> array(),
				),
				'del'=> array(),
				'ins'=> array(),
			)); ?>
		</div>
		<?php echo do_shortcode('[add_to_cart id="'.get_the_ID().'"]'); ?>
	</div>
</li>
