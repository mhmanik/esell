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
$product_class = '';
$attributes_escaped = function_exists( 'wooc_template_loop_attributes' ) ? wooc_template_loop_attributes() : null;
$product_class .= ( $attributes_escaped ) ? ' wooc-has-attributes' : '';
?>

<div class="wooc-product-layout wooc-product-layout-3">
	<div class="wooc-product-layout-wrapper">	
		<div class="wooc-thumb-wrapper">
			<div class="wooc-thumb">
				<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape bg-shape-color bg-shape-color2"></span>
				<?php
						/**
						* Product variation attributes
						*/
						if ( $attributes_escaped ) {
							$allowed_tags = wp_kses_allowed_html( 'post' );
							echo wp_kses( $attributes_escaped, $allowed_tags );
						}
					?>
				<?php
				if ( $block_data['gallery'] ) {
					echo WC_Functions::get_product_thumbnail_gallery( $product, $block_data['thumb_size'] );
				}
				else {
					echo WC_Functions::get_product_thumbnail_link( $product, $block_data['thumb_size'] );
				}
				?>
			</div>
			<?php woocommerce_show_product_loop_sale_flash();?>				
		</div>	
		<div class="wooc-title-area">
			<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_before_shop_loop_item_title' );?>
			<h3 class="wooc-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_after_shop_loop_item_title' );?>
		</div>

		<div class="wooc-price-area">
			<?php if ( $price_html = $product->get_price_html() ) : ?>			
				<div class="wooc-price"><?php echo wp_kses( $price_html, 'alltext_allow' ); ?></div>
			<?php endif; ?>		
		</div>
		
		<?php if ( $cat ): ?>
			<div class="wooc-cat"><?php echo esc_html( $cat );?></div>
		<?php endif; ?>

		<?php
			if ( $block_data['rating_display'] ) {
				wc_get_template( 'loop/rating.php' );
			}
		?>	
		<div class="wooc-buttons-area">
			<div class="wooc-buttons">
				<?php
				if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon();
					WC_Functions::wooc_print_add_to_cart_icon( true, true, true );
				if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon();
				?>
			</div>
		</div>	
	</div>
</div>