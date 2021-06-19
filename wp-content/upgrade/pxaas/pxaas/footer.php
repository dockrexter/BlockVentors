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
        $is_single = is_single();
        $class_not_is_home = ( $is_single) ? ' not-home' : '';
?>
        </main>
        <!-- end main -->
        <?php $imagebk = pxaas_get_option('footer_logo'); 
        $footer_style = pxaas_get_option_single('footer_style');
        
        ?>
        <footer class="pxaas-footer main-footer<?php echo esc_attr( $class_not_is_home ); ?>">
            <div class="back-to-top<?php echo esc_attr( $class_not_is_home ); ?>">
                <a href="#" id="return-to-top"><i class="fa fa-angle-up fs-20 color-fff bg-blue bg-orange-hvr radius-50"></i></a>
            </div>
            <?php if ($footer_style !== 'hidden') { ?>
                <?php 
                $footer_widgets = pxaas_get_option('footer_widgets',array());
                $has_active_fw = false;
                if ($footer_widgets ) {
                ?>
                <div class="footer-widgets">
                    <div class="container">
                        
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
            <?php } ?>
            <div class="footer-copyright bg-gray sm-padding text-center">
                <div class="container">
                    <?php 
                        get_template_part( 'template-parts/footer/site', 'info' );
                    ?>
                </div>
                
            </div>
        </footer>		
        <?php wp_footer(); ?>
    </body>
</html>
