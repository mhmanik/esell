<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

$query = $settings['query'];

if ( !empty( $settings['cat'] ) ) {
	$shop_permalink = get_category_link( $settings['cat'] );
}
else {
	$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
}

$block_data = array(
	'layout'         => $settings['style'],
	'cat_display'    => $settings['cat_display'] ? true : false,
	'rating_display' => $settings['rating_display'] ? true : false,	
	'gallery'        => false,
);

?>
<div class="wooc-product-slider woocue-style-<?php echo esc_attr( $settings['style'] );?>">
	
	<?php if ( $settings['section_title_display'] ): ?>
		<div class="wooc-slider-title-block-1">
			<div class="wooc-title-block">
				<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
				<div class="clear"></div>
				<h3 class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
			</div>	
			<?php if ( $settings['islink'] ): ?>
				<div class="woocue-view-btn">
					<a href="<?php echo esc_url( $shop_permalink ); ?>"><?php echo wp_kses_post( $settings['btntext'] );?><i class="flaticon-play-button"></i></a>
				</div>		
			<?php endif; ?>		
		</div>
	<?php endif; ?>

	<?php if ( $query->have_posts() ) :?>
		<div class="row" >
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				$id = get_the_ID();
				$product = wc_get_product( $id );
				wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
			}
			?>
		</div>
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>