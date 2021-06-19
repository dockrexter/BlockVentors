<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
	$single_layout = get_post_meta(get_the_ID(), 'single-post-layout-version', true);
	$single_layout = ($single_layout == 'default' || !$single_layout) ? $cryptcio_settings['single-post-layout-version'] : $single_layout;
    if (is_category()){
        $category = get_category( get_query_var( 'cat' ) );
        $cat_id = $category->cat_ID;
        if(get_metadata('category', $cat_id, 'single_blog_layouts', true) != 'default'){
            $post_layout = get_metadata('category', $cat_id, 'single_blog_layouts', true);
        }
    }
?>
<?php if($single_layout == 'single-2'):?>
	<div class="blog post-single single-2">
	    <div class="blog-content">
			<div class="blog-item">
				<?php cryptcio_get_post_media(); ?>
				<div class="post-single-2">
					<div class="blog-post-info">	
						<?php if(get_the_title() != ''):?>
							<div class="blog-post-title">
								<div class="post-name">
									<h3><?php the_title(); ?></h3>                                     
								</div>					
							</div>
						<?php endif;?>
						<div class="blog-info">
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('author', $cryptcio_settings['post-meta-single'])) : ?>
								<?php $cryptcio_author_id= $post->post_author;?>
								<div class="info author-name">
									<i class="fa fa-user"></i>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $cryptcio_author_id ); ?></a>
								</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('date', $cryptcio_settings['post-meta-single'])) : ?>
							<div class="info blog-date">
								<i class="fa fa-calendar"></i>
								<p class="date">
									<a href="<?php the_permalink(); ?>"><?php echo date('M, d'); ?></a>
								</p>
							</div>
							<?php endif;?>	
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('cat', $cryptcio_settings['post-meta-single'])) : ?>					
								<div class="info info-category">
									<?php echo get_the_term_list($post->ID,'category', '<i class="fa fa-folder"></i> ', ',  ' ); ?>
								</div>
							<?php endif;?>							
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('comment', $cryptcio_settings['post-meta-single'])) : ?>							
								<div class="info info-comment"> 
									<i class="fa fa-comment"></i>
									<?php comments_popup_link(esc_html__('0 ', 'cryptcio'), esc_html__('1', 'cryptcio'), esc_html__('%', 'cryptcio')); ?>
								</div>	
							<?php endif;?>								
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('view', $cryptcio_settings['post-meta-single'])) : ?>
								<div class="info info-view">
									<div class="info info-view">
										<i class="ion-eye"></i> <?php echo cryptcio_getPostViews(get_the_ID()); ?>
									</div>	
								</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('like', $cryptcio_settings['post-meta-single'])) : ?>
								<div class="info info-like">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i>
									<?php  if(function_exists('arrowpress_core_getPostLikeLink')) {
										echo arrowpress_core_getPostLikeLink(get_the_ID());
										}
									?>
								</div>	
							<?php endif;?>
								
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('tag', $cryptcio_settings['post-meta-single']) && get_the_tag_list()) : ?>					
									<div class="info info-tag">
										<i class="fa fa-tag"></i>
											<?php echo get_the_tag_list('',', ',''); ?>
									</div>
							<?php endif;?>									
						</div>			
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
						<div class="action">
						<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('tag', $cryptcio_settings['post-meta-single'])) : ?>
							<div class="tag-post">
								<?php echo get_the_tag_list('<i class="fa fa-tag"></i> ',', ',''); ?>
							</div>
						<?php endif;?>
							<?php 
								if(function_exists('arrowpress_core_get_share_link')){
									arrowpress_core_get_share_link();
								}
							?>	
						</div>
					</div>	
					<?php cryptcio_author_box();?>
					<div class="pagination-link">
						<?php
						$previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
						$next = get_adjacent_post(false, '', false);
						$prev_post = get_previous_post();
						$next_post = get_next_post();
						if ($next || $previous) :
						?>
							<nav class="navigation case-navigation">
								<div class="nav-links">
									<?php
									if($prev_post){
									previous_post_link('<div class="nav-previous"><a href="'.get_permalink( $prev_post->ID ).'"><i class="fa fa-angle-double-left"></i> </a> %link</div>', '%title');
									}
									else echo '<div class="nav-previous"></div>';
									if($next_post){
									next_post_link('<div class="nav-next">%link <a href="'.get_permalink( $next_post->ID ).'"><i class="fa fa-angle-double-right"></i> </a></div>', '%title');
									}
									?>
								</div><!-- .nav-links -->
							</nav><!-- .navigation -->
							<?php
						endif;
						?>
						<div class="btn-viewmore">
							<a class="view_more" href="<?php echo get_post_type_archive_link('post'); ?>"><i class="ion-grid"></i></a>
						</div>
					</div>
					<?php comments_template('', true); ?>  
				</div>
			</div>
		</div>	
	</div>
<?php else: ?>
	<div class="blog post-single single-1">
	    <div class="blog-content">
			<div class="blog-item">
				<div class="blog-top">
					<?php cryptcio_get_post_media(); ?>
				</div>
				<div class="blog-bottom">
					<div class="blog-post-info">
						<div class="blog-info">
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('date', $cryptcio_settings['post-meta-single'])) : ?>
								<div class=" info blog-date">
									<i class="fa fa-calendar"></i>
									<p><?php echo get_the_date(); ?></p>
								</div>							
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('author', $cryptcio_settings['post-meta-single'])) : ?>
								<?php $cryptcio_author_id= $post->post_author;?>
								<div class="info author-name">
									<i class="fa fa-user"></i>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author_meta( 'nickname' , $cryptcio_author_id ); ?></a>
								</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('cat', $cryptcio_settings['post-meta-single'])) : ?>					
								<div class="info info-category">
									<?php echo get_the_term_list($post->ID,'category', '<i class="fa fa-folder"></i> ', ',  ' ); ?>
								</div>
							<?php endif;?>							
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('comment', $cryptcio_settings['post-meta-single'])) : ?>							
								<div class="info info-comment"> 
									<i class="fa fa-comment"></i> <?php comments_popup_link(esc_html__('0', 'cryptcio'), esc_html__('1 ', 'cryptcio'), esc_html__('% ', 'cryptcio')); ?>
								</div>	
							<?php endif;?>								
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('view', $cryptcio_settings['post-meta-single'])) : ?>
							<div class="info info-view">
								<div class="info info-view">
									<i class="ion-eye"></i> <?php echo cryptcio_getPostViews(get_the_ID()); ?>
								</div>	
							</div>	
							<?php endif;?>
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('like', $cryptcio_settings['post-meta-single'])) : ?>
							<div class="info info-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i>
								<?php  if(function_exists('arrowpress_core_getPostLikeLink')) {
									echo arrowpress_core_getPostLikeLink(get_the_ID());
									}
								?>
							</div>	
							<?php endif;?>
							
							<?php if (isset($cryptcio_settings['post-meta-single']) && in_array('tag', $cryptcio_settings['post-meta-single']) && get_the_tag_list()) : ?>					
								<div class="info info-tag">
									<i class="fa fa-tag"></i>
										<?php echo get_the_tag_list('',', ',''); ?>
								</div>
							<?php endif;?>										
						</div>	
					</div>	
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
				<div class="action">
					<?php 
						if(function_exists('arrowpress_core_get_share_link')){
							arrowpress_core_get_share_link();
						}
					?>	
				</div>
			</div>
		</div>	
		<?php cryptcio_author_box();?>
	    <?php comments_template('', true); ?>  
	</div>
<?php endif; ?>