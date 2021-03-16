function loadmore_n_infinityscroll(){
	
	var loadMoreWrapper   = $('.wooctheme-loadmore-wrapper'),
	infinityScrollWrapper = $('.wooctheme-infscroll-wrapper');

	if (loadMoreWrapper.length) {
		loadMore(loadMoreWrapper);
	}

	if (infinityScrollWrapper.length) {
		infinityScroll(infinityScrollWrapper);
	}


	function loadMore($wrapper) {
		var button        = $('.wooctheme-loadmore-btn'),
		shopData          = $('.wooctheme-loadmore-data'),
		maxPage           = shopData.data('max'),
		query             = shopData.attr('data-query'),
		CurrentPage       = 1;

		button.on('click', button, function(){
			var data = {
				'action'  : 'wooctheme_loadmore',
				'context' : 'frontend',
				'nonce'   : shopData.data('nonce'),
				'query'   : query,
				'view': $('body').hasClass('product-list-view') ? 'list' : 'grid',
				'paged'   : CurrentPage
			};

			$.ajax({
				url   : UiartObj.ajaxurl,
				type  : 'POST',
				data  : data,
				beforeSend : function () {
					disableBtn(button);
				},
				success : function( data ){
					if( data ) {
						CurrentPage++;
						$wrapper.append(data);
						WcUpdateResultCount($wrapper);

						if ( CurrentPage == maxPage ) {
							removeBtn(button);
						}
						else {
							enableBtn(button);
						}

						$(document).trigger("afterLoadMore");
					}
					else {
						removeBtn(button);
					}
				}
			});

			return false;
		});
	}

	function infinityScroll($wrapper) {
		var canBeLoaded   = true,
		shopData          = $('.wooctheme-loadmore-data'),
		icon              = $('.wooctheme-infscroll-icon'),
		query             = shopData.attr('data-query'),
		CurrentPage       = 1;

		$(window).on('scroll load', function () {
			if (!canBeLoaded) {
				return;
			}

			var data = {
				'action'  : 'wooctheme_loadmore',
				'context' : 'frontend',
				'nonce'   : shopData.data('nonce'),
				'query'   : query,
				'paged'   : CurrentPage
			};

			if( isScrollable($wrapper) ){
				$.ajax({
					url  : UiartObj.ajaxurl,
					type : 'POST',
					data : data,
					beforeSend: function(){
						canBeLoaded = false;
						icon.show();
					},
					success:function(data){
						if( data ) {
							CurrentPage++;
							canBeLoaded = true;
							$wrapper.append(data);
							WcUpdateResultCount($wrapper);
							icon.hide();
							$(document).trigger("afterInfinityScroll");
						}
						else {
							icon.remove();
						}
					}
				});
			}
		});
	}

	function isScrollable($wrapper) {
		var ajaxVisible = $wrapper.offset().top + $wrapper.outerHeight(true),
		ajaxScrollTop = $(window).scrollTop() + $(window).height();
		if (ajaxVisible <= (ajaxScrollTop) && (ajaxVisible + $(window).height()) > ajaxScrollTop) {
			return true;
		}
		return false;
	}

	function WcUpdateResultCount($wrapper){
		var count = $($wrapper).find('.product').length;
		$('.wc-last-result-count').text(count);
	}

	function disableBtn(button) {
		button.attr('disabled', 'disabled');
		button.find('.wooctheme-loadmore-btn-text').hide();
		button.find('.wooctheme-loadmore-btn-icon').show();
	}

	function enableBtn(button) {
		button.find('.wooctheme-loadmore-btn-icon').hide();
		button.find('.wooctheme-loadmore-btn-text').show();
		button.removeAttr('disabled');
	}

	function removeBtn(button) {
		button.parent('.wooctheme-loadmore-btn-area').remove();
	}
}

export default loadmore_n_infinityscroll;