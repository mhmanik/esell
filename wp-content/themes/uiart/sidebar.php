<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;
?>
<div class="<?php Helper::the_sidebar_class(); ?>">
    <aside class="sidebar-widget-area">
        <?php
        do_action('uiart_before_sidebar');

        if (WOOCTheme::$sidebar) {
            dynamic_sidebar(WOOCTheme::$sidebar);
        } else {
            dynamic_sidebar('sidebar');
        }

        do_action('uiart_after_sidebar');
        ?>
    </aside>
</div>
