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
	<div class="sec-separator">
		<?php if($settings['icons_disable']): ?> 
			<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>  
		<?php endif; ?>	    
	</div>
