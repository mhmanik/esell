<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Post_Grid extends Widget_Base {

 public function get_name() {
        return 'wooc-post-grid';
    }    
    public function get_title() {
        return __( 'Posts grid', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-posts-grid';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

   protected function _register_controls() {  
        $terms  = get_terms( array( 'taxonomy' => 'category', 'fields' => 'id=>name' ) );
        $category_dropdown = array( '0' => esc_html__( 'All Categories', 'esell-elements' ) );

        foreach ( $terms as $id => $name ) {
            $category_dropdown[$id] = $name;
        }    
         $this->start_controls_section(                     
            'sec_section_layout',
                    [
                        'label' => __( 'Section Title', 'esell-elements' ),
                    ]
                );



        $this->add_control(
            'style',
            [
                'label' => __( 'Layout Style', 'esell-elements' ),
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
            'layout_type',
            [
                'label' => __( 'Layout', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'Grid', 'esell-elements' ),
                    '2' => __( 'Slider', 'esell-elements' ),                                
                                                   
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
                    'wooc-btn-icon'                 => __( 'Style One', 'esell-elements' ),
                    'wooc-btn-ctg-icon'                 => __( 'Style Two', 'esell-elements' ),                                       
                   
                ],
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

       
        $this->add_control(
            'btntext',
            [
                'type'    => Controls_Manager::TEXT,
                'label'   => __( 'Detail Text', 'esell-elements' ),
                'default' => 'LOREM IPSUM',
                'condition'   => array( 'islink' => 'yes' ),
            ]
        );
        
        $this->end_controls_section();
                     
      $this->start_controls_section(                     
        'sec_layout',
                [
                    'label' => __( 'Categories & Sorting', 'esell-elements' ),
                ]
            );                            
        $this->add_control(
            'number_of_post',
                [
                    'label'   => __( 'Number', 'esell-elements' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '12',  
                    'description' => __( 'Maximum number of words to display', 'esell-elements' ),                   
                ]

            );

        $this->add_control(
            'cat',
                [
                    'label' => __( 'Categories', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT2,
                     'default' => '0',
                 
                    'options' => $category_dropdown,
                ] 
            ); 
        $this->add_control(      
            'orderby',
                [
                    'label' => __( 'Post Sorting', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT2,
                        'options' => [
                        'date'        => __( 'Date (Recents comes first)', 'esell-elements' ),
                        'title'       => __( 'Title', 'esell-elements' ),
                        'menu_order'  => __( 'Custom Order (Available via Order field inside Page Attributes box)', 'esell-elements' ),
                        ],
                    'default' => 'date',
                ] 
            );
         $this->end_controls_section();


  
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __( 'Section Title', 'esell-elements' ),
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
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'esell-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                 'condition' => array( 'title_style_on' => array( 'yes' ) ),
                'selectors' => [
                    '{{WRAPPER}} .wooc-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                   
                ],
            ]
        );
    $this->end_controls_section();


  $this->start_controls_section(
            'abc_sub_title_style_section',
            [
                'label' => __( 'Section Sub Title', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,                
            ]
        );

         $this->add_control(
            'sub_title_style_on',
            [
                'label' => __( 'Customize', 'esell-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'no',
               
            ]
        );   

 
          $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,  
                'default' => '',
                'condition' => array( 'sub_title_style_on' => array( 'yes' ) ),
                'selectors' => array(
                    '{{WRAPPER}} .woocue-sub-title' => 'color: {{VALUE}}',
                ),
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_font_size',
                'label' => __( 'Typography', 'esell-elements' ),                
                 'condition' => array( 'sub_title_style_on' => array( 'yes' ) ),
                'selector' => '{{WRAPPER}} .woocue-sub-title',
            ]
        );
       
        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label' => __( 'Margin', 'esell-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                 'condition' => array( 'sub_title_style_on' => array( 'yes' ) ),
                'selectors' => [
                    '{{WRAPPER}} .woocue-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->add_responsive_control(
            'sub_title_padding',
            [
                'label' => __( 'Padding', 'esell-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                 'condition' => array( 'sub_title_style_on' => array( 'yes' ) ),
                'selectors' => [
                    '{{WRAPPER}} .woocue-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                   
                ],
            ]
        );
        $this->end_controls_section();


            $this->start_controls_section(
                'wooc_options',
                    [
                    'label' => __( 'Slider Options', 'esell-elements' ),
                    'condition' => array( 'layout_type' => array( '2' ) ),
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
                    'condition' => array( 'layout_type' => array( '2' ) ),
                   
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
        wp_enqueue_style(  'owl-carousel' );
        wp_enqueue_style(  'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
    }

    private function wooc_query( $settings, $qty = 3 ) {
        $args = array(
            'cat'                 => (int) $settings['cat'],
            'orderby'             => $settings['orderby'],
            'posts_per_page'      => $qty,
            'post_status'         => 'publish',
            'suppress_filters'    => false,
            'ignore_sticky_posts' => true,
        );

        switch ( $settings['orderby'] ) {
            case 'title':
            case 'menu_order':
            $args['order'] = 'ASC';
            break;
        }

        return new \WP_Query( $args );
    }

        protected function render() {    
            $settings = $this->get_settings();
            $settings['query'] = $this->wooc_query( $settings,  $settings['number_of_post'] );

            if ( $settings['layout_type'] == '1' ) {                
                $template   = 'post-grid-' . str_replace("style", "", $settings['style']); 
            }else{
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
                $settings['owl_data'] = json_encode( $owl_data );
                $template   = 'post-slider-' . str_replace("style", "", $settings['style']); 
            }
           
            return wooc_Elements_Helper::wooc_element_template( $template, $settings );
        }

    }
