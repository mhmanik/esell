<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

trait Socials_Trait {
	
	public static function socials(){
		$socials = array(
			'social_facebook' => array(
				'icon' => 'fa-facebook',
				'url'  => WOOCTheme::$options['social_facebook'],
			),
			'social_twitter' => array(
				'icon' => 'fa-twitter',
				'url'  => WOOCTheme::$options['social_twitter'],
			),
			'social_linkedin' => array(
				'icon' => 'fa-linkedin',
				'url'  => WOOCTheme::$options['social_linkedin'],
			),
			'social_youtube' => array(
				'icon' => 'fa-youtube',
				'url'  => WOOCTheme::$options['social_youtube'],
			),
			'social_pinterest' => array(
				'icon' => 'fa-pinterest',
				'url'  => WOOCTheme::$options['social_pinterest'],
			),
			'social_instagram' => array(
				'icon' => 'fa-instagram',
				'url'  => WOOCTheme::$options['social_instagram'],
			),
			'social_rss' => array(
				'icon' => 'fa-rss',
				'url'  => WOOCTheme::$options['social_rss'],
			),
		);
		$socials = apply_filters( 'wooctheme_socials', $socials );
		return array_filter( $socials, array( __CLASS__ , 'filter_social' ) );
	}

	public static function user_socials(){
		$socials = array(
			'facebook' => array(
				'label' => esc_html__( 'Facebook Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-facebook',
			),
			'twitter' => array(
				'label' => esc_html__( 'Twitter Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-twitter',
			),
			'linkedin' => array(
				'label' => esc_html__( 'Linkedin Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-linkedin',
			),
			'gplus' => array(
				'label' => esc_html__( 'Google Plus Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-google-plus',
			),
			'github' => array(
				'label' => esc_html__( 'Github Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-github',
			),
			'youtube' => array(
				'label' => esc_html__( 'Youtube Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-youtube-play',
			),
			'pinterest' => array(
				'label' => esc_html__( 'Pinterest Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-pinterest-p',
			),
			'instagram' => array(
				'label' => esc_html__( 'Instagram Link', 'uiart' ),
				'type'  => 'text',
				'icon'  => 'fa-instagram',
			),
		);
		return $socials;
	}

	public static function filter_social( $args ){
		return ( $args['url'] != '' );
	}
}