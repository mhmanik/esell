<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

$custom_link = axil_get_acf_data("axil_custom_link");
$link = !empty($custom_link) ? $custom_link : get_the_permalink();
$axil_options = Helper::axil_get_options();
$thumb_size = ($axil_options['axil_blog_sidebar'] === 'no') ? 'axil-single-blog-thumb':'axil-blog-thumb';
$post_share_icon = (isset($axil_options['axil_show_post_share_icon'])) ? $axil_options['axil_show_post_share_icon'] : 'yes';
?>
<!-- Start Post List  -->
<div  id="post-<?php the_ID(); ?>" <?php post_class('content-block post-list-view mt--30'); ?>>
    <?php if(has_post_thumbnail()){ ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($thumb_size) ?>
            </a>
        </div>
    <?php } ?>
    <div class="post-content">
        <?php Helper::axil_post_category_meta(); ?>
        <h4 class="title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
        <div class="post-meta-wrapper">

            <?php Helper::axil_postmeta(); ?>

            <?php if (function_exists('axil_sharing_icon_links') && $post_share_icon !== 'no') {
                axil_sharing_icon_links();
            } ?>

        </div>
    </div>
</div>
<!-- End Post List  -->