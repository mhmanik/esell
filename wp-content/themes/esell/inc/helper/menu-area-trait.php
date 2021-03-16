<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */
trait MenuAreaTrait
{
    // Nav Menu Call
    public static function axil_nav_menu_args()
    {
        $axil_nav_menu_args = array(
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'mainmenu-nav d-none d-lg-block',
            'menu_class' => 'mainmenu',
            'menu_id' => 'main-menu',
            'fallback_cb' => false,
            'walker' => new AxilNavWalker(),
        );

        return $axil_nav_menu_args;
    }
    // Mobile Menu
    public static function axil_mobile_menu_args()
    {
        $nav_menu_args = array(
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'menu-item',
            'menu_class' => 'mainmenu-item',
            'menu_id' => 'mobile-menu',
            'fallback_cb' => false,
            'walker' => new AxilMobileWalker(),
        );

        return $nav_menu_args;
    }

    // Footer bottom Menu args
    public static function axil_heaedr_top_menu_args()
    {
        $axil_heaedr_top_menu_args = array(
            'theme_location' => 'headertop',
            'container' => '',
            'menu_class' => "quick-link",
            'depth' => 1,
            'fallback_cb' => false
        );

        return $axil_heaedr_top_menu_args;
    }

    // Off-Canvas Menu args
    public static function axil_offcanvas_menu_args()
    {
        $axil_offcanvas_menu_args = array(
            'theme_location' => 'offcanvas',
            'container' => 'div',
            'menu_class' => "main-navigation",
            'fallback_cb' => false
        );

        return $axil_offcanvas_menu_args;
    }

    // Footer bottom Menu args
    public static function axil_footer_bottom_menu_args()
    {
        $axil_footer_bottom_menu_args = array(
            'theme_location' => 'footerbottom',
            'container' => '',
            'menu_class' => "quick-link",
            'depth' => 1,
            'fallback_cb' => false
        );

        return $axil_footer_bottom_menu_args;
    }

}