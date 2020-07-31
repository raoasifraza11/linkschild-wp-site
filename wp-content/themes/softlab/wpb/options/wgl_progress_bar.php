<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));
$theme_gradient_start = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
    vc_map( array(
        'name' => esc_html__( 'Progress Bar', 'softlab' ),
        'base' => 'wgl_progress_bar',
        'class' => 'softlab_progress_bar',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_progress_bar',
        'content_element' => true,
        'description' => esc_html__( 'Display Progress Bar','softlab' ),
        'params' => array(
            array(
                'type' => 'param_group',
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - defiene label and value.', 'softlab' ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Label', 'softlab' ),
                        'param_name' => 'label',
                        'admin_label' => true,
                        'description' => esc_html__( 'Enter the bar title.', 'softlab' ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Value', 'softlab' ),
                        'param_name' => 'point_value',
                        'description' => esc_html__( 'Enter the bar value.', 'softlab' ),
                        'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                    ),
                    // Customize colors dropdown
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                        'param_name' => 'bar_color_type',
                        'value' => array(
                            esc_html__( 'Theme Defaults', 'softlab' ) => '',
                            esc_html__( 'Flat Colors', 'softlab' ) => 'color',
                            esc_html__( 'Gradient Colors', 'softlab' ) => 'gradient',
                        ),
                        'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                    ),
                    // Bar color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Bar Color', 'softlab' ),
                        'param_name' => 'bar_color',
                        'value' => $theme_color_secondary,
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => 'color'
                        ),
                        'edit_field_class' => 'vc_col-sm-4 clear-left',
                    ),
                    // Bar gradient start color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient Start Color', 'softlab' ),
						'param_name' => 'bar_gradient_start',
						'value' => $theme_gradient_start,
						'dependency' => array(
							'element' => 'bar_color_type',
							'value' => 'gradient'
						),
						'edit_field_class' => 'vc_col-sm-4 clear-left',
					),
					// Bar gradient end color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient End Color', 'softlab' ),
						'param_name' => 'bar_gradient_end',
						'value' => $theme_gradient_end,
						'dependency' => array(
							'element' => 'bar_color_type',
							'value' => 'gradient'
						),
						'edit_field_class' => 'vc_col-sm-4',
					),
					// Bg bar color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Bar Color', 'softlab' ),
                        'param_name' => 'bar_bg_color',
                        'value' => '#f0f3fa',
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                    // Label color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Label Text Color', 'softlab' ),
                        'param_name' => 'label_color',
                        'value' => $header_font_color,
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4 clear-left',
                    ),
                    // Value color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Value Text Color', 'softlab' ),
                        'param_name' => 'value_color',
                        'value' => $header_font_color,
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Units', 'softlab' ),
                'param_name' => 'units',
                'value' => '%',
                'description' => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'softlab' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Progress_Bar extends WPBakeryShortCode {
        }
    }
}
