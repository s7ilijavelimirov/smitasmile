<?php

/**
 * Template part for displaying posts in blog list
 * SEO Optimized for YOAST + Polylang support
 * 
 * @package SmitaSmile
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-6 col-lg-4'); ?>>
	<div class="post-card card h-100 shadow-sm">

		<!-- Featured Image -->
		<div class="post-thumbnail-wrapper card-img-top position-relative overflow-hidden">
			<a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" class="d-block h-100 text-decoration-none">
				<?php
				if (has_post_thumbnail()) {
					echo wp_get_attachment_image(
						get_post_thumbnail_id(),
						'medium_large',
						false,
						array(
							'class'    => 'w-100 h-100 object-fit-cover',
							'alt'      => get_the_title(),
							'loading'  => 'lazy',
							'decoding' => 'async'
						)
					);
				} else {
				?>
					<img
						src="<?php echo esc_url(get_theme_file_uri('assets/images/placeholder.jpg')); ?>"
						alt="<?php echo esc_attr(get_the_title()); ?>"
						class="w-100 h-100 object-fit-cover post-placeholder"
						loading="lazy"
						decoding="async">
				<?php
				}
				?>
			</a>
			<!-- Post Tags Overlay -->
			<?php
			$tags = get_the_tags();
			if ($tags && !is_wp_error($tags)) :
			?>
				<div class="post-tags-overlay">
					<?php
					foreach (array_slice($tags, 0, 2) as $tag) :
					?>
						<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge bg-dark text-white text-decoration-none">
							#<?php echo esc_html($tag->name); ?>
						</a>
					<?php
					endforeach;
					?>
				</div>
			<?php endif; ?>

		</div>

		<!-- Post Content -->
		<div class="card-body d-flex flex-column p-5">

			<!-- Post Meta (Date) -->
			<div class="post-meta mb-2 text-white">
				<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="post-date small text-uppercase">
					<?php echo esc_html(get_the_date('F j, Y')); ?>
				</time>
			</div>

			<!-- Post Title (H3 for SEO) -->
			<h3 class="post-title card-title mb-3 flex-grow-0">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="fs-4 text-decoration-none">
					<?php the_title(); ?>
				</a>
			</h3>

			<!-- Post Excerpt -->
			<div class="post-excerpt text-white mb-3 flex-grow-1 small">
				<?php
				$excerpt = get_the_excerpt();
				if ($excerpt) {
					echo wp_trim_words($excerpt, 20, '...');
				} else {
					echo wp_trim_words(get_the_content(), 20, '...');
				}
				?>
			</div>

			<!-- Post Footer / Read More Link -->
			<div class="post-footer pt-3 border-top text-end">
				<a href="<?php the_permalink(); ?>" class="read-more-link small" aria-label="<?php echo esc_attr(sprintf(__('Read more about %s', 'smitasmile'), get_the_title())); ?>">
					<?php echo esc_html(pll__('Read More')); ?>
					<span class="arrow">→</span>
				</a>
			</div>

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->