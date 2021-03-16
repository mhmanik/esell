<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Creative_Slider extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-creative-slider';
    }

    public function get_title() {
        return __( 'Creative Slider', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['blog', 'news', 'post', 'stories', 'blogar', 'slider', 'post slider'];
    }

    protected function _register_controls() {

        $this->axil_query_controls('creative_slider_query', 'Creative Slider');

        // Start meta
        $this->start_controls_section(
            '_post_lists_meta',
            [
                'label' => esc_html__('Post Meta', 'blogar'),
            ]
        );
        $this->add_control(
            'show_category',
            [
                'label' => esc_html__( 'Show Category', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_serial_number',
            [
                'label' => esc_html__( 'Show Serial number', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_read_more_button',
            [
                'label' => esc_html__( 'Show Read More Button', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'read_more_button_text',
            [
                'label' => esc_html__( 'Read More Button Text', 'blogar' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read Post', 'blogar' ),
                'placeholder' => esc_html__( 'Type your text here', 'blogar' ),
            ]
        );
        $this->end_controls_section();
        // End meta

        $this->start_controls_section(
            '_creative_slider_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'creative_slider_size',
                'default' => 'axil-main-slider-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('creative_slider_title', 'Title', '.axil-slide.slider-style-1 .content-block .post-content .title');
        $this->axil_section_style_controls('creative_slider_area', 'Area Style', '.slider-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $creative_slider_size = (isset($settings['creative_slider_size']) && !empty($settings['creative_slider_size'])) ? $settings['creative_slider_size'] : "axil-tab-post-thumb";
        /**
         * Setup the post arguments.
         */
        $query_args = Axil_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $creative_slider_query = new \WP_Query($query_args);

        ?>
        <?php if ($creative_slider_query->have_posts()) { ?>
            <div class="slider-area creative-slider-area bg-color-grey">
                <div class="axil-slide slider-style-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1">
                                <div class="slider-inner slick-nav-avtivation-new">

                                    <?php
                                    $temp = 1;
                                    $i = 0;
                                    while ($creative_slider_query->have_posts()) {
                                    $creative_slider_query->the_post();
                                    $i++;
                                    $extra0 = ($i <= 9) ? "0" : "";
                                    $active = ( $temp === 1 ) ? 'active' : '';
                                    ?>

                                    <!-- Start Single Blog  -->
                                    <div class="content-block post-medium post-medium-border">

                                        <?php if($settings['show_serial_number']){ ?>
                                            <div class="post-number">
                                                <span><?php echo esc_html($extra0); ?><?php echo esc_html($i) ?></span>
                                            </div>
                                        <?php } ?>
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail(array(100, 100)); ?>
                                                </a>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>
                                        <div class="post-content">
                                            <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                            <?php if($settings['show_read_more_button']){ ?>
                                                <div class="post-button">
                                                    <a class="axil-button button-rounded color-secondary-alt" href="<?php the_permalink(); ?>"><?php echo (!empty($settings['read_more_button_text'])) ? $settings['read_more_button_text'] : "Read Post"; ?></a>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <!-- End Single Blog  -->

                                    <?php  $temp++; } ?>
                                    <?php wp_reset_postdata(); ?>

                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2">
                                <div class="thumbnail-wrapper slick-for-avtivation-new">

                                    <?php
                                    $temp = 1;
                                    while ($creative_slider_query->have_posts()) {
                                        $creative_slider_query->the_post();
                                        $active = ( $temp === 1 ) ? 'active' : '';
                                        ?>
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail(array(922, 870)); ?>
                                                </a>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>

                                        <?php  $temp++; } ?>
                                    <?php wp_reset_postdata(); ?>

                                </div>
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

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Creative_Slider() );


