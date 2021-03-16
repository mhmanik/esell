<?php

/* 
 * WooCommerce - Attribute functions
=============================================================== */
use wooctheme\Uiart\WOOCTheme;
global $wooc_globals;


/*
 * Product attribute: Get properties
 *
 * Note: Code from "get_tax_attribute()" function in the "../variation-swatches-for-woocommerce.php" file of the "Variation Swatches for WooCommerce" plugin
 */
function wooc_woocommerce_get_taxonomy_attribute( $taxonomy ) {
    global $wpdb, $wooc_globals;

    // Returned cached data if available
    if ( isset( $wooc_globals['pa_cache'][$taxonomy] ) ) {
        return $wooc_globals['pa_cache'][$taxonomy];
    }

    $attr = substr( $taxonomy, 3 );
    $attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = '$attr'" );

    // Save data to avoid multiple database calls
    $wooc_globals['pa_cache'][$taxonomy] = $attr;

    return $attr;
}



/*
 *  Widget: Filter Products by Attribute - Include custom elements
 */


//if ( isset(WOOCTheme::$options['shop_filters_custom_controls'] ) ) {
    function wooc_woocommerce_layered_nav_count( $term_html, $term, $link, $count ) {
        global $wooc_globals;

        // Get attribute type
        $attr = wooc_woocommerce_get_taxonomy_attribute( $term->taxonomy );
        $attr_type = ( $attr ) ? $attr->attribute_type : '';
        
        $custom_html = null;
        
        
        // Type: Color
        if ( 'color' == $attr_type || 'pa_' . $wooc_globals['pa_color_slug'] == $term->taxonomy ) {
            // Save data in global variable to avoid getting the "wooc_pa_colors" option multiple times
            if ( ! isset( $wooc_globals['pa_colors'] ) ) {
                $wooc_globals['pa_colors'] = get_option( 'wooc_pa_colors' );
            }

            $id = $term->term_id;

            $color = ( isset( $wooc_globals['pa_colors'][$id] ) ) ? $wooc_globals['pa_colors'][$id] : '#c0c0c0';
            $custom_html = '<i style="background:' . esc_attr( $color ) . ';" class="wooc-pa-color wooc-pa-color-' . esc_attr( strtolower( $term->slug ) ) . '"></i>';
        }
        // Type: Image
        else if ( 'image' == $attr_type ) {
            $image_id = absint( get_term_meta( $term->term_id, 'wooc_pa_image_thumbnail_id', true ) );
            
            if ( $image_id ) {
                $image_url = wp_get_attachment_url( $image_id );
                $custom_html = '<div class="wooc-pa-image-thumbnail-wrap">
                <img src="' . esc_url( $image_url ) . '" class="wooc-pa-image-thumbnail" alt=""></div>';
            }
        }
        
        
        if ( $custom_html ) {
            // Code from "layered_nav_list()" function in "../plugins/woocommerce/includes/widgets/class-wc-widget-layered-nav.php" file
            if ( $count > 0 ) {
                $term_html = '<a rel="nofollow" href="' . $link . '">' . $custom_html . esc_html( $term->name ) . '</a>';
            } else {
                $term_html = '<span>' . $custom_html . esc_html( $term->name ) . '</span>';
            }
        }
        
        return $term_html;
    }
    add_filter( 'woocommerce_layered_nav_term_html', 'wooc_woocommerce_layered_nav_count', 1, 4 );
//}



/*
 *  Product variations: Get variation image src
 */
function wooc_woocommerce_get_variation_image_src( $available_variations, $attribute_name ) {
    foreach( $available_variations as $variation ) {
        if ( isset( $variation['attributes']['attribute_' . $attribute_name] ) ) {
            return $variation['image']['thumb_src'];
        }
    }
    
    return null;
}


function wooc_template_loop_attributes( $product = null ) {
    global $wooc_globals;
    
    if ( ! $product ) {
    }
    global $product;
    
    if ( ! $product->is_type( 'variable' ) ) {
        return;
    }

    $product_id = $product->get_id();
    $enabled_globaly = WOOCTheme::$options['product_display_attributes'];
    $enabled_globaly_attribute_types = apply_filters( 'wooc_product_display_attribute_types', array( 'color' => '1', 'image' => '1' ) ); // Excluding "size" by default
    $enabled_attributes = get_post_meta( $product_id, 'wooc_attribute_catalog_visibility', true );
    
    if ( $enabled_globaly || $enabled_attributes ) {
        $available_variations   = $product->get_available_variations();
        $attributes             = $product->get_variation_attributes();
        $html                   = '';

        if ( ! empty( $available_variations ) ) {
            $product_url = get_permalink( $product_id );

            $html .= '<div class="wooc-shop-loop-attributes">';

             foreach ( $attributes as $attribute_name => $options ) {
                 $attr = wooc_woocommerce_get_taxonomy_attribute( $attribute_name );
                $attr_type = ( $attr ) ? $attr->attribute_type : null;

                if ( ! $attr_type ) {
                    continue;
                }
                
                // Only display custom attributes
                $is_custom_attribute = ( $enabled_globaly ) ? isset( $enabled_globaly_attribute_types[$attr_type] ) : isset( $enabled_attributes[$attribute_name] );

                if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute_name ) ) {
                    $attributes = $product->get_variation_attributes();
                    $options    = $attributes[$attribute_name];
                }


               if ( $is_custom_attribute && ! empty( $options ) ) {
                    $terms = wc_get_product_terms( $product_id, $attribute_name, array( 'fields' => 'all' ) );
                    $variation_image_src = wooc_woocommerce_get_variation_image_src( $available_variations, $attribute_name );
              

                    switch ( $attr_type ) {
                        // Type: Color swatch
                        case 'color' :

                            // Save data in global variable to avoid getting the "wooc_pa_colors" option multiple times
                            if ( ! isset( $wooc_globals['pa_colors'] ) ) {
                                $wooc_globals['pa_colors'] = get_option( 'wooc_pa_colors' );
                            }

                            $html .= '<div class="wooc-shop-loop-attribute wooc-shop-loop-attribute-color">';

                            foreach ( $terms as $term ) {
                                if ( in_array( $term->slug, $options, true ) ) {
                                    $url = $product_url . '?attribute_' . $attribute_name . '=' . $term->slug;
                                    $color = ( isset( $wooc_globals['pa_colors'][$term->term_id] ) ) ? $wooc_globals['pa_colors'][$term->term_id] : '#ccc';                                     

                                    //$html .= '<a href="' . esc_url( $url ) . '" data-variation-image-src="' . esc_url( $variation_image_src )  . '">';
                                    $html .= '<a href="' . esc_url( $url ) . '">';
                                    $html .= '<i style="background:' . esc_attr( $color ) . ';" class="wooc-pa-color wooc-pa-color-' . esc_attr( strtolower( $term->slug ) ) . '"></i>';                   
                                    $html .= '</a>';
                                }
                            }

                            break;
                        // Type: Image swatch
                        case 'image' :

                            $html .= '<div class="wooc-shop-loop-attribute wooc-shop-loop-attribute-image">';

                            foreach ( $terms as $term ) {
                                if ( in_array( $term->slug, $options, true ) ) {
                                    $url = $product_url . '?attribute_' . $attribute_name . '=' . $term->slug;
                                    $image_id = absint( get_term_meta( $term->term_id, 'wooc_pa_image_thumbnail_id', true ) );
                                    $image_url = ( $image_id ) ? wp_get_attachment_url( $image_id ) : '';

                                    //$html .= '<a href="' . esc_url( $url ) . '" data-variation-image-src="' . esc_url( $variation_image_src )  . '">';
                                    $html .= '<a href="' . esc_url( $url ) . '">';
                                    $html .= '<div class="wooc-pa-image-thumbnail-wrap"><img src="' . esc_url( $image_url ) . '" class="wooc-pa-image-thumbnail" alt=""></div>';   
                                    $html .= '</a>';
                                }
                            }

                            break;
                        // Type: Label
                        default :

                            $html .= '<div class="wooc-shop-loop-attribute wooc-shop-loop-attribute-label">';

                            foreach ( $terms as $term ) {
                                if ( in_array( $term->slug, $options, true ) ) {
                                    $url = $product_url . '?attribute_' . $attribute_name . '=' . $term->slug;

                                    //$html .= '<a href="' . esc_url( $url ) . '" data-variation-image-src="' . esc_url( $variation_image_src )  . '">';
                                    $html .= '<a href="' . esc_url( $url ) . '">';
                                    $html .= '<span>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</span>';
                                    $html .= '</a>';
                                }
                            }
                    }

                    $html .= '</div>';
                }
            }

            $html .= '</div>';
            
            return $html;
        }
    }

    
    return null;
}


$template_include_action = apply_filters( 'wooc_template_loop_attributes_above_thumbnail', 'woocommerce_before_shop_loop_item' );
add_action( $template_include_action, 'wooc_template_loop_attributes', 5 );
