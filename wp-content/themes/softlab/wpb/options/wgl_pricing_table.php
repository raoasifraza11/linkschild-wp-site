<?php
if ( !defined('ABSPATH') ) { die('-1'); }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(Softlab_Theme_Helper::get_option('main-font')['color']);
$theme_gradient_start = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['to']);

if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__( 'Pricing Table', 'softlab' ),
		'base' => 'wgl_pricing_table',
		'class' => 'softlab_pricing_table',
		'category' => esc_html__( 'WGL Modules', 'softlab' ),
		'icon' => 'wgl_icon_price_table',
		'content_element' => true,
		'description' => esc_html__( 'Place Pricing Table', 'softlab' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pricing Table Title', 'softlab' ),
				'param_name' => 'pricing_title',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Currency', 'softlab' ),
				'param_name' => 'pricing_cur',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Price', 'softlab' ),
				'param_name' => 'pricing_price',
				'edit_field_class' => 'vc_col-sm-2',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Description', 'softlab' ),
				'param_name' => 'pricing_desc',
				'edit_field_class' => 'vc_col-sm-8',
			),
			// Hover animation checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable hover animation', 'softlab' ),
				'param_name' => 'hover_animation',
				'value' => 'true',
				'description' => esc_html__( 'Lift up the item on hover.', 'softlab' ),
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'softlab' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
			),
			// ICON TAB
			// Add icon/image
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add Icon/Image', 'softlab' ),
				'param_name' => 'icon_type',
				'value' => array(
					esc_html__( 'None', 'softlab' ) => '',
					esc_html__( 'Icon', 'softlab' ) => 'font',
					esc_html__( 'Image', 'softlab' ) => 'image',
				),
				'save_always' => true,
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon pack dropdown
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
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			// Icon size
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
				'settings' => array(
					'emptyIcon' => false, // default true, display an 'EMPTY' icon?
					'iconsPerPage' => 200, // default 100, how many icons will be displayed per page. Use big number to display all icons in single page
				),
				'description' => esc_html__( 'Select icon from library.', 'softlab' ),
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
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'softlab' ),
				'param_name' => 'thumbnail',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'softlab' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-8 no-top-padding',
			),
			// Custom image width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Width', 'softlab' ),
				'param_name' => 'custom_image_width',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Custom image height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Height', 'softlab' ),
				'param_name' => 'custom_image_height',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// CONTENT TAB
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Content.', 'softlab' ),
				'param_name' => 'content',
				'holder' => 'div',
				'admin_label' => false,
				'group' => esc_html__( 'Content', 'softlab' ),
			),
			// Description
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text', 'softlab' ),
				'param_name' => 'descr_text',
				'group' => esc_html__( 'Content', 'softlab' ),
			),
			// Add button heading
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'CTA Button', 'softlab' ),
				'param_name' => 'h_button',
				'group' => esc_html__( 'Content', 'softlab' ),
			),
			// Button text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'softlab' ),
				'param_name' => 'button_title',
				'value' => esc_html__( 'Get Started', 'softlab' ),
				'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Button Link', 'softlab' ),
				'param_name' => 'link',
				'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// COLORS TAB
			// Icon color
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Icon Color', 'softlab' ),
				'param_name' => 'h_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Icon Colors', 'softlab' ),
				'param_name' => 'custom_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color', 'softlab' ),
				'param_name' => 'icon_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Header section customization
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Header Section', 'softlab' ),
				'param_name' => 'h_pricing_customize',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Title', 'softlab' ),
				'param_name' => 'custom_title_color',
				'value' => 'true',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'softlab' ),
				'param_name' => 'title_color',
				'value' => '#737373',
				'dependency' => array(
					'element' => 'custom_title_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_1',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Price color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Price', 'softlab' ),
				'param_name' => 'custom_price_color',
				'value' => 'true',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price currency color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Price Currency Color', 'softlab' ),
				'param_name' => 'price_cur_color',
				'value' => '#c4cdd7',
				'dependency' => array(
					'element' => 'custom_price_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Price Color', 'softlab' ),
				'param_name' => 'price_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'custom_price_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_2',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			//  Description color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Description', 'softlab' ),
				'param_name' => 'custom_description_color',
				'value' => 'true',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Description color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Description Color', 'softlab' ),
				'param_name' => 'description_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_description_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Description bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Description Background', 'softlab' ),
				'param_name' => 'description_bg_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'custom_description_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Backgrounds customization heading
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Backgrounds Customization', 'softlab' ),
				'param_name' => 'h_backgrounds_customization',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pricing Table Customization', 'softlab' ),
				'param_name' => 'pricing_customize',
				'value' => array(
					esc_html__( 'Default', 'softlab' ) => 'def',
					esc_html__( 'Color', 'softlab' ) => 'color',
					esc_html__( 'Image', 'softlab' ) => 'image',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Pricing table bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pricing Table Background Color', 'softlab' ),
				'param_name' => 'pricing_bg_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Pricing table bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Pricing Table Background Image', 'softlab' ),
				'param_name'  => 'pricing_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'softlab' ),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => 'image',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_3',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Header section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Header Customization', 'softlab' ),
				'param_name' => 'header_customize',
				'value' => array(
					esc_html__( 'Default', 'softlab' ) => '',
					esc_html__( 'Color', 'softlab' ) => 'color',
					esc_html__( 'Image', 'softlab' ) => 'image',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Header Background', 'softlab' ),
				'param_name' => 'header_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Header Background Image', 'softlab' ),
				'param_name'  => 'header_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'softlab' ),
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'image',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_4',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Content section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Content Customization', 'softlab' ),
				'param_name' => 'content_customize',
				'value' => array(
					esc_html__( 'Default', 'softlab' ) => '',
					esc_html__( 'Color', 'softlab' ) => 'color',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Background Color', 'softlab' ),
				'param_name'  => 'content_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'content_customize',
					'value' => array( 'color' )
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_5',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value' => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Footer section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Footer Customization', 'softlab' ),
				'param_name' => 'footer_customize',
				'value' => array(
					esc_html__( 'Default', 'softlab' ) => '',
					esc_html__( 'Color', 'softlab' ) => 'color',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value' => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Footer bg colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Footer Background Color', 'softlab' ),
				'param_name'  => 'footer_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'footer_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Button colors
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Button', 'softlab' ),
				'param_name' => 'h_button_colors',
				'group' => esc_html__( 'Colors', 'softlab' ),
			),
			// Button customization dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customization', 'softlab' ),
				'param_name' => 'button_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'softlab' ) => 'def',
					esc_html__( 'Flat Colors', 'softlab' ) => 'color',
					esc_html__( 'Gradient Colors', 'softlab' ) => 'gradient',
				),
				'std' => 'def',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_6',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Button text color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Idle', 'softlab' ),
				'param_name' => 'button_text_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array( 'color', 'gradient' )
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button text color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Hover', 'softlab' ),
				'param_name' => 'button_text_color_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array( 'color', 'gradient' )
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// Button bg idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'softlab' ),
				'param_name' => 'button_bg_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'softlab' ),
				'param_name' => 'button_bg_color_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'softlab' ),
				'param_name' => 'button_bg_gradient_idle_start',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'softlab' ),
				'param_name' => 'button_bg_gradient_idle_end',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'softlab' ),
				'param_name' => 'button_bg_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'softlab' ),
				'param_name' => 'button_bg_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_7',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Button border color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Idle', 'softlab' ),
				'param_name' => 'button_border_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Hover', 'softlab' ),
				'param_name' => 'button_border_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'softlab' ),
				'param_name' => 'button_border_gradient_idle_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'softlab' ),
				'param_name' => 'button_border_gradient_idle_end',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'softlab' ),
				'param_name' => 'button_border_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'softlab' ),
				'param_name' => 'button_border_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'softlab' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// TYPOGRAPHY TAB
			// Title styles heading
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Title Styles', 'softlab' ),
				'param_name' => 'h_title_styles',
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'title_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Title font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Font Weight', 'softlab' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'softlab' ) => '',
                    esc_html__( '300 / Light', 'softlab' ) => '300',
                    esc_html__( '400 / Regular', 'softlab' ) => '400',
                    esc_html__( '500 / Medium', 'softlab' ) => '500',
                    esc_html__( '600 / SemiBold', 'softlab' ) => '600',
                    esc_html__( '700 / Bold', 'softlab' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'softlab' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Select custom value.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Title fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'softlab' ),
				'param_name' => 'custom_fonts_title',
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
			// Price styles 
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Price Styles', 'softlab' ),
				'param_name' => 'h_content_styles',
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Price font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'price_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Pricing description styles
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Descriptions Styles', 'softlab' ),
				'param_name' => 'description_styles',
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Description font size 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'description_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Typography', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		)
	));

	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Pricing_Table extends WPBakeryShortCode {}
	}
}
