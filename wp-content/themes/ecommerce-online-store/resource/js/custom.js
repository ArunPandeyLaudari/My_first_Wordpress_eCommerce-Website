jQuery(function($) {

    /* -----------------------------------------
    Preloader
    ----------------------------------------- */
    $('#preloader').delay(1000).fadeOut();
    $('#loader').delay(1000).fadeOut("slow");

    /* -----------------------------------------
    Navigation
    ----------------------------------------- */
    $('.menu-toggle').click(function() {
        $(this).toggleClass('open');
    });

    /* -----------------------------------------
    Keyboard Navigation
    ----------------------------------------- */
    $(window).on('load resize', function() {
        if ($(window).width() < 1200) {
            $('.main-navigation').find("li").last().bind('keydown', function(e) {
                if (e.which === 9) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
        } else {
            $('.main-navigation').find("li").unbind('keydown');
        }
    });

    var primary_menu_toggle = $('#masthead .menu-toggle');
    primary_menu_toggle.on('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        var shiftKey = e.shiftKey;

        if (primary_menu_toggle.hasClass('open')) {
            if (shiftKey && tabKey) {
                e.preventDefault();
                $('.main-navigation').toggleClass('toggled');
                primary_menu_toggle.removeClass('open');
            };
        }
    });

    /* -----------------------------------------
    Main Slider
    ----------------------------------------- */

    // Determine if the document is RTL
    var isRtl = $('html').attr('dir') === 'rtl';

    $('.banner-slider').slick({
        autoplaySpeed: 3000,
        dots: false,
        arrows: true,
        nextArrow: '<button class="fas fa-angle-right slick-next"></button>',
        rtl: isRtl, // Set the rtl option
        prevArrow: '<button class="fas fa-angle-left slick-prev"></button>',    
        responsive: [{
            
            breakpoint: 1025,
            settings: {
                dots: true,
                arrows: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                dots: true,
                arrows: false,
            }
        }]
    });

    /* -----------------------------------------
    Scroll Top
    ----------------------------------------- */
    var scrollToTopBtn = $('.ecommerce-online-store-scroll-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 400) {
            scrollToTopBtn.addClass('show');
        } else {
            scrollToTopBtn.removeClass('show');
        }
    });

    scrollToTopBtn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });
    
});

window.addEventListener('scroll', function() {
    const header = document.querySelector('.sticky-header');
    if (window.scrollY > 0) {
    header.classList.add('is-sticky');
    } else {
    header.classList.remove('is-sticky');
    }
});