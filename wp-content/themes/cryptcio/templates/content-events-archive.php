<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
    $cryptcio_events_layout = isset($cryptcio_settings['events-layout']) ? $cryptcio_settings['events-layout'] :'';
    $cryptcio_events_columns = isset($cryptcio_settings['events-cols']) ? $cryptcio_settings['events-cols'] :'';   
    $cryptcio_events_pagination = isset($cryptcio_settings['events_pagination']) ? $cryptcio_settings['events_pagination'] :'';   
    $cryptcio_left_events_sidebar = isset($cryptcio_settings['left-events-sidebar']) ? $cryptcio_settings['left-events-sidebar'] :'';  
    $cryptcio_right_events_sidebar = isset($cryptcio_settings['right-events-sidebar']) ? $cryptcio_settings['right-events-sidebar'] :'';   
    //$cryptcio_events_desc = isset($cryptcio_settings['events_desc']) ? $cryptcio_settings['events_desc'] :'';   

    $cryptcio_class = '';
    $cryptcio_class_columns = '';
    

    $cryptcio_class = ' grid-isotope';
    if($cryptcio_events_columns == '1'){
        $cryptcio_class_columns = 'col-md-12 col-sm-12 col-xs-12';
    }else if($cryptcio_events_columns == '2'){
        $cryptcio_class_columns = 'col-md-6 col-sm-6 col-xs-12';
    }else if($cryptcio_events_columns == '4'){
        if ($cryptcio_left_events_sidebar == "" && $cryptcio_right_events_sidebar == ""){
            $cryptcio_class_columns = 'col-md-3 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-3 col-md-6 col-sm-6 col-xs-12';
        }
    }else{
        if ($cryptcio_left_events_sidebar == "" && $cryptcio_right_events_sidebar == ""){
            $cryptcio_class_columns = 'col-md-4 col-sm-6 col-xs-12';
        }else{
            $cryptcio_class_columns = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
        }
    }   
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    
?>
<div class="row load-item events-entries-wrap <?php echo esc_attr($cryptcio_class).' '; ?>">
    <?php while (have_posts()) : the_post(); ?>
        <div class="grid-item <?php echo esc_attr($cryptcio_class_columns); ?>">
            <div class="event-content clearfix">
				<?php 
					$loaction_event = get_post_meta(get_the_ID(),'loaction_event', true);
					$time_event = get_post_meta(get_the_ID(),'time_event', true);
					$date_event = get_post_meta(get_the_ID(),'date_event', true);
				?>
				<div class="event-date">
					<?php
						echo wp_kses($date_event,array(
							'span' => array(
							'br' => array(),
							'strong' => array(),
							)
						));
					?>
				</div>
				<div class="event-post-info">   
					<?php if(get_the_title() != ''):?>
						<div class="event-post-title">
							<div class="post-name">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?>       
								</a>                                   
							</div>                  
						</div>
					<?php endif;?>
					<div class="event-info">
						<p class="loaction-event"><i class="fa fa-map-marker"></i> <span><?php echo esc_html($loaction_event); ?><span></p>
						<p class="time-event"><i class="fa fa-clock-o"></i> <span><?php echo esc_html($time_event); ?></span></p>
					</div>
				</div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php if($cryptcio_events_pagination =='3'):?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 animate-top">             
            <div class="pagination-content text-center">
                    <?php cryptcio_pagination(); ?>
            </div>
        </div>
    </div>
<?php elseif($cryptcio_events_pagination =='2'):?>
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

