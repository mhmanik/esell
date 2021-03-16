<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
if ( ! class_exists( '\wooctheme\uiart_elements\Navmenu_Walker' ) ) return;
$icon_display = true;
	wp_nav_menu( array( 
		'theme_location'  => 'account',
		'container'       => 'nav',
		'container_class' => 'account-menu',
		'menu_class'      => 'dropdown-list',
		'fallback_cb'     => false,
		'walker'          => new \wooctheme\uiart_elements\Navmenu_Walker( $icon_display )
	) );
?>

