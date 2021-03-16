<?php
/**
 * Template part for displaying main header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package esell
 */

$axil_options = Helper::axil_get_options();
$header_layout = Helper::axil_header_layout();
$header_area = $header_layout['header_area'];
$header_style = $header_layout['header_style'];

/**
 * Modern cursor
 */
if($axil_options['axil_modern_cursor_enable'] != 'no'){ ?>
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
<?php }

/**
 * Style Switcher
 */
/*if (isset($axil_options['show_ld_switcher_form_user_end'])) {
    if ($axil_options['show_ld_switcher_form_user_end'] === 'on' || $axil_options['show_ld_switcher_form_user_end'] == 1) {
        ?>
        <div id="my_switcher" class="my_switcher">
            <ul>
                <li>
                    <a href="javascript: void(0);" data-theme="light" class="setColor light">
                        <span title="Light Mode">Light</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                        <span title="Dark Mode">Dark</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }
}*/

/**
 * Load Header
 */
if ("no" !== $header_area && "0" !== $header_area) {
    get_template_part('template-parts/header/header', $header_style);
}

/**
 * Load Mobile Menu
 */
//get_template_part('template-parts/header/mobile-menu');

/**
 * Load Page Title Wrapper
 */
get_template_part('template-parts/title/title-wrapper');


?>
<!-- Start Page Wrapper -->
<div class="main-wrapper axil-section-gapBottom">


