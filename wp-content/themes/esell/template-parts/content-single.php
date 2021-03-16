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

$sidebar = Helper::axil_sidebar_options();
$axil_single_blog_sidebar_class = ($sidebar === 'full')  || !is_active_sidebar( 'sidebar-1' )? 'col-lg-8':'col-lg-8 col-md-12 col-12';
$alignwide = ($sidebar === 'full')  || !is_active_sidebar( 'sidebar-1' )? 'wp-block-image alignwide':'';

$images = axil_get_acf_data('axil_gallery_image');
$audio_url = axil_get_acf_data('axil_upload_audio');
$custom_link = axil_get_acf_data('axil_custom_link');

$link = !empty($custom_link) ? $custom_link : get_the_permalink();
$axil_quote_author_name = axil_get_acf_data("axil_quote_author_name");
$axil_quote_author = !empty($axil_quote_author_name) ? $axil_quote_author_name : get_the_author();
$axil_quote_author_name_designation = axil_get_acf_data("axil_quote_author_name_designation");
$video_url = axil_get_acf_data("axil_video_link");
$thumb_size = 'axil-single-blog-thumb';
$header_layout = Helper::axil_post_banner_style();
$post_banner_style = $header_layout['post_banner_style'];

// Review
$review_area = axil_get_acf_data('axil_post_review_box');
$review_box_position = axil_get_acf_data('axil_post_review_box_position');
/**
 * Load Header
 */
if ($post_banner_style) {
    get_template_part('template-parts/post-banner/style', $post_banner_style);
}
?>
 <!-- Start Blog Area  -->
<div class="axil-blog-area  pt--60">
    <div class="axil-single-post post-formate post-standard">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-block">
                    <div class="inner">
                        <div class="post-content">
                            <h1 class="title"><?php the_title(); ?></h1>                            
                            <?php Helper::esell_singlepostmeta(); ?>                           
                        </div>
                        <!-- End .content -->
                         <?php  if (has_post_thumbnail()) { ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail($thumb_size, ['class' => 'w-100']) ?>
                            </div>
                        <?php } ?>                       
                        <!-- End .thumbnail -->
                    </div>
                </div>
                <!-- End .content-blog -->
            </div>
        </div>
    </div>
    <!-- End .single-post -->
            <div class="post-single-wrapper axil-section-gap">
                <div class="container">
                    <div class="row">
                        <?php if ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'left') { ?>
                        <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                            <div class="sidebar-inner">
                                <?php echo Helper::ad_post_before_sidebar(); ?>
                                    <?php dynamic_sidebar(); ?>
                                <?php echo Helper::ad_post_after_sidebar(); ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-8 axil-post-wrapper">
                            <?php if ($axil_options['axil_blog_details_social_share'] && function_exists('axil_sharing_icon_links_bottom')) {
                                axil_sharing_icon_links_bottom();
                            } ?>
                            
                            <?php echo Helper::ad_post_before_content(); ?>
                            <?php
                            if ($review_area && "above" == $review_box_position) {
                                get_template_part('template-parts/review/post-review');
                            }
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="axil-page-links"><span class="page-link-holder">' . esc_html__('Pages:', 'blogar') . '</span>',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                            ));
                            if ($review_area && "under" == $review_box_position) {
                                get_template_part('template-parts/review/post-review');
                            } ?>
                    <?php echo Helper::ad_post_after_content(); ?>                                                   
                 </div>
                <?php if ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'right') { ?>
                <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <div class="sidebar-inner">
                        <?php echo Helper::ad_post_before_sidebar(); ?>
                            <?php dynamic_sidebar(); ?>
                        <?php echo Helper::ad_post_after_sidebar(); ?>
                    </div>
                </div>
            <?php } ?>
            </div>
             <!-- Start Blog Author  -->
                <?php
                if ($axil_options['axil_blog_details_show_author_info']) {
                    get_template_part('template-parts/biography');
                }
                ?>
                <!-- End Blog Author  -->
                <?php

                /**
                 *  Output comments wrapper if it's a post, or if comments are open,
                 * or if there's a comment number – and check for password.
                 * */
                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                    ?>
                    <div class="axil-comment-area">
                        
                        <?php comments_template(); ?>

                    </div><!-- .comments-wrapper -->

                    <?php
                }

                ?>
        </div> 
    </div>
</div>
<?php
get_footer();