<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if(!function_exists('axil_widgets_init')){
    function axil_widgets_init() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'esell'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'esell'),
            'before_widget' => '<div class="%1$s axil-single-widget %2$s mt--60">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        ));
        register_sidebar( array(
            'name'              => esc_html__( 'Shop Header', 'esell' ),
            'id'                => 'widgets-shop-header',
            'before_widget'     => '<div id="%1$s" class="widget %2$s">',
            'after_widget'      => '</div></div>',
            'before_title'      => '<h3 class="axil-widget-title widget-title">',
            'after_title'       => '</h3><div class="axil-shop-widget-content">'
        ));
        register_sidebar( array(
            'name'              => esc_html__( 'Shop', 'esell' ),
            'id'                => 'widgets-shop',
            'before_widget'     => '<div id="%1$s" class="widget %2$s">',
            'after_widget'      => '</div></div>',
            'before_title'      => '<h3 class="axil-widget-title widget-title"><span>',
            'after_title'       => '</span><i class="minimize fas fa-plus"></i></h3><div class="axil-shop-widget-content">'
        ));
        $number_of_widget 	= 6;
        $axil_widget_titles = array(
            '1' => esc_html__( 'Footer 1', 'esell' ),
            '2' => esc_html__( 'Footer 2', 'esell' ),
            '3' => esc_html__( 'Footer 3', 'esell' ),
            '4' => esc_html__( 'Footer 4', 'esell' ),
            '5' => esc_html__( 'Footer 5', 'esell' ),
            '6' => esc_html__( 'Footer 6', 'esell' ),
        );
        for ( $i = 1; $i <= $number_of_widget; $i++ ) {
            register_sidebar( array(
                'name'          => $axil_widget_titles[$i],
                'id'            => 'footer-'. $i,
                'before_widget' => '<div id="%1$s" class="axil-footer-widget widget %2$s"><div class="inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h5 class="widget-title">',
                'after_title'   => '</h5>',
            ) );
        }
    }
}
add_action( 'widgets_init', 'axil_widgets_init' );