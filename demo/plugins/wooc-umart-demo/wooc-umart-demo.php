<?php
/*
Plugin Name: wooc umart demo
Plugin URI: http://wooctheme.club
Description: Custom Plugin for Metro Demo Site
Version: 1.0
Author: wooctheme
Author URI: http://wooctheme.club
*/


/*-------------------------------------
#. Exclude pages from WordPress Search
---------------------------------------*/
if (!is_admin()) {
	add_filter('pre_get_posts',	function($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	});
}


/*-------------------------------------
#. Blog
---------------------------------------*/
/*add_action( 'template_redirect', function () {
	if ( isset( $_GET['bl-layout'] ) ) {
		WOOCTheme::$options['blog_style'] = $_GET['bl-layout'];
		add_filter( 'excerpt_length', function(){
			if ( $_GET['bl-layout'] == 2 ) {
				return 37;
			}
			if ( $_GET['bl-layout'] == 3 ) {
				return 20;
			}
			return 37;
		}, 999 );
	}
});*/


/*-------------------------------------
#. Shop Page Product Style
---------------------------------------*/
/*add_filter( 'umart_block_args', function( $args ){
	if ( isset( $_GET['layout-pt'] ) ) {
		if ( in_array( $_GET['layout-pt'], range( 1,4 ) ) ) {
			$args['layout'] = $_GET['layout-pt'];
			
		}
	}
	return $args;
} );*/

/*-------------------------------------
#. Shop Page layout
---------------------------------------*/
add_action( 'template_redirect', function () {
	// Sidebar
	$axil_options           = Helper::axil_get_options();
	if ( isset( $_GET['sidebar'] ) ) {
		if ( $_GET['sidebar'] == 'left' ) {
			$axil_options['shop_layout']  = 'left-sidebar';
		}
		if ( $_GET['sidebar'] == 'right' ) {
			$axil_options['shop_layout'] = 'right-sidebar';
		}
		if ( $_GET['sidebar'] == 'full' ) {
			$axil_options['shop_layout'] = 'full-width';
		}
	}

/*	// Pagination
	if ( isset( $_GET['header'] ) ) {
		if ( $_GET['header'] == '4' ) {
			WOOCTheme::$header_style = '4';		
			
		}		
	}

	// shop_header
	if ( isset( $_GET['shop_header'] ) ) {
		if ( $_GET['shop_header'] == 'cat' ) {
			WOOCTheme::$options['Categories_shop_header'] = '1';
		}		
	}

	// Pagination
	if ( isset( $_GET['pagi'] ) ) {
		if ( $_GET['pagi'] == 'infs' ) {
			WOOCTheme::$options['wc_pagination'] = 'infinity-scroll';
		}
		if ( $_GET['pagi'] == 'lomr' ) {
			WOOCTheme::$options['wc_pagination'] = 'load-more';
		}
		if ( $_GET['pagi'] == 'num' ) {
			WOOCTheme::$options['wc_pagination'] = 'numbered';
		}
	}*/

}, 20);

/*add_filter( 'body_class', function( $classes ){
	// List/Grid
	if ( isset( $_GET['sview'] ) ) {
		if ( $_GET['sview'] == 'list' ) {
			$classes = array_diff( $classes, array( 'product-grid-view' ) );
			$classes[] = 'product-list-view';
		}
		if ( $_GET['sview'] == 'grid' ) {
			$classes = array_diff( $classes, array( 'product-list-view' ) );
			$classes[] = 'product-grid-view';
		}
	}
	return $classes;
}, 20 );

add_filter( 'wooctheme_shop_view_type', function( $args ){
	if ( isset( $_GET['sview'] ) ) {
		if ( $_GET['sview'] == 'list' ) {
			return 'list';
		}
		if ( $_GET['sview'] == 'grid' ) {
			return 'grid';
		}
	}
	return $args;
}, 20 );*/

/*-------------------------------------
#. Single Product Style
---------------------------------------*/
/*add_action( 'init', function () {
	if ( isset( $_GET['sp'] ) ) {
		WOOCTheme::$options['product_wc_single_layout'] = $_GET['sp'];
	}

	add_filter( 'woocommerce_short_description', function($text){
		if( is_single( 39 ) && isset($_GET['pthumb']) ) {
			$text = '<p>'.wp_trim_words( $text, 27, '' ).'</p>';
		}
		return $text;
	} );

}, 8);

add_action( 'template_redirect', function(){
	if( is_single( 39 ) && isset($_GET['pthumb']) ) {
		WOOCTheme::$options['wc_social'] = false;
	}
} );*/

/*-------------------------------------
#. Product thumbnail position
---------------------------------------*/
/*add_filter( 'woort_get_option', function(  $value, $option, $section, $default  ){

		if ( !empty($_GET['__option']) && $option === $_GET['__option'] && !empty($_GET['__option_value'])) {
			return $_GET['__option_value'];
		}	

		return $value;

}, 20, 4);*/