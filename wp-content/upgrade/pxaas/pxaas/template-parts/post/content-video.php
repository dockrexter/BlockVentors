<?php
/**
 * @package PXaas - Saas & Software Landing Page Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 23-09-2019
 * @since 1.0.6
 * @version 1.0.6
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * Template part for displaying video posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('mb-50px fl-wrap fw-post tranform-main-img'); ?>>
	<div class="post-itemt-wrap">
		<?php
		if(get_post_meta(get_the_ID(), '_cth_embed_video', true)!=""){  ?>
		    <div class="post-media-wrap fl-wrap">
		        <div class="resp-video">
					<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cth_embed_video', true) )); ?>
				</div>
			</div>
		<?php
		}elseif(has_post_thumbnail( )){ ?>
			<div class="o-hidden post-media-wrap fl-wrap tranform-img">
		        <a href="<?php the_permalink( ); ?>" class="blog-thumb-link">
		        	<?php the_post_thumbnail('pxaas-featured-image',array('class'=>'transition-4 respimg') ); ?>
		        </a>
	    	</div>
		<?php } ?>
		
		<div class="post-content-wrap  <?php if( !empty($slider_images)&& pxaas_get_option('blog_show_format', true ) && get_post_format( ) !== 'gallery' ){echo 'fl-wrap';}else{echo 'tranform-main-sec';}?> ">
		    <div class="post-content-wrap-title fl-wrap">
		    	<?php 
				the_title( '<h4 class="mt-20px mb-10px entry-title"><a href="' . esc_url( get_permalink() ) . '" class="color-333 fw-600 color-blue-hvr" rel="bookmark">', '</a></h4>' );
				?>
		    </div>
		    
		    <?php if(the_excerpt() != ''): ?>
                <div class="post-excerpt">
                    <?php the_excerpt();?>
                </div>
            <?php endif; ?>
			
			<?php pxaas_get_blog_post_cart_metar(); ?>

		    <?php
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'pxaas' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			<!-- read More -->
			<a class="read transition-5 o-hidden d-inline-block p-relative pl-20px mt-10px mr-15px color-aaa color-blue-hvr" href="<?php echo get_permalink();?>">
				<span class="line transition-4 p-absolute d-inline-block bg-333"></span>
				<?php esc_html_e( 'Read more', 'pxaas' ); ?>
			</a>
		</div>
	</div>
</article>
<!-- article end -->   
