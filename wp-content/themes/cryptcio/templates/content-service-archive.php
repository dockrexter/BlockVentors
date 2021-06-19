<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
    $cryptcio_service_layout = isset($cryptcio_settings['service-layout']) ? $cryptcio_settings['service-layout'] :'';
    $cryptcio_service_columns = isset($cryptcio_settings['service-cols']) ? $cryptcio_settings['service-cols'] :'';   
    $cryptcio_service_pagination = isset($cryptcio_settings['service_pagination']) ? $cryptcio_settings['service_pagination'] :'';   
    $cryptcio_left_service_sidebar = isset($cryptcio_settings['left-service-sidebar']) ? $cryptcio_settings['left-service-sidebar'] :'';  
    $cryptcio_right_service_sidebar = isset($cryptcio_settings['right-service-sidebar']) ? $cryptcio_settings['right-service-sidebar'] :'';   
    //$cryptcio_service_desc = isset($cryptcio_settings['service_desc']) ? $cryptcio_settings['service_desc'] :'';   

    $cryptcio_class = '';
    $cryptcio_class_columns = '';
    

    $cryptcio_class = ' blog-grid grid-isotope';
    if($cryptcio_service_columns == '1'){
        $cryptcio_class_columns = 'col-md-12 col-sm-12 col-xs-12';
    }else if($cryptcio_service_columns == '2'){
        $cryptcio_class_columns = 'col-md-6 col-sm-6 col-xs-12';
    }else if($cryptcio_service_columns == '4'){
        if ($cryptcio_left_service_sidebar == "" && $cryptcio_right_service_sidebar == ""){
            $cryptcio_class_columns = 'col-md-3 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-3 col-md-6 col-sm-6 col-xs-12';
        }
    }else{
        if ($cryptcio_left_service_sidebar == "" && $cryptcio_right_service_sidebar == ""){
            $cryptcio_class_columns = 'col-md-4 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
        }
    }   
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    
?>
<div class="row load-item service-entries-wrap <?php echo esc_attr($cryptcio_class).' '; ?>">
    <?php while (have_posts()) : the_post(); ?>
        <div class="grid-item <?php echo esc_attr($cryptcio_class_columns); ?> item-page<?php echo esc_attr($current_page); ?>">
            <div class="blog-content">
                <div class="blog-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="service-img">
                            <?php 
                                $attachment_id = get_post_thumbnail_id();
                                $cryptcio_service_grid = cryptcio_get_attachment($attachment_id, 'cryptcio-service-grid'); 
                            ?>
                            <a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                            <img class="lazyignore" width="<?php echo esc_attr($cryptcio_service_grid['width']) ?>" height="<?php echo esc_attr($cryptcio_service_grid['height']) ?>" src="<?php echo esc_url($cryptcio_service_grid['src']) ?>" alt="<?php echo esc_html__('member','cryptcio') ?>" />
                        </div>  
                    <?php endif;?>

                    <div class="blog-post-info">                   
                        <?php if(get_the_title() != ''):?>
                            <div class="blog-post-title">
                                <div class="post-name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>       
                                    </a>                                   
                                </div>                  
                            </div>
                        <?php endif;?>
                        <div class="blog-info">
                            <?php if (isset($cryptcio_settings['service-metas']) && in_array('date', $cryptcio_settings['service-metas'])) : ?>
                                <div class=" info">
                                    <p class="date"><?php echo get_the_date('M, d'); ?></p>
                                </div>
                            <?php endif;?>                                 
                            <?php if (isset($cryptcio_settings['service-metas']) && in_array('author', $cryptcio_settings['service-metas'])) : ?>
                                <?php $cryptcio_author_id= $post->post_author;?>
                                <div class="info author-name">
                                    <span><?php echo esc_html__('by ','cryptcio');?></span>
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $cryptcio_author_id ); ?></a>
                                </div>  
                            <?php endif;?>                                      
                        </div>
                        <div class="blog_post_desc">
                            <?php 
                            if (get_post_meta(get_the_ID(),'desc',true) != "") : ?>                            
                                <?php echo get_post_meta(get_the_ID(),'desc',true);?>
                            <?php else:?>
                                <?php
                                echo '<div class="entry-content">';
                                the_excerpt();
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cryptcio' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cryptcio' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) );
                                echo '</div>';
                                ?>
                            <?php endif; ?>
                        </div>
                        <div class="read-more">
                            <a  href="<?php the_permalink();?>"><?php echo esc_html__('Read more','cryptcio');?><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php if($cryptcio_service_pagination =='3'):?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 animate-top">             
            <div class="pagination-content text-center">
                    <?php cryptcio_pagination(); ?>
            </div>
        </div>
    </div>
<?php elseif($cryptcio_service_pagination =='2'):?>
    <?php if( get_previous_posts_link() ||  get_next_posts_link()):?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 animate-top ">
                <div class="pagination-content">            
                    <ul class="paginationtype-2">
                        <?php if( get_previous_posts_link()): ?>
                        <li class="pagination_button_prev"><?php previous_posts_link( '<span class="fa fa-angle-left"></span>' ); ?></li>
                        <?php endif; ?> 
                        <?php if( get_next_posts_link()): ?>
                        <li class="pagination_button_next"><?php next_posts_link( '<span class="fa fa-angle-right"></span>'); ?></li>
                        <?php endif; ?> 
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?> 
<?php else:?>
    <?php if ($wp_query->max_num_pages > 1) : ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">             
                <?php if (get_next_posts_link()) { ?>
                    <div class="load-more">
                        <div class="load_more_button">
                            <span data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>" rel="<?php echo esc_attr($wp_query->max_num_pages); ?>">
                                <?php echo get_next_posts_link(__('Load more', 'cryptcio')); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>                      
    <?php endif; ?>
<?php endif;?>

