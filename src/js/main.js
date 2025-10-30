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

    /**
  * Sticky Header - Hide/Show on Scroll sa Transparent Top
  */
    (function () {
        'use strict';

        const header = document.getElementById('masthead');

        if (!header) return;

        let lastScrollTop = 0;
        let scrollDirection = 'up';
        let scrollDistance = 0;
        const scrollThreshold = 150;

        /**
         * Handle scroll event
         */
        function handleScroll() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;

            // Background color - transparent na vrhu, crna nakon skrolovanja
            if (scrollTop < 50) {
                header.style.background = 'rgba(0, 0, 0, 0)';
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.9)';
            }

            // Detektuj smer skrolovanja
            if (scrollTop > lastScrollTop) {
                scrollDirection = 'down';
                scrollDistance += scrollTop - lastScrollTop;
            } else {
                scrollDirection = 'up';
                scrollDistance += lastScrollTop - scrollTop;
            }

            // Hide/Show header nakon threshold-a
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
        }

        /**
         * Throttle scroll events za bolju performansu
         */
        let ticking = false;
        function requestScroll() {
            if (!ticking) {
                window.requestAnimationFrame(handleScroll);
                ticking = true;
                setTimeout(() => { ticking = false; }, 100);
            }
        }

        // ============================================
        // EVENT LISTENERS
        // ============================================

        window.addEventListener('scroll', requestScroll, { passive: true });

        // Initial check - VAŽNO: resetuj na vrhu
        handleScroll();

        // Dodatni listener za preciznost na vrhu
        window.addEventListener('scroll', () => {
            if (window.scrollY === 0) {
                header.style.background = 'rgba(0, 0, 0, 0)';
                header.classList.remove('header-hidden');
                header.classList.add('header-visible');
            }
        }, { passive: true });

        console.log('SmitaSmile - Header Sticky Script Loaded');

    })();

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

(function () {
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
        const handle = container.querySelector('.ttw-handle');

        // Validate
        if (!beforeLayer || !handle) {
            console.warn('TTW: Invalid slider structure');
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
         * Get container bounds
         */
        function getBounds() {
            state.bounds = container.getBoundingClientRect();
        }

        /**
         * Convert client Y position to percentage
         */
        function posToPercent(clientY) {
            if (!state.bounds) getBounds();
            const y = clientY - state.bounds.top;
            const height = state.bounds.height;
            return Math.max(0, Math.min(100, (y / height) * 100));
        }

        /**
         * Start dragging - može se krenuti sa bilo kog dela kontejnera
         */
        function startDrag(e) {
            e.preventDefault();
            state.isActive = true;
            getBounds();
            container.classList.add('ttw-dragging');
            handle.classList.add('active');

            // Odmah pozicioni na klik
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            updateClip(posToPercent(clientY));
        }

        /**
         * Move - kontinuiran drag
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
            handle.classList.remove('active');
        }

        // ============================================
        // EVENT LISTENERS
        // ============================================

        // Mouse events - na ceo kontejner
        container.addEventListener('mousedown', startDrag);
        window.addEventListener('mousemove', onMove);
        window.addEventListener('mouseup', endDrag);

        // Touch events - na ceo kontejner
        container.addEventListener('touchstart', startDrag, { passive: false });
        window.addEventListener('touchmove', onMove, { passive: false });
        window.addEventListener('touchend', endDrag);

        // ============================================
        // OBSERVERS
        // ============================================

        // Resize observer - update bounds kada se menja veličina
        if (window.ResizeObserver) {
            const ro = new ResizeObserver(() => {
                getBounds();
            });
            ro.observe(container);
        }

        // Intersection observer - lazy init kada je vidljivo
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

        // Get starting position from data attribute (default 50%)
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

