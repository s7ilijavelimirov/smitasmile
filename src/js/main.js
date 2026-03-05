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
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.hero-pagination',
                type: 'bullets',
                clickable: true,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
            speed: 1500,
            observer: true,
            observeParents: true,
            preventClicks: false,
        });
    }

    /**
     * Sticky Header - Hide on scroll down, show on scroll up
     */
    (function () {
        'use strict';

        const header = document.getElementById('masthead');
        if (!header) return;

        let lastScrollY = 0;
        let ticking = false;

        function handleScroll() {
            const scrollY = window.scrollY || document.documentElement.scrollTop;

            // Background: transparent at top, dark after scroll
            if (scrollY < 50) {
                header.style.background = 'rgba(0, 0, 0, 0)';
                header.classList.remove('header-hidden');
                header.classList.add('header-visible');
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.9)';

                // Hide on scroll down, show on scroll up
                if (scrollY > lastScrollY && scrollY > 100) {
                    header.classList.add('header-hidden');
                    header.classList.remove('header-visible');
                } else {
                    header.classList.remove('header-hidden');
                    header.classList.add('header-visible');
                }
            }

            lastScrollY = scrollY;
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(handleScroll);
                ticking = true;
            }
        }, { passive: true });

        handleScroll();

    })();

    // ============================================
    // SMOOTH SCROLL (opciono)
    // ============================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            // Skip if this is a Bootstrap modal trigger
            if (this.hasAttribute('data-bs-toggle') || this.hasAttribute('data-bs-target')) {
                return;
            }

            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                // Skip if target is a modal
                const target = document.querySelector(href);
                if (target && target.classList.contains('modal')) {
                    return;
                }

                e.preventDefault();
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
 

})();
/**
 * Smile Transformations - Elegant Before/After Cards
 * Click to toggle between AFTER and BEFORE images
 *
 * @package smitasmile
 */

(function () {
    'use strict';

    function initSmileTransformations() {
        // Select both transformation-card and makeover-card
        const cards = document.querySelectorAll('.transformation-card, .makeover-card');

        if (cards.length === 0) return;

        cards.forEach((card) => {
            const container = card.querySelector('.transformation-images');
            if (!container) return;

            // Click to toggle on all devices
            container.addEventListener('click', function(e) {
                e.preventDefault();

                // Toggle revealed state
                card.classList.toggle('is-revealed');

                // Add has-interacted class on first interaction (hides tap hint)
                if (!card.classList.contains('has-interacted')) {
                    card.classList.add('has-interacted');
                }
            });
        });
    }

    // Init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSmileTransformations);
    } else {
        initSmileTransformations();
    }

})();

/**
 * WhatsApp Float Button
 * @package smitasmile
 */

(function () {
    'use strict';

    function initWhatsAppButton() {
        const whatsappBtn = document.getElementById('whatsapp-btn');

        if (!whatsappBtn) return;

        const whatsappNumber = '+34622165781';

        // Detect language from HTML lang attribute (Polylang)
        const htmlLang = document.documentElement.lang || 'en';
        let message = '';

        if (htmlLang.startsWith('es')) {
            // Spanish message
            message = 'Hola SmitaSmile, me gustaría obtener más información sobre sus servicios dentales.';
        } else {
            // English message (default)
            message = 'Hi SmitaSmile, I would like to get more information about your dental services.';
        }

        const encodedMessage = encodeURIComponent(message);
        const whatsappURL = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

        whatsappBtn.href = whatsappURL;
        whatsappBtn.addEventListener('click', function (e) {
            // Omogući otvaranje linka
            this.target = '_blank';
            this.rel = 'noopener noreferrer';
        });

  
    }

    // Init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWhatsAppButton);
    } else {
        initWhatsAppButton();
    }

})();

/**
 * Gallery - Justified Row Layout + Fullscreen Viewer
 * @package smitasmile
 */

(function() {
    'use strict';

    function initGallery() {
        const gallery = document.getElementById('galleryMasonry');
        if (!gallery) return;

        const items = gallery.querySelectorAll('.gallery-item');
        if (items.length === 0) return;

        let currentIndex = 0;
        let viewer = null;
        const gap = 6;
        const totalImages = items.length;

        // ============================================
        // JUSTIFIED ROW LAYOUT
        // ============================================
        function layoutGallery() {
            const containerWidth = gallery.offsetWidth;
            const itemsArray = Array.from(items);

            // Target row height based on screen size
            let targetRowHeight = 280;
            if (window.innerWidth < 576) targetRowHeight = 160;
            else if (window.innerWidth < 768) targetRowHeight = 200;
            else if (window.innerWidth < 1200) targetRowHeight = 240;

            let row = [];
            let rowAspectRatio = 0;

            itemsArray.forEach((item, index) => {
                const ratio = parseFloat(item.dataset.ratio) || 1;
                row.push({ element: item, ratio: ratio });
                rowAspectRatio += ratio;

                // Calculate row width at target height
                const rowWidthAtTargetHeight = rowAspectRatio * targetRowHeight + (row.length - 1) * gap;
                const isLastItem = index === itemsArray.length - 1;

                // If row overflows or is last item, finalize row
                if (rowWidthAtTargetHeight >= containerWidth || isLastItem) {
                    // Calculate actual height for this row
                    const availableWidth = containerWidth - (row.length - 1) * gap;
                    let rowHeight = availableWidth / rowAspectRatio;

                    // Don't make last incomplete row too tall
                    if (isLastItem && rowWidthAtTargetHeight < containerWidth * 0.7) {
                        rowHeight = Math.min(rowHeight, targetRowHeight);
                    }

                    // Cap maximum height
                    rowHeight = Math.min(rowHeight, targetRowHeight * 1.3);

                    // Apply sizes to items in row
                    row.forEach(rowItem => {
                        const itemWidth = rowItem.ratio * rowHeight;
                        rowItem.element.style.width = itemWidth + 'px';
                        rowItem.element.style.height = rowHeight + 'px';
                        rowItem.element.style.flexGrow = '0';
                        rowItem.element.style.flexShrink = '0';
                    });

                    // Reset for next row
                    row = [];
                    rowAspectRatio = 0;
                }
            });

            gallery.classList.add('ready');
        }

        // Initial layout
        layoutGallery();

        // Relayout on resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(layoutGallery, 200);
        });

        // ============================================
        // FULLSCREEN VIEWER - Create dynamically
        // ============================================
        let isAnimating = false;

        function createViewer() {
            if (viewer) return;

            viewer = document.createElement('div');
            viewer.className = 'fullscreen-viewer';
            viewer.setAttribute('data-total', totalImages);

            // Build thumbnails HTML
            let thumbsHTML = '';
            items.forEach((item, idx) => {
                const url = item.dataset.url;
                const title = item.dataset.title || '';
                thumbsHTML += `<div class="viewer-thumb" data-index="${idx}"><img src="${url}" alt="${title}" loading="lazy"></div>`;
            });

            viewer.innerHTML = `
                <div class="viewer-header">
                    <span class="viewer-counter"></span>
                    <button class="viewer-close" type="button" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="viewer-main">
                    <img class="viewer-image slide-in" src="" alt="">
                    <div class="viewer-title-bar">
                        <p class="viewer-title"></p>
                    </div>
                    <button class="viewer-nav viewer-prev" type="button" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <button class="viewer-nav viewer-next" type="button" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                <div class="viewer-thumbnails">
                    <div class="viewer-thumbs-track">
                        ${thumbsHTML}
                    </div>
                </div>
            `;

            // Append directly to body (outside site-wrapper)
            document.body.appendChild(viewer);

            // Get elements
            const closeBtn = viewer.querySelector('.viewer-close');
            const prevBtn = viewer.querySelector('.viewer-prev');
            const nextBtn = viewer.querySelector('.viewer-next');
            const mainArea = viewer.querySelector('.viewer-main');
            const thumbs = viewer.querySelectorAll('.viewer-thumb');

            // Close button
            closeBtn.addEventListener('click', closeViewer);

            // Navigation buttons
            prevBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                navigate(-1);
            });

            nextBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                navigate(1);
            });

            // Thumbnail clicks
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const idx = parseInt(this.dataset.index);
                    if (idx !== currentIndex) {
                        const direction = idx > currentIndex ? 1 : -1;
                        currentIndex = idx;
                        updateViewer(direction);
                    }
                });
            });

            // Click on background to close
            mainArea.addEventListener('click', function(e) {
                if (e.target === mainArea) {
                    closeViewer();
                }
            });

            // Touch swipe on main area
            let touchStartX = 0;
            let touchStartY = 0;

            mainArea.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }, { passive: true });

            mainArea.addEventListener('touchend', function(e) {
                const touchEndX = e.changedTouches[0].screenX;
                const touchEndY = e.changedTouches[0].screenY;
                const diffX = touchStartX - touchEndX;
                const diffY = touchStartY - touchEndY;

                // Only horizontal swipe (not vertical scroll)
                if (Math.abs(diffX) > 50 && Math.abs(diffX) > Math.abs(diffY)) {
                    navigate(diffX > 0 ? 1 : -1);
                }
            }, { passive: true });
        }

        function openViewer(index) {
            createViewer();
            currentIndex = index;
            updateViewer(0, true);
            viewer.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeViewer() {
            if (!viewer) return;
            viewer.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        function navigate(direction) {
            if (isAnimating) return;
            const newIndex = (currentIndex + direction + totalImages) % totalImages;
            if (newIndex === currentIndex) return;
            currentIndex = newIndex;
            updateViewer(direction);
        }

        function updateViewer(direction, instant) {
            if (!viewer) return;
            if (isAnimating && !instant) return;

            const item = items[currentIndex];
            if (!item) return;

            const url = item.dataset.url;
            const title = item.dataset.title || '';
            const alt = item.querySelector('img')?.alt || title;

            const img = viewer.querySelector('.viewer-image');
            const titleEl = viewer.querySelector('.viewer-title');
            const counterEl = viewer.querySelector('.viewer-counter');
            const thumbs = viewer.querySelectorAll('.viewer-thumb');
            const thumbsTrack = viewer.querySelector('.viewer-thumbs-track');

            // Update counter
            if (counterEl) {
                counterEl.textContent = (currentIndex + 1) + ' / ' + totalImages;
            }

            // Update title
            if (titleEl) {
                titleEl.textContent = title;
                titleEl.style.opacity = title ? '1' : '0';
            }

            // Update thumbnails active state
            thumbs.forEach((thumb, idx) => {
                if (idx === currentIndex) {
                    thumb.classList.add('is-active');
                    // Scroll thumbnail into view
                    if (thumbsTrack) {
                        const isMobile = window.innerWidth < 768;
                        if (isMobile) {
                            // Horizontal scroll for mobile
                            const thumbLeft = thumb.offsetLeft;
                            const thumbWidth = thumb.offsetWidth;
                            const trackWidth = thumbsTrack.offsetWidth;
                            const scrollLeft = thumbLeft - (trackWidth / 2) + (thumbWidth / 2);
                            thumbsTrack.scrollTo({ left: scrollLeft, behavior: 'smooth' });
                        } else {
                            // Vertical scroll for desktop sidebar
                            const thumbTop = thumb.offsetTop;
                            const thumbHeight = thumb.offsetHeight;
                            const trackHeight = thumbsTrack.offsetHeight;
                            const scrollTop = thumbTop - (trackHeight / 2) + (thumbHeight / 2);
                            thumbsTrack.scrollTo({ top: scrollTop, behavior: 'smooth' });
                        }
                    }
                } else {
                    thumb.classList.remove('is-active');
                }
            });

            // Animate image transition
            if (img) {
                if (instant || direction === 0) {
                    // No animation - instant load
                    img.src = url;
                    img.alt = alt;
                    img.className = 'viewer-image slide-in';
                } else {
                    // Slide animation
                    isAnimating = true;
                    const slideOutClass = direction > 0 ? 'slide-out-left' : 'slide-out-right';

                    img.className = 'viewer-image ' + slideOutClass;

                    setTimeout(() => {
                        img.src = url;
                        img.alt = alt;
                        img.className = 'viewer-image slide-in';

                        setTimeout(() => {
                            isAnimating = false;
                        }, 400);
                    }, 200);
                }
            }
        }

        // ============================================
        // EVENT LISTENERS
        // ============================================

        // Click on gallery item
        items.forEach(item => {
            item.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                openViewer(index);
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!viewer || !viewer.classList.contains('is-open')) return;

            if (e.key === 'ArrowLeft') {
                navigate(-1);
            } else if (e.key === 'ArrowRight') {
                navigate(1);
            } else if (e.key === 'Escape') {
                closeViewer();
            }
        });
    }

    // Init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGallery);
    } else {
        initGallery();
    }

})();

/**
 * Slide Push Menu - Modern Hamburger Navigation
 * @package smitasmile
 */

(function() {
    'use strict';

    function initSlidePushMenu() {
        // Elements
        const body = document.body;
        const hamburgerToggle = document.querySelector('.hamburger-toggle');
        const menuClose = document.querySelector('.slide-push-menu__close');
        const siteOverlay = document.querySelector('.site-overlay');
        const slidePushMenu = document.querySelector('.slide-push-menu');
        const submenuToggles = document.querySelectorAll('.slide-push-menu__item.has-submenu > .slide-push-menu__link');

        // Exit if elements don't exist
        if (!hamburgerToggle || !slidePushMenu) return;

        /**
         * Open Menu
         */
        function openMenu() {
            body.classList.add('menu-open');
            hamburgerToggle.setAttribute('aria-expanded', 'true');

            // Focus trap - focus first menu item
            setTimeout(() => {
                const firstLink = slidePushMenu.querySelector('.slide-push-menu__link');
                if (firstLink) firstLink.focus();
            }, 300);

            // Prevent body scroll
            body.style.overflow = 'hidden';
        }

        /**
         * Close Menu
         */
        function closeMenu() {
            body.classList.remove('menu-open');
            hamburgerToggle.setAttribute('aria-expanded', 'false');

            // Return focus to hamburger
            hamburgerToggle.focus();

            // Restore body scroll
            body.style.overflow = '';

            // Close all submenus
            document.querySelectorAll('.slide-push-menu__item.is-open').forEach(item => {
                item.classList.remove('is-open');
                const link = item.querySelector('.slide-push-menu__link');
                if (link) link.setAttribute('aria-expanded', 'false');
            });
        }

        /**
         * Toggle Submenu
         */
        function toggleSubmenu(e) {
            e.preventDefault();
            const parentItem = e.currentTarget.parentElement;
            const isOpen = parentItem.classList.contains('is-open');

            // Close other open submenus
            document.querySelectorAll('.slide-push-menu__item.is-open').forEach(item => {
                if (item !== parentItem) {
                    item.classList.remove('is-open');
                    const link = item.querySelector('.slide-push-menu__link');
                    if (link) link.setAttribute('aria-expanded', 'false');
                }
            });

            // Toggle current submenu
            if (isOpen) {
                parentItem.classList.remove('is-open');
                e.currentTarget.setAttribute('aria-expanded', 'false');
            } else {
                parentItem.classList.add('is-open');
                e.currentTarget.setAttribute('aria-expanded', 'true');
            }
        }

        // ============================================
        // EVENT LISTENERS
        // ============================================

        // Hamburger toggle click
        hamburgerToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (body.classList.contains('menu-open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        // Close button click
        if (menuClose) {
            menuClose.addEventListener('click', closeMenu);
        }

        // Overlay click to close
        if (siteOverlay) {
            siteOverlay.addEventListener('click', closeMenu);
        }

        // Submenu toggles
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', toggleSubmenu);
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && body.classList.contains('menu-open')) {
                closeMenu();
            }
        });

        // Close menu when clicking a link (except submenu toggles)
        slidePushMenu.querySelectorAll('.slide-push-menu__link:not(.has-submenu > .slide-push-menu__link), .slide-push-menu__sublink').forEach(link => {
            link.addEventListener('click', function() {
                // Don't close if it's a submenu toggle
                if (!this.closest('.has-submenu') || this.classList.contains('slide-push-menu__sublink')) {
                    closeMenu();
                }
            });
        });

        // Prevent menu close when clicking inside menu (only when menu is open)
        slidePushMenu.addEventListener('click', function(e) {
            // Only stop propagation when menu is actually open
            // This prevents interference with Bootstrap modals and lightbox
            if (body.classList.contains('menu-open')) {
                e.stopPropagation();
            }
        });

        // ============================================
        // RESIZE HANDLER
        // ============================================

        // Optional: Close menu on large resize changes
        let windowWidth = window.innerWidth;
        window.addEventListener('resize', function() {
            const newWidth = window.innerWidth;
            // If significant size change (e.g., orientation change), close menu
            if (Math.abs(newWidth - windowWidth) > 200 && body.classList.contains('menu-open')) {
                closeMenu();
            }
            windowWidth = newWidth;
        });

    }

    // ============================================
    // INIT ON DOM READY
    // ============================================

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSlidePushMenu);
    } else {
        initSlidePushMenu();
    }

})();

/**
 * Language Dropdown - Header
 * @package smitasmile
 */

(function() {
    'use strict';

    function initLangDropdown() {
        const langDropdowns = document.querySelectorAll('.lang-dropdown');

        if (langDropdowns.length === 0) return;

        langDropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.lang-dropdown__toggle');

            if (!toggle) return;

            // Toggle dropdown on click
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isOpen = dropdown.classList.contains('is-open');

                // Close all other dropdowns
                document.querySelectorAll('.lang-dropdown.is-open').forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('is-open');
                        d.querySelector('.lang-dropdown__toggle').setAttribute('aria-expanded', 'false');
                    }
                });

                // Toggle current
                if (isOpen) {
                    dropdown.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                } else {
                    dropdown.classList.add('is-open');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.lang-dropdown')) {
                document.querySelectorAll('.lang-dropdown.is-open').forEach(dropdown => {
                    dropdown.classList.remove('is-open');
                    dropdown.querySelector('.lang-dropdown__toggle').setAttribute('aria-expanded', 'false');
                });
            }
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.lang-dropdown.is-open').forEach(dropdown => {
                    dropdown.classList.remove('is-open');
                    dropdown.querySelector('.lang-dropdown__toggle').setAttribute('aria-expanded', 'false');
                });
            }
        });
    }

    // Init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLangDropdown);
    } else {
        initLangDropdown();
    }

})();

/**
 * Bootstrap Modal Fix
 * Move modals outside site-wrapper to prevent stacking context issues
 * @package smitasmile
 */

(function() {
    'use strict';

    function initModalFix() {
        // Find all Bootstrap modals inside site-wrapper
        const siteWrapper = document.querySelector('.site-wrapper');
        if (!siteWrapper) return;

        const modals = siteWrapper.querySelectorAll('.modal');
        if (modals.length === 0) return;

        // Move each modal to body (outside site-wrapper)
        modals.forEach(modal => {
            document.body.appendChild(modal);
        });
    }

    // Init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initModalFix);
    } else {
        initModalFix();
    }

})();