<?php

/* ---------------------------------------------------
* Theme: umart
* Author: WoocTheme
* Author URI: https://www.wooctheme.club/
  -------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'umart_child_styles', 18 );
function umart_child_styles() {
	wp_enqueue_style( 'umart-child-style', get_stylesheet_uri() );
}
add_action( 'after_setup_theme', 'umart_child_theme_setup' );

function umart_child_theme_setup() {
    load_child_theme_textdomain( 'umart', get_stylesheet_directory() . '/languages' );
}