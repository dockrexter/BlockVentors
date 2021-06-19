<?php
/**
 * @package PXaas - Saas & Software Landing Page Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 23-09-2019
 * @since 1.0.6
 * @version 1.0.6
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */
function pxaas_get_option( $setting, $default = null ) {
    global $pxaas_options;

    $default_options = array(
        // header
        'img_loader'    => get_parent_theme_file_uri('assets/images/pxaas/preloader.gif'),
        // thumbnail sizes
        'enable_custom_sizes' => '0',
        'thumb_size_opt_1' => array(
            'width'     => '1920',
            'height'    => '754',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_2' => array(
            'width'     => '9999',
            'height'    => '754',
            'hard_crop' => '0',
        ),
        'thumb_size_opt_3' => array(
            'width'     => '9999',
            'height'    => '150',
            'hard_crop' => '0',
        ),
        'thumb_size_opt_4' => array(
            'width'     => '460',
            'height'    => '305',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_5' => array(
            'width'     => '920',
            'height'    => '610',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_6' => array(
            'width'     => '1380',
            'height'    => '915',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_7' => array(
            'width'     => '362',
            'height'    => '416',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_8' => array(
            'width'     => '362',
            'height'    => '281',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_9' => array(
            'width'     => '764',
            'height'    => '504',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_10' => array(
            'width'     => '764',
            'height'    => '504',
            'hard_crop' => '1',
        ),
        'thumb_size_opt_11' => array(
            'width'     => '998',
            'height'    => '485',
            'hard_crop' => '1',
        ),
         'thumb_size_opt_12' => array(
            'width'     => '531',
            'height'    => '314',
            'hard_crop' => '1',
        ),


        'header_style'=>'default',
        //
        
        'show_title_page' => false,
        'show_btn_edit_page' => false,

        'single_featured' => true,
        'blog_show_format' => true,

        'single_comments' => false,
        'single_author' => true,
        'single_date' => true,
        'single_cats' => true,
        'single_tags' => true,
        'single_like'   => false,
        'single_post_nav' => false,

        'blog_comments' => false,
        'blog_author' => true,
        'blog_date' => true,
        'blog_cats' => true,
        'blog_tags' => false,
        // blog
        'blog_layout' => 'right_sidebar',
        'blog_content_width' => 'big-container',
        'blog_header_image_df' =>  get_template_directory_uri().'/assets/images/jk.png',
        'blog_header_image_bt_df' =>  get_template_directory_uri().'/assets/images/bb.png',
        'blog_head_title' => 'Our Last News',
        'blog_head_intro' => '<h4>Praesent nec leo venenatis elit semper aliquet id ac enim.</h4>
<span class="separator inline-sep sep-w"></span>',
        // footer
        'footer_copyright' => '<h6 class="mb-0px"><span class="ft-copy">&copy; <a href="https://themeforest.net/user/cththemes" target="_blank">CTHthemes</a> 2019.  All rights reserved.</span></h6>',

        'footer_widgets'=> array(
            array(
                'title' => esc_attr__( 'About Us', 'pxaas' ),
                'classes'  => 'col-md-3 col-sm-6',
                'widid'  => 'footer-about-us'
            ),
            array(
                'title' => esc_attr__( 'Opening Hours', 'pxaas' ),
                'classes'  => 'col-md-3 col-sm-6 two-col-li',
                'widid'  => 'footer-opengin-hours'
            ),
            array(
                'title' => esc_attr__( 'Company Us', 'pxaas' ),
                'classes'  => 'col-md-3 col-sm-6',
                'widid'  => 'footer-company-us'
            ),
            array(
                'title' => esc_attr__( 'Contact Us', 'pxaas' ),
                'classes'  => 'col-md-3 col-sm-6',
                'widid'  => 'footer-contact-us'
            ),
        ),

        'error404_bg' => get_template_directory_uri().'/assets/images/404.png',
        'error404_msg' =>  esc_html__( "The page you are looking for was moved, removed, renamed or might never existed.", 'pxaas' ),
        'error404_img_bt' => get_template_directory_uri().'/assets/images/bb.png',

        'error404_btn'    => true,

        'error404_title'   => '404 Error',

        'error404_text'    => "Sorry we can't find that page :(",

        'error404_form'    => true,
        
        'show_mini_cart'    => true,

        'show_breadcrumbs'  => 'yes',

        'protected_img' => get_template_directory_uri().'/assets/images/404.png',
        // 'protected_msg' =>  esc_html__( "The page you are looking for was moved, removed, renamed or might never existed.", 'pxaas' ),
        // 'protected_title'   => '404 Error',
        'protected_text'    => "Sorry we can't find that page :(",
        // 'protected_form'    => true,
        'protected_img_bt' => get_template_directory_uri().'/assets/images/bb.png',

        'user_menu_style'   => 'two',

    );

    if( is_customize_preview() ) $pxaas_options = get_option( 'pxaas_options', array() );
    // var_dump(get_option( 'pxaas_options', array()));
    $value = false;
    if ( isset( $pxaas_options[ $setting ] ) ) {
        $value = $pxaas_options[ $setting ];
    }else {
        if(isset($default)){
            $value = $default;
        }else if( isset( $default_options[ $setting ] ) ){
            $value = $default_options[ $setting ];
        }
    }
    return $value;
}

function pxaas_get_option_single($option = '', $default = null){
    $global = pxaas_get_option($option, $default);
    if(is_singular()){
        $singular = get_post_meta( get_the_ID(), '_cth_'.$option, true );
        if( $singular != '' && $singular != 'use_global') $global = $singular;
    }
    return $global;
}
/**
 * Blog post nav
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_post_nav')) {
    function pxaas_post_nav() {
        if(pxaas_get_option('single_post_nav', true ) == false) return ;

        $prev_post = get_adjacent_post( pxaas_get_option('single_same_term', false ) , '', true );
        $next_post = get_adjacent_post( pxaas_get_option('single_same_term', false ) , '', false );

        if ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) :
?>

<div class="post-nav single-post-nav fl-wrap post-navigate">
    <?php
    if ( is_a( $prev_post, 'WP_Post' ) ) :
    ?>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="post-link prev-post-link older-post prev-prjct" title="<?php echo esc_attr( get_the_title($prev_post->ID ) ); ?>">
            <div class="icon-nav"><i class="fa fa-long-arrow-left"></i></div>
            <div class="text-nav">
                <p><?php esc_html_e('Prev post','pxaas' );?></p>
                <h4 class="title"><?php echo esc_attr( get_the_title($prev_post->ID ) ); ?></h4>
            </div>
        </a>
    <?php 
    endif ; ?>
    <?php
    if ( is_a( $next_post, 'WP_Post' ) ) :
    ?>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="post-link next-post-link next-post nex-prjct" title="<?php echo esc_attr( get_the_title($next_post->ID ) ); ?>">
            <div class="icon-nav"><i class="fa fa-long-arrow-right"></i></div>
            <div class="text-nav">
                <p><?php esc_html_e('Next post','pxaas' );?></p>
                <h4 class="title"><?php echo esc_attr( get_the_title($next_post->ID ) ); ?></h4>
            </div>
        </a>
    <?php 
    endif ; ?>
</div>
    <?php
        endif;
    }
}

/**
 * Single Portfolio Slider nav
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_folio_slider_nav')) {
    function pxaas_folio_slider_nav() {
        
        if(pxaas_get_option('folio_show_nav', true ) == false) return ;

        $prev_post = get_adjacent_post( pxaas_get_option('folio_nav_same_term', false ) , '', true , 'portfolio_cat');

        $next_post = get_adjacent_post( pxaas_get_option('folio_nav_same_term', false ) , '', false , 'portfolio_cat');

        if ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) :
    ?>
    <!-- swiper-slide-->  
    <div class="swiper-slide portfolio-nav-slide">
        <div class="slider-content-nav-wrap full-height">
            <div class="slider-content-nav fl-wrap">
                <ul>
                    <?php
                    if ( is_a( $prev_post, 'WP_Post' ) ) :
                    ?>
                    <li class="prev-post">
                        <span><?php esc_html_e('Prev','pxaas' );?></span>
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr( get_the_title($prev_post->ID ) ); ?>"><?php echo get_the_title($prev_post->ID ); ?></a>
                    </li>
                    <?php 
                    endif ; ?>
                    <?php
                    if ( is_a( $next_post, 'WP_Post' ) ) :
                    ?>
                    <li class="next-post">
                        <span><?php esc_html_e('Next','pxaas' );?></span>
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr( get_the_title($next_post->ID ) ); ?>"><?php echo get_the_title($next_post->ID ); ?></a>
                    </li>
                    <?php 
                    endif ; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- swiper-slide end--> 
    <?php 
    endif;
    }
}

/**
 * Single Portfolio Slider nav
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_folio_nav')) {
    function pxaas_folio_nav() {
        
        if(pxaas_get_option('folio_show_nav', true ) == false) return ;

        $prev_post = get_adjacent_post( pxaas_get_option('folio_nav_same_term', false ) , '', true , 'portfolio_cat');

        $next_post = get_adjacent_post( pxaas_get_option('folio_nav_same_term', false ) , '', false , 'portfolio_cat');

        if ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) :
    ?> 
    <div class="content-nav fl-wrap">
        <ul>
            <?php
            if ( is_a( $prev_post, 'WP_Post' ) ) :
            ?>
            <li class="prev-post">
                <span><?php esc_html_e('Prev','pxaas' );?></span>
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr( get_the_title($prev_post->ID ) ); ?>"><?php echo get_the_title($prev_post->ID ); ?></a>
            </li>
            <?php 
            endif ; ?>
            <?php
            if ( is_a( $next_post, 'WP_Post' ) ) :
            ?>
            <li class="next-post">
                <span><?php esc_html_e('Next','pxaas' );?></span>
                <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr( get_the_title($next_post->ID ) ); ?>"><?php echo get_the_title($next_post->ID ); ?></a>
            </li>
            <?php 
            endif ; ?>
        </ul>
    </div> 
    <?php 
    endif;
    }
} 

/**
 * Custom comments list
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_comments')) {
    function pxaas_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } 
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
?>
        <<?php
        echo esc_attr($tag); ?> <?php
        comment_class(empty($args['has_children']) ? 'comment-item comment-nochild clearfix' : 'comment-item comment-haschild clearfix') ?> id="comment-<?php
        comment_ID() ?>">
        <?php
        if ('div' != $args['style']): ?>
        <div id="div-comment-<?php
            comment_ID() ?>" class="comment-body thecomment">
        <?php
        endif; ?>

            <div class="comment-avatar">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            </div>
            

            <?php if($args['max_depth'] > $depth): ?>
                <div class="comment-reply float-right bg-blue bg-333-hvr mb-10px pr-15px pl-15px pt-5px pb-5px radius-50px transition-2">
                    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    <i class="fa fa-share fs-14" ></i>
                </div>
            <?php endif; ?>


            <div class="comment-text">
                <h5 class="mb-0px comment-author"><?php echo get_comment_author_link($comment->comment_ID); ?> </h5>
                <span class="fs-15 color-aaa comment-date"><i class="fa fa-clock-o mr-5px"></i><?php echo get_comment_date( esc_html__( 'F d, Y', 'pxaas' ) ); ?></span>
                <div class="comment-comment"><?php comment_text(); ?></div>
                <?php
                if ($comment->comment_approved == '0'): ?>
                        <em class="comment-awaiting-moderation alignleft"><?php
                    esc_html_e('Your comment is awaiting moderation.', 'pxaas'); ?></em>
                        <br />
                    <?php
                endif; ?> 
            </div>
            


        
        <?php
        if ('div' != $args['style']): ?>
        </div> 
        <?php
        endif; ?>

    <?php
    }
}


function pxaas_pagination(){

    $pagi_content = get_the_posts_pagination(
        array(
            'mid_size' => 2,
            'prev_text' =>  wp_kses(__('<i class="fa fa-angle-left"></i>','pxaas'),array('i'=>array('class'=>array(),),) ) ,
            'next_text' =>  wp_kses(__('<i class="fa fa-angle-right"></i>','pxaas'),array('i'=>array('class'=>array(),),) ) ,
            'screen_reader_text' => esc_html__( 'Posts navigation', 'pxaas' ),
        )
    );


    echo    preg_replace(
                array(
                    '/<div class="nav-links"><span/m',
                    '/<\/span><\/div>/m'
                ), 
                array(
                    '<div class="nav-links"><span class="prev page-numbers fs-13"><i class="fa fa-angle-left"></i></span><span',
                    '</span><span class="next page-numbers fs-13"><i class="fa fa-angle-right"></i></span></div>'
                ), 
                $pagi_content
            );

    

}

/**
 * Pagination for Portfolio page templates
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_custom_pagination')) {
    function pxaas_custom_pagination($pages = '', $range = 2, $current_query = '', $sec_wrap = false) {
        // var_dump($pages);die;
        $showitems = ($range * 2) + 1;
        
        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } 
        else {
            $paged = $current_query->query_vars['paged'];
        }
        
        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } 
            else {
                $pages = $current_query->max_num_pages;
            }
        }
        
        if (1 < $pages) {
            echo '<div class="pagination-container container">';
            if ($paged > 1) echo '<a href="' . get_pagenum_link($paged - 1) . '" class="prevposts-link">'.wp_kses(__('<i class="fa fa-angle-left"></i>','pxaas'),array('i'=>array('class'=>array(),),) ).'</a>';
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    if($paged == $i)
                        echo "<a class='blog-page current-page' href='javascript:void(0);'>" . $i . "</a>";
                    else
                        echo "<a href='" . get_pagenum_link($i) . "' class='blog-page'>" . $i . "</a>";

                    
                }
            }
            if ($paged < $pages) echo '<a href="' . get_pagenum_link($paged + 1) . '" class="nextposts-link">'.wp_kses(__('<i class="fa fa-angle-right"></i>','pxaas'),array('i'=>array('class'=>array(),),) ).'</a>';
            echo '</div>';
        }

    }
}

/**
 * Pagination for Portfolio Slider page templates
 *
 * @since PXaas 1.0
 */
if (!function_exists('pxaas_folio_slider_pagination')) {
    function pxaas_folio_slider_pagination($pages = '', $range = 2, $current_query = '', $sec_wrap = false) {

        $showitems = ($range * 2) + 1;
        
        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } 
        else {
            $paged = $current_query->query_vars['paged'];
        }
        
        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } 
            else {
                $pages = $current_query->max_num_pages;
            }
        }
        
        if (1 < $pages) {
        	?>
        	<div class="swiper-slide">
                <div class="slider-content-nav-wrap full-height">
                    <div class="slider-content-nav fl-wrap">
                        <ul>
                            <li><?php if ($paged > 1) : ?>
                            	<span><?php esc_html_e('Prev','pxaas' );?></span>
                                <a href="<?php echo get_pagenum_link($paged - 1) ; ?>"><?php esc_html_e('Previous Projects','pxaas' );?></a>
                            <?php endif;?></li>
                            <li><?php if ($paged < $pages) : ?>
                            	<span><?php esc_html_e('Next','pxaas' );?></span>
                                <a href="<?php echo get_pagenum_link($paged + 1) ; ?>"><?php esc_html_e('Next Projects','pxaas' );?></a>
                            <?php endif;?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php 
            
        }

    }
}


function pxaas_breadcrumbs($classes='') {
           
    // Settings
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs fl-wrap '.$classes;
    $home_title         = esc_html__('Home','pxaas');
    $blog_title         = esc_html__('Blog','pxaas');
    $keys               = esc_html__(' > ','pxaas');


    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';

    $custom_post_types = array();
      
    // Get the query & post information
    global $post;
      
    // Do not display on the homepage
    if ( !is_front_page() ) {
      
        // Build the breadcrums
        echo '<div id="' . esc_attr($breadcrums_id ) . '" class="' . esc_attr($breadcrums_class ) . '">';
          
        // Home page
        echo '<a class="bread-item breadcrumb-link breadcrumb-home" href="' . esc_url( home_url() ) . '" title="' . esc_attr($home_title ) . '">' . esc_html($home_title ) . '</a>';

        if(is_home()){
            // Blog page
            echo '<span class="bread-item breadcrumb-current breadcrumb-item-blog">' . esc_html($blog_title ) . '</span>';
        }

        // if ( is_singular( 'post' ) || is_category() ){
        //     echo '<a class="breadcrumb-link breadcrumb-item-blog" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="'.esc_attr( get_the_title( get_option( 'page_for_posts' ) ) ).'">' . get_the_title( get_option( 'page_for_posts' ) ) .'</a> ';
        // }
          
        if ( is_archive() && !is_tax() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            if($post_type && array_key_exists($post_type, $custom_post_types)){
                echo '<span class="bread-item breadcrumb-current breadcrumb-item-custom-post-type-' . esc_attr($post_type ) . '">' . esc_html( $custom_post_types[$post_type] ) . '</span>';
            }else{
                echo '<span class="bread-item breadcrumb-current breadcrumb-item-archive">' . esc_html( get_the_archive_title() ) . '</span>';
            }
             
        } else if ( is_archive() && is_tax() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type && $post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<a class="bread-item breadcrumb-link breadcrumb-custom-post-type-' . esc_attr($post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' . esc_attr($post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>';
             
            }
             
            $custom_tax_name = get_queried_object()->name;
            echo '<span class="bread-item breadcrumb-current bread-item-archive">' . esc_html( $custom_tax_name ) . '</span>';
             
        } else if ( is_single() ) {
            
            // If post is a custom post type
            $post_type = get_post_type();
            $last_category = '';
            // If it is a custom post type (not support custom taxonomy) display name and link
            if( !in_array( $post_type, array('post','listing') ) ) {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                if(array_key_exists($post_type, $custom_post_types)){
                    echo '<a class="bread-item breadcrumb-link breadcrumb-cat breadcrumb-custom-post-type-' . esc_attr($post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' . esc_attr($custom_post_types[$post_type] ) . '">' . esc_html( $custom_post_types[$post_type] ) . '</a>';
                }else{
                    echo '<a class="bread-item breadcrumb-link breadcrumb-cat breadcrumb-custom-post-type-' . esc_attr($post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' . esc_attr($post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>';
                }
                
                echo '<span class="bread-item breadcrumb-current breadcrumb-item-' . esc_attr($post->ID ) . '" title="' . esc_attr(get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span>';
            }elseif($post_type == 'post'){
                // Get post category info
                $category = get_the_category();
                 
                // Get last category post is in
                
                if($category){
                    $last_cateogries = array_values($category);
                    $last_category = end($last_cateogries);
                 
                    // Get parent any categories and create array
                    $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                    $cat_parents = explode(',',$get_cat_parents);
                     
                    // Loop through parent categories and store in variable $cat_display
                    $cat_display = '';
                    foreach($cat_parents as $parents) {
                        $cat_display .= '<span class="bread-item breadcrumb-item-cat">'. wp_kses_post($parents) .'</span>';
                        
                    }
                }
                
                if(!empty($last_category)) {
                    echo wp_kses_post($cat_display );
                    echo '<span class="bread-item breadcrumb-current breadcrumb-item-' . esc_attr($post->ID ) . '" title="' . esc_attr(get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span>';
                     
                // Else if post is in a custom taxonomy
                }
            }
                
                 
            // If it's a custom post type within a custom taxonomy
            if(empty($last_category) && !empty($custom_taxonomy)) {
                $custom_taxonomy_arr = explode(",", $custom_taxonomy) ;
                foreach ($custom_taxonomy_arr as $key => $custom_taxonomy_val) {
                    $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy_val );
                    if($taxonomy_terms && !($taxonomy_terms instanceof WP_Error) ){
                        $cat_id         = $taxonomy_terms[0]->term_id;
                        $cat_nicename   = $taxonomy_terms[0]->slug;
                        $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy_val);
                        $cat_name       = $taxonomy_terms[0]->name;

                        if(!empty($cat_id)) {
                     
                            echo '<a class="bread-item breadcrumb-link bread-cat-' . esc_attr($cat_id ) . ' bread-cat-' . esc_attr($cat_nicename ) . '" href="' . esc_url($cat_link ) . '" title="' . esc_attr($cat_name ) . '">' . esc_html( $cat_name ) . '</a>';
                            
                            echo '<span class="bread-item breadcrumb-current breadcrumb-item-' . esc_attr($post->ID ) . '" title="' . esc_attr(get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span>';
                         
                        }
                    }

                 } 
                
              
            }
             
            
             
        } else if ( is_category() ) {
              
            // Category page
            echo '<span class="bread-item breadcrumb-current breadcrumb-item-cat-' . esc_attr($category[0]->term_id ) . ' bread-cat-' . esc_attr($category[0]->category_nicename ) . '">' . esc_html( $category[0]->cat_name ) . '</span>';
              
        } else if ( is_page() ) {
            

            // Standard page
            if( $post->post_parent ){

                $parents = '';
                  
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                  
                // Get parents in the right order
                $anc = array_reverse($anc);
                  
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<a class="bread-item breadcrumb-link breadcrumb-parent-' . esc_attr($ancestor ) . '" href="' . esc_url(get_permalink($ancestor) ) . '" title="' . esc_attr(get_the_title($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a>';
                    
                }
                  
                // Display parent pages
                echo wp_kses_post($parents );


                  
                    // Current page
                    echo '<span class="bread-item breadcrumb-current breadcrumb-item-page-' . esc_attr($post->ID ) . '" title="' . esc_attr(get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span>';

                
                  
            } else {
                  
                
                    // Current page
                    echo '<span class="bread-item breadcrumb-current breadcrumb-item-page-' . esc_attr($post->ID ) . '" title="' . esc_attr(get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span>';

                  
            }
              
        } else if ( is_tag() ) {
              
            // Tag page
              
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
              
            // Display the tag name
            echo '<span class="bread-item breadcrumb-current breadcrumb-item-tag-' . esc_attr($terms[0]->term_id ) . ' bread-tag-' . esc_attr($terms[0]->slug ) . '">' . esc_html( $terms[0]->name ) . '</span>';
          
        } elseif ( is_day() ) {
              
            // Day archive
              
            // Year link
            echo '<a class="bread-item breadcrumb-link breadcrumb-year bread-year-' . esc_attr(get_the_time('Y') ) . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . esc_attr(get_the_time('Y') ) . '">' . esc_html( get_the_time('Y') ) . esc_html__(' Archives','pxaas').'</a>';
            
              
            // Month link
            echo '<a class="bread-item breadcrumb-link breadcrumb-month bread-month-' . esc_attr(get_the_time('m') ) . '" href="' . esc_attr(get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '" title="' . esc_attr(get_the_time('M') ) . '">' . esc_html( get_the_time('M') ) . esc_html__(' Archives','pxaas').'</a>';
            
              
            // Day display
            echo '<span class="bread-item breadcrumb-current bread-' . esc_attr(get_the_time('j') ) . '"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) .  esc_html__(' Archives','pxaas').'</span>';
              
        } else if ( is_month() ) {
              
            // Month Archive
              
            // Year link
            echo '<a class="bread-item breadcrumb-link breadcrumb-year bread-year-' . esc_attr(get_the_time('Y') ) . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . esc_attr(get_the_time('Y') ) . '">' . esc_html( get_the_time('Y') ) . esc_html__(' Archives','pxaas').'</a>';
            
              
            // Month display
            echo '<span class="bread-item breadcrumb-current breadcrumb-month breadcrumb-month-' . esc_attr(get_the_time('m') ) . '" title="' . esc_attr(get_the_time('M') ) . '">' . esc_html( get_the_time('M') ) . esc_html__(' Archives','pxaas').'</span>';
              
        } else if ( is_year() ) {
              
            // Display year archive
            echo '<strong class="bread-item breadcrumb-current breadcrumb-current-' . esc_attr(get_the_time('Y') ) . '" title="' . esc_attr(get_the_time('Y') ) . '">' . esc_html( get_the_time('Y') ) . esc_html__(' Archives','pxaas').'</span>';
              
        } else if ( is_author() ) {
              
            // Auhor archive
              
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
              
            // Display author name
            echo '<span class="bread-item breadcrumb-current breadcrumb-current-' . esc_attr($userdata->user_nicename ) . '" title="' . esc_attr($userdata->display_name ) . '">' .  esc_html__(' Author: ','pxaas') . esc_html( $userdata->display_name ) . '</span>';
          
        } else if ( get_query_var('paged') ) {
              
            // Paginated archives
            echo '<a href="#" class="bread-item breadcrumb-current breadcrumb-current-' . esc_attr(get_query_var('paged') ) . '" title="'.esc_html__('Page','pxaas') . esc_attr(get_query_var('paged') ) . '">'.esc_html__('Page','pxaas') . ' ' . esc_html( get_query_var('paged') ) . '</a>';
              
        } else if ( is_search() ) {
          
            // Search results page
            echo '<span class="bread-item breadcrumb-current breadcrumb-current-' . esc_attr(get_search_query() ) . '" title="'.esc_html__('Search results for: ','pxaas') . esc_attr(get_search_query() ) . '">'.esc_html__('Search results for: ','pxaas') . esc_html( get_search_query() ) . '</span>';
          
        } elseif ( is_404() ) {
              
            // 404 page
            echo '<span class="bread-item breadcrumb-current breadcrumb-current-404">' . esc_html__('Error 404','pxaas') . '</span>';
        }
      
        echo '</div>';
          
    }
      
}



function pxaas_breadcrumb_title() {

    // Get the query & post information
    global $post, $wp_query;
    if (!is_home()) {
        if (is_archive() && !is_tax()) {
            if (is_post_type_archive('portfolio')) {
                esc_html_e('Our Portfolio', 'pxaas');
            } 
            else {
                if( pxaas_is_woocommerce_activated() ){
                    if(is_shop()) echo get_the_title( wc_get_page_id( 'shop' ) );
                }else{
                    echo get_the_archive_title();
                }
                
            }
        } 
        else if (is_archive() && is_tax()) {
            
            // If post is a custom post type
            $post_type = get_post_type();
            
            // If it is a custom post type display name and link
            if ($post_type && $post_type == 'portfolio') {
                $term = $wp_query->get_queried_object();
                echo esc_attr($term->name);
            } 
            elseif ($post_type && $post_type != 'post') {
                
                $post_type_object = get_post_type_object($post_type);
                
                echo esc_attr($post_type_object->labels->name);
            }
        } 
        else if (is_single()) {
            echo get_the_title();
        } 
        else if (is_category()) {
            echo get_the_archive_title();
        } 
        else if (is_page()) {
            echo get_the_title();
        } 
        else if (is_search()) {
            echo esc_html__('Search Blog', 'pxaas');
        } 
        elseif (is_404()) {
            echo esc_html__('Page not found', 'pxaas');
        }
    } 
    else {
        esc_html_e('Our News','pxaas');
    }

}




if ( ! function_exists( 'pxaas_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function pxaas_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pxaas' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


/** 
 * Check for existing shortcode or not
 * https://codex.wordpress.org/Function_Reference/get_shortcode_regex
 */ 
if ( !function_exists('pxaas_check_shortcode') ) {
    function pxaas_check_shortcode($content,$shortcode=''){

        if ( !empty($shortcode) && !shortcode_exists( $shortcode ) ) {

            $pattern = get_shortcode_regex(array($shortcode));

            return preg_replace('/'. $pattern .'/s', '', $content );

        }else {
            return $content;
        }  
    }
}

/**
 * Woocommerce support
 *
 */

if ( ! function_exists( 'pxaas_is_woocommerce_activated' ) ) {
    function pxaas_is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

function pxaas_get_header_cart_link(){
    if(pxaas_is_woocommerce_activated() && pxaas_get_option('show_mini_cart') ){
        global $woocommerce;
        $my_cart_count = $woocommerce->cart->cart_contents_count;
        if($my_cart_count > 0){
            $url = wc_get_page_permalink( 'cart' );
        }else{
            $url = wc_get_page_permalink( 'shop' );
        }
        return array('url'=>$url,'count'=>$my_cart_count);
    }else{
        return false;
    }
}

function pxaas_get_top_header_blog() {
    $show_header = get_post_meta(get_the_ID(),'_cth_show_header_content',true );
    $blog_header_image_df = pxaas_get_option('blog_header_image_df');
    $blog_header_image_bt_df = pxaas_get_option('blog_header_image_bt_df');

    // $show_header_blog_cus = pxaas_get_option('show_blog_header_img');
    $show_breadcrumbs_cus = pxaas_get_option('show_breadcrumbs');
    $url_home_cus = pxaas_get_option('blog_header_image');
    $url_home_img_bt_cus = pxaas_get_option('blog_header_image_bt');
    var_dump($url_home_cus);
    if( $show_header ){
        echo '<section class="sec-padding text-center p-relative o-hidden pxaas-top-section pxaas-home-blog bg-gray">
            <div class="content-top-section sec-padding">
                <div class="container">
                    <div class="row flex-center">';
                        if ($show_breadcrumbs_cus) {
                            pxaas_breadcrumbs();
                        }
                        // if($show_header_blog_cus && $url_home_cus) {
                            echo '<div class="col-md-8">
                                <div class="img-top-section">
                                    <img src="'.($url_home_cus != "" ? esc_url($url_home_cus) : esc_url( $blog_header_image_df  ) ).'" alt="'.esc_attr__( 'Header image', 'pxaas' ).'">
                                </div>
                            </div>';
                        // }
                    echo '</div>
                </div>
            </div>
            <div class="img-bot-sec" style="background-image: url('.($url_home_img_bt_cus != '' ? esc_url($url_home_img_bt_cus) : esc_url( $blog_header_image_bt_df  ) ).');"></div>
        </section>';
    }
    
}
function pxaas_get_top_header() {
    $show_header = get_post_meta(get_the_ID(),'_cth_show_header_content',true );
    $show_breadcrumbs = get_post_meta(get_the_ID(),'_cth_show_breadcrumbs_blog',true );
    $show_detail = get_post_meta(get_the_ID(),'_cth_show_page_header',true );

    $show_header_cus = pxaas_get_option('show_page_header');
    $show_breadcrumbs_cus = pxaas_get_option('show_breadcrumbs');
    $url_cus = pxaas_get_option('page_header_image');
    $url_img_bt_cus = pxaas_get_option('page_header_image_bt');
    
    $url = get_post_meta(get_the_ID(),'_cth_page_header_bg',true );
    $title = get_post_meta(get_the_ID(),'_cth_title_header',true );
    $url_img_bt = get_post_meta(get_the_ID(),'_cth_img_bt_header',true );
    

    if($show_header === 'yes') {
    echo '<section class="sec-padding text-center p-relative o-hidden pxaas-top-section pxaas-home-page bg-gray">
            <div class="content-top-section sec-padding">
                <div class="container">
                    <div class="row flex-center">'; 
                        if ($show_breadcrumbs === 'customizer') {
                            if ($show_breadcrumbs_cus) {
                                pxaas_breadcrumbs();
                            }
                        }elseif ($show_breadcrumbs === 'yes') {
                            if($title === '' ) {
                                pxaas_breadcrumbs();
                            }else {
                                echo '<h1 class="color-blue">'.esc_html( $title ). '</h1>';
                            }
                        }

                        echo wp_kses_post( get_post_meta(get_the_ID(),'_cth_page_header_intro',true ) );

                        if ($show_detail === 'customizer') {
                            if($show_header_cus) {
                                echo '<div class="col-md-8">
                                    <div class="img-top-section">
                                        <img src="'.esc_url( $url_cus ).'" alt="'.esc_attr__( 'Header image', 'pxaas' ).'">
                                    </div>
                                </div>';
                            }
                        }elseif ($show_detail === 'yes') {
                            echo '<div class="col-md-8">
                                    <div class="img-top-section">
                                        <img src="'.esc_url( $url ).'" alt="'.esc_attr__( 'Header image', 'pxaas' ).'">
                                    </div>
                                </div>';
                        }
                        
                    echo '</div>
                </div></div>';
        if($url_img_bt !== '') {
            echo '<div class="img-bot-sec" style="background-image: url('.$url_img_bt.');"></div>';
        }else {
            echo '<div class="img-bot-sec" style="background-image: url('.$url_img_bt_cus.');"></div>';        
        }
        echo '</section>';
    }
}


function pxaas_get_blog_post_cart_metar() {
    echo '<div class="post-content-wrap'; if( !empty($slider_images)&& pxaas_get_option('blog_show_format', true ) && get_post_format( ) !== 'gallery' ){echo 'fl-wrap';}else{echo 'tranform-main-sec';} echo '">';

            if( pxaas_get_option( 'blog_author')  || pxaas_get_option( 'blog_cats' ) || pxaas_get_option( 'blog_comments' ) || pxaas_get_option( 'blog_tags' ) || pxaas_get_option( 'blog_date') || pxaas_get_option( 'single_like' ) ){
                echo '<p class="mt-10px mb-15px post-opt tranform-main-cont">';
                    if( pxaas_get_option( 'blog_author') ){
                    echo '<span class="mr-10px post-author">
                            <i class="fa fa-user color-blue mr-5px"></i>';
                            the_author_posts_link( );
                        echo '</span>';
                    }
                    
                    if( pxaas_get_option( 'blog_date') ) {
                       echo '<span class="mr-10px blog-date"><i class="fa fa-clock-o color-blue mr-5px"></i>';
                        the_time(get_option('date_format'));
                       echo '</span>'; 
                    }

                    if( pxaas_get_option( 'single_like' ) && function_exists('pxaas_addons_get_likes_button') ) {
                        echo '<span class="mr-10px post-like">';
                            echo pxaas_addons_get_likes_button( get_the_ID() );
                        echo '</span>';
                    }

                    if( pxaas_get_option( 'blog_comments' ) ) {
                        echo '<span class="mr-10px comment-num"><i class="fa fa-comments-o color-blue mr-5px"></i>';
                            comments_popup_link( 
                                esc_html_x('0 Comment','comment counter None format' ,'pxaas'), 
                                esc_html_x('1 Comment','comment counter One format', 'pxaas'), 
                                esc_html_x('% Comments','comment counter Plural format', 'pxaas') );
                            echo '</span>';
                    }

                    if( pxaas_get_option( 'blog_cats' ) ) {
                        if(get_the_category( )) { 
                        echo '<span class="mr-10px post-cat"><i class="fa fa-clone color-blue mr-5px"></i>';
                            the_category( ' , ' );
                        echo '</span>';  
                        } 
                    }

                    if( pxaas_get_option( 'blog_tags' ) && get_the_tags( ) ) {
                        echo '<span class="mr-10px sing-tags"><i class="fa fa-tags color-blue mr-5px" aria-hidden="true"></i>';
                            the_tags('' , ', ' , '');
                        echo '</span>';                                  
                    }
                echo '</p>';
            }
        echo '</div>';
}

function pxaas_get_single_post_cart_metar() {
    echo '<div class="post-content-wrap'; if( !empty($slider_images)&& pxaas_get_option('blog_show_format', true ) && get_post_format( ) !== 'gallery' ){echo 'fl-wrap';}else{echo 'tranform-main-sec';} echo '">';

            if( pxaas_get_option( 'single_author')  || pxaas_get_option( 'single_cats' ) || pxaas_get_option( 'single_comments' ) || pxaas_get_option( 'single_date') ){
                echo '<p class="mt-10px mb-15px post-opt tranform-main-cont">';
                    if( pxaas_get_option( 'single_author') ){
                    echo '<span class="mr-10px post-author">
                            <i class="fa fa-user color-blue mr-5px"></i>';
                            the_author_posts_link( );
                        echo '</span>';
                    }
                    
                    if( pxaas_get_option( 'single_date') ) {
                       echo '<span class="mr-10px blog-date"><i class="fa fa-clock-o color-blue mr-5px"></i>';
                        the_time(get_option('date_format'));
                       echo '</span>'; 
                    }

                    if( pxaas_get_option( 'single_comments' ) ) {
                        echo '<span class="mr-10px comment-num"><i class="fa fa-comments-o color-blue mr-5px"></i>';
                            comments_popup_link( 
                                esc_html_x('0 Comment','comment counter None format' ,'pxaas'), 
                                esc_html_x('1 Comment','comment counter One format', 'pxaas'), 
                                esc_html_x('% Comments','comment counter Plural format', 'pxaas') );
                            echo '</span>';
                    }

                    if( pxaas_get_option( 'single_cats' ) ) {
                        if(get_the_category( )) { 
                        echo '<span class="mr-10px post-cat"><i class="fa fa-clone color-blue mr-5px"></i>';
                            the_category( ' , ' );
                        echo '</span>';  
                        } 
                    }

                   
                echo '</p>';
            }
        echo '</div>';
}



