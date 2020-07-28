<?php

    $theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));

    $defaults = array(
        'min_value' => '',
        'min_value_label' => '',
        'max_value' => '',
        'max_value_label' => '',
        'completed' => '',
        'completed_label' => '',
        'units' => '$',
        'max_width' => '',
        'extra_class' => '',
        // Points
        'values' => '',
        // Colors
        'custom_bar_color' => false,
        'bg_color' => '#ecf1f9',
        'completed_color' => $theme_color,
        'custom_text_color' => false,
        'value_color' => '#8b9baf',
        'label_color' => '#8b9baf',
        'completed_text_color' => '#ffffff',
    );

    $atts = vc_shortcode_attribute_parse($defaults, $atts);
    extract($atts);
   
    wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);

    $output = $points_render = $completed_render = $value_render = $ico_progress_classes = $animation_class = $ico_progress_style = '';

     // uniq id
    $ico_progress_id = uniqid( "ico_progress_" );
    $ico_progress_attr = 'id='.$ico_progress_id;

    // custom social colors
    ob_start();
        if ((bool)$custom_text_color) {
            echo "#$ico_progress_id .progress_value_min,
                #$ico_progress_id .progress_value_max,
                #$ico_progress_id .progress_point{
                color: ".$label_color.";
            }";
            echo "#$ico_progress_id .progress_value_min span,
                #$ico_progress_id .progress_value_max span{
                color: ".$value_color.";
            }";
            echo "#$ico_progress_id .progress_point:before{
                background: ".$value_color.";
            }";
            echo "#$ico_progress_id .progress_value_completed{
                color: ".$completed_text_color.";
            }";
        }
        if ((bool)$custom_bar_color) {
            echo "#$ico_progress_id .progress_bar_wrap{
                background: ".$bg_color.";
            }";
            echo "#$ico_progress_id .progress_completed{
                background: ".$completed_color.";
            }";
        }
    $styles = ob_get_clean();
    Softlab_shortcode_css()->enqueue_softlab_css($styles);

    // Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

    // ico progress bar classes
    $ico_progress_classes .= !empty($animation_class) ? ' '.$animation_class : '';
    $ico_progress_classes .= !empty($extra_class) ? ' '.$extra_class : '';

    // ico progress bar style
    $ico_progress_style .= $max_width != '' ? 'style="max-width: '.$max_width.'px;"': '';

    // progress bar points
    $values = (array) vc_param_group_parse_atts( $values );
    $item_data = array();
    foreach ( $values as $data ) {
        $new_data = $data;
        $new_data['point_label'] = isset( $data['point_label'] ) ? $data['point_label'] : '';
        $new_data['point_value'] = isset( $data['point_value'] ) ? $data['point_value'] : '';

        $item_data[] = $new_data;
    }

    foreach ( $item_data as $item_d ) {

        $points_render .= '<div class="progress_point" style="left:'.(int)$item_d['point_value'].'%;">'.esc_html($item_d['point_label']).'</div>';

    }

    // progress bar completed
    $data_width = ((int)$completed/(int)$max_value)*100;
    $completed_render .= '<div class="progress_bar_wrap">';
        $completed_render .= $points_render;
        $completed_render .= '<div class="progress_completed" data-width="'.$data_width.'">'.((!empty($completed) || $completed != '' ) ? '<div class="progress_value_completed"><span>'.(esc_html($units).number_format((int)$completed, 0, '.', ',')).'</span> '.esc_html($completed_label).'</div>' : '').'</div>';
    $completed_render .= '</div>';

    // progress bar values & labels
    if ((!empty($min_value) || $min_value != '') || !empty($max_value)) {
        $value_render .= '<div class="progress_value_wrap">';
            $value_render .= (!empty($min_value) || $min_value != '' ) ? '<div class="progress_value_min"><span>'.(esc_html($units).number_format((int)$min_value, 0, '.', ',')).'</span> '.esc_html($min_value_label).'</div>' : '';
            $value_render .= !empty($max_value) ? '<div class="progress_value_max"><span>'.(esc_html($units).number_format((int)$max_value, 0, '.', ',')).'</span> '.esc_html($max_value_label).'</div>' : '';
        $value_render .= '</div>';
    }

    $output .= '<div '.$ico_progress_attr.' class="softlab_module_ico_progress_bar'.esc_attr($ico_progress_classes).'" '.$ico_progress_style.'>';
        $output .= $value_render;
        $output .= $completed_render;
    $output .= '</div>';

    echo Softlab_Theme_Helper::render_html($output);

?>