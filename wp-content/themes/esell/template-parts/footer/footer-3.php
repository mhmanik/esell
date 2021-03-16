<?php
/**
 * Template part for displaying footer layout three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$axil_footer_bottom_menu_args = Helper::axil_footer_bottom_menu_args();
$lineclass = (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5') || is_active_sidebar('footer-6')) ? "footer-menu-active" : "";
$allowed_tags = wp_kses_allowed_html( 'post' );
?>
<!-- Start Footer Area  -->
<div class="axil-footer-area axil-default-footer axil-footer-var-3 bg-color-white">

    <?php if(!empty($axil_options['axil_social_icons']) && !empty($axil_options['axil_footer_social_network'])){ ?>

    <!-- Start Footer Top Area  -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Start Post List  -->
                    <div class="inner d-flex align-items-center flex-wrap">
                        <?php if (!empty($axil_options['social_title'])){ ?>
                            <h5 class="follow-title mb--0 mr--20"><?php echo esc_html($axil_options['social_title']); ?></h5>
                        <?php } ?>

                        <ul class="social-icon color-tertiary md-size justify-content-start">
                            <?php
                            foreach ($axil_options['axil_social_icons'] as $key => $value) {
                                if ($value != '') {
                                    echo '<li><a class="' . esc_attr($key) . ' social-icon" href="' . esc_url($value) . '" title="' . esc_attr(ucwords(esc_attr($key))) . '" target="_blank"><i class="fab fa-' . esc_attr($key) . '"></i></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End Post List  -->
                </div>

            </div>
        </div>
    </div>
    <!-- End Footer Top Area  -->
    <?php } ?>

    <!-- Start Copyright Area  -->
    <div class="copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-9 col-lg-12 col-md-12">
                    <div class="copyright-left">
                        <div class="logo">
                            <?php if (isset($axil_options['axil_logo_type'])): ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>"
                                   title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">

                                    <?php if ('image' == $axil_options['axil_logo_type']): ?>

                                        <?php if($axil_options['axil_head_logo']){ ?>
                                            <img class="dark-logo" src="<?php echo esc_url( $axil_options['axil_head_logo']['url'] ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                        <?php } ?>
                                        <?php if($axil_options['axil_head_logo_white']){ ?>
                                            <img class="light-logo" src="<?php echo esc_url( $axil_options['axil_head_logo_white']['url'] ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                        <?php } ?>

                                    <?php else: ?>

                                        <?php if ('text' == $axil_options['axil_logo_type']): ?>

                                            <?php echo esc_html($axil_options['axil_logo_text']); ?>

                                        <?php endif ?>

                                    <?php endif ?>

                                </a>
                            <?php else: ?>

                                <h3>
                                    <a href="<?php echo esc_url(home_url('/')); ?>"
                                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                        <?php if (isset($axil_options['axil_logo_text']) ? $axil_options['axil_logo_text'] : '') {
                                            echo esc_html($axil_options['axil_logo_text']);
                                        } else {
                                            bloginfo('name');
                                        }
                                        ?>
                                    </a>
                                </h3>

                                <?php $description = get_bloginfo('description', 'display');

                                if ($description || is_customize_preview()) { ?>

                                    <p class="site-description"><?php echo esc_html($description); ?> </p>

                                <?php } ?>

                            <?php endif ?>

                        </div> <!-- End Logo-->
                        <?php if (has_nav_menu('footerbottom')) { ?>
                            <?php wp_nav_menu($axil_footer_bottom_menu_args); ?>
                        <?php } ?>
                    </div>
                </div>
                <?php if(!empty($axil_options['axil_copyright_contact'])){ ?>
                    <div class="col-xl-3 col-lg-12 col-md-12">
                        <div class="copyright-right text-left text-xl-right mt_lg--20 mt_md--20 mt_sm--20">
                            <p class="b3"><?php echo wp_kses( $axil_options['axil_copyright_contact'], $allowed_tags ); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</div>
<!-- End Footer Area  -->

