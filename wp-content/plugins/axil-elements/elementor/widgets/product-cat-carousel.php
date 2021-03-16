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


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Product_Cat_Carousel extends Widget_Base {
   
    public function get_name() {
        return 'esell-product-cat-slider';
    }
    
    public function get_title() {
        return __( ESELL_ELEMENTS_THEME_PREFIX . ' Product Category Slider', 'esell-elements' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    private function wooc_cat_dropdown() {
    $terms = get_terms( array( 'taxonomy' => 'product_cat' ) );
    $category_dropdown = array( '0' => __( 'All Categories', 'esell-elements' ) );

    foreach ( $terms as $category ) {
      $category_dropdown[$category->term_id] = $category->name;
    }

    return $category_dropdown;
  }
    protected function _register_controls() {


    $this->start_controls_section(
            'product_cat_layout',
            [
                'label' => __( 'Layout', 'esell-elements' ),
            ]
        );      

      $this->add_control(
              'style',
              [
                  'label' => __( 'Style', 'esell-elements' ),
                  'type' => Controls_Manager::SELECT,
                  'default' => 'style1',     
                  'condition'   => array( 'layout' => 'slider' ),                
                  'options' => [
                      'style1'           => __( 'Style One', 'esell-elements' ),
                      'style2'           => __( 'Style Two', 'esell-elements' ), 
                                        
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

        $this->add_control(      
            'select_categories',
                [
                'label'         => __( 'Categories', 'esell-elements' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->wooc_cat_dropdown(),            
                'label_block'   => true,                
                'default'       => '0',
                'separator'     => 'before',
                 'multiple'     => true,
                ] 
            );


         $this->add_control(
            'cat_image_show',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Image Show', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
            ] 
        );   

      $this->add_control(
            'hide_empty_category',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Hide Empty Category', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
            ] 
        );   


      $this->add_control(
            'product_count',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Product Count Show', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
            ] 
        );   



      $this->add_control(
            'show_description',
            [
                 'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Show Description', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'yes',
            
            ] 
        );   
      $this->add_control(
            'product_text',
            [
                'type'    => Controls_Manager::TEXT,
                'label'       => __( 'Product Text', 'esell-elements' ),
                'default'     => 'Products',
                'condition'   => array( 'section_title_display' => 'yes' ),         
            ]
        );

      $this->add_control(
        'number',
            [
                'label'   => __( 'Number of items', 'esell-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 12,                   
                               
                ]
            );
      $this->add_control(
            'button_text',
            [
                'type'    => Controls_Manager::TEXT,
                'label'       => __( 'Button Text', 'esell-elements' ),
                'default'     => 'Shop Now',                      
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
                       '7'  => esc_html__( '7 Col', 'esell-elements' ),
                       '8'  => esc_html__( '8 Col', 'esell-elements' ),
                       ],
                   'default' => '8',
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
                       '7'  => esc_html__( '7 Col', 'esell-elements' ),
                       '8'  => esc_html__( '8 Col', 'esell-elements' ),
                       ],
                   'default' => '6',
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
                      '7'  => esc_html__( '7 Col', 'esell-elements' ),
                       '8'  => esc_html__( '8 Col', 'esell-elements' ),
                       ],
                   'default' => '4',
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
                        '7'  => esc_html__( '7 Col', 'esell-elements' ),
                       '8'  => esc_html__( '8 Col', 'esell-elements' ),
                       ],
                   'default' => '3',
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
                        '7'  => esc_html__( '7 Col', 'esell-elements' ),
                       '8'  => esc_html__( '8 Col', 'esell-elements' ),
                       ],
                   'default' => '2',
               ] 
           );
        $this->end_controls_section();

         $this->start_controls_section(
            'title_style_section',
            [
                'label' => __( 'Title', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,                
            ]
        );

         $this->add_control(
            'title_style_on',
            [
                'label' => __( 'Customize', 'esell-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'no',
               
            ]
        );   

 
          $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,  
                'default' => '',
                'condition' => array( 'title_style_on' => array( 'yes' ) ),
                'selectors' => array(
                    '{{WRAPPER}} .woocue-sec-title' => 'color: {{VALUE}}',
                ),
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font_size',
                'label' => __( 'Typography', 'esell-elements' ),                
                 'condition' => array( 'title_style_on' => array( 'yes' ) ),
                'selector' => '{{WRAPPER}} .woocue-sec-title',
            ]
        );
       
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'esell-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                 'condition' => array( 'title_style_on' => array( 'yes' ) ),
                'selectors' => [
                    '{{WRAPPER}} .woocue-sec-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        
    $this->end_controls_section();
	}

    private function wooc_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-carousel-default' );
        wp_enqueue_script( 'owl-carousel' );
    }
 
    protected function render() {
		$settings = $this->get_settings();  				
	 $this->wooc_load_scripts();       
        $owl_data = array( 
            'nav'                => $settings['slider_nav'] == 'yes' ? true : false,
            'dots'               => $settings['slider_dots'] == 'yes' ? true : false,
              'navText'            => array( "<i class='far fa-angle-left'></i>", "<i class='far fa-angle-right'></i>" ),
            'autoplay'           => $settings['slider_autoplay'] == 'yes' ? true : false,
            'autoplayTimeout'    => $settings['slider_interval'],
            'autoplaySpeed'      => $settings['slider_autoplay_speed'],
            'autoplayHoverPause' => $settings['slider_stop_on_hover'] == 'yes' ? true : false,
            'loop'               => $settings['slider_loop'] == 'yes' ? true : false,
            'margin'             => 15,
            'responsive'         => array(
                '0'    => array( 'items' => $settings['col_mobile'] ),
                '480'  => array( 'items' => $settings['col_xs'] ),
                '768'  => array( 'items' => $settings['col_sm'] ),
                '992'  => array( 'items' => $settings['col_md'] ),
                '1200' => array( 'items' => $settings['col_lg'] ),
            )
        );
        $settings['owl_data'] 	= json_encode( $owl_data );
         
        $template   = 'product-cat-carousel-' . str_replace("style", "", $settings['style']);    
    		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	    }
	}
