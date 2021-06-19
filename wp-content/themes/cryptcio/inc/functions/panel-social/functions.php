<?php
function cryptcio_side_tabbed() {
global $cryptcio_settings;
//twitter
$twitter = isset($cryptcio_settings['side-twitter'])?$cryptcio_settings['side-twitter']:"";
$contact = isset($cryptcio_settings['side-contact']) ? $cryptcio_settings['side-contact'] :"";
$google_map = isset($cryptcio_settings['side-map']) ? $cryptcio_settings['side-map']:"";
//instagram
$instagram = isset($cryptcio_settings['side-instagram']) ? $cryptcio_settings['side-instagram'] :"";
$iframe_instagram = isset($cryptcio_settings['iframe-instagram']) ? $cryptcio_settings['iframe-instagram'] :"";


echo '<ul class="social_widgets social">'; 
if($twitter):?>  
<?php if( function_exists('is_plugin_active') && is_plugin_active( 'arrowpress-core/arrowpress-shortcodes.php' ) ) : ?>   
  <li class="soc_block_twitter">
        <div class="sw_content">
          <h4><?php echo esc_html__('Follow me on tweets','cryptcio');?></h4>
          <?php the_widget( 'ArrowpressLatestTweetWidget','tweet_limit=2' );?>
        </div>  
  </li>
<?php endif;?>
<?php endif;
if($contact){ 
$form_shortcode = isset($cryptcio_settings['form_contact']) ? $cryptcio_settings['form_contact'] :"";    
echo '<li class="soc_block_mail">
      <div class="sw_content">
        <h4>'.esc_html__('Contact us','cryptcio').'</h4>
        <p>'.esc_html__('Contact us today for further info:','cryptcio').'</p>';
       ?>
       <?php 
        if($form_shortcode != ""){
          echo do_shortcode(''.$form_shortcode.'');
        }
       ?> 
      </div>  

    </li><?php
}
if($google_map):?>    
<li class="soc_block_marker">
      <div class="sw_content">
        <h4><?php echo esc_html__('Store Location','cryptcio'); ?></h4>
        <ul class="c_info_list">
          <?php if (!empty($cryptcio_settings['store-contact-location'])): ?>
          <li>

            <div class="clearfix">
              <i class="icon-location"></i>
              <p class="contact_e"><?php echo esc_html($cryptcio_settings['store-contact-location']); ?></p>
              <div class="soc_google_map">
              <?php echo wp_kses($cryptcio_settings['iframe-google-map'],array(
                  'iframe' => array(
                    'height' => array(),
                    'style' => array(),
                    'src' => array(),
                    'allowfullscreen' => array(),
                    )
                )); ?>
              </div>
            </div>

          </li>
          <?php endif;?>
          <?php if (!empty($cryptcio_settings['store-contact-phonenumber'])): ?>
          <li>

            <div class="clearfix">
              <i class="icon-phone-1"></i>
              <p class="contact_e"><?php echo esc_html($cryptcio_settings['store-contact-phonenumber']); ?></p>
            </div>

          </li>
          <?php endif;?>
          <?php if (!empty($cryptcio_settings['store-contact-email'])): ?>
          <li>

            <div class="clearfix">
              <i class="icon-email"></i>
              <a class="contact_e" href="mailto:<?php echo esc_attr($cryptcio_settings['store-contact-email']); ?>"><?php echo esc_html($cryptcio_settings['store-contact-email']); ?></a>
            </div>

          </li>
          <?php endif;?>
          <?php if (!empty($cryptcio_settings['store-contact-time'])): ?>
          <li>

            <div class="clearfix">
              <i class="icon-clock"></i>
              <p class="contact_e"><?php echo esc_html($cryptcio_settings['store-contact-time']); ?></p>
            </div>

          </li>
          <?php endif;?>
        </ul>
      </div>  

    </li>
<?php endif;
if($instagram){    
$insta_ifram = is_ssl() ? str_replace( 'http://', 'https://', $iframe_instagram ) : $iframe_instagram;
echo '<li class="soc_block_instagram">
      <div class="sw_content">
        <h4>'.esc_html__('Follow me on instagram','cryptcio').'</h4>
        '.wp_kses($insta_ifram,array(
              'iframe' => array(
                'height' => array(),
                'style' => array(),
                'src' => array(),
                'allowfullscreen' => array(),
                )
            )).'
      </div>  

    </li>';
}    
echo '</ul>' ; 
}