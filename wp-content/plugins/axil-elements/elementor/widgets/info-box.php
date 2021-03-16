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

class Info_Box extends Widget_Base {

 public function get_name() {
        return 'wooc-info-box';
    }    
    public function get_title() {
        return __( 'Info Box', 'esell-elements' );
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
                'label' => __( 'General', 'esell-elements' ),
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
					'3' => __( 'Style 3', 'esell-elements' ),				                 
	            ],
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
					'{{WRAPPER}} .info-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
			

		$this->add_control(
		    'title',
		    [
		        'label' => __( 'Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( '- Welcome to eSell', 'esell-elements' ),
		        'placeholder' => __( 'Title', 'esell-elements' ),
		    ]
		);
		$this->add_control(
		    'subtitle',
		    [
		        'label' => __( 'Before Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Sub title', 'esell-elements' ),
		        'placeholder' => __( 'Sub title', 'esell-elements' ),
		    ]
		);

 		$this->add_control(
            'content_pos',
            [
                'label' => __( 'Layout', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left-bottom',
                'options' => [
                   'left-bottom'  => __( 'Left Bottom', 'esell-elements' ),
					'left-top'     => __( 'Left Top', 'esell-elements' ),
					'right-top'    => __( 'Right Top', 'esell-elements' ),
					'right-bottom' => __( 'Right Bottom', 'esell-elements' ),               
					'right-center' => __( 'Right Center', 'esell-elements' ),               
					'left-center' => __( 'Left Center', 'esell-elements' ),               
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
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
								
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'border-radius: {{SIZE}}{{UNIT}};',
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
				'label' => __( 'Background', 'esell-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .info-box',
			]
		);
       $this->end_controls_section();   

       

		$this->start_controls_section(
		'sec_linking',
		    [
		        'label' => __( 'Button', 'esell-elements' ),  
		                  
		    ]
		);    
		

		$this->add_control(
		    'detail_txt',
		    [
		        'label'   => __( 'Detail Text', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'Shop Now',
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
				'selectors' => array( 
					'{{WRAPPER}} .info-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .info-subtitle' => 'color: {{VALUE}}' , 
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
					'{{WRAPPER}} .info-box .woocue-item .woocue-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box.woocue-style-8 .woocue-item .woocue-btn::after, {{WRAPPER}} .info-box.woocue-style-9 .woocue-item .woocue-btn::after' => 'background-color: {{VALUE}}',
				                              
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
			   'selector' => '{{WRAPPER}} .info-title',
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
				        '{{WRAPPER}}  .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
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
				'selector' => '{{WRAPPER}} .info-subtitle',
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
				        '{{WRAPPER}} .info-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
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
				'selector' => '{{WRAPPER}} .info-box-1 .woocue-item .woocue-btn',
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
				        '{{WRAPPER}} .info-box-1 .woocue-item .woocue-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
				]
			);

       $this->end_controls_section();   

    }

	protected function render() {
		$settings = $this->get_settings();
		$template   = 'info-box-' . str_replace("style", "", $settings['style']); 
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}