<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
$logo = empty(WOOCTheme::$options['logo']['url']) ? Helper::get_img('logo-dark.png') : WOOCTheme::$options['logo']['url'];
?>
    <div class="header-main-block">
        <div class="header-search-area">
            <div class="site-logo icon-left-logo">
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr(bloginfo('name')); ?>">
                </a>
            </div>
            <div class="container-wrp">
                <div class="container-fluid">
                    <div class="row gap10 align-items-center">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6 d-none icon-left-logo">
                            <div class="site-logo menu-icon">
                                <?php  
                                    get_template_part( 'template-parts/header/icon', 'menu2' );
                                ?>
                                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr(bloginfo('name')); ?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-5 d-none d-md-block">
                            <?php get_template_part('template-parts/header/header-search2'); ?>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-8 col-6">
                           <?php get_template_part( 'template-parts/header/icon', 'area-mid' );?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('template-parts/vertical-menu'); ?>