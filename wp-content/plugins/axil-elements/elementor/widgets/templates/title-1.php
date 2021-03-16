<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="section-title-wrapper text-center mb--55">
    <div class="row justify-content-lg-center">
        <div class="col-lg-5">
        	<?php  if($settings['sub_title']){ ?>
            	<span class="title-highlighter mb--10"><?php echo wp_kses_post( $settings['sub_title'] );?></span>
            <?php  } ?>	
            <?php  if($settings['title']){ ?>
            	<<?php echo esc_html( $settings['sec_title_tag'] );?> class="woocue-sec-title"><?php echo wp_kses_post( $settings['title'] );?></<?php echo esc_html( $settings['sec_title_tag'] );?>>	
            <?php  } ?>	
        </div>
    </div>
</div>
