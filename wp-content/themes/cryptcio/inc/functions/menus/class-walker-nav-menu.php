<?php
/**
 * Edit Nav Menu Walker: extends Walker_Nav_Menu class
 */
if ( ! class_exists( 'Cryptcio_Primary_Walker_Nav_Menu', false ) ) {
/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
	class Cryptcio_Primary_Walker_Nav_Menu extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Passed by reference. Used to append additional content.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			// Default class.
			$classes = array( 'sub-menu' );

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since 4.8.0
			 *
			 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul $class_names>{$n}";			
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string   $output Passed by reference. Used to append additional content.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$n}";			
		}

		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Passed by reference. Used to append additional content.
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item  Menu item data object.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/** Cryptcio mega menu custom field */
            if($depth == 0) {
                if(isset($item->cryptcio_mega_menu_enabled) && $item->cryptcio_mega_menu_enabled) {
					$classes[] = ' megamenu mega_column_'.$item->cryptcio_mega_menu_columns;
					if(isset($item->cryptcio_mega_menu_fullwidth) && $item->cryptcio_mega_menu_fullwidth){
						$classes[] = ' menu_fullw ';
					}
                }
            }		
			if(isset($item->cryptcio_mega_menu_block) && $item->cryptcio_mega_menu_block){
				$classes[] = ' menu_hide';
			}
			if(isset($item->cryptcio_menu_hide_title) && $item->cryptcio_menu_hide_title){
				$classes[] = ' menu_hide_title ';
			}           
			if(isset($item->cryptcio_menu_start_row)&& $item->cryptcio_menu_start_row){
				$classes[] = ' menu_start_new_row ';
			} 		
			if(isset($item->cryptcio_menu_modal_box)&& $item->cryptcio_menu_modal_box){
				$classes[] = ' menu_open_box ';
			}
			if(isset($item->cryptcio_mega_menu_bg_image_overlay)&& $item->cryptcio_mega_menu_bg_image_overlay){
				$classes[] = ' menu_bg_overlay ';
			}
			if(isset($item->cryptcio_mega_menu_iconfont_position) && $item->cryptcio_mega_menu_iconfont_position=='top'){
				$classes[] = ' menu_icon_top ';
			}
			/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			/** 
			* Add data style inline to menu item. 
			*
			* @param string   	$item->cryptcio_mega_menu_bg_image  			Background image url
			* @param string 	$item->cryptcio_mega_menu_bg_image_position	Background image position
			* @param string 	$item->cryptcio_mega_menu_bg_image_size		Background image size
			*/
			$cryptcio_menu_data = '';
			if(isset($item->cryptcio_mega_menu_bg_image)&& $item->cryptcio_mega_menu_bg_image!=''){
				$css_args = array(
					'target'		=>	'.menu-item-'. $item->ID.'> .sub-menu',
					// 'csstarget' 	=>  $tag,
					'stylesheet' 	=> array(
						'background-image' 	=> 'url("'.esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $item->cryptcio_mega_menu_bg_image)).'")',
						'background-position' 	=> isset($item->cryptcio_mega_menu_bg_image_position)&& $item->cryptcio_mega_menu_bg_image_position!=''?$item->cryptcio_mega_menu_bg_image_position:'right bottom',
						'background-repeat'=> 'no-repeat',
						'background-size' 	=> isset($item->cryptcio_mega_menu_bg_image_size)&& $item->cryptcio_mega_menu_bg_image_size!=''?$item->cryptcio_mega_menu_bg_image_size:'cover',
					),			
				);
				$cryptcio_menu_data = cryptcio_get_data_stylesheet($css_args); 				
			}

			$output .= $indent . '<li' . $id . $class_names . $cryptcio_menu_data .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			if(isset($item->cryptcio_menu_remove_link)&& $item->cryptcio_menu_remove_link){
				$atts['href'] ='#';
			}
			if(isset($item->cryptcio_menu_modal_static_block)&& $item->cryptcio_menu_modal_static_block!=''){
				$atts['href'] ='#'.esc_html(preg_replace('/\s+/', '', $item->cryptcio_menu_modal_static_block));
			}			
			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			/**
			 * Cryptcio mega menu custom field
			 * Add Icon before menu title.
			 *
			 * @param string   $icon_class Icon font class
			 * @param string   $item->tip_label Tip label
			 * @param string   $item->tip_color Tip color
			 * @param string   $item->tip_bg Tip background
			 * @param WP_Post  $item  The current menu item.
			 * @param String   $item->cryptcio_mega_menu_iconfont  
			 */
			$icon = $tip = '';
			if(isset($item->cryptcio_mega_menu_iconfont) && $item->cryptcio_mega_menu_iconfont!=''){
				$icon_style='';
				if(isset($item->cryptcio_mega_menu_iconfont_color) && $item->cryptcio_mega_menu_iconfont_color!=''){
					$icon_style = '  style="color:'.esc_html($item->cryptcio_mega_menu_iconfont_color).'" ';
				}
				$icon = wp_kses('<i class="'.esc_html($item->cryptcio_mega_menu_iconfont).'"'.$icon_style.'></i>',array(
						'i'=> array(
								'class'=> array(),
								'style'=> array(),
							),
					));
			}
			if(isset($item->tip_label) && $item->tip_label!=''){
                $item_style = '';
                if ($item->tip_color) {
                    $item_style .= 'color:'.$item->tip_color.';';
                }
                if ($item->tip_bg) {
                    $item_style .= 'background:'.$item->tip_bg.';';
                }              			
				$tip = wp_kses('<span class="tip" style="'.$item_style.'">'.$item->tip_label.'</span>',array(
						'span'=> array(
							'class'=> array(),
							'style'=> array(),
						),
					));
			}
			
			if(isset($item->cryptcio_menu_hide_title) && $item->cryptcio_menu_hide_title){
				$item->title = '';
			}			
			/** This filter is documented in wp-includes/post-template.php */
			$title = $icon.apply_filters( 'the_title', $item->title, $item->ID ).$tip;
			if(isset($args->walker->has_children) && $args->walker->has_children ){
				$title .= '<span class="open-submenu"><i class="fa fa-angle-down"></i></span>';
			}
			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
			$item_output ='';
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';
			if(isset($args->walker->has_children) && $args->walker->has_children){
				$item_output .='<span class="caret-submenu"><i class="fa fa-angle-down"></i></span>';
			}
			if(isset($item->cryptcio_mega_menu_block) && $item->cryptcio_mega_menu_block){
				$block_id='';
				if(isset($item->cryptcio_menu_modal_static_block)&& $item->cryptcio_menu_modal_static_block!=''){
					$block_id = ' id="'.esc_html(preg_replace('/\s+/', '', $item->cryptcio_menu_modal_static_block)).'"';
				}
				$item_output .= '<div class="menu-block"'.$block_id.'>'.do_shortcode('[arrowpress_static_block static="'.esc_html($item->cryptcio_mega_menu_block).'"]').'</div>';
			}				
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output Passed by reference. Used to append additional content.
		 * @param WP_Post  $item   Page data object. Not used.
		 * @param int      $depth  Depth of page. Not Used.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {}

	} // Walker_Nav_Menu
}