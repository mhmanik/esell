<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$nav_menu_args = Helper::nav_menu_args();
$logo          = empty( WOOCTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : WOOCTheme::$options['logo']['url'];
$logo_width    = (int) WOOCTheme::$options['logo_width'];
$menu_width    = 12 - $logo_width;
$logo_class    = "col-lg-{$logo_width} col-sm-12 col-12";
$menu_class    = "col-lg-{$menu_width} col-sm-12 col-12";
?>
<div class="header-mid-block">
	<div class="container">
		<div class="row align-items-center">
			<div class="navbar-logo col-lg-2 col-md-3 col-sm-4 col-xs-12">
				<div class="site-logo icon-menu">				
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">				
				<?php get_template_part( 'template-parts/header/header', 'search' );?>	
			</div>
			<div class="header-mid-right col-lg-4 col-md-4 col-sm-4 col-xs-12">			
				<?php get_template_part( 'template-parts/header/icon', 'area-mid' );?>
			</div>
		</div>
	</div>
</div>
<div class="header-main-block custom-col">
	<div class="container">
		<div class="row align-items-center">			
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pr0 custom-col-lg-3">
				<?php get_template_part( 'template-parts/vertical-menu-toggle' );?>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 custom-col-lg-9">
				<div class="row align-items-center border-def">	
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">							
						<div class="main-navigation-area def-layout">
							<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<ul class="header-main-right-right">
							<li class="hotline"><i class="fa fa-phone-square"></i>Hotline: <a href="tel:1234567890">(+123) 456 7890</a></li>						
						</ul>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
