<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_5c3de7e54eb56',
    'title' => 'Menu Option',
    'fields' => array(
        array(
            'key' => 'field_5c3de88e37696',
            'label' => 'Enable Mega Menu',
            'name' => 'esell_enable_mega_menu',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
        ),
        array(
            'key' => 'field_5c3de8217d5eb',
            'label' => 'Select Mega Menu',
            'name' => 'esell_select_mega_menu',
            'type' => 'post_object',
            'instructions' => '<a href="edit.php?post_type=megamenu">Create / Edit Mega Menu</a>',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_5c3de88e37696',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'megamenu',
            ),
            'taxonomy' => '',
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
            'ui' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'nav_menu_item',
                'operator' => '==',
                'value' => 'all',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));

endif;