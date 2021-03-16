<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

// Get Value
$axil_options = Helper::axil_get_options();
$header_layout = Helper::axil_header_layout();
$axil_heaedr_top_menu_args = Helper::axil_heaedr_top_menu_args();

  if( "no" !== $axil_options['axil_footer_top_enable'] && "0" !== $axil_options['axil_footer_top_enable'] ):?>
    <!-- Start Header Top Area  -->
    <div class="axil-header-top bg-color-dark">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6 col-12">
                <?php if($axil_options['header_top_left']){ ?>
                    <div class="header-top-text">
                        <p><?php echo esc_html($axil_options['header_top_left']); ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="header-top-link">
                    <?php if ($axil_options['header_top_right']) { ?>
                        <?php wp_nav_menu($axil_heaedr_top_menu_args); ?>
                    <?php } ?>                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area  -->   
    <?php endif ?>