<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-list/view.php
 * 
 * @author  Axiltheme
 * @since   1.0
 * @version 1.0
 */



$thumb_size = array( 158, 155 );

$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );

$hide_empty_category       = $settings['hide_empty_category'] ? $settings['hide_empty_category'] : 0;
$cate_list 					= $settings['select_categories'];
$number 					= $settings['number'];
$show_product_count        	= $settings['product_count'];
$product_text        		= $settings['product_text'];
$button_text        		= $settings['button_text'];
$cat_image_show 		    = $settings['cat_image_show'];
$show_description           = $settings['show_description'];
$parent_cat = array(
	'parent' => 0,
);
$filter_cat_arg = array(
	'include'    => $cate_list,
);
$cat_arg = array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => 1,
	'orderby'    => 'date',
	'order'      => 'DESC',
	'number'     => $number,
);

$cat_args    = array_merge( $cat_arg, $filter_cat_arg, $parent_cat );
$product_categories   = get_categories( $cat_args );

?>
<div class="wooc-category-layout-wrp">
	<div class="woocue-items owl-theme owl-custom-nav-<?php echo esc_attr( $settings['nav_style'] );?> owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">
	<?php 
		foreach ($product_categories as $product_category) :
		$cat_thumb = get_term_meta($product_category->term_id, 'thumbnail_id', true);	
		$cat_thumnail_url  = wp_get_attachment_image( $cat_thumb, array( 120, 120 ) ); 
		//$cat_thumnail_url = wp_get_attachment_url($cat_thumb);

		?>
		<div class="items">				
			<div class="items-wrp">
				<div class="overlay-right">
		                <h3><a href="<?php echo get_term_link($product_category->term_id);?>"><?php echo esc_html( $product_category->name );?></a>	</h3>	
						<?php if ( $button_text ): ?>
							<a href="<?php echo get_term_link($product_category->term_id);?>" class="">
						<?php echo esc_html( $button_text );?></a>
						<?php endif; ?>
			        </div>
				<div class="woocue-thumb">
					<?php echo wp_kses_post( $cat_thumnail_url );?>
					<div class="woocue-icon"><a href="<?php echo get_term_link($product_category->term_id);?>"><i class="fas fa-link"></i></a></div>
				</div>
			 <div class="overlay">              
				<?php if (true == $show_product_count): ?>					
					<h5 class="product-count"><?php echo esc_html( $product_category->count ); ?>&nbsp;<?php echo esc_html( $product_text ); ?></h5>
				<?php endif; ?>
				<?php if ($show_description == true):?>
					<p class="card-txt"><?php echo esc_html( $product_category->description );?></p>
				<?php endif; ?>				
	         </div>
		    </div>
		</div>
		<?php 	
	endforeach; ?>
	</div>
</div>
<?php 
wp_reset_postdata();?>
