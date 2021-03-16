<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.

global $product;

$post_thumbnail_id = $product->get_image_id();

if( wtpgsHelper::wooc_woocommerce_version_check() ) {
    // Use new, updated functions
     $attachment_ids = $product->get_gallery_image_ids() ;
} else {
    // Use older, deprecated functions
     $attachment_ids = $product->get_gallery_attachment_ids() ;
}

$gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
$warvertical = wooc_get_option('navVertical', 'wooc_settings', 'false');
$thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));

if ( $attachment_ids && has_post_thumbnail() ) {

	if( $warvertical != 'false' ){
 	    echo '<div class="woocue-gallery-left">';
		echo '<div class="wooc-nav">';
		$image         = wp_get_attachment_image($post_thumbnail_id, 'shop_thumbnail',true);
		echo '<div>'.$image.'</div>';

		foreach ( $attachment_ids as $attachment_id ) {
			 $thumbnail_image     = wp_get_attachment_image($attachment_id, $thumbnail_size);
	            
	              echo '<div>' . $thumbnail_image . '</div>';
		}
		echo "</div>";
	echo "</div>";
	}else{
		echo '<div class="woocue-gallery-bottom">';
			echo '<div class="wooc-nav">';
			$image         = wp_get_attachment_image($post_thumbnail_id, 'shop_thumbnail',true);
			echo '<div>'.$image.'</div>';

			foreach ( $attachment_ids as $attachment_id ) {
				 $thumbnail_image     = wp_get_attachment_image($attachment_id, $thumbnail_size);
		            
		              echo '<div>' . $thumbnail_image . '</div>';
			}
		echo "</div>";
	echo "</div>";

	}

}
