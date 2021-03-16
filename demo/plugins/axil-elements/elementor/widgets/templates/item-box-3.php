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
	$btn = '<a class="item-btn" '.$attr.'>'.$settings['btntext'].'</a>';
}
?>

<div class="wooc-item-box-4">
	<div class="product-box woocuef-pos-<?php echo esc_attr( $settings['bg_pos_y_type'] );?> woocuef-pos-<?php echo esc_attr( $settings['bg_pos_x_type'] );?> woocue-pos-<?php echo esc_attr( $settings['pos_y_type'] );?> woocue-pos-<?php echo esc_attr( $settings['pos_x_type'] );?>">
	    <div class="shutter-effect has-animation item-figure figure-<?php echo esc_attr( $settings['img_figure'] );?> item-img woocue-pos-<?php echo esc_attr( $settings['img_pos_y_type'] );?> woocue-pos-<?php echo esc_attr( $settings['img_pos_x_type'] );?> ">	     
	       <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'pimage_size', 'image' );?>	
	    </div>
	    <div class="item-content" data-sal="slide-left" data-sal-duration="800" data-sal-delay="200">
	    	<?php if ( $settings['title'] ): ?>
					<h2 class="item-title woocue-title"><?php echo wp_kses_post( $settings['title'] );?></h2>
				<?php endif; ?>
				<?php if ( $settings['subtitle'] ): ?>
					<div class="woocue-subtitle item-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></div>
				<?php endif; ?>
	       <?php echo $btn;?>        
	    </div>
	</div>
</div>

