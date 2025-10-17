<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Apartmani
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
	

		<section class="apartmani-lista aparments-page">
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
				<?php if (is_active_sidebar('apartmani-list')): ?>
					<div class="apartmani-widgets fade-up delay-200" data-scroll>
						<?php dynamic_sidebar('apartmani-list'); ?>
					</div>
				<?php else: ?>
					<!-- Placeholder for dirs21 booking system -->
					<div class="apartmani-placeholder fade-up delay-200" data-scroll>
						<div class="placeholder-content">
							<h3><i class="fas fa-calendar-check"></i> Booking System Area</h3>
							<p>The dirs21 apartments with booking functionality will be integrated here.</p>
							<p class="placeholder-note">To activate, go to: <strong>Appearance → Widgets → Apartmani List</strong></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	
	<!-- <?php
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
	$basic_apartmani = get_field('basic_apartmani');
	if ($basic_apartmani): ?>
		<div class="basic-apartmani">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-8 text-center">
						<h6 class="color-dark-blue text-uppercase"><?php echo $basic_apartmani['podnaslov']; ?></h6>
						<h2 class="color-dark-blue mb-3"><?php echo $basic_apartmani['naslov']; ?></h2>
						<?php echo $basic_apartmani['tekst']; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="apartmani-lista mb-7 mb-md-8 mb-xl-9">
		<div class="container">
			<div class="row loop">
				<?php
				$loop = new WP_Query(
					array(
						'post_type' => 'apartman',
						'taxonomy' => 'kategorija',
						'term' => 'basic'
					)
				);
				?>
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="col-lg-4">
						<div class="inner">
							<div class="thumb">
								<?php
								$image = get_field('fotografija_1');
								if ($image):

									// Image variables.
									$url = $image['url'];
									$title = $image['title'];
									$alt = $image['alt'];
									$caption = $image['caption'];

									// Thumbnail size attributes.
									$thumb = $image['sizes']['apartment-rectangle-horizontal'];
								?>

									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($title); ?>">
										<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
									</a>

									<?php
									if ($caption): ?>
										<div class="caption">
											<figcaption><?php echo esc_html($caption); ?></figcaption>
										</div>
									<?php endif; ?>

								<?php endif; ?>
							</div>
							<div class="inner-wrapper">
								<h4 class="color-dark-blue mb-3"><?php the_title(); ?></h4>
								<div class="misc d-flex align-items-center mb-3">
									<span class="gosti d-flex align-items-center mr-3"><i class="far fa-user-circle color-dark-blue"></i><?php the_field('broj_gostiju'); ?></span>
									<span class="kvadratura d-flex align-items-center"><i class="fas fa-ruler-combined color-dark-blue"></i><?php the_field('kvadratura'); ?>m2</span>
								</div>
								<?php the_field('kratki_opis'); ?>
								<div class="price-book">
									<span class="pricing color-dark-blue"><?php the_field('startna_cijena'); ?></span>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-block btn-primary">Details</a>
									<?php else: ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-block btn-primary">Einzelheiten</a>
									<?php endif; ?>
								</div>

							</div>

						</div>
					</div>
				<?php endwhile;
				wp_reset_query(); ?>
			</div>
		</div>
	</div>

	<?php
	$deluxe_apartmani = get_field('deluxe_apartmani');
	if ($deluxe_apartmani): ?>
		<div class="deluxe-apartmani">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-8 text-center">
						<h6 class="color-dark-gold text-uppercase"><?php echo $deluxe_apartmani['podnaslov']; ?></h6>
						<h2 class="color-dark-gold mb-3"><?php echo $deluxe_apartmani['naslov']; ?></h2>
						<?php echo $deluxe_apartmani['tekst']; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>


	<div class="apartmani-lista mb-7 mb-md-8 mb-xl-9">
		<div class="container">
			<div class="row loop">
				<?php
				$loop = new WP_Query(
					array(
						'post_type' => 'apartman',
						'taxonomy' => 'kategorija',
						'term' => 'deluxe'
					)
				);
				?>
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="col-lg-4">
						<div class="inner">
							<div class="thumb">
								<?php
								$image = get_field('fotografija_1');
								if ($image):

									// Image variables.
									$url = $image['url'];
									$title = $image['title'];
									$alt = $image['alt'];
									$caption = $image['caption'];

									// Thumbnail size attributes.
									$thumb = $image['sizes']['apartment-rectangle-horizontal'];
								?>

									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($title); ?>">
										<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
									</a>

									<?php
									if ($caption): ?>
										<div class="caption">
											<figcaption><?php echo esc_html($caption); ?></figcaption>
										</div>
									<?php endif; ?>

								<?php endif; ?>
							</div>
							<div class="inner-wrapper">
								<h4 class="color-dark-gold mb-3"><?php the_title(); ?></h4>
								<div class="misc d-flex align-items-center mb-3">
									<span class="gosti d-flex align-items-center mr-3"><i class="far fa-user-circle color-dark-gold"></i><?php the_field('broj_gostiju'); ?></span>
									<span class="kvadratura d-flex align-items-center"><i class="fas fa-ruler-combined color-dark-gold"></i><?php the_field('kvadratura'); ?>m2</span>
								</div>
								<?php the_field('kratki_opis'); ?>



								<div class="price-book">
									<span class="pricing color-dark-gold"><?php the_field('startna_cijena'); ?></span>
									<?php
									$currentlang = get_bloginfo('language');
									if ($currentlang == "en-US"):
									?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-block btn-secondary">Details</a>
									<?php else: ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-block btn-secondary">Einzelheiten</a>
									<?php endif; ?>
								</div>


							</div>
						</div>
					</div>
				<?php endwhile;
				wp_reset_query(); ?>
			</div>
		</div>
	</div>




	<div class="street-maps mb-6">
		<div class="container">
			<style>
				.embed-container {
					position: relative;
					padding-bottom: 56.25%;
					height: 0;
					overflow: hidden;
					max-width: 100%;
				}

				.embed-container iframe,
				.embed-container object,
				.embed-container embed {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
				}
			</style>
			<div class='embed-container mb-3'><iframe src='https://www.google.com/maps/embed?pb=!4v1704564856139!6m8!1m7!1sCAoSLEFGMVFpcE1CbHN1VmpyT2M3Y194S3VLZlY1TkpaY04zbVU4RXdTbE9HaE9a!2m2!1d50.293834053809!2d8.6957197515206!3f200!4f0!5f0.7820865974627469' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe></div>
			<style>
				.embed-container {
					position: relative;
					padding-bottom: 56.25%;
					height: 0;
					overflow: hidden;
					max-width: 100%;
				}

				.embed-container iframe,
				.embed-container object,
				.embed-container embed {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
				}
			</style>
			<div class='embed-container'><iframe src='https://www.google.com/maps/embed?pb=!4v1704564915542!6m8!1m7!1sCAoSLEFGMVFpcE01SWplN3VJbHpmR0RxaG8xZkd4eTdLQ0dOZDI2d3QxTFU0MFBZ!2m2!1d50.293820485056!2d8.6956437282406!3f0!4f0!5f0.7820865974627469' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe></div>
		</div>
	</div>





	<?php
	$sadrzaji = get_field('sadrzaji');
	if ($sadrzaji): ?>
		<div class="sadrzaji py-7 py-md-8 py-xl-9">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-8 text-center">
						<h6 class="color-white text-uppercase"><?php echo $sadrzaji['podnaslov']; ?></h6>
						<h2 class="color-dark-gold mb-3"><?php echo $sadrzaji['naslov']; ?></h2>
						<?php echo $sadrzaji['tekst']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="sadrzaji-lista">
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_1'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_1']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_1']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_2'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_2']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_2']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_3'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_3']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_3']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_4'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_4']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_4']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_5'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_5']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_5']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_6'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_6']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_6']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_7'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_7']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_7']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_8'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_8']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_8']; ?></span>
								</div>
							<?php }
							?>
							<?php
							if (!empty($sadrzaji['naslov_sadrzaj_9'])) { ?>
								<div class="sadrzaj">
									<?php echo $sadrzaji['ikona_sadrzaj_9']; ?>
									<span><?php echo $sadrzaji['naslov_sadrzaj_9']; ?></span>
								</div>
							<?php }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?> -->


	<?php
	$cta = get_field('cta');
	if ($cta): ?>
		<section class="cta-section">
			<div class="cta-background" style="background-image:url('<?php echo $cta['pozadinska_slika']; ?>')"></div>
			<div class="cta-overlay"></div>

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
