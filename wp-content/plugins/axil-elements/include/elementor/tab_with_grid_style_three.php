<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Tab_With_Grid_Style_Three extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-tab-with-grid-style-three';
    }

    public function get_title() {
        return __( 'Tab Grid - Three', 'blogar' );
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

        $this->axil_section_title('tab_with_grid_style_three_post_title', 'Most Popular', 'h2','true', 'text-left');

        $this->start_controls_section(
            'category_list_button_area',
            [
                'label' => esc_html__('Button', 'blogar'),
            ]
        );
        $this->axil_link_controls('tab_with_style_three_section_button', 'See All', 'See All');
        $this->end_controls_section();

        $this->start_controls_section(
            '_tab_with_grid_style_three_extra',
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
                    [   'name' => 'big_image_position',
                        'label' => esc_html__('Big Image', 'blogar'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'left' => esc_html__('Left', 'blogar'),
                            'right' => esc_html__('Right', 'blogar'),
                        ],
                        'default' => 'right',
                    ]
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
        $this->end_controls_section();
        // End meta

        $this->start_controls_section(
            '_post_grid_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
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
                    '{{WRAPPER}} .axil-big-post-image .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
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
                    '{{WRAPPER}} .axil-small-post-image .post-thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('tab_with_grid_style_three_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('tab_with_grid_style_three_area', 'Area Style', '.axil-post-grid-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $tab_with_grid_style_three_button  	= isset($settings['axil_tab_with_style_three_section_button_show']) && $settings['axil_tab_with_style_three_section_button_show'] == 'yes' ? true : false;
        $cal_class = $tab_with_grid_style_three_button == true ? "col-lg-6 col-md-8 col-sm-8 col-12" : "col-lg-12 col-md-12 col-sm-12 col-12";

        ?>
        <!-- Start Banner Area -->
        <div class="axil-post-grid-area axil-section-gap bg-color-white">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="<?php echo esc_attr($cal_class); ?>">
                            <div class="section-title <?php echo esc_attr($settings['axil_tab_with_grid_style_three_post_title_align']); ?>">
                                <?php $this->axil_section_title_render('tab_with_grid_style_three_post_title',  $this->get_settings()); ?>
                            </div>
                        </div>
                        <?php if($tab_with_grid_style_three_button){ ?>
                            <div class="col-lg-6 col-md-4 col-sm-4 col-12">
                                <div class="see-all-topics text-left text-sm-right mt_mobile--20">
                                    <?php
                                    // Link
                                    if ('2' == $settings['axil_tab_with_style_three_section_button_link_type']) {
                                        $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'href', get_permalink($settings['axil_tab_with_style_three_section_button_page_link']));
                                        $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'target', '_self');
                                        $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'rel', 'nofollow');
                                    } else {
                                        if (!empty($settings['axil_tab_with_style_three_section_button_link']['url'])) {
                                            $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'href', $settings['axil_tab_with_style_three_section_button_link']['url']);
                                        }
                                        if ($settings['axil_tab_with_style_three_section_button_link']['is_external']) {
                                            $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'target', '_blank');
                                        }
                                        if (!empty($settings['axil_tab_with_style_three_section_button_link']['nofollow'])) {
                                            $this->add_render_attribute('axil_tab_with_style_three_section_button_link', 'rel', 'nofollow');
                                        }
                                    }
                                    // Button
                                    if (!empty($settings['axil_tab_with_style_three_section_button_link']['url']) || isset($settings['axil_tab_with_style_three_section_button_link_type'])) {

                                        $this->add_render_attribute('axil_tab_with_style_three_section_button_link_style', 'class', ' axil-link-button ');

                                        // Link
                                        $button_html = '<a ' . $this->get_render_attribute_string('axil_tab_with_style_three_section_button_link_style') . ' ' . $this->get_render_attribute_string('axil_tab_with_style_three_section_button_link') . '>'  .  $settings['axil_tab_with_style_three_section_button_text'] . '</a>';
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
                                        <a class="nav-link <?php echo esc_attr(($i > 1) ? '' : 'active'); ?>" data-toggle="tab" href="#tab-<?php echo esc_attr($this->get_id() . $i); ?>" role="tab" aria-selected="<?php echo esc_attr(($i > 1) ? 'false' : 'true'); ?>"><?php echo esc_html($tab['tab_title']); ?></a>
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
                                            <div class="row  mt--40">
                                                <?php $i = 0; while ($tab_post_query->have_posts()) : $tab_post_query->the_post(); $i++; ?>


                                                    <?php
                                                    $big_image_position = $tab['big_image_position'];

                                                    if( $big_image_position == "right" ){ ?>

                                                        <?php if($i == 1){ ?>
                                                            <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                                                        <?php } ?>
                                                        <?php if ($i >= 1 & $i < 5) { ?>
                                                            <!-- Start Post Grid  -->
                                                            <div class="content-block post-medium post-medium-border border-thin">
                                                                <?php if(has_post_thumbnail()){ ?>
                                                                    <!-- Start Post Thumbnail  -->
                                                                    <div class="post-thumbnail">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                                        </a>
                                                                    </div>
                                                                    <!-- End Post Thumbnail  -->
                                                                <?php } ?>
                                                                <div class="post-content">
                                                                    <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($i == 4) { ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if( $i == 5 ){ ?>
                                                            <div class="col-xl-7 col-lg-6 col-md-12 col-12 mt_md--40 mt_sm--40">
                                                                <!-- Start Post Grid  -->
                                                                <div class="content-block content-block post-grid post-grid-transparent">
                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                        <!-- Start Post Thumbnail  -->
                                                                        <div class="post-thumbnail">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_post_thumbnail('axil-tab-big-post-thumb'); ?>
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
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($i > 5) { ?>
                                                            <div class="col-xl-4 col-lg-6 col-md-12 col-12">
                                                                <!-- Start Post Grid  -->
                                                                <div class="content-block post-medium post-medium-border border-thin">
                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                        <!-- Start Post Thumbnail  -->
                                                                        <div class="post-thumbnail">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_post_thumbnail('thumbnail'); ?>
                                                                            </a>
                                                                        </div>
                                                                        <!-- End Post Thumbnail  -->
                                                                    <?php } ?>
                                                                    <div class="post-content">
                                                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                            <?php if ($tab_post_query->post_count == $i) { ?>

                                                            <?php } ?>

                                                    <?php } else { ?>
                                                        <?php if( $i == 1 ){ ?>
                                                            <div class="col-xl-7 col-lg-6 col-md-12 col-12 mt_md--40 mt_sm--40">
                                                                <!-- Start Post Grid  -->
                                                                <div class="content-block content-block post-grid post-grid-transparent">
                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                        <!-- Start Post Thumbnail  -->
                                                                        <div class="post-thumbnail">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_post_thumbnail('axil-tab-big-post-thumb'); ?>
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
                                                            </div>
                                                        <?php } ?>
                                                        <?php if( $i == 2 ){ ?>
                                                            <div class="col-xl-5 col-lg-6 col-md-12 col-12">
                                                        <?php } ?>

                                                        <?php if ($i > 1 & $i < 6) { ?>
                                                            <!-- Start Post Grid  -->
                                                            <div class="content-block post-medium post-medium-border border-thin">
                                                                <?php if(has_post_thumbnail()){ ?>
                                                                    <!-- Start Post Thumbnail  -->
                                                                    <div class="post-thumbnail">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                                        </a>
                                                                    </div>
                                                                    <!-- End Post Thumbnail  -->
                                                                <?php } ?>
                                                                <div class="post-content">
                                                                    <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($i == 5) { ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($i > 5) { ?>
                                                            <div class="col-xl-4 col-lg-6 col-md-12 col-12">
                                                                <!-- Start Post Grid  -->
                                                                <div class="content-block post-medium post-medium-border border-thin">
                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                        <!-- Start Post Thumbnail  -->
                                                                        <div class="post-thumbnail">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_post_thumbnail('thumbnail'); ?>
                                                                            </a>
                                                                        </div>
                                                                        <!-- End Post Thumbnail  -->
                                                                    <?php } ?>
                                                                    <div class="post-content">
                                                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($tab_post_query->post_count == $i) { ?>

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
        </div>
        <!-- End Banner Area -->
        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Tab_With_Grid_Style_Three() );


