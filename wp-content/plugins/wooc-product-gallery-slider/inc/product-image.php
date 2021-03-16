<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;
$warvertical = wooc_get_option('navVertical', 'wooc_settings', 'false');
$navPosition = wooc_get_option('navPosition', 'wooc_settings', 'left');
$post_thumbnail_id = $product->get_image_id();
$image         = wp_get_attachment_image($post_thumbnail_id, 'shop_single', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image" ));

$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
    'wooc',
    'wooc--' . (has_post_thumbnail() ? 'with-images' : 'without-images'),
    'wooc-v' . $warvertical,
    'wooc-v' . $navPosition,
    'images',

));

 $attachment_ids = $product->get_gallery_image_ids() ;
 if ( $attachment_ids && has_post_thumbnail() ) {
    $has_post_thumbnail = "wooc-has-post-thumbnail";
 }else{
    $has_post_thumbnail = "wooc-none-post-thumbnail";
 }
?>

<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
<?php

if( $warvertical != 'false' ){
        if( $navPosition != 'right' ){
          
         do_action( 'woocommerce_product_thumbnails' );
           
        }
        if (has_post_thumbnail()) {
           echo '<div class="woocue-gallery-right ' .$has_post_thumbnail .'">         
           <div class="wooc-for">';

            $attachment_ids = $product->get_gallery_image_ids();
            $lightbox_src = wc_get_product_attachment_props($post_thumbnail_id);
           
            echo '<div class="woocommerce-product-gallery__image single-product-main-image"><a class="venobox"  title="'.$lightbox_src['title'].'" data-gall="wooc-lightbox" href="'.$lightbox_src['url'].'" >' . $image . '</a></div> ';

            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                     $thumbnail_image     = wp_get_attachment_image($attachment_id, 'shop_single');
                     $lightbox_src = wc_get_product_attachment_props($attachment_id);
                    // fw_print($thumbnail_src);
                      echo '<a class="venobox" data-gall="wooc-lightbox" title="'.$lightbox_src['title'].'" href="'.$lightbox_src['url'].'" >' . $thumbnail_image . '</a>';

                }
            }
            echo "</div></div>";
        } else {
            $html = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
            $html .= '</div>';
        }
        
        if( $navPosition != 'left' ){
           
                do_action( 'woocommerce_product_thumbnails' );
           
        }

//echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);

}else{

  if (has_post_thumbnail()) {
           echo '<div class="woocue-gallery-top"><div class="wooc-for">';
            $attachment_ids = $product->get_gallery_image_ids();

            $lightbox_src = wc_get_product_attachment_props($post_thumbnail_id);
           
            echo '<div class="woocommerce-product-gallery__image single-product-main-image"><a class="venobox"  title="'.$lightbox_src['title'].'" data-gall="wooc-lightbox" href="'.$lightbox_src['url'].'" >' . $image . '</a></div> ';

            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                     $thumbnail_image     = wp_get_attachment_image($attachment_id, 'shop_single');
                     $lightbox_src = wc_get_product_attachment_props($attachment_id);
                    // fw_print($thumbnail_src);
                      echo '<a class="venobox" data-gall="wooc-lightbox" title="'.$lightbox_src['title'].'" href="'.$lightbox_src['url'].'" >' . $thumbnail_image . '</a>';

                }
            }
            echo "</div></div>";
        } else {
            $html = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
            $html .= '</div>';
        }

    //echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);

   
        do_action( 'woocommerce_product_thumbnails' );


}

?>

</div>

			