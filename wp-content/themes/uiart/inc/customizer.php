<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.1
 */


/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
/**
 * wooc_custom_customize_register
 */

if (!function_exists('wooc_custom_customize_register')) {
    function wooc_custom_customize_register()
    {
        /**
         * Custom Separator
         */
        class wooc_Separator_Custom_control extends WP_Customize_Control
        {
            public $type = 'separator';

            public function render_content()
            {
                ?>
                <p>
                <hr></p>
                <?php
            }
        }
    }

    add_action('customize_register', 'wooc_custom_customize_register');
}

/**
 * Start wooc_Customize
 */
class wooc_Customize
{
    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     *
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See wooc_live_preview() for more.
     *
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since uiart 1.0
     */

    public static function register($wp_customize)
    {

        //1. Define a new section (if desired) to the Theme Customizer
        $wp_customize->add_panel('wooc_colors_options',
            array(
                'title' => esc_html__('Uiart Colors Options', 'uiart'), //Visible title of section
                'priority' => 35, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'description' => esc_html__('Allows you to customize some example settings for uiart.', 'uiart'), //Descriptive tooltip
            )
        );

        $wp_customize->add_section('wooc_colors_main_options',
            array(
                'title' => esc_html__('General', 'uiart'), //Visible title of section
                'priority' => 10, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'panel' => 'wooc_colors_options',
            )
        );


        // Body Color
        $wp_customize->add_setting('color_body', 
            array(
                 'default' => '#646464', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_body',
            array(
                'label' => esc_html__('Body Color', 'uiart'),
                'settings' => 'color_body', 
                'priority' => 10, 
                'section' => 'wooc_colors_main_options', 
            )
        ));
         $wp_customize->add_setting('color_heading', 
            array(
                'default' => '#0e283f', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_heading',
            array(
                'label' => esc_html__('Heading Color', 'uiart'),
                'settings' => 'color_heading', 
                'priority' => 10, 
                'section' => 'wooc_colors_main_options', 
            )
        ));


        /**
         * Separator
         */
        $wp_customize->add_setting('wooc_separator_heading_hover', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new wooc_Separator_Custom_control($wp_customize, 'wooc_separator_heading_hover', array(
            'settings' => 'wooc_separator_heading_hover',
            'section' => 'wooc_colors_main_options',
        )));
        // Heading Color

        /*************************
         * Primary
         ************************/
        
        $wp_customize->add_setting('color_primary', 
            array(
                'default' => '#fe7656', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_primary',
            array(
                'label' => esc_html__('Primary Color', 'uiart'),
                'settings' => 'color_primary', 
                'priority' => 10, 
                'section' => 'wooc_colors_main_options', 
            )
        ));


        $wp_customize->add_setting('color_secondary', 
            array(
                'default' => '#0e283f', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_secondary',
            array(
                'label' => esc_html__('Secondary Color', 'uiart'),
                'settings' => 'color_secondary', 
                'priority' => 11, 
                'section' => 'wooc_colors_main_options',
            )
        ));
        $wp_customize->add_setting('color_accent', 
            array(
                'default' => '#e9f1f8', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_accent',
            array(
                'label' => esc_html__('Accent Color', 'uiart'),
                'settings' => 'color_accent', 
                'priority' => 12, 
                'section' => 'wooc_colors_main_options',
            )
        ));
       
        $wp_customize->add_setting('color_light_primary', 
            array(
                'default' => '#fff5e8', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_light_primary',
            array(
                'label' => esc_html__('Light Primary Color', 'uiart'),
                'settings' => 'color_light_primary', 
                'priority' => 13, 
                'section' => 'wooc_colors_main_options', 
            )
        ));  

        $wp_customize->add_setting('color_meta', 
            array(
                'default' => '#989898', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_meta',
            array(
                'label' => esc_html__('Meta Color', 'uiart'),
                'settings' => 'color_meta', 
                'priority' => 14, 
                'section' => 'wooc_colors_main_options', 
            )
        ));    

        $wp_customize->add_setting('color_border', 
            array(
                'default' => '#f6f6f6', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control( 
            $wp_customize, 
            'wooc_color_border',
            array(
                'label' => esc_html__('Border Color', 'uiart'),
                'settings' => 'color_border', 
                'priority' => 14, 
                'section' => 'wooc_colors_main_options', 
            )
        ));
               
    }
    

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since uiart 1.0
     */
    public static function wooc_custom_color_output()
    {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
            
            /* Body */
            <?php self::generate_css('
            body,
             p,
             .additional-menu-area span.side-menu-trigger i,
             .single-product-bottom-3 .product-meta-area-wrp .product_meta-area .product-meta-group .product-meta-content.sku,
             .wooc-product-layout-1 .wooc-title a,
             .woocueproduct-isotope.woocue-layout-2 .woocue-navs-area .woocue-navs a,
             .wooc-product-info .wooc-subtitle,
             .wooc-product-info .wooc-btn-area .wooc-btn

             ', 'color ', 'color_body'); ?> 

           <?php self::generate_css('
                .wooc-product-banner .nav-item .item-bg:after,
                .newsletter-footer .wpcf7-submit,
                .header-main-block .main-navigation-area .main-navigation ul li.mega-menu>ul.sub-menu,
                .header-main-block .main-navigation-area .main-navigation ul li ul,
                .header-style-4 .left-icon-menu .vertical-icon-area ul.menu>li.current-menu-item>a,
                .header-style-4 .left-icon-menu .vertical-menu-area.vertical-icon-area .vertical-menu ul.menu li ul.sub-menu>li a:hover,
                .site .header-icon-right .wooc-button-grey-icon:hover,
                .site .header-icon-btn-block .wooc-button-grey-icon .cart-icon-num,
                .header-style-4 .newsletter-footer input[type="submit"],
                .header-style-4 .left-icon-menu .vertical-icon-area ul.menu>li>a:hover,
                .woocommerce .cart-icon-products .widget_shopping_cart .cart_list li a.remove,
                .cart-icon-products .woocommerce.widget_shopping_cart .cart_list li a.remove,
                .cart-icon-products .widget_shopping_cart .mini_cart_item a.remove

             ', 'background-color ', 'color_light_primary'); ?>


            /* primary background Color */
          
           <?php self::generate_css('
            .wooc-product-banner .woocue-price-popup.price4:after,
            .woocueproduct-isotope .woocue-viewall-2.btn-style-1 a,
            .cart-icon-products .widget_shopping_cart .woocommerce-mini-cart__buttons a,
            .wooc-product-layout-1 .wooc-buttons a,
            .footer-top.footer-top-layout .footer-social li a:hover,
            .pagination-area ul li:not(.pagi) a:hover, .pagination-area ul li:not(.pagi) span,
            .default-search-form .default-search-input button.btn-icon,
            .sidebar-widget-area .widget .widget-title:before,
            .sidebar-widget-area .widget .widget-title:after,
            .loop-post-wrp .read-more-btn:hover:before,
            .loop-post-wrp .read-more-btn:hover:after,
            .sidebar-widget-area .widget.widget_categories ul li a:hover,
            .sidebar-widget-area .widget.widget_archive ul li a:hover,
            .wp-block-button .wp-block-button__link,
            #respond .comment-reply-title:before,
            #respond .comment-reply-title:after,
            #respond form .btn-send,
            body a.scrollToTop,
            h4.woocue-sec-title span,
            .wooc-slick-slider .slick-prev:hover,
             .wooc-slick-slider .slick-next:hover,
             .wooc-product-banner .product-banner-left .banner-title span,
             .wooc-product-banner .product-banner-left .banner-title span,
             .wooc-product-banner .woocue-price-popup.price1:after,
             .wooc-product-layout-1 .wooc-buttons a.action-cart:hover,
             .header-style-4 .newsletter-footer input[type="submit"]:hover,
             .wooc-slider-title-block-1 .woocue-sec-title span,
             .site .owl-custom-nav .owl-nav button.owl-prev:hover,
             .site .owl-custom-nav .owl-nav button.owl-next:hover,
             .wooc-product-layout-3 .wooc-buttons a,
             .wooc-product-banner .woocue-price-popup.price1,
             .wooc-product-banner .slick-prev-banner:hover,
             .wooc-product-banner .slick-next-banner:hover,
             .additional-menu-area span.side-menu-trigger:hover,
             .additional-menu-area .sidenav .nav-addit-info .offcanvas_sub_title:before,
             .additional-menu-area .sidenav .nav-addit-info .offcanvas_sub_title:after,
             .additional-menu-area .sidenav .social-item ul.main-nav li a:hover,
             .woocue-info-box .woocue-price.price1,
             .woocue-info-box .woocue-price.price1:after,
             .wooc-slider-title-block-1 .woocue-sec-title span,
             .site .ls-theme1 .ls-nav-prev:hover,
             .site .ls-theme1 .ls-nav-next:hover,
             .wooc-title-block-1 .woocue-sec-title span,
             .wooc-product-layout-3 .wooc-buttons a.action-cart:hover,
             .post-content-area .post-tags a:hover,
             .sidebar-widget-area .widget.widget_tag_cloud a:hover,
             .sidebar-widget-area .widget.widget_product_tag_cloud a:hover,
             .banner3-wrp .banner3 .banner-content h1:after,
             .banner3-wrp .banner3 .banner-content h1:before,
             .site .wooc-button-pli,
             .wooctheme-loadmore-btn-area .wooctheme-loadmore-btn,
             .wooctheme-wc-reviews #respond input#submit,
             .woocommerce div.product .single-woocwc-wrapper .product-single-wc-wrp a:hover,
             .woocommerce div.product .single-add-to-cart-wrapper .product-single-wc-wrp a:hover,
             .wooc-nav.slick-vertical .slick-prev:hover,
             .wooc-nav.slick-vertical .slick-next:hover,
             .woocommerce div.product .single-woocwc-wrapper button.button.single_add_to_cart_button,
             .header-style-4 .banner3 .banner-content h1:before,
             .header-style-4 .banner3 .banner-content h1:after
             
            ',
            'background-color', 'color_primary'); 
            ?>  

            /* primary border Color */
            <?php self::generate_css('
                .pagination-area ul li:not(.pagi) a:hover, .pagination-area ul li:not(.pagi) span,
                .wp-block-button.is-style-outline .wp-block-button__link,
                .woocueproduct-isotope .woocue-viewall-2.btn-style-1 a,
                .wooc-product-layout-1 .wooc-buttons a,
                .footer-bottom .footer-bottom-wrp .footer-menu ul.menu li a:hover,                
                #respond form .btn-send,
                .wooc-slick-slider .slick-prev:hover, 
                .wooc-slick-slider .slick-next:hover,
                .wooc-product-layout-1 .wooc-buttons a.action-cart:hover,                
                .wooc-product-layout-3 .wooc-buttons a,
                .wooc-product-layout-3 .wooc-buttons a.action-cart:hover,
                .post-content-area .post-tags a:hover,
                .woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li.active a,
                .wooctheme-wc-reviews #respond input#submit,
                .woocommerce div.product .single-woocwc-wrapper .product-single-wc-wrp a:hover,
                .woocommerce div.product .single-add-to-cart-wrapper .product-single-wc-wrp a:hover,
                .site .wooc-product-layout-1 .wooc-buttons a.action-cart:hover   

                ', 'border-color', 'color_primary'); ?>

      
            /* Primary  Color*/

            <?php self::generate_css('a:active, a:focus, a:hover,
            .loop-post-wrp .post-title a:hover,
            .loop-post-wrp .post-meta li a:hover,
            .loop-post-wrp .post-author a:hover span,
            .loop-post-wrp .read-more-btn:hover,
            .sidebar-widget-area .widget a:hover,
            .pagination-area ul li.pagi a:hover, 
            .pagination-area ul li.pagi a:hover,
            .pagination-area ul li.pagi span:hover,
            .pagination-area ul li.pagi span:hover,
            .footer-logo-area .copyright-text a:hover,
            .wp-block-button.is-style-outline a.wp-block-button__link:not([href]):not([tabindex]),
            .single-post-pagination .woocue-item .woocue-content .woocue-title a:hover,
            .single-post-pagination .woocue-item .woocue-content a.woocue-link:hover,
            .header-main-block .main-navigation-area .main-navigation ul.menu>li:hover>a,
            .header-main-block .main-navigation-area .main-navigation ul.menu>li.current-menu-item>a,
            .header-main-block .main-navigation-area .main-navigation ul.menu>li.current-menu-parent>a,
            .header-main-block .main-navigation-area .main-navigation ul.menu>li.current>a,
            .wp-block-button.is-style-outline a.wp-block-button__link:not([href]):not([tabindex]):hover,
            .header-main-block .main-navigation-area .main-navigation ul li ul li:hover>a,
            .cart-icon-products .widget_shopping_cart .mini_cart_item a:hover,
            .wooc-product-info .wooc-btn-area .wooc-btn:hover,
            .wooc-countdown .wooc-countdown-wrp .wooc-countdown-price .wooc-sale-price,
            .header-main-block .main-navigation-area .main-navigation ul li.mega-menu>ul.sub-menu>li ul li a:hover,
            .woocueproduct-isotope.woocue-layout-2 .woocue-navs-area .woocue-navs a.current,
            .woocueproduct-isotope.woocue-layout-2 .woocue-navs-area .woocue-navs a:hover,
            .header-main-block .main-navigation-area .main-navigation ul>li:hover>a,
            .header-main-block .main-navigation-area .main-navigation ul>li.current-menu-item>a,
            .header-main-block .main-navigation-area .main-navigation ul>li.current_page_item>a,
            .header-main-block .main-navigation-area .main-navigation ul>li.current-menu-parent>a,
            .header-main-block .main-navigation-area .main-navigation ul>li.current>a,
            .wooc-product-layout-1 .wooc-title a:hover,
            .wooc-product-layout-3 .wooc-price,
            .wooc-product-layout-3 .wooc-title a:hover,
            .footer-bottom .footer-bottom-wrp .footer-menu ul.menu li a:hover,
            .additional-menu-area .sidenav .closebtn:hover,
             .additional-menu-area .sidenav .nav-item ul li a:hover,
             .wooc-product-grid .wooc-product-wrp .wooc-title a:hover,
             .wooc-product-grid .wooc-product-wrp .action-cart,
             .woocuepost-1 .woocue-item .woocue-content .woocue-title a:hover,
             .woocuepost-1 .woocue-item .woocue-content .woocue-author a:hover,
             .wooc-product-grid .wooc-product-wrp .action-cart i,
             .header-middlebar .btn-account .dropdown-menu .item-title > a,
             .header-middlebar .btn-account .dropdown-menu .dropdown-list a:hover,
             .additional-menu-area .sidenav ul li.menu-item-has-children:hover:after,
             .additional-menu-area .sidenav .closebtn:hover i,
             .sidebar-widget-area .widget.widget_wooctheme_recentposts_widget .footer-post-wrap .single-footer-post .post-content .title a:hover,
             .widget.widget_woocthemeabout_widget .wooc-links li a:hover,
             .wp-block-quote cite,
             .wp-block-quote cite a,
             .post-social .post-social-sharing a:hover,
             .banner3-wrp .banner3 .main-breadcrumb a span:hover,
             #respond .logged-in-as a:hover,
             .banner .main-breadcrumb a span:hover,
             .wooc-shop-categories li.current-cat a,
             .wooc-shop-categories li a:hover,
             .product-grid-view .view-mode ul li.grid-view-nav a,
             .product-list-view .view-mode ul li.list-view-nav a,            
             .single-product-bottom-3 .product-meta-area-wrp .product_meta-area .product-meta-term a:hover,
             .woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li.active a,
             .woocommerce div.product .single-product-top-3 .price,
             .woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li a:hover,
             .woocommerce div.product .single-product-area-2 .woocommerce-tabs ul.tabs li.active a,
             .woocommerce div.product .single-product-area-2 .woocommerce-tabs ul.tabs li a:hover,
             .single-woocwc-wrapper .product-social .product-social-items li a:hover,
             .woocommerce div.product .single-woocwc-wrapper button.button.single_add_to_cart_button,
            
             .woocommerce .quantity .input-group-btn .quantity-btn:hover,
             .woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li.active a,
             .header-style-4 .banner3 .main-breadcrumb a span:hover

            ',

             'color ', 'color_primary'); ?> 


            /* heading Color */
            <?php self::generate_css('h1, h2, h3, h4, h5, h6,
            .wooc-product-banner.layout-1 .product-banner-nav-img .media .ptitle,
            .wooc-product-banner.layout-2 .product-banner-nav-img .media .ptitle, 
            .wooc-product-banner.layout-3 .product-banner-nav-img .media .ptitle,
            .wooc-product-info .wooc-title,
            .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-title,
            .wooc-icon-wrp .wooc-title,
            .wooc-slider-title-block-1 .woocue-sec-title,            
            .newsletter-footer h4.woocue-sec-title,
            .wooc-title-block-1 .woocue-sec-title         

             ',

             'color ', 'color_heading'); ?>



            /* Secondary Color */
            <?php self::generate_css('
                .secondary-color,
                .footer-top.footer-top-layout .footer-social li a,
                .footer-bottom .footer-bottom-wrp .footer-menu ul.menu li a,
                .newsletter-footer .wpcf7-submit,
                .wooc-product-layout-1 .wooc-price,
                .woocue-info-box .woocue-subtitle,
                .site .header-icon-btn-block.cart-icon .wooc-button-grey-icon i:before,
                .site .header-icon-btn-block .wooc-button-grey-icon .cart-icon-num,
                .cart-icon-products .widget_shopping_cart .mini_cart_item a,
                .additional-menu-area .sidenav .nav-item ul li a,
                .additional-menu-area .sidenav .social-item ul.main-nav li a,
                .wooc-product-grid .wooc-product-wrp .wooc-title a,
                .wooc-product-grid .wooc-product-wrp .action-cart:hover,
                .woocuepost-1 .woocue-item .woocue-content .woocue-title a,
                .wooc-product-grid .wooc-product-wrp .woocue-price,
                .wooc-slider-title-block-1 .woocue-view-btn a,
                .cart-icon-products .widget_shopping_cart .woocommerce-mini-cart__total,
                .additional-menu-area .sidenav .nav-addit-info .offcanvas_sub_title,
                .wooc-title-block-1 .woocue-sec-title,
                .faq-sec-wrap .single-faq .faq-header button,
                .loop-post-wrp .post-title a,
                .sidebar-widget-area .widget.widget_wooctheme_recentposts_widget .footer-post-wrap .single-footer-post .post-content .title a,
                .pagination-area ul li.pagi a,
                .pagination-area ul li.pagi a,
                .pagination-area ul li.pagi span,
                .pagination-area ul li.pagi span,
                .sidebar-widget-area .widget a,
                blockquote,
                .wp-block-quote,   
                blockquote p,
                .wp-block-quote p,
                .post-social .post-social-sharing a,
                .post-content-area .post-tags a,
                .single-post-pagination .woocue-item .woocue-content .woocue-title a,
                .sidebar-widget-area .widget.widget_tag_cloud a,
                .sidebar-widget-area .widget.widget_product_tag_cloud a,
                .header-middlebar .btn-account .dropdown-menu .dropdown-list a,
                .wooc-product-banner.layout-1 .wooc-price .wooc-sale-price,
                .wooc-product-banner.layout-2 .wooc-price .wooc-sale-price,
                .wooc-product-banner.layout-3 .wooc-price .wooc-sale-price,
                .wooc-product-banner .woocue-price-popup.price4,               
                .wooc-product-layout-1 .wooc-price,
                .wooc-title-block-1 .woocue-sub-title,
                .single-product-bottom-3 .product-meta-area-wrp .product_meta-area .product-meta-avaibility,
                .woocommerce div.product .single-product-bottom-3 .woocommerce-tabs ul.tabs li a,
                .woocommerce div.product .single-woocwc-wrapper .product-single-wc-wrp a,
                .woocommerce div.product .single-add-to-cart-wrapper .product-single-wc-wrp a ,
                .single-product-layout-3 .product-social .product-social-items li a:hover,
                .single-product-bottom-3 .product-meta-area-wrp .product_meta-area .product-meta-group,
                .single-product-bottom-3 .product-meta-area-wrp .product_meta-area .product-meta-term ,
                .woocommerce div.product .single-product-area-2 .product_meta-area .product-meta-content,
                .woocommerce div.product .single-product-area-2 .product_meta-area .product-meta-content a,
                .header-middlebar .btn-account .dropdown-menu .item-title,
                .single-product-layout-3 .product-social .product-social-title                

                ',

             'color ', 'color_secondary'); ?>

            /* background Color */
            <?php self::generate_css('
                .newsletter-footer .wpcf7-submit:hover,
                .woocue-info-box .woocue-price.price2,
                .woocue-info-box .woocue-price.price2:after,
                .wooc-product-layout-3 .wooc-buttons a:hover,
                .wooc-product-layout-3 .wooc-buttons a.action-cart,
                .wooc-product-layout-3 .wooc-buttons a.added_to_cart,
                .site .wooctheme-border-button:hover,
             
                .loop-post-wrp .post-top-cats a:hover,
                #respond form .btn-send:hover,
                .sidebar-widget-area .widget.widget_categories ul li:hover .category-number-right,
                .site .wooc-button-pli:hover,
                .wooc-product-banner .woocue-price-popup.price2,
                .wooc-product-banner .woocue-price-popup.price2:after,
                .woocommerce span.onsale,
                .wooc-product-layout-1 .wooc-buttons a.action-cart,
                .wooc-product-layout-1 .wooc-buttons a.added_to_cart,
                .wooc-product-layout-1 .wooc-buttons a:hover,
                .wooctheme-loadmore-btn-area .wooctheme-loadmore-btn:hover,
                .wooctheme-wc-reviews #respond input#submit:hover,
                .wooc-for .slick-arrow:hover,
            
                .woocommerce div.product .single-woocwc-wrapper button.button.single_add_to_cart_button:hover,
               
                .woocueproduct-isotope .woocue-viewall-2.btn-style-1 a:hover

                ',

             'background-color ', 'color_secondary'); ?> 

            /* border Color */
            <?php self::generate_css('
                .wooc-product-layout-3 .wooc-buttons a:hover,
                .wooc-product-layout-3 .wooc-buttons a.action-cart,
                .wooc-product-layout-3 .wooc-buttons a.added_to_cart,
                .site .wooctheme-border-button:hover,
              
                #respond form .btn-send:hover,
                .wooc-product-layout-1 .wooc-buttons a:hover,
                .wooc-product-layout-1 .wooc-buttons a.action-cart:hover ,
                .woocueproduct-isotope .woocue-viewall-2.btn-style-1 a:hover                                   

                ',

             'border-color ', 'color_secondary'); ?>

        </style>
        <!--/ Customizer CSS-->
        <?php

       
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since uiart 1.0
     */
    public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true)
    {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if (!empty($mod)) {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix . $mod . $postfix
            );
            if ($echo) {
                echo wooccapeing($return);
            }
        }
        return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('wooc_Customize', 'register'));

// Output custom CSS to live site
add_action('wp_head', array('wooc_Customize', 'wooc_custom_color_output'));


