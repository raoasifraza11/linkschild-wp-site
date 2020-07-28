<?php

if ( !class_exists('Vc_Manager') || !class_exists('Softlab_Core') ) return;

if(!class_exists('Wgl_vc_register')){
    class Wgl_vc_register{
        function __construct (){
            $this->add_action();
            $this->custom_fields();
            $this->register_modules();
            $this->params_remove();
            $this->add_params();
        }

        function custom_fields () {
            require_once get_template_directory() . '/wpb/addon_fields/radio_image.php';
            require_once get_template_directory() . '/wpb/addon_fields/multi_select.php';
            require_once get_template_directory() . '/wpb/addon_fields/checkbox_custom.php';
            require_once get_template_directory() . '/wpb/addon_fields/heading_line.php';
            
            //Class Query Settings
            require_once ( get_template_directory() . '/wpb/build-query.php' );
            // Google fonts render class
            include_once get_template_directory() . '/wpb/google_fonts_enqueue.php';
        }

        function register_modules () {
            $softlab_shortcodes = array(
                'wgl_blog_posts_standard',
                'wgl_blog_posts_medium_img',
                'wgl_blog_posts_tiny_img',
                'wgl_counter',
                'wgl_carousel',
                'wgl_split_slider',
                'wgl_split_slider_left',
                'wgl_split_slider_right',
                'wgl_split_slider_item',
                'wgl_testimonials',
                'wgl_info_box',
                'wgl_services',
                'wgl_services_2',
                'wgl_services_3',
                'wgl_circuit_services',
                'wgl_flip_box',
                'wgl_image_layers',
                'wgl_pricing_table',
                'wgl_message_box',
                'wgl_button',
                'wgl_double_headings',
                'wgl_custom_text',
                'wgl_countdown',
                'wgl_video_popup',
                'wgl_spacing',
                'wgl_clients',
                'wgl_demo_item',
                'wgl_earth',
                'wgl_soc_icons',
                'wgl_time_line_vertical',
                'wgl_time_line_horizontal',
                'wgl_progress_bar',
                'wgl_divider',
                'wgl_blog_categories',
                'wgl_timetabs_wrapper',
                'wgl_timetabs_container',
                'wgl_timetabs_item',
                'wgl_ico_progress',
                'wgl_ico_progress_bar',
            );

            foreach ($softlab_shortcodes as $softlab_shortcode) {
                require_once get_template_directory() . '/wpb/options/' . $softlab_shortcode . '.php';
            }
        }

        function add_action () {

            add_action('vc_before_init', 'softlab_wpbThemeSupport');
            function softlab_wpbThemeSupport() {
                vc_set_as_theme($disable_updater = true);
            }

            // Set default path to templates
            $softlab_dir = get_template_directory() . '/wpb/templates';
            vc_set_shortcodes_templates_dir( $softlab_dir );
        }

        function params_remove () {
            // Remove options from tabs
            $remove_params = array(
                array( 'vc_tta_tour', 'style' ),
                array( 'vc_tta_tour', 'no_fill_content_area' ),
                array( 'vc_tta_tour', 'color' ),
                array( 'vc_tta_tour', 'shape' ),
                array( 'vc_tta_tour', 'gap' ),
                array( 'vc_tta_tour', 'spacing' ),
                array( 'vc_tta_tour', 'pagination_style' ),
                array( 'vc_tta_tour', 'pagination_color' ),
                // Remove tab options
                array( 'vc_tta_tabs', 'spacing' ),
                array( 'vc_tta_tabs', 'style' ),
                array( 'vc_tta_tabs', 'pagination_style' ),
                array( 'vc_tta_tabs', 'color' ),
                array( 'vc_tta_tabs', 'gap' ),
                array( 'vc_tta_tabs', 'pagination_color' ),
                array( 'vc_tta_tabs', 'shape' ),
                array( 'vc_tta_tabs', 'no_fill_content_area' ),
                // Remove Toggle options
                array( 'vc_toggle', 'custom_custom_fonts' ),
                array( 'vc_toggle', 'style' ),
                array( 'vc_toggle', 'custom_font_container' ),
                array( 'vc_toggle', 'custom_css_animation' ),
                array( 'vc_toggle', 'use_custom_heading' ),
                array( 'vc_toggle', 'custom_el_class' ),
                array( 'vc_toggle', 'custom_google_fonts' ),
                // Remove accordion options
                array( 'vc_tta_accordion', 'no_fill' ),
                array( 'vc_tta_accordion', 'gap' ),
                array( 'vc_tta_accordion', 'color' ),
                array( 'vc_tta_accordion', 'shape' ),
                array( 'vc_tta_accordion', 'spacing' ),
            );
            foreach ($remove_params as $element => $param) {
                vc_remove_param( $param[0], $param[1] );
            }
        }

        function add_params () {
            vc_add_param( 'vc_toggle' , array(
                'type' => 'dropdown',
                'heading' => 'Icon',
                'param_name' => 'color',
                'value' => array(
                    esc_html__( 'None', 'softlab' ) => 'none',
                    esc_html__( 'Check', 'softlab' ) => 'check',
                    esc_html__( 'Chevron', 'softlab' ) => 'chevron',
                    esc_html__( 'Plus', 'softlab' ) => 'plus',
                    esc_html__( 'Triangle', 'softlab' ) => 'triangle',
                )
            ));
            vc_add_param( 'vc_toggle' , array(
                'type' => 'dropdown',
                'heading' => 'Icon Position',
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Left', 'softlab' ) => 'left',
                    esc_html__( 'Right', 'softlab' ) => 'right',
                    esc_html__( 'center', 'softlab' ) => 'center',
                )
            ));

            $row_params = array(
                array(
                    'type' => 'wgl_checkbox',
                    'param_name' => 'add_extended',                    
                    'heading' => esc_html__( 'Add Extended Background Animation', 'softlab' ),       
                    'group' => esc_html__( 'Extended Animation', 'softlab' ),
                ),

                array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Values', 'softlab' ),
                    'param_name' => 'values',
                    'group' => esc_html__( 'Extended Animation', 'softlab' ),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Choose your animation',
                            'param_name' => 'extended_animation',
                            'value' => array(
                                esc_html__( 'Morph', 'softlab' ) => 'morph',
                                esc_html__( 'Sphere', 'softlab' ) => 'sphere',
                                esc_html__( 'Particles', 'softlab' ) => 'particles',
                                esc_html__( 'Hexagons', 'softlab' ) => 'hexagons',
                                esc_html__( 'Parallax Image', 'softlab' ) => 'parallax',
                                esc_html__( 'Particles Text', 'softlab' ) => 'text',
                            ),
                            'admin_label'   => true,
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Figure Color', 'softlab'),
                            'param_name' => 'figure_color',
                            'value' => '#ffffff',
                            'description' => esc_html__('Select sphere color', 'softlab'),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        /*array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Text', 'softlab' ),
                            'value' => esc_html__( 'Text', 'softlab' ),
                            'param_name' => 'particles_text',
                            'edit_field_class' => 'vc_col-sm-12',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('text')
                            ),
                        ),*/
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Choose Colors Type',
                            'param_name' => 'drop_colors',
                            'value' => array(
                                esc_html__( 'One Color', 'softlab' ) => 'one_color',
                                esc_html__( 'Random Colors', 'softlab' ) => 'random_colors',
                            ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Particles Color', 'softlab'),
                            'param_name' => 'part_color',
                            'value' => '#ff7e00',
                            'dependency' => array(
                                'element' => 'drop_colors',
                                'value' => 'one_color'
                            ),
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Particles Color 1', 'softlab'),
                            'param_name' => 'part_color_1',
                            'value' => '#ff7e00',
                            'dependency' => array(
                                'element' => 'drop_colors',
                                'value' => 'random_colors'
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Particles Color 2', 'softlab'),
                            'param_name' => 'part_color_2',
                            'value' => '#3224e9',
                            'dependency' => array(
                                'element' => 'drop_colors',
                                'value' => 'random_colors'
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Particles Color 3', 'softlab'),
                            'param_name' => 'part_color_3',
                            'value' => '#69e9f2',
                            'dependency' => array(
                                'element' => 'drop_colors',
                                'value' => 'random_colors'
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Vertical position', 'softlab'),
                            'param_name' => 'extended_animation_pos_vertical',
                            'value' => '50',
                            'description' => esc_html__( 'Enter vertical position from top in %.', 'softlab' ),
                            'edit_field_class' => 'vc_col-sm-6',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Horizontal position', 'softlab'),
                            'param_name' => 'extended_animation_pos_horizont',
                            'value' => '50',
                            'description' => esc_html__( 'Enter horizontal position from left in %.', 'softlab' ),
                            'edit_field_class' => 'vc_col-sm-6',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Sphere Size', 'softlab'),
                            'param_name' => 'sphere_width',
                            'value' => '100',
                            'description' => esc_html__( 'Set size of sphere in pixels.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'wgl_checkbox',
                            'heading' => esc_html__('Add Inside Second Sphere', 'softlab'),
                            'param_name' => 'add_second_sphere',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Number of Particles', 'softlab'),
                            'param_name' => 'particles_number',
                            'value' => '50',
                            'description' => esc_html__( 'Set number of particles (default:50)', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Particles Max Size', 'softlab'),
                            'param_name' => 'particles_size',
                            'value' => '10',
                            'description' => esc_html__( 'Set particles max size (default:10)', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Particles Speed', 'softlab'),
                            'param_name' => 'particles_speed',
                            'value' => '2',
                            'description' => esc_html__( 'Set particles speed (default:2)', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-4',
                        ),
                        array(
                            'type' => 'wgl_checkbox',
                            'param_name' => 'add_line',                    
                            'heading' => esc_html__( 'Add Linked Line', 'softlab' ),
                            'std' => '',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Hover Animation',
                            'param_name' => 'hover_anim',
                            'value' => array(
                                esc_html__( 'Grab', 'softlab' ) => 'grab',
                                esc_html__( 'Bubble', 'softlab' ) => 'bubble',
                                esc_html__( 'Repulse', 'softlab' ) => 'repulse',
                                esc_html__( 'None', 'softlab' ) => 'none',
                            ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'attach_image',
                            'heading' => esc_html__('Parallax Image', 'softlab'),
                            'param_name' => 'image_bg',
                            'description' => esc_html__( 'Select image from media library.', 'softlab' ),
                            'edit_field_class' => 'vc_col-sm-12',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'parallax'
                            ),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Parallax Direction',
                            'param_name' => 'parallax_dir',
                            'description' => esc_html__( 'This dropdown has two values: vertical, horizontal.', 'softlab' ),
                            'value' => array(
                                esc_html__( 'Vertical', 'softlab' ) => 'vertical',
                                esc_html__( 'Horizontal', 'softlab' ) => 'horizontal',
                            ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'parallax'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Parallax Factor', 'softlab'),
                            'param_name' => 'parallax_factor',
                            'value' => '0.3',
                            'description' => esc_html__( 'Set elements offset and speed. It can be positive (0.3) or negative (-0.3). Less means slower.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'parallax'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Morph Style',
                            'param_name' => 'morph_style',
                            'value' => array(
                                esc_html__( 'Style 1', 'softlab' ) => 'style_1',
                                esc_html__( 'Style 2', 'softlab' ) => 'style_2',
                                esc_html__( 'Style 3', 'softlab' ) => 'style_3',
                            ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'morph'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Speed Animation', 'softlab'),
                            'param_name' => 'morph_speed',
                            'value' => '10',
                            'description' => esc_html__( 'Set morph animation speed in seconds', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'morph'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Background Color', 'softlab'),
                            'param_name' => 'morph_color',
                            'value' => '#f7f9fd',
                            'description' => esc_html__('Select morph color', 'softlab'),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'morph'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Morph Rotation', 'softlab'),
                            'param_name' => 'morph_rotation',
                            'value' => '0',
                            'description' => esc_html__( 'Сhoose the rotation angle.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('morph')
                            ),
                            'edit_field_class' => 'vc_col-sm-12',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Top Offset', 'softlab'),
                            'param_name' => 'particles_position_top',
                            'value' => '0',
                            'description' => esc_html__( 'Set figure vertical offset from top border.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','parallax', 'morph','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Left Offset', 'softlab'),
                            'param_name' => 'particles_position_left',
                            'value' => '0',
                            'description' => esc_html__( 'Set figure horizontal offset from left border.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons','parallax', 'morph','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Width in Percent', 'softlab'),
                            'param_name' => 'particles_width',
                            'value' => '100',
                            'description' => esc_html__( 'Set figure width in percent.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons', 'morph','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Height in Percent', 'softlab'),
                            'param_name' => 'particles_height',
                            'value' => '100',
                            'description' => esc_html__( 'Set figure width in percent.', 'softlab' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => array('particles','hexagons', 'morph','text')
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'wgl_checkbox',
                            'param_name' => 'hide_on_mobile',                    
                            'heading' => esc_html__( 'Hide on Mobile', 'softlab' ),
                            'std' => '',
                            'edit_field_class' => 'vc_col-sm-12',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Screen Resolution', 'softlab' ),
                            'param_name' => 'resp_hide',
                            'value' => '768',
                            'edit_field_class' => 'vc_col-sm-12',
                            'dependency' => array(
                                'element' => 'hide_on_mobile',
                                'value' => 'true',
                            ),
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'add_extended',
                        'value' => 'true'
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Row z-index', 'softlab'),
                    'param_name' => 'z_index',
                    'value' => '1',
                    'group' => esc_html__( 'Extended Animation', 'softlab' ),
                    'description' => esc_html__( 'Set order of the row.', 'softlab' ),
                    'edit_field_class' => 'vc_col-sm-6',
                ),
            );

            vc_add_params('vc_row', $row_params);
            
            $menu_params = array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Alignment', 'softlab' ),
                    'param_name' => 'menu_alignment',
                    'value'         => array(
                        esc_html__( 'Center', 'softlab' ) => 'center',
                        esc_html__( 'Left', 'softlab' )   => 'left',
                        esc_html__( 'Right', 'softlab' )  => 'right',
                        esc_html__( 'Block', 'softlab' )  => 'block'
                    ),
                    'description' => esc_html__('Select menu item alignment.', 'softlab')
                ),  
                
            );
            vc_add_params('vc_wp_custommenu', $menu_params);         

            $vc_col_params = array(
                array(
                    'type' => 'wgl_checkbox',
                    'param_name' => 'sticky_col',                    
                    'heading' => esc_html__( 'Add Sticky Column', 'softlab' ),
                ),
            );
            vc_add_params('vc_column', $vc_col_params);
            
            $vc_col_bg_params = array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Background position on X-axis', 'softlab'),
                    'param_name' => 'col_pos_horizont',
                    'value' => '0',
                    'description' => esc_html__( 'Enter horizontal position from left.', 'softlab' ),
                    'edit_field_class' => 'vc_col-sm-5',
                    'group' => esc_html__( 'Design Options', 'softlab' ),
                ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Background position X-axis units', 'softlab'),
					'param_name' => 'col_pos_horizont_units',
					'value' => array(
						esc_html__( 'Percentages', 'softlab' ) => '%',
						esc_html__( 'Pixels', 'softlab' )      => 'px',
					),
					'std' => '%',
					'description' => esc_html__( 'Select units for horizontal position.', 'softlab' ),
					'edit_field_class' => 'vc_col-sm-5',
					'group' => esc_html__( 'Design Options', 'softlab' ),
				),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Background position on Y-axis', 'softlab'),
                    'param_name' => 'col_pos_vertical',
                    'value' => '0',
                    'description' => esc_html__( 'Enter vertical position from top.', 'softlab' ),
                    'edit_field_class' => 'vc_col-sm-5',
                    'group' => esc_html__( 'Design Options', 'softlab' ),
                ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Background position Y-axis units', 'softlab'),
					'param_name' => 'col_pos_vertical_units',
					'value' => array(
						esc_html__( 'Percentages', 'softlab' ) => '%',
						esc_html__( 'Pixels', 'softlab' )      => 'px',
					),
					'std' => '%',
					'description' => esc_html__( 'Select units for vertical position.', 'softlab' ),
					'edit_field_class' => 'vc_col-sm-5',
					'group' => esc_html__( 'Design Options', 'softlab' ),
				),
                
            );
            vc_add_params('vc_column', $vc_col_bg_params);         
        }
    }
    new Wgl_vc_register();
}

//Add inline styles to enqueue
if(!function_exists('Softlab_shortcode_css')){
    function Softlab_shortcode_css() {
        return Softlab_shortcode_css::instance();
    }
}

if ( !class_exists( "Softlab_shortcode_css" ) ){
    class Softlab_shortcode_css{
        public $settings;
        protected static $instance = null;

        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }    
        public function enqueue_softlab_css( $style ) {
            if(!empty($style)){
                ob_start();             
                    echo Softlab_Theme_Helper::render_html($style);
                $css = ob_get_clean();
                $css = apply_filters( 'softlab_enqueue_shortcode_css', $css, $style );
            }

        }
    }
}
//Add inline styles to enqueue

// Filter to replace default css class names for vc_row shortcode and vc_column
if(!class_exists('Wgl_vc_column')){
    class Wgl_vc_column{

        static public $row_atts = '';

        public static function wgl_vc_column_before($atts, $content){			
            extract( $atts); 
            self::$row_atts = $atts;

            add_filter( 'vc_shortcodes_css_class', 'Wgl_vc_column::add_custom_css_classes_for_vc_column', 10, 2);

        }
        public static function add_custom_css_classes_for_vc_column( $class_string, $tag ) {
            
            if (isset(self::$row_atts['sticky_col']) && $tag == 'vc_column') {
                $class_string .= ' sticky-sidebar';
                wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array(), false, false);
            }
            
            return $class_string;
        }
    }
    new Wgl_vc_column;
}

if ( !function_exists( 'vc_theme_before_vc_column' ) ) {
    function vc_theme_before_vc_column($atts, $content = null) {
        return Wgl_vc_column::wgl_vc_column_before($atts, $content);
    }
}
