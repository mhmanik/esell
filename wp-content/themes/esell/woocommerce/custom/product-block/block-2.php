<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */



$id  = $product->get_id();
$cat = $block_data['cat_display'] ? WC_Functions::get_top_category_name() : false;
$product_shape_color = get_post_meta( $id, 'bgshapecolor', true );
if($product_shape_color){
	$product_shape_color = $product_shape_color;
}else{
	$product_shape_color = "#fffaf6";
}
// Product variation attributes
$attributes_escaped = function_exists( 'wooc_template_loop_attributes' ) ? wooc_template_loop_attributes() : null;
$product_class ="";
$product_class .= ( $attributes_escaped ) ? ' wooc-has-attributes' : '';
?>
<div class="axil-product product-style-two">
    <div class="thumbnail">    	
            <?php  echo WC_Functions::get_product_thumbnail_link( $product, $block_data['thumb_size'] ); ?>        
            <?php woocommerce_show_product_loop_sale_flash();?>        
    </div>
    <div class="product-content">
        <div class="inner">
        	<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_before_shop_loop_item_title' );?>
				<h5 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
			<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_after_shop_loop_item_title' );?>
            <div class="product-price-variant">
	        	<?php if ( $price_html = $product->get_price_html() ) : ?>				
					<div class="price"><?php echo wp_kses( $price_html, 'alltext_allow' );?></div>
				<?php endif; ?>
            </div>

            <div class="color-variant-wrapper">
            <?php					
			if ( $attributes_escaped ) {			   
			    $allowed_tags = wp_kses_allowed_html( 'post' );
                 echo wp_kses( $attributes_escaped, $allowed_tags );
			}
			?>  
            </div>
        </div>
        <div class="product-hover-action">
            <ul class="cart-action">
                <li class="wishlist"><?php if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon(); ?></li>
                <li class="add-to-cart"><?php WC_Functions::wooc_print_add_to_cart_icon( true, true, true ); ?></li>
                <li class="quickview"><?php if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon(); ?></li>
            </ul>
        </div>
    </div>
</div>

