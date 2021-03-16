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

if ( !empty( $data['cat'] ) ) {
	$blog_permalink = get_category_link( $data['cat'] );
}
else {
	$blog_page = get_option( 'page_for_posts' );
	$blog_permalink = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
}
?>
<?php if ( $query->have_posts() ) :?>
	<div class="woocuepost-4 owl-wrap">
		<div class="custom-nav-1">
			<div class="owl-custom-nav custom-nav-1-inner">
				<div class="owl-prev"><i class="fa fa-angle-left"></i></div><h3 class="custom-nav-1-title"><?php echo esc_html( $data['title'] );?></h3><div class="owl-next"><i class="fa fa-angle-right"></i></div>
			</div>
			<a class="custom-nav-1-subtitle" href="<?php echo esc_url( $blog_permalink ); ?>"><?php esc_html_e( 'View All', 'esell-elements' )?></a>
		</div>
		<div class="owl-theme owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$content = Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'] );
				?>
				<div class="woocue-item">
					<?php if ( has_post_thumbnail() ): ?>
						<a class="woocue-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
					<?php else: ?>
						<a class="woocue-thumb" href="<?php the_permalink(); ?>"><img src="<?php echo Helper::get_img( 'nothumb-size3.jpg' );?>"></a>
					<?php endif; ?>
					<div class="woocue-content">
						<h3 class="woocue-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="woocue-meta">
							<span class="woocue-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
							<span class="woocue-sep">/</span>
							<?php the_author_posts_link(); ?>
						</div>
						<div class="woocue-text"><?php echo esc_html( $content );?></div>
					</div>
				</div>
			<?php endwhile;?>
		</div>
	</div>
<?php else: ?>
	<div><?php esc_html_e( 'Currently there are no posts', 'esell-elements' ); ?></div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>