<?php
/**
 * The template for displaying elementor template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package esell
 */
get_header(); 
while ( have_posts() ) : the_post(); ?>
	<div class="page-wrapper blog-story-area clear">
		<div class="container">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="elementor-template-preview">
			<?php the_content(); ?>
		</div>
	</div>
<?php
endwhile; // End of the loop.
get_footer();