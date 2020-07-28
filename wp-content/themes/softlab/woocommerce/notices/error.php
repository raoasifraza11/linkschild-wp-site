<?php
/**
 * Show error messages
 *
 * This WooCoomerce template is overridden by WebGeniusLab team for fine customizing.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $messages ) {
	return;
}

?>
<div class="softlab_module_message_box type_error closable wpb_animate_when_almost_visible wpb_right-to-left right-to-left wpb_start_animation animated"><div class="message_icon_wrap" role="alert"><i class="message_icon "></i></div><div class="message_content"><div class="message_text"> 
<ul class="woocommerce-error" role="alert">
	<?php foreach ( $messages as $message ) : ?>
		<li><?php echo wc_kses_notice( $message ); ?></li>
	<?php endforeach; ?>
</ul>
</div>
<div><span class="message_close_button"></span></div> 