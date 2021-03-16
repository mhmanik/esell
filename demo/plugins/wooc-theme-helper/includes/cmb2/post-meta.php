<?php
/**
 * @author  Wooctheme
 * @since   1.0
 * @version 1.0
 * @package wooctheme-theme-helper
 */


use wooctheme\Uiart\Helper;

class wooctheme_metabox
{
    public function __construct()
    {
        // Register widget areas.
        add_action('cmb2_admin_init', array(
            $this,
            'wooctheme_metabox',
        ));
    }

    public function wooctheme_metabox()
    {
        $nav_menus = wp_get_nav_menus(array('fields' => 'id=>name'));
        $nav_menus = array('default' => esc_html__('Default', 'wooctheme-theme-helper')) + $nav_menus;
        $sidebars = array('default' => esc_html__('Default', 'wooctheme-theme-helper')) + Helper::custom_sidebar_fields();
        $prefix = WOOCTHEME_THEME_HELPER_THEME;

        // metabox for page Mata Layout
        $cmb2_Page_MataLayout = new_cmb2_box(array(
            'id' => $prefix . '_layout_settings',
            'title' => esc_html__('Content Layout Settings', 'wooctheme-theme-helper'),
            'object_types' => array('page', 'post', 'product'), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        ));
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Content Layout', 'wooctheme-theme-helper'),
            'id' => 'layout',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                'full-width' => esc_html__('Full Width', 'wooctheme-theme-helper'),
                'left-sidebar' => esc_html__('Left Sidebar', 'wooctheme-theme-helper'),
                'right-sidebar' => esc_html__('Right Sidebar', 'wooctheme-theme-helper')
            ),
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Custom Sidebar', 'wooctheme-theme-helper'),
            'id' => 'sidebar',
            'type' => 'select',
            'default' => 'default',
            'options' => $sidebars,
        ));

        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Page Menu', 'wooctheme-theme-helper'),
            'id' => 'page_menu',
            'type' => 'select',
            'default' => 'default',
            'options' => $nav_menus,
        ));
       
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Section Spacing', 'wooctheme-theme-helper'),
            'id' => 'section_spacing',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                'on' => esc_html__('Enable', 'wooctheme-theme-helper'),
                'off' => esc_html__('Disable', 'wooctheme-theme-helper'),
            ),
        ));
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Wrapper Full', 'wooctheme-theme-helper'),
            'id' => 'wrapper_full',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                'on' => esc_html__('Enable', 'wooctheme-theme-helper'),
                'off' => esc_html__('Disable', 'wooctheme-theme-helper'),
            ),
        )); 
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Transparent Header', 'wooctheme-theme-helper'),
            'id' => 'header_transparent',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                'on' => esc_html__('Enable', 'wooctheme-theme-helper'),
                'off' => esc_html__('Disable', 'wooctheme-theme-helper'),
            ),
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Display Header', 'wooctheme-theme-helper'),
            'id' => 'header_area',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                'on' => esc_html__('Enable', 'wooctheme-theme-helper'),
                'off' => esc_html__('Disable', 'wooctheme-theme-helper'),
            ),
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Header Layout', 'wooctheme-theme-helper'),
            'id' => 'header_style',
            'type' => 'radio_image',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                '1' => esc_html__('Layout 1', 'wooctheme-theme-helper'),
                '2' => esc_html__('Layout 2', 'wooctheme-theme-helper'),
                '3' => esc_html__('Layout 3', 'wooctheme-theme-helper'),
                '4' => esc_html__('Layout 4', 'wooctheme-theme-helper'),
                '5' => esc_html__('Layout 5', 'wooctheme-theme-helper'),
                '6' => esc_html__('Layout 6', 'wooctheme-theme-helper'),

            ),
            'images_path' => get_template_directory_uri(),
            'images' => array(
                'default' => 'assets/img/header.png',
                '1' => 'assets/img/header-1.png',
                '2' => 'assets/img/header-2.png',
                '3' => 'assets/img/header-3.png',
                '4' => 'assets/img/header-4.png',
                '5' => 'assets/img/header-4.png',
                '6' => 'assets/img/header-4.png',

            ),
        ));

        $cmb2_Page_MataLayout->add_field(array(
            'name'      => esc_html__('Top Bar', 'wooctheme-theme-helper'),
            'id'        => 'top_bar',
            'type'      => 'select',
            'default' => 'default',
            'options' => array(
                'default'   => esc_html__('Default', 'wooctheme-theme-helper'),
                'on'        => esc_html__('Enable', 'wooctheme-theme-helper'),
                'off'       => esc_html__('Disable', 'wooctheme-theme-helper'),
            ),
        ));

        $cmb2_Page_MataLayout->add_field(array(
            'name'        => esc_html__('Top Layout', 'wooctheme-theme-helper'),
            'id'          => 'top_bar_style',
            'type'        => 'radio_image',
            'default'     => 'default',
            'options'     => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                '1' => esc_html__('Layout 1', 'wooctheme-theme-helper'),
                '2' => esc_html__('Layout 2', 'wooctheme-theme-helper'),
                '3' => esc_html__('Layout 3', 'wooctheme-theme-helper'),                

            ),
            'images_path' => get_template_directory_uri(),
            'images' => array(
                'default' => 'assets/img/header.png',
                '1' => 'assets/img/header-1.png',
                '2' => 'assets/img/header-2.png',
                '3' => 'assets/img/header-3.png',              

            ),
        ));

        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Banner', 'wooctheme-theme-helper'),
            'id' => 'banner',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => __('Default', 'wooctheme-theme-helper'),
                'on' => __('Enable', 'wooctheme-theme-helper'),
                'off' => __('Disable', 'wooctheme-theme-helper'),
            ),
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Breadcrumb', 'wooctheme-theme-helper'),
            'id' => 'breadcrumb',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => __('Default', 'wooctheme-theme-helper'),
                'on' => __('Enable', 'wooctheme-theme-helper'),
                'off' => __('Disable', 'wooctheme-theme-helper'),
            ),
        ));

        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Banner Background Type', 'wooctheme-theme-helper'),
            'id' => 'bgtype',
            'type' => 'select',
            'default' => 'default',
            'options' => array(
                'default' => __('Default', 'esell-elements'),
                'bgimg' => __('Background Image', 'esell-elements'),
                'bgcolor' => __('Background Color', 'esell-elements'),
                'texttype' => __('Text Type', 'esell-elements'),
            ),
        ));
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Banner Bg Color', 'abctw-theme-helper'),
            'desc' => esc_html__('Select Banner Background Color', 'abctw-theme-helper'),
            'id' => 'bgcolor',
            'type' => 'colorpicker',
            'default' => '',
        ));
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Banner Background Image', 'abctw-theme-helper'),
            'desc' => esc_html__('Upload a banner image', 'abctw-theme-helper'),
            'id' => 'bgimg',
            'type' => 'file',
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Footer Layout', 'wooctheme-theme-helper'),
            'id' => 'footer_style',
            'type' => 'radio_image',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                '1' => esc_html__('Layout 1', 'wooctheme-theme-helper'),
                '2' => esc_html__('Layout 2', 'wooctheme-theme-helper'),
                '3' => esc_html__('Layout 3', 'wooctheme-theme-helper'),
                '4' => esc_html__('Layout 4', 'wooctheme-theme-helper'),
                '5' => esc_html__('Layout 5', 'wooctheme-theme-helper'),

            ),
            'images_path' => get_template_directory_uri(),
            'images' => array(
                'default' => 'assets/img/footer.png',
                '1' => 'assets/img/footer-1.png',
                '2' => 'assets/img/footer-2.png',
                '3' => 'assets/img/footer-3.png',
                '4' => 'assets/img/footer-3.png',
                '5' => 'assets/img/footer-3.png',

            ),
        ));

        // metabox for page Mata Layout
        $cmb2_Page_MataLayout = new_cmb2_box(array(
            'id' => $prefix . '_pshape_settings',
            'title' => esc_html__('Products Shapa Background', 'wooctheme-theme-helper'),
            'object_types' => array('product'), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        ));


        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Shapa Background', 'abctw-theme-helper'),
            'desc' => esc_html__('Select Background Shapa color', 'abctw-theme-helper'),
            'id' => 'bgshapecolor',
            'type' => 'colorpicker',
            'default' => '#ffffff',
        ));
        $cmb2_Page_MataLayout->add_field(array(
            'name' => esc_html__('Product Layout', 'wooctheme-theme-helper'),
            'id' => 'wc_single_layout',
            'type' => 'radio_image',
            'default' => 'default',
            'options' => array(
                'default' => esc_html__('Default', 'wooctheme-theme-helper'),
                '1' => esc_html__('Layout 1', 'wooctheme-theme-helper'),
                '2' => esc_html__('Layout 2', 'wooctheme-theme-helper'),
                '3' => esc_html__('Layout 3', 'wooctheme-theme-helper'),

            ),
            'images_path' => get_template_directory_uri(),
            'images' => array(
                'default' => 'assets/img/header-footer-equipment/header-default.jpg',
                '1' => 'assets/img/header-footer-equipment/header-default.jpg',
                '2' => 'assets/img/header-footer-equipment/header-default.jpg',
                '3' => 'assets/img/header-footer-equipment/header-default.jpg',

            ),
        ));
    }
}

new wooctheme_metabox();
