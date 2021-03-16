<?php
/**
 * @author  axiltheme
 * @since   1.0
 * @version 1.0
 */


if ( is_product() ) {
	
?>
<div id="primary" class="axil-shop-area axil-section-gap bg-color-white">
	<div class="container-fluid no-gutters">
		<div class="row no-gutters">
			<?php Helper::wooc_axil_left_get_sidebar();?>
			<div class="<?php Helper::wooc_the_layout_class();?>">
				<div class="main-content">
	<?php }else{?>
		<div id="primary" class="axil-shop-area axil-section-gap bg-color-white">
	<?php if ( is_shop() )
	 { 
	 	$axil_options           = Helper::axil_get_options();
		$shop_content_layout = $axil_options['shop_content_layout'] ? 'container-fluid' : 'container';
		?>
		<div class="<?php echo esc_attr( $shop_content_layout );?>">	
			<?php }else{?>
				<div class="container">
				<?php } ?>
			<div class="row">
				<?php Helper::wooc_axil_left_get_sidebar();?>
				<div class="<?php Helper::wooc_the_layout_class();?>">
					<div class="main-content">
						<?php } ?>
					