<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Blogar_Elementor_Widget_Social_Networks extends Widget_Base
{

    use \Elementor\BlogarElementCommonFunctions;

    public function get_name()
    {
        return 'blogar-social_networks';
    }

    public function get_title()
    {
        return __('Social Networks', 'blogar');
    }

    public function get_icon()
    {
        return 'axil-icon';
    }

    public function get_categories()
    {
        return ['blogar'];
    }

    public function get_keywords()
    {
        return ['social networks', 'social icons', 'blogar'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'blogar_social_networks',
            [
                'label' => esc_html__('Social Networks', 'blogar'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_networks_title', [
                'label' => esc_html__('Title', 'blogar'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Social Networks Title', 'blogar'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'social_networks_link',
            [
                'label' => esc_html__('Link', 'blogar'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'blogar'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'social_networks_icon', [
                'label' => esc_html__('Add icons markup', 'blogar'),
                'description' => esc_html__('Add icon markup like: <i class="fab fa-dribbble"></i>', 'blogar'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '<i class="fab fa-dribbble"></i>',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'social_networks_icon_color',
            [
                'label' => esc_html__('Hover Color', 'blogar'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover a i' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'social_networks_custom_class', [
                'label' => esc_html__('Add custom class', 'blogar'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'dribbble',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'social_networks',
            [
                'label' => esc_html__('Repeater Social Networks', 'blogar'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_networks_title' => esc_html__('Twitter', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-twitter"></i>',
                        'social_networks_icon_color' => '#1ba1f2',
                        'social_networks_custom_class' => 'twitter',
                    ],
                    [
                        'social_networks_title' => esc_html__('Facebook', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-facebook-f"></i>',
                        'social_networks_icon_color' => '#3b5997',
                        'social_networks_custom_class' => 'facebook',
                    ],
                    [
                        'social_networks_title' => esc_html__('Youtube', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-youtube"></i>',
                        'social_networks_icon_color' => '#ed4141',
                        'social_networks_custom_class' => 'youtube',
                    ],
                    [
                        'social_networks_title' => esc_html__('Dribbble', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-dribbble"></i>',
                        'social_networks_icon_color' => '#EA4C89',
                        'social_networks_custom_class' => 'dribbble',
                    ],
                    [
                        'social_networks_title' => esc_html__('Behance', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-behance"></i>',
                        'social_networks_icon_color' => '#0067FF',
                        'social_networks_custom_class' => 'behance',
                    ],
                    [
                        'social_networks_title' => esc_html__('Linkedin', 'blogar'),
                        'social_networks_icon' => '<i class="fab fa-linkedin-in"></i>',
                        'social_networks_icon_color' => '#0177AC',
                        'social_networks_custom_class' => 'linkedin',
                    ],

                ],
                'title_field' => '{{{ social_networks_title }}}',
            ]
        );

        $this->end_controls_section();


        $this->axil_section_style_controls('social_networks_area', 'Area', '.axil-social-wrapper');

    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        if ($settings['social_networks']) { ?>
            <div class="axil-social-wrapper bg-color-white radius">
                <ul class="social-with-text">
                    <?php
                    foreach ($settings['social_networks'] as $item) {
                        $target = $item['social_networks_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['social_networks_link']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <li class="<?php echo esc_attr($item['social_networks_custom_class']); ?> elementor-repeater-item-<?php echo $item['_id']; ?>"><a
                                href="<?php echo esc_url($item['social_networks_link']['url']); ?>" <?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>><?php echo blogar_escapeing($item['social_networks_icon']); ?>
                                <span><?php echo esc_html($item['social_networks_title']); ?></span></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Blogar_Elementor_Widget_Social_Networks());


