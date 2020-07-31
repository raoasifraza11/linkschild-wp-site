<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(softlab_Theme_Helper::get_option("theme-custom-color"));
$second_color = esc_attr(softlab_Theme_Helper::get_option("second-custom-color"));
$theme_gradient = softlab_Theme_Helper::get_option("theme-gradient");

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services 3', 'softlab'),
        'base' => 'wgl_services_3',
        'class' => 'softlab_services_3',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_services_3',
        'content_element' => true,
        'description' => esc_html__('Add Services','softlab'),
        'params' => array(
            // General
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Title', 'softlab' ),
                "param_name" => "title",
                'admin_label' => true,
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Content', 'softlab' ),
                "param_name" => "descr",
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'softlab' ),
                'param_name' => 'add_read_more',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'softlab'),
                'param_name' => 'read_more_text',
                'value' => 'Read More',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value'   => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'softlab' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'softlab'),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'softlab')
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Icon Type', 'softlab'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Info Box Icon/Image
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None', 'softlab' )  => 'none',
                    esc_html__( 'Font', 'softlab' )  => 'font',
                    esc_html__( 'Image', 'softlab' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_font_type',
                'value' => array(
                    esc_html__( 'Flaticon', 'softlab' )    => 'type_flaticon',
                    esc_html__( 'Fontawesome', 'softlab' ) => 'type_fontawesome',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'softlab' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            // Custom image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Width', 'softlab'),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter image size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'softlab'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Circles', 'softlab' ),
                'param_name' => 'add_circles',
                'description' => esc_html__( 'Add circles around the background', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font','image')
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Circles Colors', 'softlab' ),
                'param_name' => 'circles_colors',
                'description' => esc_html__( 'Select custom colors', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_circles',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Circles Color', 'softlab'),
                'param_name' => 'circles_color',
                'value' => $theme_color,
                'description' => esc_html__('Select circles color', 'softlab'),
                'dependency' => array(
                    'element' => 'circles_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Circles Color 2', 'softlab'),
                'param_name' => 'circles_color_2',
                'value' => $second_color,
                'description' => esc_html__('Select circles 2 color', 'softlab'),
                'dependency' => array(
                    'element' => 'circles_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Styling
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Title Color', 'softlab'),
                'param_name' => 'h_custom_colors',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'softlab' ),
                'param_name' => 'custom_title_color',
                'description' => esc_html__( 'Select custom color', 'softlab' ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'softlab'),
                'param_name' => 'title_color',
                'value' => '#252525',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Content Color', 'softlab'),
                'param_name' => 'h_custom_content_colors',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Content Color', 'softlab' ),
                'param_name' => 'custom_content_color',
                'description' => esc_html__( 'Select custom color', 'softlab' ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Content Color', 'softlab'),
                'param_name' => 'content_color',
                'value' => '#6e6e6e',
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Icon Colors', 'softlab'),
                'param_name' => 'h_custom_icon_colors',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Icon Colors', 'softlab' ),
                'param_name' => 'custom_icon_color',
                'description' => esc_html__( 'Select custom colors', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon color dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_color_type',
                'value' => array(
                    esc_html__( 'Color', 'softlab' )    => 'color',
                    esc_html__( 'Gradient', 'softlab' ) => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Idle Color', 'softlab'),
                'param_name' => 'icon_color_idle',
                'value' => $theme_color,
                'description' => esc_html__('Select custom color.', 'softlab'),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Gradient From', 'softlab'),
                'param_name' => 'icon_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom color.', 'softlab'),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon gradient start color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Gradient From', 'softlab'),
                'param_name' => 'icon_color_from',
                'value' => $theme_gradient['from'],
                'description' => esc_html__('Select icon gradient color from', 'softlab'),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon gradient end color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Gradient To', 'softlab'),
                'param_name' => 'icon_color_to',
                'value' => $theme_gradient['to'],
                'description' => esc_html__('Select icon gradient color to', 'softlab'),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Read More color checkbox
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Read More Colors', 'softlab'),
                'param_name' => 'h_custom_btn_colors',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Read More Colors', 'softlab' ),
                'param_name' => 'custom_btn_color',
                'description' => esc_html__( 'Select custom colors', 'softlab' ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Read More color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Read More Color', 'softlab'),
                'param_name' => 'btn_color',
                'value' => $theme_color,
                'description' => esc_html__('Select read more color', 'softlab'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Read More hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Read More Hover Color', 'softlab'),
                'param_name' => 'btn_hover',
                'value' => '#252525',
                'description' => esc_html__('Select read more hover color', 'softlab'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services_3 extends WPBakeryShortCode {
        }
    }
}