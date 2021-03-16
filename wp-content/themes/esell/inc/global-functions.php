<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package esell
 */

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('esell_content_estimated_reading_time')) {
    /**
     * Function that estimates reading time for a given $content.
     * @param string $content Content to calculate read time for.
     * @paramint $wpm Estimated words per minute of reader.
     * @returns int $time Esimated reading time.
     */
    function esell_content_estimated_reading_time($content = '', $wpm = 200)
    {
        $clean_content = strip_shortcodes($content);
        $clean_content = strip_tags($clean_content);
        $word_count = str_word_count($clean_content);
        $time = ceil($word_count / $wpm);
        $output = $time . esc_attr__(' min read', 'esell');
        return $output;
    }
}


/**
 * Escapeing
 */
if ( !function_exists('awescapeing') ) {
    function awescapeing($html){
        return $html;
    }
}

/**
 *  Convert Get Theme Option global to function
 */
if(!function_exists('axil_get_opt')){
    function axil_get_opt(){
        global $axil_option;
        return $axil_option;
    }
}
/**
 * Get terms
 */
function axil_get_terms_gb( $term_type = null, $hide_empty = false ) {
    if(!isset( $term_type )){
        return;
    }
    $axil_custom_terms = array();
    $terms = get_terms( $term_type, array( 'hide_empty' => $hide_empty ) );
    array_push( $axil_custom_terms, esc_html__( '--- Select ---', 'esell' ) );
    if ( is_array( $terms ) && ! empty( $terms ) ) {
        foreach ( $terms as $single_term ) {
            if ( is_object( $single_term ) && isset( $single_term->name, $single_term->slug ) ) {
                $axil_custom_terms[ $single_term->slug ] = $single_term->name;
            }
        }
    }
    return $axil_custom_terms;
}

/**
 * Blog Pagination
 */
if(!function_exists('axil_blog_pagination')){
    function axil_blog_pagination(){
        GLOBAL $wp_query;
        if ($wp_query->post_count < $wp_query->found_posts) {
            ?>
            <div class="post-pagination"> <?php
                the_posts_pagination(array(
                    'prev_text'          => '<i class="fal fa-arrow-left"></i>',
                    'next_text'          => '<i class="fal fa-arrow-right"></i>',
                    'type'               => 'list',
                    'show_all'  	     => false,
                    'end_size'           => 1,
                    'mid_size'           => 8,
                )); ?>
            </div>
            <?php
        }
    }
}

/**
 * Short Title
 */
if (!function_exists('axil_short_title')){
    function axil_short_title($title, $length = 30) {
        if (strlen($title) > $length) {
            return substr($title, 0, $length) . ' ...';
        }else {
            return $title;
        }
    }
}


/**
 * Get ACF data conditionally
 */
if( !function_exists('axil_get_acf_data') ){
    function axil_get_acf_data($fields){
        return (class_exists('ACF') && get_field_object($fields)) ? get_field($fields) : false;
    }

}


/**
 * @param $url
 * @return string
 */
if ( !function_exists('axil_getEmbedUrl') ){
    function axil_getEmbedUrl($url) {
        // function for generating an embed link
        $finalUrl = '';

        if (strpos($url, 'facebook.com/') !== false) {
            // Facebook Video
            $finalUrl.='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';

        } else if(strpos($url, 'vimeo.com/') !== false) {
            // Vimeo video
            $videoId = isset(explode("vimeo.com/",$url)[1]) ? explode("vimeo.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://player.vimeo.com/video/'.$videoId;

        } else if (strpos($url, 'youtube.com/') !== false) {
            // Youtube video
            $videoId = isset(explode("v=",$url)[1]) ? explode("v=",$url)[1] : null;
            if (strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } else if(strpos($url, 'youtu.be/') !== false) {
            // Youtube  video
            $videoId = isset(explode("youtu.be/",$url)[1]) ? explode("youtu.be/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } else if (strpos($url, 'dailymotion.com/') !== false) {
            // Dailymotion Video
            $videoId = isset(explode("dailymotion.com/",$url)[1]) ? explode("dailymotion.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.dailymotion.com/embed/'.$videoId;

        } else{
            $finalUrl.=$url;
        }

        return $finalUrl;
    }
}


/**
 * @param $prefix
 * @param $title
 * @param string $subtitle
 * @return array
 */
function axil_redux_add_fields($prefix, $title, $subtitle = '')
{
    return array(
        array(
            'id' => $prefix . '_sec',
            'type' => 'section',
            'title' => $title,
            'subtitle' => $subtitle,
            'indent' => true,
        ),
        array(
            'id' => $prefix . '_activate',
            'type' => 'switch',
            'title' => esc_html__('Activate Ad', 'esell'),
            'on' => esc_html__('Enabled', 'esell'),
            'off' => esc_html__('Disabled', 'esell'),
            'default' => false,
        ),
        array(
            'id' => $prefix . '_type',
            'type' => 'button_set',
            'title' => esc_html__('Ad Type', 'esell'),
            'options' => array(
                'image' => esc_html__('Image Link', 'esell'),
                'code' => esc_html__('Custom Code', 'esell'),
            ),
            'default' => 'image',
            'required' => array($prefix . '_activate', 'equals', true)
        ),
        array(
            'id' => $prefix . '_image',
            'type' => 'media',
            'title' => esc_html__('Image', 'esell'),
            'default' => '',
            'required' => array($prefix . '_type', 'equals', 'image')
        ),
        array(
            'id' => $prefix . '_url',
            'type' => 'text',
            'title' => esc_html__('Link', 'esell'),
            'default' => '',
            'required' => array($prefix . '_type', 'equals', 'image')
        ),

        array(
            'id' => $prefix . '_link_type',
            'type' => 'button_set',
            'title' => esc_html__('Open Advertisement Tab', 'esell'),
            'options' => array(
                'blank' => esc_html__('Open in new tab', 'esell'),
                'same' => esc_html__('Open in Same tab', 'esell'),
            ),
            'required' => array($prefix . '_type', 'equals', 'image'),
            'default' => 'blank',

        ),
        array(
            'id' => $prefix . '_code',
            'type' => 'textarea',
            'title' => esc_html__('Custom Code', 'esell'),
            'default' => '',
            'subtitle' => esc_html__('Supports: Shortcode, Adsense, Text, HTML, Scripts', 'esell'),
            'required' => array($prefix . '_type', 'equals', 'code')
        ),
    );
}

/***
 * pt_like_it
 */
add_action( 'wp_ajax_nopriv_pt_like_it', 'pt_like_it' );
add_action( 'wp_ajax_pt_like_it', 'pt_like_it' );
if(!function_exists('pt_like_it')){
    function pt_like_it() {

        if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'pt_like_it_nonce' ) || ! isset( $_REQUEST['nonce'] ) ) {
            exit( "No naughty business please" );
        }

        $likes = get_post_meta( $_REQUEST['post_id'], '_pt_likes', true );
        $likes = ( empty( $likes ) ) ? 0 : $likes;
        $new_likes = $likes + 1;

        update_post_meta( $_REQUEST['post_id'], '_pt_likes', $new_likes );

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            echo esc_html($new_likes);
            die();
        }
        else {
            wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
            exit();
        }
    }
}



/**
 * @param $tags
 * @param $context
 * @return array
 */
if (! function_exists('esell_kses_allowed_html')){
    function esell_kses_allowed_html($tags, $context) {
        switch($context) {
            case 'social':
                $tags = array(
                    'a' => array('href' => array()),
                    'b' => array()
                );
                return $tags;
            case 'allow_link':
                $tags = array(
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'rel' => array(),
                        'title' => array(),
                        'target' => array(),
                    ),
                    'b' => array()
                );
                return $tags;
            case 'allow_title':
                $tags = array(
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'rel' => array(),
                        'title' => array(),
                        'target' => array(),
                    ),
                    'span' => array(
                        'class' => array(),
                        'style' => array(),
                    ),
                    'b' => array()
                );
                return $tags;

            case 'alltext_allow':
                $tags = array(
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'rel' => array(),
                        'title' => array(),
                        'target' => array(),
                    ),
                    'abbr' => array(
                        'title' => array(),
                    ),
                    'b' => array(),
                    'br' => array(),
                    'blockquote' => array(
                        'cite' => array(),
                    ),
                    'cite' => array(
                        'title' => array(),
                    ),
                    'code' => array(),
                    'del' => array(
                        'datetime' => array(),
                        'title' => array(),
                    ),
                    'dd' => array(),
                    'div' => array(
                        'class' => array(),
                        'title' => array(),
                        'style' => array(),
                        'id' => array(),
                    ),
                    'dl' => array(),
                    'dt' => array(),
                    'em' => array(),
                    'h1' => array(),
                    'h2' => array(),
                    'h3' => array(),
                    'h4' => array(),
                    'h5' => array(),
                    'h6' => array(),
                    'i' => array(
                        'class' => array(),
                    ),
                    'img' => array(
                        'alt' => array(),
                        'class' => array(),
                        'height' => array(),
                        'src' => array(),
                        'srcset' => array(),
                        'width' => array(),
                    ),
                    'li' => array(
                        'class' => array(),
                    ),
                    'ol' => array(
                        'class' => array(),
                    ),
                    'p' => array(
                        'class' => array(),
                    ),
                    'q' => array(
                        'cite' => array(),
                        'title' => array(),
                    ),
                    'span' => array(
                        'class' => array(),
                        'title' => array(),
                        'style' => array(),
                    ),
                    'strike' => array(),
                    'strong' => array(),
                    'ul' => array(
                        'class' => array(),
                    ),
                );
                return $tags;
            default:
                return $tags;
        }
    }
    add_filter( 'wp_kses_allowed_html', 'esell_kses_allowed_html', 10, 2);
}




/**
 * Tiny account
 */
if (!function_exists('wooc_tiny_account')) {
    function wooc_tiny_account($icon = false, $user = false) {       
        
        $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        
        /* Active woocommerce */
        if (WOOC_WOO_ACTIVED) {
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        }

        $result = '<ul class="wooc-menus-account">';
        
        $icon_user = apply_filters('wooc_mini_icon_account', '<i class="fal fa-user"></i>');
        
        /**
         * Not Logged in
         */
        if (!WOOC_CORE_USER_LOGGED && !$user) {     
            $axil_options = Helper::axil_get_options();
            $login_ajax = (!isset($axil_options['login_ajax']) || $axil_options['login_ajax'] == 1) ? '1' : '0';
            $span = $icon ? $icon_user : '';
            $result .= '<li class="menu-item"><a class="wooc-login-register-ajax inline-block" data-enable="' . $login_ajax . '" href="' . esc_url($login_url) . '" title="' . esc_attr__('Login / Register', 'esell') . '">' . $span . '</a></li>';
        }
        
        /**
         * Logged in
         */
        
        //$current_user->display_name) . 
        else {
            $span1 = $icon ? $icon_user : '';
             $submenu = '<div>';
                 $submenu = '<span class="wooc-subitem-acc wooc-hello-acc">' . esc_html__('QUICKLINKS', 'esell'). '</span>';
                    $submenu .= '<ul class="sub-menu">';
                    $current_user = wp_get_current_user();             
                    $menu_items = WOOC_WOO_ACTIVED ? wc_get_account_menu_items() : false;
                    if ($menu_items) {
                        foreach ($menu_items as $endpoint => $label) {
                            $submenu .= '<li class="wooc-subitem-acc ' . wc_get_account_menu_item_classes($endpoint) . '"><a href="' . esc_url(wc_get_account_endpoint_url($endpoint)) . '">' . esc_html($label) . '</a></li>';
                        }
                    }            
                    $submenu .= '</ul>';   
            $submenu .= '<div>'; 

            $result .= 
                '<li class="menu-item wooc-menu-item-account menu-item-has-children root-item">' .
                    '<a href="' . esc_url($profile_url) . '" title="' . esc_attr__('My Account', 'esell') . '">' . $span1 .'</span></a>' .
                    $submenu .
                '</li>';
        }
        
        $result .= '</ul>';
        
        return apply_filters('wooc_tiny_account_ajax', $result);
    }
}



if (!function_exists('wooc_topbar_account')) :
    function wooc_topbar_account() {
        echo wooc_tiny_account(true);
    }
endif;

/**
 * Topbar Account
 */
add_action('wooc_topbar_menu', 'wooc_topbar_account');





/**
 * Tiny account
 */
if (!function_exists('axil_tiny_account')) {
    function axil_tiny_account($icon = false, $user = false) {       
        
        $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        
        /* Active woocommerce */
        if (WOOC_WOO_ACTIVED) {
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        } 

        $icon_user = apply_filters('wooc_mini_icon_account', '<i class="fal fa-user"></i>');

        $result = '<a href="' . esc_url($profile_url) . '" title="' . esc_attr__('My Account', 'esell') . '"><i class="fal fa-user"></i></span></a>';
    
        $result .= '<div class="axil-submenu">
               <span class="title">QUICKLINKS</span>'; 
                $menu_name = 'myaccount';
                $locations = get_nav_menu_locations();

                if( $locations && isset( $locations[ $menu_name ] ) ){

                    // получаем элементы меню
                    $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

                    // создаем список
                    $menu_list = '<ul id="menu-' . $menu_name . '">';

                    foreach ( (array) $menu_items as $key => $menu_item ){
                        $menu_list .= '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
                    }

                    $menu_list .= '</ul>';
                }
                else {
                    $menu_list = '<ul><li>Меню "' . $menu_name . '" не определено.</li></ul>';
                }

            $result .= $menu_list;
        /**
         * Not Logged in
         */

        if (!WOOC_CORE_USER_LOGGED && !$user) {     
            $axil_options = Helper::axil_get_options();
            $login_ajax = (!isset($axil_options['login_ajax']) || $axil_options['login_ajax'] == 1) ? '1' : '0';
            $span = $icon ? $icon_user : '';                 

         $result .= '<a href="' . esc_url($login_url) . '" class="axil-btn w-100 text-center mt--80 mb--15">' . esc_attr__('Login', 'esell') . '</a>
                <div class="reg-footer text-center">No account yet? <a href="' . esc_url($login_url) . '" class="btn-link">' . esc_attr__('REGISTER HERE.', 'esell') . '</a></div>
            </div>';
         }else {       

            $result .= '<a href="' . wp_logout_url( get_permalink() ) . '" class="axil-btn w-100 text-center mt--80 mb--15">' . esc_attr__('Logout', 'esell') . '</a></div>'; 

        }
        

        $result .= '</ul>';
        
        return apply_filters('axil_tiny_account_ajax', $result);
    }
}



if (!function_exists('axil_topbar_account')) :
    function axil_topbar_account() {
        echo axil_tiny_account(true);
    }
endif;

/**
 * Topbar Account
 */
add_action('axil_topbar_menu', 'axil_topbar_account');




/**
 * Tiny account
 */
if (!function_exists('esell_tiny_account')) {
    function esell_tiny_account($icon = false, $user = false) {       
        
        $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        
        /* Active woocommerce */
        if (WOOC_WOO_ACTIVED) {
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        } 
        $result = '<ul>';         

        if (!WOOC_CORE_USER_LOGGED && !$user) { 
            
           if ( is_page('member-login') ) {
              $result .= '<li>' . esc_attr__('Already a member?', 'esell') . '</li>';
              $result .= '<li><a href="' . esc_url($register_url) . '" class="axil-btn">' . esc_attr__('Sign Up Now', 'esell') . '</a></li>'; 
            }
            elseif ( is_page('member-register') ) {              
                $result .= '<li>' . esc_attr__('Already a member?', 'esell') . '</li>';
                $result .= '<li><a href="' . esc_url($login_url) . '" class="axil-btn-link">' . esc_attr__(' Sign In', 'esell') . '</a></li>';
            }else{
                $result .= '<li>' . esc_attr__('Already a member?', 'esell') . '</li>';
                $result .= '<li><a href="' . esc_url($login_url) . '" class="axil-btn-link">' . esc_attr__(' Sign In', 'esell') . '</a></li>';
            }

        }else{       

             $result .= '<li><a href="' . esc_url($profile_url) . '" class="axil-btn-link">' . esc_attr__(' Already a member?', 'esell') . '</a></li>';
             $result .= '<li><a href="' . wp_logout_url( get_permalink() ) . '" class="axil-btn">' . esc_attr__(' Sign Out', 'esell') . '</a></li>'; 
        }        

        $result .= '</ul>';
        
        return apply_filters('esell_tiny_account_ajax', $result);
    }
}


if (!function_exists('esell_topbar_account')) :
    function esell_topbar_account() {
        echo esell_tiny_account(true);
    }
endif;

/**
 * Topbar Account
 */
add_action('esell_topbar_menu', 'esell_topbar_account');



