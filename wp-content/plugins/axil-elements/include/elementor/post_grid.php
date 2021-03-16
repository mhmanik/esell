<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Post_Grid extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-post-grid';
    }

    public function get_title() {
        return __( 'Post Grid - One', 'blogar' );
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

        $this->axil_section_title('post_grid_two_title', 'More Featured Posts.', 'h2','true', 'text-left');

        $this->axil_query_controls('post_grid_two_query', 'Grid Posts', 'post', 'category', '5');

        // Start meta
        $this->start_controls_section(
            '_post_grid_twos_meta',
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
        $this->end_controls_section();
        // End meta

        $this->start_controls_section(
            '_post_grid_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_grid_size',
                'default' => 'axil-grid-small-post-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_control(
            'big-post-image-custom-height',
            [
                'label' => esc_html__('Big Post Image Height', 'blogar'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-block.post-default.axil-big-post-image .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_control(
            'small-post-image-custom-height',
            [
                'label' => esc_html__('Small Post Image Height', 'blogar'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-block.post-default.axil-small-post-image .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_control(
            'dark_bg',
            [
                'label' => esc_html__( 'Dark Background', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('post_grid_section_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('post_grid_area', 'Area Style', '.axil-post-grid-area ');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        /**
         * Setup the post arguments.
         */
        $query_args = Axil_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $post_grid_query = new \WP_Query($query_args);

        ?>
        <?php if ($post_grid_query->have_posts()) { ?>
            <!-- Start Banner Area -->
            <div class="axil-video-post-area axil-section-gap <?php echo esc_attr(($settings['dark_bg'] =='yes') ? 'bg-color-black' : ''); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title <?php echo esc_attr($settings['axil_post_grid_two_title_align']); ?>">
                                <?php $this->axil_section_title_render('post_grid_two_title',  $this->get_settings()); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        $i = 0;
                        while ($post_grid_query->have_posts()) {
                            $post_grid_query->the_post();
                            $i++;
                            ?>

                            <?php if( $i == 1 ){ ?>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-md-6 col-12">

                                <!-- Start Post Grid  -->
                                <div class="content-block post-default image-rounded mt--30 axil-big-post-image">
                                    <?php if(has_post_thumbnail()){ ?>
                                        <!-- Start Post Thumbnail  -->
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('axil-grid-big-post-thumb'); ?>
                                            </a>
                                            <?php
                                            if ( has_post_format('video') ) { ?>
                                                <a class="video-popup position-top-center" href="<?php the_permalink(); ?>"><span class="play-icon"></span></a>
                                            <?php } ?>
                                        </div>
                                        <!-- End Post Thumbnail  -->
                                    <?php } ?>
                                    <div class="post-content">
                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <div class="post-meta-wrapper">
                                            <?php \Helper::axil_smallmeta($settings['show_data'], $settings['show_read_time'], $settings['show_author_avatar'], $settings['show_author_name']); ?>
                                            <?php if($settings['show_social_share']){ ?>
                                                <?php if (function_exists('axil_sharing_icon_links')) {
                                                    axil_sharing_icon_links();
                                                } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Post Grid  -->

                            </div>

                            <?php } ?>

                            <?php if( $i == 2 ){ ?>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-md-6 col-12">
                                <div class="row">
                            <?php } ?>

                            <?php if ($i > 1 & $i < 6) { ?>
                                <!-- Start Post Grid  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="content-block post-default image-rounded mt--30 axil-small-post-image">
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail($settings['post_grid_size_size']); ?>
                                                </a>
                                                <?php
                                                if ( has_post_format('video') ) { ?>
                                                    <a class="video-popup size-medium position-top-center" href="<?php the_permalink(); ?>"><span class="play-icon"></span></a>
                                                <?php } ?>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>
                                        <div class="post-content">
                                            <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                            <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Post Grid  -->
                            <?php } ?>
                            <?php if ($i == 5) { ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if ($i > 5) { ?>
                                <!-- Start Post Grid  -->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="content-block post-default image-rounded mt--30 axil-small-post-image">
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail($settings['post_grid_size_size']); ?>
                                                </a>
                                                <?php
                                                if ( has_post_format('video') ) { ?>
                                                    <a class="video-popup size-medium position-top-center" href="<?php the_permalink(); ?>"><span class="play-icon"></span></a>
                                                <?php } ?>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>
                                        <div class="post-content">
                                            <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                            <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Post Grid  -->

                            <?php } ?>
                            <?php if ($post_grid_query->post_count == $i) { ?>

                            <?php } ?>

                            <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <!-- End Banner Area -->
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Post_Grid() );


