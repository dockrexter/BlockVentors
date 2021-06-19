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


//http://proteusthemes.github.io/one-click-demo-import/
//https://wordpress.org/plugins/one-click-demo-import/

function pxaas_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__('PXaas theme - Full Demo Content (widgets included)','pxaas' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo_data_files/all-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo_data_files/widgets.wie',
            'import_notice'                => esc_html__( 'PXaas theme - Full Demo Content (widgets included). After you import this demo, you will have to setup the front-page from Settings -> Reading screen and menu from Appearance -> Menus screen.', 'pxaas' ),
        	'import_preview_image_url'     => 'http://pxaas.cththemes.com/wp-content/uploads/2019/05/pxaas-demo.png',
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'pxaas_import_files' );