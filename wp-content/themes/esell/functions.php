<?php
/**
 * esell functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package esell
 */

define('AXIL_THEME_URI', get_template_directory_uri());
define('AXIL_THEME_DIR', get_template_directory());
define('AXIL_CSS_URL', get_template_directory_uri() . '/assets/css/');
define('AXIL_JS_URL', get_template_directory_uri() . '/assets/js/');
define('AXIL_ADMIN_CSS_URL', get_template_directory_uri() . '/assets/admin/css/');
define('AXIL_ADMIN_JS_URL', get_template_directory_uri() . '/assets/admin/js/');
define('AXIL_FREAMWORK_DIRECTORY', AXIL_THEME_DIR . '/inc/');
define('AXIL_FREAMWORK_HELPER', AXIL_THEME_DIR . '/inc/helper/');
define('AXIL_FREAMWORK_OPTIONS', AXIL_THEME_DIR . '/inc/options/');
define('AXIL_FREAMWORK_CUSTOMIZER', AXIL_THEME_DIR . '/inc/customizer/');
define('AXIL_THEME_FIX', 'axil');
define('AXIL_FREAMWORK_LAB', AXIL_THEME_DIR . '/inc/lab/');
define('AXIL_FREAMWORK_TP', AXIL_THEME_DIR . '/template-parts/');
define('AXIL_IMG_URL', AXIL_THEME_URI . '/assets/images/logo/');
do_action( 'esell_theme_init' );
/* user info */
defined('WOOC_CORE_USER_LOGGED') or define('WOOC_CORE_USER_LOGGED', is_user_logged_in());

/* Check if WooCommerce active */
defined('WOOC_WOO_ACTIVED') or define('WOOC_WOO_ACTIVED', (bool) function_exists('WC'));

/* Check if DOKAN active */
defined('WOOC_DOKAN_ACTIVED') or define('WOOC_DOKAN_ACTIVED', (bool) function_exists('dokan'));

defined('WOOC_WISHLIST_ENABLE') or define('WOOC_WISHLIST_ENABLE', (bool) defined('YITH_WCWL'));


$axi_theme_data = wp_get_theme();
define('AXIL_VERSION', (WP_DEBUG) ? time() : $axi_theme_data->get('Version'));

global $wooc_globals;
$wooc_globals = array();

// Globals: WooCommerce - Custom variation controls

$wooc_globals['pa_color_slug'] = sanitize_title(apply_filters('wooc_color_attribute_slug', 'color'));
$wooc_globals['pa_variation_controls'] = array(
    'color' => esc_html__('Color', 'esell'),
    'image' => esc_html__('Image', 'esell'),
    'size' => esc_html__('Label', 'esell')
);
$wooc_globals['pa_cache'] = array();

if (!function_exists('esell_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function esell_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on esell, use a find and replace
         * to change 'esell' to the name of your theme in all the template files.
         */
        load_theme_textdomain('esell', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'esell'),
            'headertop' => esc_html__('Header Top Menu (No depth supported)', 'esell'),
            'footerbottom' => esc_html__('Footer Bottom Menu (No depth supported)', 'esell'),
            'myaccount' => esc_html__('My Account', 'esell'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Post Format
         */
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));


        add_editor_style( array( 'style-editor.css', axil_fonts_url() ) );
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
        add_editor_style('style-editor.css');

        // for gutenberg support
        add_theme_support( 'align-wide' );
        add_theme_support( 'editor-color-palette', array(
            array(
                'name' => esc_html__( 'Primary', 'esell' ),
                'slug' => 'esell-primary',
                'color' => '#3858F6',
            ),
            array(
                'name' => esc_html__( 'Secondary', 'esell' ),
                'slug' => 'esell-secondary',
                'color' => '#D93E40',
            ),
            array(
                'name' => esc_html__( 'Tertiary', 'esell' ),
                'slug' => 'esell-tertiary',
                'color' => '#050505',
            ),
            array(
                'name' => esc_html__( 'White', 'esell' ),
                'slug' => 'esell-white',
                'color' => '#ffffff',
            ),
            array(
                'name' => esc_html__( 'Dark Light', 'esell' ),
                'slug' => 'esell-dark-light',
                'color' => '#1A1A1A',
            ),
        ) );

        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => esc_html__( 'Small', 'esell' ),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__( 'Normal', 'esell' ),
                'size' => 16,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__( 'Large', 'esell' ),
                'size' => 36,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__( 'Huge', 'esell' ),
                'size' => 50,
                'slug' => 'huge'
            )
        ) );

        /**
         * Add Custom Image Size
         */
        add_image_size('axil-blog-thumb', 295, 250, true);

        add_image_size('axil-single-blog-thumb', 1600, 750, true); // blog single 
        
        add_image_size('axil-main-slider-thumb', 1230, 615, true);
        //add_image_size('axil-tab-post-thumb', 390, 260, true);
        //add_image_size('axil-tab-big-post-thumb', 705, 660, true);
        //add_image_size('axil-tab-small-post-thumb', 495, 300, true);
        add_image_size('axil-grid-big-post-thumb', 600, 500, true);
        add_image_size('axil-grid-small-post-thumb', 285, 190, true);

    }
endif;
add_action('after_setup_theme', 'esell_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function esell_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('esell_content_width', 640);
}

add_action('after_setup_theme', 'esell_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
require_once(AXIL_FREAMWORK_DIRECTORY . "scripts.php");
/**
 * Global Functions
 */
require_once(AXIL_FREAMWORK_DIRECTORY . "global-functions.php");

/**
 * Register Custom Widget Area
 */
require_once(AXIL_FREAMWORK_DIRECTORY . "widget-area-register.php");

/**
 * Register Custom Fonts
 */
require_once(AXIL_FREAMWORK_DIRECTORY . "register-custom-fonts.php");

/**
 * TGM
 */
require_once(AXIL_FREAMWORK_DIRECTORY . "tgm-config.php");

require_once(AXIL_FREAMWORK_DIRECTORY . "loadmore.php");


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/underscore/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/underscore/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/underscore/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/underscore/jetpack.php';
}

/**
 * Helper Template
 */
require_once(AXIL_FREAMWORK_HELPER . "menu-area-trait.php");
require_once(AXIL_FREAMWORK_HELPER . "layout-trait.php");
require_once(AXIL_FREAMWORK_HELPER . "option-trait.php");
require_once(AXIL_FREAMWORK_HELPER . "meta-trait.php");
require_once(AXIL_FREAMWORK_HELPER . "banner-trait.php");
require_once(AXIL_FREAMWORK_HELPER . "advertisements-trait.php");
// Helper
require_once(AXIL_FREAMWORK_HELPER . "helper.php");

/**
 * Options
 */
require_once(AXIL_FREAMWORK_OPTIONS . "theme/option-framework.php");
require_once(AXIL_FREAMWORK_OPTIONS . "page-options.php");
require_once(AXIL_FREAMWORK_OPTIONS . "post-format-options.php");
require_once(AXIL_FREAMWORK_OPTIONS . "user-extra-meta.php");
require_once(AXIL_FREAMWORK_OPTIONS . "team-extra-meta.php");
require_once(AXIL_FREAMWORK_OPTIONS . "post-and-category-options.php");
require_once(AXIL_FREAMWORK_OPTIONS . "menu-options.php");


if ( class_exists( 'WooCommerce' ) ) {
   require_once(AXIL_THEME_DIR . "/woocommerce/custom/functions.php");
   
   require_once(AXIL_THEME_DIR . "/woocommerce/inc/woocommerce-attribute-functions.php");
   require_once(AXIL_THEME_DIR . "/woocommerce/inc/admin/admin-product-attributes.php");
   require_once(AXIL_THEME_DIR . "/woocommerce/inc/admin/admin-product-categories.php");
   require_once(AXIL_THEME_DIR . "/woocommerce/inc/admin/admin-product-data.php");
   
   //require_once(AXIL_THEME_DIR . "/woocommerce/inc/widget-clear-all.php");
   require_once(AXIL_THEME_DIR . "/woocommerce/inc/woo-helper.php");
  //Helper::requires( 'woocommerce/admin/admin-product-details.php' );      
}


/**
 * Customizer
 */
require_once(AXIL_FREAMWORK_CUSTOMIZER . "color.php");

/**
 * Lab
 */
require_once(AXIL_FREAMWORK_LAB . "class-tgm-plugin-activation.php");
require_once(AXIL_FREAMWORK_DIRECTORY . "class-search-autocomplete.php");
// -- Nav Walker
require_once(AXIL_FREAMWORK_LAB . "aw-nav-menu-walker.php");
require_once(AXIL_FREAMWORK_LAB . "aw-mobile-menu-walker.php");
require_once(AXIL_FREAMWORK_TP . "title/breadcrumb.php");




function wp_get_menu_array($current_menu='Main Menu') {

    $menu_array = wp_get_nav_menu_items($current_menu);

    $menu = array();

    function populate_children($menu_array, $menu_item)
    {
        $children = array();
        if (!empty($menu_array)){
            foreach ($menu_array as $k=>$m) {
                if ($m->menu_item_parent == $menu_item->ID) {
                    $children[$m->ID] = array();
                    $children[$m->ID]['ID'] = $m->ID;
                    $children[$m->ID]['title'] = $m->title;
                    $children[$m->ID]['url'] = $m->url;
                    unset($menu_array[$k]);
                    $children[$m->ID]['children'] = populate_children($menu_array, $m);
                }
            }
        };
        return $children;
    }

    foreach ($menu_array as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = populate_children($menu_array, $m);
        }
    }

    return $menu;

}



// Check whether or not the current user-specified roles

function check_user_role($roles, $user_id = NULL) {

  if ($user_id) $user = get_userdata($user_id);
        else $user = wp_get_current_user();

     if (empty($user)) return false;
   
    foreach ($user->roles as $role) {
     
  if (in_array($role, $roles)) {
      return true;
    }
   }
    return false;
}

// Create a Redirection Function + WP Action
   function custom_registration_redirect() {

      if (check_user_role(array('customer'))) { // Add the User Role in the Array

       return wp_redirect( get_permalink( 'member-login' ) );
       // return site_url(''); //Add your redirect page slug here
    }
}

//add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);

function iconic_login_redirect( $redirect, $user ) {
$redirect_page_id = url_to_postid( $redirect );
$checkout_page_id = wc_get_page_id( 'checkout' );

if( $redirect_page_id == $checkout_page_id ) {
return $redirect;
}

return wc_get_page_permalink( 'member-login' );
}

//add_filter( 'woocommerce_login_redirect', 'iconic_login_redirect' );


add_filter( 'woocommerce_account_menu_items', 'hoge_woocommerce_account_menu_items', 10, 2 );
function hoge_woocommerce_account_menu_items( $items, $endpoints ){

    $items['orders'] = 'Recent Orders';
    $items['edit-address'] = 'Manage Addresses';
    unset( $items['payment-methods']);
    return $items;
}