<?php
include_once( ESELL_ELEMENTS_BASE_DIR . '/include/custom-post-type-base.php');
/**
 * Megamenu
 */
$megamenu_args = array(
    'menu_icon' => 'dashicons-editor-kitchensink'
);
$megamenu = new Axil_Register_Custom_Post_Type( 'Megamenu', 'Mega Menus', $megamenu_args);
