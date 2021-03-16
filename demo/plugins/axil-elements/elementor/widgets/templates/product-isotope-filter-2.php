<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */
namespace axiltheme\esell_elements;
$col_class  = "col-xl-{$settings['col_xl']} col-lg-{$settings['col_lg']} col-md-{$settings['col_md']} col-sm-{$settings['col_sm']} col-{$settings['col_mobile']}";
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$block_data = array(
	'layout'         => $settings['style'],
	'cat_display'    => $settings['cat_display'] ? true : false,
	'rating_display' => $settings['rating_display'] ? true : false,
	'wishlist' 		 => $settings['wishlist'] ? true : false,
	'quickview' 	 => $settings['quickview'] ? true : false,	
	'v_swatch'       => true,
);

$query = $settings['query'];
$uniqueid = time().rand( 1, 99 ).'-';
?>
<div class="woocueproduct-isotope woocueisotope-container woocue-layout-<?php echo esc_attr( $settings['layout'] );?>">
	<div class="woocue-navs-area">			
		<div class="woocueisotope-tab woocue-navs">
		
			<?php if ( $settings['layout'] == '2' && $settings['section_title_display'] ): ?>			
				<div class="wooc-slider-title-block-1">
					<div class="wooc-title-block">
						<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
						<div class="clear"></div>
						<h3 class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
					</div>					
				</div>
			<?php endif; ?>	

			<?php if ( $settings['layout'] == '4' && $settings['section_title_display'] ): ?>			
				<div class="wooc-slider-title-block-1">
					<div class="wooc-title-block">
						<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
						<div class="clear"></div>
						<h3 class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
					</div>					
				</div>				
			<?php endif; ?>		

			<?php if ( $settings['section_filter_display'] ): ?>
				<div class="wooc-filter-block">
					<?php if ( $settings['filter_all_display'] ): ?>
						<a href="#" data-filter="*" class="current"><?php echo esc_html_e( 'All Product', 'esell-elements' );?></a>
					<?php endif; ?>
					<?php foreach ( $settings['navs'] as $key => $value ): ?>
						<a href="#" data-filter=".<?php echo esc_attr( $uniqueid.$key );?>"><?php echo esc_html( $value );?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			
		</div>
		<?php if ( $settings['layout'] == '1' && $settings['all_link_display'] ): ?>
			<div class="woocue-viewall"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php esc_html_e( 'View All', 'esell-elements' );?><i class="flaticon-arow"></i></a></div>
		<?php endif; ?>
	</div>
	<div class="row woocueisotope-wrapper">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id = get_the_ID();
				$product = wc_get_product( $id );
				$term_slugs = array();		
				$terms = get_the_terms( $id, 'product_cat' );
				if ( $terms ) {
					foreach ( $terms as $term ) {
						$ancestors    = get_ancestors( $term->term_id, 'product_cat', 'taxonomy' );
						$ancestors    = array_reverse( $ancestors );
						$top_term     = $ancestors ? get_term( $ancestors[0], 'product_cat' ) : $term;
						$term_slugs[] = $top_term->slug;
					}
				}
				$class = '';
				foreach ( $term_slugs as $slug ) {
					$class .= ' '.$uniqueid.$slug;
				}
				?>
				<div <?php wc_product_class( $col_class.$class, $product ); ?>>
					<?php wc_get_template( "custom/product-block/blocks.php" , compact( 'product', 'block_data' ) );?>
				</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_postdata();?>
	</div>
	<?php if ( in_array( $settings['layout'], array( '2','3' ) ) && $settings['all_link_display'] ): ?>
		<div class="woocue-viewall-2 btn-style-<?php echo esc_html( $settings['btnstyle'] );?>"><a href="<?php echo esc_url( $shop_permalink ); ?>"><?php echo esc_html( $settings['all_link_text'] );?> <i class="flaticon-export"></i></a></div>
	<?php endif; ?>	
</div>