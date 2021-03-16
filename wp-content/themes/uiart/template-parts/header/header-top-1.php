<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

?>
<div class="top-header-inner-info">
	<div class="container-fluid">
		<div class="row">
			<div class="header-top-left col-lg-3 col-md-6 col-sm-6 hidden-xs">		
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
			</div>
			<div class="header-top-center col-lg-6 hidden-md hidden-sm hidden-xs">
				<div>
					Welcome to iCraft ! Wrap new offers / gift every single day on Weekends – Coupon code: craft 2020
				</div>
			</div>
			<div class="header-top-right col-lg-3 col-md-6 col-sm-6 col-xs-12">		
				<div>
					<ul class="top-icon-list">
						<li><i class="fas fa-map-marker-alt"></i><a href="#">Store Location</a></li>
						<li><i class="fas fa-store"></i><a href="#"> Order Status</a></li>
					</ul>
				</div>		
			</div>
		</div>
	</div>
</div>