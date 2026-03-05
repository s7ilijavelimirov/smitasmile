<?php

/**
 * The main template file
 * Homepage - displays hero, featured sections, and recent posts with pagination
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package SmitaSmile
 */

get_header();

// Check if blog is under development (from Blog page meta)
$posts_page_id = get_option('page_for_posts');
$blog_under_development = $posts_page_id ? get_post_meta($posts_page_id, '_blog_under_development', true) : false;
?>
<!-- Intro Section -->
<?php get_template_part('template-parts/intro-section'); ?>

<!-- Featured Blog Posts Section -->
<section class="featured-posts-section py-5 py-md-7 py-lg-8">
	<div class="container">

		<?php if ($blog_under_development) : ?>
			<!-- Under Development Message -->
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-6 text-center">
					<div class="under-development-message py-5">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-white mb-4" viewBox="0 0 16 16">
							<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
							<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
						</svg>
						<h2 class="text-white fs-1 mb-3">
							<?php echo esc_html(pll__('Under development')); ?>
						</h2>
						<p class="text-white-50 fs-5">
							<?php echo esc_html(pll__('We are working on creating content for you. Please check back soon!')); ?>
						</p>
					</div>
				</div>
			</div>
		<?php else : ?>
			<!-- Section Title -->
			<div class="row mb-5">
				<div class="col-12 text-start">
					<h2 class="text-white fs-1 mb-3">
						<?php echo esc_html(pll__('Latest News')); ?>
					</h2>
				</div>
			</div>

			<!-- Posts Grid -->
			<div class="row g-4">
				<?php
				$current_lang = pll_current_language();
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;

				$featured_args = array(
					'post_type'      => 'post',
					'posts_per_page' => get_option('posts_per_page'),
					'paged'          => $paged,
					'orderby'        => 'date',
					'order'          => 'DESC',
					'lang'           => $current_lang,
				);

				$featured_query = new WP_Query($featured_args);

				if ($featured_query->have_posts()) {
					while ($featured_query->have_posts()) {
						$featured_query->the_post();
						get_template_part('template-parts/content');
					}
				} else {
					echo '<div class="col-12"><p class="text-white text-center">' . esc_html(pll__('No posts available.')) . '</p></div>';
				}

				wp_reset_postdata();
				?>
			</div>

			<?php if ($featured_query->max_num_pages > 1) : ?>
				<div class="row mt-6">
					<div class="col-12">
						<nav aria-label="<?php echo esc_attr(pll__('Posts pagination')); ?>">
							<ul class="pagination justify-content-center">
								<?php
								$big = 999999999;
								$pagination_args = array(
									'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
									'format'    => '?paged=%#%',
									'current'   => max(1, $paged),
									'total'     => $featured_query->max_num_pages,
									'prev_text' => '← ' . esc_html(pll__('Previous')),
									'next_text' => esc_html(pll__('Next')) . ' →',
									'type'      => 'array',
								);

								$links = paginate_links($pagination_args);
								if ($links) {
									foreach ($links as $link) {
										// Uklanja nested spans
										$link = str_replace('<span class="page-numbers', '<span class="page-link page-numbers', $link);
										$link = str_replace('current"><span', 'current', $link);
										$link = str_replace('</span></span>', '', $link);

										echo '<li class="page-item">' . wp_kses_post($link) . '</li>';
									}
								}
								?>
							</ul>
						</nav>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section><!-- .featured-posts-section -->

<?php
get_footer();
