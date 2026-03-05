<?php

/**
 * The template for displaying all single posts
 * SEO YOAST optimized + Polylang support + Author + Tags
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package SmitaSmile
 */

get_header();
?>


<!-- Intro Section with Post Title, Date, Tags -->
<section class="intro-section py-5 py-md-7 py-lg-8">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<div class="intro-content">
					<!-- H1 - Main headline for SEO -->
					<h1 class="intro-title" itemprop="headline">
						<?php the_title(); ?>
					</h1>

					<!-- Post Meta - Date & Reading Time -->
					<div class="post-meta-info d-flex align-items-center justify-content-center gap-3 flex-wrap mt-3">
						<time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="post-publish-date small text-uppercase">
							<?php echo esc_html(get_the_date('F j, Y')); ?>
						</time>
					</div>

					<!-- Tags -->
					<?php
					$tags = get_the_tags();
					if ($tags && !is_wp_error($tags)) :
					?>
						<div class="post-tags d-flex flex-wrap gap-2 mt-4 justify-content-center">
							<?php
							foreach ($tags as $tag) :
							?>
								<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge">
									#<?php echo esc_html($tag->name); ?>
								</a>
							<?php
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Featured Image -->
<?php if (has_post_thumbnail()) : ?>
	<div class="post-featured-image-wrapper py-5 py-md-6 py-lg-7">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-10 offset-lg-1">
					<?php
					echo wp_get_attachment_image(
						get_post_thumbnail_id(),
						'large',
						false,
						array(
							'class'     => 'w-100 rounded-3',
							'alt'       => get_the_title(),
							'itemprop'  => 'image',
							'loading'   => 'lazy',
							'decoding'  => 'async',
							'style'     => 'max-height: 500px; object-fit: cover;'
						)
					);
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- Main Post Content -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<div class="post-body-wrapper py-5 py-md-6 py-lg-7">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8 offset-lg-2">
					<!-- Post Content -->
					<div class="post-content" itemprop="articleBody">
						<?php
						the_content();

						wp_link_pages(array(
							'before' => '<div class="post-page-links my-4"><span class="d-block mb-3">' . esc_html__('Pages:', 'smitasmile') . '</span>',
							'after'  => '</div>',
							'pagelink' => '<span class="btn btn-outline-light btn-sm me-2">%</span>',
							'separator' => '',
						));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<!-- Author Box & Back to Blog -->
<div class="post-footer-wrapper py-5 py-md-6 py-lg-7 border-top">
	<div class="container">
		<div class="row align-items-center">
			<!-- Author Box - Left -->
			<div class="col-12 col-lg-6">
				<div class="author-box d-flex gap-4 align-items-start">
					<!-- Author Avatar -->
					<div class="author-avatar flex-shrink-0">
						<?php
						echo get_avatar(get_the_author_meta('ID'), 80, '', get_the_author_meta('display_name'), array(
							'class' => 'rounded-circle',
							'loading' => 'lazy'
						));
						?>
					</div>

					<!-- Author Info -->
					<div class="author-info flex-grow-1">
						<h3 class="author-name mb-2">
							<?php echo esc_html(get_the_author_meta('display_name')); ?>
						</h3>
						<p class="author-bio mb-3">
							<?php echo wp_kses_post(get_the_author_meta('description')); ?>
						</p>
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="btn btn-outline-light p-2">
							<?php echo esc_html(pll__('View all posts')); ?>
						</a>
					</div>
				</div>
			</div>

			<!-- Back to Blog Button - Right -->
			<div class="col-12 col-lg-6 text-lg-end mt-4 mt-lg-0">
				<?php
				$blog_url = get_permalink(get_option('page_for_posts'));
				if ($blog_url) {
				?>
					<a href="<?php echo esc_url($blog_url); ?>" class="btn btn-outline-light">
						<?php echo esc_html(pll__('Back to Blog')); ?>
					</a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>


<?php
get_footer();