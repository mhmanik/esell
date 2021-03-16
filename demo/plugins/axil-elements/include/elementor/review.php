<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Review_Posts extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-review-posts';
    }

    public function get_title() {
        return __( 'Review Posts', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['review', 'blog', 'post', 'stories', 'blogar'];
    }

    protected function _register_controls() {

        global $wp_registered_sidebars;

        $options = [];

        if ( ! $wp_registered_sidebars ) {
            $options[''] = __( 'No sidebars were found', 'elementor' );
        } else {
            $options[''] = __( 'Choose Sidebar', 'elementor' );

            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $options[ $sidebar_id ] = $sidebar['name'];
            }
        }

        $default_key = array_keys( $options );
        $default_key = array_shift( $default_key );


        $this->axil_section_title('review_post_section_title', 'Most Popular', 'h2','true', 'text-left');

        $this->start_controls_section(
            'review_posts_button_area',
            [
                'label' => esc_html__('Button', 'blogar'),
            ]
        );
        $this->axil_link_controls('review_posts_section_button', 'See All', 'See All');
        $this->end_controls_section();

        $this->start_controls_section(
            '_review_posts_extra',
            [
                'label' => esc_html__('Tabs Options', 'blogar'),
            ]
        );
        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Tabs', 'blogar'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'tab_title' => esc_html__('Add Label', 'blogar'),
                        'post_cats' => 1,
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
                'fields' => [
                    [   'name' => 'post_cats',
                        'label' => esc_html__('Select Categories', 'blogar'),
                        'type' => Controls_Manager::SELECT2,
                        'multiple' => true,
                        'options' => axil_get_categories('category'),
                        'label_block' => true
                    ],
                    [   'name' => 'tab_title',
                        'label'         => esc_html__( 'Tab title', 'blogar' ),
                        'type'          => Controls_Manager::TEXT,
                        'default'       => 'Add Label',
                    ],
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'blogar'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'blogar'),
                'type' => Controls_Manager::SELECT,
                'options' => axil_get_orderby_options(),
                'default' => 'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'blogar'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__('Ascending', 'blogar'),
                    'desc' => esc_html__('Descending', 'blogar'),
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore sticky posts', 'blogar' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

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
            'show_review_badge',
            [
                'label' => esc_html__( 'Show Review Badge', 'blogar' ),
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
                'name' => 'review_post_big_image',
                'default' => 'axil-grid-big-post-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_lists_size',
                'default' => 'medium',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .featured-post .content-block .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .content-block.post-list-view .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'review_posts_sidebar_area',
            [
                'label' => esc_html__('Sidebar Area', 'blogar'),
            ]
        );
        $this->add_control(
            'show_review_posts_sidebar',
            [
                'label' => esc_html__( 'Show Sidebar', 'blogar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'blogar' ),
                'label_off' => esc_html__( 'No', 'blogar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
                'review_sidebar',
            [
                'label' => __( 'Choose Sidebar', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => $default_key,
                'options' => $options,
                'condition' => [
                    'show_review_posts_sidebar' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->axil_basic_style_controls('review_posts_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('review_posts_area', 'Area Style', '.axil-review-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $review_posts_button  = isset($settings['axil_review_posts_section_button_show']) && $settings['axil_review_posts_section_button_show'] == 'yes' ? true : false;
        $cal_class = $review_posts_button == true ? "col-lg-6 col-md-8 col-sm-8 col-12" : "col-lg-12 col-md-12 col-sm-12 col-12";

        $show_review_posts_sidebar = isset($settings['show_review_posts_sidebar']) && $settings['show_review_posts_sidebar'] == 'yes' ? true : false;
        $list_post_class = $show_review_posts_sidebar == true ? "col-lg-8 col-xl-8 mt--30" : "col-lg-12 col-xl-12 mt--30";


        ?>
        <!-- Start Banner Area -->
        <div class="axil-review-area post-listview-visible-color axil-section-gap bg-color-grey">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($cal_class); ?>">
                        <div class="section-title <?php echo esc_attr($settings['axil_review_post_section_title_align']); ?>">
                            <?php $this->axil_section_title_render('review_post_section_title',  $this->get_settings()); ?>
                        </div>
                    </div>
                    <?php if($review_posts_button){ ?>
                        <div class="col-lg-6 col-md-4 col-sm-4 col-12">
                            <div class="see-all-topics text-left text-sm-right mt_mobile--20">
                                <?php
                                // Link
                                if ('2' == $settings['axil_review_posts_section_button_link_type']) {
                                    $this->add_render_attribute('axil_review_posts_section_button_link', 'href', get_permalink($settings['axil_review_posts_section_button_page_link']));
                                    $this->add_render_attribute('axil_review_posts_section_button_link', 'target', '_self');
                                    $this->add_render_attribute('axil_review_posts_section_button_link', 'rel', 'nofollow');
                                } else {
                                    if (!empty($settings['axil_review_posts_section_button_link']['url'])) {
                                        $this->add_render_attribute('axil_review_posts_section_button_link', 'href', $settings['axil_review_posts_section_button_link']['url']);
                                    }
                                    if ($settings['axil_review_posts_section_button_link']['is_external']) {
                                        $this->add_render_attribute('axil_review_posts_section_button_link', 'target', '_blank');
                                    }
                                    if (!empty($settings['axil_review_posts_section_button_link']['nofollow'])) {
                                        $this->add_render_attribute('axil_review_posts_section_button_link', 'rel', 'nofollow');
                                    }
                                }
                                // Button
                                if (!empty($settings['axil_review_posts_section_button_link']['url']) || isset($settings['axil_review_posts_section_button_link_type'])) {

                                    $this->add_render_attribute('axil_review_posts_section_button_link_style', 'class', ' axil-link-button ');

                                    // Link
                                    $button_html = '<a ' . $this->get_render_attribute_string('axil_review_posts_section_button_link_style') . ' ' . $this->get_render_attribute_string('axil_review_posts_section_button_link') . '>'  .  $settings['axil_review_posts_section_button_text'] . '</a>';
                                    echo $button_html;
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start Tab Button  -->
                        <ul class="axil-tab-button nav nav-tabs mt--20" id="axilTab-<?php echo esc_attr($this->get_id());?>" role="tablist">
                            <?php $i = 0; foreach($settings['tabs'] as $tab): $i++; ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?php echo esc_attr(($i > 1) ? '' : 'active'); ?>" id="tab-<?php echo esc_attr($this->get_id());?>" data-toggle="tab" href="#tab-<?php echo esc_attr($this->get_id() . $i); ?>" role="tab" aria-selected="<?php echo esc_attr(($i > 1) ? 'false' : 'true'); ?>"><?php echo esc_html($tab['tab_title']); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- End Tab Button  -->

                        <!-- Start Tab Content Wrapper  -->
                        <div class="grid-tab-content tab-content mt--10" id="axilTabContent-<?php echo esc_attr($this->get_id());?>">

                            <?php
                            $j = 0; foreach($settings['tabs'] as $tab): $j++;

                                $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
                                $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'date';
                                $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';

                                $category_list = '';
                                if (!empty($tab['post_cats'])) {
                                    $category_list = implode(", ", $tab['post_cats']);
                                }
                                $category_list_value = explode(" ", $category_list);

                                $arg = [
                                    'post_type'   => 'post',
                                    'post_status' => 'publish',
                                    'posts_per_page' => $posts_per_page,
                                    'orderby' => $orderby,
                                    'order' => $order,
                                ];

                                // ignore_sticky_posts
                                $sticky = get_option( 'sticky_posts' );

                                if (!empty($settings['ignore_sticky_posts']) && $settings['ignore_sticky_posts'] == 'yes') {
                                    $arg['ignore_sticky_posts'] = 1;
                                    $arg['post__not_in'] = $sticky;
                                }
                                if (!empty($tab['post_cats'])) {
                                    $arg['tax_query'][] = [
                                        'taxonomy' => 'category',
                                        'field' => 'slug',
                                        'terms' => $category_list_value,
                                    ];
                                }

                                $tab_post_query = new \WP_Query( $arg );

                                ?>
                                <?php if ( $tab_post_query->have_posts() ) : ?>
                                    <div class="trend-tab-content tab-pane fade <?php echo esc_attr(($j > 1) ? '' : 'show active'); ?>" id="tab-<?php echo esc_attr($this->get_id() . $j); ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($this->get_id() . $j); ?>">
                                        <div class="row ">
                                            <?php $i = 0; while ($tab_post_query->have_posts()) : $tab_post_query->the_post(); $i++; ?>

                                                <?php if($i == 1){ ?>
                                                <!-- Start Featured Post  -->
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                <?php } ?>

                                                <?php if ($i >= 1 & $i < 3) { ?>
                                                        <div class="col-lg-6">
                                                            <div class="featured-post mt--30">
                                                                <div class="content-block">
                                                                    <div class="post-content">
                                                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                    </div>
                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                        <!-- Start Post Thumbnail  -->
                                                                        <div class="post-thumbnail">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_post_thumbnail($settings['review_post_big_image_size']); ?>
                                                                                <?php if(!empty(axil_get_acf_data('axil_post_review_score')) && $settings['show_review_badge'] ){ ?>
                                                                                    <div class="review-count">
                                                                                        <span><?php echo axil_get_acf_data('axil_post_review_score') ?></span>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </a>
                                                                        </div>
                                                                        <!-- End Post Thumbnail  -->
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } ?>

                                                <?php if ($i == 2) { ?>
                                                    </div>
                                                </div>
                                                <!-- End Featured Post  -->
                                                <?php } ?>

                                                <?php if( $i == 3 ){ ?>
                                                <div class="<?php echo esc_attr($list_post_class); ?>">
                                                <?php } ?>
                                                    <?php if ($i >= 3) { ?>
                                                    <!-- Start Post List  -->
                                                    <div class="content-block post-list-view with-bg-solid mt--30">
                                                        <?php if(has_post_thumbnail()){ ?>
                                                            <!-- Start Post Thumbnail  -->
                                                            <div class="post-thumbnail">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_post_thumbnail($settings['post_lists_size_size']); ?>
                                                                    <?php if(!empty(axil_get_acf_data('axil_post_review_score')) && $settings['show_review_badge'] ){ ?>
                                                                        <div class="review-count">
                                                                            <span><?php echo axil_get_acf_data('axil_post_review_score'); ?></span>
                                                                        </div>
                                                                    <?php } ?>
                                                                </a>
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
                                                    <!-- End Post List  -->
                                                <?php } ?>
                                                <?php if ($tab_post_query->post_count == $i) { ?>
                                                    </div>
                                                <?php } ?>

                                                <?php if($show_review_posts_sidebar){?>
                                                    <?php if($tab_post_query->post_count <= $i){ ?>
                                                        <!-- Start Sidebar  -->
                                                        <div class="col-lg-4 col-xl-4 mt--30 mt_md--40 mt_sm--40">
                                                            <div class="sidebar-inner">
                                                                <?php
                                                                $sidebar = $this->get_settings_for_display( 'review_sidebar' );

                                                                if ( empty( $sidebar ) ) {
                                                                    return;
                                                                }

                                                                dynamic_sidebar( $sidebar );
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <!-- End Sidebar  -->
                                                    <?php } ?>
                                                <?php } ?>


                                            <?php endwhile;
                                            wp_reset_query(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- End Tab Content Wrapper  -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Review_Posts() );


