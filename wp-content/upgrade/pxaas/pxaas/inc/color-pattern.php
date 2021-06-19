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
 * PXaas: Color Patterns
 */
/**
 * Generate the CSS for the current custom color scheme.
 */
class CTHColorChanger
{
    private $_r = 0, $_g = 0, $_b = 0, $_h = 0, $_s = 0, $_l = 0;

    public function lighten ($color, $lightness)
    {
        $this->setColor($color);
        $l = $this->_l;
        $l += $lightness;
        $this->_l = (100 < $l)?100:$l;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function darken ($color, $darkness)
    {
        $this->setColor($color);
        $l = $this->_l;
        $l -= $darkness;
        $this->_l = (0 > $l)?0:$l;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function saturate ($color, $per)
    {
        $this->setColor($color);
        $s = $this->_s;
        $s += $per;
        $this->_s = (100 < $s)?100:$s;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function desaturate ($color, $per)
    {
        $this->setColor($color);
        $s = $this->_s;
        $s -= $per;
        $this->_s = (0 > $s)?0:$s;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function _decHex ($dec)
    {
        return sprintf('%02s', dechex($dec));
    }

    public function adjust_hue($color, $per)
    {
        $this->setColor($color);
        $h = $this->_h;
        $h += $per;
        $this->_h = (360 < $h)?360:$h;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    private function setColor ($color)
    {
        $color = trim($color, '# ');
        $this->_r = hexdec(substr($color, 0, 2));
        $this->_g = hexdec(substr($color, 2, 2));
        $this->_b = hexdec(substr($color, 4, 2));
        $this->_maxRgb = max($this->_r, $this->_g, $this->_b);
        $this->_minRgb = min($this->_r, $this->_g, $this->_b);
        $this->_getHue();
        $this->_getSaturation();
        $this->_getLuminance();
    }

    private function _getHue ()
    {
        $r = $this->_r;
        $g = $this->_g;
        $b = $this->_b;
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        if ($r === $g && $r === $b) {
            $h = 0;
        } else {
            $mm = $max - $min;
            switch ($max) {
            case $r :
                $h = 60 * ($mm?($g - $b) / $mm:0);
                break;
            case $g :
                $h = 60 * ($mm?($b - $r) / $mm:0) + 120;
                break;
            case $b :
                $h = 60 * ($mm?($r - $g) / $mm:0) + 240;
                break;
            }
            if (0 > $h) {
                $h += 360;
            }
        }
        $this->_h = $h;
    }

    private function _getSaturation ()
    {
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        $cnt = round(($max + $min) / 2);
        if (127 >= $cnt) {
            $tmp = ($max + $min);
            $s = $tmp?($max - $min) / $tmp:0;
        } else {
            $tmp = (510 - $max - $min);
            $s = ($tmp)?(($max - $min) / $tmp):0;
        }
        $this->_s = $s * 100;
    }

    private function _getLuminance ()
    {
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        $this->_l = ($max + $min) / 2 / 255 * 100;
    }

    private function _getMaxMinHsl ()
    {
        $s = $this->_s;
        $l = $this->_l;
        if (49 >= $l) {
            $max = 2.55 * ($l + $l * ($s / 100));
            $min = 2.55 * ($l - $l * ($s / 100));
        } else {
            $max = 2.55 * ($l + (100 - $l) * ($s / 100));
            $min = 2.55 * ($l - (100 - $l) * ($s / 100));
        }
        $this->_maxHsl = $max;
        $this->_minHsl = $min;
    }

    private function _getRGB ()
    {
        $this->_getMaxMinHsl();
        $h = $this->_h;
        $s = $this->_s;
        $l = $this->_l;
        $max = $this->_maxHsl;
        $min = $this->_minHsl;
        if (60 >= $h) {
            $r = $max;
            $g = ($h / 60) * ($max - $min) + $min;
            $b = $min;
        } else if (120 >= $h) {
            $r = ((120 - $h) / 60) * ($max - $min) + $min;
            $g = $max;
            $b = $min;
        } else if (180 >= $h) {
            $r = $min;
            $g = $max;
            $b = (($h - 120) / 60) * ($max - $min) + $min;
        } else if (240 >= $h) {
            $r = $min;
            $g = ((240 - $h) / 60) * ($max - $min) + $min;
            $b = $max;
        } else if (300 >= $h) {
            $r = (($h - 240) / 60) * ($max - $min) + $min;
            $g = $min;
            $b = $max;
        } else {
            $r = $max;
            $g = $min;
            $b = ((360 - $h) / 60) * ($max - $min) + $min;
        }
        $this->_r = round($r);
        $this->_g = round($g);
        $this->_b = round($b);
    }
}


if (!function_exists('pxaas_hex2rgb')) {
    function pxaas_hex2rgb($hex) {
        
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if (!function_exists('pxaas_colourBrightness')) {
    
    /*
     * $hex = '#ae64fe';
     * $percent = 0.5; // 50% brighter
     * $percent = -0.5; // 50% darker
    */
    function pxaas_colourBrightness($hex, $percent) {
        
        // Work out if hash given
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        
        /// HEX TO RGB
        $rgb = pxaas_hex2rgb($hex);
        
        //// CALCULATE
        for ($i = 0; $i < 3; $i++) {
            
            // See if brighter or darker
            if ($percent > 0) {
                
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } 
            else {
                
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
            }
            
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            
            // Add a leading zero if necessary
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            
            // Append to the hex string
            $hex.= $hexDigit;
        }
        return $hash . $hex;
    }
}
// https://www.ofcodeandcolor.com/cuttle/
/**
 * Change the brightness of the passed in color
 *
 * $diff should be negative to go darker, positive to go lighter and
 * is subtracted from the decimal (0-255) value of the color
 * 
 * @param string $hex color to be modified
 * @param string $diff amount to change the color
 * @return string hex color
 */
function pxaas_adjust_hue($hex, $diff) {
    $rgb = str_split(trim($hex, '# '), 2);
    foreach ($rgb as &$hex) {
        $dec = hexdec($hex);
        if ($diff >= 0) {
            $dec += $diff;
        }
        else {
            $dec -= abs($diff);         
        }
        $dec = max(0, min(255, $dec));
        $hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
    }
    return '#'.implode($rgb);
}
if (!function_exists('pxaas_bg_png')) {
    function pxaas_bg_png($color, $input, $output) {
        $image = imagecreatefrompng($input);
        $rgbs = pxaas_hex2rgb($color);
        $background = imagecolorallocate($image, $rgbs[0], $rgbs[1], $rgbs[2]);
        
        imagepng($image, $output);
    }
}

if (!function_exists('pxaas_stripWhitespace')) {
    
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function pxaas_stripWhitespace($content) {
        
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);
        
        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);
        
        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);
        
        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);
        
        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);
        
        return trim($content);
    }
}

if (!function_exists('pxaas_add_rgba_background_inline_style')) {
    function pxaas_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
        $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
        wp_add_inline_style($handle, $inline_style);
    }
}

if (!function_exists('pxaas_overridestyle')) {
    function pxaas_overridestyle() {

        $theme_color_opt = pxaas_get_option('theme-color');

        $colorChanger = new CTHColorChanger();

        $gradient_light = '#'.$colorChanger->saturate($colorChanger->darken($colorChanger->desaturate($colorChanger->adjust_hue($theme_color_opt,-7.9140), 1.1173), 0.5882), 3);

        $gradient_dark = '#'.$colorChanger->darken($colorChanger->desaturate($colorChanger->adjust_hue($theme_color_opt,2.0055), 0.9340), 3.1373);

        $main_bg_color = pxaas_get_option('main-bg-color'); 
        $body_text_color = pxaas_get_option('body-text-color');
        $paragraph_color = pxaas_get_option('paragraph-color');
        $link_color = pxaas_get_option('link_color');
        $link_hover_color = pxaas_get_option('link_hover_color');
        $link_active_color = pxaas_get_option('link_active_color');
        $header_bg_color = pxaas_get_option('header-bg-color');
        $header_text_color = pxaas_get_option('header-text-color');
        $submenu_bg_color = pxaas_get_option('submenu-bg-color');
        $mainmenu_color = pxaas_get_option('mainmenu_color');
        $mainmenu_hover_color = pxaas_get_option('mainmenu_hover_color');
        $mainmenu_active_color = pxaas_get_option('mainmenu_active_color');
        $submenu_hover_color = pxaas_get_option('submenu_hover_color');
        $submenu_active_color = pxaas_get_option('submenu_active_color');
        $footer_bg_color = pxaas_get_option('footer-bg-color');




        $body_font = pxaas_get_option('body-font');
        $heading_font = pxaas_get_option('heading-font');
        $paragraph_font = pxaas_get_option('paragraph-font');
        $theme_bolder_font = pxaas_get_option('theme-bolder-font');




    	$inline_style = '
.banner-content-inner-wrapper h2,
.sec-title-main,.caret_btn,
.menu-section-list-wrapper ul li a,
.woo-products .main-iso .pxaas-product-content .price,.sec-article-title,
.count-title,
.team-heading-wrapper h2,
.footer_widgets_bottom .widgets-titles,.lr_st_icon_wrapper,
.breadcrumb-current,
.event-metabox li .fa,
.content-event .sig-img,
.contect-form1 i, .contect-form2 i,
.more-link,.prev-container-event h5,.fw-post .post-opt li .fa,.widget-title,
.box-widget li span,.content-blog-detail .container .hassidebar .comment-number span,
.content-blog-detail .container .hassidebar #post-comments .comment .comment-text span.comment-reply a
,.price{
    color:'.$theme_color_opt.'!important;
}
.menu-section-list-wrapper li:after{
    border: 1px dashed '.$theme_color_opt.'!important ;
}
.banner-cont-list-icon-wrapper,.widget-conten-bt,.woo-products .iso-nav ul,.lr_nl_form_wrapper button{
    border: 2px solid'.$theme_color_opt.'!important;
}
.pformat-quote .list-single-main-item,.pformat-quote:hover .blog-date{
    background: #000;
}
.banner-content-inner-wrapper h3 span, .sec-title-main span, .caret_btn span,
.woo-products .iso-nav ul li.active,.iso-nav ul li:hover,.woo-products .main-iso .pxaas-add-to-cart a,.dots-right,.dots-left,.menu-item-sp .btn-background,.reser-map-right-wrapper,
.team-heading-wrapper h2 span,.testi-heading-wrapper h2 span,.title-item-chef .content,.widget-title span.wt-decor,.lr_nl_form_wrapper button,
.lr_slider_title_first_Wrapper,.home-three .logo-mian-wrapper,.lr_piz_slide_tag,
.head-sec-title span,.es-top-slider-wrapper:before,.es-top-slider-wrapper:after,
.es-timer-main-warpper .cs-countdown-item p,.about-organizer-sec,
.lr_ec_timer_wrapper .cs-countdown-item p,.menu-item-right .container-price,
.menu-item-left .container-price,.our-gallery-container .filter-gallery-item ul li a.active,
.fw-post .post-opt .blog-date,.pxaas-body.woocoomerce .pxaas-add-to-cart a, .pxaas-body .pxaas-add-to-cart a,.pxaas-body.woocoomerce .woocommerce-pagination .current, .pxaas-body .woocommerce-pagination .current,.single_add_to_cart_button,.wc-forward{
    background:'.$theme_color_opt.'!important;
}
.lr_inner_title_heading_wrapper h2 span,.lr-btn:hover,.lr_footer_first_heading h2 span,
.lr_footer_second_heading h2 span,.lr_footer_third_heading h2 span,
.lr_footer_first_heading_cont li a:hover,#return-to-top,
.lr_index_about_right_wrapper h2 span,.lr_about_service_heading_wrapper h2 .lr_dots_left,
.lr_about_service_heading_wrapper h2 .lr_dots_right,.lr_menu_section_heading_wrapper h2 span,
.lr_team_heading_wrapper h2 span,.lr_team_img_cont_wrapper,.lr_reser_heading_main_wrapper h2 .lr_dots_left,.lr_reser_heading_main_wrapper h2 .lr_dots_right,.lr_reser_map_right_wrapper,
.lr_about_offer_left_wrapper h2 span,.lr-btn-background,.con_right_border:before,.lr_blg_date_wrapper,.lr_in_bog_slider_cont_wrapper:hover,
.btc_third_pegi a span,.lr_blog_right_search_wrapper button:hover,.lr_element_section_heading_wrapper h2 span,.lr_bs_second_box_main_wrapper,.lr_gt_left_wrapper,.lr_gt_right_heading h2 span,
.lr_ec_timer_wrapper li p,.lr_ec_slider_heading h2 .lr_dots_left,.lr_ec_slider_heading h2 .lr_dots_right,.lr_es_top_slider_wrapper:before,.lr_es_top_slider_wrapper:after,
.lr_es_timer_main_wrapper li p,.lr_team_box_main_wrapper:hover .lr_es_team_img_cont_wrapper,
.lr_es_team_heading_wrapper li a:hover,.filter_slider,.lr_banner_content_inner_wrapper h3 span,
.banner-cont-list-icon-wrapper:hover .btc_step_overlay,.lr_element_img_back_box_wrapper:after,
.lr_element_img_back_box_wrapper:before,
.slider,.cth-woo-item-wrap:hover .lr_ele_img_box_overlay,.fresh_heading_wrapper h2 span,.lr_testi_heading_wrapper h2 span,.lr_testi_slider_img_cont li a:hover,.small_dot1,.small_dot2,.small_dot3,.lr_om_price_lebel_wrapper,
.lr_om_center_section_wrapper span,.lr_om_center_section_wrapper span:after,.tb-box1-wrapper:hover .tb-img-box-overlay,.lr_center_logo_wrapper,.lr_logo_mian_wrapper2,.carousel-nevigation > .prev,.carousel-nevigation > .next,
.lr_slider_title_first_Wrapper2,.lr_center_logo_wrapper:after,.lr_slider_btn,.lr_piz_slide_tag,
.lr_piz_slide_main_warpper:hover .lr_piz_slide_img_overlay{
    background:'.$theme_color_opt.' !important;
}
@media (max-width: 600px){
    .lr_element_tabs_main_wrapper .nav-tabs > li.active > a, .lr_element_tabs_main_wrapper .nav-tabs > li.active > a:hover{
        background:'.$theme_color_opt.'!important ;
    }
}
.lr_404_img_wrapper svg,.lr_logo_mian_wrapper svg{
    fill:'.$theme_color_opt.' ;
}
.lr_piz_slide_tag:after{
    border-left: 282px solid '.$theme_color_opt.'!important;
}
@media (max-width: 767px){
    .lr_piz_slide_tag:after{
        border-left: 190px solid '.$theme_color_opt.'!important;
    }
}
.lr_piz_slide_tag:before{
    border-right: 20px solid '.$theme_color_opt.'!important;
}
.lr_nl_form_wrapper button,.lr_bs_third_social_right_wrapper li a:hover,.lv_search_box button:hover,.main-menu .navbar-header .navbar-toggle{
    background:'.$theme_color_opt.';
    border:1px solid '.$theme_color_opt.';
}
.main-menu .navigation > li:hover > a, .main-menu .navigation > li.current > a, 
.header-upper.transparent .main-menu .navigation > li.current > a, 
.main-menu .navigation > li.current-menu-item > a,.main-menu .navigation > li > ul > li > a:hover,
.caret_btn a i:before,.lr_inner_title_right_Wrapper li,.lr_404_img_cont_wrapper p,
.lr_foot_icon_wrapper i,.lr_foot_icon_email_cont_wrapper p a:hover,.lr_nl_heading_wrapper h2,
.lr_bottom_footer_main_wrapper p a,.lr_inner_title_right_Wrapper li a:hover,.cc_cart_cont_wrapper h4 a:hover,.index_about_right_wrapper h2,.about_slider_main_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .about_slider_main_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_as_icon_wrapper i:before,
.lr_as_icon_cont_wrapper h2 a:hover,.lr_menu_section_list_wrapper li,.lr_team_slider_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_team_slider_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_about_offer_right_heading h2,.count-description span,.lr_prt_slider_wrapper .owl-theme .owl-nav .owl-next:hover i:before,
 .lr_prt_slider_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_bc_first_box_img_cont_wrapper li i,.lr_bc_first_box_img_cont_wrapper li a:hover,.lr_bc_slider_first_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_bc_slider_first_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_blog_right_search_wrapper button,.lr_bc_cate_sb_heading_main_wrapper h2,.lr_bc_cate_sb_heading_main_wrapper li a span,
 .lr_bc_cate_sb_heading_main_wrapper li a:hover,.lr_bc_tf_img_wrapper h2 a:hover,.lr_bc_tf_img_wrapper h2 span,.lr_br_bd_img_cont_wrapper h4 a:hover,.lr_br_bd_img_cont_wrapper p,.lr_bs_third_social_left_wrapper p i,
 .blog_comment1_cont a,.contect_form1 i, .contect_form2 i,.lr_ct_box_wrapper h2,.lr_ct_box_wrapper p a:hover,.lr_ec_timer_inner_cont_wrapper li i,.lr_ec_timer_img_cont_wrapper h3,.lr_ec_slider_img_cont_wrapper p a,.lr_ec_slider_img_cont_wrapper h3,.le_es_slider_bottom_left_content_wrapper li i,.le_es_sign_main_wrapper h3,.lr_banner_content_inner_wrapper h2,.lr_banner_content_list_wrapper:hover .lr_banner_cont_list_icon_cont_wrapper h3 a,.lr_ele_img_cont_box_wrapper p,.lr_ff_slider_first_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_ff_slider_first_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_ff_slider_second_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_ff_slider_second_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_testi_slider_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_testi_slider_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lr_testi_slider_img_cont h2 span,.lr_ev_img_cont_wrapper i,.lr_ev_main_section_wrapper:hover .lr_ev_img_cont_wrapper h2,.lr_index_bog_slider_wrapper .owl-theme .owl-nav .owl-next:hover i:before, .lr_index_bog_slider_wrapper .owl-theme .owl-nav .owl-prev:hover i:before,.lv_search_bar i:before,.lr_slider_text,.lr_piz_slide_img_cont_wrapper p{
    color:'.$theme_color_opt.' !important;
}
.main-menu .navigation > li > ul,.lv_search_box{
    border-top:2px solid '.$theme_color_opt.';
}
.lr-btn,.lr-btn-background,.lr_prt_slider_wrapper .owl-theme .owl-nav .owl-prev,.lr_prt_slider_wrapper .owl-theme .owl-nav .owl-next,.contect_form1 input:hover, .contect_form1 input:focus, .contect_form2 input:hover, .contect_form2 input:focus,.contect_form4 textarea:hover, .contect_form4 textarea:focus,.lr_ec_slider_wrapper .owl-theme .owl-nav .owl-next:hover, .lr_ec_slider_wrapper .owl-theme .owl-nav .owl-prev:hover,#filter,.lr_banner_cont_list_icon_wrapper,.lr_element_tabs_main_wrapper .nav-tabs{
    border:2px solid '.$theme_color_opt.';
}
.lr_menu_section_list_wrapper li:after {
    border: 1px dashed '.$theme_color_opt.';
}
.btc_third_pegi a span:before{
    border-top: 8px solid '.$theme_color_opt.';
}
.btc_third_pegi a span:after{
    border-bottom: 8px solid '.$theme_color_opt.';
}
.le_es_slider_bottom_right_content_wrapper li a:hover {
    color: '.$theme_color_opt.';
    border: 1px solid '.$theme_color_opt.';
}   
.lr_index_bog_slider_wrapper .owl-theme .owl-nav .owl-next{
    border:1px solid '.$theme_color_opt.'!important;
    border-left:0 !important;
}
.lr_index_bog_slider_wrapper .owl-theme .owl-nav .owl-prev{
    border:1px solid '.$theme_color_opt.' !important;
    border-right:0 !important;
}
.lr_st_icon_cont_wrapper p {
    color:'.$theme_color_opt.';
}
@media (min-width: 767px) and (max-width: 991px){
    .slider_title_first_Wrapper3{
        background:'.$theme_color_opt.';
    }
    .slider_title_first_Wrapper4{
        background:'.$theme_color_opt.';
    }
}
@keyframes pulse {
  0% {
    -moz-box-shadow: 0 0 0 0 rgba(227, 134, 18, 0.79);
    box-shadow: 0 0 0 0 rgba(227, 134, 18, 0.79);
  }
  70% {
      -moz-box-shadow: 0 0 0 25px rgba(204,169,44, 0);
      box-shadow: 0 0 0 25px rgba(204,169,44, 0);
  }
  100% {
      -moz-box-shadow: 0 0 0 0 rgba(204,169,44, 0);
      box-shadow: 0 0 0 0 rgba(204,169,44, 0);
  }
}
.slider-area .carousel-inner .carousel-indicators li.active {
    background: rgba(34, 190, 159, 0.42);
    border: 4px solid '.$theme_color_opt.';
}
.body{
     background:'.$main_bg_color.'!important;
}
.main-footer{
     background:'.$footer_bg_color.'!important;
}
.main-menu .navigation > li > a{
    color:'.$link_color.'!important;
}
#menu-main-menu a:hover, #menu-main-menu a:focus{
    color:'.$mainmenu_hover_color.'!important;
}
.main-menu .navigation > li > ul > li > a:hover{
    color:'.$submenu_hover_color.'!important;
}
.sec-desc p,.menu-item-sp .lr_ff_slider_cont_first_wrapper p,.lr_testi_slider_img_cont p,.lr_ev_img_cont_wrapper p,.lr_in_bog_slider_cont_wrapper p{
    color:'.$paragraph_color.'!important;
}
';   
        // Remove whitespace
        $inline_style = pxaas_stripWhitespace($inline_style);
        
        return $inline_style;
    }
}