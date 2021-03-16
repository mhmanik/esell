<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package esell
 */
?>

<!-- End Page Wrapper -->
<?php 
$axil_options           = Helper::axil_get_options();
// Footer Top
$footer_top_layout 		= Helper::axil_footer_top_layout();
$footer_top_area 		= $footer_top_layout['footer_top_area'];
if( "no" != $footer_top_area && "0" != $footer_top_area && false != $footer_top_area && !is_404()){
    get_template_part('template-parts/footer/footer-top', 1);
}

?>
</div>
</div>
<!-- End main-content -->
<?php


// Footer
$footer_layout 			= Helper::axil_footer_layout();
$footer_area 			= $footer_layout['footer_area'];
$footer_style 			= $footer_layout['footer_style'];
if( "no" !== $footer_area && "0" !== $footer_area ){
    get_template_part('template-parts/footer/footer', $footer_style);
}

if($axil_options['axil_scroll_to_top_enable'] != 'no'){ ?>
    <!-- Start Back To Top  -->
    <a id="backto-top"></a>
    <!-- End Back To Top  -->
<?php }
wp_footer();
?>
</body>
</html>
