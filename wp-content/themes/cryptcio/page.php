<?php get_header(); ?>

<?php 
	$cryptcio_class = '';
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
            <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'templates/content', 'page' ); ?>

                    <?php	if ( comments_open() || get_comments_number() ) {
							comments_template();
							}
					?>				
            <?php endwhile; // End of the loop. ?>
		</div><!-- End primary -->
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>