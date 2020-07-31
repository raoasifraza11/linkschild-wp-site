<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$header_font = Softlab_Theme_Helper::get_option('header-font');
$main_font = Softlab_Theme_Helper::get_option('main-font');
$theme_color = Softlab_Theme_Helper::get_option('theme-custom-color');

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'base' => 'wgl_blog_posts_standard',
        'name' => esc_html__( 'Blog Posts', 'softlab' ),
        'description' => esc_html__( 'Display the blog posts', 'softlab' ),
        'category' => esc_html__( 'WGL Blog Modules', 'softlab' ),
        'icon' => 'wgl_icon_blog',
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blog Title', 'softlab' ),
                'param_name' => 'blog_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea', 
                'heading' => esc_html__( 'Blog Subtitle', 'softlab' ),
                'param_name' => 'blog_subtitle',
                'admin_label' => true,
            ),   
            array(
                'type' => 'softlab_radio_image',
                'heading' => esc_html__( 'Layout', 'softlab' ),
                'param_name' => 'blog_layout',
                'fields' => array(
                    'grid' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
                        'label' => esc_html__( 'Grid', 'softlab' )),
                    'masonry' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry', 'softlab' )),
                    'carousel' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
                        'label' => esc_html__( 'Carousel', 'softlab' )),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation Type', 'softlab' ),
                'param_name' => 'blog_navigation',
                'value' => array(
                    esc_html__( 'None', 'softlab' ) => 'none',
                    esc_html__( 'Pagination', 'softlab' ) => 'pagination',
                    esc_html__( 'Load More', 'softlab' ) => 'load_more',
                ),
                'std' => 'none',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value_not_equal_to' => 'carousel',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation\'s Alignment', 'softlab' ),
                'param_name' => 'blog_navigation_align',
                'value'         => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Center', 'softlab' ) => 'center',
                    esc_html__( 'Right', 'softlab' ) => 'right'
                ),
                'std' => 'left',
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'pagination'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Items to be loaded', 'softlab' ),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items amount loaded by \'Load More\' button.', 'softlab' ),
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'load_more'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'softlab' ),
                'param_name' => 'name_load_more',
                'value' => esc_html__( 'Load More', 'softlab' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'load_more'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab' )
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Layout Settings', 'softlab' ),
                'param_name' => 'h_layout_settings',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grid Columns Amount', 'softlab' ),
                'param_name' => 'blog_columns',
                'value' => array(
                    esc_html__( 'One', 'softlab' ) => '12',
                    esc_html__( 'Two', 'softlab' ) => '6',
                    esc_html__( 'Three', 'softlab' ) => '4',
                    esc_html__( 'Four', 'softlab' ) => '3'
                ),
                'std' => '12',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Post Meta settings
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Content Elements', 'softlab' ),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Media?', 'softlab' ),
                'param_name' => 'hide_media',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Title?', 'softlab' ),
                'param_name' => 'hide_blog_title',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Content?', 'softlab' ),
                'param_name' => 'hide_content',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide all post-meta?', 'softlab' ),
                'param_name' => 'hide_postmeta',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta author?', 'softlab' ),
                'param_name' => 'meta_author',
                'std' => 'true',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta comments?', 'softlab' ),
                'param_name' => 'meta_comments',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta categories?', 'softlab' ),
                'param_name' => 'meta_categories',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta date?', 'softlab' ),
                'param_name' => 'meta_date',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Likes?', 'softlab' ),
                'param_name' => 'hide_likes',
                'std' => '',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Post Share?', 'softlab' ),
                'param_name' => 'hide_share',
                'std' => 'true',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            // Post Read More Link
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Content Trim', 'softlab' ),
                'param_name' => 'h_content_trime',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post read more link?', 'softlab' ),
                'param_name' => 'read_more_hide',
                'std' => 'true',
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Read More Text', 'softlab' ),
                'param_name' => 'read_more_text',
                'value' => esc_html__( 'Learn More', 'softlab' ),
                'description' => esc_html__( 'Enter read more text.', 'softlab' ),
                'dependency' => array(
                    'element' => 'read_more_hide',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Characters Amount in Content', 'softlab' ),
                'param_name' => 'content_letter_count',
                'value' => '290',
                'description' => esc_html__( 'Limit the content to be displayed.', 'softlab' ),
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Crop Images for Posts List?', 'softlab' ),
                'param_name' => 'crop_square_img',
                'std' => 'true',
                'description' => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'softlab' ),
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            // CAROUSEL TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'softlab' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            // carousel pagination heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'softlab' ),
                'param_name' => 'h_pag_controls',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'softlab' ),
                'param_name' => 'use_pagination',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true',
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
                'edit_field_class' => 'vc_col-sm-4',
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
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'softlab' ),
                'param_name' => 'pag_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),           
            // Carousel navigation controls
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Navigation Controls', 'softlab' ),
                'param_name' => 'h_nav_controls',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Navigation control', 'softlab' ),
                'param_name' => 'use_navigation',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            // Carousel responsive settings
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'softlab' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'softlab' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
            ),
            // Desktop screen breakpoint
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
                'param_name' => 'divider_ca_1',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet screen breakpoint
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
                'param_name' => 'divider_ca_2',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile screen breakpoint
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
            // STYLES TAB
            // Blog headings styles
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Blog Headings Styles', 'softlab' ),
                'param_name' => 'blog_heading_styles',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Heading tag', 'softlab' ),
                'param_name' => 'heading_tag',
                'value' => array(
                    esc_html__( '‹h1›', 'softlab' ) => 'h1',
                    esc_html__( '‹h2›', 'softlab' ) => 'h2',
                    esc_html__( '‹h3›', 'softlab' ) => 'h3',
                    esc_html__( '‹h4›', 'softlab' ) => 'h4',
                    esc_html__( '‹h5›', 'softlab' ) => 'h5',
                    esc_html__( '‹h6›', 'softlab' ) => 'h6',
                ),
                'std' => 'h3',
                'description' => esc_html__( 'Select your html tag.', 'softlab' ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading margin bottom', 'softlab' ),
                'param_name' => 'heading_margin_bottom',
                'value' => '10px',
                'save_always' => true,
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),  
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'softlab' ),
                'param_name' => 'custom_fonts_blog_headings',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),            
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'softlab' ),
                'param_name' => 'custom_fonts_blog_size_headings',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading Font Size', 'softlab' ),
                'param_name' => 'heading_font_size',
                'value' => '24',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading Line Height', 'softlab' ),
                'param_name' => 'heading_line_height',
                'value' => '34',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_c_1',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'use_custom_heading_color',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Heading Idle', 'softlab' ),
                'param_name' => 'custom_headings_color',
                'value' => esc_attr($header_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Heading Hover', 'softlab' ),
                'param_name' => 'custom_hover_headings_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Blog Font
            // Blog Headings Font
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Blog Content Styles', 'softlab' ),
                'param_name' => 'blog_content_styles',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'softlab' ),
                'param_name' => 'custom_fonts_blog_content',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'softlab' ),
                'param_name' => 'custom_fonts_blog_size_content',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Font Size', 'softlab' ),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Line Height', 'softlab' ),
                'param_name' => 'content_line_height',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_c_2',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'softlab' ),
                'param_name' => 'use_custom_content_color',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Color', 'softlab' ),
                'param_name' => 'custom_content_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            // Blog meta styles
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Blog Meta Styles', 'softlab' ),
                'param_name' => 'blog_meta_styles',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'softlab' ),
                'param_name' => 'custom_fonts_blog_meta',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_meta',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'softlab' ),
                'param_name' => 'custom_fonts_blog_size_meta',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blog Meta Font Size', 'softlab' ),
                'param_name' => 'meta_font_size',
                'value' => '14',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_meta',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3 clearfix-col',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_c_3',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Main Color', 'softlab' ),
                'param_name' => 'use_custom_main_color',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Main Color', 'softlab' ),
                'param_name' => 'custom_main_color',
                'value' => '#abaebe',
                'description' => esc_html__( 'Custom blog meta info color.', 'softlab' ),
                'dependency' => array(
                    'element' => 'use_custom_main_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_c_4',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize \'Read More\' Color', 'softlab' ),
                'param_name' => 'use_custom_read_color',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Read More Idle', 'softlab' ),
                'param_name' => 'custom_read_more_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),             
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Read More Hover', 'softlab' ),
                'param_name' => 'custom_hover_read_more_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
             // Blog Style
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Media Styles', 'softlab' ),
                'param_name' => 'blog_content_styles',
                'group' => esc_html__( 'Styles', 'softlab' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Image Idle Overlay', 'softlab' ),
                'param_name' => 'custom_blog_mask',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Image Overlay Idle', 'softlab' ),
                'param_name' => 'custom_image_mask_color',
                'value' => esc_attr( 'rgba(14,21,30,.6)' ),
                'dependency' => array(
                    'element' => 'custom_blog_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Image Hover Overlay', 'softlab' ),
                'param_name' => 'custom_blog_hover_mask',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Image Overlay Hover', 'softlab' ),
                'param_name' => 'custom_image_hover_mask_color',
                'value' => esc_attr( 'rgba(14,21,30,.6)' ),
                'dependency' => array(
                    'element' => 'custom_blog_hover_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'softlab_param_heading',
                'param_name' => 'divider_c_5',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Items Background', 'softlab' ),
                'param_name' => 'custom_blog_bg_item',
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'softlab' ),
                'param_name' => 'custom_bg_color',
                'value' => esc_attr( 'rgba(19,17,31,1)' ),
                'dependency' => array(
                    'element' => 'custom_blog_bg_item',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
        ),

    ));
    
    Softlab_Loop_Settings::init( 'wgl_blog_posts_standard' );
    
    class WPBakeryShortCode_wgl_Blog_Posts_Standard extends WPBakeryShortCode
    {
    }
    

}