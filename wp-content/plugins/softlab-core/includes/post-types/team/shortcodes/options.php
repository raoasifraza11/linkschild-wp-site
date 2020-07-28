<?php
if (!class_exists('Softlab_Theme_Helper')) { return; }

$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));
$header_font = Softlab_Theme_Helper::get_option('header-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'wgl_team',
        'name' => esc_html__( 'Team List', 'softlab' ),
        'description' => esc_html__( 'Show Team Grid', 'softlab' ),
        'icon' => 'wgl_icon_team',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Columns in Row', 'softlab' ),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__( 'One', 'softlab' ) => '1',
                    esc_html__( 'Two', 'softlab' ) => '2',
                    esc_html__( 'Three', 'softlab' ) => '3',
                    esc_html__( 'Four', 'softlab' ) => '4',
                    esc_html__( 'Five', 'softlab' ) => '5',
                ),
                'std' => '4',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Team Info Alignment', 'softlab' ),
                'param_name' => 'info_align',
                'admin_label' => true,
                'value' => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' ) => 'right',
                ),
                'std' => 'center',
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Gap Between Items', 'softlab' ),
                'param_name' => 'grid_gap',
                'admin_label' => true,
                'value' => array(
                    esc_html__( '0px', 'softlab' ) => '0',
                    esc_html__( '2px', 'softlab' ) => '2',
                    esc_html__( '4px', 'softlab' ) => '4',
                    esc_html__( '6px', 'softlab' ) => '6',
                    esc_html__( '10px', 'softlab' ) => '10',
                    esc_html__( '20px', 'softlab' ) => '20',
                    esc_html__( '30px', 'softlab' ) => '30',
                ),
                'std' => '30',
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Image', 'softlab' ),
                'param_name' => 'single_link_wrapper',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Heading', 'softlab' ),
                'param_name' => 'single_link_heading',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Display meta dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'show_meta',
                'value' => array(
                    esc_html__( 'Hidden (show at Hover State)', 'softlab' ) => 'while_hover',
                    esc_html__( 'Visible (hide at Hover State)', 'softlab' ) => 'until_hover',
                    esc_html__( 'Always visible (never hide)', 'softlab' ) => 'permanently',
                ),
                'description' => esc_html__( 'Select preferred display option for meta container.', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Hide title checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Title', 'softlab' ),
                'param_name' => 'hide_title',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide department checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Department', 'softlab' ),
                'param_name' => 'hide_department',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide socials checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Social Icons', 'softlab' ),
                'param_name' => 'hide_soc_icons',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide content checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Content', 'softlab' ),
                'param_name' => 'hide_content',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Letters Count', 'softlab' ),
                'param_name' => 'letter_count',
                'value' => '110',
                'dependency' => array(
                    'element'   => 'hide_content',
                    'value_not_equal_to' => 'true'
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'item_el_class',
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'softlab' )
            ),
            // CAROUSEL TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'softlab' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'softlab' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'use_carousel',
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
                'dependency' => array(
                    'element'   => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_ca_1',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Infinite Loop Sliding', 'softlab' ),
                'param_name' => 'carousel_infinite',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Slide per single item at a time', 'softlab' ),
                'param_name' => 'scroll_items',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Сarousel pagination style
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Pagination Style', 'softlab' ),
                'param_name' => 'h_pag_controls',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'softlab' ),
                'param_name' => 'use_pagination',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
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
                'edit_field_class' => 'vc_col-sm-4',
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
            // Carousel arrows style
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Arrows Style', 'softlab' ),
                'param_name' => 'h_arrow_control',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Arrows control', 'softlab' ),
                'param_name' => 'use_prev_next',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_buttons_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Color', 'softlab' ),
                'param_name' => 'buttons_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_buttons_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Responsive settings
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'softlab' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_ca_2',
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'softlab' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_ca_3',
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // COLORS TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Background Styles', 'softlab' ),
                'param_name' => 'h_bg_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Background color
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Background Customize Colors', 'softlab' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Default', 'softlab' ) => 'def',
                    esc_html__( 'Color', 'softlab' ) => 'color',
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
            ),
            // Background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'softlab' ),
                'param_name' => 'background_color',
                'value' => '#ffffff',
                'description' => esc_html__( 'Select background color', 'softlab' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover Color', 'softlab' ),
                'param_name' => 'background_hover_color',
                'value' => '#ffffff',
                'description' => esc_html__( 'Select background hover color', 'softlab' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Title', 'softlab' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Idle', 'softlab' ),
                'param_name' => 'title_color',
                'value' => $header_font['color'],
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Hover', 'softlab' ),
                'param_name' => 'title_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Department', 'softlab' ),
                'param_name' => 'h_depart_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'custom_depart_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Department Color', 'softlab' ),
                'param_name' => 'depart_color',
                'value' => $theme_color_secondary,
                'dependency' => array(
                    'element' => 'custom_depart_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Social Icons', 'softlab' ),
                'param_name' => 'h_soc_styles',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Icon Colors', 'softlab' ),
                'param_name' => 'custom_soc_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'softlab' ),
                'param_name' => 'soc_color',
                'value' => '#cfd1df',
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'softlab' ),
                'param_name' => 'soc_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_co_1',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Icon Backgrounds', 'softlab' ),
                'param_name' => 'custom_soc_bg_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'softlab' ),
                'param_name' => 'soc_bg_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'softlab' ),
                'param_name' => 'soc_bg_hover_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
    ));
    Softlab_Loop_Settings::init('wgl_team', array( 'hide_cats' => true,
                    'hide_tags' => true));
    class WPBakeryShortCode_wgl_Team extends WPBakeryShortCode{}
}