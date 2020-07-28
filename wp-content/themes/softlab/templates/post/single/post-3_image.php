<?php
    $single = Softlab_SinglePost::getInstance();
    $single->set_data();
    $title = get_the_title();

    $show_likes = Softlab_Theme_Helper::get_option('single_likes');
	$single_meta = Softlab_Theme_Helper::get_option('single_meta');
	$single_date =  Softlab_Theme_Helper::get_option('single_meta_date');
	$featured_image = Softlab_Theme_Helper::options_compare('post_hide_featured_image', 'mb_post_hide_featured_image', '1');
	$show_views = Softlab_Theme_Helper::get_option('single_views');
	$single->set_post_views(get_the_ID());

	$meta_args = $meta_args_cats = $meta_args_comments = array();
 
	if ( !(bool)$single_meta ) {
		$meta_args['author'] = !(bool)Softlab_Theme_Helper::get_option('single_meta_author');
		$meta_args['date'] = !(bool)Softlab_Theme_Helper::get_option('single_meta_date');
		$meta_args_comments['comments'] = !(bool)Softlab_Theme_Helper::get_option('single_meta_comments');
		$meta_args_cats['category'] = !(bool)Softlab_Theme_Helper::get_option('single_meta_categories');	
	} 

	$page_title_padding = Softlab_Theme_Helper::options_compare('single_padding_layout_3', 'mb_post_layout_conditional', 'custom');
	$page_title_top = !empty($page_title_padding_top) ? $page_title_padding_top : 200;
	$page_title_padding_top = !empty($page_title_padding['padding-top']) ? (int)$page_title_padding['padding-top'] : '';
	$page_title_padding_bottom = !empty($page_title_padding['padding-bottom']) ? (int)$page_title_padding['padding-bottom'] : '';
	$page_title_styles = '';
	$page_title_styles .= !empty($page_title_padding_top) ?  'padding-top:'.esc_attr((int) $page_title_padding_top).'px;' : '';
	$page_title_styles .= !empty($page_title_padding_bottom) ?  'padding-bottom:'.esc_attr((int) $page_title_padding_bottom).'px;' : '';

	$apply_animation = Softlab_Theme_Helper::options_compare('single_apply_animation', 'mb_post_layout_conditional', 'custom');
	$data_attr_image = $data_attr_content = $blog_skrollr_class = '';

	if(!empty($apply_animation)){
		wp_enqueue_script('skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array(), false, false);

		$data_attr_image = ' data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target=".blog-post-single-item"';

	    $data_attr_content = ' data-center="opacity: 1" data-'.esc_attr($page_title_top).'-top="opacity: 1" data-0-top="opacity: 0" data-anchor-target=".blog-post-single-item .blog-post_content"';	
	    $blog_skrollr_class = ' blog_skrollr_init';	
	}

?>

<div class="blog-post<?php echo esc_attr($blog_skrollr_class);?> blog-post-single-item format-<?php echo esc_attr($single->get_pf());?>"<?php echo !empty($page_title_styles) ? ' style="'.esc_attr($page_title_styles).'"' : ''?>>
	<div <?php post_class("single_meta"); ?>>
		<div class="item_wrapper">
			<div class="blog-post_content" >
				<?php
					if(!(bool) $featured_image){
						$single->render_bg(false, 'full', false, $data_attr_image);
					}
					echo '<div class="wgl-container">';
					echo '<div class="row">';
					echo '<div class="content-container wgl_col-12"'.$data_attr_content.'>'; 
    				
					//Post Meta render cats
					if ( !(bool)$single_meta ) {
						$single->render_post_meta($meta_args_cats);
					}  
				?>
					<h1 class="blog-post_title"><?php echo get_the_title(); ?></h1>
				<?php

					if ( (bool)$show_likes || (bool)$show_views || !empty($meta_args_comments['comments'])) echo '<div class="blog-post_meta-wrap">';
					
					//Post Meta render date, author
					if ( !(bool)$single_meta ) {
						$single->render_post_meta($meta_args);
					}

					if ( (bool)$show_likes || (bool)$show_views  || !empty($meta_args_comments['comments']) ) echo '<div class="blog-post_info-wrap">';
						
					//Post Meta render comments
					if ( !(bool)$single_meta ) {
						$single->render_post_meta($meta_args_comments);
					}  

					// Views in blog
					if ( (bool)$show_views ) : ?>              
						<div class="blog-post_views-wrap">
							<?php
							$single->get_post_views(get_the_ID());
							?>
						</div>
						<?php
					endif;

					if ( (bool)$show_likes ) : ?>
                      <?php
                      echo '<div class="blog-post_likes-wrap">';
                      	if ( (bool)$show_likes && function_exists('wgl_simple_likes')) {
		                	echo wgl_simple_likes()->likes_button( get_the_ID(), 0 );
		                } 
                      echo '</div>';
                    endif;

					
					if ( (bool)$show_likes || (bool)$show_views  || !empty($meta_args_comments['comments']) ): ?> 
                        </div>   
                        </div>   
                    	<?php
                	endif; 

				?>	
					<!-- Close content-container -->
					</div>					

					<!-- Close Row -->
					</div>				

					<!-- Close Container -->
					</div>
			</div>
		</div>
	</div>
</div>