<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$main_font = Softlab_Theme_Helper::get_option('main-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'WGL Text Module', 'softlab' ),
        'base' => 'wgl_custom_text',
        'class' => 'softlab_custom_text',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_custom_text',
        'content_element' => true,
        'description' => esc_html__( 'Text with responsive settings','softlab' ),
        'params' => array(
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => esc_html__( 'Content.', 'softlab' ) ,
                'param_name' => 'content',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'softlab' ),
                'param_name' => 'font_size',
                'value' => (int)$main_font['font-size'],
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Styling', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'softlab' ),
                'param_name' => 'line_height',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Styling', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'softlab' ),
                'param_name' => 'custom_fonts',
                'group' => esc_html__( 'Styling', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'softlab' ),
            ),
            // Responsive settings
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Responsive settings', 'softlab' ),
                'param_name' => 'h_responsive_elements',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktops
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Desktop', 'softlab' ),
                'param_name' => 'responsive_font_desktop',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array( 
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'softlab' ),
                'param_name' => 'font_size_desktop',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_desktop',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'softlab' ),
                'param_name' => 'line_height_desktop',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_desktop',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'h_responsive_elements_talet',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Tablet
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Tablet', 'softlab' ),
                'param_name' => 'responsive_font_tablet',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'softlab' ),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_tablet',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'softlab' ),
                'param_name' => 'line_height_tablet',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_tablet',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'h_responsive_elements_mobile',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Mobile
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Mobile', 'softlab' ),
                'param_name' => 'responsive_font_mobile',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'softlab' ),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_mobile',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'softlab' ),
                'param_name' => 'line_height_mobile',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font_mobile',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),              
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_custom_text extends WPBakeryShortCode {
            
        }
    } 
}
