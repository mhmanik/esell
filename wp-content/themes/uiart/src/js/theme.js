let ThemeHelper = {

    run_closeMenuAreaLayout: () => {
        var menuArea = $('.additional-menu-area');
        var trigger = $('.side-menu-trigger', menuArea);
        trigger.removeClass('side-menu-close').addClass('side-menu-open');
        if (menuArea.find('> .wooc-cover').length) {
            menuArea.find('> .wooc-cover').remove();
        }
        $('.sidenav').css('transform', 'translateX(-100%)');
    },

    run_closeIconMenuAreaLayout: () => {
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

    run_closeSideMenu: () => {
        var wrapper = $('body').find('>#page'),
            $this = $('#side-menu-trigger a.menu-times');
        wrapper.removeClass('open').find('.offcanvas-mask').remove();
        $("#offcanvas-body-wrapper").attr('style', '');
        $this.prev('.menu-bar').removeClass('open');
        $this.addClass('close');
    },

    run_sticky_menu: () => {

        var wrapperHtml = $('<div class="header-main-block-sticky-wrapper"></div>');
        var wrapperClass = '.header-main-block-sticky-wrapper';

        $('.header-main-block').clone().appendTo(wrapperHtml);
        $('#page').append(wrapperHtml);

        var height = $(wrapperClass).outerHeight() + 30;

        $(wrapperClass).css('margin-top', '-' + height + 'px');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('body').addClass('woocthemeSticky');
            } else {
                $('body').removeClass('woocthemeSticky');
            }
        });
    },

    run_sticky_meanmenu: () => {

        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('body').addClass("mean-stick");
            } else {
                $('body').removeClass("mean-stick");
            }
        });
    },

    run_isotope: ($container, filter) => {
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

    add_vertical_menu_class: () => {
        var screenWidth = $('body').outerWidth();

        if (screenWidth < 992) {
            $('.vertical-menu').addClass('vertical-menu-mobile');
        } else {
            $('.vertical-menu').removeClass('vertical-menu-mobile');
        }
    },

    owl_change_num_pagination: ($owlParent, index) => {
        $owlParent.find('.owl-numbered-dots-items span').removeClass('active');
        //$owlParent.find('.owl-numbered-dots-items [data-num="'+index+'"]').addClass('active');
    }
}

let Theme = {

    wooc_active_animation: () => {

            /*-------------------------------------
            Intersection Observer
            -------------------------------------*/
            if (!!window.IntersectionObserver) {
            let observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("active-animation");
                        //entry.target.src = entry.target.dataset.src;
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: "0px 0px -100px 0px"
            });
            document.querySelectorAll('.has-animation').forEach(block => {
                observer.observe(block)
            });
            } else {
            document.querySelectorAll('.has-animation').forEach(block => {
                block.classList.remove('has-animation')
            });
            }


    },
    wooc_removeAttr_right: () => {
         var $ = jQuery;
        $("svg").removeAttr("id");
    },

    wooc_toggle_right: () => {
        var $ = jQuery;
        $(".cart-icon-area").mouseover(function() {
            $(this).find(" > .cart-icon-products").css("display","block");
            $(this).find(" > .cart-icon-products").css("transition","all 0.5s");
        }).mouseout(function() {
            $(this).find(" > .cart-icon-products").css("display","none");
        });
           
    },
       
    wooc_offcanvas_menu_list: () => {
    var $ = jQuery;
    $('.menu-list').on('click', '.menu-item>a', function (e) {
        if ($(this).parents('body').hasClass('has-offcanvas')) {
          var animationSpeed = 500,
            subMenuSelector = '.sub-menu',
            $this = $(this),
            checkElement = $this.next();
          if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
            checkElement.slideUp(animationSpeed, function () {
              checkElement.removeClass('menu-open');
            });
            checkElement.parent(".menu-item").removeClass("active");
          } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
            var parent = $this.parents('ul').first();
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            ul.removeClass('menu-open');
            var parent_li = $this.parent("li");
            checkElement.slideDown(animationSpeed, function () {
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

    wooc_offcanvas_menu_list_icon: () => {
    var $ = jQuery;
    $('.menu-list').on('click', '.menu-item>a', function (e) {
        if ($(this).parents('body').hasClass('has-offcanvas')) {
          var animationSpeed = 500,
            subMenuSelector = '.sub-menu',
            $this = $(this),
            checkElement = $this.next();
          if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
            checkElement.slideUp(animationSpeed, function () {
              checkElement.removeClass('menu-open');
            });
            checkElement.parent(".menu-item").removeClass("active");
          } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
            var parent = $this.parents('ul').first();
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            ul.removeClass('menu-open');
            var parent_li = $this.parent("li");
            checkElement.slideDown(animationSpeed, function () {
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


    wooc_SimpleBar: () => {
        var $ = jQuery;
        if ($('.additional-menu-msidebar').length > 0) {
            new SimpleBar($('.additional-menu-msidebar')[0]);
        }
    },

    wooc_tooltip: () => {
        var $ = jQuery;
        if ($('[data-toggle="tooltip"]').length > 0) {
            $('[data-toggle="tooltip"]').tooltip()
        }
    },

    wooc_toltp: () => {
        $(document).on('mouseover', '.wooc-toltp',
            function () {
                var self = $(this),
                    tips = self.attr('data-tips');
                $tooltip = '<div class="uiart-tooltip">' +
                    '<div class="uiart-tooltip-content">' + tips + '</div>' +
                    '<div class="uiart-tooltip-bottom"></div>' +
                    '</div>';
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
            })
            .on('mouseout', '.wooc-toltp', function () {
                $('body > .uiart-tooltip').remove();
            });

    },

    wooc_niceSelect: () => {
        var $ = jQuery;
        if ($('select').length > 0) {
            $('select').niceSelect();
        }
    },

   
    wooc_banner_slider: () => {
        var SlickCarousel = $('.wooc-product-banner');
        if (SlickCarousel.length) {
            try {
                if (SlickCarousel.find('.slick-carousel-content').hasClass('slick-initialized')) {
                    SlickCarousel.find('.slick-carousel-content').slick('unslick');
                }
                if (SlickCarousel.find('.slick-carousel-nav').hasClass('slick-initialized')) {
                    SlickCarousel.find('.slick-carousel-nav').slick('unslick');
                }
            } catch (e) {

            }

            SlickCarousel.find('.slick-carousel-content').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slick-carousel-nav',
                infinite: false,
                autoplay: true,
                responsive: [{
                    breakpoint: 769,
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
                            slidesToShow: 2,
                        }
                    },

                    {
                        breakpoint: 992,
                        settings: {
                            vertical: true,
                            slidesToShow:2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            vertical: true,
                            slidesToShow: 2,
                        }
                    }
                ]
            });
        }
    },

    wooc_logo_slider: () => {

    var logoSlickCarousel = $('.uiart-logo-slider');    
      if (logoSlickCarousel.length) {
          try {
              if (logoSlickCarousel.find('.brand-slider-active').hasClass('slick-initialized')) {
                  logoSlickCarousel.find('.brand-slider-active').slick('unslick');
              }
             
          } catch (e) {

          }
            logoSlickCarousel.find('.brand-slider-active').slick({
                dots: false,
              infinite: true,
              adaptiveHeight: true,
              infinite: true,
              arrows: false,
              autoplay: true,
              autoplaySpeed: 5000,
              fade: false,
              speed: 1000,
              pauseOnHover: false,
              pauseOnFocus: false,
              slidesToShow: 5,
              slidesToScroll: 1,
              responsive: [{
              breakpoint: 1350,
              settings: {
              slidesToShow: 4,
              slidesToScroll: 1
              }
            }, 
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
              }, 
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  adaptiveHeight: false,
                }
              },
              {
                breakpoint: 768,
                settings: {
                adaptiveHeight: false,
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
         
            ]
            });         
        }
    },

    wooc_banner_slider_fashion: () => {
        var SlickCarousel = $('.wooc-product-banner-fashion');
        if (SlickCarousel.length) {
            try {
                if (SlickCarousel.find('.slick-carousel-content').hasClass('slick-initialized')) {
                    SlickCarousel.find('.slick-carousel-content').slick('unslick');
                }
                if (SlickCarousel.find('.slick-carousel-nav').hasClass('slick-initialized')) {
                    SlickCarousel.find('.slick-carousel-nav').slick('unslick');
                }
            } catch (e) {

            }

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
                    breakpoint: 769,
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
                            slidesToShow: 2,
                        }
                    },

                    {
                        breakpoint: 992,
                        settings: {
                            vertical: false,
                            slidesToShow:2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            vertical: false,
                            slidesToShow: 2,
                        }
                    }
                ]
            });
        }
    },

    wooc_offcanvas_menu: () => {
        $('#page').on('click', '.offcanvas-menu-btn', function (e) {
            e.preventDefault();
            var $this = $(this),
                wrapper = $(this).parents('body').find('>#page'),
                wrapMask = $('<div />').addClass('offcanvas-mask'),
                offCancas = document.getElementById('offcanvas-body-wrap');

            if ($this.hasClass('menu-status-open')) {
                wrapper.addClass('open').append(wrapMask);
                $this.removeClass('menu-status-open').addClass('menu-status-close');
                offCancas.style.transform = 'translateX(' + (0) + 'px)';
                $('body').css({
                    overflow: 'hidden',
                    //height: '100%',
                    transition: 'all 0.3s ease-out'
                });

            } else {
                wrapper.removeClass('open').find('> .offcanvas-mask').remove();
                $this.removeClass('menu-status-close').addClass('menu-status-open');
                offCancas.style.transform = 'translateX(' + (-100) + '%)';
                if (UiartObj.rtl == 'yes') {
                    offCancas.style.transform = 'translateX(' + (100) + '%)';
                }
                $('body').css({
                    overflow: 'visible',
                    // height: 'auto',
                    transition: 'all 0.3s ease-out'
                });

            }

            return false;
        });

        $('#page').on('click', '#side-menu-trigger a.menu-times', function (e) {
            e.preventDefault();
            var $this = $(this);
            $("#offcanvas-body-wrapper").attr('style', '');
            $this.prev('.menu-bar').removeClass('open');
            $this.addClass('close');
            ThemeHelper.run_closeSideMenu();
            return false;
        });

        function closeMenuArea() {
            var trigger = $('.side-menu-trigger', menuArea);
            trigger.removeClass('side-menu-close').addClass('side-menu-open');
            if (menuArea.find('> .wooc-cover').length) {
                menuArea.find('> .wooc-cover').remove();
            }
            $('.sidenav').css('transform', 'translateX(100%)');
        }

        $(document).on('click', '#page.open .offcanvas-mask', function () {
            ThemeHelper.run_closeSideMenu();
        });
        $(document).on('keyup', function (event) {
            if (event.which === 27) {
                event.preventDefault();
                ThemeHelper.run_closeSideMenu();
            }
        });

    },


    wooc_offcanvas_menu_layout: () => {
        var menuArea = $('.additional-menu-area');
        menuArea.on('click', '.side-menu-trigger', function (e) {
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

        menuArea.on('click', '.closebtn', function (e) {
            e.preventDefault();
            ThemeHelper.run_closeMenuAreaLayout();
        });

        $(document).on('click', '.wooc-cover', function () {
            ThemeHelper.run_closeMenuAreaLayout();
        });


    },

    wooc_offcanvas_icon_menu_layout: () => {
        var menuArea = $('.additional-menu-area.icon-menu');
        menuArea.on('click', '.side-menu-trigger', function (e) {
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

        menuArea.on('click', '.closebtn', function (e) {
            e.preventDefault();
            ThemeHelper.run_closeIconMenuAreaLayout();
        });

        $(document).on('click', '.wooc-cover', function () {
            ThemeHelper.run_closeIconMenuAreaLayout();
        });

    },

    /* Scroll to top */
    scroll_to_top: () => {
        $('.scrollToTop').on('click', function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        $(window).scroll(function () {
            if ($(window).scrollTop() > 300) {
                $('.scrollToTop').addClass('back-top');
            } else {
                $('.scrollToTop').removeClass('back-top');
            }
        });
    },

    preloader: () => {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    },

    /* Sticky Menu */
    sticky_menu: () => {
        if (UiartObj.hasStickyMenu == 1) {
            ThemeHelper.run_sticky_menu();
            ThemeHelper.run_sticky_meanmenu();
        }
    },

    ripple_effect: () => {
        if (typeof $.fn.ripples == 'function') {
            $('.wooc-water-ripple').ripples({
                resolution: 712,
                dropRadius: 30,
                perturbance: 0.01,
            });
        }
    },

    category_search_dropdown: () => {
        $('.category-search-dropdown-js .dropdown-menu li').on('click', function (e) {
            var $parent = $(this).closest('.category-search-dropdown-js'),
                slug = $(this).data('slug'),
                name = $(this).text();

            $parent.find('.dropdown-toggle').text($.trim(name));
            $parent.find('input[name="product_cat"]').val(slug);
        });

        if ($.fn.autocomplete) {
            $(".ps-autocomplete-js .product-autocomplete-js").autocomplete({
                minChars: 2,
                search: function (event, ui) {
                    if (!$(event.target).parent().find('.product-autocomplete-spinner').length) {
                        $('<i class="product-autoaomplete-spinner fa fa-spinner fa-spin"></i>').insertAfter(event.target);
                    }
                },
                source: function (req, response) {
                    req.action = 'uiart_product_search_autocomplete';
                    $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: UiartObj.ajaxurl,
                        data: req,
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                response: function (event, ui) {
                    $(event.target).parent().find('.product-autoaomplete-spinner').remove();
                },
            })
        }

    },

    search_popup: () => {
        $('.search-icon-area a').on("click", function (event) {
            event.preventDefault();
            $("#wooctheme-search-popup").addClass("open");
            $('#wooctheme-search-popup > form > input').focus();
        });

        $("#wooctheme-search-popup, #wooctheme-search-popup button.close").on("click keyup", function (event) {
            if (event.target == this || event.target.className == "close" || event.keyCode == 27) {
                $(this).removeClass("open");
            }
        });
    },

    vertical_menu: () => {
        $('.vertical-menu-btn').on('click', function (e) {
            e.preventDefault();
            $(this).closest('.vertical-menu-area').toggleClass("opened");
        });
    },

    vertical_menu_mobile: () => {
        ThemeHelper.add_vertical_menu_class();
        $(window).on('resize', function () {
            ThemeHelper.add_vertical_menu_class();
        });
        $('.vertical-menu').on('click', 'li.menu-item-has-children span.has-dropdown', function (e) {
            if ($(this).find('+ ul.sub-menu').length) {
                $(this).closest('li').toggleClass('submenu-opend');
                $(this).find('+ ul.sub-menu').slideToggle();
            }
            return false;
        });
    },

    mobile_menu: () => {
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

    mobile_menu_max_height: () => {
        var wHeight = $(window).height();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('max-height', wHeight + 'px');
    },

    multi_column_menu: () => {
        $('.main-navigation ul > li.mega-menu').each(function () {
            // total num of columns
            var items = $(this).find(' > ul.sub-menu > li').length;
            // screen width
            var bodyWidth = $('body').outerWidth();
            // main menu link width
            var parentLinkWidth = $(this).find(' > a').outerWidth();
            // main menu position from left
            var parentLinkpos = $(this).find(' > a').offset().left;

            var width = items * 244;
            var left = (width / 6) - (parentLinkWidth / 2);

            var linkleftWidth = parentLinkpos + (parentLinkWidth / 2);
            var linkRightWidth = bodyWidth - (parentLinkpos + parentLinkWidth);

            // exceeds left screen
            if ((width / 2) > linkleftWidth) {
                $(this).find(' > ul.sub-menu').css({
                    width: width + 'px',
                    right: 'inherit',
                    left: '-' + parentLinkpos + 'px'
                });
            }
            // exceeds right screen
            else if ((width / 2) > linkRightWidth) {
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

    isotope: () => {
        if (typeof $.fn.isotope == 'function' && typeof $.fn.imagesLoaded == 'function') {

            // Blog Layout 2
            var $blogIsotopeContainer = $('.post-isotope');
            $blogIsotopeContainer.imagesLoaded(function () {
                $blogIsotopeContainer.isotope();
            });

            // Run 1st time
            var $isotopeContainer = $('.woocueisotope-container');
            $isotopeContainer.imagesLoaded(function () {
                $isotopeContainer.each(function () {
                    var $container = $(this).find('.woocueisotope-wrapper'),
                        filter = $(this).find('.woocueisotope-tab a.current').data('filter');
                    ThemeHelper.run_isotope($container, filter);
                });
            });


            // Run on click even
            $('.woocueisotope-tab a').on('click', function () {
                $(this).closest('.woocueisotope-tab').find('.current').removeClass('current');
                $(this).addClass('current');
                var $container = $(this).closest('.woocueisotope-container').find('.woocueisotope-wrapper'),
                    filter = $(this).attr('data-filter');
                ThemeHelper.run_isotope($container, filter);
                return false;
            });
        }
    },


    slick_carousel: () => {

        if (typeof $.fn.slick == 'function') {
            $(".wooc-slick-slider").each(function () {
                $(this).slick({
                    rtl: UiartObj.rtl
                });
            });

            // Loadmore
            $(document).on('afterLoadMore afterInfinityScroll', function () {
                $(".product_loaded .wooc-slick-slider").each(function () {
                    $(this).slick({
                        rtl: UiartObj.rtl
                    });
                });
                $(".product_loaded").removeClass('product_loaded');
            });

        }
    },

    owl_carousel: () => {
        if (typeof $.fn.owlCarousel == 'function') {
            $(".owl-custom-nav .owl-next").on('click', function () {
                $(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
            });
            $(".owl-custom-nav .owl-prev").on('click', function () {
                $(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
            });

            $(".wooc-owl-carousel").each(function () {
                var options = $(this).data('carousel-options');
                if (UiartObj.rtl == 'yes') {
                    options['rtl'] = true; //@rtl
                    options['navText'] = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
                }
                $(this).owlCarousel(options);
            });

            $(".owl-numbered-dots .owl-numbered-dots-items span").on('click', function () {
                let index = $(this).data('num');
                let $owlParent = $(this).closest('.owl-wrap').find('.owl-carousel');
                $owlParent.trigger('to.owl.carousel', index);
                $owlParent.find('.owl-numbered-dots-items span').removeClass('active');
                $owlParent.find('.owl-numbered-dots-items [data-num="' + index + '"]').addClass('active');
            });
        }
    },

    countdown: () => {
        if (typeof $.fn.countdown == 'function') {
            try {
                var day = (UiartObj.day == 'Day') ? 'Day%!D' : UiartObj.day,
                    hour = (UiartObj.hour == 'Hour') ? 'Hour%!D' : UiartObj.hour,
                    minute = (UiartObj.minute == 'Minute') ? 'Minute%!D' : UiartObj.minute,
                    second = (UiartObj.second == 'Second') ? 'Second%!D' : UiartObj.second;

                $('.woocjs-coutdown').each(function () {
                    var $CountdownSelector = $(this).find('.wooc-scripts-date');
                    var eventCountdownTime = $CountdownSelector.data('time');
                    $CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function (event) {
                        $(this).html(event.strftime(''
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%D</div><div class="wooc-countdown-text">' + day + '</div></div>'
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%H</div><div class="wooc-countdown-text">' + hour + '</div></div>'
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%M</div><div class="wooc-countdown-text">' + minute + '</div></div>'
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-count">%S</div><div class="wooc-countdown-text">' + second + '</div></div>'));
                    }).on('finish.countdown', function (event) {
                        $(this).html(event.strftime(''));
                    });
                });

                $('.woocjs-coutdown-2').each(function () {
                    var $CountdownSelector = $(this).find('.wooc-scripts-date');
                    var eventCountdownTime = $CountdownSelector.data('time');
                    $CountdownSelector.countdown(eventCountdownTime).on('update.countdown', function (event) {
                        $(this).html(event.strftime(''
                            + '<div class="wooc-countdown-section-top">'
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%D</div><div class="wooc-countdown-text">' + day + '</div></div></div>'
                            + '<div class="wooc-countdown-section ml10"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%H</div><div class="wooc-countdown-text">' + hour + '</div></div></div>'
                            + '</div><div class="wooc-countdown-section-bottom">'
                            + '<div class="wooc-countdown-section"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%M</div><div class="wooc-countdown-text">' + minute + '</div></div></div>'
                            + '<div class="wooc-countdown-section ml10"><div class="wooc-countdown-section-inner"><div class="wooc-countdown-count">%S</div><div class="wooc-countdown-text">' + second + '</div></div></div></div>'));
                    }).on('finish.countdown', function (event) {
                        $(this).html(event.strftime(''));
                    });
                });

            } catch (err) {
                console.log('Countdown : ' + err.message);
            }
        }
    },

    magnific_popup: () => {
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
}

export default Theme;