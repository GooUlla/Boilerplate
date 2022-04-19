import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

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
    var wrapper = block + ' .swiper';
    const swiper = new Swiper(wrapper, {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
    
      // If we need pagination
      pagination: {
        el: '.swiper-pagination',
      },
    
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    
      // And if we need scrollbar
      scrollbar: {
        el: '.swiper-scrollbar',
      },
    });
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