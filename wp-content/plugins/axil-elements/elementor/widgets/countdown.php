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

class Wooc_Product_Countdown extends Widget_Base {

 public function get_name() {
        return 'wooc-countdown-1';
    }    
    public function get_title() {
        return __( 'Product Countdown', 'esell-elements' );
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
            'countdown_layout',
            [
                'label' => __( 'Layout / Theme', 'esell-elements' ),
            ]
        );         

		$this->add_control(
		'layout',
			[
			'label' => __( 'Layout', 'esell-elements' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'layout1',
			'options' => [
			    'layout1' => __( 'Style 1', 'esell-elements' ),
				'layout2' => __( 'Style 2', 'esell-elements' ),				                 
				'layout3' => __( 'Style 3', 'esell-elements' ),				                 
			],
			] 
		);    
   		$this->end_controls_section();  

        $this->start_controls_section(
            'countdown_info',
            [
                'label' => __( 'Countdown Info', 'esell-elements' ),
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
            'color',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,  
                'default' => '#fe7656',
               	'selectors' => array(
					'{{WRAPPER}} .woocuecountdown-1 .woocue-title-area' => 'color: {{color}};',
				),
            ]
        ); 

		$this->add_control(
		    'regular_price',
		    [
		        'label' => __( 'Regular Price', 'esell-elements' ),
		        'type' => Controls_Manager::TEXT,
		        'default' => '00',
		        'placeholder' => __( 'Title', 'esell-elements' ),
		    ]
		);

		$this->add_control(
		    'sale_price',
		    [
		        'label' => __( 'Sale Price', 'esell-elements' ),
		        'type' => Controls_Manager::TEXT,
		        'default' => '00',
		        
		    ]
		);

		$this->add_control(
			'date',
			[
				'label' => __( 'Date-Time', 'plugin-domain' ),
				'type' => Controls_Manager::DATE_TIME,
			]
		);
       $this->end_controls_section();   


 

 		$this->start_controls_section(
            'countdown_theme',
            [
                'label' => __( 'Layout / Theme', 'esell-elements' ),
            ]
        );         


		$this->add_control(
		'style',
			[
			'label' => __( 'Product Layout', 'esell-elements' ),
			'type' => Controls_Manager::SELECT,
			'default' => '1',
			'options' => [
			    '1' => __( 'Style 1', 'esell-elements' ),
				'2' => __( 'Style 2', 'esell-elements' ),				                 
				'3' => __( 'Style 3', 'esell-elements' ),				                 
				'4' => __( 'Style 4', 'esell-elements' ),				                 
				'5' => __( 'Style 5', 'esell-elements' ),				                 
			],
			] 
		);    

  		

        $this->add_control(
            'wishlist',
            [
                
                'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Wishlist Display', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
                
            ] 
        );      
		$this->add_control(
		    'rating_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Rating Display', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
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
			        'name' => 'thumbnail',
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

 		$this->end_controls_section();   



        $this->start_controls_section(
            'sec_style_color',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,   
            ]
        );

		$this->add_control(
            'cbox_bg_color',
            [
                'label' => __( 'background Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp' => 'background: {{VALUE}}' ),                                        
                
            ]
        );
		$this->add_control(
            'cbox_border_color',
            [
                'label' => __( 'Border Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp' => 'border: 2px solid {{VALUE}}' ),                                        
                
            ]
        );
     
		$this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-title' => 'color: {{VALUE}}' ),                                        
                
            ]
        );
		$this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Subtitle Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array( '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-subtitle' => 'color: {{VALUE}}' ),                                       
             
            ]
        );		
		

       $this->end_controls_section();   

        $this->start_controls_section(
            'sec_typography_type',
            [
                'label' => __( 'Typography', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,   
            ]
        );

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
			    'name' => 'title_typo',
			    'label' => __( 'Typography', 'esell-elements' ),  
			     'devices' => [ 'desktop', 'tablet', 'mobile' ],	
			   'selector' => '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-title',
			]
		);

		$this->add_responsive_control(
			'title_typo_margin',
				[
				    'label' => __( 'Margin', 'esell-elements' ),
				    'type' => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em' ],
				    'devices' => [ 'desktop', 'tablet', 'mobile' ],					    
				    'selectors' => [
				        '{{WRAPPER}}  .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);


		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
			    'name' => 'subtitle_typo',
			    'label' => __( 'Typography', 'esell-elements' ),  
			     'devices' => [ 'desktop', 'tablet', 'mobile' ],	
			   'label'    => __( 'Subtitle', 'esell-elements' ),
				'selector' => '{{WRAPPER}} .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-subtitle',
			]
		);


		$this->add_responsive_control(
			'subtitle_typo_margin',
				[
				    'label' => __( 'Sub TitleMargin', 'esell-elements' ),
				    'type' => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em' ],
				    'devices' => [ 'desktop', 'tablet', 'mobile' ],					    
				    'selectors' => [
				        '{{WRAPPER}}   .wooc-countdown .wooc-countdown-wrp .wooc-countdown-title-area .wooc-countdown-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);
				
       $this->end_controls_section();  
    }


	private function wooc_load_scripts(){
		wp_enqueue_script( 'jquery-countdown' );
	}

	protected function render() {
		$settings = $this->get_settings();
		$this->wooc_load_scripts();
		 $template   = 'countdown-' . str_replace("layout", "", $settings['layout']);   	
		
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}

}