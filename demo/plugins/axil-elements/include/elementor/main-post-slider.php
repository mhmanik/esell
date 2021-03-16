<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Post_Slider extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-post-slider';
    }

    public function get_title() {
        return __( 'Main Post Slider', 'blogar' );
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

        $this->axil_query_controls('post_slider_query', 'Main Slider');

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
            'show_data',
            [
                'label' => esc_html__( 'Show Date', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_read_time',
            [
                'label' => esc_html__( 'Show Read Time', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_author_avatar',
            [
                'label' => esc_html__( 'Show Author Avatar', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_author_name',
            [
                'label' => esc_html__( 'Show Author Name', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_social_share',
            [
                'label' => esc_html__( 'Show Social Share', 'blogar' ),
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

        $this->axil_basic_style_controls('post_slider_title', 'Title', '.axil-slide.slider-style-1 .content-block .post-content .title');
        $this->axil_section_style_controls('post_slider_area', 'Area Style', '.slider-area');

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
                            <div class="slider-activation axil-slick-arrow">
                            <?php
                            $temp = 1;
                            while ($post_slider_query->have_posts()) {
                                $post_slider_query->the_post();
                                $active = ( $temp === 1 ) ? 'active' : '';
                                ?>
                                <!-- Start Single Slide  -->
                                <div class="content-block">
                                    <?php if(has_post_thumbnail()){ ?>
                                        <!-- Start Post Thumbnail  -->
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail($settings['post_slider_size_size']); ?>
                                            </a>
                                        </div>
                                        <!-- End Post Thumbnail  -->
                                    <?php } ?>
                                    <!-- Start Post Content  -->
                                    <div class="post-content">
                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                        <!-- Post Meta  -->
                                        <div class="post-meta-wrapper with-button">
                                            <?php \Helper::axil_smallmeta($settings['show_data'], $settings['show_read_time'], $settings['show_author_avatar'], $settings['show_author_name']); ?>
                                            <?php if($settings['show_social_share']){ ?>
                                                <?php if (function_exists('axil_sharing_icon_links')) {
                                                    axil_sharing_icon_links();
                                                } ?>
                                            <?php } ?>
                                            <?php if($settings['show_read_more_button']){ ?>
                                            <div class="read-more-button cerchio">
                                                <a class="axil-button button-rounded hover-flip-item-wrapper" href="<?php the_permalink(); ?>">
                                                    <span class="hover-flip-item">
                                                        <span data-text="<?php echo (!empty($settings['read_more_button_text'])) ? $settings['read_more_button_text'] : "Read Post"; ?>"><?php echo (!empty($settings['read_more_button_text'])) ? $settings['read_more_button_text'] : "Read Post"; ?></span>
                                                    </span>
                                                </a>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <!-- End Post Content  -->
                                </div>
                                <!-- End Single Slide  -->

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

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Post_Slider() );


