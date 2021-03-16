<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

class Activation {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_switch_theme', array( $this, 'init' ) );		
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init() {
		if ( !get_option( 'uiart_activated_before' ) ) {
			update_option( 'uiart_activated_before', 'yes' );
			$this->custom_sidebar();
			$this->set_elementor_default_options();
			$this->set_woocommerce_default_options();
		}
	}

	public function custom_sidebar() {
		$widget = array (
			'wooctheme-sidebar-woocommerce-sidebar' => array (
				'id' => 'wooctheme-sidebar-woocommerce-sidebar',
				'name' => 'Woocommerce Sidebar',
				'class' => 'wooctheme-custom',
				'description' => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			),
		);

		update_option( 'uiart_custom_sidebars', $widget );
	}

	public function set_elementor_default_options() {
		$data = array(
			'elementor_disable_typography_schemes' => 'yes',
			'elementor_disable_color_schemes'      => 'yes',
			'elementor_css_print_method'           => 'internal',
			'elementor_cpt_support'                => array( 'page' ),
			'elementor_container_width'            => '1310',
			'elementor_viewport_lg'                => '992',

			'_elementor_general_settings'          => array(
				'default_generic_fonts' => 'Sans-serif',
				'global_image_lightbox' => 'yes',
				'container_width'       => '1310',
			),
			'_elementor_global_css' 	=> array(
				'time'   => '1534145031',
				'fonts'  => array(),
				'status' => 'inline',
				'0'      => false,
				'css'    => '.elementor-section.elementor-section-boxed > .elementor-container{max-width:1310px;}',
			),
		);

		foreach ( $data as $key => $value ) {
			update_option( $key, $value );
		}
	}

	public function set_woocommerce_default_options() {
		update_option( 'woocommerce_single_image_width', '570' ); // 570x653
		update_option( 'woocommerce_thumbnail_image_width', '360' );
		update_option( 'woocommerce_thumbnail_cropping', 'custom' );
		update_option( 'woocommerce_thumbnail_cropping_custom_width', '5' );
		update_option( 'woocommerce_thumbnail_cropping_custom_height', '6' );
	}
}

Activation::instance();