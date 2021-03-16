<?php
if (!function_exists('blogar_activate_core')) {
    function blogar_activate_core()
    {
        $id = 'axil-sidebar-sidebar-for-lifestyle';
        $sidebars = get_option('axil__custom_sidebars', array());

        if (!array_key_exists($id, $sidebars)) {
            // wp_send_json_error(esc_html__('Sidebar with the same name already exists. Please choose a different name', 'blogar'));
            $sidebars[$id] = array(
                'id' => $id,
                'name' => esc_html__('Sidebar For Lifestyle ', 'blogar'),
                'class' => 'axil-custom',
                'description' => '',
                'before_widget' => '<div class="%1$s widget-sidebar widget %2$s widgets-sidebar">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title"><h3>',
                'after_title' => '</h3></div>',
            );
            update_option('axil__custom_sidebars', $sidebars);
        }
        // ---------------

        $id = 'axil-sidebar-sidebar-for-review';
        $sidebars = get_option('axil__custom_sidebars', array());

        if (!array_key_exists($id, $sidebars)) {
            //  wp_send_json_error(esc_html__('Sidebar with the same name already exists. Please choose a different name', 'blogar'));
            $sidebars[$id] = array(
                'id' => $id,
                'name' => esc_html__('Sidebar for Review ', 'blogar'),
                'class' => 'axil-custom',
                'description' => '',
                'before_widget' => '<div class="%1$s widget-sidebar widget %2$s widgets-sidebar">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title"><h3>',
                'after_title' => '</h3></div>',
            );
            update_option('axil__custom_sidebars', $sidebars);
        }


    }
}
