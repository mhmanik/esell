<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

use Elementor\Group_Control_Image_Size;
?>

<div class="testimonial-section">
	<div class="testimonial-slider-2 owl-custom-nav-top owl-dots-layout1 <?php echo esc_attr( $settings['dots_style'] );?>">
		<div class="woocue-items owl-theme owl-custom-nav-<?php echo esc_attr( $settings['nav_style'] );?> owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">
			<?php foreach ( $settings['abc_testimonial'] as $testimonial ): 
				$has_star         = $testimonial['show_rating'] == 'yes' ? true : false;
				$has_designation  = $testimonial['designation'] == 'yes' ? true : false;			
				$designation  	  = $testimonial['designation'];
				$title  			= $testimonial['title'];
				$content  			= $testimonial['content'];
				$rating  			= $testimonial['rating'];
				$nonrating 		  	= 5 - (int)$rating ;							
				$size 				= 'thumbnail-sm';
				$img 				= wp_get_attachment_image( $testimonial['testimonial_image']['id'], $size );
				?>
				<div class="wooc-testimonial-item column-item">
					<?php if ($img) { ?>
						<div class="wooc-testimonial-image">								
								<?php echo wp_kses_post($img);?>
						</div>
					<?php } ?>	
					<div class="wooc-testimonial-inline">
						<div class="wooc-testimonial-content"> <?php echo esc_html($content);?></div>
						<div class="wooc-testimonial-meta-inner">
							<div class="wooc-testimonial-details">
								<div class="wooc-testimonial-name"><?php echo esc_html($title);?></div>
								<div class="wooc-testimonial-job"><?php echo esc_html($designation);?></div>								
							</div>
							<?php if ($has_star): ?>
								<ul class="rating-inline list-inline">
									<?php foreach (range(1, $rating) as $key): ?>
										<li class="has-rating list-inline-item"><i class="fa fa-star"></i></li>
									<?php endforeach; ?>
									<?php for ($i=1; $i <= $nonrating; $i++): ?>
										<li class="nonrating list-inline-item"><i class="fa fa-star"></i></li>
									<?php endfor; ?>
								</ul>
							<?php endif ?>
						</div>
					</div>
				</div>
				<?php  endforeach;?>	
			</div>
		</div>
	</div>