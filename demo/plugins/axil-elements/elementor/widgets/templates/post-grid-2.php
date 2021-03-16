<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */


namespace axiltheme\esell_elements;

use axiltheme\eSell\Helper;

$thumb_size = 'axiltheme-400x240';
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
	<div class="woocuepost-2">
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
						<div class="woocue-thumb-wrp">						
							<?php if ( has_post_thumbnail() ): ?>
								<a class="woocue-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
							<?php else: ?>
								<a class="woocue-thumb" href="<?php the_permalink(); ?>">
									<img src="<?php echo Helper::get_img( 'nothumb-size3.jpg' );?>">
								</a>
							<?php endif; ?>
							<div class="woocue-date">
								<div class="postdate">
									<div class="day d-<?php the_time('j') ?>"><?php the_time('j') ?></div> 					
									<div class="month m-<?php the_time('m') ?>"><?php the_time('M') ?></div>
								</div>								
							</div>
						</div>
						<div class="woocue-content">
							<div class="woocue-content-meta">
								<div class="woocue-author"><i class="fas fa-user-tie"></i> <?php esc_html_e( "By", 'esell-elements' );?> <?php the_author_posts_link(); ?></div>
								<div class="dividar">/</div>
								<div class="woocue-cats"><i class="fas fa-tags"></i> <?php the_category( ', ' );?></div>
							</div>
							<h3 class="woocue-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	
						</div>					
				</div>
				</div>
			<?php endwhile;?>
		</div>
	
<?php else: ?>
	<div><?php esc_html_e( 'Currently there are no posts', 'esell-elements' ); ?></div>
<?php endif;?>
</div>
<?php wp_reset_postdata();?>