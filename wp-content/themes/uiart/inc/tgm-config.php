<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.1
 */

namespace wooctheme\Uiart;
class TGM_Config {	
	public $prefix;
	public $path;
	public function __construct() {
		$this->prefix = Constants::$theme_prefix;
		$this->path   = Constants::$theme_plugins_dir;
		add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
	}
	public function register_required_plugins(){
		$plugins = array(
			// Bundled
			array(
				'name'         => 'LayerSlider WP',
				'slug'         => 'LayerSlider',
				'source'       => 'LayerSlider.zip',
				'required'     => false,
				'version'      => '6.11.2'
				
			),
			array(
				'name'         => 'Uiart Elements',
				'slug'         => 'uiart-elements',
				'source'       => 'uiart-elements.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
			array(
				'name'         => 'WoocTheme Helper',
				'slug'         => 'wooc-theme-helper',
				'source'       => 'wooc-theme-helper.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
			array(
				'name'         => 'WoocTheme Demo Importer Helper',
				'slug'         => 'wooc-demo-importer-helper',
				'source'       => 'wooc-demo-importer-helper.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
			array(
				'name'         => 'WoocTheme Product Gallery Slider for WooCommerce',
				'slug'         => 'wooc-product-gallery-slider',
				'source'       => 'wooc-product-gallery-slider.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
			array(
				'name'     => 'CMB2',
				'slug'     => 'cmb2',
				'required' => true,
			),
			array(
				'name'     => 'Redux Framework',
				'slug'     => 'redux-framework',
				'required' => true,
			),
			array(
				'name'     => 'Elementor Page Builder',
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => 'Contact Form 7 Extension For Mailchimp',
				'slug'     => 'contact-form-7-mailchimp-extension',
				'required' => false,
			),
			array(
				'name'     => 'Smash Balloon Instagram Feed',
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => 'YITH WooCommerce Quick View',
				'slug'     => 'yith-woocommerce-quick-view',
				'required' => false,
			),
			array(
				'name'     => 'YITH WooCommerce Wishlist',
				'slug'     => 'yith-woocommerce-wishlist',
				'required' => false,
			),
		);

		$config = array(
			'id'           => $this->prefix,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->prefix . '-install-plugins', // Menu slug.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		);

		tgmpa( $plugins, $config );
	}
}

new TGM_Config;