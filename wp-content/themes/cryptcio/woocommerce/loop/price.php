<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$cryptcio_settings = cryptcio_check_theme_options();
$unit_product = get_post_meta(get_the_id(), 'unit_product', true);
global $product;
?>
<?php if(isset($cryptcio_settings['product-price'])):?>
	<?php if($cryptcio_settings['product-price']):?>
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<span class="price">
				<span class="dsp_in_sc"><?php esc_html_e( 'Price:', 'cryptcio' ); ?></span>
				<?php echo wp_kses($price_html,array(
					'div'=> array(
						'class'=> array(),
					),
					'span'=> array(
						'class'=> array(),
					),
					'del'=> array(),
					'ins'=> array(),
				)); ?>				
				<?php if($unit_product) :?>
					<span class="unit_price">/ <?php echo esc_html($unit_product) ?></span>
				<?php endif;?>
			</span>

		<?php endif;?>
	<?php endif; ?>
<?php endif; ?>
