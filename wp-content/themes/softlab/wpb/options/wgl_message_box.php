<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
// Add list item
    $main_font = Softlab_Theme_Helper::get_option('main-font');
    vc_map(array(
        'name' => esc_html__('Message Box', 'softlab'),
        'base' => 'wgl_message_box',
        'class' => 'softlab_message_box',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_message_box',
        'content_element' => true,
        'description' => esc_html__('Message Box','softlab'),
        'params' => array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Message Type', 'softlab' ),
                'param_name'    => 'type',
                'value'         => array(
                    esc_html__( 'Informational', 'softlab' ) => 'info',
                    esc_html__( 'Success', 'softlab' )		 => 'success',
                    esc_html__( 'Warning', 'softlab' )		 => 'warning',
                    esc_html__( 'Error', 'softlab' )		 => 'error',
                    esc_html__( 'Custom', 'softlab' )		 => 'custom',
                ),              
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'settings' => array(
                    'emptyIcon' => false,
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Message Color', 'softlab' ),
                'param_name'    => 'icon_color',
                'value'         => $theme_color,
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'softlab'),
                'param_name' => 'title',
                'admin_label'   => true,
            ),  
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Text', 'softlab'),
                'param_name' => 'text',
            ),       
            array(
                'type'          => 'wgl_checkbox',
                'heading'       => esc_html__( 'Closable?', 'softlab' ),
                'param_name'    => 'closable',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
            // title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Title Styles', 'softlab'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Title Tag', 'softlab' ),
                'param_name'    => 'title_tag',
                'value'         => array(
                    esc_html__( 'Div', 'softlab' )    => 'div',
                    esc_html__( 'Span', 'softlab' )    => 'span',
                    esc_html__( 'H2', 'softlab' )    => 'h2',
                    esc_html__( 'H3', 'softlab' )    => 'h3',
                    esc_html__( 'H4', 'softlab' )    => 'h4',
                    esc_html__( 'H5', 'softlab' )    => 'h5',
                    esc_html__( 'H6', 'softlab' )    => 'h6',
                ),
                'std' => 'h4',
                'group'         => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Choose your tag for title', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'softlab'),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter title font-size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // Title Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for title', 'softlab' ),
                'param_name' => 'custom_fonts_title',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'softlab' ),
                'param_name' => 'custom_title_color',
                'description' => esc_html__( 'Select custom color', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'softlab'),
                'param_name' => 'title_color',
                'value' => $theme_color,
                'description' => esc_html__('Select title color', 'softlab'),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // text styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Text Styles', 'softlab'),
                'param_name' => 'h_text_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Text Tag', 'softlab' ),
                'param_name'    => 'text_tag',
                'value'         => array(
                    esc_html__( 'Div', 'softlab' )    => 'div',
                    esc_html__( 'Span', 'softlab' )    => 'span',
                    esc_html__( 'H2', 'softlab' )    => 'h2',
                    esc_html__( 'H3', 'softlab' )    => 'h3',
                    esc_html__( 'H4', 'softlab' )    => 'h4',
                    esc_html__( 'H5', 'softlab' )    => 'h5',
                    esc_html__( 'H6', 'softlab' )    => 'h6',
                ),
                'std' => 'div',
                'group'         => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Choose your tag for text', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Text Font Size', 'softlab'),
                'param_name' => 'text_size',
                'value' => '',
                'description' => esc_html__( 'Enter text font-size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for text', 'softlab' ),
                'param_name' => 'custom_fonts_text',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_text',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            // text color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Text Color', 'softlab' ),
                'param_name' => 'custom_text_color',
                'description' => esc_html__( 'Select custom color', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Text Color', 'softlab'),
                'param_name' => 'text_color',
                'value' => '#000000',
                'description' => esc_html__('Select text color', 'softlab'),
                'dependency' => array(
                    'element' => 'custom_text_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),             
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_message_box extends WPBakeryShortCode {}
    } 
}
