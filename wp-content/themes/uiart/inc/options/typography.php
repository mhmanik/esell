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
        'title'  => esc_html__( 'Typography', 'uiart' ),
        'id'     => 'typo_section',
        'icon'   => 'el el-text-width',
        'fields' => array(
            array(
                'id'       => 'typo_body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                    'font-size'   => '16px',
                    'line-height' => '28px',
                ),
            ),
            array(
                'id'       => 'typo_h1',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h1', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'    => false,
                'subsets'  => false,
                'default'  => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '32px',
                    'line-height' => '38px',
                ),
            ),
            array(
                'id'       => 'typo_h2',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h2', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '28px',
                    'line-height' => '32px',
                ),
            ),
            array(
                'id'       => 'typo_h3',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h3', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets' => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '22px',
                    'line-height' => '28px',
                ),
            ),
            array(
                'id'       => 'typo_h4',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h4', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '20px',
                    'line-height' => '26px',
                ),
            ),
            array(
                'id'       => 'typo_h5',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h5', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '18px',
                    'line-height' => '24px',
                ),
            ),
            array(
                'id'       => 'typo_h6',
                'type'     => 'typography',
                'title'    => esc_html__( 'Header h6', 'uiart' ),
                'text-align'  => false,
                'font-weight' => false,
                'color'   => false,
                'subsets'  => false,
                'default' => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '600',
                    'font-size'   => '15px',
                    'line-height' => '20px',
                ),
            ),
            array(
                'id'       => 'section-mainmenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Main Menu Items', 'uiart' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'menu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Menu Font', 'uiart' ),
                'text-align' => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '16px',
                    'line-height' => '26px',
                    'text-transform' => 'none',
                ),
            ),
            array(
                'id'       => 'section-submenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Sub Menu Items', 'uiart' ),
                'indent'   => true,
            ), 
            array(
                'id'       => 'submenu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Submenu Font', 'uiart' ),
                'text-align'   => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '14px',
                    'line-height' => '26px',
                    'text-transform' => 'none',
                ),
            ),
            array(
                'id'       => 'section-resmenu',
                'type'     => 'section',
                'title'    => esc_html__( 'Mobile Menu', 'uiart' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'resmenu_typo',
                'type'     => 'typography',
                'title'    => esc_html__( 'Mobile Menu Font', 'uiart' ),
                'text-align' => false,
                'color'   => false,
                'subsets'  => false,
                'text-transform' => true,
                'default'     => array(
                    'google'      => true,
                    'font-family' => 'Josefin Sans',
                    'font-weight' => '400',
                    'font-size'   => '14px',
                    'line-height' => '21px',
                    'text-transform' => 'none',
                ),
            ),
        )
    )
);