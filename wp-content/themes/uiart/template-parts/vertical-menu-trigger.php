<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
$locations = get_nav_menu_locations();
if ( !array_key_exists( 'vertical', $locations ) ) return;
?>

<div class="additional-menu-area icon-menu">	
	<a href="#" class="closebtn close"><i class="fa fa-times"></i></a>
	<span class="side-menu-open side-menu-trigger">
		<i class="fa fa-bars"></i>
	</span>
</div>