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
        'title'   => esc_html__( 'Error Page Settings', 'uiart' ),
        'id'      => 'error_settings_section',
        'heading' => '',
        'icon'    => 'el el-error-alt',
        'fields'  => array( 
            array(
                'id'       => 'error_bgimg',
                'type'     => 'media',
                'title'    => esc_html__( 'Background Image', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( '404bg.jpg' )
                ),
            ),
            array(
                'id'       => 'error_404img',
                'type'     => 'media',
                'title'    => esc_html__( '404 Image', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( '404.png' )
                ),
            ), 
            array(
                'id'       => 'error_text_1',
                'type'     => 'text',
                'title'    => esc_html__( 'Error Text 1', 'uiart' ),
                'default'  => esc_html__( "OPS! Under Construction", 'uiart' ),
            ),
            array(
                'id'       => 'error_text_2',
                'type'     => 'text',
                'title'    => esc_html__( 'Error Text 2', 'uiart' ),
                'default'  => esc_html__( "Try going to Home Page by using the button below.", 'uiart' ),
            ), 
            array(
                'id'       => 'error_buttontext',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'uiart' ),
                'default'  => esc_html__( 'Go To Home Page', 'uiart' ),
            )
        )
    )
);