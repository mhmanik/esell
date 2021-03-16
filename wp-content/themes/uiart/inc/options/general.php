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
        'title'   => esc_html__( 'General', 'uiart' ),
        'id'      => 'general_section',
        'heading' => '',
        'icon'    => 'el el-network',
        'fields'  => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Main Logo', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-dark.png' )
                ),
            ),
            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Light Logo', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-light.png' )
                ),
                'subtitle' => esc_html__( 'Used when Transparent Header is enabled', 'uiart' ),
            ), 
            array(
                'id'       => 'mobile_logo_small',
                'type'     => 'media',
                'title'    => esc_html__( 'Mobile Logo', 'uiart' ),
                'default'  => array(
                    'url'=> Helper::get_img( 'logo-dark-small.png' )
                ),
                'subtitle' => esc_html__( 'Used when mobile Header is enabled', 'uiart' ),
            ),
            array(
                'id'       => 'logo_width',
                'type'     => 'select',
                'title'    => esc_html__( 'Logo Area Width', 'uiart'), 
                'subtitle' => esc_html__( 'Width is defined by the number of bootstrap columns. Please note, navigation menu width will be decreased with the increase of logo width', 'uiart' ),
                'options'  => array(
                    '1' => esc_html__( '1 Column', 'uiart' ),
                    '2' => esc_html__( '2 Column', 'uiart' ),
                    '3' => esc_html__( '3 Column', 'uiart' ),
                    '4' => esc_html__( '4 Column', 'uiart' ),
                ),
                'default'  => '3',
            ),
            array(
                'id'       => 'logo_height',
                'type'     => 'slider',
                'title'    => esc_html__( 'Logo Height', 'uiart' ),
                'subtitle' => esc_html__( 'Maximum height of logo. Recommended value is: 53', 'uiart' ),
                'default'  => 53,
                'min'      => 0,
                'step'     => 1,
                'max'      => 700,
            ),
            array(
                'id'       => 'breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Image', 'uiart' ),
                'subtitle' => esc_html__( 'Please upload your choice of preloader image. Transparent GIF format is recommended', 'uiart' ),
                'default'  => "",
                'required' => array( 'preloader', 'equals', true )
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top Arrow', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
        )            
    ) 
);