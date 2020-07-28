<?php
/**
 * Related Products
 *
 * This template is overridden by WebGeniusLab team.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;


$columns = (int) Softlab_Theme_Helper::get_option('shop_related_columns');
$count = (int) Softlab_Theme_Helper::get_option('shop_r_products_per_page');


if ( $related_products ) : ?>

	<section class="related products">

		<h2><?php esc_html_e( 'Related products', 'softlab' ); ?></h2>

		<div class="wgl-products-related wgl-products-wrapper columns-<?php echo esc_attr($columns);?>">

			<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) :

				$post_object = get_post( $related_product->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
