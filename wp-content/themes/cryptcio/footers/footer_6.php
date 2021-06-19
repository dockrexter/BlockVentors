<?php
$cryptcio_settings = cryptcio_check_theme_options();
?>
<?php
    if (is_active_sidebar('footer-newsletter')) {
    ?> 
	<div class="footer-newsletter">
		<div class="container">
			<div class="footer-mailchimp">
            	<?php dynamic_sidebar('footer-newsletter'); ?>
			</div>
		</div>
	</div>
	<?php
    }
?>
<?php 
if(isset($cryptcio_settings['logo_footer']['url']) && $cryptcio_settings['logo_footer']['url']!=''){
	$logo_footer = (cryptcio_get_meta_value('logo_footer_page') != '') ? cryptcio_get_meta_value('logo_footer_page') : $cryptcio_settings['logo_footer']['url'];
}
?> 
<?php if ((isset($logo_footer) && $logo_footer != '')||(isset($cryptcio_settings['show-social']) && $cryptcio_settings['show-social'])|| is_active_sidebar('footer-contact') || is_active_sidebar('footer-column-1') || is_active_sidebar('footer-column-2') || is_active_sidebar('footer-column-3') || is_active_sidebar('footer-column-4')):?>
<div class="footer-top">
	<div class="container-fuild">
		 <div class="row">
		 	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="footer-container row"> 					
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
						<div class="footer-left-info">              
							<?php
							if (isset($logo_footer) && $logo_footer != ''):
								echo '<img class="footer-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_footer)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
							else:
								// bloginfo('name');
							endif;
							?>
								
						</div>
					</div>
			        <?php if (isset($cryptcio_settings['logo_footer']) && $cryptcio_settings['logo_footer'] && $cryptcio_settings['logo_footer']['url']):?>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<?php else:?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php endif;?>
			         <?php
					    if (is_active_sidebar('footer-menu')) {
					    ?> 
						<div class="footer-menu">
					         <?php dynamic_sidebar('footer-menu'); ?>
						</div>
						<?php
					    }
					?>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
						<div class="footer-right-info"> 
							<?php if (isset($cryptcio_settings['show-social']) && $cryptcio_settings['show-social']) : ?>
								<div class="dib footer-social ">
						            <ul>
						            	<?php if (!empty($cryptcio_settings['social-facebook'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-facebook']) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                <?php if (!empty($cryptcio_settings['social-twitter'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-twitter']) ?>" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                <?php if (!empty($cryptcio_settings['social-instagram'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-instagram']) ?>" ><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                
						                <?php if (!empty($cryptcio_settings['social-linkedin'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-linkedin']) ?>" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                 <?php if (!empty($cryptcio_settings['social-google'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-google']) ?>" ><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                <?php if (!empty($cryptcio_settings['social-pinterest'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-pinterest']) ?>" ><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                <?php if (!empty($cryptcio_settings['social-youtube'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-youtube']) ?>" ><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
						                <?php endif; ?>	                                    
						               
						                 <?php if (!empty($cryptcio_settings['social-skype'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-skype']) ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
						                <?php endif; ?>		
						                
						                <?php if (!empty($cryptcio_settings['social-behance'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-behance']) ?>" ><i class="fa fa-behance" aria-hidden="true"></i></a></li>
						                <?php endif; ?>
						                <?php if (!empty($cryptcio_settings['social-dribbble'])): ?>
						                    <li><a href="<?php echo esc_url($cryptcio_settings['social-dribbble']) ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						                <?php endif; ?>	
						                <?php if (!empty($cryptcio_settings['social-slack'])): ?>
							                <li><a href="<?php echo esc_url($cryptcio_settings['social-slack']) ?>" ><i class="fa fa-slack" aria-hidden="true"></i></a></li>
							            <?php endif; ?>
							            <?php if (!empty($cryptcio_settings['social-github'])): ?>
							                <li><a href="<?php echo esc_url($cryptcio_settings['social-github']) ?>"><i class="fa fa-github-alt" aria-hidden="true"></i></a></li>
							            <?php endif; ?>		                        
						            </ul>
								</div>
							<?php endif;?> 
						</div>   
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>