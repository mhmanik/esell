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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Image_Map_info extends Widget_Base {
   
    public function get_name() {
        return 'esell-img-map';
    }
    
    public function get_title() {
        return __( ESELL_ELEMENTS_THEME_PREFIX . ' Image Map Info', 'esell-elements' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }
    protected function _register_controls() {
          $this->start_controls_section(
            'img_map_content',
            [
                'label' => __( 'Image Map', 'esell-elements' ),
            ]
        );


        $this->add_control(
            'img_map_active',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Map Active', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
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
		        'default'  => 'thumbnail',
		        'separator' => 'none',			         
		    ]
		);

		
	   $this->add_control(
	        'tag_info_title',
	        [
	            'label'   => __( 'Title', 'esell-elements' ),
	            'type'    => Controls_Manager::TEXT,
	            'default' => 'Raw Material',
	        ]
	    );
  		$this->add_control(
	        'tag_info_contact',
	        [
	            'label'   => __( 'Content', 'esell-elements' ),
	            'type'    => Controls_Manager::TEXTAREA,
	            'default' => 'Built with a good hand',
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
							'min' => -1000,
							'max' => 1000,							
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
					'{{WRAPPER}} .feature-tip .wooc-img-map.wooc-pos-left'    => 'left: {{SIZE}}{{UNIT}};',	
					'{{WRAPPER}} .feature-tip .wooc-img-map.wooc-pos-right' 	=> 'right: {{SIZE}}{{UNIT}};',
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
							'min' => -1000,
							'max' => 500,							
						],
						'%' => [
							'min' => -1000,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .feature-tip .wooc-img-map.wooc-pos-top'    => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feature-tip .wooc-img-map.wooc-pos-bottom' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
           
	    $this->end_controls_section();	
	}
    protected function render() {
		$settings = $this->get_settings();  	
		$template = 'image-map';
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	    }
	}
