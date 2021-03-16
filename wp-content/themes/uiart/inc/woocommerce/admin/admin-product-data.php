<?php
/*
 *	WooCommerce admin: Product data
 */

namespace wooctheme\Uiart;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class WOOC_Product_Data {
    
    /*
	 * Constructor
	 */
	public function __construct() {
        // Attributes: Add setting
		add_action( 'woocommerce_after_product_attribute_settings', array( $this, 'product_attribute_settings' ), 1, 2 );
        
        // Attributes: Save setting
        add_action( 'woocommerce_update_product', array( $this, 'product_attribute_settings_save' ) );
        //Alt: add_action( 'wp_ajax_woocommerce_save_attributes', array( $this, 'ajax_product_attribute_settings_save' ), 0 ); // AJAX hook from "../woocommerce/includes/class-wc-ajax.php"
	}
        
    /*
     * Product data - Attribute settings: Include custom setting
     */
    public function product_attribute_settings( $attribute, $i ) {
        global $post, $wooc_globals;
        
        // Make sure the attribute is for a variation
        if ( isset( $attribute['variation'] ) && $attribute['variation'] == true ) {
            $attr = wooc_woocommerce_get_taxonomy_attribute( $attribute['name'] );
             // "wooc_woocommerce_get_taxonomy_attribute()" is in "../savoy/includes/woocommerce/woocommerce-attribute-functions.php"
            $custom_attr_types = array_keys( $wooc_globals['pa_variation_controls'] );
            
            if ( in_array( $attr->attribute_type, $custom_attr_types ) ) {
                // Get product ID
                if ( $post ) {
                    $product_id = $post->ID;
                } else if ( isset( $_POST['post_id'] ) ) {
                    $product_id = absint( wp_unslash( $_POST['post_id'] ) ); // $post is unavailbale when saving via AJAX - see "save_attributes()" in "../woocommerce/includes/class-wc-ajax.php"
                } else {
                    return;
                }

                // Get saved product meta
                $saved_data = get_post_meta( $product_id, 'wooc_attribute_catalog_visibility', true );
                $checked = ( $saved_data && isset( $saved_data[$attribute['name']] ) ) ? true : false;
                ?>
                <tr>
                    <td>
                        <label><input type="checkbox" class="checkbox" <?php checked( $checked, true ); ?> name="wooc_attribute_catalog_visibility[<?php echo esc_attr( $attribute['name'] ); ?>]" value="1" /> <?php esc_html_e( 'Show in product catalog', 'uiart' ); ?></label>
                    </td>
                </tr>
                <?php
            }
        }
    }   
    
    /*
     * Product data - Attribute settings: Save custom setting
     */
    public function product_attribute_settings_save( $product_id = null ) {
        $saved_data = null;
        
        // AJAX save
        if ( isset( $_POST['data'], $_POST['post_id'] ) ) {
            // Based on "save_attributes()" in "../woocommerce/includes/class-wc-ajax.php":
            
            check_ajax_referer( 'save-attributes', 'security' );
            
            $product_id = absint( wp_unslash( $_POST['post_id'] ) );
            parse_str( wp_unslash( $_POST['data'] ), $data );
            
            if ( isset( $data['wooc_attribute_catalog_visibility'] ) ) {
                $saved_data = $data['wooc_attribute_catalog_visibility'];
            }
        } 
        // Static save
        else {
            if ( isset( $_POST['wooc_attribute_catalog_visibility'] ) ) {
                $saved_data = $_POST['wooc_attribute_catalog_visibility'];
            }
        }
        
        // Update/delete product meta
        if ( $saved_data ) {
            update_post_meta( $product_id, 'wooc_attribute_catalog_visibility', $saved_data );
        } else {
            delete_post_meta( $product_id, 'wooc_attribute_catalog_visibility' );
        }
    }
}
$WOOC_Product_Data = new WOOC_Product_Data();
