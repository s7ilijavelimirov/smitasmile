<?php

/**
 * Template Name: Smita Team
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();
?>

<!-- Page Header Section -->
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('template-parts/intro-section'); ?>

		<!-- Page Content -->
		<?php if (get_the_content()) : ?>
			<section class="team-content-section mb-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>

<!-- Team Members Section -->
<section class="team-members-section mt-7 mt-md-8 mt-xl-9 container-fluid">
	<div class="container">
		<?php
		$team_args = array(
			'post_type'      => 'smita_team',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC'
		);

		$team_query = new WP_Query($team_args);

		if ($team_query->have_posts()) :
			$counter = 0;
			$total = $team_query->post_count;

			while ($team_query->have_posts()) :
				$team_query->the_post();
				$counter++;

				$position_title = get_field('team_position_title');
				$specialization = get_field('team_specialization');
				$bio = get_field('team_bio');
				$experience_sections = get_field('team_experience_sections');
				$social_links = get_field('team_social_links');
				$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
				$accordion_id = 'team-accordion-' . get_the_ID();

				// Alternating: paran (2,4,6...) = image levo, neparan (1,3,5...) = image desno
				$is_even = ($counter % 2) === 0;
		?>

				<div class="row align-items-start smita-box">

					<!-- LEFT: Content -->
					<div class="col-lg-7 mt-0 <?php echo $is_even ? 'order-lg-2' : ''; ?>">

						<h1 class="mb-4">
							<?php the_title(); ?>
						</h1>

						<?php if ($position_title) : ?>
							<h4 class="mb-4">
								<?php echo esc_html($position_title); ?>
							</h4>
						<?php endif; ?>

						<?php if ($specialization) : ?>
							<h5 class="mb-4">
								<?php echo esc_html($specialization); ?>
							</h5>
						<?php endif; ?>

						<?php if ($bio) : ?>
							<div class="mb-4">
								<?php echo wp_kses_post($bio); ?>
							</div>
						<?php endif; ?>

						<!-- Accordion -->
						<?php if ($experience_sections) : ?>
							<div class="accordion mb-4" id="<?php echo esc_attr($accordion_id); ?>">
								<?php
								usort($experience_sections, function ($a, $b) {
									return (intval($a['experience_order'] ?? 0)) - (intval($b['experience_order'] ?? 0));
								});

								$exp_index = 0;
								$exp_count = count($experience_sections);

								foreach ($experience_sections as $section) :
									$section_title = $section['experience_title'] ?? '';
									$section_desc = $section['experience_description'] ?? '';
									$exp_id = $accordion_id . '-' . $exp_index;

									if (! $section_title) continue;
								?>
									<div class="accordion-item <?php echo ($exp_index < $exp_count - 1) ? 'with-divider' : ''; ?>">
										<h3 class="accordion-header">
											<button
												class="accordion-button collapsed"
												type="button"
												data-bs-toggle="collapse"
												data-bs-target="#<?php echo esc_attr($exp_id); ?>"
												aria-expanded="false"
												aria-controls="<?php echo esc_attr($exp_id); ?>">
												<?php echo esc_html($section_title); ?>
											</button>
										</h3>
										<div
											id="<?php echo esc_attr($exp_id); ?>"
											class="accordion-collapse collapse"
											data-bs-parent="#<?php echo esc_attr($accordion_id); ?>">
											<div class="accordion-body">
												<?php echo wp_kses_post($section_desc); ?>
											</div>
										</div>
									</div>
								<?php
									$exp_index++;
								endforeach;
								?>
							</div>
						<?php endif; ?>

						<!-- Social Links -->
						<?php if ($social_links) : ?>
							<div class="d-flex gap-2">
								<?php
								$social_icons = array(
									'linkedin'  => 'fab fa-linkedin',
									'instagram' => 'fab fa-instagram',
									'facebook'  => 'fab fa-facebook',
									'twitter'   => 'fab fa-twitter',
									'email'     => 'fas fa-envelope',
								);

								foreach ($social_links as $link) :
									$platform = $link['social_platform'] ?? '';
									$url = $link['social_url'] ?? '';
									if ($platform && $url) :
										$icon_class = $social_icons[$platform] ?? 'fas fa-link';
								?>
										<a href="<?php echo esc_url($url); ?>"
											target="_blank"
											rel="noopener noreferrer"
											class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center"
											style="width: 40px; height: 40px;"
											title="<?php echo esc_attr(ucfirst($platform)); ?>">
											<i class="<?php echo esc_attr($icon_class); ?>"></i>
										</a>
								<?php
									endif;
								endforeach;
								?>
							</div>
						<?php endif; ?>

					</div>

					<!-- RIGHT: Image -->
					<div class="col-lg-5 px-0 px-lg-3 mt-0 <?php echo $is_even ? '' : 'order-lg-2'; ?>">
						<?php if ($featured_image) : ?>
							<img src="<?php echo esc_url($featured_image); ?>"
								alt="<?php echo esc_attr(get_the_title()); ?>"
								class="img-fluid rounded-4">
						<?php endif; ?>
					</div>

				</div>

		<?php endwhile;
			wp_reset_postdata();
		else :
			echo '<div class="alert alert-info text-center">' . esc_html__('No team members found.', 'smitasmile') . '</div>';
		endif;
		?>
	</div>
</section>

<?php
get_footer();
