<?php
/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'wgl_posts_load_widgets' );

function wgl_posts_load_widgets()
{
    register_widget('WGL_Posts_Widget');
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class WGL_Posts_Widget extends WP_Widget {

    /**
     * Widget setup.
     */
    function __construct() {
        /* Widget settings. */
        $widget_ops = array('classname' => 'widget_wgl_posts', 'description' => esc_html__( 'Display recent posts by categories (or related)' , 'softlab-core' ) );

        /* Create the widget. */
        parent::__construct( 'wgl-posts', esc_html__( 'WGL Posts', 'softlab-core' ), $widget_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );
        
        global $wpdb;
        $time_id = rand();

        /* Our variables from the widget settings. */
        $title = $instance['title'];
        $num_posts = $instance['num_posts'];
        $categories = $instance['categories'];
        $show_image = isset($instance['show_image']) && !empty($instance['show_image']) ? 'true' : 'false';
        $show_related = isset($instance['show_related']) && !empty($instance['show_related']) ? 'true' : 'false';
        $show_content = isset($instance['show_content']) && !empty($instance['show_content']) ? 'true' : 'false';
        $show_date = isset($instance['show_date']) && !empty($instance['show_date']) ? 'true' : 'false';

        /* Before widget (defined by themes). */
        echo Softlab_Theme_Helper::render_html($before_widget);

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title ){
            echo Softlab_Theme_Helper::render_html($before_title);
            echo esc_attr($instance['title']);
            echo Softlab_Theme_Helper::render_html($after_title);
        }
        ?>
            
        <?php 
            global $post;

            if ( $show_related == 'true' ) { //show related category
                $related_category = get_the_category($post->ID);
                if(isset($related_category[0]->cat_name)){
                    $related_category_id = get_cat_ID( $related_category[0]->cat_name ); 
                }else{
                    $related_category_id = '';  
                }
                           
                $recent_posts = new WP_Query(array(
                    'showposts'             => $num_posts,
                    'cat'                   => $related_category_id, 
                    'post__not_in'          => array( $post->ID ),
                    'ignore_sticky_posts'   => 1
                ));
            }
            else {
                $recent_posts = new WP_Query(array(
                    'showposts'             => $num_posts,
                    'cat'                   => $categories,
                    'ignore_sticky_posts'   => 1
                ));
            }
        ?>

    <?php if ($recent_posts->have_posts()) : ?>
        <ul class="recent-posts-widget recent-widget-<?php echo esc_attr($time_id); ?>">
            <?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                <?php
                    $img_render = false;
                    if( $show_image == 'true' ):
                        if(has_post_thumbnail()):
                            $img_render = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                        endif; //has_post_thumbnail
                    endif; //show_image 

                    if ( $show_content == 'true' ) {

                        if (has_excerpt()) {
                            $post_excerpt = get_the_excerpt();
                        } else {
                            $post_excerpt = get_the_content();
                        }

                        $post_excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_excerpt);
                        $without_tags = strip_tags($post_excerpt);
                        $text = Softlab_Theme_Helper::modifier_character($without_tags, 50, "...");
                    }else{
                        $text = '';
                    }
                ?>

                <li class="clearfix<?php echo ((!empty($img_render)) ? ' with_image' : '') ?>">
                    <div class="recent-posts-content">
                        <?php
                            if(!empty($img_render)){
                                echo '<div class="recent-posts-image_wrapper"><a href="' . esc_url(get_permalink()) . '"><img src="' . esc_url(aq_resize($img_render[0], "150", "150", true, true, true)) . '" alt="' . the_title_attribute(array( 'before' => '', 'after' =>  '', 'echo' => false)) . '"></a></div>';
                            }
                        ?>
                        <div class="recent-posts-content_wrapper">
                            <div class="post_title">
                                <a href='<?php esc_url(the_permalink()); ?>' title='<?php esc_attr_e('Permalink to ','softlab-core'); the_title_attribute(); ?>'><?php echo esc_html(the_title($before = '', $after = '', $echo = false)); ?></a>                    
                            </div><!-- post-title -->
                            <?php if ( ( $show_date == 'true' ) ) : ?>
                                <div class="meta-wrapper">                         
                                    <span><?php
                                        echo get_the_time(get_option( 'date_format' ));
                                    ?></span>                                  
                                </div> <!-- /entry-widget-date -->  
                            <?php endif; ?>
                            <?php if ( ( $show_content == 'true' ) ) : ?>
                                <div class="recent-post-content"><?php
                                    echo esc_html($text)
                                ?></div>
                            <?php endif; ?>   
                        </div>
                    </div>
                </li>   
            <?php endwhile; ?>
        </ul>
    <?php else : esc_html_e('No posts were found for display','softlab-core');
    endif; ?>

        <?php
        /* After widget (defined by themes). */
        echo Softlab_Theme_Helper::render_html($after_widget);

        // Restor original Query & Post Data
        wp_reset_query();
        wp_reset_postdata();        
        }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = isset($new_instance['title']) ? strip_tags( $new_instance['title'] ) : '';
        $instance['num_posts'] = isset($new_instance['num_posts']) ? $new_instance['num_posts'] : '';
        $instance['categories'] = isset($new_instance['categories']) ? $new_instance['categories'] : '';
        $instance['show_image'] = isset($new_instance['show_image']) ? $new_instance['show_image'] : '';
        $instance['show_related'] = isset($new_instance['show_related']) ? $new_instance['show_related'] : '';
        $instance['show_content'] = isset($new_instance['show_content']) ? $new_instance['show_content'] : '';
        $instance['show_date'] = isset($new_instance['show_date']) ? $new_instance['show_date'] : '';
    
        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     */
    function form($instance)
    {
        /* Set up some default widget settings. */
        $defaults = array(
            'title'         => esc_html__( 'Recent Posts' , 'softlab-core' ),
            'num_posts'     => 4,
            'categories'    => 'all',
            'show_related'  => 'off',
            'show_image'    => 'on', 
            'show_date'     => 'on',
            'show_content'  => 'off'
        );

        $instance = wp_parse_args((array) $instance, $defaults); ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:' , 'softlab-core' ) ?></label>
            <input class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num_posts')); ?>"><?php esc_html_e( 'Number of posts:' , 'softlab-core' ); ?></label>
            <input type="number" min="1" max="100" class="widefat" id="<?php echo esc_attr($this->get_field_id('num_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('num_posts')); ?>" value="<?php echo esc_attr($instance['num_posts']); ?>" />
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_related')); ?>" name="<?php echo esc_attr($this->get_field_name('show_related')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('show_related')); ?>"><?php esc_html_e( 'Show related category posts' , 'softlab-core' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_image')); ?>" name="<?php echo esc_attr($this->get_field_name('show_image')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>"><?php esc_html_e( 'Show thumbnail image' , 'softlab-core' ); ?></label>
        </p>

        <p style="margin-top: 20px;">
            <label style="font-weight: bold;"><?php esc_html_e( 'Post meta info' , 'softlab-core' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e( 'Show date' , 'softlab-core' ); ?></label>
        </p>        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_content'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_content')); ?>" name="<?php echo esc_attr($this->get_field_name('show_content')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('show_content')); ?>"><?php esc_html_e( 'Show content' , 'softlab-core' ); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e( 'Filter by Category:' , 'softlab-core' ); ?></label> 
            <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
                <option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>><?php esc_html_e( 'All categories' , 'softlab-core' );?></option>
                <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
                <?php foreach( $categories as $category ) { ?>
                <option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>
    <?php 
    }
}

?>