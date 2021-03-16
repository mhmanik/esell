<?php
/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$axil_footer_bottom_menu_args = Helper::axil_footer_bottom_menu_args();
$lineclass = (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) ? "footer-menu-active" : "";
$allowed_tags = wp_kses_allowed_html( 'post' );
?>
<!-- Start Footer Area  -->
<div class="axil-footer-widget axil-footer-area axil-default-footer axil-footer-var-1 <?php echo esc_attr( $lineclass ); ?>">
    <?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')){ ?>
        <!-- Start Footer Top Area -->
            <div class="footer-top separator-top">
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
    <div class="copyright-area copyright-default separator-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-12">
                    <div class="copyright-left d-flex justify-content-xl-start justify-content-lg-center">
                        <?php if (has_nav_menu('footerbottom')) { ?>
                            <?php wp_nav_menu($axil_footer_bottom_menu_args); ?>
                        <?php } ?>
                        <?php if(!empty($axil_options['axil_copyright_contact'])){ ?>                   
                             <ul class="quick-link">
                                <li><?php echo wp_kses( $axil_options['axil_copyright_contact'], $allowed_tags ); ?></li>
                           </ul>            
                        <?php } ?>
                    </div>
                </div>
                <?php if(!empty($axil_options['axil_copyright_contact'])){ ?>
                    <div class="col-xl-5 col-lg-12">  
                        <div class="copyright-right d-flex justify-content-xl-end justify-content-lg-center align-items-center">
                            <span class="card-text"><?php echo esc_html__('Accept For', 'esell');?></span>                            
                            <?php if ( $axil_options['payment_icons'] ): ?>
                                <ul class="payment-icons-bottom quick-link">
                                    <?php if ( $axil_options['payment_img'] ) : ?>
                                        <?php $axil_cards = explode( ',', $axil_options['payment_img'] );?>
                                        <?php foreach ( $axil_cards as $axil_card ): ?>
                                            <li><?php echo wp_get_attachment_image( $axil_card );?></li>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><img alt="<?php esc_attr_e( 'payment', 'esell' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment1.png' ) ); ?>"></li>
                                            <li><img alt="<?php esc_attr_e( 'payment', 'esell' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment2.png' ) ); ?>"></li>
                                            <li><img alt="<?php esc_attr_e( 'payment', 'esell' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment3.png' ) ); ?>"></li>
                                            <li><img alt="<?php esc_attr_e( 'payment', 'esell' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment4.png' ) ); ?>"></li>
                                            <li><img alt="<?php esc_attr_e( 'payment', 'esell' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment5.png' ) ); ?>"></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?> 
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</div>
<!-- End Footer Area  -->


