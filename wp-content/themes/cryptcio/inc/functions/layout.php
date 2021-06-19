<?php    
//get search template
if ( ! function_exists( 'cryptcio_get_search_form' ) ) {
    function cryptcio_get_search_form() {
        global $cryptcio_settings;
        $template = get_search_form(false);
        $header_type = cryptcio_get_header_type();   
        $output = '';
        ob_start();
        ?>
        <?php if(isset($cryptcio_settings['header_search_style']) && $cryptcio_settings['header_search_style'] =='2'):?>
            <div class="search-holder">
                <span class="btn-search search_button" ><i class="<?php echo esc_html($cryptcio_settings['header-search-icon']); ?>"></i></span>
                <div class="searchform_wrap">
                    <div class="search-title">
                        <a href="" class="close_search_form">
                            <span class="fa fa-close"></span>
                        </a>
                        <p><?php echo esc_html__('Search','cryptcio'); ?></p>
                    </div>
                    <div class="vc_child h_inherit relative">
                         <?php echo wp_kses($template,cryptcio_allow_html()); ?>
                    </div>
                </div>     
            </div>           
        <?php else:?>
            <span class="btn-search"><i class="<?php echo esc_html($cryptcio_settings['header-search-icon']); ?>"></i></span>        
            <div class="top-search content-filter">
                <?php echo wp_kses($template,cryptcio_allow_html()); ?>
            </div>     
        <?php endif;?>   
        <?php
        $output .= ob_get_clean();
        return $output;
    }
}

//mini cart template
if ( class_exists( 'WooCommerce' ) ) {
    if ( ! function_exists ( 'cryptcio_get_minicart_template' ) ) {
        function cryptcio_get_minicart_template() {
			global $cryptcio_settings;
            $cart_item_count = WC()->cart->cart_contents_count;
            $cart_item_qty = WC()->cart->get_cart_total();
            $header_type = cryptcio_get_header_type();
            if($header_type =='5'){
                $header_cart_icon = isset($cryptcio_settings['header5-cart-icon'])? $cryptcio_settings['header5-cart-icon']:'';
            }else{
                $header_cart_icon = isset($cryptcio_settings['header-cart-icon'])?$cryptcio_settings['header-cart-icon']:'';
            }
            $output = '';
            ob_start();
            ?>

                <div class="cart_label display-flex">
                    <div class="text-header">
						<div class="minicart-content">
							<span class="title-mycart"><?php echo esc_html__('My Cart ','cryptcio'); ?></span>
							<?php if($cart_item_count > 0): ?>
                                <?php printf( _n( '<span class="text-items">1</span>', '<span class="text-items">%1$s</span>', $cart_item_count, 'cryptcio' ),
                    number_format_i18n( $cart_item_count ) ); ?>
							<?php else: ?>
								<span class="text-items"><?php echo esc_html__('0','cryptcio'); ?></span>
							<?php endif; ?>
							<p class="cart_qty"><?php echo wp_kses($cart_item_qty,cryptcio_allow_html());?></p>
						</div>
						<div class="icon-header">
							<i class="<?php echo esc_html($header_cart_icon); ?>"></i>
						</div>
                    </div>
                </div>                    
                <div class="cart-block content-filter">
                    <?php if($cart_item_count > 0): ?>
                    <div class="count-item">
                        <p><?php echo wp_sprintf( __( 'You have <span class="cart_nu_count2"> %s </span> item(s) in your cart','cryptcio' ), esc_html($cart_item_count) );?></p>
                    </div>
                    <?php endif; ?>
                    <div class="widget_shopping_cart_content">
                    </div>
                </div>
            <?php
            $output .= ob_get_clean();
            return $output;
        }
    }
}
function cryptcio_get_layout() {
    global $wp_query, $cryptcio_settings, $cryptcio_layout;
    $result = '';
    if (empty($cryptcio_layout)) {
        $result = isset($cryptcio_settings['layout']) ? $cryptcio_settings['layout'] : 'fullwidth';
        if (is_404()) {
            $result = 'fullwidth';
        } else if (is_category()) {
            $result = $cryptcio_settings['post-layout'];
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'layout', true);
                $result = !empty($shop_layout) && $shop_layout != 'default' ? $shop_layout : $cryptcio_settings['shop-layout'];
            } else if(is_tax('product_tag')){
                $result = $cryptcio_settings['shop-layout'];
            } else {
                if (is_post_type_archive('gallery')) {
                    $result = $cryptcio_settings['gallery-layout'];
                } 
                else if(is_post_type_archive('gallery')){
                    $result = $cryptcio_settings['gallery-layout']; 
                }
                else if(is_post_type_archive('teacher')){
                    $result = $cryptcio_settings['teacher-layout']; 
                }
                else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_layout = get_metadata($term->taxonomy, $term->term_id, 'layout', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if(!empty($tax_layout) && $tax_layout != 'default') {
                                    $result = $tax_layout;
                                } else {
                                    $result = $cryptcio_settings['shop-layout'];
                                }
                                break;
                            case 'product_tag':
                                $result = $cryptcio_settings['shop-layout'];
                                break;
                            case 'gallery_cat':
                                if(!empty($tax_layout) && $tax_layout != 'default') {
                                    $result = $tax_layout;
                                } else {
                                    $result = $cryptcio_settings['gallery-layout'];
                                }
                                break;
                            case 'gallery_cat':
                                $result = $cryptcio_settings['gallery-layout'];
                                break;
                            case 'teacher_cat':
                                $result = $cryptcio_settings['teacher-layout'];
                                break;        
                            case 'gallery':
                                $result = $cryptcio_settings['post-layout'];
                                break;
                            default:
                                $result = $cryptcio_settings['layout'];
                        }
                    }
                }
            }
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'layout', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                } else {
                    switch (get_post_type()) {
                        case 'gallery':
                            $result = $cryptcio_settings['gallery-layout'];
                            break;
                        case 'teacher':
                            $result = $cryptcio_settings['teacher-layout'];
                            break;
                        case 'product':
                            $result = $cryptcio_settings['single-product-layout'];
                            break;
                        case 'post':
                            $result = $cryptcio_settings['post-layout'];
                            break;
                        default:
                            $result = $cryptcio_settings['layout'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $cryptcio_settings['post-layout'];
                }
            }
        }
        $cryptcio_layout = $result;
    }    
    return $cryptcio_layout;
}
//get global sidebar position
function cryptcio_get_sidebar_position() {
    $result = '';
    global $wp_query, $cryptcio_settings, $cryptcio_sidebar_pos;
    if(empty($cryptcio_sidebar_pos)){
        $result = isset($cryptcio_settings['sidebar-position']) ? $cryptcio_settings['sidebar-position'] : 'none';
        if (is_404()) {
            $result = 'none';
        } else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'sidebar_position', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                    $result = $cat_sidebar;
                }
            else{   
                $result = $cryptcio_settings['post-sidebar-position'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar_position = get_post_meta(wc_get_page_id('shop'), 'sidebar_position', true);
                $result = !empty($shop_sidebar_position) && $shop_sidebar_position != 'default' ? $shop_sidebar_position : $cryptcio_settings['shop-sidebar-position'];
            }else if(is_tax('product_tag')){
                $result = $cryptcio_settings['shop-sidebar-position'];
            }  else {
                if (is_post_type_archive('gallery')) {
                    if(isset($cryptcio_settings['gallery-sidebar-position'])){
                        $result = $cryptcio_settings['gallery-sidebar-position'];
                    }else{
                        $result = $cryptcio_settings['sidebar-position'];
                    }
                }else if(is_post_type_archive('gallery')){
                    if(isset($cryptcio_settings['gallery-sidebar-position'])){
                        $result = $cryptcio_settings['gallery-sidebar-position'];                        
                    }else{
                        $result = $cryptcio_settings['sidebar-position'];
                    }
                }else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar_pos = get_metadata($term->taxonomy, $term->term_id, 'sidebar_position', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if(!empty($tax_sidebar_pos) && $tax_sidebar_pos != 'default') {
                                    $result = $tax_sidebar_pos;
                                } else {
                                    $result = $cryptcio_settings['shop-sidebar-position'];
                                }
                                break;
                            case 'product_tag':
                                $result = $cryptcio_settings['shop-sidebar-position'];
                                break;
                            case 'gallery_cat':
                                $result = $cryptcio_settings['gallery-sidebar-position'];
                                break;
                            case 'gallery_tag':
                                $result = $cryptcio_settings['gallery-sidebar-position'];
                                break;
                            case 'category':
                                if(!empty($tax_sidebar_pos) && $tax_sidebar_pos != 'default') {
                                    $result = $tax_sidebar_pos;
                                } else {
                                    $result = $cryptcio_settings['post-sidebar-position'];
                                }
                                break;
                            case 'tag':
                                    $result = $cryptcio_settings['post-sidebar-position'];
                                break; 
                            default:
                                $result = $cryptcio_settings['sidebar-position'];
                        }
                    }
                }
            }
        } else {
            if (is_singular()) {
                $single_sidebar_position = get_post_meta(get_the_id(), 'sidebar_position', true);
                if (!empty($single_sidebar_position) && $single_sidebar_position != 'default') {
                    $result = $single_sidebar_position;
                } else {
                    switch (get_post_type()) {
                        case 'gallery':
                            $result = $cryptcio_settings['gallery-sidebar-position'];
                            break;
                        case 'product':
                            $result = $cryptcio_settings['single-product-sidebar-position'];
                            break;
                        case 'gallery':
                            if(isset($cryptcio_settings['gallery-sidebar-position'])){
                                $result = $cryptcio_settings['gallery-sidebar-position'];
                            }else{
                                $result = $cryptcio_settings['sidebar-position'];
                            }
                            break;
                        case 'teacher':
                            if(isset($cryptcio_settings['teacher-sidebar-position'])){
                                $result = $cryptcio_settings['teacher-sidebar-position'];
                            }else{
                                $result = $cryptcio_settings['sidebar-position'];
                            }
                            break;    
                        case 'post':
                            $result = $cryptcio_settings['post-sidebar-position'];
                            break;
                        default:
                            $result = $cryptcio_settings['sidebar-position'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $cryptcio_settings['post-sidebar-position'];
                }
            }
        }
        $cryptcio_sidebar_pos = $result;
    }
    return $cryptcio_sidebar_pos;
}

//get global sidebar
function cryptcio_get_sidebar() {
    $result = '';
    global $wp_query, $cryptcio_settings, $cryptcio_sidebar;
    if(empty($cryptcio_sidebar)){
        $result = isset($cryptcio_settings['sidebar']) ? $cryptcio_settings['sidebar'] : 'none';
        if (is_404()) {
            $result = 'none';
        } else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'sidebar', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                    $result = $cat_sidebar;
                }
            else{   
                $result = $cryptcio_settings['post-sidebar'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar = get_post_meta(wc_get_page_id('shop'), 'sidebar', true);
                $result = !empty($shop_sidebar) && $shop_sidebar != 'default' ? $shop_sidebar : $cryptcio_settings['shop-sidebar'];
            } else {
                if (is_post_type_archive('gallery')) {
                    if(isset($cryptcio_settings['gallery-sidebar'])){
                        $result = $cryptcio_settings['gallery-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['sidebar']; 
                    }  
                } else if(is_post_type_archive('teacher')){
                    if(isset($cryptcio_settings['teacher-sidebar'])){
                        $result = $cryptcio_settings['teacher-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['sidebar']; 
                    }  
                } else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar = get_metadata($term->taxonomy, $term->term_id, 'sidebar', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if(!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                } else {
                                    $result = $cryptcio_settings['shop-sidebar'];
                                }
                                break;
                            case 'product_tag':
                                $result = $cryptcio_settings['shop-sidebar'];
                                break;
                            case 'gallery_cat':
                                if(isset($cryptcio_settings['gallery-sidebar'])){
                                    $result = $cryptcio_settings['gallery-sidebar'];
                                }else{
                                    $result = $cryptcio_settings['sidebar'];
                                }
                                break;
                            case 'teacher_cat':
                                if(isset($cryptcio_settings['teacher-sidebar'])){
                                    $result = $cryptcio_settings['teacher-sidebar'];
                                }else{
                                    $result = $cryptcio_settings['sidebar'];
                                }
                                break;    
                            case 'gallery_tag':
                                if(isset($cryptcio_settings['gallery-sidebar'])){
                                    $result = $cryptcio_settings['gallery-sidebar'];
                                }else{
                                    $result = $cryptcio_settings['sidebar'];
                                }
                                break;
                            case 'category':
                                if(!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                } else {
                                    $result = $cryptcio_settings['post-sidebar'];
                                }
                                break;
                            case 'tag':
                                $result = $cryptcio_settings['post-sidebar'];
                                break; 
                            default:
                                $result = $cryptcio_settings['sidebar'];
                        }
                    }
                }
            }
        } else {
            if (is_singular()) {
                $single_sidebar = get_post_meta(get_the_id(), 'sidebar', true);
                if (!empty($single_sidebar) && $single_sidebar != 'default') {
                    $result = $single_sidebar;
                } else {
                    switch (get_post_type()) {
                        case 'gallery':
                            $result = $cryptcio_settings['gallery-sidebar'];
                            break;
                        case 'product':
                            $result = $cryptcio_settings['single-product-sidebar'];
                            break;
                        case 'gallery':
                            $result = $cryptcio_settings['gallery-sidebar'];
                            break;
                        case 'teacher':
                            $result = $cryptcio_settings['teacher-sidebar'];
                            break;    
                        case 'post':
                            $result = $cryptcio_settings['post-sidebar'];
                            break;
                        default:
                            $result = $cryptcio_settings['sidebar'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $cryptcio_settings['post-sidebar'];
                }
            }
        }
        $cryptcio_sidebar = $result;
    } 
    return $cryptcio_sidebar;   
}
function cryptcio_get_sidebar_left() {
    $result = '';
    global $wp_query, $cryptcio_settings, $cryptcio_sidebar_left;

    if (empty($cryptcio_sidebar_left)) {
        $result = isset($cryptcio_settings['left-sidebar']) ? $cryptcio_settings['left-sidebar'] : '';
        if (is_404()) {
            $result = '';
        } else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'left-sidebar', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                $result = $cat_sidebar;
            }else if($cat_sidebar =='none') {
                $result = "none";
            } else {
                $result = $cryptcio_settings['left-post-sidebar'];
            }
        }else if (is_tag()){
            $result = $cryptcio_settings['left-post-sidebar'];
        }
        else if (is_search()){
            $result = $cryptcio_settings['left-post-sidebar'];
        }
        else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar = get_post_meta(wc_get_page_id('shop'), 'left-sidebar', true);
                $result = !empty($shop_sidebar) && $shop_sidebar != 'default' ? $shop_sidebar : $cryptcio_settings['left-shop-sidebar'];
            }else if(is_tax('product_tag')){
                $result = $cryptcio_settings['left-shop-sidebar'];
            } else { 
                if (is_post_type_archive('gallery')) {
                    if(isset($cryptcio_settings['left-gallery-sidebar'])){
                        $result = $cryptcio_settings['left-gallery-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['left-sidebar']; 
                    }  
                }   
                else if (is_post_type_archive('teacher')) {
                    if(isset($cryptcio_settings['left-teacher-sidebar'])){
                        $result = $cryptcio_settings['left-teacher-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['left-sidebar']; 
                    }  
                }else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar = get_metadata($term->taxonomy, $term->term_id, 'left-sidebar', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $cryptcio_settings['left-shop-sidebar'];
                                }
                                break;
                            case 'gallery_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                } else if($tax_sidebar =='none') {
                                    $result = "none";
                                }else{
                                    $result = $cryptcio_settings['left-gallery-sidebar'];
                                }
                                break;
                            case 'teacher_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                } else if($tax_sidebar =='none') {
                                    $result = "none";
                                }else{
                                    $result = $cryptcio_settings['left-teacher-sidebar'];
                                }
                                break;
                            case 'product_tag':
                                $result = $cryptcio_settings['left-shop-sidebar'];
                                break;
                            case 'category':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                } else {
                                    $result = $cryptcio_settings['left-post-sidebar'];
                                }
                                break;
                            case 'tag':
                                $result = $cryptcio_settings['left-post-sidebar'];
                                break;
                            default:
                                $result = $cryptcio_settings['left-sidebar'];
                        }
                    }
                }
            }
        } else {
            if (is_singular()) {
                $single_sidebar = get_post_meta(get_the_id(), 'left-sidebar', true);
                if (!empty($single_sidebar) && $single_sidebar != 'default') {
                    $result = $single_sidebar;
                }else if($single_sidebar =='none') {
                    $result = "none";
                } else {
                    switch (get_post_type()) {
                        case 'post':
                            $result = $cryptcio_settings['left-post-sidebar'];
                            break;
                        case 'gallery':
                            $result = $cryptcio_settings['left-gallery-sidebar'];
                            break;
                         case 'teacher':
                            $result = $cryptcio_settings['left-teacher-sidebar'];
                            break;
                        case 'product':
                            $result = $cryptcio_settings['left-single-product-sidebar'];
                            break;    
                        default:
                            $result = $cryptcio_settings['left-sidebar'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $cryptcio_settings['left-post-sidebar'];
                }
            }
        }
        $cryptcio_sidebar_left = $result;
    }
    return $cryptcio_sidebar_left;
}

function cryptcio_get_sidebar_right() {
    $result = '';
    global $wp_query, $cryptcio_settings, $cryptcio_sidebar_right;

    if (empty($cryptcio_sidebar_right)) {
        $result = isset($cryptcio_settings['right-sidebar']) ? $cryptcio_settings['right-sidebar'] : 'none';
        if (is_404()) {
            $result = 'none';
        }else if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_sidebar = get_metadata('category', $cat->term_id, 'right-sidebar', true);
            if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                $result = $cat_sidebar;
            }else if($cat_sidebar =='none') {
                $result = "none";
            } else {
                $result = $cryptcio_settings['right-post-sidebar'];
            }
        }else if (is_tag()){
            $result = $cryptcio_settings['right-post-sidebar'];
        }
        else if (is_search()){
            $result = $cryptcio_settings['right-post-sidebar'];
        }
        else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_sidebar = get_post_meta(wc_get_page_id('shop'), 'right-sidebar', true);
                $result = !empty($shop_sidebar) && $shop_sidebar != 'default' ? $shop_sidebar : $cryptcio_settings['right-shop-sidebar'];
            }else if(is_tax('product_tag')){
                $result = $cryptcio_settings['right-shop-sidebar'];
            } else { 
                if (is_post_type_archive('gallery')) {
                    if(isset($cryptcio_settings['right-gallery-sidebar'])){
                        $result = $cryptcio_settings['right-gallery-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['right-sidebar']; 
                    }  
                } 
                else if (is_post_type_archive('teacher')) {
                    if(isset($cryptcio_settings['right-teacher-sidebar'])){
                        $result = $cryptcio_settings['right-teacher-sidebar'];  
                    }else{
                        $result = $cryptcio_settings['right-sidebar']; 
                    }  
                }            
                else {
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    if ($term) {
                        $tax_sidebar = get_metadata($term->taxonomy, $term->term_id, 'right-sidebar', true);
                        switch ($term->taxonomy) {
                            case 'product_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $cryptcio_settings['right-shop-sidebar'];
                                }
                                break;
                            case 'gallery_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $cryptcio_settings['right-gallery-sidebar'];
                                }
                                break;
                            case 'teacher_cat':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $cryptcio_settings['right-teacher-sidebar'];
                                }
                                break;
                            case 'product_tag':
                                $result = $cryptcio_settings['right-shop-sidebar'];
                                break;
                            case 'category':
                                if (!empty($tax_sidebar) && $tax_sidebar != 'default') {
                                    $result = $tax_sidebar;
                                }else if($tax_sidebar =='none') {
                                    $result = "none";
                                } else {
                                    $result = $cryptcio_settings['right-post-sidebar'];
                                }
                                break;
                            case 'tag':
                                $result = $cryptcio_settings['right-post-sidebar'];
                                break;
                            default:
                                $result = $cryptcio_settings['right-sidebar'];
                        }
                    }
                }
            }
        } else if(function_exists('is_plugin_active') && is_plugin_active( 'bbpress/bbpress.php' ) && is_bbpress()){
            $result = $cryptcio_settings['right-bb-sidebar'];   
        } else {
            if (is_singular()) {
                $single_sidebar = get_post_meta(get_the_id(), 'right-sidebar', true);
                if (!empty($single_sidebar) && $single_sidebar != 'default') {
                    $result = $single_sidebar;
                }else if($single_sidebar =='none') {
                    $result = "none";
                } else {
                    switch (get_post_type()) {
                        case 'post':
                            $result = $cryptcio_settings['right-post-sidebar'];
                            break;
                        case 'gallery':
                            $result = $cryptcio_settings['right-gallery-sidebar'];
                            break;
                        case 'teacher':
                            $result = $cryptcio_settings['right-teacher-sidebar'];
                            break;
                        case 'product':
                            $result = $cryptcio_settings['right-single-product-sidebar'];
                            break;    
                        default:
                            $result = $cryptcio_settings['right-sidebar'];
                    }
                }
            } else {
                if (is_home() && !is_front_page()) {
                    $result = $cryptcio_settings['right-post-sidebar'];
                }
            }
        }
        $cryptcio_sidebar_right = $result;
    }
    return $cryptcio_sidebar_right;
}
function cryptcio_get_header_type() {
    $result = '';
    global $cryptcio_settings, $wp_query, $header_type;
    if (empty($header_type)) {
        $result = isset($cryptcio_settings['header-type']) ? $cryptcio_settings['header-type'] : 1;
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'header', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = $cryptcio_settings['header-type'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'header', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            } 
        } else if(is_404()){
            if(isset($cryptcio_settings['404_header'])){
                $result = $cryptcio_settings['404_header'];
            }else{
                $result = $cryptcio_settings['header-type'];
            }
        } else if(is_page_template( 'coming-soon.php' )){
            if(isset($cryptcio_settings['coming_header'])){
                $result = $cryptcio_settings['coming_header'];
            }else{
                $result = $cryptcio_settings['header-type'];
            }            
        }else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'header', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $cryptcio_settings['header-type'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'header', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $header_type = $result;
    }
    return $header_type;
}

function cryptcio_get_banner_top(){
    global $post, $cryptcio_settings;
    $static_block = "";  
	if(isset($cryptcio_settings['select-slider']) && $cryptcio_settings['select-slider'] != ''){
        if(cryptcio_get_meta_value('select-slider')!='' && cryptcio_get_meta_value('select-slider')!='default'){
            $static_block = cryptcio_get_meta_value('select-slider');
        }else{
            $static_block = $cryptcio_settings['select-slider'];
        }      
    }
	if($static_block != ''){      
        $block = get_post($static_block);
        $post_content = $block->post_content;
        $hide_static = cryptcio_get_meta_value('hide_static', true);
        if($hide_static){
			?>
				<div class="top-slider">
					<?php echo apply_filters('the_content', get_post_field('post_content', $static_block)); ?>
				</div>
			<?php
        }
    }
}
function cryptcio_get_header_mobile_position() {
    $result = '';
    global $cryptcio_settings, $wp_query, $header_position;
    if (empty($header_position)) {
        $result = isset($cryptcio_settings['header_postion']) ? $cryptcio_settings['header_postion'] : 1;
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'header-position', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = $cryptcio_settings['header_postion'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'header-position', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            } 
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'header-position', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $cryptcio_settings['header_postion'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'header-position', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $header_position = $result;
    }
    return $header_position;
}

function cryptcio_get_footer_type() {
    $result = '';
    global $cryptcio_settings, $wp_query, $footer_type;
    if(empty($footer_type)){
        $result = isset($cryptcio_settings['footer-type']) ? $cryptcio_settings['footer-type'] : 1;
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'footer', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = $cryptcio_settings['footer-type'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'footer', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            }
        } else if(is_404()){
            if(isset($cryptcio_settings['404_footer'])){
                $result = $cryptcio_settings['404_footer'];
            }else{
                $result = $cryptcio_settings['footer-type'];
            }
        } else if(is_page_template( 'coming-soon.php' )){
            if(isset($cryptcio_settings['coming_footer']) && $cryptcio_settings['coming_footer']!=''){
                $result = $cryptcio_settings['coming_footer'];
            }else{
                $result = $cryptcio_settings['footer-type'];
            }            
        }else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'footer', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $cryptcio_settings['footer-type'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'footer', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }        
        $footer_type = $result;
    }  
    return $footer_type;  
}

//get search template
if ( ! function_exists ( 'cryptcio_breadcrumbs' ) ) {
function cryptcio_breadcrumbs() {
    global $post, $wp_query, $author, $cryptcio_settings;

    $prepend = '';
    $before = '<li>';
    $after = '</li>';
    $home = '<span>' .esc_html__('Home', 'cryptcio'). '</span>';
	$icon_home = '';
	if(isset($cryptcio_settings['breadcrumbs-icon']) && $cryptcio_settings['breadcrumbs-icon']!=''){
        $icon_home = $cryptcio_settings['breadcrumbs-icon'];
    }
    $shop_page_id = false;
    $shop_page = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $permalinks   = get_option( 'woocommerce_permalinks' );
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page    = get_post( $shop_page_id );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
    if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
        $prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $after;
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
        echo '<ul class="breadcrumb">';

        if ( ! empty( $home ) ) {
            echo wp_kses($before,array('li'=>array())) . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url('/') ) . '"><i class="' . $icon_home . '"></i> ' . $home . '</a>' . $after;
        }

        if ( is_home() ) {

            echo wp_kses($before,array('li'=>array())) . single_post_title('', false) . $after;

        } else if ( is_category()) {

            if ( get_option( 'show_on_front' ) == 'page' ) {
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
            }

            $cat_obj = $wp_query->get_queried_object();
            $this_category = get_category( $cat_obj->term_id );

            echo wp_kses($before,array('li'=>array())) . single_cat_title( '', false ) . $after;

        } elseif ( is_search() ) {

            echo wp_kses($before,array('li'=>array())) . esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;' . $after;

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {
            echo wp_kses($prepend, cryptcio_allow_html());
            if ( is_tax('portfolio_cat') ) {
                $post_type = get_post_type_object( 'portfolio' );
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( 'portfolio' ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
            }
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
            }

            echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            echo wp_kses($prepend, cryptcio_allow_html()). wp_kses($before,array('li'=>array())) . ' ' . esc_html__( 'Products tagged &ldquo;', 'cryptcio' ) . $queried_object->name . '&rdquo;' . $after;

        } elseif ( is_tax('gallery_cat') ){
            if(is_tax('gallery_cat')){
                if(isset($cryptcio_settings['gallery_cat_slug'])){
                    $gallery_cat_slug = $cryptcio_settings['gallery_cat_slug'];
                }
                else {$gallery_cat_slug = "gallery_cat"; }                 
                echo wp_kses($prepend, cryptcio_allow_html());

                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
                }

                echo wp_kses($before,array('li'=>array())) . esc_html( $current_term->name ) . $after;
            }else{
                $queried_object = $wp_query->get_queried_object();
                    echo wp_kses($prepend, cryptcio_allow_html()) . wp_kses($before,array('li'=>array())) . ' ' . esc_html__( 'Recipes tagged &ldquo;', 'cryptcio' ) . $queried_object->name . '&rdquo;' . $after;
            }
        }  elseif ( is_day() ) {

            echo wp_kses($before,array('li'=>array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
            echo wp_kses($before,array('li'=>array())) . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
            echo wp_kses($before,array('li'=>array())) . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo wp_kses($before,array('li'=>array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
            echo wp_kses($before,array('li'=>array())) . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo wp_kses($before,array('li'=>array())) . get_the_time('Y') . $after;

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_paged() ) {

                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

            } else {

                echo wp_kses($before,array('li'=>array())) . $_name . $after;

            }

        }else if(is_post_type_archive('gallery')){
            if(isset($cryptcio_settings['gallery_slug']) && $cryptcio_settings['gallery_slug'] !=""){
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_kses($before,array('li'=>array())) .esc_html($cryptcio_settings['gallery_slug']). $after;                
            }else{
                $post_type = get_post_type_object( 'gallery' );
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('gallery') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
            }
                
        }else if(is_post_type_archive('service')){
            if(isset($cryptcio_settings['service_slug']) && $cryptcio_settings['service_slug'] !=""){
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_kses($before,array('li'=>array())) .esc_html($cryptcio_settings['service_slug']). $after;                
            }else{
                $post_type = get_post_type_object( 'service' );
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('service') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
            }
                
        }else if(is_post_type_archive('project')){
            if(isset($cryptcio_settings['project_slug']) && $cryptcio_settings['project_slug'] !=""){
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_kses($before,array('li'=>array())) .esc_html($cryptcio_settings['project_slug']). $after;                
            }else{
                $post_type = get_post_type_object( 'project' );
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('project') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
            }
        }else if(is_post_type_archive('events')){
            if(isset($cryptcio_settings['events_slug']) && $cryptcio_settings['events_slug'] !=""){
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_kses($before,array('li'=>array())) .esc_html($cryptcio_settings['events_slug']). $after;                
            }else{
                $post_type = get_post_type_object( 'events' );
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link('events') . '">' .  esc_html($post_type->labels->name) . '</a>' . $after;
            }
        }  elseif ( is_single() && ! is_attachment() ) {

            if ( 'product' == get_post_type() ) {

                echo wp_kses($prepend, cryptcio_allow_html());

                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = $terms[0];
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );

                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after;
                        }
                    }

                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after;

                }

                echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

            }elseif ( 'gallery' == get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                if(isset($cryptcio_settings['gallery_slug']) && $cryptcio_settings['gallery_slug'] !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($cryptcio_settings['gallery_slug']). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;                                   
                }else{
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($post_type->labels->name). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;
                }                
            }elseif ( 'service' == get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                if(isset($cryptcio_settings['service_slug']) && $cryptcio_settings['service_slug'] !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($cryptcio_settings['service_slug']). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;                                   
                }else{
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($post_type->labels->name). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;
                }                
            }elseif ( 'project' == get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                if(isset($cryptcio_settings['project_slug']) && $cryptcio_settings['project_slug'] !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($cryptcio_settings['project_slug']). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;                                   
                }else{
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($post_type->labels->name). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;
                }                
            } elseif ( 'events' == get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                if(isset($cryptcio_settings['events_slug']) && $cryptcio_settings['events_slug'] !=""){
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($cryptcio_settings['events_slug']). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;                                   
                }else{
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . esc_html($post_type->labels->name). '</a>' . $after;
                    echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;
                }                
            }  elseif ( 'post' != get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo wp_kses($before,array('li'=>array())) . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

            }else {

                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                    echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
                }

                $cat = current( get_the_category() );
                if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo wp_kses($before,array('li'=>array())) . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
                }
                echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

            }

        } elseif ( is_404() ) {

            echo wp_kses($before,array('li'=>array())) . esc_html__( 'Error 404', 'cryptcio' ) . $after;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo wp_kses($before,array('li'=>array())) . $post_type->labels->singular_name . $after;
            }

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                echo wp_kses($before,array('li'=>array())) . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
            }
            echo wp_kses($before,array('li'=>array())) . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>'. $after;
            echo wp_kses($before,array('li'=>array())). get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {

            echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo wp_kses($before,array('li'=>array())) . $crumb . $after;
            }

            echo wp_kses($before,array('li'=>array())) . get_the_title() . $after;

        } elseif ( is_search() ) {

            echo wp_kses($before,array('li'=>array())) . esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;' . $after;

        } elseif ( is_tag() ) {

            echo wp_kses($before,array('li'=>array())) . esc_html__( 'Posts tagged &ldquo;', 'cryptcio' ) . single_tag_title('', false) . '&rdquo;' . $after;

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo wp_kses($before,array('li'=>array())) . esc_html__( 'Author:', 'cryptcio' ) . ' ' . $userdata->display_name . $after;

        }

        if ( get_query_var( 'paged' ) ) {
            echo wp_kses($before,array('li'=>array())) . '&nbsp;(' . esc_html__( 'Page', 'cryptcio' ) . ' ' . get_query_var( 'paged' ) . ')' . $after;
        }

        echo '</ul>';
    } else {
        if ( is_home() && !is_front_page() ) {
            echo '<ul class="breadcrumb">';

            if ( ! empty( $home ) ) {
                echo wp_kses($before,array('li'=>array())) . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url('/') ) . '"><i class="' . $icon_home . '"></i> ' . $home . '</a>' . $after;

                echo wp_kses($before,array('li'=>array())) . esc_html($cryptcio_settings['blog-title']) . $after;
            }

            echo '</ul>';
        }
    }
}
}
if ( ! function_exists ( 'cryptcio_page_title' ) ) {
function cryptcio_page_title() {

    global $cryptcio_settings, $post, $wp_query, $author;

    $home = esc_html__('Home', 'cryptcio');

    $shop_page_id = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {

        if ( is_home() ) {

        } else if ( is_category() ) {

            echo single_cat_title( '', false );

        } elseif ( is_search() ) {

            echo esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;';

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            echo esc_html( $current_term->name );

        } elseif ( is_tax('gallery_cat') ) {

            $queried_object = $wp_query->get_queried_object();
            echo  $queried_object->name ;

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            echo esc_html__( 'Products tagged &ldquo;', 'cryptcio' ) . $queried_object->name . '&rdquo;';

        } elseif(is_tax('kbe_tags')){
             echo esc_html__( 'Knowledge tagged &ldquo;', 'cryptcio' ) . get_queried_object()->name . '&rdquo;';
        } elseif(is_tax('kbe_taxonomy')){
             echo esc_html( get_queried_object()->name );
        } elseif ( is_day() ) {

            printf( esc_html__( 'Daily Archives: %s', 'cryptcio' ), get_the_date() );

        } elseif ( is_month() ) {

            printf( esc_html__( 'Monthly Archives: %s', 'cryptcio' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'cryptcio' ) ) );

        } elseif ( is_year() ) {

            printf( esc_html__( 'Yearly Archives: %s', 'cryptcio' ), get_the_date( _x( 'Y', 'yearly archives date format', 'cryptcio' ) ) );

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {
                echo esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;';
            } elseif ( is_paged() ) {

            } else {

                echo esc_html($_name);

            }

        }else if(is_post_type_archive('gallery')){
            if(isset($cryptcio_settings['gallery_slug']) && $cryptcio_settings['gallery_slug'] !=""){
                echo esc_html($cryptcio_settings['gallery_slug']);
            }else{
                $post_type = get_post_type_object( 'gallery' );
                echo esc_html($post_type->labels->name);
            }
                
        }else if(is_post_type_archive('service')){
            if(isset($cryptcio_settings['service_slug']) && $cryptcio_settings['service_slug'] !=""){
                echo esc_html($cryptcio_settings['service_slug']);
            }else{
                echo esc_html__( 'Service', 'cryptcio' );
            }
                
        }else if(is_post_type_archive('project')){
            if(isset($cryptcio_settings['project_slug']) && $cryptcio_settings['project_slug'] !=""){
                echo esc_html($cryptcio_settings['project_slug']);
            }else{
                echo esc_html__( 'Project', 'cryptcio' );
            }
                
        }else if(is_post_type_archive('events')){
            if(isset($cryptcio_settings['events_slug']) && $cryptcio_settings['events_slug'] !=""){
                echo esc_html($cryptcio_settings['events_slug']);
            }else{
                echo esc_html__( 'Events', 'cryptcio' );
            }
                
        }else if ( is_post_type_archive() ) {
            sprintf( esc_html__( 'Archives: %s', 'cryptcio' ), post_type_archive_title( '', false ) );
        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'gallery' == get_post_type() ) {

                echo get_the_title();

            } else {

                echo get_the_title();

            }

        } elseif ( is_404() ) {

            echo esc_html__( 'Error 404', 'cryptcio' );

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo esc_html($post_type->labels->singular_name);
            }

        } elseif ( is_attachment() ) {

            echo get_the_title();

        } elseif ( is_page() && !$post->post_parent ) {

            echo get_the_title();

        } elseif ( is_page() && $post->post_parent ) {

            echo get_the_title();

        } elseif ( is_search() ) {

            echo esc_html__( 'Search results for &ldquo;', 'cryptcio' ) . get_search_query() . '&rdquo;';

        } elseif ( is_tag() ) {

            echo esc_html__( 'Posts tagged &ldquo;', 'cryptcio' ) . single_tag_title('', false) . '&rdquo;';

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo esc_html__( 'Author:', 'cryptcio' ) . ' ' . $userdata->display_name;

        }

        if ( get_query_var( 'paged' ) ) {
            echo ' (' . esc_html__( 'Page', 'cryptcio' ) . ' ' . get_query_var( 'paged' ) . ')';
        }
    } else {
        if ( is_home() && !is_front_page() ) {
            if ( ! empty( $home ) ) {
                echo esc_html($cryptcio_settings['blog-title']);
            }
        }
    }
}
}
?>