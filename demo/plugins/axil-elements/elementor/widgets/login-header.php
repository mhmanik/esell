<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Login_Header extends Widget_Base {

 public function get_name() {
        return 'wooc-header-login';
    }    
    public function get_title() {
        return __( 'Login Header', 'esell-elements' );
    }
    public function get_icon() {
        return ' eicon-image-box';
    }
    public function get_categories() {
        return [ ESELL_ELEMENTS_THEME_PREFIX . '-widgets' ];
    }

    protected function _register_controls() {             


        $this->start_controls_section(
            'item_layout',
            [
                'label' => __( 'General', 'esell-elements' ),
            ]
        );
         $this->add_control(
	        'layout',
	        [
	            'label' => __( 'Layout', 'esell-elements' ),
	            'type' => Controls_Manager::SELECT,
	            'default' => '1',
	            'options' => [
	                '1' => __( 'Style 1', 'esell-elements' ),
					'2' => __( 'Style 2', 'esell-elements' ),				                 
	            ],
	        ] 
	    );    
	
		$this->add_control(
		    'image',
		    [
		        'label' => __('Header Logo','esell-elements'),
		        'type'=>Controls_Manager::MEDIA,
		        'default' => [
		            'url' => Utils::get_placeholder_image_src(),
		        ],
		        'dynamic' => [
		            'active' => true,
		        ],	       
		            
		    ]
		);
		$this->add_group_control(
			    Group_Control_Image_Size::get_type(),
			    [
			        'name' => 'image_size',
			        'default'  => 'woocommerce_thumbnail',
			        'separator' => 'none',			         
			    ]
			);

		$this->add_control(
		    'url1',
		    [
		        'label'   => __( 'Left Link', 'esell-elements' ),
		        'type'    => Controls_Manager::URL,
		        'placeholder' => 'https://your-link.com',		       
		    ]
		);   
		$this->add_control(
		    'btntext1',
		    [
		        'label' => __( 'Left Link Text', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Link Text', 'esell-elements' ),
		        'placeholder' => __( 'Lorem Ipsum', 'esell-elements' ),
		    ]
		);


		$this->add_control(
		    'url2',
		    [
		        'label'   => __( 'Right Link', 'esell-elements' ),
		        'type'    => Controls_Manager::URL,
		        'placeholder' => 'https://your-link.com',		       
		    ]
		);   
		$this->add_control(
		    'btntext2',
		    [
		        'label' => __( 'Right Link Text', 'esell-elements' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Link Text', 'esell-elements' ),
		        'placeholder' => __( 'Lorem Ipsum', 'esell-elements' ),
		    ]
		);
	
 		$this->end_controls_section();   

    }

	protected function render() {
		$settings = $this->get_settings();	

		$attr = '';
		if ( !empty( $settings['url1']['url'] ) ) {
			$attr  = 'href="' . $settings['url1']['url'] . '"';
			$attr .= !empty( $settings['url1']['is_external'] ) ? ' target="_blank"' : '';
			$attr .= !empty( $settings['url1']['nofollow'] ) ? ' rel="nofollow"' : '';
		}
		$wrapper_start = '<div class="es-item">';
		$wrapper_end   = '</div>';

			if ( $settings['url1']['url'] ) {
				$wrapper_start = '<a class="es-item" ' . $attr . '>';
				$wrapper_end   = '</a>';
			}
		?>

	<div class="single-header">
		<div class="row">
		  <div class="col-md-4 col-12">
		  	<div class="single-header-left">
		       <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' );?>	
		  	</div>
		  </div>
		   <div class="col-md-8 col-12">
			        <div class="single-header-right">

			        	<?php do_action('esell_topbar_menu'); ?>
			        				           
			        </div>   		     
				</div>
			</div>
		</div>

		   <?php
	}
}