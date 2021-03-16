<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$id  = $product->get_id();
$cat = $block_data['cat_display'] ? WC_Functions::get_top_category_name() : false;
// Product variation attributes
$attributes_escaped = function_exists( 'wooc_template_loop_attributes' ) ? wooc_template_loop_attributes() : null;
$product_class =  '';
$product_class .= ( $attributes_escaped ) ? ' wooc-has-attributes' : '';

?>
<div class="wooc-product-layout wooc-product-layout-2">
	<div class="woocue-thumb-wrapper wooc-thumb-wrapper">
		<div class="woocue-thumb ">
		<?php woocommerce_show_product_loop_sale_flash();		
		 						
			if ( $attributes_escaped ) {	
				 $allowed_tags = wp_kses_allowed_html( 'post' );
                 echo wp_kses( $attributes_escaped, $allowed_tags );
			}	
			if ( $block_data['gallery'] ) {
				echo WC_Functions::get_product_thumbnail_gallery( $product, $block_data['thumb_size'] );
			}
			else {
				echo WC_Functions::get_product_thumbnail_link( $product, $block_data['thumb_size'] );
			}

		?>
		<?php if ( $cat ): ?>
			<div class="woocue-cat"><?php echo esc_html( $cat );?></div>
		<?php endif; ?>
		<?php if ( $block_data['wishlist'] ) WC_Functions::print_add_to_wishlist_icon(); ?>		
		</div>				
			<div class="woocue-contents">
			<?php
				if ( $block_data['rating_display'] ) {
					wc_get_template( 'loop/rating.php' );
				}
			?>	
			<div class="woocue-title-wrp">
				<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_before_shop_loop_item_title' );?>
				<h3 class="woocue-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<?php if ( WC_Functions::is_product_archive() ) do_action( 'woocommerce_after_shop_loop_item_title' );?>
				
			</div>

			<div class="woocue-price-area">
				<div class="woocue-left">
					<?php if ( $price_html = $product->get_price_html() ) : ?>						
						<div class="woocue-price"><?php echo wp_kses( $price_html, 'alltext_allow' ); ?></div>
					<?php endif; ?>
					<?php WC_Functions::wooc_print_add_to_cart_icon( true, true, false );
					if ( $block_data['quickview'] ) WC_Functions::print_quickview_icon(); ?>

				</div>				
			</div>
			
		</div>
	</div>	
</div>