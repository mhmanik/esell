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
$sub_title       = $settings['sub_title'] ? ' sub_title' : ' no-sub_title';

$block_data = array(
	'layout'         => $settings['style'],
	'cat_display'    => $settings['cat_display'] ? true : false,
	'rating_display' => $settings['rating_display'] ? true : false,	
	'gallery'        => false,	
	'v_swatch'       => true,
);
$count = 1;
$i = 0;
?>
<div class="wooc-product-slider ec-style-<?php echo esc_attr( $settings['style'] );?> owl-nav-po-<?php echo esc_attr( $settings['nav_style'] );?> <?php echo esc_attr( $sub_title );?>">
	<?php if ( $settings['section_title_display'] ): ?>

			<div class="section-title-wrapper mb--70">
				<?php if ( $settings['sub_title'] ): ?>
                <span class="title-highlighter mb--10"><?php echo wp_kses_post( $settings['sub_title'] );?></span>
                <?php endif; ?>	
                <h3 class="sec-title mb--25"><?php echo wp_kses_post( $settings['title'] );?></h3>
            </div>
	
	<?php endif; ?>
	<?php if ( $query->have_posts() ) :?>
		<div class="ec-items owl-theme owl-custom-nav-<?php echo esc_attr( $settings['nav_style'] );?> owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">
			<?php
			while ( $query->have_posts() ) {			
				$query->the_post();
				$id = get_the_ID();
				$product = wc_get_product( $id );				
				$i++;
				$number = $settings['number'];
				$number_off_row = $settings['number_off_row'];
				echo ($count == 1 ) ? '<div class="ec-item-list">' : ''; 
				wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
				 if( $count == $number_off_row || $i == $number ){
					echo "</div>";
						$count = 1;
					}else{
						$count++;
					}
			}
			?>
		</div>
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>