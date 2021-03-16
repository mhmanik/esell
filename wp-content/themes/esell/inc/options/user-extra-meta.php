<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e4b96c080917',
        'title' => 'User Social Media',
        'fields' => array(
            array(
                'key' => 'user_designation_key',
                'label' => 'Designation',
                'name' => 'user_designation',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'Developer',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5e4b96f6dc7f8',
                'label' => 'Add Social Icons',
                'name' => 'axil_add_social_icons',
                'type' => 'repeater',
                'instructions' => 'Choose your icon markup here: https://fontawesome.com/icons',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_5e4bbd75dc7fa',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add New Network',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e4bbcaddc7f9',
                        'label' => 'Enter Social Icon Markup',
                        'name' => 'axil_enter_social_icon_markup',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '<i class="fab fa-facebook-f"></i>',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5e4bbd75dc7fa',
                        'label' => 'Enter Social Icon Link',
                        'name' => 'axil_enter_social_icon_link',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'all',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;