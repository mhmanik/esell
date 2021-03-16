import theme from './theme';
import wc from './woocommerce';
import loadmore from './loadmore';
import widthgen from './widthgen';

loadmore();
widthgen();


	// After filter ajax load
	$(document).on('rt_filter_ajax_load', function(){
		theme.slick_carousel();
		typeof(slick_carousel);
		loadmore();
	})
	
function content_ready_scripts(){
	theme.countdown(); /* Countdown */
	theme.magnific_popup(); /* Magnific Popup */
	theme.vertical_menu();
	theme.vertical_menu_mobile();
	theme.category_search_dropdown();
	theme.wooc_offcanvas_menu();
	theme.wooc_offcanvas_menu_layout();
	theme.wooc_offcanvas_icon_menu_layout();	
	theme.wooc_niceSelect();	
	theme.wooc_tooltip();	
	theme.wooc_toltp();	
	theme.wooc_SimpleBar();	
	//theme.wooc_offcanvas_menu_list();	
	theme.wooc_offcanvas_menu_list_icon();
	theme.wooc_toggle_right();
	theme.wooc_active_animation();	
}


function content_load_scripts(){
	theme.isotope(); /* Isotope */
	theme.owl_carousel(); /* Owl Carousel */
	theme.slick_carousel(); /* Slick Carousel */
	theme.ripple_effect(); /* Water Ripple */
	theme.wooc_banner_slider(); /* Water Ripple */
	theme.wooc_banner_slider_fashion(); /* Water Ripple */
	theme.wooc_removeAttr_right(); /* Water Ripple */
	theme.wooc_logo_slider(); /* Water Ripple */
	
}

$(document).ready(function(){
	theme.scroll_to_top(); /* Scroll to top */
	theme.sticky_menu(); /* Sticky Menu */
	theme.mobile_menu(); /* MeanMenu - Mobile Menu */
	theme.multi_column_menu(); /* Mega Menu */
	theme.search_popup(); /* Header Search */
	wc.quantity_change(); /* Quantity change */
	wc.wishlist_icon(); /* Wishlist icon */
	wc.meta_reloation();	
	content_ready_scripts();
});

$(window).on('load', function () {
	content_load_scripts();
	theme.preloader(); /* Preloader */
	wc.sticky_product_thumbnail();
});

$(window).on('load resize', function () {
	theme.mobile_menu_max_height(); /* Define the maximum height for mobile menu */
	wc.slider_nav(); /* Product slider navigation height */
});

$(window).on('elementor/frontend/init', function() {
	if (elementorFrontend.isEditMode()) {
		elementorFrontend.hooks.addAction('frontend/element_ready/widget', function(){
			content_ready_scripts()
			content_load_scripts();
		});
	}
});

