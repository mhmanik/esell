<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>
<div class="feature-tip"> 
	<div class="feature-img-holder">		  		
		<div class="wooc-img-map wooc-pos-<?php echo esc_attr( $settings['pos_y_type'] );?> wooc-pos-<?php echo esc_attr( $settings['pos_x_type'] );?>  wooc-map-<?php echo esc_attr( $settings['img_map_active'] );?> ">
			<span class="wooc-img-map-hover"><i class="flaticon-qr-code-scan"></i></span>
			<div class="media">
				<div class="item-img">
					<?php  echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' ); ?>
				</div>
				<div class="media-body">
					<h3 class="title"><?php echo esc_attr( $settings['tag_info_title'] );?></h3>
					<p class="item-ctg"><?php echo esc_attr( $settings['tag_info_contact'] );?></p>
				</div>
			</div>	
		</div>			
	</div>
</div>