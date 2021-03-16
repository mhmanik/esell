<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post();

	global $product;
	?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="single-product-1">
		<div class="container">
			<div class="row">				
				<div class="col-md-6 col-12">
					<div class="before-single-wrp">
						<?php
							woocommerce_show_product_sale_flash();
							woocommerce_show_product_images();
						?>
					</div>
				</div>
				<div class="col-md-6 col-12">			
					<?php
						woocommerce_template_single_title();
						woocommerce_template_single_rating();
						woocommerce_template_single_price();
						woocommerce_template_single_meta();
						woocommerce_template_single_excerpt();
						woocommerce_template_single_add_to_cart();
					?>
				</div>	
						
			</div>		
		</div>
	</div>
</div>

<?php endwhile; // end of the loop.