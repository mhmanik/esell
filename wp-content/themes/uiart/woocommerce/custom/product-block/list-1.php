<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

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
$product_class = ( $attributes_escaped ) ? ' wooc-has-attributes' : '';

?>
<div class="wooc-product-list wooc-product-list-1">
	<div class="woocue-thumb-wrapper wooc-thumb-wrapper">
		<?php
			/**
			* Product variation attributes
			*/
			if ( $attributes_escaped ) {				
					$allowed_tags = wp_kses_allowed_html( 'post' );
                 	echo wp_kses( $attributes_escaped, $allowed_tags );
			}
		?>
		<a href="<?php echo esc_attr( $product->get_permalink() );?>" class="woocue-thumb">
		<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape bg-shape-color bg-shape-color2"></span>
			<?php echo WC_Functions::get_product_thumbnail( $product, $block_data['thumb_size'] );?>
		</a>
		<?php woocommerce_show_product_loop_sale_flash();?>
		<?php if ( $cat ): ?>
			<div class="woocue-cat"><?php echo esc_html( $cat );?></div>
		<?php endif; ?>
	</div>

	<div class="woocue-content">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
		<h3 class="woocue-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
		<?php if ( $price_html = $product->get_price_html() ) : ?>			
			<div class="woocue-price"><?php echo wp_kses( $price_html, 'alltext_allow' ); ?></div>
		<?php endif; ?>
		<?php
		if ( $block_data['rating_display'] ) {
			wc_get_template( 'loop/rating.php' );
		}
		?>	
		<div class="woocue-excerpt"><?php the_excerpt();?></div>
		<div class="woocue-buttons">
			<?php
			WC_Functions::wooc_print_add_to_cart_icon(true, true, false);
			if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon();
			if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon();
			if ( $block_data['compare'] ) WC_Functions::print_compare_icon();
			?>
		</div>		
	</div>
</div>