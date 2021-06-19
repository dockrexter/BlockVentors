<?php 
    $cryptcio_settings = cryptcio_check_theme_options();
	$event_form = isset($cryptcio_settings['events_form']) ? $cryptcio_settings['events_form'] :'';
?>
<div class="events-single">
	<div class="events-item">
		<?php 
			$loaction_event = get_post_meta(get_the_ID(),'loaction_event', true);
			$time_event = get_post_meta(get_the_ID(),'time_event', true);
			$date_event = get_post_meta(get_the_ID(),'date_event', true);
			$map_event = get_post_meta(get_the_ID(),'map_event', true);
		?>
		<div class="events-post-info">  
			<div class="event-date-line">
				<?php
					echo wp_kses($date_event,array(
						'span' => array(
						'br' => array(),
						'strong' => array(),
						)
					));
				?>
			</div>
			<div class="events-post-title">
				<h3><?php the_title(); ?></h3>          
			</div>      
			<div class="blog_post_desc">          
				<?php the_content();?>            
			</div>
			<div class="event-info row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="event-time">
						<h5><?php echo esc_html__('Time', 'cryptcio');?></h5>
						<p class="time-event"><?php echo esc_html($time_event); ?></p>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="event-time">
						<h5><?php echo esc_html__('Loaction', 'cryptcio');?></h5>
						<p class="loaction-event"><?php echo esc_html($loaction_event); ?></p>
					</div>
				</div>
			</div>
			<div class="map_event">
				<?php
					echo wp_kses($map_event,array(
						'iframe' => array(
						'height' => array(),
						'frameborder' => array(),
						'style' => array(),
						'src' => array(),
						'allowfullscreen' => array(),
						)
					));
				?>
			</div>
			<?php if($event_form): ?>
				<div class="event_form">
				  <?php echo do_shortcode($event_form); ?>
				</div>
			<?php endif; ?>
		</div> 
	</div>
</div>