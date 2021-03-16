<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

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
	'rating_display' => false,
	'v_swatch'       => false,
	'gallery'        => false,
);

$image = !empty( $settings['image']['id'] ) ? wp_get_attachment_image( $settings['image']['id'], 'full' ) : false;
?>
<div class="woocueproduct-box">
	<?php
	setup_postdata( $post );
	if ( !$image ) {
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
	}
	else {
		ob_start();
		wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );
		$content = ob_get_clean();
		$content = preg_replace( '/<img.+?>/', $image, $content, 1 );// replace image
		echo $content;
	}
	?>
</div>
<?php wp_reset_postdata();?>