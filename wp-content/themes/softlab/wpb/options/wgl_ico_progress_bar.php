<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Ico Progress Bar', 'softlab'),
        'base' => 'wgl_ico_progress_bar',
        'class' => 'softlab_ico_progress_bar',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_ico-mod',
        'content_element' => true,
        'description' => esc_html__('Display Ico Progress Bar','softlab'),
        'params' => array(
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Min Value', 'softlab' ),
                "param_name"    => "min_value",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Min Value Label', 'softlab' ),
                "param_name"    => "min_value_label",
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value', 'softlab' ),
                "param_name"    => "max_value",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value Label', 'softlab' ),
                "param_name"    => "max_value_label",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed', 'softlab' ),
                "param_name"    => "completed",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed Label', 'softlab' ),
                "param_name"    => "completed_label",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Units', 'softlab' ),
                "param_name"    => "units",
                "value"    => "$",
                "description"   => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'softlab' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Ico Progress Bar Width', 'softlab' ),
                "param_name"    => "max_width",
                "description"   => esc_html__( 'Enter max width in pixels', 'softlab' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
            // Ico Progress Bar Points
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Ico Progress Bar Points', 'softlab'),
                'param_name' => 'h_bar_points',
                'group' => esc_html__( 'Points', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - point label and point value.', 'softlab' ),
                'group' => esc_html__( 'Points', 'softlab' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'point_label' => esc_html__( 'Soft Cap', 'softlab' ),
                        'point_value' => '25',
                    ),
                    array(
                        'point_label' => esc_html__( 'Hard Cap', 'softlab' ),
                        'point_value' => '75',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Label', 'softlab' ),
                        "param_name"    => "point_label",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Value', 'softlab' ),
                        "param_name"    => "point_value",
                        "description"    => esc_html__( 'Enter value in percentage', 'softlab' ),
                    ),
                ),
            ),
            // Colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Bar Colors', 'softlab'),
                'param_name' => 'h_bar_colors',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Bar Colors', 'softlab' ),
                'param_name' => 'custom_bar_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bacground Color', 'softlab'),
                'param_name' => 'bg_color',
                'value' => '#ecf1f9',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Comleted Color', 'softlab'),
                'param_name' => 'completed_color',
                'value' => $theme_color,
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Text Colors', 'softlab'),
                'param_name' => 'h_text_colors',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Text Color', 'softlab' ),
                'param_name' => 'custom_text_color',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Values Color', 'softlab'),
                'param_name' => 'value_color',
                'value' => '#8b9baf',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Labels Color', 'softlab'),
                'param_name' => 'label_color',
                'value' => '#8b9baf',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Completed Color', 'softlab'),
                'param_name' => 'completed_text_color',
                'value' => '#ffffff',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Ico_Progress_Bar extends WPBakeryShortCode {
        }
    }
}
