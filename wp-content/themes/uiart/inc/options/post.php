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
        'title'   => esc_html__( 'Post Settings', 'uiart' ),
        'id'      => 'post_settings_section',
        'icon'    => 'el el-file-edit',
        'heading' => '',
        'fields'  => array(
            array(
                'id'      => 'post_date',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Post Date', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ),
            array(
                'id'      => 'post_author_name',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Author Name', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ),
            array(
                'id'      => 'post_comment_num',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Comment Number', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ), 
            array(
                'id'      => 'post_cats',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Categories', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ),
            array(
                'id'      => 'post_tags',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Tags', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ),
            array(
                'id'      => 'post_social',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Social Sharing', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => true,
            ),
            array(
                'id'      => 'post_share',
                'type'    => 'checkbox',
                'class'   => 'redux-custom-inline',
                'title'   => esc_html__( 'Social Sharing Icons', 'uiart'), 
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
                    'reddit'    => '0',
                    'vk'        => '0',
                ),
                'required' => array( 'post_social', '=', true )
            ),
            array(
                'id'      => 'post_about_author',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display About Author', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => false,
            ),
            array(
                'id'      => 'post_pagination',
                'type'    => 'switch',
                'title'   => esc_html__( 'Display Previous/Next Post Link', 'uiart' ),
                'on'      => esc_html__( 'On', 'uiart' ),
                'off'     => esc_html__( 'Off', 'uiart' ),
                'default' => false,
            ),
        )
    )
);