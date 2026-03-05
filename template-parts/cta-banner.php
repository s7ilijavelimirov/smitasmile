<?php
// Uzmi prosleđeni page_id ili izračunaj automatski
if (isset($args['page_id'])) {
	$page_id = $args['page_id'];
} else {
	// Uzmi trenutnu stranicu ID
	$current_page_id = get_queried_object_id();

	// Uzmi front page ID
	$front_page_id = get_option('page_on_front');

	// Ako je različita stranica, koristi njene podatke; inače koristi front page
	$page_id = ($current_page_id !== $front_page_id) ? $current_page_id : $front_page_id;
}

// Uzmi podatke
$title = get_field('cta_banner_title', $page_id);
$description = get_field('cta_banner_description', $page_id);
$link = get_field('cta_banner_link', $page_id);

if ($title && $description && $link) :
?>
    <section class="cta-banner container-fluid py-lg-8 py-md-6">
        <div class="container py-lg-8 py-md-6 px-3">
            <!-- Content -->
            <div class="cta-banner__content">
                <h2 class="cta-banner__title"><?php echo esc_html($title); ?></h2>
                <p class="cta-banner__description"><?php echo wp_kses_post($description); ?></p>
            </div>

            <!-- CTA Button -->
            <a href="<?php echo esc_url($link['url']); ?>"
                class="cta-banner__btn"
                <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                <?php echo esc_html($link['title']); ?>
            </a>
        </div>
    </section>
<?php endif; ?>
