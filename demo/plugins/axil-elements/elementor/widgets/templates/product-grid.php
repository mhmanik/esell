<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

$thumb_size = array( 158, 155 );
$query = $settings['query'];
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$col_class  = "col-xl-{$settings['col_xl']} col-lg-{$settings['col_lg']} col-md-{$settings['col_md']} col-sm-{$settings['col_sm']} col-{$settings['col_mobile']} ";
?>

<div class="woocueproduct-list woocueproduct-grid">	
	<?php if ( $query->have_posts() ) :?>
		<div class="woocue-items row">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$cat = '';
				$id = get_the_ID();
				$product = wc_get_product( $id );

				if ( $settings['cat_display'] ) {
					$terms = get_the_terms( $id, 'product_cat' );
					if ( $terms ) {
						$term = array_pop( $terms );
						$cat  = $term->name;
					}
				}

				if ( $settings['sale_price_only'] ) {
					$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
				}
				else {
					$price = $product->get_price_html();
				}
				?>

				<div class="<?php echo esc_attr( $col_class );?>">
					<div class="woocue-item media">
						<a class="woocue-thumb" href="<?php the_permalink();?>">
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('thumbnail');
								}
							?>
							<div class="woocue-icon"><i class="flaticon-add"></i></div>
						</a>
						<div class="media-body">
							<h4 class="woocue-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<?php if ( $cat ): ?>
								<div class="woocue-cat"><?php echo esc_html( $cat );?></div>
							<?php endif; ?>
							<div class="woocue-price"><?php echo wp_kses_post( $price );?></div>
						</div>
					</div>
				</div>
			<?php endwhile;?>
		</div>
		<?php if ( $settings['all_link_display'] ): ?>
				<div class="viewall-wrp">
					<div class="woocue-viewall">
						<a href="<?php echo esc_url( $shop_permalink ); ?>"><?php esc_html_e( 'See More', 'esell-elements' );?> <i class="flaticon-play-button"></i></a></div>
				</div>
			<?php endif; ?>
		<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>