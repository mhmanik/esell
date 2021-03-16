<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.1.1
 */

namespace wooctheme\Uiart;

use Elementor\Plugin;

class Scripts
{

    use Script_Trait;

    public $version;
    protected static $instance = null;

    public function __construct()
    {
        $this->version = Constants::$theme_version;

        add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 12);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 15);
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'), 15);

    }

    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function register_scripts()
    {
        /* Deregister */
        wp_deregister_style('font-awesome');
        wp_deregister_style('layerslider-font-awesome');
        wp_deregister_style('yith-wcwl-font-awesome');

        /* Slick */
        wp_register_style('slick', Helper::get_vendor_assets('slick/slick.css'), array(), $this->version);
        wp_register_style('slick-theme', Helper::get_vendor_assets('slick/slick-theme.css'), array(), $this->version);
        wp_register_script('slick', Helper::get_vendor_assets('slick/slick.min.js'), array('jquery'), $this->version, true);

        wp_register_script('jquery-nice-select', Helper::get_js('jquery.nice-select.min'), array('jquery'), $this->version, true);
        wp_register_style('nice-select', Helper::get_css('nice-select'), array(), $this->version);

        // Owl carousel
        wp_register_style('owl-carousel', Helper::get_css('owl.carousel.min'), array(), $this->version);
        wp_register_style('owl-theme-default', Helper::get_css('owl.theme.default.min'), array(), $this->version);
        wp_register_style('simplebar', Helper::get_css('simplebar'), array(), $this->version);

        // Google fonts
        wp_register_style('uiart-gfonts', $this->fonts_url(), array(), $this->version);

        // Font-awesome
        wp_register_style('theme-font-awesome', Helper::get_css('all'), array(), $this->version);

        // Bootstrap
        wp_register_style('bootstrap', Helper::maybe_rtl('bootstrap.min'), array(), $this->version);

        // Magnific popup
        wp_register_style('magnific-popup', Helper::get_css('magnific-popup.min'), array(), $this->version);

        // Main Theme Style
        wp_register_style('uiart-style', Helper::maybe_rtl('style'), array(), $this->version);
        // WooCommerce Style
        wp_register_style('uiart-wc', Helper::maybe_rtl('woocommerce'), array(), $this->version);
        // Elementor
        wp_register_style('uiart-elementor', Helper::maybe_rtl('elementor'), array(), $this->version);

        // Owl Carousel
        wp_register_script('owl-carousel', Helper::get_js('owl.carousel.min'), array('jquery'), $this->version, true);

        // bootstrap js
        wp_register_script('bootstrap', Helper::get_js('bootstrap.bundle.min'), array('jquery'), $this->version, true);
        wp_register_script('simplebar', Helper::get_js('simplebar.min'), array('jquery'), $this->version, true);

        // Meanmenu js
        wp_register_script('jquery-meanmenu', Helper::get_js('jquery.meanmenu.min'), array('jquery'), $this->version, true);

        // Isotope
        wp_register_script('images-loaded', Helper::get_js('imagesloaded.pkgd.min'), array('jquery'), $this->version, true);
        wp_register_script('isotope', Helper::get_js('isotope.pkgd.min'), array('jquery'), $this->version, true);

        // Countdown
        wp_register_script('jquery-countdown', Helper::get_js('jquery.countdown.min'), array('jquery'), $this->version, true);

        // Magnific Popup
        wp_register_script('jquery-magnific-popup', Helper::get_js('jquery.magnific-popup.min'), array('jquery'), $this->version, true);

        // Ripples
        wp_register_script('jquery-ripples', Helper::get_js('jquery.ripples.min'), array('jquery'), $this->version, true);

        // Sticky Sidebar
        wp_register_script('jquery-sticky-sidebar', Helper::get_js('jquery.sticky-sidebar.min'), array('jquery'), $this->version, true);

        // Main js
        wp_register_script('uiart-main', Helper::get_js('main'), array('jquery'), $this->version, true);
        wp_register_script('uiart-filter', Helper::get_js('filter'), array('jquery'), $this->version, true);

    }

    public function enqueue_scripts()
    {
        /*CSS*/
        wp_enqueue_style('uiart-gfonts');
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('simplebar');
        wp_enqueue_style('theme-font-awesome');
        wp_enqueue_style('slick');
        wp_enqueue_style('slick-theme');
        wp_enqueue_style('nice-select');
        $this->elementor_scripts();
        $this->conditional_scripts();
        wp_enqueue_style('uiart-style');
        wp_enqueue_style('uiart-wc');
        wp_enqueue_style('uiart-elementor');
        $this->dynamic_style();// Dynamic style
        /*JS*/
        wp_enqueue_script('bootstrap');
        wp_enqueue_script('simplebar');
        wp_enqueue_script('jquery-meanmenu');
        wp_enqueue_script('slick');
        wp_enqueue_script('jquery-nice-select');
        wp_enqueue_script('jquery-ui-autocomplete');
        wp_enqueue_script('uiart-main');
        wp_enqueue_script('uiart-filter');
        $this->localized_scripts(); // Localization
    }

    public function elementor_scripts()
    {
        if (!did_action('elementor/loaded')) {
            return;
        }
        if (Plugin::$instance->preview->is_preview_mode()) {
            wp_enqueue_style('nice-select');
            wp_enqueue_style('owl-carousel');
            wp_enqueue_style('owl-theme-default');
            wp_enqueue_script('owl-carousel');
            wp_enqueue_script('jquery-sticky');
            wp_enqueue_script('images-loaded');
            wp_enqueue_script('isotope');
            wp_enqueue_script('jquery-countdown');
            wp_enqueue_script('jquery-magnific-popup');
            wp_enqueue_script('jquery-ripples');
            wp_enqueue_script('slick');
            wp_enqueue_script('jquery-nice-select');
            wp_enqueue_style('simplebar');
            wp_enqueue_script('simplebar');
        }
    }

    public function admin_scripts()
    {
        wp_enqueue_style('uiart-admin', Helper::get_css('admin'), array(), $this->version);
    }

    private function fonts_url()
    {
        $fonts_url = '';
        if ('off' !== _x('on', 'Google fonts - Roboto and Poppins Sans : on or off', 'uiart')) {
            $fonts_url = add_query_arg('family', urlencode('Roboto:400,500,700|Josefin+Sans:400,500,600,700&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
        }
        return $fonts_url;
    }

    private function localized_scripts()
    {
        $logo = empty(WOOCTheme::$options['mobile_logo_small']['url']) ? Helper::get_img('logo-dark-small.png') : WOOCTheme::$options['mobile_logo_small']['url'];
        $appendHtml = Helper::get_template_content('template-parts/header/header-top-mobile');

        $localize_data = array(
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'hasAdminBar'       => is_admin_bar_showing() ? 1 : 0,
            'hasStickyMenu'     => WOOCTheme::$options['sticky_menu'] ? 1 : 0,
            'meanWidth'         => WOOCTheme::$options['resmenu_width'],
            'siteLogo'          => '<div class="mean-logo-area"><a href="' . esc_url(home_url('/')) . '" alt="' . esc_attr(get_bloginfo('title')) . '"><img class="logo-small" src="' . esc_url($logo) . '" /></a></div>',
            'appendHtml'        => $appendHtml,
            'rtl'               => is_rtl(),
            'day'               => esc_html__('Day', 'uiart'),
            'hour'              => esc_html__('Hour', 'uiart'),
            'minute'            => esc_html__('Minute', 'uiart'),
            'second'            => esc_html__('Second', 'uiart'),
            'rtl'               => is_rtl() ? 'yes' : 'no', //@rtl
            'product_filter'    => WOOCTheme::$options['wooc_wc_product_filter_type']
        );
        wp_localize_script('uiart-main', 'UiartObj', $localize_data);
        
        // RTL
        if (is_rtl()) {
            wp_enqueue_style('uiart-rtl', Helper::get_css('rtl'), array(), $this->version);
        }
    }

    private function conditional_scripts()
    {
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        if (is_singular('product') && WOOCTheme::$options['product_wc_single_layout'] == '2') {
            wp_enqueue_script('jquery-sticky-sidebar');
        }
    }

    private function template_style()
    {
        $css = '';

        $logo_height = WOOCTheme::$options['logo_height'] . 'px';

        $css .= ".header-main-block a.logo img{max-height:{$logo_height}}";

        if (WOOCTheme::$bgtype == 'bgcolor') {
            $bgcolor = WOOCTheme::$bgcolor;
            $banner_style = "background-color:{$bgcolor};";
        } else {
            $bgimg = WOOCTheme::$bgimg;
            $banner_style = "background:url({$bgimg}) no-repeat scroll center center / cover;";
        }

        $css .= ".banner{{$banner_style}}";

        if (WOOCTheme::$bgtype == 'bgimg') {
            $opacity = WOOCTheme::$options['bgopacity'] / 100;
            $css .= ".header-bgimg .banner:before{background-color:rgba(0,0,0,{$opacity});}";
        }
        return $css;
    }

    private function dynamic_style()
    {
        $dynamic_css = $this->template_style();
        ob_start();
        Helper::requires('common.php');
        $dynamic_css .= ob_get_clean();
        $dynamic_css = $this->output_css($dynamic_css);
        wp_register_style('uiart-dynamic', false);
        wp_enqueue_style('uiart-dynamic');
        wp_add_inline_style('uiart-dynamic', $dynamic_css);
    }
}

Scripts::instance();