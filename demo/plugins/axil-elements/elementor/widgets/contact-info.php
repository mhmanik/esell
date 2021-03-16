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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class contact_info extends Widget_Base {

 public function get_name() {
        return 'wooc-contact-info';
    }    
    public function get_title() {
        return __('Contact Information', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-info-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

	protected function _register_controls() {				   

            $this->start_controls_section(
            'contact_info',
                [
                    'label' => __( 'Contact info', 'esell-elements' ),                     
                           
                ]
            );
            $this->add_control(
                'theme',
                [
                    'label' => __( 'Layout', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'light-bg',
                    'options' => [
                        'light-bg' => __( 'Light', 'esell-elements' ),
                        'primary-bg' => __( 'Primary', 'esell-elements' ),                                 
                        'secondary-bg' => __( 'Secondary', 'esell-elements' ),                                 
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
                        '{{WRAPPER}} .contact-us-box .contact-information-area .contact-information' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
             $this->add_control(
                'icon',
                [
                    'label' => __( 'Icons', 'esell-elements' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'flaticon-check',
                        'library' => 'solid',
                    ],                     
                ]
            );      
            
            $this->add_control(
                'title',
                [
                    'label' => __( 'Title', 'esell-elements' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( 'Info box title', 'esell-elements' ),
                    'placeholder' => __( 'Info box title', 'esell-elements' ),
                ]
            ); 

             $this->add_control(
                'phone_lab',
                [
                    'label' => __( 'Phone label', 'esell-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Phone:', 'esell-elements' ),
                    'placeholder' => __( 'Phone label', 'esell-elements' ),
                ]
            ); 
            $this->add_control(
                'phone',
                [
                    'label' => __( 'Phone', 'esell-elements' ),
                    'type' => Controls_Manager::TEXT,                    
                    'placeholder' => __( 'Phone', 'esell-elements' ),
                ]
            );  
           
            $this->add_control(
                'email_lab',
                [
                    'label' => __( 'Email label', 'esell-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Email:', 'esell-elements' ),
                    'placeholder' => __( 'Email', 'esell-elements' ),
                ]
            );
            $this->add_control(
                'email',
                [
                    'label' => __( 'Email', 'esell-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'contact@email.com', 'esell-elements' ),
                    'placeholder' => __( 'Contact Email', 'esell-elements' ),
                ]
            ); 
             $this->add_control(
                'office_lab',
                [
                    'label' => __( 'Office label', 'esell-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Office:', 'esell-elements' ),
                    'placeholder' => __( 'Address label', 'esell-elements' ),
                ]
            );

            $this->add_control(
                'office',
                [
                    'label' => __( 'Office Address', 'esell-elements' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( 'Contact Office', 'esell-elements' ),
                    'placeholder' => __( 'Contact Office', 'esell-elements' ),
                ]
            );
           

         $this->add_control(
                'buttontext',
                [
                    'label'   => __( 'Button Text', 'esell-elements' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => 'LOREM IPSUM',
                ]
            );
            $this->add_control(
                    'url',
                    [
                        'label'   => __( 'URL', 'esell-elements' ),
                        'type'    => Controls_Manager::URL,
                        'placeholder' => 'https://your-link.com',
                    ]
            );    

        $this->end_controls_section();    
 
       
	}

	protected function render() {
		$settings = $this->get_settings();	
        $template   = 'contact-info';     
        return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}