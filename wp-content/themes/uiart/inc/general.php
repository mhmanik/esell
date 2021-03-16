<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

class General_Setup {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme',   array( $this, 'theme_setup' ) );
		add_action( 'widgets_init',        array( $this, 'register_sidebars' ) );
		add_filter( 'body_class',          array( $this, 'body_classes' ) );
		add_filter( 'excerpt_more',        array( $this, 'excerpt_more' ) );
		add_filter( 'excerpt_length',      array( $this, 'excerpt_length' ) );
		add_action( 'wp_head',             array( $this, 'noscript_hide_preloader' ), 1 );
		add_action( 'wp_head',             array( $this, 'wooc_pingback' ) );
		add_action( 'wp_body_open',        array( $this, 'preloader' ) );
		add_action( 'wp_footer',           array( $this, 'scroll_to_top_html' ), 5 );
		add_action( 'wp_footer',           array( $this, 'search_popup' ), 5 );
		add_filter( 'get_search_form',     array( $this, 'search_form' ) );
		add_filter( 'comment_form_fields', array( $this, 'move_textarea_to_bottom' ) );
		add_filter( 'post_class',          array( $this, 'hentry_config' ) );
		add_filter( 'elementor/widgets/wordpress/widget_args', array( $this, 'elementor_widget_args' ) );
		add_filter( 'wpcf7_autop_or_not',  '__return_false' ); // cf7 wptop

		add_filter( 'wp_kses_allowed_html', 	[ $this, 'wooc_kses_allowed_html' ], 10, 2);
		add_action('admin_head',                [ $this, 'wooc_fix_svg_thumb_display' ] );

		/* User extra fields */
		add_action( 'show_user_profile',         array( $this, 'user_fields_form' ) );
		add_action( 'edit_user_profile',         array( $this, 'user_fields_form' ) );
		add_action( 'personal_options_update',   array( $this, 'user_fields_update' ) );
		add_action( 'edit_user_profile_update',  array( $this, 'user_fields_update' ) );
		add_filter('elementor/widgets/wordpress/widget_args', array( $this, 'wooc_elementor_widgets_args_cb' ));
	}

	/*Wordpress widget header h3 tag for Elementor */
	public function wooc_elementor_widgets_args_cb($widget_args) {
		$widget_args['before_title'] = '<h3>';
		$widget_args['after_title'] = '</h3>';
		return $widget_args;
	}
	
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function theme_setup() {
		// Theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_post_type_support( 'post', 'page-attributes' );

		/*Gutenberg Support*/
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );			
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles');

        add_theme_support('editor-color-palette', array(
            array(
                'name'  => esc_html__('Primary Color', 'uiart'),
                'slug'  => 'uiart-primary-color',
                'color' => '#fe7656',
            ),
            array(
                'name'  => esc_html__('Secondary Color', 'uiart'),
                'slug'  => 'uiart-secondary-color',
                'color' => '#0e283f',
            ),

            array(
                'name'  => esc_html__('Accent Color', 'uiart'),
                'slug'  => 'uiart-accent-color',
                'color' => '#e9f1f8',
            ),
            array(
                'name'  => esc_html__('Text Color Dark', 'uiart'),
                'slug'  => 'uiart-text-dark-color',
                'color' => '#111111',
            ),
            array(
                'name'  => esc_html__('Text color light', 'uiart'),
                'slug'  => 'uiart-text-light-color',
                'color' => '#ffffff',
            ),           
        ));
        add_theme_support('editor-font-sizes', array(
            array(
                'name' => esc_html__('Small', 'uiart'),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__('Normal', 'uiart'),
                'size' => 16,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__('Large', 'uiart'),
                'size' => 36,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__('Huge', 'uiart'),
                'size' => 50,
                'slug' => 'huge'
            )
        ));		

		// Image sizes
		$sizes = array(
			'wooctheme-90x120' 		=> array( 90, 120,  true ), 
			'wooctheme-430x560' 	=> array( 430, 560,  true ), 
			'wooctheme-1300x600' 	=> array( 1300, 600, true ), 
			'wooctheme-850x460' 	=> array( 850, 460,  true ), 	
			'wooctheme-400x240' 	=> array( 400, 290,  true ), 	
			
		);
		$this->add_image_sizes( $sizes );
		// Register menus
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary', 'uiart' ),
			'vertical' => esc_html__( 'Vertical', 'uiart' ),
			'account' => esc_html__( 'Account menu', 'uiart' ),
			'offcanvas' => esc_html__( 'Offcanvas', 'uiart' ),
			'footermenu' => esc_html__( 'Footer Fenu', 'uiart' ),
		) );
	}

	private function add_image_sizes( $sizes ) {
		$sizes = apply_filters( 'uiart_image_sizes', $sizes );

		foreach ( $sizes as $size => $value ) {
			add_image_size( $size, $value[0], $value[1], $value[2] );
		}
	}

	public function register_sidebars() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'uiart' ),
			'id'            => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name' 				=> esc_html__( 'Shop', 'uiart' ),
			'id' 				=> 'widgets-shop',
			'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div></div>',
			'before_title' 		=> '<h3 class="wooc-widget-title widget-title">',
			'after_title' 		=> '</h3><div class="wooc-shop-widget-content">'
		));
		
		$footer_widget_titles = array(
			'1' => esc_html__( 'Footer 1', 'uiart' ),
			'2' => esc_html__( 'Footer 2', 'uiart' ),
			'3' => esc_html__( 'Footer 3', 'uiart' ),
			'4' => esc_html__( 'Footer 4', 'uiart' ),
		);

		foreach ( $footer_widget_titles as $id => $name ) {
			register_sidebar( array(
				'name'          => $name,
				'id'            => 'footer-'. $id,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );			
		}
	}

	public function body_classes( $classes ) {
    	// Header
		$classes[] = 'non-stick';
		$classes[] = 'header-style-'. WOOCTheme::$header_style;

		$classes[] = ' has-offcanvas';		
		//$classes[] = ' dark-layout';		

		if( WOOCTheme::$header_transparent == 'on' ){
			$classes[] = ' header-transparent';
		}

		if( WOOCTheme::$wrapper_full == 'on' ){
			$classes[] = ' wrapper-full';
		}
		if( WOOCTheme::$section_spacing == 'off' ){
			$classes[] = ' section_spacing';
		}
        // Sidebar
		if ( WOOCTheme::$layout == 'left-sidebar' ) {
			$classes[] = 'has-sidebar left-sidebar';
		}
		elseif ( WOOCTheme::$layout == 'right-sidebar' ) {
			$classes[] = 'has-sidebar right-sidebar';
		}
		else {
			$classes[] = 'no-sidebar';
		}
		
		// Bgtype
		if ( WOOCTheme::$bgtype == 'bgimg' ) {
			$classes[] = 'header-bgimg';
		}

		// Color
		if ( WOOCTheme::$options['wc_product_layout'] == '1' ) {
			$classes[] = 'wc_product_layout_1';
		}


		return $classes;
	}

	public function noscript_hide_preloader(){
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}

	public function wooc_pingback() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function preloader(){
		// Preloader
		if ( WOOCTheme::$options['preloader'] ){
			if ( !empty( WOOCTheme::$options['preloader_image']['url'] ) ) {
				$preloader_img = WOOCTheme::$options['preloader_image']['url'];
				echo '<div id="preloader" class="page-loader-img" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
			}else {				
			echo '<div id="preloader" class="page-loader">
				  <div class="page-loader-indicator loader-bars">
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			      <div class="loader-bar"></div>
			    </div></div>';
			}
		}
	}

	public function scroll_to_top_html(){
		// Back-to-top link
		if ( WOOCTheme::$options['back_to_top'] ){
			echo '<a href="#" class="scrollToTop"><i class="fa fa-angle-double-up"></i></a>';
		}
	}

	public function search_popup(){
		if ( WOOCTheme::$options['search_icon'] ){
			get_template_part( 'template-parts/header/icon-search-popup' );
		}
	}

	public function search_form(){
		$output =  '
		<form role="search" method="get" class="default-search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<div class="default-search-input">
		<div class="input-group">
		<input type="text" class="default-search-act form-control" placeholder="' . esc_attr__( 'Search here ...', 'uiart' ) . '" value="' . get_search_query() . '" name="s" />
		<span class="input-group-btn">
		<button class="btn-icon" type="submit">
		<i class="fas fa-search"></i>
		</button>
		</span>
		</div>
		</div>
		</form>
		';
		return $output;
	}

	public function move_textarea_to_bottom( $fields ) {
		$temp = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $temp;
		return $fields;
	}

	public function hentry_config( $classes ){
		if ( is_search() || is_page() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
		return $classes;
	}

	public function excerpt_more() {
		return esc_html__( ' ...', 'uiart' );
	}

	public function excerpt_length( $length ) {
		if ( is_home() && (WOOCTheme::$options['blog_style'] == '2' || WOOCTheme::$options['blog_style'] == '3') ){
			return 25;
		}
		return $length;
	}

	public function user_fields_form( $user ) {
		$user_meta   = get_the_author_meta( 'uiart_user_info', $user->ID );
		$designation = isset( $user_meta['designation'] ) ? $user_meta['designation'] : '';
		$socials = Helper::user_socials();
		?>
		<h2><?php esc_html_e( 'Additional Information', 'uiart' ); ?></h2>
		<table class="form-table">
			<tbody>
				<?php
				Helper::user_textfield( esc_html__( 'Designation', 'uiart' ), 'uiart_user_info[designation]', $designation );
				foreach ( $socials as $key => $value ) {
					$social = isset( $user_meta['socials'][$key] ) ? $user_meta['socials'][$key] : '';
					Helper::user_textfield( $value['label'], "uiart_user_info[socials][$key]", $social );
				}
				?>
			</tbody>
		</table>
		<?php
	}

	public function user_fields_update( $user_id=false ) {
		if ( !$user_id ) {
			$user_id = get_current_user_id();
			if ( !$user_id ) return;
		}

		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		if ( !isset( $_POST['uiart_user_info'] ) ) return;

		// Sanitize fields
		$meta = $_POST['uiart_user_info'];
		if ( isset( $meta['designation'] ) ) {
			sanitize_text_field( $meta['designation'] );
		}
		if ( isset( $meta['socials'] ) ) {
			foreach ( $meta['socials'] as $key => $value ) {
				$meta['socials'][$key] = sanitize_text_field( $value );
			}
		}
		
		update_user_meta( $user_id, 'uiart_user_info', $meta );
	}

	public function elementor_widget_args( $args ) {
		$args['before_widget'] = '<div class="wooc-elementor-widget widgets %2$s">';
		$args['after_widget']  = '</div>';
		$args['before_title']  = '<h3 class="woocue-widget-title">';
		$args['after_title']   = '</h3>';
		return $args;
	}

 public function wooc_fix_svg_thumb_display() {
    echo '
    <style>
      td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
        width: 100% !important;
        height: auto !important;
      }
    </style>
    ';
  }
	  /*Allow HTML for the kses post*/
	public function wooc_kses_allowed_html($tags, $context) {
		switch($context) {
			case 'social':
				$tags = array(
					'a' => array('href' => array()),
					'b' => array()
				);
			return $tags;
			case 'allow_link':
				$tags = array(
					'a' => array(
						'class' => array(),
						'href'  => array(),
						'rel'   => array(),
						'title' => array(),
						'target' => array(),
					),
					'b' => array()
				);
			return $tags;
			case 'alltext_allow':
				$tags = array(
					'a' => array(
						'class' => array(),
						'href'  => array(),
						'rel'   => array(),
						'title' => array(),
						'target' => array(),
					),
					'abbr' => array(
						'title' => array(),
					),
					'b' => array(),
					'br' => array(),
					'blockquote' => array(
						'cite'  => array(),
					),
					'cite' => array(
						'title' => array(),
					),
					'code' => array(),
					'del' => array(
						'datetime' => array(),
						'title' => array(),
					),
					'dd' => array(),
					'div' => array(
						'class' => array(),
						'title' => array(),
						'style' => array(),
						'id' 	=> array(),
					),
					'dl' => array(),
					'dt' => array(),
					'em' => array(),
					'h1' => array(),
					'h2' => array(),
					'h3' => array(),
					'h4' => array(),
					'h5' => array(),
					'h6' => array(),
					'i' => array(),
					'img' => array(
						'alt'    => array(),
						'class'  => array(),
						'height' => array(),
						'src'    => array(),
						'srcset' => array(),
						'width'  => array(),
					),
					'li' => array(
						'class' => array(),
					),
					'ol' => array(
						'class' => array(),
					),
					'p' => array(
						'class' => array(),
					),
					'q' => array(
						'cite' => array(),
						'title' => array(),
					),
					'span' => array(
						'class' => array(),
						'title' => array(),
						'style' => array(),
					),
					'strike' => array(),
					'strong' => array(),
					'ul' => array(
						'class' => array(),
					),
				);
				return $tags;
			default:
			return $tags;
		}
	}

}

General_Setup::instance();