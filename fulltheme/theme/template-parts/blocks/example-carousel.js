(function ($) {
	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    15/4/19
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */
	var initializeBlock = function ($block) {
		var block = '.' + $block.attr('class').split(' ').join('.');
    var slides = block + ' .slides';
		var controls = block + ' .pagination'
    const slider = tns({
			container: slides,
			items: 1,
			mode: 'gallery',
			speed: '600',
			navContainer: controls,
			navAsThumbnails: true,
			autoplay: true,
			autoplayTimeout: 3000,
			autoplayButtonOutput: false,
			controls: false
		});
	};
	};

	// Initialize each block on page load (front end).
	$(document).ready(function () {
		$(".carousel").each(function () {
			initializeBlock($(this));
		});
	});

	// Initialize dynamic block preview (editor).
	if (window.acf) {
		window.acf.addAction("render_block_preview/type=example-carousel", initializeBlock);
	}
})(jQuery);