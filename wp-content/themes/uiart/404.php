<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$bgimg = empty(WOOCTheme::$options['error_bgimg']['url']) ? Helper::get_img('404bg.jpg') : WOOCTheme::$options['error_bgimg']['url'];
$error_img = empty(WOOCTheme::$options['error_404img']['url']) ? Helper::get_img('404.png') : WOOCTheme::$options['error_404img']['url'];
?>
    <?php get_header(); ?>
    <div id="primary" class="content-area error-page-area"
         style="background-image: url( <?php echo esc_url($bgimg); ?> );">
        <div class="container">
            <div class="error-page">

                <div class="woocue-img"><img src="<?php echo esc_url($error_img); ?>"
                                             alt="<?php esc_attr_e('404', 'uiart'); ?>"></div>

                <?php if (WOOCTheme::$options['error_text_1']): ?>
                    <h2><?php echo esc_html(WOOCTheme::$options['error_text_1']); ?></h2>
                <?php endif; ?>

                <?php if (WOOCTheme::$options['error_text_2']): ?>
                    <h3><?php echo esc_html(WOOCTheme::$options['error_text_2']); ?></h3>
                <?php endif; ?>

                <?php if (WOOCTheme::$options['error_buttontext']): ?>
                    <div class="error-btn"><a
                                href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(WOOCTheme::$options['error_buttontext']); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>