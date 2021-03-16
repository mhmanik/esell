<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>
<div class="single-product-1">
	<div class="container">
		<div class="row">				
			<div class="col-md-6 col-12">
				<div class="before-single-wrp">
					<?php do_action( 'woocommerce_before_single_product_summary' );?>
				</div>
			</div>
			<div class="col-md-6 col-12">			
				<?php do_action( 'woocommerce_single_product_summary' );?>
			</div>	
					
		</div>		
	</div>
</div>
<div class="single-product-bottom-1">
	<?php do_action( 'woocommerce_after_single_product_summary' );?>
</div>