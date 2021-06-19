<?php
/**
 * Edit Nav Menu
 */
add_filter( 'wp_setup_nav_menu_item', 'cryptcio_setup_custom_nav_fields'  );

add_action( 'wp_update_nav_menu_item', 'cryptcio_update_custom_nav_fields' , 10, 2 );

add_filter( 'wp_edit_nav_menu_walker', 'cryptcio_replace_walker_class' , 90, 2 );

add_action( 'wp_nav_menu_item_custom_fields', 'cryptcio_nav_menu_item_custom_fields' , 99, 4 );


/** 
* Fixed: wrong active menu item. 
*/
function cryptcio_add_current_url_menu_class( $classes = array(), $item = false ) {
  // Get current URL
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );

  	// Get homepage URL
 	$homepage_url = trailingslashit( home_url('/') );
  // Exclude 404 and homepage
  	if( is_404() or $item->url == $homepage_url ){
    	return $classes;
  	}
    unset($classes[array_search('current_page_parent',$classes)]);
    if($item->url && !empty($item->url)) {
      	if ( strstr( $current_url, $item->url) ){
        	$classes[] = 'current-menu-item';
      	}
    }
  	return $classes;
}


/**
 * Setup custom menu item fields before output.
 */
function cryptcio_setup_custom_nav_fields( $menu_item ) {
	$menu_item->cryptcio_mega_menu_iconfont = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_iconfont', true );
	$menu_item->cryptcio_mega_menu_iconfont_position = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_iconfont_position', true );
	$menu_item->cryptcio_mega_menu_iconfont_color = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_iconfont_color', true );
	$menu_item->tip_label = get_post_meta( $menu_item->ID, '_menu_item_tip_label', true );
    $menu_item->tip_color = get_post_meta( $menu_item->ID, '_menu_item_tip_color', true );
    $menu_item->tip_bg = get_post_meta( $menu_item->ID, '_menu_item_tip_bg', true );
	$menu_item->cryptcio_menu_modal_box = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_menu_modal_box', true ); 
	$menu_item->cryptcio_menu_modal_static_block = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_menu_modal_static_block', true );   

	// First level & Mega menu
	$menu_item->cryptcio_mega_menu_enabled = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_enabled', true );
	$menu_item->cryptcio_mega_menu_fullwidth = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_fullwidth', true );
	$menu_item->cryptcio_mega_menu_columns = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_columns', true );
	// Background image options
	$menu_item->cryptcio_mega_menu_bg_image = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_bg_image', true );
	$menu_item->cryptcio_mega_menu_bg_image_position = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_bg_image_position', true );
	$menu_item->cryptcio_mega_menu_bg_image_size = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_bg_image_size', true );
	$menu_item->cryptcio_mega_menu_bg_image_overlay = (bool)get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_bg_image_overlay', true );

	// Second level & Third level
	$menu_item->cryptcio_menu_hide_title = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_menu_hide_title', true );
	$menu_item->cryptcio_menu_remove_link = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_menu_remove_link', true );	
	$menu_item->cryptcio_menu_start_row = (bool) get_post_meta( $menu_item->ID, '_menu_item_cryptcio_menu_start_row', true );	
	$menu_item->cryptcio_mega_menu_block = get_post_meta( $menu_item->ID, '_menu_item_cryptcio_mega_menu_block', true );	

	return $menu_item;
}

/**
 * Update custom menu item fields.
 */
function cryptcio_update_custom_nav_fields( $menu_id, $menu_db_id ) {

	if ( ! empty( $_POST['menu-item-iconfont'][ $menu_db_id ] )) {
		update_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_iconfont', $_POST['menu-item-iconfont'][ $menu_db_id ]  );
	} else {
		delete_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_iconfont' );
	}

    $check = array('tip_label', 'tip_color', 'tip_bg','cryptcio_mega_menu_block','cryptcio_menu_remove_link','cryptcio_menu_start_row','cryptcio_menu_modal_box','cryptcio_menu_modal_static_block','cryptcio_mega_menu_bg_image_overlay','cryptcio_mega_menu_iconfont_position','cryptcio_mega_menu_iconfont_color');

    foreach ( $check as $key ) {
        if (isset($_POST['menu-item-'.$key][$menu_db_id])){
            update_post_meta( $menu_db_id, '_menu_item_'.$key, $_POST['menu-item-'.$key][$menu_db_id]);
        }
        else{
            delete_post_meta( $menu_db_id, '_menu_item_'.$key );
        }
    }
	$mega_menu_enabled = isset( $_POST['menu-item-cryptcio-enable-mega-menu'][ $menu_db_id ] );
	if ( $mega_menu_enabled ) {
		update_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_enabled', 'on' );
	} else {
		delete_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_enabled' );
	}

	if ( $mega_menu_enabled && isset( $_POST['menu-item-cryptcio-fullwidth-menu'][ $menu_db_id ] ) ) {
		update_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_fullwidth', 'on' );
	} else {
		delete_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_fullwidth' );
	}

	if ( $mega_menu_enabled && ! empty( $_POST['menu-item-cryptcio-columns'][ $menu_db_id ] ) ) {
		update_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_columns', absint( $_POST['menu-item-cryptcio-columns'][ $menu_db_id ] ) );
	} else {
		delete_post_meta( $menu_db_id, '_menu_item_cryptcio_mega_menu_columns' );
	}
	//Mega menu background image options
	$mega_menu_param = array('cryptcio_mega_menu_bg_image','cryptcio_mega_menu_bg_image_position','cryptcio_mega_menu_bg_image_size');
	foreach ($mega_menu_param as $key) {
		if ( $mega_menu_enabled && ! empty( $_POST['menu-item-'.$key][ $menu_db_id ] ) ) {
			update_post_meta( $menu_db_id, '_menu_item_'.$key,  $_POST['menu-item-'.$key][ $menu_db_id ] );
		} else {
			delete_post_meta( $menu_db_id, '_menu_item_'.$key );
		}
	}	
	if ( isset( $_POST['menu-item-cryptcio-hide-title'][ $menu_db_id ] ) ) {
		update_post_meta( $menu_db_id, '_menu_item_cryptcio_menu_hide_title', 'on' );
	} else {
		delete_post_meta( $menu_db_id, '_menu_item_cryptcio_menu_hide_title' );
	}

}

function cryptcio_replace_walker_class( $walker, $menu_id ) {

	if ( 'Walker_Nav_Menu_Edit' == $walker ) {
		$walker = 'Cryptcio_Walker_Nav_Menu_Edit';
	}

	return $walker;
}

function cryptcio_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
	// set default item fields
	$default_mega_menu_fields = array(
		'cryptcio_mega_menu_iconfont' => '',
		'cryptcio_mega_menu_enabled' => 0,
		'cryptcio_mega_menu_fullwidth' => 0,
		'cryptcio_mega_menu_columns' => 3,
		'tip_color' => '',
		'tip_label' => '',
		'tip_bg' => '',
		'cryptcio_mega_menu_block'=> '',
		'cryptcio_menu_hide_title' => 0,
	);

	// set defaults
	foreach ( $default_mega_menu_fields as $field=>$value ) {
		if ( !isset($item->$field) ) {
			$item->$field = $value;
		}
	}

	if ( empty( $item->cryptcio_mega_menu_columns ) ) {
		$item->cryptcio_mega_menu_columns = 3;
	}

	$mega_menu_container_classes = array( 'cryptcio-mega-menu-fields' );

	$mega_menu_container_classes = implode( ' ', $mega_menu_container_classes );
	?>
	<div class="<?php echo esc_attr( $mega_menu_container_classes ); ?>">
		<p class="field-cryptcio-iconfont description description-wide">
			<label>
				<?php echo esc_html__('Icon Font Class','cryptcio'); ?><br />
	            <input type="text" id="edit-menu-item-iconfont-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-iconfont"
	                <?php if (esc_attr( $item->cryptcio_mega_menu_iconfont )) : ?>
	                    name="menu-item-iconfont[<?php echo esc_attr($item_id); ?>]"
	                <?php endif; ?>
	                   data-name="menu-item-iconfont[<?php echo esc_attr($item_id); ?>]"
	                   value="<?php echo esc_attr( $item->cryptcio_mega_menu_iconfont ); ?>" />				
			</label>
		</p>
		<p class="description description-wide">
			<?php echo esc_html__('Icon Position: ','cryptcio'); ?>
			<select name="menu-item-cryptcio_mega_menu_iconfont_position[<?php echo esc_attr($item_id); ?>]" id="edit-menu-item-cryptcio_mega_menu_iconfont_position-<?php echo esc_attr($item_id); ?>">
				<?php 
				$cryptcio_menu_icon_pos = array( 
					esc_html__('left','cryptcio') => 'left',
					esc_html__('top','cryptcio') => 'top', 
				);
				foreach( $cryptcio_menu_icon_pos as $title=>$value): ?>
					<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->cryptcio_mega_menu_iconfont_position); ?>><?php echo esc_html($title); ?></option>
				<?php endforeach; ?>
			</select>
		</p>	
		<p class="description description-wide">
			<?php echo esc_html__('Icon Color: ','cryptcio'); ?>
			<input type="text" id="edit-menu-item-cryptcio_mega_menu_iconfont_color-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-cryptcio_mega_menu_iconfont_color"
		                <?php if (esc_attr( $item->cryptcio_mega_menu_iconfont_color )) : ?>
		                    name="menu-item-cryptcio_mega_menu_iconfont_color[<?php echo esc_attr($item_id); ?>]"
		                <?php endif; ?>
		                   data-name="menu-item-cryptcio_mega_menu_iconfont_color[<?php echo esc_attr($item_id); ?>]"
		                   value="<?php echo esc_attr( $item->cryptcio_mega_menu_iconfont_color ); ?>" />
		</p>		
		<div class="menu-tip-fields description-wide">
		    <p class="description col-1">
		        <label for="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>">
		            <?php echo esc_html__('Tip Label','cryptcio'); ?><br />
		            <input type="text" id="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_label"
		                <?php if (esc_attr( $item->tip_label )) : ?>
		                    name="menu-item-tip_label[<?php echo esc_attr($item_id); ?>]"
		                <?php endif; ?>
		                   data-name="menu-item-tip_label[<?php echo esc_attr($item_id); ?>]"
		                   value="<?php echo esc_attr( $item->tip_label ); ?>" />
		        </label>
		    </p>
		    <p class="description col-2">
		        <label for="edit-menu-item-tip_color-<?php echo esc_attr($item_id); ?>">
		            <?php echo esc_html__('Tip Text Color','cryptcio'); ?><br />
		            <input type="text" id="edit-menu-item-tip_color-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_color"
		                <?php if (esc_attr( $item->tip_color )) : ?>
		                    name="menu-item-tip_color[<?php echo esc_attr($item_id); ?>]"
		                <?php endif; ?>
		                   data-name="menu-item-tip_color[<?php echo esc_attr($item_id); ?>]"
		                   value="<?php echo esc_attr( $item->tip_color ); ?>" />
		        </label>
		    </p>
		    <p class="description">
		        <label for="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>">
		            <?php echo esc_html__('Tip BG Color','cryptcio'); ?><br />
		            <input type="text" id="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_bg"
		                <?php if (esc_attr( $item->tip_bg )) : ?>
		                    name="menu-item-tip_bg[<?php echo esc_attr($item_id); ?>]"
		                <?php endif; ?>
		                   data-name="menu-item-tip_bg[<?php echo esc_attr($item_id); ?>]"
		                   value="<?php echo esc_attr( $item->tip_bg ); ?>" />
		        </label>
		    </p>
		</div>
			
	    <p class="description field-cryptcio_menu_modal_static_block description-wide">
	        <label for="edit-menu-item-cryptcio_menu_modal_static_block-<?php echo esc_attr($item_id); ?>">
	            <?php echo esc_html__('Enter unique ID','cryptcio'); ?><br />
	            <input type="text" id="edit-menu-item-cryptcio_menu_modal_static_block-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-cryptcio_menu_modal_static_block"
	                <?php if (esc_attr( $item->cryptcio_menu_modal_static_block )) : ?>
	                    name="menu-item-cryptcio_menu_modal_static_block[<?php echo esc_attr($item_id); ?>]"
	                <?php endif; ?>
	                   data-name="menu-item-cryptcio_menu_modal_static_block[<?php echo esc_attr($item_id); ?>]"
	                   value="<?php echo esc_attr( $item->cryptcio_menu_modal_static_block ); ?>" />
	        </label>
	        <span class="description"><?php echo esc_html__('Enter ID for your menu link if you want to open static block in modal box. Make sure to add block name in Static Block name field below.','cryptcio');?></span>
	    </p>		    
		<!-- Mega menu in first level -->
		<div class="cryptcio-mega-menu-fist-lev description-wide">
			<p class="field-cryptcio-enable-mega-menu">
				<label for="edit-menu-item-cryptcio-enable-mega-menu-<?php echo esc_attr($item_id); ?>">
					<input id="edit-menu-item-cryptcio-enable-mega-menu-<?php echo esc_attr($item_id); ?>" type="checkbox" class="edit-menu-item-use_megamenu" name="menu-item-cryptcio-enable-mega-menu[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_mega_menu_enabled ); ?>/>
					<?php echo esc_html__('Enable Mega Menu','cryptcio'); ?>
				</label>
			</p>
			<p class="field-cryptcio-fullwidth-menu">
				<label for="edit-menu-item-cryptcio-fullwidth-menu-<?php echo esc_attr($item_id); ?>">
					<input id="edit-menu-item-cryptcio-fullwidth-menu-<?php echo esc_attr($item_id); ?>" type="checkbox" name="menu-item-cryptcio-fullwidth-menu[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_mega_menu_fullwidth ); ?>/>
					<?php echo esc_html__('Fullwidth','cryptcio'); ?>
				</label>
			</p>
			<p class="field-cryptcio-columns description description-wide">
				<?php _ex( 'Number of columns: ', 'edit menu walker', 'cryptcio' ); ?>
				<select name="menu-item-cryptcio-columns[<?php echo esc_attr($item_id); ?>]" id="edit-menu-item-cryptcio-columns-<?php echo esc_attr($item_id); ?>">
					<?php foreach( array( '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5 ) as $title=>$value): ?>
						<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->cryptcio_mega_menu_columns); ?>><?php echo esc_html($title); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<div class="field-cryptcio-menu-background-image">
				<p class="description description description-wide" >
		            <label> <?php echo esc_html__('Background Image ','cryptcio'); ?></label>
		                <input type="text" id="edit-menu-item-cryptcio_mega_menu_bg_image-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-popup_bg_image"
		                    <?php if (esc_attr( $item->cryptcio_mega_menu_bg_image )) : ?>
		                        name="menu-item-cryptcio_mega_menu_bg_image[<?php echo esc_attr($item_id); ?>]"
		                    <?php endif; ?>
		                       data-name="menu-item-cryptcio_mega_menu_bg_image[<?php echo esc_attr($item_id); ?>]"
		                       value="<?php echo esc_attr( $item->cryptcio_mega_menu_bg_image ); ?>" />
		                <br/>
		                <input class="button_upload_image button" id="edit-menu-item-cryptcio_mega_menu_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="<?php echo esc_html__('Upload Image','cryptcio');?>" />&nbsp;
		                <input class="button_remove_image button" id="edit-menu-item-cryptcio_mega_menu_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="<?php echo esc_html__('Remove Image','cryptcio');?>" />
		            
		        </p>
				<p class="field-cryptcio-bg-pos description description-wide">
					<?php echo esc_html__('Background image position: ','cryptcio'); ?>
					<select name="menu-item-cryptcio_mega_menu_bg_image_position[<?php echo esc_attr($item_id); ?>]" id="edit-menu-item-cryptcio_mega_menu_bg_image_position-<?php echo esc_attr($item_id); ?>">
						<?php 
						$cryptcio_menu_bg_pos = array( 
							esc_html__('select','cryptcio') => 'select',
							esc_html__('left top','cryptcio') => 'left top', 
							esc_html__('left center','cryptcio') => 'left center', 
							esc_html__('left bottom','cryptcio') => 'left bottom', 
							esc_html__('right top','cryptcio') => 'right top', 
							esc_html__('right center','cryptcio') => 'right center' ,
							esc_html__('right bottom','cryptcio') => 'right bottom' ,
							esc_html__('center top','cryptcio') => 'center top' ,
							esc_html__('center center','cryptcio') => 'center center', 
							esc_html__('center bottom','cryptcio') => 'center bottom', 
						);
						foreach( $cryptcio_menu_bg_pos as $title=>$value): ?>
							<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->cryptcio_mega_menu_bg_image_position); ?>><?php echo esc_html($title); ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p class="field-cryptcio-bg-image-size description description-wide">
					<?php echo esc_html__('Background image size: ','cryptcio'); ?>
					<select name="menu-item-cryptcio_mega_menu_bg_image_size[<?php echo esc_attr($item_id); ?>]" id="edit-menu-item-cryptcio_mega_menu_bg_image_size-<?php echo esc_attr($item_id); ?>">
						<?php 
						$cryptcio_menu_bg_size = array( 
							esc_html__('select','cryptcio') => 'select',
							esc_html__('cover','cryptcio') => 'cover', 
							esc_html__('contain','cryptcio') => 'contain', 
							esc_html__('inherit','cryptcio') => 'inherit', 
						);
						foreach( $cryptcio_menu_bg_size as $title=>$value): ?>
							<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->cryptcio_mega_menu_bg_image_size); ?>><?php echo esc_html($title); ?></option>
						<?php endforeach; ?>
					</select>
				</p>		
				<p class="field-cryptcio_mega_menu_bg_image_overlay">
					<label for="edit-menu-item-cryptcio_mega_menu_bg_image_overlay-<?php echo esc_attr($item_id); ?>">
						<input id="edit-menu-item-cryptcio_mega_menu_bg_image_overlay-<?php echo esc_attr($item_id); ?>" type="checkbox" name="menu-item-cryptcio_mega_menu_bg_image_overlay[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_mega_menu_bg_image_overlay ); ?>/>
						<?php echo esc_html__( 'Enable background overlay', 'cryptcio' ); ?>
					</label>
				</p>
				<p class="field-cryptcio-hide-menu-title">
					<label for="edit-menu-item-cryptcio-hide-title-<?php echo esc_attr($item_id); ?>">
						<input id="edit-menu-item-cryptcio-hide-title-<?php echo esc_attr($item_id); ?>" type="checkbox" name="menu-item-cryptcio-hide-title[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_menu_hide_title ); ?>/>
						<?php echo esc_html__( 'Hide Menu Title', 'cryptcio' ); ?>
					</label>
				</p>
				<p class="field-cryptcio_menu_remove_link">
					<label for="edit-menu-item-cryptcio_menu_remove_link-<?php echo esc_attr($item_id); ?>">
						<input id="edit-menu-item-cryptcio_menu_remove_link-<?php echo esc_attr($item_id); ?>" type="checkbox" class="edit-menu-item-use_megamenu" name="menu-item-cryptcio_menu_remove_link[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_menu_remove_link ); ?>/>
						<?php echo esc_html__('Remove link','cryptcio'); ?>
					</label>
				</p>													        
			</div>
		</div>
		<div class="cryptcio-mega-menu-second-lev">
			<p class="field-cryptcio_menu_start_row">
				<label for="edit-menu-item-cryptcio_menu_start_row-<?php echo esc_attr($item_id); ?>">
					<input id="edit-menu-item-cryptcio_menu_start_row-<?php echo esc_attr($item_id); ?>" type="checkbox" class="edit-menu-item-use_megamenu" name="menu-item-cryptcio_menu_start_row[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->cryptcio_menu_start_row ); ?>/>
					<?php echo esc_html__('Start new row','cryptcio'); ?>
				</label>
			</p>						
			<p class="field-cryptcio_mega_menu_block description description-wide">
				<label>
					<?php echo esc_html__('Enter Block Name','cryptcio'); ?><br />
		            <input type="text" id="edit-menu-item-cryptcio_mega_menu_block-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-cryptcio_mega_menu_block"
		                <?php if (esc_attr( $item->cryptcio_mega_menu_block )) : ?>
		                    name="menu-item-cryptcio_mega_menu_block[<?php echo esc_attr($item_id); ?>]"
		                <?php endif; ?>
		                   data-name="menu-item-cryptcio_mega_menu_block[<?php echo esc_attr($item_id); ?>]"
		                   value="<?php echo esc_attr( $item->cryptcio_mega_menu_block ); ?>" />				
				</label>
				<span class="description"><?php echo wp_kses(__('Make sure to use an unique name for a Static Block content type. You can add new static block in <strong>Static Block > Add New </strong> ','cryptcio'),array('strong'=> array()));?></span>
			</p>			
		</div>

	</div>

	<!-- Mega Menu End -->

	<?php
}

	require_once(CRYPTCIO_FUNCTIONS  . '/menus/class-edit-menu-walker.php');
	require_once(CRYPTCIO_FUNCTIONS  . '/menus/class-walker-nav-menu.php');

?>