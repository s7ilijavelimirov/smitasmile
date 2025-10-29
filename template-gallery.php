<?php

/**
 * Template Name: Gallery
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();
?>

<!-- Gallery Content -->
<section class="gallery-content container-fluid">
    <div class="container container-xxl">
        <div class="row">
            <div class="col-12">
                <?php
                $gallery_cta_link = get_field('gallery_cta_link');
                $gallery_images = get_field('gallery_images');
                ?>

                <!-- CTA Button -->
                <?php if ($gallery_cta_link): ?>
                    <div class="gallery-cta-section text-center mb-5">
                        <a href="<?php echo esc_url($gallery_cta_link['url']); ?>"
                            class="btn btn-outline-light tour"
                            target="<?php echo esc_attr($gallery_cta_link['target'] ?: '_self'); ?>"
                            rel="<?php echo esc_attr($gallery_cta_link['target'] === '_blank' ? 'noopener noreferrer' : ''); ?>">
                            <?php
                            $svg_path = get_template_directory() . '/dist/img/360.svg';
                            if (file_exists($svg_path)) {
                                echo file_get_contents($svg_path);
                            }
                            ?>
                            <span><?php echo esc_html($gallery_cta_link['title']); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Gallery Masonry Template Part -->
                <?php get_template_part('template-parts/gallery-masonry'); ?>
            </div>
        </div>
    </div>
    <div class="container container-xxl">
        <h1>Instagram Feed</h1>
        <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
    </div>
</section>

<?php get_footer(); ?>