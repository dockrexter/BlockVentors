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



?>
<form role="search" method="get" action="<?php echo esc_url(home_url( '/' ) ); ?>" class="fl-wrap wp-search-form">
    <input name="s" type="text" class="search" placeholder="<?php echo esc_attr_x( 'Search...', 'search input placeholder','pxaas' ) ?>" value="<?php echo get_search_query() ?>" />
    <button class="search-submit" type="submit"><i class="fa fa-search"></i><?php esc_html_e( 'Search', 'pxaas' ) ?></button>
</form>
