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

<!-- Team Members Grid -->
<section class="team-grid-section py-5 py-lg-7">
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
		?>
			<div class="row g-4">
				<?php
				while ($team_query->have_posts()) :
					$team_query->the_post();

					$member_id = get_the_ID();
					$position_title = get_field('team_position_title');
					$specialization = get_field('team_specialization');
					$bio = get_field('team_bio');
					$experience_sections = get_field('team_experience_sections');
					$social_links = get_field('team_social_links');
					$featured_image = get_the_post_thumbnail_url($member_id, 'large');
					$modal_id = 'team-modal-' . $member_id;
				?>

					<!-- Team Member Card -->
					<div class="col-6 col-lg-4 px-1">
						<article class="team-card" role="button" data-bs-toggle="modal" data-bs-target="#<?php echo esc_attr($modal_id); ?>">
							<div class="team-card__image-wrapper">
								<?php if ($featured_image) : ?>
									<img src="<?php echo esc_url($featured_image); ?>"
										alt="<?php echo esc_attr(get_the_title()); ?>"
										class="team-card__image"
										loading="lazy">
								<?php else : ?>
									<div class="team-card__placeholder">
										<span><?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?></span>
									</div>
								<?php endif; ?>

								<!-- Hover Icon -->
								<span class="team-card__icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
								</span>

								<!-- Info Box on Image -->
								<div class="team-card__info">
									<h3 class="team-card__name"><?php the_title(); ?></h3>
									<?php if ($position_title) : ?>
										<p class="team-card__position"><?php echo esc_html($position_title); ?></p>
									<?php endif; ?>
									<?php if ($specialization) : ?>
										<p class="team-card__specialization"><?php echo esc_html($specialization); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</article>
					</div>

					<!-- Team Member Modal -->
					<div class="modal fade team-modal" id="<?php echo esc_attr($modal_id); ?>" tabindex="-1" aria-labelledby="<?php echo esc_attr($modal_id); ?>-label" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
							<div class="modal-content">
								<button type="button" class="team-modal__close btn-close btn-close-white" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'smitasmile'); ?>"></button>

								<div class="team-modal__body">
									<!-- Header with Image -->
									<div class="team-modal__header">
										<?php if ($featured_image) : ?>
											<img src="<?php echo esc_url($featured_image); ?>"
												alt="<?php echo esc_attr(get_the_title()); ?>"
												class="team-modal__image">
										<?php endif; ?>
										<div class="team-modal__header-info">
											<h2 class="team-modal__name" id="<?php echo esc_attr($modal_id); ?>-label">
												<?php the_title(); ?>
											</h2>
											<?php if ($position_title) : ?>
												<p class="team-modal__position"><?php echo esc_html($position_title); ?></p>
											<?php endif; ?>
											<?php if ($specialization) : ?>
												<p class="team-modal__specialization"><?php echo esc_html($specialization); ?></p>
											<?php endif; ?>
										</div>
									</div>

									<!-- Bio -->
									<?php if ($bio) : ?>
										<div class="team-modal__bio">
											<?php echo wp_kses_post($bio); ?>
										</div>
									<?php endif; ?>

									<!-- Experience Sections with Icons -->
									<?php if ($experience_sections) : ?>
										<div class="team-modal__sections">
											<?php
											usort($experience_sections, function ($a, $b) {
												return (intval($a['experience_order'] ?? 0)) - (intval($b['experience_order'] ?? 0));
											});

											// Define SVG icons for different section types
											$section_icons = array(
												'languages' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>',
												'education' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>',
												'additional' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>',
												'experience' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>',
												'default' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>'
											);

											foreach ($experience_sections as $section) :
												$section_title = $section['experience_title'] ?? '';
												$section_desc = $section['experience_description'] ?? '';

												if (!$section_title) continue;

												// Determine icon based on title keywords
												$title_lower = strtolower($section_title);
												$icon_svg = $section_icons['default'];
												if (strpos($title_lower, 'language') !== false || strpos($title_lower, 'idioma') !== false || strpos($title_lower, 'sprach') !== false) {
													$icon_svg = $section_icons['languages'];
												} elseif (strpos($title_lower, 'additional') !== false || strpos($title_lower, 'adicional') !== false || strpos($title_lower, 'zusätzlich') !== false) {
													$icon_svg = $section_icons['additional'];
												} elseif (strpos($title_lower, 'education') !== false || strpos($title_lower, 'educación') !== false || strpos($title_lower, 'ausbildung') !== false || strpos($title_lower, 'formación') !== false) {
													$icon_svg = $section_icons['education'];
												} elseif (strpos($title_lower, 'experience') !== false || strpos($title_lower, 'experiencia') !== false || strpos($title_lower, 'erfahrung') !== false) {
													$icon_svg = $section_icons['experience'];
												}
											?>
												<div class="team-modal__section">
													<div class="team-modal__section-header">
														<span class="team-modal__section-icon">
															<?php echo $icon_svg; ?>
														</span>
														<h4 class="team-modal__section-title"><?php echo esc_html($section_title); ?></h4>
													</div>
													<div class="team-modal__section-content">
														<?php echo wp_kses_post($section_desc); ?>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>

									<!-- Social Links -->
									<?php if ($social_links) : ?>
										<div class="team-modal__social">
											<?php
											$social_icons = array(
												'linkedin'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
												'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
												'facebook'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
												'twitter'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>',
												'email'     => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
												'default'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>'
											);

											foreach ($social_links as $link) :
												$platform = $link['social_platform'] ?? '';
												$url = $link['social_url'] ?? '';
												if ($platform && $url) :
													$icon_svg = $social_icons[$platform] ?? $social_icons['default'];
											?>
													<a href="<?php echo esc_url($url); ?>"
														target="_blank"
														rel="noopener noreferrer"
														class="team-modal__social-link"
														title="<?php echo esc_attr(ucfirst($platform)); ?>">
														<?php echo $icon_svg; ?>
													</a>
											<?php
												endif;
											endforeach;
											?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="team-grid__empty">
				<?php echo esc_html__('No team members found.', 'smitasmile'); ?>
			</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
