<?php
/*
Plugin Name: Axil Elements
Plugin URI: https://www.axiltheme.com
Description: eSell Elements Plugin for eSell Theme
Version: 1.0
Author: AxilTheme
Author URI: https://www.axiltheme.com
*/

if (!defined('ABSPATH')) exit;

if (!defined('ESELL_ELEMENTS')) {
    $plugin_data = get_file_data(__FILE__, array('version' => 'Version'));
    define('ESELL_ELEMENTS', $plugin_data['version']);
    define('ESELL_ELEMENTS_SCRIPT_VER', (WP_DEBUG) ? time() : ESELL_ELEMENTS);
    define('ESELL_ELEMENTS_THEME_PREFIX', 'esell');
    define('ESELL_ELEMENTS_BASE_DIR', plugin_dir_path(__FILE__));
}

class esell_elements
{

    public $plugin = 'esell-elements';
    public $action = 'esell_theme_init';
    protected static $instance;

    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'load_textdomain'), 20);
        add_action($this->action, array($this, 'after_theme_loaded'));
        add_action('axiltheme_social_share', array($this, 'wooc_social_share'));
    }

    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function after_theme_loaded()
    {
        require_once ESELL_ELEMENTS_BASE_DIR . 'plugin-hooks.php'; // Plugin Hooks
        require_once ESELL_ELEMENTS_BASE_DIR . 'lib/wp-svg/init.php'; // SVG support
        require_once ESELL_ELEMENTS_BASE_DIR . 'lib/sidebar-generator/init.php'; // Sidebar generator
        require_once ESELL_ELEMENTS_BASE_DIR . 'lib/navmenu-icon/init.php'; // Navmenu icon support

        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/custom-post.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/social-share.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/widgets/custom-widget-register.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/common-functions.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/allow-svg.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/ajax_requests.php');
        include_once(ESELL_ELEMENTS_BASE_DIR. '/include/sidebar-generator.php');

        include ESELL_ELEMENTS_BASE_DIR . 'inc/custom-login/custom-login.php';

        if (did_action('elementor/loaded')) {
            require_once ESELL_ELEMENTS_BASE_DIR . 'elementor/init.php'; // Elementor
            require_once ESELL_ELEMENTS_BASE_DIR . 'elementor/helper.php'; // Elementor
        }
    }

    public function wooc_social_share($sharer)
    {
        include ESELL_ELEMENTS_BASE_DIR . 'inc/social-share.php';
    }

    public function load_textdomain()
    {
        load_plugin_textdomain($this->plugin, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}

esell_elements::instance();