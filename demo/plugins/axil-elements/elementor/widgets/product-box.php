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
use Elementor\DATE_TIME;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Box extends Widget_Base {

 public function get_name() {
        return 'wooc-product-box';
    }    
    public function get_title() {
        return __( 'Product Box', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {
        
        $args = array(
			'post_type'           => 'product',
			'posts_per_page'      => -1,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'ignore_sticky_posts' => true,
		);
		$products = get_posts( $args );
		$products_dropdown = array();

		foreach ( $products as $product ) {
			$products_dropdown[$product->ID] = $product->post_title;
		}



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
                   '1' => __( 'Style 1', 'esell-elements' ),
					'2' => __( 'Style 2', 'esell-elements' ),				                 
                ],
            ] 
        );             


         $this->add_control(      
            'p_id',
                [
                'label' => __( 'Product', 'esell-elements' ),
                'type' => Controls_Manager::SELECT2,
               	'options'     => $products_dropdown,               
                'label_block'   => true,                
                'default'     => '0',
                'separator'     => 'before',
                ] 
            );



			$this->add_control(
			    'image',
			    [
			        'label' => __('Replace Product Image','esell-elements'),
			        'type'=>Controls_Manager::MEDIA,
			        'default' => [
			            'url' => Utils::get_placeholder_image_src(),
			        ],
			        'dynamic' => [
			            'active' => true,
			        ],
			            
			    ]
			);

			$this->add_group_control(
			    Group_Control_Image_Size::get_type(),
			    [
			        'name' => 'image_size',
			        'default'  => 'woocommerce_thumbnail',
			        'separator' => 'none',			         
			    ]
			);


			$this->add_control(
			'cat_display',
				[
				    'label' => __( 'Category Name Display', 'esell-elements' ),
				    'type' => Controls_Manager::SWITCHER,
				    'label_on'    => __( 'On', 'esell-elements' ),
				    'label_off'   => __( 'Off', 'esell-elements' ),
				    'default'     => 'no',
				   
				]
			);   

       $this->end_controls_section();   
    }
    
	protected function render() {
		$settings = $this->get_settings();
		$template = 'product-box';		
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}