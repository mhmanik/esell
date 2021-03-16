<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$nav_menu_args = Helper::nav_menu_args();
$dark_logo           = empty( WOOCTheme::$options['logo_dark']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : WOOCTheme::$options['logo_dark']['url'];
$light_logo          = empty( WOOCTheme::$options['logo_light']['url'] ) ? Helper::get_img( 'logo-light.png' ) : WOOCTheme::$options['logo_light']['url'];
$logo_width    = (int) WOOCTheme::$options['logo_width'];
$menu_width    = 12 - $logo_width;
$logo_class    = "col-lg-2 col-sm-12 col-12";
$menu_class    = "col-lg-10 col-sm-12 col-12";
?>

<div class="header-main-block menu-dark">
	<div class="container">
		<div class="row align-items-center">
			<div class="<?php echo esc_attr( $logo_class );?>">
				<div class="site-logo icon-menu">			
				
					<a class="logo temp-logo dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $dark_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
					<a class="logo temp-logo light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $light_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
			
				</div>
			</div>
			<div class="<?php echo esc_attr( $menu_class );?>">
				<div class="main-navigation-area">
					<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
					<?php get_template_part( 'template-parts/header/icon', 'area' );?>					
				</div>
			</div>
		</div>
	</div>
</div>