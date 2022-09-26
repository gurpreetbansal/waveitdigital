(function ($) {
    'use strict';

    // AOS.init();

    $(window).scroll(function () {
        var windowScroll = $(window).scrollTop();

        if (windowScroll >= 10) {
            $("#header").addClass("scrolled");
        } else {
            $("#header").removeClass("scrolled");
        }
    });

    $(document).ready(function () {
        $('.site-search > a').click(function () {
            $(this).parent().toggleClass('visible');
            $(this).children('i').toggleClass('fa-times fa-search')
        });
    });

    $(window).on("load resize", function () {
        var siteFooter = $('#footer').outerHeight();
        $('main').css({
            'margin-bottom': siteFooter + 'px'
        });
    });

    var home_swiper = new Swiper(".home-swiper", {
        speed: 500,
        effect: 'slide',
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 'auto',
        spaceBetween: 30,
        watchOverflow: true,
        grabCursor: false,
        allowTouchMove: true,
        observer: true,
        observeParents: true,
        observeSlideChildren: true,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        }
    });
    $(".home-swiper").hover(function () {
        (this).swiper.autoplay.stop();
    }, function () {
        (this).swiper.autoplay.start();
    });

    //Avoid pinch zoom on iOS
    document.addEventListener('touchmove', function (event) {
        if (event.scale !== 1) {
            event.preventDefault();
        }
    }, false);
})(jQuery)