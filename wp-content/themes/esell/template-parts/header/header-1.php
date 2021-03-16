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
$header_sticky = $header_layout['header_sticky'];
$header_transparent = $header_layout['header_transparent'];
// Condition
$unique_id = esc_attr( esell_unique_id( 'header-search-' ) );

$header_sticky = ("no" !== $header_sticky && "0" !== $header_sticky) ? " header-sticky " : "";
$header_transparent = ("no" !== $header_transparent && "0" !== $header_transparent) ? " header-transparent " : "";
// Menu
$axil_nav_menu_args = Helper::axil_nav_menu_args();

?>

  <!-- Start Header -->
    <header class="header axil-header header-style-1 <?php echo esc_attr($header_sticky) ?>  <?php echo esc_attr($header_transparent) ?>">
      
        <?php get_template_part('template-parts/header/header', 'top'); ?>
        <!-- Start Mainmenu Area  -->
        <div class="axil-mainmenu mainmenu-fullwidth">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="logo">
                    <?php if (isset($axil_options['axil_logo_type'])): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                           title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">

                            <?php if ('image' == $axil_options['axil_logo_type']): ?>

                                <?php if($axil_options['axil_head_logo']){ ?>
                                    <img class="dark-logo" src="<?php echo esc_url( $axil_options['axil_head_logo']['url'] ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
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
                </div>
                <div class="col-lg-6">
                    <nav class="mainmenunav">
                    <!-- Start Mainmanu Nav -->
                    <?php if (has_nav_menu('primary')) {
                        wp_nav_menu($axil_nav_menu_args);
                    } ?>
                    <!-- End Mainmanu Nav -->
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header-items">
                        <?php get_template_part('template-parts/header/header', 'search'); ?>
                        <div class="axil-shopping-items">
                            <ul class="shopping-items">
                                <li class="wishlist"><a href="#"><i class="far fa-heart"></i></a></li>
                                <li class="shopping-cart"><a href="#"><i class="far fa-shopping-cart"></i></a></li>
                                <li class="my-account menu-item-has-children"><?php do_action('axil_topbar_menu'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area  -->
         <?php 
            if( "no" !== $axil_options['banner_top_enable'] && "0" !== $axil_options['banner_top_enable'] ):?>
            <!-- Start Add Area  -->
            <div class="axil-header-add bg-color-lighter">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner">
                                <p class="text"><?php echo esc_html($axil_options['banner_top_info']); ?></p>
                                <p class="separator"></p>
                                <p class="button"><a href="<?php echo esc_url($axil_options['banner_top_info_url']); ?>"><?php echo esc_html($axil_options['banner_top_info_url_txt']); ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Add Area  -->
         <?php endif ?>
    </header>
    <!-- Start Header -->