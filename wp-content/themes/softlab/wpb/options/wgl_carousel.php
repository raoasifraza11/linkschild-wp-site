<?php

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'base' => 'wgl_carousel',
        'name' => esc_html__( 'Carousel', 'softlab' ),
		'class' => 'softlab_carousel_module',
        'content_element' => true,      
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_carousel',
        'show_settings_on_create' => true,
        'is_container' => true,
		'as_parent' => array( 'only' => 'wgl_counter, wgl_button, vc_column_text, wgl_pricing_table, wgl_info_box, wgl_custom_text, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row, wgl_flip_box' ),
        'params' => array(
            // GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns Amount', 'softlab' ),
				'param_name' => 'slide_to_show',
				'value' => array(
					esc_html__( '1', 'softlab' ) => '1',
					esc_html__( '2', 'softlab' ) => '2',
					esc_html__( '3', 'softlab' ) => '3',
					esc_html__( '4', 'softlab' ) => '4',
					esc_html__( '5', 'softlab' ) => '5',
					esc_html__( '6', 'softlab' ) => '6',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
			    'type' => 'softlab_param_heading',
			    'param_name' => 'divider_1',
			    'edit_field_class' => 'divider',
			),
			array(
			    'type' => 'textfield',
			    'heading' => esc_html__( 'Animation Speed', 'softlab' ),
			    'param_name' => 'speed',
			    'value' => '300',
			    'description' => esc_html__( 'Enter value in milliseconds.', 'softlab' ),
			    'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'softlab' ),
				'param_name' => 'autoplay',
				'value' => 'true',
				'edit_field_class' => 'vc_col-sm-1',
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
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_2',
                'edit_field_class' => 'divider',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Slide One Item per time', 'softlab' ),
				'param_name' => 'slides_to_scroll',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Infinite loop sliding', 'softlab' ),
				'param_name' => 'infinite',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Adaptive Height', 'softlab' ),
				'param_name' => 'adaptive_height',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'softlab' ),
				'param_name' => 'fade_animation',
				'dependency' => array(
					'element' => 'slide_to_show',
					'value' => '1'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            // NAVIGATION TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'softlab' ),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'softlab' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'std' => 'true'
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
                'group' => esc_html__( 'Navigation', 'softlab' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Pagination Aligning', 'softlab' ),
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
                'group' => esc_html__( 'Navigation', 'softlab' ),
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
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_3',
				'group' => esc_html__( 'Navigation', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'softlab' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Navigation', 'softlab' ),
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
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel prev/next heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'softlab' ),
                'param_name' => 'h_prev_buttons',
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'softlab' ),
                'param_name' => 'use_prev_next',
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom offset', 'softlab' ),
                'param_name' => 'custom_prev_next_offset',
                 'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Navigation', 'softlab' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'softlab' ),
                'param_name' => 'prev_next_offset',
                'value' => '50%',
                'description' => esc_html__( 'Enter value in percentages.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_prev_next_offset',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'divider_4',
				'group' => esc_html__( 'Navigation', 'softlab' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Prev/Next Buttons Color', 'softlab' ),
                'param_name' => 'prev_next_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Buttons Background Color', 'softlab' ),
                'param_name' => 'prev_next_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // RESPONSIVE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
                'param_name' => 'custom_resp',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Responsive', 'softlab' ),
            ),
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
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
                'param_name' => 'divider_5',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
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
                'param_name' => 'divider_6',
                'group' => esc_html__( 'Responsive', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
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
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists( 'WPBakeryShortCodesContainer' )) {
        class WPBakeryShortCode_wgl_carousel extends WPBakeryShortCodesContainer {}
    }
}