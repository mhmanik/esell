<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>
<div id="wooctheme-search-popup">
	<button type="button" class="close">×</button>
	<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" name="s" value="<?php echo get_search_query();?>" placeholder="<?php esc_html_e( 'Type here........' , 'uiart' );?>" />
		<button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
	</form>
</div>