<?php
//remove action
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_before_shop_loop','woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10 ); 
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
//add action
add_action('woocommerce_related_after', 'woocommerce_output_related_products', 10);
add_action( 'woocommerce_shop_loop_item_title', 'cryptcio_template_title_custom', 10 );
add_action('init', 'woocommerce_clear_cart_url');
add_action( 'woocommerce_before_shop_loop_item_title', 'cryptcio_template_loop_product_thumbnail',10 ); 
add_action('woocommerce_after_shop_loop_item_title', 'cryptcio_woocommerce_single_excerpt', 40);
//product action
add_action('woocommerce_product_action_cart', 'woocommerce_template_loop_add_to_cart', 5);
add_action('woocommerce_product_action', 'cryptcio_quickview', 30);
add_action('woocommerce_product_action', 'cryptcio_wishlist_custom', 10);
add_action('woocommerce_product_action', 'cryptcio_compare_product', 20);
add_action('woocommerce_product_action', 'cryptcio_product_permalink', 35);
add_action('woocommerce_single_product_summary','cryptcio_template_single_excerpt',20);
//end product action

add_action('woocommerce_template_single_add_to_cart','cryptcio_wishlist_custom', 30);
add_action('woocommerce_archive_top_toolbar', 'cryptcio_product_loop_view_mode', 30);
if(isset($cryptcio_settings['product-sortby']) && $cryptcio_settings['product-sortby']){
	add_action('woocommerce_archive_top_toolbar','woocommerce_catalog_ordering', 10);
}
add_action('woocommerce_archive_top_toolbar', 'cryptcio_view_count', 20);
//add_action('woocommerce_archive_top_toolbar','cryptcio_get_search_form_woo', 30);
add_action('woocommerce_archive_top_toolbar_bottom', 'woocommerce_result_count', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 8 );
add_action( 'woocommerce_single_product_summary', 'cryptcio_stock_text_shop_page', 7 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 6 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
add_action('woocommerce_single_product_summary','cryptcio_single_info', 35);
add_action( 'woocommerce_single_product_summary', 'cryptcio_sharing', 50 );
add_action('woocommerce_after_single_product_summary','cryptcio_product_pagination',5);
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 12 );
add_action( 'yith_wcqv_product_summary', 'cryptcio_sharing', 30);
add_action('woocommerce_before_shop_loop_item_title_packery','woocommerce_show_product_loop_sale_flash',10);
//remove filter
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
//add filter
add_filter( 'wp_calculate_image_srcset', 'cryptcio_disable_srcset' );
add_filter('loop_shop_per_page', 'cryptcio_product_shop_per_page', 20);
add_filter( 'gettext', 'cryptcio_sort_change', 20, 3 );
add_filter('woocommerce_add_to_cart_fragments', 'cryptcio_woocommerce_header_add_to_cart_fragment');
add_filter('woocommerce_checkout_fields', 'cryptcio_custom_override_checkout_fields');
add_filter("woocommerce_checkout_fields", "cryptcio_order_fields");
add_filter("woocommerce_checkout_fields", "cryptcio_order_shipping_fields");
add_filter('woocommerce_product_get_rating_html', 'cryptcio_get_rating_html', 10, 2);
add_filter( 'woocommerce_product_tabs', 'cryptcio_overide_product_tabs', 98 );
//add placeholder for checkout postcode field
add_filter( 'woocommerce_default_address_fields' , 'cryptcio_override_default_address_fields' );
//Define woocommerce support
add_action( 'after_setup_theme', 'cryptcio_woocommerce_support' );
add_filter( 'woocommerce_subcategories', 'woocommerce_maybe_show_product_subcategories' );
add_filter( 'woocommerce_product_add_to_cart_text' , 'cryptcio_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'cryptcio_woocommerce_product_add_to_cart_text' );
add_filter('woocommerce_get_price_html', 'cryptcio_changeFreePriceNotice', 10, 2);
add_action('woocommerce_product_image','cryptcio_woocommerce_product_image',10);

// Function
if ( ! function_exists( 'woocommerce_subcategories' ) ) {

	/**
	 * Output the start of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function woocommerce_subcategories( $echo = true ) {
		ob_start();

		$loop_start = apply_filters( 'woocommerce_subcategories', ob_get_clean() );

		if ( $echo ) {
			echo $loop_start; // WPCS: XSS ok.
		} else {
			return $loop_start;
		}
	}
}
function cryptcio_product_pagination(){
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    global $cryptcio_settings;
    $cryptcio_single_prd_pagination='';
    if(cryptcio_get_meta_value('single_prd_pagination')!=''){
        $cryptcio_single_prd_pagination =cryptcio_get_meta_value('single_prd_pagination');
    }elseif(isset($cryptcio_settings['single_prd_pagination']) && $cryptcio_settings['single_prd_pagination']){
         $cryptcio_single_prd_pagination=$cryptcio_settings['single_prd_pagination'];
    }
    ?>
    <?php if(($prev_post  || $next_post) && $cryptcio_single_prd_pagination!=''):?>
      <div class="clearfix">
            <div class="prev_nex_paginations text-center">
              <ul>
                  <?php
                  if($prev_post){
                  previous_post_link('<li class="arrow_left"><a href="'.get_permalink( $prev_post->ID ).'" class="btn btn-border-radius"><i class="fa fa-angle-double-left" aria-hidden="true"></i>'.esc_html__(' Prev Entry','cryptcio').'</a></li>', '');
                  } ?>
                  <?php
                  if($next_post){
                  next_post_link('<li class="arrow_right"><a href="'.get_permalink( $next_post->ID ).'" class="btn btn-border-radius btn-icon">'.esc_html__(' Next Entry','cryptcio').'<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>', '');
                  } ?>            
              </ul>
            </div>
      </div>
    <?php endif;   
}
function cryptcio_woocommerce_product_image(){
    global $product, $woocommerce_loop;
    if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') && ($woocommerce_loop['product_style'] == 'style-2')){
		$index_size2 = array('1','4','7','10','13','15','18','21','24','27','30');
	}elseif(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery') && ($woocommerce_loop['product_style'] == 'style-1')){
		$index_size2 = array('6','12','20','26','34','40','48','54');
	}
	if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')): ?>
        <?php if(in_array($woocommerce_loop['i'], $index_size2)): ?>
            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
                <?php echo woocommerce_get_product_thumbnail('crypto_shop'); ?> 
            </a>
        <?php else: ?>
            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
                <?php echo woocommerce_get_product_thumbnail('crypto_shop'); ?> 
            </a>
        <?php endif;?>
        <?php
            /**
             * woocommerce_before_shop_loop_item_title_packery hook.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title_packery' );
        ?>
    <?php elseif(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'list') || isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'list-slider')): ?>
        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
          <?php echo woocommerce_get_product_thumbnail('shop_thumbnail'); ?>              
        </a>
    <?php else: ?>
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
    <?php endif; 
}
if(!function_exists('cryptcio_woocommerce_product_add_to_cart_text')){
    function cryptcio_woocommerce_product_add_to_cart_text() {
        global $product;
        $product_type = $product->get_type();
        if (!$product->is_in_stock()) {
            return esc_html__('Out of Stock','cryptcio'); 
        }else{    
          if(null!==get_post_meta( $product->get_id(), '_cryptcio_woo_btn_text', true )&&get_post_meta( $product->get_id(), '_cryptcio_woo_btn_text', true )!=''){
              return esc_html(get_post_meta( $product->get_id(), '_cryptcio_woo_btn_text', true ));
          }else{
              switch ( $product_type ) {
                  case 'simple':
                      return esc_html__('Add to cart','cryptcio');
                  break;
              
                  case 'grouped':
                      return esc_html__('Buy Product','cryptcio');
                  break;
                  case 'external':
                      return esc_html__('Buy Product','cryptcio');
                  break;
                  case 'variable':
                      return esc_html__('Select Options','cryptcio');
                  break;
                  default:
                      return esc_html__( 'Read more', 'cryptcio' );
              }
          }   
        }     
    }    
}
function cryptcio_product_permalink(){
    global $product,$cryptcio_settings;
    $class="";
    if(isset($cryptcio_settings['product-link']) && $cryptcio_settings['product-link']){
        $class=' cryptcio_setting_show_prd_link ';
    }
    if(null!==get_post_meta( $product->get_id(), '_cryptcio_prd_link', true )&&get_post_meta( $product->get_id(), '_cryptcio_prd_link', true )!=''){?>
        <div class="action_item prd_permalink <?php echo esc_attr($class);?>"><a target="_blank" href="<?php echo esc_url(get_post_meta( $product->get_id(), '_cryptcio_prd_link', true ) );?>" ><i class="fa fa-link"></i></a></div>
    <?php }else{?>
            <div class="action_item prd_permalink <?php echo esc_attr($class);?>"><a target="_blank" href="<?php echo esc_url( get_permalink( $product->get_id() ) );?>" ><i class="fa fa-link"></i></a></div>
    <?php }

}
function cryptcio_changeFreePriceNotice($price, $product) {
    if ( $price == wc_price( 0.00 ) )
        return '<span class="amount">'.esc_html__('FREE','cryptcio').'</span>';
    else
        return $price;
}
function cryptcio_get_search_form_woo(){
    ?>
    <div class="search-post-shop">
        <?php echo cryptcio_get_search_form_shop(); ?>
    </div>
    <?php
}
function cryptcio_disable_srcset( $sources ) {
  return false;
}
function cryptcio_single_info(){
    global $product, $cryptcio_settings;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
    <?php if (class_exists('YITH_WCWL') && $cryptcio_settings['product-wishlist'] || ($compare && $cryptcio_settings['product-compare'])):?>
    <div class="add-to">
            <?php    
            if (class_exists('YITH_WCWL') && $cryptcio_settings['product-wishlist']) {
                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
            }
            ?>
        <?php
        if ($compare && $cryptcio_settings['product-compare']){
                printf('<div class="add-to-compare"><a title="'.esc_html__("compare","cryptcio").'" data-toggle="tooltip" data-placement="top" href="%s" class="%s" data-product_id="%d"><i class="fa fa-random"></i></a></div>', cryptcio_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'cryptcio'));
            }
        ?>
    </div>
    <?php endif;?>
    <?php
}
function cryptcio_stock_text_shop_page() {
    global $product;
     $availability = $product->get_availability();
    if ( $product->is_in_stock()) {
        echo '<div class="availability"><strong>' . esc_html__( 'Availability: ', 'cryptcio') . '</strong><span class="stock">' .$product->get_stock_quantity(). esc_html__( ' In Stock & Ready to Ship', 'cryptcio') . '</span></div>';
    }
    else{
         echo '<div class="availability"><strong>' . esc_html__( 'Availability: ', 'cryptcio') . '</strong><span class="stock">' . esc_html__( 'Out Stock', 'cryptcio') . '</span></div>';
    }
}
function cryptcio_compare_product(){
    global $product, $cryptcio_settings;
    $compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
    ?>
    <?php
    if ($compare && $cryptcio_settings['product-compare']){
            printf('<div class="action_item compare_product"><a title="'.esc_html__("Compare","cryptcio").'" data-toggle="tooltip" data-placement="top" href="%s" class="%s" data-product_id="%d"><i class="fa fa-random"></i></a></div>', cryptcio_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id());
        }
    ?>
    <?php
}   
function cryptcio_add_compare_action($product_id) {
    $action = 'yith-woocompare-add-product';
    $url_args = array('action' => $action, 'id' => $product_id);
    return wp_nonce_url(add_query_arg($url_args), $action);
}
function cryptcio_quickview(){
    global $product, $cryptcio_settings;
    $quickview = (get_option( 'yith-wcqv-enable', 'yes' ) == 'yes'); 
    ?>
    <?php 
        if(function_exists('is_plugin_active') && is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) && $quickview && $cryptcio_settings['product-quickview']){
            printf('<div class="quick-view action_item" data-toggle="tooltip" data-placement="top" title="'.esc_html__("Quick view","cryptcio").'"><a href="#" class="yith-wcqv-button" data-product_id="%d" title=""><i class="fa fa-search-plus"></i></a></div>', $product->get_id(), esc_html__('Quick View', 'cryptcio'), esc_html__('Quick View', 'cryptcio'));
        }
    ?>
    <?php
}
function cryptcio_wishlist_custom(){
    global $cryptcio_settings;
    ?>
    <?php if (class_exists('YITH_WCWL') && isset($cryptcio_settings['product-wishlist']) && $cryptcio_settings['product-wishlist']) :?>
    <div class="action_item wishlist-btn">
            <?php    
                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
            ?>
    </div>
    <?php endif;?>
    <?php
}
//count view
function cryptcio_view_count(){
    global $cryptcio_settings, $wp_query, $woocommerce_loop;
	$cat = $wp_query->get_queried_object();
	if(isset($cat->term_id)){
		$woo_cat = $cat->term_id;
	}else{
		$woo_cat = '';
	}
	$category_item = $cryptcio_settings['category-item'];
	if (is_product_category()){
		if(get_metadata('product_cat', $woo_cat, 'category_item', true) != ''){
			$category_item = get_metadata('product_cat', $woo_cat, 'category_item', true);
		}else{
			$category_item = $cryptcio_settings['category-item'];
		}
		
	}
    if ($category_item != '') {
        $per_page = explode(',', $category_item);
    } else {
        $per_page = explode(',', '18,24,36');
    }
    $page_count = cryptcio_product_shop_per_page();
    ?>
	<?php if(isset($cryptcio_settings['product-result-count']) && $cryptcio_settings['product-result-count']): ?>
		<form class="woocommerce-viewing result-count" method="get">
			<label><?php echo esc_html__('Show:', 'cryptcio') ?> </label>
			<select name="count" class="count">
				<?php foreach ( $per_page as $count ) : ?>
					<option value="<?php echo esc_attr( $count ); ?>" <?php selected( $page_count, $count ); ?>><?php echo esc_html( $count ); ?></option>
				<?php endforeach; ?>
			</select>
			<input type="hidden" name="paged" value=""/>
			<?php
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'count' === $key || 'submit' === $key || 'paged' === $key ) {
					continue;
				}
				if ( is_array( $val ) ) {
					foreach( $val as $innerVal ) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					}
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			}
			?>
		</form>
	<?php endif;?>
    <?php
}
//grid and list cart
function cryptcio_product_loop_view_mode() {
    global $cryptcio_settings, $wp_query;
    $cat = $wp_query->get_queried_object();
    if(isset($cat->term_id)){
    $woo_cat = $cat->term_id;
    }else{
        $woo_cat = '';
    }
  $product_list_mode = $cryptcio_settings['product-layouts'];
  if(is_tax('product_cat')){
      $product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
  }
    ?>
	<?php if(isset($cryptcio_settings['product-view-mode']) && $cryptcio_settings['product-view-mode']): ?>
        <div class="viewmode-toggle">
            <?php if($product_list_mode == 'only-list' || $product_list_mode == 'only-grid') : ?>
                <?php if($product_list_mode == 'only-list') : ?>
                <a href="#" id="list_mode" class="active" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'cryptcio') ?>"><i class="lnr lnr-list"></i></a>
                <?php endif;?>
                <?php if($product_list_mode == 'only-grid') : ?>
                <a href="#" id="grid_mode" class="active" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'cryptcio') ?>"><i class="pe-7s-keypad"></i></a>
                <?php endif;?>                
            <?php else:?>
                <?php if($product_list_mode == 'grid-default') : ?>
                <a class="black_button_active" href="#" id="grid_mode" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'cryptcio') ?>"><i class="pe-7s-keypad"></i></a>
                <a href="#" id="list_mode" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'cryptcio') ?>"><i class="lnr lnr-list"></i></a>
                <?php elseif($product_list_mode == 'list-default') : ?>
                  <a  href="#" id="grid_mode" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'cryptcio') ?>"><i class="pe-7s-keypad"></i></a>
                <a href="#" class="black_button_active" id="list_mode" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'cryptcio') ?>"><i class="lnr lnr-list"></i></a>
                <?php elseif($product_list_mode == 'only-grid'):?>
                   <a class="black_button_active" href="#" id="grid_mode" data-isotope-layout="grid" data-isotope-container=".product-isotope" title="<?php echo esc_html__('Grid View', 'cryptcio') ?>"><i class="pe-7s-keypad"></i></a>
                <?php elseif($product_list_mode == 'only-list'):?>
                  <a href="#" class="black_button_active" id="list_mode" data-isotope-layout="list" data-isotope-container=".product-isotope" title="<?php echo esc_html__('List View', 'cryptcio') ?>"><i class="lnr lnr-list"></i></a>
                <?php endif;?>
            <?php endif;?>
        </div> 
	<?php endif;?>
    <?php
}

function cryptcio_override_default_address_fields( $address_fields ) {
    $address_fields['postcode']['placeholder'] = esc_html__('Postcode / Zip *','cryptcio');

    return $address_fields;
}
function cryptcio_get_rating_html($rating_html, $rating) {
global $product;
$review_count = $product->get_review_count();
$rating_html ='';
  if ( $rating > 0 ) {
    $title = sprintf( esc_html__( 'Rated %s out of 5', 'cryptcio' ), $rating );
  } else {
    $title = esc_html__('Not yet rated','cryptcio');
    $rating = 0;
  }
  if ( 0 < $rating ) {

      $rating_html  = '<div class="star_rating_wrap"><div class="star-rating" title="' . $title . '">';
      $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'cryptcio' ) . '</span>';
      $rating_html .= '</div>';
      $rating_html .= '<p>'.sprintf(_n( '(Based on 1 review)', '(Based on %d reviews)', $review_count, 'cryptcio' ),number_format_i18n( $review_count )).'</p></div>';
    }else{
        $rating_html ='';
    }

  return $rating_html;
}
//add theme support woocommerce
function cryptcio_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );   
}

function cryptcio_overide_product_tabs( $tabs ) {
    global $cryptcio_settings, $product,$post;
    if ( $post->post_content ) {
        if(isset($cryptcio_settings['product-destab-name']) && $cryptcio_settings['product-destab-name'] !=''){
            $tabs['description']['title'] = $cryptcio_settings['product-destab-name'];  
        }     
    } 
    
    if(isset($cryptcio_settings['product-reviewtab']) && $cryptcio_settings['product-reviewtab']){
        unset( $tabs['reviews'] );
    }else{
        if ( comments_open() ) {
            if(isset($cryptcio_settings['product-reviewtab-name']) && $cryptcio_settings['product-reviewtab-name'] !=''){
                $tabs['reviews']['title'] = $cryptcio_settings['product-reviewtab-name'];      
            }     
        }   
    }   
    
    if(isset($cryptcio_settings['product-infotab']) && $cryptcio_settings['product-infotab']) {
        unset( $tabs['additional_information'] );  
    }else{
        if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {            
            if(isset($cryptcio_settings['product-infotab-name']) && $cryptcio_settings['product-infotab-name'] !=''){
                $tabs['additional_information']['title'] = $cryptcio_settings['product-infotab-name']; 
            }        
        } 
    }

    return $tabs;
}
function cryptcio_template_loop_product_thumbnail() {
    global $product;
    $second_image = '';
    $attachment_ids = $product->get_gallery_image_ids();
    if (count($attachment_ids) && isset($attachment_ids[0])) {
            $second_image = wp_get_attachment_image($attachment_ids[0], 'shop_catalog');
    }
    ?>
    <?php if ($second_image != ''): ?>
    <div class="product-image-slider">
		<a class="img-first" href="<?php the_permalink(); ?>">
			<?php echo  woocommerce_get_product_thumbnail(); ?>  
		</a>
		<a class="img-last" href="<?php the_permalink(); ?>">
			<?php echo wp_kses($second_image ,array(
			  'img' =>  array(
				'width' => array(),
				'height'  => array(),
				'src' => array(),
				'class' => array(),
				'alt' => array(),
				'id' => array(),
				)
			));?> 
		</a>     
    </div>
    <?php else:?>
        <a href="<?php the_permalink(); ?>">
            <?php echo  woocommerce_get_product_thumbnail(); ?>
        </a>
    <?php endif; ?>
    <?php
}
function cryptcio_product_image(){
    global $post, $product, $woocommerce;
?>
    <div class="images">
        <?php
            if ( has_post_thumbnail() ) {
                $attachment_count = count( $product->get_gallery_image_ids() );
                $gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
                $props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                    'title'  => $props['title'],
                    'alt'    => $props['alt'],
                    'data-zoom-image' => $image_link,
                    'class' => 'gallery-img zoom',    
                ) );
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $props['url'], $props['caption'], $image ), $post->ID );
            } else {
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'cryptcio' ) ), $post->ID );
            }

        ?>
    </div>
    <?php 
        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids ) {
            $loop       = 0;
            $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
            ?>
            <div data-max-items="4" class="owl-prd-thumbnail thumbnails <?php echo 'columns-' . $columns; ?>"><?php

                foreach ( $attachment_ids as $attachment_id ) {

                    $classes = array( 'zoom' );

                    if ( $loop === 0 || $loop % $columns === 0 )
                        $classes[] = 'first';

                    if ( ( $loop + 1 ) % $columns === 0 )
                        $classes[] = 'last';

                    $image_link = wp_get_attachment_url( $attachment_id );

                    if ( ! $image_link )
                        continue;

                    $image_title    = esc_attr( get_the_title( $attachment_id ) );
                    $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                        'title' => $image_title,
                        'alt'   => $image_title
                        ) );

                    $image_class = esc_attr( implode( ' ', $classes ) );

                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-image="'.$image_link.'" data-image-zoom="'.$image_link.'">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

                    $loop++;
                }

            ?></div>
            <?php
        }
    ?>
    <?php
}

function cryptcio_sharing(){
    global $cryptcio_settings,$product;
    $single_style =  get_post_meta($product->get_id(), 'single_style', true);
    if($single_style == 'default' && isset( $cryptcio_settings['single-product-style']) ){
      $single_style = $cryptcio_settings['single-product-style'];
    }    
    if($single_style=='5'){
      $cryptcio_product_share = isset($cryptcio_settings['product5-share'])?$cryptcio_settings['product5-share']:'';
    }else{
      $cryptcio_product_share = isset($cryptcio_settings['product-share'])?$cryptcio_settings['product-share']:'';
    }
    $cryptcio_product_print = isset($cryptcio_settings['print_shortcode'])?$cryptcio_settings['print_shortcode']:'';
    
    if(isset($cryptcio_product_share) && $cryptcio_product_share!='' && (in_array('facebook', $cryptcio_product_share) || in_array('twitter', $cryptcio_product_share) || in_array('pin', $cryptcio_product_share) || in_array('skype', $cryptcio_product_share) || in_array('youtube', $cryptcio_product_share)|| in_array('linkedin', $cryptcio_product_share) )):?>
        <div class="product-share">
			<?php echo '<h5>'.esc_html__('Share:','cryptcio').'</h5>'; ?>
			<?php if (isset($cryptcio_product_share) && in_array('facebook', $cryptcio_product_share)) : ?>
				<a class="fb-share" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i> <span><?php echo esc_html__('Share','cryptcio'); ?></span> </a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('twitter', $cryptcio_product_share)) : ?>
				<a class="tw-share" href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-twitter"></i> <span><?php echo esc_html__('Twitter','cryptcio'); ?></span></a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('google', $cryptcio_product_share)) : ?>
				<a class="gg-share" href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i>  <span><?php echo esc_html__('Google+','cryptcio'); ?></span></a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('pin', $cryptcio_product_share)) : ?>
				<a class="pt-share" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id() )); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span><?php echo esc_html__('Pinterest','cryptcio'); ?></span></a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('skype', $cryptcio_product_share)) : ?>
				<a class="sky-share" href="https://www.skype.com/en/sharer?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-skype"></i> <span><?php echo esc_html__('Skype','cryptcio'); ?></span></a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('youtube', $cryptcio_product_share)) : ?>
				<a class="yt-share" href="https://www.youtube.com/sharer?url=<?php echo urlencode(get_the_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id() )); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-youtube"></i> <span><?php echo esc_html__('Youtube','cryptcio'); ?></span></a>
			<?php endif;?>
			<?php if (isset($cryptcio_product_share) && in_array('linkedin', $cryptcio_product_share)) : ?>
				<a class="li-share" href="http://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span><?php echo esc_html__('Linkedin','cryptcio'); ?></span></a>
			<?php endif;?>
			<div class="share-type">
				<?php if(isset($cryptcio_product_print) && $cryptcio_product_print!=''):?>
					<?php echo do_shortcode($cryptcio_product_print);?>                     
				<?php endif;?>  
				<?php if (isset($cryptcio_product_share) && in_array('email', $cryptcio_product_share)) : ?>
					<a href="mailto:blank?subject=<?php echo( basename(get_permalink()) );?>&amp;body=<?php the_permalink() ?>"><i class="fa fa-envelope-o"></i> <span><?php echo esc_html__('Email to Friends','cryptcio'); ?></span></a>
				<?php endif;?>
			</div>
		</div>
    <?php endif;
}
function cryptcio_template_title_custom() {
    ?>
    <h3><a href="<?php the_permalink(); ?>" class="product-name"><?php the_title(); ?></a></h3>
    <?php
}
function cryptcio_template_single_excerpt(){
    global $post,$cryptcio_settings,$product;
    $single_style =  get_post_meta($product->get_id(), 'single_style', true);
    if($single_style == 'default' && isset( $cryptcio_settings['single-product-style']) ){
      $single_style = $cryptcio_settings['single-product-style'];
    }
    if($single_style=='5'){
      the_content();
    }else{
      wc_get_template( 'single-product/short-description.php' );
    }
}
function cryptcio_woocommerce_single_excerpt() {
    global $post;
	
    if ( ! $post->post_excerpt ) {
        return;
    }
    ?>
    <div class="desc">
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?> 
    </div>
    <?php
}
function cryptcio_product_shop_per_page() {
    global $cryptcio_settings, $wp_query, $woocommerce_loop;
	$cat = $wp_query->get_queried_object();
	if(isset($cat->term_id)){
		$woo_cat = $cat->term_id;
	}else{
		$woo_cat = '';
	}
	$category_item = $cryptcio_settings['category-item'];
	if (is_product_category()){
		if(get_metadata('product_cat', $woo_cat, 'category_item', true) != ''){
			$category_item = get_metadata('product_cat', $woo_cat, 'category_item', true);
		}else{
			$category_item = $cryptcio_settings['category-item'];
		}
		
	}
    parse_str($_SERVER['QUERY_STRING'], $params);
	
    // replace it with theme option
    if ($category_item != '') {
        $per_page = explode(',', $category_item);
    } else {
        $per_page = explode(',', '18,24,36');
    }

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

    return $item_count;
}
function cryptcio_order_fields($fields) {
    $order = array(
        "billing_country",
        "billing_state",
        "billing_first_name", 
        "billing_last_name", 
        "billing_company", 
        "billing_address_1", 
        "billing_address_2",
        "billing_city",   
        "billing_postcode",       
        "billing_email", 
        "billing_phone",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}
function cryptcio_order_shipping_fields($fields) {
    $order = array(
        "shipping_country",
        "shipping_state",
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company", 
        "shipping_address_1",
        "shipping_address_2",
        "shipping_city",        
        "shipping_postcode",
        "shipping_phone",       
        "shipping_email",        
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }

    $fields["shipping"] = $ordered_fields;
    return $fields;

}
//update cart items on minicart
function cryptcio_woocommerce_header_add_to_cart_fragment($fragments) {
    $_cartQty = WC()->cart->cart_contents_count;
    $fragments['#mini-scart .cart_count'] = '<p class="cart_count">' . $_cartQty . '</p>';
    $fragments['#mini-scart .cart_nu_count'] = '<p class="cart_nu_count">' . $_cartQty . '</p>';
    $fragments['.count-item p .cart_nu_count2'] = '<span class="cart_nu_count2">' . $_cartQty . '</span>';    
    $fragments['.cart_label .text-items'] = '<span class="text-items">' . $_cartQty . '</span>'; 
    $fragments['.cart_label .ajax-cart'] = '<span class="ajax-cart">' . $_cartQty . '</span>';    
    return $fragments;
}
//update wishlist items on header
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
  function yith_wcwl_ajax_update_count(){
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }
  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

// check for empty-cart get param to clear the cart
function woocommerce_clear_cart_url() {
    global $woocommerce;
    if (isset($_GET['empty-cart'])) {
        $woocommerce->cart->empty_cart();
    }
}
function cryptcio_custom_override_checkout_fields($fields) {

    $fields['billing']['billing_first_name'] = array(
        'label' => esc_html__('First Name','cryptcio'),
        'placeholder' => _x('First Name *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['billing']['billing_last_name'] = array(
        'label' => esc_html__('Last Name','cryptcio'),
        'placeholder' => _x('Last Name *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['billing']['billing_company'] = array(
        'label' => '',
        'placeholder' => _x('Company Name', 'placeholder', 'cryptcio'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_1'] = array(
        'label' => '',
        'placeholder' => _x('Address', 'placeholder', 'cryptcio'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['billing']['billing_address_2'] = array(
        'label' => '',
        'placeholder' => _x('Enter Your Apartment', 'placeholder', 'cryptcio'),
        'required' => false,
    );
    $fields['billing']['billing_city'] = array(
        'label' => esc_html__('City','cryptcio'),
        'placeholder' => _x('City *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['billing']['billing_email'] = array(
        'label' => esc_html__('Email Address','cryptcio'),
        'placeholder' => _x('E-mail *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['billing']['billing_phone'] = array(
        'label' => esc_html__('Phone','cryptcio'),
        'placeholder' => _x('Phone *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['billing']['billing_state'] = array(
        'label' => esc_html__('State / County','cryptcio'),
        'placeholder' => _x('State / County', 'placeholder', 'cryptcio'),
        'required' => false,
    );
    $fields['shipping']['shipping_phone'] = array(
        'label' => esc_html__('Phone','cryptcio'),
        'placeholder'   => _x('Phone Number *', 'placeholder', 'cryptcio'),
        'required'  => true,
     );
    $fields['shipping']['shipping_first_name'] = array(
        'label' => esc_html__('First Name','cryptcio'),
        'placeholder' => _x('First Name *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['shipping']['shipping_last_name'] = array(
        'label' => esc_html__('Last Name','cryptcio'),
        'placeholder' => _x('Last Name *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['shipping']['shipping_company'] = array(
        'label' => esc_html__('Company Name','cryptcio'),
        'placeholder' => _x('Company Name', 'placeholder', 'cryptcio'),
        'required' => false,
        'class'     => array('form-row-wide'),
    );
    $fields['shipping']['shipping_city'] = array(
        'label' => esc_html__('City','cryptcio'),
        'placeholder' => _x('City *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['shipping']['shipping_state'] = array(
        'label' => esc_html__('Enter State/Country','cryptcio'),
        'placeholder' => _x('Enter State/Country', 'placeholder', 'cryptcio'),
        'required' => false,
    );
    $fields['shipping']['shipping_email'] = array(
        'label' => esc_html__('Email Address','cryptcio'),
        'placeholder' => _x('E-mail *', 'placeholder', 'cryptcio'),
        'required' => true,
    );
    $fields['shipping']['shipping_address_1'] = array(
        'label' => esc_html__('Adress','cryptcio'),
        'placeholder' => _x('Address *', 'placeholder', 'cryptcio'),
        'required' => true,
        'class'     => array('form-row-wide'),
    );
    $fields['order']['order_comments'] = array(
        'label' => esc_html__('Order notes','cryptcio'),
        'placeholder' => _x('Order Notes', 'placeholder', 'cryptcio'),
        'required' => false,
        'type' => 'textarea',
        'class'     => array('form-row-wide'),
    );
    

    return $fields;
}
function cryptcio_sort_change( $translated_text, $text, $domain ) {

    if ( is_woocommerce() ) {

        switch ( $translated_text ) {
            case 'Sort by popularity' :

                $translated_text = esc_html__( 'Popularity', 'cryptcio' );
                break;
            case 'Sort by average rating' :

                $translated_text = esc_html__( 'Average rating', 'cryptcio' );
                break;    
            case 'Sort by newness' :

                $translated_text = esc_html__( 'Newest', 'cryptcio' );
                break;
            case 'Sort by price: low to high' :

                $translated_text = esc_html__( 'Low to high', 'cryptcio' );
                break;    
            case 'Sort by price: high to low' :

                $translated_text = esc_html__( 'High to low', 'cryptcio' );
                break;    
        }

    }

    return $translated_text;
} 
add_action('cryptcio_get_product_image','cryptcio_get_product_image');
function cryptcio_get_product_image(){
    global $post, $product;
    $thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
    $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
    $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );  
	$single_style = cryptcio_get_product_single_style();		
	?>
    <figure class="woocommerce-product-gallery__wrapper">          
		<?php
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids && has_post_thumbnail() ) {?>
			<?php foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$attributes      = array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);
				$html  = '<div data-thumb="' .  esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a data-fancybox="images" href="' . esc_url( $full_size_image[0] ) . '">';
				if( $single_style == '2'){
					$html .= wp_get_attachment_image( $attachment_id, 'cryptcio-shop-single', false );
				}else{
					$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
				}
				$html .= '</a></div>';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}?>
			<?php
		}else{
			$attributes = array(
				'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
				'class'           => 'zoom',
			);

			if ( has_post_thumbnail() ) {
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a <a data-fancybox="images" href="' . esc_url( $full_size_image[0] ) . '">';
				if( $single_style == '2'){
					$html .= get_the_post_thumbnail( $post->ID, 'cryptcio-shop-single', $attributes );
				}else{
					$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
				}
				$html .= '</a></div>';
			}else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'cryptcio' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
		}
		?>
    </figure>

  <?php 
}
