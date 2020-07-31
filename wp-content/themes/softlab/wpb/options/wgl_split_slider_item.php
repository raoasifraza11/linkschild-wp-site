<?php

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(		
		
        'base' => 'wgl_split_slider_item',
        'name' => esc_html__('Slider Content Section', 'softlab'),
		'class' => 'softlab_split_slider_item_module',
        'content_element' => true,      
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_carousel',
        'show_settings_on_create' => true,
        'is_container' => true,
        'as_child'  => array('only' => 'wgl_split_slider_left, wgl_split_slider_right'),
		'as_parent' => array('except' => 'vc_row'),
        'params' => array(
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Slide Settings', 'softlab' ),
                'param_name' => 'side_style',
                'edit_field_class' => 'side_css_editor',
            ), 
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Text Alignment', 'softlab'),
                'param_name' => 'text_align',
                'value' => array(
                    esc_html__('Left', 'softlab') => 'left',
                    esc_html__('Right', 'softlab') => 'right',
                    esc_html__('Center', 'softlab') => 'center',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => 'center',
            ),
            // Responsive padding
            // Padding on Desktop
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Padding on Desktop', 'softlab' ),
                'param_name' => 'heading',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab' ),
                'param_name' => 'screen_desktops',
                'value' => '1024',
                'description' => esc_html__( 'Enter value in px.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12', 
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'softlab' ),
                'param_name' => 'top_pad_d',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'softlab' ),
                'param_name' => 'bottom_pad_d',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'softlab' ),
                'param_name' => 'left_pad_d',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'softlab' ),
                'param_name' => 'right_pad_d',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),            
            //Padding on Tablet
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Padding on Tablet', 'softlab' ),
                'param_name' => 'heading_t',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab' ),
                'param_name' => 'screen_tablet',
                'value' => '768',
                'description' => esc_html__( 'Enter value in px.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12', 
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'softlab' ),
                'param_name' => 'top_pad_t',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'softlab' ),
                'param_name' => 'bottom_pad_t',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'softlab' ),
                'param_name' => 'left_pad_t',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'softlab' ),
                'param_name' => 'right_pad_t',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),            
            //Padding on Mobile
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Padding on Mobile', 'softlab' ),
                'param_name' => 'heading_m',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab' ),
                'param_name' => 'screen_mobile',
                'value' => '480',
                'description' => esc_html__( 'Enter value in px.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12', 
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'softlab' ),
                'param_name' => 'top_pad_m',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'softlab' ),
                'param_name' => 'bottom_pad_m',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'softlab' ),
                'param_name' => 'left_pad_m',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'softlab' ),
                'param_name' => 'right_pad_m',
                'value' => '',
                'description' => esc_html__( 'Enter value in px, em, %, pt, cm.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),

        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_wgl_split_slider_item extends WPBakeryShortCodesContainer {}
    }
}