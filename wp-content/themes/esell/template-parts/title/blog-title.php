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

$page_breadcrumb = Helper::axil_page_breadcrumb();
$page_breadcrumb_enable = $page_breadcrumb['breadcrumbs'];
$allowed_tags = wp_kses_allowed_html( 'post' );
?>
<?php if($axil_options['axil_enable_blog_title'] !== 'no'){ ?>
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
                if($axil_options['axil_enable_blog_title'] !== 'no'){
                    if ( is_archive() ): ?>
                        <h1 class="page-title h3"><?php the_archive_title(); ?></h1>
                    <?php elseif( is_search() ): ?>
                        <h1 class="page-title h3"><?php esc_html_e( 'Search results for: ', 'esell' ) ?><?php echo get_search_query(); ?></h1>
                    <?php else: ?>
                        <h3 class="page-title h3">
                            <?php  if ( isset( $axil_options['axil_blog_text'] ) && !empty( $axil_options['axil_blog_text'] ) ){
                                echo esc_html( $axil_options['axil_blog_text'] );
                            } else {
                                echo esc_html__('Blog', 'esell');
                            }  ?>
                        </h3>
                    <?php endif;
                } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Breadcrumb Area  -->
<?php }