function setupSearch() {
    $('#header .toggle-hide').on('click', function (e) {
        e.preventDefault();
        if ($('#menu').hasClass('active')) return; // Prevent toggle in mobile
        vanhoover_toggle_main_search();
    });
    $('#header .search-field').on('focus', function () {
        if ($('#header .toggle-hide').data('enabled') !== true) {
            vanhoover_toggle_main_search();
        }
    });
    $('#header .search-form').on('scroll', function () {
        this.scrollLeft = 0;
    }).on('keyup', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            $('#header .search-submit').click();
        }
    });
    $('#header .search-field, #header .search-submit').css({
        'position': 'absolute',
        'left': '-100vw'
    });
}

function setupNav() {
    $('.menu-item-has-children > a').append(' ').append($('<i>').addClass('fas fa-caret-down'));
    $('.menu-toggle-mobile').on('click', function (e) {
        e.preventDefault();
        let active = $('#menu').toggleClass('active').hasClass('active');
        if (($('#header .toggle-hide').data('enabled') !== true && active) ||
            ($('#header .toggle-hide').data('enabled') === true && !active)) {
            // sync open state with nav
            if (active) setTimeout(vanhoover_toggle_main_search, 300);
            else vanhoover_toggle_main_search();
        }
    });
}

function setupHotelSlider() {
    $('.hotel-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 2,
        autoplay: true,
        dots: true,
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev"><span class="fas fa-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></button>',
        nextArrow: '<button type="button" class="slick-next"><span class="fas fa-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></button>',
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 783,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: false
                }
            },
            {
                breakpoint: 581,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: false
                }
            }
        ]
    });
}

function setupFooter() {
    $(window).on('scroll', toggleOnScroll);
    toggleOnScroll();
    $('#return-to-top').on('click', function (e) {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
}

function toggleOnScroll() {
    $('#return-to-top').css('bottom',
        (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) ? '1em' : '-3em'
    );
    $('#homepage-scroll-down-container').css('opacity',
        (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) ? '0' : '1'
    );
}

let timeout;

function vanhoover_toggle_main_search() {
    let button = $('#header .toggle-hide');
    if ($(button).data('enabled') !== true) {
        $('#search').addClass('active');
        $('#header .search-field, #header .search-submit').removeAttr('style');
        $(button).addClass('active').data('enabled', true);
        $('#header .search-form')
            .css('background', 'rgba(255,255,255,1)')
            .css('width', '312px');
        if ($('#menu').hasClass('active')) return; // Prevent focus in mobile
        $('#header .search-field').focus();
        clearTimeout(timeout);
    } else {
        $('#search').removeClass('active');
        $(button).removeClass('active').data('enabled', false);
        $('#header .search-form')
            .css('background', 'rgba(255,255,255,0)')
            .css('width', '2em');
        timeout = setTimeout(function () {
            $('#header .search-field, #header .search-submit').css({
                'position': 'absolute',
                'left': '-100vw'
            });
        }, 250);
    }
}

window.clickCount = 0;
function setupPuzzle() {
    $("#homepage-image").on('click', function (){
        window.clickCount += 1;
        if(window.clickCount >= 15) {
            $('#head-nav-img').attr('href', './politestpony');
        }
    });
}

$(document).ready(function () {
    setupSearch();
    setupNav();
    setupHotelSlider();
    setupFooter();
    setupPuzzle()
});