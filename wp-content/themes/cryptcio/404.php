
<?php get_header(); ?>
<?php $cryptcio_overlay_class = ''; ?>
<?php if(isset($cryptcio_settings['404-overlay']) && $cryptcio_settings['404-overlay']){
    $cryptcio_overlay_class = 'overlay404';
}
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <div class="page-404 text-center <?php echo esc_attr($cryptcio_overlay_class);?>">
                    <?php if(isset($cryptcio_settings['404-logo']) && $cryptcio_settings['404-logo']!='' && $cryptcio_settings['404-logo']['url']!='' && isset($cryptcio_settings['404-logo']['url'])):?>
                       <header class="display-flex">
                           <img src="<?php echo esc_url($cryptcio_settings['404-logo']['url']);?>" alt="" />
                       </header>
                    <?php elseif(isset($cryptcio_settings['logo']) && $cryptcio_settings['logo']!=''):?>
                       <header class="display-flex">
                           <img src="<?php echo esc_url($cryptcio_settings['logo']['url']);?>" alt="" />
                       </header>                        
                    <?php endif;?>        
                <div class="page-404-container container">
                    <div class="content-404">
                        <div class="content-desc">                         	
                            <div class="heading404">                                         
                                    <div class="content404">
                                        <?php if(isset($cryptcio_settings['404-image']) && $cryptcio_settings['404-image']!='') :?>
                                            <?php $logo_header = $cryptcio_settings['404-image']['url']; ?>
                                            <div class="img-404">
                                                <img src="<?php echo esc_url($logo_header); ?>" alt=""/>
                                            </div>
                                        <?php endif;?>                                        
                                        <?php if(isset($cryptcio_settings['404-content']) && $cryptcio_settings['404-content'] !=''):?>
                                            <p><?php echo wp_kses($cryptcio_settings['404-content'],cryptcio_allow_html());?></p>
                                        <?php endif;?>
                                            <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('go back home', 'cryptcio');?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>    
                                
                            </div> 
                        </div>
					</div>
                </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
