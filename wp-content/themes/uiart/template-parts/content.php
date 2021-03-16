<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$thumb_size      = Helper::has_sidebar() ? 'wooctheme-850x460' : 'wooctheme-1300x600';
$has_entry_meta  = ( !has_post_thumbnail() && WOOCTheme::$options['blog_date'] ) ||( !has_post_thumbnail() && WOOCTheme::$options['blog_cats'] && has_category() ) || WOOCTheme::$options['blog_author_name'] || WOOCTheme::$options['blog_comment_num'] ? true : false;

$comments_number = get_comments_number();
$comments_text   = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'uiart' ), number_format_i18n( $comments_number ) );
$post_id          = get_the_ID();
$author           = $post->post_author;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-post-wrp loop-post-wrp-1' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink();?>">
				<?php the_post_thumbnail( $thumb_size );?>				
			</a>
		</div>
	<?php endif; ?>
	<div class="post-content-area">
		<?php if ( has_post_thumbnail() && WOOCTheme::$options['blog_cats'] && has_category() ): ?>
			<div class="post-top-cats"><?php the_category( ' ' );?></div>
		<?php endif; ?>
		<h2 class="post-title"><a href="<?php the_permalink();?>" class="entry-title" rel="bookmark"><?php the_title();?></a></h2>
		<?php if ( $has_entry_meta ): ?>
			<ul class="post-meta">
				<?php if ( WOOCTheme::$options['blog_date'] ): ?>
					<li><i class="fas fa-calendar-alt"></i><span class="updated published"><?php the_time( get_option( 'date_format' ) );?></span></li>
				<?php endif; ?>				
				<?php if ( WOOCTheme::$options['blog_comment_num'] ): ?>
					<li><i class="fas fa-comments"></i><span><?php echo esc_html( $comments_text );?></span></li>
				<?php endif; ?>
				<?php if ( WOOCTheme::$options['blog_cats'] && has_category() ): ?>
					<li><i class="fas fa-tags"></i><?php the_category( ', ' );?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<div class="post-content entry-summary"><?php the_excerpt();?></div>		
		<div class="post-content-footer">
			<?php if ( WOOCTheme::$options['blog_author_name'] ): ?>
	            <div class="post-author">                                
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID', $author))) ?>"
                   class="post-author post-author-with-img">
                    <?php
                    $args = array('class' => 'rounded-circle');
                    echo get_avatar(get_the_author_meta('ID'), 30, '', '', $args); ?>
                    <?php esc_html_e( 'By', 'uiart' );?>
                    <span><?php echo get_the_author_meta('display_name', $author); ?></span>
                </a>                                
	          </div>  
			<?php endif; ?>
			<a href="<?php the_permalink();?>" class="read-more-btn"><?php esc_html_e( 'Read More', 'uiart' );?></a>
		</div>
	</div>
</article>