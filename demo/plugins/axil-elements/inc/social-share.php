<?php
/*
***************************************************************
*  Social sharing icons
***************************************************************
*/

if ( ! function_exists('axil_sharing_icon_links') ) {
 function axil_sharing_icon_links( ) {

  global $post;
  $axil_options = Helper::axil_get_options();

  $html = '<ul class="social-share-transparent justify-content-end">';

   // facebook
   $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
   $html .= '<li><a href="'. esc_url( $facebook_url ) .'" target="_blank" class="aw-facebook"><i class="fab fa-facebook-f"></i></a></li>';

   // twitter
   $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
   $html .= '<li><a href="'. esc_url( $twitter_url ) .'" target="_blank" class="aw-twitter"><i class="fab fa-twitter"></i></a></li>';

   // linkedin
   $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
   $html .= '<li><a href="'. esc_url( $linkedin_url ) .'" target="_blank" class="aw-linkdin"><i class="fab fa-linkedin-in"></i></a></li>';

   $html .= '<li><button class="axilcopyLink" title="'. esc_html('Copy Link', 'blogar') .'" data-link="'. esc_url(get_permalink()) .'"><i class="fas fa-link"></i></button></li>';

  $html .= '</ul>';



  echo wp_kses_post($html);

 }
}



if ( ! function_exists('axil_sharing_icon_links_bottom') ) {
    function axil_sharing_icon_links_bottom( ) {

        global $post;
        $axil_options = Helper::axil_get_options();

        $html = '<ul class="social-icon icon-rounded-transparent md-size">';

        // facebook
        $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='. get_the_permalink();
        $html .= '<li><a href="'. esc_url( $facebook_url ) .'" target="_blank" class="aw-facebook"><i class="fab fa-facebook-f"></i></a></li>';

        // twitter
        $twitter_url = 'https://twitter.com/share?'. esc_url(get_permalink()) .'&amp;text='. get_the_title();
        $html .= '<li><a href="'. esc_url( $twitter_url ) .'" target="_blank" class="aw-twitter"><i class="fab fa-twitter"></i></a></li>';

        // linkedin
        $linkedin_url = 'http://www.linkedin.com/shareArticle?url='. esc_url(get_permalink()) .'&amp;title='. get_the_title();
        $html .= '<li><a href="'. esc_url( $linkedin_url ) .'" target="_blank" class="aw-linkdin"><i class="fab fa-linkedin-in"></i></a></li>';



        $html .= '</ul>';


        echo wp_kses_post($html);

    }
}