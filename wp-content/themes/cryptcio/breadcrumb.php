<?php
$cryptcio_settings = cryptcio_check_theme_options();
$header_type = cryptcio_get_header_type();
$breadcrumbs = cryptcio_get_meta_value('breadcrumbs', true);
$breadcrumbs_layout = get_post_meta(get_the_ID(), 'breadcrumbs_style', true);
$breadcrumbs_layout = ($breadcrumbs_layout == 'default' || !$breadcrumbs_layout) ? $cryptcio_settings['breadcrumbs_style'] : $breadcrumbs_layout;
$page_title = cryptcio_get_meta_value('page_title', true);
$breadcrumbs_align = isset($cryptcio_settings['breadcrumbs_align']) ? $cryptcio_settings['breadcrumbs_align'] :'';
if (( is_front_page() && is_home()) || is_front_page() || is_page_template( 'coming-soon.php' )) {
    $breadcrumbs = false;
    $page_title = false;
}
$cryptcio_breadcrumb_class='';
if(isset($cryptcio_settings['breadcrumbs-bg']) && $cryptcio_settings['breadcrumbs-bg']['background-image'] !=''){
	$cryptcio_breadcrumb_class = 'use_bg_image';
}
$cryptcio_breadcrumbs_align='';
if($breadcrumbs_align == 'left'){
	$cryptcio_breadcrumbs_align = ' text-left';
}else if($breadcrumbs_align == 'right'){
	$cryptcio_breadcrumbs_align = ' text-right';
}else{
	$cryptcio_breadcrumbs_align = ' text-center';
}
?>
<?php if($breadcrumbs_layout == 'type-3'):?>
	<?php if ($breadcrumbs || $page_title) : ?>
	<div class="side-breadcrumb type-3 has-overlay <?php echo esc_attr($cryptcio_breadcrumb_class);?><?php echo esc_attr($cryptcio_breadcrumbs_align);?>"> 
		<div class="container">
	        <div class="row">
	        	<div class="col-md-12 col-sm-12 col-xs-12 breadcrumb-container <?php if(get_the_title() == ''){echo 'breadcrumb_no_title';}?>">
				    <?php if((isset($cryptcio_settings['breadcrumbs-title']) && $cryptcio_settings['breadcrumbs-title'])): ?>
						<?php if($page_title && (get_the_title() != '' || is_404())) :?>
							<div class="page-title"><h1><?php cryptcio_page_title(); ?></h1></div>
						<?php endif;?>
					<?php endif;?>
				    <?php if(isset($cryptcio_settings['breadcrumbs-link']) && $cryptcio_settings['breadcrumbs-link']):?>
						<?php if ($breadcrumbs) : ?>
							<?php cryptcio_breadcrumbs(); ?>
						<?php endif;?>
				    <?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php elseif($breadcrumbs_layout == 'type-2'):?>
	<?php if ($breadcrumbs || $page_title) : ?>
	<div class="side-breadcrumb has-overlay type-2 <?php echo esc_attr($cryptcio_breadcrumb_class);?><?php echo esc_attr($cryptcio_breadcrumbs_align);?>"> 
		<div class="container">
	        <div class="row">
	        	<div class="col-md-12 col-sm-12 col-xs-12 breadcrumb-container <?php if(get_the_title() == ''){echo 'breadcrumb_no_title';}?>">
				   <?php if((isset($cryptcio_settings['breadcrumbs-title-false']) && $cryptcio_settings['breadcrumbs-title-false'])): ?>
						<?php if($page_title && (get_the_title() != '' || is_404())) :?>
							<div class="page-title"><h1><?php cryptcio_page_title(); ?></h1></div>
						<?php endif;?>
					<?php endif;?>
				    <?php if(isset($cryptcio_settings['breadcrumbs-link']) && $cryptcio_settings['breadcrumbs-link']):?>
						<?php if ($breadcrumbs) : ?>
							<?php cryptcio_breadcrumbs(); ?>
						<?php endif;?>
				    <?php endif;?>			    
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php else: ?>
	<?php if ($breadcrumbs || $page_title) : ?>
	<div class="side-breadcrumb has-overlay type-1 <?php echo esc_attr($cryptcio_breadcrumb_class);?><?php echo esc_attr($cryptcio_breadcrumbs_align);?>"> 
		<div class="container">
	        <div class="row">
	        	<div class="col-md-12 col-sm-12 col-xs-12 breadcrumb-container <?php if(get_the_title() == ''){echo 'breadcrumb_no_title';}?>">
				    <?php if((isset($cryptcio_settings['breadcrumbs-title']) && $cryptcio_settings['breadcrumbs-title'])): ?>
						<?php if($page_title && (get_the_title() != '' || is_404())) :?>
							<div class="page-title"><h1><?php cryptcio_page_title(); ?></h1></div>
						<?php endif;?>
					<?php endif;?>
				    <?php if(isset($cryptcio_settings['breadcrumbs-link']) && $cryptcio_settings['breadcrumbs-link']):?>
						<?php if ($breadcrumbs) : ?>
							<?php cryptcio_breadcrumbs(); ?>
						<?php endif;?>
				    <?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php endif; ?>