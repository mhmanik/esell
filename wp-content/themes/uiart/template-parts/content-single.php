<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$thumb_size      = Helper::has_sidebar() ? 'wooctheme-size2' : 'wooctheme-size1';
$has_entry_meta  = WOOCTheme::$options['blog_date'] || ( WOOCTheme::$options['blog_cats'] && has_category() ) || WOOCTheme::$options['blog_author_name'] || WOOCTheme::$options['blog_comment_num'] ? true : false;

$comments_number = get_comments_number();
$comments_text   = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'uiart' ), number_format_i18n( $comments_number ) );
$author_id       = get_the_author_meta( 'ID' );
$author_name     = get_the_author_meta( 'display_name' );
$author_bio      = get_the_author_meta( 'description' );
$author_info     = get_the_author_meta( 'uiart_user_info' );
$author_designation = !empty( $author_info['designation'] ) ? $author_info['designation'] : '';
$author_socials  = array();
if ( !empty( $author_info['socials'] ) ) {
	$socials = Helper::user_socials();
	foreach ( $author_info['socials'] as $key => $value ) {
		if ( $value ) {
			$author_socials[$key] = array(
				'icon' => $socials[$key]['icon'],
				'link' => $value
			);
		}
	}	
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'loop-post-wrp loop-post-wrp-single' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail"><?php the_post_thumbnail( $thumb_size );?></div>
	<?php endif; ?>
	<span class="entry-title d-none"><?php the_title();?></span>
	<div class="post-content-area">
		<?php if ( $has_entry_meta ): ?>
			<ul class="post-meta">
				<?php if ( WOOCTheme::$options['blog_date'] ): ?>
					<li><i class="fas fa-calendar-alt"></i><span class="updated published"><?php the_time( get_option( 'date_format' ) );?></span></li>
				<?php endif; ?>
				<?php if ( WOOCTheme::$options['blog_author_name'] ): ?>
					<li><i class="fas fa-user-tie"></i><span class="vcard author"><a href="<?php echo get_author_posts_url( $author_id ); ?>" class="fn"><?php the_author(); ?></a></span></li>
				<?php endif; ?>
				<?php if ( WOOCTheme::$options['blog_comment_num'] ): ?>
					<li><i class="fas fa-comments"></i><span><?php echo esc_html( $comments_text );?></span></li>
				<?php endif; ?>
				<?php if ( WOOCTheme::$options['blog_cats'] && has_category() ): ?>
					<li><i class="fas fa-tags"></i><?php the_category( ', ' );?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<div class="post-content entry-content clearfix"><?php the_content();?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>' ) );?>		
		<?php if ( WOOCTheme::$options['post_tags'] && has_tag() && WOOCTheme::$options['post_social'] ): ?>
			<div class="single-post-footer">
				<?php if ( WOOCTheme::$options['post_tags'] && has_tag() ): ?>
					<div class="post-tags">
						<h3 class="woocue-title"><?php esc_html_e( 'Releted Tags:', 'uiart' );?></h3>
						<div class="woocue-content"><?php echo get_the_term_list( $post->ID, 'post_tag' ); ?></div>
					</div>
				<?php endif; ?>
				<?php
				if ( WOOCTheme::$options['post_social'] ) {
					do_action( 'wooctheme_social_share', WOOCTheme::$options['post_share'] );
				}
				?>		
			</div>
		<?php endif; ?>

		<?php if ( WOOCTheme::$options['post_about_author'] && $author_bio ): ?>
			<div class="post-author-block">
				<div class="woocue-left">
					<a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo get_avatar( $author_id, 120 ); ?></a>
				</div>
				<div class="woocue-right">
					<h3 class="author-name"><?php echo esc_html( $author_name );?></h3>

					<?php if ( $author_designation ): ?>
						<div class="author-designation"><?php echo esc_html( $author_designation );?></div>
					<?php endif ?>

					<?php if ( $author_socials ): ?>
						<div class="author-social">
							<?php foreach ( $author_socials as $author_social ): ?>
								<a href="<?php echo esc_url( $author_social['link'] );?>" target="_blank"><i class="fa <?php echo esc_attr( $author_social['icon'] );?>"></i></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					
					<div class="author-bio"><?php echo esc_attr( $author_bio );?></div>
				</div>
			</div>
		<?php endif; ?>
		<?php
		if ( WOOCTheme::$options['post_pagination'] ) {
			get_template_part( 'template-parts/content-single-pagination' );
		}
		?>
	</div>
</div>