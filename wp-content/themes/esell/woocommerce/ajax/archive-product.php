<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || die();

$args = array(
	'post_type' => 'product',
	'status' => 'published',
	'posts_per_page' => 10,
	'tax_query' => array(),
	'meta_query' => array(

		// 'relation' => 'AND',

	),
);

$query_url = esc_url_raw($_POST['query_url']);
$wc_options = get_option('woocommerce_permalinks');
$product_category_base = $wc_options['category_base'];

// Checking if the url contains category
if(strpos($query_url, $product_category_base) !== FALSE){

	// $current_category = get_category_by_path($query_url, false);

	$category_expression = '/([A-Za-z0-9-_]*)\/?\??(?>filter|min_.*)?$/m';
	preg_match_all($category_expression, $query_url, $matches, PREG_SET_ORDER, 0);
	// print_r($matches[0][1]);
	$cat_slug = $matches[0][1];
	$current_category = get_term_by( 'slug', $cat_slug, 'product_cat');

	// print_r($current_category);

	$args['tax_query'][] = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms' => $current_category->slug,
		// 'operator' => 'IN'
	);

}

// Retriving Query Parameter from url

parse_str(parse_url($query_url, PHP_URL_QUERY), $url_query_params);

// print_r($url_query_params);

if(isset($url_query_params) && !empty($url_query_params)){

	foreach($url_query_params as $key => $value){

		if($key == 'max_price' || $key == 'min_price') continue;

		$args['tax_query'][] = array(

			'taxonomy' => str_replace("filter","pa", $key),
			'field' => 'slug',
			'terms' => $value,
			// 'operator' => 'IN'
	
		);

	}

}

if(isset($url_query_params['min_price']) && isset($url_query_params['max_price'])){

	$args['meta_query'][] = wc_get_min_max_price_meta_query(array(
		'min_price' => sanitize_text_field($url_query_params['min_price']),
		'max_price' => sanitize_text_field($url_query_params['max_price']),
	));

}
// echo "<pre>";
// print_r($args);
// echo "</pre>";

$loop = new WP_Query($args);

// do_action( 'woocommerce_before_main_content' );

if($loop->have_posts()){

	// do_action( 'woocommerce_before_shop_loop' );
	
	// woocommerce_product_loop_start();

	while($loop->have_posts( )){

		$loop->the_post();

		/**
		 * Hook: woocommerce_shop_loop.
		 */
		do_action( 'woocommerce_shop_loop' );

		wc_get_template_part( 'content', 'product' );

	}

	// woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	// do_action( 'woocommerce_after_shop_loop' );

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

wp_reset_postdata();

wp_die();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
// do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */

// do_action( 'woocommerce_sidebar' );

// get_footer( 'shop' );
