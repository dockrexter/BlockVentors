<?php
//remove wpml language selector style
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
//remove wpml currency-switcher style
add_action('wp_print_styles', 'cryptcio_dequeue_css_currency_switcher', 100);

function cryptcio_dequeue_css_currency_switcher() {
    wp_dequeue_style('currency-switcher');
}

//show currency switcher dropdown list
function cryptcio_show_currencies_dropdown() {
    global $cryptcio_settings;
        ?>
            <div class="currency_custom"
                <div class="dib header-currencies dropdown-menu">
                    <div id="currencyHolder">
                        <?php echo(do_shortcode('[currency_switcher]')); ?>
                    </div>
                </div>
            </div>
        <?php
}
//show language switcher dropdown list
function cryptcio_show_language_dropdown() {
    global $cryptcio_settings, $sitepress;
        ?>
        <?php if ( isset($cryptcio_settings['wpml-switcher']) && $cryptcio_settings['wpml-switcher']) :?>
            <?php if ( function_exists('is_plugin_active') && is_plugin_active('sitepress-multilingual-cms/sitepress.php') && function_exists('icl_object_id') ): 
            if( !defined( 'ICL_LANGUAGE_CODE' ) && !isset( $sitepress )) {
                return false;
            }
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            $language_text = esc_html__('Languages', 'cryptcio');
            if(defined('ICL_LANGUAGE_CODE')) {
                $language_text = ICL_LANGUAGE_CODE;
            }
            ?>
                <div class="languges-flags display-inline">
                    <?php 
                    if(!empty($languages)){
                        foreach($languages as $l){
                            echo '<a class="lang-'.$l['active'].'" href="'.$l['url'].'" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown">';
                            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="16" /> <span>'.$l['language_code'].'</span>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            <?php elseif(function_exists('is_plugin_active') && is_plugin_active('polylang/polylang.php')):?>
                <?php if(function_exists('pll_the_languages') && function_exists('pll_current_language')): ?>
                <div class="languges-flags display-inline">
                    <ul><?php pll_the_languages(array('show_flags'=>0,'show_names'=>1));?></ul>
                </div>
                <?php endif;?>                
            <?php endif;?>
        <?php endif;?>
        <?php
}
//demo
function cryptcio_show_language_dropdown_demo(){
    global $cryptcio_settings, $sitepress;
    ?>
        <?php if(isset($cryptcio_settings['wpml-switcher']) && $cryptcio_settings['wpml-switcher']):?>
        <div class="languges-flags">
            <a class="current-open" href="#" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"><i class="fa fa-globe" aria-hidden="true"></i><?php echo esc_html__('en', 'cryptcio') ?></a>
            <div class="header-languages content-filter dropdown-menu">
                <div id="lang_sel_list" class="lang_sel_list_vertical">
                    <ul>
                        <li class="icl-en"><a href="#"><?php echo esc_html__('English', 'cryptcio') ?></a></li>
                        <li class="icl-en"><a href="#"><?php echo esc_html__('German', 'cryptcio') ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>  
        <?php endif;?>
    <?php
}