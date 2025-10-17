<?php

/**
 * Template Name: FAQ
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
							<span class="banner-subtitle" data-scroll data-delay="100"><?php echo $banner['podnaslov']; ?></span>
							<h1 class="banner-title" data-scroll data-delay="200"><?php echo $banner['naslov']; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="faq-search-container py-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="search-box">
							<i class="fas fa-search"></i>
							<?php
							$currentlang = get_bloginfo('language');
							$placeholder = ($currentlang == "en-US") ? "Search FAQ..." : "FAQ durchsuchen...";
							?>
							<input type="text" id="faqSearch" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>">
							<span class="search-results-count"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Booking FAQ -->
	<?php
	$booking_pitanja = get_field('booking_pitanja');
	if ($booking_pitanja): ?>
		<section class="faq-section pt-0">
			<div class="container">
				<?php if (get_field('booking_pitanja_naslov')): ?>
					<h3 class="faq-section-title"><?php the_field('booking_pitanja_naslov'); ?></h3>
				<?php endif; ?>

				<div class="accordion" id="accordionBooking">
					<?php for ($i = 1; $i <= 10; $i++):
						$pitanje = $booking_pitanja["pitanje_{$i}"];
						$odgovor = $booking_pitanja["odgovor_{$i}"];
						if (!empty($pitanje)): ?>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#booking_<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
										<span class="accordion-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
										<?php echo $pitanje; ?>
									</button>
								</h2>
								<div id="booking_<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionBooking">
									<div class="accordion-body">
										<?php echo $odgovor; ?>
									</div>
								</div>
							</div>
					<?php endif;
					endfor; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Dolazak FAQ -->
	<?php
	$dolazak_pitanja = get_field('dolazak_pitanja');
	if ($dolazak_pitanja): ?>
		<section class="faq-section">
			<div class="container">
				<?php if (get_field('dolazak_pitanja_naslov')): ?>
					<h3 class="faq-section-title"><?php the_field('dolazak_pitanja_naslov'); ?></h3>
				<?php endif; ?>

				<div class="accordion" id="accordionDolazak">
					<?php for ($i = 1; $i <= 10; $i++):
						$pitanje = $dolazak_pitanja["pitanje_{$i}"];
						$odgovor = $dolazak_pitanja["odgovor_{$i}"];
						if (!empty($pitanje)): ?>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#dolazak_<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
										<span class="accordion-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
										<?php echo $pitanje; ?>
									</button>
								</h2>
								<div id="dolazak_<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionDolazak">
									<div class="accordion-body">
										<?php echo $odgovor; ?>
									</div>
								</div>
							</div>
					<?php endif;
					endfor; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Contactless FAQ -->
	<?php
	$contactless_pitanja = get_field('contactless_pitanja');
	if ($contactless_pitanja): ?>
		<section class="faq-section">
			<div class="container">
				<?php if (get_field('contactless_pitanja_naslov')): ?>
					<h3 class="faq-section-title"><?php the_field('contactless_pitanja_naslov'); ?></h3>
				<?php endif; ?>

				<div class="accordion" id="accordionContactless">
					<?php for ($i = 1; $i <= 10; $i++):
						$pitanje = $contactless_pitanja["pitanje_{$i}"];
						$odgovor = $contactless_pitanja["odgovor_{$i}"];
						if (!empty($pitanje)): ?>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#contactless_<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
										<span class="accordion-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
										<?php echo $pitanje; ?>
									</button>
								</h2>
								<div id="contactless_<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionContactless">
									<div class="accordion-body">
										<?php echo $odgovor; ?>
									</div>
								</div>
							</div>
					<?php endif;
					endfor; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Boravak FAQ -->
	<?php
	$boravak_pitanja = get_field('boravak_pitanja');
	if ($boravak_pitanja): ?>
		<section class="faq-section">
			<div class="container">
				<?php if (get_field('boravak_pitanja_naslov')): ?>
					<h3 class="faq-section-title"><?php the_field('boravak_pitanja_naslov'); ?></h3>
				<?php endif; ?>

				<div class="accordion" id="accordionBoravak">
					<?php for ($i = 1; $i <= 10; $i++):
						$pitanje = $boravak_pitanja["pitanje_{$i}"];
						$odgovor = $boravak_pitanja["odgovor_{$i}"];
						if (!empty($pitanje)): ?>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#boravak_<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
										<span class="accordion-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
										<?php echo $pitanje; ?>
									</button>
								</h2>
								<div id="boravak_<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionBoravak">
									<div class="accordion-body">
										<?php echo $odgovor; ?>
									</div>
								</div>
							</div>
					<?php endif;
					endfor; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Odlazak FAQ -->
	<?php
	$odlazak_pitanja = get_field('odlazak_pitanja');
	if ($odlazak_pitanja): ?>
		<section class="faq-section">
			<div class="container">
				<?php if (get_field('odlazak_pitanja_naslov')): ?>
					<h3 class="faq-section-title"><?php the_field('odlazak_pitanja_naslov'); ?></h3>
				<?php endif; ?>

				<div class="accordion" id="accordionOdlazak">
					<?php for ($i = 1; $i <= 10; $i++):
						$pitanje = $odlazak_pitanja["pitanje_{$i}"];
						$odgovor = $odlazak_pitanja["odgovor_{$i}"];
						if (!empty($pitanje)): ?>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#odlazak_<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
										<span class="accordion-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
										<?php echo $pitanje; ?>
									</button>
								</h2>
								<div id="odlazak_<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#accordionOdlazak">
									<div class="accordion-body">
										<?php echo $odgovor; ?>
									</div>
								</div>
							</div>
					<?php endif;
					endfor; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php get_footer(); ?>