<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
$img =   Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );
?>
<div class="wooc-countdown woocjs-coutdown">
	<div class="wooc-countdown-wrp">
	<div class="wooc-countdown-image"><?php echo wp_kses_post( $img );?></div>
		<?php if ( $settings['regular_price'] || $settings['sale_price'] ): ?>
			<div class="wooc-countdown-price">
				<?php if ( $settings['sale_price'] ): ?>
					<span class="wooc-sale-price"><?php echo esc_html( $settings['sale_price'] );?></span>
				<?php endif; ?>	
				<?php if ( $settings['regular_price'] ): ?>
					<span class="wooc-reg-price"><?php echo esc_html( $settings['regular_price'] );?></span>
				<?php endif; ?>
							
			</div>
		<?php endif; ?>		
		<?php if ( $settings['title'] || $settings['subtitle'] ): ?>
			<div class="wooc-countdown-title-area">	
				<?php if ( $settings['title'] ): ?>
					<div class="wooc-countdown-title"><?php echo wp_kses_post( $settings['title'] );?></div>
				<?php endif; ?>
				<?php if ( $settings['subtitle'] ): ?>
					<div class="wooc-countdown-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></div>
				<?php endif; ?>				
			</div>
		<?php endif; ?>
		<?php if ( $settings['date'] ): ?>
			<div class="wooc-countdown-coutdown wooc-scripts-date clearfix" data-time="<?php echo esc_attr( $settings['date'] ); ?>"></div>
		<?php endif; ?>
	</div>	
</div>