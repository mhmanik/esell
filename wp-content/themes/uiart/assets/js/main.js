(function() {
	'use strict';

	var $ = jQuery;

	function _typeof(obj) {
		"@babel/helpers - typeof";

		if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
			_typeof = function(obj) {
				return typeof obj;
			};
		} else {
			_typeof = function(obj) {
				return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
			};
		}

		return _typeof(obj);
	}

	function _defineProperty(obj, key, value) {
		if (key in obj) {
			Object.defineProperty(obj, key, {
				value: value,
				enumerable: true,
				configurable: true,
				writable: true
			});
		} else {
			obj[key] = value;
		}

		return obj;
	}

	var ThemeHelper = {
		run_closeMenuAreaLayout: function run_closeMenuAreaLayout() {
			var menuArea = $('.additional-menu-area');
			var trigger = $('.side-menu-trigger', menuArea);
			trigger.removeClass('side-menu-close').addClass('side-menu-open');

			if (menuArea.find('> .wooc-cover').length) {
				menuArea.find('> .wooc-cover').remove();
			}

			$('.sidenav').css('transform', 'translateX(-100%)');
		},
		run_closeIconMenuAreaLayout: function run_closeIconMenuAreaLayout() {
			var menuArea = $('.additional-menu-area.icon-menu');
			var trigger = $('.side-menu-trigger', menuArea);
			trigger.removeClass('side-menu-close').addClass('side-menu-open');
			menuArea.removeClass('open');

			if (menuArea.find('> .wooc-cover').length) {
				menuArea.find('> .wooc-cover').remove();
			}

			$('.icon-menu-wrp').css('transform', 'translateX(-100%)');
			$('.icon-menu-wrp').removeClass('open');
		},
		run_closeSideMenu: function run_closeSideMenu() {
			var wrapper = $('body').find('>#page'),
				$this = $('#side-menu-trigger a.menu-times');
			wrapper.removeClass('open').find('.offcanvas-mask').remove();
			$("#offcanvas-body-wrapper").attr('style', '');
			$this.prev('.menu-bar').removeClass('open');
			$this.addClass('close');
		},
		run_sticky_menu: function run_sticky_menu() {
			var wrapperHtml = $('<div class="header-main-block-sticky-wrapper"></div>');
			var wrapperClass = '.header-main-block-sticky-wrapper';
			$('.header-main-block').clone().appendTo(wrapperHtml);
			$('#page').append(wrapperHtml);
			var height = $(wrapperClass).outerHeight() + 30;
			$(wrapperClass).css('margin-top', '-' + height + 'px');
			$(window).scroll(function() {
				if ($(this).scrollTop() > 300) {
					$('body').addClass('woocthemeSticky');
				} else {
					$('body').removeClass('woocthemeSticky');
				}
			});
		},
		run_sticky_meanmenu: function run_sticky_meanmenu() {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 50) {
					$('body').addClass("mean-stick");
				} else {
					$('body').removeClass("mean-stick");
				}
			});
		},
		run_isotope: function run_isotope($container, filter) {
			$container.isotope({
				filter: filter,
				layoutMode: 'fitRows',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: true
				}
			});
		},
		add_vertical_menu_class: function add_vertical_menu_class() {
			var screenWidth = $('body').outerWidth();

			if (screenWidth < 992) {
				$('.vertical-menu').addClass('vertical-menu-mobile');
			} else {
				$('.vertical-menu').removeClass('vertical-menu-mobile');
			}
		},
		owl_change_num_pagination: function owl_change_num_pagination($owlParent, index) {
			$owlParent.find('.owl-numbered-dots-items span').removeClass('active');
		}
	};
	var Theme = {
		wooc_active_animation: function wooc_active_animation() {
			if (!!window.IntersectionObserver) {
				var observer = new IntersectionObserver(function(entries, observer) {
					entries.forEach(function(entry) {
						if (entry.isIntersecting) {
							entry.target.classList.add("active-animation");
							observer.unobserve(entry.target);
						}
					});
				}, {
					rootMargin: "0px 0px -100px 0px"
				});
				document.querySelectorAll('.has-animation').forEach(function(block) {
					observer.observe(block);
				});
			} else {
				document.querySelectorAll('.has-animation').forEach(function(block) {
					block.classList.remove('has-animation');
				});
			}
		},
		wooc_removeAttr_right: function wooc_removeAttr_right() {
			var $ = jQuery;
			$("svg").removeAttr("id");
		},
		wooc_toggle_right: function wooc_toggle_right() {
			var $ = jQuery;
			$(".cart-icon-area").mouseover(function() {
				$(this).find(" > .cart-icon-products").css("display", "block");
				$(this).find(" > .cart-icon-products").css("transition", "all 0.5s");
			}).mouseout(function() {
				$(this).find(" > .cart-icon-products").css("display", "none");
			});
		},
		wooc_offcanvas_menu_list: function wooc_offcanvas_menu_list() {
			var $ = jQuery;
			$('.menu-list').on('click', '.menu-item>a', function(e) {
				if ($(this).parents('body').hasClass('has-offcanvas')) {
					var animationSpeed = 500,
						subMenuSelector = '.sub-menu',
						$this = $(this),
						checkElement = $this.next();

					if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
						checkElement.slideUp(animationSpeed, function() {
							checkElement.removeClass('menu-open');
						});
						checkElement.parent(".menu-item").removeClass("active");
					} else if (checkElement.is(subMenuSelector) && !checkElement.is(':visible')) {
						var parent = $this.parents('ul').first();
						var ul = parent.find('ul:visible').slideUp(animationSpeed);
						ul.removeClass('menu-open');
						var parent_li = $this.parent("li");
						checkElement.slideDown(animationSpeed, function() {
							checkElement.addClass('menu-open');
							parent.find('.menu-item.active').removeClass('active');
							parent_li.addClass('active');
						});
					}

					if (checkElement.is(subMenuSelector)) {
						e.preventDefault();
					}
				} else {
					if ($(this).attr('href') === "#") {
						e.preventDefault();
					}
				}
			});
		},
		wooc_offcanvas_menu_list_icon: function wooc_offcanvas_menu_list_icon() {
			var $ = jQuery;
			$('.menu-list').on('click', '.menu-item>a', function(e) {
				if ($(this).parents('body').hasClass('has-offcanvas')) {
					var animationSpeed = 500,
						subMenuSelector = '.sub-menu',
						$this = $(this),
						checkElement = $this.next();

					if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
						checkElement.slideUp(animationSpeed, function() {
							checkElement.removeClass('menu-open');
						});
						checkElement.parent(".menu-item").removeClass("active");
					} else if (checkElement.is(subMenuSelector) && !checkElement.is(':visible')) {
						var parent = $this.parents('ul').first();
						var ul = parent.find('ul:visible').slideUp(animationSpeed);
						ul.removeClass('menu-open');
						var parent_li = $this.parent("li");
						checkElement.slideDown(animationSpeed, function() {
							checkElement.addClass('menu-open');
							parent.find('.menu-item.active').removeClass('active');
							parent_li.addClass('active');
						});
					}

					if (checkElement.is(subMenuSelector)) {
						e.preventDefault();
					}
				} else {
					if ($(this).attr('href') === "#") {
						e.preventDefault();
					}
				}
			});
		},
		wooc_SimpleBar: function wooc_SimpleBar() {
			var $ = jQuery;

			if ($('.additional-menu-msidebar').length > 0) {
				new SimpleBar($('.additional-menu-msidebar')[0]);
			}
		},
		wooc_tooltip: function wooc_tooltip() {
			var $ = jQuery;

			if ($('[data-toggle="tooltip"]').length > 0) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		},
		wooc_toltp: function wooc_toltp() {
			$(document).on('mouseover', '.wooc-toltp', function() {
				var self = $(this),
					tips = self.attr('data-tips');
				$tooltip = '<div class="uiart-tooltip">' + '<div class="uiart-tooltip-content">' + tips + '</div>' + '<div class="uiart-tooltip-bottom"></div>' + '</div>';
				$('body').append($tooltip);
				var $tooltip = $('body > .uiart-tooltip');
				var tHeight = $tooltip.outerHeight();
				var tBottomHeight = $tooltip.find('.uiart-tooltip-bottom').outerHeight();
				var tWidth = $tooltip.outerWidth();
				var tHolderWidth = self.outerWidth();
				var top = self.offset().top - (tHeight - tBottomHeight) - 26;
				var left = self.offset().left;
				$tooltip.css({
					'top': top + 'px',
					'left': left + 'px',
					'opacity': 1
				}).show();

				if (tWidth <= tHolderWidth) {
					var itemLeft = (tHolderWidth - tWidth) / 2;
					left = left + itemLeft;
					$tooltip.css('left', left + 'px');
				} else {
					var itemLeft = (tWidth - tHolderWidth) / 2;
					left = left - itemLeft;

					if (left < 0) {
						left = 0;
					}

					$tooltip.css('left', left + 'px');
				}
			}).on('mouseout', '.wooc-toltp', function() {
				$('body > .uiart-tooltip').remove();
			});
		},
		wooc_niceSelect: function wooc_niceSelect() {
			var $ = jQuery;

			if ($('select').length > 0) {
				$('select').niceSelect();
			}
		},
		wooc_banner_slider: function wooc_banner_slider() {
			var SlickCarousel = $('.wooc-product-banner');

			if (SlickCarousel.length) {
				try {
					if (SlickCarousel.find('.slick-carousel-content').hasClass('slick-initialized')) {
						SlickCarousel.find('.slick-carousel-content').slick('unslick');
					}

					if (SlickCarousel.find('.slick-carousel-nav').hasClass('slick-initialized')) {
						SlickCarousel.find('.slick-carousel-nav').slick('unslick');
					}
				} catch (e) {}

				SlickCarousel.find('.slick-carousel-content').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					asNavFor: '.slick-carousel-nav',
					infinite: false,
					autoplay: true,
					responsive: [{
						breakpoint: 769
					}]
				});
				SlickCarousel.find('.slick-carousel-nav').slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					vertical: true,
					asNavFor: '.slick-carousel-content',
					dots: false,
					focusOnSelect: true,
					verticalSwiping: false,
					centerMode: false,
					centerPadding: '0',
					arrows: true,
					prevArrow: '<div class="slick-prev-banner"><i class="fa fa-angle-up"></i><span class="sr-only">Prev</span></div>',
					nextArrow: '<div class="slick-next-banner"><i class="fa fa-angle-down"></i><span class="sr-only">Next</span></div>',
					autoplay: true,
					autoplaySpeed: 5000,
					infinite: false,
					responsive: [{
						breakpoint: 1200,
						settings: {
							vertical: true,
							slidesToShow: 2
						}
					}, {
						breakpoint: 992,
						settings: {
							vertical: true,
							slidesToShow: 2
						}
					}, {
						breakpoint: 768,
						settings: {
							vertical: true,
							slidesToShow: 2
						}
					}]
				});
			}
		},
		wooc_logo_slider: function wooc_logo_slider() {
			var logoSlickCarousel = $('.uiart-logo-slider');

			if (logoSlickCarousel.length) {
				var _logoSlickCarousel$fi;

				try {
					if (logoSlickCarousel.find('.brand-slider-active').hasClass('slick-initialized')) {
						logoSlickCarousel.find('.brand-slider-active').slick('unslick');
					}
				} catch (e) {}

				logoSlickCarousel.find('.brand-slider-active').slick((_logoSlickCarousel$fi = {
					dots: false,
					infinite: true,
					adaptiveHeight: true
				}, _defineProperty(_logoSlickCarousel$fi, "infinite", true), _defineProperty(_logoSlickCarousel$fi, "arrows", false), _defineProperty(_logoSlickCarousel$fi, "autoplay", true), _defineProperty(_logoSlickCarousel$fi, "autoplaySpeed", 5000), _defineProperty(_logoSlickCarousel$fi, "fade", false), _defineProperty(_logoSlickCarousel$fi, "speed", 1000), _defineProperty(_logoSlickCarousel$fi, "pauseOnHover", false), _defineProperty(_logoSlickCarousel$fi, "pauseOnFocus", false), _defineProperty(_logoSlickCarousel$fi, "slidesToShow", 5), _defineProperty(_logoSlickCarousel$fi, "slidesToScroll", 1), _defineProperty(_logoSlickCarousel$fi, "responsive", [{
					breakpoint: 1350,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
				}, {
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				}, {
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						adaptiveHeight: false
					}
				}, {
					breakpoint: 768,
					settings: {
						adaptiveHeight: false,
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]), _logoSlickCarousel$fi));
			}
		},
		wooc_banner_slider_fashion: function wooc_banner_slider_fashion() {
			var SlickCarousel = $('.wooc-product-banner-fashion');

			if (SlickCarousel.length) {
				try {
					if (SlickCarousel.find('.slick-carousel-content').hasClass('slick-initialized')) {
						SlickCarousel.find('.slick-carousel-content').slick('unslick');
					}

					if (SlickCarousel.find('.slick-carousel-nav').hasClass('slick-initialized')) {
						SlickCarousel.find('.slick-carousel-nav').slick('unslick');
					}
				} catch (e) {}

				SlickCarousel.find('.slick-carousel-content').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					asNavFor: '.slick-carousel-nav',
					infinite: false,
					autoplay: false,
					autoplaySpeed: 20000,
					speed: 2000,
					responsive: [{
						breakpoint: 769
					}]
				});
				SlickCarousel.find('.slick-carousel-nav').slick({
					slidesToShow: 2,
					slidesToScroll: 1,
					vertical: false,
					asNavFor: '.slick-carousel-content',
					dots: false,
					focusOnSelect: true,
					verticalSwiping: false,
					centerMode: false,
					centerPadding: '0',
					arrows: true,
					prevArrow: '<div class="slick-prev-banner"><i class="fas fa-long-arrow-alt-up"></i><span class="sr-only">Prev</span></div>',
					nextArrow: '<div class="slick-next-banner"><i class="fas fa-long-arrow-alt-down"></i><span class="sr-only">Next</span></div>',
					autoplay: false,
					autoplaySpeed: 7000,
					speed: 2000,
					infinite: false,
					responsive: [{
						breakpoint: 1200,
						settings: {
							vertical: false,
							slidesToShow: 2
						}
					}, {
						breakpoint: 992,
						settings: {
							vertical: false,
							slidesToShow: 2
						}
					}, {
						breakpoint: 768,
						settings: {
							vertical: false,
							slidesToShow: 2
						}
					}]
				});
			}
		},
		wooc_offcanvas_menu: function wooc_offcanvas_menu() {
			$('#page').on('click', '.offcanvas-menu-btn', function(e) {
				e.preventDefault();
				var $this = $(this),
					wrapper = $(this).parents('body').find('>#page'),
					wrapMask = $('<div />').addClass('offcanvas-mask'),
					offCancas = document.getElementById('offcanvas-body-wrap');

				if ($this.hasClass('menu-status-open')) {
					wrapper.addClass('open').append(wrapMask);
					$this.removeClass('menu-status-open').addClass('menu-status-close');
					offCancas.style.transform = 'translateX(' + 0 + 'px)';
					$('body').css({
						overflow: 'hidden',
						transition: 'all 0.3s ease-out'
					});
				} else {
					wrapper.removeClass('open').find('> .offcanvas-mask').remove();
					$this.removeClass('menu-status-close').addClass('menu-status-open');
					offCancas.style.transform = 'translateX(' + -100 + '%)';

					if (UiartObj.rtl == 'yes') {
						offCancas.style.transform = 'translateX(' + 100 + '%)';
					}

					$('body').css({
						overflow: 'visible',
						transition: 'all 0.3s ease-out'
					});
				}

				return false;
			});
			$('#page').on('click', '#side-menu-trigger a.menu-times', function(e) {
				e.preventDefault();
				var $this = $(this);
				$("#offcanvas-body-wrapper").attr('style', '');
				$this.prev('.menu-bar').removeClass('open');
				$this.addClass('close');
				ThemeHelper.run_closeSideMenu();
				return false;
			});

			$(document).on('click', '#page.open .offcanvas-mask', function() {
				ThemeHelper.run_closeSideMenu();
			});
			$(document).on('keyup', function(event) {
				if (event.which === 27) {
					event.preventDefault();
					ThemeHelper.run_closeSideMenu();
				}
			});
		},
		wooc_offcanvas_menu_layout: function wooc_offcanvas_menu_layout() {
			var menuArea = $('.additional-menu-area');
			menuArea.on('click', '.side-menu-trigger', function(e) {
				e.preventDefault();
				var self = $(this);

				if (self.hasClass('side-menu-open')) {
					$('.sidenav').css('transform', 'translateX(0%)');

					if (!menuArea.find('> .wooc-cover').length) {
						menuArea.append("<div class='wooc-cover'></div>");
					}

					self.removeClass('side-menu-open').addClass('side-menu-close');
				}
			});
			menuArea.on('click', '.closebtn', function(e) {
				e.preventDefault();
				ThemeHelper.run_closeMenuAreaLayout();
			});
			$(document).on('click', '.wooc-cover', function() {
				ThemeHelper.run_closeMenuAreaLayout();
			});
		},
		wooc_offcanvas_icon_menu_layout: function wooc_offcanvas_icon_menu_layout() {
			var menuArea = $('.additional-menu-area.icon-menu');
			menuArea.on('click', '.side-menu-trigger', function(e) {
				e.preventDefault();
				var self = $(this);

				if (self.hasClass('side-menu-open')) {
					$('.left-icon-menu .icon-menu-wrp').css('transform', 'translateX(0%)');

					if (!menuArea.find('> .wooc-cover').length) {
						menuArea.append("<div class='wooc-cover'></div>");
					}

					self.removeClass('side-menu-open').addClass('side-menu-close');
					menuArea.find('> .closebtn').addClass('open');
				}
			});
			menuArea.on('click', '.closebtn', function(e) {
				e.preventDefault();
				ThemeHelper.run_closeIconMenuAreaLayout();
			});
			$(document).on('click', '.wooc-cover', function() {
				ThemeHelper.run_closeIconMenuAreaLayout();
			});
		},
		scroll_to_top: function scroll_to_top() {
			$('.scrollToTop').on('click', function() {
				$('html, body').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
			$(window).scroll(function() {
				if ($(window).scrollTop() > 300) {
					$('.scrollToTop').addClass('back-top');
				} else {
					$('.scrollToTop').removeClass('back-top');
				}
			});
		},
		preloader: function preloader() {
			$('#preloader').fadeOut('slow', function() {
				$(this).remove();
			});
		},
		sticky_menu: function sticky_menu() {
			if (UiartObj.hasStickyMenu == 1) {
				ThemeHelper.run_sticky_menu();
				ThemeHelper.run_sticky_meanmenu();
			}
		},
		ripple_effect: function ripple_effect() {
			if (typeof $.fn.ripples == 'function') {
				$('.wooc-water-ripple').ripples({
					resolution: 712,
					dropRadius: 30,
					perturbance: 0.01
				});
			}
		},
		category_search_dropdown: function category_search_dropdown() {
			$('.category-search-dropdown-js .dropdown-menu li').on('click', function(e) {
				var $parent = $(this).closest('.category-search-dropdown-js'),
					slug = $(this).data('slug'),
					name = $(this).text();
				$parent.find('.dropdown-toggle').text($.trim(name));
				$parent.find('input[name="product_cat"]').val(slug);
			});

			if ($.fn.autocomplete) {
				$(".ps-autocomplete-js .product-autocomplete-js").autocomplete({
					minChars: 2,
					search: function search(event, ui) {
						if (!$(event.target).parent().find('.product-autocomplete-spinner').length) {
							$('<i class="product-autoaomplete-spinner fa fa-spinner fa-spin"></i>').insertAfter(event.target);
						}
					},
					source: function source(req, response) {
						req.action = 'uiart_product_search_autocomplete';
						$.ajax({
							dataType: "json",
							type: "POST",
							url: UiartObj.ajaxurl,
							data: req,
							success: function success(data) {
								response(data);
							}
						});
					},
					response: function response(event, ui) {
						$(event.target).parent().find('.product-autoaomplete-spinner').remove();
					}
				});
			}
		},
		search_popup: function search_popup() {
			$('.search-icon-area a').on("click", function(event) {
				event.preventDefault();
				$("#wooctheme-search-popup").addClass("open");
				$('#wooctheme-search-popup > form > input').focus();
			});
			$("#wooctheme-search-popup, #wooctheme-search-popup button.close").on("click keyup", function(event) {
				if (event.target == this || event.target.className == "close" || event.keyCode == 27) {
					$(this).removeClass("open");
				}
			});
		},
		vertical_menu: function vertical_menu() {
			$('.vertical-menu-btn').on('click', function(e) {
				e.preventDefault();
				$(this).closest('.vertical-menu-area').toggleClass("opened");
			});
		},
		vertical_menu_mobile: function vertical_menu_mobile() {
			ThemeHelper.add_vertical_menu_class();
			$(window).on('resize', function() {
				ThemeHelper.add_vertical_menu_class();
			});
			$('.vertical-menu').on('click', 'li.menu-item-has-children span.has-dropdown', function(e) {
				if ($(this).find('+ ul.sub-menu').length) {
					$(this).closest('li').toggleClass('submenu-opend');
					$(this).find('+ ul.sub-menu').slideToggle();
				}

				return false;
			});
		},
		mobile_menu: function mobile_menu() {
			$('#site-header .main-navigation nav').meanmenu({
				meanMenuContainer: '#meanmenu',
				meanScreenWidth: UiartObj.meanWidth,
				removeElements: "#site-header, .top-header-desktop",
				siteLogo: UiartObj.siteLogo,
				meanExpand: '<i class="flaticon-menu"></i>',
				meanContract: '<i class="flaticon-remove-1"></i>',
				meanMenuClose: '<i class="flaticon-remove-1"></i>',
				appendHtml: UiartObj.appendHtml
			});
		},
		mobile_menu_max_height: function mobile_menu_max_height() {
			var wHeight = $(window).height();
			wHeight = wHeight - 50;
			$('.mean-nav > ul').css('max-height', wHeight + 'px');
		},
		multi_column_menu: function multi_column_menu() {
			$('.main-navigation ul > li.mega-menu').each(function() {
				var items = $(this).find(' > ul.sub-menu > li').length;
				var bodyWidth = $('body').outerWidth();
				var parentLinkWidth = $(this).find(' > a').outerWidth();
				var parentLinkpos = $(this).find(' > a').offset().left;
				var width = items * 244;
				var left = width / 6 - parentLinkWidth / 2;
				var linkleftWidth = parentLinkpos + parentLinkWidth / 2;
				var linkRightWidth = bodyWidth - (parentLinkpos + parentLinkWidth);

				if (width / 2 > linkleftWidth) {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						right: 'inherit',
						left: '-' + parentLinkpos + 'px'
					});
				} else if (width / 2 > linkRightWidth) {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						left: 'inherit',
						right: '-' + linkRightWidth + 'px'
					});
				} else {
					$(this).find(' > ul.sub-menu').css({
						width: width + 'px',
						left: '-' + left + 'px'
					});
				}
			});
		},
		isotope: function isotope() {
			if (typeof $.fn.isotope == 'function' && typeof $.fn.imagesLoaded == 'function') {
				var $blogIsotopeContainer = $('.post-isotope');
				$blogIsotopeContainer.imagesLoaded(function() {
					$blogIsotopeContainer.isotope();
				});
				var $isotopeContainer = $('.woocueisotope-container');
				$isotopeContainer.imagesLoaded(function() {
					$isotopeContainer.each(function() {
						var $container = $(this).find('.woocueisotope-wrapper'),
							filter = $(this).find('.woocueisotope-tab a.current').data('filter');
						ThemeHelper.run_isotope($container, filter);
					});
				});
				$('.woocueisotope-tab a').on('click', function() {
					$(this).closest('.woocueisotope-tab').find('.current').removeClass('current');
					$(this).addClass('current');
					var $container = $(this).closest('.woocueisotope-container').find('.woocueisotope-wrapper'),
						filter = $(this).attr('data-filter');
					ThemeHelper.run_isotope($container, filter);
					return false;
				});
			}
		},
		slick_carousel: function slick_carousel() {
			if (typeof $.fn.slick == 'function') {
				$(".wooc-slick-slider").each(function() {
					$(this).slick({
						rtl: UiartObj.rtl
					});
				});
				$(document).on('afterLoadMore afterInfinityScroll', function() {
					$(".product_loaded .wooc-slick-slider").each(function() {
						$(this).slick({
							rtl: UiartObj.rtl
						});
					});
					$(".product_loaded").removeClass('product_loaded');
				});
			}
		},
		owl_carousel: function owl_carousel() {
			if (typeof $.fn.owlCarousel == 'function') {
				$(".owl-custom-nav .owl-next").on('click', function() {
					$(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
				});
				$(".owl-custom-nav .owl-prev").on('click', function() {
					$(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
				});
				$(".wooc-owl-carousel").each(function() {
					var options = $(this).data('carousel-options');

					if (UiartObj.rtl == 'yes') {
						options['rtl'] = true;
						options['navText'] = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
					}

					$(this).owlCarousel(options);
				});
				$(".owl-numbered-dots .owl-numbered-dots-items span").on('click', function() {
					var index = $(this).data('num');
					var $owlParent = $(this).closest('.owl-wrap').find('.owl-carousel');
					$owlParent.trigger('to.owl.carousel', index);
					$owlParent.find('.owl-numbered-dots-items span').removeClass('active');
					$owlParent.find('.owl-numbered-dots-items [data-num="' + index + '"]').addClass('active');
				});
			}
		},
		countdown: function countdown() {
			if (typeof $.fn.countdown == 'function') {
				try {
					var day = UiartObj.day == 'Day' ? 'Day%!D' : UiartObj.day,
						hour = UiartObj.hour == 'Hour' ? 'Hour%!D' : UiartObj.hour,
						minute = UiartObj.minute == 'Minute' ? 'Minute%!D' : UiartObj.minute,
						second = UiartObj.second == 'Second' ? 'Second%!D' : UiartObj.second;
					$('.woocjs-coutdown').each(function() {
						var $CountdownSelector = $(this).find('.wooc-scripts-date');
						var eventCountdownTime = $CountdownSelector.data('time');
						$CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
							$(this).html(event.strftime('' + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%D</div><div class="wooc-countdown-text">' + day + '</div></div>' + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%H</div><div class="wooc-countdown-text">' + hour + '</div></div>' + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%M</div><div class="wooc-countdown-text">' + minute + '</div></div>' + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%S</div><div class="wooc-countdown-text">' + second + '</div></div>'));
						}).on('finish.countdown', function(event) {
							$(this).html(event.strftime(''));
						});
					});
					$('.woocjs-coutdown-2').each(function() {
						var $CountdownSelector = $(this).find('.wooc-scripts-date');
						var eventCountdownTime = $CountdownSelector.data('time');
						$CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function(event) {
							$(this).html(event.strftime('' + '<div class="wooc-countdown-section-top">' + '<div class="wooc-countdown-section"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%D</div><div class="wooc-countdown-text">' + day + '</div></div></div>' + '<div class="wooc-countdown-section ml10"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%H</div><div class="wooc-countdown-text">' + hour + '</div></div></div>' + '</div><div class="wooc-countdown-section-bottom">' + '<div class="wooc-countdown-section"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%M</div><div class="wooc-countdown-text">' + minute + '</div></div></div>' + '<div class="wooc-countdown-section ml10"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%S</div><div class="wooc-countdown-text">' + second + '</div></div></div></div>'));
						}).on('finish.countdown', function(event) {
							$(this).html(event.strftime(''));
						});
					});
				} catch (err) {
					console.log('Countdown : ' + err.message);
				}
			}
		},
		magnific_popup: function magnific_popup() {
			if (typeof $.fn.magnificPopup == 'function') {
				$('.wooc-video-popup').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
			}
		}
	};

	var WooCommerce = {
		wooc_SimpleBar: function wooc_SimpleBar() {
			var $ = jQuery;

			if ($('.additional-menu-msidebar').length > 0) {
				new SimpleBar($('.additional-menu-msidebar')[0]);
			}
		},
		meta_reloation: function meta_reloation() {
			$('.product-type-variable .single-product-top-2 .product_meta-area-js, .product-type-variable .single-product-top-3 .product_meta-area-js').insertAfter('form.variations_form table.variations');
		},
		sticky_product_thumbnail: function sticky_product_thumbnail() {
			if (typeof $.fn.stickySidebar == 'function') {
				var screenWidth = $('body').outerWidth();

				if (screenWidth > 991) {
					var top = 20;

					if (UiartObj.hasStickyMenu == 1) {
						top += $('.header-main-block-sticky-wrapper').outerHeight();
					}

					if (UiartObj.hasAdminBar == 1) {
						top += $('#wpadminbar').outerHeight();
					}

					$('.single-product-area-2 .wooc-sticky-left').stickySidebar({
						topSpacing: top
					});
				}
			}
		},
		quantity_change: function quantity_change() {
			$(document).on('click', '.quantity .input-group-btn .quantity-btn', function() {
				var $input = $(this).closest('.quantity').find('.input-text');

				if ($(this).hasClass('quantity-plus')) {
					$input.trigger('stepUp').trigger('change');
				}

				if ($(this).hasClass('quantity-minus')) {
					$input.trigger('stepDown').trigger('change');
				}
			});
		},
		slider_nav: function slider_nav() {
			$('.woocueproduct-slider').each(function() {
				var $target = $(this).find('.owl-custom-nav .owl-nav button.owl-prev, .owl-custom-nav .owl-nav button.owl-next'),
					$img = $(this).find('.woocue-thumb-wrapper').first();

				if ($img.length) {
					var height = $img.outerHeight();
					height = height / 2 - 24;
					$target.css('top', height + 'px');
				}
			});
		},
		wishlist_icon: function wishlist_icon() {
			$(document).on('click', '.wooctheme-wishlist-icon', function() {
				if ($(this).hasClass('wooctheme-add-to-wishlist')) {
					var $obj = $(this),
						productId = $obj.data('product-id'),
						afterTitle = $obj.data('title-after');
					var data = {
						'action': 'uiart_add_to_wishlist',
						'context': 'frontend',
						'nonce': $obj.data('nonce'),
						'add_to_wishlist': productId
					};
					$.ajax({
						url: UiartObj.ajaxurl,
						type: 'POST',
						data: data,
						beforeSend: function beforeSend() {
							$obj.find('.wishlist-icon').hide();
							$obj.find('.ajax-loading').show();
							$obj.addClass('wooctheme-wishlist-ajaxloading');
						},
						success: function success(data) {
							if (data['result'] != 'error') {
								$obj.find('.ajax-loading').hide();
								$obj.removeClass('wooctheme-wishlist-ajaxloading');
								$obj.find('.wishlist-icon').removeClass('fa-heart-o').addClass('fa-heart').show();
								$obj.removeClass('wooctheme-add-to-wishlist').addClass('wooctheme-remove-from-wishlist');
								$obj.attr('title', afterTitle);
							} else {
								console.log(data['message']);
							}
						}
					});
					return false;
				}
			});
		}
	};

	function loadmore_n_infinityscroll() {
		var loadMoreWrapper = $('.wooctheme-loadmore-wrapper'),
			infinityScrollWrapper = $('.wooctheme-infscroll-wrapper');

		if (loadMoreWrapper.length) {
			loadMore(loadMoreWrapper);
		}

		if (infinityScrollWrapper.length) {
			infinityScroll(infinityScrollWrapper);
		}

		function loadMore($wrapper) {
			var button = $('.wooctheme-loadmore-btn'),
				shopData = $('.wooctheme-loadmore-data'),
				maxPage = shopData.data('max'),
				query = shopData.attr('data-query'),
				CurrentPage = 1;
			button.on('click', button, function() {
				var data = {
					'action': 'wooctheme_loadmore',
					'context': 'frontend',
					'nonce': shopData.data('nonce'),
					'query': query,
					'view': $('body').hasClass('product-list-view') ? 'list' : 'grid',
					'paged': CurrentPage
				};
				$.ajax({
					url: UiartObj.ajaxurl,
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
				shopData = $('.wooctheme-loadmore-data'),
				icon = $('.wooctheme-infscroll-icon'),
				query = shopData.attr('data-query'),
				CurrentPage = 1;
			$(window).on('scroll load', function() {
				if (!canBeLoaded) {
					return;
				}

				var data = {
					'action': 'wooctheme_loadmore',
					'context': 'frontend',
					'nonce': shopData.data('nonce'),
					'query': query,
					'paged': CurrentPage
				};

				if (isScrollable($wrapper)) {
					$.ajax({
						url: UiartObj.ajaxurl,
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
	$(document).on('rt_filter_ajax_load', function() {
		Theme.slick_carousel();
		typeof slick_carousel === "undefined" ? "undefined" : _typeof(slick_carousel);
		loadmore_n_infinityscroll();
	});

	function content_ready_scripts() {
		Theme.countdown();
		Theme.magnific_popup();
		Theme.vertical_menu();
		Theme.vertical_menu_mobile();
		Theme.category_search_dropdown();
		Theme.wooc_offcanvas_menu();
		Theme.wooc_offcanvas_menu_layout();
		Theme.wooc_offcanvas_icon_menu_layout();
		Theme.wooc_niceSelect();
		Theme.wooc_tooltip();
		Theme.wooc_toltp();
		Theme.wooc_SimpleBar();
		Theme.wooc_offcanvas_menu_list_icon();
		Theme.wooc_toggle_right();
		Theme.wooc_active_animation();
	}

	function content_load_scripts() {
		Theme.isotope();
		Theme.owl_carousel();
		Theme.slick_carousel();
		Theme.ripple_effect();
		Theme.wooc_banner_slider();
		Theme.wooc_banner_slider_fashion();
		Theme.wooc_removeAttr_right();
		Theme.wooc_logo_slider();
	}

	$(document).ready(function() {
		Theme.scroll_to_top();
		Theme.sticky_menu();
		Theme.mobile_menu();
		Theme.multi_column_menu();
		Theme.search_popup();
		WooCommerce.quantity_change();
		WooCommerce.wishlist_icon();
		WooCommerce.meta_reloation();
		content_ready_scripts();
	});
	$(window).on('load', function() {
		content_load_scripts();
		Theme.preloader();
		WooCommerce.sticky_product_thumbnail();
	});
	$(window).on('load resize', function() {
		Theme.mobile_menu_max_height();
		WooCommerce.slider_nav();
	});
	$(window).on('elementor/frontend/init', function() {
		if (elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/widget', function() {
				content_ready_scripts();
				content_load_scripts();
			});
		}
	});

}());