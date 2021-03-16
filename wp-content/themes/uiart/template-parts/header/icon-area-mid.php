<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use \WC_Widget_Cart;

/*if ( !WOOCTheme::$options['search_icon'] && !( WOOCTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) && !( WOOCTheme::$options['cart_icon'] && class_exists( 'WooCommerce' ) ) ) {
	return;
}*/

?>
<div class="header-icon-right  header-icon-area clearfix">
	<ul>
		<li>
			<ul class="log-box">
			<li class="log login">
			<a class="link-lg" href="# ">
				<i class="far fa-user"></i>
				<span class="txt-h-mobile">Login / Register</span>
			</a>
		</li>				
		</ul>
	</li>
	<li>
		<a href="#" title="Wish List (0) ">
		<i class="far fa-heart"></i><span class="txt-h-mobile">Wish List (0) </span>
	</a>
</li>
	<li><div class="header-icon-btn-block cart-icon icon-area-content cart-icon-area">
	<a class="googo-toggle-right-sidebar" href="<?php echo esc_url( wc_get_cart_url() );?>">
		<i class="fas fa-shopping-basket"></i>
		<span class="cart-icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span>
		<span class="txt-h-mobile">Your Cart</span>
        </a>		
	<div class="cart-icon-products">
		<h1 class="d-none">Widget Cart</h1>
		<div class="cart-icon-products-wrp">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>
	</div>
</div>
</li>
	</ul>
</div>
