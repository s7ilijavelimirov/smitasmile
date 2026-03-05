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
/*
//////////////////////////////////////////////////////
 WHAT LEAD US TO SUCCESS SECTION – DISABLED
//////////////////////////////////////////////////////

// What Lead Us to Success Section
$main_title = get_field('success_main_title');
$items = get_field('success_items');

if ($main_title || $items) :
?>
    <section class="container-fluid what-lead-us-to-success py-lg-8 py-md-6">
        <div class="success">
            <!-- Main Title -->
            <?php if ($main_title) : ?>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center mb-lg-8 mb-md-6 fs-1">
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
                                <div class="success-card__image-wrapper">
                                    <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>

                                    <?php if ($icon_url) : ?>
                                        <div class="success-card__icon">
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="success-card__content">
                                    <h4><?php echo esc_html($title); ?></h4>
                                    <?php echo wp_kses_post($description); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

//////////////////////////////////////////////////////
 END DISABLED SECTION
//////////////////////////////////////////////////////
*/
?>

<!-- Success Stories Content -->
<!-- <section class="success-stories-content pb-lg-8 pb-md-6 pt-0">
    <div class="container-xl-custom">
        <h2 class="text-center mb-lg-8 mb-md-6"><?php echo esc_html(pll__('Testimonials')); ?></h2>
        <div class="row">
            <div class="col-12">
                <div class="success-stories-placeholder">
                   <?php //echo do_shortcode('[trustindex no-registration=google]'); ?> 
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Smile Transformations Section -->
<?php
$smile_section_title = get_field('smile_section_title');
$smile_makeovers = get_field('smile_makeovers');
$smile_cta_link = get_field('smile_cta_link');

// Polylang translations
$text_after = function_exists('pll__') ? pll__('After') : 'After';
$text_before = function_exists('pll__') ? pll__('Before') : 'Before';
$text_tap = function_exists('pll__') ? pll__('Tap') : 'Tap';

if ($smile_makeovers && is_array($smile_makeovers)) :
?>
    <section class="smile-transformations container-fluid py-lg-8 py-md-6 pt-0">
        <div class="container">
            <!-- Section Title -->
            <?php if ($smile_section_title) : ?>
                <div class="row">
                    <div class="col-12">
                        <h2 class="smile-transformations__title mb-lg-8 mb-md-6">
                            <?php echo esc_html($smile_section_title); ?>
                        </h2>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Transformation Cards Grid -->
            <div class="row g-4">
                <?php foreach ($smile_makeovers as $makeover) :
                    $before_img = $makeover['makeover_image_before'] ?? null;
                    $after_img = $makeover['makeover_image_after'] ?? null;
                    $card_title = $makeover['makeover_title'] ?? '';

                    $before_url = isset($before_img['url']) ? $before_img['url'] : '';
                    $after_url = isset($after_img['url']) ? $after_img['url'] : '';

                    if (!$before_url || !$after_url) continue;
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="transformation-card">
                            <!-- Card Title -->
                            <?php if ($card_title) : ?>
                                <h3 class="transformation-card__title">
                                    <?php echo esc_html($card_title); ?>
                                </h3>
                            <?php endif; ?>

                            <!-- Image Container -->
                            <div class="transformation-images">
                                <!-- AFTER Image -->
                                <div class="transformation-after">
                                    <img src="<?php echo esc_url($after_url); ?>" alt="<?php echo esc_attr($card_title); ?> - <?php echo esc_attr($text_after); ?>" loading="lazy" decoding="async">
                                </div>

                                <!-- BEFORE Image -->
                                <div class="transformation-before">
                                    <img src="<?php echo esc_url($before_url); ?>" alt="<?php echo esc_attr($card_title); ?> - <?php echo esc_attr($text_before); ?>" loading="lazy" decoding="async">
                                </div>

                                <!-- AFTER Badge - Sparkle/Star for perfect smile -->
                                <div class="transformation-badge transformation-badge--after">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>
                                    </svg>
                                    <span><?php echo esc_html($text_after); ?></span>
                                </div>

                                <!-- BEFORE Badge - History/Rewind icon -->
                                <div class="transformation-badge transformation-badge--before">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                        <path d="M3 3v5h5"/>
                                    </svg>
                                    <span><?php echo esc_html($text_before); ?></span>
                                </div>

                                <!-- Tap Hint -->
                                <div class="transformation-tap-hint">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 4.1 12 6"/>
                                        <path d="M5.1 8 2.9 6.4"/>
                                        <path d="M6.4 2.9 8 5.1"/>
                                        <path d="M18 2v2"/>
                                        <path d="M22 8h-2"/>
                                        <path d="M8 10v12l3.5-3.5 2.5 5 2.5-1-2.5-5H18l-10-8z"/>
                                    </svg>
                                    <span><?php echo esc_html($text_tap); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- CTA Button -->
            <?php if ($smile_cta_link && !empty($smile_cta_link['url'])) : ?>
                <div class="row mt-lg-8 mt-md-5">
                    <div class="col-12 text-center">
                        <a href="<?php echo esc_url($smile_cta_link['url']); ?>" class="btn btn-secondary" <?php echo !empty($smile_cta_link['target']) ? 'target="' . esc_attr($smile_cta_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($smile_cta_link['title']); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
<!-- CTA Section -->
<?php get_template_part('template-parts/cta-banner'); ?>
<?php get_footer(); ?>