<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Softlab
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php 
        wp_head(); 
    ?>
</head>

<body <?php body_class(); ?>>
    <?php 
        Softlab_Theme_Helper::preloader();
        get_template_part('templates/header/section','header');
        get_template_part('templates/header/section','page_title');
        
    ?>
    <main id="main">