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
class Logo_Slider extends Widget_Base {
   
    public function get_name() {
        return 'esell-logo-slider';
    }
    
    public function get_title() {
        return __( ESELL_ELEMENTS_THEME_PREFIX . ' Logo Slider', 'esell-elements' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }
    protected function _register_controls() {
          $this->start_controls_section(
            'brand_content',
            [
                'label' => __( 'Brands', 'esell-elements' ),
            ]
        );

        $this->add_control(
            'theme',
            [
                'label' => __( 'Features', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'v1',                   
                'options' => [
                    'v1'           => __( 'Features v1', 'esell-elements' ),
                    'v2'           => __( 'Features V2', 'esell-elements' ),                    
                    'v3'           => __( 'Features V3', 'esell-elements' ),                    
                                      
                ],
                
                
            ] 
        );
 		$this->add_control(
            'section_title_display',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Section Title Display', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
            ] 
        );   


        $this->add_control(
            'title',
            [
                'type'    => Controls_Manager::TEXT,
                'label'       => __( 'Title', 'esell-elements' ),
                'default'     => 'Lorem Ipsum',
                'condition'   => array( 'section_title_display' => 'yes' ),         
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'type'    => Controls_Manager::TEXT,
                'label'       => __( 'Sub Title', 'esell-elements' ),
                'default'     => 'Lorem Ipsum',
                'condition'   => array( 'section_title_display' => 'yes' ),         
            ]
        );
     
        
		$repeater = new Repeater();
	    $repeater->add_control(
	        'esell_brand_title',
	        [
	            'label'   => __( 'Title', 'esell-elements' ),
	            'type'    => Controls_Manager::TEXT,
	            'default' => 'Brand Logo',
	        ]
	    );

	    $repeater->add_control(
	        'esell_brand_logo',
	        [
	            'label' => __( 'Partner Logo', 'esell-elements' ),
	            'type' => Controls_Manager::MEDIA,
	            'default' => [
	                'url' => Utils::get_placeholder_image_src(),
	            ],
	        ]
	    );
	    $repeater->add_group_control(
	        Group_Control_Image_Size::get_type(),
	        [
	            'name' => 'esell_brand_logo_size',
	            'default' => 'large',
	            'separator' => 'none',
	        ]
	    );

	    $repeater->add_control(
	        'esell_brand_link',
	        [
	            'label'   => __( 'Partner Link', 'esell-elements' ),
	            'type'    => Controls_Manager::TEXT,
	            'default' => __( '#', 'esell-elements' ),
	        ]
	    );

	    $this->add_control(
	        'esell_brand_list',
	        [
	            'type'    => Controls_Manager::REPEATER,
	            'fields'  => array_values( $repeater->get_controls() ),
	            'default' => [

	                [
	                    'esell_brand_title'      => 'Brand Logo',
	                    'esell_brand_link'       => __( '#', 'esell-elements' ),
	                ],
	            ],
	            'title_field' => '{{{ esell_brand_title }}}',
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
		    'islink',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Products Detail', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => 'no',
		        
		    ] 
		); 	

		$this->add_control(
		    'woocbtnstyle',
		    [
		        'label' => __( 'Button Style', 'esell-elements' ),
		        'condition'   => array( 'islink' => 'yes' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'wooc-btn-ctg-icon',
		        'options' => [
		            'wooc-btn-icon'   				=> __( 'Style One', 'esell-elements' ),
		            'wooc-btn-ctg-icon' 				=> __( 'Style Two', 'esell-elements' ),		                                  
		           
		        ],
		    ] 
		);


		$this->add_control(
		    'btntext',
		    [
		        'type'    => Controls_Manager::TEXT,
		        'label'   => __( 'Detail Text', 'esell-elements' ),
		        'default' => 'LOREM IPSUM',
		        'condition'   => array( 'islink' => 'yes' ),
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
            'wooc_options',
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
            'nav_style',
            [
                'label' => __( 'Nav Style', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'middle',
                'condition' => [
                        'slider_nav' =>'yes',
                    ],   
                'options' => [
                    'top'       => __( 'Top', 'esell-elements' ),
                    'middle'    => __( 'Middle', 'esell-elements' ),
                    'bottom'    => __( 'Bottom', 'esell-elements' ),  
                   
                ],
            ] 
        );
           
            $this->add_control(
                'slider_dots',
                [
                    'label'   => __( 'Navigation dots', 'esell-elements' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'return_value' => 'yes',
                    'description' => esc_html__( 'Enable or disable navigation dots. Default: On', 'esell-elements' ),                    
                ]
            );

            $this->add_control(
            'dots_style',
            [
                'label' => __( 'Navigation dots Style', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                            'slider_dots' =>'yes',
                        ],   
                'options' => [
                    'primary-primary'       => esc_html__( 'primary-primary', 'esell-elements' ),
                    'secondary-secondary'   => esc_html__( 'secondary-secondary', 'esell-elements' ),
                    'primary-light'         => esc_html__( 'primary-light', 'esell-elements' ),                   
                    'secondary-light'       => esc_html__( 'secondary-light', 'esell-elements' ),                 
                    'light-light'           => esc_html__( 'light-light', 'esell-elements' ),                 
                    ],
                'default' => 'primary-primary',
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
                'label'   => __( 'Slider Loop', 'esell-elements' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',    
                'description' => esc_html__( 'Loop to first item. Default: On', 'esell-elements' ),              
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
           'wooc_responsive',
               [
               'label' => __( 'Responsive Columns', 'esell-elements' ),                
               
               ]
               
           );

           $this->add_control(
               'col_lg',
               [
                   'label' => __( 'Desktops: < 1200px', 'esell-elements' ),
                   'type' => Controls_Manager::SELECT,
                   'options' => [
                       '1'  => esc_html__( '1 Col', 'esell-elements' ),
                       '2'  => esc_html__( '2 Col', 'esell-elements' ),
                       '3'  => esc_html__( '3 Col', 'esell-elements' ),
                       '4'  => esc_html__( '4 Col', 'esell-elements' ),
                       '5'  => esc_html__( '5 Col', 'esell-elements' ),
                       '6'  => esc_html__( '6 Col', 'esell-elements' ),
                       ],
                   'default' => '4',
               ] 
           );
           $this->add_control(
           'col_md',
               [
                   'label' => __( 'Desktops: < 992px', 'esell-elements' ),
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
           'col_sm',
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
           'col_xs',
               [
                   'label' => __( 'Phones: < 768px', 'esell-elements' ),
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
           $this->add_control(
           'col_mobile',
               [
                   'label' => __( 'Small Phones: < 480px', 'esell-elements' ),
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
	}

    private function wooc_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
    }
 
    protected function render() {
		$settings = $this->get_settings();  				
		$this->wooc_load_scripts();		      
        $owl_data = array( 
            'nav'                => $settings['slider_nav'] == 'yes' ? true : false,
            'dots'               => $settings['slider_dots'] == 'yes' ? true : false,
            'navText'            => array( "<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>" ),
            'autoplay'           => $settings['slider_autoplay'] == 'yes' ? true : false,
            'autoplayTimeout'    => $settings['slider_interval'],
            'autoplaySpeed'      => $settings['slider_autoplay_speed'],
            'autoplayHoverPause' => $settings['slider_stop_on_hover'] == 'yes' ? true : false,
            'loop'               => $settings['slider_loop'] == 'yes' ? true : false,
            'margin'             => 30,
            'responsive'         => array(
                '0'    => array( 'items' => $settings['col_mobile'] ),
                '480'  => array( 'items' => $settings['col_xs'] ),
                '768'  => array( 'items' => $settings['col_sm'] ),
                '992'  => array( 'items' => $settings['col_md'] ),
                '1200' => array( 'items' => $settings['col_lg'] ),
            )
        );
        $settings['owl_data'] 	= json_encode( $owl_data );
		$template 				= 'logo-slider';
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	    }
	}
