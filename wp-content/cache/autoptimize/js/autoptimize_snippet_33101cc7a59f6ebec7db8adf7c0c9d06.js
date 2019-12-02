!function(l){"use strict";jQuery(function(a){a(".row-has-seperator").length&&a(".row-has-seperator").each(function(){a(this).after('<div class="row-seperator"></div>'),a(".row-seperator").each(function(){var e=a(this),t=e.prev().css("background-color");"transparent"==t&&(t=a("body.meteorite-boxed").length?a(".meteorite-boxed #page").css("background-color"):a("body.custom-background").length?a("body.custom-background").css("background-color"):a("body").css("background-color")),e.css("background-color",t);var i=e.prev().css("border-bottom-color");e.css({"border-bottom-color":i,"border-right-color":i})})})}),jQuery.fn.meteorite_submenu_positioning=function(e){return l(this).children(".sub-menu").each(function(){var e=l(this);if(e.length){var t=e.offset(),i=t.left,a=(t.top,e.height(),e.outerWidth()),o=i+a;l(window).height();l(window).width()<o&&(e.parent().parent(".sub-menu").length?e.css({left:-1*a,top:"10px"}):e.css({left:-1*a+e.parent().width(),top:"115%"}))}})},jQuery.fn.meteorite_walk_through_menu_items=function(){l(this).meteorite_submenu_positioning(),l(this).find(".sub-menu").length&&l(this).find(".sub-menu li").meteorite_walk_through_menu_items()},jQuery(function(e){e.fn.meteorite_submenu_positioning&&(e(".menu-item-has-children, .menu-item-has-children li").mouseenter(function(){e(this).meteorite_submenu_positioning()}),e(".menu-item-has-children > ul > li").each(function(){e(this).meteorite_walk_through_menu_items()}),e(window).on("resize load",function(){e(".menu-item-has-children").each(function(){e(this).meteorite_walk_through_menu_items()})}))});l(function(){matchMedia("only screen and (min-width: 1025px)").matches&&(l(window).on("load scroll",function(){if(991<l(window).width()){var e=l(".parallax-text:not(.no-parallax)"),t=l(".parallax-header:not(.no-parallax)"),i=l(".header-button"),a=l(".header-image").height()/1.5,o=l(this).scrollTop(),n=l(".header-image").height()/2;o<1.5*a+l("#masthead").height()&&(e.css({opacity:1-o/a}),e.css("top",n+.1*o+"px"),i.css({opacity:1-o/a}),t.css("top",.45*o+"px"))}}),l(window).on("scroll load",function(){l('.meteorite-parallax[data-hasbg="hasbg"]').each(function(){var e=l(window).scrollTop(),t=l(this).offset().top;if(t<e+l(window).height()){if(e<t)var i=Math.abs(e-t)/2;else i=(t-e)/2;l(this).css("backgroundPosition","0px "+parseInt(i).toString()+"px")}else l(this).css({backgroundPosition:""})})}),l(window).on("scroll load",function(){l(".fade-in").each(function(){l(this).offset().top+150<l(window).scrollTop()+l(window).height()&&l(this).addClass("meteorite-show").delay(1e3).queue(function(){l(this).removeClass("fade-in meteorite-show").dequeue()})}),l(".fade-in-left, .fade-in-right").each(function(){l(this).offset().top+150<l(window).scrollTop()+l(window).height()&&l(this).addClass("meteorite-show").delay(1e3).queue(function(){l(this).removeClass("fade-in-left fade-in-right meteorite-show").dequeue()})}),l(".fade-in-up").each(function(){l(this).offset().top+150<l(window).scrollTop()+l(window).height()&&l(this).addClass("meteorite-show").delay(1e3).queue(function(){l(this).removeClass("fade-in-up meteorite-show").dequeue()})}),l(".fade-in-single").each(function(){var e=l(this).offset().top,t=l(window).scrollTop()+l(window).height();l(this).hasClass("meteorite-text-with-icon")&&(l("body").hasClass("siteorigin-panels")?l(this).closest(".panel-row-style").find(".meteorite-text-with-icon").find(".meteorite-item").each(function(e){l(this).css("animation-delay",100*e+"ms")}):l("body").hasClass("elementor-page")&&l(this).closest(".elementor-section").find(".meteorite-text-with-icon").find(".meteorite-item").each(function(e){l(this).css("animation-delay",100*e+"ms")})),e+150<t&&l(this).find(".meteorite-item").each(function(e){var t=l(this);setTimeout(function(){t.addClass("meteorite-show").delay(2e3).queue(function(){t.removeClass("meteorite-show").dequeue(),t.closest(".fade-in-single").removeClass("fade-in-single")})},100*e)})}),l(".fade-in-up-single").each(function(){var e=l(this).offset().top,t=l(window).scrollTop()+l(window).height();l(this).hasClass("meteorite-text-with-icon")&&(l("body").hasClass("siteorigin-panels")?l(this).closest(".panel-row-style").find(".meteorite-text-with-icon").find(".meteorite-item").each(function(e){l(this).css("animation-delay",200*e+"ms")}):l("body").hasClass("elementor-page")&&l(this).closest(".elementor-section").find(".meteorite-text-with-icon").find(".meteorite-item").each(function(e){l(this).css("animation-delay",100*e+"ms")})),e+150<t&&l(this).find(".meteorite-item").each(function(e){var t=l(this);setTimeout(function(){t.addClass("meteorite-show").delay(4e3).queue(function(){t.removeClass("meteorite-show").dequeue(),t.closest(".fade-in-up-single").removeClass("fade-in-up-single")})},200*e)})})})),l('#main-nav a[href*="#"]:not(.search-button-toggle), #footer-nav a[href*="#"], #mobile-menu a[href*="#"], .meteorite-button[href*="#"], .button[href*="#"], .smooth-scroll[href*="#"]').on("click",function(e){var t=this.hash,i=l(t);i.length&&(e.preventDefault(),matchMedia("only screen and (min-width: 992px)").matches?l("html, body").stop().animate({scrollTop:i.offset().top-l(".nav-container").outerHeight()},1e3):l("html, body").stop().animate({scrollTop:i.offset().top},1e3))}),l(window).on("scroll load",function(){l(document).scrollTop()>l(".header-container").height()?l(".upbutton").addClass("meteorite-show"):l(".upbutton").removeClass("meteorite-show")}),l(".upbutton").click(function(){return l("html, body").animate({scrollTop:0},800),!1}),l(window).on("load resize",function(){l(".nav-placeholder").height(l(".nav-container").outerHeight()),l(window).width()<1024&&(l(".nav-container").removeClass("fixed"),l(".parallax-header").css({top:"0"}))}),l(window).on("scroll load",function(){var e=l(".nav-container"),t=l(".header-area").height();l("#masthead.below .nav-container").hasClass("sticky")?(l(document).scrollTop()>t+l(".topbar").outerHeight()?e.addClass("fixed"):e.removeClass("fixed"),l(document).scrollTop()>t+l(".topbar").outerHeight()?e.addClass("floated"):e.removeClass("floated")):l("#masthead.above .nav-container").hasClass("sticky")&&(l(document).scrollTop()>0+l(".topbar").outerHeight()?e.addClass("fixed"):e.removeClass("fixed"),l(document).scrollTop()>0+l(".topbar").outerHeight()+t/2?e.addClass("floated"):e.removeClass("floated"))}),function(){function t(){l(".meteorite-header-search").stop().fadeToggle(200),i=!i}if(l(".search-button-toggle").length){var i=!0;l(".search-button-toggle").on("click",function(e){e.preventDefault(),l(".meteorite-header-search").stop().fadeToggle(200),l(".overlay-search input").focus(),i=!i}),l(".overlay-search-close").on("click",function(e){e.preventDefault(),t(),l(".search-button-toggle").focus()}),l(document).keydown(function(e){27!=e.keyCode||i||(t(),l(".search-button-toggle").focus())}),l(window).on("load resize",function(){matchMedia("only screen and (max-width: 1024px)").matches&&l(".meteorite-header-search").removeAttr("style"),i=!0})}}(),l(window).on("load resize",function(){matchMedia("only screen and (max-width: 1024px)").matches||(l("#mobile-menu").removeAttr("style"),l(".btn-menu").removeClass("open-nav-cross"))}),l(window).on("load",function(){l(".btn-menu, #mobile-menu a").on("click",function(){l("#mobile-menu").stop().slideToggle(300),l(".btn-menu").toggleClass("open-nav-cross")}),l("#mobile-menu").find("li:has(ul)").children("a").after('<span class="btn-submenu"></span>'),l("#mobile-menu .btn-submenu").on("click",function(){l(this).next("ul").stop().slideToggle(300),l(this).toggleClass("active")})}),l(window).on("load resize",function(){(matchMedia("only screen and (max-width: 1024px)").matches||l("body").hasClass("meteorite-no-animations"))&&(l(".fade-in").removeClass("fade-in"),l(".fade-in-up").removeClass("fade-in-up"),l(".fade-in-left").removeClass("fade-in-left"),l(".fade-in-right").removeClass("fade-in-right"),l(".fade-in-single").removeClass("fade-in-single"),l(".fade-in-up-single").removeClass("fade-in-up-single"))}),l(".skill-bar").length&&l(".skill-bar").on("on-appear",function(){l(this).each(function(){var e=l(this).data("percent");l(this).find(".skill-bar-fill").animate({width:e+"%"},3e3),l(this).parent().find(".skill-perc").addClass("meteorite-show").animate({width:e+"%"},3e3)})}),l(".meteorite-skill-circle").length&&l(".meteorite-skill-circle").on("on-appear",function(){var e=l(this).parent().data("fillcolor"),t=l(this).parent().data("unfillcolor"),i=l(this).parent().data("size"),a=l(this).parent().data("linewidth"),o=l(this).parent().data("speed");l(this).find(".meteorite-skill-circle-inner").each(function(){l(this).easyPieChart({barColor:e,scaleColor:!1,trackColor:t,size:i,lineWidth:a,animate:{duration:o,enabled:!0}})})}),l(".panel-row-style").each(function(){if(l(this).data("hascolor")&&l(this).find("h1, h2, h3, h4, h5, h6, a, .fa, div, span").css("color","inherit"),l(this).data("hasbg")&&l(this).data("overlay")){l(this).append('<div class="overlay"></div>');var e=l(this).data("overlay-color");l(this).find(".overlay").css("background-color",e)}}),l(".panel-grid .panel-widget-style").each(function(){var e=l(this).data("title-color"),t=l(this).data("headings-color");"#444444"!=e&&l(this).find(".widget-title").css("color",e),"#444444"!=t&&l(this).find("h1, h2, h3:not(.widget-title), h4, h5, h6, h3 a").css("color",t)}),l(".meteorite-testimonials").length&&l(".meteorite-testimonials").each(function(){var e=l(this);if(1<e.data("items-large"))var t=!1;else t=!0;e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("items-large"),itemsDesktopSmall:[1400,e.data("items-large")],itemsTablet:[992,e.data("items-medium")],itemsTabletSmall:[768,e.data("items-medium")],itemsMobile:[480,e.data("items-small")],touchDrag:!0,mouseDrag:!0,autoHeight:t,stopOnHover:!0,autoPlay:e.data("autoplay")})}),l(".meteorite-team").length&&l(".meteorite-team").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("items-large"),itemsDesktopSmall:[1400,e.data("items-large")],itemsTablet:[992,e.data("items-medium")],itemsTabletSmall:[768,e.data("items-medium")],itemsMobile:[480,e.data("items-small")],touchDrag:!0,mouseDrag:!0,stopOnHover:!0,autoHeight:!1,autoPlay:e.data("autoplay")})}),l(".meteorite-latest-news-carousel").length&&l(".meteorite-latest-news-carousel").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("items-large"),itemsDesktopSmall:[1400,e.data("items-large")],itemsTablet:[992,e.data("items-medium")],itemsTabletSmall:[768,e.data("items-medium")],itemsMobile:[480,e.data("items-small")],touchDrag:!0,mouseDrag:!0,stopOnHover:!0,autoHeight:!1,autoPlay:e.data("autoplay")})}),l(".meteorite-clients").length&&l(".meteorite-clients").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("items-large"),itemsDesktopSmall:[1400,e.data("items-large")],itemsTablet:[992,e.data("items-medium")],itemsTabletSmall:[768,e.data("items-medium")],itemsMobile:[480,e.data("items-small")],touchDrag:!0,mouseDrag:!0,stopOnHover:!0,autoHeight:!1,autoPlay:e.data("autoplay")})}),l(".meteorite-projects-carousel").length&&l(".meteorite-projects-carousel").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("cols"),itemsDesktopSmall:[1400,e.data("cols")],itemsTablet:[992,3],itemsTabletSmall:[768,2],itemsMobile:[480,1],touchDrag:!0,mouseDrag:!0,stopOnHover:!0,autoHeight:!0,autoPlay:e.data("autoplay"),afterInit:function(){setTimeout(function(){l(".owl-carousel").each(function(){l(this).data("owlCarousel").updateVars()})},0)}});var t=e;e.parent().find(".next").click(function(){t.trigger("owl.next")}),e.parent().find(".prev").click(function(){t.trigger("owl.prev")})}),l(".related-posts-carousel").length&&l(".related-posts-carousel").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:e.data("pagination"),responsive:!0,items:e.data("items-large"),itemsDesktopSmall:[1400,e.data("items-large")],itemsTablet:[992,e.data("items-medium")],itemsTabletSmall:[768,e.data("items-medium")],itemsMobile:[480,e.data("items-small")],touchDrag:!0,mouseDrag:!0,autoHeight:!1,autoPlay:e.data("autoplay"),stopOnHover:e.data("stop-on-hover")});var t=e;e.parent().find(".next").click(function(){t.trigger("owl.next")}),e.parent().find(".prev").click(function(){t.trigger("owl.prev")})}),l(".format-gallery-carousel").length&&l(".format-gallery-carousel").each(function(){var e=l(this);e.owlCarousel({navigation:!1,pagination:!0,responsive:!0,items:1,touchDrag:!0,mouseDrag:!0,autoHeight:!0,autoPlay:e.data("autoplay"),singleItem:!0,stopOnHover:e.data("stop-on-hover")});var t=e;e.parent().find(".next").click(function(){t.trigger("owl.next")}),e.parent().find(".prev").click(function(){t.trigger("owl.prev")})}),function(){if(l(".terra-themes-header-slider").length){l(".terra-themes-header-slider").owlCarousel({navigation:l(".terra-themes-header-slider").data("navigation"),pagination:l(".terra-themes-header-slider").data("pagination"),responsive:!0,items:1,responsiveRefreshRate:1,touchDrag:!1,mouseDrag:!1,autoHeight:!0,addClassActive:!0,autoPlay:l(".terra-themes-header-slider").data("autoplay"),singleItem:!0,transitionStyle:l(".terra-themes-header-slider").data("transition"),stopOnHover:l(".terra-themes-header-slider").data("hoverstop"),afterInit:function(){setTimeout(function(){l(".owl-carousel").each(function(){l(this).data("owlCarousel").updateVars()})},0),l(".owl-item.active .header-image.do-animate").each(function(){l(this).addClass("meteorite-show")}),l(".parallax-text, .header-button-down").hide().delay(450).fadeIn(400),l(".owl-item.active .header-video video").length&&l(".owl-item.active .header-video video")[0].play()},beforeMove:function(){setTimeout(function(){l(".owl-item:not(.active) .header-image.do-animate").removeClass("meteorite-show"),l(".owl-item:not(.active) .header-video video")[0].pause()},500)},afterMove:function(){l(".owl-item.active .header-video video").length&&(l(".owl-item.active .header-video video")[0].currentTime=0,l(".owl-item.active .header-video video")[0].play()),l(".owl-item.active .header-image.do-animate").each(function(){l(this).addClass("meteorite-show")}),l(".parallax-text, .header-button-down").hide().delay(450).fadeIn(400)}});var e=l(".terra-themes-header-slider");l(".terra-themes-slider-controls .next").click(function(){e.trigger("owl.next")}),l(".terra-themes-slider-controls .prev").click(function(){e.trigger("owl.prev")})}}(),l("body").fitVids(),l(".meteorite-facts").length&&l(".meteorite-facts .fact-item.count-me").on("on-appear",function(){l(this).find(".fact-count").each(function(){var e=parseInt(l(this).attr("data-to")),t=parseInt(l(this).attr("data-speed"));l(this).countTo({to:e,speed:t})})}),l(".social-menu-widget a").attr("target","_blank"),l('[data-waypoint-active="yes"]').waypoint(function(){l(this).trigger("on-appear")},{offset:"90%",triggerOnce:!0}),l(window).on("load",function(){setTimeout(function(){l.waypoints("refresh")},100)}),l(".meteorite-projects").length&&l(".meteorite-projects").each(function(){function e(e){e.isotope({filter:"*",itemSelector:".project-item",percentPosition:!0,animationOptions:{duration:750,easing:"liniar",queue:!1}})}var t=l(this),i=t.find(".project-filter").find("a");t.find(".isotope-container").imagesLoaded(function(){e(t.find(".isotope-container"))}),l(window).load(function(){e(t.find(".isotope-container"))}),i.click(function(){var e=l(this).attr("data-filter");return i.removeClass("active"),l(this).addClass("active"),t.find(".isotope-container").isotope({filter:e,animationOptions:{duration:750,easing:"liniar",queue:!1}}),!1})}),l(".terra-themes-header-slider").length&&l(window).on("load resize",function(){l(".terra-themes-header-slider .video-wrap").each(function(e){var t,i=l(this).closest(".terra-themes-header-slider").outerHeight(),a=l(this).closest(".terra-themes-header-slider").outerWidth();l(this).width(a);var o=l(this).closest(".terra-themes-header-slider").outerHeight();t=1280/720*(o+20),l(this).height(o);var n=a/1280,s=(o-i)/720,r=s;s<n&&(r=n),1280*r<t&&(r=t/1280),l(this).find("video, .mejs-overlay, .mejs-poster").width(Math.ceil(1280*r+2)),l(this).find("video, .mejs-overlay, .mejs-poster").height(Math.ceil(720*r+2)),l(this).scrollLeft((l(this).find("video").width()-a)/2),l(this).find(".mejs-overlay, .mejs-poster").scrollTop((l(this).find("video").height()-o)/2),l(this).scrollTop((l(this).find("video").height()-o)/2)})}),l(window).load(function(){l("#preloader").css("opacity",0),setTimeout(function(){l("#preloader").hide()},600)})})}(jQuery);