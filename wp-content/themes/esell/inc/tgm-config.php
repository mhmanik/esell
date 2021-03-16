<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */

class TGM_Config {
    public $prfx = AXIL_THEME_FIX;
    public $path = "http://axilthemes.com/themes/esell/demo/plugins/";

	public function __construct() {
		add_action( 'tgmpa_register', array( $this, 'axil_tgn_plugins' ) );
	}

	public function axil_tgn_plugins(){
		$plugins = array(	
			array(
				'name'         => esc_html__('eSell Core','esell'),
				'slug'         => 'esell-core',
				'source'       => 'esell-core.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
			array(
				'name'         => esc_html__('eSell Demo','esell'),
				'slug'         => 'esell-demo',
				'source'       => 'esell-demo.zip',
				'required'     =>  true,
				'version'      => '1.0'
			),
            array(
                'name'      => esc_html__('Advanced Custom Fields Pro', 'esell'),
                'slug'      => 'advanced-custom-fields-pro',
                'source'	=> 'advanced-custom-fields-pro.zip',
                'required'  => true,
            ),
					
			// Repository
			array(
				'name'     => esc_html__('Redux Framework','esell'),
				'slug'     => 'redux-framework',
				'required' => true,
			),
			array(
				'name'     => esc_html__('MailChimp for WordPress','esell'),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
				'name'     => esc_html__('Smash Balloon Social Photo Feed','esell'),
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => esc_html__('Elementor Page Builder','esell'),
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => esc_html__('Contact Form 7','esell'),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
            array(
                'name'      => esc_html__('One Click Demo', 'esell'),
                'slug'      => 'one-click-demo-import',
                'required'  => true,
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
			)

		);

		$config = array(
			'id'           => $this->prfx,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->prfx . '-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                    // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

new TGM_Config;