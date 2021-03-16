<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Tab_With_List_Style extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-tab-with-list-style';
    }

    public function get_title() {
        return __( 'Tab List Style', 'blogar' );
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

        $this->axil_section_title('tab_with_list_style_post_title', 'Most Popular', 'h2','true', 'text-left');

        $this->start_controls_section(
            '_tab_with_list_style_extra',
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
                    ]
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'blogar'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tab_with_list_style_size',
                'default' => 'axil-tab-post-thumb',
                'exclude' => ['custom'],
                'separator' => 'none',
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
        $this->end_controls_section();
        // End meta



        $this->axil_basic_style_controls('tab_with_list_style_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('tab_with_list_style_area', 'Area Style', '.axil-trending-post-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $tab_with_list_style_size = (isset($settings['tab_with_list_style_size']) && !empty($settings['tab_with_list_style_size'])) ? $settings['tab_with_list_style_size'] : "axil-tab-post-thumb";

        ?>
        <!-- Start Banner Area -->
        <div class="axil-trending-post-area axil-section-gap bg-color-white">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title <?php echo esc_attr($settings['axil_tab_with_list_style_post_title_align']); ?>">
                                <?php $this->axil_section_title_render('tab_with_list_style_post_title',  $this->get_settings()); ?>
                            </div>
                        </div>
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
                            <div class="tab-content" id="axilTabContent-<?php echo esc_attr($this->get_id());?>">

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
                                        <div class="row trend-tab-content tab-pane fade <?php echo esc_attr(($j > 1) ? '' : 'show active'); ?>" id="tab-<?php echo esc_attr($this->get_id() . $j); ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($this->get_id() . $j); ?>">
                                            <div class="col-lg-8">

                                                <?php $i = 0; while ($tab_post_query->have_posts()) : $tab_post_query->the_post(); $i++;
                                                    $extra0 = ($i <= 9) ? "0" : "";
                                                ?>
                                                    <!-- Start Single Post  -->
                                                    <div class="content-block trend-post post-order-list axil-control">
                                                        <div class="post-inner">
                                                            <?php if($settings['show_serial_number']){ ?>
                                                                <span class="post-order-list"><?php echo esc_html($extra0); ?><?php echo esc_html($i) ?></span>
                                                            <?php } ?>
                                                            <div class="post-content">
                                                                <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                                <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
                                                        <?php if(has_post_thumbnail()){ ?>
                                                            <!-- Start Post Thumbnail  -->
                                                            <div class="post-thumbnail">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_post_thumbnail($tab_with_list_style_size); ?>
                                                                </a>
                                                            </div>
                                                            <!-- End Post Thumbnail  -->
                                                        <?php } ?>
                                                    </div>
                                                    <!-- End Single Post  -->
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

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Tab_With_List_Style() );


