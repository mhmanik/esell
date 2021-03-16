<?php
include_once( BLOGAR_ADDONS_DIR . '/include/custom-post-type-base.php');
/**
 * Megamenu
 */
$megamenu_args = array(
    'menu_icon' => 'dashicons-editor-kitchensink'
);
$megamenu = new Axil_Register_Custom_Post_Type( 'Megamenu', 'Mega Menus', $megamenu_args);






