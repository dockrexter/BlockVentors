<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php
global $wp_query, $woocommerce_loop;
$cryptcio_settings = cryptcio_check_theme_options();
$cryptcio_sidebar_left = cryptcio_get_sidebar_left();
$cryptcio_sidebar_right = cryptcio_get_sidebar_right();
$cryptcio_layout = cryptcio_get_layout();
$cat = $wp_query->get_queried_object();
//only for demo
if (isset($_GET['sidebar']) && $_GET['sidebar']=="none") {
    $cryptcio_sidebar_left = $_GET['sidebar'];
    $cryptcio_sidebar_right = $_GET['sidebar'];
}
//end demo
if(isset($cat->term_id)){
	$woo_cat = $cat->term_id;
}else{
	$woo_cat = '';
}
$product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
$product_type_class = '';
if($product_list_mode == "only-grid-wrap"){
	$product_type_class = "product-grid-wrap";
}
else if($product_list_mode == "only-list-wrap"){
	$product_type_class = "product-list-wrap";
}
else{
	$product_type_class = "product-grid-wrap";
}
$product_layout = isset($cryptcio_settings['product-layouts']) ? $cryptcio_settings['product-layouts'] :'';
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
			$class .= ' col-md-12 col-sm-12 col-xs-12';
		}
	}
	$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<?php cryptcio_get_banner_top(); ?>
</div>
<?php get_sidebar('left'); ?> 
<div class="<?php echo esc_attr($class);?>">
	<?php if ( have_posts() ) : ?>
		<?php wc_print_notices(); ?>
		<?php 
			if(is_product_category()){
				$cryptcio_shop_slogan = $cryptcio_settings['shop-slogan'];
			}else if(isset($cryptcio_settings['shop-slogan']) && $cryptcio_settings['shop-slogan']){
				$cryptcio_shop_slogan = $cryptcio_settings['shop-slogan'];
			}
		?>
		<?php if(isset($cryptcio_settings['show-slogan']) && $cryptcio_settings['show-slogan']): ?>
			<?php if(isset($cryptcio_shop_slogan) && $cryptcio_shop_slogan):?>
				<?php if(is_shop() ): ?>
					<div class="term-description">
						<p><?php echo wp_kses($cryptcio_shop_slogan,cryptcio_allow_html()); ?></p>
					</div>
				<?php else: ?>
					<?php if(term_description() !=""): ?>
						<?php
							/**
							 * woocommerce_archive_description hook.
							 *
							 * @hooked woocommerce_taxonomy_archive_description - 10
							 * @hooked woocommerce_product_archive_description - 10
							 */
							
							do_action( 'woocommerce_archive_description' );
						?>
					<?php else: ?>
						<div class="term-description">
							<p><?php echo wp_kses($cryptcio_shop_slogan,cryptcio_allow_html()); ?></p>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ('subcategories' === get_option( 'woocommerce_shop_page_display' ) || 'both' === get_option( 'woocommerce_shop_page_display' )): ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row">
					<div class="cate-archive">
						<?php woocommerce_subcategories();?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="archive_product clearfix">
			<?php 
			if(isset($cryptcio_settings['product-toolbar']) && $cryptcio_settings['product-toolbar']){
				$cryptcio_product_toolbar = $cryptcio_settings['product-toolbar'];
				if(is_product_category()){
					if(!cryptcio_get_meta_value('product-toolbar', true)){
						$cryptcio_product_toolbar ='';
					}else{
						$cryptcio_product_toolbar = $cryptcio_settings['product-toolbar'];
					}
				}					
			}

			?>
			<?php if(isset($cryptcio_product_toolbar) && $cryptcio_product_toolbar): ?>
				<div class="top_archive_product clearfix">
					<?php if(isset($cryptcio_settings['product-left-toolbar']) && $cryptcio_settings['product-left-toolbar']): ?>
						<?php if(isset($cryptcio_settings['product-right-toolbar']) && $cryptcio_settings['product-right-toolbar']): ?>
							<div class="col-md-4 col-sm-12 col-xs-12 no-padding">
						<?php else: ?>
							<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
						<?php endif; ?>
							<?php $total = $wp_query->found_posts; ?>
							<div class="total-product">
								<p><?php printf( __( 'We found <strong> %1$s product(s) </strong> available for you','cryptcio' ),$total ); ?></p>
							</div>
						</div>
					<?php endif; ?>
					<?php if(isset($cryptcio_settings['product-right-toolbar']) && $cryptcio_settings['product-right-toolbar']): ?>
						<?php if(isset($cryptcio_settings['product-left-toolbar']) && $cryptcio_settings['product-left-toolbar']): ?>
							<div class="col-md-8 col-sm-12 col-xs-12 text-right filter_count_view no-padding">
						<?php else: ?>
							<div class="col-md-12 col-sm-12 col-xs-12 text-right filter_count_view no-padding">
						<?php endif; ?>
							<?php if( function_exists('is_plugin_active') && is_plugin_active('woocommerce-ajax-filters/woocommerce-filters.php') 
								&& (isset($cryptcio_settings['product-price-ajax']) && $cryptcio_settings['product-price-ajax']) && !$cryptcio_sidebar_left && !$cryptcio_sidebar_right): ?>
								<div class="price-ajax display-inline">
									<?php $title_price = esc_html__('Price','cryptcio'); ?>
									<?php do_shortcode('[br_filters attribute=price type=slider title="'.$title_price.'"]'); ?>
								</div>
							<?php endif; ?>
							<?php if((isset($cryptcio_settings['product-select-cate']) && $cryptcio_settings['product-select-cate']) && !$cryptcio_sidebar_left && !$cryptcio_sidebar_right): ?>
								<div class="widget_product_categories display-inline category-list">
									<label class="select-cate">
										<?php echo esc_html__( 'Select categories', 'cryptcio' ); ?>
									</label>
									<div class="select-content">
										<?php if (function_exists ( 'arrowpress_core_list_cate' )) : ?>
											<?php echo arrowpress_core_list_cate(); ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
							<?php
								/**
								 * woocommerce_archive_top_toolbar hook.
								 *
								 * @hooked woocommerce_archive_top_toolbar - 10
								 */
								
								do_action( 'woocommerce_archive_top_toolbar' );
							?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php 
			$category_cols = get_metadata('product_cat', $woo_cat, 'category_cols', true);
			$cols_md = 'columns-4';
			if ( empty( $woocommerce_loop['columns'] ) ) {
				$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
			}
			if(!is_product_category()){
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
			} else{
				switch ($category_cols) {
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
			$terms = get_terms( 'product_cat', array(
			'hierarchical'  => false,
			'hide_empty'        => true,
			'order' => 'random'
			) );
			?>
			<div class="text-center product_archives woocommerce <?php echo esc_attr($cols_md);?> <?php echo esc_attr($product_type_class);?>">
				<?php woocommerce_product_loop_start(); ?>					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?> 
			</div>
			<div class="toolbar-bottom clearfix">
				<?php if (is_tax('product_cat')):?>
					<?php $product_pagination = get_metadata('product_cat', $woo_cat, 'product_pagination', true); ?>
				<?php else: ?>
					<?php $product_pagination = isset($cryptcio_settings['product-pagination'])?$cryptcio_settings['product-pagination']:''; ?>
				<?php endif; ?>
				<?php if($product_pagination == 'pagination') :?>
					<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>
				<?php else: ?>
					<?php if ($wp_query->max_num_pages > 1) : ?>			
						<?php if (get_next_posts_link()) { ?>
							<div class="load-more">
								<div class="load_more_button">
									<span data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>">
										<?php echo get_next_posts_link(__('View more', 'cryptcio')); ?>
									</span>
								</div>
							</div>
						<?php } ?>				
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php else:
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );	
	endif; ?>
</div>
<?php get_sidebar('right'); ?>
<?php get_footer( 'shop' ); ?>
