<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$cryptcio_settings = cryptcio_check_theme_options();
$featured = get_post_meta($post->ID, '_featured', 'true') == 'yes' ? true : false;
$postdatestamp = '';
$cryptcio_product_meta = isset($cryptcio_settings['product-meta'])?$cryptcio_settings['product-meta']:'';
?>
<?php if(isset($cryptcio_product_meta) && $cryptcio_product_meta!='' && in_array('sku', $cryptcio_product_meta) || in_array('condition', $cryptcio_product_meta) 
	|| in_array('reference', $cryptcio_product_meta) || in_array('tag', $cryptcio_product_meta)): ?> 
	<div class="product_meta">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>
			<?php if (isset($cryptcio_product_meta) && in_array('sku', $cryptcio_product_meta)) : ?>
				<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
					<span class="sku_wrapper">
						<strong><?php esc_html_e( 'SKU:', 'cryptcio' ); ?></strong> 
						<span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'cryptcio' ); ?></span>
					</span>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(isset($cryptcio_product_meta) && in_array('condition', $cryptcio_product_meta) && $cryptcio_settings['product-sale'] && $product->is_on_sale() || $featured || ( time() - ( 60 * 60 * 24 ) ) < $postdatestamp): ?>
				<span class="condition">
					<strong><?php esc_html_e( 'Condition:', 'cryptcio' ); ?></strong>
					<?php woocommerce_show_product_sale_flash() ?>
				</span>
			<?php endif; ?>
			<?php if (isset($cryptcio_product_meta) && in_array('reference', $cryptcio_product_meta)) : ?>
				<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><strong>' . _n( 'Reference:', 'Reference:', count( $product->get_category_ids() ), 'cryptcio' ) . ' </strong>', '</span>' ); ?>
			<?php endif; ?>
			<?php if (isset($cryptcio_product_meta) && in_array('tag', $cryptcio_product_meta)) : ?>
				<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as"><strong>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'cryptcio' ) . ' </strong>', '</span>' ); ?>
			<?php endif; ?>
		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div>
<?php endif; ?>

