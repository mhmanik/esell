<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */


?>


<div class="single-product-area-2">
	<div class="container-fluid ">
		<div class="row gutters-0">
			<div class="col-lg-4 wooc-sticky-left">
				<div class="wooc-product-summary-img">
					<?php do_action( 'woocommerce_before_single_product_summary' );?>					
				</div>
			</div>
			<div class="col-lg-8 col-12 pl40px">
				<div class="row">
					<div class="col-lg-8 col-12">			
						<div class="wooc-product-summary">			
							<?php do_action( 'woocommerce_single_product_summary' );?>
						
						</div>		
					</div>		
					<div class="col-lg-4 col-12">			
						<div class="wooc-product-add">			
							
						</div>		
					</div>
						<div class="col-12">	
							<?php do_action( 'woocommerce_after_single_product_summary' );?>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
