<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.1
 */

if (!isset($content_width)) {
    $content_width = 1300;
}
global $wooc_globals;
$wooc_globals = array();

// Globals: WooCommerce - Custom variation controls

$wooc_globals['pa_color_slug'] = sanitize_title(apply_filters('wooc_color_attribute_slug', 'color'));
$wooc_globals['pa_variation_controls'] = array(
    'color' => esc_html__('Color', 'uiart'),
    'image' => esc_html__('Image', 'uiart'),
    'size' => esc_html__('Label', 'uiart')
);
$wooc_globals['pa_cache'] = array();


class Uiart_Main
{

    public $theme = 'uiart';
    public $action = 'uiart_theme_init';

    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'load_textdomain'));
        add_action('admin_notices', array($this, 'plugin_update_notices'));
        $this->includes();
    }

    public function load_textdomain()
    {
        load_theme_textdomain($this->theme, get_template_directory() . '/languages');
    }

    public function includes()
    {
        require_once get_template_directory() . '/inc/traits/init.php';
        require_once get_template_directory() . '/inc/customizer.php';
        require_once get_template_directory() . '/inc/helper.php';
        require_once get_template_directory() . '/inc/constants.php';
        require_once get_template_directory() . '/inc/includes.php';
        require_once get_template_directory() . '/inc/woo-helper.php';
        require_once get_template_directory() . '/inc/class-search-autocomplete.php';
        do_action($this->action);
    }

    public function plugin_update_notices()
    {
        $plugins = array();

        if (defined('UIART_ELEMENTS')) {
            if (version_compare(UIART_ELEMENTS, '1.0', '<')) {
                $plugins[] = 'Uiart Elements';
            }
        }

        foreach ($plugins as $plugin) {
            $notice = '<div class="error"><p>' . sprintf(__("Please update plugin <b><i>%s</b></i> to the latest version otherwise some functionalities will not work properly. You can update it from <a href='%s'>here</a>", 'uiart'), $plugin, menu_page_url('classima-install-plugins', false)) . '</p></div>';          
                    $allowed_tags = wp_kses_allowed_html( 'post' );
                    echo wp_kses( $notice, $allowed_tags );
        }
    }
}

new Uiart_Main;
add_editor_style('style-editor.css');
add_filter('body_class', 'wooc_filter_body_classes', 30);
function wooc_filter_body_classes($classes)
{
    if (is_search() && ($index = array_search('psearch-results', $classes)) !== null) {
        unset($classes[$index]);
    }
    return $classes;
}

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links)
{
    $links = str_replace('</a> (', '</a> <span class="category-number-right">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($link_html)
{
    $link_html = str_replace('</a>&nbsp;(', '</a> <span class="category-number-right">(', $link_html);
    $link_html = str_replace(')', ')</span>', $link_html);
    return $link_html;
}

function wooc_unique_id($prefix = '')
{
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string)++$id_counter;
}

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );


    }
}


/**
 * Escapeing
 */

if (!function_exists('wooccapeing')) {
    function wooccapeing($html)
    {
        return $html;
    }
}
