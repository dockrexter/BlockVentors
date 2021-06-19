<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$cryptcio_settings = cryptcio_check_theme_options();
global $product;
?>
<?php if(isset($cryptcio_settings['product-price'])):?>
	<?php if($cryptcio_settings['product-price']):?>
		<?php if($product->get_price_html()):?>
			<div class="price_single_product">
				<p class="price">
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
					<?php if(wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && $product->is_taxable() && $product->get_price_html()!=esc_html__('FREE','cryptcio')):?>
						<span class="tax"><?php echo esc_html__('Ex Tax: ','cryptcio'); ?><?php echo wc_price(wc_get_price_excluding_tax($product)); ?></span>
					<?php endif;?>
				</p>				
			</div>
		<?php endif;?>
	<?php endif;?>
<?php endif;?>