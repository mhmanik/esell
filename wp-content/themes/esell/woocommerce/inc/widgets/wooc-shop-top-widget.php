<?php 
// Security check
defined('ABSPATH') || die();

if( !class_exists('RTShopWidget') ){

    class RTShopWidget{

        function __construct(){

            add_action('woocommerce_before_shop_loop', array(&$this, 'add_top_widget'));

        }

        function add_top_widget(){

            if(is_active_sidebar('topbar')){

                dynamic_sidebar('topbar');
            }

        }

    }

    new RTShopWidget();

}