<?php
/**
 * Template part for displaying page banner style two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$banner_layout = Helper::axil_banner_layout();
$banner_area = $banner_layout['banner_area'];
$banner_style = $banner_layout['banner_style'];
$banner_title = axil_get_acf_data("axil_custom_title");
$banner_sub_title = axil_get_acf_data("axil_custom_sub_title");
$allowed_tags = wp_kses_allowed_html( 'post' );
// Get $post if you're inside a function.
global $post;
?>


 <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area bg-gradient-1 ptb--90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner">
                            <?php
                    if ("no" !== $page_breadcrumb_enable && "0" !== $page_breadcrumb_enable) {
                        axil_breadcrumbs();
                    }
                    ?>
                            <div class="axil-breadcrumb-title">
                               <?php
                    if($banner_title){ ?>
                        <h3 class="page-title h3"><?php echo wp_kses( $banner_title, $allowed_tags ); ?></h3>
                    <?php  } else { ?>
                        <h3 class="page-title h3"><?php wp_title(''); ?></h3>
                    <?php  }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->


        