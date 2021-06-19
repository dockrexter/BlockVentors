<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
    $cryptcio_post_layout = isset($cryptcio_settings['post-layout-version']) ? $cryptcio_settings['post-layout-version'] :'';
    $cryptcio_post_columns = isset($cryptcio_settings['post-layout-columns']) ? $cryptcio_settings['post-layout-columns'] :'';   
    $cryptcio_post_pagination = isset($cryptcio_settings['post_pagination']) ? $cryptcio_settings['post_pagination'] :'';   
    $cryptcio_left_post_sidebar = isset($cryptcio_settings['left-post-sidebar']) ? $cryptcio_settings['left-post-sidebar'] :'';  
    $cryptcio_right_post_sidebar = isset($cryptcio_settings['right-post-sidebar']) ? $cryptcio_settings['right-post-sidebar'] :'';   
    //$cryptcio_post_desc = isset($cryptcio_settings['post_desc']) ? $cryptcio_settings['post_desc'] :'';   
    if (is_category()){
        $category = get_category( get_query_var( 'cat' ) );
        $cat_id = $category->cat_ID;
        if(get_metadata('category', $cat_id, 'blog_layout', true) != 'default'){
            $cryptcio_post_layout = get_metadata('category', $cat_id, 'blog_layout', true);    
        }
        if(get_metadata('category', $cat_id, 'blog_columns', true) != 'default'){
        	$cryptcio_post_columns = get_metadata('category', $cat_id, 'blog_columns', true);  
        } 
        if(get_metadata('category', $cat_id, 'post_pagination', true) != 'default'){
            $cryptcio_post_pagination = get_metadata('category', $cat_id, 'post_pagination', true);
        }  
		if(get_metadata('category', $cat_id, 'left-sidebar', true) != 'default'){
            $cryptcio_left_post_sidebar = get_metadata('category', $cat_id, 'left-sidebar', true);
        } 
		if(get_metadata('category', $cat_id, 'right-sidebar', true) != 'default'){
            $cryptcio_right_post_sidebar = get_metadata('category', $cat_id, 'right-sidebar', true);
        }               
    }
    $cryptcio_skin = get_post_meta(get_the_ID(),'skin',true);
	$cryptcio_class = '';
	$cryptcio_class_columns = '';
	
	if($cryptcio_post_layout == 'masonry'){
		$cryptcio_class = ' blog-masonry grid-isotope';
	}else if($cryptcio_post_layout == 'list'){
		$cryptcio_class = ' blog-list';
		$cryptcio_post_columns = '1';
	}else{
		$cryptcio_class = ' blog-grid grid-isotope';
	}
	if($cryptcio_post_columns == '1'){
		$cryptcio_class_columns = 'col-md-12 col-sm-12 col-xs-12';
	}else if($cryptcio_post_columns == '2'){
		$cryptcio_class_columns = 'col-md-6 col-sm-6 col-xs-12';
	}else if($cryptcio_post_columns == '4'){
		if ($cryptcio_left_post_sidebar == "" && $cryptcio_right_post_sidebar == ""){
			$cryptcio_class_columns = 'col-md-3 col-sm-6 col-xs-12';
		}else{
			$cryptcio_class_columns = 'col-lg-3 col-md-6 col-sm-6 col-xs-12';
		}
	}else{
		if ($cryptcio_left_post_sidebar == "" && $cryptcio_right_post_sidebar == ""){
			$cryptcio_class_columns = 'col-md-4 col-sm-6 col-xs-12';
		}else{
			$cryptcio_class_columns = 'col-lg-4 col-md-6 col-sm-6 col-xs-12';
		}
	}	
    $current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
	
?>
<div class="row load-item blog-entries-wrap <?php echo esc_attr($cryptcio_class).' '; ?>">
	<?php while (have_posts()) : the_post(); ?>
		<div class="grid-item <?php echo esc_attr($cryptcio_class_columns); ?> item-page<?php echo esc_attr($current_page); ?>">
			<div class="blog-content">
				<div class="blog-item <?php if(isset($cryptcio_settings['post_default_date'])&& $cryptcio_settings['post_default_date']){echo ' post_default_date_enable ';}?>">
					<?php cryptcio_get_post_media(); ?>
					<?php if ($cryptcio_post_layout == "list"): ?>
						<?php if (isset($cryptcio_settings['post-meta2']) && in_array('date', $cryptcio_settings['post-meta2'])) : ?>
							<?php if(isset($cryptcio_settings['post_default_date'])&& $cryptcio_settings['post_default_date']):?>
								<div class=" blog-date type1 type-default">
									<p><?php echo get_the_date(); ?></p>
								</div>								
							<?php else:?>
								<div class=" blog-date type1">
									<p class="date"><?php echo get_the_time('d'); ?></p>
									<p class="month"><?php echo get_the_time('M'); ?></p>
								</div>								
							<?php endif;?>
						
						<?php endif;?>
					<?php endif; ?>
					<div class="blog-post-info <?php if (has_post_thumbnail() == '' && (get_post_format() != 'audio') && (get_post_format() != 'video')){ echo 'no-img';}?>">
						<?php if(get_the_title() != ''):?>
							<div class="blog-post-title">
								<div class="post-name">
									<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?>       
									</a> 
									<?php  if ( is_sticky() && is_home() && ! is_paged() ):?>
									 <span class="sticky_post"><?php echo esc_html__('Featured', 'cryptcio')?></span>
									<?php                                    endif;?>                                   
								</div>					
							</div>
						<?php endif;?>
						
						<div class="blog-info">
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('author', $cryptcio_settings['post-meta2'])) : ?>
								<?php $cryptcio_author_id= $post->post_author;?>
								<div class="info author-name">
									<i class="fa fa-user"></i>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $cryptcio_author_id ); ?></a>
								</div>	
							<?php endif;?>
							<?php if ($cryptcio_post_layout != "list"): ?>
								<?php if (isset($cryptcio_settings['post-meta2']) && in_array('date', $cryptcio_settings['post-meta2'])) : ?>
								<div class="info blog-date">
									<p class="date">
										<a href="<?php the_permalink(); ?>"><?php echo get_the_date('M, d'); ?></a>
									</p>
								</div>
								<?php endif;?>
							<?php endif; ?>
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('cat', $cryptcio_settings['post-meta2'])) : ?>					
								<div class="info info-category">
									<?php echo get_the_term_list($post->ID,'category', '<i class="fa fa-folder"></i> ', ',  ' ); ?>
								</div>
							<?php endif;?>	
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('comment', $cryptcio_settings['post-meta2'])) : ?>							
								<div class="info info-comment"> 
									<i class="fa fa-comment"></i> <?php comments_popup_link(esc_html__('0 ', 'cryptcio'), esc_html__('1', 'cryptcio'), esc_html__('% ', 'cryptcio')); ?>
								</div>	
							<?php endif;?>	
											
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('view', $cryptcio_settings['post-meta2'])) : ?>
							<div class="info info-view">
								<i class="ion-eye"></i> <?php echo cryptcio_getPostViews(get_the_ID()); ?>
							</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('like', $cryptcio_settings['post-meta2'])) : ?>
							<div class="info info-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i>
								<?php  if(function_exists('arrowpress_core_getPostLikeLink')) {
									echo arrowpress_core_getPostLikeLink(get_the_ID());
									}
								?>
							</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta2']) && in_array('tag', $cryptcio_settings['post-meta2']) && get_the_tag_list()) : ?>
								<div class="info info-tag">
										<i class="fa fa-tag"></i>
									<?php echo get_the_tag_list('',', ',''); ?>
								</div>
							<?php endif;?>										
						</div>
						<?php if ($cryptcio_post_layout == "list"): ?>
							<div class="blog_post_desc">
									<?php 
									if (get_post_meta(get_the_ID(),'highlight',true) != "") : ?>                            
										<?php echo get_post_meta(get_the_ID(),'highlight',true);?>
									<?php else:?>
										<?php
										echo '<div class="entry-content">';
										the_content();
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
						<?php else: ?>
							<div class="blog_post_desc">
								<?php 
								if (get_post_meta(get_the_ID(),'highlight',true) != "") : ?>                            
									<?php echo the_excerpt();?>
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
						<?php endif; ?>
						<div class="read-more">
							<a  href="<?php the_permalink();?>"><?php echo esc_html__('Read more >>','cryptcio');?></a>
						</div>
					</div>	
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php if($cryptcio_post_pagination =='3'):?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 animate-top">				
			<div class="pagination-content text-center">
					<?php cryptcio_pagination(); ?>
			</div>
		</div>
	</div>
<?php elseif($cryptcio_post_pagination =='2'):?>
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

