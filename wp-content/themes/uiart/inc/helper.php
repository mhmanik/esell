<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

use wooctheme\Lib\WP_SVG;

class Helper {

	use Socials_Trait;
	use Asset_Loader_Trait;



	public static function has_sidebar() {
		$has_sidebar_widgets = false;
		if ( WOOCTheme::$sidebar ) {
			if ( is_active_sidebar( WOOCTheme::$sidebar ) ){
				$has_sidebar_widgets = true;
			}
		}
		else {
			if ( is_active_sidebar( 'sidebar' ) ){
				$has_sidebar_widgets = true;
			}
		}

		if ( $has_sidebar_widgets && WOOCTheme::$layout != 'full-width' ) {
			return true;
		}
		else {
			return false;
		}
	}

	public static function the_layout_class() {
		$layout_class = self::has_sidebar() ? 'col-xl-9 col-lg-8 col-12' : 'col-12';
		echo apply_filters( 'uiart_layout_class', $layout_class );
	}

	public static function the_sidebar_class() {
		echo apply_filters( 'uiart_sidebar_class', 'wooc-default-sidebar col-xl-3 col-lg-4 col-12' );
	}


	public static function wooc_the_layout_class() {
		$layout_class = self::has_sidebar() ? 'col-xl-9 col-lg-8 col-12' : 'col-12';
		echo apply_filters( 'uiart_layout_class', $layout_class );
	}

	public static function wooc_the_sidebar_class() {
		echo apply_filters( 'uiart_sidebar_class', 'wooc-shop-sidebar col-xl-3 col-lg-4 col-12' );
	}

	public static function left_sidebar() {
		if ( self::has_sidebar() ) {
			if ( WOOCTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}			
		}
	}

	public static function right_sidebar() {
		if ( self::has_sidebar() ) {
			if ( WOOCTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
		}
	}

	public static function shop_grid_page_url() {
		global $wp;
		$current_url = add_query_arg( 'shopview', 'grid', home_url( $wp->request ) );
		return $current_url;
	}

	public static function shop_list_page_url() {
		global $wp;
		$current_url = add_query_arg( 'shopview', 'list', home_url( $wp->request ) );
		return $current_url;
	}

	public static function the_breadcrumb() {
		if ( function_exists( 'bcn_display') ) {
			bcn_display();
		}
		else {
			Helper::requires( 'breadcrumbs.php' );
			$args = array(
				'show_browse'   => false,
				'post_taxonomy' => array( 'product' =>'product_cat' )
			);
			$breadcrumb = new WOOCTheme_Breadcrumb( $args );
			return $breadcrumb->trail();
		}
	}
	
	public static function filter_content( $content ){
		// wp filters
		$content = wptexturize( $content );
		$content = convert_smilies( $content );
		$content = convert_chars( $content );
		$content = wpautop( $content );
		$content = shortcode_unautop( $content );

		// remove shortcodes
		$pattern= '/\[(.+?)\]/';
		$content = preg_replace( $pattern,'',$content );

		// remove tags
		$content = strip_tags( $content );

		return $content;
	}

	public static function get_current_post_content( $post = false ) {
		if ( !$post ) {
			$post = get_post();				
		}
		$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
		$content = self::filter_content( $content );
		return $content;
	}

	public static function comments_callback( $comment, $args, $depth ){
		$args2 = get_defined_vars();
		Helper::get_template_part( 'template-parts/comments-callback', $args2 );
	}

	public static function nav_menu_args(){	
		$pagemenu = false;
		if ( ( is_single() || is_page() ) ) {
			$menuid = get_post_meta( get_the_id(), "page_menu", true );
			if ( !empty( $menuid ) && $menuid != 'default' ) {
				$pagemenu = $menuid;
			}
		}
		if ( $pagemenu ) {
			$nav_menu_args = array( 'menu' => $pagemenu,'container' => 'nav' );
		}
		else {
				$nav_menu_args = array( 'theme_location' => 'primary','container' => 'nav' );
		}
		return $nav_menu_args;
	}	


	public static function wooc_nav_menu_args(){
		$nav_menu_args = array( 'theme_location' => 'primary', 'menu' => true, 'container' => 'nav', 'fallback_cb' => false );
		
		return $nav_menu_args;
	}	
	public static function nav_menu_offcanvas_args(){
		$nav_menu_args = array( 
			'theme_location' => 'offcanvas',
			'container' => 'offcanvas-nav',
			'menu_class'           => 'menu menu-list',
			 'fallback_cb' => false
		 );		
		return $nav_menu_args;
	}	
	public static function nav_menu_footermenu_args(){
		$nav_menu_args = array( 'theme_location' => 'footermenu','container' => 'footermenu-nav', 'fallback_cb' => false );
		
		return $nav_menu_args;
	}

	public static function user_textfield( $label, $field, $value ){
		?>
		<tr>
			<th>
				<label><?php echo esc_html( $label ); ?></label>
			</th>
			<td>
				<input class="regular-text" type="text" value="<?php echo esc_attr( $value );?>" name="<?php echo esc_attr( $field );?>">
			</td>
		</tr>
		<?php
	}

	public static function is_page( $arg ) {
		if ( function_exists( $arg ) && call_user_func( $arg ) ) {
			return true;
		}
		return false;
	}


	public static function get_primary_color() {
		$primary_color = WOOCTheme::$options['primary_color'];	
		return apply_filters( 'wooctheme_primary_color', $primary_color );
	}

	public static function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = "$r, $g, $b";
		return $rgb;
	}

	public static function uniqueid() {
		$time = microtime();
		$time = str_replace( array( ' ','.' ), '-' , $time );
		$id = 'u-'. $time;
		return $id;
	}

    /**
     * Custom Sidebar
     */
    public static function custom_sidebar_fields()
    {
        
        $sidebar_fields = array();
        $sidebar_fields['sidebar'] = esc_html__('Sidebar', 'uiart');
		$sidebar_fields['widgets-shop'] = esc_html__( 'Widgets Shop', 'uiart' );
        $sidebars = get_option("sbg_sidebars", array());        
        if ($sidebars) {
            foreach ($sidebars as $sidebar) {
                $sidebar_fields[$sidebar] = $sidebar;
            }
        }
        return $sidebar_fields;
    }

	public static function get_custom_sidebar_fields() {
		$prefix = Constants::$theme_prefix;
		$sidebar_fields = array();

		$sidebar_fields['sidebar'] = esc_html__( 'Sidebar', 'uiart' );
		$sidebar_fields['widgets-shop'] = esc_html__( 'Widgets Shop', 'uiart' );

		$sidebars = get_option( "{$prefix}_custom_sidebars", array() );
		if ( $sidebars ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebar_fields[$sidebar['id']] = $sidebar['name'];
			}
		}

		return $sidebar_fields;
	}

	public static function get_attachment_image( $attachment_id, $size = 'thumbnail', $icon = false, $attr = '' ) {
		if ( !defined( 'UIART_ELEMENTS' ) ) {
			return wp_get_attachment_image( $attachment_id, $size, $icon, $attr );
		}
		else {
			$img = WP_SVG::get_attachment_image( $attachment_id, $size, $icon, $attr );
		}
		return $img;
	}
}