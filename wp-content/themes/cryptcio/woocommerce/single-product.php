<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php
$cryptcio_settings = cryptcio_check_theme_options();
$cryptcio_layout = cryptcio_get_layout();
$single_style =cryptcio_get_product_single_style();
$class = '';
$cryptcio_product_meta = isset($cryptcio_settings['product-meta']) ? $cryptcio_settings['product-meta']:'';
if(isset($cryptcio_product_meta) && $cryptcio_product_meta!='' && in_array('brand', $cryptcio_product_meta)){
	$class .= "show-brand ";
}else{
	$class .= "";
}
?>
<?php
	$class = '';
	if ($cryptcio_sidebar_left && $cryptcio_sidebar_right && is_active_sidebar($cryptcio_sidebar_left) && is_active_sidebar($cryptcio_sidebar_right)){
	 	$class .= 'col-md-6 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif($cryptcio_sidebar_left && (!$cryptcio_sidebar_right|| $cryptcio_sidebar_right=="none") && is_active_sidebar($cryptcio_sidebar_left)){
		$class .= 'f-right col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif((!$cryptcio_sidebar_left || $cryptcio_sidebar_left=="none") && $cryptcio_sidebar_right && is_active_sidebar($cryptcio_sidebar_right)){
		$class .= 'col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}else {
		$class .= 'content-primary'; 
		if($cryptcio_layout == 'fullwidth'){
			$class .= ' col-md-12';
		}
	}
	$class .= " single_product_".$single_style;
	if($single_style=='5'){
		$cryptcio_product_related = isset($cryptcio_settings['product5-related'])?$cryptcio_settings['product5-related']:'';
	}else{
		$cryptcio_product_related = isset($cryptcio_settings['product-related'])?$cryptcio_settings['product-related']:'';
	}
?>
	<?php get_sidebar('left'); ?>  
		<div class="<?php echo esc_attr($class);?>">
				<?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
				?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>
				<div class="clearfix"></div>
				<div class="row">
					<?php 
						if(isset($cryptcio_product_related) && $cryptcio_product_related){
							/**
							 * woocommerce_related_after hook.
							 *
							 * @hooked woocommerce_output_related_products - 10
							 * @hooked cryptcio_banner_single_product - 20
							 */
							do_action('woocommerce_related_after');
						}
					?>
				</div>
		</div>
		<?php get_sidebar('right'); ?>  
		
<?php get_footer( 'shop' ); ?>
