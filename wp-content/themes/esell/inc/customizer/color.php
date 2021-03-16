<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since axil 1.0
 */
/**
 * axil_custom_customize_register
 */
if (!function_exists('axil_custom_customize_register')) {
    function axil_custom_customize_register()
    {
        /**
         * Custom Separator
         */
        class eSell_Separator_Custom_control extends WP_Customize_Control
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

    add_action('customize_register', 'axil_custom_customize_register');
}

/**
 * Start axil_Customize
 */
class axil_Customize
{
    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     *
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See axil_live_preview() for more.
     *
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since axil 1.0
     */
    public static function register($wp_customize)
    {

        //1. Define a new section (if desired) to the Theme Customizer
        $wp_customize->add_panel('axil_colors_options',
            array(
                'title' => esc_html__('eSell Colors Options', 'esell'), //Visible title of section
                'priority' => 35, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'description' => esc_html__('Allows you to customize some example settings for axil.', 'esell'), //Descriptive tooltip
            )
        );

        $wp_customize->add_section('axil_colors_main_options',
            array(
                'title' => esc_html__('General', 'esell'), //Visible title of section
                'priority' => 10, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'panel' => 'axil_colors_options',
            )
        );

        /*************************
         * Primary
         ************************/
        $wp_customize->add_setting('color_primary',
            array(
                'default' => '#3858F6',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_primary',
            array(
                'label' => esc_html__('Primary Color', 'esell'),
                'settings' => 'color_primary',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /*************************
         * Secondary
         ************************/
        $wp_customize->add_setting('color_secondary',
            array(
                'default' => '#D93E40',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_secondary',
            array(
                'label' => esc_html__('Secondary Color', 'esell'),
                'settings' => 'color_secondary',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /*************************
         * Secondary Alt
         ************************/
        $wp_customize->add_setting('color_secondary_alt',
            array(
                'default' => '#F1352A',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_secondary_alt',
            array(
                'label' => esc_html__('Secondary Alt Color', 'esell'),
                'settings' => 'color_secondary_alt',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /*************************
         * Tertiary
         ************************/
        $wp_customize->add_setting('color_tertiary',
            array(
                'default' => '#050505',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_tertiary',
            array(
                'label' => esc_html__('Tertiary Color', 'esell'),
                'settings' => 'color_tertiary',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /**
         * Separator
         */
        $wp_customize->add_setting('axil_separator_heading_hover', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new eSell_Separator_Custom_control($wp_customize, 'axil_separator_heading_hover', array(
            'settings' => 'axil_separator_heading_hover',
            'section' => 'axil_colors_main_options',
        )));
        // Heading Color
        $wp_customize->add_setting('color_heading',
            array(
                // 'default' => '#000248',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_heading',
            array(
                'label' => esc_html__('Heading Color', 'esell'),
                'settings' => 'color_heading',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /**
         * Separator
         */
        $wp_customize->add_setting('axil_separator_body_color', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new eSell_Separator_Custom_control($wp_customize, 'axil_separator_body_color', array(
            'settings' => 'axil_separator_body_color',
            'section' => 'axil_colors_main_options',
        )));

        // Body Color
        $wp_customize->add_setting('color_body',
            array(
                // 'default' => '#494e51',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_body',
            array(
                'label' => esc_html__('Body Color', 'esell'),
                'settings' => 'color_body',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));




        /**
         * Separator
         */
        $wp_customize->add_setting('axil_separator_meta_color2', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new eSell_Separator_Custom_control($wp_customize, 'axil_separator_meta_color2', array(
            'settings' => 'axil_separator_meta_color2',
            'section' => 'axil_colors_main_options',
        )));

        // Meta Color
        $wp_customize->add_setting('color_meta',
            array(
                // 'default' => '#7b7b7b',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_meta',
            array(
                'label' => esc_html__('Meta Text Color', 'esell'),
                'settings' => 'color_meta',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));
        // Meta Color
        $wp_customize->add_setting('link_color_meta',
            array(
                // 'default' => '#7b7b7b',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_link_color_meta',
            array(
                'label' => esc_html__('Meta Link Color', 'esell'),
                'settings' => 'link_color_meta',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));
        // Meta hover Color
        $wp_customize->add_setting('color_meta_hover',
            array(
                // 'default' => '#3858F6',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_meta_hover',
            array(
                'label' => esc_html__('Meta Link Hover Color', 'esell'),
                'settings' => 'color_meta_hover',
                'priority' => 10,
                'section' => 'axil_colors_main_options',
            )
        ));

        /*************************
         * Header Color
         ************************/

        $wp_customize->add_section('axil_colors_header_options',
            array(
                'title' => esc_html__('Header', 'esell'), //Visible title of section
                'priority' => 10, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'panel' => 'axil_colors_options',
            )
        );
        // Link Color
        $wp_customize->add_setting('color_header_link_color',
            array(
                // 'default' => '#121213',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_link_color',
            array(
                'label' => esc_html__('Navigation Link Color', 'esell'),
                'settings' => 'color_header_link_color',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));
        // Link Hover Color
        $wp_customize->add_setting('color_header_link_hover_color',
            array(
                // 'default' => '#3858F6',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_link_hover_color',
            array(
                'label' => esc_html__('Navigation Link Hover + Active Color', 'esell'),
                'settings' => 'color_header_link_hover_color',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));
        // BG Color
        $wp_customize->add_setting('color_header_bg',
            array(
                // 'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_bg',
            array(
                'label' => esc_html__('Navigation Background Color', 'esell'),
                'settings' => 'color_header_bg',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));
        // Border Color
        $wp_customize->add_setting('color_header_border_color',
            array(
                // 'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_border_color',
            array(
                'label' => esc_html__('Navigation Border Color', 'esell'),
                'settings' => 'color_header_border_color',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));

        /**
         * Separator
         */
        $wp_customize->add_setting('axil_separator_header_top_separetor', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new eSell_Separator_Custom_control($wp_customize, 'axil_separator_header_top_separetor', array(
            'settings' => 'axil_separator_header_top_separetor',
            'section' => 'axil_colors_header_options',
        )));

        // Link Color
        $wp_customize->add_setting('color_header_top_link_color',
            array(
                // 'default' => '#121213',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_top_link_color',
            array(
                'label' => esc_html__('Header Top: Link Color', 'esell'),
                'settings' => 'color_header_top_link_color',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));
        // Link Hover Color
        $wp_customize->add_setting('color_header_top_link_hover_color',
            array(
                // 'default' => '#3858F6',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_top_link_hover_color',
            array(
                'label' => esc_html__('Header Top: Link Hover + Active Color', 'esell'),
                'settings' => 'color_header_top_link_hover_color',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));
        // BG Color
        $wp_customize->add_setting('color_header_top_bg',
            array(
                // 'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_header_top_bg',
            array(
                'label' => esc_html__('Header Top: Background Color', 'esell'),
                'settings' => 'color_header_top_bg',
                'priority' => 10,
                'section' => 'axil_colors_header_options',
            )
        ));



        //  Footer
        $wp_customize->add_section('axil_colors_footer_options',
            array(
                'title' => esc_html__('Footer', 'esell'), //Visible title of section
                'priority' => 35, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'panel' => 'axil_colors_options',
            )
        );

        // Footer Heading Color
        $wp_customize->add_setting('color_footer_heading_color',
            array(
                // 'default' => '#ffffff',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_heading_color',
            array(
                'label' => esc_html__('Title Color', 'esell'),
                'settings' => 'color_footer_heading_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));

        // Text Color
        $wp_customize->add_setting('color_footer_body_color',
            array(
                // 'default' => '#6b7074',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_body_color',
            array(
                'label' => esc_html__('Text Color', 'esell'),
                'settings' => 'color_footer_body_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));

        // Link Color
        $wp_customize->add_setting('color_footer_link_color',
            array(
                // 'default' => '#6b7074',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_link_color',
            array(
                'label' => esc_html__('Link Color', 'esell'),
                'settings' => 'color_footer_link_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));

        // Link Hover Color
        $wp_customize->add_setting('color_footer_link_hover_color',
            array(
                // 'default' => '#3858F6',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_link_hover_color',
            array(
                'label' => esc_html__('Link Hover Color', 'esell'),
                'settings' => 'color_footer_link_hover_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));

        // Footer Bottom Border Top Color
        $wp_customize->add_setting('color_footer_bottom_border_color',
            array(
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_bottom_border_color',
            array(
                'label' => esc_html__('Footer Bottom Border Color', 'esell'),
                'settings' => 'color_footer_bottom_border_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));
        // Background Color
        $wp_customize->add_setting('color_footer_bg_color',
            array(
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'axil_color_footer_bg_color',
            array(
                'label' => esc_html__('Footer Background Color', 'esell'),
                'settings' => 'color_footer_bg_color',
                'priority' => 10,
                'section' => 'axil_colors_footer_options',
            )
        ));

    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since axil 1.0
     */
    public static function axil_custom_color_output()
    {
        ?>
        <!--Customizer CSS-->
        <!--/Customizer CSS-->
        <style type="text/css">

            /* Body */
            <?php self::axil_generate_css('body, p, ul, ol, ol li', 'color ', 'color_body'); ?>

            /* Meta */
            <?php self::axil_generate_css('ul.blog-meta li, .axil-single-widget .small-post .content ul.blog-meta li, ul.post-meta-list li, ul.post-meta-list', 'color ', 'color_meta'); ?>
            /* Meta Link */
            <?php self::axil_generate_css('.axil-blog-list .blog-top .author .info ul.blog-meta li a, .axil-blog-details-area .blog-top .author .info ul.blog-meta li a, ul.post-meta-list li a, ul.post-meta-list a, .post-meta a, .post-meta h6 a, ul.social-share-transparent li a , ul.social-share-transparent li button ', 'color ', 'link_color_meta'); ?>
            /* Meta Link Hover */
            <?php self::axil_generate_css('.axil-blog-list .blog-top .author .info ul.blog-meta li a:hover, .axil-blog-details-area .blog-top .author .info ul.blog-meta li a:hover,  ul.post-meta-list li a:hover, ul.post-meta-list a:hover, .post-meta a:hover, .post-meta h6 a:hover, ul.social-share-transparent li a:hover, ul.social-share-transparent li button:hover', 'color ', 'color_meta_hover', '', ' !important'); ?>


            /************************************************************************************
             * Header
             ************************************************************************************/
            /* Background Color */
            <?php self::axil_generate_css('.axil-header, .ax-header, .haeder-default.sticky, ul.mainmenu li.has-dropdown ul.axil-submenu', 'background-color ', 'color_header_bg', '', ' !important'); ?>
            <?php self::axil_generate_css('.axil-header.header-style-3 .header-bottom, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav', 'border-color ', 'color_header_border_color', '', ' !important'); ?>
            /* Link Color */
            <?php self::axil_generate_css('.mainmenu-nav ul.mainmenu > li > a, .mainmenu-nav ul li, .mainmenu-nav ul.mainmenu > li.menu-item-has-children .axil-submenu li a, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav .vertical-nav-item a, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav .vertical-nav-item a.hover-flip-item-wrapper span::before', 'color ', 'color_header_link_color'); ?>
            /* Link Hover Color */
            <?php self::axil_generate_css('.mainmenu-nav ul.mainmenu > li > a:hover, .mainmenu-nav ul.mainmenu > li.menu-item-has-children .axil-submenu li:hover > a, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav .vertical-nav-item a.hover-flip-item-wrapper span::after, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav .vertical-nav-item.active a, .mainmenu-nav ul.mainmenu > li.megamenu-wrapper .megamenu-sub-menu .megamenu-item .axil-vertical-nav .vertical-nav-item.active a.hover-flip-item-wrapper span::before', 'color ', 'color_header_link_hover_color'); ?>
            <?php self::axil_generate_css('.mainmenu-nav ul.mainmenu > li > a::after', 'background ', 'color_header_link_hover_color'); ?>

            /************************************************************************************
             * Header Top
             ************************************************************************************/
            /* Background Color */
            <?php self::axil_generate_css('.axil-header .header-top', 'background-color ', 'color_header_top_bg', '', ' !important'); ?>
            /* Link Color */
            <?php self::axil_generate_css('.header-top .header-top-nav li a, .header-top .header-top-date li, .axil-header.header-style-3 .header-top .header-top-nav li a, .axil-header.header-style-3 .header-top .social-share-transparent li a', 'color ', 'color_header_top_link_color'); ?>
            <?php self::axil_generate_css('ul.social-icon.color-white li a', 'background ', 'color_header_top_link_color'); ?>
            /* Link Hover Color */
            <?php self::axil_generate_css('.header-top .header-top-nav li a:hover, .axil-header.header-style-3 .header-top .header-top-nav li a:hover, .axil-header.header-style-3 .header-top .social-share-transparent li a:hover', 'color ', 'color_header_top_link_hover_color', '', '!important'); ?>
            <?php self::axil_generate_css('ul.social-icon.color-white li a:hover', 'background ', 'color_header_top_link_hover_color', '', '!important'); ?>


            /************************************************************************************
             * General
             ************************************************************************************/
            /* Primary [#3858F6] */
            <?php self::axil_generate_css(':root', '--color-primary', 'color_primary'); ?>
            <?php self::axil_generate_css(':root', '--color-secondary', 'color_secondary'); ?>
            <?php self::axil_generate_css(':root', '--color-secondary-alt', 'color_secondary_alt'); ?>
            <?php self::axil_generate_css(':root', '--color-tertiary', 'color_tertiary'); ?>
            /* Heading */
            <?php self::axil_generate_css('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6', 'color ', 'color_heading'); ?>

            /************************************************************************************
             * Footer
             ************************************************************************************/
            /* Background Color */
            <?php self::axil_generate_css('.axil-footer-area', 'background-color ', 'color_footer_bg_color'); ?>
            /* Footer Heading Color */
            <?php self::axil_generate_css('.axil-footer-area .widget-title, .axil-footer-area .follow-title, .footer-widget-item .title, .footer-default.footer-style-3 .footer-widget-item h6.title, .footer-default .footer-widget-item h2, .footer-widget-item h1, .footer-widget-item h3, .footer-widget-item h4, .footer-widget-item h5, .footer-widget-item h6 ', 'color ', 'color_footer_heading_color'); ?>
            /* Footer Body Color */
            <?php self::axil_generate_css('.footer-default.footer-style-3 .footer-widget-item .axil-ft-address .address p span.address-info, .footer-default.axil-footer-style-1 .footer-widget-item p, .footer-widget-item p, .copyright-default p, .axil-footer-area p, .copyright-area .copyright-right p', 'color ', 'color_footer_body_color'); ?>
            /* Footer Link Color */
            <?php self::axil_generate_css('.footer-widget-item ul li a, .copyright-area ul.mainmenu li a, .copyright-area .copyright-right p a, .footer-widget-item ul.menu li a, .footer-widget-item a:not(.axil-button), .copyright-default .quick-contact ul li a, .copyright a, .copyright-default p a', 'color ', 'color_footer_link_color'); ?>
            <?php self::axil_generate_css('.axil-footer-style-1.footer-variation-three ul.social-icon li a', 'background ', 'color_footer_link_color'); ?>
            /* Footer Link Hover Color */
            <?php self::axil_generate_css('.footer-widget-item ul li a:hover, .footer-widget-item ul.menu li a:hover, .copyright-default .quick-contact ul li a:hover, .copyright a:hover, .copyright-area .mainmenu li a:hover, .copyright-area .copyright-right p a:hover, .copyright-default p a:hover', 'color ', 'color_footer_link_hover_color'); ?>
            <?php self::axil_generate_css('ul.social-icon li a:hover', 'background ', 'color_footer_link_hover_color'); ?>
            /* Footer Bottom Border top Color */
            <?php self::axil_generate_css('.axil-footer-style-1.footer-variation-2 .footer-top::before, .axil-footer-style-1.footer-variation-three .footer-top::after', 'background ', 'color_footer_bottom_border_color'); ?>
            <?php self::axil_generate_css('.copyright-default', 'border-color ', 'color_footer_bottom_border_color'); ?>

        </style>
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
     * @since axil 1.0
     */
    public static function axil_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true)
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
                echo awescapeing($return);
            }
        }
        return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('axil_Customize', 'register'));

// Output custom CSS to live site
add_action('wp_head', array('axil_Customize', 'axil_custom_color_output'));