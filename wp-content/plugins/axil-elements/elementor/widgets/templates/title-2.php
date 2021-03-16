<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}
if ( $settings['url']['url'] ) {
	$btn = '<a '.$attr.' class="wooc-btn"><span>'.$settings['btntext'].'</span><i class="flaticon-play-button"></i> </a>';
}
?>

<div class="wooc-slider-title-block-1">
	<div class="wooc-title-block <?php echo wp_kses_post( $settings['title_align'] );?>">
		<?php  if($settings['sub_title']){ ?>
			<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
		<?php  } ?>	
		<div class="clear"></div>
		<?php  if($settings['title']){ ?>
		<<?php echo esc_html( $settings['sec_title_tag'] );?> class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></<?php echo esc_html( $settings['sec_title_tag'] );?>>	
		<?php  } ?>			
	</div>	
	<?php if ( $settings['islink'] ): ?>
		<div class="woocue-viewall wooc-btn-icon">
			<?php echo wp_kses_post( $btn );?>
		</div>		
	<?php endif; ?>		
</div>
