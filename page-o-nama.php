<?php

/**
 * Template Name: O Nama
 *
 * @package Likedaheim
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	$banner = get_field('banner');
	if ($banner): ?>
		<section class="page-banner">
			<div class="banner-background" style="background-image:url('<?php echo $banner['pozadinska_slika']; ?>')"></div>
			<div class="banner-overlay"></div>

			<div class="container">
				<div class="banner-content">
					<div class="row justify-content-center">
						<div class="col-lg-8 text-center">
							<span class="banner-subtitle fade-up delay-100" data-scroll><?php echo $banner['podnaslov']; ?></span>
							<h1 class="banner-title fade-up delay-200" data-scroll><?php echo $banner['naslov']; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$intro = get_field('intro');
	if ($intro): ?>
		<section class="about-intro">
			<div class="container">
				<div class="about-content-wrapper fade-up delay-200" data-scroll>
					<!-- Text Content -->
					<div class="about-text-section">
						<div class="about-header">
							<span class="about-subtitle"><?php echo $intro['podnaslov']; ?></span>
							<h2 class="about-title"><?php echo $intro['naslov']; ?></h2>
						</div>

						<div class="about-text-content">
							<?php echo $intro['tekst']; ?>
						</div>
					</div>

					<!-- Image Section -->
					<?php if (!empty($intro['fotografija'])): ?>
						<div class="about-image-section fade-left delay-300" data-scroll>
							<div class="about-image-wrapper">
								<a href="<?php echo esc_url($intro['fotografija']['url']); ?>" data-lity class="about-image-link">
									<img src="<?php echo esc_url($intro['fotografija']['url']); ?>"
										alt="<?php echo esc_attr($intro['fotografija']['alt']); ?>"
										class="about-image" />
									<div class="image-overlay">
										<i class="fas fa-search-plus"></i>
									</div>
								</a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>