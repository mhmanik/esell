<?php
/**
 * @author  Wooctheme
 * @since   1.0
 * @version 1.0
 * @package wooctheme-theme-helper
 */

use wooctheme\Uiart\WOOCTheme;

add_action('init', 'register_wooctheme_team_postypes');

function register_wooctheme_team_postypes(){

    $prefix             = WOOCTHEME_THEME_HELPER_FIX;
    $team_slug          = ( !empty(WOOCTheme::$options['team_slug']) )? WOOCTheme::$options['team_slug'] :'team';
    $team_cat_slug      = ( !empty(WOOCTheme::$options['team_cat_slug']) )? WOOCTheme::$options['team_cat_slug'] :'team-cat';
    $labels = array(
        'name'                  => esc_html__('Team',                   'wooctheme-theme-helper'),
        'singular_name'         => esc_html__('Team',                   'wooctheme-theme-helper'),
        'add_new'               => esc_html__('Add New',                'wooctheme-theme-helper'),
        'add_new_item'          => esc_html__('Add New Team',           'wooctheme-theme-helper'),
        'edit_item'             => esc_html__('Edit Team',              'wooctheme-theme-helper'),
        'new_item'              => esc_html__('New Team',               'wooctheme-theme-helper'),
        'view_item'             => esc_html__('View Team',              'wooctheme-theme-helper'),
        'search_items'          => esc_html__('Search Team',            'wooctheme-theme-helper'),
        'not_found'             => esc_html__('No Team found',          'wooctheme-theme-helper'),
        'not_found_in_trash'    => esc_html__('No Team found in Trash', 'wooctheme-theme-helper'),
        'parent_item_colon'     => ''
    );
    
    register_post_type("{$prefix}_team", array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'show_in_nav_menus'     => true,
        'has_archive'           => true,
        'rewrite'               => true,        
        'hierarchical'          => false,       
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-businessman',
        'supports'              => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),        
        'rewrite'               => array( 'slug' => esc_html__($team_slug , 'wooctheme-theme-helper' )),
    ));

    $labels = array(
        'name'              => _x( 'Team Categories', 'team categories',            'wooctheme-theme-helper' ),
        'singular_name'     => _x( 'Team Category', 'team category',                'wooctheme-theme-helper' ),
        'search_items'      => esc_html__('Search Team Categories' ,                'wooctheme-theme-helper'),
        'all_items'         => esc_html__('All Team Categories' ,                   'wooctheme-theme-helper'),
        'parent_item'       => esc_html__('Parent Team Category' ,                  'wooctheme-theme-helper'),
        'parent_item_colon' => esc_html__('Parent Team Category:' ,                 'wooctheme-theme-helper'),
        'edit_item'         => esc_html__('Edit Team Category' ,                    'wooctheme-theme-helper'),
        'update_item'       => esc_html__('Update Team Category' ,                  'wooctheme-theme-helper'),
        'add_new_item'      => esc_html__('Add New Team Category' ,                 'wooctheme-theme-helper'),
        'new_item_name'     => esc_html__('New Team Category Name' ,                'wooctheme-theme-helper'),
        'menu_name'         => esc_html__('Team Category' ,                         'wooctheme-theme-helper'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_nav_menus' => true,
        'show_ui'           => null,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $team_cat_slug  ),

    );
    register_taxonomy( "{$prefix}_team_category", array( "{$prefix}_team" ), $args );    
}


