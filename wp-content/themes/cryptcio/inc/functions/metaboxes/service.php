<?php
function cryptcio_service_meta_data() {
    return array(  
        array(
            "name" => "service_show_image",
            'type' => 'select',
            'title' => esc_html__('Show/Hide Featured Image in detail page', 'cryptcio'),
            'options' => array(
                'show' => esc_html__('Show', 'cryptcio'),
                'hide' => esc_html__('Hide', 'cryptcio'),
            ),
            'default' => 'show'
        ),          
        "desc" => array(
            "name" => "desc",
            "title" => esc_html__("Short Description", 'cryptcio'),
            "desc" => esc_html__("Content", 'cryptcio'),
            "type" => "editor"
        ), 
    );
}
function cryptcio_view_service_meta_option() {
    $meta_box = cryptcio_service_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_save_service_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_save_service2_meta_option($post_id) {
    $meta_box_service = cryptcio_service_meta_data();
    $meta_box = array_merge($meta_box_service); 
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_save_service_page_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_show_service_page_meta_option() {
    $meta_box = cryptcio_default_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_add_service_metaboxes() {
    if (function_exists('add_meta_box')) {  
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'cryptcio'), 'cryptcio_show_service_page_meta_option', 'service', 'side', 'low');
        add_meta_box('show-meta-boxes', esc_html__('Service Options', 'cryptcio'), 'cryptcio_view_service_meta_option', 'service', 'normal', 'low');
    }
}
add_action('add_meta_boxes', 'cryptcio_add_service_metaboxes');
add_action('save_post', 'cryptcio_save_service_meta_option');
add_action('save_post', 'cryptcio_save_service2_meta_option');
add_action('save_post', 'cryptcio_save_service_page_meta_option');

