<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use axiltheme\eSell\Helper;

$thumb_size = 'axiltheme-size3';
$query = $data['query'];
?>
<?php if ( $query->have_posts() ) :?>
<div class="woocuepost-3">
	<div class="woocue-sec-title-area">
		<h3 class="woocue-sec-title"><?php echo esc_html( $data['title'] );?></h3>
		<?php if ( $data['subtitle'] ): ?>
			<h4 class="woocue-sec-subtitle"><?php echo esc_html( $data['subtitle'] );?></h4>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$content = Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'] );
			?>
			<div class="col-md-4 col-12">
				<div class="woocue-item">
					<?php if ( has_post_thumbnail() ): ?>
						<a class="woocue-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
					<?php else: ?>
						<a class="woocue-thumb" href="<?php the_permalink(); ?>"><img src="<?php echo Helper::get_img( 'nothumb-size3.jpg' );?>"></a>
					<?php endif; ?>
					<div class="woocue-content">
						<div class="woocue-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
						<h3 class="woocue-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="woocue-author"><?php esc_html_e( "Posted by", 'esell-elements' );?> <?php the_author_posts_link(); ?></div>
						<div class="woocue-text"><?php echo esc_html( $content );?></div>
					</div>
				</div>
			</div>
		<?php endwhile;?>
	</div>
</div>
<?php else: ?>

	<div><?php esc_html_e( 'Currently there are no posts', 'esell-elements' ); ?></div>

<?php endif;?>
<?php wp_reset_postdata();?>