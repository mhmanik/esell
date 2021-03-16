<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$axil_options           = Helper::axil_get_options(); 
$has_sku          = wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ? true : false;
$sku              = $product->get_sku();
$sku              = $sku? $sku : esc_html__( 'N/A', 'esell' );
$stock_status     = WC_Functions::get_stock_status();
$cats_title       = _n( 'Category', 'Categories', count( $product->get_category_ids() ) , 'esell' );
$tags_title       = _n( 'Tag', 'Tags', count( $product->get_tag_ids() ) , 'esell' );
$cats_html        = wc_get_product_category_list( $product->get_id() );
$tags_html        = wc_get_product_tag_list( $product->get_id() );
$has_cats_n_tags  = $axil_options['wc_cats'] && $cats_html && $axil_options['wc_tags'] && $tags_html ? true : false;
$has_cats_or_tags = ( $axil_options['wc_cats'] && $cats_html ) || ( $axil_options['wc_tags'] && $tags_html ) ? true : false;
$sku 			  = $product->get_sku() ? $sku : esc_html__( 'N/A', 'woocommerce' ); 
$layout = $axil_options['product_wc_single_layout'] ? $axil_options['product_wc_single_layout'] : '1';
if ($layout == '1') { ?>
	<div class="product_meta">
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
<?php } elseif($layout == '2') { ?>
	<div class="product-meta-area-wrp">
		<div class="product_meta-area product_meta-area-js">
			<?php do_action( 'woocommerce_product_meta_start' ); ?>
			<?php if ( $axil_options['in_stock_avaibility'] ) : ?>
				<div class="product-meta-avaibility">
				    <?php echo WC_Functions::esell_wc_format_stock_for_display($product) ?>	
				</div>
				<?php endif; ?>					
				<div class="product-meta-group">
					<?php if ( $has_sku ) : ?>
						<div class="product-meta-sku product_meta">	

							<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
								<span class="sku_wrapper product-meta-title"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> 
								<span class="product-meta-content sku"><?php echo esc_attr( $sku );?></span></span>
							<?php endif; ?>
						</div>
						
					<?php endif; ?>					
				</div>		
				<?php if ( $has_cats_or_tags ): ?>			
				<?php if ( $axil_options['wc_cats'] && $cats_html ): ?>
					<div class="product-meta-term">
						<span class="product-meta-title"><?php echo esc_html( $cats_title ); ?>:</span>
						<span class="product-meta-content"><?php echo wp_kses( $cats_html, 'alltext_allow' );?></span>
					</div>
				<?php endif; ?>	
				<?php if ( $axil_options['wc_tags'] && $tags_html ): ?>
					<div class="product-meta-term">
						<span class="product-meta-title"><?php echo esc_html( $tags_title ); ?>:</span>
						<span class="product-meta-content"><?php echo wp_kses( $cats_html, 'alltext_allow' );?></span>
					</div>
				<?php endif; ?>					
				<?php endif ?>
			<?php do_action( 'woocommerce_product_meta_end' ); ?>
		</div>	
	</div>
<?php } else { ?>
	<div class="product-meta-area-wrp">
		<div class="container">
			<div class="product_meta-area product_meta-area-js">
				<?php do_action( 'woocommerce_product_meta_start' ); ?>
				<?php if ( $axil_options['in_stock_avaibility'] ) : ?>
					<div class="product-meta-avaibility">
					    <?php echo WC_Functions::esell_wc_format_stock_for_display($product) ?>	
					</div>
					<?php endif; ?>					
				<div class="product-meta-group">
					<?php if ( $has_sku ) : ?>
						<div class="product-meta-sku product_meta">	
							<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
								<span class="sku_wrapper product-meta-title"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> 
								<span class="product-meta-content sku"><?php echo esc_attr( $sku );?></span></span>
							<?php endif; ?>
						</div>						
					<?php endif; ?>					
				</div>		
				<?php if ( $has_cats_or_tags ): ?>
					<div class="product-term-group">
						<?php if ( $axil_options['wc_cats'] && $cats_html ): ?>
							<div class="product-meta-term">
								<span class="product-meta-title"><?php echo esc_html( $cats_title ); ?>:</span>
								<span class="product-meta-content"><?php echo wp_kses( $cats_html, 'alltext_allow' );?></span>
							</div>
						<?php endif; ?>

						<?php if ( $has_cats_n_tags ): ?>
							
						<?php endif ?>

						<?php if ( $axil_options['wc_tags'] && $tags_html ): ?>
							<div class="product-meta-term">
								<span class="product-meta-title"><?php echo esc_html( $tags_title ); ?>:</span>
								<span class="product-meta-content"><?php echo wp_kses( $cats_html, 'alltext_allow' );?></span>
							</div>
						<?php endif; ?>
					</div>		
				<?php endif ?>
				<?php do_action( 'woocommerce_product_meta_end' ); ?>
			</div>
		</div>
	</div>
<?php } ?>
