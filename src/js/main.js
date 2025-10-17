// Header scroll behavior
// Header scroll behavior
(function () {
    let lastScrollTop = 0;
    const navbar = $('.navbar');
    const scrollThreshold = 50;

    $(window).on('scroll', function () {
        const scrollTop = $(this).scrollTop();

        if (scrollTop > scrollThreshold) {
            if (scrollTop > lastScrollTop) {
                navbar.addClass('scrolling-down').removeClass('scrolling-up');

                // ✅ Mobilni - sakrij naziv sajta
                if ($(window).width() < 1200) {
                    $('.navbar-brand span').fadeOut(200);
                }

            } else {
                navbar.addClass('scrolling-up').removeClass('scrolling-down');

                // ✅ Mobilni - prikaži naziv sajta
                if ($(window).width() < 1200) {
                    $('.navbar-brand span').fadeIn(200);
                }
            }
        } else {
            navbar.removeClass('scrolling-down scrolling-up');

            // ✅ Na vrhu - uvek prikaži naziv
            if ($(window).width() < 1200) {
                $('.navbar-brand span').fadeIn(200);
            }
        }
        lastScrollTop = scrollTop;
    });
})();
// Slider
$('.hero-slider').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true,
    arrows: false,
    dots: false,
    speed: 1200,
    pauseOnHover: false,
    cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)'
});

// Lazy load backgrounds
$('.hero-slide').each(function () {
    const bg = $(this).data('bg');
    $(this).css('background-image', `url(${bg})`);
});

// ✅ Fix: Reset animation pre slide change
$('.hero-slider').on('beforeChange', function () {
    $('.hero-subtitle, .hero-title, .hero-logo').removeClass('animate-in');
});

// ✅ Trigger animations nakon što se slide promeni
$('.hero-slider').on('afterChange', function () {
    setTimeout(() => {
        $('.slick-active .hero-subtitle, .slick-active .hero-title, .slick-active .hero-logo').addClass('animate-in');
    }, 50); // ✅ Kraći delay
});

// Initial animation
setTimeout(() => {
    $('.slick-active .hero-subtitle, .slick-active .hero-title, .slick-active .hero-logo').addClass('animate-in');
}, 100);
// Rezervacije
if ($(".booking").hasClass("booking-en")) {
    $('.check-availability-toggle').click(function (e) {
        e.preventDefault();
        $('.booking-hidden').slideToggle(400);
        $(this).text($(this).text() == "Close reservation" ? "Check availability" : "Close reservation");
    });
} else {
    $('.check-availability-toggle').click(function (e) {
        e.preventDefault();
        $('.booking-hidden').slideToggle(400);
        $(this).text($(this).text() == "Reservierung abschließen" ? "Verfügbarkeit prüfen" : "Reservierung abschließen");
    });
}

$(".booking .input-group .form-control").unwrap();

$('#datum-dolaska').datepicker({
    format: "dd/mm/yyyy",
    weekStart: 1,
    todayHighlight: true,
    startDate: new Date()
}).datepicker("setDate", "0");

$('#datum-odlaska').datepicker({
    format: "dd/mm/yyyy",
    weekStart: 1,
    todayHighlight: true,
    startDate: new Date()
}).datepicker("setDate", "0");

// Room slider
$('.room-slider').slick({
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 1199,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        }
    ]
});

$(document).ready(function () {
    $('.room-slider').slickLightbox({
        itemSelector: 'a'
    });
});

// Apartment sliders
$(document).ready(function () {
    $('.apartment-slider').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        fade: true,
        arrows: false,
        dots: true,
        infinite: true,
        speed: 800,
        pauseOnHover: true,
        pauseOnFocus: true,
        dotsClass: 'slick-dots',
        cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)'
    });
});

// Scroll Animations
$(document).ready(function () {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('animate-in');
                }, entry.target.dataset.delay || 0);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    $('[data-scroll]').each(function () {
        observer.observe(this);
    });
});
// Intro Gallery Slider
$(document).ready(function () {
    if ($('.intro-gallery-slider').length) {
        // Glavni slider
        $('.intro-gallery-slider').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            fade: true,
            arrows: false,
            dots: true,
            infinite: true,
            speed: 800,
            pauseOnHover: false,
            pauseOnFocus: false,
            cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
            adaptiveHeight: true
        });

        // ✅ Lightbox galerija
        $('.intro-gallery-lightbox').slickLightbox({
            itemSelector: 'a'
        });

        // ✅ Klik na slider slike trigguje lightbox
        $('.gallery-main, .gallery-thumb').on('click', function () {
            const imgUrl = $(this).data('img');
            const $link = $('.intro-gallery-lightbox a[href="' + imgUrl + '"]');
            if ($link.length) {
                $link.trigger('click');
            }
        });
    }
});
// FAQ Search - Simple & Clean (bez highlight-a)
$(document).ready(function () {
    const searchInput = $('#faqSearch');
    const searchCount = $('.search-results-count');

    if (searchInput.length) {
        searchInput.on('input', function () {
            const searchTerm = $(this).val().toLowerCase().trim();
            let visibleCount = 0;

            if (searchTerm === '') {
                // Reset
                $('.accordion-item').show();
                $('.faq-section').show();
                $('.faq-section-title').show();
                searchCount.text('');
                return;
            }

            // Pretraži sve accordion items
            $('.accordion-item').each(function () {
                const $item = $(this);
                const questionText = $item.find('.accordion-button').text().toLowerCase();
                const answerText = $item.find('.accordion-body').text().toLowerCase();

                if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                    $item.show();
                    visibleCount++;
                } else {
                    $item.hide();
                }
            });

            // Sakrij/prikaži sekcije i naslove
            $('.faq-section').each(function () {
                const $section = $(this);
                const visibleItems = $section.find('.accordion-item:visible').length;

                if (visibleItems === 0) {
                    $section.find('.faq-section-title').hide();
                    $section.addClass('no-results');
                } else {
                    $section.find('.faq-section-title').show();
                    $section.removeClass('no-results');
                }
            });

            // Update count
            if (visibleCount > 0) {
                searchCount.text(`${visibleCount} ${visibleCount === 1 ? 'result' : 'results'}`);
            } else {
                searchCount.text('No result');
            }
        });
    }
});
// Business Inquiry Modal - Date Pickers
$(document).ready(function () {
    
    $('#businessInquiryModal').on('shown.bs.modal', function () {
        
        // English version
        const checkinEN = $('#checkin-date-en');
        const checkoutEN = $('#checkout-date-en');
        
        if (checkinEN.length && checkoutEN.length) {
            checkinEN.datepicker({
                format: "dd.mm.yyyy",
                weekStart: 1,
                todayHighlight: true,
                startDate: new Date(),
                autoclose: true
            }).on('changeDate', function(e) {
                const nextDay = new Date(e.date);
                nextDay.setDate(nextDay.getDate() + 1);
                checkoutEN.datepicker('setStartDate', nextDay);
                checkoutEN.focus();
            });
            
            checkoutEN.datepicker({
                format: "dd.mm.yyyy",
                weekStart: 1,
                todayHighlight: true,
                startDate: new Date(),
                autoclose: true
            });
        }
        
        // German version
        const checkinDE = $('#checkin-date-de');
        const checkoutDE = $('#checkout-date-de');
        
        if (checkinDE.length && checkoutDE.length) {
            checkinDE.datepicker({
                format: "dd.mm.yyyy",
                weekStart: 1,
                todayHighlight: true,
                startDate: new Date(),
                autoclose: true
            }).on('changeDate', function(e) {
                const nextDay = new Date(e.date);
                nextDay.setDate(nextDay.getDate() + 1);
                checkoutDE.datepicker('setStartDate', nextDay);
                checkoutDE.focus();
            });
            
            checkoutDE.datepicker({
                format: "dd.mm.yyyy",
                weekStart: 1,
                todayHighlight: true,
                startDate: new Date(),
                autoclose: true
            });
        }
    });
    
    $('#businessInquiryModal').on('hidden.bs.modal', function () {
        $('#checkin-date-en, #checkout-date-en, #checkin-date-de, #checkout-date-de').each(function() {
            if ($(this).data('datepicker')) {
                $(this).datepicker('destroy');
            }
        });
    });
});