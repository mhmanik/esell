<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;


if ( !WOOCTheme::$has_top_bar ) {
	return;
}

/*$has_top_info = WOOCTheme::$options['phone'] || WOOCTheme::$options['email'] ? true : false;
$socials = Helper::socials();

if ( !$has_top_info && !$socials ) {
	return;
}*/

?>
<div class="top-header-inner-info">
	<div class="container">
		<div class="row">
			<div class="header-top-left col-lg-3 col-md-6 col-sm-6 hidden-xs">		
				<?php if ( WOOCTheme::$options['left_txt1'] && WOOCTheme::$options['left_txt2'] ): ?>
				<div>
					<ul class="top-icon-list">
						<?php if ( WOOCTheme::$options['left_txt1'] ): ?>
							<li><i class="fas fa-map-marker-alt"></i><a href="<?php echo esc_url( WOOCTheme::$options['left_link1'] ); ?>">
								<?php echo esc_attr( WOOCTheme::$options['left_txt1'] ); ?> </a></li>
						<?php endif; ?>
						<?php if ( WOOCTheme::$options['left_txt2'] ): ?>
							<li><i class="fas fa-store"></i><a href="<?php echo esc_url( WOOCTheme::$options['left_link2'] ); ?>">
								<?php echo esc_attr(  WOOCTheme::$options['left_txt2'] ); ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<div class="header-top-center col-lg-6 hidden-md hidden-sm hidden-xs">
				<div>
					Welcome to iCraft gift every single day on Weekends – Coupon code: craft 2020
				</div>
			</div>
			<div class="header-top-right col-lg-3 col-md-6 col-sm-6 col-xs-12">		
				<div>
					<ul class="top-icon-list list-right">
						<li><i class="fas fa-map-marker-alt"></i><a href="#">Store Location</a></li>
						<li><i class="fas fa-store"></i><a href="#"> Order Status</a></li>
					</ul>
				</div>		
			</div>
		</div>
	</div>
</div>