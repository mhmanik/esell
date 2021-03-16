<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
$socials = Helper::socials();
?>
<div class="top-header-inner-info top-layout-2">
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
			<div class="header-top-right col-lg-9 col-md-6 col-sm-6 col-xs-12">		
				<div class="info-top">
					<i class="fas fa-bell"></i> &nbsp; <span>Welcome to iCraft ! Wrap new offers / gift every single day on Weekends – Coupon code: craft 2020</span>
				</div>		
			</div>
		</div>
	</div>
</div>