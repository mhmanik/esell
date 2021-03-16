<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

    class esell_Widgets_Control{
        public function __construct(){
            $this->esell_widgets_control();                  
            
        }

    public function esell_widgets_control(){
        $sectiontitle = 'on';
        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager; 

      
         $widget_files = [
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/login-header.php',
                'class' => 'Login_Header',
            ],  
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/poster-banner.php',
                'class' => 'Poster_banner',
            ],  

            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/testimonial-carousel.php',
                'class' => 'Testimonial_Carousel',
            ],  
                 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-cat-carousel.php',
                'class' => 'Product_Cat_Carousel',
            ],     
             [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-carousel.php',
                'class' => 'Product_Carousel',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/item-box.php',
                'class' => 'Item_Box',
            ],
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/item-box2.php',
                'class' => 'Item_Box2',
            ],    
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-widget-list.php',
                'class' => 'Product_Widget_List',
            ],   
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/title.php',
                'class' => 'Title',
            ],   
             [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/image-map.php',
                'class' => 'Image_Map_info',
            ],     
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/logo-slider.php',
                'class' => 'Logo_Slider',
            ],       
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/library-tabs.php',
                'class' => 'library_tabs',
            ],  
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/divider.php',
                'class' => 'eSellDivider',
            ],  
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/icon-box.php',
                'class' => 'Icon_Box',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-grid.php',
                'class' => 'Wooc_Product_Grid',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-media-grid.php',
                'class' => 'Product_Media_Grid',
            ],
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-banner-slider.php',
                'class' => 'Product_Banner_Slider',
            ],
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/countdown.php',
                'class' => 'Wooc_Product_Countdown',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-box.php',
                'class' => 'Product_Box',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/info-box.php',
                'class' => 'Info_Box',
            ], 
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-info-box.php',
                'class' => 'Product_Info_Box',
            ],   
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/product-isotope-filter.php',
                'class' => 'Wooc_Isotope_Filter',
            ],   
           
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/post-grid.php',
                'class' => 'Post_Grid',
            ],  
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/contact-info.php',
                'class' => 'contact_info',
            ],
            [
                'section_title' => 'on',
                'file_path' => 'elementor/widgets/faq.php',
                'class' => 'wooc_faq',
            ],
            
        ];
        foreach ($widget_files as $widget_file) {
            if ( file_exists( ESELL_ELEMENTS_BASE_DIR . $widget_file['file_path'] ) && $widget_file['section_title'] == 'on' ) {                
                require_once ESELL_ELEMENTS_BASE_DIR. $widget_file['file_path'];
                $class_name_with_namespace = "axiltheme\\esell_elements\\" . $widget_file['class'];
                $widgets_manager->register_widget_type( new $class_name_with_namespace() );
            }
        }


    }
}    
new esell_Widgets_Control();