'use strict';

function debounce(func, wait, immediate) {
	var timeout;
	return function () {
		var context = this, args = arguments;
		var later   = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

( function ($) {
	var s, self;
	var VietMoz = {
		settings: {
			document: $(document),
			body: $(document.body),
			window: $(window),
			browserWidth: 0,
			browserHeight: 0,
			headDOM: document.getElementById('masthead'),
			head: $(document.getElementById('masthead')),
			mheadDOM: document.getElementById('mhead'),
			mhead: $(document.getElementById('mhead')),
			mmenu: $(document.getElementById('m-menu')),
			menuToggler: $('.menu-toggler'),
			dropdownToggler: $('.dropdown-toggler'),
			mSearchToggler: $('.search-toggler'),
			mSearch: $('#search-wrapper'),
			mSearchInput: $('#search-wrapper .search-field'),
			sidebarDOM: document.getElementById('secondary'),
			sidebar: $(document.getElementById('secondary')),
			footerDOM: document.getElementById('colophon'),
			footer: $(document.getElementById('colophon')),
			footerRow: $('#colophon .row'),
			grid: $('.grid'),
			backToTop: $('#back-to-top'),
			backToTopOffset: 300,
			backToTopOffsetOpacity: 1200,
			backToTopDuration: 700,
			slick: $('.slick'),
		},
		init: function () {
			self = this;
			s    = this.settings;

			s.menuToggler.on('click', this.toggleMenu);
			s.dropdownToggler.on('click', this.toggleSubMenu);
			s.body.on('click', this.closeMenu);
			s.mSearchToggler.on('click', this.toogleSearch);
			s.backToTop.on('click', this.backToTopClick);
			$('#header-search-btn').on('click', this.v1cSearchHandler);

			window.addEventListener('resize', debounce(function () {
				self.updateBrowserDimension();
			}, 250));

			window.addEventListener('scroll', debounce(function () {
				self.backToTopScroll();
			}, 100));

			this.updateBrowserDimension();
			this.activateHeadroom();
			// this.makeSidebarIsotope();
			// this.makeFooterIsotope();
			this.initIsotope();
			this.activateSlick();
		},
		toggleMenu: function () {
			s.mmenu.slideToggle();
			s.mhead.toggleClass('active');
		},
		toggleSubMenu: function () {
			$(this).find('+ ul').slideToggle();
			$(this).parent().toggleClass('dropdown-active');
		},
		closeMenu: function (e) {
			if (!s.mhead.hasClass('active')) return;

			if ($.contains(s.mheadDOM, e.target)) return;

			self.toggleMenu();
		},
		toogleSearch: function () {
			s.mhead.toggleClass('search-active');
			s.mSearch.slideToggle(function () {
				s.mSearchInput.focus();
			});
		},
		activateHeadroom: function () {
			if (VIETMOZ.headroom) {
				var headroom = new Headroom(s.headDOM);
				headroom.init();
			}
			if (VIETMOZ.m_headroom) {
				var mHeadroom = new Headroom(s.mheadDOM);
				mHeadroom.init();
			}
		},
		makeSidebarIsotope: function () {
			if (s.sidebar.is(':empty')) {
				return;
			}
			s.sidebar.isotope({
				masonry: {
					gutter: '.gutter-sizer',
					columnWidth: '.widget',
				},
				itemSelector: '.widget',
				percentPosition: true,
			});
		},
		updateBrowserDimension: function () {
			s.browserWidth  = s.window.width();
			s.browserHeight = s.window.height();
		},
		initIsotope: function () {
			if (s.grid.is(':empty')) {
				return;
			}

			s.grid.imagesLoaded(function() {
				if ( s.grid.hasClass('fitrows') ) {
					s.grid.isotope({
						layoutMode: 'fitRows',
						itemSelector: '.grid-item',
						percentPosition: true,
					});
				} else {
					s.grid.isotope({
						masonry: {
							columnWidth: '.grid-item',
						},
						itemSelector: '.grid-item',
						percentPosition: true,
					});
				}
			});
		},
		backToTopScroll: function () {
			if (s.window.scrollTop() > s.backToTopOffset) {
				s.backToTop.addClass('is-visible')
			} else {
				s.backToTop.removeClass('is-visible fade-out');
			}

			if (s.window.scrollTop() > s.backToTopOffsetOpacity) {
				s.backToTop.addClass('fade-out');
			}
			if (s.window.scrollTop() > ( s.document.height() - s.browserHeight - s.backToTopOffset )) {
				s.backToTop.removeClass('fade-out');
			}
		},
		backToTopClick: function () {
			event.preventDefault();
			$('body,html').animate({
					scrollTop: 0,
				}, s.backToTopDuration
			);
		},
		activateSlick: function () {
			s.slick.each(function () {
				$(this).slick();
			})
		},
		v1cSearchHandler: function (e) {
			e.preventDefault();
			var searchForm = $(this).parent().find('.search-wrapper');
			searchForm.toggle();
		}
	};

	VietMoz.init();

	/* Mega Menu */
	$('.vietmoz-menu li.vmz-mega-menu').mouseenter(function () {
		$(this).find(' > .megamenu').fadeIn(300);
	});

	$('.vietmoz-menu li.vmz-mega-menu').mouseleave(function () {
		$(this).find(' > .megamenu').fadeOut(300);
	});

	$(".tab-titles li").hover(function () {
		$(".tab-content").removeClass('tab-show');
		$(".tab-titles li").removeClass('active');
		$(this).addClass("active");
		var selected_tab = $(this).find("a").attr("href");
		$(selected_tab).addClass("tab-show");
		return false;
	});
	/* end Mega menu */
}(jQuery) );
