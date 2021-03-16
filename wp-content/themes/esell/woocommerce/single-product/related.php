<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
if ( $related_products ){
	$axil_options           = Helper::axil_get_options(); 
	$layout = $axil_options['product_wc_single_layout'] ? $axil_options['product_wc_single_layout'] : '1';
	if ($layout == '2') { ?>		  
		<?php
			$before_heading = apply_filters( 'woocommerce_product_related_products_before_heading', esc_html__( '- Your Recently', 'esell' ) );
			$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Viewed Items', 'esell' ) );
			//WC_Functions::product_slider( $related_products, $heading, $before_heading );						
			WC_Functions::product_grid( $related_products, $heading, $before_heading );						
		}else{ 				
			$before_heading = apply_filters( 'woocommerce_product_related_products_before_heading', esc_html__( '- Your Recently', 'esell' ) );
			$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Viewed Items', 'esell' ) );
			//WC_Functions::product_slider( $related_products, $heading, $before_heading );				
			WC_Functions::product_grid( $related_products, $heading, $before_heading );				
	}
} 
wp_reset_postdata();?>

