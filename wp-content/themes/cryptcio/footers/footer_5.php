<?php
$cryptcio_settings = cryptcio_check_theme_options();
?>
<div class="footer-menu">
	<div class="container">
		<div class="row"> 					
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="menu-top">
					<?php
						$before_items_wrap = '';
						$after_item_wrap = '';                  
						if(cryptcio_get_footer_menu_top()!=''&& cryptcio_get_footer_menu_top()!='default' && cryptcio_get_footer_menu_top()!='1'){
							wp_nav_menu(array(
								'menu' => cryptcio_get_footer_menu_top(),
								'menu_class' => 'mega-menu',
								'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
								'walker' => new Cryptcio_Primary_Walker_Nav_Menu()
									)
							);                    
						}
					?> 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
				<div class="up-top text-right">
					<a href="javascript:void(0);"><?php echo esc_html__('Up to top','cryptcio'); ?> <i class="fa fa-long-arrow-up"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer-top">
	<div class="container">
		<div class="footer-container row"> 					
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
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
			<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
				<div class="footer-left-info">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php 
							if(isset($cryptcio_settings['logo_footer_2']['url']) && $cryptcio_settings['logo_footer_2']['url']!=''){
								$logo_footer = (cryptcio_get_meta_value('logo_footer_page') != '') ? cryptcio_get_meta_value('logo_footer_page') : $cryptcio_settings['logo_footer_2']['url'];
							}
							?>                
							<?php
							if (isset($logo_footer) && $logo_footer != ''):
								echo '<img class="footer-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_footer)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
							else:
								// bloginfo('name');
							endif;
						?>
					</a>
				</div>
			</div>	
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<?php dynamic_sidebar('footer-newsletter'); ?>
			</div>
		</div>
	</div>
</div>
<?php if ($cryptcio_settings['show-footer-bottom']) : ?>
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