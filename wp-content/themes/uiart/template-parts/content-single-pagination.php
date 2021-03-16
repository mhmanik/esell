<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$previous = get_previous_post();
$next = get_next_post();
?>
<div class="single-post-pagination">
	<div class="woocue-left woocue-item">
		<?php if ( $previous ): ?>
			<?php if ( has_post_thumbnail( $previous ) ): ?>
				<div class="woocue-thumb"><a href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><?php echo get_the_post_thumbnail( $previous, 'thumbnail' ); ?><div class="woocue-icon"><i class="flaticon-plus-symbol"></i></div></a></div>
			<?php endif; ?>

			<div class="woocue-content">
				<h3 class="woocue-title"><a href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><?php echo get_the_title( $previous ); ?></a></h3>
				<div class="woocue-date"><i class="fas fa-history"></i><?php echo esc_html( get_post_time( get_option( 'date_format' ), false, $previous ) ); ?></div>
				<a class="woocue-link" href="<?php echo esc_url( get_permalink( $previous ) ); ?>"><i class="fa fa-angle-left"></i><?php echo esc_html_e( 'Previous Post', 'uiart' );?></a>
			</div>
		<?php endif; ?>
	</div>
	<div class="woocue-right woocue-item">
		<?php if ( $next ): ?>
			<div class="woocue-content">
				<h3 class="woocue-title"><a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo get_the_title( $next ); ?></a></h3>
				<div class="woocue-date"><?php echo esc_html( get_post_time( get_option( 'date_format' ), false, $next ) ); ?><i class="fas fa-history"></i></div>
				<a class="woocue-link" href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo esc_html_e( 'Next Post', 'uiart' );?><i class="fa fa-angle-right"></i></a>
			</div>
			<?php if ( has_post_thumbnail( $next ) ): ?>
				<div class="woocue-thumb"><a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo get_the_post_thumbnail( $next, 'thumbnail' ); ?><div class="woocue-icon"><i class="flaticon-plus-symbol"></i></div></a></div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>