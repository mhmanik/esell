<?php
class wtpgsHelper {
public static function wooc_woocommerce_version_check($version = '3.0')
       {
        if (class_exists('WooCommerce')) {
            global $woocommerce;
            if (version_compare($woocommerce->version, $version, ">=")) {
                return true;
            }
        }
        return false;
    }
}