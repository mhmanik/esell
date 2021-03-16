<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package esell
 */

get_header();
// Get Value
$axil_options = Helper::axil_get_options();
?>
<!-- Start Error Area  -->
<div class="error-area bg_image--4 bg-color-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/others/404.png" alt="Error Images">

                    <?php if(!empty($axil_options['axil_404_title'])){ ?> <h1 class="title"><?php echo esc_html( $axil_options['axil_404_title'] );?></h1> <?php } ?>
                    <?php if(!empty($axil_options['axil_404_subtitle'])){ ?> <p><?php echo esc_html( $axil_options['axil_404_subtitle'] );?></p> <?php } ?>
                    <?php if( $axil_options['axil_enable_go_back_btn'] !== "no"){ ?>
                        <div class="back-totop-button cerchio d-inline-block">
                            <a class="axil-button button-rounded hover-flip-item-wrapper" href="<?php echo esc_url( home_url( '/' ) );?>">
                                <span class="hover-flip-item">
                                    <span data-text="<?php echo esc_html( $axil_options['axil_button_text'] );?>"><?php echo esc_html( $axil_options['axil_button_text'] );?></span>
                                </span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Error Area  -->
<?php
get_footer();