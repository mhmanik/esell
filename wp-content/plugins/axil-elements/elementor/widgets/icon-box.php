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

class Icon_Box extends Widget_Base {

 public function get_name() {
        return 'wooc-icon-box';
    }    
    public function get_title() {
        return __( 'Icon Box', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {
              
        $this->start_controls_section(
            'icon_layout',
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
	    $this->add_control(
	        'colortype',
	        [
	            'label' => __( 'Color Type', 'esell-elements' ),
	            'type' => Controls_Manager::SELECT,
	            'default' => 'primary',
	            'options' => [
	                'primary' => __( 'Primary', 'esell-elements' ),
					'secondary' => __( 'Secondary', 'esell-elements' ),				                 
					'light' => __( 'Light', 'esell-elements' ),				                 
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
			    'icontype',
			    [
			        'label' => __( 'Style', 'esell-elements' ),
			        'type' => Controls_Manager::SELECT,
			        'default' => 'icon',			       
			        'options' => [
						'icon'  => esc_html__( 'Icon', 'esell-elements' ),
						'image' => esc_html__( 'Custom Image', 'esell-elements' ),
			        ],
			    ] 
			);

			$this->add_control(
			    'icon',
			    [
			        'label' => __( 'Icons', 'esell-elements' ),
			        'type' => Controls_Manager::ICONS,
			        'default' => [
			            'value' => 'fa fa-university',
			            'library' => 'solid',
			        ],
                    'condition' => [
                            'icontype' =>'icon',
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
			        'condition' => [
				                'icontype' =>'image',
				            ],      
			    ]
			);

   	
			

			$this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image_size',
                    'default' => 'large',
                    'separator' => 'none',
                     'condition' => [
				                'icontype' =>'image',
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
            'box_bg_color',
            [
                'label' => __( 'Box background Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-icon-wrp' => 'background: {{VALUE}}' ),                                        
                
            ]
        );
		$this->add_control(
            'box_border_color',
            [
                'label' => __( 'Box Border Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-icon-wrp' => 'border: 2px solid {{VALUE}}' ),                                        
                
            ]
        );
         $this->add_control(
            'box_shape_color',
            [
                'label' => __( 'Box Shape Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '{{WRAPPER}} .wooc-icon-wrp .img-box:after' => 'background: {{VALUE}}' ),                                        
                
            ]
        );
		$this->add_control(
            'box_icon_color',
            [
                'label' => __( 'Icon Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '
					{{WRAPPER}} .feature-icon i' 	=> 'color: {{VALUE}}'
				),                                        
                
            ]
        );
        $this->add_control(
            'box_icon_box_color',
            [
                'label' => __( 'Icon Box Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '
					{{WRAPPER}} .feature-icon:after' 	=> 'background-color: {{VALUE}}'
				),                                        
                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,      
				'selectors' => array( '
					{{WRAPPER}} .woocue-title' 	=> 'color: {{VALUE}}',
					'{{WRAPPER}} .wooc-title' 	=> 'color: {{VALUE}}'  
				),                                        
                
            ]
        );
		$this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Subtitle Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => array( 
					'{{WRAPPER}} .woocue-subtitle' 	=> 'color: {{VALUE}}',
					'{{WRAPPER}} .wooc-subtitle' 		=> 'color: {{VALUE}}'  
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
			   'selector' => '{{WRAPPER}} .wooc-title',
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
				        '{{WRAPPER}}  .wooc-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
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
				'selector' => '{{WRAPPER}} .wooc-title',
			]
		);
				
       $this->end_controls_section();   

    }

	protected function render() {
		$settings = $this->get_settings();				
		 $template   = 'icon-box-' . str_replace("style", "", $settings['style']);         
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}