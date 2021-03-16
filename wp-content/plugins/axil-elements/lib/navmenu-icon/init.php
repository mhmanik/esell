<?php
/**
 * @author  AxilTheme
 * 
 * The following code is a derivative work of the code from plugin "Menu Image v-2.9.1"(https://wordpress.org/plugins/menu-image/),
 * which is licensed GPLv2. This code therefore is also licensed under the terms
 * of the GNU Public License, verison 2.
 */
namespace axiltheme\esell_elements;

use axiltheme\eSell\Constants;
use axiltheme\eSell\Helper;
use axiltheme\Lib\WP_SVG;


class NavMenu_Icon {

	protected static $instance = null;

	public $version = null;
	
	private function __construct() {
		$this->version = ESELL_ELEMENTS_SCRIPT_VER;

		// Backend
		add_action( 'init',       array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ), 99 );

		// Frontend
		add_filter( 'axiltheme_navmenu_icon_item_title', array( $this, 'menu_image_nav_menu_item_title_filter' ), 10, 7 ); // Output
	}
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function menu_image_nav_menu_item_title_filter( $title, $item, $depth, $args, $icon_display, $text_display, $toggle_display ) {
		$thumb_id = get_post_thumbnail_id( $item->ID );
		if ( !$thumb_id ) {
			return $title;
		}
		$icon 	= $icon_display ? WP_SVG::get_attachment_image( $thumb_id, array( '30', '30' ), true ) : '';		
		$toggle = $toggle_display ? 'data-toggle="tooltip" data-placement="top"' : '';
		$text 	= $text_display ? '<span ' . $toggle . ' title="' . $title . '" class="icon-menu-text">' . $title . '</span>' : '';


		$title = $icon . $text;
		return $title;
	}
	public function init() {
		add_post_type_support( 'nav_menu_item', array( 'thumbnail' ) );

		require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );
		require_once dirname(__FILE__) . '/navmenu-walker.php';
	}

	public function admin_init() {
		require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );
		require_once dirname(__FILE__) . '/navmenu-edit-walker.php';		
		add_filter( 'wp_edit_nav_menu_walker',                array( $this, 'menu_image_edit_nav_menu_walker_filter' ) );
		add_action( 'axiltheme_wp_nav_menu_item_custom_fields', array( $this, 'menu_item_custom_fields' ), 10, 4 );
		add_filter( 'manage_nav-menus_columns',        array( $this, 'menu_image_nav_menu_manage_columns' ), 11 );
		add_action( 'admin_head-nav-menus.php',        array( $this, 'scripts' ) );
		add_action( 'wp_ajax_axiltheme-set-menu-icon',   array( $this, 'ajax_set_menu_icon' ) );
	}
	public function menu_image_edit_nav_menu_walker_filter() {
		return 'axiltheme\esell_elements\Navmenu_Edit_Walker';
	}

	public function menu_item_custom_fields( $item_id, $item, $depth, $args ) {
		if (!$item_id && isset($item->ID)) {
			$item_id = $item->ID;
		}
		?>
		<div class="field-image hide-if-no-js wp-media-buttons">
			<?php echo $this->wp_post_thumbnail_html( $item_id ) ?>
		</div>
		<?php
	}

	public function menu_image_nav_menu_manage_columns( $columns ) {
		return $columns + array( 'image' => __( 'Icon', 'esell-elements' ) );
	}

	public function scripts() {
		wp_enqueue_script( 'axiltheme-admin-navmenu-icon', plugins_url( 'admin-navmenu-icon.js', __FILE__ ), array( 'jquery' ), $this->version );
		wp_localize_script(
			'axiltheme-admin-navmenu-icon', 'axilthemeNavIcon', array(
				'uploaderTitle'      => __( 'Chose menu image', 'esell-elements' ),
				'uploaderButtonText' => __( 'Select', 'esell-elements' ),
				'nonce' => wp_create_nonce( 'axiltheme-update-menu-icon' ),
			)
		);
		wp_enqueue_media();
		wp_enqueue_style( 'editor-buttons' );

		ob_start();
		require_once dirname(__FILE__) . '/style.php';
		$custom_css = ob_get_clean();
		$custom_css  = $this->minified_css( $custom_css );
		wp_add_inline_style( 'editor-buttons', $custom_css );
	}

	private function minified_css( $css ) {
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css ); // Remove comments
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css ); // Remove tabs, spaces, newlines, etc
		return $css;
	}

	public function ajax_set_menu_icon() {
		$json = !empty( $_REQUEST[ 'json' ] );

		$post_ID = intval( $_POST[ 'post_id' ] );
		if ( !current_user_can( 'edit_post', $post_ID ) ) {
			wp_die( - 1 );
		}

		$thumbnail_id = intval( $_POST[ 'thumbnail_id' ] );

		check_ajax_referer( 'axiltheme-update-menu-icon' );

		if ( $thumbnail_id == '-1' ) {
			$success = delete_post_thumbnail( $post_ID );
		} else {
			$success = set_post_thumbnail( $post_ID, $thumbnail_id );
		}

		if ( $success ) {
			$return = $this->wp_post_thumbnail_html( $post_ID );
			$json ? wp_send_json_success( $return ) : wp_die( $return );
		}

		wp_die( 0 );
	}

	private function wp_post_thumbnail_html( $item_id ) {
		$thumbnail_id = get_post_thumbnail_id( $item_id );
		$content      = sprintf(
			'<p class="description description-thin" ><label>%s<br /><a title="%s" href="#" class="set-post-thumbnail button%s" data-item-id="%s" style="height: auto;">%s</a>%s</label></p>',
			esc_html__( 'Icon (jpg/png/svg)', 'esell-elements' ),
			$thumbnail_id ? esc_attr__( 'Change menu item image', 'esell-elements' ) : esc_attr__( 'Set menu item image', 'esell-elements' ),
			'',
			$item_id,
			$thumbnail_id ? wp_get_attachment_image( $thumbnail_id, 'full' ) : esc_html__( 'Upload Image', 'esell-elements' ),
			$thumbnail_id ? '<span class="dashicons dashicons-update axiltheme-menu-icon-spinner"></span><a href="#" class="remove-post-thumbnail">' . esc_html__( 'Remove', 'esell-elements' ) . '</a>' : ''
		);
		return $content;
	}
}

NavMenu_Icon::instance();