
;(function($) {

	'use strict'

	// Enables the row seperators
	jQuery(function($) {
		if ( $('.row-has-seperator').length ) {
			$('.row-has-seperator').each(function () {
				var $this = $(this);
				$this.after('<div class="row-seperator"></div>');
				$('.row-seperator').each(function() {
					var $this = $(this);

					var bgColor = $this.prev().css('background-color');
					if ( bgColor == 'transparent' ) {
						if ( $('body.meteorite-boxed').length ) {
							bgColor = $('.meteorite-boxed #page').css('background-color');
						} else if ( $('body.custom-background').length ) {
							bgColor = $('body.custom-background').css('background-color');
						} else {
							bgColor = $('body').css('background-color');
						}
					}
					$this.css('background-color', bgColor);

					var borderColor = $this.prev().css('border-bottom-color');
					$this.css({
						'border-bottom-color': borderColor,
						'border-right-color': borderColor,
					});
				});
			});
		}
	});


	// Sub menu positioning
	jQuery.fn.meteorite_submenu_positioning = function( variables ) {
		return $(this).children('.sub-menu').each( function() {
			var submenu = $(this);
			if ( submenu.length ) {
				var submenu_position = submenu.offset(),
					submenu_left = submenu_position.left,
					submenu_top = submenu_position.top,
					submenu_height = submenu.height(),
					submenu_width = submenu.outerWidth(),
					submenu_bottom_edge = submenu_top + submenu_height,
					submenu_right_edge = submenu_left + submenu_width,
					browser_bottom_edge = $( window ).height(),
					browser_right_edge = $( window ).width()

				// current submenu goes beyond browser's right edge
				if( submenu_right_edge > browser_right_edge ) {

					// first level submenu
					if( ! submenu.parent().parent('.sub-menu').length ) {
						submenu.css({ 
							'left': ( -1 ) * submenu_width + submenu.parent().width(),
							'top': '115%'
						});

					// second level submenu
					} else {
						submenu.css({
							'left': ( -1 ) * submenu_width,
							'top': '10px'
						});
					}

				}

			}
		});
	}

	// Recursive function for positioning menu items correctly on load
	jQuery.fn.meteorite_walk_through_menu_items = function() {
		$(this).meteorite_submenu_positioning();

		if ( $(this).find('.sub-menu').length ) {
			$(this).find('.sub-menu li').meteorite_walk_through_menu_items();
		} else {
			return;
		}
	};

	// Calculate main menu dropdown submenu position
	jQuery(function($) {
		if ( $.fn.meteorite_submenu_positioning ) {
			$('.menu-item-has-children, .menu-item-has-children li').mouseenter( function() {
				$(this).meteorite_submenu_positioning();
			});

			$('.menu-item-has-children > ul > li').each( function() {
				$(this).meteorite_walk_through_menu_items();
			});

			$(window).on( 'resize load', function() {
				$('.menu-item-has-children').each( function() {
					$(this).meteorite_walk_through_menu_items();
				});
			});
		}
	});

	var meteorite_smoothScroll = function() {
		$('#main-nav a[href*="#"]:not(.search-button-toggle), #footer-nav a[href*="#"], #mobile-menu a[href*="#"], .meteorite-button[href*="#"], .button[href*="#"], .smooth-scroll[href*="#"]').on('click',function (e) {
			var target = this.hash;
			var $target = $(target);
			if ( $target.length ) {
				e.preventDefault();
				if( (matchMedia( 'only screen and (min-width: 992px)' ).matches) ) {
					$('html, body').stop().animate({
						'scrollTop': $target.offset().top - ( $('.nav-container').outerHeight() )
					}, 1000);
				} else {
					$('html, body').stop().animate({
						'scrollTop': $target.offset().top
					}, 1000);
				}
			}			
		});
	}

	var meteorite_upButton = function() {
		$(window).on('scroll load', function()	{
			if($(document).scrollTop() > ($('.header-container').height()) ) {
				$('.upbutton').addClass('meteorite-show');
			} else {
				$('.upbutton').removeClass('meteorite-show');
			}
		});
		$('.upbutton').click(function() {
			$('html, body').animate({ scrollTop: 0 }, 800);
			return false;
		});
	}

	var meteorite_headerSearch = function() {
		function toggleSearchOverlay() {
			$('.meteorite-header-search').stop().fadeToggle(200);
			searchIsClosed = !searchIsClosed;
		}
		if ( $('.search-button-toggle').length ) {
			var searchIsClosed = true;
			$('.search-button-toggle').on('click', function(event){
				event.preventDefault();
				$('.meteorite-header-search').stop().fadeToggle(200);
				$('.overlay-search input').focus();
				searchIsClosed = !searchIsClosed;
			});
			$('.overlay-search-close').on('click', function(e) {
				e.preventDefault();
				toggleSearchOverlay();
				$('.search-button-toggle').focus();
			});
			$(document).keydown( function(e) {
				if ( e.keyCode == 27 && !searchIsClosed ) {
					toggleSearchOverlay();
					$('.search-button-toggle').focus();
				}
			});
			$(window).on('load resize', function() {
				if ((matchMedia( 'only screen and (max-width: 1024px)' ).matches) ) {
					$('.meteorite-header-search').removeAttr('style');
				}
				searchIsClosed = true;
			});
		}
	}

	var meteorite_responsiveMenu = function() {
		$(window).on('load resize', function() {
			if ( !(matchMedia( 'only screen and (max-width: 1024px)' ).matches) ) {
				$('#mobile-menu').removeAttr('style');
				$('.btn-menu').removeClass('open-nav-cross');
			}
		});
		$(window).on('load', function() {
			$('.btn-menu, #mobile-menu a').on('click', function() {
				$('#mobile-menu').stop().slideToggle(300);
				$('.btn-menu').toggleClass('open-nav-cross');
			});

			var hasChildMenu = $('#mobile-menu').find('li:has(ul)');
			hasChildMenu.children('a').after('<span class="btn-submenu"></span>');

			$('#mobile-menu .btn-submenu').on('click', function() {
				$(this).next('ul').stop().slideToggle(300);
				$(this).toggleClass('active');
			});
		})
	}


	var meteorite_headerFix = function() {
		$(window).on('load resize', function() {
			$(".nav-placeholder").height($(".nav-container").outerHeight());
			if ( $(window).width() < 1024 ) {
				$('.nav-container').removeClass('fixed');
				$('.parallax-header').css({ 'top': '0' });
			}
		});
		$(window).on("scroll load", function()	{
			var navContainer = $(".nav-container");
			var headerAreaHeight = $(".header-area").height();

			if ( $("#masthead.below .nav-container").hasClass("sticky") ) {
				if ( $(document).scrollTop() > headerAreaHeight + $(".topbar").outerHeight() ) {
					navContainer.addClass("fixed");
				} else {
					navContainer.removeClass("fixed");
				}
				if ( $(document).scrollTop() > headerAreaHeight + $(".topbar").outerHeight() ) {
					navContainer.addClass("floated");
				} else {
					navContainer.removeClass("floated");
				}
			} else if ( $("#masthead.above .nav-container").hasClass("sticky") ) {
				if ( $(document).scrollTop() > 0 + $(".topbar").outerHeight() ) {
					navContainer.addClass("fixed");
				} else {
					navContainer.removeClass("fixed");
				}
				if ( $(document).scrollTop() > 0 + $(".topbar").outerHeight() + (headerAreaHeight / 2) ) {
					navContainer.addClass("floated");
				} else {
					navContainer.removeClass("floated");
				}
			}
		});
	}

	var meteorite_parallaxHeader = function() {
		$(window).on('load scroll', function() {
			if ( $(window).width() > 991 ) {
				var paratext = $('.parallax-text:not(.no-parallax)');
				var image = $('.parallax-header:not(.no-parallax)');
				var headerButton = $('.header-button');
				var headerHeight = $('.header-image').height() / 1.5; // scrolltop value when opacity should be 0

				var scrollTop = $(this).scrollTop();
				var textHeight = $('.header-image').height() / 2;

				// we compare scroll position with header height + masthead height to prevent calculating the top value when it isnt visible anymore
				if ( scrollTop < ( headerHeight * 1.5 + $('#masthead').height() ) ) {
					paratext.css({ 'opacity' : (1 - scrollTop/headerHeight) });
					paratext.css("top", textHeight + (scrollTop * 0.1) + 'px');
					headerButton.css({ 'opacity' : (1 - scrollTop/headerHeight) });
					image.css("top", scrollTop * 0.45 + 'px');
				}
			}
		});
	}

	var meteorite_parallaxBg = function() {
		$(window).on("scroll load", function() {
			$('.meteorite-parallax[data-hasbg="hasbg"]').each(function(){

				var scrPos = $(window).scrollTop();
				var offTop = $(this).offset().top;
				var bottom = scrPos + $(window).height();
				
				if( bottom > offTop ) {
					if ( offTop > scrPos ) {
						var coords = ( Math.abs(scrPos - offTop) / 2 );
					} else {
						var coords = ( offTop - scrPos ) / 2;
					}
					$(this).css("backgroundPosition", ("0px " + (parseInt(coords)).toString() + "px"));
				} else {
					$(this).css({ backgroundPosition: '' })
				}
			});
		});
	}

	var meteorite_fadeInEffect = function() {
		$(window).on("scroll load", function() {
			$(".fade-in").each(function() {
				var offTop = $(this).offset().top;
				var scrPos = $(window).scrollTop();
				var bottom = scrPos + $(window).height();

				if ( bottom > offTop + 150 ) {
					$(this).addClass("meteorite-show").delay(1000).queue(function(){
						$(this).removeClass("fade-in meteorite-show").dequeue();
					});
				}
			});
			$(".fade-in-left, .fade-in-right").each(function() {
				var offTop = $(this).offset().top;
				var scrPos = $(window).scrollTop();
				var bottom = scrPos + ($(window).height());

				if ( bottom > offTop + 150 ) {
					$(this).addClass("meteorite-show").delay(1000).queue(function(){
						$(this).removeClass("fade-in-left fade-in-right meteorite-show").dequeue();
					});
				}
			});
			$(".fade-in-up").each(function() {
				var offTop = $(this).offset().top;
				var scrPos = $(window).scrollTop();
				var bottom = scrPos + $(window).height();

				if ( bottom > offTop + 150 ) {
					$(this).addClass("meteorite-show").delay(1000).queue(function(){
						$(this).removeClass("fade-in-up meteorite-show").dequeue();
					});
				}
			});
			$(".fade-in-single").each(function() {
				var offTop = $(this).offset().top;
				var scrPos = $(window).scrollTop();
				var bottom = scrPos + $(window).height();

				if ( $(this).hasClass('meteorite-text-with-icon') ) {
					if ( $('body').hasClass('siteorigin-panels') ) {
						$(this).closest(".panel-row-style").find('.meteorite-text-with-icon').find(".meteorite-item").each(function(i) {
							$(this).css('animation-delay', 100*i + 'ms');
						});
					} else if ( $('body').hasClass('elementor-page') ) {
						$(this).closest('.elementor-section').find('.meteorite-text-with-icon').find('.meteorite-item').each(function(i) {
							$(this).css('animation-delay', 100*i + 'ms');
						});
					}
				}

				if ( bottom > offTop + 150 ) {
					$(this).find('.meteorite-item').each(function(l) {
						var $this = $(this);
						setTimeout(function() {
							$this.addClass("meteorite-show").delay(2000).queue(function(){
								$this.removeClass("meteorite-show").dequeue();
								$this.closest(".fade-in-single").removeClass("fade-in-single");
							});
						}, 100*l);
					});
				}
			});
			$(".fade-in-up-single").each(function() {
				var offTop = $(this).offset().top;
				var scrPos = $(window).scrollTop();
				var bottom = scrPos + $(window).height();

				if ( $(this).hasClass('meteorite-text-with-icon') ) {
					if ( $('body').hasClass('siteorigin-panels') ) {
						$(this).closest(".panel-row-style").find('.meteorite-text-with-icon').find(".meteorite-item").each(function(i) {
							$(this).css('animation-delay', 200*i + 'ms');
						});
					} else if ( $('body').hasClass('elementor-page') ) {
						$(this).closest('.elementor-section').find('.meteorite-text-with-icon').find('.meteorite-item').each(function(i) {
							$(this).css('animation-delay', 100*i + 'ms');
						});
					}
				}

				if ( bottom > offTop + 150 ) {
					$(this).find('.meteorite-item').each(function(l) {
						var $this = $(this);
						setTimeout(function() {
							$this.addClass("meteorite-show").delay(4000).queue(function(){
								$this.removeClass("meteorite-show").dequeue();
								$this.closest(".fade-in-up-single").removeClass("fade-in-up-single");
							});
						}, 200*l);
					});
				}
			});
		});
	}

	var meteorite_removeFadeInClass = function() {
		$(window).on("load resize", function() {
			if ( (matchMedia( 'only screen and (max-width: 1024px)' ).matches) || $('body').hasClass('meteorite-no-animations') ) {
				$(".fade-in").removeClass("fade-in");
				$(".fade-in-up").removeClass("fade-in-up");
				$(".fade-in-left").removeClass("fade-in-left");
				$(".fade-in-right").removeClass("fade-in-right");
				$(".fade-in-single").removeClass("fade-in-single");
				$(".fade-in-up-single").removeClass("fade-in-up-single");
			}
		});
	}

	var meteorite_skillBars = function() {
		if ( $('.skill-bar').length ) {
			$('.skill-bar').on('on-appear', function() {
				$(this).each(function() {
					var percent = $(this).data('percent');

					$(this).find('.skill-bar-fill').animate({ "width": percent + '%' },3000);
					$(this).parent().find('.skill-perc').addClass('meteorite-show').animate({ "width": percent + '%' },3000);
				});
			});
		}
	};

	var meteorite_skillCircles = function() {
		if ( $('.meteorite-skill-circle').length ) {
			$('.meteorite-skill-circle').on('on-appear', function() {
				var $barColor 	= $(this).parent().data('fillcolor');
				var $trackColor = $(this).parent().data('unfillcolor');
				var $size 		= $(this).parent().data('size');
				var $lineWidth 	= $(this).parent().data('linewidth');
				var $speed 		= $(this).parent().data('speed');

				$(this).find('.meteorite-skill-circle-inner').each(function() {
					$(this).easyPieChart({
						barColor: $barColor,
						scaleColor: false,
						trackColor: $trackColor,
						size: $size,
						lineWidth: $lineWidth,
						animate: { duration: $speed, enabled: true }
					});
				});
			});
		}
	}

	var meteorite_panelsStyling = function() {
		$(".panel-row-style").each( function() {
			if ( $(this).data('hascolor') ) {
				$(this).find('h1, h2, h3, h4, h5, h6, a, .fa, div, span').css('color','inherit');
			}
			if ( $(this).data('hasbg') && $(this).data('overlay') ) {
				$(this).append( '<div class="overlay"></div>' );
				var overlayColor = $(this).data('overlay-color');
				$(this).find('.overlay').css('background-color', overlayColor );
			}
		});
		$('.panel-grid .panel-widget-style').each( function() {
			var titleColor = $(this).data('title-color');
			var headingsColor = $(this).data('headings-color');
			if ( titleColor != '#444444' ) {
				$(this).find('.widget-title').css('color', titleColor );
			}
			if ( headingsColor != '#444444' ) {
				$(this).find('h1, h2, h3:not(.widget-title), h4, h5, h6, h3 a').css('color', headingsColor );
			}
		});	
	};

	var meteorite_testimonialCarousel = function(){
		if ( $(".meteorite-testimonials").length ) {
			$('.meteorite-testimonials').each(function() {
				var this_carousel = $(this);
				if ( this_carousel.data('items-large') > 1 ) { 
					var sliderHeightAuto = false;
				} else {
					var sliderHeightAuto = true;
				} 
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('items-large'),
					itemsDesktopSmall: [1400, this_carousel.data('items-large')],
					itemsTablet:[992, this_carousel.data('items-medium')],
					itemsTabletSmall: [768, this_carousel.data('items-medium')],
					itemsMobile: [480, this_carousel.data('items-small')],
					touchDrag: true,
					mouseDrag: true,
					autoHeight: sliderHeightAuto,
					stopOnHover: true,
					autoPlay: this_carousel.data('autoplay')
				});
			});
		}
	};

	var meteorite_teamCarousel = function(){
		if ( $(".meteorite-team").length ) {
			$('.meteorite-team').each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('items-large'),
					itemsDesktopSmall: [1400, this_carousel.data('items-large')],
					itemsTablet:[992, this_carousel.data('items-medium')],
					itemsTabletSmall: [768, this_carousel.data('items-medium')],
					itemsMobile: [480, this_carousel.data('items-small')],
					touchDrag: true,
					mouseDrag: true,
					stopOnHover: true,
					autoHeight: false,
					autoPlay: this_carousel.data('autoplay')
				});
			});
		}
	};

	var meteorite_newsCarousel = function(){
		if ( $(".meteorite-latest-news-carousel").length ) {
			$(".meteorite-latest-news-carousel").each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('items-large'),
					itemsDesktopSmall: [1400, this_carousel.data('items-large')],
					itemsTablet:[992, this_carousel.data('items-medium')],
					itemsTabletSmall: [768, this_carousel.data('items-medium')],
					itemsMobile: [480, this_carousel.data('items-small')],
					touchDrag: true,
					mouseDrag: true,
					stopOnHover: true,
					autoHeight: false,
					autoPlay: this_carousel.data('autoplay'),
				});
			});
		}
	};

	var meteorite_clientsCarousel = function(){
		if ( $(".meteorite-clients").length ) {
			$(".meteorite-clients").each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('items-large'),
					itemsDesktopSmall: [1400, this_carousel.data('items-large')],
					itemsTablet:[992, this_carousel.data('items-medium')],
					itemsTabletSmall: [768, this_carousel.data('items-medium')],
					itemsMobile: [480, this_carousel.data('items-small')],
					touchDrag: true,
					mouseDrag: true,
					stopOnHover: true,
					autoHeight: false,
					autoPlay: this_carousel.data('autoplay')
				});
			});
		}
	};

	var meteorite_projectsCarousel = function(){
		if ( $(".meteorite-projects-carousel").length ) {
			$(".meteorite-projects-carousel").each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('cols'),
					itemsDesktopSmall: [1400, this_carousel.data('cols')],
					itemsTablet:[992,3],
					itemsTabletSmall: [768,2],
					itemsMobile: [480,1],
					touchDrag: true,
					mouseDrag: true,
					stopOnHover: true,
					autoHeight: true,
					autoPlay: this_carousel.data('autoplay'),
					afterInit: function() { 
						setTimeout(function(){
							$(".owl-carousel").each(function(){
								/* 
								fixes a bug where the outer-wrapper has wrong width because when the plugin calculates the width, 
								the siteorigin wrapper isn't loaded 
								*/
								$(this).data('owlCarousel').updateVars();
							});
						},0);
					},
				});
				// Custom Navigation Events
				var owl = this_carousel;
				this_carousel.parent().find(".next").click(function(){
					owl.trigger('owl.next');
				});
				this_carousel.parent().find(".prev").click(function(){
					owl.trigger('owl.prev');
				});
			});
		}
	};

	var meteorite_relatedPostsCarousel = function(){
		if ( $(".related-posts-carousel").length ) {
			$(".related-posts-carousel").each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: this_carousel.data('pagination'),
					responsive: true,
					items: this_carousel.data('items-large'),
					itemsDesktopSmall: [1400, this_carousel.data('items-large')],
					itemsTablet:[992, this_carousel.data('items-medium')],
					itemsTabletSmall: [768, this_carousel.data('items-medium')],
					itemsMobile: [480, this_carousel.data('items-small')],
					touchDrag: true,
					mouseDrag: true,
					autoHeight: false,
					autoPlay: this_carousel.data('autoplay'),
					stopOnHover: this_carousel.data('stop-on-hover'),
				});
				// Custom Navigation Events
				var owl = this_carousel;
				this_carousel.parent().find(".next").click(function(){
					owl.trigger('owl.next');
				});
				this_carousel.parent().find(".prev").click(function(){
					owl.trigger('owl.prev');
				});
			});
		}
	};

	var meteorite_formatGalleryCarousel = function(){
		if ( $(".format-gallery-carousel").length ) {
			$(".format-gallery-carousel").each(function() {
				var this_carousel = $(this);
				this_carousel.owlCarousel({
					navigation: false,
					pagination: true,
					responsive: true,
					items: 1,
					touchDrag: true,
					mouseDrag: true,
					autoHeight: true,
					autoPlay: this_carousel.data('autoplay'),
					singleItem: true,
					stopOnHover: this_carousel.data('stop-on-hover'),
				});
				// Custom Navigation Events
				var owl = this_carousel;
				this_carousel.parent().find(".next").click(function(){
					owl.trigger('owl.next');
				});
				this_carousel.parent().find(".prev").click(function(){
					owl.trigger('owl.prev');
				});
			});
		}
	};

	var meteorite_headerSlider = function(){
		if ( $(".terra-themes-header-slider").length ) {
			$(".terra-themes-header-slider").owlCarousel({
				navigation: $('.terra-themes-header-slider').data('navigation'),
				pagination: $('.terra-themes-header-slider').data('pagination'),
				responsive: true,
				items: 1,
				responsiveRefreshRate: 1,
				touchDrag: false,
				mouseDrag: false,
				autoHeight: true,
				addClassActive: true,
				autoPlay: $('.terra-themes-header-slider').data('autoplay'),
				singleItem: true,
				transitionStyle: $('.terra-themes-header-slider').data('transition'),
				stopOnHover: $('.terra-themes-header-slider').data('hoverstop'),
				afterInit: function() { 
					setTimeout(function(){
						$(".owl-carousel").each(function(){
							/* 
							fixes a bug where the outer-wrapper has wrong width because when the plugin calculates the width, 
							the slides are underneath and it has got a scrollbar 
							https://github.com/OwlCarousel2/OwlCarousel2/issues/461 
							*/
							$(this).data('owlCarousel').updateVars();
						});
					},0);

					$('.owl-item.active .header-image.do-animate').each( function() {
						$(this).addClass('meteorite-show');
					});

					$('.parallax-text, .header-button-down').hide().delay(450).fadeIn(400);

					// Chrome fix not autoplaying the first video by default (v68.0.3440.106)
					if ( $('.owl-item.active .header-video video').length ) {
						$('.owl-item.active .header-video video')[0].play();
					}
				},
				beforeMove: function() { 
					 setTimeout( function() {
					 	$('.owl-item:not(.active) .header-image.do-animate').removeClass('meteorite-show');
					 	$('.owl-item:not(.active) .header-video video')[0].pause();
					 }, 500);
				},
				afterMove: function() {
					if ( $('.owl-item.active .header-video video').length ) {
						$('.owl-item.active .header-video video')[0].currentTime = 0;
						$('.owl-item.active .header-video video')[0].play();
					}
					$('.owl-item.active .header-image.do-animate').each( function() {
						$(this).addClass('meteorite-show');
					});
					$('.parallax-text, .header-button-down').hide().delay(450).fadeIn(400);
				},
			});

			// Custom Navigation Events
			var owl = $('.terra-themes-header-slider');
			$(".terra-themes-slider-controls .next").click(function(){
				owl.trigger('owl.next');
			});
			$(".terra-themes-slider-controls .prev").click(function(){
				owl.trigger('owl.prev');
			});
		}
	};

	var meteorite_responsiveVideo= function(){
		$("body").fitVids();
	};

	var meteorite_facts = function() {
		if ( $('.meteorite-facts').length ) {
			$('.meteorite-facts .fact-item.count-me').on('on-appear', function() {
				$(this).find('.fact-count').each(function() {
					var to = parseInt($(this).attr('data-to')), speed = parseInt($(this).attr('data-speed'));
					$(this).countTo({
						to: to,
						speed: speed
					});
				});
			});
		}
	};

	var meteorite_socialMenu = function() {
		$('.social-menu-widget a').attr( 'target','_blank' );
	};

	var meteorite_detectWaypoint = function() {
		$('[data-waypoint-active="yes"]').waypoint(function() {
			$(this).trigger('on-appear');
		}, { offset: '90%', triggerOnce: true });

		$(window).on('load', function() {
			setTimeout(function() {
				$.waypoints('refresh');
			}, 100);
		});
	};

	var meteorite_portfolioIsotope = function(){
		if ( $('.meteorite-projects').length ) {
			$('.meteorite-projects').each(function() {

				var self       = $(this);
				var filterNav  = self.find('.project-filter').find('a');

				var projectIsotope = function($selector){

					$selector.isotope({
						filter: '*',
						itemSelector: '.project-item',
						percentPosition: true,
						animationOptions: {
							duration: 750,
							easing: 'liniar',
							queue: false,
						}
					});
				}

				self.find('.isotope-container').imagesLoaded( function() {
					projectIsotope(self.find('.isotope-container'));
				});

				$(window).load(function(){
					projectIsotope(self.find('.isotope-container'));
				});

				filterNav.click(function(){
					var selector = $(this).attr('data-filter');
					filterNav.removeClass('active');
					$(this).addClass('active');

					self.find('.isotope-container').isotope({
						filter: selector,
						animationOptions: {
							duration: 750,
							easing: 'liniar',
							queue: false,
						}
					});
					return false;
				});

			});
		}
	};

	var meteorite_videoSlide = function() {
		if ( $('.terra-themes-header-slider').length ) {
			$(window).on('load resize', function() {
				$('.terra-themes-header-slider .video-wrap').each(function(i){
					var min_w = 992; // minimum video width allowed
					var video_width_original = 1280;  // original video dimensions
					var video_height_original = 720;
					var vid_ratio = 1280/720;
					var header_height = $(this).closest('.terra-themes-header-slider').outerHeight();
				
					var $sectionWidth = $(this).closest('.terra-themes-header-slider').outerWidth();
					$(this).width($sectionWidth);
					
					var $sectionHeight = $(this).closest('.terra-themes-header-slider').outerHeight();
					min_w = vid_ratio * ($sectionHeight+20);
					$(this).height($sectionHeight);
				
					var scale_h = $sectionWidth / video_width_original;
					var scale_v = ($sectionHeight - header_height) / video_height_original; 
					var scale =  scale_v;
					if ( scale_h > scale_v ) {
						scale =  scale_h;
					}
					if ( scale * video_width_original < min_w ) {
						scale = min_w / video_width_original;
					}
							
					$(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
					$(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
					$(this).scrollLeft(($(this).find('video').width() - $sectionWidth) / 2);
					$(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);
					$(this).scrollTop(($(this).find('video').height() - ($sectionHeight)) / 2);
				});
			});
		}
	};

	var meteorite_removePreloader = function() {
		$(window).load( function() {
			$('#preloader').css('opacity', 0);
			setTimeout(function(){$('#preloader').hide();}, 600);
		});
	}

	// Dom Ready
	$(function() {
		if ( (matchMedia( 'only screen and (min-width: 1025px)' ).matches) ) {
			meteorite_parallaxHeader();
			meteorite_parallaxBg();
			meteorite_fadeInEffect();
		}
		meteorite_smoothScroll();
		meteorite_upButton();
		meteorite_headerFix();
		meteorite_headerSearch();
		meteorite_responsiveMenu();
		meteorite_removeFadeInClass();
		meteorite_skillBars();
		meteorite_skillCircles();
		meteorite_panelsStyling();
		meteorite_testimonialCarousel();
		meteorite_teamCarousel();
		meteorite_newsCarousel();
		meteorite_clientsCarousel();
		meteorite_projectsCarousel();
		meteorite_relatedPostsCarousel();
		meteorite_formatGalleryCarousel();
		meteorite_headerSlider();
		meteorite_responsiveVideo();
		meteorite_facts();
		meteorite_socialMenu();
		meteorite_detectWaypoint();
		meteorite_portfolioIsotope();
		meteorite_videoSlide();
		meteorite_removePreloader();
	});
})(jQuery);