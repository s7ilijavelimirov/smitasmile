<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Cjenik
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
	<?php endif; ?>

	<?php
	$intro = get_field('intro');
	if ($intro): ?>
		<div class="intro mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-8 text-center">
						<?php echo $intro['tekst']; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$basic_cjenik = get_field('basic_cjenik');
	if ($basic_cjenik): ?>
		<div class="cjenik basic-cjenik mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="color-dark-blue mb-3"><?php echo $basic_cjenik['naslov']; ?></h3>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-4 mb-3 mb-xl-0">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $basic_cjenik['basic_single_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-blue pricing-card-title"><?php echo $basic_cjenik['basic_single_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-blue pricing-card-title mb-0"><?php echo $basic_cjenik['basic_single_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($basic_cjenik['basic_single_link']['url']); ?>" class="btn btn-block btn-primary"><?php echo esc_html($basic_cjenik['basic_single_link']['title']); ?></a>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-3 mb-xl-0">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $basic_cjenik['basic_double_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-blue pricing-card-title"><?php echo $basic_cjenik['basic_double_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-blue pricing-card-title mb-0"><?php echo $basic_cjenik['basic_double_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($basic_cjenik['basic_double_link']['url']); ?>" class="btn btn-block btn-primary"><?php echo esc_html($basic_cjenik['basic_double_link']['title']); ?></a>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $basic_cjenik['basic_wheelchair_accessible_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-blue pricing-card-title"><?php echo $basic_cjenik['basic_wheelchair_accessible_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-blue pricing-card-title mb-0"><?php echo $basic_cjenik['basic_wheelchair_accessible_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($basic_cjenik['basic_wheelchair_accessible_link']['url']); ?>" class="btn btn-block btn-primary"><?php echo esc_html($basic_cjenik['basic_wheelchair_accessible_link']['title']); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$deluxe_cjenik = get_field('deluxe_cjenik');
	if ($deluxe_cjenik): ?>
		<div class="cjenik deluxe-cjenik mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="color-dark-gold mb-3"><?php echo $deluxe_cjenik['naslov']; ?></h3>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-4 mb-3 mb-xl-0">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $deluxe_cjenik['deluxe_single_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-gold pricing-card-title"><?php echo $deluxe_cjenik['deluxe_single_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-gold pricing-card-title mb-0"><?php echo $deluxe_cjenik['deluxe_single_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($deluxe_cjenik['deluxe_single_link']['url']); ?>" class="btn btn-block btn-secondary"><?php echo esc_html($deluxe_cjenik['deluxe_single_link']['title']); ?></a>
							</div>
						</div>
					</div>
					<div class="col-xl-4 mb-3 mb-xl-0">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $deluxe_cjenik['deluxe_double_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-gold pricing-card-title"><?php echo $deluxe_cjenik['deluxe_double_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-gold pricing-card-title mb-0"><?php echo $deluxe_cjenik['deluxe_double_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($deluxe_cjenik['deluxe_double_link']['url']); ?>" class="btn btn-block btn-secondary"><?php echo esc_html($deluxe_cjenik['deluxe_double_link']['title']); ?></a>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="card text-center">
							<div class="card-header">
								<h6 class="my-0 font-weight-normal"><?php echo $deluxe_cjenik['deluxe_2_sobe_naslov']; ?></h6>
							</div>
							<div class="card-body">
								<h3 class="card-title color-dark-gold pricing-card-title"><?php echo $deluxe_cjenik['deluxe_2_sobe_cijena_mjesecna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/monthly</small>
									<?php else: ?>
										<small class="text-muted">/Monat</small>
									<?php endif; ?>
								</h3>
								<h3 class="card-title color-dark-gold pricing-card-title mb-0"><?php echo $deluxe_cjenik['deluxe_2_sobe_cijena_tjedna']; ?>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<small class="text-muted">/weekly</small>
									<?php else: ?>
										<small class="text-muted">/Woche</small>
									<?php endif; ?>
								</h3>
							</div>
							<div class="card-footer text-muted">
								<a href="<?php echo esc_url($deluxe_cjenik['deluxe_2_sobe_link']['url']); ?>" class="btn btn-block btn-secondary"><?php echo esc_html($deluxe_cjenik['deluxe_2_sobe_link']['title']); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$cta = get_field('cta');
	if ($cta): ?>
		<div class="cta py-7 py-md-8 py-xl-9" style="background-image:url('<?php echo $cta['pozadinska_slika']; ?>')">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7 mb-3 mb-lg-0">
						<h6 class="color-white text-uppercase"><?php echo $cta['podnaslov']; ?></h6>
						<h2 class="color-dark-gold mb-3"><?php echo $cta['naslov']; ?></h2>
						<?php echo $cta['tekst']; ?>
					</div>
					<div class="col-lg-4 offset-lg-1">
						<a href="<?php echo esc_url($cta['link']['url']); ?>" class="btn btn-block btn-primary"><?php echo esc_html($cta['link']['title']); ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
