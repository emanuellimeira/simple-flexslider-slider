<?php 

/*
 * Simple Flexslider Slideshow. 
 * Flexslider Slideshow plugin for WordPress.
 *
 * Plugin Name: Simple Flexslider Slideshow
 * Plugin URI:  https://www.emanuellimeira.com.br/plugins/simple-flexslider-slider
 * Description: Easy to use slideshow plugin to create simple responsive slideshows with Flex Slider.
 * Version:     1.0.0
 * Author:      Emanuel Limeira
 * Author URI:  https://www.emanuellimeira.com.br
 * License:     GPL-2.0+
 * Copyright:   2016 Emanuel Limeira
 *
 * Text Domain: simple-slidz
 * Domain Path: /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

function flex_init() {
    $args = array(
        'public' => true,
        'label' => 'Flexslider',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('sflex_images', $args);
}
add_action('init', 'flex_init');

add_image_size('np_widget', 180, 100, true);
add_image_size('np_function', 600, 280, true);

add_theme_support( 'post-thumbnails' );

function sflex_function($type='sflex_function') {
    $args = array(
        'post_type' => 'sflex_images',
        'posts_per_page' => 5
    );
    $result = '<div class="hero-slider flexslider clearfix" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="fade" data-pause="yes">';
    $result .= '<ul class="slides">';
 
    //the loop
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
 
        $the_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $type);
        //$result .='<img title="'.get_the_title().'" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" alt=""/>';
        //$result .='<img title="'.get_the_title().'" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" alt=""/>';
        $result .='<li class=" parallax" style="background-image:url(' . $the_url[0] . ');"></li>';
    }
    // $result .= '</div>';
    // $result .='<div id = "htmlcaption" class = "nivo-html-caption">';
    // $result .='<strong>This</strong> is an example of a <em>HTML</em> caption with <a href = "#">a link</a>.';
    $result .='</ul>';
    $result .='</div>';
    return $result;
}

add_shortcode('sflex-shortcode', 'sflex_function');