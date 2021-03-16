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
        'title' => esc_html__( 'WooCommerce Settings', 'uiart' ),
        'id'    => 'wc_secttings',
        'icon'  => 'el el-shopping-cart',
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Shop Page', 'uiart' ),
        'id'      => 'wc_sec_shop',
        'subsection' => true,
        'fields'  => array(
            array(
                'id' => 'shop_content_layout',
                'type' => 'switch',
                'title' => esc_html__('Shop Content Full Layout', 'uiart'),
                'on' => esc_html__('On', 'uiart'),
                'off' => esc_html__('Off', 'uiart'),
                'default' => false,
            ),  
            array(
                'id'       => 'wc_product_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Product Block Style', 'uiart'), 
                'options'  => array(
                    '1' => esc_html__( 'Style 1', 'uiart' ),
                    '2' => esc_html__( 'Style 2', 'uiart' ),
                    '3' => esc_html__( 'Style 3', 'uiart' ),
                    '4' => esc_html__( 'Style 4', 'uiart' ),
                   
                ),
                'default'  => '1',
            ),            

            array(
                'id'       => 'wc_tab_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Tab Product Columns', 'uiart'), 
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'uiart' ),
                    '6'  => esc_html__( '2 Col', 'uiart' ),
                    '4'  => esc_html__( '3 Col', 'uiart' ),
                    '3'  => esc_html__( '4 Col', 'uiart' ),
                    '2'  => esc_html__( '6 Col', 'uiart' ),
                ),
                'default'  => '6',
            ),
            array(
                'id'       => 'wc_mobile_product_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Product Columns', 'uiart'), 
                'options'  => array(
                    '12' => esc_html__( '1 Col', 'uiart' ),
                    '6'  => esc_html__( '2 Col', 'uiart' ),
                    '4'  => esc_html__( '3 Col', 'uiart' ),
                    '3'  => esc_html__( '4 Col', 'uiart' ),
                    '2'  => esc_html__( '6 Col', 'uiart' ),
                ),
                'default'  => '12',
            ), 
           

             array(
                'id'       => 'wc_shop_Product_img_size',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Columns Images 100% ', 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),


            array(
                'id'       => 'wc_num_product',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Page', 'uiart' ),
                'default'  => '9',
            ),
            array(
                'id'       => 'wc_pagination',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Pagination Type', 'uiart' ),
                'options'  => array(
                    'numbered'        => esc_html__( 'Numbered', 'uiart' ),
                    'load-more'       => esc_html__( 'Load More', 'uiart' ),
                    'infinity-scroll' => esc_html__( 'Infinity Scroll', 'uiart' ),
                ),
                'default'  => 'numbered'
            ),
            array(
                'id'       => 'wc_sale_label',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sale Product Label', 'uiart' ),
                'options'  => array(
                    'percentage' => esc_html__( 'Percentage', 'uiart' ),
                    'text'       => esc_html__( 'Text', 'uiart' ),
                ),
                'default'  => 'percentage'
            ),
            array(
                'id'       => 'wc_shop_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Category', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_review',
                'type'     => 'switch',
                'title'    => esc_html__( 'Review Star', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_shop_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'uiart' ),
            ),
            array(
                'id'       => 'wc_shop_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'uiart' ),
            ),
            array(
                'id'       => 'wc_shop_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'uiart' ),
            ),

            array(
                'id' => 'uiart_search_auto_suggest_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search', 'uiart'),
                
                'default' => true,
                'on' => esc_html__('Enable', 'uiart'),
                'off' => esc_html__('Disable', 'uiart'),
            ),
            array(
                'id' => 'uiart_search_img_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search With Image', 'uiart'),                
                'default' => true,
                'on' => esc_html__('Enable', 'uiart'),
                'off' => esc_html__('Disable', 'uiart'),
            ),
            array(
                'id' => 'uiart_search_auto_suggest_limit',
                'type' => 'text',
                'title' => esc_html__('Autosuggest Limit', 'uiart'),
                
                'default' => '10'
            ),

            array(
                'id' => 'wooc_search_auto_suggest_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search', 'uiart'),
                
                'default' => true,
                'on' => esc_html__('Enable', 'uiart'),
                'off' => esc_html__('Disable', 'uiart'),
            ),
            array(
                'id' => 'wooc_search_img_status',
                'type' => 'switch',
                'title' => esc_html__('Header Autosuggest Product Search With Image', 'uiart'),                
                'default' => true,
                'on' => esc_html__('Enable', 'uiart'),
                'off' => esc_html__('Disable', 'uiart'),
            ),

            array(
                'id' => 'wooc_search_auto_suggest_limit',
                'type' => 'text',
                'title' => esc_html__('Autosuggest Limit', 'uiart'),
                
                'default' => '10'
            ),

              array(
                'id'        => 'shop_filters_custom_controls',
                'type'      => 'switch',
                'title'     => __( 'Custom Controls', 'uiart' ),
                'subtitle'  => __( 'Display color/image swatches for variable-product attributes.', 'uiart' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_custom_controls',
                'type'      => 'switch',
                'title'     => __( 'Custom Controls', 'uiart' ),
                'subtitle'  => __( 'Display color/image swatches and size labels for variable-product attributes.', 'uiart' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_display_attributes',
                'type'      => 'switch',
                'title'     => __( 'Color/Image Swatches', 'uiart' ),
                'subtitle'  => __( 'Display color/image swatches for variable-product attributes.', 'uiart' ),
                'default'   => 0,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
              array(
                'id'        => 'product_hover_image_global',
                'type'      => 'switch',
                'title'     => __( 'Hover Image', 'uiart' ),
                'subtitle'  => __( 'Display the second gallery image when a product is "hovered".', 'uiart' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),
            array(
                'id'       => 'wooc_wc_product_filter_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Product Filter Type', 'uiart' ),
                'options'  => array(
                    'ajax' => esc_html__( 'Ajax', 'uiart' ),
                    'regular' => esc_html__( 'Regular', 'uiart' ),
                ),
                'default'  => 'regular',
            ), 

        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Product Page', 'uiart' ),
        'id'      => 'wc_sec_product',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'product_wc_single_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Layout', 'uiart'), 
                'options'  => array(
                    'default' => esc_html__( 'Default', 'uiart' ),
                    '1'       => esc_html__( 'Layout 1', 'uiart' ),
                    '2'        => esc_html__( 'Layout 2', 'uiart' ),
                    '3'         => esc_html__( 'Layout 3', 'uiart' ),                   
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'wc_show_excerpt',
                'type'     => 'switch',
                'title'    => esc_html__( "Show excerpt when short description doesn't exist", 'uiart' ),
                'on'       => esc_html__( 'Enabled', 'uiart' ),
                'off'      => esc_html__( 'Disabled', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'in_stock_avaibility',
                'type'     => 'switch',
                'title'    => esc_html__( 'In stock Avaibility', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Social Sharing', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'      => 'wc_share',
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
                    'reddit'    => '1',
                    'vk'        => '0',
                ),
                'required' => array( 'wc_social', '=', true )
            ),
            array(
                'id'       => 'wc_product_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quickview Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Quick View" must be enabled to use this feature', 'uiart' ),
            ),
            array(
                'id'       => 'wc_product_compare_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Compare Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Compare" must be enabled to use this feature', 'uiart' ),
            ),
            array(
                'id'       => 'wc_product_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Wishlist Icon', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
                'subtitle' => esc_html__( 'Plugin "YITH WooCommerce Wishlist" must be enabled to use this feature', 'uiart' ),
            ),
            array(
                'id'       => 'wc_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description Tab', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_reviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'Reviews Tab', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_additional_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Additional Information Tab', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ), 
       
        )
    )
);

Redux::setSection( $opt_name,
    array(
        'title'   => esc_html__( 'Cart Page', 'uiart' ),
        'id'      => 'wc_sec_cart',
        'subsection' => true,
        'fields'  => array(
            array(
                'id'       => 'wc_cross_sell',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross Sell Products', 'uiart' ),
                'on'       => esc_html__( 'Show', 'uiart' ),
                'off'      => esc_html__( 'Hide', 'uiart' ),
                'default'  => true,
            ),
        )
    )
);

    Redux::setSection( $opt_name, array(
        'title'     => __( 'Shop Categories Header', 'uiart' ),       
        'subsection' => true,
        'fields'    => array(
            array(
                'id'        => 'Categories_shop_header',
                'type'      => 'switch',
                'title'     => __( 'Shop Categories Bar', 'uiart' ),
                'subtitle'  => __( 'Display filters bar ( categories ) above shop catalog.', 'uiart' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable'
            ),      

        array(
            'id'        => 'shop_categories_top_level',
            'type'      => 'select',
            'title'     => __( 'Display Type', 'uiart' ),
            'options'   => array( '1' => 'Show top-level categories', '0' => 'Hide top-level categories' ),
            'default'   => '1',
            
        ),
        array(
            'id'        => 'shop_categories_back_link',
            'type'      => 'select',
            'title'     => __( '"Back" Link', 'uiart' ),
            'subtitle'  => __( 'Display "Back" link on sub-category menus.', 'uiart' ),
            'options'   => array( '0' => 'Disable', '1st' => 'Display', '2nd' => 'Display from second sub-category level' ),
            'default'   => '1st',
            'required'  => array( 'shop_categories_top_level', '=', '0' )
        ),
                      
            array(
                'id'        => 'shop_categories_hide_empty',
                'type'      => 'switch',
                'title'     => __( 'Hide Empty Categories', 'uiart' ),
                'default'   => 1,
                'on'        => 'Enable',
                'off'       => 'Disable',
                
            ),

            array(
                'id'        => 'shop_categories_orderby',
                'type'      => 'select',
                'title'     => __( 'Order By', 'uiart' ),
                'options'   => array(
                    'id' => 'ID',
                    'name'          => 'Name/Menu-order',
                    'slug'          => 'Slug',
                    'count'         => 'Count',
                    'term_group'    => 'Term group'
                ),
                'default'   => 'slug',
                
            ),
            array(
                'id'        => 'shop_categories_order',
                'type'      => 'select',
                'title'     => __( 'Order', 'uiart' ),
                'options'   => array( 'asc' => 'Ascending', 'desc' => 'Descending' ),
                'default'   => 'asc',
               
            ),           
          
           
        )
    ) );
