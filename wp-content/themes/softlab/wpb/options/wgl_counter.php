<?php
if ( !defined('ABSPATH') ) { die('-1'); }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_gradient_start = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'Counter', 'softlab' ),
        'base' => 'wgl_counter',
        'class' => 'softlab_counter',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_counter',
        'content_element' => true,
        'description' => esc_html__( 'Counter','softlab' ),
        'params' => array(
            array(
                'type' => 'softlab_radio_image',
                'heading' => esc_html__( 'Overall Layout', 'softlab' ),
                'param_name' => 'counter_layout',
                'fields' => array(
                    'top' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
                        'label' => esc_html__( 'Top', 'softlab' )),
                    'left' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
                        'label' => esc_html__( 'Left', 'softlab' )),
                    'right' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
                        'label' => esc_html__( 'Right', 'softlab' )),
                ),
                'value' => 'top',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'softlab' ),
                'param_name' => 'counter_align',
                'value' => array(
                    esc_html__( 'Left', 'softlab' )   => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' )  => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            // CONTENT TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'softlab' ),
                'param_name' => 'count_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Divider', 'softlab' ),
                'param_name' => 'add_counter_divider',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Prefix', 'softlab' ),
                'description' => esc_html__( 'Enter prefix before counter value.', 'softlab' ),
                'param_name' => 'count_prefix',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value', 'softlab' ),
                'description' => esc_html__( 'Enter number without any special character', 'softlab' ),
                'param_name' => 'count_value',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Suffix', 'softlab' ),
                'description' => esc_html__( 'Enter suffix after counter value.', 'softlab' ),
                'param_name' => 'count_suffix',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Counter Offsets', 'softlab' ),
                'param_name' => 'counter_offsets',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'h_shadow',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            // Counter shadow
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Shadow', 'softlab' ),
                'param_name' => 'add_shadow',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Counter shadow appearance
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Appearance', 'softlab' ),
                'param_name' => 'shadow_appearance',
                'value' => array(
                    esc_html__( 'Visible While Hover', 'softlab' ) => 'on_hover',
                    esc_html__( 'Visible Until Hover', 'softlab' ) => 'before_hover',
                    esc_html__( 'Always Visible', 'softlab' )      => 'always',
                ),
                'std' => 'always',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Type', 'softlab' ),
                'param_name' => 'shadow_type',
                'value' => array(
                    esc_html__( 'Outset', 'softlab' ) => '',
                    esc_html__( 'Inset', 'softlab' ) => 'inset',
                ),
                'std' => 'inset',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'X Offset', 'softlab' ),
                'param_name' => 'shadow_offset_x',
                'value' => '0',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Y Offset', 'softlab' ),   
                'param_name' => 'shadow_offset_y',
                'value' => '14',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blur', 'softlab' ),
                'param_name' => 'shadow_blur',
                'value' => '10',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Spread', 'softlab' ),
                'param_name' => 'shadow_spread',
                'value' => '0',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'shadow_color',
                'value' => 'rgba(0,0,0,0.06)',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add icon/image', 'softlab' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None', 'softlab' )  => '',
                    esc_html__( 'Font', 'softlab' )  => 'font',
                    esc_html__( 'Image', 'softlab' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Pack', 'softlab' ),
                'param_name' => 'icon_pack',
                'value' => array(
                    esc_html__( 'Fontawesome', 'softlab' ) => 'fontawesome',
                    esc_html__( 'Flaticon', 'softlab' )    => 'flaticon',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Custom Icon Size', 'softlab' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // ddefault 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'flaticon',
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
                'edit_field_class' => 'vc_col-sm-8 no-top-padding',
            ),
            // Image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'softlab' ),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'softlab' ),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON CONTAINER TAB
            // Icon container width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Container Width', 'softlab' ),
                'param_name' => 'custom_icon_bg_width',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
                'group' => esc_html__( 'Icon Container', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5 no-top-padding',
            ),
			// Icon container height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Container Height', 'softlab' ),
				'param_name' => 'custom_icon_bg_height',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5 no-top-padding',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Icon Offsets', 'softlab' ),
				'param_name' => 'icon_offsets',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
            // COLORS TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'softlab' ),
                'param_name' => 'h_icon_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Icon Colors', 'softlab' ),
                'param_name' => 'custom_icon_color',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Color', 'softlab' ),
                'param_name' => 'icon_color',
                'value' => '#000000',
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover Color', 'softlab' ),
                'param_name' => 'icon_color_hover',
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon border heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Border Colors', 'softlab' ),
                'param_name' => 'h_icon_border_colors',
                'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon container border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_icon_border_color',
                'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container border color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'icon_border_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container border hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'icon_border_color_hover',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon container colors heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Container Colors', 'softlab' ),
                'param_name' => 'h_icon_colors',
                'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            // Icon container bg color dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Background Colors', 'softlab' ),
				'param_name' => 'icon_bg_color_type',
				'value' => array(
					esc_html__( 'Theme defaults', 'softlab' )  => '',
					esc_html__( 'Flat colors', 'softlab' )     => 'color',
					esc_html__( 'Gradient colors', 'softlab' ) => 'gradient',
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-10',
			),
            // Icon container bg color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'softlab' ),
                'param_name' => 'icon_bg_color',
                'value' => '#000000',
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Icon container bg hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover Color', 'softlab' ),
                'param_name' => 'icon_bg_color_hover',
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            // Background gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'softlab' ),
                'param_name' => 'icon_bg_gradient_start',
                'value' => $theme_gradient_start,
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Background gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'softlab' ),
                'param_name' => 'icon_bg_gradient_end',
                'value' => $theme_gradient_end,
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Value colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Value colors', 'softlab' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Value color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Value Color', 'softlab' ),
                'param_name' => 'custom_value_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Value color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Counter Value Color', 'softlab' ),
                'param_name' => 'value_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Use text-stroke effect
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Text-Stroke', 'softlab' ),
                'param_name' => 'add_value_text_stroke',
                'dependency' => array(
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text-stroke color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text-stroke Color', 'softlab' ),
                'param_name' => 'value_text_stroke_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_value_text_stroke',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Title Colors', 'softlab' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'softlab' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'softlab' ),
                'param_name' => 'title_color',
                'value' => '#8b9baf',
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // TYPOGRAPHY TAB
            // Title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Counter Title Styles', 'softlab' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Title Tag dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'softlab' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'softlab' )  => 'div',
                    esc_html__( '‹h2›', 'softlab' )   => 'h2',
                    esc_html__( '‹h3›', 'softlab' )   => 'h3',
                    esc_html__( '‹h4›', 'softlab' )   => 'h4',
                    esc_html__( '‹h5›', 'softlab' )   => 'h5',
                    esc_html__( '‹h6›', 'softlab' )   => 'h6',
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Custom html tag for counter title.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title margin top
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Margin Top', 'softlab' ),
                'param_name' => 'title_margin_top',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'softlab' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Font Weight', 'softlab' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'softlab' )    => '',
                    esc_html__( '300 / Light', 'softlab' )      => '300',
                    esc_html__( '400 / Regular', 'softlab' )    => '400',
                    esc_html__( '500 / Medium', 'softlab' )     => '500',
                    esc_html__( '600 / SemiBold', 'softlab' )   => '600',
                    esc_html__( '700 / Bold', 'softlab' )       => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for counter title', 'softlab' ),
                'param_name' => 'custom_fonts_title',
                'description' => esc_html__( 'Customize font family.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
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
            // Value styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Counter Value Styles', 'softlab' ),
                'param_name' => 'h_count_value_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Value container height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Container Height', 'softlab' ),
                'param_name' => 'value_height',
                'value' => '',
                'description' => esc_html__( 'Сustom height for value wrapper in pixels. Note: value may be cropped from bottom.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-10',
            ),
            // Value font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Font Size', 'softlab' ),
                'param_name' => 'value_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Value Font Weight', 'softlab' ),
                'param_name' => 'value_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'softlab' )    => '',
                    esc_html__( '300 / Light', 'softlab' )      => '300',
                    esc_html__( '400 / Regular', 'softlab' )    => '400',
                    esc_html__( '500 / Medium', 'softlab' )     => '500',
                    esc_html__( '600 / SemiBold', 'softlab' )   => '600',
                    esc_html__( '700 / Bold', 'softlab' )       => '700',
                    esc_html__( '800 / Extra Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value custom fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for counter value', 'softlab' ),
                'param_name' => 'custom_fonts_count_value',
                'description' => esc_html__( 'Customize font family.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_count_value',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_count_value',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Counter extends WPBakeryShortCode {
        }
    }
}