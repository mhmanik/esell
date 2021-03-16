<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */


global $product;
$product_id      = $product->get_id();
$is_in_wishlist  = YITH_WCWL()->is_product_in_wishlist( $product_id, false );
$wishlist_url    = YITH_WCWL()->get_wishlist_url();

$title_before = esc_html__( 'Add to Wishlist', 'esell' );
$title_after  = esc_html__( 'Aleady exists in Wishlist! Click here to view Wishlist', 'esell' );
if ( $is_in_wishlist ) {
	$class      = 'axiltheme-remove-from-wishlist';
	$icon_font  = 'fas fa-heart';
	$title      = $title_after;
}
else {
	$class      = 'axiltheme-add-to-wishlist';
	$icon_font  = 'far fa-heart';
	$title      = $title_before;
}
$html = '';
if ( $icon ) {
	$html .= '<i class="wishlist-icon '.$icon_font.'"></i>';
}
$html .= '<img class="ajax-loading" alt="spinner" src="'.Helper::get_img( 'wishlist.gif' ).'">';
if ( $text ) {
	$html .= '<span>' . esc_html__( 'WishList', 'esell' ) . '</span>';
}
$nonce =  wp_create_nonce( 'esell_wishlist_nonce' );
 $allowed_tags = wp_kses_allowed_html( 'post' );  
?>
<a href="<?php echo esc_url( $wishlist_url );?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $title );?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id );?>" data-title-after="<?php echo esc_attr( $title_after );?>" class="axil-btn btn-outline btn-icon axiltheme-wishlist-icon <?php echo esc_attr( $class );?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" target="_blank">	
	<?php echo wp_kses( $html, $allowed_tags ); ?>
</a>