<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */


use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
$attr = '';
$btn = '';
if ( !empty( $settings['url']['url'] ) ) {
	$attr  = 'href="' . $settings['url']['url'] . '"';
	$attr .= !empty( $settings['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $settings['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$title = '<a ' . $attr . '>' . $settings['title'] . '</a>';
}
if ( !empty( $settings['buttontext'] ) ) {
    $btn = '<a class="btn-outline" ' . $attr . '>' . $settings['buttontext'] . ' <i class="flaticon-user"></i></a>';
}
?>		
<div class="contact-us-box <?php echo wp_kses_post( $settings['theme'] );?>">
	<div class="contact-information-area">
		<div class="contact-information">			  
		  <span class="icon"><?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
		  <h2 class="title"><?php echo wp_kses_post( $settings['title'] );?></h2>
			  <div class="sub-contact-information">
				  <p class="sub-title"><?php echo wp_kses_post( $settings['phone_lab'] );?><a href="tel:<?php echo wp_kses_post( $settings['phone'] );?>"><?php echo wp_kses_post( $settings['phone'] );?></a></p>
				  <p class="sub-title"><?php echo wp_kses_post( $settings['email_lab'] );?> <a href="mailto:<?php echo wp_kses_post( $settings['email'] );?>"><?php echo wp_kses_post( $settings['email'] );?></a></p>
				  <p class="sub-title"><?php echo wp_kses_post( $settings['office_lab'] );?> <?php echo wp_kses_post( $settings['office'] );?></p>		
			 </div>
		  <?php echo wp_kses_post( $btn );?> 
		</div>
	</div>
</div>
