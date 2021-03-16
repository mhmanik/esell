<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$nav_menu_args = Helper::nav_menu_args();

$logo          = empty( WOOCTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : WOOCTheme::$options['logo']['url'];
?>
<div class="header-main-block">
	<div class="header-main-block-wrp">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-3 woocue-left">
					<?php get_template_part( 'template-parts/header/icon', 'menu' );?>
				</div>
				<div class="col-md-4 col-4 woocue-middle">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
				</div>
				<div class="col-md-4 col-5 woocue-right">
					
						<?php get_template_part( 'template-parts/header/icon', 'area2' );?>
					
				</div>
			</div>
		</div>		
	</div>	
</div>