<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\DATE_TIME;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Carousel extends Widget_Base {

 public function get_name() {
        return 'wooc-product-carousel';
    }    
    public function get_title() {
        return __( 'Product Carousel', 'esell-elements' );
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
		        'default' => '1',
		        'options' => [
		            '1'   => __( 'Style One', 'esell-elements' ),
		            '2'   => __( 'Style Two', 'esell-elements' ),
		            '3'   => __( 'Style Three', 'esell-elements' ),                           
		            '4'   => __( 'Style four', 'esell-elements' ),                           
		            '5'   => __( 'Style Five', 'esell-elements' ),                           
		           
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
	        'col-gap',
	            [
	                'label'   => __( 'Columns Gap', 'esell-elements' ),
	                'type'    => Controls_Manager::NUMBER,
	                'default'     => 30,     
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
		    'rating_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Rating Display', 'esell-elements' ),
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
	                'default'     => 4,               
	                
	            ]

	        );
		
	 	$this->add_control(
	        'number_off_row',
	            [
	                'label'   => __( 'Number Row items', 'esell-elements' ),
	                'type'    => Controls_Manager::NUMBER,
	                'default'     => 1,               
	                
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


        $this->start_controls_section(
            'sec_typography_type',
            [
                'label' => __( 'Product Typography', 'esell-elements' ),
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
				        'top'   	=> __( 'Top', 'esell-elements' ),
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
			'navText'            => array( "<i class='far fa-angle-left'></i>", "<i class='far fa-angle-right'></i>" ),
			'autoplay'           => $settings['slider_autoplay'] == 'yes' ? true : false,
			'autoplayTimeout'    => $settings['slider_interval'],
			'autoplaySpeed'      => $settings['slider_autoplay_speed'],
			'autoplayHoverPause' => $settings['slider_stop_on_hover'] == 'yes' ? true : false,
			'loop'               => $settings['slider_loop'] == 'yes' ? true : false,
			'margin'             => 60,
			'responsive'         => array(
				'0'    => array( 'items' => $settings['col_mobile'] ),
				'480'  => array( 'items' => $settings['col_xs'] ),
				'768'  => array( 'items' => $settings['col_sm'] ),
				'992'  => array( 'items' => $settings['col_md'] ),
				'1200' => array( 'items' => $settings['col_lg'] ),
			)
		);

		$settings['owl_data'] = json_encode( $owl_data );
		$settings['query']    = $this->wooc_build_query( $settings );
		
		$template = 'product-carousel';
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}