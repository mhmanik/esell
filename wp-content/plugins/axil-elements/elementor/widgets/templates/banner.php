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
if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if ( !empty( $settings['url2']['url'] ) ) {
	$attr2  = 'href="' . $settings['url2']['url'] . '"';
	$attr2 .= !empty( $settings['url2']['is_external'] ) ? ' target="_blank"' : '';
	$attr2 .= !empty( $settings['url2']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $settings['url']['url'] ) {
	$btn = '<a class="wooc-button-pli" '.$attr.'><i class="flaticon-shopping-bag-3"></i><span>'.$settings['btntext'].'</span></a>';
}
if ( $settings['url2']['url'] ) {
	$btn2 = '<a class="wooc-button-light" '.$attr2.'><i class="flaticon-shopping-bag-4"></i><span>'.$settings['btntext2'].'</span></a>';
}

?>
<div class="wooc-product-banner layout-<?php echo esc_attr( $settings['style'] );?>">	
	<?php if ( $query->have_posts() ) :?>		
			<?php 
			$tabs = null;
			$content= null; 
			while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$cat = '';
				$id = get_the_ID();
				$product = wc_get_product( $id );
			
				$price = $product->get_price_html();
				$title = get_the_title();				
				?>
				<?php    
                $tabs .= '<div class="nav-item content-block">
					<div class="media item-bg align-items-center"><div class="nav-item-image">
					 '. get_the_post_thumbnail( $id, 'axiltheme-90x120' ) .'
					   </div><div class="media-body">
					   <h2 class="ptitle">'. $title.'</h2>
					    <span class="wooc-sale-price">'. $price.'</span>									
                      </div>
                       </div>
                </div>';
                $content .= '<div class="product-image-content">';        
                      $content .= '<div class="item-img slider-big-img"></span>'.get_the_post_thumbnail( $id, 'axiltheme-430x560' ) . '</div></div>'; ?>
			<?php endwhile;?>	
			<div class="container">
			    <div class="banner-row align-items-center gutters-0">	
					<div class="banner-lg-5">
						<div class="product-banner-left">
							<p><?php echo wp_kses_post( $settings['subtitle'] );?></p>
							<h2 class="banner-title"><?php echo wp_kses_post( $settings['title'] );?></h2>
							<div class="banner-link-set">
								
								<div class="wooc-btn-common">
									<?php echo wp_kses_post( $btn );?>
								</div>
								<div class="wooc-btn-common">
									<?php echo wp_kses_post( $btn2 );?>
								</div>
							</div>
						</div>
					</div>
					<div class="banner-lg-7">
						<div class="banner-slick-row align-items-center">
							<div class="banner-slick-7 slick-carousel-content product-banner-img"><?php echo wp_kses_post( $content ); ?></div>
							<div class="banner-slick-4 offset-lg-1 slick-carousel-nav product-banner-nav-img"><?php echo wp_kses_post( $tabs ); ?></div> 
						</div>
					</div>
			    </div>
			</div>

	<?php else:?>
		<div><?php esc_html_e( 'No products available', 'esell-elements' ); ?></div>
	<?php endif;?>
</div>
<?php wp_reset_postdata();?>