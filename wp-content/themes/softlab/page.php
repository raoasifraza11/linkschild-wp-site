<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Softlab
 * @since 1.0
 * @version 1.0
 */

get_header();
the_post();

$sb = Softlab_Theme_Helper::render_sidebars();
$row_class = $sb['row_class'];
$column = $sb['column'];
?>
<div class="wgl-container">
    <div class="row <?php echo apply_filters('softlab_row_class', $row_class); ?>">
        <div id='main-content' class="wgl_col-<?php echo apply_filters('softlab_column_class', $column); ?>">
        <?php
            the_content(esc_html__('Read more!', 'softlab'));
            wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'softlab') . ': ', 'after' => '</div>'));
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
        </div>
        <?php
            echo (isset($sb['content']) && !empty($sb['content']) ) ? $sb['content'] : '';
        ?>           
    </div>
</div>
<?php
get_footer(); 

?>