<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if (!class_exists('Softlab_header_sticky')) {
	class Softlab_header_sticky extends Softlab_get_header{

		public function __construct(){
			$this->header_vars();  
			$this->html_render = 'sticky';

	   		if (Softlab_Theme_Helper::options_compare('header_sticky','mb_customize_header_layout','custom') == '1') {
	   			$header_sticky_style = Softlab_Theme_Helper::get_option('header_sticky_style');
	   			$header_sticky_background = Softlab_Theme_Helper::get_option('header_sticky_background');
	   			$header_sticky_color = Softlab_Theme_Helper::get_option('header_sticky_color');
	   			$header_sticky_border = Softlab_Theme_Helper::get_option('header_sticky_border');
	   			$header_sticky_border_height = Softlab_Theme_Helper::get_option('header_sticky_border_height');
	   			$header_sticky_border_color = Softlab_Theme_Helper::get_option('header_sticky_border_color');
	   			$header_sticky_shadow = Softlab_Theme_Helper::get_option('header_sticky_shadow');

	   			$sticky_styles = '';
	   			$sticky_styles .= !empty($header_sticky_background['rgba']) ? 'background-color: '.(esc_attr($header_sticky_background['rgba'])).';' : '';
	   			$sticky_styles .= !empty($header_sticky_color) ? 'color: '.(esc_attr($header_sticky_color)).';' : '';

	   			if($header_sticky_border == '1'){
	   				$sticky_styles .= !empty($header_sticky_border_height['height']) ? 'border-style:solid;border-width: '.(int)(esc_attr($header_sticky_border_height['height'])).'px;' : '';
	   				$sticky_styles .= !empty($header_sticky_border_color['rgba']) ? 'border-color: '.(esc_attr($header_sticky_border_color['rgba'])).';' : '';
	   			}
	   			$sticky_styles = !empty($sticky_styles) ? ' style="'.$sticky_styles.'"' : '';

	   			echo "<div class='wgl-sticky-header".($header_sticky_shadow == '1' ? ' header_sticky_shadow' : '')."'".(!empty($sticky_styles) ? $sticky_styles : '').(!empty($header_sticky_style) ? ' data-style="'.esc_attr($header_sticky_style).'"' : '').">";

	   				echo "<div class='container-wrapper'>";
	   				
	   					$this->build_header_layout('sticky');
	   				echo "</div>";

	   			echo "</div>";
	   		}
		}
	}

    new Softlab_header_sticky();
}
