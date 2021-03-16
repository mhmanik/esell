<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Post_list extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-post-list';
    }

    public function get_title() {
        return __( 'Post List', 'blogar' );
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

        $this->axil_section_title('post_list_title', 'More Featured Posts.', 'h2','true', 'text-left');

        $this->axil_query_controls('post_list_query', 'Featured Posts');
        
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
        $this->end_controls_section();

        $this->start_controls_section(
            '_post_lists_extra',
            [
                'label' => esc_html__('Extra Options', 'blogar'),
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
        $this->add_control(
            'custom-height',
            [
                'label' => esc_html__('Height', 'blogar'),
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
                    '{{WRAPPER}} .content-block.post-list-view .post-thumbnail a img, {{WRAPPER}} .content-block.post-list-view .post-thumbnail' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('post_lists_section_title', 'Section Title', '.section-title .title');
        $this->axil_section_style_controls('post_lists_area', 'Area Style', '.axil-post-list-area ');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        /**
         * Setup the post arguments.
         */
        $query_args = Axil_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $post_list_query = new \WP_Query($query_args);

        ?>
        <?php if ($post_list_query->have_posts()) { ?>
            <!-- Start Banner Area -->
            <div class="axil-post-list-area post-listview-visible-color">
                <div class="section-title mb--30 <?php echo esc_attr($settings['axil_post_list_title_align']); ?>">
                    <?php $this->axil_section_title_render('post_list_title',  $this->get_settings()); ?>
                </div>
                <?php
                $temp = 1;
                while ($post_list_query->have_posts()) {
                    $post_list_query->the_post();
                    $active = ( $temp === 1 ) ? 'active' : '';
                    ?>
                    <div class="content-block post-list-view axil-control mt--30">
                        <?php if(has_post_thumbnail()){ ?>
                            <!-- Start Post Thumbnail  -->
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail($settings['post_lists_size_size']); ?>
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

                    <?php  $temp++; } ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <!-- End Banner Area -->
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Post_list() );


