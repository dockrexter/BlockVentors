<?php
$cryptcio_settings = cryptcio_check_theme_options();
$cryptcio_myaccount_icon = isset($cryptcio_settings['header-myaccount-icon']) ? $cryptcio_settings['header-myaccount-icon'] :'';
$cryptcio_header_class = '';

$cryptcio_header_layout = isset($cryptcio_settings['header_layout_style_2']) ? $cryptcio_settings['header_layout_style_2'] :'';
$cryptcio_header_layout_class = '';
if($cryptcio_header_layout == '1'){
	$cryptcio_header_layout_class = 'container-fluid';
}
else if($cryptcio_header_layout == '3'){
	$cryptcio_header_layout_class = 'container-fluid header-boxed';
}else{
	$cryptcio_header_layout_class = 'container';
}

$string = $cryptcio_settings['header-callto'];
$call_to = str_replace(' ','',$string);  
?>

<div class="header-wrapper <?php echo esc_attr($cryptcio_header_class);?>">
	<?php if(isset($cryptcio_settings['header5-topinfo']) && $cryptcio_settings['header5-topinfo']) :?>
		<div class="header-top-link display-flex">
			<div class="<?php echo esc_attr($cryptcio_header_layout_class); ?>">
				<div class="row">
					<div class="col-md-8 col-sm-6 hidden-xs">
						<?php if(isset($cryptcio_settings['header-notice']) && $cryptcio_settings['header-notice']) :?>
							<div class="header-notice">
								<?php echo wp_kses($cryptcio_settings['header-notice'],array(
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
									); 
								?>
							</div>
						<?php endif;?>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 text-right">
						<?php if (isset($cryptcio_settings['header-myaccount-show']) && $cryptcio_settings['header-myaccount-show']) :?>
							<div class="header-myaccount display-inline-b">
								<div class="header-profile">
									<?php 
										if ( class_exists( 'WooCommerce' )) {
											$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
										}else{
											$myaccount_page_id = wp_login_url();
										}
										$logout_url = wp_logout_url(get_permalink($myaccount_page_id));
										if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
											$logout_url = str_replace('http:', 'https:', $logout_url);
										}
									?>
									<div class="top-link display-inline">
										<ul class="top-link-content"> 
											<?php if (!is_user_logged_in()): ?>
												<li class="customlinks"><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('Login&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;Register', 'cryptcio') ?> <i class="<?php echo esc_attr($cryptcio_myaccount_icon); ?>"></i></a></li>
											<?php else: ?>
												<li class="customlinks"><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('My Account&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;', 'cryptcio') ?></a></li>
												<li class="customlinks"><a href="<?php echo esc_url($logout_url) ?>"><?php echo esc_html__('Logout', 'cryptcio') ?> <i class="fa fa-power-off"></i></a></li>
											<?php endif; ?>                          	
										</ul>
									</div>
								</div>
							</div>	 
						<?php endif; ?> 
						<?php	 
							if (isset($cryptcio_settings['header5-minicart']) && $cryptcio_settings['header5-minicart'] && class_exists('WooCommerce')) :
							$cryptcio_minicart_template = cryptcio_get_minicart_template();?>
							<div id="mini-scart" class="mini-cart display-inline-b"> <?php echo wp_kses($cryptcio_minicart_template, cryptcio_allow_html()); ?> </div>
						<?php endif; ?> 
						<?php cryptcio_show_language_dropdown();?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?> 
	<div class="header-middle">
		<div class="<?php echo esc_attr($cryptcio_header_layout_class); ?>">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<?php if (is_front_page()) : ?>
						<h1 class="header-logo display-flex">
						<?php else : ?>
							<h2 class="header-logo display-flex">
							<?php endif; ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php 
								if(isset($cryptcio_settings['logo']) && $cryptcio_settings['logo']!=''){
									$logo_header = (cryptcio_get_meta_value('logo_header_page') != '') ? cryptcio_get_meta_value('logo_header_page') : $cryptcio_settings['logo']['url'];
								}
								if(isset($cryptcio_settings['logo-fixed']) && $cryptcio_settings['logo-fixed']!=''){
									$logo_header_sticky = (cryptcio_get_meta_value('logo_header_fixed_page') != '') ? cryptcio_get_meta_value('logo_header_fixed_page') : $cryptcio_settings['logo-fixed']['url'];
								}
								?>

								<?php
								if ($logo_header && $logo_header!=''):
									echo '<img class="logo-default"  src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_header)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
								else:
									//bloginfo('name');
								endif;
								
								if (isset($logo_header_sticky) && $logo_header_sticky!=''):
									echo '<img class="logo-fixed"  src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_header_sticky)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
								else:
									//bloginfo('name');
								endif;
								?>
							</a>
							<?php if (is_front_page()) : ?>
						</h1>
					<?php else : ?>
						</h2>
					<?php endif; ?>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
					<div class="header-container text-right">
						<div class="open-menu-mobile hidden-lg hidden-md">
							<div class="display-flex">
								<i class="fa fa-bars"></i>
							</div>
						</div>
						<div class="header-center">
							<h2 class="logo-mobile hidden-lg hidden-md">
								<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<?php 
									if(isset($cryptcio_settings['logo']) && $cryptcio_settings['logo']!=''){
										$logo_header = (cryptcio_get_meta_value('logo_header_page') != '') ? cryptcio_get_meta_value('logo_header_page') : $cryptcio_settings['logo']['url'];
									}
									?>

									<?php
									if ($logo_header && $logo_header!=''):
										echo '<img  src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_header)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
									else:
										bloginfo('name');
									endif;
									?>
								</a>
							</h2>
							<div class="close-menu-mobile hover-effect hidden-lg hidden-md">
								<i class="fa fa-close"></i>
								<i class="fa fa-close fa-hover"></i>
							</div>	
							<nav id="site-navigation" class="main-navigation">
								<?php
									$before_items_wrap = '';
									$after_item_wrap = '';
									$cryptcio_select_menu = get_post_meta(get_the_ID(), 'select_menu', true);
										if ($cryptcio_select_menu!= 'default' && has_nav_menu($cryptcio_select_menu)) {
											wp_nav_menu(array(
												'theme_location' => $cryptcio_select_menu,
												'menu_class' => 'mega-menu',
												'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
												'walker' => new Cryptcio_Primary_Walker_Nav_Menu()
													)
											);                    
										}else if(cryptcio_get_menu_id()!=''&& cryptcio_get_menu_id()!='default' && cryptcio_get_menu_id()!='1'){
						                    wp_nav_menu(array(
						                        'menu' => cryptcio_get_menu_id(),
						                        'menu_class' => 'mega-menu',
						                        'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
						                        'walker' => new Cryptcio_Primary_Walker_Nav_Menu()
						                            )
						                    );                    
			                			}else if (has_nav_menu('primary')) {
										wp_nav_menu(array(
											'theme_location' => 'primary',
											'menu_class' => 'mega-menu',
											'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
											'walker' => new Cryptcio_Primary_Walker_Nav_Menu()
												)
										);
									}
								?> 
								<?php if(isset($cryptcio_settings['header-social']) && $cryptcio_settings['header-social']):?>
									<div class="header-social social-mobile hidden-lg hidden-md">
										<h5><?php echo esc_html__('LET&rsquo;S GET SOCIAL','cryptcio');?></h5>
										<div class="social_icon hover-effect">
											<ul>
												<?php if(isset($cryptcio_settings['social-header-twitter']) && $cryptcio_settings['social-header-twitter'] !=''):?>
												 <li><a href="<?php echo esc_url($cryptcio_settings['social-header-twitter']);?>" ><i class="fa fa-twitter"></i><i class="fa fa-twitter fa-hover"></i></a></li>
												<?php endif;?>
												<?php if(isset($cryptcio_settings['social-header-instagram']) && $cryptcio_settings['social-header-instagram'] !=''):?>
												 <li><a href="<?php echo esc_url($cryptcio_settings['social-header-instagram']);?>" ><i class="fa fa-instagram"></i><i class="fa fa-instagram fa-hover"></i></a></li>
												<?php endif;?>
												<?php if(isset($cryptcio_settings['social-header-facebook']) && $cryptcio_settings['social-header-facebook'] !=''):?>
												 <li><a href="<?php echo esc_url($cryptcio_settings['social-header-facebook']);?>" ><i class="fa fa-facebook"></i><i class="fa fa-facebook fa-hover"></i></a></li>
												<?php endif;?>
												<?php if(isset($cryptcio_settings['social-header-google']) && $cryptcio_settings['social-header-google'] !=''):?>
												 <li><a href="<?php echo esc_url($cryptcio_settings['social-header-google']);?>" ><i class="fa fa-google-plus"></i><i class="fa fa-google-plus fa-hover"></i></a></li>
												<?php endif;?>
												<?php if(isset($cryptcio_settings['social-header-pinterest']) && $cryptcio_settings['social-header-pinterest'] !=''):?>
												 <li><a href="<?php echo esc_url($cryptcio_settings['social-header-pinterest']);?>" ><i class="fa fa-pinterest"></i><i class="fa fa-pinterest fa-hover"></i></a></li>
												<?php endif;?>
											</ul>
										</div>
									</div>
								<?php endif;?>	
								<?php if(isset($cryptcio_settings['header-contact']) && $cryptcio_settings['header-contact']):?>
									<?php if((isset($cryptcio_settings['header-callto']) && $cryptcio_settings['header-mailto']) || (isset($cryptcio_settings['header-callto']) && $cryptcio_settings['header-mailto'])):?>									
										<div class="header-contact contact-mobile hidden-lg hidden-md">
											<h5><?php echo esc_html__('Contact Us','cryptcio');?></h5>
											<ul>
												<li>
													<a href="callto:<?php echo esc_attr($call_to); ?>"><span class="lnr lnr-phone-handset"></span> <?php echo esc_html($cryptcio_settings['header-callto']); ?></a>
												</li>
												<li>
													<a href="mailto:<?php echo esc_attr($cryptcio_settings['header-mailto']); ?>"><span class="lnr lnr-envelope"></span> <?php echo esc_html($cryptcio_settings['header-mailto']); ?></a>
												</li>
											</ul>
										</div>
									<?php endif;?>	
								<?php endif;?>
							</nav> 
						</div>  
						<div class="header-right">
							<div class="header_icon display-inline-b">	          
								<?php 	                
									if (isset($cryptcio_settings['header5-search']) && $cryptcio_settings['header5-search']) {
										$cryptcio_search_template = cryptcio_get_search_form();
										echo '<div class="search-block-top display-flex">' .wp_kses($cryptcio_search_template, cryptcio_allow_html()) . '</div>';
									}  
								?>  
							</div>
							<?php cryptcio_show_language_dropdown();?>
						</div>    
					</div> 
				</div> 
			</div>
		</div>
	</div>
</div>
<!-- Menu -->
