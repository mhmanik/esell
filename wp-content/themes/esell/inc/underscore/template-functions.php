<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package esell
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/**
 * @param $classes
 * @return array
 */
function esell_body_classes( $classes ) {

    $axil_options = Helper::axil_get_options();


    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

    // Scroll to top
    $classes[] = ($axil_options['axil_scroll_to_top_enable'] != 'no') ? "active-scroll-to-top" : "";
    $classes[] = ($axil_options['axil_preloader'] != 'no') ? "active-preloader" : "";

    if (is_blog()) {
        $classes[] = ($axil_options['axil_blog_sidebar'] !== 'no') ? "active-sidebar-blog" : "";
        $classes[] = ($axil_options['axil_single_pos'] !== 'full') ? "active-sidebar-single-post" : "";
    }

    if (isset($axil_options['active_dark_mode'])){
        $classes[] = ($axil_options['active_dark_mode'] == 'on' || $axil_options['active_dark_mode'] == 1) ? 'active-dark-mode' : '';
    }

    // Header sticky and transparent
    $header_layout = Helper::axil_header_layout();
    $header_sticky = $header_layout['header_sticky'];
    $header_transparent = $header_layout['header_transparent'];
    $classes[] = ("no" !== $header_sticky && "0" !== $header_sticky) ? "header-sticky-active" : "";
    $classes[] = ("no" !== $header_transparent && "0" !== $header_transparent) ? "header-transparent-active" : "";

	return $classes;
}
add_filter( 'body_class', 'esell_body_classes' );

/**
 * @param $classes
 * @return string
 */
function esell_admin_body_classes($classes){
    global $post;
    if ( isset( $post ) ) {
        return $post->post_type . '-' . $post->post_name;
    }
}
add_filter( 'admin_body_class', 'esell_admin_body_classes');

/**
 * Get unique ID.
 */
function esell_unique_id($prefix = '')
{
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string)++$id_counter;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function esell_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action('wp_head', 'esell_pingback_header');

/**
 * Comment navigation
 */
function esell_get_post_navigation()
{
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
        require(get_template_directory() . '/inc/comment-nav.php');
    endif;
}

require get_template_directory() . '/inc/comment-form.php';