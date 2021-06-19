<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
    $cryptcio_project_layout = isset($cryptcio_settings['project-layout']) ? $cryptcio_settings['project-layout'] :'';
    $cryptcio_project_columns = isset($cryptcio_settings['project-cols']) ? $cryptcio_settings['project-cols'] :'';   
    $cryptcio_project_pagination = isset($cryptcio_settings['project_pagination']) ? $cryptcio_settings['project_pagination'] :'';   
    $cryptcio_left_project_sidebar = isset($cryptcio_settings['left-project-sidebar']) ? $cryptcio_settings['left-project-sidebar'] :'';  
    $cryptcio_right_project_sidebar = isset($cryptcio_settings['right-project-sidebar']) ? $cryptcio_settings['right-project-sidebar'] :'';   
    //$cryptcio_project_desc = isset($cryptcio_settings['project_desc']) ? $cryptcio_settings['project_desc'] :'';   

    $cryptcio_class = '';
    $cryptcio_class_columns = '';
    

    $cryptcio_class = ' blog-grid grid-isotope';
    if($cryptcio_project_columns == '1'){
        $cryptcio_class_columns = 'col-md-12 col-sm-12 col-xs-12';
    }else if($cryptcio_project_columns == '2'){
        $cryptcio_class_columns = 'col-md-6 col-sm-6 col-xs-12';
    }else if($cryptcio_project_columns == '4'){
        if ($cryptcio_left_project_sidebar == "" && $cryptcio_right_project_sidebar == ""){
            $cryptcio_class_columns = 'col-md-3 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-3 col-md-6 col-sm-6 col-xs-12';
        }
    }else{
        if ($cryptcio_left_project_sidebar == "" && $cryptcio_right_project_sidebar == ""){
            $cryptcio_class_columns = 'col-md-4 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
        }
    }   
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    
?>
<div class="row load-item project-entries-wrap <?php echo esc_attr($cryptcio_class).' '; ?>">
    <?php while (have_posts()) : the_post(); ?>
        <div class="grid-item <?php echo esc_attr($cryptcio_class_columns); ?> item-page<?php echo esc_attr($current_page); ?>">
            <div class="project-content">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="project-img">
						<?php 
							$attachment_id = get_post_thumbnail_id();
							$cryptcio_project_grid = cryptcio_get_attachment($attachment_id, 'cryptcio-project-grid'); 
						?>
						<a href="<?php the_permalink(); ?>"><img class="lazyignore" width="<?php echo esc_attr($cryptcio_project_grid['width']) ?>" height="<?php echo esc_attr($cryptcio_project_grid['height']) ?>" src="<?php echo esc_url($cryptcio_project_grid['src']) ?>" alt="<?php echo esc_html__('member','cryptcio') ?>" /></a>
					</div>  
				<?php endif;?>
				<div class="project-post-info">     
					<div class="link-plus"><a href="<?php the_permalink(); ?>"><?php echo esc_html__('+','cryptcio') ?></a></div>
					<?php if(get_the_title() != ''):?>
						<div class="blog-post-title">
							<div class="post-name">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                   
							</div>                  
						</div>
					<?php endif;?>
					<div class="info-category">
						<?php echo get_the_term_list($post->ID,'project_cat', '', ', ' ); ?>
					</div>
				</div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php if($cryptcio_project_pagination =='3'):?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 animate-top">             
            <div class="pagination-content text-center">
                    <?php cryptcio_pagination(); ?>
            </div>
        </div>
    </div>
<?php elseif($cryptcio_project_pagination =='2'):?>
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
                            <span data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>">
                                <?php echo get_next_posts_link(__('Load more', 'cryptcio')); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>                      
    <?php endif; ?>
<?php endif;?>

