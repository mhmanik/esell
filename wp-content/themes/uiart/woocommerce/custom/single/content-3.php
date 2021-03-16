<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>


<div class="single-product-top-area">
	<div class="container">
		<div class="single-product-top-3">	
			<div class="woocue-top-item">
				<div class="woocue-top-left">
					<?php do_action( 'woocommerce_before_single_product_summary' );?>
					<div class="clear"></div>
				</div>
				<div class="woocue-top-right">			
					<?php do_action( 'woocommerce_single_product_summary' );?>
				</div>		
			</div>
		</div>
	</div>
</div>
<div class="single-product-bottom-3">
	<?php do_action( 'woocommerce_after_single_product_summary' );?>
</div>