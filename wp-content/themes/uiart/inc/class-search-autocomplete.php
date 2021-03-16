<?php

namespace wooctheme\Uiart;

class Wooc_product_aj_search {

    public static $instance;

    public function wooc_sratch_ajax_responder($data = '') {
        global $wpdb;
        $search_limit = isset( WOOCTheme::$options['wooc_search_auto_suggest_limit'])
                && !empty( WOOCTheme::$options['wooc_search_auto_suggest_limit'])? (int) WOOCTheme::$options['wooc_search_auto_suggest_limit'] :  10;

        $search_filter = isset($_GET['q']) ? esc_sql($_GET['q']) : null;

        if (empty($search_filter) || !function_exists('WC'))
            die(json_encode(array()));
        $search_filter = urldecode($search_filter);
        $posts = $wpdb->get_results("select * from {$wpdb->posts} where post_type = 'product' and post_status = 'publish' and post_title like '%{$search_filter}%' LIMIT 0,{$search_limit}");

        $search_data = array();
        if(!empty($posts))
        foreach ($posts as $post):

            $product = get_product($post->ID);

            $search_data[] = array(
                'url'           => get_permalink($product->get_id()),
                'title'         => $post->post_title,
                'price_html'    => $product->get_price_html(),

            );

            if(isset( WOOCTheme::$options['wooc_search_img_status']) &&  WOOCTheme::$options['wooc_search_img_status']){
                $image_id = get_post_thumbnail_id($post->ID);
                $image = wp_get_attachment_image($image_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail' ));
                if(!empty($image)){
                    $search_data[count($search_data) - 1]['thumbnail'] = $image;
                }
            }
            
        endforeach;

        $search_output = json_encode($search_data);
        header('Content-Type: application/json');
         echo sprintf(__('%s','uiart'),$search_output) ;
        die();
    }

    public function wooc_product_search_callback() {

        if(isset( WOOCTheme::$options['wooc_search_auto_suggest_status'])
            &&  WOOCTheme::$options['wooc_search_auto_suggest_status']){
        ?>

            <script type="text/javascript">
                jQuery(function($) {

                    var ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php')) ?>";


                    var currentAjaxRequest = null;

                    var searchForms = $('.product-search .search-dropdown form.searchform').css('position','relative').each(function() {

                      var input = $(this).find('input[name="s"]');

                      var offSet = input.position().top + input.innerHeight() + 1;
                      $('<ul class="psearch-results"></ul>').css( { 'position': 'absolute', 'left': '0px', 'top': offSet } ).appendTo($(this)).hide();

                      input.on('keyup change', function() {

                        var term = $(this).val();

                        var form = $(this).closest('form');

                        var searchURL = ajaxurl+'?action=ajax_product_search&q=' + term;

                        var resultsList = form.find('.psearch-results');

                        var subm = form.find('button[type="submit"]');


                        if (term.length > 2 && term != $(this).attr('data-old-term')) {
                            if(subm.hasClass('icon-search')){
                                subm.removeClass('icon-search').addClass('fa fa-spinner fa-spin');
                            }

                          $(this).attr('data-old-term', term);

                          if (currentAjaxRequest != null) currentAjaxRequest.abort();

                          currentAjaxRequest = $.getJSON(searchURL + '&view=json', function(data) {

                            resultsList.empty();

                            subm.removeClass('fa fa-spinner fa-spin').addClass('icon-search');


                            if(data.results_count == 0) {
                              resultsList.hide();
                            } else {

                              $.each(data, function(index, item) {
                                var link = $('<a></a>').attr('href', item.url);
                                link.append('<span class="title">' + item.title + '</span>');
                                link.append('<span class="price-html">' + item.price_html + '</span>');
                                if(typeof item.thumbnail != 'undefined'){
                                    link.append('<span class="thumbnail">' + item.thumbnail + '</span>');
                                }
                                link.wrap('<li></li>');
                                resultsList.append(link.parent());
                              });

                              if(data.results_count > 10) {
                                resultsList.append('<li><span class="title"><a href="' + searchURL + '"><?php esc_html_e('See all results', 'uiart')?> (' + data.results_count + ')</a></span></li>');
                              }
                              resultsList.fadeIn(200);
                            }
                            //$('.search-results').css( { 'width': '.input-outer.input-group.border-radius-default'.innerWidth() + 2 });
                          });
                        }
                      });
                    });

                    $('body').bind('click', function(){
                        $('.psearch-results').hide();
                    });                  

                });
            </script>
        <?php
        }
    }

    public static function get_instance(){

        if(empty(self::$instance)
            or !is_object(self::$instance)
            or !(self::$instance instanceof Wooc_product_aj_search)){

            return self::$instance = new Wooc_product_aj_search();
        }
        return self::$instance;
    }
}

$wooc_auto_search = Wooc_product_aj_search::get_instance();

add_action('wp_footer',array($wooc_auto_search,'wooc_product_search_callback'),20);
add_action('wp_ajax_ajax_product_search', array($wooc_auto_search, 'wooc_sratch_ajax_responder'));
add_action('wp_ajax_nopriv_ajax_product_search', array($wooc_auto_search, 'wooc_sratch_ajax_responder'));
