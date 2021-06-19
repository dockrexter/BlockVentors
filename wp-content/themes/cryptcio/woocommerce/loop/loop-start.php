<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
?>
<?php 
global $wp_query, $product, $woocommerce_loop;
$cryptcio_settings = cryptcio_check_theme_options();
$cat = $wp_query->get_queried_object();
if(isset($cat->term_id)){
	$woo_cat = $cat->term_id;
}else{
	$woo_cat = '';
}
$product_layout = isset($cryptcio_settings['product-layouts'])?$cryptcio_settings['product-layouts']:'';
$product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
$product_type_class = '';
if($product_list_mode == "only-grid" || $product_list_mode == "grid-default"){
	$product_type_class = "product-grid product-grid-style1 load-item isotope";
	if(cryptcio_get_meta_value('product_style')=='style2'){
		$product_type_class .= " product-grid-style2 ";
	}	
}else if( $product_list_mode == "list-default"){
	$product_type_class = "product-list isotope";
}else if(($product_list_mode == "only-list") || ($product_layout == "only-list") ){
	$product_type_class = "product-list ";
	if(cryptcio_get_meta_value('product_style')=='style2'){
		$product_type_class .= " product-list-style3 ";
	}	
}else if(($product_list_mode == "only-grid") || is_shop()){
	$product_type_class = "product-grid load-item isotope";
}else if( isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') || isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'grid')){
	$product_type_class = "product-grid load-item isotope";
}else{
	$product_type_class = "product-grid";
}

$classes = "";
if (isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') || isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'grid')){
	$classes = ' isotope';
}
   
?>
<div class="product_types <?php echo esc_attr($product_type_class);?>">


