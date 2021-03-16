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

class Item_Box extends Widget_Base {

 public function get_name() {
        return 'wooc-item-box';
    }    
    public function get_title() {
        return __( 'Item Box', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {             


        $this->start_controls_section(
            'item_layout',
            [
                'label' => __( 'General', 'esell-elements' ),
            ]
        );
        

  		$this->add_control(
	        'style2',
	        [
	            'label' => __( 'Content Align', 'esell-elements' ),
	            'type' => Controls_Manager::SELECT,
	            'default' => 'right-top',	         
	            'options' => [
	            	'right-top'  => __( 'Right Top ', 'esell-elements' ),
					'right-bottom'  => __( 'Right Bottom', 'esell-elements' ),
					'left-bottom'  => __( 'Left Bottom', 'esell-elements' ),
					'right-bottom-center'  => __( 'Bottom Center', 'esell-elements' ),	

	            ],
	        ] 
	    );   
		

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Image Width', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 180,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 160,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wooc-item-box-3 .product-box .item-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
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
		'radius',
		[
			'label' => __( 'Border Radius', 'esell-elements' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],					
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
							
			'devices' => [ 'desktop', 'tablet', 'mobile' ],				
			'selectors' => [
				'{{WRAPPER}} .wooc-item-box-3 .product-box .item-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
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
		        'label' => __( 'Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Sub Title', 'esell-elements' ),
		        'placeholder' => __( 'Title', 'esell-elements' ),
		    ]
		);
		$this->add_control(
		    'url',
		    [
		        'label'   => __( 'Link', 'esell-elements' ),
		        'type'    => Controls_Manager::URL,
		        'placeholder' => 'https://your-link.com',		       
		    ]
		);   

		$this->add_control(
		    'btntext',
		    [
		        'label' => __( 'Sub Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Link Text', 'esell-elements' ),
		        'placeholder' => __( 'Lorem Ipsum', 'esell-elements' ),
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
				'selectors' => array( 
					'{{WRAPPER}} .woocue-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wooc-title' => 'color: {{VALUE}}' 
				),                                  
                
            ]
        );

		$this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Subtitle Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array( 
					'{{WRAPPER}} .woocue-subtitle' => 'color: {{VALUE}}' , 
					'{{WRAPPER}} .wooc-subtitle' => 'color: {{VALUE}}'
					),                                
             
            ]
        );		
		$this->add_control(
            'link_color',
            [
                'label' => __( 'Button/Link', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array(
					'{{WRAPPER}} .woocue-info-box .woocue-item .woocue-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .woocue-info-box.woocue-style-8 .woocue-item .woocue-btn::after, {{WRAPPER}} .woocue-info-box.woocue-style-9 .woocue-item .woocue-btn::after' => 'background-color: {{VALUE}}',
				                              
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
				'selector' => '{{WRAPPER}} .woocue-info-box-1 .woocue-item .woocue-btn',
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
				        '{{WRAPPER}} .woocue-info-box-1 .woocue-item .woocue-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);

       $this->end_controls_section();   

    }

	protected function render() {
		$settings = $this->get_settings();	
		$template = 'item-box-2';	
		
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}