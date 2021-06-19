<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
?>

<div class="service-single">
    <div class="blog-content">
        <div class="blog-item">
            <?php if ( has_post_thumbnail() && get_post_meta(get_the_ID(),'service_show_image',true)!='hide') : ?>
                <div class="service-img">
                    <?php 
                        $attachment_id = get_post_thumbnail_id();
                        $cryptcio_service_grid = cryptcio_get_attachment($attachment_id, 'cryptcio-service-single'); 
                    ?>
                    <img class="lazyignore" width="<?php echo esc_attr($cryptcio_service_grid['width']) ?>" height="<?php echo esc_attr($cryptcio_service_grid['height']) ?>" src="<?php echo esc_url($cryptcio_service_grid['src']) ?>" alt="<?php echo esc_html__('member','cryptcio') ?>" />
                </div>  
            <?php endif;?>
            <div class="blog-post-info">  
              <?php if(get_the_title() != '' && get_post_meta(get_the_ID(),'service_show_image',true)!='hide'):?>
                <div class="blog-post-title">
                  <div class="post-name">
                    <h3><?php the_title(); ?></h3>                                     
                  </div>          
                </div>
              <?php endif;?>      
              <div class="blog_post_desc">          
                <?php the_content();?>
                  <?php 
                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cryptcio' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                      'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cryptcio' ) . ' </span>%',
                      'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                  ?>              
              </div>
            </div>  

        </div>
    </div>
</div>
<?php 
$gallery_related = get_post_meta(get_the_ID(), 'related_entries', true);
?>
<?php if (is_array($gallery_related)) : ?>
    <?php if (count($gallery_related) > 0) : ?>
        <div class="service_related">
            <div class="container">
                <h3><?php echo esc_html__('Related Services','cryptcio' );?> </h3>
                <div class="row blog-grid service-entries-wrap grid-isotope">
                    <?php foreach ($gallery_related as $key => $entry) : ?>
                        <?php 
                        $cryptcio_service_columns = isset($cryptcio_settings['service-cols']) ? $cryptcio_settings['service-cols'] :'';   
                        $cryptcio_left_service_sidebar = isset($cryptcio_settings['left-service-sidebar']) ? $cryptcio_settings['left-service-sidebar'] :'';  
                        $cryptcio_right_service_sidebar = isset($cryptcio_settings['right-service-sidebar']) ? $cryptcio_settings['right-service-sidebar'] :'';   

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
                        ?>
                        <div class="grid-item <?php echo esc_attr($cryptcio_class_columns); ?>">
                            <div class="blog-content">
                                <div class="blog-item">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="service-img">
                                            <?php 
                                                $attachment_id = get_post_thumbnail_id($entry);
                                                $cryptcio_service_grid = cryptcio_get_attachment($attachment_id, 'cryptcio-service-grid');
                                            ?>
                                            <a href="<?php echo get_permalink($entry); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            <img class="lazyignore" width="<?php echo esc_attr($cryptcio_service_grid['width']) ?>" height="<?php echo esc_attr($cryptcio_service_grid['height']) ?>" src="<?php echo esc_url($cryptcio_service_grid['src']) ?>" alt="<?php echo esc_html($cryptcio_service_grid['alt']) ?>" />
                                        </div>  
                                    <?php endif;?>

                                    <div class="blog-post-info">                   
                                        <?php if(get_the_title($entry) != ''):?>
                                            <div class="blog-post-title">
                                                <div class="post-name">
                                                    <a href="<?php echo get_permalink($entry); ?>"><?php echo get_the_title($entry); ?>       
                                                    </a>                                   
                                                </div>                  
                                            </div>
                                        <?php endif;?>
                                        <div class="blog_post_desc">
                                            <?php 
                                            if (get_post_meta($entry,'desc',true) != "") : ?>                            
                                                <?php echo get_post_meta($entry,'desc',true);?>
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
                                            <a  href="<?php echo get_permalink($entry);?>"><?php echo esc_html__('Read more','cryptcio');?><i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>    
        </div>
    <?php endif; ?>
<?php endif; ?>  