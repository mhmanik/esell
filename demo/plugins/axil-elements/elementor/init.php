<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		$this->section_water_ripple_effect();

		add_action( 'elementor/widgets/widgets_registered', 	array( $this, 'elementor_widgets_control' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		add_action( 'elementor/editor/after_enqueue_styles',    array( $this, 'editor_style' ) );
	}
	public function section_water_ripple_effect() {
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'add_ripple_animation_option' ) );
		add_action( 'elementor/frontend/section/before_render',            array( $this, 'render_ripple' ) );
	}
	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .axiltheme-el-custom{content: url('.$img.');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.select2-container--default .select2-selection--single {min-width: 126px !important; min-height: 30px !important;}' );
	}
	public function add_ripple_animation_option( $args ) {
		$args['Theme'] = array( 'wooc-ripple' => 'Water Ripple' );
		return $args;
	}
	public function render_ripple( $obj ) {
		$data = $obj->get_settings();
		if ( $data['animation'] == 'wooc-ripple' ) {
			$obj->add_render_attribute( '_wrapper', 'class', 'wooc-water-ripple' );
			wp_enqueue_script( 'jquery-ripples' );
		}
	}


	public function elementor_widgets_control(){
		if ( did_action( 'elementor/loaded' ) ) {			
			require_once 'base.php';
		}
	}


	public function widget_categoty( $class ) {
		$id         = ESELL_ELEMENTS_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = array(
			'title' => __( 'AxilTheme Elements', 'esell-elements' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
}

new Custom_Widget_Init();