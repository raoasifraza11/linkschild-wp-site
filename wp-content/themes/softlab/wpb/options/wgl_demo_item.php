<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Demo Item', 'softlab'),
        'base' => 'wgl_demo_item',
        'class' => 'softlab_demo_item',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_demo',
        'content_element' => true,
        'description' => esc_html__('Demo Item','softlab'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'softlab'),
                'param_name' => 'di_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'softlab'),
                'param_name' => 'di_subtitle',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'softlab'),
                'param_name' => 'di_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'softlab' ),
            ), 
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Coming Soon', 'softlab' ),
                'param_name' => 'coming_soon',
            ), 
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Button', 'softlab' ),
                'param_name' => 'add_button',
                'dependency' => array(
                    'element' => 'coming_soon',
                    "is_empty" => true
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Title', 'softlab'),
                'param_name' => 'di_button_title',
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'softlab' ),
                'param_name' => 'di_link',
                'description' => esc_html__('Add link to image.', 'softlab'),
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => 'true'
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Demo_Item extends WPBakeryShortCode {
            
        }
    } 
}
