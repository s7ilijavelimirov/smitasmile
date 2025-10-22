<?php

/**
 * Hero Section Template - Swiper.js
 * 
 * Displays hero with image slider or video background using Swiper
 * Uses ACF fields for front-page
 * 
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$hero_bg_type = get_field('hero_bg_type', $page_id) ?: 'image';
$hero_images = get_field('hero_background_images', $page_id);
$hero_video = get_field('hero_background_video', $page_id);
$hero_min_height = get_field('hero_min_height', $page_id) ?: '100vh';
$hero_headline = get_field('hero_headline', $page_id);
$hero_subheadline = get_field('hero_subheadline', $page_id);
$hero_secondary_text = get_field('hero_secondary_text', $page_id);
$hero_cta_link = get_field('hero_cta_link', $page_id);
$show_language_flags = get_field('show_flags', $page_id);
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
					?>
					<div class="swiper-slide hero-slide">
						<?php echo wp_get_attachment_image($img_id, 'full', false, array('class' => 'hero-slide-img', 'alt' => $img_alt, 'loading' => 0 === $index ? 'eager' : 'lazy', 'decoding' => 'async')); ?>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pagination (Dots) -->
			<div class="swiper-pagination hero-pagination"></div>
		</div>
		<!-- Overlay -->

	<?php endif; ?>



	<!-- Content -->
	<div class="hero-content d-flex align-items-center justify-content-center h-100">
		
		<div class="container text-center text-white">
			<!-- Main Headline - H1 for SEO -->
			<h1 class="hero-headline mb-3">
				<?php echo wp_kses_post($hero_headline); ?>
			</h1>

			<!-- Subheadline -->
			<?php if ($hero_subheadline) : ?>
				<p class="hero-subheadline mb-3">
					<?php echo wp_kses_post($hero_subheadline); ?>
				</p>
			<?php endif; ?>
			<?php if ($hero_secondary_text || $show_language_flags) : ?>
				<div class="hero-secondary-wrapper d-flex justify-content-center gap-2">
					<?php if ($hero_secondary_text) : ?>
						<p class="hero-secondary">
							<?php echo wp_kses_post($hero_secondary_text); ?>
						</p>
					<?php endif; ?>

					<?php if ($show_language_flags) : ?>
						<div class="language-pickers d-flex justify-content-center">
							<?php pll_the_languages(array(
								'show_flags' => 1,
								'show_names' => 0,
								'display_names_as' => 'flag',
								'hide_if_no_translation' => 0, // Prikaži čak i bez prevedenih stranica
								'echo' => 1,
							)); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<!-- CTA Button -->
			<?php if ($hero_cta_link) : ?>
				<a
					href="<?php echo esc_url($hero_cta_link['url']); ?>"
					class="btn btn-outline-light"
					target="<?php echo esc_attr($hero_cta_link['target'] ?: '_self'); ?>"
					rel="<?php echo esc_attr($hero_cta_link['target'] === '_blank' ? 'noopener noreferrer' : ''); ?>"
					aria-label="<?php echo esc_attr($hero_cta_link['title']); ?>">
					<?php echo wp_kses_post($hero_cta_link['title']); ?>
				</a>
			<?php endif; ?>
		</div>
	
	</div>

</section><!-- .hero-section -->