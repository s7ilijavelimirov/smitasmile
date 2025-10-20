/**
 * Main JavaScript - SmitaSmile Theme
 * @package smitasmile
 */

(function () {
    'use strict';

    // ============================================
    // STICKY HEADER - Hide/Show on Scroll
    // ============================================
    const header = document.getElementById('masthead');

    if (header) {
        let lastScrollTop = 0;
        let scrollDirection = 'up';
        let scrollDistance = 0;
        const scrollThreshold = 150;

        window.addEventListener('scroll', function () {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;

            // Promeni boju - transparent na vrhu (scrollTop < 50), crna kada se skroluje
            if (scrollTop < 50) {
                header.style.background = 'rgba(0, 0, 0, 0.3)'; // Transparent
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.9)'; // Crna
            }

            // Detektuj smer skrolovanja
            if (scrollTop > lastScrollTop) {
                scrollDirection = 'down';
                scrollDistance += scrollTop - lastScrollTop;
            } else {
                scrollDirection = 'up';
                scrollDistance += lastScrollTop - scrollTop;
            }

            // Primeni hide/show nakon threshold-a
            if (scrollDistance > scrollThreshold) {
                if (scrollDirection === 'down' && scrollTop > 100) {
                    header.classList.add('header-hidden');
                    header.classList.remove('header-visible');
                } else {
                    header.classList.remove('header-hidden');
                    header.classList.add('header-visible');
                }
                scrollDistance = 0;
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);
    }

    // ============================================
    // DROPDOWN HOVER (ako trebate bez data-bs-toggle)
    // ============================================
    const dropdownItems = document.querySelectorAll('.navbar-nav .dropdown');

    dropdownItems.forEach(function (item) {
        const toggle = item.querySelector('.dropdown-toggle');
        const menu = item.querySelector('.dropdown-menu');

        if (toggle && menu) {
            // Desktop - hover
            item.addEventListener('mouseenter', function () {
                menu.classList.add('show');
            });

            item.addEventListener('mouseleave', function () {
                menu.classList.remove('show');
            });
        }
    });

    // ============================================
    // SMOOTH SCROLL (opciono)
    // ============================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const target = document.querySelector(href);
                const headerHeight = header ? header.offsetHeight : 0;
                const targetTop = target.offsetTop - headerHeight - 20;

                window.scrollTo({
                    top: targetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ============================================
    // DOCUMENT READY
    // ============================================
    console.log('SmitaSmile Theme - Main JS Loaded');

})();