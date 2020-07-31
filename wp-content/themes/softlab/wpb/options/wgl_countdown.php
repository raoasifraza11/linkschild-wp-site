<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$main_font = Softlab_Theme_Helper::get_option( 'main-font' );
$theme_color = esc_attr(Softlab_Theme_Helper::get_option( 'theme-custom-color' ));
$header_font = Softlab_Theme_Helper::get_option( 'header-font' );

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Countdown Timer', 'softlab' ),
        'base' => 'wgl_countdown',
        'class' => 'softlab_countdown',
        'content_element' => true,
        'description' => esc_html__( 'Countdown','softlab' ),
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_countdown',
        'params' => array(
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'countdown to this date:', 'softlab' ),
                'param_name' => 'h_date',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Year', 'softlab' ),
                'param_name' => 'countdown_year',
                'description' => esc_html__( 'Example: 2020', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Month', 'softlab' ),
                'param_name' => 'countdown_month',
                'description' => esc_html__( 'Example: 12', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Day', 'softlab' ),
                'param_name' => 'countdown_day',
                'description' => esc_html__( 'Example: 31', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Hours', 'softlab' ),
                'param_name' => 'countdown_hours', 
                'description' => esc_html__( 'Example: 24', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Minutes', 'softlab' ),
                'param_name' => 'countdown_min',
                'description' => esc_html__( 'Example: 59', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ), 
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Hidden Values', 'softlab' ),
                'param_name' => 'h_hide',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Days?', 'softlab' ),
                'param_name' => 'hide_day',
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Hours?', 'softlab' ),
                'param_name' => 'hide_hours',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Minutes?', 'softlab' ),
                'param_name' => 'hide_minutes',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Seconds?', 'softlab' ),
                'param_name' => 'hide_seconds',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            // STYLE TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'softlab' ),
                'param_name' => 'align',
                'value' => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' ) => 'right',
                ),
                'std' => 'center',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_s_1',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Countdown Size', 'softlab' ),
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Small','softlab' ) => 'small',
                    esc_html__( 'Medium','softlab' ) => 'medium',
                    esc_html__( 'Large','softlab' ) => 'large',
                    esc_html__( 'Extra Large','softlab' ) => 'e_large',
                    esc_html__( 'Custom','softlab' ) => 'custom',
                ),
                'std' => 'large', 
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'softlab' ),
                'param_name' => 'font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Number Font Size ', 'softlab' ),
                'param_name' => 'font_size_number',
                'description' => esc_html__( 'Enter value in em.', 'softlab' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),           
             array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Text Font Size ', 'softlab' ),
                'param_name' => 'font_size_text',
                'description' => esc_html__( 'Enter value in em.', 'softlab' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_s_2',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Number Font Weight', 'softlab' ),
                'param_name' => 'font_weight',
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'value' => array(
                    esc_html__( 'Theme defaults', 'softlab' ) => '',
                    esc_html__( '300 / Light', 'softlab' ) => '300',
                    esc_html__( '400 / Regular', 'softlab' ) => '400',
                    esc_html__( '500 / Medium', 'softlab' ) => '500',
                    esc_html__( '600 / SemiBold', 'softlab' ) => '600',
                    esc_html__( '700 / Bold', 'softlab' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Text Font Weight', 'softlab' ),
                'param_name' => 'font_text_weight',
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'value' => array(
                    esc_html__( 'Theme defaults', 'softlab' ) => '',
                    esc_html__( '300 / Light', 'softlab' ) => '300',
                    esc_html__( '400 / Regular', 'softlab' ) => '400',
                    esc_html__( '500 / Medium', 'softlab' ) => '500',
                    esc_html__( '600 / SemiBold', 'softlab' ) => '600',
                    esc_html__( '700 / Bold', 'softlab' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_s_3',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Number Color', 'softlab' ),
                'param_name' => 'number_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Color', 'softlab' ),
                'param_name' => 'countdown_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Separating Points Color', 'softlab' ),
                'param_name' => 'points_color',
                'value' => $theme_color,
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'softlab' ),
                'param_name' => 'custom_fonts_countdown',
                'group' => esc_html__( 'Style', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_countdown',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_countdown',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
            ),
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_countdown extends WPBakeryShortCode {}
    } 
}