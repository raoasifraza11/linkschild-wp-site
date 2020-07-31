<?php

class Banner extends WP_Widget
{
private $isMultilingual = FALSE; //Is this site multilingual?
    
    function __construct() 
    {
        parent::__construct(
            'combined_image_banner_widget', // Base ID
            esc_html__( 'WGL Banner', 'softlab-core' ), // Name
            array( 'description' => esc_html__( 'WGL Widget', 'softlab-core' ), ) // Args
        );

        //If WPML is active and was setup to have more than one language this website is multilingual.
        
        if ( is_admin() === TRUE ) {
            add_action('admin_enqueue_scripts', array($this, 'enqueue_backend_scripts') );
        }
    }


    public function enqueue_backend_scripts()
    {
        wp_enqueue_media(); //Enable the WP media uploader
        wp_enqueue_script('softlab-upload-img', get_template_directory_uri() . '/core/admin/js/img_upload.js', array('jquery'), false, true);
    }
    

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) 
    {
        
        $title_name = 'title';
        $text_name = 'text';
        $show_tags = 'show_tags';
        
        $padding_top_value = 'padding_top_value';
        $padding_bottom_value = 'padding_bottom_value';
        
        $image_name = 'image';

        $image_name_2 = 'image_2';

        $attachment_id = attachment_url_to_postid ($instance[$image_name]);
        $alt = '';
        // if no alt attribute is filled out then echo "Featured Image of article: Article Name"
        if ('' === get_post_meta($attachment_id, '_wp_attachment_image_alt', true)) {
            $alt = the_title_attribute(array('before' => esc_html__('Featured image: ', 'softlab-core'), 'echo' => false));
        } else {
            $alt = trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
        }

        $widgetImg = ( (isset($instance[$image_name])) && (!empty($instance[$image_name])) )? '<img class="banner-widget_img" src="' . esc_url($instance[$image_name]) . '" alt="'.esc_attr($alt).'">':'';
        $widgetImg_2 = ( (isset($instance[$image_name_2])) && (!empty($instance[$image_name_2])) )? 'background-image: url('.$instance[$image_name_2].');' : '';
        
        $title = ( (isset($instance[$title_name])) && (!empty($instance[$title_name])) )? $instance[$title_name]:FALSE; 
        $text = ( (isset($instance[$text_name])) && (!empty($instance[$text_name])) )? $instance[$text_name] : '';
        $show_tags_value = ( (isset($instance[$show_tags])) && (!empty($instance[$show_tags])) )? $instance[$show_tags] : '';
        
        $padding_top = isset($instance[$padding_top_value]) && $instance[$padding_top_value] !== '' ? 'padding-top: ' . (int) $instance[$padding_top_value]. 'px;' : '';
        $padding_bottom = isset($instance[$padding_bottom_value]) && $instance[$padding_bottom_value] !== ''  ? 'padding-bottom: '. (int) $instance[$padding_bottom_value]. 'px;' : '';

        $widgetImg_2 .= $padding_top. $padding_bottom;
         
        $text_sub_title = ( (isset($instance['text_sub_title'])) && (!empty($instance['text_sub_title'])) )? $instance['text_sub_title'] : '';
        $button_link = ( (isset( $instance['button_link'])) && (!empty($instance['button_link'])) )? $instance['button_link'] : '';
        
        $widgetClasses = 'softlab_banner-widget';
        $widgetClasses.= ' widget softlab_widget';
        $widgetClasses .= empty($widgetImg) ? ' without_logotype' : '';
        $html = '<div class="' . esc_attr($widgetClasses) . '" style="'.esc_attr($widgetImg_2).'">';
            if(!empty($widgetImg)){
               $html .= '<div class="banner-widget_img-wrapper">' . $widgetImg . '</div>'; 
            }
            
            if ( !empty($text_sub_title) ) $html .= '<p class="banner-widget_text_sub">' . Softlab_Theme_Helper::render_html($text_sub_title) . '</p>';
            if ( !empty($text) ){
              $html .= '<h2 class="banner-widget_text">' . Softlab_Theme_Helper::render_html($text);
              if(!empty($show_tags_value)){
                $html .= '<span class="tags_title"></span>';
              }
              $html .= '</h2>';
            } 

            if ( !empty($button_link) && !empty($title) ) $html.= '<a class="banner-widget_button" href="'.esc_url($button_link).'"><span>'. esc_html($title).'</span></a>';

        $html.= '</div>';

        echo Softlab_Theme_Helper::render_html($html);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array(
            'show_tags'     => 'on',
            'padding_top_value'     => '54',
            'padding_bottom_value'     => '200',
        );

        $instance = wp_parse_args((array) $instance, $defaults);

        $title_name = 'title';
        $title = ( (isset($instance[$title_name])) && (!empty( $instance[$title_name])) )? $instance[$title_name] : '';        

        $padding_top = 'padding_top_value';
        $padding_top_value = isset($instance[$padding_top]) && $instance[$padding_top] !== '' ? $instance[$padding_top] : '';        

        $padding_bottom = 'padding_bottom_value';
        $padding_bottom_value = isset($instance[$padding_bottom]) &&  $instance[$padding_bottom] !== ''  ? $instance[$padding_bottom] : '';        

        $show_tags = 'show_tags';
        $show_tags_value = isset($instance[$show_tags]) &&  !empty($instance[$show_tags])  ? $instance[$show_tags] : '';
        
        $text_name = 'text';
        $text = ( (isset($instance[$text_name])) && (!empty($instance[$text_name])) )? $instance[$text_name] : '';       
        
        $text_sub_title = 'text_sub_title';
        $text_sub = ( (isset($instance[$text_sub_title])) && (!empty($instance[$text_sub_title])) )? $instance[$text_sub_title] : '';

        $image_name = 'image';
        $image = ( (isset($instance[$image_name])) && (!empty($instance[$image_name])) )? $instance[$image_name] : '';

        $image_name_2 = 'image_2';
        $image_2 = ( (isset($instance[$image_name_2])) && (!empty($instance[$image_name_2])) )? $instance[$image_name_2] : '';

        $button_link = ( (isset( $instance['button_link'])) && (!empty($instance['button_link'])) )? $instance['button_link'] : '';



        ?>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id($image_name) ); ?>"><?php echo esc_html__('Add Logotype image:', 'softlab-core')?></label><br />
            <img class="softlab_media_image" src="<?php if(!empty($instance[$image_name])){echo esc_url( $instance[$image_name] );} ?>" style="max-width: 100%" />
            <input type="text" class="widefat softlab_media_url" name="<?php echo esc_attr( $this->get_field_name($image_name) ); ?>" id="<?php echo esc_attr( $this->get_field_id($image_name) ); ?>" value="<?php echo esc_attr( $image ); ?>">
            <a href="#" class="button softlab_media_upload"><?php esc_html_e('Upload', 'softlab-core'); ?></a>
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id($image_name_2) ); ?>"><?php echo esc_html__('Add background image:', 'softlab-core')?></label><br />
            <img class="softlab_media_image" src="<?php if(!empty($instance[$image_name_2])){echo esc_url( $instance[$image_name_2] );} ?>" style="max-width: 100%" />
            <input type="text" class="widefat softlab_media_url" name="<?php echo esc_attr( $this->get_field_name($image_name_2) ); ?>" id="<?php echo esc_attr( $this->get_field_id($image_name_2) ); ?>" value="<?php echo esc_attr( $image_2 ); ?>">
            <a href="#" class="button softlab_media_upload"><?php esc_html_e('Upload', 'softlab-core'); ?></a>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $padding_top ) ); ?>"><?php echo esc_html__('Padding Top: ', 'softlab-core')?></label> 
            <input class="widefat" id="<?php echo esc_attr(  $this->get_field_id( $padding_top ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $padding_top ) ); ?>" type="number" value="<?php echo esc_attr( $padding_top_value ); ?>">
        </p>        

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $padding_bottom ) ); ?>"><?php echo esc_html__('Padding Bottom: ', 'softlab-core')?></label> 
            <input class="widefat" id="<?php echo esc_attr(  $this->get_field_id( $padding_bottom ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $padding_bottom ) ); ?>" type="number" value="<?php echo esc_attr( $padding_bottom_value ); ?>">
        </p> 

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $text_sub_title ) ); ?>"><?php echo esc_html__('Sub Title:', 'softlab-core')?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $text_sub_title ) ); ?>" name="<?php echo esc_attr(  $this->get_field_name( $text_sub_title ) ); ?>" row="2"><?php echo Softlab_Theme_Helper::render_html($text_sub); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $text_name ) ); ?>"><?php echo esc_html__('Title:', 'softlab-core')?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $text_name ) ); ?>" name="<?php echo esc_attr(  $this->get_field_name( $text_name ) ); ?>" row="2"><?php echo Softlab_Theme_Helper::render_html($text); ?></textarea>
        </p>    

        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_tags_value, 'on'); ?> id="<?php echo esc_attr($this->get_field_id($show_tags)); ?>" name="<?php echo esc_attr($this->get_field_name('show_tags')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id('show_tags')); ?>"><?php esc_html_e( 'Show Title Tags' , 'softlab-core' ); ?></label>
        </p>           

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $title_name ) ); ?>"><?php echo esc_html__('Button title:', 'softlab-core')?></label> 
            <input class="widefat" id="<?php echo esc_attr(  $this->get_field_id( $title_name ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $title_name ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_html_e( 'Button link:', 'softlab-core' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>">
        </p>
        <?php

    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) 
    {
        $new_instance['show_tags'] = $new_instance['show_tags'];
        $new_instance['padding_top_value'] = $new_instance['padding_top_value'];
        $new_instance['padding_bottom_value'] = $new_instance['padding_bottom_value'];
        return $new_instance;
    }
}

function banner_register_widgets() {
    register_widget('banner');
}

add_action('widgets_init', 'banner_register_widgets');

?>