<?php

namespace Elementor;

use Elementor\Group_Control_Base;
use Elementor\REPEA;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

function axil_elementor_init()
{

    /**
     * Initialize EAE_Helper
     */
    new axil_Helper;

}

add_action('elementor/init', 'Elementor\axil_elementor_init');
/**
 * Get All Post Types
 */
function axil_get_post_types()
{

    $axil_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
    $axil_exclude_cpts = array('elementor_library', 'attachment');
    foreach ($axil_exclude_cpts as $exclude_cpt) {
        unset($axil_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($axil_cpts);
    foreach ($post_types as $type) {
        $types[$type->name] = $type->label;
    }
    return $types;
}

/**
 * Get all types of post.
 */
if(!function_exists('axil_get_all_types_post')){
    function axil_get_all_types_post($post_type)
    {
        $posts_args = get_posts(array(
            'post_type' => $post_type,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ));

        $posts = array();

        if (!empty($posts_args) && !is_wp_error($posts_args)) {
            foreach ($posts_args as $post) {
                $posts[$post->ID] = $post->post_title;
            }
        }

        return $posts;
    }
}


/**
 * Get all Pages
 */
if (!function_exists('axil_get_all_pages')) {
    function axil_get_all_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/*
 * All Post Name
 * return array
 */
if(!function_exists('axil_get_all_posts')){
    function axil_get_all_posts($post_type = 'post')
    {
        $options = array();
        $options = ['0' => esc_html__('None', 'esell-elements')];
        $axil_post = array('posts_per_page' => -1, 'post_type' => $post_type);
        $axil_post_terms = get_posts($axil_post);
        if (!empty($axil_post_terms) && !is_wp_error($axil_post_terms)) {
            foreach ($axil_post_terms as $term) {
                $options[$term->ID] = $term->post_title;
            }
            return $options;
        }
    }
}



/**
 * Post Settings Parameter
 */
if(!function_exists('axil_get_post_settings')){
    function axil_get_post_settings($settings)
    {
        foreach ($settings as $key => $value) {
            $post_args[$key] = $value;
        }
        $post_args['post_status'] = 'publish';

        return $post_args;
    }
}

/**
 * Get Post Thumbnail Size
 */
if(!function_exists('axil_get_thumbnail_sizes')){
    function axil_get_thumbnail_sizes()
    {
        $sizes = get_intermediate_image_sizes();
        foreach ($sizes as $s) {
            $ret[$s] = $s;
        }
        return $ret;
    }
}


/**
 * Post Orderby Options
 */
if(!function_exists('axil_get_orderby_options')){
    function axil_get_orderby_options()
    {
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
        return $orderby;
    }
}


/**
 * Get Post Categories
 */
if(!function_exists('axil_get_categories')){
    function axil_get_categories($taxonomy)
    {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
        }
        return $options;
    }
}


/**
 * Get Post Categories
 */
if(!function_exists('axil_get_categories_id')){
    function axil_get_categories_id($taxonomy)
    {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }
        return $options;
    }
}


/**
 * Get all Pages
 */
if (!function_exists('axil_get_pages')) {
    function axil_get_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}


/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function axil_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
    }

    return $allowed_html;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function axil_kses_intermediate($string = '')
{
    return wp_kses($string, axil_get_allowed_html_tags('intermediate'));
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function axil_kses_basic($string = '')
{
    return wp_kses($string, axil_get_allowed_html_tags('basic'));
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function axil_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(axil_get_allowed_html_tags($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'esell'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Element Common Functions
 */
trait EsellElementCommonFunctions
{

    /**
     * Create section title fields
     *
     * @param null $control_id
     * @param string $before_title
     * @param string $title
     * @param string $default_title_tag
     * @param string $description
     */
    protected function axil_section_title($control_id = null, $title = 'Your Section Title', $default_title_tag = 'h2', $align_field = false, $align = 'text-left')
    {
        $this->start_controls_section(
            'axil_' . $control_id . '_section_title',
            [
                'label' => esc_html__('Section Title', 'esell'),
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_title',
            [
                'label' => esc_html__('Title', 'esell'),
                'type' => Controls_Manager::TEXT,
                'default' => $title,
                'placeholder' => esc_html__('Type Heading Text', 'esell'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'esell'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'esell'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'esell'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'esell'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'esell'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'esell'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'esell'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => $default_title_tag,
                'toggle' => false,
            ]
        );
        if($align_field == true){
            $this->add_responsive_control(
                'axil_' . $control_id . '_align',
                [
                    'label' => esc_html__( 'Alignment', 'esell' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'text-left' => [
                            'title' => esc_html__( 'Left', 'esell' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'text-center' => [
                            'title' => esc_html__( 'Center', 'esell' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'text-right' => [
                            'title' => esc_html__( 'Right', 'esell' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => $align,
                    'toggle' => true,
                ]
            );
        }
        $this->end_controls_section();
    }

    /**
     * Render Section Title
     *
     * @param null $control_id
     * @param $settings
     */
    protected function axil_section_title_render($control_id = null, $settings)
    {
        $this->add_render_attribute('title_args', 'class', 'title');
        ?>
            <?php if ($settings['axil_'.$control_id.'_title_tag']) : ?>
                <<?php echo tag_escape($settings['axil_'.$control_id.'_title_tag']); ?> <?php echo $this->get_render_attribute_string('title_args'); ?>><?php echo axil_kses_basic($settings['axil_'.$control_id.'_title']); ?></<?php echo tag_escape($settings['axil_'.$control_id.'_title_tag']) ?>>
            <?php endif; ?>
        <?php
    }

    /**
     * [axil_query_controls description]
     * @param  [type] $control_id     [description]
     * @param  [type] $control_name   [description]
     * @param string $post_type [description]
     * @param string $taxonomy [description]
     * @param string $posts_per_page [description]
     * @param string $offset [description]
     * @param string $orderby [description]
     * @param string $order [description]
     * @return [type]                 [description]
     */
    protected function axil_query_controls($control_id = null, $control_name = null, $post_type = 'any', $taxonomy = 'category', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc')
    {

        $this->start_controls_section(
            'esell' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'esell'), $control_name),
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Category', 'esell'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => axil_get_categories($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Category', 'esell'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => axil_get_categories_id($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'post__in',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Select post manually', 'esell' ),
                'label_block' => true,
                'multiple' => true,
                'options' => axil_get_all_posts(),
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude post', 'esell'),
                'type' => Controls_Manager::SELECT2,
                'options' => axil_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'post_format',
            [
                'label' =>esc_html__('Select Post Format', 'esell'),
                'type'      => Controls_Manager::SELECT2,
                'options' => [
                    'post-format-standard' => esc_html__( 'Standard', 'esell' ),
                    'post-format-audio' => esc_html__( 'Audio', 'esell' ),
                    'post-format-video' => esc_html__( 'Video', 'esell' ),
                    'post-format-gallery' => esc_html__( 'Gallery', 'esell' ),
                    'post-format-link' => esc_html__( 'Link', 'esell' ),
                    'post-format-quote' => esc_html__( 'Quote', 'esell' ),
                ],
                'default' => [],
                'label_block' => true,
                'multiple'  => true,
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'esell'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'esell'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'esell'),
                'type' => Controls_Manager::SELECT,
                'options' => axil_get_orderby_options(),
                'default' => $orderby,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'esell'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__('Ascending', 'esell'),
                    'desc' => esc_html__('Descending', 'esell'),
                ],
                'default' => $order,

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore sticky posts', 'esell' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'esell' ),
                'label_off' => esc_html__( 'No', 'esell' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_only_sticky_posts',
            [
                'label' => esc_html__( 'Show only sticky posts', 'esell' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'esell' ),
                'label_off' => esc_html__( 'No', 'esell' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * [axil_basic_style_controls description]
     * @param  [string] $control_id       [description]
     * @param  [string] $control_name     [description]
     * @param  [string] $control_selector [description]
     * @return [styleing control]                   [ color, typography, padding, margin ]
     */
    protected function axil_basic_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'axil_' . $control_id . '_styling',
            [
                'label' => esc_html__($control_name, 'esell'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_color',
            [
                'label' => esc_html__('Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'axil_' . $control_id . '_typography',
                'label' => esc_html__('Typography', 'esell'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_responsive_control(
            'axil_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'esell'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'axil_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'esell'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * [axil_section_style_controls description]
     * @param  [type] $control_id       [description]
     * @param  [type] $control_name     [description]
     * @param  [type] $control_selector [description]
     * @return [type]                   [description]
     */
    protected function axil_section_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'axil_' . $control_id . '_area_styling',
            [
                'label' => esc_html__($control_name, 'esell'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'axil_' . $control_id . 'area_background',
                'label' => esc_html__('Background', 'esell'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'axil_' . $control_id . 'area_border',
                'label' => esc_html__( 'Border', 'esell' ),
                'selector' => '{{WRAPPER}} ' . $control_selector,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'axil_' . $control_id . '_area_padding',
            [
                'label' => esc_html__('Padding', 'esell'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'axil_' . $control_id . '_area_margin',
            [
                'label' => esc_html__('Margin', 'esell'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * [axil_link_controls description]
     * @param string $control_id [description]
     * @param string $control_name [description]
     * @return [type]               [description]
     */
    protected function axil_link_controls($control_id = 'button', $control_name = 'Button', $default = 'Read More')
    {

        $this->add_control(
            'axil_' . $control_id . '_show',
            [
                'label' => esc_html__('Show Button', 'esell'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'esell'),
                'label_off' => esc_html__('Hide', 'esell'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_text',
            [
                'label' => esc_html__($control_name . ' Text', 'esell'),
                'type' => Controls_Manager::TEXT,
                'default' => $default,
                'title' => esc_html__('Enter button text', 'esell'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_link_type',
            [
                'label' => esc_html__($control_name . ' Link Type', 'esell'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_link',
            [
                'label' => esc_html__($control_name . ' link', 'esell'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'esell'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'axil_' . $control_id . '_link_type' => '1'
                ],
                'label_block' => true
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_page_link',
            [
                'label' => esc_html__('Select ' . $control_name . ' Page', 'esell'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => axil_get_all_pages(),
                'condition' => [
                    'axil_' . $control_id . '_link_type' => '2'
                ]
            ]
        );

    }

    /**
     * [axil_link_controls_style description]
     * @param string $control_id [description]
     * @param string $control_selector [description]
     * @return [type]                   [description]
     */
    protected function axil_link_controls_style($control_id = 'button_style', $control_name = 'Button', $control_selector = 'a', $default_size = 'btn-large', $default_style = 'btn-solid')
    {
        /**
         * Button One
         */
        $this->start_controls_section(
            'axil_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'esell'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_button_style',
            [
                'label' => esc_html__('Button Style', 'esell'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'btn-transparent' => esc_html__('Outline', 'esell'),
                    'btn-solid' => esc_html__('Solid', 'esell'),
                    'axil-link-button' => esc_html__('Link', 'esell'),
                ],
                'default' => $default_style
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_button_size',
            [
                'label' => esc_html__('Button Size', 'esell'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'btn-extra-large' => esc_html__('Extra Large', 'esell'),
                    'btn-large' => esc_html__('Large', 'esell'),
                    'btn-medium' => esc_html__('Medium', 'esell'),
                    'btn-small' => esc_html__('Small', 'esell'),
                ],
                'default' => $default_size,
                'condition' => array(
                    'axil_' . $control_id . '_button_style!' => 'axil-link-button',
                ),
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_button_arrow_icon',
            [
                'label' => esc_html__('Arrow Icon', 'esell'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'esell'),
                'label_off' => esc_html__('Hide', 'esell'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                        'axil_' . $control_id . '_button_style!' => 'axil-link-button',
                ),
            ]
        );
        $this->add_responsive_control(
            'axil_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'esell'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'axil_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );


        $this->start_controls_tabs('axil_' . $control_id . '_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('axil_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'esell')]);

        $this->add_control(
            'axil_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . ' .button-icon' => 'border-left-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '::after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . '::before' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . '.axil-link-button::after' => 'background: {{VALUE}};',
                ],
            ]

        );

        $this->add_control(
            'axil_' . $control_id . '_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'esell'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} ' . $control_selector . '::after' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} ' . $control_selector . '::before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('axil_' . $control_id . '_btn_hover', ['label' => esc_html__('Hover', 'esell')]);

        $this->add_control(
            'axil_' . $control_id . '_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . ':hover .button-icon' => 'border-left-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . '.btn-transparent:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'esell'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover::after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} ' . $control_selector . '.axil-link-button:hover::after' => 'background: {{VALUE}};',
                ],
            ]

        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    /**
     * @param string $control_id
     * @param string $control_name
     * @param string $default_for_lg
     * @param string $default_for_md
     * @param string $default_for_sm
     * @param string $default_for_all
     */
    protected function axil_columns($control_id = 'columns_options', $control_name = 'Select Columns', $default_for_lg = '4', $default_for_md = '6', $default_for_sm = '6', $default_for_all = '12'){
        $this->start_controls_section(
            'axil_' . $control_id . 'columns_section',
            [
                'label' => esc_html__($control_name, 'esell'),
            ]
        );

        $this->add_control(
            'axil_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'esell' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'esell' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'esell' ),
                    6 => esc_html__( '2 Columns', 'esell' ),
                    4 => esc_html__( '3 Columns', 'esell' ),
                    3 => esc_html__( '4 Columns', 'esell' ),
                    5 => esc_html__( '5 Columns (col-5)', 'esell' ),
                    2 => esc_html__( '6 Columns', 'esell' ),
                    1 => esc_html__( '12 Columns', 'esell' ),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'esell' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'esell' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'esell' ),
                    6 => esc_html__( '2 Columns', 'esell' ),
                    4 => esc_html__( '3 Columns', 'esell' ),
                    3 => esc_html__( '4 Columns', 'esell' ),
                    5 => esc_html__( '5 Columns (col-5)', 'esell' ),
                    2 => esc_html__( '6 Columns', 'esell' ),
                    1 => esc_html__( '12 Columns', 'esell' ),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'esell' ),
                'description' => esc_html__( 'Screen width equal to or greater than 576px', 'esell' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'esell' ),
                    6 => esc_html__( '2 Columns', 'esell' ),
                    4 => esc_html__( '3 Columns', 'esell' ),
                    3 => esc_html__( '4 Columns', 'esell' ),
                    5 => esc_html__( '5 Columns (col-5)', 'esell' ),
                    2 => esc_html__( '6 Columns', 'esell' ),
                    1 => esc_html__( '12 Columns', 'esell' ),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'axil_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'esell' ),
                'description' => esc_html__( 'Screen width less than 576px', 'esell' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'esell' ),
                    6 => esc_html__( '2 Columns', 'esell' ),
                    4 => esc_html__( '3 Columns', 'esell' ),
                    3 => esc_html__( '4 Columns', 'esell' ),
                    5 => esc_html__( '5 Columns (col-5)', 'esell' ),
                    2 => esc_html__( '6 Columns', 'esell' ),
                    1 => esc_html__( '12 Columns', 'esell' ),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

}

/**
 * axil_Helper
 */
class Axil_Helper
{


    public static function get_query_args($posttype, $taxonomy, $settings)
    {

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);


        $exclude_category_list = '';
        if (!empty($settings['exclude_category'])) {
            $exclude_category_list = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_category_list);



        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();


        // Post in
        $post_in = $settings['post__in'];
        if ($post_in >= 1 && !empty($post_in)) {
            $post_in_ids = implode(', ', $post_in);
        } else {
            $post_in_ids = '';
        }
        $in_posts = explode(',', $post_in_ids);

        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'category__not_in' => $exclude_category_list_value,
        );

        // ignore_sticky_posts and manually Exclude
        $sticky = get_option( 'sticky_posts' );
        if (!empty($settings['ignore_sticky_posts']) && $settings['ignore_sticky_posts'] == 'yes') {
            $args['ignore_sticky_posts'] = 1;

            if ( !empty($settings['post__not_in']) ) {
                $post__not_in = $settings['post__not_in'];
                $posts_not_in = array_merge($post__not_in,$sticky);
                $args['post__not_in'] = $posts_not_in;
            } else {
                $args['post__not_in'] = $sticky;
            }

        } else {
            if (!empty($settings['post__not_in'])) {
                $post__not_in = $settings['post__not_in'];
                $args['post__not_in'] = $post__not_in;
            }
        }

        // show_sticky_posts and manually Exclude
        if (!empty($settings['show_only_sticky_posts']) && $settings['show_only_sticky_posts'] == 'yes') {
            $args['ignore_sticky_posts'] = 1;
            // post__in
            if ("0" != $in_posts && !empty($settings['post__in'])) {
                $posts_in = array_merge($in_posts,$sticky);
                $args['post__in'] = $posts_in;
            } else{
                $args['post__in'] = $sticky;
            }
        } else {
            // post__in
            if ("0" != $in_posts && !empty($settings['post__in'])) {
                $args['post__in'] = $in_posts;
            }
        }


        if (!empty($settings['category'])) {
            $args['tax_query'][] = [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $category_list_value,
            ];
        }

        if (!empty($settings['post_format'])) {
            $args['tax_query'][] = [
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => $settings['post_format'],
            ];
        }

        return $args;
    }

}


/**
 * @param $content
 * @param string $limit
 * @return string
 */
function axil_limit_content_chr( $content, $limit = '100' ) {
    return mb_strimwidth( strip_tags($content), 0, $limit, '...' );
}

