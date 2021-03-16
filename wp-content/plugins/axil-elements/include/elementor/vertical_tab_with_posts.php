<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Vertical_Tab_With_Posts extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-Vertical-tab-with-post';
    }

    public function get_title() {
        return __( 'Vertical Tab With Post (For Mega Menu) ', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['blog', 'news', 'post', 'stories', 'blogar', 'mega menu', 'menu'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            '_vertical_tab_with_post_extra',
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
                'default' => 4,
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
                'name' => 'vertical_tab_with_post',
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
        $this->end_controls_section();
        // End meta

        $this->axil_section_style_controls('vertical_tab_with_post_area', 'Area Style', '.vertical-tab-with-post-area');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $vertical_tab_with_post_size = (isset($settings['vertical_tab_with_post_size']) && !empty($settings['vertical_tab_with_post_size'])) ? $settings['vertical_tab_with_post_size'] : "axil-tab-post-thumb";
        ?>
        <!-- Start Banner Area -->
        <div class="vertical-tab-with-post-area">

            <!-- Start vertical Nav  -->
            <div class="axil-vertical-nav">
                <!-- Start Tab Button  -->
                <ul class="vertical-nav-menu">
                    <?php $i = 0; foreach($settings['tabs'] as $tab): $i++; ?>
                        <li class="vertical-nav-item <?php echo esc_attr(($i > 1) ? '' : 'active'); ?>">
                            <a class="hover-flip-item-wrapper" href="#tab-<?php echo esc_attr($this->get_id() . $i); ?>"><span class="hover-flip-item"><span data-text="<?php echo esc_html($tab['tab_title']); ?>"><?php echo esc_html($tab['tab_title']); ?></span></span></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- End Tab Button  -->
            </div>
            <!-- Start vertical Nav  -->

            <!-- Start vertical Menu  -->
            <div class="axil-vertical-nav-content">

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

                <!-- Start Tab Content Wrapper  -->
                <div class="axil-vertical-inner tab-content" id="tab-<?php echo esc_attr($this->get_id() . $j); ?>" <?php echo ($j > 1) ? '' : 'style="display: block;"'; ?>>
                    <?php if ( $tab_post_query->have_posts() ) : ?>
                        <div class="axil-vertical-single">
                            <div class="row">
                                <?php $i = 0; while ($tab_post_query->have_posts()) : $tab_post_query->the_post(); $i++;
                                    $extra0 = ($i <= 9) ? "0" : "";
                                    ?>
                                    <!-- Start Post List  -->
                                    <div class="col-lg-3">
                                        <div class="content-block image-rounded">
                                            <?php if(has_post_thumbnail()){ ?>
                                                <!-- Start Post Thumbnail  -->
                                                <div class="post-thumbnail mb--20">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail($vertical_tab_with_post_size); ?>
                                                    </a>
                                                </div>
                                                <!-- End Post Thumbnail  -->
                                            <?php } ?>
                                            <div class="post-content">
                                                <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Post List  -->
                                <?php endwhile;
                                wp_reset_query(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- End Tab Content Wrapper  -->
                <?php endforeach; ?>

            </div>
            <!-- End vertical Menu  -->

        </div>
        <!-- End Banner Area -->
        <?php

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Vertical_Tab_With_Posts() );


