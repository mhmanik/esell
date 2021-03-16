<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="https://gmpg.org/xfn/11"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to content', 'uiart'); ?></a>
    <header id="site-header" class="site-header">
    <?php  if ( WOOCTheme::$has_top_bar )  {
        get_template_part('template-parts/header/header-top', WOOCTheme::$top_bar_style); 
    }
    get_template_part('template-parts/header/header', WOOCTheme::$header_style); ?>
    </header>
    <div id="meanmenu"></div>
    <div id="content" class="site-content">
    <?php get_template_part('template-parts/content', 'banner'); ?>