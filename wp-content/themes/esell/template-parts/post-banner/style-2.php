<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$axil_single_blog_sidebar_class = ($axil_options['axil_single_pos'] === 'full')  || !is_active_sidebar( 'sidebar-1' )? 'col-lg-8 offset-lg-2':'col-lg-8 col-md-12 col-12';
$alignwide = ($axil_options['axil_single_pos'] === 'full')  || !is_active_sidebar( 'sidebar-1' )? 'wp-block-image alignwide':'';


$images = axil_get_acf_data('axil_gallery_image');
$audio_url = axil_get_acf_data('axil_upload_audio');
$custom_link = axil_get_acf_data('axil_custom_link');

$link = !empty($custom_link) ? $custom_link : get_the_permalink();
$axil_quote_author_name = axil_get_acf_data("axil_quote_author_name");
$axil_quote_author = !empty($axil_quote_author_name) ? $axil_quote_author_name : get_the_author();
$axil_quote_author_name_designation = axil_get_acf_data("axil_quote_author_name_designation");
$video_url = axil_get_acf_data("axil_video_link");
$axil_options = Helper::axil_get_options();

$thumb_size = 'axil-single-blog-thumb';

?>

<!-- Start Banner Area -->
<div class="banner banner-single-post post-formate post-standard">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Single Slide  -->
                <div class="content-block">
                    <?php
                    if (has_post_thumbnail()) { ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail($thumb_size) ?>
                        </div>
                    <?php } ?>
                    <!-- Start Post Content  -->
                    <div class="post-content">
                        <?php if ($axil_options['axil_show_blog_details_categories_meta'] !== 'no' && has_category()) { ?>
                            <?php Helper::axil_post_category_meta(); ?>
                        <?php } ?>
                        <h1 class="title"><?php the_title(); ?></h1>
                        <!-- Post Meta  -->
                        <div class="post-meta-wrapper">
                            <?php Helper::axil_singlepostmeta(); ?>
                            <?php if($axil_options['axil_blog_details_social_share_for_top']){
                                if (function_exists('axil_sharing_icon_links')) {
                                    axil_sharing_icon_links();
                                }
                            } ?>
                        </div>
                    </div>
                    <!-- End Post Content  -->
                </div>
                <!-- End Single Slide  -->
            </div>
        </div>
    </div>
</div>
<!-- End Banner Area -->
<?php if ("hide" !== $axil_options['axil_enable_single_post_breadcrumb_wrap']) { ?>
    <!-- End Banner Area -->
    <div class="breadcrumb-wrapper">
        <div class="container">
            <!-- End Single Slide  -->
            <?php axil_breadcrumbs(); ?>
        </div>
    </div>
<?php }
