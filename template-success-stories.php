<?php

/**
 * Template Name: Success Stories
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();
?>

<!-- Intro Section -->
<?php get_template_part('template-parts/intro-section'); ?>

<?php
// What Lead Us to Success Section
$main_title = get_field('success_main_title');
$items = get_field('success_items');

if ($main_title || $items) :
?>
    <section class="container-fluid what-lead-us-to-success py-7 py-md-8 py-xl-9">
        <div class="success">
            <!-- Main Title -->
            <?php if ($main_title) : ?>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center mb-5 fs-1">
                            <?php echo esc_html($main_title); ?>
                        </h2>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Items Grid -->
            <?php if ($items && is_array($items)) : ?>
                <div class="row g-4">
                    <?php foreach ($items as $item) :
                        $icon_id = $item['item_icon'];
                        $image_id = $item['item_image'];
                        $title = $item['item_title'];
                        $description = $item['item_description'];
                        $icon_url = wp_get_attachment_image_url($icon_id, 'thumbnail');
                        $image_url = wp_get_attachment_image_url($image_id, 'medium_large');
                    ?>
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="success-card h-100">
                                <!-- Card Image -->
                                <div class="success-card__image-wrapper">
                                    <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="success-card__image">
                                    <?php endif; ?>

                                    <!-- Icon Overlay -->
                                    <?php if ($icon_url) : ?>
                                        <div class="success-card__icon">
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($title); ?>" class="success-card__icon-img">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Card Content -->
                                <div class="success-card__content">
                                    <h4 class="success-card__title"><?php echo esc_html($title); ?></h4>
                                    <div class="success-card__description">
                                        <?php echo wp_kses_post($description); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
<!-- Success Stories Content -->

<!-- Smile Makeovers Section -->
<?php
$smile_section_title = get_field('smile_section_title');
$smile_makeovers = get_field('smile_makeovers');
$smile_cta_link = get_field('smile_cta_link');

if ($smile_makeovers && is_array($smile_makeovers)) :
?>
    <section class="smile-makeovers py-7 py-md-8 py-xl-9">
        <div class="container">
            <!-- Section Title -->
            <?php if ($smile_section_title) : ?>
                <div class="row mb-5 mb-md-6">
                    <div class="col-12">
                        <h2 class="smile-makeovers__title">
                            <?php echo esc_html($smile_section_title); ?>
                        </h2>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Makeovers Grid/Slider -->
            <div class="row g-4">
                <?php foreach ($smile_makeovers as $index => $makeover) :
                    $before_image = $makeover['makeover_image_before'];
                    $after_image = $makeover['makeover_image_after'];
                    $makeover_title = $makeover['makeover_title'];
                    $before_url = isset($before_image['url']) ? $before_image['url'] : '';
                    $after_url = isset($after_image['url']) ? $after_image['url'] : '';
                ?>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="makeover-card">
                            <h3 class="makeover-card__title">
                                <?php echo esc_html($makeover_title); ?>
                            </h3>
                            
                            <!-- Before/After Slider Container -->
                            <div class="ttw-container" data-ttw-start="50">
                                <!-- After Image (Background) -->
                                <div class="ttw-layer ttw-after" data-label="After">
                                    <?php if ($after_url) : ?>
                                        <img src="<?php echo esc_url($after_url); ?>" alt="After - <?php echo esc_attr($makeover_title); ?>" loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <!-- Before Image (Overlay) -->
                                <div class="ttw-layer ttw-before" data-label="Before">
                                    <?php if ($before_url) : ?>
                                        <img src="<?php echo esc_url($before_url); ?>" alt="Before - <?php echo esc_attr($makeover_title); ?>" loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <!-- Slider Handle -->
                                <div class="ttw-handle"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- CTA Button -->
            <?php if ($smile_cta_link && !empty($smile_cta_link['url'])) : ?>
                <div class="row mt-6 mt-md-7">
                    <div class="col-12 text-center">
                        <a href="<?php echo esc_url($smile_cta_link['url']); ?>" class="btn btn-primary" <?php echo !empty($smile_cta_link['target']) ? 'target="' . esc_attr($smile_cta_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($smile_cta_link['title']); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
<section class="success-stories-content mt-7 mt-md-8 mt-xl-9">
    <div class="container">
        <h1 class="text-center">Testimonials</h1>
        <div class="row">
            <div class="col-12">
                <div class="success-stories-placeholder">
                    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>