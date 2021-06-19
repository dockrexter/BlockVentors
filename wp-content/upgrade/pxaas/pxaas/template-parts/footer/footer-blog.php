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
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
        do_action( 'pxaas_footer_before');
?>
        </main>
        <!-- end main -->
        <?php $imagebk = pxaas_get_option('footer_logo'); ?>
        <footer class="pxaas-footer main-footer footer-blog">
            <?php 
            $footer_widgets = pxaas_get_option('footer_widgets',array());
            $has_active_fw = false;
            if ($footer_widgets ) {
            ?>
            <div class="footer-widgets">
                <div class="container">
                    <div class="back-to-top">
                        <a href="#" id="return-to-top"><i class="fa fa-long-arrow-up"></i></a>
                    </div>
                    <div class="row fwids-row"><?php
                        foreach ($footer_widgets as $widget) {
                            if($widget['title']&&$widget['classes']){

                                if(is_active_sidebar($widget['widid'])){
                                
                                    echo '<div class="dynamic-footer-widget '.esc_attr($widget['classes'] ).'">';

                                        dynamic_sidebar($widget['widid']);

                                    echo '</div>';

                                    $has_active_fw = true;
                                }
                            }
                        }
                    ?></div>
                </div>
            </div>
            <?php
            }
            ?>
            <?php 
            $footer_widgets_bot = pxaas_get_option('footer_widgets_bottom',array());
            if ($footer_widgets_bot) {
            ?>
            <div class="container footer_widgets_bottom">
                <div class="row">
                    <?php
                        foreach ($footer_widgets as $widget) {
                            if($widget['title']&&$widget['classes']){
                                if(is_active_sidebar($widget['widid'])){
                                
                                    echo '<div class="dynamic-footer-widget '.esc_attr($widget['classes'] ).'">';

                                        dynamic_sidebar($widget['widid']);

                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="footer-copyright container">
                <?php 
                get_template_part( 'template-parts/footer/site', 'info' );
                ?>
            </div>
        </footer>		
        <?php wp_footer(); ?>
    </body>
</html>
