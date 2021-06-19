<?php

function cryptcio_default_meta_data() {
    $cryptcio_layout = cryptcio_layouts();
    $cryptcio_sidebar_position = cryptcio_sidebar_position();
    $cryptcio_sidebars = cryptcio_sidebars();
    $cryptcio_header_layout = cryptcio_header_types();
    $cryptcio_preload_layout = cryptcio_preload_types();
    $cryptcio_header_positions = cryptcio_header_positions();
    $cryptcio_footer_layout = cryptcio_footer_types();
    $cryptcio_popup_layout = cryptcio_popup_layouts();
    $cryptcio_block_name = cryptcio_get_block_name();
    $cryptcio_block_name['default'] =esc_html__('default','cryptcio');
    $cryptcio_block_name['none'] =esc_html__('none','cryptcio');
    $cryptcio_slider = cryptcio_rev_sliders_in_array();
    $cryptcio_breadcrumbs_type = cryptcio_get_breadcrumbs_type();
    $cryptcio_breadcrumbs_type['default'] =esc_html__('default','cryptcio');
    return array(
        //Preload
		'preload' => array(
            'name' => 'preload',
            'title' => esc_html__('Preload Layout', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_preload_layout,
            'default' => 'default'
        ),
		// header
        'header' => array(
            'name' => 'header',
            'title' => esc_html__('Header Layout', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_header_layout,
            'default' => 'default'
        ),
		'header-position' => array(
            'name' => 'header-position',
            'title' => esc_html__('Header Mobile Position', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_header_positions,
            'default' => 'default'
        ),
        //footer
        'footer' => array(
            'name' => 'footer',
            'title' => esc_html__('Footer Layout', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_footer_layout,
            'default' => 'default'
        ),  
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'cryptcio'),
            'desc' => esc_html__('Hide breadcrumbs', 'cryptcio'),
            'type' => 'checkbox',
        ),
        "breadcrumbs_bg"=> array(
            "name" => "breadcrumbs_bg",
            "title" => esc_html__("Breadcrumbs Background", 'cryptcio'),
            'desc' => esc_html__("Upload breadcrumbs background", "cryptcio"),
            "type" => "upload"
        ),   
        "breadcrumbs_color"=> array(
            "name" => "breadcrumbs_color",
            "title" => esc_html__("Breadcrumbs Color", 'cryptcio'),
            "type" => "color"
        ),  
        "breadcrumbs_padding"=> array(
            "name" => "breadcrumbs_padding",
            "title" => esc_html__("Breadcrumbs top and bottom padding", 'cryptcio'),
            "type" => "number",
            'desc' => esc_html__('Enter a number here. (px)','cryptcio'),
        ),                                    
        'breadcrumbs_style' =>   array(
            'name'=>'breadcrumbs_style',
            'type' => 'select',
            'title' => esc_html__('Select Breadcrumbs Type', 'cryptcio'),
            'options' => $cryptcio_breadcrumbs_type,
            'default' => 'default'
        ),            
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'cryptcio'),
            'desc' => esc_html__('Hide Page Title', 'cryptcio'),
            'type' => 'checkbox'
        ),
        "breadcrumbs_font"=> array(
            "name" => "breadcrumbs_font",
            "title" => esc_html__("Page title font family", 'cryptcio'),
            "type" => "text",
            'desc' => esc_html__('Enter font family name here. You can find google font family in fonts.google.com.','cryptcio'),
        ), 
        "breadcrumbs_font_size"=> array(
            "name" => "breadcrumbs_font_size",
            "title" => esc_html__("Page title font size", 'cryptcio'),
            "type" => "number",
            'desc' => esc_html__('Enter font size here. (px)','cryptcio'),
        ),   
        "breadcrumbs_font_weight"=> array(
            "name" => "breadcrumbs_font_weight",
            "title" => esc_html__("Page title font weight", 'cryptcio'),
            "type" => "text",
            'desc' => esc_html__('Enter font weight here (normal, bold).','cryptcio'),
        ),      
        "breadcrumbs_letter_space"=> array(
            "name" => "breadcrumbs_letter_space",
            "title" => esc_html__("Page title letter spacing", 'cryptcio'),
            "type" => "number",
            'desc' => esc_html__('Enter a number for page title letter spacing (px)','cryptcio'),
        ),                  
        'show_header' => array(
            'name' => 'show_header',
            'title' => esc_html__('Header', 'cryptcio'),
            'desc' => esc_html__('Hide header', 'cryptcio'),
            'type' => 'checkbox'
        ),
        //  Show Footer
        'show_footer' => array(
            'name' => 'show_footer',
            'title' => esc_html__('Footer', 'cryptcio'),
            'desc' => esc_html__('Hide footer', 'cryptcio'),
            'type' => 'checkbox'
        ),
        //sidebar position
        'left-sidebar' => array(
            'name' => 'left-sidebar',
            'type' => 'select',
            'title' => esc_html__('Left Sidebar', 'cryptcio'),
            'options' => $cryptcio_sidebars,
            'default' => 'default'
        ),
        'right-sidebar' => array(
            'name' => 'right-sidebar',
            'type' => 'select',
            'title' => esc_html__('Right Sidebar', 'cryptcio'),
            'options' => $cryptcio_sidebars,
            'default' => 'default'
        ),
        // layout
        'layout' => array(
            'name' => 'layout',
            'title' => esc_html__('Layout', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_layout,
            'default' => 'default'
        ),
        'hide_f_info' => array(
            'name' => 'hide_f_info',
            'title' => esc_html__('Hide footer info', 'cryptcio'),
            'desc' => esc_html__('Hide footer info', 'cryptcio'),
            'type' => 'checkbox'
        ), 
        'remove_space_br' => array(
            'name' => 'remove_space_br',
            'title' => esc_html__('Remove top space', 'cryptcio'),
            'desc' => esc_html__('Remove top space', 'cryptcio'),
            'type' => 'checkbox'
        ),   
        'remove_space' => array(
            'name' => 'remove_space',
            'title' => esc_html__('Remove bottom space', 'cryptcio'),
            'desc' => esc_html__('Remove bottom space', 'cryptcio'),
            'type' => 'checkbox'
        ), 
        'show_slider' => array(
            'name' => 'show_slider',
            'title' => esc_html__('Show Revolution Slider', 'cryptcio'),
            'desc' => esc_html__('Enable Slider', 'cryptcio'),
            'type' => 'checkbox'
        ),  
        'category_slider' => array(
            'name' => 'category_slider',
            'title' => esc_html__('Select Revolution Slider', 'cryptcio'),
            'desc' => esc_html__('Slider will show if you show revolution slider', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_slider,
            'default' => 'default'
        ),      
    );
}

