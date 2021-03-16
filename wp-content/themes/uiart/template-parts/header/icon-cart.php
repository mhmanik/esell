<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>

<div class="header-icon-btn-block cart-icon icon-area-content cart-icon-area">
	<a class="wooc-button-grey-icon googo-toggle-right-sidebar" href="<?php echo esc_url( wc_get_cart_url() );?>"><i class="fas fa-shopping-basket"></i><span class="cart-icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span></a>		
	<div class="cart-icon-products">
		<h1 class="d-none">Widget Cart</h1>
		<div class="cart-icon-products-wrp">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>
	</div>

</div>


