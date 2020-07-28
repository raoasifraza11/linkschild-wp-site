<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Clients', 'softlab'),
        'base' => 'wgl_clients',
        'class' => 'softlab_clients',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_clients',
        'content_element' => true,
        'description' => esc_html__('Display Clients','softlab'),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'softlab' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for each item - thumbnail(s) and link.', 'softlab' ),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Thumbnail', 'softlab' ),
                        'param_name' => 'thumbnail',
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Hover Thumbnail', 'softlab' ),
                        'param_name' => 'hover_thumbnail',
                        'description' => esc_html__( 'Need for \'Exchange Images\' and \'Shadow\' animations only.', 'softlab' ),
                        'edit_field_class' => 'vc_col-sm-6 no-top-padding',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Add Link', 'softlab' ),
                        'param_name' => 'add_link',
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link', 'softlab' ),
                        'param_name' => 'link',
                        'description' => esc_html__( 'Add link to client image.', 'softlab' ),
                        'dependency'    => array(
                            'element'   => 'add_link',
                            'value' => 'true'
                        ),
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grid Columns Amount', 'softlab' ),
                'param_name' => 'item_grid',
                'value' => array(
                    esc_html__( 'One Column', 'softlab' ) => '1',
                    esc_html__( 'Two Columns', 'softlab' ) => '2',
                    esc_html__( 'Three Columns', 'softlab' ) => '3',
                    esc_html__( 'Four Columns', 'softlab' ) => '4',
                    esc_html__( 'Five Columns', 'softlab' ) => '5',
                    esc_html__( 'Six Columns', 'softlab' ) => '6',
                ),
                'std' => '4',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Animation for each Thumbnail Image', 'softlab' ),
                'param_name' => 'item_anim',
                'value' => array(
                    esc_html__( 'Shadow', 'softlab' ) => 'shadow',
                    esc_html__( 'Zoom', 'softlab' ) => 'zoom',
                    esc_html__( 'Opacity', 'softlab' ) => 'opacity',
                    esc_html__( 'Grayscale', 'softlab' ) => 'grayscale',
                    esc_html__( 'Contrast', 'softlab' ) => 'contrast',
                    esc_html__( 'Blur', 'softlab' ) => 'blur',
                    esc_html__( 'Invert', 'softlab' ) => 'invert',
                    esc_html__( 'Exchange Images', 'softlab' ) => 'ex_images',
                ),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
            // CAROUSEl TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'softlab' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'softlab' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay Speed', 'softlab' ),
                'param_name' => 'autoplay_speed',
                'value' => '3000',
                'description' => esc_html__( 'Enter value in milliseconds.', 'softlab' ),
                'dependency' => array(
                    'element' => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'softlab' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            // Desktop resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Resolution', 'softlab' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_1',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Tablets resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Resolution', 'softlab' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_2',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Resolution', 'softlab' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Clients extends WPBakeryShortCode {
        }
    }
}
