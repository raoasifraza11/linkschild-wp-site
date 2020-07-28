<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Softlab
 * @since 1.0
 * @version 1.0
 */
 
get_header();
the_post();

$sb = Softlab_Theme_Helper::render_sidebars('single');


$single_type = Softlab_Theme_Helper::get_option('single_type_layout'); 
if(empty($single_type)){
	$single_type = 2;
}

if (class_exists( 'RWMB_Loader' )) {
	$mb_type = rwmb_meta('mb_post_layout_conditional');
	if(!empty($mb_type) && $mb_type != 'default' ){
		$single_type = rwmb_meta('mb_single_type_layout');
	}
}

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

$column = $sb['column'];
$row_class = $sb['row_class'];
$layout = $sb['layout'];

$row_class .= ' single_type-'.$single_type;

if($single_type === '3'){
	echo '<div class="post_featured_bg">';
		get_template_part('templates/post/single/post', $single_type.'_image');
	echo '</div>';
}
?>

<div class="wgl-container">
        <div class="row<?php echo apply_filters('softlab_row_class', $row_class); ?>">
			<div id='main-content' class="wgl_col-<?php echo apply_filters('softlab_column_class', $column); ?>">
				<?php
					get_template_part('templates/post/single/post', $single_type);

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

				$show_post_related = Softlab_Theme_Helper::get_option('single_related_posts');
				if ( (bool)$show_post_related && class_exists('Vc_Manager')) : ?>
					<?php

					$mb_blog_show_r = $mb_blog_carousel_r = $mb_blog_column_r = $mb_blog_number_r = $mb_blog_title_r ='';
					$mb_blog_cat_r = array();

					if (class_exists( 'RWMB_Loader' )) {
						$mb_blog_carousel_r 	  = rwmb_meta('mb_blog_carousel_r');
						$mb_blog_show_r 	  	  = rwmb_meta('mb_blog_show_r');
						$mb_blog_title_r 	  	  = rwmb_meta('mb_blog_title_r');
						$mb_blog_cat_r   		  = get_post_meta(get_the_id(), 'mb_blog_cat_r'); // store terms’ IDs in the post meta and doesn’t set post terms.
						$mb_blog_column_r 	  = rwmb_meta('mb_blog_column_r');
						
						$mb_blog_number_r 	  = rwmb_meta('mb_blog_number_r');
						$mb_blog_number_r 	  = !empty($mb_blog_number_r) ? $mb_blog_number_r : (($layout == "none") ? "3" : "2");
					}		    
					if ($mb_blog_show_r == "1" && class_exists('Vc_Manager')) {
					?>

					<div class='single related_posts'>
					<?php
						// Related Posts
						// Get Cats_Slug
						$categories = $post_category_compile = '';
						if (get_the_category()) $categories = get_the_category();
						
						if ($categories) {
							$post_categ = '';
							foreach ($categories as $category) {
								$post_categ = $post_categ . $category->slug . ',';
							}
							$post_category_compile .= '' . trim($post_categ, ',') . '';
							
							if(!empty($mb_blog_cat_r[0])){
								$categories = get_categories( array( 'include' => $mb_blog_cat_r[0]  ) ); 
								$post_categ = $post_category_compile = '';
								foreach ($categories as $category) {
									$post_categ = $post_categ . $category->slug . ',';
								}
								$post_category_compile .= '' . trim($post_categ, ',') . '';
							}

							$mb_blog_cat_r = $post_category_compile;
						}
						echo '<div class="softlab_module_title"><h3>'.(!empty($mb_blog_title_r) ? esc_html($mb_blog_title_r) : esc_html__('Related Posts', 'softlab')) .' </h3></div>';
						echo do_shortcode('[wgl_blog_posts_standard 
							blog_layout="'.(!empty($mb_blog_carousel_r) ? 'carousel' : 'grid').'"
							use_navigation=""
							hide_share="true"
							hide_content="true"
							heading_tag="h5"
							blog_border_style="solid"
							blog_border_width="1px"
							blog_border_color="#eeeeee"
							heading_font_size="24" 
							heading_line_height="36"
							heading_margin_bottom="11"
							content_font_size="14"
							content_line_height="24"
							content_letter_count="90"
							crop_square_img="1"
							custom_fonts_blog_size_headings="true" 
							custom_fonts_blog_size_content="true"
							pag_type="circle"
							blog_columns="' . (!empty($mb_blog_column_r) ? $mb_blog_column_r : (($layout == "none") ? "4" : "6") ).'"
							number_of_posts="'.$mb_blog_number_r.'"
							categories="'.$mb_blog_cat_r.'"
							order_by="rand"
							custom_resp="true"
						    resp_mobile = "600"
						    resp_mobile_slides "1"
							]');?>
					</div>
					<?php
					}
				endif;
				if (comments_open() || get_comments_number()) {?>
					<div class="row">
						<div class="wgl_col-12">
							<?php comments_template(); ?>
						</div>
					</div>
				<?php } ?>
			</div>	
			<?php
				echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : '';
			?>
		</div>

</div>

<?php
	get_footer();
?>