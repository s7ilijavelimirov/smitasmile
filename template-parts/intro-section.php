<?php
defined( 'ABSPATH' ) || exit;

/**
 * Intro Section Template Part - SEO & LCP Optimized
 * 
 * On homepage: pulls from Blog page ACF fields
 * On other pages: pulls from current page ACF fields
 * LCP: Uses fetchpriority=high and preload for background image
 * 
 * @package smitasmile
 */

$page_id = get_queried_object_id();

// If on homepage, get Blog page ID
if (is_front_page()) {
    $page_id = get_option('page_for_posts');
} elseif (is_home()) {
    $page_id = get_option('page_for_posts');
}

// Get ACF values
$bg_image = get_field('intro_bg_image', $page_id);
$intro_title = get_field('intro_title', $page_id);
$secondary_text = get_field('intro_secondary_text', $page_id);
$intro_description = get_field('intro_description', $page_id);

// Fallback to page title if ACF title is empty
$title = $intro_title ?: get_the_title($page_id);

// Get background image with alt text for SEO
$bg_image_url = '';
$bg_image_alt = '';
if ($bg_image && isset($bg_image['url'])) {
    $bg_image_url = $bg_image['url'];
    $bg_image_id = $bg_image['ID'] ?? false;
    if ($bg_image_id) {
        $bg_image_alt = get_post_meta($bg_image_id, '_wp_attachment_image_alt', true);
    }
    $bg_image_alt = $bg_image_alt ?: $title;
}

// Build inline style
$bg_style = $bg_image_url ? 'background-image: url(' . esc_url($bg_image_url) . '); background-size: cover; background-position: center;' : '';
?>

<!-- Preload LCP image in head -->
<?php 
if ($bg_image_url) {
    echo '<link rel="preload" as="image" href="' . esc_url($bg_image_url) . '" fetchpriority="high">';
}
?>

<!-- Intro Section - SEO Optimized with Schema Markup -->
<section
    class="intro-section"
    <?php echo $bg_style ? 'style="' . esc_attr($bg_style) . '"' : ''; ?>
    fetchpriority="high"
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