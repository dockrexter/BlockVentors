<form role="search" method="get"  class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="search-form woosearch-search">
        <div class="woosearch-input-box">
			<?php 
				$header_type = cryptcio_get_header_type();
				$cryptcio_settings = cryptcio_check_theme_options();
					if (get_post_type()=='post') {
						$searchTaxArray = array('category');
					} else if (get_post_type()=='gallery') {
						$searchTaxArray = array('gallery_cat');
					} else {
						if(class_exists( 'WooCommerce' )) {
							$searchTaxArray = array('product_cat');
						}            	 
					}         
				if($header_type == '1' && isset($cryptcio_settings['show_category_search']) && $cryptcio_settings['show_category_search'] && (is_array($searchTaxArray) || is_object($searchTaxArray))):?>
					<?php                
						foreach ($searchTaxArray as $taxonomy) {
							$taxonomy     = $taxonomy;
							$orderby      = 'name';  
							$show_count   = 1;      
							$pad_counts   = 0;     
							$hierarchical = 1;    
							$title        = '';  
							$empty        = 0;

							$args = array(
								 'taxonomy'     => $taxonomy,
								 'orderby'      => $orderby,
								 'show_count'   => $show_count,
								 'pad_counts'   => $pad_counts,
								 'hierarchical' => $hierarchical,
								 'title_li'     => $title,
							);
							$terms = get_categories( $args );
							$term_array =array();
							foreach ($terms as $cat) {
								$category_id = $cat->term_id;       
								$term_array[$cat->slug] = $cat->name;
							}  
							$default_name_select = esc_html__('All Category','cryptcio');

							if((is_array($term_array) || is_object($term_array)) && !empty($term_array)){
								echo '<select class="pro_cat_select"  name="'.esc_attr($taxonomy).'">';
									echo '<option value="">'.esc_html($default_name_select).'</option>'; 
									foreach($term_array as $key => $value):
										echo '<option value="'.esc_attr($key).'">'.esc_html($value).'</option>'; //close your tags!!
									endforeach;                               
								echo '</select> ' ;
							}                         
						}
					?>                         
				<?php endif;?> 
			<input class="product-search" type="text" name="s"  placeholder="<?php echo esc_attr__("Search...", "cryptcio") ?>"/>
        </div>
		<button type="submit" class="searchsubmit woosearch-submit submit btn-search">
			<span class="search-text"><?php echo esc_html__('Search','cryptcio'); ?></span>
			<i class="fa fa-search"></i>
		</button>
		<?php 
            if (isset($cryptcio_settings['header_search_type']) &&$cryptcio_settings['header_search_type']==1) {
		        if(class_exists( 'WooCommerce' )) {
		            echo  '<input type="hidden" name="post_type" value="product" />';
		        }                 
            }  else {
           	 	echo  '<input type="hidden" name="post_type" value="post" />';
            } 
		?>       
    </div>
</form>