<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option( 'theme-custom-color' ));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Social Icons', 'softlab' ),
        'base' => 'wgl_soc_icons',
        'class' => 'softlab_soc_icons',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_social-icons',
        'content_element' => true,
        'description' => esc_html__( 'Display Social Icons','softlab' ),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'softlab' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Define social icons parameters - title, link and colors.', 'softlab' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'link' => 'https://www.facebook.com/',
                        'icon' => 'fa fa-facebook',
                        'title' => esc_html__( 'Facebook', 'softlab' ),
                        'new_tab' => true,
                    ),
                    array(
                        'link' => 'https://twitter.com/',
                        'icon' => 'fa fa-twitter',
                        'title' => esc_html__( 'Twitter', 'softlab' ),
                        'new_tab' => true,
                    ),
                    array(
                        'link' => 'https://www.instagram.com/',
                        'icon' => 'fa fa-instagram',
                        'title' => esc_html__( 'Instagram', 'softlab' ),
                        'new_tab' => true,
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__( 'Icon', 'softlab' ),
                        'param_name' => 'icon',
                        'value' => 'fa fa-adjust', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => true,
                            // default true, display an 'EMPTY' icon?
                            'iconsPerPage' => 200,
                            // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        ),
                        'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'softlab' ),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Link', 'softlab' ),
                        'param_name' => 'link',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-7',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Custom Colors', 'softlab' ),
                        'param_name' => 'custom_colors',
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Open in New Tab', 'softlab' ),
                        'param_name'    => 'new_tab',
                        'std' => 'true',
                        'edit_field_class' => 'vc_col-sm-7',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Icon Idle', 'softlab' ),
                        'param_name' => 'icon_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-3',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Icon Hover', 'softlab' ),
                        'param_name' => 'icon_hover_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-9',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Idle', 'softlab' ),
                        'param_name' => 'bg_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-3',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Hover', 'softlab' ),
                        'param_name' => 'bg_hover_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-9',
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icons Alignment', 'softlab' ),
                'param_name' => 'icons_pos',
                'value' => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Display inline checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Display: Inline', 'softlab' ),
                'param_name' => 'display_inline',
                'description' => esc_html__( 'Fill content width.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_1',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Gap Between Icons', 'softlab' ),
                'param_name' => 'icon_gap',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container dimensions (width, height, line-height)
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Container Dimensions', 'softlab' ),
                'param_name' => 'bg_size',
                'description' => esc_html__( 'Width and height in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Border Radius', 'softlab' ),
                'param_name' => 'border_radius',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Add animated element
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Box Shadow', 'softlab' ),
                'param_name' => 'add_box_shadow_element',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'softlab' ),
                'param_name' => 'icon_size',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            // COLORS TAB
            // Icon colors checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'all_custom_colors',
                'description' => esc_html__( 'For all icons.', 'softlab' ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Colored bg checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Colored Background', 'softlab' ),
                'param_name' => 'add_bg',
                'description' => esc_html__( 'For all icons.', 'softlab' ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-9 no-top-padding',
            ),
            // Icon colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icons Idle', 'softlab' ),
                'param_name' => 'all_icon_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'all_custom_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icons Hover', 'softlab' ),
                'param_name' => 'all_icon_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'all_custom_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // Icon bg colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Backgrounds Idle', 'softlab' ),
                'param_name' => 'all_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom icon bg colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Backgrounds Hover', 'softlab' ),
                'param_name' => 'all_bg_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Borders Idle', 'softlab' ),
                'param_name' => 'all_border_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Borders Hover', 'softlab' ),
                'param_name' => 'all_border_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // OFFSET TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Side offsets', 'softlab' ),
                'param_name' => 'heading',
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Margin Left', 'softlab' ),
                'param_name' => 'left_margin',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Margin Right', 'softlab' ),
                'param_name' => 'right_margin',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Padding Left', 'softlab' ),
                'param_name' => 'left_padding',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Padding Right', 'softlab' ),
                'param_name' => 'right_padding',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Soc_Icons extends WPBakeryShortCode {
        }
    }
}
