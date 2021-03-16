<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */

trait PostMeta
{
    public static function axil_postmeta(){
        $axil_options = Helper::axil_get_options();
        ?>
        <div class="axil-post-meta">
              <?php if ($axil_options['axil_show_blog_details_author_meta'] != 'no') { ?>
                <div class="post-author-avatar border-rounded">
                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                </div>
            <?php } ?>           
            <div class="post-meta-content">               
                <h6 class="author-title post-author-name">
                    <?php printf('<a class="hover-flip-item-wrapper" href="%1$s"><span class="hover-flip-item"><span data-text="%2$s">%2$s</span></span></a>', esc_url(get_author_posts_url(get_the_author_meta('ID', get_the_author_meta( 'ID' ) ))), get_the_author_meta('display_name', get_the_author_meta( 'ID' ))); ?>
                    
                </h6>
                         
                <ul class="post-meta-list">
                    <?php if ($axil_options['axil_show_post_publish_date_meta'] !== 'no') { ?>
                        <li class="post-meta-date"><?php echo get_the_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <li>300k Views</li>
                </ul>
            </div>
        </div> 
        <?php
    }


  // Single post meta
    public static function esell_singlepostmeta()
    {
        $axil_options = Helper::axil_get_options();
        ?>
        <div class="axil-post-meta">
            <?php if ($axil_options['axil_show_blog_details_author_meta'] != 'no') { ?>
                <div class="post-author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                </div>
             <?php } ?>
            <div class="post-meta-content">    
                 <?php
                if ($axil_options['axil_show_blog_details_author_meta'] != 'no') { ?>
                    <h6 class="author-title post-author-name"><?php printf('<a class="hover-flip-item-wrapper" href="%1$s"><span class="hover-flip-item"><span data-text="%2$s">%2$s</span></span></a>', esc_url(get_author_posts_url(get_the_author_meta('ID', get_the_author_meta( 'ID' ) ))), get_the_author_meta('display_name', get_the_author_meta( 'ID' ))); ?></h6>
                <?php } ?>
                <ul class="post-meta-list">                    
                      <?php if ($axil_options['axil_show_blog_details_publish_date_meta'] !== 'no') { ?>
                        <li class="post-meta-date"><?php echo get_the_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <li>300k Views</li>                    

                </ul>
            </div>
        </div>

    <?php }


    /**
     * axil_post_category_meta
     */
    public static function axil_post_category_meta($show = true){
        $axil_options = Helper::axil_get_options();
        if ( $show && $axil_options['axil_show_post_categories_meta'] !== 'no' && has_category()) {
            $categories = get_the_category();
            ?>
            <div class="post-cat">
                <div class="post-cat-list">
                    <?php
                    if ( ! empty( $categories ) ) {
                        foreach( $categories as $category ) { ?>
                            <a class="hover-flip-item-wrapper" href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>">
                                <span class="hover-flip-item"><span data-text="<?php echo esc_html( $category->name ) ?>"><?php echo esc_html( $category->name ) ?></span></span>
                            </a> <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }


    // Single post meta
    public static function axil_singlepostmeta()
    {
        $axil_options = Helper::axil_get_options();
        ?>

        <div class="post-meta">
            <?php if ($axil_options['axil_show_blog_details_author_meta'] != 'no') { ?>
                <div class="post-author-avatar border-rounded">
                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                </div>
            <?php } ?>
            <div class="content">
                <?php
                if ($axil_options['axil_show_blog_details_author_meta'] != 'no') { ?>
                    <h6 class="post-author-name"><?php printf('<a class="hover-flip-item-wrapper" href="%1$s"><span class="hover-flip-item"><span data-text="%2$s">%2$s</span></span></a>', esc_url(get_author_posts_url(get_the_author_meta('ID', get_the_author_meta( 'ID' ) ))), get_the_author_meta('display_name', get_the_author_meta( 'ID' ))); ?></h6>
                <?php } ?>
                <ul class="post-meta-list">
                    <?php if ($axil_options['axil_show_blog_details_publish_date_meta'] !== 'no') { ?>
                        <li class="post-meta-date"><?php echo get_the_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <?php if ($axil_options['axil_show_blog_details_updated_date_meta'] !== 'no') { ?>
                        <li class="post-meta-update-date"><?php echo the_modified_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <?php if ($axil_options['axil_show_blog_details_reading_time_meta'] !== 'no') { ?>
                        <li class="post-meta-reading-time"><?php echo esell_content_estimated_reading_time(get_the_content()); ?></li>
                    <?php } ?>
                    <?php if ($axil_options['axil_show_blog_details_comments_meta'] !== 'no') { ?>
                        <li class="post-meta-comments"><?php comments_popup_link(esc_html__('No Comments', 'esell'), esc_html__('1 Comment', 'esell'), esc_html__('% Comments', 'esell'), 'post-comment', esc_html__('Comments off', 'esell')); ?></li>
                    <?php } ?>
                    <?php if ($axil_options['axil_show_blog_details_tags_meta'] !== 'no' && has_tag()) { ?>
                        <li class="post-meta-tags"><?php the_tags(' ', ' '); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php }

    // Single post meta
    public static function axil_smallmeta($show_data = true, $show_read_time = true, $show_author_avatar = true, $show_author_name = true)
    {
        ?>
        <?php if($show_data || $show_read_time || $show_author_avatar || $show_author_name){ ?>
        <div class="post-meta">
            <?php if ($show_author_avatar) { ?>
                <div class="post-author-avatar border-rounded">
                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                </div>
            <?php } ?>
            <div class="content">
                <?php
                if ($show_author_name) { ?>
                    <h6 class="post-author-name"><?php printf('<a class="hover-flip-item-wrapper" href="%1$s"><span class="hover-flip-item"><span data-text="%2$s">%2$s</span></span></a>', esc_url(get_author_posts_url(get_the_author_meta('ID', get_the_author_meta( 'ID' ) ))), get_the_author_meta('display_name', get_the_author_meta( 'ID' ))); ?></h6>
                <?php } ?>
                <?php if($show_data || $show_read_time){ ?>
                    <ul class="post-meta-list">
                        <?php if ($show_data) { ?>
                            <li class="post-meta-date"><?php echo get_the_time(get_option('date_format')); ?></li>
                        <?php } ?>
                        <?php if ($show_read_time) { ?>
                            <li class="post-meta-reading-time"><?php echo esell_content_estimated_reading_time(get_the_content()); ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

    <?php }

    public static function axil_smallmeta_for_single_post()
    {
        $axil_options = Helper::axil_get_options();
        ?>
        <div class="post-meta">
            <?php if ($axil_options['axil_show_post_author_meta'] != 'no') { ?>
                <div class="post-author-avatar border-rounded">
                    <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                </div>
            <?php } ?>
            <div class="content">
                <?php
                if ($axil_options['axil_show_post_author_meta'] != 'no') { ?>
                    <h6 class="post-author-name"><?php printf('<a class="hover-flip-item-wrapper" href="%1$s"><span class="hover-flip-item"><span data-text="%2$s">%2$s</span></span></a>', esc_url(get_author_posts_url(get_the_author_meta('ID', get_the_author_meta( 'ID' ) ))), get_the_author_meta('display_name', get_the_author_meta( 'ID' ))); ?></h6>
                <?php } ?>
                <ul class="post-meta-list">
                    <?php if ($axil_options['axil_show_blog_details_publish_date_meta'] !== 'no') { ?>
                        <li class="post-meta-date"><?php echo get_the_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <?php if ($axil_options['axil_show_blog_details_reading_time_meta'] !== 'no') { ?>
                        <li class="post-meta-reading-time"><?php echo esell_content_estimated_reading_time(get_the_content()); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php
    }

    public static function axil_read_more()
    {
        $axil_options = Helper::axil_get_options();
        if ($axil_options['axil_enable_readmore_btn'] !== 'no') { ?>
            <a class="axil-button btn-large btn-transparent" href="<?php the_permalink(); ?>"><span
                        class="button-text"><?php echo esc_html($axil_options['axil_readmore_text'], 'esell') ?></span><span
                        class="button-icon"></span></a>
        <?php }
    }
}



