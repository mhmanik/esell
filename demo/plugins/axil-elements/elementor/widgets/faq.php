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
class wooc_faq extends Widget_Base {

 public function get_name() {
        return 'wooc_faq';
    }    
    public function get_title() {
        return __( 'FAQ', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-divider';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

	protected function _register_controls() {
		
		$this->start_controls_section(
            'faq_layout',
            [
                'label' => __( 'Faq', 'esell-elements' ),
            ]
        );


       $repeater = new Repeater();
            
            $repeater->add_control(
                'faq_title',
                [
                    'label'   => __( 'Faq  Title', 'esell-elements' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => 'Lorem Ipsum',
                ]
            );

            $repeater->add_control(
                'faq_content',
                [
                    'label' => __( 'Faq Content', 'esell-elements' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( 'faq box title', 'esell-elements' ),
                    'placeholder' => __( 'faq box title', 'esell-elements' ),
                ]
            );

            $this->add_control(
                'faq_items_content',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'show_label' => false,
                    'default' => [                       
                        [
                            'faq_title' => __( 'Lorem Ipsum', 'esell-elements' ),                           
                            'faq_content' => __( 'Lorem Ipsum', 'esell-elements' ),                           
                        ],                      

                    ],
                    'title_field' => '{{{ faq_title }}}',
                ]
            );

        $this->end_controls_section();       
	}
    protected function render() {
        $settings = $this->get_settings();
         $template   = 'faq';                    
        return wooc_Elements_Helper::wooc_element_template( $template, $settings );
    }
}