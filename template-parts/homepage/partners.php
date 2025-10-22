<?php

/**
 * Partners Section Template
 * 
 * Displays partner logos in a single row
 * Clickable logos open partner link in new window
 * 
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$main_title = get_field('partners_main_title', $page_id);
$partners = get_field('partners_items', $page_id);

if (!$partners || empty($partners)) {
    return;
}
?>

<section class="partners-section">
    <div class="container">

        <!-- Section Header -->
        <?php if ($main_title) : ?>
            <div class="partners-header mb-5">
                <h2 class="partners-title"><?php echo esc_html($main_title); ?></h2>
            </div>
        <?php endif; ?>

        <!-- Partners Grid - Single Row -->
        <div class="partners-grid">
            <?php foreach ($partners as $partner) :
                $logo_id = $partner['partner_logo'] ?? '';
                $link = $partner['partner_link'] ?? '';

                if (!$logo_id) {
                    continue;
                }

                $logo_url = wp_get_attachment_url($logo_id);
                $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true) ?: 'Partner Logo';
                $link_url = $link['url'] ?? '';
                $link_target = $link['target'] ?? '_blank';
            ?>
                <div class="partner-item">
                    <?php if ($link_url) : ?>
                        <a
                            href="<?php echo esc_url($link_url); ?>"
                            class="partner-link"
                            target="<?php echo esc_attr($link_target); ?>"
                            rel="noopener noreferrer"
                            aria-label="<?php echo esc_attr($logo_alt); ?>">
                            <?php echo wp_get_attachment_image($logo_id, 'full', false, array('class' => 'partner-logo', 'loading' => 'lazy')); ?>
                        </a>
                    <?php else : ?>
                        <div class="partner-link">
                            <?php echo wp_get_attachment_image($logo_id, 'full', false, array('class' => 'partner-logo', 'loading' => 'lazy')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div><!-- .partners-grid -->

    </div><!-- .container -->
</section><!-- .partners-section -->