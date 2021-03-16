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

class Wooc_Isotope_Filter extends Widget_Base {

 public function get_name() {
        return 'wooc-product-slider';
    }    
    public function get_title() {
        return __( 'Product Slider', 'esell-elements' );
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
            'sec_general_layout',
            [
                'label' => __( 'General', 'esell-elements' ),
            ]
        );

        $this->add_control(
		    'style',
		    [
		        'label' => __( 'Product Style', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		           '1' => __( 'Style 1', 'esell-elements' ),
					'2' => __( 'Style 2', 'esell-elements' ),
									                  
		        ],
		    ] 
		);             
		$this->add_control(
		    'section_title_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Rating Display', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		        
		    ] 
		);   

		$this->add_control(
		    'title',
		    [
		        'label' => __( 'Title', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Title', 'esell-elements' ),
		        'placeholder' => __( 'Title', 'esell-elements' ),
		        	'condition'   => array( 'section_title_display' => 'yes' ),
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
		        'condition'   => array( 'section_title_display' => 'yes' ),
		        
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
			        'label' => __( 'Title', 'esell-elements' ),
			        'type' => Controls_Manager::TEXTAREA,
			        'default' => __( 'Title', 'esell-elements' ),
			        'description' => __( "Put the comma seperated ID's here eg. 23,26,89", 'esell-elements' ),
			         'condition'   => array( 'custom_id' => 'yes' ),
			    ]
			);
	  $this->end_controls_section();

	  

       
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'esell-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                   '1' => __( 'Layout 1', 'esell-elements' ),
					'2' => __( 'Layout 2', 'esell-elements' ),				
					                  
                ],
            ] 
        );            

	


		$this->add_control(
		    'navtype',
		    [
		        'label' => __( 'Navigation Type', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'items',
		        'options' => [
		           'items' => __( 'Selected Items', 'esell-elements' ),
					'cats'  => __( 'Selected Categories', 'esell-elements' ),
					                  
		        ],
		    ] 
		);             
		$this->add_control(
		    'navitems',
		    [
		        'label' => __( 'Items to Show', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT2,
		        'default' => 'items',
		        'multiple'  => true,
		        'default'   => array( 'featured', 'new', 'popular'),
				'condition' => array( 'navtype' => 'items' ),
		        'options' => [
		          'featured' => __( 'Featured', 'esell-elements' ),
					'new'      => __( 'New', 'esell-elements' ),
					'popular'  => __( 'Popular', 'esell-elements' ),
					'rating'   => __( 'Best Rated', 'esell-elements' ),
					'sale'     => __( 'Sale', 'esell-elements' ),
		        ],
		    ] 
		);            

		$this->add_control(
		    'navcats',
		    [
		        'label' => __( 'Categories to Show', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT2,
		        'default' => 'items',
		        'multiple'  => true,
		        'description' => __( 'If empty then all categories will be displayed', 'esell-elements' ),
		        'options'     => $this->wooc_cat_dropdown_2(),
				'condition'   => array( 'navtype' => 'cats' ),
		        
		    ] 
		);             	
		$this->add_control(
		    'cat',
		    [
		        'label' => __( 'Category', 'esell-elements' ),
		        'type' => Controls_Manager::SELECT2,
		        'multiple'  => true,
		      	'options'     => $this->wooc_cat_dropdown_1(),
				'default' => 'items',
				'condition'   => array( 'navtype' => 'items' ),
		        
		    ] 
		);             

 		$this->add_control(
        'number',
            [
                'label'   => __( 'Number of Products/Per Item', 'esell-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default'     => 4,
                'description' => __( 'Write -1 to show all', 'esell-elements' ), 
                'condition'   => array( 'navtype' => 'items' ), 
            ]

        );

		$this->add_control(
		    'out_stock_hide',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Hide Out-of-stock Products', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => 'yes',
		        
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
		        'default'     => '',
		        
		    ] 
		);   
		
		$this->add_control(
		    'all_link_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Variation Swatch Display', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '',
		       
		        
		    ] 
		);  		
		$this->add_control(
		    'filter_all_display',
		    [
		        
		        'type' => Controls_Manager::SWITCHER,
		        'label'       => __( 'Filter All Display', 'esell-elements' ),
		        'label_on'    => __( 'On', 'esell-elements' ),
		        'label_off'   => __( 'Off', 'esell-elements' ),
		        'default'     => '1',
		       
		        
		    ] 
		);   
         $this->add_control(
                'all_link_text',
                [
                    'label'   => __( 'View All link Text', 'esell-elements' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => 'View All',
                    'condition'   => array( 'all_link_display' => 'yes' ),
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
                    'default' => '4',
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
                    'default' => '3',
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
                    'default' => '3',
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
                    'default' => '2',
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
                    'default' => '1',
                ] 
            );
       $this->end_controls_section();

    }
    
	private function wooc_load_scripts(){
		wp_enqueue_script( 'images-loaded' );
		wp_enqueue_script( 'isotope' );
	}

	private function wooc_isotope_item_navigation( $data ) {
		$navs = array(
			'featured' => __( 'Featured', 'esell-elements' ),
			'new'      => __( 'New', 'esell-elements' ),
			'popular'  => __( 'Popular', 'esell-elements' ),
			'sale'     => __( 'Sale', 'esell-elements' ),
			'rating'   => __( 'Best Rated', 'esell-elements' ),
		);

		$navs = apply_filters( 'esell_isotope_item_navigations', $navs );

		foreach ( $navs as $key => $value ) {
			if ( !in_array( $key , $data['navitems'] ) ) {
				unset($navs[$key]);
			}
		}

		return $navs;
	}

	private function wooc_isotope_item_query( $data ) {

		$result = array();

		// Post type
		$args = array(
			'post_type'           => 'product',
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'posts_per_page'      => $data['number'],
		);

		// Category
		if ( !empty( $data['cat'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $data['cat'],
			);
		}

		// Out-of-stock hide
		if ( $data['out_stock_hide'] ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'outofstock',
				'operator' => 'NOT IN',
			);
		}

		$args2 = array();
		
		if ( in_array( 'new' , $data['navitems'] ) ) {
			$result['new'] = new \WP_Query( $args );
		}

		if ( in_array( 'featured' , $data['navitems'] ) ) {
			$args2['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'featured',
			);
			$result['featured'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'popular' , $data['navitems'] ) ) {
			$args2['meta_key'] = 'total_sales';
			$args2['orderby']  = 'meta_value_num';
			$args2['order']    = 'DSC';
			$result['popular'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'rating' , $data['navitems'] ) ) {
			$args2['meta_key'] = '_wc_average_rating';
			$args2['orderby']  = 'meta_value_num';
			$args2['order']    = 'DSC';
			$result['rating']  = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'sale' , $data['navitems'] ) ) {
			$args2['meta_query'][] = array(
				'key'     => '_sale_price',
				'compare' => '!=',
				'value'   => ''
			);
			$result['sale'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		return $result;
	}

	private function wooc_isotope_cats_navigation( $data ) {
		$category_dropdown = array();
		if ( $data['navcats'] ) {
			$terms = get_terms( array( 'taxonomy' => 'product_cat', 'include' => $data['navcats'], 'orderby'  => 'include' ) );
		}
		else {
			$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
		}

		foreach ( $terms as $term ) {
			$category_dropdown[$term->slug] = $term->name;
		}

		return $category_dropdown;	
	}
    private function wooc_isotope_cats_item_query( $data ) {
		// Post type
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => -1,
		);

		// Out-of-stock hide
		if ( $data['out_stock_hide'] ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'outofstock',
				'operator' => 'NOT IN',
			);
		}

		if ( $data['navcats'] ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $data['navcats'],
			);	
		}

		return new \WP_Query( $args );
	}
	protected function render() {
		$settings = $this->get_settings();		
		$this->wooc_load_scripts();
		if ( $settings['navtype'] == 'cats' ) {
			$settings['navs']  = $this->wooc_isotope_cats_navigation( $settings );
			$settings['query'] = $this->wooc_isotope_cats_item_query( $settings );
			$template = 'product-isotope-filter-2';
		}
		else {
			$settings['navs']    = $this->wooc_isotope_item_navigation( $settings );
			$settings['queries'] = $this->wooc_isotope_item_query( $settings );
			$template = 'product-isotope-filter-1';
		}
	
		return wooc_Elements_Helper::wooc_element_template( $template, $settings );
	}
}