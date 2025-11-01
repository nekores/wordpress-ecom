/**
 * Main JavaScript file for Optimally Organic theme
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Hero Slider
        var currentSlide = 0;
        var slides = $('.hero-slide');
        var totalSlides = slides.length;
        var slideInterval;

        function showSlide(index) {
            slides.removeClass('active');
            $('.hero-slider-dots .dot').removeClass('active');
            slides.eq(index).addClass('active');
            $('.hero-slider-dots .dot').eq(index).addClass('active');
            currentSlide = index;
        }

        function nextSlide() {
            var next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        function prevSlide() {
            var prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        function startSlider() {
            slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        }

        function stopSlider() {
            clearInterval(slideInterval);
        }

        // Slider controls
        $('.hero-next').on('click', function() {
            stopSlider();
            nextSlide();
            startSlider();
        });

        $('.hero-prev').on('click', function() {
            stopSlider();
            prevSlide();
            startSlider();
        });

        // Dot navigation
        $('.hero-slider-dots .dot').on('click', function() {
            stopSlider();
            var slideIndex = $(this).index();
            showSlide(slideIndex);
            startSlider();
        });

        // Pause on hover
        $('.hero-slider').on('mouseenter', stopSlider).on('mouseleave', startSlider);

        // Initialize slider
        if (slides.length > 0) {
            showSlide(0);
            startSlider();
        }

        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $('.main-navigation ul').toggleClass('open');
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Newsletter form submission
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            var email = $(this).find('input[type="email"]').val();
            // Add your newsletter subscription logic here
            alert('Thank you for subscribing!');
            $(this).find('input[type="email"]').val('');
        });

        // Cart count update is handled by add-to-cart-alert.js

    });

})(jQuery);

