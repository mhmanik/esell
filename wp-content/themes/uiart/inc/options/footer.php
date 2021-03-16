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
        'title'   => esc_html__( 'Footer', 'uiart' ),
        'id'      => 'footer_section',
        'heading' => '',
        'icon'    => 'el el-caret-down',
        'fields'  => array(
          
             array(
                'id'       => 'footer_area',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer Area', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),

            array(
                'id'       => 'footer_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer Layout', 'uiart' ),
                'default'  => '1',
                'options' => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'footer-1.png' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'footer-2.png' ),
                    ),     
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'footer-3.png' ),
                    ),   
                    '4' => array(
                        'title' => '<b>'. esc_html__( 'Layout 4', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'footer-3.png' ),
                    ), 
                    '5' => array(
                        'title' => '<b>'. esc_html__( 'Layout 5', 'uiart' ) . '</b>',
                        'img' => Helper::get_img( 'footer-3.png' ),
                    ),                   
                ),
                'required' => array( 'footer_area', '=', true )
            ),



        array(
                'id'       => 'footer_top_area',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer Top Area', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),

             array(
                'id'       => 'footer_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Footer Logo', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-dark.png' )
                ),

            ),
             array(
                'id'       => 'footer_logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Footer Logo Light', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-light.png' )
                ),

            ),

            array(
                'id'       => 'copyright_area',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Copyright Area', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'copyright_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright Text', 'uiart' ),
                'default'  => sprintf( '&copy; Copyright Uiart %s. Designed by <a target="_blank" href="%s" rel="nofollow">WoocTheme</a>' , date('Y'), esc_url( Constants::$theme_author_uri ) ),
                'required' => array( 'copyright_area', 'equals', true )
            ),



            array(
                'id'       => 'social_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Social Icons', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
                'required' => array( 'copyright_area', 'equals', true )
            ),
            array(
                'id'       => 'mail_chimp_layout',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Footer MailChimp Area', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => false,
            ),
          
            array(
                'id'       => 'mail_chimp_styles',
                'type'     => 'select',
                'title'    => esc_html__( 'MailChimp Layouts', 'uiart'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'uiart' ),                                    
                ),
                'default'  => '1',
                'required' => array( 'mail_chimp_layout', 'equals', true )
            ),
                             
            array(
                'id'       => 'mail_shortcode',
                'type'     => 'text',
                'title'    => esc_html__('Enter Mail Chimp Shortcode', 'uiart'),                
                'default'  => esc_html__('[contact-form-7 id="5" title="newsletter"]', 'uiart'),
                'required' => array( 'mail_chimp_layout', 'equals', true )
            ),
        
          
            array(
                'id'       => 'nav_menu_args',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Menu', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => false,                
            ),

            array(
                'id'       => 'payment_icons',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Payment Icons', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => false,                
            ),

            array(
                'id'       => 'payment_img',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Payment Icons Gallery', 'uiart' ),
                'required' => array( 'payment_icons', 'equals', true )
            ),
             array(
                'id'       => 'footer_bottom_styles',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Layouts', 'uiart'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'uiart' ),
                    '2' => esc_html__( 'Style 2', 'uiart' ),                                   
                ),
                'default'  => '1',
                'required' => array( 'payment_icons', 'equals', true )
            ),
            
              array(
                'id'       => 'icon_class_1',
                'type'     => 'media',
                'title'    => esc_html__( 'Icon One', 'uiart' ),
                'default'  => '',
                'required' => array( 'footer_style', 'equals', '4' )

            ),
            
            array(
                'id'       => 'title_class_1',
                'type'     => 'text',
                'title'    => esc_html__( 'Title One', 'uiart' ),       
                'default'  => 'Free Ship Worldwide',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),
            array(
                'id'       => 'content_class_1',
                'type'     => 'text',
                'title'    => esc_html__( 'Content One', 'uiart' ),       
                'default'  => 'In ac hendrerit turpis aliqu am ultrices dolor dolor.',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),
            
            array(
                'id'       => 'icon_class_2',
                'type'     => 'media',
                'title'    => esc_html__( 'Icon Two', 'uiart' ),
                'default'  => '',
                'required' => array( 'footer_style', 'equals', '4' )

            ),
              array(
                'id'       => 'title_class_2',
                'type'     => 'text',
                'title'    => esc_html__( 'Title Two', 'uiart' ),       
                'default'  => 'Special Offers',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),
            array(
                'id'       => 'content_class_2',
                'type'     => 'text',
                'title'    => esc_html__( 'COntent Two', 'uiart' ),       
                'default'  => 'In ac hendrerit turpis aliqu am ultrices dolor dolor.',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),

            array(
                'id'       => 'icon_class_3',
                'type'     => 'media',
                'title'    => esc_html__( 'Icon Three', 'uiart' ),
                'default'  => '',
                'required' => array( 'footer_style', 'equals', '4' )

            ),
          
            array(
                'id'       => 'title_class_3',
                'type'     => 'text',
                'title'    => esc_html__( 'Title Three', 'uiart' ),       
                'default'  => 'Order Protection',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),
            array(
                'id'       => 'content_class_3',
                'type'     => 'text',
                'title'    => esc_html__( 'COntent Three', 'uiart' ),       
                'default'  => 'In ac hendrerit turpis aliqu am ultrices dolor dolor.',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),

            array(
                'id'       => 'icon_class_4',
                'type'     => 'media',
                'title'    => esc_html__( 'Icon Four', 'uiart' ),
                'default'  => '',
                'required' => array( 'footer_style', 'equals', '4' )

            ),        
            array(
                'id'       => 'title_class_4',
                'type'     => 'text',
                'title'    => esc_html__( 'Title Four', 'uiart' ),       
                'default'  => '24/7 Online Support',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),
            array(
                'id'       => 'content_class_4',
                'type'     => 'text',
                'title'    => esc_html__( 'COntent Four', 'uiart' ),       
                'default'  => 'In ac hendrerit turpis aliqu am ultrices dolor dolor.',        
                'required' => array( 'footer_style', 'equals', '4' )
            ),

         
        )
    )
);