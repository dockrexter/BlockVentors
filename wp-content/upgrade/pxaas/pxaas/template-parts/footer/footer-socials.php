<?php
/**
 * @package PXaas - Saas & Software Landing Page Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 23-09-2019
 * @since 1.0.6
 * @version 1.0.6
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * Displays footer widgets if assigned
 *
 */

?>
<div class="footer-social">
	<?php
	if ( has_nav_menu( 'social' ) ) : 
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class'     => 'social-links-menu',
			'container'       => '',
            'container_class' => '',
            'container_id'    => '',
			'depth'          => 1,
			'link_before'    => '<span>',
			'link_after'     => '</span>',
		) );
	endif;
	?>
</div>
