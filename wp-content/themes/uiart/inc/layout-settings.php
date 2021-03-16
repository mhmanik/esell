<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

class Layouts {

	use Layout_Trait;

	protected static $instance = null;

	public $prefix;
	public $type;
	public $meta_value;

	public function __construct() {
		$this->prefix  = Constants::$theme_prefix;
		
		add_action( 'template_redirect', array( $this, 'layout_settings' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function layout_settings() {
		// Single Pages
		if( ( is_single() || is_page() ) ) {
			$post_type        = get_post_type();
			$post_id          = get_the_id();
			//$this->meta_value = get_post_meta( $post_id, "uiart_layout_settings", true );
			
			switch( $post_type ) {
				case 'page':
				$this->type = 'page';
				break;
				case 'post':
				$this->type = 'single_post';
				break;
				case 'product':
				$this->type = 'product';
				break;
				default:
				$this->type = 'page';
				break;
			}

			WOOCTheme::$layout              = $this->meta_layout_option( 'layout' );	
			WOOCTheme::$sidebar             = $this->meta_layout_option( 'sidebar' );			
			WOOCTheme::$header_style        = $this->meta_layout_global_option( 'header_style' );
			WOOCTheme::$footer_style        = $this->meta_layout_global_option( 'footer_style' );
			WOOCTheme::$has_banner          = $this->meta_layout_global_option( 'banner', true );
			WOOCTheme::$section_spacing     = $this->meta_layout_option( 'section_spacing', true );
			WOOCTheme::$wrapper_full     	= $this->meta_layout_option( 'wrapper_full', true );
			WOOCTheme::$header_transparent  = $this->meta_layout_option( 'header_transparent', true );
			WOOCTheme::$has_breadcrumb      = $this->meta_layout_global_option( 'breadcrumb', true );
			WOOCTheme::$bgtype              = $this->meta_layout_global_option( 'bgtype' );
			WOOCTheme::$bgimg               = $this->bgimg_option( 'bgimg' );
			WOOCTheme::$bgcolor             = $this->meta_layout_global_option( 'bgcolor' );
			
			WOOCTheme::$has_top_bar         	= $this->meta_layout_global_option( 'top_bar', true );
			WOOCTheme::$top_bar_style       	= $this->meta_layout_global_option( 'top_bar_style' );

		}

		// Blog and Archive
		elseif( is_home() || is_archive() || is_search() || is_404() || Helper::is_page( 'is_woocommerce' ) ) {

			if( is_search() ) {
				$this->type = 'search';
			}
			elseif( is_404() ) {
				$this->type = 'error';
				WOOCTheme::$options[$this->type . '_layout'] = 'full-width';
			}
			elseif( Helper::is_page( 'is_woocommerce' ) ) {
				$this->type = 'shop';
			}			
			else {
				$this->type = 'blog';
			}

			WOOCTheme::$layout              = $this->layout_option( 'layout' );
			WOOCTheme::$sidebar             = $this->layout_option( 'sidebar' );			
			WOOCTheme::$header_style        = $this->layout_global_option( 'header_style' );
			WOOCTheme::$footer_style        = $this->layout_global_option( 'footer_style' );
			WOOCTheme::$has_banner          = $this->layout_global_option( 'banner', true );
			WOOCTheme::$section_spacing     = $this->layout_option( 'section_spacing', true );
			WOOCTheme::$wrapper_full        = $this->layout_option( 'wrapper_full', true );
			WOOCTheme::$header_transparent  = $this->layout_option( 'header_transparent', true );
			WOOCTheme::$has_breadcrumb      = $this->layout_global_option( 'breadcrumb', true );
			WOOCTheme::$bgtype              = $this->layout_global_option( 'bgtype' );
			WOOCTheme::$bgimg               = $this->bgimg_option( 'bgimg', false );
			WOOCTheme::$bgcolor             = $this->layout_global_option( 'bgcolor' );

			WOOCTheme::$has_top_bar         = $this->layout_global_option( 'top_bar', true );
			WOOCTheme::$top_bar_style       = $this->layout_global_option( 'top_bar_style' );
		}
	}
}

Layouts::instance();