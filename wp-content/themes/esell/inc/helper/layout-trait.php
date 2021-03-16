<?php

/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */
trait LayoutTrait
{

      // Sidebar
    public static function wooc_axil_sidebar_options()
    {

        $axil_options = Helper::axil_get_options();
        $condipfix      = self::wooc_layout_settings();
      
        /**
         * Get Page Options value
         */
        $select_sidebar = axil_get_acf_data('select_sidebar');

        /**
         * Set Condition
         */
        $sidebar = (empty($select_sidebar) ||  $select_sidebar == "0") ? $axil_options[$condipfix . '_sidebar'] : $select_sidebar;

        return $sidebar;

    } 


    public static function wooc_has_sidebar() {
        
        $axil_options           = self::axil_get_options();         
        $condipfix               = self::wooc_layout_settings();        
        $layout                  = $axil_options[$condipfix . '_layout'];
        $sidebar                = Helper::wooc_axil_sidebar_options();
        $has_sidebar_widgets        = false;
        
        if ( $sidebar ) {
            if ( is_active_sidebar( $sidebar )  ){
                $has_sidebar_widgets = true;
            }
        }
        else {
            if ( is_active_sidebar( 'sidebar' ) ){
                $has_sidebar_widgets = true;
            }
        }

        if ( $layout != 'full-width' ) {
            return true;
        }
        else {
            return false;
        }
    }

  

    public static function wooc_the_layout_class() {
              
        $layout_class = self::wooc_has_sidebar() ? 'col-xl-8 col-lg-8 col-12' : 'col-12';
        echo apply_filters( 'esell_layout_class', $layout_class );
    }

    public static function wooc_the_sidebar_class() {

        echo apply_filters( 'esell_sidebar_class', 'wooc-shop-sidebar col-xl-3 col-lg-4 col-12' );
    }

 /** layout settings */
    public static function wooc_layout_settings()
    {
        if (is_single() || is_page()) {
                $post_type = get_post_type();
                switch ($post_type) {
                    case 'product':
                        $themepfix = 'product';
                        break;             
                    default:
                        $themepfix = 'product';
                        break;
                }
            } elseif( Helper::is_page( 'is_woocommerce' ) ) {
                 $themepfix = 'shop';
            }else {
                $themepfix = 'shop';
            }
        
        return $themepfix;
    }
 

     // layout style
    public static function axil_wooc_layout()
    {
        $esell_options = self::axil_get_options();
        $condipfix = self::wooc_layout_settings();
        $layout = $esell_options[$condipfix . "_layout"];
        $sidebar    = Helper::axil_sidebar_options();
        $has_sidebar_contnet = (is_active_sidebar( $sidebar ) || is_active_sidebar( 'sidebar' )) ? 'col-xl-8 axil-main' : 'col-xl-12 axil-main';

        // Layout class
        if ($layout == 'full-width') {
            $layout_class = 'col-12';
            $post_class = 'col-lg-4';
        } else {
            $layout_class = $has_sidebar_contnet;
            $post_class = 'col-lg-6';
        }
        $layout = [
            'layout' => $layout,
            'layout_class' => $layout_class,
            'post_class' => $post_class,
        ];
        return $layout;    
    }


    public static function wooc_axil_left_get_sidebar()
    { 
        $layout_abj = Helper::axil_wooc_layout();
        $layout = $layout_abj['layout'];
        $sidebar  = Helper::wooc_axil_sidebar_options();
        if ($layout == 'left-sidebar') { ?>         
            <div class="col-lg-4 col-xl-4 mt_md--40 mt_sm--40">
                <?php echo Helper::ad_post_before_sidebar(); 
                    if ($sidebar) {
                        dynamic_sidebar( $sidebar );
                    } else {
                        dynamic_sidebar('sidebar-1');
                    }
                    echo Helper::ad_post_after_sidebar(); ?>
            </div>
        <?php                 
        }
        return;             
    }

    public static function wooc_axil_right_get_sidebar()
    {

        $layout_abj = Helper::axil_wooc_layout();
        $layout = $layout_abj['layout'];
         $sidebar                = Helper::wooc_axil_sidebar_options();
        if ($layout == 'right-sidebar') { ?>         
            <div class="col-lg-4 col-xl-4 mt_md--40 mt_sm--40">
                <?php echo Helper::ad_post_before_sidebar();                 
                    if ($sidebar) {
                        dynamic_sidebar( $sidebar );
                    } else {
                        dynamic_sidebar('sidebar-1');
                    }
                    echo Helper::ad_post_after_sidebar(); ?>
            </div>
        <?php                 
        }
        return; 
    }


    public static function axil_left_get_sidebar()
    {
        $layout_abj = Helper::axil_layout_style_all();
        $layout = $layout_abj['layout'];
        if ($layout == 'left-sidebar') {
            get_sidebar();
        }
        return;
    }

    public static function axil_right_get_sidebar()
    {
        $layout_abj = Helper::axil_layout_style_all();
        $layout = $layout_abj['layout'];
        if ($layout == 'right-sidebar') {
            get_sidebar();
        }
        return;
    }




    /**
     * @return array
     * Header Layout
     */
    public static function axil_header_layout()
    {
        $esell_options = Helper::axil_get_options();
        $themepfix = AXIL_THEME_FIX;

        /**
         * Get Page Options value
         */
        if(class_exists('ACF')){
            $header_area = get_field($themepfix .  '_show_header');
            $header_style = get_field( $themepfix . "_select_header_style");
            $header_sticky = get_field( $themepfix . "_header_sticky");
            $header_transparent = get_field( $themepfix . "_header_transparent");
        }

        /**
         * Set Condition
         */
        $header_area = (empty($header_area)) ? $esell_options['axil_enable_header'] : $header_area;
        $header_style = (empty($header_style) ||  $header_style == "0") ? $esell_options['axil_select_header_template'] : $header_style;
        $header_sticky = (empty($header_sticky)) ? $esell_options['axil_header_sticky'] : $header_sticky;
        $header_transparent = (empty($header_transparent)) ? $esell_options['axil_header_transparent'] : $header_transparent;
        /**
         * Load Value
         */
        $header_layout = [
            'header_area' => $header_area,
            'header_style' => $header_style,
            'header_sticky' => $header_sticky,
            'header_transparent' => $header_transparent,
        ];
        return $header_layout;

    }

    /**
     * @return array
     * Footer Layout
     */
    public static function axil_footer_layout()
    {
        $esell_options = Helper::axil_get_options();

        /**
         * Get Page Options value
         */
        $footer_area = axil_get_acf_data('axil_show_footer');
        $footer_style = axil_get_acf_data('axil_select_footer_style');

        /**
         * Set Condition
         */
        $footer_area = (empty($footer_area)) ? $esell_options['axil_footer_enable'] : $footer_area;
        $footer_style = (empty($footer_style) ||  $footer_style == "0") ? $esell_options['axil_select_footer_template'] : $footer_style;

        /**
         * Load Value
         */
        $footer_layout = [
            'footer_area' => $footer_area,
            'footer_style' => $footer_style,
        ];
        return $footer_layout;

    }

    /**
     * @return array
     * Footer Layout
     */
    public static function axil_post_banner_style()
    {
        $esell_options = Helper::axil_get_options();

        /**
         * Get Page Options value
         */
        $post_banner_style = axil_get_acf_data('select_banner_style');
        $axil_single_post_style = (isset($esell_options['axil_single_post_style'])) ? $esell_options['axil_single_post_style'] : "";

        /**
         * Set Condition
         */
        $post_banner_style = (empty($post_banner_style) ||  $post_banner_style == "0") ? $axil_single_post_style : $post_banner_style;

        /**
         * Load Value
         */
        $post_banner_layout = [
            'post_banner_style' => $post_banner_style,
        ];
        return $post_banner_layout;

    }

    /**
     * @return array
     * Footer Layout
     */
    public static function axil_footer_top_layout()
    {
        $esell_options = Helper::axil_get_options();

        /**
         * Get Page Options value
         */
        $footer_top_area = axil_get_acf_data('axil_show_footer_top');
        /**
         * Set Condition
         */
        $footer_top_area = (empty($footer_top_area)) ? $esell_options['axil_footer_top_enable'] : $footer_top_area;

        /**
         * Load Value
         */
        $footer_top_layout = [
            'footer_top_area' => $footer_top_area,
        ];
        return $footer_top_layout;

    }


  

    // Sidebar
    public static function axil_sidebar_options()
    {

        $esell_options = Helper::axil_get_options();

        /**
         * Get Page Options value
         */
        $select_sidebar = axil_get_acf_data('select_sidebar');

        /**
         * Set Condition
         */
        $sidebar = (empty($select_sidebar) ||  $select_sidebar == "0") ? $esell_options['axil_single_pos'] : $select_sidebar;

        return $sidebar;

    }

    // Menu Option
    public static function axil_logos()
    {
        $esell_options = self::axil_get_options();
        // Logo
        $axil_dark_logo = empty($esell_options['logo']['url']) ? self::get_img('logo-black.svg') : $esell_options['logo']['url'];
        $axil_light_logo = empty($esell_options['logo_light']['url']) ? self::get_img('logo-white.svg') : $esell_options['logo_light']['url'];
        $axil_logo_symbol = empty($esell_options['logo_symbol']['url']) ? self::get_img('logo-symbol.svg') : $esell_options['logo_symbol']['url'];

        $menu_option = [
            'axil_dark_logo' => $axil_dark_logo,
            'axil_light_logo' => $axil_light_logo,
            'axil_logo_symbol' => $axil_logo_symbol
        ];
        return $menu_option;
    }

    // Page layout style
    public static function axil_layout_style()
    {
        $themepfix = AXIL_THEME_FIX;
        $esell_options = self::axil_get_options();
        $condipfix = self::layout_settings();

        if (is_single() || is_page()) {
            $layout = get_post_meta(get_the_ID(), $themepfix . "_layout", true);
            $layout = (empty($layout) || $layout == 'default') ? $esell_options[$condipfix . "_layout"] : $layout;

        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            $layout = (empty($layout) || $layout == 'default') ? $esell_options[$condipfix . "_layout"] : $layout;
        }

        return $layout;
    }

    // layout style
    public static function axil_layout_style_all()
    {
        $themepfix = AXIL_THEME_FIX;
        $esell_options = self::axil_get_options();
        $condipfix = self::layout_settings();
        $sidebar 	= Helper::axil_sidebar_options();
        $has_sidebar_contnet = (is_active_sidebar( $sidebar ) || is_active_sidebar( 'sidebar' )) ? 'col-xl-8 axil-main' : 'col-xl-12 axil-main';

        if (is_single() || is_page()) {
            $layout = get_post_meta(get_the_ID(), $themepfix . "_layout", true);
            $layout = (empty($layout) || $layout == 'default') ? $esell_options[$condipfix . "_layout"] : $layout;

        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            $layout = (empty($layout) || $layout == 'default') ? $esell_options[$condipfix . "_layout"] : $layout;
        }

        // Layout class
        if ($layout == 'full-width') {
            $layout_class = 'col-12';
            $post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 masonry-item';
        } else {
            $layout_class = $has_sidebar_contnet;
            $post_class = 'col-12';
        }

        $layout = [
            'layout' => $layout,
            'layout_class' => $layout_class,
            'post_class' => $post_class,
        ];
        return $layout;
    }

    // layout style
    public static function axil_layout_custom_taxonomy()
    {
        $esell_options = self::axil_get_options();
        $condipfix = self::layout_settings();
        $layout = $esell_options[$condipfix . "_layout"];
        $sidebar 	= Helper::axil_sidebar_options();
        $has_sidebar_contnet = (is_active_sidebar( $sidebar ) || is_active_sidebar( 'sidebar' )) ? 'col-xl-8 axil-main' : 'col-xl-12 axil-main';

        // Layout class
        if ($layout == 'full-width') {
            $layout_class = 'col-12';
            $post_class = 'col-lg-4';
        } else {
            $layout_class = $has_sidebar_contnet;
            $post_class = 'col-lg-6';
        }
        $layout = [
            'layout' => $layout,
            'layout_class' => $layout_class,
            'post_class' => $post_class,
        ];
        return $layout ; 
         }

    /**  Footer Options */
    public static function axil_active_footer()
    {
        $esell_options = Helper::axil_get_options();
        if (!$esell_options['footer_area']) {
            return false;
        }
        $footer_column = $esell_options['footer_column'];
        for ($i = 1; $i <= $footer_column; $i++) {
            if (is_active_sidebar('footer-' . $i)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Custom Sidebar
     */
    public static function get_custom_sidebar_fields()
    {
         $themepfix = 'esell';
        $sidebar_fields = array();
        $sidebar_fields['sidebar'] = esc_html__('Sidebar', 'esell');
        $sidebar_fields['widgets-shop'] = esc_html__('shop', 'esell');
        $sidebars = get_option("{$themepfix}_custom_sidebars", array());
        if ($sidebars) {
            foreach ($sidebars as $sidebar) {
                $sidebar_fields[$sidebar['id']] = $sidebar['name'];
            }
        }
        return $sidebar_fields;
    }

    /** layout settings */
    public static function layout_settings()
    {
        if (is_single() || is_page()) {
            $post_type = get_post_type();

            switch ($post_type) {
                case 'page':
                    $themepfix = 'page';
                    break;
                case 'post':
                    $themepfix = 'single_post';
                    break;
                default:
                    $themepfix = 'single_post';
                    break;
            }
        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            if (is_author()) {
                $themepfix = 'author';
            } elseif (is_search()) {
                $themepfix = 'search';
            } elseif (is_post_type_archive("team") || is_tax("team_category")) {
                $themepfix = 'team_archive';
            } else {
                $themepfix = 'blog';
            }
        }
        return $themepfix;
    }

  
}