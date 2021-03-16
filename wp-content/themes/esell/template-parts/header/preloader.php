<?php
$axil_options = Helper::axil_get_options();
$preloader_default_image = AXIL_THEME_URI . '/assets/images/preloader.gif';
if ( $axil_options['axil_preloader'] !== 'no' ) {
    if ( !empty( $axil_options['axil_preloader_image']['url'] ) ) {
        $preloader_img = $axil_options['axil_preloader_image']['url'];
        echo '<div class="preloader bgimg" id="preloader" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
    }else{
        echo '<div class="preloader bgimg" id="preloader" style="background-image:url(' . esc_url($preloader_default_image) . ');"></div>';
    }
}