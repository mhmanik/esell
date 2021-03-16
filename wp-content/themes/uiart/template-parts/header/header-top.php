<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

/*
if ( !WOOCTheme::$has_top_bar ) {
	return;
}

$has_top_info = WOOCTheme::$options['phone'] || WOOCTheme::$options['email'] ? true : false;
$socials = Helper::socials();

if ( !$has_top_info && !$socials ) {
	return;
}*/

$socials = Helper::socials();
?>
<div class="top-header-inner-info top-layout-2">
	<div class="container">
		<div class="row">
			<div class="header-top-left col-lg-3 col-md-6 col-sm-6 hidden-xs">		
				<div>
					<ul class="top-icon-list">
						<li><i class="fas fa-map-marker-alt"></i><a href="#">Store Location</a></li>
						<li><i class="fas fa-store"></i><a href="#"> Order Status</a></li>
					</ul>
				</div>
			</div>			
			<div class="header-top-right col-lg-9 col-md-6 col-sm-6 col-xs-12">		
				<div>
					<ul class="top-icon-list">
						<li><i class="fas fa-map-marker-alt"></i><a href="#">Store Location</a></li>
						<li><i class="fas fa-store"></i><a href="#"> Order Status</a></li>
						<li>
						<?php if ( WOOCTheme::$options['social_icons'] && $socials ): ?>
							<div class="footer-social-wrp footer-social-hendalar align-items-center">
								<ul class="footer-social">
									<?php foreach ( $socials as $social ): ?>
										<li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><i class="fab <?php echo esc_attr( $social['icon'] );?>"></i></a></li>
									<?php endforeach; ?>					
								</ul>
							</div>
						<?php endif; ?>
						</li>
					</ul>
				</div>		
			</div>
		</div>
	</div>
</div>