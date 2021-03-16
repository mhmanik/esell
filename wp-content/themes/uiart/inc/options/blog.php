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
        'title'   => esc_html__( 'Blog Settings', 'uiart' ),
        'id'      => 'blog_settings_section',
        'icon'    => 'el el-tags',
        'heading' => '',
        'fields'  => array(
            array(
                'id'       =>'blog_style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog/Archive Layout', 'uiart' ),
                'default'  => '1',
                'options'  => array(
                    '1' => array(
                        'title' => '<b>'. esc_html__( 'Layout 1', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'blog1.jpg' ),
                    ),
                    '2' => array(
                        'title' => '<b>'. esc_html__( 'Layout 2', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'blog2.jpg' ),
                    ),
                    '3' => array(
                        'title' => '<b>'. esc_html__( 'Layout 3', 'uiart' ) . '</b>',
                        'img'   => Helper::get_img( 'blog3.png' ),
                    ),
                ),
            ),
            array(
                'id'       => 'blog_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Date', 'uiart' ),
                'on'       => esc_html__( 'On', 'uiart' ),
                'off'      => esc_html__( 'Off', 'uiart' ),
                'default'  => true,
            ), 
            array(
                'id'       => 'blog_author_name',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Author Name', 'uiart' ),
                'on'       => esc_html__( 'On', 'uiart' ),
                'off'      => esc_html__( 'Off', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_comment_num',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Comment Number', 'uiart' ),
                'on'       => esc_html__( 'On', 'uiart' ),
                'off'      => esc_html__( 'Off', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Categories', 'uiart' ),
                'on'       => esc_html__( 'On', 'uiart' ),
                'off'      => esc_html__( 'Off', 'uiart' ),
                'default'  => true,
            ),
        )
    ) 
);