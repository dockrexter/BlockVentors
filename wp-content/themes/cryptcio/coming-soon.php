<?php 
/*
 Template Name: Coming soon
 */
?>
<?php get_header(); ?>
<?php $cryptcio_overlay_class = ''; ?>
<?php if(isset($cryptcio_settings['404-overlay']) && $cryptcio_settings['404-overlay']){
    $cryptcio_overlay_class = 'overlay404';
}
?>
<div class="coming-soon-container has-overlay text-left">
	<header class="display-flex">
        <div class="container">	
	            <?php if(isset($cryptcio_settings['coming-logo']) && $cryptcio_settings['coming-logo']!='' && $cryptcio_settings['coming-logo']['url']!='' && isset($cryptcio_settings['coming-logo']['url'])):?>
	                <img src="<?php echo esc_url($cryptcio_settings['404-logo']['url']);?>" alt="" />                
	               
	            <?php elseif(isset($cryptcio_settings['logo']) && $cryptcio_settings['logo']!=''):?>
		            <img src="<?php echo esc_url($cryptcio_settings['logo']['url']);?>" alt="" />                      
	            <?php endif;?>   
	            <?php if(isset($cryptcio_settings['coming_select_menu']) && $cryptcio_settings['coming_select_menu']!='' && isset($cryptcio_settings['coming_menu_link']) && $cryptcio_settings['coming_menu_link']!='' ):?>
                   <div class="header-container text-right">
                   		<ul class="mega-menu">
                   			<li>
                   				<a href="<?php echo esc_attr($cryptcio_settings['coming_menu_link']);?>"><?php echo esc_attr($cryptcio_settings['coming_select_menu']);?></a>
                   			</li>
                   		</ul>  
					</div>  
				<?php endif;?>
		</div>  
	</header>     		
	<div class="page-coming-soon">        		
		<?php 
		if(isset($cryptcio_settings['coming-soon-block']) && $cryptcio_settings['coming-soon-block']!=''){
		    echo do_shortcode('[arrowpress_static_block static="'.esc_html(get_the_title($cryptcio_settings['coming-soon-block'])).'"]');
		}else{?>
			<div class="coming-title"><?php echo esc_html__('Coming Soon','cryptcio');?></div>		
		<?php }
		?>
	</div>
</div>
<?php get_footer(); ?>
