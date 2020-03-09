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


});
