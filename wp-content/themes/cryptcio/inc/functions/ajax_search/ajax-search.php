<?php
add_action( 'wp_ajax_cryptcio_search', 'cryptcio_autocomplete_search' );
add_action( 'wp_ajax_nopriv_cryptcio_search', 'cryptcio_autocomplete_search' );
function cryptcio_autocomplete_search() {
    $term = strtolower( $_GET['term'] );
    $post_type = strtolower($_GET['post_type']);
    $suggestions = array();
        
    $args = array(
        's'                 => $term , 
        'post_type'         => $post_type,                  
    );  
    if(isset($_GET['tax']) && (is_array($_GET['tax'])|| is_object($_GET['tax']))){
        $i=1;
        $tax_query = array(); 
        $_GET['tax'] = array_unique($_GET['tax']);
        foreach ($_GET['tax'] as $value) {
            $taxonomy = $value['tax'];
            $tax_term = $value['term']; 
            if(sizeof($_GET['tax']) > 1 && $i==1){
                $tax_query[] = array('relation' => 'AND');
            }   
            if($tax_term!=''){
                $tax_query[] = array(
                             'taxonomy' => $taxonomy,
                             'field' => 'slug',
                             'terms' => $tax_term,
                             'operator' => 'IN'
                           );
            }            
            $args['tax_query'] = $tax_query ;  
            $i ++;                      
        }                
    }     

    if(isset($_GET['min_price']) && $_GET['min_price']!='' && isset($_GET['max_price']) && $_GET['max_price']!=''){
        $min_price = preg_replace("/[^0-9]/", '', $_GET['min_price']); 
        $max_price = preg_replace("/[^0-9]/", '', $_GET['max_price']);
        $args['meta_query'] = array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
                ),
            );
    }
    
    $loop = new WP_Query( $args );  
    while( $loop->have_posts() ) {
        $loop->the_post();
        $suggestion = array();
        $suggestion['label'] = get_the_title();
        $suggestion['link'] = get_permalink(); 
        $suggestion['imgsrc'] = ''; 
        if($post_type=='product'){
            $product = wc_get_product(get_the_ID());
            $suggestion['add_cart'] = do_shortcode('[add_to_cart id="'.get_the_ID().'"]');
            $suggestion['imgsrc'] = get_the_post_thumbnail_url(); 
        }else{
            $suggestion['add_cart'] = '';
        }
        
        $suggestion['termtest'] = $min_price;  
        $suggestion['args']=    $args['tax_query'];
        $suggestions[] = $suggestion;
    }
    wp_reset_postdata();
    
    
    echo json_encode( $suggestions );
    exit();
}

