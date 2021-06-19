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
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
$show_page_title = pxaas_get_option('show_title_page',true);
$show_btn_edit = pxaas_get_option('show_btn_edit_page',true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
	<?php if($show_page_title || $show_btn_edit) : ?>
		<div class="entry-header">
			<?php if($show_page_title ) the_title( '<h4 class="entry-title">', '</h4>' ); ?>
			<?php if($show_btn_edit ) pxaas_edit_link( get_the_ID() ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content clearfix">
		<?php
			the_content();
		?>
	</div>

	<?php
        wp_link_pages( array(
        'before'      => '<div class="page-links mt-20px"><span class="page-links-title">' . esc_html__( 'Pages:', 'pxaas' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        ) );
    ?>

</article>
