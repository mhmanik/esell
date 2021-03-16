<?php
/*
Plugin Name: WoocTheme Demo Importer Helper
Plugin URI: http://wooctheme.club
Description: WoocTheme plugin after you've finished importing demo contents
Version: 1.0
Author: wooctheme
Author URI: http://wooctheme.club
*/
if (!defined('ABSPATH')) exit;
if (!defined('WOOC')) {
    define('WOOC', (WP_DEBUG) ? time() : '1.0');
    define('WOOC_PREVIEW', 'http://wooctheme.club/umart/demo/preview/');
    define('WOOC_PREVIEW_LINK', 'http://wooctheme.club/umart/');
    define('WOOC_DEMO_DATA_URL', 'http://wooctheme.club/umart/demo/');
    define('WOOC_PREFIX', 'wooc');
    define('WOOC_DEMO_HELPER_URL', plugin_dir_url(__FILE__));
    define('WOOC_DEMO_HELPER_ASSETS', trailingslashit(WOOC_DEMO_HELPER_URL . 'assets'));
}

if (is_admin() && !defined('FW')) {
    require_once dirname(__FILE__) . '/unyson/framework/bootstrap.php';
    add_filter('fw_framework_directory_uri', 'wooc_fw_framework_directory_uri');
    add_action('admin_menu', 'wooc_remove_unyson_menus', 12);
    add_action('network_admin_menu', 'wooc_remove_unyson_menus', 12);
    add_action('after_setup_theme', 'wooc_remove_unyson_footer_version', 12);
    add_action('admin_enqueue_scripts', 'wooc_fw_admin_styles', 20);
    // skip image import
    //add_filter( 'fw:ext:backups:add-restore-task:image-sizes-restore', '__return_false' );
    add_action('plugins_loaded', 'wooc_unyson_demo_importer', 20);
}

add_action('plugins_loaded', 'wooc_elementor_textdomain', 16);
function wooc_elementor_textdomain()
{
    load_plugin_textdomain('wooc', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

function wooc_fw_framework_directory_uri()
{
    return plugin_dir_url(__FILE__) . 'unyson/framework';
}

function wooc_remove_unyson_menus()
{
    remove_menu_page('fw-extensions');
    remove_menu_page('fw-extensions');
    remove_submenu_page('tools.php', 'fw-backups');
}

function wooc_remove_unyson_footer_version()
{
    $abcfw_obj = fw();
    remove_filter('update_footer', array($abcfw_obj->backend, '_filter_footer_version'), 11);
}

function wooc_fw_admin_styles()
{
    wp_enqueue_style('abc-demo-helper', WOOC_DEMO_HELPER_ASSETS . '/wooc-demo.css');
}

function wooc_unyson_demo_importer()
{
    require_once 'unyson-demo-importer.php';
}