<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
// Increase loop count
$entries_count = 0;
$post_term_arr = get_the_terms( get_the_ID(), 'product_cat' );
$post_term_filters = '';
$post_term_names = '';
if( is_array( $post_term_arr ) && count( $post_term_arr ) > 0 ) {
    foreach ( $post_term_arr as $post_term ) {

        $post_term_filters .= $post_term->slug . ' ';
        $post_term_names .= $post_term->name . ', ';
    }
}

$post_term_filters = trim( $post_term_filters );
$post_term_names = substr( $post_term_names, 0, -2 );
$classes[] = "item";
$classes[] = 'item-page'.$current_page;
$classes[] = $post_term_filters;

if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') && ($woocommerce_loop['product_style'] == 'style-2')){
	$index_size2 = array('1','4','7','10','13','15','18','21','24','27','30');
	$classes[] = "";
	if(in_array($woocommerce_loop['i'], $index_size2)){
		$classes[] = 'image_size2';
	}else{
		$classes[] = 'image_size';
	} 
}elseif(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') && ($woocommerce_loop['product_style'] == 'style-1')){
	$index_size2 = array('6','12','20','26','34','40','48','54');
	$classes[] = "";
	if(in_array($woocommerce_loop['i'], $index_size2)){
		$classes[] = 'image_size2';
	}else{
		$classes[] = 'image_size';
	} 
}
?>
<div <?php post_class($classes); ?>>
	<div class="product-content">
		<div class="product-image">
			<?php 
				/**
				 * woocommerce_product_image hook.
				 *
				 * @hooked cryptcio_woocommerce_product_image - 10
				 */			
				do_action('woocommerce_product_image');
			?>
			<div class="product-action product-action-grid">
				
				<?php
				/**
				 * woocommerce_product_action_cart hook.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_product_action_cart' );
				?>
				<div class="action_item_box">
				<?php
				/**
				 * woocommerce_product_action hook.
				 *
				 * @hooked cryptcio_wishlist_custom - 10
				 * @hooked cryptcio_compare_product - 20
				 * @hooked cryptcio_quickview - 30
				 */
				do_action( 'woocommerce_product_action' );
				?>
				</div>
			</div>
		</div>
		<div class="product-desc">
			<h3><a href="<?php the_permalink(); ?>" class="product-name"><?php echo the_title(); ?></a></h3>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('woocommerce_after_shop_loop_item_title');
			?>
			<div class="product-action product-action-list">
				<?php
				/**
				 * woocommerce_product_action_cart hook.
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_product_action_cart' );
				?>
				<div class="action_item_box">
				<?php
				/**
				 * woocommerce_product_action hook.
				 *
				 * @hooked cryptcio_wishlist_custom - 10
				 * @hooked cryptcio_compare_product - 20
				 * @hooked cryptcio_quickview - 30
				 */
				do_action( 'woocommerce_product_action' );
				?>
				</div>
            </div>
		</div>
	</div>
</div>
<?php 
    $entries_count++;
	if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')){
		$woocommerce_loop['i']++;
	}
?>