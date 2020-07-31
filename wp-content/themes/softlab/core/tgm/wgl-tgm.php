<?php

require_once get_template_directory() . '/core/tgm/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'softlab_register_required_plugins');

function softlab_register_required_plugins()
{
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = [
        [
            'name' => esc_html__('Softlab Core', 'softlab'), // The plugin name.
            'slug' => 'softlab-core', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/core/tgm/plugins/softlab-core.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ],
        [
            'name' => esc_html__('WPBakery Visual Composer', 'softlab'),
            'slug' => 'js_composer',
            'source' => get_template_directory() . '/core/tgm/plugins/js_composer.zip',
            'required' => true,
            'version' => '6.1',
        ],
        [
            'name' => esc_html__('Revolution Slider', 'softlab'),
            'slug' => 'revslider',
            'source' => get_template_directory() . '/core/tgm/plugins/revslider.zip',
            'version' => '6.2.2',
        ],
        [
            'name' => esc_html__('WooCommerce', 'softlab'),
            'slug' => 'woocommerce',
        ],
        [
            'name' => esc_html__('Contact Form 7', 'softlab'),
            'slug' => 'contact-form-7',
        ],
    ];

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = [
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins',  // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => [
            'page_title' => esc_html__('Install Required Plugins', 'softlab'),
            'menu_title' => esc_html__('Install Plugins', 'softlab'),
            'installing' => esc_html__('Installing Plugin: %s', 'softlab'), // %s = plugin name.
            'oops' => esc_html__('Something went wrong with the plugin API.', 'softlab'),
            'notice_can_install_required' => esc_html__('This theme requires the following plugins: %1$s.', 'softlab'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => esc_html__('This theme recommends the following plugins: %1$s.', 'softlab'), // %1$s = plugin name(s).
            'notice_cannot_install' => esc_html__('Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'softlab'), // %1$s = plugin name(s).
            'notice_can_activate_required' => esc_html__('The following required plugins are currently inactive: %1$s.', 'softlab'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => esc_html__('The following recommended plugins are currently inactive: %1$s.', 'softlab'), // %1$s = plugin name(s).
            'notice_cannot_activate' => esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'softlab'), // %1$s = plugin name(s).
            'notice_ask_to_update' => esc_html__('The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'softlab'), // %1$s = plugin name(s).
            'notice_cannot_update' => esc_html__('Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'softlab'), // %1$s = plugin name(s).
            'install_link' => esc_html__('Begin installing plugins', 'softlab'),
            'activate_link' => esc_html__('Begin activating plugins', 'softlab'),
            'return' => esc_html__('Return to Required Plugins Installer', 'softlab'),
            'plugin_activated' => esc_html__('Plugin activated successfully.', 'softlab'),
            'complete' => esc_html__('All plugins installed and activated successfully. %s', 'softlab'), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ]
    ];

    tgmpa($plugins, $config);
}
