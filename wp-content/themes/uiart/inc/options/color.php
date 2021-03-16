<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use \Redux;

$opt_name = Constants::$theme_options;

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Colors', 'uiart' ),
        'id'      => 'color_section',
        'heading' => '',
        'icon'    => 'el el-eye-open',
        'fields'  => array(
            array(
                'id'       => 'section-color-sitewide',
                'type'     => 'section',
                'title'    => esc_html__( 'Sitewide Colors', 'uiart' ),
                'indent'   => true,
            ),
          
          
            array(
                'id'       => 'sitewide_color',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Other Colors', 'uiart' ),
                'options'  => array(
                    'primary' => esc_html__( 'Primary Color', 'uiart' ),
                    'custom'  => esc_html__( 'Custom', 'uiart' ),
                ),
                'default'  => 'primary',
                'subtitle' => esc_html__( 'Selecting Primary Color will hide some color options from the below settings and replace them with Primary Color', 'uiart' ),
            ),

              array(
                'id'       => 'primary_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Primary Color', 'uiart' ),
                'default'  => '#e53935',
                
            ),


            array(
                'id'       => 'section-color-menu',
                'type'     => 'section',
                'title'    => esc_html__( 'Main Menu', 'uiart' ),
                'indent'   => true,
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'menu_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Menu Color', 'uiart' ),
                'default'  => '#0E283F',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'section-color-submenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Sub Menu', 'uiart' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'submenu_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Color', 'uiart' ),
                'default'  => '#0E283F',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'submenu_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Hover Color', 'uiart' ),
                'default'  => '#ffffff',
            ), 
            array(
                'id'       => 'submenu_hover_bgcolor',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Submenu Hover Background Color', 'uiart' ),
                'default'  => '#0E283F',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'section-color-banner',
                'type'     => 'section',
                'title'    => esc_html__( 'Banner/Breadcrumb Area', 'uiart' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'banner_title_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Banner Title Color', 'uiart' ),
                'default'  => '#fff',
            ),
            array(
                'id'       => 'breadcrumb_link_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Link Color', 'uiart' ),
                'default'  => '#fff',
            ),
            array(
                'id'       => 'breadcrumb_link_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Link Hover Color', 'uiart' ),
                'default'  => '#fe7656',
                'required' => array( 'sitewide_color', '=', 'custom' )
            ),
            array(
                'id'       => 'breadcrumb_active_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Active Breadcrumb Color', 'uiart' ),
                'default'  => '#fe7656',
            ),
            array(
                'id'       => 'breadcrumb_seperator_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Breadcrumb Seperator Color', 'uiart' ),
                'default'  => '#686868',
            ),
            array(
                'id'       => 'section-color-footer',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Area', 'uiart' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'footer_bgcolor',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Background Color', 'uiart' ),
                'default'  => '#fff',
            ), 
            array(
                'id'       => 'footer_title_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Title Text Color', 'uiart' ),
                'default'  => '#0E283F',
            ), 
            array(
                'id'       => 'footer_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Text Color', 'uiart' ),
                'default'  => '#cccccc',
            ), 
            array(
                'id'       => 'footer_link_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Link Color', 'uiart' ),
                'default'  => '#cccccc',
            ), 
            array(
                'id'       => 'footer_link_hover_color',
                'type'     => 'color',
                'transparent' => false,
                'title'    => esc_html__( 'Footer Body Link Hover Color', 'uiart' ),
                'default'  => '#ffffff',
            ),
        )
    )
);