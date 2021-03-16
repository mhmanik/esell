<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package esell
 */

/**
 * Enqueue scripts and styles.
 */

if (!function_exists('esell_register_scripts')){

   function esell_register_scripts() {
        wp_register_style('owl-carousel', AXIL_CSS_URL . 'owl.carousel.min.css', array(), AXIL_VERSION);
        wp_register_style('owl-carousel-default', AXIL_CSS_URL . 'owl.theme.default.min.css', array(), AXIL_VERSION);        
        wp_register_script('owl-carousel', AXIL_JS_URL . 'owl.carousel.min.js', array('jquery'), AXIL_VERSION, true);

    }
}

add_action( 'wp_enqueue_scripts', 'esell_register_scripts', 25);    


if (!function_exists('esell_scripts')){

    function esell_scripts() {

        wp_deregister_style('font-awesome');

        // Fonts
        wp_enqueue_style('axil-fonts',axil_fonts_url());

        // Style
        wp_enqueue_style('bootstrap', AXIL_CSS_URL . 'vendor/bootstrap.min.css', array(), AXIL_VERSION);
        wp_enqueue_style('slick', AXIL_CSS_URL . 'vendor/slick.css', array(), AXIL_VERSION);
        wp_enqueue_style('slick-theme', AXIL_CSS_URL . 'vendor/slick-theme.css', array(), AXIL_VERSION);
        wp_enqueue_style('font-awesome', AXIL_CSS_URL . 'vendor/font-awesome.css', array(), AXIL_VERSION);
        wp_enqueue_style('axil-style', AXIL_CSS_URL . 'style.css', array(), AXIL_VERSION);
        wp_enqueue_style('axil-woocommerce', AXIL_CSS_URL . 'woocommerce.css', array(), AXIL_VERSION);
        wp_enqueue_style( 'esell-style', get_stylesheet_uri() );

       
        // Scripts
        wp_enqueue_script('modernizr', AXIL_JS_URL . 'vendor/modernizr.min.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('popper', AXIL_JS_URL . 'vendor/popper.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('bootstrap', AXIL_JS_URL . 'vendor/bootstrap.min.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('slick', AXIL_JS_URL . 'vendor/slick.min.js', array('jquery'), AXIL_VERSION, false);
        wp_enqueue_script('tweenmax', AXIL_JS_URL . 'vendor/tweenmax.min.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('gsap', AXIL_JS_URL . 'vendor/gsap.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('axil-copylink', AXIL_JS_URL . 'vendor/commands.js', array('jquery'), AXIL_VERSION, true);
        wp_enqueue_script('axil-cookie', AXIL_JS_URL . 'vendor/js.cookie.js', array('jquery'), AXIL_VERSION, true);
      

        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-carousel-default' );
        wp_enqueue_script( 'owl-carousel' );

        wp_enqueue_script('axil-main', AXIL_JS_URL . 'main.js', array('jquery'), AXIL_VERSION, true);
       
        wp_enqueue_script('jquery-style-switcher', AXIL_JS_URL . 'vendor/jquery.style.switcher.js', array('jquery'), AXIL_VERSION, true);


        wp_enqueue_script( 'esell-navigation', AXIL_ADMIN_JS_URL . 'navigation.js', array(), AXIL_VERSION, true );
        wp_enqueue_script( 'esell-skip-link-focus-fix', AXIL_ADMIN_JS_URL . 'skip-link-focus-fix.js', array(), AXIL_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

       // axil_elementor_scripts();
        localized_scripts();
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
}

add_action( 'wp_enqueue_scripts', 'esell_scripts', 20);  


 function axil_elementor_scripts() {  
    if ( !did_action( 'elementor/loaded' ) ) {
        return;
    }   
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                // Style
                wp_enqueue_style( 'owl-carousel' );
                wp_enqueue_style( 'owl-carousel-default' );
                wp_enqueue_style( 'bootstrap' );
                                          
                // Script
                wp_enqueue_script( 'owl-carousel' );
                wp_enqueue_script( 'bootstrap' );   
                
        } 
    }

 function localized_scripts()
    {
        $axil_options           = Helper::axil_get_options(); 
        $localize_data = array(
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'hasAdminBar'       => is_admin_bar_showing() ? 1 : 0,   
            'day'               => esc_html__('Day', 'esell'),
            'hour'              => esc_html__('Hour', 'esell'),
            'minute'            => esc_html__('Minute', 'esell'),
            'second'            => esc_html__('Second', 'esell'),
            'rtl'               => is_rtl() ? 'yes' : 'no', //@rtl
            'product_filter'    => $axil_options['wooc_wc_product_filter_type']
        );
        wp_localize_script('axil-main', 'EsellObj', $localize_data);
        
    }

/**
 * Axil admin script
 */
if( !function_exists('esell_media_scripts') ) {
    function esell_media_scripts() {

        wp_enqueue_style('esell-wp-admin', AXIL_ADMIN_CSS_URL . 'admin-style.css', array(), AXIL_VERSION);
        if (is_rtl()){
            wp_enqueue_style('esell-rtl-admin', AXIL_ADMIN_CSS_URL . 'rtl-admin.css', array(), AXIL_VERSION);
        }

        // JS
        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script( 'axil-logo-uploader', AXIL_ADMIN_JS_URL .'logo-uploader.js', false, '', true );
    }
}
add_action('admin_enqueue_scripts', 'esell_media_scripts', 1000);