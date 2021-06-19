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
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<?php $show_page_header = get_post_meta(get_the_ID(),'_cth_image_post',true ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('fw-post tranform-main-img pformat-default'); ?>>
	<div class="post-itemt-wrap">
	<?php 
	// Get the list of files
	$slider_images = get_post_meta( get_the_ID(), '_cth_post_slider_images', true);
	
	if( !empty($slider_images)&& pxaas_get_option('blog_show_format', true ) && get_post_format( ) !== 'gallery' ){ ?>
	
		<div class="post-media-wrap fl-wrap"> 
	 		<div class="single-slider owl-carousel owl-theme dis-owl-dot nav-betwen"> 
	 			<?php 
	            foreach ( (array) $slider_images as $img_id => $img_url ) {
			        echo '<div class="item">';
		       		echo wp_get_attachment_image($img_id, 'pxaas-featured-image', false,array('class'=>'resp-img') );
			        echo '</div>';
			    }
	 			?>
	        </div> 
	        <div class="button-single">
				<a href="<?php echo esc_url( get_permalink() ) ?>"><i class="fa fa-long-arrow-right"></i></a>
			</div>
		 </div> 
		<?php } elseif(has_post_thumbnail( )){ ?>
		<div class="post-media-wrap fl-wrap tranform-img">
		    <?php the_post_thumbnail('pxaas-featured-image',array('class'=>'resp-img') ); ?>
		    <div class="button-single">
				<a href="<?php echo esc_url( get_permalink() ) ?>"><i class="fa fa-long-arrow-right"></i></a>
			</div>
		</div>
		<?php } ?>
			
		<div class="post-content-wrap  <?php if( !empty($slider_images)&& pxaas_get_option('blog_show_format', true ) && get_post_format( ) !== 'gallery' ){echo 'fl-wrap';}else{echo 'tranform-main-sec';}?> ">
			
		    <div class="post-content-wrap-title fl-wrap">
		    	<?php if( pxaas_get_option( 'blog_date') ) :?>
		        <div class="blog-date tranform-main-date">
		           <span><?php the_time(get_option('date_format'));?></span> 
		        </div>
		    	<?php endif;?>
		    	<?php 
				the_title( '<h3 class="entry-title entry-title-p"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				// pxaas_edit_link( get_the_ID() );
				?>
		    </div>
		    <?php if( pxaas_get_option( 'blog_author') || pxaas_get_option( 'blog_date' )  || pxaas_get_option( 'blog_cats' ) || pxaas_get_option( 'blog_comments' )  ):?>
		    
			<?php endif;?>
		    <div class="post-excerpt">
		    	<?php the_excerpt();?>
			</div>
			<div class="post-opt tranform-main-cont">
		    	<ul class="blog-title-opt clearfix">
		    		<?php if( pxaas_get_option( 'blog_author') ):?>
		            <li class="post-author">
		                <i class="fa fa-user"></i><?php the_author_posts_link( );?>
		            </li>
		            <?php endif;?>

		            <?php if( pxaas_get_option( 'single_like' ) && function_exists('pxaas_addons_get_likes_button') ):?>
		                <li class="post-like">
		                    <?php echo pxaas_addons_get_likes_button( get_the_ID() );?>
		                </li>
		            <?php endif;?>

		         	<?php if( pxaas_get_option( 'blog_comments' ) ):?>
		        		<li class="comment-num"><i class="fa fa-comments-o"></i><?php comments_popup_link( esc_html_x('0 comment','comment counter None format' ,'pxaas'), esc_html_x('1 comment','comment counter One format', 'pxaas'), esc_html_x('% comments','comment counter Plural format', 'pxaas') ); ?></li>
		        	<?php endif;?>

		        	<?php if( pxaas_get_option( 'blog_cats' ) ) :?>
						<?php if(get_the_category( )) { ?>
						<li class="cat-post"><i class="fa fa-clone"></i><?php the_category( ' , ' ); ?></li>	
						<?php } ?>	
					<?php endif;?>
			    </ul>
			</div>
		    <?php
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'pxaas' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
		</div>
	</div>
	<!-- end post-itemt-wrap -->
</article>
<!-- article end -->   

  
