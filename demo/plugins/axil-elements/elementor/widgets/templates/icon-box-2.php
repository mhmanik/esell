<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */
namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

?>

<div class="wooc-icon-wrp media layout-<?php echo wp_kses_post( $settings['style'] );?> layout-<?php echo wp_kses_post( $settings['colortype'] );?>">		
	<?php if ( $settings['icontype'] == 'image' ): ?>
		<div class="img-box">
			<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?> 
		 </div>
		<?php else: ?>
		<div class="feature-icon">
			<?php Icons_Manager::render_icon( $settings['icon'] ); ?>
		</div>
	<?php endif; ?>	

	<div class="wooc-content-area media-body">
		<div class="wooc-content">
			
			<?php if ( $settings['title'] ): ?>
				<h2 class="wooc-title"><?php echo wp_kses_post( $settings['title'] );?></h2>
			<?php endif; ?>		
			<?php if ( $settings['subtitle'] ): ?>
				<span class="wooc-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></span>
			<?php endif; ?>
			
		</div>
	</div>			
</div>	