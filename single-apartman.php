<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Likedaheim
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="banner py-6 py-lg-8" style="background-image:url('<?php the_field('pozadinska_slika'); ?>')">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h6 class="color-dark-gold text-uppercase">Like Daheim</h6>
						<h1 class="color-white mb-0"><?php the_title(); ?></h1>
					</div>
				</div>
			</div>
		</div>

		<div class="room-slider p-3 mb-7 mb-md-8 mb-xl-9">

				<?php
				$image = get_field('fotografija_1');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_2');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_3');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_4');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_5');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_6');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_7');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_8');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_9');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>
				<?php
				$image = get_field('fotografija_10');
				if( $image ):

					// Image variables.
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];

					// Thumbnail size attributes.
					$thumb = $image['sizes']['apartment-square'];
				?>
					<div class="slide">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" >
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="img-fluid" />
						</a>

						<?php 
						if( $caption ): ?>
							<div class="caption">
								<figcaption><?php echo esc_html($caption); ?></figcaption>
							</div>
						<?php endif; ?>
					</div>

				<?php endif; ?>

		</div>

		<div class="misc mb-3">
			<div class="container">
				<div class="inner p-3">
					<div class="row align-items-center">
						<div class="col-lg-6 mb-3 mb-lg-0">
							<div class="d-lg-flex align-items-center">
								<span class="gosti d-flex align-items-center mb-2 mb-lg-0 mr-lg-3"><i class="far fa-user-circle color-dark-blue"></i><?php the_field('broj_gostiju'); ?></span>
								<span class="kvadratura d-flex align-items-center mb-2  mb-lg-0 mr-lg-3"><i class="fas fa-ruler-combined color-dark-blue"></i><?php the_field('kvadratura'); ?>m2</span>
								<?php if( get_field('velicina_kreveta') ): ?>
									<span class="krevet d-flex align-items-center"><i class="fas fa-bed"></i><?php the_field('velicina_kreveta'); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-6">
							<a href="" class="btn btn-block btn-primary"><?php the_field('startna_cijena'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="sadrzaj mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="inner p-3 p-lg-5">
					<div class="row">
						<div class="col-12">
							<h3 class="color-dark-blue mb-3"><?php the_field('opis_naslov'); ?></h3>
							<?php the_field('opis'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 mb-3 mb-lg-0">
							<div class="pogodnosti">
								<h4 class="color-dark-blue mb-3"><?php the_field('ukljucene_pogodnosti_naslov'); ?></h4>
								<?php the_field('ukljucene_pogodnosti'); ?>
							</div>
						</div>
						<div class="col-lg-4 mb-3 mb-lg-0">
							<div class="usluge">
								<h4 class="color-dark-blue mb-3"><?php the_field('ukljucene_usluge_naslov'); ?></h4>
								<?php the_field('ukljucene_usluge'); ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="dodatne">
								<h4 class="color-dark-blue mb-3"><?php the_field('dodatne_usluge_naslov'); ?></h4>
								<?php the_field('dodatne_usluge'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
