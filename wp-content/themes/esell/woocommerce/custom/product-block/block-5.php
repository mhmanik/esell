<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell;

$id  = $product->get_id();
$cat = $block_data['cat_display'] ? WC_Functions::get_top_category_name() : false;

$product_shape_color = get_post_meta( $id, 'bgshapecolor', true );
if($product_shape_color){
	$product_shape_color = $product_shape_color;
}else{
	$product_shape_color = "#fffaf6";
}
// Product variation attributes
$product_class = "";
$attributes_escaped = function_exists( 'wooc_template_loop_attributes' ) ? wooc_template_loop_attributes() : null;
$product_class .= ( $attributes_escaped ) ? ' wooc-has-attributes' : '';
$rating_count = $product->get_rating_count();

?>
<div class="wooc-product-layout wooc-product-layout-5">
	<div class="wooc-product-layout-wrapper">	
		<div class="wooc-thumb-wrapper">
			<div class="wooc-thumb">
				<?php					
					if ( $attributes_escaped ) {						
						$allowed_tags = wp_kses_allowed_html( 'post' );
                 		echo wp_kses( $attributes_escaped, $allowed_tags );
					}
				?>
				<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape bg-shape-color bg-shape-color2"></span>
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

			<div class="wooc-buttons-area">
				<div class="wooc-buttons">
					<div class="wooc-button-left">				
						<?php WC_Functions::wooc_print_add_to_cart_icon( true, true, false ); ?>
					</div>
					<div class="wooc-button-right">
						 <?php if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon();?>
						<?php if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon(); ?>	
					</div>
				</div>
			</div>		
				
		</div>
		
		<?php if ( $price_html = $product->get_price_html() ) : ?>		
		<div class="wooc-price-area">
			<?php if ( $price_html = $product->get_price_html() ) : ?>				
				<div class="wooc-price"><?php echo wp_kses( $price_html, 'alltext_allow' ); ?></div>
			<?php endif; ?>	

			<?php
			if ( $block_data['rating_display'] ) {
				if ( $rating_count > 0 ) : 
				echo "<span class='dividar'> / </span>";
				wc_get_template( 'loop/rating.php' );
			 endif; 
			}
		?>	
		
		</div>
		<?php endif; ?>	
		<div class="wooc-title-area">
			<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_before_shop_loop_item_title' );?>
			<h3 class="wooc-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_after_shop_loop_item_title' );?>
		</div>

		<?php if ( $cat ): ?>
			<div class="wooc-cat"><?php echo esc_html( $cat );?></div>
		<?php endif; ?>	
		
	</div>
</div>