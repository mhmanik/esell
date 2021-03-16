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
<div class="vertical-menu-area">
	<div class="vertical-menu-btn">
		<img class="woocue-menubar" src="<?php echo Helper::get_img( 'menubar.png' );?>" alt="menu">
		<img class="woocue-crossbar" src="<?php echo Helper::get_img( 'crossbar.png' );?>" alt="menu">
		<h3 class="woocue-title"><?php echo esc_html( $menu_name );?></h3>
	</div>
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