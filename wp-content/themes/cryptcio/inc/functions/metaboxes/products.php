<?php
function cryptcio_product_meta_data(){
    return array(
        "unit_product" => array(
            "name" => "unit_product",
            "title" => esc_html__("Product Unit", 'cryptcio'),
            "desc" => esc_html__("Enter units for product.", 'cryptcio'),
            "type" => "textfield"
        ),
		// Custom Tab Title
        "custom_tab_title" => array(
            "name" => "custom_tab_title",
            "title" => esc_html__("Custom Tab Title", 'cryptcio'),
            "desc" => esc_html__("Input the custom tab title.", 'cryptcio'),
            "type" => "textfield"
        ),
        // Content Tab Content
        "custom_tab_content" => array(
            "name" => "custom_tab_content",
            "title" => esc_html__("Custom Tab Content", 'cryptcio'),
            "desc" => esc_html__("Input the custom tab content.", 'cryptcio'),
            "type" => "editor"
        )
    );
}

function cryptcio_show_product_tab_meta_option() {
    $meta_box = cryptcio_product_meta_data();
    cryptcio_show_meta_box($meta_box);
}

function cryptcio_save_product_tab_meta_option($post_id) {
    $meta_box = cryptcio_product_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}

function cryptcio_add_product_tab_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Custom Tab', 'cryptcio'), 'cryptcio_show_product_tab_meta_option', 'product', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'cryptcio_add_product_tab_metaboxes');
add_action('save_post', 'cryptcio_save_product_tab_meta_option');
function cryptcio_product_sidebar_option(){
    $cryptcio_layout = cryptcio_layouts();
    $cryptcio_sidebar_position = cryptcio_sidebar_position();
    $cryptcio_sidebars = cryptcio_sidebars();
    $cryptcio_header_layout = cryptcio_header_types();
    $cryptcio_preload_layout = cryptcio_preload_types();
    $cryptcio_header_positions = cryptcio_header_positions();
    $cryptcio_footer_layout = cryptcio_footer_types();
    $cryptcio_popup_layout = cryptcio_popup_layouts();
    $cryptcio_block_name = cryptcio_get_block_name();
    $cryptcio_block_name['default'] ='default';
    $cryptcio_slider = cryptcio_rev_sliders_in_array();
    $cryptcio_breadcrumbs_type = cryptcio_get_breadcrumbs_type();
    $cryptcio_breadcrumbs_type['default'] ='default';
    return array(
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
		'single_style'    => array(
            'name'  => 'single_style',
            'type' => 'select',
            'title' => esc_html__('Single Style', 'cryptcio'),
            'options' => array(
                "default" => esc_html__("Default","cryptcio"),
					"1" => esc_html__("Style 1","cryptcio"),
					"2" => esc_html__("Style 2","cryptcio"),
					"3" => esc_html__("Style 3","cryptcio"),
					"4" => esc_html__("Style 4","cryptcio"),
				),
            'default' => 'default'            
        ),
        'single_prd_pagination' => array(
            'name' => 'single_prd_pagination',
            'title' => esc_html__('Show product next and prev button', 'cryptcio'),
            'type' => 'checkbox'
        ),                 
		'related_col' => array(
            'name'  => 'related_col',
            'type' => 'select',
            'title' => esc_html__('Related product columns', 'cryptcio'),
            'options' => array(
                "default" => esc_html__("Default","cryptcio"),
                "2" => esc_html__("2","cryptcio"),
                "3" => esc_html__("3","cryptcio"),
                "4" => esc_html__("4","cryptcio"),
            ),
            'default' => 'default'            
        ),
    );
}
function cryptcio_show_product_default_meta_option() {
    $meta_box = cryptcio_product_sidebar_option();
    cryptcio_show_meta_box($meta_box);
}


function cryptcio_save_product_meta_option($post_id) {
    $meta_box = cryptcio_product_sidebar_option();
    return cryptcio_save_meta_data($post_id, $meta_box);
}

function cryptcio_add_product_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('show-meta-boxes', esc_html__('Product Options', 'cryptcio'), 'cryptcio_show_product_default_meta_option', 'product', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'cryptcio_add_product_metaboxes');
add_action('save_post', 'cryptcio_save_product_meta_option');
function cryptcio_add_categorymeta_product_table() {
// Create Product Cat Meta
global $wpdb;
$type = 'product_cat';
$table_name = $wpdb->prefix . $type . 'meta';
$variable_name = $type . 'meta';
$wpdb->$variable_name = $table_name;

// Create Product Cat Meta Table
    if(function_exists('cryptcio_create_metadata_table')){    
        cryptcio_create_metadata_table($table_name, $type);
    }
}
add_action( 'init', 'cryptcio_add_categorymeta_product_table' );
//Taxonomy
function cryptcio_default_product_tax_meta_data() {
    $cryptcio_sidebar_position = cryptcio_sidebar_position();
    $cryptcio_sidebars = cryptcio_sidebars();   
    $cryptcio_list_mode = cryptcio_product_type();
    $cryptcio_product_list_style = cryptcio_product_list_style();
    $cryptcio_product_list_style['default'] ='default'; 
	$cryptcio_pagination_types = cryptcio_pagination_types();
    $cryptcio_pagination_types['default'] ='Default'; 
    $cryptcio_header_layout = cryptcio_header_types();
    $cryptcio_footer_layout = cryptcio_footer_types(); 
    $cryptcio_block_name = cryptcio_get_block_name();
    $cryptcio_block_name['default'] ='default';    
    return array(
        // Breadcrumbs
        'breadcrumbs' => array(
            'name' => 'breadcrumbs',
            'title' => esc_html__('Breadcrumbs', 'cryptcio'),
            'desc' => esc_html__('Hide breadcrumbs', 'cryptcio'),
            'type' => 'checkbox'
        ),
        'page_title' => array(
            'name' => 'page_title',
            'title' => esc_html__('Page Title', 'cryptcio'),
            'desc' => esc_html__('Hide Page Title', 'cryptcio'),
            'type' => 'checkbox'
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
        'product-toolbar' => array(
            'name' => 'product-toolbar',
            'type' => 'checkbox',
            'title' => esc_html__('Hide Product Toolbar', 'cryptcio'),
        ),
        'list_mode_product' => array(
            'name' => 'list_mode_product',
            'type' => 'select',
            'title' => esc_html__('List mode', 'cryptcio'),
            'options' => $cryptcio_list_mode,
            'default' => 'only-grid'
        ),              
		'category_item' => array(
			'name' => 'category_item',
			'type' => 'text',
			'title' => esc_html__('Products Per Page', 'cryptcio'),
			'desc' => esc_html__('Comma separated list of product counts.', 'cryptcio'),
			'default' => ''
		),
        'category_cols' => array(
            'name' => 'category_cols',
            'type' => 'select',
            'title' => esc_html__('Number of grid column', 'cryptcio'),
            'options' =>  
                    array(
                    "3" => esc_html__("3 columns", 'cryptcio'),
                    "1" => esc_html__("1 columns", 'cryptcio'),
                    "2" => esc_html__("2 columns", 'cryptcio'),
                    "4" => esc_html__("4 columns", 'cryptcio'),
                    "5" => esc_html__("5 columns", 'cryptcio'),
                    "column-default" => esc_html__("Default", 'cryptcio'),
                    ),
            'default' => 'column-default'
        ),
		'product_pagination' => array(
            'name' => 'product_pagination',
            'type' => 'select',
            'title' => esc_html__('Product pagination', 'cryptcio'),
            'options' => $cryptcio_pagination_types,
            'default' => 'default',
        ), 
        'hide_static' => array(
            'name' => 'hide_static',
            'title' => esc_html__('Hide Banner', 'cryptcio'),
            'type' => 'checkbox'
        ),   
        'select-slider' => array(
            'name' => 'select-slider',
            'title' => esc_html__('Select Top Banner', 'cryptcio'),
            'desc' => esc_html__('Choose a block to display at the top of product category page. You can create a block in Static Block/Add New.', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_block_name,
            'default' => 'default'
        ),         
        'block_bottom' => array(
            'name' => 'block_bottom',
            'title' => esc_html__('Select Banner Bottom', 'cryptcio'),
            'desc' => esc_html__('Choose a block to display at the bottom of product category page. You can create a block in Static Block/Add New.', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_block_name,
            'default' => 'default'
        ),              
    );
}

add_action( 'product_cat_add_form_fields', 'cryptcio_add_product_cat', 10, 2);
function cryptcio_add_product_cat() {
    $product_cat_meta_boxes = cryptcio_default_product_tax_meta_data();

    cryptcio_show_tax_add_meta_boxes($product_cat_meta_boxes);
}

add_action( 'product_cat_edit_form_fields', 'cryptcio_edit_product_cat', 10, 2);
function cryptcio_edit_product_cat($tag, $taxonomy) {
    $product_cat_meta_boxes = cryptcio_default_product_tax_meta_data();

    cryptcio_show_tax_edit_meta_boxes($tag, $taxonomy, $product_cat_meta_boxes);
}

add_action( 'created_term', 'cryptcio_save_product_cat', 10,3 );
add_action( 'edit_term', 'cryptcio_save_product_cat', 10,3 );

function cryptcio_save_product_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $product_cat_meta_boxes = cryptcio_default_product_tax_meta_data();
    return cryptcio_save_taxdata( $term_id, $tt_id, $taxonomy, $product_cat_meta_boxes );
}
// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'cryptcio_woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'cryptcio_woo_add_custom_general_fields_save' );
function cryptcio_woo_add_custom_general_fields() {

  global $woocommerce, $post;
  echo '<div class="options_group">';    
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_cryptcio_prd_link', 
            'label'       => esc_html__( 'Product Link', 'cryptcio' ),
            'placeholder' => '', 
        )
    );    
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_cryptcio_woo_btn_text', 
            'label'       => esc_html__( 'Add to cart button text', 'cryptcio' ),
            'placeholder' => esc_html__('Buy Ticket','cryptcio'),
            'desc_tip'    => 'true',
        )
    );  
  echo '</div>';
    
}
function cryptcio_woo_add_custom_general_fields_save( $post_id ){
    // Text Field
    $woocommerce_text_field = $_POST['_cryptcio_woo_btn_text'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_cryptcio_woo_btn_text', esc_attr( $woocommerce_text_field ) );
        // Text Field
    $woocommerce_text_field = $_POST['_cryptcio_prd_link'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_cryptcio_prd_link', esc_attr( $woocommerce_text_field ) );
        
}