<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use \Redux;
use \ReduxFrameworkPlugin;

class WOOCTheme
{

    protected static $instance;

    // Sitewide static variables
    public static $options;

    // Template specific variables

    public static $layout;
    public static $sidebar;
    public static $has_top_bar;
    public static $top_bar_style;
    public static $header_style;
    public static $footer_style;
    public static $has_banner;
    public static $has_breadcrumb;
    public static $bgtype;
    public static $bgimg;
    public static $bgcolor;
    public static $wc_single_layout;
    public static $section_spacing;
    public static $wrapper_full;
    public static $header_transparent;
 

    private function __construct()
    {
        add_action('after_setup_theme', array($this, 'set_options'));
        $this->redux_init();
        $this->layerslider_init();
    }

    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function set_options()
    {
        include Constants::$theme_inc_dir . 'predefined-data.php';
        $options = json_decode($predefined_options, true);
        if (class_exists('Redux') && isset($GLOBALS[Constants::$theme_options])) {
            $options = wp_parse_args($GLOBALS[Constants::$theme_options], $options);
        }
        self::$options = $options;
    }


    public function redux_init()
    {
        $options = Constants::$theme_options;

        // Remove Redux Ads
        add_filter("redux/{$options}/aURL_filter", '__return_empty_string');

        // Remove Redux Menu
        add_action('admin_menu', function () {
            remove_submenu_page('tools.php', 'redux-about');
        }, 12);

        // If Redux is running as a plugin, this will remove the demo notice and links
        add_action('redux/loaded', function () {
            if (class_exists('ReduxFrameworkPlugin')) {
                add_filter('plugin_row_meta', array($this, 'redux_remove_extra_meta'), 12, 2);
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        });
    }

    public function redux_remove_extra_meta($links, $file)
    {
        if (strpos($file, 'redux-framework.php') !== false) {
            $links = array_slice($links, 0, 3);
        }

        return $links;
    }

    public function layerslider_init()
    {

        if (function_exists('layerslider_set_as_theme')) {
            layerslider_set_as_theme();
        }

        if (function_exists('layerslider_hide_promotions')) {
            layerslider_hide_promotions();
        }

        add_filter('option_ls-latest-version', '__return_false'); // Disable LayerSlider update notice

        // Add more skins
        if (class_exists('\LS_Sources')) {
            \LS_Sources::addSkins(Constants::$theme_inc_dir . 'layerslider-skins/');
        }

        // Remove purchase notice from plugins page
        add_action('admin_init', function () {
            if (defined('LS_PLUGIN_BASE')) {
                remove_action('after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3);
            }
        });
    }

}

WOOCTheme::instance();