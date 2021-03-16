<?php
/**
 * @author  Axiltheme
 * @since   1.0
 * @version 1.0
 */

 $axil_options           = Helper::axil_get_options();



$search      = isset( $_GET['s'] ) ? $_GET['s'] : '';
$product_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';

$all_label = $label = esc_html__( 'All Categories', 'esell' );
if ( isset( $_GET['product_cat'] ) ) {
	$pcat = $_GET['product_cat'];
	if ( isset( $category_dropdown[$pcat] ) ) {
		$label = $category_dropdown[$pcat]['name'];
	}
}

?>

<div class="product-search">
	<div class="search-dropdown header_auto_search">
		<div class="search-outer visible-mobile-menu-off axil-search">
			<form id="search__form" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php if(isset( $axil_options['wooc_search_auto_suggest_status']) 
				&&  $axil_options['wooc_search_auto_suggest_status']){?>
					<input type="hidden" value="product" name="post_type" />
				<?php }?>
				<div class="input-outer input-group border-radius-default">
					<input type="search" class="placeholder product-search-input form-control" name="s" id="s" value="" maxlength="128" placeholder="<?php esc_attr_e('Product Search...', 'esell')?>" autocomplete="off"/>
					<button type="submit" class="btn wooc-btn-search"><i class="fal fa-search"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

