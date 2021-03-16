<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package esell
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
	$axil_options = Helper::axil_get_options();
	$sidebar = 		Helper::wooc_axil_sidebar_options();
	
	
?>

<div id="axil-blog-sidebar" class="widget-area axil-blog-sidebar">
    <?php echo Helper::ad_post_before_sidebar(); 
    if ($sidebar) {
            dynamic_sidebar( $sidebar );
        } else {
            dynamic_sidebar('sidebar-1');
        }
        echo Helper::ad_post_after_sidebar(); ?>
</div><!-- #secondary -->