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
class Testimonial_Carousel extends Widget_Base {
   
    public function get_name() {       
        return 'wooc-testimonial';
    }    
    public function get_title() {      
          return __( 'Testimonial Carousel', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }
    protected function _register_controls() {

          $this->start_controls_section(
            'testimonial_layout',
            [
                'label' => __( 'Layout', 'esell-elements' ),
            ]
        );
		$this->add_control(
		    'style',
		    [
		        'label' => __( 'Style', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		            '1'   => __( 'Style One', 'esell-elements' ),
		            '2'   => __( 'Style Two', 'esell-elements' ),		        
		        ],
		    ] 
		);  

		$this->end_controls_section();
		$this->start_controls_section(
            'testimonial_content',
            [
                'label' => __( 'Testimonial', 'esell-elements' ),
            ]
        );

		$repeater = new Repeater();

		$repeater->add_control(
		    'testimonial_image',
		    [
		        'label' => __( 'Testimonial Logo', 'esell-elements' ),
		        'type' => Controls_Manager::MEDIA,
		        'default' => [
		            'url' => Utils::get_placeholder_image_src(),
		        ],
		    ]
		);
		
		$repeater->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'Lorem Ipsum',
		    ]
		);
		$repeater->add_control(
		    'designation',
		    [
		        'label'   => __( 'Designation', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'Lorem Ipsum',
		    ]
		);
	$repeater->add_control(
		    'content',
		    [
		        'label'   => __( 'Content', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => 'Very good Design. Flexible. Fast Support.',
		    ]
		);
		
		$repeater->add_control(
		    'show_rating',
		    [
		        'label'   => __( 'Show Rating', 'esell-elements' ),
		        'type'    => Controls_Manager::SWITCHER,
		        'default' => 'no',
		        'return_value' => 'yes',
		       'description' => esc_html__( 'Enable or disable Show Rating. Default: On', 'esell-elements' ),                    
		    ]
		);
		$repeater->add_control(
	        'rating',
	        [
	            'label' => __( 'Rating', 'esell-elements' ),
	            'type' => Controls_Manager::SELECT,
	            'default' => '1',
	            'options' => [
	               '1' => __( '1 Star', 'kctheme' ),
					'2' => __( '2 Stars', 'kctheme' ),
					'3' => __( '3 Stars', 'kctheme' ),
					'4' => __( '4 Stars', 'kctheme' ),
					'5' => __( '5 Stars', 'kctheme' ),
	            ],
				'condition' => [
				    'show_rating' =>'yes',
				], 
	        ] 
		 );
		    
	       $this->add_control(
            'abc_testimonial',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'title' => __( 'Standard Feature', 'esell-elements' ),
                        'content' => 'Lorem Ipsum has been the industrys standard dummy text ever since printer took a galley. Rimply dummy text of the printing and typesetting industry',
                    ], 
                    [
                        'title' => __( 'Standard Feature', 'esell-elements' ),
                        'content' => 'Lorem Ipsum has been the industrys standard dummy text ever since printer took a galley. Rimply dummy text of the printing and typesetting industry',
                    ],
                    [
                        'title' => __( 'Standard Feature', 'esell-elements' ),
                        'content' => 'Lorem Ipsum has been the industrys standard dummy text ever since printer took a galley. Rimply dummy text of the printing and typesetting industry',
                    ],

                ],
                 'title_field' => '{{{ title }}}',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'abc_responsive',
				[
				'label' => __( 'Responsive Columns', 'esell-elements' ),
				
				]
				
			);

			$this->add_control(
                'big_desktops',
                [
                    'label' => __( 'Desktops: > 1199px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
						'1'  => esc_html__( '1 Col', 'esell-elements' ),
						'2'  => esc_html__( '2 Col', 'esell-elements' ),
						'3'  => esc_html__( '3 Col', 'esell-elements' ),
						'4'  => esc_html__( '4 Col', 'esell-elements' ),
						'5'  => esc_html__( '5 Col', 'esell-elements' ),
						'6'  => esc_html__( '6 Col', 'esell-elements' ),
						],
                    'default' => '3',
                ] 
            );
            $this->add_control(
            'desktops',
                [
                    'label' => __( 'Desktops: > 991px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
						'1'  => esc_html__( '1 Col', 'esell-elements' ),
						'2'  => esc_html__( '2 Col', 'esell-elements' ),
						'3'  => esc_html__( '3 Col', 'esell-elements' ),
						'4'  => esc_html__( '4 Col', 'esell-elements' ),
						'5'  => esc_html__( '5 Col', 'esell-elements' ),
						'6'  => esc_html__( '6 Col', 'esell-elements' ),
						],
                    'default' => '2',
                ] 
            );
            $this->add_control(
            'tablets',
                [
                    'label' => __( 'Tablets: > 767px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
						'1'  => esc_html__( '1 Col', 'esell-elements' ),
						'2'  => esc_html__( '2 Col', 'esell-elements' ),
						'3'  => esc_html__( '3 Col', 'esell-elements' ),
						'4'  => esc_html__( '4 Col', 'esell-elements' ),
						'5'  => esc_html__( '5 Col', 'esell-elements' ),
						'6'  => esc_html__( '6 Col', 'esell-elements' ),
						],
                    'default' => '2',
                ] 
            );	        
            $this->add_control(
            'mobile',
                [
                    'label' => __( '767px > - Mobile', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
						'1'  => esc_html__( '1 Col', 'esell-elements' ),
						'2'  => esc_html__( '2 Col', 'esell-elements' ),
						'3'  => esc_html__( '3 Col', 'esell-elements' ),
						'4'  => esc_html__( '4 Col', 'esell-elements' ),
						'5'  => esc_html__( '5 Col', 'esell-elements' ),
						'6'  => esc_html__( '6 Col', 'esell-elements' ),
						],
                    'default' => '1',
                ] 
            );		
		
			$this->end_controls_section();

			$this->start_controls_section(
			'abc_options',
				[
				'label' => __( 'Slider Options', 'esell-elements' ),
				]
			);


			    $this->add_control(
			        'slider_nav',
			        [
			            'label'   => __( 'Navigation Arrow', 'esell-elements' ),
			            'type'    => Controls_Manager::SWITCHER,
			            'default' => 'yes',
			            'return_value' => 'yes',
			            'description' => esc_html__( 'Enable or disable navigation arrow. Default: On', 'esell-elements' ),                    
			        ]
			    );
			    $this->add_control(
			        'slider_autoplay',
			        [
			            'label'   => __( 'Autoplay', 'esell-elements' ),
			            'type'    => Controls_Manager::SWITCHER,
			            'default' => 'yes',
			            'return_value' => 'yes',
			           'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'esell-elements' ),                    
			        ]
			    );
			    
			    $this->add_control(
			        'slider_stop_on_hover',
			            [
			                'label'   => __( 'Stop on Hover', 'esell-elements' ),
			                'type'    => Controls_Manager::SWITCHER,
			                'default' => 'yes',
			                'return_value' => 'yes',		                   
			               'description' => esc_html__( 'Stop autoplay on mouse hover. Default: On', 'esell-elements' ),
			                'condition' => [
			                    'slider_autoplay' =>'yes',
			                ],               
			            ]
			        );

				$this->add_control(
			    'slider_interval',
			    	[
			            'label'   => __( 'Autoplay Interval', 'esell-elements' ),
			            'type'    => Controls_Manager::SELECT2,
						'options' => [
							'5000' => esc_html__( '5 Seconds', 'esell-elements' ),
							'4000' => esc_html__( '4 Seconds', 'esell-elements' ),
							'3000' => esc_html__( '3 Seconds', 'esell-elements' ),
							'2000' => esc_html__( '2 Seconds', 'esell-elements' ),
							'1000' => esc_html__( '1 Second',  'esell-elements' ),
							],
						'default' => '5000',
						'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'esell-elements' ),
				            'condition' => [
				                'slider_autoplay' =>'yes',
				            ],               
				        ]
				    );


				$this->add_control(
			    'slider_autoplay_speed',
			    	[
			            'label'   => __( 'Autoplay Slide Speed', 'esell-elements' ),
			            'type'    => Controls_Manager::NUMBER,
						'default' => 200,					
						'description' => esc_html__( 'Slide speed in milliseconds. Default: 200', 'esell-elements' ),
				            'condition' => [
				                'slider_autoplay' =>'yes',
				            ],               
				        ]
				    );

				$this->add_control(
				'slider_loop',
				    [
				        'label'   => __( 'Stop on Hover', 'esell-elements' ),
				        'type'    => Controls_Manager::SWITCHER,
				        'default' => 'yes',
				        'return_value' => 'yes',	
						'description' => esc_html__( 'Loop to first item. Default: On', 'esell-elements' ),              
						]
				);
				$this->end_controls_section();
    }

   private function wooc_load_scripts(){
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
	}


	protected function render() {
			$settings = $this->get_settings();
			$this->wooc_load_scripts();	
		  	$owl_data = array( 
	                'nav'                => $settings['slider_nav'] == 'yes' ? true : false,
	                'dots'               => false,
	                'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
	                'autoplay'           => $settings['slider_autoplay'] == 'yes' ? true : false,
	                'autoplayTimeout'    => $settings['slider_interval'],
	                'autoplaySpeed'      => $settings['slider_autoplay_speed'],
	                'autoplayHoverPause' => $settings['slider_stop_on_hover'] == 'yes' ? true : false,
	                'loop'               => $settings['slider_loop'] == 'yes' ? true : false,
	                'margin'             => 0,
	                'responsive'         => array(                
						'0'  				 => array( 'items' => '1' ),                
						'768'                => array( 'items' =>  '1' ),
						'992'                => array( 'items' =>  '1' ),
						'1200'               => array( 'items' =>  '1' ),
	            )
	        );    

	        $settings['owl_data'] = json_encode( $owl_data ); 
   			$template = 'testimonial-carousel-1';
			return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
  
}
