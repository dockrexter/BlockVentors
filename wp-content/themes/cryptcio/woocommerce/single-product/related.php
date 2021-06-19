<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce_loop;
$cols_md = 'columns-4';
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}
if(isset($cryptcio_settings['product-cols'])){
	switch ($cryptcio_settings['product-cols']) {
		case 1: $cols_md = ' columns-1';
	        break;
		case 2: $cols_md = ' columns-2';
	        break;
	    case 3: $cols_md = ' columns-3';
	        break;
		case 4: $cols_md = ' columns-4';
	        break;
	    default: $cols_md = ' columns-5';
	        break;
	}

}
if ( $related_products ) : ?>
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="related products-bottom woocommerce">
			<div class="title-hdwoo">
				<h3 class="title-cart"><?php esc_html_e( 'Related products', 'cryptcio' ) ?></h3>
			</div>
			<div class="product_archives isotope woocommerce <?php echo esc_attr($cols_md);?>">
				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $related_products as $related_product ) : ?>

						<?php
					 	$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>
			</div>
		</div>
	</div>
<?php endif;

wp_reset_postdata();
