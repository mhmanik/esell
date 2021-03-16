<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package esell
 */
trait OptionsTrait {

  /**
   * @abstract get theme mod
   * return boolean
   */
  public static function get_axil_options($name) {
      $modval = get_theme_mod($name);
      if (!empty($modval)) {
          if (!is_array($modval)) {
              $newval = unserialize($modval);
          } else {
              $newval = $modval;
          }
          return $newval;
      }
      return false;
  }

  /**
   * @abstract get theme options
   * return object
   */
  public static function axil_get_options(){
    
    include AXIL_FREAMWORK_OPTIONS . 'predefined-data.php';

    $axil_optionss = json_decode( $predefined_data, true );
    if ( class_exists( 'Redux' ) ) {  
        global $options;
        $axil_optionss = wp_parse_args( $GLOBALS['axil_options'], $options );
    }
    return $axil_optionss;
  }

  /**
   * @abstract get post object
   * return object
   */
  public static function axil_get_post_object(){
      global $post;
      return $post;
  }

  /**
   * @abstract get current user info
   * return array
   */

  public static function axil_get_current_user_var(){
      return wp_get_current_user();
  }

}