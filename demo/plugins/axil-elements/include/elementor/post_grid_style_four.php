<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Post_Grid_Four extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-post-grid-style-four';
    }

    public function get_title() {
        return __( 'Post Grid - Four', 'blogar' );
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

        $this->axil_section_title('post_grid_four_title', '', 'h2','true', 'text-left');

        $this->axil_query_controls('post_grid_four_query', 'Grid Posts', 'post', 'category', '5');

        // Start meta
        $this->start_controls_section(
            '_post_grid_fours_meta',
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
                'name' => 'grid_post_four_big_post_thumb',
                'default' => 'axil-single-blog-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'grid_post_four_small_post_thumb',
                'default' => 'axil-grid-big-post-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_control(
            'grid-post-style-four-big-post-image-custom-height',
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
                    '{{WRAPPER}} .content-block.post-grid .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_control(
            'grid-post-style-four-small-post-image-custom-height',
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
                    '{{WRAPPER}} .content-block.post-grid.post-grid-small .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('post_grid_four_section_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('post_grid_four_area', 'Area Style', 'slider-area.bg-color-grey.ptb--60');

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
            <div class="slider-area bg-color-grey pt--60 pb--80">
                <div class="axil-slide slider-style-2 plr--135 plr_lg--30 plr_md--30 plr_sm--30">
                    <?php
                    if($settings['axil_post_grid_four_title_title']){ ?>
                        <div class="row mb--10">
                            <div class="col-md-12">
                                <div class="section-title <?php echo esc_attr($settings['axil_post_grid_four_title_align']); ?>">
                                    <?php $this->axil_section_title_render('post_grid_four_title',  $this->get_settings()); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row row--10">
                        <?php
                        $i = 0;
                        while ($post_grid_query->have_posts()) {
                            $post_grid_query->the_post();
                            $i++;
                            ?>

                            <?php if( $i == 1 ){ ?>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-12 mt--20">
                                <!-- Start Post Grid  -->
                                <div class="content-block post-grid post-grid-transparent post-overlay-bottom">
                                    <?php if(has_post_thumbnail()){ ?>
                                        <!-- Start Post Thumbnail  -->
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail($settings['grid_post_four_big_post_thumb_size']); ?>
                                            </a>
                                        </div>
                                        <!-- End Post Thumbnail  -->
                                    <?php } ?>
                                    <div class="post-grid-content">
                                        <div class="post-content">
                                            <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Post Grid  -->
                            </div>
                            <?php } ?>

                            <?php if( $i == 2 ){ ?>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-12 mt_lg--20 mt_md--20 mt_sm--20">
                                <div class="row row--10">
                            <?php } ?>
                            <?php if ($i > 1 & $i < 6) { ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt--20">
                                    <!-- Start Post Grid  -->
                                    <div class="content-block post-grid post-grid-transparent post-grid-small post-overlay-bottom">
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail($settings['grid_post_four_small_post_thumb_size']); ?>
                                                </a>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>
                                        <div class="post-grid-content">
                                            <div class="post-content">
                                                <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Start Post Grid  -->
                                </div>
                            <?php } ?>
                            <?php if ($i == 5) { ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if ($i > 5) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--20">
                                    <!-- Start Post Grid  -->
                                    <div class="content-block post-grid post-grid-transparent post-grid-small post-overlay-bottom">
                                        <?php if(has_post_thumbnail()){ ?>
                                            <!-- Start Post Thumbnail  -->
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail($settings['grid_post_four_small_post_thumb_size']); ?>
                                                </a>
                                            </div>
                                            <!-- End Post Thumbnail  -->
                                        <?php } ?>
                                        <div class="post-grid-content">
                                            <div class="post-content">
                                                <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Start Post Grid  -->
                                </div>
                            <?php } ?>
                            <?php if ($post_grid_query->post_count == $i) { ?>

                            <?php } ?>

                        <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Post_Grid_Four );


