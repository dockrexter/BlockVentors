<?php
$cryptcio_settings = cryptcio_check_theme_options();
?>
<div id="contact" class="footer-contact">
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
</div>
<div class="footer-top">
	<div class="container">
		 <div class="row">
		 	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="footer-container row"> 					
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="footer-left-info">
							<?php 
							if(isset($cryptcio_settings['logo_footer']['url']) && $cryptcio_settings['logo_footer']['url']!=''){
								$logo_footer = (cryptcio_get_meta_value('logo_footer_page') != '') ? cryptcio_get_meta_value('logo_footer_page') : $cryptcio_settings['logo_footer']['url'];
							}
							?>                
							<?php
							if (isset($logo_footer) && $logo_footer != ''):
								echo '<img class="footer-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_footer)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
							else:
								// bloginfo('name');
							endif;
							?>
	                        <?php if (isset($cryptcio_settings['footer-info']) && $cryptcio_settings['footer-info']) : ?>
								<div class="footer_info">
									<p><?php echo wp_kses($cryptcio_settings['footer-info'],array('i'=>array('class' =>array()),
										'a'=>array(
											'href'=>array(), 
											'target' =>array()
											))
										); ?></p>	
								</div>
							<?php endif;?>
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
					<?php

				        $cols = 0;
				        for ($i = 1; $i <= 4; $i++) {
				            if (is_active_sidebar('footer2-column-' . $i))
				                $cols++;
				        }
			        ?>
			        <?php if (isset($cryptcio_settings['logo_footer']) && $cryptcio_settings['logo_footer'] && $cryptcio_settings['logo_footer']['url']):?>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php else:?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php endif;?>
						<?php
				        if ($cols) :
				            $col_class = array();
				            switch ($cols) {
				                case 1:
				                    $col_class[1] = 'col-sm-12';
				                    break;
				                case 2:
				                    $col_class[1] = 'col-sm-6 col-xs-6 col-md-6';
				                    $col_class[2] = 'col-sm-6 col-xs-6 col-md-6';
				                    break;
				                case 3:
				                    $col_class[1] = 'col-xs-12 col-sm-4 col-md-3';
				                    $col_class[2] = 'col-xs-12 col-sm-4 col-md-3';
				                    $col_class[3] = 'col-xs-12 col-sm-4 col-md-6';
				                    break;
				                case 4:
				                    $col_class[1] = 'col-xs-12 col-sm-6 col-md-3';
				                    $col_class[2] = 'col-xs-12 col-sm-6 col-md-3';
				                    $col_class[3] = 'col-xs-12 col-sm-6 col-md-3';
				                    $col_class[4] = 'col-xs-12 col-sm-6 col-md-3';
				                    break;
				            }
				            ?>
				        <div class="row">
							<div class="footer-menu-list">
								<?php
			                    $cols = 1;
			                    for ($i = 1; $i <= 4; $i++) {
			                        if (is_active_sidebar('footer2-column-' . $i)) {
			                            ?>
			                            <div class="<?php echo esc_attr($col_class[$cols++]) ?>">
			                                <?php dynamic_sidebar('footer2-column-' . $i); ?>
			                            </div>
			                            <?php
			                        }
			                    }
			                    ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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