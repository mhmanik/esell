<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

if ( !woocommerce_products_will_display() ) {
	return;
}

?>
<div class="woo-shop-top">
	<div class="woocue-left">
		<div class="limit-show"><?php woocommerce_result_count();?></div>
	</div>
	<div class="woocue-right">
		<div class="sort-list"><?php woocommerce_catalog_ordering();?></div>
		<div class="view-mode" id="shop-view-mode">
			<ul>
				<li class="grid-view-nav"><a href="<?php echo esc_url( Helper::shop_grid_page_url() );?>" ><i class="fa fa-th"></i></a></li> 
				<li class="list-view-nav"><a href="<?php echo esc_url( Helper::shop_list_page_url() );?>"><i class="fa fa-th-list"></i></a></li>
			</ul>
		</div>
	</div>
</div>
	<?php if ( WOOCTheme::$options['Categories_shop_header'] ) : ?>
		<div class="woo-categories-shop-top">
			<ul class="wooc-shop-categories">
			    <?php WC_Functions::wooc_category_menu(); ?>
			</ul>
		</div>
	<?php endif; ?>