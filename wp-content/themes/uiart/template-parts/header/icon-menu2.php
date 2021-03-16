<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */
namespace wooctheme\Uiart;
$locations = get_nav_menu_locations();

if ( !array_key_exists( 'vertical', $locations ) ) return;
if ( ! class_exists( '\wooctheme\uiart_elements\Navmenu_Walker' ) ) return;

$menu_obj = get_term( $locations['vertical'], 'nav_menu' );
$menu_name = $menu_obj->name;
$icon_display = true;
$text_display = true;
$toggle_display = false;
$logo  = empty( WOOCTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : WOOCTheme::$options['logo']['url'];
?>

<div class="additional-menu-area additional-menu-icon4">
	<div  class="sidenav additional-menu-msidebar" data-simplebar>
			<a href="#" class="closebtn"><i class="flaticon-cancel-1"></i></a>
	        <div class="nav-item">
	        	<?php if ( WOOCTheme::$options['offcanvas_title'] ): ?> 
	            <span class="offcanvas_title"><?php echo WOOCTheme::$options['offcanvas_title']; ?> </span>
	        <?php endif; ?>
	        	<?php
				wp_nav_menu( array( 
					'theme_location'  => 'vertical',
					'container'       => 'nav',
					'container_class' => 'vertical-menu',
					'menu_class'           => 'menu menu-list',
					'fallback_cb'     => false,
					'walker'          => new \wooctheme\uiart_elements\Navmenu_Walker( $icon_display, $text_display , $toggle_display)
				) );
				?>
	        </div>		 		
	</div>
	<span class="side-menu-open side-menu-trigger">
	<i class="flaticon-menu-4"></i>
	</span>
</div>