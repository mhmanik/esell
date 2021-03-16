<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */
trait advertisementsTrait
{

    public static function ad_post_header_mid()
    {
        $axil_options = self::axil_get_options();
        if ($axil_options['ad_post_header_mid_activate']) {
            if ($axil_options['ad_post_header_mid_type'] == 'code') {
                print(($axil_options['ad_post_header_mid_code']));
            } else if ($axil_options['ad_post_header_mid_type'] == 'image' && !empty ($axil_options['ad_post_header_mid_image']['url'])) { ?>
                <div class="banner-add text-right ads-container">
                    <?php if ($axil_options['ad_post_header_mid_url']) { ?>
                        <a class="before-content-ad-color" <?php if ($axil_options['ad_post_header_mid_link_type'] == 'blank') { ?> target="_blank"<?php } ?>
                           href="<?php echo esc_url($axil_options['ad_post_header_mid_url']); ?>">
                            <img src="<?php echo esc_url($axil_options['ad_post_header_mid_image']['url']); ?>"
                                 alt="<?php esc_attr(bloginfo('name')); ?>"></a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url($axil_options['ad_post_header_mid_image']['url']); ?>"
                             alt="<?php esc_attr(bloginfo('name')); ?>">
                    <?php } ?>
                </div>
            <?php }
        }
    }

    public static function ad_post_before_content()
    {
        $axil_options = self::axil_get_options();
        if ($axil_options['ad_post_before_content_activate']) {
            if ($axil_options['ad_post_before_content_type'] == 'code') {
                print(($axil_options['ad_post_before_content_code']));
            } else if ($axil_options['ad_post_before_content_type'] == 'image' && !empty ($axil_options['ad_post_before_content_image']['url'])) { ?>
                <div class="ads-container mb--30">
                    <?php if ($axil_options['ad_post_before_content_url']) { ?>
                        <a class="before-content-ad-color" <?php if ($axil_options['ad_post_before_content_link_type'] == 'blank') { ?> target="_blank"<?php } ?>
                           href="<?php echo esc_url($axil_options['ad_post_before_content_url']); ?>">
                            <img src="<?php echo esc_url($axil_options['ad_post_before_content_image']['url']); ?>"
                                 alt="<?php esc_attr(bloginfo('name')); ?>"></a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url($axil_options['ad_post_before_content_image']['url']); ?>"
                             alt="<?php esc_attr(bloginfo('name')); ?>">
                    <?php } ?>
                </div>
            <?php }
        }
    }

    public static function ad_post_after_content()
    {
        $axil_options = self::axil_get_options();
        if ($axil_options['ad_post_after_content_activate']) {
            if ($axil_options['ad_post_after_content_type'] == 'code') {
                print(($axil_options['ad_post_after_content_code']));
            } else if ($axil_options['ad_post_after_content_image']['url'] && $axil_options['ad_post_after_content_type'] == 'image') { ?>
                <div class="ads-container mt--30">
                    <?php if ($axil_options['ad_post_after_content_url']) { ?>
                        <a class="after-content-ad-color"
                           target="<?php if ($axil_options['ad_post_after_content_link_type'] == 'blank') { ?>_blank<?php } ?>"
                           href="<?php echo esc_url($axil_options['ad_post_after_content_url']); ?>">
                            <img src="<?php echo esc_url($axil_options['ad_post_after_content_image']['url']); ?>"
                                 alt="<?php esc_attr(bloginfo('name')); ?>">
                        </a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url($axil_options['ad_post_after_content_image']['url']); ?>"
                             alt="<?php esc_attr(bloginfo('name')); ?>">
                    <?php } ?>
                </div>
            <?php }

        }
    }

    public static function ad_post_before_sidebar()
    {
        $axil_options = self::axil_get_options();
        if ($axil_options['ad_post_before_sidebar_activate']) {
            if ($axil_options['ad_post_before_sidebar_type'] == 'code') {
                print(($axil_options['ad_post_before_sidebar_code']));
            } else if ($axil_options['ad_post_before_sidebar_type'] == 'image' && !empty ($axil_options['ad_post_before_sidebar_image']['url'])) { ?>

                <div class="ads-container mb--65 mt_sm--30 mt_md--30">
                    <?php if ($axil_options['ad_post_before_sidebar_url']) { ?>
                        <a class="before-content-ad-color"
                            <?php if ($axil_options['ad_post_before_sidebar_link_type'] == 'blank') { ?> target="_blank"<?php } ?>
                           href="<?php echo esc_url($axil_options['ad_post_before_sidebar_url']); ?>">
                            <img src="<?php echo esc_url($axil_options['ad_post_before_sidebar_image']['url']); ?>"
                                 alt="<?php esc_attr(bloginfo('name')); ?>">
                        </a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url($axil_options['ad_post_before_sidebar_image']['url']); ?>"
                             alt="<?php esc_attr(bloginfo('name')); ?>">
                    <?php } ?>
                </div>
            <?php }

        }
    }

    public static function ad_post_after_sidebar()
    {
        $axil_options = self::axil_get_options();
        if ($axil_options['ad_post_after_sidebar_activate']) {
            if ($axil_options['ad_post_after_sidebar_type'] == 'code') {
                print(($axil_options['ad_post_after_sidebar_code']));
            } else if ($axil_options['ad_post_after_sidebar_image']['url'] && $axil_options['ad_post_after_sidebar_type'] == 'image') { ?>
                <div class="ads-container mt--65 mt_sm--30 mt_md--30">
                    <?php if ($axil_options['ad_post_after_sidebar_url']) { ?>
                        <a class="after-content-ad-color"
                            <?php if ($axil_options['ad_post_after_sidebar_link_type'] == 'blank') { ?> target="_blank"<?php } ?>
                           href="<?php echo esc_url($axil_options['ad_post_after_sidebar_url']); ?>">
                            <img src="<?php echo esc_url($axil_options['ad_post_after_sidebar_image']['url']); ?>"
                                 alt="<?php esc_attr(bloginfo('name')); ?>"></a>
                    <?php } else { ?>
                        <img src="<?php echo esc_url($axil_options['ad_post_after_sidebar_image']['url']); ?>"
                             alt="<?php esc_attr(bloginfo('name')); ?>">
                    <?php } ?>

                </div>
            <?php }

        }
    }

}