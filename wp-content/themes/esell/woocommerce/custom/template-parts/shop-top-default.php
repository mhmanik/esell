<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */

if ( !woocommerce_products_will_display() ) {
	return;
}
?>
<div class="woo-shop-top">	
	    <?php
	        if ( is_active_sidebar( 'widgets-shop-header' ) ) {
	            dynamic_sidebar( 'widgets-shop-header' );
			}
	    ?>
		
		<div class="woocue-right">
			<div class="sort-list"><?php woocommerce_catalog_ordering();?></div>		
		</div>
</div>
	