<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Softlab
 * @since 1.0
 * @version 1.0
 */

get_header();

$sb = Softlab_Theme_Helper::render_sidebars();
$row_class = $sb['row_class'];
$column = $sb['column'];

?>
    <div class="wgl-container">
        <div class="row<?php echo apply_filters('softlab_row_class', $row_class); ?>">
            <div id='main-content' class="wgl_col-<?php echo apply_filters('softlab_column_class', $column); ?>">
            <?php
                if ( have_posts() ) :
                ?>
                    <header class="searh-header">
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'softlab' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>
                    <?php

                    global $wgl_blog_atts;
                    global $wp_query;
                    $wgl_blog_atts = array(
                        'query' => $wp_query,
                        'animation_class' => '',
                        // General
                        'blog_layout' => 'grid',
                        // Content
                        'blog_columns' => '12',
                        'hide_media' => false,
                        'hide_content' => false,
                        'hide_blog_title' => false,
                        'hide_postmeta' => false,
                        'meta_author' => false,
                        'meta_date' => false,
                        'meta_comments' => false,
                        'meta_categories' => true,
                        'hide_likes' => true,
                        'hide_share' => true,
                        'read_more_hide' => false,
                        'read_more_text' => esc_html__('Learn More', 'softlab'),
                        'content_letter_count' => '85',
                        'crop_square_img' => 'true',
                        'heading_tag' => 'h3',
                        'items_load'  => 4,
                        'heading_margin_bottom' => '10px',
                    );
                    get_template_part('templates/post/posts-list');
                    /* Start the Loop */
                    echo Softlab_Theme_Helper::pagination();

                else :
                    ?>
                    <div class="page_404_wrapper">
                        <header class="searh-header-404">
                            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'softlab' ); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php if ( is_search() ) : ?>

                                <p class="banner_404_text"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'softlab' ); ?></p>
                                <div class="search_result_form text-center">
                                <?php
                                    get_search_form();
                                ?>
                                </div>
                                <div class="softlab_404_button softlab_module_button wgl_button wgl_button-x acenter">
                                    <a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><span><?php esc_html_e('Take me home', 'softlab'); ?></span></a>
                                </div>
                            <?php
                            else :
                            ?>
                                <p class="banner_404_text"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'softlab' ); ?></p>
                                <div class="search_result_form text-center">
                                <?php
                                    get_search_form();
                                ?>
                                </div>
                                <div class="softlab_404_button softlab_module_button wgl_button wgl_button-x acenter">
                                    <a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><span><?php esc_html_e('Take me home', 'softlab'); ?></span></a>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php

                endif;
                ?>          
            </div>
            <?php
                echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : '';
            ?>
        </div>

    </div>

<?php

get_footer(); ?>