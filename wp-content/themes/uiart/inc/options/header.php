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
        'title'   => esc_html__( 'Header', 'uiart' ),
        'id'      => 'header_section',
        'heading' => '',
        'icon'    => 'el el-flag',
        'fields'  => array(
            array(
                'id'       => 'resmenu_width',
                'type'     => 'slider',
                'title'    => esc_html__( 'Responsive Header Screen Width', 'uiart' ),
                'subtitle' => esc_html__( 'Screen width in which mobile menu activated. Recommended value is: 991', 'uiart' ),
                'default'  => 991,
                'min'      => 0,
                'step'     => 1,
                'max'      => 2000,
            ),
            array(
                'id'       => 'sticky_menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Show header at the top when scrolling down', 'uiart' ),
            ), 


            array(
                'id'       => 'has_offcanvas',
                'type'     => 'switch',
                'title'    => esc_html__( 'Offcanvas', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Show header at the top when scrolling down', 'uiart' ),
            ),
           
              array(
                'id'       => 'offcanvas_logo',
                'type'     => 'switch',
                'title'    => esc_html__( 'Offcanvas Logo', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => True,
                 'required' => array( 'has_offcanvas', 'equals', true )      
            ),
             array(
                'id'       => 'offcanvas_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Offcanvas Menu Title', 'uiart' ),                
                'default'  => '',     
                 'required' => array( 'has_offcanvas', 'equals', true )          
            ), 
             array(
                'id'       => 'offcanvas_sub_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Offcanvas Sub Title', 'uiart' ),                
                'default'  => 'Follow Us',       
                 'required' => array( 'has_offcanvas', 'equals', true )              
            ),

            array(
                'id'       => 'offcanvas_socials',
                'type'     => 'switch',
                'title'    => esc_html__( 'Offcanvas Socials Icon', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                 'required' => array( 'has_offcanvas', 'equals', true )      
                
            ),

            
            array(
                'id'       => 'top_bar',
                'type'     => 'switch',
                'title'    => esc_html__( 'Top Bar', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => false,
            ),

            array(
                'id'       => 'top_bar_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Top Bar Layout', 'uiart' ),
                'default'  => '1',
                'options' => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'top1.png' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'top2.png' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'top3.png' ),
                    ), 
                    '4' => array(
                        'title' => '<b>'. esc_html__( 'Layout 4', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'top3.png' ),
                    ),
                ),
                'required' => array( 'top_bar', '=', true )
            ),

            array(
                'id' => 'left_txt1',
                'type' => 'text',
                'title' => esc_html__('Left Text 1', 'uiart'),
                 'default' => 'Store Location',
                 'required' => array( 'top_bar', 'equals', true )   
            ), 
            array(
                'id' => 'left_txt2',
                'type' => 'text',
                'title' => esc_html__('Left Text 2', 'uiart'),
                'default' => 'Order Status',
                 'required' => array( 'top_bar', 'equals', true )   
            ),
            array(
                'id' => 'left_txt3',
                'type' => 'textarea',
                'title' => esc_html__('Left Text 2', 'uiart'),
                'default' => 'Order Status',
                 'required' => array( 'top_bar', 'equals', true )   
            ),

            array(
                'id'       => 'header_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header Layout', 'uiart' ),
                'default'  => '1',
                'options' => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-1.png' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-2.png' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-3.png' ),
                    ),
                    '4' => array(
                        'title' => '<b>'. esc_html__( 'Layout 4', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-4.png' ),
                    ),
                   '5' => array(
                        'title' => '<b>'. esc_html__( 'Layout 5', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-4.png' ),
                    ),
                   '6' => array(
                        'title' => '<b>'. esc_html__( 'Layout 6', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'header-4.png' ),
                    ),
                  
                ),
            ),       
           

            array(
                'id'       => 'search_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Search', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'account_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Login/Account', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),

            array(
                'id' => 'signin_txt',
                'type' => 'text',
                'title' => esc_html__('Log In button Text', 'uiart'),

                'default' => 'Login',
                 'required' => array( 'account_icon', 'equals', true )   
            ), 
            array(
                'id' => 'signout_txt',
                'type' => 'text',
                'title' => esc_html__('Log out button Text', 'uiart'),

                'default' => 'Logout',
                 'required' => array( 'account_icon', 'equals', true )   
            ),

            array(
                'id'       => 'cart_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cart Icon', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),


            array(
                'id'       => 'banner',
                'type'     => 'switch',
                'title'    => esc_html__( 'Banner', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'banner_search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Banner Search', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'bgtype',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Banner Background Type', 'uiart' ),
                'options'  => array(
                    'bgcolor'  => esc_html__( 'Background Color', 'uiart' ),
                    'bgimg'    => esc_html__( 'Background Image', 'uiart' ),
                    'texttype'    => esc_html__( 'Text Type', 'uiart' ),
                ),
                'default' => 'bgcolor',
                'required' => array( 'banner', 'equals', true )
            ),
            array(
                'id'       => 'bgcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Banner Background Color', 'uiart'), 
                'validate' => 'color',
                'transparent' => false,
                'default' => '#0e283f',
                'required' => array( 'bgtype', 'equals', 'bgcolor' )
            ),
            array(
                'id'       => 'bgimg',
                'type'     => 'media',
                'title'    => esc_html__( 'Banner Background Image', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'banner.jpg' )
                ),
                'required' => array( 'bgtype', 'equals', 'bgimg' )
            ), 
            array(
                'id'       => 'bgopacity',
                'type'     => 'slider',
                'title'    => esc_html__( 'Banner Background Opacity (in %)', 'uiart' ),
                'min'      => 0,
                'max'      => 100,
                'step'     => 1,
                'default'  => 0,
                'display_value' => 'label',
                'required' => array( 'bgtype', 'equals', 'bgimg' )
            ), 
        )
    ) 
);