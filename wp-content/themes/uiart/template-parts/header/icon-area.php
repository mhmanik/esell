<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use \WC_Widget_Cart;

if ( !WOOCTheme::$options['search_icon'] && !( WOOCTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) && !( WOOCTheme::$options['cart_icon'] && class_exists( 'WooCommerce' ) ) ) {
	return;
}
?>
<div class="header-icon-right  header-icon-area  icon-true clearfix">
	<?php
	if ( WOOCTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) {
			get_template_part( 'template-parts/header/icon', 'account-true' );
		}
		if ( WOOCTheme::$options['cart_icon'] && class_exists( 'WC_Widget_Cart' ) ){
			get_template_part( 'template-parts/header/icon', 'cart' );
		}	
	?>
</div>