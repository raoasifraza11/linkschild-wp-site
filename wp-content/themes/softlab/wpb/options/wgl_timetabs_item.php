<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color_secondary	= esc_attr(Softlab_Theme_Helper::get_option("theme-secondary-color"));
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);


if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__('Time Tab Item', 'softlab'),
		'base' => 'wgl_timetabs_item',
		'class' => 'softlab_time_line_vertical',
		'category' => esc_html__('WGL Modules', 'softlab'),
		'icon' => 'wgl_icon_vertical-timeline',
		'as_child' => array('only' => 'wgl_timetabs_container'),
		'content_element' => true,
		'description' => esc_html__('Time tabs item','softlab'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Time', 'softlab'),
				'param_name' => 'time',
				'admin_label' => true,
				'value' => esc_html__( '11.00 am - 01.00 pm', 'softlab' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'softlab'),
				'param_name' => 'title',
				'admin_label' => true,
				'value' => esc_html__( 'Event Title', 'softlab' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'softlab' ),
				'param_name' => 'thumbnail',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'softlab' ),
			),
			// Content Section
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Event description', 'softlab'),
				'param_name' => 'description',
			),
			//Button settings
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Button Customize', 'softlab'),
				'param_name' => 'h_button',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Button Text', 'softlab'),
				'value' => esc_html__('Read more', 'softlab'),
				'param_name' => 'button_text',
				'group' => esc_html__( 'Button', 'softlab' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Button Link', 'softlab' ),
				'param_name' => 'button_link',
				'group' => esc_html__( 'Button', 'softlab' ),
			),
			// Button size header
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Button Size', 'softlab'),
				'param_name' => 'h_button_size',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button shadow header
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Button Shadow', 'softlab'),
				'param_name' => 'h_button_shadow',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button size options
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Size', 'softlab' ),
				'description' => esc_html__('Select button size.', 'softlab'),
				'param_name' => 'button_size',
				'value' => array(
					esc_html__( 'Small', 'softlab' )  => 's',
					esc_html__( 'Medium', 'softlab' ) => 'm',
					esc_html__( 'Large', 'softlab' )  => 'l',
					esc_html__( 'Extra Large', 'softlab' ) => 'xl',
				),
				'std' => 'm',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button shadow options
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Shadow Style', 'softlab' ),
				'description' => esc_html__('Select button shadow style.', 'softlab'),
				'param_name' => 'button_shadow_style',
				'value' => array(
					esc_html__( 'None', 'softlab' )     => 'none',
					esc_html__( 'Always', 'softlab' )   => 'always',
					esc_html__( 'On Hover', 'softlab' ) => 'on_hover',
					esc_html__( 'Before Hover', 'softlab' ) => 'before_hover',
				),
				'std' => 'on_hover',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'		 => 'dropdown',
				'heading' 	 => esc_html__( 'Customize', 'softlab' ),
				'description' => esc_html__('Show options for color customizing.', 'softlab'),
				'param_name' => 'button_customize',
				'value'		 => array(
					esc_html__( 'Default', 'softlab' ) => 'def',
					esc_html__( 'Color', 'softlab' )   => 'color',
				),
				'std'		=> 'color',
				'group' 	=> esc_html__( 'Button', 'softlab' ),
			),
			array(
				'type' 		 => 'softlab_param_heading',
				'heading' 	 => esc_html__('Text Color', 'softlab'),
				'param_name' => 'h_text_color',
				'dependency' => array(
					'element' => 'button_customize',
					'value'   => 'color'
				),
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__('Text Color', 'softlab'),
				'description' => esc_html__('Select custom text color for button.', 'softlab'),
				'param_name' => 'button_text_color',
				'value' => $header_font_color,
				'dependency'  => array(
					'element' => 'button_customize',
					'value'   => 'color'
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__('Hover Text Color', 'softlab'),
				'description' => esc_html__('Select custom text color for hover button.', 'softlab'),
				'param_name' => 'button_text_color_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color',
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Background Color', 'softlab'),
				'param_name' => 'h_background_color',
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
				'dependency' => array(
					'element' => 'button_customize',
					'value'   => 'color'
				),
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' 	  => esc_html__('Background', 'softlab'),
				'description' => esc_html__('Select custom background for button.', 'softlab'),
				'param_name' => 'button_bg_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value'   => 'color'
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__('Hover Background', 'softlab'),
				'param_name' => 'button_bg_color_hover',
				'value' => $theme_color_secondary,
				'description' => esc_html__('Select custom background for hover button.', 'softlab'),
				'dependency' => array(
					'element' => 'button_customize',
					'value'   => 'color'
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button border-color header
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Border Color', 'softlab'),
				'param_name' => 'h_border_color',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Button border-color
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__('Border Color', 'softlab'),
				'description' => esc_html__('Select custom border color for button.', 'softlab'),
				'param_name' => 'button_border_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array('color')
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Button Hover border-color
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__('Hover Border Color', 'softlab'),
				'description' => esc_html__('Select custom border color for hover button.', 'softlab'),
				'param_name' => 'button_border_color_hover',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array('color')
				),
				'save_always' => true,
				'group' => esc_html__( 'Button', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Text Color Customize
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Text Color Customize', 'softlab'),
				'param_name' => 'h_text_colors',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Time Custom Color
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Time Custom Color', 'softlab' ),
				'param_name' => 'time_custom_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Time Color', 'softlab'),
				'param_name' => 'time_color',
				'value' => '#ffffff',
				'description' => esc_html__('Select custom color', 'softlab'),
				'dependency' => array(
					'element' => 'time_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Title Custom Color
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Title Custom Color', 'softlab' ),
				'param_name' => 'title_custom_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Title Color', 'softlab'),
				'param_name' => 'title_color',
				'value' => '#ffffff',
				'description' => esc_html__('Select custom color', 'softlab'),
				'dependency' => array(
					'element' => 'title_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Description Custom Color
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Description Custom Color', 'softlab' ),
				'param_name' => 'description_custom_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Description Color', 'softlab'),
				'param_name' => 'description_color',
				'value' => '#dadada',
				'description' => esc_html__('Select custom color', 'softlab'),
				'dependency' => array(
					'element' => 'description_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Bg Color Customize
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__('Background Color Customize', 'softlab'),
				'param_name' => 'h_bg_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Background Custom Color', 'softlab' ),
				'param_name' => 'bg_custom_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Background Color', 'softlab'),
				'param_name' => 'bg_color',
				'value' => '',
				'description' => esc_html__('Select custom color', 'softlab'),
				'dependency' => array(
					'element' => 'bg_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Background Hover Color', 'softlab'),
				'param_name' => 'bg_color_hover',
				'value' => '#131120',
				'description' => esc_html__('Select custom color', 'softlab'),
				'dependency' => array(
					'element' => 'bg_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_timetabs_item extends WPBakeryShortCode {
		}
	}
}