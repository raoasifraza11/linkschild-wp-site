<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_gradient_start = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'Button', 'softlab' ),
        'base' => 'wgl_button',
        'class' => 'softlab_button',
        'icon' => 'wgl_icon_button',
        'content_element' => true,
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'description' => esc_html__( 'Add extended button','softlab'),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'softlab' ),
                'value' => esc_html__( 'Button Text', 'softlab' ),
                'param_name' => 'button_text',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Button Link', 'softlab' ),
                'param_name' => 'link',
            ),
            // Animations
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            //  STYLE TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button', 'softlab' ),
                'param_name' => 'h_button_style',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Size', 'softlab' ),
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Extra Large', 'softlab' ) => 'xl',
                    esc_html__( 'Large', 'softlab' ) => 'l',
                    esc_html__( 'Medium', 'softlab' ) => 'm',
                    esc_html__( 'Small', 'softlab' ) => 's',
                ),
                'std' => 'xl',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Border Radius', 'softlab' ),
                'value' => '',
                'param_name' => 'border_radius',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_1',
				'group' => esc_html__( 'Style', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Alignment', 'softlab' ),
                'param_name' => 'align',
                'value' => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' ) => 'right',
                ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Button Full Width', 'softlab' ),
				'param_name' => 'full_width',
				'group' => esc_html__( 'Style', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Display: Inline', 'softlab' ),
				'param_name' => 'inline',
                'description' => esc_html__( 'Fill content width.', 'softlab' ),
				'group' => esc_html__( 'Style', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
            // Border heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button Border', 'softlab' ),
                'param_name' => 'h_button_border',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Border checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Border', 'softlab' ),
                'param_name' => 'add_border',
                'value' => 'true',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Border Width', 'softlab' ),
                'param_name' => 'border_width',
                'value' => '1px',
                'dependency' => array(
                    'element' => 'add_border',
                    'value' => 'true'
                ),
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Shadow
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button Shadow', 'softlab' ),
                'param_name' => 'h_button_shadow',
                'group' => esc_html__( 'Style', 'softlab' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Appearance', 'softlab' ),
                'param_name' => 'shadow_style',
                'value' => array(
					esc_html__( 'Theme Defaults', 'softlab' ) => '',
					esc_html__( 'Disable Shadow', 'softlab' ) => 'none',
					esc_html__( 'Always Visible', 'softlab' ) => 'always',
					esc_html__( 'While Hover', 'softlab' ) => 'on_hover',
					esc_html__( 'Until Hover', 'softlab' ) => 'before_hover',
                ),
                'std' => 'always',
                'group' => esc_html__( 'Style', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // TYPOGRAPHY TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text Font Size', 'softlab' ),
                'param_name' => 'font_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Text Font Weight', 'softlab' ),
                'param_name' => 'font_weight',
                'value' => array(
                    esc_html__( 'Theme defaults', 'softlab' ) => '',
                    esc_html__( '300 / Light', 'softlab' ) => '300',
                    esc_html__( '400 / Regular', 'softlab' ) => '400',
                    esc_html__( '500 / Medium', 'softlab' ) => '500',
                    esc_html__( '600 / SemiBold', 'softlab' ) => '600',
                    esc_html__( '700 / Bold', 'softlab' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom font family for button', 'softlab' ),
				'param_name' => 'custom_fonts_button',
				'description' => esc_html__( 'Customize font family', 'softlab' ),
				'group' => esc_html__( 'Typography', 'softlab' ),
			),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_button',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add icon/Image', 'softlab' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None','softlab') => 'none',
                    esc_html__( 'Font','softlab') => 'font',
                    esc_html__( 'Image','softlab') => 'image',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Pack', 'softlab' ),
                'param_name' => 'icon_pack',
                'value' => array(
                    esc_html__( 'Fontawesome', 'softlab' ) => 'fontawesome',
                    esc_html__( 'Flaticon', 'softlab' ) => 'flaticon',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'softlab' ),
				'param_name' => 'icon_font_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font'
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'softlab' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'softlab' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => 'image'
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Position', 'softlab' ),
				'param_name' => 'icon_position',
				'value' => array(
				    esc_html__( 'Left', 'softlab' ) => 'left',
				    esc_html__( 'Right', 'softlab' ) => 'right'
				),
				'description' => esc_html__( 'Select alignment.', 'softlab' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => array('image', 'font')
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
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
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'flaticon',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'softlab' ),
                'param_name' => 'img_width',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image'
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // OFFSETS TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button Paddings', 'softlab' ),
                'param_name' => 'heading',
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'softlab' ),
                'param_name' => 'top_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'softlab' ),
                'param_name' => 'bottom_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'softlab' ),
                'param_name' => 'left_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'softlab' ),
                'param_name' => 'right_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button Margins', 'softlab' ),
                'param_name' => 'heading',
                'group' => esc_html__( 'Offsets', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Margin', 'softlab' ),
                'param_name' => 'top_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Margin', 'softlab' ),
                'param_name' => 'bottom_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Margin', 'softlab' ),
                'param_name' => 'left_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Margin', 'softlab' ),
                'param_name' => 'right_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Offsets', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // COLORS TAB
			// Button colors heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button', 'softlab' ),
                'param_name' => 'h_button_customize',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'softlab' ),
                'param_name' => 'customize',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'softlab' ) => 'def',
                    esc_html__( 'Flat Colors', 'softlab' ) => 'color',
                    esc_html__( 'Gradient Colors', 'softlab' ) => 'gradient',
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_2',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Text color idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Idle', 'softlab' ),
                'param_name' => 'text_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Hover', 'softlab' ),
                'param_name' => 'text_color_hover',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_3',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Bg color idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'softlab' ),
                'param_name' => 'bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'customize',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Bg color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'softlab' ),
                'param_name' => 'bg_color_hover',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'customize',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'softlab' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'softlab' ),
				'param_name' => 'bg_gradient_idle_end',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'softlab' ),
				'param_name' => 'bg_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'softlab' ),
				'param_name' => 'bg_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_4',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Idle', 'softlab' ),
				'param_name' => 'border_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Hover', 'softlab' ),
				'param_name' => 'border_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'softlab' ),
				'param_name' => 'border_gradient_idle_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'softlab' ),
				'param_name' => 'border_gradient_idle_end',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'softlab' ),
				'param_name' => 'border_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'softlab' ),
				'param_name' => 'border_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon colors heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'h_icon_color',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_icon_color',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => 'font'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color Idle', 'softlab' ),
				'param_name' => 'icon_color_idle',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color Hover', 'softlab' ),
				'param_name' => 'icon_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Button extends WPBakeryShortCode {
        }
    }
}