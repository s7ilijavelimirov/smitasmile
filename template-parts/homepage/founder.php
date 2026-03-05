<?php
defined( 'ABSPATH' ) || exit;

/**
 * Founder Section Template
 *
 * Elegant centered design with small round image next to signature
 * Uses ACF fields for front-page template
 * SEO optimized with fallback alt text
 *
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$founder_image = get_field('founder_image', $page_id);
$founder_title = get_field('founder_title', $page_id);
$founder_description = get_field('founder_description', $page_id);
$founder_name = get_field('founder_name', $page_id);
$founder_signature = get_field('founder_signature', $page_id);

if (! $founder_title) {
	return;
}

// SEO: Get image alt text from WordPress, fallback to founder name
$image_alt = '';
if ($founder_image) {
	$image_alt = get_post_meta($founder_image, '_wp_attachment_image_alt', true);
	$image_alt = $image_alt ?: esc_attr($founder_name);
}

// SEO: Get signature alt text, fallback to founder name
$signature_alt = '';
if ($founder_signature) {
	$signature_alt = get_post_meta($founder_signature, '_wp_attachment_image_alt', true);
	$signature_alt = $signature_alt ?: esc_attr($founder_name . ' signature');
}
?>

<section class="founder-section container-fluid py-lg-8 py-md-6">
	<div class="container">
		<div class="founder-content">
			<!-- Title -->
			<h2 class="founder-title"><?php echo wp_kses_post($founder_title); ?></h2>

			<!-- Description -->
			<?php if ($founder_description) : ?>
				<div class="founder-description">
					<?php echo wp_kses_post($founder_description); ?>
				</div>
			<?php endif; ?>

			<!-- Author Block: Round Image + Signature -->
			<div class="founder-author">
				<?php if ($founder_image) : ?>
					<div class="founder-avatar">
						<?php echo wp_get_attachment_image($founder_image, 'thumbnail', false, array('alt' => $image_alt)); ?>
					</div>
				<?php endif; ?>

				<div class="founder-info">
					<?php if ($founder_signature) : ?>
						<div class="founder-signature">
							<?php echo wp_get_attachment_image($founder_signature, 'medium', false, array('alt' => $signature_alt)); ?>
						</div>
					<?php endif; ?>

					<?php if ($founder_name) : ?>
						<p class="founder-name"><?php echo wp_kses_post($founder_name); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- .founder-section -->
