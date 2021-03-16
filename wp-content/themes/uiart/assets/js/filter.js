(function($){
	'use strict';

	$(document).ready(function(){

		if (UiartObj.product_filter != 'ajax' ) return;

		$('button.button').hide();

		$('.widget a').on('click', function(e){
			e.preventDefault();
			
			var query_url = '';
			
			// Property Filter Link Click
			if($(e.target).hasClass('rtwpvs-term-span')){

				$('[data-term]').removeClass('selected');
				
				var attribute_name = $(e.target).closest('[data-attribute_name]').attr('data-attribute_name').replace('attribute_pa', 'filter');
				var term_name = $(e.target).closest('[data-term]').addClass('selected').attr('data-term');

				// Full Request URL
				var full_url = new URL(window.location.href);
				full_url.searchParams.set(attribute_name, term_name);

				query_url = full_url.href;
				
			} else {
				query_url = $(e.target).attr('href');
			}

			window.history.pushState('page-id', 'Ajax Load', query_url);

			$.ajax({
				url: UiartObj.ajaxurl,
				data: {
					action: 'load_template',
					template: 'archive',
					part: 'product',
					query_url: query_url,
				},
				type: "POST",
				success: function(data) {

					$(".wooctheme-archive-products").html(data);

					$(document).trigger('rt_filter_ajax_load');

				},

				error: function(MLHttpRequest, textStatus, errorThrown){
					console.log(errorThrown);
				}
			});

		});

		// Price Filter
		$('.widget .price_label').ready(function(){

			$('.widget .price_label').bind('DOMSubtreeModified', function(){

				// console.log("Price Changed");

				var from = parseInt($('.price_label .from').html().replace('$', ''));
				var to = parseInt($('.price_label .to').html().replace('$', ''));

				// console.log(typeof(from));

				// console.log(parseInt("Hello 40 Years."));

				// console.log(`from ${from} to ${to}`);

				var url = new URL(window.location.href);

				url.searchParams.set('min_price', from);
				url.searchParams.set('max_price', to);
				window.history.pushState('page-id', 'Ajax Load', url);
				// console.log(url.href);

				// typeof($);

				$.ajax({
					url: UiartObj.ajaxurl,
					type: "POST",
					// processData: false,
					// contentType: false,
					data: {
						action: 'load_template',
						template: 'archive',
						part: 'product',
						query_url: url.href,
					},
					success: function(data) {

						$(".wooctheme-archive-products").html(data);

						$(document).trigger('rt_filter_ajax_load');

					},

					error: function(MLHttpRequest, textStatus, errorThrown){
						console.log(errorThrown);
					}
				});

			});

		})
		
		function fetch_filtered_data(){

			

		}

	});

})(jQuery);