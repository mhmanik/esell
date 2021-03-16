<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */


	/* Helper Functions
	=============================================================== */
	
	global $wooc_woocommerce_enabled;
	$wooc_woocommerce_enabled = ( class_exists( 'WooCommerce' ) ) ? true : false;
		
	/* Check if WooCommerce is activated */
	function wooc_woocommerce_activated() {
		global $wooc_woocommerce_enabled;
		return $wooc_woocommerce_enabled;
	}
	
	/* Check if the current page is a WooCommmerce page */
	function wooc_is_woocommerce_page() {
		// Get the current body class
		$body_classes = get_body_class();
		
		foreach( $body_classes as $body_class ) {
			// Check if the class contains the word "woocommerce"
			if ( strpos( $body_class, 'woocommerce' ) !== false ) {
				return true;
			}
		}
		
		return false;
	}	
	
	/* Add page include slug */
	function wooc_add_page_include( $slug ) {
		global $wooc_page_includes;
		$wooc_page_includes[$slug] = true;
	}
		
	/* Get post categories */
	function wooc_get_post_categories() {
		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);
		
		$categories = get_categories( $args );
		
		$return = array( 'All' => '' );
		
		foreach( $categories as $category ) {
            $return[wp_specialchars_decode( $category->name )] = $category->slug;
		}
		
		return $return;
	};
		
	/* Get social media profiles list */
	if ( ! function_exists( 'wooc_get_social_profiles' ) ) {
		function wooc_get_social_profiles( $wrapper_class = 'nm-social-profiles-list' ) {
			global $wooc_theme_options;
			
            $social_profiles_meta = array(
				'facebook'		=> array( 'title' => 'Facebook', 'icon' => 'nm-font nm-font-facebook' ),
				'instagram'		=> array( 'title' => 'Instagram', 'icon' => 'nm-font nm-font-instagram' ),
				'twitter'		=> array( 'title' => 'Twitter', 'icon' => 'nm-font nm-font-twitter' ),
                'flickr'		=> array( 'title' => 'Flickr', 'icon' => 'nm-font nm-font-flickr' ),
				'linkedin'		=> array( 'title' => 'LinkedIn', 'icon' => 'nm-font nm-font-linkedin' ),
				'pinterest'		=> array( 'title' => 'Pinterest', 'icon' => 'nm-font nm-font-pinterest' ),
                'rss'	        => array( 'title' => 'RSS', 'icon' => 'nm-font nm-font-rss-square' ),
                'snapchat'      => array( 'title' => 'Snapchat', 'icon' => 'nm-font nm-font-snapchat-ghost' ),
                'behance'		=> array( 'title' => 'Behance', 'icon' => 'nm-font nm-font-behance' ),
                'dribbble'		=> array( 'title' => 'Dribbble', 'icon' => 'nm-font nm-font-dribbble' ),
				'line'          => array( 'title' => 'LINE', 'icon' => 'nm-font nm-font-line-app' ),
                'mixcloud'      => array( 'title' => 'MixCloud', 'icon' => 'nm-font nm-font-mixcloud' ),
                'odnoklassniki' => array( 'title' => 'OK.RU', 'icon' => 'nm-font nm-font-odnoklassniki' ),
                'soundcloud'    => array( 'title' => 'SoundCloud', 'icon' => 'nm-font nm-font-soundcloud' ),
                'telegram'	    => array( 'title' => 'Telegram', 'icon' => 'nm-font nm-font-telegram' ),
                'tumblr'	    => array( 'title' => 'Tumblr', 'icon' => 'nm-font nm-font-tumblr' ),
				'vimeo'	        => array( 'title' => 'Vimeo', 'icon' => 'nm-font nm-font-vimeo-square' ),
				'vk'			=> array( 'title' => 'VK', 'icon' => 'nm-font nm-font-vk' ),
				'weibo'			=> array( 'title' => 'Weibo', 'icon' => 'nm-font nm-font-weibo' ),
                'whatsapp'		=> array( 'title' => 'WhatsApp', 'icon' => 'nm-font nm-font-whatsapp' ),
				'youtube'		=> array( 'title' => 'YouTube', 'icon' => 'nm-font nm-font-youtube' ),
                'email'			=> array( 'title' => 'Email', 'icon' => 'nm-font nm-font-envelope' )
			);
            
            $social_profiles = array();
            foreach( $wooc_theme_options['social_profiles'] as $slug => $url ) {
                if ( $url !== '' ) {
                    if ( $slug == 'email' ) {
                        $url = 'mailto:' . $url;
                    }
                    $social_profiles[$slug] = array( 'title' => $social_profiles_meta[$slug]['title'], 'url' => $url, 'icon' => $social_profiles_meta[$slug]['icon'] );
                }
            }
            $social_profiles = apply_filters( 'wooc_social_profiles', $social_profiles );
            
            $output = '';
			foreach ( $social_profiles as $slug => $data ) {
                $output .= '<li><a href="' . esc_url( $data['url'] ) . '" target="_blank" title="' . esc_attr( $data['title'] ) . '" rel="nofollow"><i class="' . esc_attr( $data['icon'] ) . '"></i></a></li>';
            }
			
			return '<ul class="' . $wrapper_class . '">' . $output . '</ul>';
		}
	}
	