<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB Taxonomy directory)
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jcchavezs/cmb2-taxonomy
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

require_once dirname(__FILE__) . '/functions.php';

add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_sample_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_taxonomy_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$woocthemetwprefix = 'wooctheme_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['category_metabox'] = array(
		'id'            => 'category_metabox',
		'title'         => __( 'Category Metabox', 'wooctheme-theme-helper' ),
		'object_types'  => array( 'category', ), // Taxonomy
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'cmb_styles' 	=> true, // false to disable the CMB stylesheet
		'fields'        => array(			
			array(
				'name'    => __( 'Category Color', 'wooctheme-theme-helper' ),
				'desc'    => __( 'This is category background color.)', 'wooctheme-theme-helper' ),
				'id'      => $woocthemetwprefix . 'category_color',
				'type'    => 'colorpicker',
				'default' => '#000000'
			),
			array(
				'name' => __( 'Image', 'wooctheme-theme-helper' ),
				'desc' => __( 'Category image', 'wooctheme-theme-helper' ),
				'id'   => $woocthemetwprefix . 'category_image',
				'type' => 'file',
			),			
		),
	);

	return $meta_boxes;
}

//Category Color column
add_filter( 'manage_edit-category_columns', 'wooctheme_edit_term_columns', 10, 3 );
function wooctheme_edit_term_columns( $columns ) {
    $columns['wooctheme_category_color'] = esc_html__( 'Category Color', 'wooctheme-theme-helper' );
    return $columns;
}
// RENDER COLUMNS
add_filter( 'manage_category_custom_column', 'wooctheme_manage_term_custom_column', 10, 3 );
function wooctheme_manage_term_custom_column( $out, $column, $term_id ) {
    if ( 'wooctheme_category_color' === $column ) {
        $value  = get_term_meta( $term_id , 'wooctheme_category_color', true );
        if ( ! $value )
            $value = '';
        $out = sprintf( '<span class="term-meta-color-block" style="background:%s" ></span>', esc_attr( $value ) );
    }
    return $out;
}
