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
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\DATE_TIME;
use Elementor\SLIDER;
use Elementor\CHOOSE;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class library_tabs extends Widget_Base {

 public function get_name() {
        return 'esell-library-tab';
    }    
    public function get_title() {
        return __( ESELL_ELEMENTS_THEME_PREFIX . ' Library Tabs', 'esell-elements' );
    }
    public function get_icon() {
        return 'eicon-accordion';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    public function get_post_template( $type = 'page' ) {
    $posts = get_posts(
      array(
        'post_type'      => 'elementor_library',
        'orderby'        => 'title',
        'order'          => 'ASC',
        'posts_per_page' => '-1',
        'tax_query'      => array(
          array(
            'taxonomy' => 'elementor_library_type',
            'field'    => 'slug',
            'terms'    => $type,
          ),
        ),
      )
    );
    $templates = array();
    foreach ( $posts as $post ) {
      $templates[] = array(
        'id'   => $post->ID,
        'name' => $post->post_title,
      );
    }
    return $templates;
  }

  public function get_saved_data( $type = 'section' ) {
    $saved_widgets = $this->get_post_template( $type );
    $options[-1]   = __( 'Select', 'esell-elements' );
    if ( count( $saved_widgets ) ) {
      foreach ( $saved_widgets as $saved_row ) {
        $options[ $saved_row['id'] ] = $saved_row['name'];
      }
    } else {
      $options['no_template'] = __( 'It seems that, you have not saved any template yet.', 'esell-elements' );
    }
    return $options;
  }

  public function get_content_type() {
    $content_type = array(
      'content'              => __( 'Content', 'esell-elements' ),
      'saved_rows'           => __( 'Saved Section', 'esell-elements' ),
      'saved_page_templates' => __( 'Saved Page', 'esell-elements' ),
    );
    return $content_type;
  }

	protected function _register_controls() {
        $this->start_controls_section(
            'library_tab_content',
                [
                    'label' => __( 'Library Tabs Items', 'esell-elements' ),
                ]
            );

          $this->add_control(
            'style',
            [
                'label' => __( 'Layout', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'Style 1', 'esell-elements' ),
                    '2' => __( 'Style 2', 'esell-elements' ),                                
                    '3' => __( 'Style 3', 'esell-elements' ),                                
                ],
            ] 
        );         

           
            $repeater = new Repeater();
            
            $repeater->add_control(
            'tab_nav',
                [
                    'label'   => __( 'Nav Title', 'esell-elements' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => 'Lorem Ipsum',
                ]
            );
            $repeater->add_control(
            'colortype',
                [
                'label' => __( 'Color Type', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                    'options' => [
                        'primary'       => __( 'Primary', 'esell-elements' ),
                        'secondary'     => __( 'Secondary', 'esell-elements' ),                              
                        'light'         => __( 'Light', 'esell-elements' ),                              
                        'accent'        => __( 'Accent Color', 'esell-elements' ),                              
                    ],
                ] 
            );              
            $repeater->add_control(
                'title',
                [
                'label' => __( 'Title', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Title', 'esell-elements' ),
                'placeholder' => __( 'Title', 'esell-elements' ),
                ]
            );
            $repeater->add_control(
                'subtitle',
                [
                'label' => __( 'Sub Title', 'esell-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Sub title', 'esell-elements' ),
                'placeholder' => __( 'Sub title', 'esell-elements' ),
                ]
            );
            $repeater->add_control(
                'icontype',
                [
                    'label' => __( 'Style', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',                   
                    'options' => [
                        'icon'  => esc_html__( 'Icon', 'esell-elements' ),
                        'image' => esc_html__( 'Custom Image', 'esell-elements' ),
                    ],
                ] 
            );
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icons', 'esell-elements' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-university',
                        'library' => 'solid',
                    ],
                    'condition' => [
                            'icontype' =>'icon',
                    ],      
                ]
            );
            $repeater->add_control(
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
                    'condition' => [
                                'icontype' =>'image',
                            ],      
                ]
            );

            $repeater->add_control(
                'library_tab_library',
                [
                    'label' => __( 'Elementor Library', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => $this->get_saved_data('section'),
                ]
            );

            $this->add_control(
                'library_tab_items',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'show_label' => false,
                    'default' => [                       
                        [
                            'tab_nav' => __( 'Standard Feature', 'esell-elements' ),                           
                            'title' => __( 'Standard Feature', 'esell-elements' ),                           
                        ],                      

                    ],

                    'title_field' => '{{{ tab_nav }}}',
                ]
            );
           
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();	
        $template   = 'library-tabs-' . str_replace("style", "", $settings['style']); 
         return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}