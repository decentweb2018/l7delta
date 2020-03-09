// Require dependencies
var $ = jQuery;

$( '.js body' ).addClass( 'appear' );

Modernizr.addTest('ipad', function () {
    return !!navigator.userAgent.match(/iPad/i);
});

Modernizr.addTest('iphone', function () {
    return !!navigator.userAgent.match(/iPhone/i);
});

Modernizr.addTest('ipod', function () {
    return !!navigator.userAgent.match(/iPod/i);
});

Modernizr.addTest('ios', function () {
    return (Modernizr.ipad || Modernizr.ipod || Modernizr.iphone);
});

// Fire it up
var Site = {
	challengeElement: null,
	context: null,

	/**
	 * Initialize site
	 */
	init: function() {
		/**
		 * Set the initial breakpoint context
		 */
		Site.challengeElement = document.querySelector('.breakpoint-context');
		Site.challengeContext();

		/**
		 * Check breakpoint context on window resizing
		 * Throttled/debounced for better performance
		 */
		$(window).resize(Site.debounce(function() {
			Site.challengeContext();
		}, 250));
	},

	/**
	 * Device targeting should be based on media queries in CSS,
	 * we do not define this in scripts
	 * Modified from http://davidwalsh.name/device-state-detection-css-media-queries-javascript
	 */
	challengeContext: function() {
		var styles = window.getComputedStyle(Site.challengeElement),
			index = parseInt(styles.getPropertyValue('z-index'), 10),
			states = {
				1: 'mobile',
				2: 'tablet'
			};

		Site.context = states[index] || 'desktop';
	},

	/**
	 * Throttle/debounce helper
	 * Modified from http://remysharp.com/2010/07/21/throttling-function-calls/
	 */
	debounce: function(fn, delay) {
		var timer = null;

		return function() {
			var context = this,
				args = arguments;

			clearTimeout(timer);

			timer = setTimeout(function() {
				fn.apply(context, args);
			}, delay);
		};
	}
};

jQuery(document).ready(function($) {
	Site.init();

	// Initiate Parallax plugin
	$('.parallax').parallax();

	// Initiate Wow plugin
	new WOW().init();

	// Size background videos
	resizeVidePlayers();
	$(window).resize(Site.debounce(function() {
		resizeVidePlayers();
	}, 250));

	// Header Words Rotator
	var rotatingContainer = $( '.js_rotate_words' );
	var firstHeight = $( '.js_rotate_words span:first-child' ).addClass('active').outerHeight();
	rotatingContainer.css( 'marginBottom', firstHeight );
	if( $( '.js_rotate_words > span' ).length > 1 ){
		window.setInterval( function(){

			if( rotatingContainer.is_on_screen() ){
				var $active = $( '.js_rotate_words .active' );
				var $next = $active.next();

				$( '.js_rotate_words span' ).removeClass('last_active');

				if($active.is(':last-child')){
					$next = $( '.js_rotate_words span:first-child' );
				}
				$active.removeClass('active').addClass('last_active');
				$next.addClass('active');
				rotatingContainer.css( 'marginBottom', $next.outerHeight() );
			}

		}, 3000 );
	}

	$(window).resize(Site.debounce(function() {
		rotatingContainer.css( 'marginBottom', $( '.js_rotate_words span.active' ).outerHeight() );
	}, 250));

	// Sticky header
	var $body = $('body');

	var header = $("header.site-header");
	var toolbar = $("#toolbar");
	var filterBar = $("#filter_toolbar");
	var helperButtons = $(".helper-buttons");

		var lastScrollTop = 59, delta = 40;
		$(window).scroll(calculateHeaderState);

		function calculateHeaderState(){
			/*start header scroll position check*/
            var st = $(window).scrollTop();

            if( st > delta + 20 ){
                $body.addClass("opaque_header");
            }else{
                $body.removeClass("opaque_header");
            }

            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            if (st > lastScrollTop && st >= 0){
                $body.addClass("hide_menu");
                toolbar.addClass("tool_fix");
                filterBar.addClass("fixed_filter");
                //console.log(st);
            } else {
                $body.removeClass("hide_menu");
                toolbar.removeClass("tool_fix");
                filterBar.removeClass("fixed_filter");
            }
            lastScrollTop = st;

            if( st > 600 ){
                helperButtons.addClass("out");
            }else{
                helperButtons.removeClass("out");
            }
		}
    	calculateHeaderState();

	helperButtons.children('.back-to-top').on('click', function (e) {
		e.preventDefault();
		$('html,body').animate({
			scrollTop: 0
		}, 700);
	});


	//Testimonials
	var parent = $('.client-testimonials ul');
	var divs = parent.children();
	while (divs.length) {
		parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
	}

	$testimonialsSlider = parent.slick({
		adaptiveHeight: false,
		autoplay: true,
		arrows: false,
	});

	$testimonialsSlider.find('.slick-slide').click(function() {
		$testimonialsSlider.slick('slickGoTo', parseInt($testimonialsSlider.slick('slickCurrentSlide'))+1);
	});

	//Form label placeholders
	$( ".gform_wrapper" ).on( "focus", "input[type=text], textarea", function() {
		var $fieldWrapper = $( this ).closest( '.gfield, .name_last, .name_first, .ginput_left, .ginput_right, .ginput_full' );
		$fieldWrapper.addClass('active');
		$fieldWrapper.find('.validation_message').fadeOut();
	});
	$( ".gform_wrapper" ).on( "blur", "input[type=text], textarea", function() {
		var $this = $( this );
		var $fieldWrapper = $this.closest( '.gfield, .name_last, .name_first, .ginput_left, .ginput_right, .ginput_full' );
		var strippedVal = $this.val().replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"").trim();
		if( strippedVal === '' ){
			$fieldWrapper.removeClass('active');
		}
	});
	//Sidebar Form Toggle
	$(".toggle-with-title .gform_heading").click(function(){
		var $this = $(this);

		$this.siblings().slideToggle();
	});

	$( ".js-grow textarea" ).css("height", "auto").attr("rows", "1").autogrow();

	$(document).bind('gform_post_render', function(event, formId, current_page){

		$(".toggle-with-title .gform_heading").siblings().show();
		$( ".js-grow textarea" ).css("height", "auto").attr("rows", "1").autogrow();

		$( ".gform_wrapper input, .gform_wrapper textarea" ).each(function(){
			var $this = $( this );
			var $fieldWrapper = $this.closest( '.gfield' );
			var strippedVal = $this.val().replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"").trim();
			if( strippedVal !== '' ){
				$fieldWrapper.addClass('active');
			}
		});

		if( $('.validation_error').length > 0 ){
			$('html,body').animate({
				scrollTop: $(".validation_error").offset().top - 200
			}, 400 );
		}

	}).bind('gform_confirmation_loaded', function(event, formId){
		$('html,body').animate({
			scrollTop: $(".gform_confirmation_wrapper").offset().top - 200
		}, 400 );
	});

	//Play BG video
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


    // Menu Toggle
    var $slideOutNav = $('.slide-out-container');
    $(".menu-toggle, .slide-out-container .bg-overlay, .slide-out-container .btn-close").click(function () {
        $slideOutNav.toggleClass("active");
    });

    $(".slide-out-container .menu-item-has-children > a .menu-arrow").click(function (e) {
        var $this = $(this);
        var $parent = $this.closest('.menu-item');

        var $submenu = $parent.find('.sub-menu').first();

        //toggles
        $parent.toggleClass("active");
        $submenu.slideToggle();

        e.preventDefault();

    });


    //Top bar alert
    var shouldShowAlert = $.cookie('hideTopBarAlert');
    var $pageAlert = $(".page-alert");
    if (shouldShowAlert !== 'true') {
        $pageAlert.show();
    }

    $(".page-alert button").click(function () {
        $pageAlert.slideUp();
        $.cookie('hideTopBarAlert', 'true', {expires: 7, path: '/'});
    });


	$( 'a' ).click(function( e ){
		if( this.target === '_blank' || this.target === '_BLANK' ){
			return;
		}

		if( $(this).parent().hasClass('menu-item-has-children') ){
			return;
		}
		var currentpage = window.location.hostname + window.location.pathname;

		var href = this.href;
		if( href.indexOf(currentpage) >= 0 ){
			href = href.split( currentpage )[1];
		}

		if( ! Modernizr.ios || (e.ctrlKey || e.metaKey || /^#/.test( href ) === true || (this.target && (this.target === '_blank' || this.target === '_BLANK') ) ) ){
			// Follow the link normally
		}else{
			$('#page').fadeOut( 1000, function(){
				window.location = href;
			} );

			return false;
		}

	});

	// $('#page').animate({opacity: 1}, 1000);

	$('.hero_block').slick({
        adaptiveHeight: false,
        arrows: true,
        fade: true,
        autoplay: true,
        autoplaySpeed: 6000,
        prevArrow: '<button type="button" class="slick-prev"><span class="icon-caret-left"></span></button>',
        nextArrow: '<button type="button" class="slick-next"><span class="icon-caret-right"></span></button>',
    });

});

window.addEventListener('pageshow', function(event) {
	$('.slide-out-container').removeClass("active");
		jQuery('#page').css({display: 'block', opacity : '0'}).animate({opacity: 1}, 1000);
		//delta remove menu
		$('.delta-hamburger-menu').removeClass('animate');
		$('.mobile-nav').removeClass('active');
		$('body').removeClass('body-fixed');
});

	// function onYouTubeIframeAPIReady() {
  //
	// 	$(".full-video-helper iframe").each(function(){
	// 		var thisID = this.id;
	// 		var player = new YT.Player(thisID, {
	// 			events: {
	// 				'onReady': function(){
	// 					player.playVideo();
	// 					player.mute();
	// 				},
	// 				'onStateChange':
	// 					function(e){
	// 						if (e.data === YT.PlayerState.ENDED) {
	// 							player.playVideo();
	// 						}
	// 					}
	// 			}
	// 		});
	// 	});
	// }


function resizeVidePlayers(){
	$( 'section.content_builder_block' ).each( function(){
		var $this = $(this);
		var $videoContainer = $this.find('.full-video-helper');

		if($videoContainer.length > 0){

			var thisHeight = $this.outerHeight();
			var videoHeight = $videoContainer.outerHeight();
			var videoWidth = $videoContainer.outerWidth();

			var heightPerc = videoHeight / thisHeight;

			if ( videoHeight < thisHeight ){
				$videoContainer.css( 'width', videoWidth / (heightPerc) );
			}else{
				$videoContainer.attr( 'style', '' );
			}
		}

	} );
}

$.fn.is_on_screen = function(){
	var win = $(window);
	var viewport = {
		top : win.scrollTop(),
		left : win.scrollLeft()
	};
	viewport.right = viewport.left + win.width();
	viewport.bottom = viewport.top + win.height();

	var bounds = this.offset();
	bounds.right = bounds.left + this.outerWidth();
	bounds.bottom = bounds.top + this.outerHeight();

	return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};


//dropdown

$(document).ready(function() {
	$('#header-delta-main-navigation .sub-menu').hide ();
	$('#header-delta-main-navigation .menu-item-has-children').hover (

	  function () {
	    $(this).addClass('active');
	    $('ul:first', this).fadeIn ();
	  },

	  function () {
	    $(this).removeClass('active');
	    $('ul:first', this).delay(100).fadeOut();
	  }
	);

	$('.delta-hamburger-menu-wrapper').on('click', function() {
		$('.delta-hamburger-menu').toggleClass('animate');
		$('.mobile-nav').toggleClass('active');
		$('body').toggleClass('body-fixed');
	})

	//QA Dropdown
	$('.qa_question').click(function() {
		$(this).find('.qa_answer').slideToggle();
		$(this).toggleClass('open');
	}); //click

});
