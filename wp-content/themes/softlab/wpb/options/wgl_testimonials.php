<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
	vc_map(array(
		'name' => esc_html__( 'Testimonials', 'softlab' ),
		'base' => 'wgl_testimonials',
		'class' => 'softlab_testimonials',
		'category' => esc_html__( 'WGL Modules', 'softlab' ),
		'icon' => 'wgl_icon_testimonial',
		'content_element' => true,
		'description' => esc_html__( 'Represent clients feedback.','softlab' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'softlab_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'softlab' ),
				'param_name' => 'item_type',
				'fields' => array(
					'author_top' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_1.png',
						'label' => esc_html__( 'Top', 'softlab' )),
					'author_bottom' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_3.png',
						'label' => esc_html__( 'Bottom', 'softlab' )),
					'inline_top' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_2.png',
						'label' => esc_html__( 'Top Inline', 'softlab' )),
					'inline_bottom' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_3.png',
						'label' => esc_html__( 'Bottom Inline', 'softlab' )),
				),
				'value' => 'author_top',
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'softlab' ),
				'param_name' => 'item_grid',
				'value' => array(
					esc_html__( 'One Column', 'softlab' ) => '1',
					esc_html__( 'Two Columns', 'softlab' ) => '2',
					esc_html__( 'Three Columns', 'softlab' ) => '3',
					esc_html__( 'Four Columns', 'softlab' ) => '4',
					esc_html__( 'Five Columns', 'softlab' ) => '5',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'softlab' ),
				'param_name' => 'item_align',
				'value' => array(
					esc_html__( 'Left', 'softlab' ) => 'left',
					esc_html__( 'Center', 'softlab' ) => 'center',
					esc_html__( 'Right', 'softlab' ) => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'softlab' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on hover.', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_3',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Background Image', 'softlab' ),
				'param_name' => 'add_bg_image',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'softlab' ),
				'param_name' => 'bg_image',
				'dependency' => array(
					'element' => 'add_bg_image',
					'value' => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'softlab' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Items', 'softlab' ),
				'description' => esc_html__( 'Enter values for each item - thumbnail, quote, author name, author position.', 'softlab' ),
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail image', 'softlab' ),
						'param_name' => 'thumbnail',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Quote', 'softlab' ),
						'param_name' => 'quote',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Name', 'softlab' ),
						'param_name' => 'author_name',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Position', 'softlab' ),
						'param_name' => 'author_position',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Date stamp', 'softlab' ),
						'param_name' => 'date_stamp',
						'dependency' => array(
							'element' => 'item_type',
							'value' => 'inline_bottom',
						),
					),
				),
				'group' => esc_html__( 'Items', 'softlab' ),
			),
			// Thumbnail image dimensions
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Thumbnail Image Dimensions', 'softlab' ),
				'param_name' => 'h_image_styles',
				'group' => esc_html__( 'Items', 'softlab' ),
			),
			// Thumbnail width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Width', 'softlab' ),
				'param_name' => 'custom_img_width',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Items', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Height', 'softlab' ),
				'param_name' => 'custom_img_height',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Items', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail border radius
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Border Radius', 'softlab' ),
				'param_name' => 'custom_img_radius',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Items', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// STYLES TAB
			// Quote styles
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Quote', 'softlab' ),
				'param_name' => 'h_quote_styles',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'HTML Tag', 'softlab' ),
                'param_name' => 'quote_tag',
                'value' => array(
                    esc_html__( '‹div›', 'softlab' )  => 'div',
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                    esc_html__( '‹h2›', 'softlab' )   => 'h2',
                    esc_html__( '‹h3›', 'softlab' )   => 'h3',
                    esc_html__( '‹h4›', 'softlab' )   => 'h4',
                    esc_html__( '‹h5›', 'softlab' )   => 'h5',
                    esc_html__( '‹h6›', 'softlab' )   => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'description' => esc_html__( 'Select custom tag.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Quote font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'quote_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_4',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Quote font
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'softlab' ),
				'param_name' => 'custom_fonts_quote',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_quote',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_quote',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_5',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Quote color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_quote_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Quote colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Color', 'softlab' ),
				'param_name' => 'quote_color',
				'value' => '#606568',
				'dependency' => array(
					'element' => 'custom_quote_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_6',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Quote icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Quote Icon Color', 'softlab' ),
				'param_name' => 'custom_quote_icon_color',
				'dependency' => array(
					'element' => 'item_type',
					'value' => array( 'inline_top', 'inline_bottom' )
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Quote icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Icon Color', 'softlab' ),
				'param_name' => 'quote_icon_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'custom_quote_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name styles
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Author Name', 'softlab' ),
				'param_name' => 'h_name_styles',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'softlab' ),
				'param_name' => 'name_tag',
				'value' => array(
                    esc_html__( '‹div›', 'softlab' )  => 'div',
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                    esc_html__( '‹h2›', 'softlab' )   => 'h2',
                    esc_html__( '‹h3›', 'softlab' )   => 'h3',
                    esc_html__( '‹h4›', 'softlab' )   => 'h4',
                    esc_html__( '‹h5›', 'softlab' )   => 'h5',
                    esc_html__( '‹h6›', 'softlab' )   => 'h6',
				),
				'std' => 'h3',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'description' => esc_html__( 'Select your html tag.', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name Font Size', 'softlab' ),
				'param_name' => 'name_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_7',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Author name Fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'softlab' ),
				'param_name' => 'custom_fonts_name',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_name',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_name',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_8',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Author name color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_name_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Name Color', 'softlab' ),
				'param_name' => 'name_color',
				'value' => '#000000',
				'dependency' => array(
					'element' => 'custom_name_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position styles heading
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Author Position', 'softlab' ),
				'param_name' => 'h_status_styles',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'softlab' ),
				'param_name' => 'position_tag',
				'value' => array(
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                    esc_html__( '‹div›', 'softlab' ) => 'div',
                    esc_html__( '‹h2›', 'softlab' ) => 'h2',
                    esc_html__( '‹h3›', 'softlab' ) => 'h3',
                    esc_html__( '‹h4›', 'softlab' ) => 'h4',
                    esc_html__( '‹h5›', 'softlab' ) => 'h5',
                    esc_html__( '‹h6›', 'softlab' ) => 'h6',
				),
				'std' => 'span',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'description' => esc_html__( 'Select custom tag.', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'position_size',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_9',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Author position fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'softlab' ),
				'param_name' => 'custom_fonts_status',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_status',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_status',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_10',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Author position color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_position_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Position Color', 'softlab' ),
				'param_name' => 'position_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'custom_position_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Date styles heading
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Date Stamp', 'softlab' ),
				'param_name' => 'h_data_styles',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Date font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'softlab' ),
				'param_name' => 'date_size',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_11',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			// Date color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_date_color',
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Date color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Status Color', 'softlab' ),
				'param_name' => 'date_color',
				'value' => '#c4cdd7',
				'dependency' => array(
					'element' => 'custom_date_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Carousel', 'softlab' ),
				'param_name' => 'use_carousel',
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'softlab' ),
				'param_name' => 'autoplay',
				'dependency' => array(
					'element'   => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-1 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'softlab' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Enter value in milliseconds.', 'softlab' ),
				'dependency' => array(
					'element' => 'autoplay',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_12',
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'softlab' ),
				'param_name' => 'fade_animation',
				'description' => esc_html__( 'Requieres single full-width column.', 'softlab' ),
				'dependency' => array(
					'element'   => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Carousel pagination controls
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'softlab' ),
				'param_name' => 'h_pag_controls',
				'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'softlab' ),
				'param_name' => 'use_pagination',
				'std' => 'true',
				'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
			),
			array(
				'type' => 'softlab_radio_image',
				'heading' => esc_html__( 'Pagination Type', 'softlab' ),
				'param_name' => 'pag_type',
				'fields' => array(
					'circle' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
						'label' => esc_html__( 'Circle', 'softlab' )),
					'circle_border' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
						'label' => esc_html__( 'Empty Circle', 'softlab' )),
					'square' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
						'label' => esc_html__( 'Square', 'softlab' )),
					'line' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
						'label' => esc_html__( 'Line', 'softlab' )),
					'line_circle' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
						'label' => esc_html__( 'Line - Circle', 'softlab' )),
				),
				'value' => 'circle',
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'softlab' ),
				'param_name' => 'pag_offset',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination Aligning', 'softlab' ),
				'param_name' => 'pag_align',
				'value' => array(
					esc_html__( 'Left', 'softlab' )	=> 'left',
					esc_html__( 'Center', 'softlab' )	=> 'center',
					esc_html__( 'Right', 'softlab' )	=> 'right',
				),
				'std' => 'center',
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Pagination Color', 'softlab' ),
				'param_name' => 'custom_pag_color',
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pagination Color', 'softlab' ),
				'param_name' => 'pag_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'custom_pag_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Prev/Next buttons
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'softlab' ),
                'param_name' => 'h_prev_next',
                'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Prev/Next checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'softlab' ),
                'param_name' => 'use_prev_next',
                'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next positioning dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Buttons Positioning', 'softlab' ),
				'param_name' => 'prev_next_position',
				'value' => array(
					esc_html__( 'Opposite each other', 'softlab' ) => '',
					esc_html__( 'Bottom right corner', 'softlab' ) => 'right',
				),
				'std' => 'right',
				'dependency' => array(
					'element' => 'use_prev_next',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_13',
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next colors checkbox
			array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            // Prev/Next color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Color Idle', 'softlab' ),
                'param_name' => 'prev_next_color',
                'value' => 'rgba( '.Softlab_Theme_Helper::hexToRGB($theme_color).',0.5)',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Color Hover', 'softlab' ),
                'param_name' => 'prev_next_color_hover',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_14',
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next bg color
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'softlab' ),
                'param_name' => 'prev_next_bg_idle',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next bg color hover
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'softlab' ),
                'param_name' => 'prev_next_bg_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// RESPONSIVE TAB
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Responsive', 'softlab' ),
				'param_name' => 'h_responsive',
				'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
				'param_name' => 'custom_resp',
				'dependency'  => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Medium desktop
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Medium Desktop', 'softlab' ),
				'param_name' => 'h_resp_medium',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'softlab' ),
				'param_name' => 'resp_medium',
				'value' => '1025',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'softlab' ),
				'param_name' => 'resp_medium_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Tablets
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Tablets', 'softlab' ),
				'param_name' => 'h_resp_tablets',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'softlab' ),
				'param_name' => 'resp_tablets',
				'value' => '800',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'softlab' ),
				'param_name' => 'resp_tablets_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Mobile phones
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Mobile Phones', 'softlab' ),
				'param_name' => 'h_resp_mobile',
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'softlab' ),
				'param_name' => 'resp_mobile',
				'value' => '480',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'softlab' ),
				'param_name' => 'resp_mobile_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
		)
	));

	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Testimonials extends WPBakeryShortCode {}
	}
}
