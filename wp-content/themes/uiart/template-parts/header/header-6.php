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
		<div class="site-logo icon-menu">				
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
		</div>
			
	</div>
</div>
<div class="header-main-block">
	<div class="container">
		<div class="row align-items-center">			
			<div class="col-lg-2">
			<?php if ( WOOCTheme::$options['has_offcanvas'] ) {
					get_template_part( 'template-parts/header/icon', 'menu' );					
				}?>
			</div>
			<div class="col-lg-8">
				<div class="main-navigation-area def-layout">
					<div class="main-navigation"><?php wp_nav_menu( $nav_menu_args );?></div>
				</div>					
			</div>	
			<div class="col-lg-2">
				<?php get_template_part( 'template-parts/header/icon', 'area' );?>		
			</div>		
		</div>
	</div>
</div>
