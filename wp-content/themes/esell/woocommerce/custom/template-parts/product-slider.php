<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */

	$axil_options           = Helper::axil_get_options();
// Can be used only in 'include' function

if ( $type == 'cross-sells' ) {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 1 ),
		'992'  => array( 'items' => 2 ),
	);
}
elseif ( $axil_options['product_wc_single_layout'] == 'full-width' ) {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 3 ),
		'992'  => array( 'items' => 3 ),
		'1200' => array( 'items' => 4 ),
	);
}
else {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'400'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 3 ),
		'992'  => array( 'items' => 4 ),
	);
}

$owl_data = array( 
	'nav'                => true,
	'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
	'dots'               => false,
	'autoplay'           => true,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => false,
	'margin'             => 30,
	'responsive'         => $responsive
);

$owl_data = json_encode( $owl_data );

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'owl-theme-default' );
wp_enqueue_script( 'owl-carousel' );

$block_data = array( 'v_swatch' => false, 'gallery' => false );
?>

	<div class="related up-sell products axil-section-gap pb--20 <?php echo esc_attr( $type );?>">
		<div class="container">
				<div class="section-title-wrapper">
					<span class="title-highlighter mb--10"><?php echo esc_html( $before_heading );?></span>
					<h3 class="mb--25 mb_sm--30"><?php echo esc_html( $title );?></h3>
				</div>
			<div class="row row--30">
				<div class="col-12 mt--40">
					<div class="owl-theme owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
					<?php
						foreach ( $products as $product ) {
							$post_object = get_post( $product->get_id() );
							setup_postdata( $GLOBALS['post'] =& $post_object );
							wc_get_template( "content-product.php" , compact( 'block_data' ) );
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>