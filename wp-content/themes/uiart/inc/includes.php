<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

Helper::requires( 'general.php' );
Helper::requires( 'options/init.php' );
Helper::requires( 'layout-settings.php' );
Helper::requires( 'activation.php' );
Helper::requires( 'wooctheme.php' );
Helper::requires( 'loadmore.php' );
Helper::requires( 'scripts.php' );
Helper::requires( 'tgm-config.php' );
Helper::requires( 'class-tgm-plugin-activation.php' );


Helper::requires( 'ajax-template-file-loader.php' );
Helper::requires( 'widgets/wooc-shop-top-widget.php' );


if ( class_exists( 'WooCommerce' ) ) {
	Helper::requires( 'custom/functions.php', 'woocommerce' );
	//Helper::requires( 'woocommerce/admin/admin-product-details.php' );
	Helper::requires( 'woocommerce/woocommerce-attribute-functions.php' );
	Helper::requires( 'woocommerce/admin/admin-product-attributes.php' );	
	Helper::requires( 'woocommerce/admin/admin-product-categories.php' );
	Helper::requires( 'woocommerce/admin/admin-product-data.php' );
	
}

