<?php
/*
Plugin Name: WoocTheme Helper
Plugin URI: https://www.Wooctheme.club
Description: Wooctheme Helper Plugin for Uiart
Version: 1.0
Author: Wooctheme
Author URI: https://www.Wooctheme.club
*/

if (!defined('ABSPATH')) {
    exit;
}
if (!defined('WOOCTHEME_THEME_HELPER')) {
    define('WOOCTHEME_THEME_HELPER_VERSION', (WP_DEBUG) ? time() : '1.0');
    define('WOOCTHEME_THEME_HELPER_THEME', 'uiart');
    define('WOOCTHEME_THEME_WIDGET_PREA', 'wooctheme');
    define('WOOCTHEME_THEME_HELPER_FIX', 'wooc');
    define('WOOCTHEME_THEME_HELPER_URL', plugins_url('/', __FILE__));
}

class wooctheme_theme_helper
{
    protected static $instance = null;
    public $plugin = 'wooctheme-theme-helper';
    public $action = 'uiart_theme_init';
    public $panels = 'wooctheme_helper_init';
    public $version = WOOCTHEME_THEME_HELPER_VERSION;
    public $base_url = null;

    public function __construct()
    {
        $this->base_url = $this->get_base_url() . '/wooctheme-theme-helper/';
        add_action('plugins_loaded', array($this, 'wooctheme_load_textdomain'), 16);
        add_action('after_setup_theme', array($this, 'wooctheme_after_setup_includes'), 15);
        add_action('after_setup_theme', array($this, 'wooctheme_after_widgets_includes'), 15);
        add_action("redux/options/wooctheme/saved", array($this, 'wooctheme_flush_redux_saved'), 10, 2);
        add_action("redux/options/wooctheme/section/reset", array($this, 'wooctheme_flush_redux_reset'));
        add_action("redux/options/wooctheme/reset", array($this, 'wooctheme_flush_redux_reset'));
        add_action('init', array($this, 'wooctheme_rewrite_flush_check'));
    }

    public function wooctheme_load_textdomain()
    {
        load_plugin_textdomain($this->plugin, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    public function wooctheme_after_setup_includes()
    {
        if (!did_action($this->action)) {
            return;
        }       
        require_once 'includes/cmb2/post-meta.php';
        require_once 'includes/cmb2/user-meta.php';
        require_once 'includes/cmb2/cmb2-radio-image.php';
        require_once 'includes/cmb2/cmb2-taxonomy/taxonomy-meta.php';
        require_once 'includes/sidebar-generator.php';

    }

    public function wooctheme_after_widgets_includes()
    {
        require_once 'widgets/wooc-about-widget.php';
        require_once 'widgets/wooc-social-widget.php';
        require_once 'widgets/wooc-post-widget.php';
        require_once 'widgets/wooc-contact-info.php';
        require_once 'widgets/wooc-info-widget.php';  
        if ( class_exists( 'WooCommerce' ) ) {
            require_once 'widgets/woocommerce-product-sorting.php';
            require_once 'widgets/woocommerce-price-filter.php';
        }
    }

    private function get_base_url()
    {
        $file = dirname(dirname(__FILE__));
        // Get correct URL and path to wp-content
        $content_url = untrailingslashit(dirname(dirname(get_stylesheet_directory_uri())));
        $content_dir = untrailingslashit(WP_CONTENT_DIR);

        // Fix path on Windows

        $file = wp_normalize_path($file);
        $content_dir = wp_normalize_path($content_dir);
        $url = str_replace($content_dir, $content_url, $file);
        return $url;
    }

    // Flush rewrites
    public function wooctheme_flush_redux_saved($saved_options, $changed_options)
    {
        if (empty($changed_options)) {
            return;
        }
        $panelspfix = WOOCTHEME_THEME_HELPER_THEME;
        $flush = false;
        $slugs = array('team_slug', 'services_slug', 'project_slug');
        foreach ($slugs as $slug) {
            if (array_key_exists($slug, $changed_options)) {
                $flush = true;
            }
        }
        if ($flush) {
            update_option("{$panelspfix}_rewrite_flash", true);
        }
    }

    public function wooctheme_flush_redux_reset()
    {
        $panelspfix = WOOCTHEME_THEME_HELPER_THEME;
        update_option("{$panelspfix}_rewrite_flash", true);
    }

    public function wooctheme_rewrite_flush_check()
    {
        $panelspfix = WOOCTHEME_THEME_HELPER_THEME;
        if (get_option("{$panelspfix}_rewrite_flash") == true) {
            flush_rewrite_rules();
            update_option("{$panelspfix}_rewrite_flash", false);
        }
    }
}

new wooctheme_theme_helper;