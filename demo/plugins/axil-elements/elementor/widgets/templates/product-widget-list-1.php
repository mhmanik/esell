<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */
namespace axiltheme\esell_elements;
use axiltheme\eSell\WC_Functions;
$thumb_size 		= array( 158, 155 );
$query 				= $settings['query'];
$shop_permalink 	= get_permalink( wc_get_page_id( 'shop' ) );
$thumb_border       = $settings['thumb_border'] ? 'thumb_border' : 'hide_thumb_border';
$count 				= 1;
$i 					= 0;
?>
<div class="woocueproduct-list">	
	<?php if ( $query->have_posts() ) :?>
		<div class="wooc-title-block">			
				<h3 class="woocue-widget-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
			</div>	
		<div class="woocue-items owl-theme owl-custom-nav-top owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">		
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
				$i++;
				$number = $settings['number'];
				$number_off_row = $settings['number_off_row'];
				echo ($count == 1 ) ? '<div class="woocue-item-list">' : ''; 	
				?>			
					<div class="woocue-item media">
						<div class="woocue-thumb <?php echo esc_attr( $thumb_border );?>">							
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('thumbnail');
								}
								?>
							<div class="woocue-icon"><?php if ( $settings['quickview'] ) WC_Functions::print_quickview_icon(); ?></div>	
						</div>
						<div class="media-body">
							<h3 class="woocue-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<?php if ( $cat ): ?>
								<div class="woocue-cat"><?php echo esc_html( $cat );?></div>
							<?php endif; ?>
							<div class="woocue-price"><?php echo wp_kses_post( $price );?></div>
							<?php
							if ( $settings['rating_display'] ) {
								wc_get_template( 'loop/rating.php' );
							}
							?>	
						</div>
					</div>		
			<?php  if( $count == $number_off_row || $i == $number ){
				echo "</div>";
					$count = 1;
				}else{
					$count++;
				}
		endwhile;?>
		</div>		
	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>

