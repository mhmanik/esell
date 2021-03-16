<?php
/**
 * @author  wooctheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
class Demo_Importer {
	public function __construct() {		
		add_filter( 'wooc_demo_installer_warning_info', array( $this, 'wooc_data_loss_warning' ) );
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'wooc_demo_config' ) );
		add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', array( $this, 'wooc_after_demo_install' ) );
		add_action( 'admin_menu', array( $this, 'wpdocs_register_my_custom_menu_page' ) );
		//add_filter( 'fw:ext:backups:add-restore-task:image-sizes-restore', '__return_false' ); // Enable it to skip image restore step
	}	
	public function wpdocs_register_my_custom_menu_page() {
		add_management_page(esc_html__( 'Demo Contents Install', 'wooc' ), 'Install Demo Data', 'manage_options', 'tools.php?page=fw-backups-demo-content');
	}	

	public function wooc_data_loss_warning( $links ) {
		$html  = '<div class="demo-Warning-info notice notice-error">';
		$html .= esc_html__( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'wooc');
		$html .= '</div>';
		return $html;
	}
	public function wooc_demo_config( $demos ) {
		$demos_array = array(
			'demo1' => array(
				'title' => esc_html__( 'Home 1', 'wooc' ),
				'screenshot' 		=> WOOC_PREVIEW . 'home1.jpg',
				'preview_link' 		=> WOOC_PREVIEW_LINK . 'home1',
			),
			'demo2' => array(
				'title' 			=> esc_html__( 'Home 2', 'wooc' ),
				'screenshot' 		=> WOOC_PREVIEW . 'home2.jpg',
				'preview_link' 		=> WOOC_PREVIEW_LINK . 'home2',
			),	
			'demo3' => array(
				'title' 			=> esc_html__( 'Home 3', 'wooc'),
				'screenshot' 		=> WOOC_PREVIEW . 'home3.jpg',
				'preview_link' 		=> WOOC_PREVIEW_LINK . 'home3',
			),				
		);

		$download_url = WOOC_DEMO_DATA_URL;		
		foreach ($demos_array as $id => $data) {
			$demo = new \FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[ $demo->get_id() ] = $demo;

			unset($demo);
		}

		return $demos;
	}

	public function wooc_after_demo_install( $collection ){
		// Update front page id
		$demos = array(
			'demo1'  => 42,
			'demo2'  => 104,			
			'demo3'  => 142,		
		);
		$data = $collection->to_array();
		foreach( $data['tasks'] as $task ) {
			if( $task['id'] == 'demo:demo-download' ){
				$demo_id = $task['args']['demo_id'];
				$page_id = $demos[$demo_id];
				update_option( 'page_on_front', $page_id );
				flush_rewrite_rules();
				break;
			}
		}
		
		// Update contact form 7 email
		$cf7ids = array( 372, 5 );
		foreach ( $cf7ids as $cf7id ) {
			$mail = get_post_meta( $cf7id, '_mail', true );
			$mail['recipient'] = get_option( 'admin_email' );

			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			
			update_post_meta( $cf7id, '_mail', $mail );		
		}

		// Update WooCommerce email options //todo
       /* $admin_email = get_option( 'admin_email' );
		$name  = get_bloginfo( 'name', 'display' );

		update_option( 'woocommerce_stock_email_recipient', $admin_email );
		update_option( 'woocommerce_email_from_address',    $admin_email );
		update_option( 'woocommerce_email_from_name',       $name );*/

		// Update post author id
		/*global $wpdb;
		$id = get_current_user_id();
		$query = "UPDATE $wpdb->posts SET post_author = $id";
		$wpdb->query($query);*/
				
	}
}

new Demo_Importer;