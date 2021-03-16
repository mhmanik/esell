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
$wrapper_start = '<div class="info-item-banner">';
$wrapper_end   = '</div>';

if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if ( $settings['url']['url'] ) {
	$btn = '<a class="axil-btn" ' . $attr . '>'.$settings['detail_txt'] .'</a>';
	
	}
?>

<div class="axil-slider info-box has-radius-wrapper bg_image bg_image--6">
	<?php echo wp_kses_post( $wrapper_start);?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="inner text-left">
            	<?php if ( $settings['subtitle'] ): ?>
                	<span class="info-subtitle title-highlighter mb--10"><?php echo wp_kses_post( $settings['subtitle'] );?></span>
                <?php endif; ?>	
                <h1 class="h2 info-title"><?php echo wp_kses_post( $settings['title'] );?></h1>
               <?php echo wp_kses_post( $btn );?>
            </div>
        </div>
    </div>
    <?php echo wp_kses_post( $wrapper_end );?>
</div>

