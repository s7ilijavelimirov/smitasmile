<?php
defined( 'ABSPATH' ) || exit;

/**
 * Smile Transformations - Elegant Before/After Cards
 * Click to toggle between AFTER and BEFORE
 * With Polylang support for translations
 *
 * @package smitasmile
 */

$title = get_field('smile_section_title');
$makeovers = get_field('smile_makeovers');
$cta_link = get_field('smile_cta_link');

if (!$makeovers || empty($makeovers)) {
    return;
}

// Polylang translations
$text_after = function_exists('pll__') ? pll__('After') : __( 'After', 'smitasmile' );
$text_before = function_exists('pll__') ? pll__('Before') : __( 'Before', 'smitasmile' );
$text_tap = function_exists('pll__') ? pll__('Tap') : __( 'Tap', 'smitasmile' );
?>

<section class="smile-transformations container-fluid pb-lg-8 pb-md-6 pt-0">
    <div class="container-xxl">

        <!-- Section Title -->
        <?php if ($title) : ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="smile-transformations__title mb-lg-8 mb-md-6"><?php echo esc_html($title); ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <!-- Transformation Cards Grid -->
        <div class="row g-4">
            <?php foreach ($makeovers as $makeover) :
                $before_img = $makeover['makeover_image_before'] ?? null;
                $after_img = $makeover['makeover_image_after'] ?? null;
                $card_title = $makeover['makeover_title'] ?? '';

                // Skip if no images
                if (!$before_img || !$after_img) {
                    continue;
                }
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
                            <!-- AFTER Image - Always visible -->
                            <div class="transformation-after">
                                <img
                                    src="<?php echo esc_url($after_img['url']); ?>"
                                    alt="<?php echo esc_attr($card_title); ?> - <?php echo esc_attr($text_after); ?>"
                                    width="<?php echo esc_attr($after_img['width'] ?? '600'); ?>"
                                    height="<?php echo esc_attr($after_img['height'] ?? '400'); ?>"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- BEFORE Image - Revealed on click -->
                            <div class="transformation-before">
                                <img
                                    src="<?php echo esc_url($before_img['url']); ?>"
                                    alt="<?php echo esc_attr($card_title); ?> - <?php echo esc_attr($text_before); ?>"
                                    width="<?php echo esc_attr($before_img['width'] ?? '600'); ?>"
                                    height="<?php echo esc_attr($before_img['height'] ?? '400'); ?>"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- AFTER Badge (visible by default) - Sparkle/Star for perfect smile -->
                            <div class="transformation-badge transformation-badge--after">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>
                                </svg>
                                <span><?php echo esc_html($text_after); ?></span>
                            </div>

                            <!-- BEFORE Badge (visible when revealed) - History/Rewind icon -->
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
        <?php if ($cta_link) : ?>
            <div class="row mt-lg-8 mt-md-5">
                <div class="col-12 text-center">
                    <a
                        href="<?php echo esc_url($cta_link['url']); ?>"
                        class="btn btn-secondary"
                        <?php echo $cta_link['target'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php echo esc_html($cta_link['title']); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Testimonials -->
<section class="success-stories-content container-fluid pb-lg-8 pb-md-6 pt-0">
    <div class="container-xl-custom">
        <h2 class="text-center fs-1 mb-lg-8 mb-md-6"><?php echo esc_html(function_exists('pll__') ? pll__('Testimonials') : 'Testimonials'); ?></h2>
        <div class="row">
            <div class="col-12">
                <div class="success-stories-placeholder">
                    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
