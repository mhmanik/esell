(function() {
	'use strict';
	var $ = jQuery;
	
		function loadmore_n_infinityscroll() {
		var loadMoreWrapper = $('.axiltheme-loadmore-wrapper'),
			infinityScrollWrapper = $('.axiltheme-infscroll-wrapper');

		if (loadMoreWrapper.length) {
			loadMore(loadMoreWrapper);
		}

		if (infinityScrollWrapper.length) {
			infinityScroll(infinityScrollWrapper);
		}

		function loadMore($wrapper) {
			var button = $('.axiltheme-loadmore-btn'),
				shopData = $('.axiltheme-loadmore-data'),
				maxPage = shopData.data('max'),
				query = shopData.attr('data-query'),
				CurrentPage = 1;
			button.on('click', button, function() {
				var data = {
					'action': 'axiltheme_loadmore',
					'context': 'frontend',
					'nonce': shopData.data('nonce'),
					'query': query,
					'view': $('body').hasClass('product-list-view') ? 'list' : 'grid',
					'paged': CurrentPage
				};
				$.ajax({
					url: WoocEsellObj.ajaxurl,
					type: 'POST',
					data: data,
					beforeSend: function beforeSend() {
						disableBtn(button);
					},
					success: function success(data) {
						if (data) {
							CurrentPage++;
							$wrapper.append(data);
							WcUpdateResultCount($wrapper);

							if (CurrentPage == maxPage) {
								removeBtn(button);
							} else {
								enableBtn(button);
							}

							$(document).trigger("afterLoadMore");
						} else {
							removeBtn(button);
						}
					}
				});
				return false;
			});
		}

		function infinityScroll($wrapper) {
			var canBeLoaded = true,
				shopData = $('.axiltheme-loadmore-data'),
				icon = $('.axiltheme-infscroll-icon'),
				query = shopData.attr('data-query'),
				CurrentPage = 1;
			$(window).on('scroll load', function() {
				if (!canBeLoaded) {
					return;
				}

				var data = {
					'action': 'axiltheme_loadmore',
					'context': 'frontend',
					'nonce': shopData.data('nonce'),
					'query': query,
					'paged': CurrentPage
				};

				if (isScrollable($wrapper)) {
					$.ajax({
						url: WoocEsellObj.ajaxurl,
						type: 'POST',
						data: data,
						beforeSend: function beforeSend() {
							canBeLoaded = false;
							icon.show();
						},
						success: function success(data) {
							if (data) {
								CurrentPage++;
								canBeLoaded = true;
								$wrapper.append(data);
								WcUpdateResultCount($wrapper);
								icon.hide();
								$(document).trigger("afterInfinityScroll");
							} else {
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

			if (ajaxVisible <= ajaxScrollTop && ajaxVisible + $(window).height() > ajaxScrollTop) {
				return true;
			}

			return false;
		}

		function WcUpdateResultCount($wrapper) {
			var count = $($wrapper).find('.product').length;
			$('.wc-last-result-count').text(count);
		}

		function disableBtn(button) {
			button.attr('disabled', 'disabled');
			button.find('.axiltheme-loadmore-btn-text').hide();
			button.find('.axiltheme-loadmore-btn-icon').show();
		}

		function enableBtn(button) {
			button.find('.axiltheme-loadmore-btn-icon').hide();
			button.find('.axiltheme-loadmore-btn-text').show();
			button.removeAttr('disabled');
		}

		function removeBtn(button) {
			button.parent('.axiltheme-loadmore-btn-area').remove();
		}
	}

	function widthgen() {
		$(window).on('load resize', elementWidth);

		function elementWidth() {
			$('.elementwidth').each(function() {
				var $container = $(this),
					width = $container.outerWidth(),
					classes = $container.attr("class").split(' ');
				var classes1 = startWith(classes, 'elwidth');
				classes1 = classes1[0].split('-');
				classes1.splice(0, 1);
				var classes2 = startWith(classes, 'elmaxwidth');
				classes2.forEach(function(el) {
					$container.removeClass(el);
				});
				classes1.forEach(function(el) {
					var maxWidth = parseInt(el);

					if (width <= maxWidth) {
						$container.addClass('elmaxwidth-' + maxWidth);
					}
				});
			});
		}

		function startWith(item, stringName) {
			return $.grep(item, function(elem) {
				return elem.indexOf(stringName) == 0;
			});
		}
	}


	loadmore_n_infinityscroll();
	widthgen();

	
}());