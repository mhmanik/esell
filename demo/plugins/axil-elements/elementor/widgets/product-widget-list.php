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
use Elementor\DATE_TIME;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Widget_List extends Widget_Base {

 public function get_name() {
        return 'wooc-product-widget-list';
    }    
    public function get_title() {
        return __( 'Product Widget List', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

	private function wooc_cat_dropdown_1() {
		$terms = get_terms( array( 'taxonomy' => 'product_cat' ) );
		$category_dropdown = array( '0' => __( 'All Categories', 'esell-elements' ) );

		foreach ( $terms as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		return $category_dropdown;
	}
	private function wooc_cat_dropdown_2() {
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0, 'hide_empty' => false ) );
		$category_dropdown = array();
		foreach ( $terms as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		return $category_dropdown;
	}

	private function wooc_build_query( $settings ) {

		if ( !$settings['custom_id'] ) {

			// Post type
			$number = $settings['number'];
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $number ? $number : 3,
				'ignore_sticky_posts' => true,
				'post_status'         => 'publish',
				'suppress_filters'    => false,
			);

			$args['tax_query'] = array();

			// Category
			if ( !empty( $settings['cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $settings['cat'],
				);
			}

			// Featured only
			if ( $settings['featured_only'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'slug',
					'terms'    => 'featured',
				);
			}

			// Out-of-stock hide
			if ( $settings['out_stock_hide'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'slug',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				);
			}

			// Order
			$args['orderby'] = $settings['orderby'];
			switch ( $settings['orderby'] ) {

				case 'title':
				case 'menu_order':
				$args['order']    = 'ASC';
				break;

				case 'bestseller':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'total_sales';
				break;

				case 'rating':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_wc_average_rating';
				break;

				case 'price_l':
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'ASC';
				$args['meta_key'] = '_price';
				break;

				case 'price_h':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_price';
				break;
			}
		}

		else {

			$posts = array_map( 'trim' , explode( ',', $settings['product_ids'] ) );
			$args = array(
				'post_type'      => 'product',
				'ignore_sticky_posts' => true,
				'nopaging'       => true,
				'post__in'       => $posts,
				'orderby'        => 'post__in',
			);
		}

		return new \WP_Query( $args );
	}


    protected function _register_controls() {
        
        $args = array(
			'post_type'           => 'product',
			'posts_per_page'      => -1,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'ignore_sticky_posts' => true,
		);
		$products = get_posts( $args );
		$products_dropdown = array();

		foreach ( $products as $product ) {
			$products_dropdown[$product->ID] = $product->post_title;
		}

 		$this->start_controls_section(
            'sec_general',
            [
                'label' => __( 'General', 'esell-elements' ),                
            ]
        );
		
		
		$this->add_control(
		    'title',
		    [
		        'label' => __( 'Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Title', 'esell-elements' ),
		        'placeholder' => __( 'Title', 'esell-elements' ),
		    ]
		);

		$this->add_control(
		    'custom_id',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Custom Product ID', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
		    ] 
		);   
		$this->add_control(
		    'thumb_border',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Thumb Border', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
		    ] 
		);   

		$this->add_control(
		    'product_ids',
		    [
			'label'       => __( "Product ID's, seperated by commas", 'esell-elements' ),
			'type'    => Controls_Manager::TEXT,
			'description' => __( "Put the comma seperated ID's here eg. 23,26,89", 'esell-elements' ),
			'condition'   => array( 'custom_id' => 'yes' ),
		    ]
		);

		$this->add_control(
		    'cat_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Category Name Display', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => 'yes',
		        
		    ] 
		); 		
		$this->add_control(
		    'price_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Display price ', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => 'no',
		        
		    ] 
		); 		
		$this->add_control(
		    'sale_price_only',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Display only sale price', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',		      
		        
		    ] 
		);   	

		$this->add_control(
		    'rating_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Display only Rating', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',		      
		        
		    ] 
		);   
 		$this->end_controls_section();
			
        $this->start_controls_section(
            'sec_filter',
            [
                'label' => __( 'Product Filtering', 'esell-elements' ),
                'condition'   => array( 'custom_id' => '' ),
            ]
        );
       				
	 	$this->add_control(
	        'number',
	            [
	                'label'   => __( 'Number of items', 'esell-elements' ),
	                'type'    => Controls_Manager::NUMBER,
	                'default'     => 3,               
	                
	            ]

	        );
 				
	 	$this->add_control(
	        'number_off_row',
	            [
	                'label'   => __( 'Number Row items', 'esell-elements' ),
	                'type'    => Controls_Manager::NUMBER,
	                'default'     => 3,               
	                
	            ]

	        );


         $this->add_control(      
            'cat',
                [
                'label' => __( 'Categories', 'esell-elements' ),
                'type' => Controls_Manager::SELECT2,
               	'options'     => $this->wooc_cat_dropdown_2(),            
                'label_block'   => true,                
                'default'     => '0',
                'separator'     => 'before',
                 'multiple'  => true,
                ] 
            );

		$this->add_control(      
            'orderby',
                [
                'label' => __( 'Categories', 'esell-elements' ),
                'type' => Controls_Manager::SELECT2,
	               'options'     => array(
						'date'        => __( 'Date (Recents comes first)', 'esell-elements' ),
						'title'       => __( 'Title', 'esell-elements' ),
						'bestseller'  => __( 'Bestseller', 'esell-elements' ),
						'rating'      => __( 'Rating(High-Low)', 'esell-elements' ),
						'price_l'     => __( 'Price(Low-High)', 'esell-elements' ),
						'price_h'     => __( 'Price(High-Low)', 'esell-elements' ),
						'rand'        => __( 'Random(Changes on every page load)', 'esell-elements' ),
						'menu_order'  => __( 'Custom Order (Available via Order field inside Page Attributes box)', 'esell-elements' ),
					),    
                'label_block'   => true,                
                'default'     => 'date',
                'separator'     => 'before',
                ] 
            );

		$this->add_control(
		    'out_stock_hide',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Hide Out-of-stock Products', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
		    ] 
		); 		

		$this->add_control(
		    'featured_only',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Display only Featured Products', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
		    ] 
		); 		
		$this->add_control(
		    'quickview',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Display only quickview Products', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
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
		    'btntext',
		    [
		        'label'   => __( 'Detail Text', 'esell-elements' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'LOREM IPSUM',
		        'condition'   => array( 'islink' => 'yes' ),
		    ]
		);
		
		$this->end_controls_section();


        $this->start_controls_section(
            'sec_typography_type',
            [
                'label' => __( 'Typography', 'esell-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,   
            ]
        );


		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
			    'name' => 'section_typo',
			    'label' => __( 'Section Typography', 'esell-elements' ),  
			     'devices' => [ 'desktop', 'tablet', 'mobile' ],	
			   'selector' => '{{WRAPPER}} .woocue-widget-title',
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
			    'name' => 'title_typo',
			    'label' => __( 'Typography', 'esell-elements' ),  
			     'devices' => [ 'desktop', 'tablet', 'mobile' ],	
			   'selector' => '{{WRAPPER}} .woocue-title',
			]
		);

		$this->add_responsive_control(
			'title_typo_margin',
				[
				    'label' => __( 'Margin', 'esell-elements' ),
				    'type' => Controls_Manager::DIMENSIONS,
				    'size_units' => [ 'px', '%', 'em' ],
				    'devices' => [ 'desktop', 'tablet', 'mobile' ],					    
				    'selectors' => [
				        '{{WRAPPER}}  .wooc-product-wrp .woocue-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        
				    ],
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
			'dots'               => $settings['slider_dots'] == 'yes' ? true : false,
			'navText'            => array( "<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>" ),
			'autoplay'           => $settings['slider_autoplay'] == 'yes' ? true : false,
			'autoplayTimeout'    => $settings['slider_interval'],
			'autoplaySpeed'      => $settings['slider_autoplay_speed'],
			'autoplayHoverPause' => $settings['slider_stop_on_hover'] == 'yes' ? true : false,
			'loop'               => $settings['slider_loop'] == 'yes' ? true : false,
			'margin'             => 30,
			'responsive'         => array(
				'0'    => array( 'items' => 1 ),
				'480'  => array( 'items' => 1 ),
				'768'  => array( 'items' => 1 ),
				'992'  => array( 'items' => 1 ),
				'1200' => array( 'items' => 1 ),
			)
		);

		$settings['owl_data'] = json_encode( $owl_data );	
		$settings['query'] = $this->wooc_build_query( $settings );	
		$template = 'product-widget-list-1';		
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}