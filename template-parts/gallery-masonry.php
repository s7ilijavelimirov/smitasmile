<?php
/**
 * Gallery Masonry Template Part
 * 
 * @package smitasmile
 */

$gallery_title = get_field('gallery_title');
$gallery_description = get_field('gallery_description');
$gallery_images = get_field('gallery_images');

if (!$gallery_images) {
    echo '<div class="gallery-placeholder"><p>No gallery images found.</p></div>';
    return;
}
?>

<div class="gallery-masonry-wrapper">
    <?php if ($gallery_title || $gallery_description): ?>
        <div class="gallery-header">
            <?php if ($gallery_title): ?>
                <h2 class="gallery-title"><?php echo esc_html($gallery_title); ?></h2>
            <?php endif; ?>
            
            <?php if ($gallery_description): ?>
                <p class="gallery-description"><?php echo wp_kses_post($gallery_description); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="gallery-masonry" id="galleryMasonry" data-total="<?php echo count($gallery_images); ?>">
        <?php foreach ($gallery_images as $index => $item): 
            $image = $item['image'];
            $title = $item['title'];
            $alt = $item['alt_text'] ?: $title;
            $image_url = esc_url($image['url']);
            $image_width = (int)$image['width'];
            $image_height = (int)$image['height'];
            $aspect_ratio = $image_width / $image_height;
            ?>
            <div class="gallery-item" 
                data-index="<?php echo esc_attr($index); ?>" 
                data-width="<?php echo esc_attr($image_width); ?>" 
                data-height="<?php echo esc_attr($image_height); ?>" 
                data-ratio="<?php echo esc_attr($aspect_ratio); ?>"
                data-title="<?php echo esc_attr($title); ?>" 
                data-url="<?php echo $image_url; ?>">
                <figure class="gallery-figure">
                    <img 
                        src="<?php echo $image_url; ?>"
                        alt="<?php echo esc_attr($alt); ?>"
                        title="<?php echo esc_attr($title); ?>"
                        class="gallery-image"
                        loading="lazy"
                        decoding="async"
                        itemprop="image"
                        width="<?php echo esc_attr($image_width); ?>"
                        height="<?php echo esc_attr($image_height); ?>"
                    >
                    <?php if ($title): ?>
                        <figcaption class="gallery-overlay" itemprop="description">
                            <p class="gallery-image-title"><?php echo esc_html($title); ?></p>
                        </figcaption>
                    <?php endif; ?>
                </figure>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Lightbox Modal -->
    <div class="gallery-lightbox" id="galleryLightbox">
        <div class="lightbox-container">
            <button class="lightbox-close" id="lightboxClose" aria-label="Close gallery"></button>
            <button class="lightbox-prev" id="lightboxPrev" aria-label="Previous image">&#10094;</button>
            <div class="lightbox-content">
                <img class="lightbox-image" id="lightboxImage" src="" alt="">
                <p class="lightbox-title" id="lightboxTitle"></p>
            </div>
            <button class="lightbox-next" id="lightboxNext" aria-label="Next image">&#10095;</button>
            <div class="lightbox-counter" id="lightboxCounter"></div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    function initGallery() {
        const gallery = document.getElementById('galleryMasonry');
        if (!gallery) return;

        const items = gallery.querySelectorAll('.gallery-item');
        if (items.length === 0) return;

        let currentIndex = 0;
        const gap = 16;

        // Čekaj da sve slike budu učitane
        Promise.all(
            Array.from(items).map(item => {
                return new Promise(resolve => {
                    const img = item.querySelector('img');
                    if (img.complete) {
                        resolve();
                    } else {
                        img.onload = resolve;
                        img.onerror = resolve;
                    }
                });
            })
        ).then(() => {
            layoutMasonry();
            setupLightbox();
            window.addEventListener('resize', debounce(layoutMasonry, 300));
        });

        function debounce(func, wait) {
            let timeout;
            return function executedFunction() {
                const later = () => {
                    clearTimeout(timeout);
                    func();
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function layoutMasonry() {
            const containerWidth = gallery.offsetWidth;
            const itemsArray = Array.from(items);

            itemsArray.forEach(item => {
                item.style.width = '';
                item.style.height = '';
            });

            let rowHeight = 250;
            if (window.innerWidth < 768) rowHeight = 150;
            else if (window.innerWidth < 1024) rowHeight = 200;
            else if (window.innerWidth < 1400) rowHeight = 240;

            let row = [];
            let rowWidth = 0;

            itemsArray.forEach((item, index) => {
                const ratio = parseFloat(item.dataset.ratio);
                const itemWidth = rowHeight * ratio;

                row.push({ item: item, width: itemWidth });
                rowWidth += itemWidth + gap;

                const isLastItem = index === itemsArray.length - 1;
                const rowOverflows = rowWidth >= containerWidth;

                if (rowOverflows || isLastItem) {
                    const availableWidth = containerWidth - (gap * (row.length - 1));
                    const totalRatio = row.reduce((sum, r) => sum + r.width, 0);
                    let scale = availableWidth / totalRatio;

                    if (isLastItem && scale > 1) {
                        scale = 1;
                    }

                    row.forEach(r => {
                        const finalHeight = rowHeight * scale;
                        const finalWidth = r.width * scale;
                        r.item.style.width = finalWidth + 'px';
                        r.item.style.height = finalHeight + 'px';
                        r.item.style.flex = '0 0 auto';
                    });

                    row = [];
                    rowWidth = 0;
                }
            });

            gallery.classList.add('ready');
        }

        function setupLightbox() {
            const lightbox = document.getElementById('galleryLightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxTitle = document.getElementById('lightboxTitle');
            const lightboxCounter = document.getElementById('lightboxCounter');
            const lightboxClose = document.getElementById('lightboxClose');
            const lightboxPrev = document.getElementById('lightboxPrev');
            const lightboxNext = document.getElementById('lightboxNext');

            const getScrollbarWidth = () => {
                const outer = document.createElement('div');
                outer.style.visibility = 'hidden';
                outer.style.overflow = 'scroll';
                document.body.appendChild(outer);
                const inner = document.createElement('div');
                outer.appendChild(inner);
                const width = outer.offsetWidth - inner.offsetWidth;
                outer.parentNode.removeChild(outer);
                return width;
            };

            const scrollbarWidth = getScrollbarWidth();

            items.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentIndex = parseInt(this.dataset.index);
                    openLightbox();
                });
            });

            lightboxClose.addEventListener('click', closeLightbox);
            lightboxPrev.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                openLightbox();
            });
            lightboxNext.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % items.length;
                openLightbox();
            });

            lightbox.addEventListener('click', function(e) {
                if (e.target === this) closeLightbox();
            });

            document.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('active')) return;
                if (e.key === 'ArrowLeft') {
                    currentIndex = (currentIndex - 1 + items.length) % items.length;
                    openLightbox();
                }
                if (e.key === 'ArrowRight') {
                    currentIndex = (currentIndex + 1) % items.length;
                    openLightbox();
                }
                if (e.key === 'Escape') closeLightbox();
            });

            function openLightbox() {
                const item = items[currentIndex];
                lightboxImage.src = item.dataset.url;
                lightboxTitle.textContent = item.dataset.title || '';
                lightboxCounter.textContent = (currentIndex + 1) + ' / ' + items.length;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
                document.body.style.paddingRight = scrollbarWidth + 'px';
            }

            function closeLightbox() {
                lightbox.classList.remove('active');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '0px';
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGallery);
    } else {
        initGallery();
    }
})();
</script>