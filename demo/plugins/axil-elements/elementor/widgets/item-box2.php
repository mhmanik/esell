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

class Item_Box2 extends Widget_Base {

 public function get_name() {
        return 'wooc-item-box2';
    }    
    public function get_title() {
        return __( 'Item Box 2', 'esell-elements' );
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
			'img_figure',
			[
				'label' => __( 'Image Figure', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'Left',
				'toggle' => true,
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
					'{{WRAPPER}} .wooc-box' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .product-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
				'bgheight',
				[
					'label' => __( 'Background Height ', 'esell-elements' ),
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
						'{{WRAPPER}} .wooc-item-box-4 .product-box::after' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .wooc-item-box-4 .product-box::after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

          $this->add_control(
            'bgheightcolor',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,  
                'default' => '#e9f1f8',               
                'selectors' => array(
                    '{{WRAPPER}} .wooc-item-box-4 .product-box::after' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .shutter-effect.has-animation.item-figure::before' => 'background: {{VALUE}}',
                ),
            ]
        );

		$this->add_control(
			'bg_pos_x_type',
			[
				'label' => __( 'Horizontal Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'bg_pos_x',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocuef-pos-left::after'    => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocuef-pos-right::after'    => 'right: {{SIZE}}{{UNIT}};',	
					
				],
			]
		);

		$this->add_control(
			'bg_pos_y_type',
			[
				'label' => __( 'Vertical Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'esell-elements' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'esell-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
				'toggle' => true,
			]
		);


		$this->add_responsive_control(
			'bg_pos_y',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
				
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocuef-pos-top::after'  => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocuef-pos-bottom::after'  => 'bottom: {{SIZE}}{{UNIT}};',				
					
				],
			]
		);


       $this->end_controls_section();   

        $this->start_controls_section(
            'sec_imgheight',
            [
                'label' => __( 'Image', 'esell-elements' ),
                  
            ]
        );


		$this->add_responsive_control(
			'imgheight',
			[
				'label' => __( 'Image Height', 'esell-elements' ),
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
					'{{WRAPPER}} .wooc-item-box-4 .product-box .item-img img' => 'width: {{SIZE}}{{UNIT}};',
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
		        'selectors' => [					
					'{{WRAPPER}} .wooc-box' => 'background-image: url({{URL}});',
				],
		            
		    ]
		);
		$this->add_group_control(
			    Group_Control_Image_Size::get_type(),
			    [
			        'name' => 'pimage_size',
			        'default'  => 'woocommerce_thumbnail',
			        'separator' => 'none',			         
			    ]
			);


		$this->add_responsive_control(
			'imgradius',
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
					'{{WRAPPER}} .wooc-item-box-4 .product-box .item-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'img_pos_x_type',
			[
				'label' => __( 'Horizontal Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'img_pos_x',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-item-box-4 .item-img.woocue-pos-left'    => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .item-img.woocue-pos-right'    => 'right: {{SIZE}}{{UNIT}};',
					
				],
			]
		);

		$this->add_control(
			'img_pos_y_type',
			[
				'label' => __( 'Vertical Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'esell-elements' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'esell-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
				'toggle' => true,
			]
		);


		$this->add_responsive_control(
			'img_pos_y',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
				
					'{{WRAPPER}} .wooc-item-box-4 .item-img.woocue-pos-top'  => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .item-img.woocue-pos-bottom'  => 'bottom: {{SIZE}}{{UNIT}};',
					
				],
			]
		);



       $this->end_controls_section();   

        $this->start_controls_section(
            'sec_content',
            [
                'label' => __( 'Content', 'esell-elements' ),                  
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


		$this->add_responsive_control(
		'title_align',
		[
		    'label'   => __( 'Alignment (flex)', 'esell-elements' ),
		    'type'    => Controls_Manager::CHOOSE,
		     
		    'options' => [
		        'left'    => [
		            'title' => __( 'Left', 'esell-elements' ),
		            'icon'  => 'fa fa-align-left',
		        ],
		        'center' => [
		            'title' => __( 'Center', 'esell-elements' ),
		            'icon'  => 'fa fa-align-center',
		        ],
		        'right' => [
		            'title' => __( 'Right', 'esell-elements' ),
		            'icon'  => 'fa fa-align-right',
		        ],
		    ],
		    'selectors' => [
		        '{{WRAPPER}} .wooc-item-box-4 .product-box .item-content'   => 'text-align: {{VALUE}}',
		        
		    ],
		    'default' => 'left',
		]
		); 


		$this->add_control(
			'pos_x_type',
			[
				'label' => __( 'Horizontal Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'pos_x',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocue-pos-left .item-content'    => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocue-pos-right .item-content'    => 'right: {{SIZE}}{{UNIT}};',
					
				],
			]
		);

		$this->add_control(
			'pos_y_type',
			[
				'label' => __( 'Vertical Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'esell-elements' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'esell-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
				'toggle' => true,
			]
		);


		$this->add_responsive_control(
			'pos_y',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,							
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
				
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocue-pos-top .item-content'  => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-item-box-4 .product-box.woocue-pos-bottom .item-content'  => 'bottom: {{SIZE}}{{UNIT}};',
					
				],
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
					'{{WRAPPER}} .wooc-item-box-4 .product-box .item-content .item-title' => 'color: {{VALUE}}',
					 
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
			   'selector' => '{{WRAPPER}} .wooc-item-box-4 .product-box .item-content .item-title',
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
				        '{{WRAPPER}}  .wooc-item-box-4 .product-box .item-content .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
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
		$template = 'item-box-3';	
		
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}