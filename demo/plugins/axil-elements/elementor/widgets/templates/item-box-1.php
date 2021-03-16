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
$class = 'wooc-box-style-'.$settings['style'];

if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( $settings['btntext'] ) {
	$btn = '<div class="wooc-box-btn-area">
		<a class="woocue-btn" '.$attr.'>'.$settings['btntext'].'</a>
	</div>';
}

?>
<div class="wooc-item-box-2 <?php echo esc_attr( $class );?>">
	<div class="wooc-box">

		<div class="woocue-content">
			<?php if ( $settings['title'] ): ?>
				<h3 class="woocue-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
			<?php endif; ?>

			<?php if ( $settings['subtitle'] ): ?>
				<p class="woocue-subtitle"><?php echo wp_kses_post( $settings['subtitle'] );?></p>
			<?php endif; ?>

			<?php echo $btn;?>
		</div>
	</div>
</div>
