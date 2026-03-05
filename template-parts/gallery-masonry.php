<?php
/**
 * Gallery Masonry Template Part - Modern Redesign
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
            $aspect_ratio = $image_height > 0 ? round($image_width / $image_height, 2) : 1;
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

                    <!-- Zoom Icon -->
                    <span class="gallery-zoom-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="11" y1="8" x2="11" y2="14"></line>
                            <line x1="8" y1="11" x2="14" y2="11"></line>
                        </svg>
                    </span>

                    <?php if ($title): ?>
                        <figcaption class="gallery-overlay" itemprop="description">
                            <p class="gallery-image-title"><?php echo esc_html($title); ?></p>
                        </figcaption>
                    <?php endif; ?>
                </figure>
            </div>
        <?php endforeach; ?>
    </div>

</div>
