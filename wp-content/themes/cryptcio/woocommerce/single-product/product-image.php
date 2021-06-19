<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}
global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';  
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
$cryptcio_settings = cryptcio_check_theme_options();
$single_style =  cryptcio_get_product_single_style();
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<?php if( $single_style == '2'):?>
		<div class="row">
			<div class="col-md-10 col-sm-9 col-xs-9 custom-col-10 f-float">
				<div class="img_single_large">
					<?php do_action('cryptcio_get_product_image');?>
				</div>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-3 custom-col-2">
				<div class="img_single_thumb">
					<?php do_action( 'woocommerce_product_thumbnails' ); ?>
				</div>
			</div>
		</div>	
	<?php elseif( $single_style == '3' || $single_style == '4'):?>
		<div class="img_single_large">
			<?php do_action('cryptcio_get_product_image');?>
		</div>		
	<?php else :?>
		<div class="img_single_large">
			<?php do_action('cryptcio_get_product_image');?>
		</div>
		<div class="img_single_thumb">
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>	
		</div>
	<?php endif;?>
</div>
