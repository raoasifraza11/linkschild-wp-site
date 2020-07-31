<?php
if(!class_exists('Softlab_Theme_Helper')){
    return;
}
$theme_color = Softlab_Theme_Helper::get_option('theme-custom-color');
$header_font = Softlab_Theme_Helper::get_option('header-font');
$main_font = Softlab_Theme_Helper::get_option('main-font');
$theme_gradient = Softlab_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    vc_map( array(
        "name" => esc_html__("Portfolio Slider", "softlab-core"),
        "base" => $this->shortcodeName,
        "class" => 'softlab_portfolio_slider',
        "category" => esc_html__('WGL Modules', 'softlab-core'),
        "icon" => 'wgl_icon_portfolio_module',
        "content_element" => true,
        "description" => esc_html__("Portfolio Slider","softlab-core"),
        "params" => array(                             
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Click Item', 'softlab-core'),
                'param_name' => 'click_area',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-8',
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'value' => array(
                    esc_html__("Single", "softlab-core") => 'single',
                    esc_html__("Popup", "softlab-core") => 'popup',
                    esc_html__("Custom Link", "softlab-core") => 'custom',
                    esc_html__("Default", "softlab-core") => 'none',
                ),
                'std' => 'popup',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Add Single Link to Title', 'softlab-core' ),
                'param_name' => 'single_link_title',
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'std' => 'true',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show Info Position', 'softlab-core'),
                'param_name' => 'info_position',
                'admin_label' => true,
                'value' => array(
                    esc_html__('Inside Image', "softlab-core") => 'inside_image',
                    esc_html__('Under Image', "softlab-core") => 'under_image',
                ),
                'std' => 'inside_image',
                'group' => esc_html__( 'Content', 'softlab-core' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Inside Image Animation', 'softlab-core'),
                'param_name' => 'image_anim',
                'value' => array(
                    esc_html__('Outline', 'softlab-core') => 'outline',
                    esc_html__('Side Offset', 'softlab-core') => 'offset',
                    esc_html__('Always Show Info', 'softlab-core') => 'always_info',
                ),
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array('inside_image')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Horizontal Content Align', 'softlab-core'),
                'param_name' => 'horizontal_align',
                'admin_label' => true,
                'value' => array(
                    esc_html__('Left', 'softlab-core') => 'Left',
                    esc_html__('Center', 'softlab-core') => 'center',
                    esc_html__('Right', 'softlab-core') => 'right'
                ),
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array('under_image')
                )
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Content Elements', 'softlab-core'),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Icon', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'softlab-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Show Title?', 'softlab-core' ),
                'param_name' => 'show_portfolio_title',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'std' => 'true',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Show categories?', 'softlab-core' ),
                'param_name' => 'show_meta_categories',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab-core' ),
                'std' => 'true',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Show Content?', 'softlab-core' ),
                'param_name' => 'show_content',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab-core' ),
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'softlab-core'),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'softlab-core' ),
                "dependency"    => array(
                    "element"   => "show_content",
                    'value' => 'true'
                ),
            ),
            // --- CAROUSEL GROUP --- //
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Carousel Options', 'softlab-core'),
                'param_name' => 'h_portfolio_carousel',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                "type"          => "wgl_checkbox",
                'heading' => esc_html__( 'Autoplay', 'softlab-core' ),
                "param_name"    => "autoplay",
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'softlab-core' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Multiple Items', 'softlab-core' ),
                'param_name' => 'multiple_items',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            // carousel pagination heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Pagination Controls', 'softlab-core'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'softlab-core' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'softlab_radio_image',
                'heading' => esc_html__('Pagination Type', 'softlab-core'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__('Circle', 'softlab-core')),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__('Empty Circle', 'softlab-core')),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__('Square', 'softlab-core')),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__('Line', 'softlab-core')),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__('Line - Circle', 'softlab-core')),
                ),
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'softlab-core' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'softlab-core' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'softlab-core' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'softlab-core'),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel pagination heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Responsive', 'softlab-core'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab-core' ),
                'param_name' => 'custom_resp',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
            ),
            // medium desktop
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Medium Desktop', 'softlab-core'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab-core' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab-core' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Tablets', 'softlab-core'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab-core' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab-core' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Mobile Phones', 'softlab-core'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'softlab-core' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'softlab-core' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),

            // --- CUSTOM GROUP --- //
            // Portfolio Headings Font
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Typography', 'softlab-core'),
                'param_name' => 'h_typography',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'softlab-core'),
                'param_name' => 'heading_font_size',
                'value' => '',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'softlab-core' ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Categories Font Size', 'softlab-core'),
                'param_name' => 'cat_font_size',
                'value' => '',
                'description' => esc_html__( 'Enter categories font-size in pixels.', 'softlab-core' ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for Portfolio Headings', 'softlab-core' ),
                'param_name' => 'custom_fonts_portfolio_headings',
                'group' => esc_html__( 'Font', 'softlab-core' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_portfolio_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'softlab-core' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'softlab-core' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_portfolio_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
            ),
            // Heading Colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Heading Colors', 'softlab-core'),
                'param_name' => 'h_heading_colors',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Heading Colors', 'softlab-core' ),
                'param_name' => 'custom_heading',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'softlab-core'),
                'param_name' => 'heading_color',
                'value' => esc_attr($header_font['color']),
                'dependency' => array(
                    'element' => 'custom_heading',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Hover Color', 'softlab-core'),
                'param_name' => 'heading_color_hover',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_heading',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Categories Colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Categories Colors', 'softlab-core'),
                'param_name' => 'h_cat_colors',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Categories Colors', 'softlab-core' ),
                'param_name' => 'custom_cat',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'softlab-core'),
                'param_name' => 'cat_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'custom_cat',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Hover Color', 'softlab-core'),
                'param_name' => 'cat_color_hover',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_cat',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icons Colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Icons Colors', 'softlab-core'),
                'param_name' => 'h_icons_colors',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Icons Colors', 'softlab-core' ),
                'param_name' => 'custom_icons',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'softlab-core'),
                'param_name' => 'icons_color',
                'value' => esc_attr($header_font['color']),
                'dependency' => array(
                    'element' => 'custom_icons',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Hover Color', 'softlab-core'),
                'param_name' => 'icons_color_hover',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_icons',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Content Colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Content Color', 'softlab-core'),
                'param_name' => 'h_content_colors',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Content Color', 'softlab-core' ),
                'param_name' => 'custom_content',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'softlab-core'),
                'param_name' => 'content_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'custom_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Overlay Colors', 'softlab-core'),
                'param_name' => 'h_content_overlay',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Font', 'softlab-core' ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Background Custom Colors', 'softlab-core' ),
                'param_name'    => 'bg_color_type',
                'value'         => array(
                    esc_html__( 'Default', 'softlab-core' )      => 'def',
                    esc_html__( 'Color', 'softlab-core' )      => 'color',
                    esc_html__( 'Gradient', 'softlab-core' )     => 'gradient',
                    esc_html__( 'None', 'softlab-core' )      => 'none',
                ),
                'std' => 'def',
                'group' => esc_html__( 'Font', 'softlab-core' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'softlab-core'),
                'param_name' => 'background_color',
                'value' => 'rgba(255,255,255,0.9)',
                'description' => esc_html__('Select background color', 'softlab-core'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'softlab-core'),
                'param_name' => 'background_gradient_start',
                'value' => 'rgba('.Softlab_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.85)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'softlab-core'),
                'param_name' => 'background_gradient_end',
                'value' => 'rgba('.Softlab_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.85)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Secondary overlay color
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Custom Secondary Overlay Color', 'softlab-core'),
                'param_name' => 'h_sec_overlay_colors',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Secondary Overlay Color', 'softlab-core' ),
                'param_name' => 'custom_sec_overlay',
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'softlab-core'),
                'param_name' => 'sec_overlay_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_sec_overlay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'softlab-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
));
    Softlab_Loop_Settings::init($this->shortcodeName, array( 'hide_cats' => true,
                    'hide_tags' => true));
}
?>