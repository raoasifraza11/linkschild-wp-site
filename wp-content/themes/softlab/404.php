<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Softlab
 * @since 1.0
 * @version 1.0
 */
get_header();?>
	<div class="wgl-container">
		<div class="row">
			<div class="wgl_col-12">
				<section class="page_404_wrapper">
					<div class="banner_404"><img src="<?php echo esc_url(get_template_directory_uri() . "/img/404.png"); ?>" alt="<?php echo esc_attr__('404','softlab'); ?>"></div>
					<h2 class="banner_404_title"><?php 
						echo esc_html__('Sorry We Can\'t Find That Page!', 'softlab'); 
					?></h2>
					<p class="banner_404_text"><?php echo esc_html__('The page you are looking for was moved, removed, renamed or never existed.', 'softlab'); ?></p>
					<div class="softlab_404_search">
						<?php get_search_form(); ?>
					</div>
					<div class="softlab_404_button softlab_module_button wgl_button wgl_button-m acenter">
						<a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><span><?php esc_html_e('Back to home', 'softlab'); ?></span></a>
					</div>
				</section>
			</div>
		</div>
	</div>
<?php get_footer(); ?>