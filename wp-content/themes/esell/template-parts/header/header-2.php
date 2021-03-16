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
<header class="header axil-header  header-dark header-with-shadow <?php echo esc_attr($header_sticky) ?>  <?php echo esc_attr($header_transparent) ?>">
    <div class="header-wrap">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-6">
                <div class="logo">
                    <?php if (isset($axil_options['axil_logo_type'])): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                           title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">

                            <?php if ('image' == $axil_options['axil_logo_type']): ?>

                                <?php if($axil_options['axil_head_logo_white']){ ?>
                                    <img src="<?php echo esc_url( $axil_options['axil_head_logo_white']['url'] ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
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

            <div class="col-lg-6 d-none d-xl-block">
                <div class="mainmenu-wrapper">
                    <!-- Start Mainmanu Nav -->
                    <?php if (has_nav_menu('primary')) {
                        wp_nav_menu($axil_nav_menu_args);
                    } ?>
                    <!-- End Mainmanu Nav -->
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 col-md-6 col-sm-6 col-6">
                <div class="header-search text-right d-flex align-items-center justify-content-end">
                    <?php if(!empty($axil_options['axil_enable_header_search']) && $axil_options['axil_enable_header_search']){ ?>
                        <form  id="<?php echo esc_attr($unique_id); ?>"  action="<?php echo esc_url(home_url( '/' )); ?>" method="GET" class="blog-search">
                            <div class="axil-search form-group">
                                <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                <input type="text"  name="s"  class="form-control" placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'esell' ); ?>" value="<?php echo get_search_query(); ?>"/>
                            </div>
                        </form>
                    <?php } ?>
                    <!-- Start Hamburger Menu  -->
                    <div class="hamburger-menu d-block d-xl-none">
                        <div class="hamburger-inner">
                            <div class="icon"><i class="fal fa-bars"></i></div>
                        </div>
                    </div>
                    <!-- End Hamburger Menu  -->
                </div>
            </div>
            
        </div>
    </div>
</header>
<!-- Start Header -->