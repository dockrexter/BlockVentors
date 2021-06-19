<?php
// push your child theme functions here
function apr_child_scripts() {
    wp_enqueue_style( 'apr-parent-style', get_template_directory_uri(). '/style.css' );
    wp_enqueue_style( 'apr-child-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'apr_child_scripts' );
