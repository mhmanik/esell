<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */


defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

$axil_options                   = Helper::axil_get_options(); 

$wc_mobile_product_columns      = $axil_options['wc_mobile_product_columns'];
$wc_tab_product_columns         = $axil_options['wc_tab_product_columns'];

$product_col_class = ( $axil_options['shop_layout'] == 'full-width') ? "col-xl-3 col-lg-3 col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}" : "col-xl-4 col-lg-4 col-md-{$wc_tab_product_columns} col-sm-{$wc_tab_product_columns} col-{$wc_mobile_product_columns}";


$product_class = '';
if (is_shop() || is_product_taxonomy() || isset($_REQUEST['ajax_product_loadmore'])) {
    $product_class = $product_col_class;
}
if (!isset($block_data)) {
    $block_data = array();
}
if (!empty($view)) {

    $shopview = $view;

} else {
    $shopview = isset($_GET["shopview"]) && $_GET["shopview"] == 'list' ? 'list' : 'grid';
}
$block_data_defaults = array(
    'type' => $shopview,
    'layout' => $axil_options['wc_product_layout'],
    'list_layout' => 1,
    'cat_display' => $axil_options['wc_shop_cat'] ? true : false,
    'rating_display' => $axil_options['wc_shop_review'] ? true : false,
    'v_swatch' => true,
);

$block_data_defaults['type'] = apply_filters('axiltheme_shop_view_type', $block_data_defaults['type']);
$block_data = wp_parse_args($block_data, $block_data_defaults);
if ($block_data['type'] == 'list') {
    $product_class = 'col-12';
}
if (!empty($isloadmore)) {
    $product_class .= ' product_loaded';
}
// Product variation attributes
$attributes_escaped = function_exists('wooc_template_loop_attributes') ? wooc_template_loop_attributes() : null;
$product_class .= ($attributes_escaped) ? ' wooc-has-attributes' : '';
?>
<div <?php wc_product_class($product_class, $product); ?>>
    <?php
    do_action('woocommerce_before_shop_loop_item');
    wc_get_template("custom/product-block/blocks.php", compact('product', 'block_data'));
    do_action('woocommerce_after_shop_loop_item');
    ?>
</div>
