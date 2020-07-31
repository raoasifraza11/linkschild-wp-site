<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));
$theme_secondary_color = esc_attr(Softlab_Theme_Helper::get_option("theme-secondary-color"));
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Double Headings', 'softlab'),
        'base' => 'wgl_double_headings',
        'class' => 'softlab_custom_text',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_double-text',
        'content_element' => true,
        'description' => esc_html__('Double Headings','softlab'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'softlab'),
                'param_name' => 'subtitle',
            ),
            array(
                'type' => 'textarea',
                'holder' => 'div',
                'heading' => esc_html__('Title.', 'softlab') ,
                'param_name' => 'content',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'softlab' ),
                'param_name' => 'align',
                'edit_field_class' => 'vc_col-sm-12',
                'value' => array(
                    esc_html__( 'Left', 'softlab' )   => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' )  => 'right',
                ),
            ), 
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
            // TITLE STYLES TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Title Styles', 'softlab'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'softlab' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'softlab' ) => 'div',
                    esc_html__( '‹h2›', 'softlab' )  => 'h2',
                    esc_html__( '‹h3›', 'softlab' )  => 'h3',
                    esc_html__( '‹h4›', 'softlab' )  => 'h4',
                    esc_html__( '‹h5›', 'softlab' )  => 'h5',
                    esc_html__( '‹h6›', 'softlab' )  => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'description' => esc_html__( 'Your html tag for title', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'softlab'),
                'param_name' => 'title_size',
                'value' => '36px',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Line Height', 'softlab'),
                'param_name' => 'title_line_height',
                'value' => '48px',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Font Weight', 'softlab' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( '300 / Light', 'softlab' )      => '300',
                    esc_html__( '400 / Regular', 'softlab' )    => '400',
                    esc_html__( '500 / Medium', 'softlab' )     => '500',
                    esc_html__( '600 / SemiBold', 'softlab' )   => '600',
                    esc_html__( '700 / Bold', 'softlab' )       => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'std' => '700',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Title Color', 'softlab' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'softlab' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_ts_1',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Set Title Resonsive Font Size', 'softlab' ),
                'param_name' => 'responsive_font',
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Small Desktops', 'softlab'),
                'param_name' => 'font_size_desktop',
                'description' => esc_html__( 'Enter font-size in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Tablets', 'softlab'),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter font-size in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Mobile', 'softlab'),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter font-size in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for title', 'softlab' ),
                'param_name' => 'custom_fonts_title',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Title Styles', 'softlab' ),
            ),   
            // SUBTITLE STYLES TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Subtitle Styles', 'softlab'),
                'param_name' => 'h_subtitle_styles',
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Subtitle Tag', 'softlab' ),
                'param_name' => 'subtitle_tag',
                'value' => array(
                    esc_html__( '‹div›', 'softlab' ) => 'div',
                    esc_html__( '‹h2›', 'softlab' )  => 'h2',
                    esc_html__( '‹h3›', 'softlab' )  => 'h3',
                    esc_html__( '‹h4›', 'softlab' )  => 'h4',
                    esc_html__( '‹h5›', 'softlab' )  => 'h5',
                    esc_html__( '‹h6›', 'softlab' )  => 'h6',
                ),
                'std' => 'div',
                'description' => esc_html__( 'Your html tag for subtitle', 'softlab' ),
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Font Size', 'softlab'),
                'param_name' => 'subtitle_size',
                'value' => '18px',
                'description' => esc_html__( 'Enter font-size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Line Height', 'softlab'),
                'param_name' => 'subtitle_line_height',
                'value' => '20px',
                'description' => esc_html__( 'Enter line height in pixels.', 'softlab' ),
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Subtitle Font Weight', 'softlab' ),
                'param_name' => 'subtitle_weight',
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'value' => array(
                    esc_html__( '300 / Light', 'softlab' ) => '300',
                    esc_html__( '400 / Regular', 'softlab' ) => '400',
                    esc_html__( '500 / Medium', 'softlab' ) => '500',
                    esc_html__( '600 / SemiBold', 'softlab' ) => '600',
                    esc_html__( '700 / Bold', 'softlab' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'std' => '400',
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Subtitle Color', 'softlab' ),
                'param_name' => 'custom_subtitle_color',
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Subtitle Color', 'softlab' ),
                'param_name' => 'subtitle_color',
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
                'value' => $theme_secondary_color,
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_subtitle_color',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'description' => esc_html__( 'Choose color for subtitle.', 'softlab' ),
            ), 
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for subtitle', 'softlab' ),
                'param_name' => 'custom_fonts_subtitle',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_subtitle',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_subtitle',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Subtitle Styles', 'softlab' ),
            ),              
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Double_Headings extends WPBakeryShortCode {
            
        }
    } 
}
