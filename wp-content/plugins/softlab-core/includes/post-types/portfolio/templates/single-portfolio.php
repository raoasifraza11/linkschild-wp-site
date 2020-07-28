<?php 
if(!class_exists('Softlab_Theme_Helper')){
    return;
}

get_header();

$sb = Softlab_Theme_Helper::render_sidebars('portfolio_single');
$row_class = $sb['row_class'];
$column = $sb['column'];

$defaults = array(
	'posts_per_row' => '1',
	'portfolio_layout' => '',
);

// Allowed HTML render
$allowed_html = array(
    'a' => array(
        'href' => true,
        'title' => true,
    ),
    'br' => array(),
    'b' => array(),
    'em' => array(),
    'strong' => array()
); 

$single_post_type = Softlab_Theme_Helper::options_compare('portfolio_single_type_layout','mb_portfolio_post_conditional','custom');
$single_post_align = Softlab_Theme_Helper::options_compare('portfolio_single_align','mb_portfolio_post_conditional','custom');
$item = new WglPortfolio();

echo '<div class="single_portfolio-wrapper single_type-'.esc_attr($single_post_type).'">';
if ($single_post_type == '3' || $single_post_type == '4') {
	while ( have_posts() ):
		the_post();
		echo $item->wgl_portfolio_single_fw();
	endwhile;
		wp_reset_postdata();
} 

?>
<div class="wgl-container single_portfolio">
	<div class="row<?php echo esc_attr($row_class); ?>">
		<div id='main-content' class="wgl_col-<?php echo (int)$column; ?>">
			<?php
				while ( have_posts() ):
				the_post();
				echo $item->wgl_portfolio_single_item($defaults, $item_class = '');
				endwhile;
				wp_reset_postdata();

				$previousPost = get_adjacent_post(false, '', true);
				$nextPost  = get_adjacent_post(false, '', false);

				if ($nextPost || $previousPost):
					?>
					<div class="softlab-post-navigation">
						<?php
						if(is_a( $previousPost, 'WP_Post' )){							
							$image_prev_url = wp_get_attachment_image_src(get_post_thumbnail_id($previousPost->ID), 'thumbnail');

							$img_prev_html = '';
							$class_image_prev = ' no_image';
							$img_prev_html .= "<span class='image_prev". esc_attr($class_image_prev)."'>";
							$img_prev_html .= "<span class='no_image_post'></span>";
							$img_prev_html .= "</span>";

							echo '<div class="prev-link_wrapper">';
								echo '<div class="info_prev-link_wrapper"><a href="' . esc_url(get_permalink($previousPost->ID)) . '" title="' . esc_attr($previousPost->post_title) . '">'.$img_prev_html.'<span class="prev-link-info_wrapper"><span class="prev_title">'.wp_kses( $previousPost->post_title, $allowed_html ).'</span><span class="meta-wrapper"><span class="date_post">'.esc_html(get_the_time(get_option( 'date_format' ), $previousPost->ID)).'</span></span></span></a></div>';
							echo '</div>';
						}
						if(is_a( $nextPost, 'WP_Post' )) {
							$image_next_url = wp_get_attachment_image_src(get_post_thumbnail_id($nextPost->ID), 'thumbnail');

							$img_next_html = '';
							$class_image_next = ' no_image';
							$img_next_html .= "<span class='image_next".esc_attr($class_image_next)."'>";
							$img_next_html .= "<span class='no_image_post'></span>";
							$img_next_html .= "</span>";
							echo '<div class="next-link_wrapper">';
							echo '<div class="info_next-link_wrapper"><a href="' . esc_url(get_permalink($nextPost->ID)) . '" title="' . esc_attr( $nextPost->post_title ) . '"><span class="next-link-info_wrapper"><span class="next_title">'.wp_kses( $nextPost->post_title, $allowed_html ) .'</span><span class="meta-wrapper"><span class="date_post">'.esc_html(get_the_time(get_option( 'date_format' ), $nextPost->ID)).'</span></span></span>'.$img_next_html.'</a></div>';
							echo '</div>';
						}
						if(is_a( $previousPost, 'WP_Post' ) || is_a( $nextPost, 'WP_Post' )){
							echo '<a class="back-nav_page" href="#" onclick="location.href = document.referrer; return false;">';
								echo '<span></span>';
								echo '<span></span>';
								echo '<span></span>';
								echo '<span></span>';
							echo '</a>';
						}
						?>
					</div>
					<?php
				endif;   

			$related_switch = Softlab_Theme_Helper::get_option('portfolio_related_switch');
			if (class_exists( 'RWMB_Loader' )) {
	            $mb_related_switch = rwmb_meta('mb_portfolio_related_switch');      
	            if ($mb_related_switch == 'on') {
	                $related_switch = true;
	            }elseif ($mb_related_switch == 'off') {
	                $related_switch = false;
	            }
	        }
			
			if ( (bool)$related_switch && class_exists('Vc_Manager')) :
				$mb_pf_cat_r = array();
				
				$mb_pf_carousel_r = Softlab_Theme_Helper::options_compare('pf_carousel_r', 'mb_portfolio_related_switch', 'on');
				$mb_pf_title_r = Softlab_Theme_Helper::options_compare('pf_title_r', 'mb_portfolio_related_switch', 'on');
				$mb_pf_column_r = Softlab_Theme_Helper::options_compare('pf_column_r', 'mb_portfolio_related_switch', 'on');
				$mb_pf_number_r = Softlab_Theme_Helper::options_compare('pf_number_r', 'mb_portfolio_related_switch', 'on');
				$mb_pf_number_r = !empty($mb_pf_number_r) ? $mb_pf_number_r : '12';

				if (class_exists( 'RWMB_Loader' )) {
					$mb_pf_cat_r   		  = get_post_meta(get_the_id(), 'mb_pf_cat_r'); // store terms’ IDs in the post meta and doesn’t set post terms.
				}

				if (!(bool)$mb_pf_carousel_r) {
					wp_enqueue_script('isotope');
				}
				
				$cats = get_the_terms( get_the_id(), 'portfolio-category' );
				$cats = $cats ? $cats : array(); 
				$cat_slugs = array();
				foreach( $cats as $cat ){
					$cat_slugs[] = $cat->slug;
				}
				$cat_slugs = !empty( $cat_slugs ) ? implode(",", $cat_slugs) : null;
				
				if(!empty($mb_pf_cat_r[0])){
					$cat_slugs = array();
					$list = get_terms( 'portfolio-category', array( 'include' => $mb_pf_cat_r[0]  ) );
					foreach ($list as $key => $value) { 
						$cat_slugs[] = $value->slug;
					}
					$cat_slugs = !empty( $cat_slugs ) ? implode(",", $cat_slugs) : null;			
				}

				$mb_pf_cat_r = $cat_slugs;
				$mb_pf_cat_r = 'portfolio-category:'.$mb_pf_cat_r;

				$atts = array(
					'portfolio_layout' => 'related',
					'title' => '',
					'mb_pf_carousel_r' => $mb_pf_carousel_r,
					'subtitle' => '',
					'view_all_link' => '',
					'show_view_all' => 'no',
					'click_area' => 'single',
					'posts_per_row' => $mb_pf_column_r,
					'item_el_class' => '', 
					'css' => '',
					'autoplay' => true,
					'autoplay_speed' => '5000',
					'multiple_items' => true,
					'use_pagination' => false,
					'view_style' => 'standard',
					'crop_images' => 'yes',
					'show_portfolio_title' => 'true',
					'show_meta_categories' => 'true',
					'add_overlay' => 'true',
					'custom_overlay_color' => 'rgba(34,35,40,.7)',
					'items_load' => $mb_pf_column_r,
					'grid_gap' => '30px',
					'featured_render' => '1',
					'number_of_posts' => $mb_pf_number_r,
					'order_by' => "menu_order",
					'order' => "ASC",
					'post_type' => "portfolio",
					'taxonomies' => $mb_pf_cat_r
				);
				$featured_render = new WglPortfolio();

				$featured_post = $featured_render->render($atts);
				if($featured_render->post_count > 0){
					echo '<div class="related_portfolio">';
						if(!empty($mb_pf_title_r)){
							echo '<div class="softlab_module_title"><h3>' . esc_html($mb_pf_title_r) . '</h3></div>';
						}
						echo $featured_post;
					echo '</div>';
				}
			endif;
			if (comments_open() || get_comments_number()) {?>
				<div class="row">
					<div class="wgl_col-12">
						<?php comments_template('', true); ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
			echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : '';
		?>
	</div>
</div>
</div>

<?php

get_footer();

?>