/* ========================================================================
 * see manifest.json to see the order that scripts are combined
 *
 * TOC
 *
 *
 * ======================================================================== */


(function($) {

	$(window).load(function() {

		// flexslider init
		// The slider being synced must be initialized first
		$('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 210,
			itemMargin: 5,
			asNavFor: '#slider',
			prevText: '',
			nextText: '',
		});

		$('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: "#carousel"
		});
	});

})(jQuery);
