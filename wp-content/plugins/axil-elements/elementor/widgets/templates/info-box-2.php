<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
$attr = '';
if ( !empty( $settings['posterurl']['url'] ) ) {
	$attr  = 'href="' . $settings['posterurl']['url'] . '"';
	$attr .= !empty( $settings['posterurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['posterurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}
$wrapper_start = '<div class="es-item">';
$wrapper_end   = '</div>';

	if ( $settings['posterurl']['url'] ) {
		$wrapper_start = '<a class="es-item" ' . $attr . '>';
		$wrapper_end   = '</a>';
	}
?>

<div class="single-poster">
   <?php echo wp_kses_post( $wrapper_start);?>
       <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>	
        <div class="poster-content">
            <div class="inner">
                <h2 class="title">Up to <span class="poster-sticker">60%</span> <br> off Sale</h2>

                <?php if ( $settings['subtitle'] ): ?>
                	<span class="info-subtitle sub-title"><?php echo wp_kses_post( $settings['subtitle'] );?></span>
                <?php endif; ?>	

            </div>
        </div>   
     <?php echo wp_kses_post( $wrapper_end );?>
</div>