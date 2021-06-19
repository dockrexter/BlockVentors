<?php $cryptcio_settings = cryptcio_check_theme_options(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :?>
        <?php if (!empty($cryptcio_settings['favicon'])): ?>
            <link rel="shortcut icon" href="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $cryptcio_settings['favicon']['url'])); ?>" type="image/x-icon" />
        <?php endif; ?>
    <?php endif;?>    
    <?php wp_head(); ?>
</head>
<?php
$cryptcio_sidebar_left = cryptcio_get_sidebar_left();
$cryptcio_sidebar_right = cryptcio_get_sidebar_right();
$cryptcio_layout = cryptcio_get_layout();
$header_type = cryptcio_get_header_type();
$header_position = cryptcio_get_header_mobile_position();
$cryptcio_remove_space_br = cryptcio_get_meta_value('remove_space_br', true);
$cryptcio_remove_space = cryptcio_get_meta_value('remove_space', true);
$cryptcio_header_fixed = get_post_meta(get_the_ID(), 'header_fixed', true);
$cryptcio_footer_fixed = get_post_meta(get_the_ID(), 'footer_fixed', true);
$cryptcio_header_top_hidden = get_post_meta(get_the_ID(), 'header_hidden_top', true);
$cryptcio_top_slide = get_post_meta(get_the_ID(), 'header_topslide', true);
$footer_class = '';
$header_class = '';
$header_position_class = '';
$header_hidden_top = '';
$cryptcio_coming_soon_class = '';
if($cryptcio_header_fixed || (isset($cryptcio_settings['header-fixed']) && $cryptcio_settings['header-fixed']) && !is_404()){
    $header_class .= ' fixed-header';
}
if($cryptcio_footer_fixed || (isset($cryptcio_settings['footer-position']) && $cryptcio_settings['footer-position']) && !is_404()){
    $footer_class = ' footer-fixed';
}
if($header_position == '2'){
    $header_position_class .= ' header-bottom';
}else{
	$header_position_class .= ' header-top';
}
if($cryptcio_header_top_hidden){
	$header_hidden_top .= ' hide-top';
}
$show_header = cryptcio_get_meta_value('show_header', true);
if (is_404() || is_page_template( 'coming-soon.php' )) {
    $cryptcio_layout =  'wide';
    $show_header ='';
}

if(is_page_template( 'coming-soon.php' ) && isset($cryptcio_settings['coming_footer_display']) && !$cryptcio_settings['coming_footer_display']){
    $cryptcio_coming_soon_class =' hide_footer ';
}
if(is_page_template( 'coming-soon.php' ) && isset($cryptcio_settings['coming_header_display']) && !$cryptcio_settings['coming_header_display']){
    $cryptcio_coming_soon_class .=' hide_header ';
}

$layout_class = '';
if($cryptcio_layout == 'wide'){
	$layout_class = ' wide';
}elseif($cryptcio_layout == 'fullwidth'){
	$layout_class = ' full-width';
}else{
	$layout_class = '';
}
$layout_class2 = '';
if($cryptcio_layout == 'boxed'){
    $layout_class2 = ' boxed';
}
?>
<body <?php body_class(); ?>>
    <?php echo cryptcio_pre_loader();?>
	<div id="page" class="hfeed site <?php if(!$cryptcio_remove_space){echo 'remove_space';}?> <?php if(!$cryptcio_remove_space_br){echo 'remove_space_br';}?> <?php echo esc_attr($header_class);?> <?php echo esc_attr($footer_class); ?> <?php echo esc_attr($cryptcio_coming_soon_class);?> <?php echo esc_attr($layout_class2); ?>">
        <?php if ($show_header) : ?>
            <header id="masthead" class="site-header<?php echo esc_attr($header_position_class); ?> header-v<?php echo esc_attr($header_type); ?> <?php echo esc_attr($header_hidden_top); ?>">
                <?php if($cryptcio_top_slide || (isset($cryptcio_settings['header-topslide']) ? $cryptcio_settings['header-topslide'] :'')): ?>
					<?php cryptcio_get_post_banner_block(); ?>
				<?php endif; ?>
				<?php get_template_part('headers/header_' . $header_type); ?>
            </header> <!-- End masthead -->
        <?php endif; ?>
        <?php get_template_part('breadcrumb'); ?>
        <?php cryptcio_get_page_banner();?>
        <div id="main" class="wrapper <?php echo esc_attr($layout_class); ?>">
        <?php if($cryptcio_layout == 'fullwidth') :?>
            <div class="container">
				 <div class="row">    
			<?php else: ?>
			<div class="container-fluid">
			<?php endif;?> 
            

                    
        
       
