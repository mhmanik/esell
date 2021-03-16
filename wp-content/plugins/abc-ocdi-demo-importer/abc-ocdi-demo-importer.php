<?php
/*
Plugin Name: abc-ocdi-demo-importer
Plugin URI: https://www.abctechweb.net
Description: Abc Ocdi Demo Importer for Tact Theme
Version: 1.0
Author: abctechweb
Author URI: https://www.abctechweb.net
*/

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined( 'ABCOCDI' ) ) {
	define( 'ABCOCDI',  				( WP_DEBUG ) ? time() : '1.0' );	
	define( 'ABCOCDI_FILE', 			plugin_dir_path( __FILE__ ) ); 	
	define( 'ABCOCDI_DIR', 				plugin_dir_path( __DIR__ ) );
	define( 'ABCOCDI_PREVIEW', 			plugins_url( 'abc-ocdi-demo-importer/ocdi-demo/preview/', dirname(__FILE__) ) );	
	define( 'ABCOCDI_PREVIEW_LINK', 	'https://abctechweb.net/envato/wptheme/tact/');	
	define( 'ABCOCDI_PREFIX',      		'abcocdi' );
}

class abc_ocdi_demo_importer {
	public $plugin  = 'abcocdi';
	public function __construct() {	
		add_action( 'plugins_loaded', 		array( $this, 'abcocd_demo_importer' ), 20 );		
		add_action( 'plugins_loaded', 		array( $this, 'abctw_load_textdomain' ), 20 );		
	}
	public function abctw_load_textdomain()
    {
        load_plugin_textdomain($this->plugin, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
	public function abcocd_demo_importer() {			
		require_once 'demo-importer-ocdi.php';		
	}		
	
}
new abc_ocdi_demo_importer;