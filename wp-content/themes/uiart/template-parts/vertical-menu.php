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
$text_display = false;
$toggle_display = true;
?>
<div class="left-icon-menu">	
	<div class="icon-menu-wrp">
		<div class="vertical-menu-area opened vertical-icon-area">
			<?php
				wp_nav_menu( array( 
					'theme_location'  => 'vertical',
					'container'       => 'nav',
					'container_class' => 'vertical-menu',
					'fallback_cb'     => false,
					'walker'          => new \wooctheme\uiart_elements\Navmenu_Walker( $icon_display, $text_display, $toggle_display )
				) );
				?>
		</div>
	</div>
</div>
