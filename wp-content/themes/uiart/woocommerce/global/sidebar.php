<?php
/**
 * Sidebar
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/sidebar.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 wooc: Modified */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="wooc-shop-sidebar-col col-md-3 col-sm-12">
    <div id="wooc-shop-sidebar" class="wooc-shop-sidebar" data-sidebar-layout="default">
        <ul id="wooc-shop-widgets-ul">
            <?php
                if ( is_active_sidebar( 'widgets-shop' ) ) {
                    dynamic_sidebar( 'widgets-shop' );
                }
            ?>
        </ul>
    </div>
</div>
