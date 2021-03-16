<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if(!function_exists('axil_core_widgets_init')){
    function axil_core_widgets_init() {

        $number_of_widget 	= 4;
        $axil_widget_titles = array(
            '1' => esc_html__( 'Footer 1', 'blogar' ),
            '2' => esc_html__( 'Footer 2', 'blogar' ),
            '3' => esc_html__( 'Footer 3', 'blogar' ),
            '4' => esc_html__( 'Footer 4', 'blogar' ),
            '5' => esc_html__( 'Footer 5', 'blogar' ),
            '6' => esc_html__( 'Footer 6', 'blogar' ),
        );
        for ( $i = 1; $i <= $number_of_widget; $i++ ) {
            register_sidebar( array(
                'name'          => $axil_widget_titles[$i],
                'id'            => 'footer-'. $i,
                'before_widget' => '<div id="%1$s" class="footer-widget-item widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="title">',
                'after_title'   => '</h6>',
            ) );
        }
    }
}
add_action( 'widgets_init', 'axil_core_widgets_init' );
