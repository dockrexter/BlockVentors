<?php
$cryptcio_settings = cryptcio_check_theme_options();
?>
<div class="container">		
	<div class="footer-form">
		<?php
   				 if (is_active_sidebar('footer-form')) {
   		 ?> 
            <?php dynamic_sidebar('footer-form'); ?>
			<?php
   		 }
		?>
	</div>
</div>
<?php if (isset($cryptcio_settings['show-social']) && $cryptcio_settings['show-social']) : ?>
	<div class="dib footer-social">
        <ul>
        	<?php if (!empty($cryptcio_settings['social-facebook'])): ?>
                <li class="facebook"><a href="<?php echo esc_url($cryptcio_settings['social-facebook']) ?>"><i class="fa fa-facebook" aria-hidden="true"></i><?php echo esc_html__('Facebook','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-twitter'])): ?>
                <li class="twitter"><a href="<?php echo esc_url($cryptcio_settings['social-twitter']) ?>" ><i class="fa fa-twitter" aria-hidden="true"></i><?php echo esc_html__('Twitter','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-instagram'])): ?>
                <li class="instagram"><a href="<?php echo esc_url($cryptcio_settings['social-instagram']) ?>" ><i class="fa fa-instagram" aria-hidden="true"></i><?php echo esc_html__('Instagram','cryptcio') ?></a></li>
            <?php endif; ?>
            
            <?php if (!empty($cryptcio_settings['social-linkedin'])): ?>
                <li class="linkedin"><a href="<?php echo esc_url($cryptcio_settings['social-linkedin']) ?>" ><i class="fa fa-linkedin" aria-hidden="true"></i><?php echo esc_html__('Linkedin','cryptcio') ?></a></li>
            <?php endif; ?>
             <?php if (!empty($cryptcio_settings['social-slack'])): ?>
                <li class="slack"><a href="<?php echo esc_url($cryptcio_settings['social-slack']) ?>" ><i class="fa fa-slack" aria-hidden="true"></i><?php echo esc_html__('Slack','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-github'])): ?>
                <li class="github"><a href="<?php echo esc_url($cryptcio_settings['social-github']) ?>"><i class="fa fa-github-alt" aria-hidden="true"></i><?php echo esc_html__('Github','cryptcio') ?></a></li>
            <?php endif; ?>	
             <?php if (!empty($cryptcio_settings['social-google'])): ?>
                <li class="google"><a href="<?php echo esc_url($cryptcio_settings['social-google']) ?>" ><i class="fa fa-google-plus" aria-hidden="true"></i><?php echo esc_html__('Google Plus','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-pinterest'])): ?>
                <li class="pinterest"><a href="<?php echo esc_url($cryptcio_settings['social-pinterest']) ?>" ><i class="fa fa-pinterest" aria-hidden="true"></i><?php echo esc_html__('Pinterest','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-youtube'])): ?>
                <li class="youtube"><a href="<?php echo esc_url($cryptcio_settings['social-youtube']) ?>" ><i class="fa fa-youtube-play" aria-hidden="true"></i><?php echo esc_html__('Youtube','cryptcio') ?></a></li>
            <?php endif; ?>	                                    
           
             <?php if (!empty($cryptcio_settings['social-skype'])): ?>
                <li class="skype"><a href="<?php echo esc_url($cryptcio_settings['social-skype']) ?>"><i class="fa fa-skype" aria-hidden="true"></i><?php echo esc_html__('Skype','cryptcio') ?></a></li>
            <?php endif; ?>		
            <?php if (!empty($cryptcio_settings['social-behance'])): ?>
                <li class="behance"><a href="<?php echo esc_url($cryptcio_settings['social-behance']) ?>" ><i class="fa fa-behance" aria-hidden="true"></i><?php echo esc_html__('Behance','cryptcio') ?></a></li>
            <?php endif; ?>
            <?php if (!empty($cryptcio_settings['social-dribbble'])): ?>
                <li class="dribbble"><a href="<?php echo esc_url($cryptcio_settings['social-dribbble']) ?>"><i class="fa fa-dribbble" aria-hidden="true"></i><?php echo esc_html__('Dribbble','cryptcio') ?></a></li>
            <?php endif; ?>	
            		                        
        </ul>
	</div>
<?php endif;?>	
<?php if ($cryptcio_settings['footer-copyright'] || $cryptcio_settings['show-payment']) : ?>
	<div class="footer-bottom">
		<div class="container">				 		
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="bottom-footer">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12 copy-right">
								<div class="copyright-content"><?php echo wp_kses($cryptcio_settings['footer-copyright'],array(
			                        'a' => array(
			                            'href' => array(),
			                            'title' => array(),
			                            'target' => array(),
			                        ),
			                        'p' => array('class' => array()),
			                        'br' => array(),
			                        'i' => array(
			                            'class' => array(),
			                            'aria-hidden' => array(),
			                        ),
									)
									); ?>
										
								</div>	
							</div>
							<?php if (isset($cryptcio_settings['show-payment']) && $cryptcio_settings['show-payment']) : ?>
							<div class="col-md-6 col-sm-6 col-xs-12 f-right">
								<div class="payment">
									<ul>
										<?php if (!empty($cryptcio_settings['link-visa'])): ?>
											<li><a href="<?php echo esc_url($cryptcio_settings['link-visa']); ?>"><i class="fa fa-cc-visa"></i></a></li>
										<?php endif; ?>
										<?php if (!empty($cryptcio_settings['link-mastercard'])): ?>
											<li><a href="<?php echo esc_url($cryptcio_settings['link-mastercard']); ?>"><i class="fa fa-cc-mastercard"></i></a></li>
										<?php endif; ?>
										<?php if (!empty($cryptcio_settings['link-discover'])): ?>
											<li><a href="<?php echo esc_url($cryptcio_settings['link-discover']); ?>"><i class="fa fa-cc-discover"></i></a></li>
										<?php endif; ?>
										<?php if (!empty($cryptcio_settings['link-amex'])): ?>
											<li><a href="<?php echo esc_url($cryptcio_settings['link-amex']); ?>"><i class="fa fa-cc-amex"></i></a></li>
										<?php endif; ?>
										<?php if (!empty($cryptcio_settings['link-paypal'])): ?>
											<li><a href="<?php echo esc_url($cryptcio_settings['link-paypal']); ?>"><i class="fa fa-cc-paypal"></i></a></li>
										<?php endif; ?>
									</ul>
								</div>
							</div>	
							<?php endif;?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php endif;?>