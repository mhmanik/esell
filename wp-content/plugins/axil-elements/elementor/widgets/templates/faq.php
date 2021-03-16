<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;
use Elementor\Group_Control_Image_Size;

?>
<div class="faq-sec-wrap">
  <div class="accordion">
	<?php foreach ( $settings['faq_items_content'] as $faq_items ):
	$tabActive =  wooc_unique_id('faq') . $faq_items['_id'] ;
	 ?>
	<div class="single-faq">			
		<div class="faq-header">
		  <button class="collapsed" type="button" data-toggle="collapse" data-target="#<?php echo esc_attr($tabActive);?>" aria-expanded="false" aria-controls="<?php echo esc_attr($tabActive);?>">
		   <span class="faq_title"><?php echo esc_attr($faq_items['faq_title']);?></span>
		  </button>
		</div>
		<!-- FAQ Body -->
		<div id="<?php echo esc_attr($tabActive);?>" class="collapse"  style="">
		  <div class="faq-body">
		    <p> <?php echo esc_attr($faq_items['faq_content']);?></p>
		  </div>
		</div>
	</div>
	<?php  endforeach;?>		
	</div>
</div>

