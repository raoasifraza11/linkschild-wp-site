<?php

$theme_gradient = Softlab_Theme_Helper::get_option( 'theme-gradient' );

if (function_exists( 'vc_map' )) {
    vc_map(array(		
        'base' => 'wgl_ico_progress',
        'name' => esc_html__( 'Ico Progress', 'softlab' ),
		'class' => 'softlab_ico_progress_module',
        'description' => esc_html__( 'Display Ico Progress Module', 'softlab' ),
        'as_parent' => array( 'only' => 'wgl_countdown, wgl_button, vc_column_text, wgl_custom_text, vc_single_image, vc_row , wgl_ico_progress_bar, wgl_spacing' ),
		'content_element' => true,		
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_ico-mod',
		'show_settings_on_create' => true,
		'is_container' => true,
        'params' => array(
            // Module offsets
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Module Offsets', 'softlab' ),
                'param_name' => 'heading',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'softlab' ),
                'param_name' => 'ico_top_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'softlab' ),
                'param_name' => 'ico_right_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'softlab' ),
                'param_name' => 'ico_bottom_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'softlab' ),
                'param_name' => 'ico_left_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Background Colors', 'softlab' ),
                'param_name' => 'h_bg_bg_colors',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'softlab' ) => 'def',
                    esc_html__( 'Flat Colors', 'softlab' ) => 'color',
                    esc_html__( 'Gradient Colors', 'softlab' ) => 'gradient',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),  
            // Bg color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'softlab' ),
                'param_name' => 'bg_color',
                'value' => 'rgba(0,0,32,0.7)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient Start', 'softlab' ),
                'param_name' => 'bg_gradient_start',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Bg gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient End', 'softlab' ),
                'param_name' => 'bg_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists( 'WPBakeryShortCodesContainer' )) {
        class WPBakeryShortCode_wgl_Ico_Progress extends WPBakeryShortCodesContainer
        {
        }
    }
}