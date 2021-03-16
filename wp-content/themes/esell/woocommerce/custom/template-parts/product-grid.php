<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */

$axil_options           = Helper::axil_get_options();
$block_data = array( 'v_swatch' => false, 'gallery' => false );
?>

	<div class="related up-sell products axil-section-gap pb--20 <?php echo esc_attr( $type );?>">
		<div class="container">
				<div class="section-title-wrapper">
					<span class="title-highlighter mb--10"><?php echo esc_html( $before_heading );?></span>
					<h3 class="mb--25 mb_sm--30"><?php echo esc_html( $title );?></h3>
				</div>
			<div class="row row--30">				
			<?php
				foreach ( $products as $product ) {
					$post_object = get_post( $product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-12">
							<?php 	wc_get_template( "content-product.php" , compact( 'block_data' ) ); ?>
						</div>
				<?php }
			?>
			</div>				
		</div>
	</div>