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

class Poster_banner extends Widget_Base {

 public function get_name() {
        return 'es-poster-banner';
    }    
    public function get_title() {
        return __( 'Poster Banner', 'esell-elements' );
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
	            'default' => 'style-one',
	            'options' => [
	                'style-one' => __( 'Style 1', 'esell-elements' ),
					'style-two' => __( 'Style 2', 'esell-elements' ),			                 
						                 
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
		$this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default'  => 'full',
		        'separator' => 'none',	
		        	         
		    ]
		);		
       $this->end_controls_section();   

       
	$this->start_controls_section(
		'poster_linking',
		    [
		        'label' => __( 'Poster Link', 'esell-elements' ),  		         
		                  
		    ]
		);    		
	

		$this->add_control(
		    'posterurl',
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
		$attr = '';
		if ( !empty( $settings['posterurl']['url'] ) ) {
			$attr  = 'href="' . $settings['posterurl']['url'] . '"';
			$attr .= !empty( $settings['posterurl']['is_external'] ) ? ' target="_blank"' : '';
			$attr .= !empty( $settings['posterurl']['nofollow'] ) ? ' rel="nofollow"' : '';
		}
		$wrapper_start = '<div class="es-item">';
		$wrapper_end   = '</div>';

			if ( $settings['posterurl']['url'] ) {
				$wrapper_start = '<a class="es-item" ' . $attr . '>';
				$wrapper_end   = '</a>';
			}
		?>
		<div class="single-poster">
		   <?php echo wp_kses_post( $wrapper_start);?>
		       <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>	
		        <div class="poster-content">
		            <div class="inner">
		                <h2 class="title <?php echo wp_kses_post( $settings['style'] );?>"><?php echo wp_kses_post( $settings['title'] );?></h2>
		                <?php if ( $settings['subtitle'] ): ?>
		                	<span class="info-subtitle sub-title"><?php echo wp_kses_post( $settings['subtitle'] );?></span>
		                <?php endif; ?>	

		            </div>
		        </div>   
		     <?php echo wp_kses_post( $wrapper_end );?>
		</div>
		   <?php
	}
}