/* global binbillScreenReaderText */
(function ($) {

	// Variables and DOM Caching.
	var $body = $('body'),
		$customHeader = $body.find('.custom-header'),
		$branding = $customHeader.find('.site-branding'),
		$navigation = $body.find('.navigation-top'),
		$navWrap = $navigation.find('.wrap'),
		$navMenuItem = $navigation.find('.menu-item'),
		$menuToggle = $navigation.find('.menu-toggle'),
		$menuScrollDown = $body.find('.menu-scroll-down'),
		$sidebar = $body.find('#secondary'),
		$entryContent = $body.find('.entry-content'),
		$formatQuote = $body.find('.format-quote blockquote'),
		isFrontPage = $body.hasClass('binbill-front-page') || $body.hasClass('home blog'),
		navigationFixedClass = 'site-navigation-fixed',
		navigationHeight,
		navigationOuterHeight,
		navPadding,
		navMenuItemHeight,
		idealNavHeight,
		navIsNotTooTall,
		headerOffset,
		menuTop = 0,
		resizeTimer;

	// Ensure the sticky navigation doesn't cover current focused links.
	$('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex], [contenteditable]', '.site-content-contain').filter(':visible').focus(function () {
		if ($navigation.hasClass('site-navigation-fixed')) {
			var windowScrollTop = $(window).scrollTop(),
				fixedNavHeight = $navigation.height(),
				itemScrollTop = $(this).offset().top,
				offsetDiff = itemScrollTop - windowScrollTop;

			// Account for Admin bar.
			if ($('#wpadminbar').length) {
				offsetDiff -= $('#wpadminbar').height();
			}

			if (offsetDiff < fixedNavHeight) {
				$(window).scrollTo(itemScrollTop - (fixedNavHeight + 50), 0);
			}
		}
	});

	// Set properties of navigation.
	function setNavProps() {
		navigationHeight = $navigation.height();
		navigationOuterHeight = $navigation.outerHeight();
		navPadding = parseFloat($navWrap.css('padding-top')) * 2;
		navMenuItemHeight = $navMenuItem.outerHeight() * 2;
		idealNavHeight = navPadding + navMenuItemHeight;
		navIsNotTooTall = navigationHeight <= idealNavHeight;
	}

	// Make navigation 'stick'.
	function adjustScrollClass() {

		// Make sure we're not on a mobile screen.
		if ('none' === $menuToggle.css('display')) {

			// Make sure the nav isn't taller than two rows.
			if (navIsNotTooTall) {

				// When there's a custom header image or video, the header offset includes the height of the navigation.
				if (isFrontPage && ($body.hasClass('has-header-image') || $body.hasClass('has-header-video'))) {
					headerOffset = $customHeader.innerHeight() - navigationOuterHeight;
				} else {
					headerOffset = $customHeader.innerHeight();
				}

				// If the scroll is more than the custom header, set the fixed class.
				if ($(window).scrollTop() >= headerOffset) {
					$navigation.addClass(navigationFixedClass);
				} else {
					$navigation.removeClass(navigationFixedClass);
				}

			} else {

				// Remove 'fixed' class if nav is taller than two rows.
				$navigation.removeClass(navigationFixedClass);
			}
		}
	}

	// Set margins of branding in header.
	function adjustHeaderHeight() {
		if ('none' === $menuToggle.css('display')) {

			// The margin should be applied to different elements on front-page or home vs interior pages.
			if (isFrontPage) {
				$branding.css('margin-bottom', navigationOuterHeight);
			} else {
				$customHeader.css('margin-bottom', navigationOuterHeight);
			}

		} else {
			$customHeader.css('margin-bottom', '0');
			$branding.css('margin-bottom', '0');
		}
	}

	// Set icon for quotes.
	function setQuotesIcon() {
		$(binbillScreenReaderText.quote).prependTo($formatQuote);
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass(param) {
		var sidebarPos, sidebarPosBottom;

		if (!$body.hasClass('has-sidebar') || (
			$body.hasClass('search') ||
			$body.hasClass('single-attachment') ||
			$body.hasClass('error404') ||
			$body.hasClass('binbill-front-page')
		)) {
			return;
		}

		sidebarPos = $sidebar.offset();
		sidebarPosBottom = sidebarPos.top + ($sidebar.height() + 28);

		$entryContent.find(param).each(function () {
			var $element = $(this),
				elementPos = $element.offset(),
				elementPosTop = elementPos.top;

			// Add 'below-entry-meta' to elements below the entry meta.
			if (elementPosTop > sidebarPosBottom) {
				$element.addClass('below-entry-meta');
			} else {
				$element.removeClass('below-entry-meta');
			}
		});
	}

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement('div');
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ('undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI);
	}

	/**
	 * Test if an iOS device.
	*/
	function checkiOS() {
		return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	}

	/*
	 * Test if background-attachment: fixed is supported.
	 * @link http://stackoverflow.com/questions/14115080/detect-support-for-background-attachment-fixed
	 */
	function supportsFixedBackground() {
		var el = document.createElement('div'),
			isSupported;

		try {
			if (!('backgroundAttachment' in el.style) || checkiOS()) {
				return false;
			}
			el.style.backgroundAttachment = 'fixed';
			isSupported = ('fixed' === el.style.backgroundAttachment);
			return isSupported;
		}
		catch (e) {
			return false;
		}
	}

	// Fire on document ready.
	$(document).ready(function () {

		// If navigation menu is present on page, setNavProps and adjustScrollClass.
		if ($navigation.length) {
			setNavProps();
			adjustScrollClass();
		}

		// If 'Scroll Down' arrow in present on page, calculate scroll offset and bind an event handler to the click event.
		if ($menuScrollDown.length) {

			if ($('body').hasClass('admin-bar')) {
				menuTop -= 32;
			}
			if ($('body').hasClass('blog')) {
				menuTop -= 30; // The div for latest posts has no space above content, add some to account for this.
			}
			if (!$navigation.length) {
				navigationOuterHeight = 0;
			}

			$menuScrollDown.click(function (e) {
				e.preventDefault();
				$(window).scrollTo('#primary', {
					duration: 600,
					offset: { top: menuTop - navigationOuterHeight }
				});
			});
		}

		//adjustHeaderHeight();
		setQuotesIcon();
		if (true === supportsInlineSVG()) {
			document.documentElement.className = document.documentElement.className.replace(/(\s*)no-svg(\s*)/, '$1svg$2');
		}

		if (true === supportsFixedBackground()) {
			document.documentElement.className += ' background-fixed';
		}
	});

	// If navigation menu is present on page, adjust it on scroll and screen resize.
	if ($navigation.length) {

		// On scroll, we want to stick/unstick the navigation.
		$(window).on('scroll', function () {
			adjustScrollClass();
			//adjustHeaderHeight();
		});

		// Also want to make sure the navigation is where it should be on resize.
		$(window).resize(function () {
			setNavProps();
			setTimeout(adjustScrollClass, 500);
		});
	}

	$(window).resize(function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');
		}, 300);
		//setTimeout( adjustHeaderHeight, 1000 );
	});

	// Add header video class after the video is loaded.
	$(document).on('wp-custom-header-video-loaded', function () {
		$body.addClass('has-header-video');
	});




	//Top nav mobile menu
	$("#mobile-menu-toggle").click(function () {
		$(".mobile-menu-visible").toggle();
	})
	$("#menu-overlay").click(function () {
		$(".mobile-menu-visible").toggle();
	})
	$("#header-menu-mobile").click(function (e) {
		e.stopImmediatePropagation();
	})
	if (localStorage.getItem('isSubscribed')) {
		$(".subs-wrap").hide();
		$(".subs-thankyou").show();
	}

	//Subscribe
	$("#subs-submit").click(function (e) {
		var email = $("#subsemail").val();
		//debugger
		var pathname = "https://www.binbill.com/blog";
		pathname = window.location.origin;

		$.ajax({
			url: pathname + "/blog/wp-content/themes/binbill/subscription.php",
			data: {
				email: email
			},
			type: "post",
			success: function (s) {
				if ("Thankyou for subscribing" === s) {
					$(".subs-wrap").hide();
					$(".subs-thankyou").show();
					localStorage.setItem('isSubscribed', true);
				}
			},
			error: function (e) {
				console.log(e)
			}
		})
	})

	/*Share*/
	//Social Popup

	$(".social_share_pop").on("click", function (e) {

		e.preventDefault();

		windowPopup(jQuery(this).attr("href"), 500, 300);

	});
	function windowPopup(url, width, height) {
		// Calculate the position of the popup so
		// it’s centered on the screen.
		var left = (screen.width / 2) - (width / 2),
			top = (screen.height / 2) - (height / 2);
		window.open(
			url,
			"",
			"menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left
		);

	}

	//Send message Pop
	$("#openMessagePop, #openMessagePopMobile").click(function (e) {
		$("#messagePop").show();
	});

	$("#messageClose").click(function (e) {
		$("#messagePop").hide();
	})
	$("#yourPhone").keydown(function (e) {
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1) {
			return
		}
		if (e.which < 47 || e.which > 57) {
			e.preventDefault();
		} else {
			return
		}
	});
	$("#submitMessage").click(function (e) {
		$("#errorMsg").hide();
		var name = $("#yourName").val();
		var email = $("#yourEmail").val();
		var phone = $("#yourPhone").val();
		var message = $("#yourMessage").val();

		var emailPattern = /\A[^@]+@([^@\.]+\.)+[^@\.]+\z"/;
		var error = "";
		//Check blank
		if (name == "") {
			error = "Name cannot be blank";
		} else if (email == "") {
			error = "Email cannot be blank";
		} else if (phone == "") {
			error = "Phone cannot be blank";
		} else if (message == "") {
			error = "Message cannot be blank";
		} else {
			
			//Email validity
			var emailPattern = email.split("@");
			emailName = emailPattern[0];
			emailHost = emailPattern[1] ? emailPattern[1].split(".") : "";
			if (/^[a-zA-Z0-9._]+$/.test(emailName)) {

			} else {
				error = "Invalid Email";
			}
			if (/^[a-zA-Z0-9-]+$/.test(emailHost[0])) {

			} else {
				error = "Invalid Email";
			}
			if (emailHost[1] && /^[a-zA-Z]+$/.test(emailHost[1])) {

			} else {
				error = "Invalid Email";
			}
			if (emailHost[2]) {
				if (/^[a-zA-Z]+$/.test(emailHost[2])) {

				} else {
					error = "Invalid Email";
				}
			}
			if (emailPattern.length > 2 || emailHost.length > 3) {
				error = "Invalid Email";
			}

			//Name validity
			if(/^[a-zA-Z]+$/.test(name)) {

			}else{
				error = "Only Alphabets allowed in name";
			}

		}

		if (error != "") {
			var x = document.getElementById("errorMsg");
			x.innerText = error;
			$("#errorMsg").show();
			return;
		}

		var data = JSON.stringify({
			'name': name,
			'email': email,
			'phone': phone,
			'message': message
		})

		$.ajax({
			url: 'https://consumer.binbill.com/contact-us',
			type: "POST",
			dataType: "json",
			data: data,
			headers: {
				'Content-Type': "application/json; charset=UTF8",
				Accept: "application/json, text/javascript"

			},

			success: function (s) {
				$("#messagePop").hide();
			},
			error: function (e) {
				$("#messagePop").hide();
			}
		});


	});


	/*Search Form*/
	$(".nav-search-box").click(function () {
		$(".searchPop").toggle();
	})


})(jQuery);
