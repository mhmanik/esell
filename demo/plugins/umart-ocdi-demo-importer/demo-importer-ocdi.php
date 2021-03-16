<?php
/**
 * @author  Vecuro
 * @since   1.0
 * @version 1.0
 * @package mixlax-ocdi-demo-importer
 */


if ( ! defined( 'ABSPATH' ) ) exit;
class Mixlax_Ocdi_Demo_Importer {

	public function __construct() {
		add_filter( 'pt-ocdi/import_files',          array( $this, 'demo_config' ) );
		add_filter( 'pt-ocdi/before_widgets_import', array( $this, 'mixlax_update_option_import' ) );		
		add_filter( 'pt-ocdi/after_import',          array( $this, 'after_import' ) );
		add_filter( 'pt-ocdi/disable_pt_branding',   '__return_true' );
		add_action( 'init',                          array( $this, 'mixlax_ocdi_update_term_count' ), 50);
		add_action( 'init',                          array( $this, 'mixlax_rewrite_flush_check' ) );
	}
	function mixlax_ocdi_update_term_count() {
		$list_of_taxonomies = get_taxonomies('', 'names');	
		foreach ( $list_of_taxonomies as $single_taxonomy )  {
			$args = [
				'taxonomy' =>  $single_taxonomy,
				'fields' =>  'ids',
				'hide_empty' => false,
			];
			$terms = get_terms( $args );
			wp_update_term_count($terms, $single_taxonomy);
			
		}
	}
	public function demo_config() {	

		$demos_array = array(
			'demo1' => array(
				'title' 			=> __( 'Home1 ( Multi Page )', 'mixlax-ocdi-demo-importer' ),
				'page'  			=> __( 'Home1', 'mixlax-ocdi-demo-importer' ),				
				'screenshot' 		=> MIXLAXOCDI_PREVIEW . 'home1.jpg',
				'preview_link' 		=> MIXLAXOCDI_PREVIEW_LINK . 'home1',
				
			),
			'demo2' => array(
				'title' 			=> __( 'Home2 ( Multi Page )', 'mixlax-ocdi-demo-importer' ),
				'page'  			=> __( 'Home2', 'mixlax-ocdi-demo-importer' ),
				'screenshot' 		=> MIXLAXOCDI_PREVIEW . 'home2.jpg',
				'preview_link' 		=> MIXLAXOCDI_PREVIEW_LINK . 'home2',
				
			),
			'demo3' => array(
				'title' 			=> __( 'Home3 ( Multi Page )', 'mixlax-ocdi-demo-importer' ),
				'page'  			=> __( 'Home3', 'mixlax-ocdi-demo-importer' ),
				'screenshot' 		=> MIXLAXOCDI_PREVIEW . 'home3.jpg',
				'preview_link' 		=> MIXLAXOCDI_PREVIEW_LINK . 'home3',
				
			),
			
		);
		$config = array();		
		$import_path  =  MIXLAXOCDI_FILE . 'ocdi-demo/sample-data/';		
		$redux_option = 'mixlax_options';
		foreach ( $demos_array as $key => $demo ) {
			$config[] = array(
				'import_file_id'               => $key,				
				'import_page_name'             => $demo['page'],
				'import_file_name'             => $demo['title'],
				'local_import_file'            => $import_path . 'contents.xml',
				'local_import_widget_file'     => $import_path . 'widgets.wie',
				'local_import_customizer_file' => $import_path . 'customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => $import_path . 'options.json',
						'option_name' => $redux_option,
					),
				),
				'import_preview_image_url'   => $demo['screenshot'],
				'preview_url'                => $demo['preview_link'],
				'import_notice' => __('After you import this demo, you will have setup all content.', 'mixlax-ocdi-demo-importer'),
			);
		}
		return $config;		
	}
	public function mixlax_update_option_import( $selected_import ) {
		{
		    // Remove 'Hello World!' post
		    wp_delete_post(1, true);
		    // Remove 'Sample page' page
		    wp_delete_post(2, true);
		    wp_delete_post(3, true);		    
		    $sidebars_widgets = get_option('sidebars_widgets');
		    $sidebars_widgets['sidebar'] = array();
		    update_option('sidebars_widgets', $sidebars_widgets);
		}
	}
	public function after_import( $selected_import ) {
		$this->assign_menu();
		$this->assign_frontpage( $selected_import );
		$this->update_contact_form_sender_email();
		//$this->Update_RevSlider();	
		$this->update_layer_slider();	
		$this->update_elementor_option();	
		$this->update_permalinks();
		update_option( 'mixlax_ocdi_importer_rewrite_flash', true );
	}
	private function assign_menu() {
		$primary  			= get_term_by( 'name', 'main menu', 'nav_menu' );
		$footerbottom  		= get_term_by( 'name', 'Footer Bottom Menu', 'nav_menu' );
		$offcanvas  		= get_term_by( 'name', 'Off Canvas', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'primary'  			=> $primary->term_id,
			'footerbottom'  	=> $footerbottom->term_id,
			'offcanvas'  		=> $offcanvas->term_id,

		));
	}
	private function assign_frontpage( $selected_import ) {
		$blog_page  = get_page_by_title( 'Blog' );
		$front_page = get_page_by_title( $selected_import['import_page_name'] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front',  $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );
	}
	
	private function update_contact_form_sender_email() {
		$form1 = get_page_by_title( 'Contact', OBJECT, 'wpcf7_contact_form' );
		$forms = array( $form1 );
		foreach ( $forms as $form ) {
			if ( !$form ) {
				continue;
			}
			$cf7id = $form->ID;
			$mail  = get_post_meta( $cf7id, '_mail', true );
			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. \WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			update_post_meta( $cf7id, '_mail', $mail );		
		}
	}

	private function update_layer_slider() {		
		if ( class_exists( 'LS_Sources' ) ) {
            $import_path  =  dirname( plugin_basename( __FILE__ )) . '/ocdi-demo/layerslider/';
			\LS_Sources::addDemoSlider( $import_path ); 
		}

	}

	private function Update_RevSlider() {
			if ( class_exists( 'RevSlider' ) ) {	
		        $slider_array = array(	        
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home1.zip",
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home2.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home3.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home4.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home5.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home6.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home7.zip", 
					MIXLAXOCDI_FILE . "ocdi-demo/sample-data/revslider/home8.zip", 
		        );
		        $slider = new RevSlider();
		        foreach($slider_array as $filepath){
		            $slider->importSliderFromPost(true,true,$filepath);  
		        }
		        echo ' Slider processed';
		    } 
		}		
	private function update_permalinks() {
		update_option( 'permalink_structure', '/%postname%/' );
	}	
	private function update_elementor_option() {
	    $cpt_support                                = get_option('elementor_cpt_support');
	    $elementor_disable_color_schemes            = get_option('elementor_disable_color_schemes');
	    $elementor_disable_typography_schemes       = get_option('elementor_disable_typography_schemes');
	    $elementor_container_width                  = get_option('elementor_container_width');
	    $hseparator                                 = get_option('bcn_options[hseparator]');
	   
		 //check if option DOESN'T exist in db

	    if (!$cpt_support) {
	        $cpt_support = ['page', 'post', 'elementor_disable_color_schemes']; //create array of our default supported post types
	        update_option('elementor_cpt_support', $cpt_support); //write it to the database
	    }
	    if (empty($elementor_disable_color_schemes)) {
	        update_option('elementor_disable_color_schemes', 'yes'); //update database
	    }
	    if (empty($elementor_disable_typography_schemes)) {
	        update_option('elementor_disable_typography_schemes', 'yes'); //update database
	    }
	    if (empty($elementor_container_width)) {
	        update_option('elementor_container_width', '1200'); //update database
	    }
	    $elementor_general_settings = array(
	        'container_width' => (!empty($elementor_container_width)) ? $elementor_container_width : '1200',
	    );
	    update_option('_elementor_general_settings', $elementor_general_settings); //update database	  
	    // Update Global Css Options For Elementor
	    $currentTime 			= strtotime("now");
	    $elementor_global_css 	= array(
	        'time' 				=> $currentTime,
	        'fonts' 			=> array()
	    );
	    update_option('_elementor_global_css', $elementor_global_css); //update database
	    update_option('bcn_options[hseparator]', '<span class="dvdr"> / </span>'); //update database  
	    update_option('mixlax_elementor_custom_setting_imported', 'elementor_custom_setting_imported');
	}	

	public function mixlax_rewrite_flush_check() {
		if ( get_option( 'mixlax_ocdi_importer_rewrite_flash' ) == true  ) {
			flush_rewrite_rules();
			delete_option( 'mixlax_ocdi_importer_rewrite_flash' );
		}
	}
}

new Mixlax_Ocdi_Demo_Importer;