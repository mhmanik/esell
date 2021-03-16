<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Contact extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-contact-form';
    }

    public function get_title() {
        return __( 'Contact', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['contact', 'contact from', 'blogar'];
    }
    public function get_axil_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $axil_cfa         = array();
        $axil_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $axil_forms       = get_posts( $axil_cf_args );
        $axil_cfa         = ['0' => esc_html__( 'Select Form', 'blogar' ) ];
        if( $axil_forms ){
            foreach ( $axil_forms as $axil_form ){
                $axil_cfa[$axil_form->ID] = $axil_form->post_title;
            }
        }else{
            $axil_cfa[ esc_html__( 'No contact form found', 'blogar' ) ] = 0;
        }
        return $axil_cfa;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'blogar_contact_form',
            [
                'label' => esc_html__( 'Contact', 'blogar' ),
            ]
        );

        $this->add_control(
            'select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'blogar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_axil_contact_form(),
            ]
        );
        $this->end_controls_section();

        $this->axil_section_style_controls('area_style', 'Section', '.axil-contact-form-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        ?>
        <div class="axil-contact-form-area">
            <!-- Start Contact Form -->
            <?php if( !empty($settings['select_contact_form']) ){ ?> <div class="axil-contact-form contact-form--1"> <?php
                echo do_shortcode( '[contact-form-7  id="'.$settings['select_contact_form'].'"]' );
                ?> </div> <?php
            } else {
                echo '<div class="alert alert-info"><p>' . __('Please Select contact form.', 'blogar' ). '</p></div>';
            } ?>
        </div>

        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Contact() );


