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
use Elementor\SLIDER;
use Elementor\CHOOSE;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Info_Box extends Widget_Base {

 public function get_name() {
        return 'wooc-product-info-box';
    }    
    public function get_title() {
        return __('Product Info Box', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {
              
        $this->start_controls_section(
            'info_layout',
            [
                'label' => __( 'General', 'esell-elements' ),
            ]
        );
   
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Box Height', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-info' => 'height: {{SIZE}}{{UNIT}};',
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



		$this->add_responsive_control(
			'radius',
			[
				'label' => __( 'Border Radius', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,							
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],								
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-info' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

	   $this->add_control(
	            'shape_color',
	            [
	                'label' => __( 'Shap background', 'esell-elements' ),
	                'type' => Controls_Manager::COLOR,   
	                'selectors' => array( '{{WRAPPER}} .wooc-product-info .wooc-img.wooc-posx-left:after' => 'background-color: {{VALUE}}' ),                                       
	             
	            ]
	        );      



	$this->add_responsive_control(
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

       $this->end_controls_section();  


        $this->start_controls_section(
            'sec_bg',
            [
                'label' => __( 'Background', 'esell-elements' ),
            ]
        );

		$this->add_group_control(
		\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wooc-product-info',
			]
		);

       $this->end_controls_section();   


        $this->start_controls_section(
            'sec_img',
            [
                'label' => __( 'Product Image', 'esell-elements' ),
            ]
        );

			$this->add_control(
			    'image',
			    [
			        'label' => __('Image','esell-elements'),
			        'type'=>Controls_Manager::MEDIA,
			        'default' => [
			            'url' => Utils::get_placeholder_image_src(),
			        ],
			        'dynamic' => [
			            'active' => true,
			        ],
			            
			    ]
			);


			$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-info .wooc-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_posx_type',
			[
				'label' => __( 'Horizontal Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-up',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'image_offset',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,							
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-info .wooc-img.wooc-posx-left'    => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-product-info .wooc-img.wooc-posx-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
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
		        'label'   => __( 'Detail Text', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'LOREM IPSUM',
		    ]
		);
		$this->add_control(
		    'url',
		    [
		        'label'   => __( 'Detail URL', 'esell-elements' ),
		        'type'    => Controls_Manager::URL,
		        'placeholder' => 'https://your-link.com',		        
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
            'title_color',
            [
                'label' => __( 'Title Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .woocue-title' => 'color: {{VALUE}}' ),                                        
                
            ]
        );

		$this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Subtitle Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array( '{{WRAPPER}} .woocue-subtitle' => 'color: {{VALUE}}' ),                                       
             
            ]
        );		
		$this->add_control(
            'link_color',
            [
                'label' => __( 'Button/Link', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array(
					'{{WRAPPER}} .woocueinfo-box .woocue-item .woocue-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .woocueinfo-box.woocue-style-8 .woocue-item .woocue-btn::after, {{WRAPPER}} .woocueinfo-box.woocue-style-9 .woocue-item .woocue-btn::after' => 'background-color: {{VALUE}}',
				                              
                ),
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
			   'selector' => '{{WRAPPER}} .woocue-title',
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
				        '{{WRAPPER}}  .woocue-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
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
				'selector' => '{{WRAPPER}} .woocue-subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_typo_margin',
				[
				    'label' => __( 'Margin', 'esell-elements' ),
				    'type' => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em' ],
				    'devices' => [ 'desktop', 'tablet', 'mobile' ],					    
				    'selectors' => [
				        '{{WRAPPER}} .woocue-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
			    'name' => 'link_typo',
			    'label' => __( 'Typography', 'esell-elements' ),  
			     'devices' => [ 'desktop', 'tablet', 'mobile' ],	
			   'label'    => __( 'Subtitle', 'esell-elements' ),
				'selector' => '{{WRAPPER}} .woocueinfo-box-1 .woocue-item .woocue-btn',
			]
		);

		$this->add_responsive_control(
			'link_typo_margin',
				[
				    'label' => __( 'Margin', 'esell-elements' ),
				    'type' => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em' ],
				    'devices' => [ 'desktop', 'tablet', 'mobile' ],					    
				    'selectors' => [
				        '{{WRAPPER}} .woocueinfo-box-1 .woocue-item .woocue-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);

       $this->end_controls_section();   

    }

	protected function render() {
		$settings = $this->get_settings();
		$template = 'product-info-1';			
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}