<?php
function cryptcio_post_meta_data() {
    $cryptcio_page_single_blog_layouts = cryptcio_page_single_blog_layouts();
    $cryptcio_page_single_blog_layouts['default'] ='Default';
    return array( 
        array(
            "name" => "single-post-layout-version",
            'type' => 'select',
            'title' => esc_html__('Single Blog Layout', 'cryptcio'),
            'options' => $cryptcio_page_single_blog_layouts,
            'default' => 'default'
        ),  
        "highlight" => array(
            "name" => "highlight",
            "title" => esc_html__("Short Description", 'cryptcio'),
            "desc" => esc_html__("Content", 'cryptcio'),
            "type" => "editor"
        ),
        'cat_bg' => array(
            'name' => 'cat_bg',
            'title' => esc_html__(' Category Background Color', 'cryptcio'),
            'desc' => esc_html__("You should input hex color(ex: #4aa9c2).", 'cryptcio'),
            'type' => 'color',
        ),         
    );
}
function cryptcio_post_format(){
    return array(
        "video_code" => array(
            "name" => "video_code",
            "title" => esc_html__("Video & Audio Embed Code", 'cryptcio'),
            "desc" => esc_html__('Enter the embed link (Youtube or Vimeo). ', 'cryptcio'),
            "type" => "textarea",
            'display_condition' => 'post-type-video', 
        ),
        "link_code" => array(
            "name" => "link_code",
            "title" => esc_html__("Link", 'cryptcio'),
            "desc" => esc_html__('Enter link. ', 'cryptcio'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "link_title" => array(
            "name" => "link_title",
            "title" => esc_html__("Link title", 'cryptcio'),
            "desc" => esc_html__('Enter link title. ', 'cryptcio'),
            "type" => "textfield",
            'display_condition' => 'post-type-link', 
        ),
        "quote_code" => array(
            "name" => "quote_code",
            "title" => esc_html__("Quote", 'cryptcio'),
            "desc" => esc_html__('Enter quote. ', 'cryptcio'),
            "type" => "textarea",
            'display_condition' => 'post-type-quote', 
        ),
        "quote_author" => array(
            "name" => "quote_author",
            "title" => esc_html__("Quote author", 'cryptcio'),
            "desc" => esc_html__('Enter quote author. ', 'cryptcio'),
            "type" => "textfield",
            'display_condition' => 'post-type-quote', 
        ),
        "quote_job" => array(
            "name" => "quote_job",
            "title" => esc_html__("Quote job", 'cryptcio'),
            "desc" => esc_html__('Enter quote job. ', 'cryptcio'),
            "type" => "textfield",
            'display_condition' => 'post-type-quote', 
        ),
    );
}
function cryptcio_view_post_meta_option() {
    $meta_box = cryptcio_post_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_view_post_format_meta_option() {
    $meta_box = cryptcio_post_format();
    cryptcio_show_meta_box($meta_box);
}

function cryptcio_show_post_meta_option() {
    $meta_box = cryptcio_default_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_save_post2_meta_option($post_id) {
    $meta_box_post = cryptcio_post_meta_data();
    $meta_box_format = cryptcio_post_format();
    $meta_box = array_merge($meta_box_post,$meta_box_format); 
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_save_post_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}

function cryptcio_add_post_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-format-boxes', esc_html__('Post Format', 'cryptcio'), 'cryptcio_view_post_format_meta_option', 'post', 'normal', 'low');
        add_meta_box('show-meta-boxes', esc_html__('Blog Options', 'cryptcio'), 'cryptcio_view_post_meta_option', 'post', 'normal', 'low');
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'cryptcio'), 'cryptcio_show_post_meta_option', 'post', 'normal', 'low');
    }
}

add_action('add_meta_boxes', 'cryptcio_add_post_metaboxes');
add_action('save_post', 'cryptcio_save_post_meta_option');
add_action('save_post', 'cryptcio_save_post2_meta_option');

function cryptcio_default_post_tax_meta_data() {
    $cryptcio_sidebar_position = cryptcio_sidebar_position();
    $cryptcio_sidebars = cryptcio_sidebars();
    $cryptcio_header_layout = cryptcio_header_types();
    $cryptcio_blog_layout = cryptcio_page_blog_layouts();
    $cryptcio_blog_columns = cryptcio_page_blog_columns();
    $cryptcio_blog_layout['default']= esc_html__('Default','cryptcio');
    return array(
        // Breadcrumbs
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
        'blog_layout' => array(
            'name' => 'blog_layout',
            'title' => esc_html__('Blog layout', 'cryptcio'),
            'desc' => esc_html__('Select blog layout', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_blog_layout,
            'default' => 'default'            
        ),
		'blog_columns' => array(
            'name' => 'blog_columns',
            'title' => esc_html__('Blog columns', 'cryptcio'),
            'desc' => esc_html__('Select blog columns', 'cryptcio'),
            'type' => 'select',
            'options' => $cryptcio_blog_columns,
            'default' => 'default'            
        ),
        /*'post_desc' => array(
            'name' => 'post_desc',
            'title' => esc_html__('Post Description', 'cryptcio'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','cryptcio'),
                '1' => esc_html__('Hide','cryptcio'),
                '2' => esc_html__('Display','cryptcio'),
             ),
            'default' => 'default'            
        ),  */   
        'post_per_page' => array(
            'name' => 'post_per_page',
            'type' => 'number',
            'title' => esc_html__('Post show per page', 'cryptcio'),
            'default' => 'default',
        ),  
        'post_pagination' => array(
            'name' => 'post_pagination',
            'title' => esc_html__('Pagination type', 'cryptcio'),
            'desc' => esc_html__('Select blog pagination', 'cryptcio'),
            'type' => 'select',
            'options' => array(
                'default' => esc_html__('Default','cryptcio'),
                '1' => esc_html__('Load more','cryptcio'),
                '2' => esc_html__('Next/Prev','cryptcio'),
                '3' => esc_html__('Number','cryptcio'),
             ),
            'default' => 'default'            
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
    );
}
//category taxonomy
function cryptcio_add_categorymeta_table() {
    // Create Product Cat Meta
    global $wpdb;
    $type = 'category';
    $table_name = $wpdb->prefix . $type . 'meta';
    $variable_name = $type . 'meta';
    $wpdb->$variable_name = $table_name;

    // Create Category Meta Table
    if(function_exists('cryptcio_create_metadata_table')){    
        cryptcio_create_metadata_table($table_name, $type);
    }
}
add_action( 'init', 'cryptcio_add_categorymeta_table' );

// category meta
add_action( 'category_add_form_fields', 'cryptcio_add_category', 10, 2);
function cryptcio_add_category() {
    $category_meta_boxes = cryptcio_default_post_tax_meta_data();
    cryptcio_show_tax_add_meta_boxes($category_meta_boxes);
}

add_action( 'category_edit_form_fields', 'cryptcio_edit_category', 10, 2);
function cryptcio_edit_category($tag, $taxonomy) {
    $category_meta_boxes = cryptcio_default_post_tax_meta_data();
    cryptcio_show_tax_edit_meta_boxes($tag, $taxonomy, $category_meta_boxes);
}

add_action( 'created_term', 'cryptcio_save_category', 10,3 );
add_action( 'edit_term', 'cryptcio_save_category', 10,3 );
function cryptcio_save_category($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    $category_meta_boxes = cryptcio_default_post_tax_meta_data();
    return cryptcio_save_taxdata( $term_id, $tt_id, $taxonomy, $category_meta_boxes );
}



 