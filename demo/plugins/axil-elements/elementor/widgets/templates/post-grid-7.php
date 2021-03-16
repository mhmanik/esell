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
	<div class="woocuepost-7">
		<?php if ( $data['title'] ): ?>
			<div class="wooc-sec-title-area-1 no-after-style">
				<h3 class="woocue-sec-title"><?php echo esc_html( $data['title'] );?></h3>
				
				<?php if ( $data['title_right_link_text'] ): ?>
					<div class="woocue-viewall"><a href="<?php echo esc_url( $blog_permalink ); ?>"><?php echo esc_html( $data['title_right_link_text'] );?>
					<i class="flaticon-arow"></i></a></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="row">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$content = Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'] );
				?>
				<div class="col-md-4 col-12">
					<div class="woocue-item elementwidth elwidth-300">
						<div class="woocue-thumb-area">
							<?php if ( has_post_thumbnail() ): ?>
								<a class="woocue-thumb esell-scale-animation" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( $thumb_size ); ?>										
								</a>
							<?php else: ?>
								<a class="woocue-thumb esell-scale-animation" href="<?php the_permalink(); ?>">
									<img src="<?php echo Helper::get_img( 'nothumb-size3.jpg' );?>">
								</a>
							<?php endif; ?>
							<div class="woocue-date">
								<div class="woocue-d1"><?php the_time( 'd' ); ?></div>
								<div class="woocue-d2"><?php the_time( 'M' ); ?></div>
							</div>
						</div>
						<div class="woocue-content">
							<div class="woocue-cats"><?php the_category( ', ' );?></div>
							<h3 class="woocue-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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