<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

$axil_options = Helper::axil_get_options();
$thumb_size = ($axil_options['axil_blog_sidebar'] === 'no') ? 'axil-single-blog-thumb':'axil-blog-thumb';
$post_share_icon = (isset($axil_options['axil_show_post_share_icon'])) ? $axil_options['axil_show_post_share_icon'] : 'yes';
?>

<!-- Start Post List  -->
<div  id="post-<?php the_ID(); ?>" <?php post_class('content-blog  mt--60'); ?>>
    <div class="inner">
         <?php if(has_post_thumbnail()){ ?>
        <div class="post-thumbnail thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($thumb_size) ?>
            </a>
        </div>
    <?php } ?>       
        <div class="content">
            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>           
            <?php Helper::axil_postmeta(); ?>
            <p><?php the_excerpt();?></p>
            <div class="read-more-btn">
                <a class="axil-btn" href="<?php the_permalink();?>"><?php esc_html_e( 'Read More', 'esell' );?></a>
            </div>
        </div>
    </div>
</div>
<!-- End Post List  -->