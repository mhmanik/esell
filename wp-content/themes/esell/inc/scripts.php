<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.1.1
 */

use Elementor\Plugin;

class Scripts
{
 
    public $version;
    protected static $instance = null;

    public function __construct()
    {
        

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
        wp_register_style('slick', Helper::get_vendor_css('slick'), array(), AXIL_VERSION);
        wp_register_style('slick-theme', Helper::get_vendor_css('slick-theme'), array(), AXIL_VERSION);
        wp_register_style('bootstrap', Helper::maybe_vendors_rtl('bootstrap.min'), array(), AXIL_VERSION);
        
         // Owl carousel
        wp_register_style('owl-carousel', Helper::get_vendor_css('owl.carousel.min'), array(), AXIL_VERSION);
        wp_register_style('owl-theme-default', Helper::get_vendor_css('owl.theme.default.min'), array(), AXIL_VERSION);
        wp_register_style('simplebar', Helper::get_vendor_css('simplebar'), array(), AXIL_VERSION);
        wp_register_style('axil-style', Helper::get_css('style'), array(), AXIL_VERSION);
        wp_register_style('axil-woocommerce', Helper::get_css('woocommerce'), array(), AXIL_VERSION);
                
        // Google fonts
        wp_register_style('esell-gfonts', $this->fonts_url(), array(), AXIL_VERSION);
        // Font-awesome
        wp_register_style('theme-font-awesome', Helper::get_vendor_css('font-awesome'), array(), AXIL_VERSION);
        wp_register_script('owl-carousel', Helper::get_vendor_js('owl.carousel.min'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('slick', Helper::get_vendor_js('slick.min'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('modernizr', Helper::get_vendor_js('modernizr.min'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('popper', Helper::get_vendor_js('popper'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('bootstrap', Helper::get_vendor_js('bootstrap.min'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('tweenmax', Helper::get_vendor_js('tweenmax.min'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('gsap', Helper::get_vendor_js('gsap'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('axil-copylink', Helper::get_vendor_js('commands'), array('jquery'), AXIL_VERSION, true);  
       

       wp_register_script('jquery-nice-select', Helper::get_vendor_js('jquery.nice-select.min'), array('jquery'), AXIL_VERSION, true);
       wp_register_style('nice-select', Helper::get_vendor_css('nice-select'), array(), AXIL_VERSION);


        wp_register_script('axil-cookie', Helper::get_vendor_js('js.cookie'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('axil-main', Helper::get_js('main'), array('jquery'), AXIL_VERSION, true);
        wp_register_script('jquery-style-switcher', Helper::get_vendor_js('jquery.style.switcher'), array('jquery'), AXIL_VERSION, true);           
        wp_register_script('esell-navigation', Helper::get_js('navigation'), array('jquery'), AXIL_VERSION, true);           
        wp_register_script('esell-skip-link-focus-fix', Helper::get_js('skip-link-focus-fix'), array('jquery'), AXIL_VERSION, true);           

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        wp_register_script('axil-has-elementor', Helper::get_js('has-elementor'), array('jquery'), AXIL_VERSION, true);

         
        // For Post Like
       /* if( is_single() ) {
            wp_enqueue_style('like-it', AXIL_CSS_URL . 'vendor/like-it.css', array(), AXIL_VERSION);
            wp_enqueue_script('like-it', AXIL_JS_URL . 'vendor/like-it.js', array('jquery'), AXIL_VERSION, true);
            wp_localize_script( 'like-it', 'likeit', array(
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ));
        }
        */

    }

    public function enqueue_scripts()
    {

        /*CSS*/
        wp_enqueue_style('esell-gfonts');
        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('owl-theme-default');
        wp_enqueue_style('bootstrap');        
        wp_enqueue_style('slick');
        wp_enqueue_style('slick-theme');
       // wp_enqueue_style('nice-select');
       // wp_enqueue_style('simplebar');
        wp_enqueue_style('axil-style');
        wp_enqueue_style('axil-woocommerce');
        wp_enqueue_style('theme-font-awesome');
        $this->fonts_url();

        $this->elementor_scripts();       
        wp_enqueue_style( 'esell-style', get_stylesheet_uri() );        
        wp_enqueue_style('esell-wc');
        wp_enqueue_style('esell-elementor');        
        /*JS*/
        
        wp_enqueue_script('owl-carousel');
        wp_enqueue_script('bootstrap');
       // wp_enqueue_script('simplebar');
        wp_enqueue_script('jquery-meanmenu');
        wp_enqueue_script('slick');
        wp_enqueue_script('tweenmax');
        //wp_enqueue_script('jquery-nice-select');
        wp_enqueue_script('jquery-style-switcher');
        wp_enqueue_script('jquery-ui-autocomplete');
        wp_enqueue_script('axil-main');
        wp_enqueue_script('axil-has-elementor');
       
        $this->localized_scripts(); // Localization
    }

    public function elementor_scripts()
    {
        if (!did_action('elementor/loaded')) {
            return;
        }
        if (Plugin::$instance->preview->is_preview_mode()) {
          
            wp_enqueue_style('owl-carousel');
            wp_enqueue_style('owl-theme-default');
            
            wp_enqueue_script('owl-carousel');  

            wp_enqueue_script('images-loaded');        
            wp_enqueue_script('slick');    
            wp_enqueue_script('tweenmax');        
            
        }
    }


    public function admin_scripts()
    {

        wp_enqueue_style('esell-admin', Helper::get_admin_css('admin'), array(), AXIL_VERSION);
        wp_enqueue_style('esell-wp-admin', Helper::get_admin_css('admin-style'), array(), AXIL_VERSION);
        
        if (is_rtl()){
            wp_enqueue_style('esell-rtl-admin', Helper::get_admin_css('admin-style'), array(), AXIL_VERSION);           
        }

        // JS
        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-tabs' );
       // wp_enqueue_script('axil-logo-uploader', Helper::get_admin_js('logo-uploader'), array(), AXIL_VERSION); 
     
    }

    private function fonts_url()
    {
       $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Nunito+Sans Sans, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_attr_x( 'on', 'Red Hat Display font: on or off', 'esell' ) ) {
            $fonts[] = 'Red Hat Display:0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw($fonts_url);
    }

    private function localized_scripts()
    {
       
      
        $localize_data = array(
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'hasAdminBar'       => is_admin_bar_showing() ? 1 : 0,
             
            'rtl'               => is_rtl(),
            'day'               => esc_html__('Day', 'esell'),
            'hour'              => esc_html__('Hour', 'esell'),
            'minute'            => esc_html__('Minute', 'esell'),
            'second'            => esc_html__('Second', 'esell'),
            'rtl'               => is_rtl() ? 'yes' : 'no', //@rtl
            //'product_filter'    => $axil_options['wooc_wc_product_filter_type']
        );
        wp_localize_script('axil-has-elementor', 'EsellObj', $localize_data);
    }

    private function conditional_scripts()
    {
         $axil_options           = Helper::axil_get_options();
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        if (is_singular('product') && $axil_options['product_wc_single_layout'] == '2') {
            wp_enqueue_script('jquery-sticky-sidebar');
        }
    }

}

Scripts::instance();