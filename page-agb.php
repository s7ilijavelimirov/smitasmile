<?php

/**
 * The template for displaying all pages
 *
 * Template Name: AGB
 *
 * @package Smitasmile
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

	<div class="copy mb-5">
		<div class="container">
			<div class="col-12">
				<?php the_field('tekst'); ?>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
