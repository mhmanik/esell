<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

global $product;
$product_id      = $product->get_id();
$is_in_wishlist  = YITH_WCWL()->is_product_in_wishlist( $product_id, false );
$wishlist_url    = YITH_WCWL()->get_wishlist_url();

$title_before = esc_html__( 'Add to Wishlist', 'uiart' );
$title_after  = esc_html__( 'Aleady exists in Wishlist! Click here to view Wishlist', 'uiart' );
if ( $is_in_wishlist ) {
	$class      = 'wooctheme-remove-from-wishlist';
	$icon_font  = 'flaticon-heart-2';
	$title      = $title_after;
}
else {
	$class      = 'wooctheme-add-to-wishlist';
	$icon_font  = 'flaticon-favorite-1';
	$title      = $title_before;
}
$html = '';
if ( $icon ) {
	$html .= '<i class="wishlist-icon '.$icon_font.'"></i>';
}
$html .= '<img class="ajax-loading" alt="spinner" src="'.Helper::get_img( 'wishlist.gif' ).'">';
if ( $text ) {
	$html .= '<span>' . esc_html__( 'WishList', 'uiart' ) . '</span>';
}
$nonce =  wp_create_nonce( 'uiart_wishlist_nonce' );
 $allowed_tags = wp_kses_allowed_html( 'post' );  
?>
<a href="<?php echo esc_url( $wishlist_url );?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $title );?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id );?>" data-title-after="<?php echo esc_attr( $title_after );?>" class="wooctheme-wishlist-icon <?php echo esc_attr( $class );?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" target="_blank">	
	<?php echo wp_kses( $html, $allowed_tags ); ?>
</a>