<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */

?>
<div class="axil-single-product-area bg-color-white">
	<div class="single-product-thumb mb--40">
		<div class="container">
			<div class="row row--30">				
				<div class="col-lg-6 mb--40">
					<div class="before-single-wrp single-product-thumbnail axil-product">
						<div class="thumbnail">
							<?php do_action( 'woocommerce_before_single_product_summary' );?>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12">			
					<div class="single-product-content">			
						<div class="inner">			
							<?php do_action( 'woocommerce_single_product_summary' );?>
						</div>	
					</div>	
				</div>	
						
			</div>		
		</div>
	</div>
</div>
<div class="single-product-bottom-1">
	<?php do_action( 'woocommerce_after_single_product_summary' );?>
</div>