<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Image Layers', 'softlab'),
        'base' => 'wgl_image_layers',
        'class' => 'softlab_image_layers',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_image_layers',
        'content_element' => true,
        'description' => esc_html__('Display Image Layers','softlab'),
        'params' => array(
            // image styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Layers Settings', 'softlab'),
                'param_name' => 'h_settings',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'softlab' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph', 'softlab' ),
                'params' => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Thumbnail', 'softlab' ),
                        'param_name'    => 'thumbnail',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Top Offset', 'softlab' ),
                        'param_name'    => 'top_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'softlab' ),
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Left Offset', 'softlab' ),
                        'param_name'    => 'left_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'softlab' ),
                    ),          
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Image Animation', 'softlab' ),
                        'param_name'    => 'image_animation',
                        'edit_field_class' => 'vc_col-sm-6',
                        'value'         => array(
                            esc_html__( 'Fade In', 'softlab' )      => 'fade_in',
                            esc_html__( 'Slide Up', 'softlab' )      => 'slide_up',
                            esc_html__( 'Slide Down', 'softlab' )     => 'slide_down',
                            esc_html__( 'Slide Left', 'softlab' )     => 'slide_left',
                            esc_html__( 'Slide Right', 'softlab' )     => 'slide_right',
                            esc_html__( 'Slide Big Up', 'softlab' )      => 'slide_big_up',
                            esc_html__( 'Slide Big Down', 'softlab' )     => 'slide_big_down',
                            esc_html__( 'Slide Big Left', 'softlab' )     => 'slide_big_left',
                            esc_html__( 'Slide Big Right', 'softlab' )     => 'slide_big_right',
                            esc_html__( 'Slide Big Right', 'softlab' )     => 'slide_big_right',
                            esc_html__( 'Flip Horizontally', 'softlab' )     => 'flip_x',
                            esc_html__( 'Flip Vertically', 'softlab' )     => 'flip_y',
                            esc_html__( 'Zoom In', 'softlab' )     => 'zoom_in',
                        ),
                    ),         
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Image z-index', 'softlab' ),
                        'param_name'    => 'image_order',
                        'value'         => '1',
                        'edit_field_class' => 'vc_col-sm-6',
                    ),  
                ),
            ),
            // images interval
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Interval Images Appearing', 'softlab'),
                'param_name' => 'interval',
                'value' => '600',
                'description' => esc_html__( 'Enter interval in milliseconds', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Transition Speed', 'softlab'),
                'param_name' => 'transition',
                'value' => '800',
                'description' => esc_html__( 'Enter transition speed in milliseconds', 'softlab' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'softlab' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'softlab')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Image_Layers extends WPBakeryShortCode {
        }
    }
}
