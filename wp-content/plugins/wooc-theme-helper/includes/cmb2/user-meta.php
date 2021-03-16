<?php
/**
 * @author  Wooctheme
 * @since   1.0
 * @version 1.0
 * @package wooctheme-theme-helper
 */


add_action('cmb2_admin_init', 'wooctheme_register_user_profile_metabox');
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function wooctheme_register_user_profile_metabox()
{
    $userpfix = WOOCTHEME_THEME_HELPER_FIX;
    /**
     * Metabox for the user profile screen
     */
    $cmb_user = new_cmb2_box(array(
        'id' => $userpfix . '_edit',
        'title' => esc_html__('User Profile Metabox', 'wooctheme-theme-helper'), // Doesn't output for user boxes
        'object_types' => array('user'), // Tells CMB2 to use user_meta vs post_meta
        'show_names' => true,
        'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
    ));


    $cmb_user->add_field(array(
        'name' => esc_html__('Social Profile Information', 'wooctheme-theme-helper'),
        'id' => $userpfix . '_extra_social_info',
        'type' => 'title',
        'on_front' => false,
    ));

    $cmb_user->add_field(array(
        'name' => esc_html__('Facebook URL', 'wooctheme-theme-helper'),
        'desc' => esc_html__('Please enter your facebook URL', 'wooctheme-theme-helper'),
        'id' => $userpfix . '_facebookurl',
        'type' => 'text_url',
    ));
    $cmb_user->add_field(array(
        'name' => esc_html__('Twitter URL', 'wooctheme-theme-helper'),
        'desc' => esc_html__('Please enter your twitter URL', 'wooctheme-theme-helper'),
        'id' => $userpfix . '_twitterurl',
        'type' => 'text_url',
    ));
    $cmb_user->add_field(array(
        'name' => esc_html__('Linkedin URL', 'wooctheme-theme-helper'),
        'desc' => esc_html__('Please enter your linkedin URL', 'wooctheme-theme-helper'),
        'id' => $userpfix . '_linkedinurl',
        'type' => 'text_url',
    ));
    $cmb_user->add_field(array(
        'name' => esc_html__('Pinterest URL', 'wooctheme-theme-helper'),
        'desc' => esc_html__('Please enter your pinterest URL', 'wooctheme-theme-helper'),
        'id' => $userpfix . '_pinteresturl',
        'type' => 'text_url',
    ));

}
