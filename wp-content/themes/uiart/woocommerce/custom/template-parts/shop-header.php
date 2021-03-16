<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

if ( is_product() ) {
?>
<div id="primary" class="content-area">
	<div class="container-fluid no-gutters">
		<div class="row no-gutters">
			<?php Helper::left_sidebar();?>
			<div class="<?php Helper::wooc_the_layout_class();?>">
				<div class="main-content">
	<?php }else{?>
		<div id="primary" class="content-area">
	<?php if ( is_shop() ) { 
		$shop_content_layout = WOOCTheme::$options['shop_content_layout'] ? 'container-fluid' : 'container';
		?>
		<div class="<?php echo esc_attr( $shop_content_layout );?>">	
			<?php }else{?>
				<div class="container">
				<?php } ?>
			<div class="row">
				<?php Helper::left_sidebar();?>
				<div class="<?php Helper::wooc_the_layout_class();?>">
					<div class="main-content">
						<?php } ?>
					