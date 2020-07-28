<?php
	$theme_color = esc_attr(Softlab_Theme_Helper::get_option("theme-custom-color"));
	$theme_secondary_color = esc_attr(Softlab_Theme_Helper::get_option("theme-secondary-color"));
	$header_font_color = esc_attr(Softlab_Theme_Helper::get_option('header-font')['color']);

	$defaults = array(
		// General
		'title' => '',
		'subtitle' => '',
		'align' => 'left',
		'extra_class' => '',
		// Title
		'title_tag' => 'div',
		'title_size' => '36px',
		'title_line_height' => '48px',
		'title_weight' => '700',
		'custom_title_color' => false,
		'title_color' => $header_font_color,
		'responsive_font' => false,
		'font_size_desktop' => '',
		'font_size_tablet' => '',
		'font_size_mobile' => '',
		'custom_fonts_title' => false,
		// Subtitle
		'subtitle_tag' => 'div',
		'subtitle_size' => '18px',
		'subtitle_line_height' => '20px',
		'subtitle_weight' => '400',
		'custom_subtitle_color' => false,
		'subtitle_color' => $theme_secondary_color,
		'custom_fonts_subtitle' => false,
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	$title = $content;
	$output = $title_render = $subtitle_render = $dbl_head_wrap_classes = $animation_class = '';

	// Allowed HTML render
	$allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'span' => array(
			'class' => true,
			'style' => true,
		),
		'p' => array(
			'class' => true,
			'style' => true,
		)
	); 

	$dbl_id = uniqid( "softlab_dbl_" );
	$dbl_attr = 'id='.$dbl_id;

	// Render Google Fonts
	extract( Softlab_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title','google_fonts_subtitle') ) );
	$title_font_style = !empty($styles_google_fonts_title) ? esc_attr( $styles_google_fonts_title ) : '';
	$subtitle_font_style = !empty($styles_google_fonts_subtitle) ? esc_attr( $styles_google_fonts_subtitle ) : '';

	ob_start();
	if ((bool)$custom_subtitle_color) {
		echo "#$dbl_id .heading_subtitle{
				color: ".(!empty($subtitle_color) ? esc_attr($subtitle_color) : 'transparent').";
			  }";
	}
	$styles = ob_get_clean();
	Softlab_shortcode_css()->enqueue_softlab_css($styles);

	// Title styles
	$title_size_style = !empty($title_size) ? 'font-size:' . (int)$title_size . 'px; ' : '';
	$title_line_height_responsive = !empty($title_line_height) ? round(((int)$title_line_height / (int)$title_size), 3) : '';
	$title_line_height_style = !empty($title_line_height_responsive) ? 'line-height:' . $title_line_height_responsive .'; ' : '';
	$title_weight_style = !empty($title_weight) ? 'font-weight:' . (int)$title_weight . '; ' : '';
	$title_color_style = !empty($title_color && (bool)$custom_title_color) ? 'color:' . esc_attr($title_color) . '; ' : '';

	// Font Size of Title
	if (!empty($title_size_style) || !empty($title_line_height_style) || !empty($title_weight_style) || !empty($title_color_style) || !empty($title_font_style)) {
		$title_styles = 'style="'.$title_size_style.$title_line_height_style.$title_weight_style.$title_color_style.$title_font_style.'"';
	}

	// Subtitle styles
	$subtitle_size_style = !empty($subtitle_size) ? 'font-size:' . (int)$subtitle_size . 'px; ' : '';
	$subtitle_line_height_style = !empty($subtitle_line_height) ? 'line-height:' . (int)$subtitle_line_height . 'px; ' : '';
	$subtitle_weight_style = !empty($subtitle_weight) ? 'font-weight:' . (int)$subtitle_weight . '; ' : '';

	// Font Size of subTitle
	if (!empty($subtitle_size_style) || !empty($subtitle_line_height_style) || !empty($subtitle_weight_style) || !empty($subtitle_font_style)) {
		$subtitle_styles = 'style="'.$subtitle_size_style.$subtitle_line_height_style.$subtitle_weight_style.$subtitle_font_style.'"';
	} 

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// Wrapper classes
	$dbl_head_wrap_classes .= ' a'.$align;
	$dbl_head_wrap_classes .= ' '.$extra_class;
	$dbl_head_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';

	// Title output
	if (!empty($title)) {
		$title_render .= '<div class="heading_title" '.$title_styles.'>';
		if ((bool)$responsive_font) {
			$title_render .= !empty($font_size_desktop) ? '<div class="heading_title_desktop" style="font-size:'.(int)$font_size_desktop.'px;">' : '';
			$title_render .= !empty($font_size_tablet) ? '<div class="heading_title_tablet" style="font-size:'.(int)$font_size_tablet.'px;">' : '';
			$title_render .= !empty($font_size_mobile) ? '<div class="heading_title_mobile" style="font-size:'.(int)$font_size_mobile.'px;">' : '';
		}
		switch ($title_tag) {
			case 'div':
				$title_render .= wp_kses($title, $allowed_html);
				break;
			default:
				$title_render .= '<'.esc_attr($title_tag).'>'.wp_kses($title, $allowed_html).'</'.esc_attr($title_tag).'>';
				break;
		}
		if ((bool)$responsive_font) {
			$title_render .= !empty($font_size_desktop) ? '</div>' : '';
			$title_render .= !empty($font_size_tablet) ? '</div>' : '';
			$title_render .= !empty($font_size_mobile) ? '</div>' : '';
		}
		$title_render .= '</div>';
	}

	// Subtitle output
	if (!empty($subtitle)) {
		$subtitle_render .= '<div class="heading_subtitle" '.$subtitle_styles.'>';
			switch ($subtitle_tag) {
				case 'div':
					$subtitle_render .= esc_html($subtitle);
					break;
				default:
					$subtitle_render .= '<'.esc_attr($subtitle_tag).'>'.esc_html($subtitle).'</'.esc_attr($subtitle_tag).'>';
					break;
			}
		$subtitle_render .= '</div>';
	}

	// Render
	$output .= '<div '.esc_attr($dbl_attr).' class="softlab_module_double_headings'.esc_attr($dbl_head_wrap_classes).'">';
		$output .= $subtitle_render;
		$output .= $title_render;
	$output .= '</div>';

	echo Softlab_Theme_Helper::render_html($output);
?>  
