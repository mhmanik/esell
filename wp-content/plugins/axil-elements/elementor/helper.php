<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

class wooc_Elements_Helper { 
 

    public static function wooc_get_asset_file($file) {
        return ESELL_ELEMENTS_BASE_DIR. $file;
    }
    public static  function wooc_get_css($file)
    {
        $file = ESELL_ELEMENTS_BASE_DIR. 'css/' . $file . '.css';
        return $file;
    }
    public static function wooc_get_font_flaticon_css( $file ){
        $file = ESELL_ELEMENTS_BASE_DIR. 'fonts/' . $file;
        return $file;
    }

	public static function wooc_element_template( $template, $settings ) {
		$template_name = "/esell-widgets/templates/{$template}.php";
		if ( file_exists( STYLESHEETPATH . $template_name ) ) {
			$file = STYLESHEETPATH . $template_name;
		}
		elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		}
		else {
			$file = __DIR__ . "/widgets/templates/{$template}.php";
		}
		ob_start();
		include $file;
		echo ob_get_clean();
	}
}


/*
 * All Post Name
 * return array
 */

function wooc_product_post_name ( $post_type = 'product' ){
    $options = array();
    $options = ['0' => esc_html__( 'None', 'esell-elements' )];
    $wooc_post = array( 'posts_per_page' => -1, 'post_type'=> $post_type );
    $wooc_post_terms = get_posts( $wooc_post );
    if ( ! empty( $wooc_post_terms ) && ! is_wp_error( $wooc_post_terms ) ){
        foreach ( $wooc_post_terms as $term ) {
            $options[ $term->ID ] = $term->post_title;
        }
        
        return $options;
    }
}


/**
 * Get all Pages
 */
if ( !function_exists('wooc_get_all_pages') ) {
    function wooc_get_all_pages() {

        $page_list = get_posts( array(
            'post_type'         => 'page',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => -1,
        ) );

        $pages = array();

        if ( ! empty( $page_list ) && ! is_wp_error( $page_list ) ) {
            foreach ( $page_list as $page ) {
               $pages[ $page->post_name ] = $page->post_title;
            }
        }

        return $pages;
    }
}
