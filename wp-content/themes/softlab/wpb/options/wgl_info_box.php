<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$theme_color = esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary  = esc_attr(Softlab_Theme_Helper::get_option('theme-secondary-color'));
$theme_gradient_start = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Softlab_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(Softlab_Theme_Helper::get_option('main-font')['color']);

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'flaticon', get_template_directory_uri().'/fonts/flaticon/flaticon.css' );
}

if (function_exists( 'vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__( 'Info Box', 'softlab' ),
        'base' => 'wgl_info_box',
        'class' => 'softlab_info_box',
        'category' => esc_html__( 'WGL Modules', 'softlab' ),
        'icon' => 'wgl_icon_info_box',
        'content_element' => true,
        'description' => esc_html__( 'Info Box','softlab' ),
        'params' => array(
        	// GENERAL TAB
        	// Overall layout radio
			array(
				'type' => 'softlab_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'softlab' ),
				'param_name' => 'layout',
				'fields' => array(
					'top' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
					    'label' => esc_html__( 'Top', 'softlab')),
					'left' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
					    'label' => esc_html__( 'Left', 'softlab')),
					'right' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
					    'label' => esc_html__( 'Right', 'softlab')),
				),
				'value' => 'top',
			),
			// Alignment dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'softlab' ),
				'param_name' => 'alignment',
				'value' => array(
					esc_html__( 'Left', 'softlab' )   => 'left',
					esc_html__( 'Center', 'softlab' ) => 'center',
					esc_html__( 'Right', 'softlab' )  => 'right',
				),
				'std' => 'center',
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Hover effect
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'softlab' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on Hover State.', 'softlab'),
				'edit_field_class' => 'vc_col-sm-4',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'softlab' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'softlab')
            ),
            // CONTENT TAB
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Info Box Title', 'softlab' ),
                'param_name' => 'ib_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Info Box Text', 'softlab' ),
                'param_name' => 'ib_content',
                'save_always' => true,
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
            array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Info Box Offsets', 'softlab' ),
				'param_name' => 'ib_offsets',
                'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Add Image for Background', 'softlab' ),
                'param_name' => 'ib_bg_image',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'h_shadow',
				'group' => esc_html__( 'Content', 'softlab' ),
			),
			// Info box shadow
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Info-Box Shadow', 'softlab' ),
				'param_name' => 'add_shadow',
				'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Info box shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'softlab' ),
				'param_name' => 'shadow_appearance',
				'value'	=> array(
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
				'value'	=> array(
					esc_html__( 'Outset', 'softlab' ) => '',
					esc_html__( 'Inset', 'softlab' ) => 'inset',
				),
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
				'value' => '6',
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
				'value' => '13',
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
                'value' => 'rgba(145,145,145,0.2)',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
                'type' => 'softlab_param_heading',
                'param_name' => 'h_button_2',
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
			// Read more button dropdown
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add \'Read More\' Button', 'softlab' ),
				'param_name' => 'add_read_more',
				'value'	=> array(
					esc_html__( 'None', 'softlab' ) => '',
					esc_html__( 'With Custom Text', 'softlab' ) => 'alphameric',
					esc_html__( 'With Custom Icon', 'softlab' ) => 'icon',
				),
				'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'softlab' ),
                'param_name' => 'read_more_text',
                'value' => 'Read More',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value'   => 'alphameric'
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'softlab' ),
                'param_name' => 'read_more_icon_size',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Content', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'icon',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Stick button checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Stick the button', 'softlab' ),
				'param_name' => 'read_more_icon_sticky',
				'description' => esc_html__( 'Attach to the bottom right corner.', 'softlab' ),
				'dependency' => array(
					'element' => 'add_read_more',
					'value' => 'icon'
				),
				'group' => esc_html__( 'Content', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'read_more_icon',
                'value' => 'flaticon-next-1',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'icon',
                ),
                'group' => esc_html__( 'Content', 'softlab' ),
            ),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'softlab' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to \'Read More\' button.', 'softlab' ),
				'dependency' => array(
					'element' => 'add_read_more',
					'value' => array('alphameric', 'icon')
				),
				'group' => esc_html__( 'Content', 'softlab' ),
			),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add Icon or Image', 'softlab' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None', 'softlab' )  => 'none',
                    esc_html__( 'Icon', 'softlab' )  => 'font',
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
                'param_name' => 'icon_font_type',
                'value' => array(
                    esc_html__( 'Flaticon', 'softlab' )    => 'type_flaticon',
                    esc_html__( 'Fontawesome', 'softlab' ) => 'type_fontawesome',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Icon font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'softlab' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Icon', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Icon', 'softlab' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image from Media Library ', 'softlab' ),
                'param_name' => 'thumbnail',
                'value' => '',
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
			// Icon full width
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Full Width Image', 'softlab' ),
				'param_name' => 'bg_full_width',
                'description' => esc_html__( 'Define as \'100%\'.', 'softlab' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image'
                ),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-padding',
			),
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
			array(
				'type' => 'softlab_param_heading',
				'param_name' => 'h_icon_shadow',
				'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
			),
			// Icon container shadow checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Container Shadow', 'softlab' ),
				'param_name' => 'add_icon_shadow',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'softlab' ),
				'param_name' => 'icon_shadow_appearance',
				'value'	=> array(
					esc_html__( 'Visible While Hover', 'softlab' ) => 'on_hover',
					esc_html__( 'Visible Until Hover', 'softlab' ) => 'before_hover',
					esc_html__( 'Always Visible', 'softlab' )      => 'always',
				),
				'std' => 'always',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true'
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Type', 'softlab' ),
				'param_name' => 'icon_shadow_type',
				'value'	=> array(
					esc_html__( 'Outset', 'softlab' ) => '',
					esc_html__( 'Inset', 'softlab' ) => 'inset',
				),
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true'
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'X Offset', 'softlab' ),
				'param_name' => 'icon_shadow_offset_x',
				'value' => '0',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Y Offset', 'softlab' ),
				'param_name' => 'icon_shadow_offset_y',
				'value' => '6',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blur', 'softlab' ),
				'param_name' => 'icon_shadow_blur',
				'value' => '13',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spread', 'softlab' ),
				'param_name' => 'icon_shadow_spread',
				'value' => '0',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'icon_shadow_color',
                'value' => 'rgba(145,145,145,0.2)',
                'dependency' => array(
                    'element' => 'add_icon_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon Container', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // COLORS TAB
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Title Colors', 'softlab' ),
                'param_name' => 'h_title_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'title_color_hover',
                'value' => $header_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Content colors heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Content Colors', 'softlab' ),
                'param_name' => 'h_content_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Content color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_content_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Content color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'content_color',
                'value' => $main_font_color,
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'content_color_hover',
                'value' => $main_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'softlab' ),
                'param_name' => 'h_icon_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Colors', 'softlab' ),
                'param_name' => 'custom_icon_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'icon_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'icon_color_hover',
                'value' => $theme_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon/image container color heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Container Colors', 'softlab' ),
                'param_name' => 'h_icon_bg_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon container colors dropdown
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_icon_bg_color',
				'value' => array(
					esc_html__( 'Theme defaults', 'softlab' )  => '',
					esc_html__( 'Flat colors', 'softlab' )     => 'color',
					esc_html__( 'Gradient colors', 'softlab' ) => 'gradient',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon container color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'icon_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_bg_color',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Icon container hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
				'param_name' => 'icon_bg_color_hover',
				'value' => '#ffffff',
				'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Gradient Start Color', 'softlab' ),
				'param_name' => 'icon_bg_gradient_start',
				'value' => $theme_gradient_start,
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Gradient End Color', 'softlab' ),
				'param_name' => 'icon_bg_gradient_end',
				'value' => $theme_gradient_end,
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon/image border
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Icon Border Colors', 'softlab' ),
                'param_name' => 'h_icon_border_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon container border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_icon_border_color',
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
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Background color
			array(
				'type' => 'softlab_param_heading',
				'heading' => esc_html__( 'Info Box Background Colors', 'softlab' ),
				'param_name' => 'h_bg_colors',
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Background color dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'softlab' ),
				'param_name' => 'custom_bg_color',
				'value' => array(
					esc_html__( 'Theme defaults', 'softlab' )  => '',
					esc_html__( 'Flat colors', 'softlab' )     => 'color',
					esc_html__( 'Gradient colors', 'softlab' ) => 'gradient',
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background idle color 
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Color', 'softlab' ),
				'param_name' => 'ib_bg_color',
				'value' => '#f6f5f3',
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'ib_bg_color_hover',
                'value' => '#f6f5f3',
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_bg_color',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Background gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Gradient Start Color', 'softlab' ),
				'param_name' => 'ib_bg_gradient_start',
				'value' => $theme_gradient_start,
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Gradient End Color', 'softlab' ),
				'param_name' => 'ib_bg_gradient_end',
				'value' => $theme_gradient_end,
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'softlab' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Info Box Border Colors', 'softlab' ),
                'param_name' => 'h_border_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_border_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'border_color',
                'value' => '#cbcbcb',
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'border_color_hover',
                'value' => '#cbcbcb',
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            // Button colors
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Button Colors', 'softlab' ),
                'param_name' => 'h_button_colors',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'softlab' ),
                'param_name' => 'custom_button_color',
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'softlab' ),
                'param_name' => 'button_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Button color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Hover Color', 'softlab' ),
                'param_name' => 'button_color_hover',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // button color on info box hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Item Hover Color', 'softlab' ),
                'param_name' => 'button_color_item_hover',
                'value' => $header_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'softlab' ),
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Title styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Title Styles', 'softlab' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'softlab' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                    esc_html__( '‹div›', 'softlab' )  => 'div',
                    esc_html__( '‹h2›', 'softlab' )   => 'h2',
                    esc_html__( '‹h3›', 'softlab' )   => 'h3',
                    esc_html__( '‹h4›', 'softlab' )   => 'h4',
                    esc_html__( '‹h5›', 'softlab' )   => 'h5',
                    esc_html__( '‹h6›', 'softlab' )   => 'h6',
                ),
                'std' => 'h3',
                'description' => esc_html__( 'Choose your tag for info box title', 'softlab' ),
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
                    esc_html__( 'Theme defaults', 'softlab' )   => '',
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
            // Title margin bottom
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Bottom Offset', 'softlab' ),
                'param_name' => 'title_bot_offset',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for info box title', 'softlab' ),
                'param_name' => 'custom_fonts_title',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
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
            // Content styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( 'Content Styles', 'softlab' ),
                'param_name' => 'h_content_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content Tag', 'softlab' ),
                'param_name' => 'content_tag',
                'value' => array(
                    esc_html__( '‹span›', 'softlab' ) => 'span',
                    esc_html__( '‹div›', 'softlab' )  => 'div',
                    esc_html__( '‹h2›', 'softlab' )   => 'h2',
                    esc_html__( '‹h3›', 'softlab' )   => 'h3',
                    esc_html__( '‹h4›', 'softlab' )   => 'h4',
                    esc_html__( '‹h5›', 'softlab' )   => 'h5',
                    esc_html__( '‹h6›', 'softlab' )   => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'description' => esc_html__( 'Choose your tag for info box content', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content Font Weight', 'softlab' ),
                'param_name' => 'content_weight',
                'value' => array(
                    esc_html__( 'Theme defaults', 'softlab' )   => '',
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
            // Content font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Font Size', 'softlab' ),
                'param_name' => 'content_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content line height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Line Height', 'softlab' ),
                'param_name' => 'content_line_height',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for info box content', 'softlab' ),
                'param_name' => 'custom_fonts_content',
                'description' => esc_html__( 'Customize font family', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_content',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_content',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'softlab' ),
            ),
            // Button styles heading
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__( '\'Read More\' Button Styles', 'softlab' ),
                'param_name' => 'h_button_styles',
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Font Size', 'softlab' ),
                'param_name' => 'button_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Top Offset', 'softlab' ),
                'param_name' => 'read_more_offset',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'softlab' ),
                'group' => esc_html__( 'Typography', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Button Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for Button', 'softlab' ),
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
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_info_box extends WPBakeryShortCode {
            
        }
    } 
}
