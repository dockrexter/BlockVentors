<?php
require_once(CRYPTCIO_FUNCTIONS . '/config_options.php');
require_once(CRYPTCIO_FUNCTIONS . '/vc_functions.php');
require_once(CRYPTCIO_FUNCTIONS . '/sidebars.php');
require_once(CRYPTCIO_FUNCTIONS . '/layout.php');
require_once(CRYPTCIO_FUNCTIONS . '/menus/menu.php');
require_once(CRYPTCIO_FUNCTIONS . '/panel-social/functions.php');
require_once(CRYPTCIO_FUNCTIONS . '/ajax_search/ajax-search.php');

if (class_exists('Woocommerce')) {
    require_once(CRYPTCIO_FUNCTIONS . '/woocommerce.php');
}
require_once(CRYPTCIO_FUNCTIONS . '/wpml.php');
add_action( 'wp_ajax_cryptcio_ajax_load_more', 'cryptcio_ajax_load_more' );
add_action( 'wp_ajax_nopriv_cryptcio_ajax_load_more', 'cryptcio_ajax_load_more' );
function cryptcio_ajax_load_more(){
    $cryptcio_perpage = $_POST['cryptcio_perpage'];
    $cryptcio_currentpage = $_POST['cryptcio_currentpage'];
    $args = array(
        'post_type' => 'gallery' ,
        'post_status' => 'publish',
        'posts_per_page' => (int)$cryptcio_perpage,
        'paged' => (int)$cryptcio_currentpage + 1,
    );
    $rquery = new Wp_Query( $args );
    if ( $rquery->have_posts() ) :
                    while ( $rquery->have_posts() ) : $rquery->the_post();
                ?>
                    <?php 
                        $post_term_arr = get_the_terms( get_the_ID(), 'gallery_cat' );
                        $post_term_filters = '';
                        $post_term_names = '';

                        if (is_array($post_term_arr) || is_object($post_term_arr)){
                            foreach ( $post_term_arr as $post_term ) {

                                $post_term_filters .= $post_term->slug . ' ';
                                $post_term_names .= $post_term->name . ', ';
                                if($post_term->parent!=0){
                                    $parent_term = get_term( $post_term->parent,'gallery_cat' );
                                    $post_term_filters .= $parent_term->slug . ' ';
                                    
                                }
                            }
                        }

                        $post_term_filters = trim( $post_term_filters );
                        $post_term_names = substr( $post_term_names, 0, -2 );
                        $author = get_the_author_link();
                    ?>
                    <div class="item <?php echo esc_attr($post_term_filters);?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <figure class="gallery-image">
                                <div class="gallery-img">
                                    <?php 
                                        $attachment_id = get_post_thumbnail_id();
                                        $attachment_grid = cryptcio_get_attachment($attachment_id, 'cryptcio_gallery_grid'); 
                                        $attachment_grid_2 = cryptcio_get_attachment($attachment_id, 'cryptcio-blog-list');
                                    ?>
                                    <a class="fancybox-thumb" data-fancybox-group="fancybox-thumb" href="<?php echo esc_url($attachment_grid_2['src']) ?>" ><img width="<?php echo esc_attr($attachment_grid['width']) ?>" height="<?php echo esc_attr($attachment_grid['height']) ?>" src="<?php echo esc_url($attachment_grid['src']) ?>" alt="<?php echo esc_html__('gallery','cryptcio') ?>" /></a>
                                </div>
                            </figure>   
                        <?php endif;?>  
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
}
function cryptcio_get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
//* Wrap first word of widget title into a span tag
add_filter ( 'widget_title', 'cryptcio_add_span_tag_to_widgets' );
function cryptcio_add_span_tag_to_widgets( $old_title ) {
  
    $parsed = cryptcio_get_string_between($old_title, '[', ']');
    if($parsed != ''){
        $title = substr($old_title, strpos($old_title, "]") + 1);
        $titleNew = '<span class="before_title">'.esc_html($parsed).'</span>'.'<span class="f-title">'.esc_html($title).'</span>';
    }else{
        $titleNew = $old_title;
    }

    return $titleNew;
}
//preloader
function cryptcio_pre_loader() {
    $result = $cryptcio_gif_preload = '';
    global $cryptcio_settings, $wp_query, $preload_type;
    if(isset($cryptcio_settings['logo-preload']) && $cryptcio_settings['logo-preload']!=''){
        $cryptcio_logo_preload = $cryptcio_settings['logo-preload']['url'];
    }
	if(isset($cryptcio_settings['gif-preload']) && $cryptcio_settings['gif-preload']!=''){
        $cryptcio_gif_preload = $cryptcio_settings['gif-preload']['url'];
    }
    if (empty($preload_type)) {
        $result = isset($cryptcio_settings['preload-type']) ? $cryptcio_settings['preload-type'] : 1;
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'preload', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = $cryptcio_settings['preload-type'];
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'preload', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            } 
        } else if(is_404()){
            if(isset($cryptcio_settings['404_preload'])){
                $result = $cryptcio_settings['404_preload'];
            }else{
                $result = $cryptcio_settings['preload-type'];
            }
        } else if(is_page_template( 'coming-soon.php' )){
            if(isset($cryptcio_settings['coming_preload'])){
                $result = $cryptcio_settings['coming_preload'];
            }else{
                $result = $cryptcio_settings['preload-type'];
            }            
        }else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'preload', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = $cryptcio_settings['preload-type'];
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'preload', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $preload_type = $result;
    }
    if((isset($cryptcio_settings['preload']) && $cryptcio_settings['preload'] =='enable') || get_post_meta(get_the_id(), 'preload', true)!='default'){
        ob_start();
    ?>
    <div class="preloader">
        <?php if($result == 1): ?>
            <div id="loading">
				<div class="pre-psoload">
					<div class="psoload">
						<div class="straight"></div>
						<div class="curve"></div>
						<div class="center"></div>
						<div class="inner"></div>
					</div>
				</div>
            </div>
        <?php elseif($result == 2): ?>
             <div id="loading-2">
                <div id="loading-center-2">
                    <?php
						if ($cryptcio_logo_preload && $cryptcio_logo_preload!=''):
							echo '<img class="logo-preload" src="' . esc_url(str_replace(array('http:', 'https:'), '', $cryptcio_logo_preload)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
						endif;
                    ?>
                    <div id="loading-center-absolute-2">
                        <div class="object-2" id="object_one_2"></div>
                        <div class="object-2" id="object_two_2"></div>
                        <div class="object-2" id="object_three_2"></div>
                    </div>
                </div>
            </div>
        <?php elseif($result == 3): ?>
            <div id="loading-3">
                <div id="loading-center-3">
                    <div id="loading-center-absolute-3">
                        <div class="object-3" id="object_four_3"></div>
                        <div class="object-3" id="object_three_3"></div>
                        <div class="object-3" id="object_two_3"></div>
                        <div class="object-3" id="object_one_3"></div>
                    </div>
                </div>
            </div>
        <?php elseif($result == 4): ?>
            <div class="preloader-4">
                <div class="busy-loader">
                    <div class="w-ball-wrapper ball-1">
                        <div class="w-ball">
                        </div>
                    </div>
                    <div class="w-ball-wrapper ball-2">
                        <div class="w-ball">
                        </div>
                    </div>
                    <div class="w-ball-wrapper ball-3">
                        <div class="w-ball">
                        </div>
                    </div>
                    <div class="w-ball-wrapper ball-4">
                        <div class="w-ball">
                        </div>
                    </div>
                    <div class="w-ball-wrapper ball-5">
                        <div class=" w-ball">
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($result == 5): ?>
            <div class="preloader-5">
                <?php
                if ($cryptcio_logo_preload && $cryptcio_logo_preload!=''):
                    echo '<img class="logo-preload" src="' . esc_url(str_replace(array('http:', 'https:'), '', $cryptcio_logo_preload)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                else:
                    bloginfo('name');
                endif;
                ?>
                <div class="loader"></div>
            </div>
        <?php elseif($result == 6): ?>
            <div id="loading-6">
                <div class="gif-loader">
					<?php
					if ($cryptcio_gif_preload && $cryptcio_gif_preload!=''):
						echo '<img class="gif-preload" src="' . esc_url(str_replace(array('http:', 'https:'), '', $cryptcio_gif_preload)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
					endif;
					?>
				</div>
            </div>
        <?php elseif($result == 7): ?>
            <div id="loading-7">
                <div id="loading-center-7">
                    <div id="loading-center-absolute-7">
                        <div id="object-7"></div>
                    </div>
                </div>
            </div>
        <?php elseif($result == 9): ?>
            <div id="loading-9">
				<div class="preloader8">
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php else: ?>
            <div class="loader-8">
                <div class="loader-inner pacman">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
       return ob_get_clean();
        }else{ 
            ?>
            <div class="preloader">
                <div id="pre-loader">
                </div>
            </div>
            <?php
         }
}

//search filter
if ( !is_admin() ) {
    function cryptcio_searchfilter($query) {
        if ($query->is_search && !is_admin() && $query->get( 'post_type' ) != 'kbe_knowledgebase' && $query->get( 'post_type' ) != 'product') {
        $query->set('post_type',array('post','recipe'));
        }
        return $query;
    }
    add_filter('pre_get_posts','cryptcio_searchfilter');
}
//back to top
add_action( 'wp_footer', 'cryptcio_back_to_top' );
function cryptcio_back_to_top() {
echo '<a class="scroll-to-top"><i class="fa fa-angle-up"></i></a>';
}
add_action( 'wp_footer', 'cryptcio_overlay' );
function cryptcio_overlay() {
echo '<div class="overlay"></div>';
}
function cryptcio_get_post_media(){ 
    global $cryptcio_settings;
    $cryptcio_sidebar_left = cryptcio_get_sidebar_left();
    $cryptcio_sidebar_right = cryptcio_get_sidebar_right();
    $gallery = get_post_meta(get_the_ID(), 'images_gallery', true);
	$cryptcio_single_post_layout = get_post_meta(get_the_ID(), 'single-post-layout-version', true);
	$cryptcio_single_post_layout = ($cryptcio_single_post_layout == 'default' || !$cryptcio_single_post_layout) ? $cryptcio_settings['single-post-layout-version'] : $cryptcio_single_post_layout;
    $cryptcio_post_layout = isset($cryptcio_settings['post-layout-version']) ? $cryptcio_settings['post-layout-version'] :'';   
    $cryptcio_post_columns = isset($cryptcio_settings['post-layout-columns']) ? $cryptcio_settings['post-layout-columns'] :'';   
    $attachment_id = get_post_thumbnail_id();
    $image_grid = cryptcio_get_attachment($attachment_id, 'cryptcio-blog-grid'); 
    $image_grid_2 = cryptcio_get_attachment($attachment_id, 'cryptcio-blog-grid_2'); 
	$image_list = cryptcio_get_attachment($attachment_id, 'cryptcio-blog-list'); 
    $image_full = cryptcio_get_attachment($attachment_id, 'full'); 
    $image_list_sidebar = cryptcio_get_attachment($attachment_id, 'cryptcio-blog-list-sidebar'); 
    if (is_category()){
        $category = get_category( get_query_var( 'cat' ) );
        $cat_id = $category->cat_ID;
        if(get_metadata('category', $cat_id, 'blog_layout', true) != 'default'){
            $cryptcio_post_layout = get_metadata('category', $cat_id, 'blog_layout', true);    
        }
        if(get_metadata('category', $cat_id, 'blog_columns', true) != 'default'){
            $cryptcio_post_columns = get_metadata('category', $cat_id, 'blog_columns', true);  
        }
        if(get_metadata('category', $cat_id, 'blog_list_style', true) != 'default'){
            $cryptcio_list_style = get_metadata('category', $cat_id, 'blog_list_style', true);
        }
		if(get_metadata('category', $cat_id, 'single-post-layout-version', true) != 'default'){
			$cryptcio_single_post_layout = get_metadata('category', $cat_id, 'single-post-layout-version', true);
		}
    }
	$blog_id =  'blog_id-'.wp_rand();
    ?> 
   <?php if ( get_post_format() == 'video') : ?>
        <?php $video = get_post_meta(get_the_ID(), 'video_code', true); ?>
            <?php if ($video && $video != ''): ?>
                 <?php if(is_singular()):?>
                    <div class="blog-video">
                        <a data-fancybox href="<?php echo esc_url($video); ?>"><img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" /> <i class="fa fa-play-circle-o"></i></a>
                    </div>
                <?php else: ?>
                    <div class="blog-video">
                        <?php if ($cryptcio_post_layout == "list"): ?>
                            <a data-fancybox href="<?php echo esc_url($video); ?>"><img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" /> <i class="fa fa-play-circle-o"></i></a>
                        <?php elseif($cryptcio_post_layout == "classic")  :?>
                             <a data-fancybox href="<?php echo esc_url($video); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /> <i class="fa fa-play-circle-o"></i></a>
                        <?php elseif($cryptcio_post_layout == "masonry")  :?>
                             <a data-fancybox href="<?php echo esc_url($video); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /> <i class="fa fa-play-circle-o"></i></a>
                        <?php else:?>
                            <a data-fancybox href="<?php echo esc_url($video); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /> <i class="fa fa-play-circle-o"></i></a>                  
                        <?php endif;?>
                    </div>
                  <?php endif; ?>
            <?php endif; ?>
        <?php elseif ( get_post_format() == 'audio') : ?>
            <?php $video = get_post_meta(get_the_ID(), 'video_code', true); ?>
            <?php if ($video && $video != ''): ?>
                <div class="blog-audio">
                        <?php if(get_post_format() == 'video'){
                            echo '<div class="iframe_video_container">';
                        }
                        ?>                    
                            <?php if (strpos($video,'iframe') !== false):?>
                                <?php echo wp_kses($video,array(
                                  'iframe' => array(
                                    'height' => array(),
                                    'style' => array(),
                                    'src' => array(),
                                    'allowfullscreen' => array(),
                                    )
                                )); ?>                            
                            <?php else: ?>
                                <iframe src="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $video ) : $video); ?> " width="100%" <?php if(get_post_format() == 'video'){echo 'height="400"';}?>></iframe>
                            <?php endif;?>
                        <?php if(get_post_format() == 'video'){
                            echo '</div>';
                        }
                        ?>                 
                </div>
        <?php endif; ?>
    <?php elseif(has_post_format('gallery')): ?>
        <?php if (is_array($gallery) && count($gallery) > 1) : ?>   
            <?php if(is_singular()):?>
                <div class="blog-gallery blog-img arrows-custom"> 
                    <?php
                    $index = 0;
                    foreach ($gallery as $key => $value) :
                        $cryptcio_blog_list_sidebar = wp_get_attachment_image_src($value, 'cryptcio-blog-list-sidebar');
                        $image_list = wp_get_attachment_image_src($value, 'cryptcio-blog-list');
                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                            if($cryptcio_single_post_layout == 'single-2'){
								echo '<div class="img-gallery">
									<div class="img">
										<img src="' . esc_url($image_list[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}else{
								echo '<div class="img-gallery">
									<div class="img">
										<img src="' . esc_url($cryptcio_blog_list_sidebar[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}
                        $index++;
                    endforeach;
                    ?>
                </div> 
            <?php else: ?>   
                <div id="<?php echo esc_attr($blog_id); ?>" class="blog-gallery blog-img arrows-custom"> 
                    <?php
                    $index = 0;
                    foreach ($gallery as $key => $value) :
                        $image_grid = wp_get_attachment_image_src($value, 'cryptcio-blog-grid');
						$image_grid_2 = wp_get_attachment_image_src($value, 'cryptcio-blog-grid_2'); 
                        $image_list = wp_get_attachment_image_src($value, 'cryptcio-blog-list');
						$image_list_sidebar = wp_get_attachment_image_src($value, 'cryptcio-blog-list-sidebar'); 
                        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                        if ($cryptcio_post_layout == "list"){
							echo '<div class="img-gallery">
								<div class="img">
									<img src="' . esc_url($image_list[0]) . '" alt="gallery-blog" class="gallery-img" />
								</div>
							</div>';
                        }elseif ($cryptcio_post_layout == "masonry"){
							if($cryptcio_post_columns == "1"){
								echo '<div class="img-gallery">
									<div class="img">
										<img src="' . esc_url($cryptcio_blog_list_sidebar[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}else{
								echo '<div class="img-gallery">
									<div class="img">
										<img src="' . esc_url($image_grid_2[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}
                        }else{
                            if($cryptcio_post_columns == "1"){
								echo '<div class="img-gallery">
									<div class="img">
										<img src="' . esc_url($cryptcio_blog_list_sidebar[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}else{
								echo '<div class="img-gallery">
									<div class="img">
									   <img src="' . esc_url($image_grid[0]) . '" alt="gallery-blog" class="gallery-img" />
									</div>
								</div>';
							}	
                        }
                        
                        $index++;
                    endforeach;
                    ?>
                </div>
            <?php endif; ?> 
        <?php else: ?>
            <?php if (has_post_thumbnail()): ?>
				<div class="blog-img img-hover">
                    <?php if ($cryptcio_post_layout == "list"): ?>
						<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" /></a>
					<?php elseif($cryptcio_post_layout == "masonry")  :?>
                        <a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid_2['width']) ?>" height="<?php echo esc_attr($image_grid_2['height']) ?>" src="<?php echo esc_url($image_grid_2['src']) ?>" alt="<?php echo esc_attr($image_grid_2['alt']) ?>" /></a>
                    <?php else:?>
                        <a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /></a>                  
                    <?php endif;?>
                </div> 
            <?php endif;?>
        <?php endif; ?>
    <?php elseif(has_post_format('link')):?>
        <?php 
            $link = get_post_meta(get_the_ID(), 'link_code', true); 
            $link_title = get_post_meta(get_the_ID(), 'link_title', true);
        ?>
        <?php if(is_singular()):?>
            <?php if($link && $link != ''):?>
                <figure class="quote link">
					<div class="quote_section">
						<div class="link-icon">
							<i class="fa fa-link" aria-hidden="true"></i>
						</div>
						<div class="link-post">
							<a class="post_link" href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
								<?php if($link_title && $link_title != ''):?>
									<span><?php echo wp_kses($link_title,array());?></span>
								<?php endif;?> 
							</a>
						</div>
					</div>
				</figure>
            <?php endif;?> 
        <?php else: ?>
            <?php if ($cryptcio_post_layout == "grid"): ?>
                <div class="blog-img img-hover">
					<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /></a>
                </div>
            <?php else: ?>
                <?php if($link && $link != ''):?>
                    <figure class="quote">
						<div class="quote_section">
							<div class="link-icon">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </div>
							<div class="link-post">
								<a class="post_link" href="<?php echo esc_url(is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link);?>">
									<?php if($link_title && $link_title != ''):?>
										<span><?php echo wp_kses($link_title,array());?></span>
									<?php endif;?> 
								</a>
							</div>
						</div>
					</figure>
                <?php endif;?>
            <?php endif; ?>  
        <?php endif; ?>  
    <?php elseif(has_post_format('quote')):?>
        <?php 
            $quote = get_post_meta(get_the_ID(), 'quote_code', true); 
            $quote_author = get_post_meta(get_the_ID(), 'quote_author', true); 
        ?>
        <?php if(is_singular()):?>
			<?php if($cryptcio_single_post_layout == 'single-2'): ?>
				<div class="blog-img img-hover">
					<img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" />
				</div>
			<?php else :?>  
				<div class="blog-img img-hover">
					<img width="<?php echo esc_attr($image_list_sidebar['width']) ?>" height="<?php echo esc_attr($image_list_sidebar['height']) ?>" src="<?php echo esc_url($image_list_sidebar['src']) ?>" alt="<?php echo esc_attr($image_list_sidebar['alt']) ?>" />
				</div>
			<?php endif; ?>  
            <?php if($quote && $quote != ''):?>
                <figure class="quote">
                    <div class="quote_section">
						<div class="quote-icon">
							<i class="fa fa-quote-left" aria-hidden="true"></i>
						</div>
						<blockquote class="var3">
                            <?php echo wp_kses($quote,array());?>
                        </blockquote>
                        <?php if($quote_author && $quote_author != ''):?>
                            <div class="author_info"><?php echo  wp_kses($quote_author,array());?></div>
                        <?php endif;?> 
                    </div>
                </figure>
            <?php endif;?>  
        <?php else: ?>
            <?php if ($cryptcio_post_layout == "grid"): ?>
                <div class="blog-img img-hover">
					<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /></a>
                </div>
            <?php else: ?>
                <?php if($quote && $quote != ''):?>
                    <figure class="quote">
                        <div class="quote_section">
							<div class="quote-icon">
								<i class="fa fa-quote-left" aria-hidden="true"></i>
							</div>
							<blockquote class="var3">
                                <?php echo wp_kses($quote,array());?>
                            </blockquote>
                            <?php if($quote_author && $quote_author != ''):?>
                                <div class="author_info"><?php echo  wp_kses($quote_author,array());?></div>
                            <?php endif;?> 
                        </div>
                    </figure>
                <?php endif;?>  
            <?php endif; ?>  
        <?php endif; ?>  
    <?php else: ?>
        <?php if (has_post_thumbnail()): ?>
             <?php if(is_singular()):?>
                <?php if($cryptcio_single_post_layout == 'single-2'): ?>
					<div class="blog-img img-hover">
						<img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" />
					</div>
				<?php else :?>
					<div class="blog-img img-hover">
						<img width="<?php echo esc_attr($image_list_sidebar['width']) ?>" height="<?php echo esc_attr($image_list_sidebar['height']) ?>" src="<?php echo esc_url($image_list_sidebar['src']) ?>" alt="<?php echo esc_attr($image_list_sidebar['alt']) ?>" />
					</div>
				<?php endif; ?>
            <?php else: ?>
                <div class="blog-img img-hover">
                    <?php if ($cryptcio_post_layout == "list"): ?>
						<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_list['width']) ?>" height="<?php echo esc_attr($image_list['height']) ?>" src="<?php echo esc_url($image_list['src']) ?>" alt="<?php echo esc_attr($image_list['alt']) ?>" /></a>
					<?php elseif($cryptcio_post_layout == "masonry")  :?>
						<?php if($cryptcio_post_columns =='1') :?>
							<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_list_sidebar['width']) ?>" height="<?php echo esc_attr($image_list_sidebar['height']) ?>" src="<?php echo esc_url($image_list_sidebar['src']) ?>" alt="<?php echo esc_attr($image_list_sidebar['alt']) ?>" /></a>
						<?php else:?>
							<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid_2['width']) ?>" height="<?php echo esc_attr($image_grid_2['height']) ?>" src="<?php echo esc_url($image_grid_2['src']) ?>" alt="<?php echo esc_attr($image_grid_2['alt']) ?>" /></a>
						<?php endif;?>
					<?php else:?>
						<?php if($cryptcio_post_columns =='1') :?>
							<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_list_sidebar['width']) ?>" height="<?php echo esc_attr($image_list_sidebar['height']) ?>" src="<?php echo esc_url($image_list_sidebar['src']) ?>" alt="<?php echo esc_attr($image_list_sidebar['alt']) ?>" /></a>
						<?php else:?>
							<a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr($image_grid['width']) ?>" height="<?php echo esc_attr($image_grid['height']) ?>" src="<?php echo esc_url($image_grid['src']) ?>" alt="<?php echo esc_attr($image_grid['alt']) ?>" /></a>                  
						<?php endif;?>
                    <?php endif;?>
                </div> 
            <?php endif;?>
        <?php endif;?>
    <?php endif; 
}

function cryptcio_gallery_posts_per_page( $query ) {
    global $cryptcio_settings,$wp_query;
    $cryptcio_gallery_per_page = isset($cryptcio_settings['gallery_per_page']) ? $cryptcio_settings['gallery_per_page'] :'12';
    if (is_tax('gallery_cat')){
        $cat = $wp_query->get_queried_object();
        if(get_metadata('gallery_cat', $cat->term_id, 'gallery_per_page', true)  != 'default'){
            $cryptcio_gallery_per_page = get_metadata('gallery_cat', $cat->term_id, 'gallery_per_page', true);    
        }
    }
    if(isset($cryptcio_gallery_per_page) && $cryptcio_gallery_per_page != ''){
          if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'gallery' ) || is_tax('gallery_cat') )) {
            $query->set( 'posts_per_page', $cryptcio_gallery_per_page );
          }
    }else{
        if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'gallery' ) || is_tax('gallery_cat') )) {
            $query->set( 'posts_per_page',  '8');
        }
    }
}
add_action( 'pre_get_posts', 'cryptcio_gallery_posts_per_page' );

function cryptcio_posts_per_page( $query ) {
      global $cryptcio_settings,$wp_query;
    $cryptcio_post_layout = isset($cryptcio_settings['post-layout-version']) ? $cryptcio_settings['post-layout-version'] :'';   
    $cryptcio_post_per_page = isset($cryptcio_settings['post_per_page']) ? $cryptcio_settings['post_per_page'] :'';
    if (is_category()){
        $category = $wp_query->get_queried_object();
        if(isset($category)){
            $cat_id = $category->term_id;
             if(get_metadata('category', $cat_id, 'post_per_page', true) != ''){
                $cryptcio_post_per_page = get_metadata('category', $cat_id, 'post_per_page', true);    
            }  
        }
                   
    }
    if(isset($cryptcio_post_per_page) && $cryptcio_post_per_page != ''){
          if ( !is_admin() && $query->is_main_query() && (is_category() || is_tag() || is_home())) {
            $query->set( 'posts_per_page', $cryptcio_post_per_page );
          }
    }
    // Service Post Type
    $cryptcio_service_per_page = isset($cryptcio_settings['service_per_page']) ? $cryptcio_settings['service_per_page'] :'8';

    if(isset($cryptcio_service_per_page) && $cryptcio_service_per_page != ''){
          if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'service' ) || is_tax('service_cat') )) {
            $query->set( 'posts_per_page', $cryptcio_service_per_page );
          }
    }else{
        if ( !is_admin() && $query->is_main_query() && (is_post_type_archive( 'service' ) || is_tax('service_cat') )) {
            $query->set( 'posts_per_page',  '8');
        }
    }
}
add_action( 'pre_get_posts', 'cryptcio_posts_per_page' );

function cryptcio_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return esc_html__('0 Views','cryptcio');
    }
    return $count.esc_html__(' Views','cryptcio');
}
function cryptcio_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function cryptcio_get_attachment( $attachment_id, $size = 'full' ) {
    if (!$attachment_id)
        return false;
    $attachment = get_post( $attachment_id );
    $image = wp_get_attachment_image_src($attachment_id, $size);

    if (!$attachment)
        return false;

    return array(
        'alt' => esc_attr(get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true )),
        'caption' => esc_attr($attachment->post_excerpt),
        'description' => esc_html($attachment->post_content),
        'href' => get_permalink( $attachment->ID ),
        'src' => esc_url($image[0]),
        'title' => esc_attr($attachment->post_title),
        'width' => esc_attr($image[1]),
        'height' => esc_attr($image[2])
    );
}
function cryptcio_pagination($max_num_pages = null) {
    global $wp_query, $wp_rewrite;

    $max_num_pages = ($max_num_pages) ? $max_num_pages : $wp_query->max_num_pages;

    // Don't print empty markup if there's only one page.
    if ($max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $max_num_pages,
        'current' => $paged,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_next' => True,
        'prev_text' => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
        'next_text' => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
        'type' => 'list'
            ));

    if ($links) :
        ?>
        <nav class="pagination">
            <?php echo wp_kses($links, cryptcio_allow_html()); ?>        
        </nav>
        <?php
    endif;
}
function cryptcio_get_excerpt($limit = 45) {

    if (!$limit) {
        $limit = 45;
    }

    $allowed_html =array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'ul' => array(),
        'li'  => array(),
        'ol'  => array(),
        'iframe' => array(
            'src' => true,
            'width' => true,
            'height' => true,
            'align' => true,
            'class' => true,
            'name' => true,
            'id' => true,
            'seamless' => true,
            'srcdoc' => true,
            'sandbox' => true,
            'allowfullscreen' => true
        ),
        'blockquote'  => array(),
        'embed' => array(
                'width' => array(),
                'height' => array(),
                ),
        'br' => array(),
        'img' => array(
            'alt' => array(),
            'src' => array(),
            'width' => array(),
            'height' =>array(), 
            'id' => array(),
            'style' => array(),
            'class' => array(),
            ),
        'audio' => array(
            'src' => true,
            'width' => true,
            'height' => true,
            'align' => true,
            'class' => true,
            'name' => true,
            'id' => true,
            'preload' => true,
            'style' => true,
            'controls' => true,
        ),
        'source' => array(
            'src' => true,
            'width' => true,
            'height' => true,
            'align' => true,
            'class' => true,
            'name' => true,
            'id' => true,
            'type' => true,
        ),
        'p'  => array(
            'style' => true,
            'class' => true,
            'id' => true,),
        'em' => array(),
        'strong' => array(),
    );

    if (has_excerpt()) {
        $content =  wp_kses(strip_shortcodes(get_the_excerpt()), $allowed_html) ;
    } else {
        $content = get_the_content( );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );
        $content =  wp_kses(strip_shortcodes($content), $allowed_html) ;
    }

    $content = explode(' ', $content, $limit);

    if (count($content) >= $limit) {
        array_pop($content);
            $content = implode(" ",$content).'<a href="'.get_the_permalink().'" class="view-details"><i class="fa fa-long-arrow-right"></i>&nbsp;'.esc_html__('View Details', 'cryptcio').'</a>';
    } else {
        $content = implode(" ",$content);
    }

    return $content;
}
function cryptcio_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter( 'comment_form_fields', 'cryptcio_move_comment_field_to_bottom' );

function cryptcio_comment_nav() {
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <div class="comment-nav-links">
        <?php
        if ($prev_link = get_previous_comments_link(__('Older', 'cryptcio'))) :
            printf('<div class="comment-nav-previous">%s</div>', $prev_link);
        endif;

        if ($next_link = get_next_comments_link(__('Newer', 'cryptcio'))) :
            printf('<div class="comment-nav-next">%s</div>', $next_link);
        endif;
        ?>
            </div>
        </nav>
        <?php
    endif;
}
function cryptcio_comment_body_template($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_html($tag) ?> <?php comment_class(empty($args['has_children']) ? 'profile-content ' : 'parent profile-content' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <?php if(get_avatar($comment, $args['avatar_size']) != ''):?>
            <div class="comment-author vcard profile-top">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>    
            </div>
        <?php endif;?>
            <div class="profile-bottom">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation"><?php echo esc_html__('Your comment is awaiting moderation.', 'cryptcio'); ?></em>
                    <br />
                <?php endif; ?>
                <div class="comment-bottom ">
                        <div class="info-content">
                            <div class="profile-name"><?php printf(esc_html__('%s','cryptcio'), get_comment_author_link()); ?>
                            </div>
                             <div class="date-cmt">
                                <span><?php
                                  $d = "d/m/Y";
                                  $t = "h:j";
                                printf(esc_html__('%1$s at %2$s', 'cryptcio'), get_comment_date() ,  get_comment_time());
                                ?></span>
                            </div>
                        </div>
                        <div class="profile-desc">
                            <?php comment_text(); ?>
                        </div>
                        <div class="info-right ">
                            <div class="links-info">
                                <?php if($depth<$args['max_depth']): ?>
                                <div class="info">
                                    <?php comment_reply_link(array_merge($args, array('reply_text'=>'<i class="fa fa-mail-reply"></i> '.esc_html__('Reply', 'cryptcio'),'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
                <?php if ('div' != $args['style']) : ?>
                    </div>
                <?php endif; ?>
            </div>
                <?php

}
add_filter('comment_reply_link', 'cryptcio_reply_link_class');
function cryptcio_reply_link_class($cryptcio_class){
    $cryptcio_class = str_replace("class='comment-reply-link", "class='", $cryptcio_class);
    return $cryptcio_class;
}

add_action( 'comment_form', 'cryptcio_comment_submit' );
function cryptcio_comment_submit( $post_id ) {
    if (get_post_type() !== 'product'){
        echo '<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="comment-submit">
                        <button type="submit" class="submit btn btn-primary" > '.esc_html__('Send comment', 'cryptcio').'
                        </button>    
                    </div>
                </div>';
        }
}


add_filter('latest_tweets_render_date', 'cryptcio_latest_tweets_date', 10 , 1 );
//allow html in widget title
function cryptcio_change_widget_title($title)
{
    //convert square brackets to angle brackets
    $title = str_replace('[', '<', $title);
    $title = str_replace(']', '>', $title);

    //strip tags other than the allowed set
    $title = strip_tags($title, '<a><blink><br><span>');
    return $title;
}
add_filter('widget_title', 'cryptcio_change_widget_title');
function cryptcio_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'cryptcio_custom_excerpt_length', 999 );
if( ! function_exists( 'cryptcio_pages_ids_from_template' ) ) {
    function cryptcio_pages_ids_from_template( $name ) {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $name . '.php'
        ));

        $return = array();

        foreach($pages as $page){
            $return[] = $page->ID;
        }

        return $return;
    }
}
function cryptcio_maintenance_mode(){
    global $cryptcio_settings;
    if(isset($cryptcio_settings['under-contr-mode']) && $cryptcio_settings['under-contr-mode'] ==1){
        if(!current_user_can('edit_themes') || !is_user_logged_in()){
            wp_die(get_template_part('coming-soon'));
        }
    }
}
add_action('get_header', 'cryptcio_maintenance_mode');

function cryptcio_get_page_banner() {
    global $wp_query, $header_type;
    $cat = $wp_query->get_queried_object();
    $show_slider = get_post_meta(get_the_ID(), 'show_slider', true);
    $slider_category = get_post_meta(get_the_ID(), 'category_slider', true);
    $output = '';
    ?>
    <?php if($show_slider) :?>
        <div class="main-slider">
          <?php echo do_shortcode( '[rev_slider alias=' . $slider_category . ']' ); ?>
        </div>
    <?php endif;?>
    <?php
}
add_filter('woocommerce_short_description', 'cryptcio_woocommerce_short_description', 10, 1);
function cryptcio_woocommerce_short_description($post_excerpt){
    if (!is_product()) {
        $post_excerpt = substr($post_excerpt, 0, 200);
    }
	$limit = 26;
	$content = str_replace( ']]>', ']]&gt;', $post_excerpt );
	$content = explode(' ', $post_excerpt, $limit);
	if (count($content) >= $limit) {
        array_pop($content);
            $content = implode(" ",$content).'.&nbsp;<a href="'.get_the_permalink().'" class="view-details">'.'<i class="fa fa-long-arrow-right"></i>&nbsp;'.esc_html__('View Details', 'cryptcio').'</a>';
    } else {
        $content = implode(" ",$content);
    }
    return $content;
}
function cryptcio_get_product_single_style(){
    global $cryptcio_settings;
    $single_style =  get_post_meta(get_the_id(), 'single_style', true);
    if($single_style == 'default' && isset( $cryptcio_settings['single-product-style']) ){
        $single_style = $cryptcio_settings['single-product-style'];
    }else{
		$single_style = 1;
	}
    return $single_style;
}
function cryptcio_get_footer_menu_top() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['footer_menu_top']) ? $cryptcio_settings['footer_menu_top'] : '';
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_categories_id() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_categories']) ? $cryptcio_settings['select_menu_categories'] : '';
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_menu_top() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_top']) ? $cryptcio_settings['select_menu_top'] : '';
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_menu_right_id() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_right']) ? $cryptcio_settings['select_menu_right'] : '';
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_menu_left_id() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_left']) ? $cryptcio_settings['select_menu_left'] : '';
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_menu_id() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_name']) ? $cryptcio_settings['select_menu_name'] : '';
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'select_menu_name', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = isset($cryptcio_settings['select_menu_name']) ? $cryptcio_settings['select_menu_name'] : '';
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'select_menu_name', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            } 
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'select_menu_name', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = isset($cryptcio_settings['select_menu_name']) ? $cryptcio_settings['select_menu_name'] : '';
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'select_menu_name', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $menu_id = $result;
    return $menu_id;
}
function cryptcio_get_menu_onepage_id() {
    $result = '';
    global $cryptcio_settings, $wp_query;
        $result = isset($cryptcio_settings['select_menu_name_onepage']) ? $cryptcio_settings['select_menu_name_onepage'] : '';
        if (is_category()) {
            $cat = $wp_query->get_queried_object();
            $cat_layout = get_metadata('category', $cat->term_id, 'select_menu_name_onepage', true);
            if (!empty($cat_layout) && $cat_layout != 'default') {
                    $result = $cat_layout;
                }
            else{   
                $result = isset($cryptcio_settings['select_menu_name_onepage']) ? $cryptcio_settings['select_menu_name_onepage'] : '';;
            }
        } else if (is_archive()) {
            if (function_exists('is_shop') && is_shop()) {
                $shop_layout = get_post_meta(wc_get_page_id('shop'), 'select_menu_name_onepage', true);
                if(!empty($shop_layout) && $shop_layout != 'default') {
                    $result = $shop_layout;
                }
            } 
        } else {
            if (is_singular()) {
                $single_layout = get_post_meta(get_the_id(), 'select_menu_name_onepage', true);
                if (!empty($single_layout) && $single_layout != 'default') {
                    $result = $single_layout;
                }
            } else {
                if (!is_home() && is_front_page()) {
                    $result = isset($cryptcio_settings['select_menu_name_onepage']) ? $cryptcio_settings['select_menu_name_onepage'] : '';;
                } else if (is_home() && !is_front_page()) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    $posts_page_layout = get_post_meta($posts_page_id, 'select_menu_name_onepage', true);
                    if (!empty($posts_page_layout) && $posts_page_layout != 'default') {
                        $result = $posts_page_layout;
                    }
                }
            }
        }
        $menu_id = $result;
    return $menu_id;
}
function crytpcio_get_data_stylesheet($args) {
    $content = '';
    if(isset($args) && is_array($args)) {
        //  get targeted css class/id from array
        if (array_key_exists('target',$args)) {
            if(!empty($args['target'])) {
                $content .=  " data-ch-target='".$args['target']."' ";
            }
        }
        if (array_key_exists('csstarget',$args)) {
            if(!empty($args['csstarget'])) {
                $content .=  " data-ch-csstarget='".$args['csstarget']."' ";
            }
        }        
        //  get media sizes
        if (array_key_exists('stylesheet',$args)) {
            if(!empty($args['stylesheet'])) {
                $content .=  " data-ch-stylesheet='".json_encode($args['stylesheet'])."' ";
            }
        }        
        if (array_key_exists('tablet',$args)) {
            if(!empty($args['tablet'])) {
                $content .=  " data-ch-responsive-tablet='".json_encode($args['tablet'])."' ";
            }
        }
        if (array_key_exists('tablet-port',$args)) {
            if(!empty($args['tablet-port'])) {
                $content .=  " data-ch-responsive-tablet-port='".json_encode($args['tablet-port'])."' ";
            }
        }
        if (array_key_exists('mobile-land',$args)) {
            if(!empty($args['mobile-land'])) {
                $content .=  " data-ch-responsive-mob-land='".json_encode($args['mobile-land'])."' ";
            }
        }
        if (array_key_exists('mobile',$args)) {
            if(!empty($args['mobile'])) {
                $content .=  " data-ch-responsive-mob='".json_encode($args['mobile'])."' ";
            }
        }                        
    }
    ?>   
    <?php     
    return $content;
} 
?>
