<?php
/**
 * Template Name: Blank fix Template
 *
 * @package esell
 */

?>
<div id="primary" class="fix-content-area ">
		<?php while ( have_posts() ) :
			the_post();
			the_content();
		endwhile; // End of the loop. ?>
</div>

