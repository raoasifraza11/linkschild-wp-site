<?php

// Class Theme Helper
require_once(get_template_directory() . '/core/class/theme-helper.php');

// Class Theme Cache
require_once(get_template_directory() . '/core/class/theme-cache.php');

// Class Walker comments
require_once(get_template_directory() . '/core/class/walker-comment.php');

// Class Walker Mega Menu
require_once(get_template_directory() . '/core/class/walker-mega-menu.php');

// Class Theme Likes
require_once(get_template_directory() . '/core/class/theme-likes.php');

// Class Theme Cats Meta
require_once(get_template_directory() . '/core/class/theme-cat-meta.php');

// Class Single Post
require_once(get_template_directory() . '/core/class/single-post.php');

// Class Tinymce
require_once(get_template_directory() . "/core/class/tinymce-icon.php");

// Class Theme Autoload
require_once(get_template_directory() . '/core/class/theme-autoload.php');



function softlab_editor()
{

    /* This theme styles the visual editor with editor-style.css to match the theme style. */
    add_editor_style('css/editor-styles.css');
    add_editor_style('fonts/flaticon/flaticon.css');

    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'softlab_editor');

function softlab_content_width()
{
    if (!isset($content_width)) {
        $content_width = 940;
    }
}
add_action('after_setup_theme', 'softlab_content_width', 0);

function softlab_theme_slug_setup()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'softlab_theme_slug_setup');

require_once(get_template_directory() . '/wpb/wpb-init.php');


add_action('init', 'softlab_page_init');
if (!function_exists('softlab_page_init')) {
    function softlab_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('softlab_main_menu')) {
    function softlab_main_menu($location = '')
    {
        wp_nav_menu(array(
            'theme_location'  => 'main_menu',
            'menu'  => $location,
            'container' => '',
            'container_class' => '',
            'after' => '',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new Softlab_Mega_Menu_Waker()
        ));
    }
}

// return all sidebars
if (!function_exists('softlab_get_all_sidebar')) {
    function softlab_get_all_sidebar()
    {
        global $wp_registered_sidebars;
        $out = [];
        if (empty($wp_registered_sidebars))
            return;
        foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
        endforeach;
        return $out;
    }
}

if (!function_exists('softlab_get_custom_preset')) {
    function softlab_get_custom_preset()
    {
        $custom_preset = get_option('softlab_set_preset');
        $presets =  softlab_default_preset();

        $out = [];
        $out['default'] = esc_html__('Default', 'softlab');
        $i = 1;
        if (is_array($presets)) {
            foreach ($presets as $key => $value) {
                $out[$key] = $key;
                $i++;
            }
        }
        if (is_array($custom_preset)) {
            foreach ($custom_preset as $preset_id => $preset) :
                $out[$preset_id] = $preset_id;
            endforeach;
        }
        return $out;
    }
}

if (!function_exists('softlab_get_custom_menu')) {
    function softlab_get_custom_menu()
    {
        $taxonomies = [];

        $menus = get_terms('nav_menu');
        foreach ($menus as $key => $value) {
            $taxonomies[$value->name] = $value->name;
        }
        return $taxonomies;
    }
}

function softlab_get_attachment($attachment_id)
{
    $attachment = get_post($attachment_id);
    return [
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    ];
}

if (!function_exists('softlab_reorder_comment_fields')) {
    function softlab_reorder_comment_fields($fields)
    {
        $new_fields = [];

        $myorder = ['author', 'email', 'url', 'comment'];

        foreach ($myorder as $key) {
            $new_fields[$key] = isset($fields[$key]) ? $fields[$key] : '';
            unset($fields[$key]);
        }

        if ($fields) {
            foreach ($fields as $key => $val) {
                $new_fields[$key] = $val;
            }
        }

        return $new_fields;
    }
}
add_filter('comment_form_fields', 'softlab_reorder_comment_fields');

function softlab_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'softlab_mce_buttons_2');


function softlab_tiny_mce_before_init($settings)
{
    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
    $style_formats = [
        [
            'title' => esc_html__('Dropcap', 'softlab'),
            'items' => [
                [
                    'title' => esc_html__('Dropcap', 'softlab'),
                    'inline' => 'span',
                    'classes' => 'dropcap',
                    'styles' => ['color' => esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'))],
                ],
                [
                    'title' => esc_html__('Dropcap with background', 'softlab'),
                    'inline' => 'span',
                    'classes' => 'dropcap-bg',
                    'styles' => ['background-color' => esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'))],
                ],
            ],
        ],
        [
            'title' => esc_html__('Highlighter', 'softlab'),
            'inline' => 'span',
            'classes' => 'highlighter',
            'styles' => ['color' => '#ffffff', 'background-color' => esc_attr(Softlab_Theme_Helper::get_option('theme-custom-color'))],
        ],
        [
            'title' => esc_html__('Double Heading Font', 'softlab'),
            'inline' => 'span',
            'classes' => 'dbl_font',
        ],
        [
            'title' => esc_html__('Font Weight', 'softlab'),
            'items' => [
                [
                    'title' => esc_html__('Default', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => 'inherit']
                ], [
                    'title' => esc_html__('Lightest (100)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '100']
                ], [
                    'title' => esc_html__('Lighter (200)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '200']
                ], [
                    'title' => esc_html__('Light (300)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '300']
                ], [
                    'title' => esc_html__('Normal (400)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '400']
                ], [
                    'title' => esc_html__('Medium (500)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '500']
                ], [
                    'title' => esc_html__('Semi-Bold (600)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '600']
                ], [
                    'title' => esc_html__('Bold (700)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '700']
                ], [
                    'title' => esc_html__('Bolder (800)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '800']
                ], [
                    'title' => esc_html__('Extra Bold (900)', 'softlab'),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => ['font-weight' => '900']
                ],
            ]
        ],
        [
            'title' => esc_html__('List Style', 'softlab'),
            'items' => [
                [
                    'title' => esc_html__('Check', 'softlab'),
                    'selector' => 'ul',
                    'classes' => 'softlab_check'
                ], [
                    'title' => esc_html__('Plus', 'softlab'),
                    'selector' => 'ul',
                    'classes' => 'softlab_plus'
                ], [
                    'title' => esc_html__('Dash', 'softlab'),
                    'selector' => 'ul',
                    'classes' => 'softlab_dash'
                ], [
                    'title' => esc_html__('Slash', 'softlab'),
                    'selector' => 'ul',
                    'classes' => 'softlab_slash'
                ], [
                    'title' => esc_html__('No List Style', 'softlab'),
                    'selector' => 'ul',
                    'classes' => 'no-list-style'
                ],
            ]
        ],
    ];

    $settings['style_formats'] = str_replace('"', "'", json_encode($style_formats));
    $settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
    return $settings;
}
add_filter('tiny_mce_before_init', 'softlab_tiny_mce_before_init');

function softlab_theme_add_editor_styles()
{
    add_editor_style('css/libs/v4-shims.min.css');
    add_editor_style('css/libs/all.min.css');
}
add_action('current_screen', 'softlab_theme_add_editor_styles');

function softlab_categories_postcount_filter($variable)
{
    if (strpos($variable, '</a> (')) {
        $variable = str_replace('</a> (', '</a> <span class="post_count">(', $variable);
        $variable = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post_count">(', $variable);
        $variable = str_replace(')', ')</span>', $variable);
    }

    $pattern1 = '/cat-item-\d+/';
    preg_match_all($pattern1, $variable, $matches);
    if (isset($matches[0])) {
        foreach ($matches[0] as $key => $value) {
            $int = (int) str_replace('cat-item-', '', $value);
            $icon_image_id = get_term_meta($int, 'category-icon-image-id', true);
            if (!empty($icon_image_id)) {
                $icon_image = wp_get_attachment_image_src($icon_image_id, 'full');
                $icon_image_alt = get_post_meta($icon_image_id, '_wp_attachment_image_alt', true);
                $replacement = '$1<img class="cats_item-image" src="' . esc_url($icon_image[0]) . '" alt="' . (!empty($icon_image_alt) ? esc_attr($icon_image_alt) : '') . '"/>';
                $pattern = '/(cat-item-' . $int . '+.*?><a.*?>)/';
                $variable = preg_replace($pattern, $replacement, $variable);
            }
        }
    }

    return $variable;
}
add_filter('wp_list_categories', 'softlab_categories_postcount_filter');

add_filter('get_archives_link', 'softlab_render_archive_widgets', 10, 6);
function softlab_render_archive_widgets($link_html, $url, $text, $format, $before, $after)
{

    $text = wptexturize($text);
    $url  = esc_url($url);

    if ('link' == $format) {
        $link_html = "\t<link rel='archives' title='" . esc_attr($text) . "' href='$url' />\n";
    } elseif ('option' == $format) {
        $link_html = "\t<option value='$url'>$before $text $after</option>\n";
    } elseif ('html' == $format) {
        $after = str_replace('(', '', $after);
        $after = str_replace(' ', '', $after);
        $after = str_replace('&nbsp;', '', $after);
        $after = str_replace(')', '', $after);

        $after = !empty($after) ? " <span class='post_count'>(" . esc_html($after) . ")</span> " : "";

        $link_html = "<li>" . esc_html($before) . "<a href='" . esc_url($url) . "'>" . esc_html($text) . "</a>" . $after . "</li>";
    } else { // custom
        $link_html = "\t$before<a href='$url'>$text</a>$after\n";
    }

    return $link_html;
}

// Add image size
if (function_exists('add_image_size')) {
    add_image_size('softlab-700-570',  700, 570, true);
    add_image_size('softlab-440-440',  440, 440, true);
    add_image_size('softlab-220-180',  220, 180, true);
    add_image_size('softlab-120-120',  120, 120, true);
}

// Include Woocommerce init if plugin is active
if (class_exists('WooCommerce')) {
    require_once(get_template_directory() . '/woocommerce/woocommerce-init.php');
}

add_filter('vc_css_editor_border_radius_options_data', 'softlab_border_radius_options');

function softlab_border_radius_options()
{
    return [
        '' => esc_html__('None', 'softlab'),
        '1px' => esc_html__('1px', 'softlab'),
        '2px' => esc_html__('2px', 'softlab'),
        '3px' => esc_html__('3px', 'softlab'),
        '4px' => esc_html__('4px', 'softlab'),
        '5px' => esc_html__('5px', 'softlab'),
        '10px' => esc_html__('10px', 'softlab'),
        '15px' => esc_html__('15px', 'softlab'),
        '20px' => esc_html__('20px', 'softlab'),
        '25px' => esc_html__('25px', 'softlab'),
        '30px' => esc_html__('30px', 'softlab'),
        '35px' => esc_html__('35px', 'softlab'),
        '50%' => esc_html__('50%', 'softlab'),
    ];
}

add_filter('softlab_enqueue_shortcode_css', 'softlab_render_css');
function softlab_render_css($styles)
{
    global $softlab_dynamic_css;
    if (!isset($softlab_dynamic_css['style'])) {
        $softlab_dynamic_css = [];
        $softlab_dynamic_css['style'] = $styles;
    } else {
        $softlab_dynamic_css['style'] .= $styles;
    }
}
