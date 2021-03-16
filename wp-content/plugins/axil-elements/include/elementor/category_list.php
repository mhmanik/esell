<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Category_List extends Widget_Base {

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name() {
        return 'blogar-category-list';
    }

    public function get_title() {
        return __( 'Category List', 'blogar' );
    }

    public function get_icon() {
        return 'axil-icon';
    }

    public function get_categories() {
        return [ 'blogar' ];
    }

    public function get_keywords()
    {
        return ['category', 'cat', 'blogar'];
    }

    protected function _register_controls() {

        $this->axil_section_title('category_list_title', 'Trending Topics', 'h2','true', 'text-left');
        $this->start_controls_section(
            'category_list_button_area',
            [
                'label' => esc_html__('Button', 'blogar'),
            ]
        );
        $this->axil_link_controls('category_list_section_button', 'See All Topics', 'See All Topics');
        $this->end_controls_section();

        $this->start_controls_section(
            '_category_options',
            [
                'label' => esc_html__('Category Options', 'blogar'),
            ]
        );
        $this->add_control(
            'category_lists',
            [
                'label' => esc_html__('Select Categories', 'blogar'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => axil_get_categories('category'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'show_count',
            [
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'show_count',
                'label'       => esc_html__( 'Show count ', 'blogar' ),
                'label_on'    => esc_html__( 'Show', 'blogar' ),
                'label_off'   => esc_html__( 'Hide', 'blogar' ),
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'hide_empty_category',
            [
                'type'        => Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Hide empty category ', 'blogar' ),
                'label_on'    => esc_html__( 'Show', 'blogar' ),
                'label_off'   => esc_html__( 'Hide', 'blogar' ),
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'orderby',
            [
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'orderby',
                'label'   => esc_html__( 'Post Ordering', 'blogar' ),
                'options' => array(
                    'id'        =>  esc_html__( 'ID', 'blogar' ),
                    'Count'     =>  esc_html__( 'Count', 'blogar'),
                    'Name'      =>  esc_html__( 'Name', 'blogar' ),
                    'Slug'      =>  esc_html__( 'Slug', 'blogar' ),
                ),
                'default' => 'Name',
            ]
        );
        $this->add_control(
            'order',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Ordering', 'blogar' ),
                'options' => array(
                    'ASC'        =>  esc_html__( 'ASC', 'blogar' ),
                    'DESC'     =>  esc_html__( 'DESC', 'blogar'),
                ),
                'default' => 'ASC ',
            ]
        );

        $this->end_controls_section();

        $this->axil_basic_style_controls('category_list_title', 'Title', '.section-title .title');
        $this->axil_section_style_controls('category_list_area', 'Section', '.axil-categories-list');

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $show_count 		  	= isset($settings['show_count']) && $settings['show_count'] == 'yes' ? true : false;
        $hide_empty_category  	= isset($settings['hide_empty_category']) && $settings['hide_empty_category'] == 'yes' ? true : false;
        $orderby  				= isset($settings['orderby']) ? $settings['orderby'] : 'name';
        $order  				= isset($settings['order']) ? $settings['order'] : 'ASC';
        $catsArray = $settings['category_lists'];

        $categories = get_terms( array(
            'taxonomy' 			=> 'category',
            'hide_empty' 		=> $hide_empty_category,
            'slug'              => $catsArray,
            'orderby'           => $orderby,
            'order'             => $order,
        ) );

        $category_list_section_button  	= isset($settings['axil_category_list_section_button_show']) && $settings['axil_category_list_section_button_show'] == 'yes' ? true : false;
        $cal_class = $category_list_section_button == true ? "col-lg-6 col-md-8 col-sm-8 col-12" : "col-lg-12 col-md-12 col-sm-12 col-12";
        ?>

        <div class="axil-categories-list axil-section-gap bg-color-grey">
            <div class="container">

                <div class="row align-items-center mb--30">
                    <div class="<?php echo esc_attr($cal_class); ?>">
                        <div class="section-title <?php echo esc_attr($settings['axil_category_list_title_align']); ?>">
                            <?php $this->axil_section_title_render('category_list_title',  $this->get_settings()); ?>
                        </div>
                    </div>

                    <?php if($category_list_section_button){ ?>
                        <div class="col-lg-6 col-md-4 col-sm-4 col-12">
                            <div class="see-all-topics text-left text-sm-right mt_mobile--20">
                                <?php
                                // Link
                                if ('2' == $settings['axil_category_list_section_button_link_type']) {
                                    $this->add_render_attribute('axil_category_list_section_button_link', 'href', get_permalink($settings['axil_category_list_section_button_page_link']));
                                    $this->add_render_attribute('axil_category_list_section_button_link', 'target', '_self');
                                    $this->add_render_attribute('axil_category_list_section_button_link', 'rel', 'nofollow');
                                } else {
                                    if (!empty($settings['axil_category_list_section_button_link']['url'])) {
                                        $this->add_render_attribute('axil_category_list_section_button_link', 'href', $settings['axil_category_list_section_button_link']['url']);
                                    }
                                    if ($settings['axil_category_list_section_button_link']['is_external']) {
                                        $this->add_render_attribute('axil_category_list_section_button_link', 'target', '_blank');
                                    }
                                    if (!empty($settings['axil_category_list_section_button_link']['nofollow'])) {
                                        $this->add_render_attribute('axil_category_list_section_button_link', 'rel', 'nofollow');
                                    }
                                }
                                // Button
                                if (!empty($settings['axil_category_list_section_button_link']['url']) || isset($settings['axil_category_list_section_button_link_type'])) {

                                    $this->add_render_attribute('axil_category_list_section_button_link_style', 'class', ' axil-link-button ');

                                    // Link
                                    $button_html = '<a ' . $this->get_render_attribute_string('axil_category_list_section_button_link_style') . ' ' . $this->get_render_attribute_string('axil_category_list_section_button_link') . '>'  .  $settings['axil_category_list_section_button_text'] . '</a>';
                                    echo $button_html;
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start List Wrapper  -->
                        <div class="list-categories categories-activation axil-slick-arrow arrow-between-side">
                            <?php
                            foreach( $categories as $category ){ ?>
                                <!-- Start Single Category  -->
                                <div class="single-cat">
                                    <div class="inner">
                                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">

                                            <?php $category_image_id 	= get_term_meta( $category->term_id, 'blogar_category_background_image', true ); ?>
                                            <div class="thumbnail">
                                                <?php echo wp_get_attachment_image( $category_image_id, array('180', '180'), "", array( "class" => "img-responsive" ) ); ?>
                                            </div>
                                            <?php if ( !empty($category->name) ): ?>
                                                <div class="content">
                                                    <h5 class="title">
                                                        <?php echo esc_html($category->name); ?>
                                                        <?php if ( $show_count): ?>
                                                            <span class="counter">(<?php echo wp_kses_post($category->count); ?>)</span>
                                                        <?php endif ?>
                                                    </h5>
                                                </div>
                                            <?php endif ?>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Category  -->
                            <?php } ?>

                        </div>
                        <!-- Start List Wrapper  -->
                    </div>
                </div>
            </div>
        </div>

        <?php


    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Blogar_Elementor_Widget_Category_List() );


