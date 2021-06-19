<?php

if (!class_exists('ReduxFramework') && file_exists(CRYPTCIO_ADMIN . '/ReduxCore/framework.php')) {
    require_once( CRYPTCIO_ADMIN . '/ReduxCore/framework.php' );
}

require_once( CRYPTCIO_ADMIN . '/settings/settings.php' );
require_once( CRYPTCIO_ADMIN . '/settings/save_settings.php' );

function cryptcio_check_theme_options() {
    // check default options
    global $cryptcio_settings;
    if(!get_option('cryptcio_settings')) {
        ob_start();
        include(CRYPTCIO_PLUGINS . '/theme_options.php');
        $options = ob_get_clean();
        $cryptcio_default_settings = json_decode($options, true);
        if (is_array($cryptcio_default_settings) || is_object($cryptcio_default_settings))
        {
            foreach ($cryptcio_default_settings as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $key1 => $value1) {
                        if (!isset($cryptcio_settings[$key][$key1]) || !$cryptcio_settings[$key][$key1]) {
                            $cryptcio_settings[$key][$key1] = $cryptcio_default_settings[$key][$key1];
                        }
                    }
                } else {
                    if (!isset($cryptcio_settings[$key])) {
                        $cryptcio_settings[$key] = $cryptcio_default_settings[$key];
                    }
                }
            }
        }
    }

    return $cryptcio_settings;
}

if(!class_exists('ReduxFramework')) {
    cryptcio_check_theme_options();
}
//get theme layout options
function cryptcio_layouts() {
    return array(
        'default' => esc_html__('Default Layout', 'cryptcio'),
        'wide' => esc_html__('Wide', 'cryptcio'),
        'fullwidth' => esc_html__('Full width', 'cryptcio'),
        'boxed' => esc_html__('Boxed', 'cryptcio'),
    );
}
//get theme sidebar position options
function cryptcio_sidebar_position() {
    return array(
        'default' => esc_html__('Default Position', 'cryptcio'),
        'left-sidebar' => esc_html__('Left', 'cryptcio'),
        'right-sidebar' => esc_html__('Right', 'cryptcio'),
        'none' => esc_html__('None', 'cryptcio')
    );
}
function cryptcio_select_menu() {
    return array(
        'default' => esc_html__('Default Menu', 'cryptcio'),
        'primary' => esc_html__('Primary Menu', 'cryptcio'),
    );
}
function cryptcio_allow_html(){
    return array(
        'form'=>array(
            'role' => array(),
            'method'=> array(),
            'class'=> array(),
            'action'=>array(),
            'id'=>array(),
            ),
        'input' => array(
            'type' => array(),
            'name'=> array(),
            'class'=> array(),
            'title'=>array(),
            'id'=>array(), 
            'value'=> array(), 
            'placeholder'=>array(), 
            'autocomplete' => array(),
            'data-number' => array(),
            'data-keypress' => array(),                        
            ),
        'button' => array(
            'type' => array(),
            'name'=> array(),
            'class'=> array(),
            'title'=>array(),
            'id'=>array(),                            
            ),  
        'img'=> array(
            'src' => array(),
            'alt' => array(),
            'class'=> array(),
            ),                      
        'div'=>array(
            'class'=> array(),
            ),
        'h4'=>array(
            'class'=> array(),
            ),
        'a'=>array(
            'class'=> array(),
            'href'=>array(),
            'onclick' => array(),
            'aria-expanded' => array(),
            'aria-haspopup' => array(),
            'data-toggle' => array(),
            ),
        'i' => array(
            'class'=> array(),
        ),
        'p' => array(
            'class'=> array(),
        ), 
        'br' => array(),
        'span' => array(
            'class'=> array(),
            'onclick' => array(),
            'style' => array(),
        ), 
        'strong' => array(
            'class'=> array(),
        ),  
        'ul' => array(
            'class'=> array(),
        ),  
        'li' => array(
            'class'=> array(),
        ), 
        'del' => array(),
        'ins' => array(),
        'select'=> array(
            'class' => array(),
            'name' => array(),
        ),
        'option'=> array(
            'class' => array(),
            'value' => array(),
        ),        
    );
}
function cryptcio_rev_sliders_in_array(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[]     = $slider->getAlias();
            $arrT[]     = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}
//cryptcio popup
function cryptcio_popup_layouts() {
    return array(
        'default' => esc_html__('Default Popup', 'cryptcio'),
        '1' => esc_html__("Popup ", 'cryptcio'),
    );
}
function cryptcio_header_types() {
    return array(
        'default' => esc_html__('Default Header', 'cryptcio'),
        '1' => esc_html__('Header Type 1', 'cryptcio'),
        '2' => esc_html__('Header Type 2', 'cryptcio'),
        '3' => esc_html__('Header Type 3', 'cryptcio'),
        '4' => esc_html__('Header Type 4', 'cryptcio'),
        '5' => esc_html__('Header Type 5', 'cryptcio'),
        '6' => esc_html__('Header Type 6', 'cryptcio'),
        '7' => esc_html__('Header Type 7', 'cryptcio'),
    );
}
function cryptcio_seclect_slider(){
    $block_options = array();
    $args = array(
        'numberposts'       => -1,
        'post_type'         => 'block',
        'post_status'       => 'publish',
    );
    $posts = get_posts($args);
    foreach( $posts as $_post ){
        $block_options[$_post->ID] = $_post->post_title;

    }
    return $block_options;
}
function cryptcio_header_positions() {
    return array(
        'default' => esc_html__('Default Position', 'cryptcio'),
        '1' => esc_html__('Top', 'cryptcio'),
        '2' => esc_html__('Bottom', 'cryptcio'),
    );
}
function cryptcio_preload_types() {
    return array(
        'default' => esc_html__('Default Preload', 'cryptcio'),
        '1' => esc_html__('Preload Type 1', 'cryptcio'),
        '2' => esc_html__('Preload Type 2', 'cryptcio'),
        '3' => esc_html__('Preload Type 3', 'cryptcio'),
        '4' => esc_html__('Preload Type 4', 'cryptcio'),
        '5' => esc_html__('Preload Type 5', 'cryptcio'),
        '6' => esc_html__('Preload Type 6', 'cryptcio'),
        '7' => esc_html__('Preload Type 7', 'cryptcio'),
        '8' => esc_html__('Preload Type 8', 'cryptcio'),
        '9' => esc_html__('Preload Type 9', 'cryptcio'),
    );
}
function cryptcio_list_menu(){
    $menus = get_terms('nav_menu');
    $menu_list =array();
    foreach($menus as $menu){
      $menu_list[$menu->term_id] =  $menu->name . "";
    } 
    return $menu_list;
}
function cryptcio_footer_types() {
    return array(
        'default' => esc_html__('Default Footer', 'cryptcio'),
        '1' => esc_html__('Footer Type 1', 'cryptcio'),
        '2' => esc_html__('Footer Type 2', 'cryptcio'),
        '3' => esc_html__('Footer Type 3', 'cryptcio'),
        '4' => esc_html__('Footer Type 4', 'cryptcio'),
        '5' => esc_html__('Footer Type 5', 'cryptcio'),
        '6' => esc_html__('Footer Type 6', 'cryptcio'),
        '7' => esc_html__('Footer Type 7', 'cryptcio'),
    );
}
function cryptcio_page_blog_layouts(){
    return array(
        "grid" => esc_html__("Grid", 'cryptcio'),
        "list" => esc_html__("List", 'cryptcio'),
        "masonry" => esc_html__("Masonry", 'cryptcio'),
    );
}
function cryptcio_page_single_blog_layouts(){
    return array(
        "single-1" => esc_html__("Single 1", 'cryptcio'),
        "single-2" => esc_html__("Single 2", 'cryptcio'),
    );
}
function cryptcio_page_blog_columns(){
    return array(
        "3" => esc_html__("3 Columns", 'cryptcio'),
		"1" => esc_html__("1 Column", 'cryptcio'),
        "2" => esc_html__("2 Columns", 'cryptcio'),
        "4" => esc_html__("4 Columns", 'cryptcio'),
    );
}
function cryptcio_get_breadcrumbs_type(){
    return array(
        "type-1" => esc_html__("Type 1", 'cryptcio'),
        "type-2" => esc_html__("Type 2", 'cryptcio'),
        "type-3" => esc_html__("Type 3", 'cryptcio'),
    );
}
function cryptcio_get_align(){
    return array(
        "left" => esc_html__("Left", 'cryptcio'),
		"center" => esc_html__("Center", 'cryptcio'),
        "right" => esc_html__("Right", 'cryptcio'),
    );
}
function cryptcio_product_columns() {
    return array(
		"5" => esc_html__("5", 'cryptcio'),
		"4" => esc_html__("4", 'cryptcio'),
		"3" => esc_html__("3", 'cryptcio'),
		"2" => esc_html__("2", 'cryptcio'),
		"1" => esc_html__("1", 'cryptcio'),
    );
}
function cryptcio_product_list_style(){
    return array(
        "style1" => esc_html__("Style 1 (Default)", 'cryptcio'),
        "style2" => esc_html__("Style 2", 'cryptcio'),
    );    
}
function cryptcio_product_type() {
    return array(
        "only-grid" => esc_html__("Grid", 'cryptcio'),
        "only-list" => esc_html__("List", 'cryptcio'),
        "grid-default" => esc_html__("Grid (default) / List", 'cryptcio'),
        "list-default" => esc_html__("List (default) / Grid", 'cryptcio'),
    );
}
function cryptcio_blog_columns() {
    return array(
        "2" => esc_html__("2", 'cryptcio'),
        "3" => esc_html__("3", 'cryptcio'),
        "4" => esc_html__("4", 'cryptcio'),
    );
}
function cryptcio_gallery_columns() {
    return array(
        "3" => esc_html__("3", 'cryptcio'),
        "2" => esc_html__("2", 'cryptcio'),
        "4" => esc_html__("4", 'cryptcio'),
        "5" => esc_html__("5", 'cryptcio'),
    );
}
function cryptcio_page_gallery_layouts(){
    return array(
        "1" => esc_html__("Grid", 'cryptcio'),
        "2" => esc_html__("Masonry", 'cryptcio'),
    );
}
function cryptcio_teacher_columns() {
    return array(
        "4" => esc_html__("4", 'cryptcio'),
        "3" => esc_html__("3", 'cryptcio'),
        "2" => esc_html__("2", 'cryptcio'),
    );
}
function cryptcio_page_masonry_layouts(){
    return array(
        "masonry1" => esc_html__("Masonry 1", 'cryptcio'),
        "masonry2" => esc_html__("Masonry 2", 'cryptcio'),
        "masonry3" => esc_html__("Masonry 3", 'cryptcio'),
        "masonry4" => esc_html__("Masonry 4", 'cryptcio'),
    );
}
function cryptcio_gallery_style(){
    return array(
        "style1" => esc_html__("Style 1", 'cryptcio'),
        "style2" => esc_html__("Style 2", 'cryptcio'),
        "style3" => esc_html__("Style 3", 'cryptcio'),
        "style4" => esc_html__("Style 4", 'cryptcio'),
    );
}
function cryptcio_pagination_types(){
    return array(
        "pagination" => esc_html__("Pagination", 'cryptcio'),
        "loadmore" => esc_html__("Loadmore", 'cryptcio'),
    );
}
function cryptcio_get_block_name(){
    $block_options = array();
    $args = array(
        'numberposts'       => -1,
        'post_type'         => 'block',
        'post_status'       => 'publish',
    );
    $posts = get_posts($args);
    foreach( $posts as $_post ){
        $block_options[$_post->ID] = $_post->post_title;

    }
    return $block_options;
}
