<?php
/*
Plugin Name: WoocTheme One Click Demo Importer
Plugin URI: https://www.WoocTheme.com
Description: Mixlax One Click Demo Importer for Mixlax Theme
Version: 1.0
Author: Vecuro
Author URI: https://www.WoocTheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined( 'MIXLAXOCDI' ) ) {
	define( 'MIXLAXOCDI',  					( WP_DEBUG ) ? time() : '1.0' );	
	define( 'MIXLAXOCDI_FILE', 				plugin_dir_path( __FILE__ ) ); 	
	define( 'MIXLAXOCDI_DIR', 				plugin_dir_path( __DIR__ ) );
	define( 'MIXLAXOCDI_PREVIEW', 			plugins_url( 'mixlax-ocdi-demo-importer/ocdi-demo/preview/', dirname(__FILE__) ) );	
	define( 'MIXLAXOCDI_PREVIEW_LINK', 		'http://vecurosoft.com/products/wordpress/mixlax/');	
	define( 'MIXLAXOCDI_PREFIX',      		'mixlaxocdi' );
}

class mixlax_ocdi_demo_importer_int {
	public $plugin  = 'mixlax-ocdi-demo-importer';
	public function __construct() {	
		add_action( 'plugins_loaded', 		array( $this, 'mixlax_demo_importer' ), 20 );		
		add_action( 'plugins_loaded', 		array( $this, 'mixlax_load_textdomain' ), 20 );		
	}
	public function mixlax_load_textdomain()
    {
        load_plugin_textdomain($this->plugin, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
	public function mixlax_demo_importer() {			
		require_once 'demo-importer-ocdi.php';		
	}		
	
}
new mixlax_ocdi_demo_importer_int;