<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use axiltheme\eSell\Helper;

$thumb_size = 'axiltheme-size3';
$query = $settings['query'];

if ( !empty( $settings['cat'] ) ) {
	$blog_permalink = get_category_link( $settings['cat'] );
}
else {
	$blog_page = get_option( 'page_for_posts' );
	$blog_permalink = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
}
?>

<?php if ( $query->have_posts() ) :?>
	<div class="woocuepost-1">
	<?php if ( $settings['section_title_display'] ): ?>
		<div class="wooc-slider-title-block-1">
			<div class="wooc-title-block">
				<div class="woocue-sub-title"><?php echo wp_kses_post( $settings['sub_title'] );?></div>
				<div class="clear"></div>
				<h3 class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></h3>
			</div>	
			<?php if ( $settings['islink'] ): ?>
				<div class="woocue-view-btn wooc-btn-ctg-icon">
					<a class="wooc-btn" href="<?php echo esc_url( $blog_permalink ); ?>"><?php echo wp_kses_post( $settings['btntext'] );?><i class="flaticon-play-button"></i></a>
				</div>		
			<?php endif; ?>		
		</div>
	<?php endif; ?>
		<div class="row">
			<?php while ( $query->have_posts() ) : $query->the_post();?>
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