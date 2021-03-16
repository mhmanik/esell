let WooCommerce =  {

    wooc_SimpleBar: () => {
        var $ = jQuery;
        if ($('.additional-menu-msidebar').length > 0) {
            new SimpleBar($('.additional-menu-msidebar')[0]);
        }
    },

	/* Single Product-2 relocate meta */
	meta_reloation : () => {
		$('.product-type-variable .single-product-top-2 .product_meta-area-js, .product-type-variable .single-product-top-3 .product_meta-area-js').insertAfter('form.variations_form table.variations');
	},

	/* Sticky product thumbnail */
	sticky_product_thumbnail : () => {
		if (typeof $.fn.stickySidebar == 'function') {

			let screenWidth = $('body').outerWidth();

			if ( screenWidth > 991 ) {
				let top = 20;
				if ( UiartObj.hasStickyMenu == 1 ) {
					top += $('.header-main-block-sticky-wrapper').outerHeight();
				}
				if ( UiartObj.hasAdminBar == 1 ) {
					top += $('#wpadminbar').outerHeight();
				}

				$('.single-product-area-2 .wooc-sticky-left').stickySidebar({
					topSpacing: top
				});	
			}
		}
	},	

	/* Quantity change */
	quantity_change : () => {
		$(document).on('click', '.quantity .input-group-btn .quantity-btn',function(){
			var $input = $(this).closest('.quantity').find('.input-text');

			if ( $(this).hasClass('quantity-plus') ) {
				$input.trigger('stepUp').trigger('change');
			}

			if ( $(this).hasClass('quantity-minus') ) {
				$input.trigger('stepDown').trigger('change');
			}
		});
	},

	/* Product slider navigation height */
	slider_nav : () => {
		$('.woocueproduct-slider').each(function() {
			var $target = $(this).find('.owl-custom-nav .owl-nav button.owl-prev, .owl-custom-nav .owl-nav button.owl-next'),
			$img = $(this).find('.woocue-thumb-wrapper').first();

			if ($img.length) {
				var height = $img.outerHeight();
				height = height/2 - 24;
				$target.css('top', height + 'px');
			}
		});
	},

	/* Wishlist icon */
	wishlist_icon : () => {
		$(document).on('click', '.wooctheme-wishlist-icon',function(){
			if ( $(this).hasClass('wooctheme-add-to-wishlist')) {

				var $obj   = $(this),
				productId  = $obj.data('product-id'),
				afterTitle = $obj.data('title-after');

				var data = {
					'action'          : 'uiart_add_to_wishlist',
					'context'         : 'frontend',
					'nonce'           : $obj.data('nonce'),
					'add_to_wishlist' : productId,
				};

				$.ajax({
					url : UiartObj.ajaxurl,
					type : 'POST',
					data : data,
					beforeSend : function () {
						$obj.find('.wishlist-icon').hide();
						$obj.find('.ajax-loading').show();
						$obj.addClass('wooctheme-wishlist-ajaxloading');
					},
					success : function( data ){
						if ( data['result'] != 'error' ) {
							$obj.find('.ajax-loading').hide();
							$obj.removeClass('wooctheme-wishlist-ajaxloading');
							$obj.find('.wishlist-icon').removeClass('fa-heart-o').addClass('fa-heart').show();
							$obj.removeClass('wooctheme-add-to-wishlist').addClass('wooctheme-remove-from-wishlist');
							$obj.attr('title', afterTitle);
						}
						else {
							console.log(data['message']);
						}
					}
				});

				return false;
			}
		});
	}
}

export default WooCommerce;