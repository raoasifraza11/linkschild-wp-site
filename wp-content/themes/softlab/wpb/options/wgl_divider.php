<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Divider', 'softlab'),
        'base' => 'wgl_divider',
        'class' => 'softlab_divider',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_divider', // need to change
        'content_element' => true,
        'description' => esc_html__('Divider', 'softlab'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Width', 'softlab'),
                'param_name' => 'width',
                'description' => esc_html__('Enter value.', 'softlab'),
                'value' => '100',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Width Units', 'softlab' ),
                'param_name' => 'width_units',
                'value' => array(
                    esc_html__( 'Pixels', 'softlab' )      => 'px',
                    esc_html__( 'Percentages', 'softlab' ) => '%',
                ),
                'std' => '%',
                'description' => esc_html__('Select value units.', 'softlab'),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height', 'softlab'),
                'param_name' => 'height',
                'description' => esc_html__('Enter value in pixels.', 'softlab'),
                'value' => '1px',
                'save_always' => true,
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'softlab' ),
                'param_name' => 'divider_alignment',
                'value' => array(
                    esc_html__( 'Left', 'softlab' )   => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' )  => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Divider Color', 'softlab' ),
                'param_name' => 'divider_color',
                'value' => '#e7e8e8',
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // EXTRA LINE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Extra Line', 'softlab' ),
                'param_name' => 'add_divider_line',
                'description' => esc_html__( 'Short line above Divider.', 'softlab' ),
                'group' => esc_html__( 'Extra Line', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Extra Line Alignment', 'softlab' ),
                'param_name' => 'divider_line_alignment',
                'value' => array(
                    esc_html__( 'Left', 'softlab' )   => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' )  => 'right',
                ),
                'dependency' => array(
                    'element' => 'add_divider_line',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Extra Line', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Extra Line Color', 'softlab' ),
                'param_name' => 'divider_line_color',
                'value' => $theme_color,
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider_line',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Extra Line', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_divider extends WPBakeryShortCode {}
    }
}