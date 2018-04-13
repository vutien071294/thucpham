jQuery(document).ready(function ($) {
	var s, d;
	var VMZ = {
		settings: {
			document: $(document),
			body: $(document.body),
			window: $(window),
			browserWidth: 0,
			browserHeight: 0,
		},
		init: function () {
			d = this;
			s = this.settings;

			d.updateBrowserDimension();

			s.window.on('resize', debounce(function () {
				d.updateBrowserDimension();
			}, 250));
		},
		updateBrowserDimension: function () {
			s.browserWidth  = s.window.width();
			s.browserHeight = s.window.height();
		},
	};

	VMZ.init();
});
