<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */



if ( !woocommerce_products_will_display() ) {
    return;
}

$axil_options           = Helper::axil_get_options(); 
if ( $axil_options['shop_categories_layout'] == '1' ) {  
    $shop_categories_layout     = 'col-lg-12';
}elseif ($axil_options['shop_categories_layout'] == '2' ) { 
     $shop_categories_layout     = 'col-lg-6';   
}elseif ($axil_options['shop_categories_layout'] == '3' ) { 
    $shop_categories_layout     = 'col-lg-4';
}elseif ($axil_options['shop_categories_layout'] == '6' ) {     
    $shop_categories_layout     = 'col-lg-2';
}else {      
    $shop_categories_layout     = 'col-lg-3';
}


$header_class = ' no-filters';
$show_filters = true;
$show_categories = true;
?>
    <div class="wooc-shop-header<?php echo esc_attr( $header_class ); ?>">
        <div class="wooc-shop-menu <?php echo esc_attr( $axil_options['shop_categories_layout'] ); ?>">
            <div class="wooc-row row">
                <div class="col-12">
                    <ul id="wooc-shop-filter-menu" class="wooc-shop-filter-menu">
                        <?php if ( $show_categories ) : ?>
                        <li class="wooc-shop-categories-btn-wrap" data-panel="cat">
                            <a href="#categories" class="invert-color"><?php esc_html_e( 'Categories', 'esell' ); ?></a>
                        </li>
                        <?php 
						endif;
						if ( $show_filters ) :
						?>
                        <li data-panel="filter">
                            <a href="#filter" class="invert-color axiltheme-border-button"><?php esc_html_e( 'Filter', 'esell' ); ?> <i class="flaticon-plus-symbol"></i></a>
						</li>                   

                        <li class="wooc-shop-search-btn-wrap" data-panel="search">                           
                            <a href="#search" id="wooc-shop-search-btn" class="invert-color axiltheme-border-button">
                                <i class="fas fa-search"></i> <span><?php esc_html_e( 'Search', 'esell' ); ?></span>
                                <i class="wooc-font wooc-font-search flip"></i>
                            </a>
                        </li>
                        <?php 
                            endif;      ?>
                    </ul>
                    <?php if ( $show_categories ) : ?>
                    <ul id="wooc-shop-categories" class="wooc-shop-categories">
                        <?php WC_Functions::wooc_category_menu(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if ( $show_filters ) : ?>
        <div id="wooc-shop-sidebar" class="wooc-shop-sidebar wooc-shop-sidebar-header" data-sidebar-layout="header">
            <div class="wooc-shop-sidebar-inner">
                <div class="wooc-row">
                    <div class="col-xs-12">
                        <ul id="wooc-shop-widgets-ul" class="small-block-grid-<?php echo esc_attr( $axil_options['shop_filters_columns'] ); ?>">
                            <?php
                                if ( is_active_sidebar( 'widgets-shop' ) ) {
                                    dynamic_sidebar( 'widgets-shop' );
								}
                            ?>
                        </ul>
                    </div>
                </div>
            </div>            
            <div id="wooc-shop-sidebar-layout-indicator"></div> <!-- Don't remove (used for testing sidebar/filters layout in JavaScript) -->
        </div>
        <?php endif; ?>        
        <?php 
			// Search-form
			//if (  $axil_options['shop_search'] ) {
				wc_get_template( 'product-searchform_wooc.php' );
			//}
		?>
    </div>
