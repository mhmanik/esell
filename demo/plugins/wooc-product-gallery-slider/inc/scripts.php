<?php
class WoocScripts
{

    protected static $instance = null;

    public function __construct()
    {

        add_action('wp_enqueue_scripts', array($this, 'wooc_assets'), 20);


    }

    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    public function wooc_assets()
    {


        wp_enqueue_script('slick-js', WOOCTHEME_WTPGS_URL . 'assets/js/slick.min.js', array('jquery'), '2.0', true);
        wp_enqueue_script('venobox-js', WOOCTHEME_WTPGS_URL . 'assets/js/venobox.min.js', array('jquery'), '2.0', true);

        wp_register_script('woocjs', WOOCTHEME_WTPGS_URL . 'assets/js/wooc.js', array(), '2.0', true);
        $woocJquery = array(

            'wLightboxframewidth' => wooc_get_option('Lightboxframewidth', 'wooc_settings', '600'),
            'wcaption' => wooc_get_option('caption', 'wooc_settings', 'true'),

        );
        wp_localize_script('woocjs', 'wooc_var', $woocJquery);

        // Enqueued script with localized data.
        wp_enqueue_script('woocjs');

        $warrows = wooc_get_option('navIcon', 'wooc_settings', 'true');
        $wautoPlay = wooc_get_option('autoPlay', 'wooc_settings', 'false');
        $wslider_thubms = wooc_get_option('thubms', 'wooc_settings', '4');

        $warvertical = wooc_get_option('navVertical', 'wooc_settings', 'false');

        $wooc_sliderJs = "(function( $ ) {
    'use strict';
jQuery(document).ready(function(){

    jQuery('.wooc-for').slick({
        fade: false,
        asNavFor: '.wooc-nav',
        lazyLoad:'disable',
        adaptiveHeight: true,
        dots: false,
        dotsClass:'slick-dots wooc-dots',
        focusOnSelect:false,
        rtl: false,
        infinite: false,
        draggable: false,
        arrows: {$warrows},
        prevArrow:'<span class=\"slick-prev slick-arrow\" aria-label=\"prev\"  ><i class=\"icofont-long-arrow-left\"></i></span>',
        nextArrow:'<span class=\"slick-next slick-arrow\" aria-label=\"Next\" ><i class=\"icofont-long-arrow-right\"></i></span>',
        speed: 500,
        autoplay: {$wautoPlay},
        pauseOnHover: true,
        pauseOnDotsHover: true,
        autoplaySpeed: 5000,
    });

    jQuery('.wooc-nav').slick({
        slidesToShow: {$wslider_thubms},
        slidesToScroll: 1,
        vertical: {$warvertical},
        verticalSwiping: true,
        rtl:false,
        arrows: {$warrows},
        prevArrow:'<span class=\"slick-prev slick-arrow\" aria-label=\"prev\"  ><i class=\"icofont-caret-up\"></i></span>',
        nextArrow:'<span class=\"slick-next slick-arrow\" aria-label=\"Next\" ><i class=\"icofont-caret-down\"></i></span>',
        speed:600,
        infinite: false,
        centerMode: false,
        focusOnSelect: true,
        asNavFor: '.wooc-for',
        responsive: [

            {
                breakpoint: 1025,
                settings: {
                    variableWidth: false,
                    vertical: false,
                    verticalSwiping: false,
                    rtl: false,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    swipeToSlide :true,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    variableWidth: false,
                    vertical: false,
                    verticalSwiping: false,
                    rtl: false,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    swipeToSlide :true,
                }
            }
        ]

    });

})})(jQuery);";

        wp_add_inline_script('woocjs', $wooc_sliderJs);
        wp_enqueue_style('slick-style', WOOCTHEME_WTPGS_URL . 'assets/css/slick.css', null, '2.0');
        wp_enqueue_style('slick-theme', WOOCTHEME_WTPGS_URL . 'assets/css/slick-theme.css', null, '2.0');
        wp_enqueue_style('venobox-style', WOOCTHEME_WTPGS_URL . 'assets/css/venobox.css', null, '2.0');
        wp_enqueue_style('wtpgs-style', WOOCTHEME_WTPGS_URL . 'assets/css/wtpgs.css', null, '2.0');

        $color = wooc_get_option('navColor', 'wooc_settings', '#222');
        $custom_css = "
                .wooc-for .slick-arrow,.wooc-nav .slick-prev::before, .wooc-nav .slick-next::before{
                        color: {$color};                
                }";
        wp_add_inline_style('wtpgs-style', $custom_css);


        wp_enqueue_style('wtpgs-icofont', WOOCTHEME_WTPGS_URL . 'assets/css/icofont.css', null, '2.0');
    }


}

WoocScripts::instance();