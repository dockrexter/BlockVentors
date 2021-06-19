<?php
function cryptcio_page_meta_data() {
	$cryptcio_menu_list = cryptcio_select_menu();
    $cryptcio_fonts =  array(
                        'default' => esc_html__( 'default', 'cryptcio' ),
                        'Cormorant Garamond'  => 'cormorant-garamond',                         
                    );   
    $cryptcio_menu_name_list = cryptcio_list_menu();
    $cryptcio_menu_name_list['default'] = esc_html__('Default', 'cryptcio');    
    return array(
		'title_option' => array(
			"name" => "title_option",
			"type" => "accordion",
			"title" => esc_html__("Title Option", 'cryptcio'),
			'desc' => esc_html__("Select different main color for page", "cryptcio"),
		),
        'main_color' => array(
			"name" => "main_color",
			"title" => esc_html__("Main Color", 'cryptcio'),
			"type" => "color",
			'desc' => esc_html__("Select different main color for page", "cryptcio"),
		),
        'main_color_2' => array(
            "name" => "main_color_2",
            "title" => esc_html__("Main Color Gradient", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different main color for page", "cryptcio"),
        ),
        'page_highlight_color' => array(
            "name" => "page_highlight_color",
            "title" => esc_html__("Highlight Color", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different highlight color for page", "cryptcio"),
        ),
		'body_bg' => array(
			'name' => 'body_bg',
			'title' => esc_html__('Body Background Color', 'cryptcio'),
			'desc' => esc_html__("You should input hex color(ex: #e1e1e1).", 'cryptcio'),
			'type' => 'color',
		), 
		'body_bg_image' => array(
			'name' => 'body_bg_image',
			'title' => esc_html__('Body Background Image', 'cryptcio'),
			'desc' => esc_html__("Upload background image only page", 'cryptcio'),
			"type" => "upload"
		), 
		'select_menu' => array(
            'name' => 'select_menu',
            'title' => esc_html__('Select Menu Location', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_menu_list,
            'desc' => esc_html__("Select menu by menu location. This option has higher priority than select menu by name. ", 'cryptcio'),            
            'default' => 'default'
        ),
        'select_menu_name' => array(
            'name' => 'select_menu_name',
            'title' => esc_html__('Select menu by menu name', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_menu_name_list,
            'default' => 'default'
        ),        
        'header_fixed' => array(
            'name' => 'header_fixed',
            'title' => esc_html__('Header Fixed', 'cryptcio'),
            'type' => 'checkbox'
        ),
		'header_topslide' => array(
            'name' => 'header_topslide',
            'title' => esc_html__('Show Top Slider Header', 'cryptcio'),
            'type' => 'checkbox'
        ),
		'header_hidden_top' => array(
            'name' => 'header_hidden_top',
            'title' => esc_html__('Hidden Top Header', 'cryptcio'),
            'type' => 'checkbox'
        ),
		'footer_fixed' => array(
            'name' => 'footer_fixed',
            'title' => esc_html__('Footer Fixed', 'cryptcio'),
            'type' => 'checkbox'
        ),
		'footer_hidden_contact' => array(
            'name' => 'footer_hidden_contact',
            'title' => esc_html__('Show Contact Form Footer 2', 'cryptcio'),
            'type' => 'checkbox'
        ),
        'hidden_footer_newsletter' => array(
            'name' => 'hidden_footer_newsletter',
            'title' => esc_html__('Hidden Footer Newsletter', 'cryptcio'),
            'type' => 'checkbox'
        ),
        "logo_header_page"=> array(
            "name" => "logo_header_page",
            "title" => esc_html__("Logo header for page", 'cryptcio'),
            'desc' => esc_html__("Upload logo header for this page", 'cryptcio'),
            "type" => "upload"
        ), 
		"logo_header_fixed_page"=> array(
            "name" => "logo_header_fixed_page",
            "title" => esc_html__("Logo header fixed for page", 'cryptcio'),
            'desc' => esc_html__("Upload logo header for this page", 'cryptcio'),
            "type" => "upload"
        ), 
        "logo_header_mobile"=> array(
            "name" => "logo_header_mobile",
            "title" => esc_html__("Logo header in mobile", 'cryptcio'),
            'desc' => esc_html__("Upload mobile header logo for this page", 'cryptcio'),
            "type" => "upload"
        ),                                         
        'header_layout_style' => array(
            'name' => 'header_layout_style',
            'title' => esc_html__('Select header layout for this page', 'cryptcio'),
            'type' => 'select',
            'options' => array(
                    "default" => esc_html__("Default","cryptcio"),
                    "1" => esc_html__("Wide","cryptcio"),
                    "2" => esc_html__("FullWidth","cryptcio"),
                    "3" => esc_html__("Boxed","cryptcio"),
                ),
            'default' => 'default',
        ), 
        'cus_font' => array(
            'name' => 'cus_font',
            'title' => esc_html__('Select font family for header menu', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_fonts,
            'default' => 'default',
            'group' => 'font',
        ), 
		'header_bg' => array(
            "name" => "header_bg",
            "title" => esc_html__("Header Background", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different header background for page", "cryptcio"),
        ),
        'header-top-bg' => array(
            "name" => "header-top-bg",
            "title" => esc_html__("Header Top Background", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different header background for header top", "cryptcio"),
        ),        
		'header_bg_hover' => array(
            "name" => "header_bg_hover",
            "title" => esc_html__("Header Background Hover", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different header background hover for page", "cryptcio"),
        ),
		'header_color' => array(
            "name" => "header_color",
            "title" => esc_html__("Header Color", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different header color for page", "cryptcio"),
        ),
		'header_border_color' => array(
            "name" => "header_border_color",
            "title" => esc_html__("Header Border Color", 'cryptcio'),
            "type" => "color",
            'desc' => esc_html__("Select different header border color for page", "cryptcio"),
        ),
		
        // Footer Options
        'footer_bg' => array(
            'name' => 'footer_bg',
            'title' => esc_html__('Footer Background', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #13264a).", 'cryptcio'),
            'type' => 'color',
        ),
        'footer_title_color' => array(
            'name' => 'footer_title_color',
            'title' => esc_html__('Footer title color', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #d5a853).", 'cryptcio'),
            'type' => 'color',
        ),
        'footer_text_color' => array(
            'name' => 'footer_text_color',
            'title' => esc_html__('Footer text color', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #ffffff).", 'cryptcio'),
            'type' => 'color',
        ),
        'footer_link_color' => array(
            'name' => 'footer_link_color',
            'title' => esc_html__('Footer link color', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #9a9a9a).", 'cryptcio'),
            'type' => 'color',
        ),
        'footer_backgroud_bottom_color' => array(
            'name' => 'footer_backgroud_bottom_color',
            'title' => esc_html__('Footer bottom background color', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #2d3e5e).", 'cryptcio'),
            'type' => 'color',
        ),
         'footer_border_color' => array(
            'name' => 'footer_border_color',
            'title' => esc_html__('Footer border color', 'cryptcio'),
            'desc' => esc_html__("You should input hex colfor(ex: #efefef).", 'cryptcio'),
            'type' => 'color',
        ),
         "bg_image_footer_page"=> array(
            "name" => "bg_image_footer_page",
            "title" => esc_html__("Background footer for page", 'cryptcio'),
            'desc' => esc_html__("Upload background footer only page", 'cryptcio'),
            "type" => "upload"
        ),
        "logo_footer_page"=> array(
            "name" => "logo_footer_page",
            "title" => esc_html__("Logo footer for page", 'cryptcio'),
            'desc' => esc_html__("Upload logo footer only page", 'cryptcio'),
            "type" => "upload"
        ),
    );
}
function cryptcio_view_page_meta_option() {
    $meta_box = cryptcio_page_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_save_page2_meta_option($post_id) {
    $meta_box = cryptcio_page_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_show_page_meta_option() {
    $meta_box = cryptcio_default_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_save_page_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}

function cryptcio_add_page_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'cryptcio'), 'cryptcio_show_page_meta_option', 'page', 'side', 'low');
        add_meta_box('view-skin-boxes', esc_html__('Skin Options', 'cryptcio'), 'cryptcio_view_page_meta_option', 'page', 'normal', 'low');
    }
}
add_action('add_meta_boxes', 'cryptcio_add_page_metaboxes');
add_action('save_post', 'cryptcio_save_page_meta_option');
add_action('save_post', 'cryptcio_save_page2_meta_option');
 