<?php get_header(); ?>

<?php 
	$cryptcio_class = '';
	$cryptcio_sidebar_left = cryptcio_get_sidebar_left();
	$cryptcio_sidebar_right = cryptcio_get_sidebar_right();
	$cryptcio_layout = cryptcio_get_layout();	
	$cryptcio_settings = cryptcio_check_theme_options(); 
	if ($cryptcio_sidebar_left && $cryptcio_sidebar_right && is_active_sidebar($cryptcio_sidebar_left) && is_active_sidebar($cryptcio_sidebar_right)){
	 	$cryptcio_class .= 'col-md-6 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif($cryptcio_sidebar_left && (!$cryptcio_sidebar_right|| $cryptcio_sidebar_right=="none") && is_active_sidebar($cryptcio_sidebar_left)){
		$cryptcio_class .= 'f-right col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}elseif((!$cryptcio_sidebar_left || $cryptcio_sidebar_left=="none") && $cryptcio_sidebar_right && is_active_sidebar($cryptcio_sidebar_right)){
		$cryptcio_class .= 'col-lg-9 col-md-9 col-sm-12 col-xs-12 main-sidebar'; 
	}else {
		$cryptcio_class .= 'content-primary'; 
		if($cryptcio_layout == 'fullwidth'){
			$cryptcio_class .= ' col-md-12';
		}
	}
?>
<?php get_sidebar('left'); ?> 
	<div class="<?php echo esc_attr($cryptcio_class);?>">			
		<div id="primary" class="content-area">
             <?php if (have_posts()): ?>                        
                 <?php get_template_part( 'templates/content', 'blog-archive' ); ?>
             <?php else: ?> 
			    <article id="post-0" class="post no-results not-found">
			        <div class="container">
			            <h1 class="entry-title not-found-title"><?php echo esc_html__('Nothing Found', 'cryptcio'); ?></h1>
			            <div class="row">
			                <div class="entry-content">
			                    <div class="col-md-6 col-sm-12 col-xs-12">
			                        <p><?php echo esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'cryptcio'); ?></p>
			                        <div class="widget widget_search">
			                        <?php get_search_form(); ?>
			                        </div>
			                    </div>
			                </div><!-- .entry-content -->
			            </div>
			        </div>
			    </article><!-- #post-0 -->
             <?php endif; ?>
		</div> <!-- End primary -->
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>