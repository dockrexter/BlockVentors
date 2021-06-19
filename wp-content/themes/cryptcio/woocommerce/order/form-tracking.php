<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>
<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">
	<p class="note-tracking"><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.','cryptcio' ); ?></p>
	<div class="form-tracking">
		<p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'Order ID','cryptcio' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.','cryptcio' ); ?>" /></p>
		<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing email','cryptcio' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_attr_e( 'Email you used during checkout.','cryptcio' ); ?>" /></p>
		<div class="clear"></div>
		<p class="form-row form-submit"><input type="submit" class="button btn btn-primary" name="track" value="<?php esc_attr_e( 'Track','cryptcio' ); ?>" /></p>
		<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
	</div>
</form>

