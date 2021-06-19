<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
?>
<div class="service-single project-single">
    <div class="blog-content">
        <div class="blog-item">
            <?php if ( has_post_thumbnail()) : ?>
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