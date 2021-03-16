<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Group_Control_Image_Size;
?>
<div class="brand-slider-wrapper <?php echo esc_attr($settings['theme']);?> owl-nav-po-<?php echo esc_attr( $settings['nav_style'] );?>">
	<?php if ( $settings['section_title_display'] ): ?>
		<div class="wooc-slider-title-block-1">
			<div class="wooc-title-block">
					<?php if ( $settings['sub_title'] ): ?>
				<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
				<div class="clear"></div>
					<?php endif; ?>	
				<h3 class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
			</div>	
			<?php if ( $settings['islink'] ): 
				if ( !empty( $settings['url']['url'] ) ) { ?>
				<div class="woocue-view-btn  owl-nav-<?php echo esc_attr( $settings['slider_nav'] );?>  <?php echo esc_attr( $settings['woocbtnstyle'] );?>">
					<a href="<?php echo esc_url( $settings['url']['url'] );?>" class="wooc-btn">
					  <span><?php echo esc_attr( $settings['btntext'] );?></span>
					  <i class="flaticon-play-button"></i>
					</a>          
				</div>		
			<?php }; ?>		
			<?php endif; ?>	
		</div>
	<?php endif; ?>
	<div class="esell-logo-slider">	
		<div class="woocue-items owl-theme  owl-nav-<?php echo esc_attr( $settings['slider_nav'] );?>  owl-custom-nav-<?php echo esc_attr( $settings['nav_style'] );?> owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">
			<?php foreach ( $settings['esell_brand_list'] as $brandimage ): ?>
		        <div class="single-brand-slider">
		            <?php
		                if( !empty($brandimage['esell_brand_link']) ){
		                    echo sprintf('<a href="%1$s">%2$s</a>',$brandimage['esell_brand_link'],Group_Control_Image_Size::get_attachment_image_html( $brandimage, 'esell_brand_logo_size', 'esell_brand_logo' ) );
		                }else{
		                    echo Group_Control_Image_Size::get_attachment_image_html( $brandimage, 'esell_brand_logo_size', 'esell_brand_logo' ); 
		                }
		            ?>
		        </div>
		    <?php endforeach;?>			
		</div>
	</div>
</div>