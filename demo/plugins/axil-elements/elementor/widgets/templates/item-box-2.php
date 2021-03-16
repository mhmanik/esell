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

<div class="wooc-item-box-3">

	<div class="product-box <?php echo esc_attr( $settings['style2'] );?>">
	    <div class="item-img">
	       <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' );?>
	    </div>
	    <div class="item-content" data-sal="slide-left" data-sal-duration="800" data-sal-delay="200">
	    	<?php if ( $settings['title'] ): ?>
					<h2 class="item-title rtin-title"><?php echo wp_kses_post( $settings['title'] );?></h2>
				<?php endif; ?>
				<?php if ( $settings['subtitle'] ): ?>
					<p class="item-subtitle rtin-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></p>
				<?php endif; ?>
	       <?php echo $btn;?>        
	    </div>
	</div>

</div>
