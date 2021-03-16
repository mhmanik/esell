<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Empty extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-empty';
    }

    public function get_title() {
        return __( 'Empty', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['blog', 'news', 'post', 'stories', 'blogar'];
    }

    protected function _register_controls() {

        $this->axil_query_controls('post_slider_query', 'Empty');

        $this->start_controls_section(
            '_post_slider_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_slider_size',
                'default' => 'axil-main-slider-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

//        $this->axil_basic_style_controls('post_slider_title', 'Title', '.section-title .title');
//        $this->axil_section_style_controls('post_slider_area', 'Post Section', '.axil-blog-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        /**
         * Setup the post arguments.
         */
        $query_args = Axil_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $post_slider_query = new \WP_Query($query_args);

        ?>
        <?php if ($post_slider_query->have_posts()) { ?>
            <!-- Start Banner Area -->
            <div class="slider-area bg-color-grey slider-activation-with-slick">
                <div class="axil-slide slider-style-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                $temp = 1;
                                while ($post_slider_query->have_posts()) {
                                    $post_slider_query->the_post();
                                    $active = ( $temp === 1 ) ? 'active' : '';
                                    ?>

                                    <!-- the single post goes here -->

                                    <?php  $temp++; } ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Banner Area -->
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Empty() );


