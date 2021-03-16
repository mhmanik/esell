<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;


$thumb_size = array( 158, 155 );

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
	$btn = '<a class="wooc-button-df" '.$attr.'><i class="flaticon-shopping-bag-3"></i> <span> '.$settings['btntext'].'</span></a>';
}
if ( $settings['url2']['url'] ) {
	$btn2 = '<a class="wooc-button-df" '.$attr2.'><i class="flaticon-shopping-bag-4"></i> <span> '.$settings['btntext2'].'</span></a>';
}


 $tabs =   $content = "";
?>

<div class="wooc-product-banner layout-<?php echo esc_attr( $settings['style'] );?>">	
	<?php foreach ( $settings['plists'] as $plist ): ?>
	<?php    

	if ( $plist['offer_info'] ) {
		$offer_info = '<div class="woocue-price-popup price'.$plist['offer_info_tyle'].'">'.$plist['offer_info'].'</div>';
	}else{
		$offer_info = "";
	}

	$simage = !empty( $plist['image']['id'] ) ? wp_get_attachment_image( $plist['image']['id'], 'axiltheme-90x120' ) : false;
	$image = !empty( $plist['image']['id'] ) ? wp_get_attachment_image( $plist['image']['id'], 'axiltheme-430x560' ) : false;

    $tabs .= '<div class="nav-item content-block">
	<div class="media item-bg align-items-center"><div class="nav-item-image"> '. $simage   .' </div>
		<div class="media-body">
			<h2 class="ptitle">'. $plist['ptitle']. '</h2>';
			if ( $plist['regular_price'] || $plist['sale_price'] ): 
				$tabs .= '<div class="wooc-price">';
					 if ( $plist['regular_price'] ): 
						$tabs .=  '<span class="wooc-reg-price">' . esc_html( $plist['regular_price'] ) .'</span>';
					endif; 		
					 if ( $plist['sale_price'] ): 
						$tabs .= '<span class="wooc-sale-price">  -  ' . esc_html( $plist['sale_price'] ) .' </span>';
					 endif; 
						
				$tabs .=  '</div>';
			 endif; 
	          $tabs .=  '</div>
         </div>
   	</div>';
   $content .= '<div class="product-image-content">';     
		if($plist['image']['id'])  {
			$content .= '<div class="item-img slider-big-img"> '. $offer_info  .'<span class="bg-shape bg-shape-color bg-shape-color"></span>'. $image . '</div>';
		}
  $content .= ' </div>'; ?>
	  <?php endforeach;?>
		<div class="container">
		    <div class="banner-row align-items-center">	
				<div class="banner-lg-5">
					<div class="product-banner-left">
						<p><?php echo wp_kses_post( $settings['subtitle'] );?></p>
						<h2 class="banner-title"><?php echo wp_kses_post( $settings['title'] );?></h2>
						<div class="banner-link-set">
							
								<div class="wooc-btn-common">
									<?php echo wp_kses_post( $btn );?>
								</div>
								<div class="wooc-btn-common-df">
									<?php echo wp_kses_post( $btn2 );?>
								</div>

						</div>
					</div>
				</div>
				<div class="banner-lg-7">
					<div class="banner-slick-row align-items-center">
						<div class="banner-slick-7 slick-carousel-content product-banner-img"><?php echo wp_kses_post( $content ); ?></div>
						<div class="banner-slick-4 slick-carousel-nav product-banner-nav-img"><?php echo wp_kses_post( $tabs ); ?></div> 
					</div>
				</div>
		    </div>
		</div>
	</div>
