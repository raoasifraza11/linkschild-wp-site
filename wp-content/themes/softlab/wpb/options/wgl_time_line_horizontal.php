<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Time Line Horizontal', 'softlab' ),
        'base' => 'wgl_time_line_horizontal',
        'class' => 'softlab_time_line_horizontal',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_horizont-timeline',
        'content_element' => true,
        'description' => esc_html__( 'Display Time Line Horizontal','softlab' ),
        'params' => array(
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Time Line Items', 'softlab' ),
				'param_name' => 'values',
				'description' => esc_html__( 'Enter values for each item, such as thumbnail, title, description and date.', 'softlab' ),
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail', 'softlab' ),
						'param_name' => 'thumbnail',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Date', 'softlab' ),
						'param_name' => 'date',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'softlab' ),
						'param_name' => 'title',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'softlab' ),
						'param_name' => 'descr',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'wgl_checkbox',
						'heading' => esc_html__( 'Customize Colors', 'softlab' ),
						'param_name' => 'custom_item_colors',
						'edit_field_class' => 'vc_col-sm-3',
					),
					array(
						'type' => 'colorpicker', 
						'heading' => esc_html__( 'Circle Background', 'softlab' ),
						'param_name' => 'circle_background',
						'value' => '#ffffff',
						'dependency' => array(
							'element' => 'custom_item_colors',
							'value' => 'true'
						),
						'edit_field_class' => 'vc_col-sm-3',
					),
					array(
						'type' => 'colorpicker', 
						'heading' => esc_html__( 'Icon Color', 'softlab' ),
						'param_name' => 'icon_color',
						'value' => '#dae3f4',
						'dependency' => array(
							'element' => 'custom_item_colors',
							'value' => 'true'
						),
						'edit_field_class' => 'vc_col-sm-3',
					),
                ),
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Сrossline', 'softlab' ),
				'param_name' => 'custom_crossline',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Сrossline Сolor', 'softlab' ),
				'param_name' => 'crossline_color',
				'value' => '#dbe4f4',
				'dependency' => array(
					'element' => 'custom_crossline',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Appear Animation', 'softlab' ),
				'param_name' => 'appear_anim',
				'std' => 'true',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            // CAROUSEL TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Cloumns Amount', 'softlab' ),
                'param_name' => 'slide_to_show',
                'value' => array(
                    esc_html__( '1', 'softlab' ) => '1',
                    esc_html__( '2', 'softlab' ) => '2',
                    esc_html__( '3', 'softlab' ) => '3',
                    esc_html__( '4', 'softlab' ) => '4',
                    esc_html__( '5', 'softlab' ) => '5',
                    esc_html__( '6', 'softlab' ) => '6',
                ),           
                'std' => '4',   
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Slide one item at a time', 'softlab' ),
                'param_name' => 'slides_to_scroll',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'softlab' ),
                'param_name' => 'autoplay',
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
            // carousel pagination heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'softlab' ),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'softlab' ),
                'param_name' => 'use_pagination',
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination Alignment', 'softlab' ),
				'param_name' => 'pag_align',
				'value' => array(
					esc_html__( 'Left', 'softlab' ) => 'left',
					esc_html__( 'Right', 'softlab' ) => 'right',
					esc_html__( 'Center', 'softlab' ) => 'center',
				),
				'std' => 'center',
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
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
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Carousel', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                	'element' => 'use_pagination',
                	'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'softlab' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // RESPONSIVE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
                'param_name' => 'custom_resp',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
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
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_r_1',
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Tablets breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablets Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
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
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_r_2',
				'group' => esc_html__( 'Responsive', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
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
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Time_Line_Horizontal extends WPBakeryShortCode {
        }
    }
}
