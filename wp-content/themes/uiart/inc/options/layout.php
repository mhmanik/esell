<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use \Redux;

$opt_name = Constants::$theme_options;


function wooctheme_redux_post_type_fields( $prefix ){
    return array(
        'layout' => array(
            'id'       => $prefix. '_layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'uiart' ),
            'options'  => array(
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'uiart' ),
                'full-width'    => esc_html__( 'Full Width', 'uiart' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'uiart' ),
            ),
            'default'  => 'right-sidebar'
        ),

        'sidebar' => array(
            'id'       => $prefix. '_sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Custom Sidebar', 'uiart' ),
            'options'  => Helper::custom_sidebar_fields(),
            'default'  => 'sidebar',
            'required' => array( $prefix. '_layout', '!=', 'full-width' ),
        ),
        'wrapper_full' => array(
            'id'       => $prefix. '_wrapper_full',
            'type'     => 'select',
            'title'    => esc_html__( 'Wrapper Full', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'on'      => esc_html__( 'Enabled', 'uiart' ),
                'off'     => esc_html__( 'Disabled', 'uiart' ),
            ),
            'default'  => 'off',
        ),
        'section_spacing' => array(
            'id'       => $prefix. '_section_spacing',
            'type'     => 'select',
            'title'    => esc_html__( 'Section Spacing', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'on'      => esc_html__( 'Enabled', 'uiart' ),
                'off'     => esc_html__( 'Disabled', 'uiart' ),
            ),
            'default'  => 'default',
        ),  
        'header_type' => array(
            'id'       => $prefix. '_header_transparent',
            'type'     => 'select',
            'title'    => esc_html__( 'Transparent Header', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'on'      => esc_html__( 'Enabled', 'uiart' ),
                'off'     => esc_html__( 'Disabled', 'uiart' ),
            ),
            'default'  => 'default',
        ),
        
        'header_style' => array(
            'id'       => $prefix. '_header_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Layout', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                '1'       => esc_html__( 'Layout 1', 'uiart' ),
                '2'       => esc_html__( 'Layout 2', 'uiart' ),
                '3'       => esc_html__( 'Layout 3', 'uiart' ),
                '4'       => esc_html__( 'Layout 4', 'uiart' ),             
            ),
            'default'  => 'default',
        ),  
        'footer_style' => array(
            'id'       => $prefix. '_footer_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer Layout', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                '1'       => esc_html__( 'Layout 1', 'uiart' ),
                '2'       => esc_html__( 'Layout 2', 'uiart' ),
              
            ),
            'default'  => 'default',
        ),
        'banner' => array(
            'id'       => $prefix. '_banner',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'on'      => esc_html__( 'Enabled', 'uiart' ),
                'off'     => esc_html__( 'Disabled', 'uiart' ),
            ),
            'default'  => 'default',
        ),
        'breadcrumb' => array(
            'id'       => $prefix. '_breadcrumb',
            'type'     => 'select',
            'title'    => esc_html__( 'Breadcrumb', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'on'      => esc_html__( 'Enabled', 'uiart' ),
                'off'     => esc_html__( 'Disabled', 'uiart' ),
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgtype' => array(
            'id'       => $prefix. '_bgtype',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner Background Type', 'uiart'), 
            'options'  => array(
                'default' => esc_html__( 'Default',  'uiart' ),
                'bgcolor'  => esc_html__( 'Background Color', 'uiart' ),
                'bgimg'    => esc_html__( 'Background Image', 'uiart' ),
                'texttype'    => esc_html__( 'Text Type', 'uiart' ),                 
            ),
            'default'  => 'default',
            'required' => array( $prefix. '_banner', '!=', 'off' )
        ),
        'bgimg' => array(
            'id'       => $prefix. '_bgimg',
            'type'     => 'media',
            'title'    => esc_html__( 'Banner Background Image', 'uiart' ),
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgimg' ),
        ),
        'bgcolor' => array(
            'id'       => $prefix. '_bgcolor',
            'type'     => 'color',
            'title'    => esc_html__( 'Banner Background Color', 'uiart'), 
            'validate' => 'color',
            'transparent' => false,
            'default'  => '',
            'required' => array( $prefix. '_bgtype', '=', 'bgcolor' ),
        ),
    );
}

Redux::setSection( $opt_name,
    array(
        'title' => esc_html__( 'Layout Defaults', 'uiart' ),
        'id'    => 'layout_defaults',
        'icon'  => 'el el-th',
    )
);

// Page
$wooctheme_page_fields = wooctheme_redux_post_type_fields( 'page' );
$wooctheme_page_fields['layout']['default'] = 'full-width';
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Page', 'uiart' ),
        'id'         => 'pages_section',
        'subsection' => true,
        'fields'     => $wooctheme_page_fields     
    )
);

//Post Archive
$wooctheme_post_archive_fields = wooctheme_redux_post_type_fields( 'blog' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Blog / Archive', 'uiart' ),
        'id'         => 'blog_section',
        'subsection' => true,
        'fields'     => $wooctheme_post_archive_fields
    )
);

// Single Post
$wooctheme_single_post_fields = wooctheme_redux_post_type_fields( 'single_post' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Post Single', 'uiart' ),
        'id'         => 'single_post_section',
        'subsection' => true,
        'fields'     => $wooctheme_single_post_fields           
    ) 
);

// Search
$wooctheme_search_fields = wooctheme_redux_post_type_fields( 'search' );
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Search Layout', 'uiart' ),
        'id'         => 'search_section',
        'subsection' => true,
        'fields'     => $wooctheme_search_fields            
    )
);

// Error 404 Layout
$wooctheme_error_fields = wooctheme_redux_post_type_fields( 'error' );
unset($wooctheme_error_fields['layout']);
$wooctheme_error_fields['banner']['default'] = 'off';
Redux::setSection( $opt_name,
    array(
        'title'      => esc_html__( 'Error 404 Layout', 'uiart' ),
        'id'         => 'error_section',
        'subsection' => true,
        'fields'     => $wooctheme_error_fields           
    )
);

// Woocommerce
if ( class_exists( 'WooCommerce' ) ) {

    $fields = array(  
    array(
        'id' => 'woocommerce_header',
        'type' => 'switch',
        'title' => esc_html__('WooCommerce Default Header', 'tact'),
        'on' => esc_html__('On', 'tact'),
        'off' => esc_html__('Off', 'tact'),
        'default' => false,
    ),  

);

$fields2 = wooctheme_redux_post_type_fields( 'shop' );
$wooctheme_shop_archive_fields = array_merge($fields2, $fields);

    // Woocommerce Shop Archive
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Shop', 'uiart' ),
            'id'         => 'shop_section',
            'subsection' => true,
            'fields'     => $wooctheme_shop_archive_fields
        ) 
    );

    // Woocommerce Product
    $wooctheme_product_fields = wooctheme_redux_post_type_fields( 'product' );
    $wooctheme_product_fields['layout']['default'] = 'full-width';
    Redux::setSection( $opt_name,
        array(
            'title'      => esc_html__( 'Product', 'uiart' ),
            'id'         => 'product_section',
            'subsection' => true,
            'fields'     => $wooctheme_product_fields
        ) 
    );
}

