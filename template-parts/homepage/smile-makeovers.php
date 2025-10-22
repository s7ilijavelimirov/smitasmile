<?php
/**
 * Smile Makeovers - Before/After Slider
 * 
 * @package smitasmile
 */

$title = get_field('smile_section_title');
$makeovers = get_field('smile_makeovers');
$cta_link = get_field('smile_cta_link');

if (!$makeovers || empty($makeovers)) {
    return;
}
?>

<section class="smile-makeovers">
    <div class="container-xxl">
        
        <!-- Section Title -->
        <?php if ($title) : ?>
            <div class="row mb-5 mb-lg-6">
                <div class="col-12">
                    <h2 class="smile-makeovers__title"><?php echo esc_html($title); ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <!-- Makeover Cards Grid -->
        <div class="row g-4">
            <?php foreach ($makeovers as $makeover) : 
                $before_img = $makeover['makeover_image_before'] ?? null;
                $after_img = $makeover['makeover_image_after'] ?? null;
                $card_title = $makeover['makeover_title'] ?? 'Smile Transformation';

                // Skip ako nema slika
                if (!$before_img || !$after_img) {
                    continue;
                }
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="makeover-card">
                        
                        <!-- Card Title -->
                        <h3 class="makeover-card__title">
                            <?php echo esc_html($card_title); ?>
                        </h3>

                        <!-- Before/After Slider -->
                        <div class="ttw-container" data-ttw-start="50">
                            <!-- BEFORE Layer -->
                            <div class="ttw-layer ttw-before">
                                <img 
                                    src="<?php echo esc_url($before_img['url']); ?>" 
                                    alt="Before - <?php echo esc_attr($card_title); ?>"
                                    width="<?php echo esc_attr($before_img['width'] ?? '600'); ?>"
                                    height="<?php echo esc_attr($before_img['height'] ?? '600'); ?>"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- AFTER Layer -->
                            <div class="ttw-layer ttw-after">
                                <img 
                                    src="<?php echo esc_url($after_img['url']); ?>" 
                                    alt="After - <?php echo esc_attr($card_title); ?>"
                                    width="<?php echo esc_attr($after_img['width'] ?? '600'); ?>"
                                    height="<?php echo esc_attr($after_img['height'] ?? '600'); ?>"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- Handle (Slider) -->
                            <div class="ttw-handle" role="slider" aria-label="Before/After slider"></div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- CTA Button -->
        <?php if ($cta_link) : ?>
            <div class="row mt-3 mt-lg-5">
                <div class="col-12 text-center">
                    <a 
                        href="<?php echo esc_url($cta_link['url']); ?>" 
                        class="btn btn-secondary"
                        <?php echo $cta_link['target'] ? 'target="_blank" rel="noopener"' : ''; ?>>
                        <?php echo esc_html($cta_link['title']); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>