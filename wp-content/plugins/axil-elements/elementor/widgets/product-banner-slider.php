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

class Product_Banner_Slider extends Widget_Base {

 public function get_name() {
        return 'wooc-product-banner-slider';
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
                    '4'   => __( 'Style 4', 'esell-elements' ),                        
                ],
            ] 
        );   
        
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Title', 'esell-elements' ),
                'placeholder' => __( 'Title', 'esell-elements' ),
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Sub Title', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Sub title', 'esell-elements' ),
                'placeholder' => __( 'Sub title', 'esell-elements' ),
            ]
        );  


        $this->add_control(
            'bg_title',
            [
                'label' => __( 'Background Text', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Fashion', 'esell-elements' ),
                'placeholder' => __( 'Fashion', 'esell-elements' ),
                 'condition' => array( 'style' => array('4') ),
            ]
        );
       $this->end_controls_section(); 

        $this->start_controls_section(
            'filter_product_sec',
                [
                    'label' => __( 'Filter Product', 'esell-elements' ),  
                     'condition' => array( 'style' => array('1','2') ),
                              
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
      $this->end_controls_section();


    $this->start_controls_section(
            'banner_content_sec',
                [
                    'label' => __( 'Filter Product', 'esell-elements' ),  
                     'condition' => array( 'style' => array('3','4') ),
                              
                ]
            );    

        $repeater = new Repeater();

        $repeater->add_control(
            'ptitle',
            [
                'label'   => __( 'Pruduct Title', 'esell-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Aenean eget sodales',
            ]
        );
        $repeater->add_control(
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
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'image_size',
            'default'  => 'woocommerce_thumbnail',
            'separator' => 'none', 
            ]
        );

        $repeater->add_control(
            'regular_price',
            [
                'label' => __( 'Regular Price', 'esell-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __( 'Title', 'esell-elements' ),
            ]
        );

        $repeater->add_control(
            'sale_price',
            [
                'label' => __( 'Sale Price', 'esell-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                
            ]
        );

         $repeater->add_control(
            'offer_info',
            [
                'label' => __( 'Offer Info', 'esell-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '33',
                
            ]
        );

        $repeater->add_control(
            'offer_info_tyle',
            [
                'label' => __( 'Info background', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'esell-elements' ),
                    '2'   => __( 'Style 2', 'esell-elements' ),
                    '3'   => __( 'Style 3', 'esell-elements' ),                        
                    '4'   => __( 'Style 4', 'esell-elements' ),                        
                                           
                ],
            ] 
        );


        $repeater->add_control(
            'plink',
            [
                'label'   => __( 'Product Link', 'esell-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( '#', 'esell-elements' ),
            ]
        );

        $repeater->add_control(
            'shape_bg_color',
            [
                'label' => __( 'Shape background', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'esell-elements' ),
                    '2'   => __( 'Style 2', 'esell-elements' ),
                    '3'   => __( 'Style 3', 'esell-elements' ),                        
                    '4'   => __( 'Style 4', 'esell-elements' ),                        
                    '5'   => __( 'Style 5', 'esell-elements' ),                        
                ],
            ] 
        );   

         /*  $repeater->add_control(
            'shape_bg_color',
            [
                'label' => __( 'Shap background', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
                'selectors' => array( '{{WRAPPER}} .elementor-repeater-item-{{CURRENT_ITEM}} span.bg-shape' => 'background-color: {{VALUE}}' ),                                       
             
            ]
        );      
        */

        $this->add_control(
            'plists',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => [

                    [
                        'p_title'               => 'Product Title',
                        'regular_price'         => '00',
                        'sale_price'            => '00',
                        'shape_bg_color'            => '#ffffff',
                        'p_link'                => __( '#', 'esell-elements' ),
                    ],
                ],
                'title_field' => '{{{ ptitle }}}',
            ]
        );            
       

       
      $this->end_controls_section();


       $this->start_controls_section(
        'sec_linking',
            [
                'label' => __( 'Link and Button', 'esell-elements' ),  
                          
            ]
        );                  
        $this->add_control(
            'btntext',
            [
                'label'   => __( 'Button One', 'esell-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'LOREM IPSUM',
            ]
        );
        $this->add_control(
            'url',
            [
                'label'   => __( 'Button One Link', 'esell-elements' ),
                'type'    => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                
            ]
        );  
         $this->add_control(
            'btntext2',
            [
                'label'   => __( 'Button two', 'esell-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'LOREM IPSUM',
            ]
        );
        $this->add_control(
            'url2',
            [
                'label'   => __( 'Button two Link', 'esell-elements' ),
                'type'    => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                
            ]
        );  

         
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
        
        if ( $settings['style'] == '3' ) {
            $template = 'banner-2';
        }elseif( $settings['style'] == '4' ){
            $template = 'banner-3';
        }else {
            $template = 'banner';
            $settings['query'] = $this->wooc_build_query( $settings );
        }
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
    }
}