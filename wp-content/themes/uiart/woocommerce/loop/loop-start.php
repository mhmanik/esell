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

use wooctheme\Uiart\WOOCTheme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wooctheme_class = '';
if ( WOOCTheme::$options['wc_pagination'] == 'load-more' ) {
	$wooctheme_class .= ' wooctheme-loadmore-wrapper';
}
if ( WOOCTheme::$options['wc_pagination'] == 'infinity-scroll' ) {
	$wooctheme_class .= ' wooctheme-infscroll-wrapper';
}
?>
<div class="products wooctheme-archive-products row<?php echo esc_attr( $wooctheme_class );?>">
