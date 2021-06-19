<?php
add_action('widgets_init', 'cryptcio_register_sidebars');

function cryptcio_register_sidebars() {
    
    register_sidebar(array(
        'name' => esc_html__('General Sidebar', 'cryptcio'),
        'id' => 'general-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget general-sidebar %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-bg">',
        'after_title' => '</h3>',
    ));
	register_sidebar( array(
        'name' => esc_html__('Blog Sidebar', 'cryptcio'),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ) );
	register_sidebar( array(
        'name' => esc_html__('Blog Sidebar Home 6', 'cryptcio'),
        'id' => 'blog-sidebar-home-6',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title widget-title-border">',
        'after_title' => '</h3>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Widget 1', 'cryptcio'),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));

     register_sidebar(array(
        'name' => esc_html__('Footer 1 Widget 2', 'cryptcio'),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1 Widget 3', 'cryptcio'),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Widget 1', 'cryptcio'),
        'id' => 'footer2-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Widget 2', 'cryptcio'),
        'id' => 'footer2-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
      register_sidebar(array(
        'name' => esc_html__('Footer 2 Widget 3', 'cryptcio'),
        'id' => 'footer2-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
     register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 1', 'cryptcio'),
        'id' => 'footer3-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 2', 'cryptcio'),
        'id' => 'footer3-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 3', 'cryptcio'),
        'id' => 'footer3-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3 Widget 4', 'cryptcio'),
        'id' => 'footer3-column-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
      register_sidebar(array(
        'name' => esc_html__('Footer 7 Widget 1', 'cryptcio'),
        'id' => 'footer7-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 7 Widget 2', 'cryptcio'),
        'id' => 'footer7-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Newsletter', 'cryptcio'),
        'id' => 'footer-newsletter',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Contact', 'cryptcio'),
        'id' => 'footer-contact',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Menu', 'cryptcio'),
        'id' => 'footer-menu',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
      register_sidebar(array(
        'name' => esc_html__('Footer Form', 'cryptcio'),
        'id' => 'footer-form',   
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4 class="footer-title">',
        'after_title' => '</h4>',
    ));
    if (class_exists('Woocommerce')) {
		register_sidebar(array(
			'name' => esc_html__('Shop Sidebar', 'cryptcio'),
			'id' => 'shop-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title widget-title-border">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => esc_html__('Single Product Sidebar', 'cryptcio'),
			'id' => 'single-product-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title widget-title-border">',
			'after_title' => '</h3>',
		));
    }
}