<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Featured_Posts extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-featured-posts';
    }

    public function get_title() {
        return __( 'Featured Posts', 'blogar' );
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

        $this->axil_section_title('featured_post_title', 'More Featured Posts.', 'h2','true', 'text-left');

        $this->axil_query_controls('featured_post_query', 'Featured Posts');

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
        $this->end_controls_section();
        // End meta

        $this->start_controls_section(
            '_featured_posts_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'featured_posts_size',
                'default' => 'medium',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('featured_posts_section_title', 'Section Title', '.section-title .title');
        $this->axil_basic_style_controls('featured_posts_title', 'Post Title', '.content-block.post-horizontal .title');
        $this->axil_section_style_controls('featured_posts_box', 'Post Box', '.content-block.content-direction-column');
        $this->axil_section_style_controls('featured_posts_area', 'Area Style', '.axil-featured-post');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        /**
         * Setup the post arguments.
         */
        $query_args = Axil_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $featured_post_query = new \WP_Query($query_args);

        ?>
        <?php if ($featured_post_query->have_posts()) { ?>
            <!-- Start Banner Area -->
            <div class="axil-featured-post axil-section-gap bg-color-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title <?php echo esc_attr($settings['axil_featured_post_title_align']); ?>">
                                <?php $this->axil_section_title_render('featured_post_title',  $this->get_settings()); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $temp = 1;
                        while ($featured_post_query->have_posts()) {
                            $featured_post_query->the_post();
                            $active = ( $temp === 1 ) ? 'active' : '';
                            ?>
                            <!-- Start Single Post  -->
                            <div class="col-lg-6 col-xl-6 col-md-12 col-12 mt--30">
                                <div class="content-block content-direction-column axil-control is-active post-horizontal thumb-border-rounded">
                                    <div class="post-content">
                                        <?php \Helper::axil_post_category_meta($settings['show_category']); ?>
                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <?php \Helper::axil_smallmeta($settings['show_data'], $settings['show_read_time'], $settings['show_author_avatar'], $settings['show_author_name']); ?>
                                    </div>
                                    <?php if(has_post_thumbnail()){ ?>
                                        <!-- Start Post Thumbnail  -->
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail($settings['featured_posts_size_size']); ?>
                                            </a>
                                        </div>
                                        <!-- End Post Thumbnail  -->
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- End Single Post  -->

                            <?php  $temp++; } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <!-- End Banner Area -->
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Featured_Posts() );


