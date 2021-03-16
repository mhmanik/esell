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

class Product_Media_Grid extends Widget_Base {

 public function get_name() {
        return 'wooc-product-wrp-media-grid';
    }    
    public function get_title() {
        return __( 'Product Media Grid', 'esell-elements' );
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
		    'style',
		    [
		        'label' => __( 'Style', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'style1',
		        'options' => [
		            'style1'   => __( 'Style One', 'esell-elements' ),
		            'style2'   => __( 'Style Two', 'esell-elements' ),
		            'style3'   => __( 'Style Three', 'esell-elements' ),                           
		           
		        ],
		    ] 
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Box Height', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-wrp' => 'height: {{SIZE}}{{UNIT}};',
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
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
								
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-wrp' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_posx_type',
			[
				'label' => __( 'Horizontal Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'esell-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-up',
					],
					'right' => [
						'title' => __( 'Right', 'esell-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'image_offset',
			[
				'label' => __( 'Offset', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,							
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-wrp .wooc-img.wooc-posx-left'    => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wooc-product-wrp .wooc-img.wooc-posx-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Image Width', 'esell-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],					
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,							
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 110,
					],				
				'devices' => [ 'desktop', 'tablet', 'mobile' ],				
				'selectors' => [
					'{{WRAPPER}} .wooc-product-wrp .wooc-img'    => 'max-width: {{SIZE}}{{UNIT}};',
					
				],
			]
		);

		
		$this->add_control(
		    'col-gap',
		    [
		        'label' => __( 'Columns Gap', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT2,
		        'default' => '15',
		        'options' => [
		            '15' => '30px',
		            '10' => '20px',
		            '5'  => '10px',
		            '0'  => '0',
		        ],
		        'prefix_class' => 'column-gap-',
		        'frontend_available' => true,
		    ]
		);

		$this->add_control(
		    'all_link_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'View All link Display at To', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		       
		        
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
            'esell_responsive',
                [
                'label' => __( 'Responsive Columns', 'esell-elements' ),
                ]
            );

            $this->add_control(
                'col_xl',
                [
                    'label' => __( 'Desktops: > 1199px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '12'  => esc_html__( '1 Col', 'esell-elements' ),
                        '6'  => esc_html__( '2 Col', 'esell-elements' ),
                        '4'  => esc_html__( '3 Col', 'esell-elements' ),
                        '3'  => esc_html__( '4 Col', 'esell-elements' ),                        
                        '2'  => esc_html__( '6 Col', 'esell-elements' ),
                        ],
                    'default' => '3',
                ] 
            );
            $this->add_control(
            'col_lg',
                [
                    'label' => __( 'Desktops: > 991px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '12'  => esc_html__( '1 Col', 'esell-elements' ),
                        '6'  => esc_html__( '2 Col', 'esell-elements' ),
                        '4'  => esc_html__( '3 Col', 'esell-elements' ),
                        '3'  => esc_html__( '4 Col', 'esell-elements' ),                        
                        '2'  => esc_html__( '6 Col', 'esell-elements' ),
                        ],
                    'default' => '4',
                ] 
            );
            $this->add_control(
            'col_md',
                [
                    'label' => __( 'Tablets: > 767px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                            '12'  => esc_html__( '1 Col', 'esell-elements' ),
                            '6'  => esc_html__( '2 Col', 'esell-elements' ),
                            '4'  => esc_html__( '3 Col', 'esell-elements' ),
                            '3'  => esc_html__( '4 Col', 'esell-elements' ),                        
                            '2'  => esc_html__( '6 Col', 'esell-elements' ),
                        ],
                    'default' => '6',
                ] 
            );

            $this->add_control(
            'col_sm',
                [
                    'label' => __( 'Phones: >575px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                            '12'  => esc_html__( '1 Col', 'esell-elements' ),
                            '6'  => esc_html__( '2 Col', 'esell-elements' ),
                            '4'  => esc_html__( '3 Col', 'esell-elements' ),
                            '3'  => esc_html__( '4 Col', 'esell-elements' ),                        
                            '2'  => esc_html__( '6 Col', 'esell-elements' ),
                        ],
                    'default' => '6',
                ] 
            );         
            $this->add_control(
            'col_mobile',
                [
                    'label' => __( 'Small Phones: <576px', 'esell-elements' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                            '12'  => esc_html__( '1 Col', 'esell-elements' ),
                            '6'  => esc_html__( '2 Col', 'esell-elements' ),
                            '4'  => esc_html__( '3 Col', 'esell-elements' ),
                            '3'  => esc_html__( '4 Col', 'esell-elements' ),                        
                            '2'  => esc_html__( '6 Col', 'esell-elements' ),
                        ],
                    'default' => '12',
                ] 
            );
       $this->end_controls_section();
    }
    
	protected function render() {
		$settings = $this->get_settings();

		if ( $settings['style'] == 'style2' ) {			
			$template = 'product-grid-2';
		}else {			
			$template = 'product-grid-1';
		}

		$settings['query'] = $this->wooc_build_query( $settings );	
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}