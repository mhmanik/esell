<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Widget_Base;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Product_Banner_Slider2 extends Widget_Base {

 public function get_name() {
        return 'wooc-product-banner-slider2';
    }    
    public function get_title() {
        return __( 'Product Banner Slider', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'services_layout',
            [
                'label' => __( 'Layout / Theme', 'esell-elements' ),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => __( 'Layout', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'esell-elements' ),
                    '2'   => __( 'Style 2', 'esell-elements' ),
                    '3'   => __( 'Style 3', 'esell-elements' ),                        
                ],
            ] 
        );             

         $this->add_control(      
            'product_ids',
                [
                'label' => __( 'Select The Posts that will not display', 'esell-elements' ),
                'type' => Controls_Manager::SELECT2,
                'options'       => wooc_product_post_name(),                  
                'label_block'   => true,
                'multiple'      => true,
                'separator'     => 'before',
                ] 
            );


      /*	$this->add_control(
            'product_ids',
            [
                'label' => __( 'Product IDs, seperated by commas', 'esell-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Product IDs, seperated by commas', 'esell-elements' ),
                'placeholder' => __( 'Info box title', 'esell-elements' ),
            ]
        );	
        */	
       $this->end_controls_section();   
    }


	private function wooc_build_query( $data ) {

		$posts = $data['product_ids'];
        
			$args = array(
				'post_type'      => 'product',
				'ignore_sticky_posts' => true,
				'nopaging'       => true,
				'post__in'       => $posts,
				'orderby'        => 'post__in',
			);
		
		return new \WP_Query( $args );
	}
    
private function slick_load_scripts(){
        wp_enqueue_style(  'slick' );
        wp_enqueue_style(  'slick-theme' );
        wp_enqueue_script( 'slick' );
    }


    protected function render() {      
        $settings = $this->get_settings();
        $this->slick_load_scripts();
		$settings['query'] = $this->wooc_build_query( $settings );
		$template = 'view';
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );

    }
}