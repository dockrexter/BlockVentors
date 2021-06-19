<?php 
$cryptcio_settings = cryptcio_check_theme_options();
$footer_type = cryptcio_get_footer_type();
$cryptcio_layout = cryptcio_get_layout();
$cryptcio_hide_footernewsletter = cryptcio_get_meta_value('hide_footernewsletter', true);
$cryptcio_hide_f_info = cryptcio_get_meta_value('hide_f_info', true);
$cryptcio_hidden_f_newsletter = get_post_meta(get_the_ID(), 'hidden_footer_newsletter', true);
$cryptcio_hidden_contact = get_post_meta(get_the_ID(), 'footer_hidden_contact', true);
$footer_hidden_class = '';
if($cryptcio_hidden_f_newsletter){
    $footer_hidden_class = ' hidden_newsletter';
}
if (is_404() || is_page_template( 'coming-soon.php' )) {
    $cryptcio_layout =  'wide';
}
if(is_404()){
	$cryptcio_show_footer = '';
}else{
	$cryptcio_show_footer = cryptcio_get_meta_value('show_footer', true);
}
$layout_class = '';
if($cryptcio_layout == 'wide'){
	$layout_class = ' wide';
}elseif($cryptcio_layout == 'fullwidth'){
	$layout_class = ' full-width';
}else{
	$layout_class = ' boxed';
}
?> 
	<?php if($cryptcio_layout == 'fullwidth') :?>
		</div>
	</div>
	<?php else:?>
		</div>
	<?php endif; ?>
</div> <!-- End main-->
<?php if ($cryptcio_show_footer) : ?>
<footer id="colophon" class="footer <?php if($cryptcio_hidden_contact){echo 'add_contact';}?> <?php if(!$cryptcio_hide_f_info){echo 'remove_f_info';}?> <?php echo esc_attr($footer_hidden_class); ?> <?php echo esc_attr($layout_class); ?>">
    <div class="footer-v<?php echo esc_attr($footer_type); ?>">      
        <?php get_template_part('footers/footer_' . $footer_type); ?>
    </div> <!-- End footer -->
</footer> <!-- End colophon -->
<?php endif;?>
</div> <!-- End page-->
<?php wp_footer(); ?>
</body>
</html>