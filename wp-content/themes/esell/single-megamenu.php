<?php
/**
 * The template for displaying megamenu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package esell
 */
get_header();
while ( have_posts() ) :
    the_post();

    the_content();

endwhile; // End of the loop.
get_footer();