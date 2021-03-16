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
class Title extends Widget_Base {  

 public function get_name() {
        return 'wooc-title';
    }    
    public function get_title() {
        return __( 'Section Title', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-post-title';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }
  
  protected function _register_controls() {

     $this->start_controls_section(
            'title_section',
            [
                'label' => __( 'Section Title Layout', 'esell-elements' ),
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
      

        $this->add_responsive_control(
        'section_title_margin',
        [
            'label' => __( 'Section Margin', 'esell-elements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
             'condition' => array( 'before_title_style_on' => array( 'yes' ) ),
            'selectors' => [
                '{{WRAPPER}} .wooc-title-block-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
            ],
        ]
        );
        
        $this->add_responsive_control(
            'title_align',
            [
                'label'   => __( 'Alignment (flex)', 'esell-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                 'condition' => array( 'style' => array( '1' ) ),
                'options' => [
                    'flex-start'    => [
                        'title' => __( 'Left', 'esell-elements' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'esell-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'esell-elements' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wooc-title-block-1'   => 'justify-content: {{VALUE}}',
                    
                ],
                'default' => 'center',
            ]
        ); 

        $this->add_responsive_control(
            'title_text_align',
            [
                'label'   => __( 'Alignment (text-align)', 'esell-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                 'condition' => array( 'style' => array( '1' ) ),
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
                    '{{WRAPPER}} .wooc-title-block-1'   => 'text-align: {{VALUE}}',
                    
                ],
                'default' => 'center',
            ]
        );
      

        $this->add_responsive_control(
            'title_align2',
            [
                'label'   => __( 'Alignment', 'esell-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                 'condition' => array( 'style' => array( '2' ) ),
                    'options' => [
                        'space-between'    => [
                            'title' => __( 'Left', 'esell-elements' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'esell-elements' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => __( 'Right', 'esell-elements' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                'selectors' => [                    
                    '{{WRAPPER}} .wooc-slider-title-block-1'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .wooc-slider-title-block-1'   => 'justify-content: {{VALUE}};',
                ],
                'default' => 'space-between',
            ]
        );

        $this->end_controls_section();

     $this->start_controls_section(
            'title_before_section',
            [
                'label' => __( 'Title Right', 'esell-elements' ),
                'condition' => [
                    'style' => '2',
                ],  

            ]

        );
         $this->add_control(
            'islink',
            [
                
                'type' => Controls_Manager::SWITCHER,
                'label'       => __( 'Detail Link', 'esell-elements' ),
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'no',               
                
            ] 
        );                    

        $this->add_control(
            'btntext',
            [
                'label'   => __( 'Button Text', 'esell-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'LOREM IPSUM',
            ]
        );
        $this->add_control(
            'url',
            [
                'label'   => __( 'Button Link', 'esell-elements' ),
                'type'    => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                
            ]
        );  

        $this->end_controls_section();



        $this->start_controls_section(
            'title_text_section',
            [
                'label' => __( 'Title', 'esell-elements' ),
            ]
        );
        $this->add_responsive_control(
            'sec_title_tag',
            [
                'label' => __( 'Title HTML Tag', 'esell-elements' ),
                'type' => Controls_Manager::CHOOSE,
                 'options' => [
                      'h1'  => [
                        'title' => esc_html__( 'H1', 'esell-elements' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'esell-elements' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'esell-elements' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'esell-elements' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'esell-elements' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'esell-elements' ),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'div'  => [
                        'title' => esc_html__( 'div', 'esell-elements' ),
                        'icon' => 'eicon-font'
                    ]
                ],
                'default' => 'h3',               

            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Type your title here...', 'esell-elements' ),
                'default' => 'Section title here',
            ]
        ); 
       $this->end_controls_section();


        $this->start_controls_section(
            'sub_title_section',
            [
                'label' => __( 'Sub Title', 'esell-elements' ),
            ]
        );
        
       $this->add_control(
            'sub_title',
            [
                'label' => __( 'Description', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Type your Description here.', 'esell-elements' ),    
                 'default' => 'Section sub title here',            
            ]
        );
        $this->end_controls_section();
       
        $this->start_controls_section(
            'before_title_style_section',
            [
                'label' => __( 'Title Before', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,                
            ]
        );

         $this->add_control(
            'before_title_style_on',
            [
                'label' => __( 'Customize', 'esell-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on'    => __( 'On', 'esell-elements' ),
                'label_off'   => __( 'Off', 'esell-elements' ),
                'default'     => 'no',
               
            ]
        );  
          $this->add_control(
            'before_title_color',
            [
                'label' => __( 'Color', 'esell-elements' ),
                'type' => Controls_Manager::COLOR,  
                'default' => '',
                'condition' => array( 'before_title_style_on' => array( 'yes' ) ),
                'selectors' => array(
                    '{{WRAPPER}} .woocue-sub-title:after' => 'background-color: {{VALUE}}',
                ),
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


        $this->start_controls_section(
            'abc_sub_title_style_section',
            [
                'label' => __( 'Sub Title', 'esell-elements' ),
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
       
    $this->end_controls_section();

  }


    protected function render() {
        $settings = $this->get_settings();
        $template   = 'title-' . str_replace("style", "", $settings['style']);                 
        return wooc_Elements_Helper::wooc_element_template( $template, $settings );
    }
}
