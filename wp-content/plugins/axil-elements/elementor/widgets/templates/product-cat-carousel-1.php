<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-list/view.php
 * 
 * @author  Axiltheme
 * @since   1.0
 * @version 1.0
 */

namespace axiltheme\esell_elements;

$thumb_size = array( 158, 155 );
$shop_permalink = get_permalink( wc_get_page_id( 'shop' ) );
$hide_empty_category       = $settings['hide_empty_category'] ? $settings['hide_empty_category'] : 0;
$sub_title       = $settings['sub_title'] ? ' sub_title' : ' no-sub_title';


$cate_list 					= $settings['select_categories'];
$number 					= $settings['number'];
$show_product_count        	= $settings['product_count'];
$product_text        		= $settings['product_text'];
$button_text        		= $settings['button_text'];
$cat_image_show 		    = $settings['cat_image_show'];
$show_description       	= $settings['show_description'];
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

<div class="axil-categorie-area axil-section-gap pb--0 bg-color-white owl-nav-po-<?php echo esc_attr( $settings['nav_style'] );?> <?php echo esc_attr( $sub_title );?>">

	<?php if ( $settings['section_title_display'] ): ?>
		<div class="section-title-wrapper mb--70">
			<?php if ( $settings['sub_title'] ): ?>
		    <span class="title-highlighter mb--10"><?php echo wp_kses_post( $settings['sub_title'] );?></span>
		    	<?php endif; ?>	
		    <h3 class="mb--25"><?php echo wp_kses_post( $settings['title'] );?></h3>
		</div>
	<?php endif; ?>

     <div class="categrie-product-activation slick-layout-wrapper--20 axil-slick-arrow  arrow-top-slide">
		<div class="owl-theme owl-custom-nav-middle owl-carousel wooc-owl-carousel" data-carousel-options="<?php echo esc_attr( $settings['owl_data'] );?>">
		<?php 
			foreach ($product_categories as $product_category) :
			$cat_thumb = get_term_meta($product_category->term_id, 'thumbnail_id', true);	
			$cat_thumnail_url  = wp_get_attachment_image( $cat_thumb, array( 120, 120 ) ) 
			//$cat_thumnail_url = wp_get_attachment_url($cat_thumb);
			?>
			 <div class="slick-single-layout">
                <div class="categrie-product">
                    <a href="<?php echo get_term_link($product_category->term_id);?>">
                      	<?php echo wp_kses_post( $cat_thumnail_url );?>
                        <h6 class="cat-title"><?php echo esc_html( $product_category->name );?></h6>
                    </a>
                </div>
                <!-- End .categrie-product -->
            </div>
			<?php 	
		endforeach; ?>
		</div>
	</div>
</div>
<?php 
wp_reset_postdata();?>



