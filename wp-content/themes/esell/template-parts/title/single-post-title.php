<?php
/**
 * Template part for displaying header page title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
?>
<!-- Start Breadcrumb Area -->
<div class="axil-breadcrumb-area breadcrumb-style-default">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner">
                    <?php  if ("hide" !== $axil_options['axil_enable_single_post_breadcrumb_wrap']) {
                        axil_breadcrumbs();
                    } ?>
                    <!--  Title here  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->

