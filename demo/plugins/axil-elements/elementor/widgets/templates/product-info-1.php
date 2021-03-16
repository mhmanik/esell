<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
$attr = $btn = '';
if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $settings['btntext'] ) {
	$btn = '<div class="wooc-btn-area"><a class="wooc-btn" '.$attr.'>'.$settings['btntext'].' <i class="flaticon-play-button"></i> </a></div>';
}
$img =   Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );

?>
<div class="wooc-product-info shape-color<?php echo esc_attr( $settings['shape_bg_color'] );?>">	
	<?php if ( $settings['image_posx_type'] == 'top' ) { ?>
		<div class="wooc-product-info-wrp text-center">	
				<?php if( $img ):?>
					<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>		
					</div>	
				<?php endif; ?>
			<div class="wooc-content-area">
				<div class="wooc-content">
					<?php if ( $settings['subtitle'] ): ?>
						<h3 class="wooc-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></h3>
					<?php endif; ?>
					<?php if ( $settings['title'] ): ?>
						<h4 class="wooc-title"><?php echo wp_kses_post( $settings['title'] );?></h4>
					<?php endif; ?>
					<?php echo $btn;?>
					
				</div>
			</div>			
		</div>	
		<?php }else{ ?>
		<div class="wooc-product-info-wrp media">
		<?php if ( $settings['image_posx_type'] == 'left' ) { ?>
			<?php if( $img ):?>
			<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>
			</div>
			<?php endif; ?>
		<?php } ?>
			<div class="wooc-content-area media-body">
				<div class="wooc-content">
					<?php if ( $settings['subtitle'] ): ?>
						<h3 class="wooc-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></h3>
					<?php endif; ?>
					<?php if ( $settings['title'] ): ?>
						<h4 class="wooc-title"><?php echo wp_kses_post( $settings['title'] );?></h4>
					<?php endif; ?>
					<?php echo $btn;?>
					
				</div>
			</div>	
			<?php if ( $settings['image_posx_type'] == 'right' ) { ?>
			<?php if( $img ):?>
			<div class="wooc-img wooc-posx-<?php echo esc_attr( $settings['image_posx_type'] );?>">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>
			</div>
			<?php endif; ?>
		<?php } ?>
		</div>	
	<?php } ?>
</div>