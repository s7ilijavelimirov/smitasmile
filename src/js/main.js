/**
 * Main JavaScript - SmitaSmile Theme
 * @package smitasmile
 */

(function () {
    'use strict';

    // ============================================
    // SWIPER HERO INITIALIZATION
    // ============================================

    // Swiper je globalno dostupan jer se učitava kao <script>
    if (typeof Swiper !== 'undefined') {
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.hero-pagination',
                type: 'bullets',
                clickable: true,
            },
            effect: 'slide',
            speed: 1200,
            observer: true,
            observeParents: true,
            preventClicks: false,
        });

        console.log('SmitaSmile - Hero Swiper initialized');
    }

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
                header.style.background = 'rgba(0, 0, 0, 0)'; // Transparent
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
/**
 * Smile Makeovers - Before/After Slider
 * Vanilla JS - No dependencies
 * 
 * @package smitasmile
 */

(function() {
    'use strict';

    /**
     * Initialize Before/After sliders
     */
    function initSmileMakeovers() {
        const containers = document.querySelectorAll('.ttw-container');

        if (containers.length === 0) return;

        containers.forEach((container) => {
            initSlider(container);
        });
    }

    /**
     * Initialize single slider
     */
    function initSlider(container) {
        // Prevent double init
        if (container.dataset.ttwInit === 'true') return;
        container.dataset.ttwInit = 'true';

        // Get elements
        const beforeLayer = container.querySelector('.ttw-before');
        const afterLayer = container.querySelector('.ttw-after');
        const handle = container.querySelector('.ttw-handle');

        // Validate
        if (!beforeLayer || !afterLayer || !handle) {
            console.warn('Invalid slider structure');
            return;
        }

        // State
        const state = {
            isActive: false,
            currentPct: 50,
            bounds: null,
        };

        /**
         * Update clip-path percentage
         */
        function updateClip(pct) {
            state.currentPct = Math.max(0, Math.min(100, pct));
            beforeLayer.style.setProperty('--ttw-pct', state.currentPct + '%');
            handle.style.top = state.currentPct + '%';
        }

        /**
         * Get bounds
         */
        function getBounds() {
            state.bounds = container.getBoundingClientRect();
        }

        /**
         * Convert client position to percentage
         */
        function posToPercent(clientY) {
            if (!state.bounds) getBounds();
            const y = clientY - state.bounds.top;
            return (y / state.bounds.height) * 100;
        }

        /**
         * Start dragging
         */
        function startDrag(e) {
            e.preventDefault();
            state.isActive = true;
            getBounds();
            container.classList.add('ttw-dragging');
        }

        /**
         * Move handle
         */
        function onMove(e) {
            if (!state.isActive) return;

            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            updateClip(posToPercent(clientY));
        }

        /**
         * End dragging
         */
        function endDrag() {
            state.isActive = false;
            container.classList.remove('ttw-dragging');
        }

        /**
         * Click on container
         */
        function onContainerClick(e) {
            if (state.isActive) return;
            
            // Skip if clicking handle
            if (e.target === handle || handle.contains(e.target)) return;

            getBounds();
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            updateClip(posToPercent(clientY));
        }

        // ============================================
        // EVENT LISTENERS
        // ============================================

        // Mouse
        handle.addEventListener('mousedown', startDrag);
        window.addEventListener('mousemove', onMove);
        window.addEventListener('mouseup', endDrag);

        // Touch
        handle.addEventListener('touchstart', startDrag, { passive: false });
        window.addEventListener('touchmove', onMove, { passive: false });
        window.addEventListener('touchend', endDrag);

        // Click to set position
        container.addEventListener('click', onContainerClick);

        // ============================================
        // OBSERVERS
        // ============================================

        // Resize observer - update bounds
        if (window.ResizeObserver) {
            const ro = new ResizeObserver(() => {
                getBounds();
            });
            ro.observe(container);
        }

        // Intersection observer - init when visible
        if (window.IntersectionObserver) {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        getBounds();
                        updateClip(state.currentPct);
                    }
                });
            }, { threshold: 0.1 });
            io.observe(container);
        }

        // ============================================
        // INIT
        // ============================================

        // Get starting position from data attribute
        const startPct = parseFloat(container.dataset.ttwStart) || 50;
        getBounds();
        updateClip(startPct);
    }

    // ============================================
    // AUTO INIT ON DOM READY
    // ============================================

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSmileMakeovers);
    } else {
        initSmileMakeovers();
    }

    // Expose to global for manual init if needed
    window.initSmileMakeovers = initSmileMakeovers;

})();

