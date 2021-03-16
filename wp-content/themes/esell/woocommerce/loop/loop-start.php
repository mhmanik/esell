<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$axil_options           = Helper::axil_get_options(); 
$products_class_wrp = '';
if ( $axil_options['wc_pagination'] == 'load-more' ) {
	$products_class_wrp .= ' axiltheme-loadmore-wrapper';
}
if ( $axil_options['wc_pagination'] == 'infinity-scroll' ) {
	$products_class_wrp .= ' axiltheme-infscroll-wrapper';
}
?>
<div class="products axiltheme-archive-products  row--30 row<?php echo esc_attr( $products_class_wrp );?>">