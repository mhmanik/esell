<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
$img =   Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
$id = intval( $settings['p_id'] );
$product  = wc_get_product( $id );
if ( !$product ) {
	return;

}
global $post;
$post = get_post( $id );

if ( $settings['thumbnail_size'] == 'custom' ) {
	$size = array_values( $settings['thumbnail_custom_dimension'] );
}
else {
	$size = $settings['thumbnail_size'];
}

$block_data = array(
	'layout'         => $settings['style'],
	'thumb_size'     => $size,
	'cat_display'    => $settings['cat_display'] ? true : false,
	'rating_display' => $settings['rating_display'] ? true : false,
	'v_swatch'       => false,
	'gallery'        => false,
);

$image = !empty( $settings['image']['id'] ) ? Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) : false;
?>
<div class="wooc-countdown woocjs-coutdown countdown-product">
<div class="woocueproduct-box primary-bg">
	<?php
	setup_postdata( $post );
	if ( !$image ) {
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );

		if ( $settings['date'] ): ?>
			<div class="wooc-countdown-coutdown wooc-scripts-date clearfix" data-time="<?php echo esc_attr( $settings['date'] ); ?>"></div>
		<?php endif;

	}
	else {
		ob_start();
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
		$content = ob_get_clean();
		$content = preg_replace( '/<img.+?>/', $image, $content, 1 );// replace image
		echo $content;
		if ( $settings['date'] ): ?>
			<div class="wooc-countdown-coutdown wooc-scripts-date clearfix" data-time="<?php echo esc_attr( $settings['date'] ); ?>"></div>
		<?php endif;
	}
	?>
</div>
</div>
<?php wp_reset_postdata();?>
