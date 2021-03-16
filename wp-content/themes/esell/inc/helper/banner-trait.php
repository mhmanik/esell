<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */
trait BannerTrait
{
    
    /**
     * @return array
     * Banner Layout
     */
    public static function axil_banner_layout()
    {
        $axil_options = Helper::axil_get_options();

        /**
         * Get Page Options value
         */
        $banner_area = axil_get_acf_data('axil_title_wrapper_show');
        $banner_style = axil_get_acf_data('axil_select_banner_style');

        /**
         * Set Condition
         */
        if($banner_area == 'yes'){
            $banner_style = ( $banner_style == "0" ) ? $axil_options['axil_select_banner_template'] : $banner_style;
        } else {
            $banner_style = $axil_options['axil_select_banner_template'];
        }
        $banner_area = (!empty($banner_area)) ? $banner_area : $axil_options['axil_banner_enable'];
        /**
         * Load Value
         */
        $banner_layout = [
            'banner_area' => $banner_area,
            'banner_style' => $banner_style,
        ];
        return $banner_layout;

    }

    
    /**
     * @return array
     * Banner Layout
     */
    public static function axil_page_breadcrumb()
    {
        $axil_options = Helper::axil_get_options();
        /**
         * Get Page Options value
         */
        $breadcrumbs = axil_get_acf_data('axil_breadcrumbs_enable');

        /**
         * Set Condition
         */
        $breadcrumbs = (!empty($breadcrumbs)) ? $breadcrumbs : $axil_options['axil_breadcrumb_enable'];

        /**
         * Load Value
         */
        $breadcrumbs_enable = [
            'breadcrumbs' => $breadcrumbs,
        ];
        return $breadcrumbs_enable;

    }

}
