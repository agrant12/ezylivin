(function ($) {
  $(document).ready(function () {
    $('#searchsubmit, #commentform #submit').addClass('btn btn-default');
	$('button, html input[type="button"], input[type="reset"], input[type="submit"]').addClass('btn btn-default');
	$('input:not(button, html input[type="button"], input[type="reset"], input[type="submit"]), input[type="file"], select, textarea').addClass('form-control');
	if ($('label').parent().not('div')) {
	  $('label:not(#searchform label,#commentform label)').wrap('<div></div>');
	}
    $('table').addClass('table table-bordered');
    $('.attachment-thumbnail').addClass('thumbnail');
    $('embed-responsive-item,iframe,embed,object,video').parent().addClass('embed-responsive embed-responsive-16by9');
	$('.navbar-nav').addClass('blog-nav');
	$('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:focus').closest('.navbar-nav').removeClass('blog-nav');
  });
  function isElementInViewport(elem) {
		var $elem = $(elem);

		// Get the scroll position of the page.
		var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
		var viewportTop = $(scrollElem).scrollTop();
		var viewportBottom = viewportTop + $(window).height();

		// Get the position of the element on the page.
		var elemTop = Math.round( $elem.offset().top );
		var elemBottom = elemTop + $elem.height();

		return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
	}

	function checkAnimation() {
		var $element = $('.blog-post');

		$element.each(function(i, elem) {
			// If the animation has already been started
			if ($(this).hasClass('service-animation')) return;

			if (isElementInViewport($(this))) {
				// Start the animation
				$(this).addClass('service-animation');
			}
		});
	}

	$(window).scroll(function(){
		checkAnimation();
	});

	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return "";
	}

	$(window).load(function() {
		var newsletter = getCookie("newsletter");
		if (newsletter != "") {
			//alert("Welcome again " + username);
		} else{
			$('.subscribe-box').fadeIn();
		}
	});

	$('.close').on('click', function() {
		$('.subscribe-box').fadeOut();
		setCookie('newsletter', 'optout', 3);
	});
	
}) (jQuery);