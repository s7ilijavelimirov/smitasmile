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
    <div class="container-fluid px-0 pb-lg-8 pb-md-6 pt-0">
        <div class="row">
            <div class="col-12">
                <?php
                $gallery_cta_link = get_field('gallery_cta_link');
                $gallery_images = get_field('gallery_images');
                ?>

                <!-- CTA Button -->
                <!-- <?php if ($gallery_cta_link): ?>
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
                <?php endif; ?> -->

                <!-- Gallery Masonry Template Part -->
                <?php get_template_part('template-parts/gallery-masonry'); ?>
            </div>
            <!-- <iframe src="https://www.theasys.io/viewer/88wSAFPya9fyuaQGmfB2ZTLdwWqJf3/"
                width="100%" height="800" frameborder="0" allow="fullscreen">
            </iframe> -->


        </div>
    </div>


</section>
<!-- CTA Section -->
<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer(); ?>