<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Naslovnica
 *
 * @package Likedaheim
 */

get_header();
?>


<main id="primary" class="site-main">

	<?php
	$banner = get_field('banner');
	if ($banner): ?>
		<div class="hero-fullscreen">
			<div class="hero-slider">
				<div class="hero-slide" data-bg="<?php echo $banner['pozadinska_slika_1']; ?>">
					<div class="hero-overlay"></div>
					<div class="hero-content">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-12 col-lg-8 text-center">
									<?php if (!empty($banner['podnaslov_1'])): ?>
										<span class="hero-subtitle" data-scroll data-delay="200"><?php echo $banner['podnaslov_1']; ?></span>
									<?php else: ?>
										<img src="<?php echo get_template_directory_uri(); ?>/dist/img/logo_black.png" alt="<?php bloginfo('name'); ?>" class="hero-logo" data-scroll data-delay="200">
									<?php endif; ?>
									<h1 class="hero-title" data-scroll data-delay="400"><?php echo $banner['naslov_1']; ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hero-slide" data-bg="<?php echo $banner['pozadinska_slika_2']; ?>">
					<div class="hero-overlay"></div>
					<div class="hero-content">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-12 col-lg-8 text-center">
									<?php if (!empty($banner['podnaslov_2'])): ?>
										<span class="hero-subtitle" data-scroll data-delay="200"><?php echo $banner['podnaslov_2']; ?></span>
									<?php else: ?>
										<img src="<?php echo get_template_directory_uri(); ?>/dist/img/logo_black.png" alt="<?php bloginfo('name'); ?>" class="hero-logo" data-scroll data-delay="200">
									<?php endif; ?>
									<h1 class="hero-title" data-scroll data-delay="400"><?php echo $banner['naslov_2']; ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hero-gradient-bottom"></div>
		</div>
	<?php endif; ?>
	<?php
	$apartmani = get_field('apartmani');
	if ($apartmani): ?>
		<section class="apartmani-lista">
			<div class="container">
				<!-- Header -->
				<!-- <div class="row justify-content-center mb-5">
					<div class="col-12 col-lg-8 text-center">
						<span class="section-subtitle fade-up delay-100" data-scroll><?php echo $apartmani['podnaslov']; ?></span>
						<h2 class="section-title fade-up delay-200" data-scroll><?php echo $apartmani['naslov']; ?></h2>
						<?php if (!empty($apartmani['tekst'])): ?>
							<div class="section-text fade-up delay-300" data-scroll>
								<?php echo $apartmani['tekst']; ?>
							</div>
						<?php endif; ?>
					</div>
				</div> -->

				<!-- Widget Area -->
				<?php if (is_active_sidebar('apartmani-homepage')): ?>
					<div class="apartmani-widgets fade-up delay-200" data-scroll>
						<?php dynamic_sidebar('apartmani-homepage'); ?>
					</div>
				<?php else: ?>
					<!-- Placeholder for dirs21 booking system -->
					<div class="apartmani-placeholder fade-up delay-200" data-scroll>
						<div class="placeholder-content">
							<h3><i class="fas fa-calendar-check"></i> Booking System Area</h3>
							<p>The dirs21 apartments with booking functionality will be integrated here.</p>
							<p class="placeholder-note">To activate, go to: <strong>Appearance → Widgets → Apartmani Homepage</strong></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
	<!-- Business Customers CTA Section -->
	<section class="business-cta-section">
		<div class="container">
			<div class="business-cta-card fade-up delay-100" data-scroll>
				<div class="row align-items-center">
					<div class="col-lg-7">
						<div class="business-cta-content">
							<?php
							$currentlang = get_bloginfo('language');
							if ($currentlang == "en-US"): ?>
								<h2 class="business-cta-title">Corporate offers designed for you<br>– contact us for more information.</h2>
								<p class="business-cta-text">Our apartments are the ideal accommodation for employees or business travelers: modern, comfortable, and flexible.</p>
							<?php else: ?>
								<h2 class="business-cta-title">Wir bieten maßgeschneiderte Angebote für Firmenkunden</h2>
								<p class="business-cta-text">Unsere Apartments sind die ideale Unterkunft für Ihre Mitarbeiter oder Geschäftsreisende: modern ausgestattet, flexibel buchbar und mit Rundum-Wohlfühlfaktor.</p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="business-cta-action">
							<?php
							$contact_page = get_page_by_path('contact');
							$contact_url = $contact_page ? get_permalink($contact_page->ID) : '#';

							$buttonText = ($currentlang == "en-US") ? 'Request corporate offer' : 'Jetzt Firmenangebot anfragen';
							?>
							<button type="button" class="btn btn-business" data-bs-toggle="modal" data-bs-target="#businessInquiryModal" data-hover="<?php echo esc_attr($buttonText); ?>">
								<div class="btn-content">
									<span><?php echo $buttonText; ?></span>
									<i class="fas fa-arrow-right"></i>
								</div>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- <?php
			$currentlang = get_bloginfo('language');
			if ($currentlang == "en-US"):
			?>
		<div class="booking booking-en mb-5 mb-md-7" id="booking">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10 col-xl-9">
						<div class="inner p-3 p-lg-5 fade-up delay-100" data-scroll data-delay="100">
							<?php if (is_active_sidebar('dirs21')) : ?>
								<div class="dirs21-widget-area">
									<?php dynamic_sidebar('dirs21'); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>

		<div class="booking booking-de mb-5 mb-md-7" id="booking">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10 col-xl-9">
						<div class="inner p-3 p-lg-5 fade-up delay-100" data-scroll data-delay="100">
							<?php if (is_active_sidebar('dirs21')) : ?>
								<div class="dirs21-widget-area">
									<?php dynamic_sidebar('dirs21'); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endif; ?> -->

	<?php
	$intro = get_field('intro');
	if ($intro): ?>
		<section class="home-intro">
			<div class="container">
				<div class="intro-wrapper">
					<div class="row g-0 align-items-center">
						<div class="col-lg-5">
							<div class="intro-content">
								<span class="intro-subtitle" data-scroll data-delay="100"><?php echo $intro['podnaslov']; ?></span>
								<h2 class="intro-title" data-scroll data-delay="200"><?php echo $intro['naslov']; ?></h2>
								<div class="intro-text" data-scroll data-delay="300">
									<?php echo $intro['tekst']; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="intro-gallery-wrapper">
								<!-- ✅ Slider za prikaz -->
								<div class="intro-gallery-slider">
									<?php
									$images = [
										$intro['fotografija_1'],
										$intro['fotografija_2'],
										$intro['fotografija_3'],
										$intro['fotografija_4']
									];

									foreach ($images as $index => $main_image):
										if ($main_image): ?>
											<div class="slide-item">
												<div class="intro-gallery-grid">
													<div class="gallery-main" data-img="<?php echo esc_url($main_image['url']); ?>">
														<img src="<?php echo esc_url($main_image['sizes']['apartment-square']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" />
													</div>

													<div class="gallery-thumbnails">
														<?php
														$thumb_count = 0;
														foreach ($images as $i => $thumb):
															if ($i !== $index && $thumb && $thumb_count < 3):
																$thumb_count++; ?>
																<div class="gallery-thumb" data-img="<?php echo esc_url($thumb['url']); ?>">
																	<img src="<?php echo esc_url($thumb['sizes']['apartment-square']); ?>" alt="<?php echo esc_attr($thumb['alt']); ?>" />
																</div>
														<?php endif;
														endforeach; ?>
													</div>
												</div>
											</div>
									<?php endif;
									endforeach; ?>
								</div>

								<!-- ✅ Galerija za lightbox (MORA biti van slidera!) -->
								<div class="intro-gallery-lightbox">
									<?php foreach ($images as $image):
										if ($image): ?>
											<a href="<?php echo esc_url($image['url']); ?>">
												<img src="<?php echo esc_url($image['sizes']['apartment-square']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
											</a>
									<?php endif;
									endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php
	$sadrzaji = get_field('sadrzaji');
	if ($sadrzaji): ?>
		<section class="amenities-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="col-12 col-lg-8 text-center">
						<span class="section-subtitle fade-up delay-100" data-scroll data-delay="100"><?php echo $sadrzaji['podnaslov']; ?></span>
						<h2 class="section-title fade-up delay-200" data-scroll data-delay="200"><?php echo $sadrzaji['naslov']; ?></h2>
						<div class="section-text fade-up delay-300" data-scroll data-delay="300">
							<?php echo $sadrzaji['tekst']; ?>
						</div>
					</div>
				</div>

				<div class="amenities-grid">
					<?php
					for ($i = 1; $i <= 9; $i++):
						$naslov = $sadrzaji["naslov_sadrzaj_{$i}"];
						$ikona = $sadrzaji["ikona_sadrzaj_{$i}"];
						$opis = $sadrzaji["opis_{$i}"];
						if (!empty($naslov)):
							$delay = 100 + ($i * 50);
					?>
							<div class="amenity-item fade-up delay-<?php echo $delay; ?>" data-scroll data-delay="<?php echo $delay; ?>">
								<div class="amenity-icon">
									<?php echo $ikona; ?>
								</div>
								<span class="amenity-label"><?php echo $naslov; ?></span>
								<?php if (!empty($opis)): ?>
									<div class="amenity-description">
										<p><?php echo $opis; ?></p>
									</div>
								<?php endif; ?>
							</div>
					<?php
						endif;
					endfor;
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$cta = get_field('cta');
	if ($cta): ?>
		<section class="cta-section">
			<div class="cta-background" style="background-image:url('<?php echo $cta['pozadinska_slika']; ?>')"></div>
			<div class="container">
				<div class="cta-content">
					<div class="row align-items-center">
						<div class="col-lg-7 mb-4 mb-lg-0">
							<div class="cta-text fade-up delay-100" data-scroll data-delay="100">
								<span class="cta-subtitle"><?php echo $cta['podnaslov']; ?></span>
								<h2 class="cta-title"><?php echo $cta['naslov']; ?></h2>
								<div class="cta-description">
									<?php echo $cta['tekst']; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-1">
							<div class="cta-action fade-up delay-200" data-scroll data-delay="200">
								<a href="<?php echo esc_url($cta['link']['url']); ?>" class="btn btn-primary w-100" data-hover="<?php echo esc_html($cta['link']['title']); ?>">
									<span><?php echo esc_html($cta['link']['title']); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
