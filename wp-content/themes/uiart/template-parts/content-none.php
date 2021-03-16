<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

?>
<section class="no-results not-found">
	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'uiart' ); ?></h2>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>	
		<?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'uiart') , 'allow_link' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'uiart' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'uiart' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>