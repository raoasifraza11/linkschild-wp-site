<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services', 'softlab'),
        'base' => 'wgl_services',
        'class' => 'softlab_services',
        'category' => esc_html__('WGL Modules', 'softlab'),
        'icon' => 'wgl_icon_services',
        'content_element' => true,
        'description' => esc_html__('Add Services','softlab'),
        'params' => array(
            // General
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Service Animation', 'softlab' ),
                'param_name' => 'service_anim',
                'value'         => array(
                    esc_html__( 'Fade', 'softlab' )      => 'fade',
                    esc_html__( 'Front Side Slide', 'softlab' )      => 'front_slide',
                    esc_html__( 'Back Side Slide', 'softlab' )      => 'back_slide',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Animation Direction', 'softlab' ),
                'param_name' => 'anim_dir',
                'value'         => array(
                    esc_html__( 'Slide to Right', 'softlab' )      => 'to_right',
                    esc_html__( 'Slide to Left', 'softlab' )      => 'to_left',
                    esc_html__( 'Slide to Top', 'softlab' )      => 'to_top',
                    esc_html__( 'Slide to Bottom', 'softlab' )      => 'to_bottom',
                ),
                'dependency' => array(
                    'element' => 'service_anim',
                    'value' => array('front_slide','back_slide'),
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'softlab' ),
                'param_name'    => 'service_align',
                'value'         => array(
					esc_html__( 'Left', 'softlab' )   => 'left',
					esc_html__( 'Center', 'softlab' ) => 'center',
					esc_html__( 'Right', 'softlab' )  => 'right',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'softlab'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'softlab')
            ),
            // Front Side
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Front Side Background', 'softlab'),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'front_bg_style',
                'value'         => array(
                    esc_html__( 'Frame', 'softlab' )      => 'front_frame',
                    esc_html__( 'Color', 'softlab' )      => 'front_color',
                    esc_html__( 'Image', 'softlab' )      => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Frame Color', 'softlab'),
                'param_name' => 'front_frame_color',
                'value' => 'rgba(255,255,255,0.3)',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => array('front_frame','front_color')
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'softlab'),
                'param_name' => 'front_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'softlab'),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Front Side Icon', 'softlab'),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Info Box Icon/Image
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_type',
                'value'         => array(
                    esc_html__( 'None', 'softlab' )      => 'none',
                    esc_html__( 'Font', 'softlab' )      => 'font',
                    esc_html__( 'Image', 'softlab' )     => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_font_type',
                'value'         => array(
                    esc_html__( 'Fontawesome', 'softlab' )      => 'type_fontawesome',
                    esc_html__( 'Flaticon', 'softlab' )      => 'type_flaticon',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'softlab' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'softlab' ),
                'param_name' => 'front_icon_thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            // Custom image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Width', 'softlab'),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter image size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Height', 'softlab'),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Enter image size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'softlab'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'softlab' ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Color', 'softlab'),
                'param_name' => 'front_icon_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Front Side Title
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Front Side Title', 'softlab'),
                'param_name' => 'h_front_title',
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_title',
                'heading' => esc_html__('Title', 'softlab'),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'softlab'),
                'param_name' => 'front_title_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            // Front Side Title
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Front Side Description', 'softlab'),
                'param_name' => 'h_front_descr',
                'group' => esc_html__( 'Front Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_descr',
                'heading' => esc_html__('Description', 'softlab'),
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Color', 'softlab'),
                'param_name' => 'front_descr_color',
                'value' => '#bebebe',
                'group' => esc_html__( 'Front Side', 'softlab' ),
            ),
            // Back Side
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Back Side Background', 'softlab'),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'back_bg_style',
                'value'         => array(
                    esc_html__( 'Color', 'softlab' )      => 'back_color',
                    esc_html__( 'Image', 'softlab' )      => 'back_image',
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'softlab'),
                'param_name' => 'back_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'softlab'),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'softlab' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
            ),
            array(
                'type' => 'softlab_param_heading',
                'heading' => esc_html__('Back Side Button', 'softlab'),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'softlab' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'softlab'),
                'param_name' => 'read_more_text',
                'value' => esc_html__('Read More', 'softlab'),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'softlab' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'softlab'),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'softlab' ),
                'param_name' => 'button_customize',
                'value'         => array(
                    esc_html__( 'Default', 'softlab' )        => 'def',
                    esc_html__( 'Color', 'softlab' )          => 'color',
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // Button text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'softlab'),
                'param_name' => 'button_text_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom text color for button.', 'softlab'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Text Color', 'softlab'),
                'param_name' => 'button_text_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom text color for hover button.', 'softlab'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background', 'softlab'),
                'param_name' => 'button_bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom background for button.', 'softlab'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Background', 'softlab'),
                'param_name' => 'button_bg_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom background for hover button.', 'softlab'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Border Color', 'softlab'),
                'param_name' => 'button_border_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom border color for button.', 'softlab'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Border Color', 'softlab'),
                'param_name' => 'button_border_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom border color for hover button.', 'softlab'),
                'group' => esc_html__( 'Back Side', 'softlab' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services extends WPBakeryShortCode {
        }
    }
}