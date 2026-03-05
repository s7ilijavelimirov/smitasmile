<?php
defined( 'ABSPATH' ) || exit;

/**
 * Hero Section Template - Swiper.js
 *
 * Left-aligned elegant hero with image slider and 3 CTA buttons
 * All content managed via ACF fields
 *
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$hero_bg_type    = get_field('hero_bg_type', $page_id) ?: 'image';
$hero_images     = get_field('hero_background_images', $page_id);
$hero_video      = get_field('hero_background_video', $page_id);
$hero_min_height = get_field('hero_min_height', $page_id) ?: '100vh';
$hero_headline   = get_field('hero_headline', $page_id);
$hero_subheadline = get_field('hero_subheadline', $page_id);

// 3 CTA buttons
$hero_cta_book    = get_field('hero_cta_link', $page_id);     // Link field (array: url, title, target)
$hero_cta_call    = get_field('hero_cta_call', $page_id);     // Link field (array: url, title, target)
$hero_cta_contact = get_field('hero_cta_contact', $page_id);  // Link field (array: url, title, target)

if (! $hero_headline) {
	return;
}

// SEO: Get image alt text
$bg_alt = esc_attr(get_bloginfo('name') . ' - Hero banner');
?>

<section class="hero-section" style="min-height: <?php echo esc_attr($hero_min_height); ?>">
	<div class="hero-overlay"></div>
	<?php if ('video' === $hero_bg_type && $hero_video) : ?>
		<!-- Video Background -->
		<video class="hero-video" autoplay muted loop playsinline>
			<source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
		</video>
	<?php elseif ('image' === $hero_bg_type && $hero_images) : ?>
		<!-- Image Slider with Swiper -->
		<div class="swiper hero-swiper">
			<div class="swiper-wrapper">
				<?php foreach ($hero_images as $index => $image) : ?>
					<?php
					$img_id = $image['image'];
					$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
					$img_alt = $img_alt ?: $bg_alt;
					// Add unique slide class for each slide (slide-1, slide-2, slide-3, etc.)
					$slide_number = $index + 1;
					$slide_class = 'hero-slide-img hero-slide-img--slide-' . $slide_number;
					if (1 === $index) {
						$slide_class .= ' hero-slide-img--center-top';
					}
					?>
					<div class="swiper-slide hero-slide">
						<?php
						$img_data = wp_get_attachment_image_src($img_id, 'full');
						$img_width = isset($img_data[1]) ? $img_data[1] : 1920;
						$img_height = isset($img_data[2]) ? $img_data[2] : 1080;
						echo wp_get_attachment_image($img_id, 'full', false, array(
							'class' => $slide_class,
							'alt' => $img_alt,
							'loading' => 0 === $index ? 'eager' : 'lazy',
							'decoding' => 'async',
							'width' => $img_width,
							'height' => $img_height
						));
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	<?php endif; ?>

	<!-- Content - Left Aligned -->
	<div class="hero-content">
		<div class="container px-2">
			<div class="hero-content__inner">
				<!-- Decorative line -->
				<span class="hero-content__line" aria-hidden="true"></span>

				<!-- Main Headline - H1 for SEO -->
				<h1 class="hero-headline">
					<?php echo wp_kses_post($hero_headline); ?>
				</h1>

				<!-- Subheadline -->
				<?php if ($hero_subheadline) : ?>
					<p class="hero-subheadline">
						<?php echo wp_kses_post($hero_subheadline); ?>
					</p>
				<?php endif; ?>

				<!-- CTA Buttons -->
				<?php if ($hero_cta_book || $hero_cta_call || $hero_cta_contact) : ?>
					<div class="hero-cta-group">
						<!-- Primary: Book Appointment (full width row) -->
						<?php if ($hero_cta_book) : ?>
							<a
								href="<?php echo esc_url($hero_cta_book['url']); ?>"
								class="btn btn-primary"
								target="<?php echo esc_attr($hero_cta_book['target'] ?: '_self'); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
									<line x1="16" y1="2" x2="16" y2="6"></line>
									<line x1="8" y1="2" x2="8" y2="6"></line>
									<line x1="3" y1="10" x2="21" y2="10"></line>
								</svg>
								<?php echo esc_html($hero_cta_book['title']); ?>
								<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="7" y1="17" x2="17" y2="7"></line>
									<polyline points="7 7 17 7 17 17"></polyline>
								</svg>
							</a>
						<?php endif; ?>

						<!-- Secondary row: Call Us + Contact Us side by side -->
						<?php if ($hero_cta_call || $hero_cta_contact) : ?>
							<div class="hero-cta-row">
								<?php if ($hero_cta_call) : ?>
									<a
										href="<?php echo esc_url($hero_cta_call['url']); ?>"
										class="btn btn-secondary"
										target="<?php echo esc_attr($hero_cta_call['target'] ?: '_self'); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
										</svg>
										<?php echo esc_html($hero_cta_call['title']); ?>
									</a>
								<?php endif; ?>

								<?php if ($hero_cta_contact) : ?>
									<a
										href="<?php echo esc_url($hero_cta_contact['url']); ?>"
										class="btn btn-secondary"
										target="<?php echo esc_attr($hero_cta_contact['target'] ?: '_self'); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
											<polyline points="22,6 12,13 2,6"></polyline>
										</svg>
										<?php echo esc_html($hero_cta_contact['title']); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Pagination (Dots) - Bottom center -->
	<div class="swiper-pagination hero-pagination"></div>

</section><!-- .hero-section -->
