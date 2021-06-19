<?php
function cryptcio_events_meta_data() {
    return array(
		"date_event" => array(
            "name" => "date_event",
            "title" => esc_html__("Date Event", 'cryptcio'),
            "type" => "textarea"
        ), 
		"loaction_event" => array(
            "name" => "loaction_event",
            "title" => esc_html__("Loaction Event", 'cryptcio'),
            "type" => "textfield"
        ), 
		"time_event" => array(
            "name" => "time_event",
            "title" => esc_html__("Time Event", 'cryptcio'),
            "type" => "textfield"
        ), 
		"map_event" => array(
            "name" => "map_event",
            "title" => esc_html__("Map iframe Code", 'cryptcio'),
            "desc" => esc_html__('Enter iframe code', 'cryptcio'),
            "type" => "textarea"
        ), 
    );
}
function cryptcio_view_events_meta_option() {
    $meta_box = cryptcio_events_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_save_events_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_save_events2_meta_option($post_id) {
    $meta_box_events = cryptcio_events_meta_data();
    $meta_box = array_merge($meta_box_events); 
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_save_events_page_meta_option($post_id) {
    $meta_box = cryptcio_default_meta_data();
    return cryptcio_save_meta_data($post_id, $meta_box);
}
function cryptcio_show_events_page_meta_option() {
    $meta_box = cryptcio_default_meta_data();
    cryptcio_show_meta_box($meta_box);
}
function cryptcio_add_events_metaboxes() {
    if (function_exists('add_meta_box')) {  
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', 'cryptcio'), 'cryptcio_show_events_page_meta_option', 'events', 'side', 'low');
        add_meta_box('show-meta-boxes', esc_html__('Events Options', 'cryptcio'), 'cryptcio_view_events_meta_option', 'events', 'normal', 'low');
    }
}
add_action('add_meta_boxes', 'cryptcio_add_events_metaboxes');
add_action('save_post', 'cryptcio_save_events_meta_option');
add_action('save_post', 'cryptcio_save_events2_meta_option');
add_action('save_post', 'cryptcio_save_events_page_meta_option');

