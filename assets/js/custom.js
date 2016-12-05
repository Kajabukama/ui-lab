$(document).ready(function() {
    window_size = $(window).height();
    $('.col').height(window_size);
    $('.carousel.carousel-slider').carousel({full_width: true});
    // $('.carousel.carousel-slider').height(window_size);
});