<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (!class_exists('Redux')) {
    return;
}
$opt_name = AXIL_THEME_FIX . '_options';
$theme = wp_get_theme();
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'disable_tracking' => true,
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'submenu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__('Axil Theme Options', 'esell'),
    'page_title' => esc_html__('Axil Theme Options', 'esell'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    //'google_api_key'       => 'AIzaSyC2GwbfJvi-WnYpScCPBGIUyFZF97LI0xs',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-menu',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    'forced_dev_mode_off' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => AXIL_THEME_FIX . '_options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => true,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    'footer_credit' => '&nbsp;',
    // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'hide_expand' => true,
    // This variable determines if the ‘Expand Options’ buttons is visible on the options panel.
);

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTS
 */

// -> START Basic Fields

/**
 * General
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'esell'),
    'id' => 'axil_general',
    'icon' => 'el el-cog',
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('General Setting', 'esell'),
    'id' => 'axil-general-setting',
    'icon' => 'el el-adjust-alt',
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'active_dark_mode',
            'type' => 'switch',
            'title' => esc_html__('Switch to Dark Mode', 'esell'),
            'on' => esc_html__('Yes', 'esell'),
            'off' => esc_html__('No', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'show_ld_switcher_form_user_end',
            'type' => 'switch',
            'title' => esc_html__('Enabled Dark/Light Switcher Form User End', 'esell'),
            'on' => esc_html__('Enabled', 'esell'),
            'off' => esc_html__('Disabled', 'esell'),
            'default' => true,
        ),

        // Start logo
        array(
            'id' => 'axil_logo_type',
            'type' => 'button_set',
            'title' => esc_html__('Select Logo Type', 'esell'),
            'subtitle' => esc_html__('Select logo type, if the image is chosen the existing options of  image below will work, or text option will work. (Note: Used when Transparent Header is enabled.)', 'esell'),
            'options' => array(
                'image' => 'Image',
                'text' => 'Text',
            ),
            'default' => 'image',
        ),
        array(
            'id' => 'axil_head_logo',
            'title' => esc_html__('Default Logo', 'esell'),
            'subtitle' => esc_html__('Upload the main logo of your site. ( Recommended size: Width 267px and Height: 70px )', 'esell'),
            'type' => 'media',
            'default' => array(
                'url' => AXIL_IMG_URL . 'logo.png'
            ),
            'required' => array('axil_logo_type', 'equals', 'image'),
        ),
        array(
            'id' => 'axil_head_logo_white',
            'title' => esc_html__('White Logo', 'esell'),
            'subtitle' => esc_html__('Upload the white logo of your site that use into off canvas area. ( Recommended size: Width 267px and Height: 70px )', 'esell'),
            'type' => 'media',
            'default' => array(
                'url' => AXIL_IMG_URL . 'white-logo.png'
            ),
            'required' => array('axil_logo_type', 'equals', 'image'),
        ),
        array(
            'id' => 'axil_logo_max_height',
            'type' => 'dimensions',
            'units_extended' => true,
            'units' => array('rem', 'px', '%'),
            'title' => esc_html__('Logo Height', 'esell'),
            'subtitle' => esc_html__('Set custom logo height. Default value: 50px', 'esell'),
            'width' => false,
            'output' => array(
                'max-height' => '.logo img'
            ),
            'required' => array('axil_logo_type', 'equals', 'image'),
        ),
        array(
            'id' => 'axil_logo_padding',
            'type' => 'spacing',
            'title' => esc_html__('Logo Padding', 'esell'),
            'subtitle' => esc_html__('Controls the top, right, bottom and left padding of the logo. (Note: Used when Transparent Header is enabled.)', 'esell'),
            'mode' => 'padding',
            'units' => array('em', 'px'),
            'default' => array(
                'padding-top' => 'px',
                'padding-right' => 'px',
                'padding-bottom' => 'px',
                'padding-left' => 'px',
                'units' => 'px',
            ),
            'output'         => array('.logo a'),
            'required' => array('axil_logo_type', 'equals', 'image'),
        ),
        array(
            'id' => 'axil_logo_text',
            'type' => 'text',
            'required' => array('axil_logo_type', 'equals', 'text'),
            'title' => esc_html__('Site Title', 'esell'),
            'subtitle' => esc_html__('Enter your site title here. (Note: Used when Transparent Header is enabled.)', 'esell'),
            'default' => get_bloginfo('name')
        ),
        array(
            'id' => 'axil_logo_text_font',
            'type' => 'typography',
            'title' => esc_html__('Site Title Font Settings', 'esell'),
            'required' => array('axil_logo_type', 'equals', 'text'),
            'google' => true,
            'subsets' => false,
            'line-height' => false,
            'text-transform' => true,
            'transition' => false,
            'text-align' => false,
            'preview' => false,
            'all_styles' => true,
            'output' => array('.logo a, .haeder-default .logo a'),
            'units' => 'px',
            'subtitle' => esc_html__('Controls the font settings of the site title. (Note: Used when Transparent Header is enabled.)', 'esell'),
            'default' => array(
                'google' => true,
            )
        ),
        // End logo
        array(
            'id' => 'axil_scroll_to_top_enable',
            'type' => 'button_set',
            'title' => esc_html__('Enable Back To Top', 'esell'),
            'subtitle' => esc_html__('Enable the back to top button that appears in the bottom right corner of the screen.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Yes', 'esell'),
                'no' => esc_html__('No', 'esell'),
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'axil_modern_cursor_enable',
            'type' => 'button_set',
            'title' => esc_html__('Enable Modern Cursor', 'esell'),
            'subtitle' => esc_html__('Enable the modern cursor that appears in the whole website.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Yes', 'esell'),
                'no' => esc_html__('No', 'esell'),
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'axil_preloader',
            'type' => 'button_set',
            'title' => esc_html__('Enable Preloader', 'esell'),
            'options' => array(
                'yes' => esc_html__('Yes', 'esell'),
                'no' => esc_html__('No', 'esell'),
            ),
            'default' => 'no'
        ),
        array(
            'id' => 'axil_preloader_image',
            'type' => 'media',
            'title' => esc_html__('Preloader Image', 'esell'),
            'subtitle' => esc_html__('Please upload your choice of preloader image. Transparent GIF format is recommended', 'esell'),
            'default' => array(
                'url' => AXIL_THEME_URI . '/assets/images/preloader.gif'
            ),
            'required' => array('axil_preloader', 'equals', 'yes')
        ),
    )
));
Redux::setSection($opt_name,
    array(
        'title' => esc_html__('Contact & Socials', 'esell'),
        'id' => 'socials_section',
        'heading' => esc_html__('Contact & Socials', 'esell'),
        'subtitle' => esc_html__('In case you want to hide any field, just keep that field empty', 'esell'),
        'icon' => 'el el-twitter',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'social_title',
                'type' => 'text',
                'title' => esc_html__('Social Title', 'esell'),
                'default' => esc_html__('Follow us', 'esell'),
            ),

            array(
                'id' => 'axil_social_icons',
                'type' => 'sortable',
                'title' => esc_html__('Social Icons', 'esell'),
                'subtitle' => esc_html__('Enter social links to show the icons', 'esell'),
                'mode' => 'text',
                'label' => true,
                'options' => array(
                    'facebook-f' => '',
                    'twitter' => '',
                    'pinterest-p' => '',
                    'linkedin-in' => '',
                    'instagram' => '',
                    'vimeo-v' => '',
                    'dribbble' => '',
                    'behance' => '',
                    'youtube' => '',
                ),
                'default' => array(
                    'facebook-f' => 'https://www.facebook.com/',
                    'twitter' => 'https://twitter.com/',
                    'pinterest-p' => 'https://pinterest.com/',
                    'linkedin-in' => 'https://linkedin.com/',
                    'instagram' => 'https://instagram.com/',
                    'vimeo-v' => 'https://vimeo.com/',
                    'dribbble' => 'https://dribbble.com/',
                    'behance' => 'https://behance.com/',
                    'youtube' => '',
                ),
            )
        )
    )
);

/**
 * Header
 */
Redux::setSection($opt_name, array(
        'title' => esc_html__('Header', 'esell'),
        'id' => 'header_id',
        'icon' => 'el el-minus',
        'fields' => array(
            array(
                'id' => 'axil_enable_header',
                'type' => 'switch',
                'title' => esc_html__('Header', 'esell'),
                'subtitle' => esc_html__('Enable or disable the header area.', 'esell'),
                'default' => true
            ),

            // Header Custom Style
            array(
                'id' => 'axil_select_header_template',
                'type' => 'image_select',
                'title' => esc_html__('Select Header Layout', 'esell'),
                'options' => array(
                    '1' => array(
                        'alt' => esc_html__('Header Layout 1', 'esell'),
                        'title' => esc_html__('Header Layout 1', 'esell'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/header/1.png',
                    ),
                    '2' => array(
                        'alt' => esc_html__('Header Layout 2', 'esell'),
                        'title' => esc_html__('Header Layout 2', 'esell'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/header/2.png',
                    ),
                    '3' => array(
                        'alt' => esc_html__('Header Layout 3', 'esell'),
                        'title' => esc_html__('Header Layout 3', 'esell'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/header/3.png',
                    ),
                    '4' => array(
                        'alt' => esc_html__('Header Layout 4', 'esell'),
                        'title' => esc_html__('Header Layout 4', 'esell'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/header/4.png',
                    ),
                    '5' => array(
                        'alt' => esc_html__('Header Layout 5', 'esell'),
                        'title' => esc_html__('Header Layout 5', 'esell'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/header/5.png',
                    ),
                ),
                'default' => '1',
                'required' => array('axil_enable_header', 'equals', true),
            ),
            array(
                'id' => 'axil_enable_header_search',
                'type' => 'switch',
                'title' => esc_html__('Header Search Form', 'esell'),
                'subtitle' => esc_html__('Enable or disable header search form.', 'esell'),
                'default' => true,
            ),
            array(
                'id' => 'axil_enable_header_social_icon',
                'type' => 'switch',
                'title' => esc_html__('Social Icon', 'esell'),
                'subtitle' => esc_html__('Enable or disable social icon.', 'esell'),
                'default' => true,
                'required' => array( 'axil_select_header_template', 'equals', array('3', '4', '5') ),
            ),
            array(
                'id' => 'axil_enable_header_top_menu',
                'type' => 'switch',
                'title' => esc_html__('Header Top Menu', 'esell'),
                'subtitle' => esc_html__('Enable or disable header top menu.', 'esell'),
                'default' => false,
                'required' => array( 'axil_select_header_template', 'equals', array('3', '4', '5') ),
            ),
            array(
                'id' => 'axil_enable_header_top_date',
                'type' => 'switch',
                'title' => esc_html__('Header Top Date', 'esell'),
                'subtitle' => esc_html__('Enable or disable header top date.', 'esell'),
                'default' => false,
                'required' => array( 'axil_select_header_template', 'equals', array('3', '4', '5') ),
            ),
            array(
                'id' => 'axil_header_sticky',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky', 'esell'),
                'subtitle' => esc_html__('Enable to activate the sticky header.', 'esell'),
                'default' => false,
                'required' => array('axil_enable_header', 'equals', true),
            ),
            array(
                'id' => 'axil_header_transparent',
                'type' => 'switch',
                'title' => esc_html__('Header Transparent', 'esell'),
                'subtitle' => esc_html__('Enable to make the header area transparent.', 'esell'),
                'default' => true,
                'required' => array('axil_enable_header', 'equals', true),
            ), // output body class


        )
    ));

/**
 * Header Top
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header Top', 'esell'),
    'id' => 'axil_header_top_section',
    'icon' => 'el el-credit-card',
    'fields' => array(
        array(
            'id' => 'axil_header_top_enable',
            'type' => 'switch',
            'title' => esc_html__('Header Top', 'esell'),
            'subtitle' => esc_html__('Enable or disable the Header top area.', 'esell'),
            'default' => false,
        ),

        // Header Custom Style
        array(
            'id' => 'header_top_left',
            'type' => 'text',
            'title' => esc_html__('Header Top Left', 'esell'),
            'default' => '365 days to change your mind',
            'required' => array('axil_header_top_enable', 'equals', true),
        ),
         array(
            'id' => 'header_top_right',
            'type' => 'switch',
            'title' => esc_html__('Header Top right', 'esell'),
            'subtitle' => esc_html__('Enable or disable the Top Right.', 'esell'),
            'default' => true,
             'required' => array('axil_header_top_enable', 'equals', true),
        ),

    )
));

/**
 * footer Top
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'esell'),
    'id' => 'axil_footer_top_section',
    'icon' => 'el el-credit-card',
    'fields' => array(
        array(
            'id' => 'axil_footer_top_enable',
            'type' => 'switch',
            'title' => esc_html__('Footer Top', 'esell'),
            'subtitle' => esc_html__('Enable or disable the footer top area.', 'esell'),
            'default' => false,
        ),

        // Header Custom Style
        array(
            'id' => 'axil_ft_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'esell'),
            'default' => 'New Product Notifications',
            'required' => array('axil_footer_top_enable', 'equals', true),
        ), 
        array(
            'id' => 'axil_ft_sub_title',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'esell'),
            'default' => '- Our Newsletter',
            'required' => array('axil_footer_top_enable', 'equals', true),
        ),
        array(
            'id' => 'axil_ft_shortcode',
            'type' => 'textarea',
            'title' => esc_html__('Add Shortcode Here', 'esell'),
            'default' => '',
            'required' => array('axil_footer_top_enable', 'equals', true),
        ),
        array(
            'id'       => 'axil_ft_area_background',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'esell'),
            'subtitle' => esc_html__('Footer Top Background', 'esell'),
            'required' => array('axil_footer_top_enable', 'equals', true),
            'output'    => array('background' => '.axil-instagram-area.bg-color-grey')
        ),     

    )
));


/**
 * Footer section
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'esell'),
    'id' => 'axil_footer_section',
    'icon' => 'el el-photo',
    'fields' => array(
        array(
            'id' => 'axil_footer_enable',
            'type' => 'switch',
            'title' => esc_html__('Footer', 'esell'),
            'subtitle' => esc_html__('Enable or disable the footer area.', 'esell'),
            'default' => true,
        ),
        // Header Custom Style
        array(
            'id' => 'axil_select_footer_template',
            'type' => 'image_select',
            'title' => esc_html__('Select Footer Layout', 'esell'),
            'options' => array(
                '1' => array(
                    'alt' => esc_html__('Footer Layout 1', 'esell'),
                    'title' => esc_html__('Footer Layout 1', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/footer/1.png',
                ),
                '2' => array(
                    'alt' => esc_html__('Footer Layout 2', 'esell'),
                    'title' => esc_html__('Footer Layout 2', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/footer/2.png',
                ),
                '3' => array(
                    'alt' => esc_html__('Footer Layout 3', 'esell'),
                    'title' => esc_html__('Footer Layout 3', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/footer/3.png',
                ),
                '4' => array(
                    'alt' => esc_html__('Footer Layout 4', 'esell'),
                    'title' => esc_html__('Footer Layout 4', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/footer/4.png',
                ),
            ),
            'default' => '2',
            'required' => array('axil_footer_enable', 'equals', true),
        ),
        array(
            'id' => 'axil_footer_social_network',
            'type' => 'switch',
            'title' => esc_html__('Footer Social Network', 'esell'),
            'subtitle' => esc_html__('Enable or disable the footer social network.', 'esell'),
            'default' => false,
            'required' => array('axil_select_footer_template', 'equals', array('1', '2', '3')),
        ),
        // Footer Bottom
        array(
            'id' => 'axil_copyright_contact',
            'type' => 'editor',
            'title' => esc_html__('Copyright Content', 'esell'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 5,
            ),
            'default' => '© 2021. All rights reserved by <a href="#" target="_blank" rel="noopener">Your Company.</a>',
            'required' => array('axil_footer_enable', 'equals', true),
        ),

           array(
                'id'       => 'payment_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Payment Icons', 'esell' ),
                'on'       => esc_html__( 'Enabled', 'esell' ),
                'off'      => esc_html__( 'Disabled', 'esell' ),
                'default'  => false,                
            ),

            array(
                'id'       => 'payment_img',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Payment Icons Gallery', 'esell' ),
                'required' => array( 'payment_icons', 'equals', true )
            ),

    )
));

/**
 * Page Banner/Title section
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Banner', 'esell'),
    'id' => 'axil_banner_section',
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'id' => 'axil_banner_enable',
            'type' => 'switch',
            'title' => esc_html__('Banner', 'esell'),
            'subtitle' => esc_html__('Enable or disable the banner area.', 'esell'),
            'default' => true,
        ),
        // Header Custom Style
        array(
            'id' => 'axil_select_banner_template',
            'type' => 'image_select',
            'title' => esc_html__('Select banner Layout', 'esell'),
            'options' => array(
                '1' => array(
                    'alt' => esc_html__('Banner Layout 1', 'esell'),
                    'title' => esc_html__('banner Layout 1', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/banner/1.jpg',
                ),
                '2' => array(
                    'alt' => esc_html__('Banner Layout 2', 'esell'),
                    'title' => esc_html__('banner Layout 2', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/banner/2.jpg',
                ),
            ),
            'default' => '1',
            'required' => array('axil_banner_enable', 'equals', true),
        ),
        array(
            'id' => 'axil_breadcrumb_enable',
            'type' => 'switch',
            'title' => esc_html__('Breadcrumb', 'esell'),
            'subtitle' => esc_html__('Enable or disable the breadcrumb area.', 'esell'),
            'default' => true,
            'required' => array('axil_select_banner_template', 'equals', '1'),

        ),
    )
));


/**
 * Page Banner/Title section
 */

Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Banner Top', 'esell'),
    'id' => 'axil_banner_top_section',
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'id' => 'banner_top_enable',
            'type' => 'switch',
            'title' => esc_html__('Banner', 'esell'),
            'subtitle' => esc_html__('Enable or disable the banner top info area.', 'esell'),
            'default' => true,
        ),    
         array(
            'id' => 'banner_top_info',
            'type' => 'textarea',
            'title' => esc_html__('Offer Text', 'esell'),
            'default' => 'STUDENT NOW GET 10% OFF',
            'required' => array('banner_top_enable', 'equals', true),
        ), 
         array(
            'id' => 'banner_top_info_url_txt',
            'type' => 'text',
            'title' => esc_html__('Url Text', 'esell'),
            'default' => 'Learn More',
            'required' => array('banner_top_enable', 'equals', true),
        ), 
         array(
            'id' => 'banner_top_info_url',
            'type' => 'text',
            'title' => esc_html__('Url', 'esell'),
            'default' => '',
            'required' => array('banner_top_enable', 'equals', true),
        ),
    )
));

/**
 * Blog Panel
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog', 'esell'),
    'id' => 'axil_blog',
    'icon' => 'el el-file-edit',
));

/**
 * Blog Options
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Archive', 'esell'),
    'id' => 'axil_blog_genaral',
    'icon' => 'el el-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'axil_enable_blog_title',
            'type' => 'button_set',
            'title' => esc_html__('Title', 'esell'),
            'subtitle' => esc_html__('Enable or Disable the blog page title.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Enable', 'esell'),
                'no' => esc_html__('Disable', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_blog_text',
            'type' => 'text',
            'title' => esc_html__('Default Title', 'esell'),
            'subtitle' => esc_html__('Controls the Default title of the page which is displayed on the page title are on the blog page.', 'esell'),
            'default' => esc_html__('Blog', 'esell'),
            'required' => array('axil_enable_blog_title', 'equals', 'yes'),
        ),
        array(
            'id' => 'axil_blog_sidebar',
            'type' => 'image_select',
            'title' => esc_html__('Select Blog Sidebar', 'esell'),
            'subtitle' => esc_html__('Choose your favorite blog layout', 'esell'),
            'options' => array(
                'left' => array(
                    'alt' => esc_html__('Left Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                    'title' => esc_html__('Left Sidebar', 'esell'),
                ),
                'right' => array(
                    'alt' => esc_html__('Right Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                    'title' => esc_html__('Right Sidebar', 'esell'),
                ),
                'no' => array(
                    'alt' => esc_html__('No Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                    'title' => esc_html__('No Sidebar', 'esell'),
                ),
            ),
            'default' => 'right',
        ),
        array(
            'id' => 'axil_show_post_author_meta',
            'type' => 'button_set',
            'title' => esc_html__('Author', 'esell'),
            'subtitle' => esc_html__('Show or hide the author of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_post_publish_date_meta',
            'type' => 'button_set',
            'title' => esc_html__('Publish Date', 'esell'),
            'subtitle' => esc_html__('Show or hide the publish date of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_post_updated_date_meta',
            'type' => 'button_set',
            'title' => esc_html__('Updated Date', 'esell'),
            'subtitle' => esc_html__('Show or hide the updated date of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'no',
        ),
        array(
            'id' => 'axil_show_post_reading_time_meta',
            'type' => 'button_set',
            'title' => esc_html__('Reading Time', 'esell'),
            'subtitle' => esc_html__('Show or hide the publish content reading time.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_post_comments_meta',
            'type' => 'button_set',
            'title' => esc_html__('Comments', 'esell'),
            'subtitle' => esc_html__('Show or hide the comments of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'no',
        ),
        array(
            'id' => 'axil_show_post_categories_meta',
            'type' => 'button_set',
            'title' => esc_html__('Categories', 'esell'),
            'subtitle' => esc_html__('Show or hide the categories of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_post_tags_meta',
            'type' => 'button_set',
            'title' => esc_html__('Tags', 'esell'),
            'subtitle' => esc_html__('Show or hide the tags of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'no',
        ),
        array(
            'id' => 'axil_show_post_share_icon',
            'type' => 'button_set',
            'title' => esc_html__('Share icon', 'esell'),
            'subtitle' => esc_html__('Show or hide the share icon of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
    )
));

/**
 * Single Post
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single', 'esell'),
    'id' => 'axil_blog_details_id',
    'icon' => 'el el-website',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'axil_single_pos',
            'type' => 'image_select',
            'title' => esc_html__('Blog Details Sidebar', 'esell'),
            'subtitle' => esc_html__('Choose your favorite layout', 'esell'),
            'options' => array(
                'left' => array(
                    'alt' => esc_html__('Left Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                    'title' => esc_html__('Left Sidebar', 'esell'),
                ),
                'right' => array(
                    'alt' => esc_html__('Right Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                    'title' => esc_html__('Right Sidebar', 'esell'),
                ),
                'full' => array(
                    'alt' => esc_html__('No Sidebar', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                    'title' => esc_html__('No Sidebar', 'esell'),
                ),
            ),
            'default' => 'full',
        ),
        array(
            'id' => 'axil_single_post_style',
            'type' => 'image_select',
            'title' => esc_html__('Blog Details Banner Style', 'esell'),
            'subtitle' => esc_html__('Choose your favorite layout', 'esell'),
            'options' => array(
                '0' => array(
                    'alt' => esc_html__('Default', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/post-style-0.png',
                    'title' => esc_html__('Default', 'esell'),
                ),
                '1' => array(
                    'alt' => esc_html__('Full Banner', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/post-style-1.png',
                    'title' => esc_html__('Full Banner', 'esell'),
                ),
                '2' => array(
                    'alt' => esc_html__('Boxed Banner', 'esell'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/post-style-2.png',
                    'title' => esc_html__('Boxed Banner', 'esell'),
                ),
            ),
        ),
        array(
            'id' => 'axil_enable_single_post_breadcrumb_wrap',
            'type' => 'button_set',
            'title' => esc_html__('Breadcrumb Area', 'esell'),
            'subtitle' => esc_html__('Enable or Disable Breadcrumb Area.', 'esell'),
            'options' => array(
                'show' => esc_html__('Enable', 'esell'),
                'hide' => esc_html__('Disable', 'esell'),
            ),
            'default' => 'show',
        ),
        array(
            'id' => 'axil_show_blog_details_categories_meta',
            'type' => 'button_set',
            'title' => esc_html__('Categories', 'esell'),
            'subtitle' => esc_html__('Show or hide the categories of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_blog_details_author_meta',
            'type' => 'button_set',
            'title' => esc_html__('Author', 'esell'),
            'subtitle' => esc_html__('Show or hide the author of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_blog_details_publish_date_meta',
            'type' => 'button_set',
            'title' => esc_html__('Publish Date', 'esell'),
            'subtitle' => esc_html__('Show or hide the publish date of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_blog_details_updated_date_meta',
            'type' => 'button_set',
            'title' => esc_html__('Updated Date', 'esell'),
            'subtitle' => esc_html__('Show or hide the updated date of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'no',
        ),
        array(
            'id' => 'axil_show_blog_details_reading_time_meta',
            'type' => 'button_set',
            'title' => esc_html__('Reading Time', 'esell'),
            'subtitle' => esc_html__('Show or hide the publish content reading time.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_show_blog_details_comments_meta',
            'type' => 'button_set',
            'title' => esc_html__('Comments', 'esell'),
            'subtitle' => esc_html__('Show or hide the comments of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'no',
        ),

        array(
            'id' => 'axil_show_blog_details_tags_meta',
            'type' => 'button_set',
            'title' => esc_html__('Tags', 'esell'),
            'subtitle' => esc_html__('Show or hide the tags of blog post.', 'esell'),
            'options' => array(
                'yes' => esc_html__('Show', 'esell'),
                'no' => esc_html__('Hide', 'esell'),
            ),
            'default' => 'yes',
        ),
        array(
            'id' => 'axil_blog_details_social_share_for_top',
            'type' => 'switch',
            'title' => esc_html__('Social Share Form Top', 'esell'),
            'subtitle' => esc_html__('Show or hide the social share of single post.', 'esell'),
            'default' => true,
        ),
        array(
            'id' => 'axil_blog_details_social_share',
            'type' => 'switch',
            'title' => esc_html__('Social Share', 'esell'),
            'subtitle' => esc_html__('Show or hide the social share of single post.', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'axil_blog_details_like_options',
            'type' => 'switch',
            'title' => esc_html__('Like Button', 'esell'),
            'subtitle' => esc_html__('Show or hide the like button of single post.', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'axil_blog_details_show_author_info',
            'type' => 'switch',
            'title' => esc_html__('Show Author Info', 'esell'),
            'subtitle' => esc_html__('Show or hide the Author Info box of single post.', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'axil_show_blog_details_comments_meta_bottom',
            'type' => 'switch',
            'title' => esc_html__('Comments Count', 'esell'),
            'subtitle' => esc_html__('Show or hide the Comments Count of single post.', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'axil_show_blog_details_add_our_comment_button',
            'type' => 'switch',
            'title' => esc_html__('Add your comment button', 'esell'),
            'subtitle' => esc_html__('Show or hide the Add your comment button of single post.', 'esell'),
            'default' => false,
        ),
        array(
            'id' => 'axil_show_blog_details_add_our_comment_button_text',
            'type' => 'text',
            'title' => esc_html__('Add your comment button Text', 'esell'),
            'default' => esc_html__('Add Your Comment', 'esell'),
            'required' => array('axil_show_blog_details_add_our_comment_button', 'equals', true),
        ),
        array(
            'id' => 'axil_post_review_pors_label',
            'type' => 'text',
            'title' => esc_html__('Pors', 'esell'),
            'default' => esc_html__('Pors', 'esell'),
        ),
        array(
            'id' => 'axil_post_review_cons_label',
            'type' => 'text',
            'title' => esc_html__('Cons', 'esell'),
            'default' => esc_html__('Cons', 'esell'),
        ),
    )
));

/**
 * Typography
 */

/**
 * 404 error page
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('404 Page', 'esell'),
    'id' => 'axil_error_page',
    'icon' => 'el el-eye-close',
    'fields' => array(
        array(
            'id' => 'axil_404_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'esell'),
            'subtitle' => esc_html__('Add your Default title.', 'esell'),
            'value' => 'Page not Found',
            'default' => esc_html__('Page not Found', 'esell'),
        ),
//        array(
//            'id' => 'axil_404font',
//            'type' => 'typography',
//            'title' => esc_html__('Title Typography', 'esell'),
//            'subtitle' => esc_html__('Controls the typography for the title.', 'esell'),
//            'google' => true,
//            'font-style' => true,
//            'font-weight' => true,
//            'font-family' => true,
//            'subsets' => true,
//            'line-height' => true,
//            'text-align' => true,
//            'all_styles' => true,
//            'output' => array('.axil-error-not-found .axil-error .title'),
//            'units' => 'px',
//            'default' => array(
//                'google' => true,
//            ),
//        ),
        
        array(
            'id' => 'axil_404_subtitle',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'esell'),
            'subtitle' => esc_html__('Add your custom subtitle.', 'esell'),
            'default' => esc_html__('Sorry, but the page you were looking for could not be found.', 'esell'),
        ),
//        array(
//            'id' => 'axil_404font_subtitle',
//            'type' => 'typography',
//            'title' => esc_html__('Sub Title Typography', 'esell'),
//            'subtitle' => esc_html__('Controls the typography settings of the subtitle.', 'esell'),
//            'google' => true,
//            'font-backup' => false,
//            'subsets' => false,
//            'line-height' => false,
//            'text-align' => false,
//            'text-transform' => true,
//            'all_styles' => true,
//            'output' => array('.axil-error-not-found .axil-error .subtitle-2'),
//            'units' => 'px',
//            'default' => array(
//                'google' => true,
//            )
//        ),
        array(
            'id' => 'axil_enable_go_back_btn',
            'type' => 'button_set',
            'title' => esc_html__('Button', 'esell'),
            'subtitle' => esc_html__('Enable or disable the go to home page button.', 'esell'),
            'options' => array(
                'yes' => 'Enable',
                'no' => 'Disable'
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'axil_button_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'esell'),
            'subtitle' => esc_html__('Set the custom text of go to home page button.', 'esell'),
            'default' => esc_html__('Back to Homepage', 'esell'),
            'required' => array('axil_enable_go_back_btn', 'equals', 'yes'),
        )
    )
));


/**
 * Ads Management
 */
Redux::setSection($opt_name,
    array(
        'title' => esc_html__('Ad Management', 'esell'),
        'id' => 'ad_settings_section',
        'icon' => 'el el-speaker',
    )
);

// Blog / Archive
$header_mid = axil_redux_add_fields('ad_post_header_mid', esc_html__('Header Mid', 'esell'));
$before_content = axil_redux_add_fields('ad_post_before_content', esc_html__('Before Post Contents', 'esell'));
$after_content = axil_redux_add_fields('ad_post_after_content', esc_html__('After Post Contents', 'esell'));
$before_sidebar = axil_redux_add_fields('ad_post_before_sidebar', esc_html__('Before Post Sidebar', 'esell'));
$after_sidebar = axil_redux_add_fields('ad_post_after_sidebar', esc_html__('After Post Sidebar', 'esell'));

$fields = array_merge($before_content, $after_content, $before_sidebar, $after_sidebar);

Redux::setSection($opt_name,
    array(
        'title' => esc_html__('Header', 'esell'),
        'id' => 'ad_settings_header_mid',
        'heading' => esc_html__('Header Mid Ad', 'esell'),
        'subsection' => true,
        'icon' => 'el el-network',
        'fields' => $header_mid
    )
);

Redux::setSection($opt_name,
    array(
        'title' => esc_html__('Blog', 'esell'),
        'id' => 'ad_settings_blog_section',
        'heading' => esc_html__('Blog', 'esell'),
        'subsection' => true,
        'icon' => 'el el-network',
        'fields' => $fields
    )
);



function esell_redux_post_type_fields( $prefix ){
    return array(
        'layout' => array(
            'id'       => $prefix. '_layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'esell' ),
            'options'  => array(
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'esell' ),
                'full-width'    => esc_html__( 'Full Width', 'esell' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'esell' ),
            ),
            'default'  => 'right-sidebar'
        ),

        'sidebar' => array(
            'id'       => $prefix. '_sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Custom Sidebar', 'esell' ),
            'options'  => Helper::get_custom_sidebar_fields(),
            'default'  => 'sidebar',
            'required' => array( $prefix. '_layout', '!=', 'full-width' ),
        ),
        'wrapper_full' => array(
            'id'       => $prefix. '_wrapper_full',
            'type'     => 'select',
            'title'    => esc_html__( 'Wrapper Full', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'on'      => esc_html__( 'Enabled', 'esell' ),
                'off'     => esc_html__( 'Disabled', 'esell' ),
            ),
            'default'  => 'off',
        ),
        'section_spacing' => array(
            'id'       => $prefix. '_section_spacing',
            'type'     => 'select',
            'title'    => esc_html__( 'Section Spacing', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'on'      => esc_html__( 'Enabled', 'esell' ),
                'off'     => esc_html__( 'Disabled', 'esell' ),
            ),
            'default'  => 'default',
        ),  
        'header_type' => array(
            'id'       => $prefix. '_header_transparent',
            'type'     => 'select',
            'title'    => esc_html__( 'Transparent Header', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'on'      => esc_html__( 'Enabled', 'esell' ),
                'off'     => esc_html__( 'Disabled', 'esell' ),
            ),
            'default'  => 'default',
        ),
        
        'header_style' => array(
            'id'       => $prefix. '_header_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Layout', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                '1'       => esc_html__( 'Layout 1', 'esell' ),
                '2'       => esc_html__( 'Layout 2', 'esell' ),
                '3'       => esc_html__( 'Layout 3', 'esell' ),
                '4'       => esc_html__( 'Layout 4', 'esell' ),             
            ),
            'default'  => 'default',
        ),  
        'footer_style' => array(
            'id'       => $prefix. '_footer_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer Layout', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                '1'       => esc_html__( 'Layout 1', 'esell' ),
                '2'       => esc_html__( 'Layout 2', 'esell' ),
              
            ),
            'default'  => 'default',
        ),
        'banner' => array(
            'id'       => $prefix. '_banner',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'on'      => esc_html__( 'Enabled', 'esell' ),
                'off'     => esc_html__( 'Disabled', 'esell' ),
            ),
            'default'  => 'default',
        ),
        'breadcrumb' => array(
            'id'       => $prefix. '_breadcrumb',
            'type'     => 'select',
            'title'    => esc_html__( 'Breadcrumb', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'on'      => esc_html__( 'Enabled', 'esell' ),
                'off'     => esc_html__( 'Disabled', 'esell' ),
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgtype' => array(
            'id'       => $prefix. '_bgtype',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner Background Type', 'esell'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'esell' ),
                'bgcolor'  => esc_html__( 'Background Color', 'esell' ),
                'bgimg'    => esc_html__( 'Background Image', 'esell' ),
                'texttype'    => esc_html__( 'Text Type', 'esell' ),                 
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgimg' => array(
            'id'       => $prefix. '_bgimg',
            'type'     => 'media',
            'title'    => esc_html__( 'Banner Background Image', 'esell' ),
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgimg' ),
        ),
        'bgcolor' => array(
            'id'       => $prefix. '_bgcolor',
            'type'     => 'color',
            'title'    => esc_html__( 'Banner Background Color', 'esell'), 
            'validate' => 'color',
            'transparent' => false,
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgcolor' ),
        ),
    );
}


// Woocommerce
if ( class_exists( 'WooCommerce' ) ) {

/**
 * Ads Management
 */
Redux::setSection($opt_name,
    array(
        'title' => esc_html__('WooCommerce', 'esell'),
        'id' => 'ad_settings_section',
        'icon' => 'el el-speaker',
    )
);

    $fields = array(  
    array(
        'id' => 'woocommerce_header',
        'type' => 'switch',
        'title' => esc_html__('WooCommerce Default Header', 'tact'),
        'on' => esc_html__('On', 'tact'),
        'off' => esc_html__('Off', 'tact'),
        'default' => false,
    ),  

);

$fields2 = esell_redux_post_type_fields( 'shop' );
$axiltheme_shop_archive_fields = array_merge($fields2, $fields);

    // Woocommerce Shop Archive
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Shop Layout', 'esell' ),
            'id'         => 'shop_section',
            'subsection' => true,
            'fields'     => $axiltheme_shop_archive_fields
        ) 
    );

    // Woocommerce Product
    $esell_product_fields = esell_redux_post_type_fields( 'product' );
    $esell_product_fields['layout']['default'] = 'full-width';
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Product Layout', 'esell' ),
            'id'         => 'product_section',
            'subsection' => true,
            'fields'     => $esell_product_fields
        ) 
    );
}

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Shop Settings', 'esell' ),
        'id'      => 'wc_sec_shop',
        'subsection' => true,
        'fields'  => array(         
                array(
                    'id' => 'woocommerce_header',
                    'type' => 'switch',
                    'title' => esc_html__('WooCommerce Default Header', 'tact'),
                    'on' => esc_html__('On', 'tact'),
                    'off' => esc_html__('Off', 'tact'),
                    'default' => false,
                ),  
            array(
                'id' => 'shop_content_layout',
                'type' => 'switch',
                'title' => esc_html__('Shop Content Full Layout', 'esell'),
                'on' => esc_html__('On', 'esell'),
                'off' => esc_html__('Off', 'esell'),
                'default' => false,
            ),  
            array(
                'id'       => 'wc_product_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Product Block Style', 'esell'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'esell' ),
                    '2' => esc_html__( 'Style 2', 'esell' ),
                    '3' => esc_html__( 'Style 3', 'esell' ),
                    '4' => esc_html__( 'Style 4', 'esell' ),
                   
                ),
                'default'  => '1',
            ),            

            array(
                'id'       => 'wc_tab_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Tab Product Columns', 'esell'), 
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'esell' ),
                    '6'  => esc_html__( '2 Col', 'esell' ),
                    '4'  => esc_html__( '3 Col', 'esell' ),
                    '3'  => esc_html__( '4 Col', 'esell' ),
                    '2'  => esc_html__( '6 Col', 'esell' ),
                ),
                'default'  => '6',
            ),
            array(
                'id'       => 'wc_mobile_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Product Columns', 'esell'), 
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'esell' ),
                    '6'  => esc_html__( '2 Col', 'esell' ),
                    '4'  => esc_html__( '3 Col', 'esell' ),
                    '3'  => esc_html__( '4 Col', 'esell' ),
                    '2'  => esc_html__( '6 Col', 'esell' ),
                ),
                'default'  => '12',
            ), 
           

             array(
                'id'       => 'wc_shop_Product_img_size',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Columns Images 100% ', 'esell' ),
                'on'       => esc_html__( 'Enabled', 'esell' ),
                'off'      => esc_html__( 'Disabled', 'esell' ),
                'default'  => true,
            ),


            array(
                'id'       => 'wc_num_product',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Page', 'esell' ),
                'default'  => '9',
            ),
            array(
                'id'       => 'wc_pagination',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Pagination Type', 'esell' ),
                'options'  => array(
                    'numbered'        => esc_html__( 'Numbered', 'esell' ),
                    'load-more'       => esc_html__( 'Load More', 'esell' ),
                    'infinity-scroll' => esc_html__( 'Infinity Scroll', 'esell' ),
                ),
                'default'  => 'numbered'
            ),
            array(
                'id'       => 'wc_sale_label',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sale Product Label', 'esell' ),
                'options'  => array(
                    'percentage' => esc_html__( 'Percentage', 'esell' ),
                    'text'       => esc_html__( 'Text', 'esell' ),
                ),
                'default'  => 'percentage'
            ),
            array(
                'id'       => 'wc_shop_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Category', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_review',
                'type'     => 'switch',
                'title'    => esc_html__( 'Review Star', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'esell' ),
            ),
            array(
                'id'       => 'wc_shop_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'esell' ),
            ),
            array(
                'id'       => 'wc_shop_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'esell' ),
            ),

            array(
                'id' => 'esell_search_auto_suggest_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search', 'esell'),
                
                'default' => true,
                'on' => esc_html__('Enable', 'esell'),
                'off' => esc_html__('Disable', 'esell'),
            ),
            array(
                'id' => 'esell_search_img_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search With Image', 'esell'),                
                'default' => true,
                'on' => esc_html__('Enable', 'esell'),
                'off' => esc_html__('Disable', 'esell'),
            ),
            array(
                'id' => 'esell_search_auto_suggest_limit',
                'type' => 'text',
                'title' => esc_html__('Autosuggest Limit', 'esell'),
                
                'default' => '10'
            ),

            array(
                'id' => 'wooc_search_auto_suggest_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search', 'esell'),
                
                'default' => true,
                'on' => esc_html__('Enable', 'esell'),
                'off' => esc_html__('Disable', 'esell'),
            ),
            array(
                'id' => 'wooc_search_img_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search With Image', 'esell'),                
                'default' => true,
                'on' => esc_html__('Enable', 'esell'),
                'off' => esc_html__('Disable', 'esell'),
            ),

            array(
                'id' => 'wooc_search_auto_suggest_limit',
                'type' => 'text',
                'title' => esc_html__('Autosuggest Limit', 'esell'),
                
                'default' => '10'
            ),

              array(
                'id'        => 'shop_filters_custom_controls',
                'type'      => 'switch',
                'title'     => __( 'Custom Controls', 'esell' ),
                'subtitle'  => __( 'Display color/image swatches for variable-product attributes.', 'esell' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_custom_controls',
                'type'      => 'switch',
                'title'     => __( 'Custom Controls', 'esell' ),
                'subtitle'  => __( 'Display color/image swatches and size labels for variable-product attributes.', 'esell' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_display_attributes',
                'type'      => 'switch',
                'title'     => __( 'Color/Image Swatches', 'esell' ),
                'subtitle'  => __( 'Display color/image swatches for variable-product attributes.', 'esell' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_hover_image_global',
                'type'      => 'switch',
                'title'     => __( 'Hover Image', 'esell' ),
                'subtitle'  => __( 'Display the second gallery image when a product is "hovered".', 'esell' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
            array(
                'id'       => 'wooc_wc_product_filter_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Product Filter Type', 'esell' ),
                'options'  => array(
                    'ajax' => esc_html__( 'Ajax', 'esell' ),
                    'regular' => esc_html__( 'Regular', 'esell' ),
                ),
                'default'  => 'regular',
            ), 

        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Product Settings', 'esell' ),
        'id'      => 'wc_sec_product',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'product_wc_single_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Layout', 'esell'), 
                'options'  => array(                    
                    '1'       => esc_html__( 'Layout 1', 'esell' ),
                    '2'        => esc_html__( 'Layout 2', 'esell' ),
                    '3'         => esc_html__( 'Layout 3', 'esell' ),                   
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'wc_show_excerpt',
                'type'     => 'switch',
                'title'    => esc_html__( "Show excerpt when short description doesn't exist", 'esell' ),
                'on'       => esc_html__( 'Enabled', 'esell' ),
                'off'      => esc_html__( 'Disabled', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'in_stock_avaibility',
                'type'     => 'switch',
                'title'    => esc_html__( 'In stock Avaibility', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Social Sharing', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'      => 'wc_share',
                'type'    => 'checkbox',
                'class'   => 'redux-custom-inline',
                'title'   => esc_html__( 'Social Sharing Icons', 'esell'), 
                'options' => array(
                    'facebook'  => 'Facebook',
                    'twitter'   => 'Twitter',
                    'linkedin'  => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'tumblr'    => 'Tumblr',
                    'reddit'    => 'Reddit',
                    'vk'        => 'Vk',
                ),
                'default' => array(
                    'facebook'  => '1',
                    'twitter'   => '1',
                    'linkedin'  => '1',
                    'pinterest' => '1',
                    'tumblr'    => '0',
                    'reddit'    => '1',
                    'vk'        => '0',
                ),
                'required' => array( 'wc_social', '=', true )
            ),
            array(
                'id'       => 'wc_product_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'esell' ),
            ),
            array(
                'id'       => 'wc_product_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'esell' ),
            ),
            array(
                'id'       => 'wc_product_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'esell' ),
            ),
            array(
                'id'       => 'wc_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description Tab', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_reviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'Reviews Tab', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_additional_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Additional Information Tab', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ), 
       
        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Cart Page', 'esell' ),
        'id'      => 'wc_sec_cart',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'wc_cross_sell',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross Sell Products', 'esell' ),
                'on'       => esc_html__( 'Show', 'esell' ),
                'off'      => esc_html__( 'Hide', 'esell' ),
                'default'  => true,
            ),
        )
    )
);

    Redux::setSection( $opt_name, array(
        'title'     => __( 'Shop Categories Header', 'esell' ),       
        'subsection' => true,
        'fields'    => array(
            array(
                'id'        => 'Categories_shop_header',
                'type'      => 'switch',
                'title'     => __( 'Shop Categories Bar', 'esell' ),
                'subtitle'  => __( 'Display filters bar ( categories ) above shop catalog.', 'esell' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),      

        array(
            'id'        => 'shop_categories_top_level',
            'type'      => 'select',
            'title'     => __( 'Display Type', 'esell' ),
            'options'   => array( '1' => 'Show top-level categories', '0' => 'Hide top-level categories' ),
            'default'   => '1',
            
        ),
        array(
            'id'        => 'shop_categories_back_link',
            'type'      => 'select',
            'title'     => __( '"Back" Link', 'esell' ),
            'subtitle'  => __( 'Display "Back" link on sub-category menus.', 'esell' ),
            'options'   => array( '0' => 'Disable', '1st' => 'Display', '2nd' => 'Display from second sub-category level' ),
            'default'   => '1st',
            'required'  => array( 'shop_categories_top_level', '=', '0' )
        ),
                      
            array(
                'id'        => 'shop_categories_hide_empty',
                'type'      => 'switch',
                'title'     => __( 'Hide Empty Categories', 'esell' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable',
                
            ),
            array(
                'id'        => 'shop_categories_orderby',
                'type'      => 'select',
                'title'     => __( 'Order By', 'esell' ),
                'options'   => array(
                    'id' => 'ID',
                    'name'          => 'Name/Menu-order',
                    'slug'          => 'Slug',
                    'count'         => 'Count',
                    'term_group'    => 'Term group'
                ),
                'default'   => 'slug',
                
            ),
            array(
                'id'        => 'shop_categories_order',
                'type'      => 'select',
                'title'     => __( 'Order', 'esell' ),
                'options'   => array( 'asc' => 'Ascending', 'desc' => 'Descending' ),
                'default'   => 'asc',
               
            ),           
          
           
        )
    ) );
