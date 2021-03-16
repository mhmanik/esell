<?php
/**
 * Plugin Name: WoocTheme Product Gallery Slider for WooCommerce
 * Description: This plugin will add a carousel in your Product Gallery.
 * Plugin URI: https://wooctheme.club/wooctheme-product-gallery-slider
 * Author: wooctheme.club
 * Version: 1.0
 * Author URI: https://wooctheme.club/
 *
 * Text Domain: wtpgs
 *
 * @package wtpgs
 *
 */

if (!defined('ABSPATH')) {
    exit;
}
if (!defined('WOOCTHEME_WTPGS')) {
    define('WOOCTHEME_WTPGS_VERSION', (WP_DEBUG) ? time() : '1.0');  
    define('WOOCTHEME_WTPGS_FIX', 'wtpgs');
    define('WOOCTHEME_WTPGS_URL', plugins_url('/', __FILE__));
}
add_action('plugins_loaded', 'wooc_hooks');
function wooc_hooks()
{
    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    remove_theme_support('wc-product-gallery-slider');
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
    add_action('woocommerce_before_single_product_summary', 'wooc_product_image', 20);
    add_action('woocommerce_product_thumbnails', 'wooc_product_thumbnails', 20);
    add_filter('plugin_action_links_' . plugin_basename(__FILE__) . '', 'wooc_plugin_row_meta');
    add_action('plugins_loaded', 'wooc_wtpgs_textdomain', 16);


}

function wooc_wtpgs_textdomain()
{
    load_plugin_textdomain('wtpgs', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
//---------------------------------------------------------------------
// Woocommerce Version Check
//---------------------------------------------------------------------
require_once plugin_dir_path(__FILE__) . '/inc/helper.php';
require_once plugin_dir_path(__FILE__) . '/inc/scripts.php';

//---------------------------------------------------------------------
// Add setting API
//---------------------------------------------------------------------

require_once plugin_dir_path(__FILE__) . '/inc/class.settings-api.php';

//---------------------------------------------------------------------
// Plugin Options
//---------------------------------------------------------------------

require_once plugin_dir_path(__FILE__) . '/inc/options.php';

new wooc_Settings_API();

function wooc_get_option($option, $section, $default = '')
{

    $options = get_option($section);
    if (isset($options[$option])) {
         $option =  $options[$option];
         return apply_filters( 'wooc_get_option', $option );
    }
    return $default;
}

//---------------------------------------------------------------------
// Plugin Functions
//---------------------------------------------------------------------

if (!function_exists('wooc_product_image')) {
    /**
     * Output the product image before the single product summary.
     */
    function wooc_product_image()
    {

        require_once plugin_dir_path(__FILE__) . '/inc/product-image.php';
    }
}
if (!function_exists('wooc_product_thumbnails')) {
    /**
     * Output the product image before the single product summary.
     */
    function wooc_product_thumbnails()
    {

        require_once plugin_dir_path(__FILE__) . '/inc/product-thumbnails.php';
    }
}

/*
Link in Plugin Meta
 */
function wooc_plugin_row_meta($links)
{

    $row_meta = array(
        'settings' => '<a href="' . admin_url('admin.php?page=wooc_options') . '">Settings</a>'
    );

    return array_merge($links, $row_meta);


}