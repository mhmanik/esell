<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use axiltheme\eSell\WC_Functions;

$thumb_size = array( 158, 155 );
$query = $settings['query'];
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$col_class  = "col-xl-{$settings['col_xl']} col-lg-{$settings['col_lg']} col-md-{$settings['col_md']} col-sm-{$settings['col_sm']} col-{$settings['col_mobile']} ";
?>

<div class="wooc-product-grid">	
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
				if ( $settings['islink'] ) {
					$btn = '<div class="wooc-btn-area"><a  href=" '.get_the_permalink().'" class="wooc-btn">'.$settings['btntext'].'</a></div>';
				}
				$product_shape_color = get_post_meta( $id, 'bgcolor', true );
				if($product_shape_color){
					$product_shape_color = $product_shape_color;
				}else{
					$product_shape_color = "#fffaf6";
				}
				?>

				<div class="<?php echo esc_attr( $col_class );?>">
					<div class="wooc-product-wrp">	
						<?php if ( $settings['image_posx_type'] == 'top' ) { ?>
							<div class="wooc-product-info-wrp text-center">	
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
										<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape-list"></span>
										<a class="woocue-thumb" href="<?php the_permalink();?>">
										<?php the_post_thumbnail('thumbnail'); ?>
										</a>		
									</div>	
								<?php }	?>
								<div class="wooc-content-area">
									<div class="wooc-content">
										<?php if ( $cat ): ?>
											<h5 class="wooc-subtitle"><?php echo esc_html( $cat );?></h5>
										<?php endif; ?>					
											<h3 class="wooc-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
										<div class="wooc-content-footer">
											<?php if (  $settings['price_display'] ): ?>
												<div class="woocue-price"><?php echo wp_kses_post( $price );?></div>
											<?php endif; ?>	
											<?php WC_Functions::wooc_print_add_to_cart_icon( true, true, false );?>											
										</div>
									</div>
								</div>			
							</div>	
							<?php }else{ ?>
							<div class="wooc-product-info-wrp media">
							<?php if ( $settings['image_posx_type'] == 'left' ) { ?>
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
										<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape-list"></span>
										<a class="woocue-thumb" href="<?php the_permalink();?>">
										<?php the_post_thumbnail('thumbnail');?></a>	
									</div>
								<?php }	?>
							<?php } ?>
								<div class="wooc-content-area media-body">
									<div class="wooc-content">
										<?php if ( $cat ): ?>
										<h5 class="wooc-subtitle"><?php echo esc_html( $cat );?></h5>
										<?php endif; ?>		
										<h3 class="wooc-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>										
										<div class="wooc-content-footer">
											<?php if (  $settings['price_display'] ): ?>
												<div class="woocue-price"><?php echo wp_kses_post( $price );?></div>
											<?php endif; ?>	
											<?php WC_Functions::wooc_print_add_to_cart_icon( true, true, false );?>											
										</div>
									</div>
								</div>	
								<?php if ( $settings['image_posx_type'] == 'right' ) { ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
											<span style="background: <?php echo esc_html( $product_shape_color ); ?>" class="bg-shape-list"></span>
											<a class="woocue-thumb" href="<?php the_permalink();?>">
											<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail('thumbnail');
												}
												?>	
											</a>	
										</div>
								<?php }	?>
							<?php } ?>
							</div>	
						<?php } ?>
					</div>
				</div>
			<?php endwhile;?>
		</div>
		<?php if ( $settings['all_link_display'] ): ?>
				<div class="viewall-wrp">
					<div class="woocue-viewall">
						<a href="<?php echo esc_url( $shop_permalink ); ?>"><?php esc_html_e( 'See More', 'esell-elements' );?> <i class="flaticon-arow"></i></a></div>
				</div>
			<?php endif; ?>
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>