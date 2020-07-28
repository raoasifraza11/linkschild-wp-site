<?php
if ( !defined( 'ABSPATH' ) ) { exit; }
	
if ((bool)$use_gradient_switch) {
	$radial_gradient_idle = 'background: '.$theme_gradient_from.';';
	$radial_gradient_idle .= 'background: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';
	$radial_gradient_idle .= 'background: radial-gradient(circle farthest-corner at 100% 150%, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';	

	$radial_gradient_hover = 'background: -webkit-radial-gradient(100% 100%, circle farthest-corner, '.$theme_gradient_from.' 0%, '.$theme_gradient_to.' 100%);';
	$radial_gradient_hover .= 'background: radial-gradient(circle farthest-corner at 100% 100%, '.$theme_gradient_from.' 0%, '.$theme_gradient_to.' 100%);';

	$radial_gradient_idle_100_150 = 'background: '.$theme_gradient_from.';';
	$radial_gradient_idle_100_150 .= 'background: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';
	$radial_gradient_idle_100_150 .= 'background: radial-gradient(circle farthest-corner at 100% 150%, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';
	
	$radial_gradient_hover_0_m50 = 'background: '.$theme_gradient_to.';';
	$radial_gradient_hover_0_m50 = 'background-image: -webkit-radial-gradient(0% -50%, circle farthest-corner, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';
	$radial_gradient_hover_0_m50 .= 'background-image: radial-gradient(circle farthest-corner at 0% -50%, '.$theme_gradient_to.' 10%, '.$theme_gradient_from.' 50%);';
	
	$radial_gradient_hover_solid = 'background: '.$theme_gradient_from.';';
}

// Button
if ((bool)$use_gradient_switch) {
	$css .= ".softlab_module_button .wgl_button_link:before,
			 .softlab_module_button .btn_border_gradient:before {
				$radial_gradient_idle;
			}";
	$css .= ".softlab_module_button .wgl_button_link:after,
			 .softlab_module_button .btn_border_gradient:after {
				background: ".$theme_gradient_from.";
			}";
	$css .= ".softlab_module_button .wgl_button_link:hover {
				color: #ffffff;
			}";
}

// WPBakery Elements
$css .= '
.wpb-js-composer .wgl-container .vc_row .vc_general.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title:before,
.wpb-js-composer .wgl-container .vc_row .vc_general.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-heading:before,
.wpb-js-composer .wgl-container .vc_row .vc_toggle .vc_toggle_title:after {';
if ( (bool)$use_gradient_switch ) {
	$css .= " $radial_gradient_idle_100_150 }";
} else {
	$css .= 'background-color: '.$theme_color.' }';
}

$css .= '
.wpb-js-composer .wgl-container .vc_row .vc_toggle .vc_toggle_icon {';
if ( (bool)$use_gradient_switch ) {
	$css .= " color: $theme_gradient_from }";
} else {
	$css .= 'color: '.$theme_color.' }';
}

$css .= '
.wpb-js-composer .wgl-container .vc_row .vc_toggle.vc_toggle_active .vc_toggle_icon,
.wpb-js-composer .wgl-container .vc_row .vc_toggle:hover .vc_toggle_icon {';
if ( (bool)$use_gradient_switch ) {
	$css .= " color: inherit }";
}

// Blog Gradient
$css .= '
.info_prev-link_wrapper > a:before,
.softlab_module_carousel .slick-prev:before,
.softlab_module_carousel .slick-next:before,
.info_next-link_wrapper > a:before{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: '.$theme_gradient_to.';'
		.$radial_gradient_hover.'
	}';
} else {
	$css .= 'background-color: '.$theme_color.';}';
}

$css .= '.load_more_item,
	form.post-password-form input[type="submit"],
	.widget.softlab_widget.softlab_banner-widget .banner-widget_button,
	.button__wrapper,
	.wgl_module_team .team-info_icons .team-icon,
	.single-team .single_team_page .team-info_icons .team-icon,
	.page_404_wrapper .softlab_404_button .wgl_button_link,
	.blog-post .softlab_module_videobox .videobox_link_wrapper a{';
	if ( (bool)$use_gradient_switch ) {
		$css .= '
		background: '.$theme_gradient_to.';'
		.$radial_gradient_idle_100_150.'
	}';
} else {
	$css .= 'background-color: '.$theme_color.';}';
}		

// Widgets Gradient Styles
$css .= '
.author-widget_img-wrapper{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: '.$theme_gradient_to.';'
		.$radial_gradient_hover.'
	}';
} else {
	$css .= 'background-color: '.$theme_color.';}';
}			

//Shop Gradient Styles

$css .= '
ul.wgl-products li a.add_to_cart_button:before, 
ul.wgl-products li a.button:before, 
ul.wgl-products li .added_to_cart.wc-forward:before,	
div.product form.cart .button,		
#payment #place_order,
#payment #place_order:hover,
#add_payment_method .wc-proceed-to-checkout a.checkout-button,
table.shop_table.cart input.button,
#add_payment_method .wc-proceed-to-checkout a.checkout-button:before, 
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:before, 
.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:before,
.cart .button,
button.button:hover,
.cart_totals .wc-proceed-to-checkout a.checkout-button:hover,
.cart .button:hover,
.cart-collaterals .button,
.cart-collaterals .button:hover,
table.shop_table.cart input.button:hover,
.woocommerce-message a.button:before,
.wgl-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout):before,
.wc-proceed-to-checkout a.checkout-button{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: '.$theme_gradient_to.';'
		.$radial_gradient_idle_100_150.'
	}';

} else {
	$css .= 'background-color:'.$theme_color.';}';
}

if ( (bool)$use_gradient_switch ) {
	$css .= '.woocommerce-message a.button:after,
	#add_payment_method .wc-proceed-to-checkout a.checkout-button:after, 
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:after, 
	.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:after{';
	$css .= 'background-color:'.$theme_color.';}';	

	$css .= '.woocommerce .cart .button:hover{';
	$css .= 'color:'.$theme_color.' !important;}';
}


$css .= '
.woocommerce.widget_shopping_cart .buttons a:before,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: '.$theme_gradient_to.';'
		.$radial_gradient_idle_100_150.'
	}';
} else {
	$css .= 'background-color:'.$theme_color.';}';
}

// Linear Gradient

$css .= '
.rev_slider .rev-btn.gradient-button{';
if ( (bool)$use_gradient_switch ) {
	$css .= '
		background: -webkit-linear-gradient(left, '.$theme_gradient_from.' 0%, '.$theme_gradient_to.' 50%, '.$theme_gradient_from.' 100%);
		background-size: 300%, 1px;
		background-position: 0%;
	}';
} else {
	$css .= 'background-color:'.$theme_color.';}';
}

?>