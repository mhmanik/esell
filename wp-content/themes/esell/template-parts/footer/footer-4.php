<?php
/**
 * Template part for displaying footer layout four
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$axil_footer_bottom_menu_args = Helper::axil_footer_bottom_menu_args();
$lineclass = (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) ? "footer-menu-active" : "";
$allowed_tags = wp_kses_allowed_html( 'post' );
?>
<footer class="axil-footer-area axil-default-footer axil-footer-var-4 bg-color-extra03 <?php echo esc_attr( $lineclass ); ?>">

    <?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ){ ?>
        <!-- Start Footer Top Area -->
        <div class="footer-mainmenu">
            <div class="container">
                <div class="row">
                    <?php if (is_active_sidebar('footer-1')) { ?>
                        <!-- Start Single Widget -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget-item axil-border-right">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                        </div><!-- End Single Widget -->
                    <?php } ?>

                    <?php if (is_active_sidebar('footer-2')) { ?>
                        <!-- Start Single Widget -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget-item">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                        </div><!-- End Single Widget -->
                    <?php } ?>

                    <?php if (is_active_sidebar('footer-3')) { ?>
                        <!-- Start Single Widget -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget-item">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                        </div><!-- End Single Widget -->
                    <?php } ?>

                    <?php if (is_active_sidebar('footer-4')) { ?>
                        <!-- Start Single Widget -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget-item widget-last">
                                <?php dynamic_sidebar('footer-4'); ?>
                            </div>
                        </div><!-- End Single Widget -->
                    <?php } ?>

                </div>
            </div>
        </div>
        <!-- End Footer Top Area -->
    <?php } ?>

    <!-- Start Copyright Area  -->
    <div class="copyright-area copyright-default">
        <div class="container">
            <div class="row align-items-center">
                <?php if(!empty($axil_options['axil_copyright_contact'])){ ?>
                    <div class="col-lg-5">
                        <div class="copyright-left text-left">
                            <p><?php echo wp_kses( $axil_options['axil_copyright_contact'], $allowed_tags ); ?></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-7">
                    <div class="copyright-right">
                        <?php if (has_nav_menu('footerbottom')) { ?>
                            <?php wp_nav_menu($axil_footer_bottom_menu_args); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</footer>

