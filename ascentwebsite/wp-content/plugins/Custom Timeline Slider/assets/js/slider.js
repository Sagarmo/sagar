jQuery(document).ready(function($) {
    let currentIndex = 0;

    function slideTo(index) {
        const $slider = $('.cts-slider');
        const slideWidth = $('.cts-slide').outerWidth(true);
        const offset = -index * slideWidth;
        $slider.css('transform', `translateX(${offset}px)`);
    }

    $('.cts-timeline-slider').on('click', '.cts-slide', function() {
        currentIndex = $(this).index();
        slideTo(currentIndex);
    });
});
