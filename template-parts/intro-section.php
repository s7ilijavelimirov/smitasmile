<?php

/**
 * Intro Section Template Part - SEO Optimized
 * 
 * Reusable component with background image, title, secondary text and description
 * Uses ACF fields: intro_bg_image, intro_title, intro_secondary_text, intro_description
 * SEO: H1 must be first content element on page (YOAST requirement)
 * 
 * @package smitasmile
 */

// Get ACF values
$bg_image = get_field('intro_bg_image');
$intro_title = get_field('intro_title');
$secondary_text = get_field('intro_secondary_text');
$intro_description = get_field('intro_description');

// Fallback to page title if ACF title is empty (SEO best practice - YOAST reads get_the_title())
$title = $intro_title ?: get_the_title();
$page_id = get_queried_object_id();

// Get background image with alt text for SEO
$bg_image_url = '';
$bg_image_alt = '';
if ($bg_image && isset($bg_image['url'])) {
    $bg_image_url = $bg_image['url'];
    // Get alt text from image metadata (YOAST reads this)
    $bg_image_alt = isset($bg_image['alt']) ? $bg_image['alt'] : get_post_meta($bg_image['id'], '_wp_attachment_image_alt', true);
    $bg_image_alt = $bg_image_alt ?: $title; // Fallback to page title
}

// Build inline style only if background image exists
$bg_style = $bg_image_url ? 'background-image: url(' . esc_url($bg_image_url) . ');' : '';
?>

<!-- Intro Section - SEO Optimized with Schema Markup -->
<section
    class="intro-section"
    <?php echo $bg_style ? 'style="' . esc_attr($bg_style) . '"' : ''; ?>
    role="banner"
    aria-label="<?php echo esc_attr($title); ?>">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro-content">
                    <?php if ($title) : ?>
                        <!-- H1 must be first content element for YOAST SEO -->
                        <h1 class="intro-title" itemprop="headline">
                            <?php echo wp_kses_post($title); ?>
                        </h1>
                    <?php endif; ?>

                    <!-- Secondary text - supports main keyword -->
                    <?php if ($secondary_text) : ?>
                        <p class="intro-secondary-text" itemprop="description">
                            <?php echo wp_kses_post($secondary_text); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Description - body content for keyword optimization -->
                    <?php if ($intro_description) : ?>
                        <div class="intro-description" itemprop="text">
                            <?php echo wp_kses_post($intro_description); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>