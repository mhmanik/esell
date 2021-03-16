<?php
namespace wooctheme\Uiart; 

?>
<div id="wooc-shop-search">
    <div class="wooc-row">
        <div class="col-xs-12">
            <div class="wooc-shop-search-inner">
                <div class="wooc-shop-search-input-wrap">
                    <a href="#" id="wooc-shop-search-close">X</a>
                    <form id="wooc-shop-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" id="wooc-shop-search-input" autocomplete="off" value="" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>" />
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
                
                <div id="wooc-shop-search-notice"><span><?php printf( esc_html__( 'press %sEnter%s to search', 'woocommerce' ), '<u>', '</u>' ); ?></span></div>
            </div>
        </div>
    </div>
</div>