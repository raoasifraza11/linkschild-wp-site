<?php

    if ( !class_exists( 'Softlab_Core' ) ) {
        return;
    }

    if (!function_exists('wgl_get_redux_icons')) {
        function wgl_get_redux_icons() {
            return WglAdminIcon()->get_icons_name( true );
        }

        add_filter('redux/font-icons', 'wgl_get_redux_icons');
    }

    if (!function_exists('softlab_get_preset')) {
        function softlab_get_preset() {
            $custom_preset = get_option('softlab_set_preset');
            $presets = function_exists('softlab_default_preset') ? softlab_default_preset() : '';

            $out = [];
            $i = 1;
            if(is_array($presets)){
                foreach ($presets as $key => $value) {
                    if($key != 'img'){
                        $out[$key] = $key;
                        $i++;
                    }
                }
            }
            if(is_array($custom_preset)){
                foreach ( $custom_preset as $preset_id => $preset) :
                    if($preset_id != 'default' && $preset_id != 'img'){
                        $out[$preset_id] = $preset_id;
                    }
                endforeach;
            }
            return $out;
        }
    }

    if (!function_exists('softlab_redux_get_custom_menu')) {
        function softlab_redux_get_custom_menu() {
            $taxonomies = [];

            $menus = get_terms('nav_menu');
            foreach ($menus as $key => $value) {
                $taxonomies[$value->name] = $value->name;
            }
            return $taxonomies;
        }
    }

    // This is theme option name where all the Redux data is stored.
    $theme_slug = 'softlab_set';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    $theme = wp_get_theme();

    $args = [
        'opt_name' => $theme_slug,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version' => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type' => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => true,
        // Show the sections below the admin menu item or not
        'menu_title' => esc_html__('Theme Options', 'softlab'),
        'page_title' => esc_html__('Theme Options', 'softlab'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => true,
         // Show the panel pages on the admin bar
        'admin_bar' => true,
        'admin_bar_icon' => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => true,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_priority' => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => 'dashicons-admin-generic',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => true,
         // Shows the Import/Export panel when not used as a field.
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn' => true,
    ];


    Redux::setArgs( $theme_slug, $args );

    // -> START Basic Fields
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('General', 'softlab'),
        'id' => 'general',
        'icon' => 'el el-cog',
        'fields' => [
            [
                'id' => 'use_minify',
                'type' => 'switch',
                'title' => esc_html__('Use minify css/js files', 'softlab'),
                'desc' => esc_html__('Recommended for site load speed.', 'softlab'),
            ],
            [
                'id' => 'preloder_settings',
                'type' => 'section',
                'title' => esc_html__('Preloader Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'preloader',
                'type' => 'switch',
                'title' => esc_html__('Preloader On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'preloader_background',
                'type' => 'color',
                'title' => esc_html__('Preloader Background', 'softlab'),
                'subtitle' => esc_html__('Set Preloader Background', 'softlab'),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => [ 'preloader', '=', '1' ],
            ],
            [
                'id' => 'preloader_color_1',
                'type' => 'color',
                'title' => esc_html__('Preloader Color', 'softlab'),
                'default'  => '#f57479',
                'transparent' => false,
                'required' => [ 'preloader', '=', '1' ],
            ],
            [
                'id' => 'preloader_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'search_settings',
                'type' => 'section',
                'title' => esc_html__('Search Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'search_style',
                'type' => 'button_set',
                'title' => esc_html__('Choose your search style.', 'softlab'),
                'options'  => [
                    'standard' => esc_html__('Standard', 'softlab'),
                    'alt' => esc_html__('Alternative', 'softlab'),
                ],
                'default'  => 'standard'
            ],
             [
                'id' => 'search_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'scroll_up_settings',
                'type' => 'section',
                'title' => esc_html__('Scroll Up Button Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'scroll_up',
                'type' => 'switch',
                'title' => esc_html__('Button On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'scroll_up_bg_color',
                'type' => 'color',
                'title' => esc_html__('Button Background Color', 'softlab'),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => [ 'scroll_up', '=', '1' ],
            ],
            [
                'id' => 'scroll_up_arrow_color',
                'type' => 'color',
                'title' => esc_html__('Button Arrow Color', 'softlab'),
                'default'  => '#664bc4',
                'transparent' => false,
                'required' => [ 'scroll_up', '=', '1' ],
            ],
            [
                'id' => 'scroll_up_settings-end',
                'type' => 'section',
                'indent' => false,
            ],
        ],
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Custom JS', 'softlab'),
        'id' => 'editors-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'custom_js',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom JS', 'softlab'),
                'subtitle' => esc_html__('Paste your JS code here.', 'softlab'),
                'mode' => 'javascript',
                'theme' => 'chrome',
                'default'  => ''
            ],
            [
                'id' => 'header_custom_js',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom JS', 'softlab'),
                'subtitle' => esc_html__('Code to be added inside HEAD tag', 'softlab'),
                'mode' => 'html',
                'theme' => 'chrome',
                'default'  => ''
            ],
        ],
    ] );

    // -> START Basic Fields
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Header', 'softlab'),
        'id' => 'header_section',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Logo', 'softlab'),
        'id' => 'logo',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'header_logo',
                'type' => 'media',
                'title' => esc_html__('Header Logo', 'softlab'),
            ],
            [
                'id' => 'logo_height_custom',
                'type' => 'switch',
                'title' => esc_html__('Enable Logo Height', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'logo_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Set Logo Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ],
                'required' => [ 'logo_height_custom', '=', '1' ],
            ],
            [
                'id' => 'logo_sticky',
                'type' => 'media',
                'title' => esc_html__('Sticky Logo', 'softlab'),
            ],
            [
                'id' => 'sticky_logo_height_custom',
                'type' => 'switch',
                'title' => esc_html__('Enable Sticky Logo Height', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'sticky_logo_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Set Sticky Logo Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '',
                ],
                'required' => [
                    [ 'sticky_logo_height_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'logo_mobile',
                'type' => 'media',
                'title' => esc_html__('Mobile Logo', 'softlab'),
            ],
            [
                'id' => 'mobile_logo_height_custom',
                'type' => 'switch',
                'title' => esc_html__('Enable Mobile Logo Height', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'mobile_logo_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Set Mobile Logo Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '',
                ],
                'required' => [
                    [ 'mobile_logo_height_custom', '=', '1' ],
                ],
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Header Builder', 'softlab'),
        'id' => 'header-customize',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'header_def_js_preset',
                'type' => 'select',
                'title' => esc_html__('Header default preset', 'softlab'),
                'default'  => '',
                'select2'  => ['allowClear' => false],
                'options'  => softlab_get_preset(),
                'desc' => esc_html__('Please choose preset to use this in all Pages.
                    You also can choose for every page your custom header present in page\'s option select(page metabox).', 'softlab'),
            ],
            [
                'id' => 'opt-js-preset',
                'type' => 'custom_preset',
                'title' => esc_html__('Custom Preset', 'softlab'),
            ],
            [
                'id' => 'bottom_header_layout',
                'type' => 'custom_header_builder',
                'title' => esc_html__('Header Builder', 'softlab'),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => [
                    'items'  => [
                        'html1' => [ 'title' => esc_html__('HTML 1', 'softlab'), 'settings' => true] ,
                        'html2'  =>  [ 'title' => esc_html__('HTML 2', 'softlab'), 'settings' => true] ,
                        'html3' => [ 'title' => esc_html__('HTML 3', 'softlab'), 'settings' => true] ,
                        'html4'  =>  [ 'title' => esc_html__('HTML 4', 'softlab'), 'settings' => true] ,
                        'html5' => [ 'title' => esc_html__('HTML 5', 'softlab'), 'settings' => true] ,
                        'html6'  =>  [ 'title' => esc_html__('HTML 6', 'softlab'), 'settings' => true] ,
                        'html7'  =>  [ 'title' => esc_html__('HTML 7', 'softlab'), 'settings' => true] ,
                        'html8'  =>  [ 'title' => esc_html__('HTML 8', 'softlab'), 'settings' => true] ,
                        'wpml' =>  [ 'title' => esc_html__('WPML', 'softlab'), 'settings' => false] ,
                        'delimiter1'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter2'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter3'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter4'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter5'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter6'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'spacer3'  =>  [ 'title' => esc_html__('Spacer 3', 'softlab'), 'settings' => true] ,
                        'spacer4'  =>  [ 'title' => esc_html__('Spacer 4', 'softlab'), 'settings' => true] ,
                        'spacer5'  =>  [ 'title' => esc_html__('Spacer 5', 'softlab'), 'settings' => true] ,
                        'spacer6'  =>  [ 'title' => esc_html__('Spacer 6', 'softlab'), 'settings' => true] ,
                        'spacer7'  =>  [ 'title' => esc_html__('Spacer 7', 'softlab'), 'settings' => true] ,
                        'spacer8'  =>  [ 'title' => esc_html__('Spacer 8', 'softlab'), 'settings' => true] ,
                        'button1'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button2'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button3'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button4'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'cart' =>  [ 'title' => esc_html__('Cart', 'softlab'), 'settings' => false] ,
                        'spacer1'  =>  [ 'title' => esc_html__('Spacer 1', 'softlab'), 'settings' => true] ,
                        'side_panel' =>  [ 'title' => esc_html__('Side Panel', 'softlab'), 'settings' => false] ,
                    ],
                    'Top Left area' => [],
                    'Top Center area' => [],
                    'Top Right area' => [],
                    'Middle Left area' => [
                        'logo' => [ 'title' => esc_html__('Logo', 'softlab'), 'settings' => false],
                        'spacer2'  =>  [ 'title' => esc_html__('Spacer 2', 'softlab'), 'settings' => true] ,
                        'menu' => [ 'title' => esc_html__('Menu', 'softlab'), 'settings' => false],
                    ],
                    'Middle Center area' => [

                    ],
                    'Middle Right area' => [
                        'item_search'  =>  [ 'title' => esc_html__('Search', 'softlab'), 'settings' => false] ,

                    ],
                    'Bottom Left  area' => [
                    ],
                    'Bottom Center area' => [
                    ],
                    'Bottom Right area' => [
                    ],
                ],
                'default' => [
                    'items'  => [
                        'html1' => [ 'title' => esc_html__('HTML 1', 'softlab'), 'settings' => true] ,
                        'html2'  =>  [ 'title' => esc_html__('HTML 2', 'softlab'), 'settings' => true] ,
                        'html3' => [ 'title' => esc_html__('HTML 3', 'softlab'), 'settings' => true] ,
                        'html4'  =>  [ 'title' => esc_html__('HTML 4', 'softlab'), 'settings' => true] ,
                        'html5' => [ 'title' => esc_html__('HTML 5', 'softlab'), 'settings' => true] ,
                        'html6'  =>  [ 'title' => esc_html__('HTML 6', 'softlab'), 'settings' => true] ,
                        'html7'  =>  [ 'title' => esc_html__('HTML 7', 'softlab'), 'settings' => true] ,
                        'html8'  =>  [ 'title' => esc_html__('HTML 8', 'softlab'), 'settings' => true] ,
                        'wpml' =>  [ 'title' => esc_html__('WPML', 'softlab'), 'settings' => false] ,
                        'delimiter1'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter2'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter3'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter4'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter5'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'delimiter6'  =>  [ 'title' => esc_html__('|', 'softlab'), 'settings' => true] ,
                        'spacer3'  =>  [ 'title' => esc_html__('Spacer 3', 'softlab'), 'settings' => true] ,
                        'spacer4'  =>  [ 'title' => esc_html__('Spacer 4', 'softlab'), 'settings' => true] ,
                        'spacer5'  =>  [ 'title' => esc_html__('Spacer 5', 'softlab'), 'settings' => true] ,
                        'spacer6'  =>  [ 'title' => esc_html__('Spacer 6', 'softlab'), 'settings' => true] ,
                        'spacer7'  =>  [ 'title' => esc_html__('Spacer 7', 'softlab'), 'settings' => true] ,
                        'spacer8'  =>  [ 'title' => esc_html__('Spacer 8', 'softlab'), 'settings' => true] ,
                        'button1'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button2'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button3'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'button4'  =>  [ 'title' => esc_html__('Button', 'softlab'), 'settings' => true] ,
                        'cart' =>  [ 'title' => esc_html__('Cart', 'softlab'), 'settings' => false] ,
                        'spacer1'  =>  [ 'title' => esc_html__('Spacer 1', 'softlab'), 'settings' => true] ,
                        'side_panel' =>  [ 'title' => esc_html__('Side Panel', 'softlab'), 'settings' => false] ,

                    ],
                    'Top Left area' => [],
                    'Top Center area' => [],
                    'Top Right  area' => [],
                    'Middle Left  area' => [
                        'logo' => [ 'title' => esc_html__('Logo', 'softlab'), 'settings' => false],
                        'spacer2'  =>  [ 'title' => esc_html__('Spacer 2', 'softlab'), 'settings' => true],
                        'menu' => [ 'title' => esc_html__('Menu', 'softlab'), 'settings' => false],
                    ],
                    'Middle Center  area' => [

                    ],
                    'Middle Right  area' => [
                        'item_search'  =>  [ 'title' => esc_html__('Search', 'softlab'), 'settings' => false] ,

                    ],
                    'Bottom Left area' => [
                    ],
                    'Bottom Center area' => [
                    ],
                    'Bottom Right area' => [
                    ],
                ],
            ],
            [
                'id' => 'bottom_header_spacer1',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 1 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer2',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 2 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 130,
                ]
            ],
            [
                'id' => 'bottom_header_spacer3',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 3 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer4',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 4 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer5',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 5 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer6',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 6 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer7',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 7 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_spacer8',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Spacer 8 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter1_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter1_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter1_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter1_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [

                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter1_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter1_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter1_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_delimiter2_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter2_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter2_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter2_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [

                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter2_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter2_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter2_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_delimiter3_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter3_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter3_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter3_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [

                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter3_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter3_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter3_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_delimiter4_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter4_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter4_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter4_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [

                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter4_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter4_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter4_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_delimiter5_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter5_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter5_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter5_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [
                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter5_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter5_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter5_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_delimiter6_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter6_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Delimiter Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 1,
                ]
            ],
            [
                'id' => 'bottom_header_delimiter6_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'bottom_header_delimiter6_margin',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'margin',
                'all' => false,
                'bottom' => false,
                'top' => false,
                'left' => true,
                'right' => true,
                'title' => esc_html__('Delimiter Spacing', 'softlab'),
                'default'  => [

                    'margin-left' => '30',
                    'margin-right' => '30',
                ]
            ],
            [
                'id' => 'bottom_header_delimiter6_sticky_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Delimiter', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_delimiter6_sticky_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Delimiter Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_delimiter6_sticky_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_title',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'softlab'),
                'default'  => esc_html__('Get Ticket', 'softlab'),
            ],
            [
                'id' => 'bottom_header_button1_link',
                'type' => 'text',
                'title' => esc_html__('Link', 'softlab')
            ],
            [
                'id' => 'bottom_header_button1_target',
                'type' => 'switch',
                'title' => esc_html__('Open link in a new tab', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'bottom_header_button1_size',
                'type' => 'select',
                'title' => esc_html__('Button Size', 'softlab'),
                'options'  => [
                    's' => esc_html__('Small', 'softlab'),
                    'm' => esc_html__('Medium', 'softlab'),
                    'l' => esc_html__('Large', 'softlab'),
                    'xl' => esc_html__('Extra Large', 'softlab'),

                ],
                'default'  => 's'
            ],
            [
                'id' => 'bottom_header_button1_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button1_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_custom_sticky',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button1_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button1_hover_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button1_custom_sticky', '=', '1' ],
                ],
            ],
                        [
                'id' => 'bottom_header_button2_title',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'softlab'),
                'default' => esc_html__('Get Ticket', 'softlab'),
            ],
            [
                'id' => 'bottom_header_button2_link',
                'type' => 'text',
                'title' => esc_html__('Link', 'softlab')
            ],
            [
                'id' => 'bottom_header_button2_target',
                'type' => 'switch',
                'title' => esc_html__('Open link in a new tab', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'bottom_header_button2_size',
                'type' => 'select',
                'title' => esc_html__('Button Size', 'softlab'),
                'options'  => [
                    's' => esc_html__('Small', 'softlab'),
                    'm' => esc_html__('Medium', 'softlab'),
                    'l' => esc_html__('Large', 'softlab'),
                    'xl' => esc_html__('Extra Large', 'softlab'),

                ],
                'default'  => 'm'
            ],
            [
                'id' => 'bottom_header_button2_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button2_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_custom_sticky',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button2_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button2_hover_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button2_custom_sticky', '=', '1' ],
                ],
            ],
                        [
                'id' => 'bottom_header_button3_title',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'softlab'),
                'default'  => esc_html__('Get Ticket', 'softlab'),
            ],
            [
                'id' => 'bottom_header_button3_link',
                'type' => 'text',
                'title' => esc_html__('Link', 'softlab')
            ],
            [
                'id' => 'bottom_header_button3_target',
                'type' => 'switch',
                'title' => esc_html__('Open link in a new tab', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'bottom_header_button3_size',
                'type' => 'select',
                'title' => esc_html__('Button Size', 'softlab'),
                'options'  => [
                    's' => esc_html__('Small', 'softlab'),
                    'm' => esc_html__('Medium', 'softlab'),
                    'l' => esc_html__('Large', 'softlab'),
                    'xl' => esc_html__('Extra Large', 'softlab'),

                ],
                'default'  => 'm'
            ],
            [
                'id' => 'bottom_header_button3_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button3_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_custom_sticky',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button3_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Background Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button3_hover_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button3_custom_sticky', '=', '1' ],
                ],
            ],
                        [
                'id' => 'bottom_header_button4_title',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'softlab'),
                'default' => esc_html__('Get Ticket', 'softlab'),
            ],
            [
                'id' => 'bottom_header_button4_link',
                'type' => 'text',
                'title' => esc_html__('Link', 'softlab')
            ],
            [
                'id' => 'bottom_header_button4_target',
                'type' => 'switch',
                'title' => esc_html__('Open link in a new tab', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'bottom_header_button4_size',
                'type' => 'select',
                'title' => esc_html__('Button Size', 'softlab'),
                'options' => [
                    's' => esc_html__('Small', 'softlab'),
                    'm' => esc_html__('Medium', 'softlab'),
                    'l' => esc_html__('Large', 'softlab'),
                    'xl' => esc_html__('Extra Large', 'softlab'),

                ],
                'default'  => 'm'
            ],
            [
                'id' => 'bottom_header_button4_custom',
                'type' => 'switch',
                'title' => esc_html__('Customize Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button4_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_color_txt',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => [
                    'color' => '#fd226a',
                    'alpha' => '1',
                    'rgba'  => 'rgba(253,34,106,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_border',
                'type' => 'color_rgba',
                'title' => esc_html__('Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_custom_sticky',
                'type' => 'switch',
                'title' => esc_html__('Customize Sticky Button', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'bottom_header_button4_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Text Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_color_txt_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Text Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Background Color', 'softlab'),
                'default'  => [
                    'color' => '#fd226a',
                    'alpha' => '1',
                    'rgba'  => 'rgba(253,34,106,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_bg_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Background Color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_button4_hover_border_sticky',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Hover Border Color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'bottom_header_button4_custom_sticky', '=', '1' ],
                ],
            ],
            [
                'id' => 'bottom_header_bar_html1_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 1 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html2_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 2 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html3_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 3 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html4_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 4 Editor', 'softlab'),
                'default' => '',
            ],            [
                'id' => 'bottom_header_bar_html5_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 5 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html6_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 6 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html7_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 7 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'bottom_header_bar_html8_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 8 Editor', 'softlab'),
                'default' => '',
            ],
            [
                'id' => 'header_top-start',
                'type' => 'section',
                'title' => esc_html__('Header Top Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_top_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width Top Header', 'softlab'),
                'subtitle' => esc_html__('Set header content in full width top layout', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'header_top_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Top Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'header_top_background_image',
                'type' => 'media',
                'title' => esc_html__('Header Top Background Image', 'softlab'),
            ],
            [
                'id' => 'header_top_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Top Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_top_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Top Text Color', 'softlab'),
                'subtitle' => esc_html__('Set Top header text color', 'softlab'),
                'default'  => [
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_top_bottom_border',
                'type' => 'switch',
                'title' => esc_html__('Set Header Top Bottom Border', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'header_top_border_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Top Border Width', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '1',
                ],
                'required' => [
                    [ 'header_top_bottom_border', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_top_bottom_border_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Top Border Color', 'softlab'),
                'default'  => [
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'header_top_bottom_border', '=', '1' ],
                ],
            ],
            [
                'id' => 'header_top-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_middle-start',
                'type' => 'section',
                'title' => esc_html__('Header Middle Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_middle_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width Middle Header', 'softlab'),
                'subtitle' => esc_html__('Set header content in full width middle layout', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'header_middle_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Middle Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 110,
                ]
            ],
            [
                'id' => 'header_middle_background_image',
                'type' => 'media',
                'title' => esc_html__('Header Middle Background Image', 'softlab'),
            ],
            [
                'id' => 'header_middle_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Middle Background', 'softlab'),
                'default'  => [
                    'color' => '#f7f9fd',
                    'alpha' => '1',
                    'rgba'  => 'rgba(247,249,253,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_middle_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Middle Text Color', 'softlab'),
                'subtitle' => esc_html__('Set Middle header text color', 'softlab'),
                'default'  => [
                    'color' => '#313538',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,53,56,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_middle_bottom_border',
                'type' => 'switch',
                'title' => esc_html__('Set Header Middle Bottom Border', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'header_middle_border_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Middle Border Width', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '1',
                ],
                'required' => [
                    [ 'header_middle_bottom_border', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_middle_bottom_border_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Middle Border Color', 'softlab'),
                'default'  => [
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'header_middle_bottom_border', '=', '1' ],
                ],
            ],
            [
                'id' => 'header_middle-end',
                'type' => 'section',
                'indent' => false,
            ],

            [
                'id' => 'header_bottom-start',
                'type' => 'section',
                'title' => esc_html__('Header Bottom Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_bottom_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width Bottom Header', 'softlab'),
                'subtitle' => esc_html__('Set header content in full width bottom layout', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'header_bottom_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Bottom Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'header_bottom_background_image',
                'type' => 'media',
                'title' => esc_html__('Header Bottom Background Image', 'softlab'),
            ],
            [
                'id' => 'header_bottom_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Bottom Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_bottom_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Bottom Text Color', 'softlab'),
                'subtitle' => esc_html__('Set Bottom header text color', 'softlab'),
                'default'  => [
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_bottom_bottom_border',
                'type' => 'switch',
                'title' => esc_html__('Set Header Bottom Border', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'header_bottom_border_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Header Bottom Border Width', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '1',
                ],
                'required' => [
                    [ 'header_bottom_bottom_border', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_bottom_bottom_border_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Bottom Border Color', 'softlab'),
                'default'  => [
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'header_bottom_bottom_border', '=', '1' ],
                ],
            ],
            [
                'id' => 'header_bottom-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-left-start',
                'type' => 'section',
                'title' => esc_html__('Top Left Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_top_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_top_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_top_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-top-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-center-start',
                'type' => 'section',
                'title' => esc_html__('Top Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_top_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_top_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_top_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-top-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-center-start',
                'type' => 'section',
                'title' => esc_html__('Top Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_top_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_top_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_top_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-top-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-top-right-start',
                'type' => 'section',
                'title' => esc_html__('Top Right Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_top_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'right'
            ],
            [
                'id' => 'header_column_top_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_top_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-top-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-left-start',
                'type' => 'section',
                'title' => esc_html__('Middle Left Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_middle_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_middle_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_middle_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-middle-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-center-start',
                'type' => 'section',
                'title' => esc_html__('Middle Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_middle_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_middle_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_middle_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-middle-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-center-start',
                'type' => 'section',
                'title' => esc_html__('Middle Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_middle_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_middle_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_middle_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-middle-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-middle-right-start',
                'type' => 'section',
                'title' => esc_html__('Middle Right Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_middle_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'right'
            ],
            [
                'id' => 'header_column_middle_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_middle_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-middle-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-left-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Left Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_bottom_left_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_bottom_left_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_bottom_left_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-bottom-left-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-center-start',
                'type' => 'section',
                'title' => esc_html__('Middle Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_bottom_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_bottom_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_bottom_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-bottom-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-center-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Center Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_bottom_center_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'header_column_bottom_center_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_bottom_center_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-bottom-center-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_column-bottom-right-start',
                'type' => 'section',
                'title' => esc_html__('Bottom Right Column Options', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_column_bottom_right_horz',
                'type' => 'button_set',
                'title' => esc_html__('Horizontal Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'right'
            ],
            [
                'id' => 'header_column_bottom_right_vert',
                'type' => 'button_set',
                'title' => esc_html__('Vertical Align', 'softlab'),
                'options'  => [
                    'top' => esc_html__('Top', 'softlab'),
                    'middle' => esc_html__('Middle', 'softlab'),
                    'bottom' => esc_html__('Bottom', 'softlab'),
                ],
                'default'  => 'middle'
            ],
            [
                'id' => 'header_column_bottom_right_display',
                'type' => 'button_set',
                'title' => esc_html__('Display', 'softlab'),
                'options'  => [
                    'normal' => esc_html__('Normal', 'softlab'),
                    'grow' => esc_html__('Grow', 'softlab'),
                ],
                'default'  => 'normal'
            ],
            [
                'id' => 'header_column-bottom-right-end',
                'type' => 'section',
                'indent' => false,
            ],
            [
                'id' => 'header_row_settings-start',
                'type' => 'section',
                'title' => esc_html__('Header Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'header_shadow',
                'type' => 'switch',
                'title' => esc_html__('Header Bottom Shadow', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'header_on_bg',
                'type' => 'switch',
                'title' => esc_html__('Over content', 'softlab'),
                'subtitle' => esc_html__('Set Header preset to display over content.', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'lavalamp_active',
                'type' => 'switch',
                'title' => esc_html__('Enable Lavalamp Marker', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'sub_menu_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Sub Menu Background', 'softlab'),
                'subtitle' => esc_html__('Set sub menu background color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'sub_menu_color',
                'type' => 'color',
                'title' => esc_html__('Sub Menu Text Color', 'softlab'),
                'subtitle' => esc_html__('Set sub menu header text color', 'softlab'),
                'default'  => '#313131',
                'transparent' => false,
            ],
            [
                'id' => 'header_mobile_queris',
                'type' => 'slider',
                'title' => esc_html__('Show Header mobile in the resolution', 'softlab'),
                "default" => 1200,
                "min" => 1,
                "step" => 1,
                "max" => 1700,
                'display_value' => 'text',
                'required' => [ 'mobile_header', '=', '1' ],
            ],

            [
                'id' => 'header_row_settings-end',
                'type' => 'section',
                'indent' => false,
            ],

        ]

    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Header Sticky', 'softlab'),
        'id' => 'header_builder_sticky',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'header_sticky',
                'type' => 'switch',
                'title' => esc_html__('Sticky Header', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'header_sticky-start',
                'type' => 'section',
                'title' => esc_html__('Sticky Settings', 'softlab'),
                'indent' => true,
                'required' => [ 'header_sticky', '=', '1' ],
            ],
            [
                'id' => 'header_sticky_color',
                'type' => 'color',
                'title' => esc_html__('Sticky Header Text Color', 'softlab'),
                'subtitle' => esc_html__('Set sticky header text color', 'softlab'),
                'default'  => '#313131',
                'transparent' => false,
            ],
            [
                'id' => 'header_sticky_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Sticky Header Background', 'softlab'),
                'subtitle' => esc_html__('Set sticky header background color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1.0',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'header_sticky_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Sticky Header Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 100,
                ]
            ],
            [
                'id' => 'header_sticky_style',
                'type' => 'select',
                'title' => esc_html__('Choose your sticky style.', 'softlab'),
                'options'  => [
                    'standard' => esc_html__('Show when scroll', 'softlab'),
                    'scroll_up' => esc_html__('Show when scroll up', 'softlab'),
                ],
                'default'  => 'standard'
            ],
            [
                'id' => 'header_sticky_border',
                'type' => 'switch',
                'title' => esc_html__('Bottom Border On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'header_sticky_border_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Bottom Border Width', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '1',
                ],
                'required' => [
                    [ 'header_sticky_border', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_sticky_border_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Bottom Border Color', 'softlab'),
                'default'  => [
                    'color' => '#525252',
                    'alpha' => '1',
                    'rgba'  => 'rgba(82, 82, 82, 1)'
                ],
                'mode' => 'background',
                'required' => [
                    [ 'header_sticky_border', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_sticky_shadow',
                'type' => 'switch',
                'title' => esc_html__('Bottom Shadow On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'sticky_header',
                'type' => 'switch',
                'title' => esc_html__('Custom Sticky Header ', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'sticky_header_layout',
                'type' => 'sorter',
                'title' => esc_html__('Sticky Header Order', 'softlab'),
                'desc' => esc_html__('Organize the layout of the sticky header', 'softlab'),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => [
                    'items'  => [
                        'html1' => esc_html__('HTML 1', 'softlab'),
                        'html2' => esc_html__('HTML 2', 'softlab'),
                        'html3' => esc_html__('HTML 3', 'softlab'),
                        'html4' => esc_html__('HTML 4', 'softlab'),
                        'html5' => esc_html__('HTML 5', 'softlab'),
                        'html6' => esc_html__('HTML 6', 'softlab'),
                        'item_search' => esc_html__('Search', 'softlab'),
                        'wpml' => esc_html__('WPML', 'softlab'),
                        'delimiter1'  => esc_html__('|', 'softlab'),
                        'delimiter2'  => esc_html__('|', 'softlab'),
                        'delimiter3'  => esc_html__('|', 'softlab'),
                        'delimiter4'  => esc_html__('|', 'softlab'),
                        'delimiter5'  => esc_html__('|', 'softlab'),
                        'delimiter6'  => esc_html__('|', 'softlab'),
                        'side_panel'  => esc_html__('Side Panel', 'softlab'),
                        'cart' => esc_html__('Cart', 'softlab'),
                        'spacer1' => esc_html__('Spacer 1', 'softlab'),
                        'spacer2' => esc_html__('Spacer 2', 'softlab'),
                        'spacer3' => esc_html__('Spacer 3', 'softlab'),
                        'spacer4' => esc_html__('Spacer 4', 'softlab'),
                        'spacer5' => esc_html__('Spacer 5', 'softlab'),
                        'spacer6' => esc_html__('Spacer 6', 'softlab'),
                    ],
                    'Left align side' => [
                        'logo' => esc_html__('Logo', 'softlab'),
                    ],
                    'Center align side' => [],
                    'Right align side' => [
                        'menu' => esc_html__('Menu', 'softlab'),
                    ],
                ],
                'default'  => [
                    'items'  => [
                        'html1' => esc_html__('HTML 1', 'softlab'),
                        'html2' => esc_html__('HTML 2', 'softlab'),
                        'html3' => esc_html__('HTML 3', 'softlab'),
                        'html4' => esc_html__('HTML 4', 'softlab'),
                        'html5' => esc_html__('HTML 5', 'softlab'),
                        'html6' => esc_html__('HTML 6', 'softlab'),
                        'item_search' => esc_html__('Search', 'softlab'),
                        'wpml' => esc_html__('WPML', 'softlab'),
                        'delimiter1'  => esc_html__('|', 'softlab'),
                        'delimiter2'  => esc_html__('|', 'softlab'),
                        'delimiter3'  => esc_html__('|', 'softlab'),
                        'delimiter4'  => esc_html__('|', 'softlab'),
                        'delimiter5'  => esc_html__('|', 'softlab'),
                        'delimiter6'  => esc_html__('|', 'softlab'),
                        'spacer1' => esc_html__('Spacer 1', 'softlab'),
                        'spacer2' => esc_html__('Spacer 2', 'softlab'),
                        'spacer3' => esc_html__('Spacer 3', 'softlab'),
                        'spacer4' => esc_html__('Spacer 4', 'softlab'),
                        'spacer5' => esc_html__('Spacer 5', 'softlab'),
                        'spacer6' => esc_html__('Spacer 6', 'softlab'),
                        'side_panel' => esc_html__('Side Panel', 'softlab'),
                        'cart' => esc_html__('Cart', 'softlab'),
                    ],
                    'Left align side' => [
                        'logo' => esc_html__('Logo', 'softlab'),
                    ],
                    'Center align side' => [],
                    'Right align side' => [
                        'menu' => esc_html__('Menu', 'softlab'),
                    ],
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_custom_sticky_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width Sticky Header', 'softlab'),
                'default'  => false,
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html1_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 1 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html2_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 2 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html3_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 3 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html4_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 4 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html5_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 5 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_bar_html6_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 6 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer1',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 1 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer2',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 2 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer3',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 3 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer4',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 4 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer5',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 5 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'sticky_header_spacer6',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 6 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'sticky_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'header_sticky-end',
                'type' => 'section',
                'indent' => false,
                'required' => [ 'header_sticky', '=', '1' ],
            ],
        ]
    ] );
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Header Mobile', 'softlab'),
        'id' => 'header_builder_mobile',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'mobile_header',
                'type' => 'switch',
                'title' => esc_html__('Custom Mobile Header ', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'mobile_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Mobile Header Background', 'softlab'),
                'subtitle' => esc_html__('Set mobile header background color', 'softlab'),
                'default'  => [
                    'color' => '#664bc4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(102, 75, 196, 1)'
                ],
                'mode' => 'background',
                'required' => [ 'mobile_header', '=', '1' ],
            ],
            [
                'id' => 'mobile_color',
                'type' => 'color',
                'title' => esc_html__('Mobile Header Text Color', 'softlab'),
                'subtitle' => esc_html__('Set mobile header text color', 'softlab'),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => [ 'mobile_header', '=', '1' ],
            ],
            [
                'id' => 'mobile_sub_menu_background',
                'type' => 'color_rgba',
                'title' => esc_html__('Mobile Sub Menu Background', 'softlab'),
                'subtitle' => esc_html__('Set sub menu background color', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
                'required' => [ 'mobile_header', '=', '1' ],
            ],
            [
                'id' => 'mobile_sub_menu_color',
                'type' => 'color',
                'title' => esc_html__('Mobile Sub Menu Text Color', 'softlab'),
                'subtitle' => esc_html__('Set sub menu header text color', 'softlab'),
                'default'  => '#4f4e4e',
                'transparent' => false,
                'required' => [ 'mobile_header', '=', '1' ],
            ],
            [
                'id' => 'header_mobile_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Mobile Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => '100',
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_over_content',
                'type' => 'switch',
                'title' => esc_html__('Mobile Over Content', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'mobile_menu',
                'type' => 'select',
                'title' => esc_html__('Mobile Menu', 'softlab'),
                'select2'  => ['allowClear' => false],
                'options'  => softlab_redux_get_custom_menu(),
            ],
            [
                'id' => 'mobile_header_layout',
                'type' => 'sorter',
                'title' => esc_html__('Mobile Header Order', 'softlab'),
                'desc' => esc_html__('Organize the layout of the mobile header', 'softlab'),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => [
                    'items'  => [
                        'html1' => esc_html__('HTML 1', 'softlab'),
                        'html2' => esc_html__('HTML 2', 'softlab'),
                        'html3' => esc_html__('HTML 3', 'softlab'),
                        'html4' => esc_html__('HTML 4', 'softlab'),
                        'html5' => esc_html__('HTML 5', 'softlab'),
                        'html6' => esc_html__('HTML 6', 'softlab'),
                        'wpml'  => esc_html__('WPML', 'softlab'),
                        'spacer1' => esc_html__('Spacer 1', 'softlab'),
                        'spacer2' => esc_html__('Spacer 2', 'softlab'),
                        'spacer3' => esc_html__('Spacer 3', 'softlab'),
                        'spacer4' => esc_html__('Spacer 4', 'softlab'),
                        'spacer5' => esc_html__('Spacer 5', 'softlab'),
                        'spacer6' => esc_html__('Spacer 6', 'softlab'),
                        'side_panel' =>  esc_html__('Side Panel', 'softlab'),
                        'cart' =>  esc_html__('Cart', 'softlab'),
                    ],
                    'Left align side' => [
                        'menu' => esc_html__('Menu', 'softlab'),
                    ],
                    'Center align side' => [
                        'logo' => esc_html__('Logo', 'softlab'),
                    ],
                    'Right align side' => [
                        'item_search'  =>  esc_html__('Search', 'softlab'),
                    ],
                ],
                'default'  => [
                    'items'  => [
                        'html1' => esc_html__('HTML 1', 'softlab'),
                        'html2' => esc_html__('HTML 2', 'softlab'),
                        'html3' => esc_html__('HTML 3', 'softlab'),
                        'html4' => esc_html__('HTML 4', 'softlab'),
                        'html5' => esc_html__('HTML 5', 'softlab'),
                        'html6' => esc_html__('HTML 6', 'softlab'),
                        'wpml'  => esc_html__('WPML', 'softlab'),
                        'spacer1'  =>  esc_html__('Spacer 1', 'softlab'),
                        'spacer2'  =>  esc_html__('Spacer 2', 'softlab'),
                        'spacer3'  =>  esc_html__('Spacer 3', 'softlab'),
                        'spacer4'  =>  esc_html__('Spacer 4', 'softlab'),
                        'spacer5'  =>  esc_html__('Spacer 5', 'softlab'),
                        'spacer6'  =>  esc_html__('Spacer 6', 'softlab'),
                        'side_panel' =>  esc_html__('Side Panel', 'softlab'),
                        'cart' =>  esc_html__('Cart', 'softlab'),
                    ],
                    'Left align side' => [
                        'menu' => esc_html__('Menu', 'softlab'),
                    ],
                    'Center align side' => [
                        'logo' => esc_html__('Logo', 'softlab'),
                    ],
                    'Right align side' => [
                        'item_search'  =>  esc_html__('Search', 'softlab'),
                    ],
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html1_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 1 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html2_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 2 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html3_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 3 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html4_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 4 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html5_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 5 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_bar_html6_editor',
                'type' => 'ace_editor',
                'mode' => 'html',
                'title' => esc_html__('HTML Element 6 Editor', 'softlab'),
                'default' => '',
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer1',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 1 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer2',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 2 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer3',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 3 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer4',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 4 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer5',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 5 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
            [
                'id' => 'mobile_header_spacer6',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Spacer 6 Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 25,
                ],
                'required' => [
                    [ 'mobile_header', '=', '1' ]
                ],
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Page Title', 'softlab'),
        'id' => 'page_title',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Settings', 'softlab'),
        'id' => 'page_title_settings',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_switch',
                'type' => 'switch',
                'title' => esc_html__('Page Title On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'page_title-start',
                'type' => 'section',
                'title' => esc_html__('Page Title Settings', 'softlab'),
                'indent' => true,
                'required' => [ 'page_title_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center bottom',
                    'background-color' => '#1e2228',
                    'background-image' => esc_url(get_template_directory_uri() . "/img/page_title_bg.png")
                ]
            ],
            [
                'id' => 'page_title_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 378,
                ]
            ],
            [
                'id' => 'page_title_align',
                'type' => 'button_set',
                'title' => esc_html__('Text Align', 'softlab'),
                'options'  => [
                    'left' => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right'
                 ],
                'default' => 'left'
            ],
            [
                'id' => 'page_title_padding',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Paddings Top/Bottom', 'softlab'),
                'default'  => [
                    'padding-top' => '60',
                    'padding-bottom' => '155',
                ]
            ],
            [
                'id' => 'page_title_margin',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'bottom' => true,
                'top' => false,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Margin Bottom', 'softlab'),
                'default'  => [
                    'margin-bottom' => '40',
                ]
            ],
            [
                'id' => 'page_title_parallax',
                'type' => 'switch',
                'title' => esc_html__('Add Page Title Parallax', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'page_title_parallax_speed',
                'type' => 'spinner',
                'title' => esc_html__('Parallax Speed', 'softlab'),
                'default'  => '0.3',
                'min' => '-5',
                'step' => '0.1',
                'max' => '5',
                'required' => [ 'page_title_parallax', '=', '1' ],
            ],
            [
                'id' => 'page_title_breadcrumbs_switch',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'page_title-end',
                'type' => 'section',
                'indent' => false,
                'required' => [ 'page_title_switch', '=', '1' ],
            ],

        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Typography', 'softlab'),
        'id' => 'page_title_typography',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_bg_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => '',
                'transparent' => false
            ],
            [
                'id' => 'page_title_font',
                'type' => 'custom_typography',
                'title' => esc_html__('Page Title Font', 'softlab'),
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default' => [
                    'font-size' => '42px',
                    'line-height' => '72px',
                    'color' => '#161616',
                ],
            ],
            [
                'id' => 'page_title_breadcrumbs_font',
                'type' => 'custom_typography',
                'title' => esc_html__('Page Title Breadcrumbs Font', 'softlab'),
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default' => [
                    'font-size' => '16px',
                    'color' => '#8b9baf',
                    'line-height' => '24px',
                ],
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Responsive', 'softlab'),
        'id' => 'page_title_responsive',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'page_title_resp_switch',
                'type' => 'switch',
                'title' => esc_html__('Responsive Layout On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'page_title_resp_resolution',
                'type' => 'slider',
                'title' => esc_html__('Switch to responsive in the resolution', 'softlab'),
                "default" => 768,
                "min" => 1,
                "step" => 1,
                "max" => 1700,
                'display_value' => 'text',
                'required' => [ 'page_title_resp_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_resp_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 378,
                ],
                'required' => [ 'page_title_resp_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_resp_padding',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Paddings Top/Bottom', 'softlab'),
                'default'  => [
                    'padding-top' => '15',
                    'padding-bottom' => '40',
                ],
                'required' => [ 'page_title_resp_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_resp_font',
                'type' => 'custom_typography',
                'title' => esc_html__('Page Title Font', 'softlab'),
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default' => [
                    'font-size' => '42px',
                    'line-height' => '72px',
                    'color' => '#161616',
                ],
                'required' => [ 'page_title_resp_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_resp_breadcrumbs_switch',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs On/Off', 'softlab'),
                'default'  => true,
                'required' => [ 'page_title_resp_switch', '=', '1' ],
            ],
            [
                'id' => 'page_title_resp_breadcrumbs_font',
                'type' => 'custom_typography',
                'title' => esc_html__('Page Title Breadcrumbs Font', 'softlab'),
                'font-size' => true,
                'google' => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color' => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default' => [
                    'font-size' => '16px',
                    'color' => '#8b9baf',
                    'line-height' => '24px',
                ],
                'required' => [ 'page_title_resp_breadcrumbs_switch', '=', '1' ],
            ],

        ]
    ] );

    // -> START Footer Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Footer', 'softlab'),
        'id' => 'footer',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Settings', 'softlab'),
        'id' => 'footer_settings',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'footer_switch',
                'type' => 'switch',
                'title' => esc_html__('Footer On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'footer-start',
                'type' => 'section',
                'title' => esc_html__('Footer Settings', 'softlab'),
                'indent' => true,
                'required' => [ 'footer_switch', '=', '1' ],
            ],
            [
                'id' => 'footer_add_wave',
                'type' => 'switch',
                'title' => esc_html__('Add Wave', 'softlab'),
                'default' => false,
                 'required' => [ 'footer_switch', '=', '1' ],
            ],
            [
                'id' => 'footer_wave_height',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Set Wave Height', 'softlab'),
                'height' => true,
                'width' => false,
                'default' => [
                    'height' => 158,
                ],
                'required' => [ 'footer_add_wave', '=', '1' ],
            ],
            [
                'id' => 'footer_content_type',
                'type' => 'select',
                'title' => esc_html__('Content Type', 'softlab'),
                'options'  => [
                    'widgets' => 'Get Widgets',
                    'pages' => 'Get Pages'
                ],
                'default'  => 'widgets'
            ],
            [
                'id' => 'footer_page_select',
                'type' => 'select',
                'title' => esc_html__('Page Select', 'softlab'),
                'data'  => 'posts',
                'args'  => [
                    'post_type' => 'footer',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                ],
                'required' => [ 'footer_content_type', '=', 'pages' ]
            ],
            [
                'id' => 'widget_columns',
                'type' => 'button_set',
                'title' => esc_html__('Columns', 'softlab'),
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                 ],
                'default' => '4',
                'required' => [ 'footer_content_type', '=', 'widgets' ]
            ],
            [
                'id' => 'widget_columns_2',
                'type' => 'image_select',
                'title' => esc_html__('Columns Layout', 'softlab'),
                'options'  => [
                    '6-6' => [
                        'alt' => '50-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-50.png'
                    ],
                    '3-9' => [
                        'alt' => '25-75',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-75.png'
                    ],
                    '9-3' => [
                        'alt' => '75-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/75-25.png'
                    ],
                    '4-8' => [
                        'alt' => '33-66',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-66.png'
                    ],
                    '8-4' => [
                        'alt' => '66-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/66-33.png'
                    ]
                ],
                'default'  => '6-6',
                'required' => [ 'widget_columns', '=', '2' ],
            ],
            [
                'id' => 'widget_columns_3',
                'type' => 'image_select',
                'title' => esc_html__('Columns Layout', 'softlab'),
                'options'  => [
                    '4-4-4' => [
                        'alt' => '33-33-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-33-33.png'
                    ],
                    '3-3-6' => [
                        'alt' => '25-25-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-25-50.png'
                    ],
                    '3-6-3' => [
                        'alt' => '25-50-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-50-25.png'
                    ],
                    '6-3-3' => [
                        'alt' => '50-25-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-25-25.png'
                    ],
                ],
                'default'  => '4-4-4',
                'required' => [ 'widget_columns', '=', '3' ],
            ],
            [
                'id' => 'footer_spacing',
                'type' => 'spacing',
                'output' => [ '.wgl-footer' ],
                'mode' => 'padding',
                'units' => 'px',
                'all' => false,
                'title' => esc_html__('Paddings', 'softlab'),
                'default'  => [
                    'padding-top' => '90px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '60px',
                    'padding-left' => '0px'
                ]
            ],
            [
                'id' => 'footer_full_width',
                'type' => 'switch',
                'title' => esc_html__('Full Width On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'footer_content_type', '=', 'widgets' ]
            ],
            [
                'id' => 'footer-end',
                'type' => 'section',
                'indent' => false,
                'required' => [ 'footer_switch', '=', '1' ],
            ],
            [
                'id' => 'footer-start-styles',
                'type' => 'section',
                'title' => esc_html__('Footer Styling', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'footer_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                ]
            ],
            [
                'id' => 'footer_align',
                'type' => 'button_set',
                'title' => esc_html__('Content Align', 'softlab'),
                'options'  => [
                    'left' => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right'
                 ],
                'default'  => 'center',
                'required' => [ 'footer_content_type', '=', 'widgets' ]
            ],
            [
                'id' => 'footer_bg_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => '#f7f9fd',
                'transparent' => false
            ],
            [
                'id' => 'footer_heading_color',
                'type' => 'color',
                'title' => esc_html__('Headings color', 'softlab'),
                'default'  => '#161616',
                'transparent' => false
            ],
            [
                'id' => 'footer_text_color',
                'type' => 'color',
                'title' => esc_html__('Content color', 'softlab'),
                'default'  => '#4f4e4e',
                'transparent' => false
            ],
            [
                'id' => 'footer-end-styles',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ] );

    // -> START Copyright Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Copyright', 'softlab'),
        'id' => 'copyright',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Settings', 'softlab'),
        'id' => 'copyright-settings',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'copyright_switch',
                'type' => 'switch',
                'title' => esc_html__('Copyright On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'copyright-start',
                'type' => 'section',
                'title' => esc_html__('Copyright Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'copyright_editor',
                'type' => 'editor',
                'title' => esc_html__('Editor', 'softlab'),
                'default' => '<p>Copyright © 2019 Softlab by WebGeniusLab. All Rights Reserved</p>',
                'args' => [
                    'wpautop' => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny' => false,
                    'quicktags' => true,
                ],
                'required' => [ 'copyright_switch', '=', '1' ],
            ],
            [
                'id' => 'copyright_text_color',
                'type' => 'color',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => '#96a1b6',
                'transparent' => false,
                'required' => [ 'copyright_switch', '=', '1' ],
            ],
            [
                'id' => 'copyright_bg_color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'softlab'),
                'default'  => '#f7f9fd',
                'transparent' => false,
                'required' => [ 'copyright_switch', '=', '1' ],
            ],
            [
                'id' => 'copyright_spacing',
                'type' => 'spacing',
                'mode' => 'padding',
                'left' => false,
                'right' => false,
                'all' => false,
                'title' => esc_html__('Paddings', 'softlab'),
                'default'  => [
                    'padding-top' => '20',
                    'padding-bottom' => '20',
                ],
                'required' => [ 'copyright_switch', '=', '1' ],
            ],
            [
                'id' => 'copyright-end',
                'type' => 'section',
                'indent' => false,
                'required' => [ 'footer_switch', '=', '1' ],
            ],
        ]
    ]);

    // -> START Blog Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Blog', 'softlab'),
        'id' => 'blog-option',
        'icon' => 'el-icon-th',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Archive', 'softlab'),
        'id' => 'blog-list-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'post_archive_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Archive Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
            [
                'id' => 'blog_list_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Blog Archive Sidebar Layout', 'softlab'),
                'options'  => [
                    'none' => [
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default'  => 'none'
            ],
            [
                'id' => 'blog_list_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Blog Archive Sidebar', 'softlab'),
                'data' => 'sidebars',
                'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'blog_list_sidebar_def_width',
                'type' => 'button_set',
                'title' => esc_html__('Blog Archive Sidebar Width', 'softlab'),
                'options'  => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default'  => '9',
                'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'blog_list_sidebar_sticky',
                'type' => 'switch',
                'title' => esc_html__('Blog Archive Sticky Sidebar On?', 'softlab'),
                'default'  => false,
                'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'blog_list_sidebar_gap',
                'type' => 'select',
                'title' => esc_html__('Blog Archive Sidebar Side Gap', 'softlab'),
                'options'  => [
                    'def' => 'Default',
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default'  => '30',
                'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'blog_list_columns',
                'type' => 'button_set',
                'title' => esc_html__('Columns in Archive', 'softlab'),
                'options' => [
                    '12' => 'One',
                    '6' => 'Two',
                    '4' => 'Three',
                    '3' => 'Four'
                 ],
                'default' => '12'
            ],
            [
                'id' => 'blog_list_likes',
                'type' => 'switch',
                'title' => esc_html__('Likes On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_share',
                'type' => 'switch',
                'title' => esc_html__('Share On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_hide_media',
                'type' => 'switch',
                'title' => esc_html__('Hide Media?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_hide_title',
                'type' => 'switch',
                'title' => esc_html__('Hide Title?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_hide_content',
                'type' => 'switch',
                'title' => esc_html__('Hide Content?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_post_listing_content',
                'type' => 'switch',
                'title' => esc_html__('Cut Off Text in Blog Listing', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_letter_count',
                'type' => 'text',
                'title' => esc_html__('Number of character to show after trim.', 'softlab'),
                'default'  => '85',
                'required' => [ 'blog_post_listing_content', '=', true ],
            ],
            [
                'id' => 'blog_list_read_more',
                'type' => 'switch',
                'title' => esc_html__('Hide Read More Button?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_meta',
                'type' => 'switch',
                'title' => esc_html__('Hide all post-meta?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'blog_list_meta_author',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta author?', 'softlab'),
                'default'  => false,
                'required' => [ 'blog_list_meta', '=', false ],
            ],
            [
                'id' => 'blog_list_meta_comments',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta comments?', 'softlab'),
                'default'  => false,
                'required' => [ 'blog_list_meta', '=', false ],
            ],
            [
                'id' => 'blog_list_meta_categories',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta categories?', 'softlab'),
                'default'  => false,
                'required' => [ 'blog_list_meta', '=', false ],
            ],
            [
                'id' => 'blog_list_meta_date',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta date?', 'softlab'),
                'default'  => false,
                'required' => [ 'blog_list_meta', '=', false ],
            ],

        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Single', 'softlab'),
        'id' => 'blog-single-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'blog_title_conditional',
                'type' => 'switch',
                'title' => esc_html__('Blog Post Title On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'post_single_page_title_text',
                'type' => 'text',
                'title' => esc_html__('Single Page Title Text', 'softlab'),
                'default'  => esc_html__('Blog', 'softlab'),
                'required' => [ 'blog_title_conditional', '=', true ],
            ],
            [
                'id' => 'post_single_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'  => false,
                'title' => esc_html__('Single Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
            [
                'id' => 'single_type_layout',
                'type' => 'button_set',
                'title' => esc_html__('Blog Single Type', 'softlab'),
                'options'  => [
                    '1' => esc_html__('Title First', 'softlab'),
                    '2' => esc_html__('Image First', 'softlab'),
                    '3' => esc_html__('Overlay Image', 'softlab')
                ],
                'default'  => '3'
            ],
            [
                'id' => 'single_padding_layout_3',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Page Title Padding', 'softlab'),
                'default'  => [
                    'padding-top' => '372px',
                    'padding-bottom' => '72px',
                ],
                'required' => [ 'single_type_layout', '=', '3' ],
            ],
            [
                'id' => 'single_apply_animation',
                'type' => 'switch',
                'title' => esc_html__('Apply Animation?', 'softlab'),
                'default'  => true,
                'required' => [ 'single_type_layout', '=', '3' ],
            ],
            [
                'id' => 'single_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Blog Single Sidebar Layout', 'softlab'),
                'options'  => [
                    'none' => [
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default'  => 'right'
            ],
            [
                'id' => 'single_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Blog Single Sidebar', 'softlab'),
                'data' => 'sidebars',
                'required' => [ 'single_sidebar_layout', '!=', 'none' ],
                'default' =>  'sidebar_main-sidebar',
            ],
            [
                'id' => 'single_sidebar_def_width',
                'type' => 'button_set',
                'title' => esc_html__('Blog Single Sidebar Width', 'softlab'),
                'options'  => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default'  => '9',
                'required' => [ 'single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'single_sidebar_sticky',
                'type' => 'switch',
                'title' => esc_html__('Blog Single Sticky Sidebar On?', 'softlab'),
                'default'  => true,
                'required' => [ 'single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'single_sidebar_gap',
                'type' => 'select',
                'title' => esc_html__('Blog Single Sidebar Side Gap', 'softlab'),
                'options'  => [
                    'def' => 'Default',
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default'  => 'def',
                'required' => [ 'single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'single_related_posts',
                'type' => 'switch',
                'title' => esc_html__('Related Posts', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'single_likes',
                'type' => 'switch',
                'title' => esc_html__('Likes On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'single_views',
                'type' => 'switch',
                'title' => esc_html__('Views On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'single_share',
                'type' => 'switch',
                'title' => esc_html__('Share On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'single_author_info',
                'type' => 'switch',
                'title' => esc_html__('Author Info On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'single_meta',
                'type' => 'switch',
                'title' => esc_html__('Hide all post-meta?', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'single_meta_author',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta author?', 'softlab'),
                'default'  => false,
                'required' => [ 'single_meta', '=', false ],
            ],
            [
                'id' => 'single_meta_comments',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta comments?', 'softlab'),
                'default'  => true,
                'required' => [ 'single_meta', '=', false ],
            ],
            [
                'id' => 'single_meta_categories',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta categories?', 'softlab'),
                'default'  => false,
                'required' => [ 'single_meta', '=', false ],
            ],
            [
                'id' => 'single_meta_date',
                'type' => 'switch',
                'title' => esc_html__('Hide post-meta date?', 'softlab'),
                'default'  => false,
                'required' => [ 'single_meta', '=', false ],
            ],
            [
                'id' => 'single_meta_tags',
                'type' => 'switch',
                'title' => esc_html__('Hide tags?', 'softlab'),
                'default'  => false,
            ],

        ]
    ] );

    // -> START Portfolio Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Portfolio', 'softlab'),
        'id' => 'portfolio-option',
        'icon' => 'el-icon-th',
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Archive', 'softlab'),
        'id' => 'portfolio-list-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'portfolio_archive_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Archive Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
            [
                'id' => 'portfolio_list_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Archive Sidebar Layout', 'softlab'),
                'options'  => [
                    'none' => [
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default'  => 'none'
            ],
            [
                'id' => 'portfolio_list_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Portfolio Archive Sidebar', 'softlab'),
                'data' => 'sidebars',
                'required' => [ 'portfolio_list_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'portfolio_list_columns',
                'type' => 'button_set',
                'title' => esc_html__('Columns in Archive', 'softlab'),
                'options' => [
                    '1' => 'One',
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four'
                 ],
                'default' => '3'
            ],
            [
                'id' => 'portfolio_slug',
                'type' => 'text',
                'title' => esc_html__('Portfolio Slug', 'softlab'),
                'default'  => 'portfolio',
            ],
            [
                'id' => 'portfolio_list_show_filter',
                'type' => 'switch',
                'title' => esc_html__('Filter On/Off', 'softlab'),
                'default'  => false,
            ],

            [
                'id' => 'portfolio_list_filter_cats',
                'type'  => 'select',
                'multi' => true,
                'title' => esc_html__('Select Categories', 'softlab'),
                'data'  => 'terms',
                'args' => ['taxonomies'=>'portfolio-category'],
                'required' => [ 'portfolio_list_show_filter', '=', '1' ],
            ],

            [
                'id' => 'portfolio_list_show_title',
                'type' => 'switch',
                'title' => esc_html__('Title On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_list_show_content',
                'type' => 'switch',
                'title' => esc_html__('Content On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'portfolio_list_show_cat',
                'type' => 'switch',
                'title' => esc_html__('Categories On/Off', 'softlab'),
                'default'  => true,
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Single', 'softlab'),
        'id' => 'portfolio-single-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'portfolio_title_conditional',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Post Title On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_single_page_title_text',
                'type' => 'text',
                'title' => esc_html__('Single Page Title Text', 'softlab'),
                'default'  => esc_html__('Portfolio', 'softlab'),
                'required' => [ 'portfolio_title_conditional', '=', true ],
            ],
            [
                'id' => 'portfolio_single_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Single Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
            [
                'id' => 'portfolio_single_type_layout',
                'type' => 'button_set',
                'title' => esc_html__('Portfolio Single Type', 'softlab'),
                'options'  => [
                    '1' => esc_html__('Title First', 'softlab'),
                    '2' => esc_html__('Image First', 'softlab'),
                    '3' => esc_html__('Overlay Image', 'softlab'),
                    '4' => esc_html__('Overlay Image with Info', 'softlab'),
                ],
                'default'  => '2'
            ],
            [
                'id' => 'portfolio_single_align',
                'type' => 'button_set',
                'title' => esc_html__('Portfolio Single Alignment', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'left'
            ],
            [
                'id' => 'portfolio_single_padding',
                'type' => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Portfolio Single Padding', 'softlab'),
                'default'  => [
                    'padding-top' => '165px',
                    'padding-bottom' => '165px',
                ],
                'required' => [
                        [ 'portfolio_single_type_layout', '!=', '1' ],
                        [ 'portfolio_single_type_layout', '!=', '2' ],
                    ],
            ],
            [
                'id' => 'portfolio_parallax',
                'type' => 'switch',
                'title' => esc_html__('Add Portfolio Parallax', 'softlab'),
                'default'  => false,
                'required' => [
                        [ 'portfolio_single_type_layout', '!=', '1' ],
                        [ 'portfolio_single_type_layout', '!=', '2' ],
                    ],
            ],
            [
                'id' => 'portfolio_parallax_speed',
                'type' => 'spinner',
                'title' => esc_html__('Parallax Speed', 'softlab'),
                'default'  => '0.3',
                'min' => '-5',
                'step' => '0.1',
                'max' => '5',
                'required' => [ 'portfolio_parallax', '=', '1' ],
            ],
            [
                'id' => 'portfolio_single_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Single Sidebar Layout', 'softlab'),
                'options'  => [
                    'none' => [
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default'  => 'none'
            ],
            [
                'id' => 'portfolio_single_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Portfolio Single Sidebar', 'softlab'),
                'data' => 'sidebars',
                'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'portfolio_single_sidebar_def_width',
                'type' => 'button_set',
                'title' => esc_html__('Portfolio Single Sidebar Width', 'softlab'),
                'options'  => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default'  => '8',
                'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'portfolio_single_sidebar_sticky',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Single Sticky Sidebar On?', 'softlab'),
                'default'  => false,
                'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'portfolio_single_sidebar_gap',
                'type' => 'select',
                'title' => esc_html__('Portfolio Single Sidebar Side Gap', 'softlab'),
                'options'  => [
                    'def' => 'Default',
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default'  => 'def',
                'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'portfolio_above_content_cats',
                'type' => 'switch',
                'title' => esc_html__('Tags On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_above_content_share',
                'type' => 'switch',
                'title' => esc_html__('Share On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_single_meta_likes',
                'type' => 'switch',
                'title' => esc_html__('Post-meta likes On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_single_meta',
                'type' => 'switch',
                'title' => esc_html__('Hide all post-meta?', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'portfolio_single_meta_author',
                'type' => 'switch',
                'title' => esc_html__('Post-meta author On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'portfolio_single_meta', '=', false ],
            ],
            [
                'id' => 'portfolio_single_meta_comments',
                'type' => 'switch',
                'title' => esc_html__('Post-meta comments On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'portfolio_single_meta', '=', false ],
            ],
            [
                'id' => 'portfolio_single_meta_categories',
                'type' => 'switch',
                'title' => esc_html__('Post-meta categories On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'portfolio_single_meta', '=', false ],
            ],
            [
                'id' => 'portfolio_single_meta_date',
                'type' => 'switch',
                'title' => esc_html__('Post-meta date On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'portfolio_single_meta', '=', false ],
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Related Posts', 'softlab'),
        'id' => 'portfolio-related-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'portfolio_related_switch',
                'type' => 'switch',
                'title' => esc_html__('Related Posts On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'pf_title_r',
                'type' => 'text',
                'title' => esc_html__('Title', 'softlab'),
                'default'  => esc_html__('Related Portfolio', 'softlab'),
                'required' => [ 'portfolio_related_switch', '=', '1' ],
            ],
            [
                'id' => 'pf_carousel_r',
                'type' => 'switch',
                'title' => esc_html__('Display items carousel for this portfolio post', 'softlab'),
                'default'  => true,
                'required' => [ 'portfolio_related_switch', '=', '1' ],
            ],
            [
                'id' => 'pf_column_r',
                'type' => 'button_set',
                'title' => esc_html__('Related Columns', 'softlab'),
                'options' => [
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four'
                ],
                'default' => '3',
                'required' => [ 'portfolio_related_switch', '=', '1' ],
            ],
            [
                'id' => 'pf_number_r',
                'type' => 'text',
                'title' => esc_html__('Number of Related Items', 'softlab'),
                'default'  => '3',
                'required' => [ 'portfolio_related_switch', '=', '1' ],
            ],
        ]
    ] );

    // -> START Team Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Team', 'softlab'),
        'id' => 'team-option',
        'icon' => 'el-icon-th',
        'fields' => [
            [
                'id' => 'team_slug',
                'type' => 'text',
                'title' => esc_html__('Team Slug', 'softlab'),
                'default'  => 'team',
            ],
            [
                'id' => 'team_single_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title' => esc_html__('Single Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
        ]
    ] );

    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Single', 'softlab'),
        'id' => 'team-single-option',
        'subsection' => true,
        'fields' => [
            [
                'id' => 'team_title_conditional',
                'type' => 'switch',
                'title' => esc_html__('Team Post Title On/Off', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'team_single_page_title_text',
                'type' => 'text',
                'title' => esc_html__('Single Page Title Text', 'softlab'),
                'default'  => esc_html__('Team', 'softlab'),
                'required' => [ 'team_title_conditional', '=', true ],
            ],
        ]
    ] );

    // -> START Page 404 Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Page 404', 'softlab'),
        'id' => '404-option',
        'icon' => 'el-icon-th',
        'fields' => [
            [
                'id' => '404_page_title_bg_image',
                'type' => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'  => false,
                'title' => esc_html__('404 Page Title Background Image', 'softlab'),
                'default'  => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                ]
            ],
        ]
    ] );

        // -> START Side Panel Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Side Panel', 'softlab'),
        'id' => 'side_panel',
        'icon' => 'el-icon-th',
        'fields' => [
            [
                'id' => 'side_panel_text_color',
                'type' => 'color_rgba',
                'title' => esc_html__('Text Color', 'softlab'),
                'default'  => [
                    'color' => '#313538',
                    'alpha' => '1',
                    'rgba'  => 'rgba(96,101,104,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'side_panel_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Background', 'softlab'),
                'default'  => [
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ],
                'mode' => 'background',
            ],
            [
                'id' => 'side_panel_text_alignment',
                'type' => 'button_set',
                'title' => esc_html__('Text Align', 'softlab'),
                'options'  => [
                    'left' => esc_html__('Left', 'softlab'),
                    'center' => esc_html__('Center', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'center'
            ],
            [
                'id' => 'side_panel_width',
                'type' => 'dimensions',
                'units' => 'px',
                'units_extended' => false,
                'title' => esc_html__('Width', 'softlab'),
                'height' => false,
                'width' => true,
                'default' => [
                    'width' => 480,
                ]
            ],
            [
                'id' => 'side_panel_position',
                'type' => 'button_set',
                'title' => esc_html__('Position', 'softlab'),
                'options'  => [
                    'left'  => esc_html__('Left', 'softlab'),
                    'right' => esc_html__('Right', 'softlab'),
                ],
                'default'  => 'right'
            ],
        ]
    ] );

    // -> START Layout Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Sidebars', 'softlab'),
        'id' => 'layout_options',
        'icon' => 'el el-braille',
        'fields' => [
            [
                'id'=>'sidebars',
                'type' => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__('Add Sidebar', 'softlab'),
                'title' => esc_html__('Register Sidebars', 'softlab'),
                'default' => ['Main Sidebar'],
            ],
            [
                'id' => 'sidebars-start',
                'type' => 'section',
                'title' => esc_html__('Sidebar Page Settings', 'softlab'),
                'indent' => true,
            ],
            [
                'id' => 'page_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Page Sidebar Layout', 'softlab'),
                'options'  => [
                    'none' => [
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ],
                    'left' => [
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ],
                    'right' => [
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    ]
                ],
                'default'  => 'none'
            ],
            [
                'id' => 'page_sidebar_def',
                'type' => 'select',
                'title' => esc_html__('Page Sidebar', 'softlab'),
                'data' => 'sidebars',
                'required' => [ 'page_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'page_sidebar_def_width',
                'type' => 'button_set',
                'title' => esc_html__('Page Sidebar Width', 'softlab'),
                'options'  => [
                    '9' => '25%',
                    '8' => '33%',
                ],
                'default'  => '9',
                'required' => [ 'page_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'page_sidebar_sticky',
                'type' => 'switch',
                'title' => esc_html__('Sticky Sidebar On?', 'softlab'),
                'default'  => false,
                'required' => [ 'page_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'page_sidebar_gap',
                'type' => 'select',
                'title' => esc_html__('Sidebar Side Gap', 'softlab'),
                'options'  => [
                    'def' => 'Default',
                    '0' => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ],
                'default'  => '30',
                'required' => [ 'page_sidebar_layout', '!=', 'none' ],
            ],
            [
                'id' => 'sidebars-end',
                'type' => 'section',
                'indent' => false,
            ],
        ]
    ] );

    // -> START Social Share Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Social Shares', 'softlab'),
        'id' => 'soc_shares',
        'icon' => 'el el-share-alt',
        'fields' => [
            [
                'id' => 'show_soc_icon_page',
                'type' => 'switch',
                'title' => esc_html__('Show Social Shares on Pages On/Off', 'softlab'),
                'default'  => false,
            ],
            [
                'id' => 'soc_icon_style',
                'type' => 'button_set',
                'title' => esc_html__('Choose your share style.', 'softlab'),
                'options'  => [
                    'standard' => esc_html__('Standard', 'softlab'),
                    'hovered' => esc_html__('Hovered', 'softlab'),
                ],
                'default'  => 'standard',
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_position',
                'type' => 'switch',
                'title' => esc_html__('Fixed Position On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_offset',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'bottom' => true,
                'top' => false,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Offset Top', 'softlab'),
                'desc' => esc_html__('Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'softlab'),
                'default'  => [ 'margin-bottom' => '40%' ],
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_facebook',
                'type' => 'switch',
                'title' => esc_html__('Facebook Share On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_twitter',
                'type' => 'switch',
                'title' => esc_html__('Twitter Share On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_linkedin',
                'type' => 'switch',
                'title' => esc_html__('Linkedin Share On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_pinterest',
                'type' => 'switch',
                'title' => esc_html__('Pinterest Share On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'soc_icon_tumblr',
                'type' => 'switch',
                'title' => esc_html__('Tumblr Share On/Off', 'softlab'),
                'default'  => false,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'add_custom_share',
                'type' => 'switch',
                'title' => esc_html__('Add Custom Share?', 'softlab'),
                'default'  => true,
                'required' => [ 'show_soc_icon_page', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-1',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 1', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-1',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 1', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-2',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 2', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-2',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 2', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-3',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 3', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-3',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 3', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-4',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 4', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-4',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 4', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-5',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 5', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-5',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 5', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-6',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 6', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-6',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 6', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-7',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 7', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-7',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 7', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-8',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 8', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-8',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 8', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-9',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 9', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-9',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 9', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_icons-10',
                'type' => 'select',
                'data' => 'elusive-icons',
                'title' => esc_html__('Custom Share Icon 10', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
            [
                'id' => 'select_custom_share_text-10',
                'type' => 'text',
                'title' => esc_html__('Custom Share Link 10', 'softlab'),
                'required' => [ 'add_custom_share', '=', '1' ],
            ],
        ]
    ] );

    // -> START Styling Options
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Color Options', 'softlab'),
        'id' => 'color_options_color',
        'icon' => 'el-icon-tint',
        'fields' => [
            [
                'id' => 'theme-custom-color',
                'type' => 'color',
                'title' => esc_html__('General Theme Color', 'softlab'),
                'transparent' => false,
                'default' => '#664bc4',
                'validate'  => 'color',
            ],
            [
                'id' => 'theme-secondary-color',
                'type' => 'color',
                'title' => esc_html__('Theme Secondary Color', 'softlab'),
                'transparent' => false,
                'default' => '#54e0c4',
                'validate'  => 'color',
            ],
            [
                'id' => 'use-gradient',
                'type' => 'switch',
                'title' => esc_html__('Use Theme Gradient?', 'softlab'),
                'default'  => true,
            ],
            [
                'id' => 'theme-gradient',
                'type' => 'color_gradient',
                'title' => esc_html__('Theme Gradient', 'softlab'),
                'validate' => 'color',
                'default'  => [
                    'from' => '#6a4bc4',
                    'to' => '#d75dbc',
                ],
                'required' => [ 'use-gradient', '=', '1' ],
            ],
            [
                'id' => 'body-background-color',
                'type' => 'color',
                'title' => esc_html__('Body Background Color', 'softlab'),
                'transparent' => false,
                'default' => '#ffffff',
                'validate'  => 'color',
            ],
        ]
    ]);

    // Start Typography config
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Typography', 'softlab'),
        'id' => 'Typography',
        'icon'  => 'el-icon-font', // Icon for section
    ] );

    $typography = [];
    $main_typography = [
        [
            'id' => 'main-font',
            'title' => esc_html__('Content Font', 'softlab'),
            'color' => true,
            'line-height' => true,
            'font-size' => true,
            'subsets' => false,
            'all_styles'  => true,
            'font-weight-multi' => true,
            'defs' => [
                'font-size' => '16px',
                'line-height' => '30px',
                'color' => '#4f4e4e',
                'font-family' => 'Nunito',
                'font-weight' => '400',
                'font-weight-multi' => '600,700',
            ],
        ],
        [
            'id' => 'header-font',
            'title' => esc_html__('Headings Main Settings', 'softlab'),
            'font-size' => false,
            'line-height' => false,
            'color' => true,
            'subsets' => false,
            'all_styles' => true,
            'font-weight-multi' => true,
            'defs' => [
                'color' => '#161616',
                'google' => true,
                'font-family' => 'Poppins',
                'font-weight' => '700',
                'font-weight-multi' => '400,500,600,700',
            ],
        ],
        [
            'id' => 'double-heading-font',
            'title' => esc_html__('Double Heading Settings', 'softlab'),
            'font-size' => false,
            'line-height' => false,
            'color' => true,
            'subsets' => false,
            'all_styles' => false,
            'font-weight-multi' => false,
            'defs' => [
                'color' => '#54e0c4',
                'google' => true,
                'font-family' => 'Playfair Display',
                'font-weight' => '700italic',
            ],
        ],
    ];
    foreach ($main_typography as $key => $value) {
        array_push($typography , [
            'id' => $value['id'],
            'type' => 'custom_typography',
            'title' => $value['title'],
            'color' => $value['color'],
            'line-height' => $value['line-height'],
            'font-size' => $value['font-size'],
            'subsets' => $value['subsets'],
            'all_styles'  => $value['all_styles'],
            'font-weight-multi'  => isset($value['font-weight-multi']) ? $value['font-weight-multi'] : '',
            'subtitle' => isset($value['subtitle']) ? $value['subtitle'] : '',
            'google' => true,
            'font-style'  => true,
            'font-backup' => false,
            'text-align'  => false,
            'default' => $value['defs'],
        ]);
    }
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Main Content', 'softlab'),
        'id' => 'main_typography',
        //'icon' => 'el-icon-font', // Icon for section
        'subsection'  => true,
        'fields' => $typography
    ] );

    // Start menu typography
    $menu_typography = [
        [
            'id' => 'menu-font',
            'title' => esc_html__('Menu Font', 'softlab'),
            'color' => false,
            'line-height' => true,
            'font-size' => true,
            'subsets' => true,
            'defs' => [
                'font-family' => 'Poppins',
                'google' => true,
                'font-size' => '16px',
                'font-weight' => '600',
                'line-height' => '30px'
            ],
        ],
        [
            'id' => 'sub-menu-font',
            'title' => esc_html__('Submenu Font', 'softlab'),
            'color' => false,
            'line-height' => true,
            'font-size' => true,
            'subsets' => true,
            'defs' => [
                'font-family' => 'Nunito',
                'google' => true,
                'font-size' => '16px',
                'font-weight' => '600',
                'line-height' => '30px'
            ],
        ],
    ];
    $menu_typography_array = [];
    foreach ($menu_typography as $key => $value) {
        array_push($menu_typography_array , [
            'id' => $value['id'],
            'type' => 'custom_typography',
            'title' => $value['title'],
            'color' => $value['color'],
            'line-height' => $value['line-height'],
            'font-size' => $value['font-size'],
            'subsets' => $value['subsets'],
            'google' => true,
            'font-style'  => true,
            'font-backup' => false,
            'text-align'  => false,
            'all_styles'  => false,
            'default' => $value['defs'],
        ]);
    }
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Menu', 'softlab'),
        'id' => 'main_menu_typography',
        //'icon' => 'el-icon-font', // Icon for section
        'subsection' => true,
        'fields' => $menu_typography_array
    ] );
    // End menu Typography

    // Start headings typography
    $headings = [
        [
            'id' => 'header-h1',
            'title' => esc_html__('H1', 'softlab'),
            'defs'  => [
                'font-family' => 'Poppins',
                'font-size' => '42px',
                'line-height' => '48px',
                'font-weight' => '700',
            ],
        ],
        [
            'id' => 'header-h2',
            'title' => esc_html__('H2', 'softlab'),
            'defs' => [
                'font-family' => 'Poppins',
                'font-size' => '36px',
                'line-height' => '48px',
                'font-weight' => '700',
            ],
        ],
        [
            'id' => 'header-h3',
            'title' => esc_html__('H3', 'softlab'),
            'defs' => [
                'font-family' => 'Poppins',
                'font-weight' => '700',
                'font-size' => '30px',
                'line-height' => '42px',
            ],
        ],
        [
            'id' => 'header-h4',
            'title' => esc_html__('H4', 'softlab'),
            'defs' => [
                'font-family' => 'Poppins',
                'font-size' => '24px',
                'line-height' => '36px',
                'font-weight' => '700',
            ],
        ],
        [
            'id' => 'header-h5',
            'title' => esc_html__('H5', 'softlab'),
            'defs' => [
                'font-family' => 'Poppins',
                'font-size' => '20px',
                'line-height' => '26px',
                'font-weight' => '600'
            ],
        ],
        [
            'id' => 'header-h6',
            'title' => esc_html__('H6', 'softlab'),
            'defs' => [
                'font-family' => 'Poppins',
                'font-size' => '18px',
                'line-height' => '24px',
                'font-weight' => '600',
            ],
        ],
    ];
    $headings_array = [];
    foreach ($headings as $key => $heading) {
        array_push($headings_array , [
            'id' => $heading['id'],
            'type' => 'custom_typography',
            'title' => $heading['title'],
            'google' => true,
            'font-backup' => false,
            'font-size' => true,
            'line-height' => true,
            'color' => false,
            'word-spacing' => false,
            'letter-spacing' => true,
            'text-align' => false,
            'text-transform' => true,
            'default' => $heading['defs'],
        ]);
    }

    // Typogrophy section
    Redux::setSection( $theme_slug, [
        'title' => esc_html__('Headings', 'softlab'),
        'id' => 'main_headings_typography',
        //'icon' => 'el-icon-font', // Icon for section
        'subsection' => true,
        'fields' => $headings_array
    ] );
    // End Typography config

    if ( class_exists( 'WooCommerce' ) )  {
        Redux::setSection( $theme_slug, [
            'title'  => esc_html__('Shop', 'softlab'),
            'id' => 'shop-option',
            'icon' => 'el-icon-shopping-cart',
            'fields' => [
            ]
        ] );
        Redux::setSection( $theme_slug, [
            'title' => esc_html__('Catalog', 'softlab'),
            'id' => 'shop-catalog-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_catalog_page_title_bg_image',
                    'type' => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview'  => false,
                    'title' => esc_html__('Catalog Page Title Background Image', 'softlab'),
                    'default'  => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#1e73be',
                    ]
                ],
                [
                    'id' => 'shop_catalog_sidebar_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Shop Catalog Sidebar Layout', 'softlab'),
                    'options'  => [
                        'none' => [
                            'alt' => 'None',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ],
                        'left' => [
                            'alt' => 'Left',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ],
                        'right' => [
                            'alt' => 'Right',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ]
                    ],
                    'default'  => 'left'
                ],
                [
                    'id' => 'shop_catalog_sidebar_def',
                    'type' => 'select',
                    'title' => esc_html__('Shop Catalog Sidebar', 'softlab'),
                    'data' => 'sidebars',
                    'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_catalog_sidebar_def_width',
                    'type' => 'button_set',
                    'title' => esc_html__('Shop Sidebar Width', 'softlab'),
                    'options'  => [
                        '9' => '25%',
                        '8' => '33%',
                    ],
                    'default'  => '9',
                    'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_sidebar_sticky',
                    'type' => 'switch',
                    'title' => esc_html__('Sticky Sidebar On?', 'softlab'),
                    'default'  => false,
                    'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_sidebar_gap',
                    'type' => 'select',
                    'title' => esc_html__('Sidebar Side Gap', 'softlab'),
                    'options' => [
                        'def' => 'Default',
                        '0' => '0',
                        '15' => '15',
                        '20' => '20',
                        '25' => '25',
                        '30' => '30',
                        '35' => '35',
                        '40' => '40',
                        '45' => '45',
                        '50' => '50',
                    ],
                    'default'  => 'def',
                    'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_column',
                    'type' => 'button_set',
                    'title' => esc_html__('Shop Column', 'softlab'),
                    'options' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'default'  => '3',
                ],
                [
                    'id' => 'shop_products_per_page',
                    'type' => 'spinner',
                    'title' => esc_html__('Products per page', 'softlab'),
                    'default' => '12',
                    'min' => '1',
                    'step' => '1',
                    'max' => '100',
                ],
                [
                    'id' => 'use_animation_shop',
                    'type' => 'switch',
                    'title' => esc_html__('Use Animation Shop?', 'softlab'),
                    'default'  => true,
                ],
                [
                    'id' => 'shop_catalog_animation_style',
                    'type' => 'select',
                    'select2'  => ['allowClear' => false],
                    'title' => esc_html__('Animation Style', 'softlab'),
                    'options' => [
                        'fade-in' => esc_html__('Fade In', 'softlab'),
                        'slide-top' => esc_html__('Slide Top', 'softlab'),
                        'slide-bottom' => esc_html__('Slide Bottom', 'softlab'),
                        'slide-left' => esc_html__('Slide Left', 'softlab'),
                        'slide-right' => esc_html__('Slide Right', 'softlab'),
                        'zoom' => esc_html__('Zoom', 'softlab'),
                    ],
                    'default'  => 'slide-left',
                    'required' => [ 'use_animation_shop', '=', true ],
                ],
            ]

        ] );
        Redux::setSection( $theme_slug, [
            'title' => esc_html__('Single', 'softlab'),
            'id' => 'shop-single-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_single_page_title_bg_image',
                    'type' => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'title' => esc_html__('Single Page Title Background Image', 'softlab'),
                    'default'  => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#1e73be',
                    ]
                ],
                [
                    'id' => 'shop_single_sidebar_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Shop Single Sidebar Layout', 'softlab'),
                    'options'  => [
                        'none' => [
                            'alt' => 'None',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ],
                        'left' => [
                            'alt' => 'Left',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ],
                        'right' => [
                            'alt' => 'Right',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ]
                    ],
                    'default'  => 'none'
                ],
                [
                    'id' => 'shop_single_sidebar_def',
                    'type' => 'select',
                    'title' => esc_html__('Shop Single Sidebar', 'softlab'),
                    'data' => 'sidebars',
                    'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_single_sidebar_def_width',
                    'type' => 'button_set',
                    'title' => esc_html__('Shop Single Sidebar Width', 'softlab'),
                    'options'  => [
                        '9' => '25%',
                        '8' => '33%',
                    ],
                    'default'  => '9',
                    'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_single_sidebar_sticky',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Single Sticky Sidebar On?', 'softlab'),
                    'default'  => false,
                    'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_single_sidebar_gap',
                    'type' => 'select',
                    'title' => esc_html__('Shop Single Sidebar Side Gap', 'softlab'),
                    'options' => [
                        'def' => 'Default',
                        '0'  => '0',
                        '15' => '15',
                        '20' => '20',
                        '25' => '25',
                        '30' => '30',
                        '35' => '35',
                        '40' => '40',
                        '45' => '45',
                        '50' => '50',
                    ],
                    'default'  => 'def',
                    'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
                ],
                [
                    'id' => 'shop_title_conditional',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Single Post Title On/Off', 'softlab'),
                    'default'  => true,
                ],
                [
                    'id' => 'shop_single_page_title_text',
                    'type' => 'text',
                    'title' => esc_html__('Shop Single Page Title Text', 'softlab'),
                    'default'  => esc_html__('Shop', 'softlab'),
                    'required' => [ 'shop_title_conditional', '=', true ],
                ],
            ]

        ] );
        Redux::setSection( $theme_slug, [
            'title' => esc_html__('Related', 'softlab'),
            'id' => 'shop-related-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_related_columns',
                    'type' => 'button_set',
                    'title' => esc_html__('Related products column', 'softlab'),
                    'options'  => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ],
                    'default'  => '4',
                ],
                [
                    'id' => 'shop_r_products_per_page',
                    'type' => 'spinner',
                    'title' => esc_html__('Related products per page', 'softlab'),
                    'default'  => '4',
                    'min' => '1',
                    'step' => '1',
                    'max' => '100',
                ],
            ]

        ] );
        Redux::setSection( $theme_slug, [
            'title' => esc_html__('Cart', 'softlab'),
            'id' => 'shop-cart-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_cart_page_title_bg_image',
                    'type' => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'title' => esc_html__('Cart Page Title Background Image', 'softlab'),
                    'default'  => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#1e73be',
                    ]
                ],
            ]

        ] );
        Redux::setSection( $theme_slug, [
            'title' => esc_html__('Checkout', 'softlab'),
            'id' => 'shop-checkout-option',
            'subsection' => true,
            'fields' => [
                [
                    'id' => 'shop_checkout_page_title_bg_image',
                    'type' => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'title' => esc_html__('Checkout Page Title Background Image', 'softlab'),
                    'default'  => [
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#1e73be',
                    ]
                ],
            ]

        ] );
    }

