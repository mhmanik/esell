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

class eSellDivider extends Widget_Base {  

 public function get_name() {
        return 'esell-divider';
    }    
    public function get_title() {
        return __( ' divider', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-divider';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

  
  protected function _register_controls() {
      $this->start_controls_section(
     'divider_content',
            [
                'label' => __( 'Divider', 'esell-elements' ),
            ]
        );
       
        $this->add_control(
            'icons_disable',
            [
                'label'   => __( 'Icons', 'esell-elements' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'description' => esc_html__( 'Enable or disable Icons. Default: On', 'esell-elements' ),                    
            ]
        );

        $this->add_control(
        'icon',
            [
                'label' => __( 'Icons', 'esell-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'flaticon-lotus-flower',
                    'library' => 'solid',
                ],
            'condition' => [
                'icons_disable' =>'yes',
            ],   

            ]
        );       
  }

    protected function render() {
        $settings = $this->get_settings();         
        $template   = 'divider';    
         return wooc_Elements_Helper::wooc_element_template( $template, $settings );

       
    }
}
