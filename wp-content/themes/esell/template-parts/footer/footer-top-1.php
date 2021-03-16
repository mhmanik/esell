<?php
/**
 * Template part for displaying footer top layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
// Get data from page option
$op_footer_top_area        = axil_get_acf_data('axil_show_footer_top');
// Get data from theme option
$ot_footer_top_area         = $axil_options['axil_footer_top_enable'];

if (empty($op_footer_top_area)){
    $subtitle                   = (!empty($axil_options['axil_ft_sub_title'])) ? $axil_options['axil_ft_sub_title'] : "";
    $title                   = (!empty($axil_options['axil_ft_title'])) ? $axil_options['axil_ft_title'] : "";
    $shortcode                   = (!empty($axil_options['axil_ft_shortcode'])) ? $axil_options['axil_ft_shortcode'] : "";
} else {
    $title                  = axil_get_acf_data("axil_footer_top_title");
    $subtitle                  = axil_get_acf_data("axil_footer_top_sub_title");
    $shortcode              = axil_get_acf_data("axil_footer_top_shortcode");
}
?>

<div class="container">
<div class="esell-newsletter-wrapper mt--50 bg_image bg_image--5">
    <div class="newsletter-content">
        <span class="title-highlighter mb--10"><?php echo esc_html($subtitle); ?></span>
        <h3 class="mb--40 mb_sm--30"><?php echo esc_html($title); ?></h3>
        <?php //if(!empty($shortcode)){ ?>
            <?php //echo do_shortcode($shortcode); ?>
        <?php // } ?>
        <div class="input-group newsletter-form">
            <div class="position-relative newsletter-inner mb--15">
                <img class="send-mail-icon" src="<?php echo get_template_directory_uri();?>/assets/images/send-mail.png" alt="send mail icon">
                <input placeholder="rafayel@axilweb.com" type="text">
            </div>
            <button type="submit" class="axil-btn mb--15">Subscribe</button>
        </div>
    </div>
</div>
</div>
<!-- End newsletter sectoin -->