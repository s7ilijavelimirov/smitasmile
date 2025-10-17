<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Smitasmile
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="banner banner-post py-6 py-lg-8 mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h6 class="color-dark-gold text-uppercase">Like Daheim</h6>
						<?php
							$currentlang = get_bloginfo('language');
							if($currentlang=="en-US"):
						?>
						<h1 class="color-white mb-0">News</h1>
						<?php else: ?>
						<h1 class="color-white mb-0">Nachrichten</h1>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="post-list mb-7 mb-md-8 mb-xl-9">
			<div class="container">
				<div class="row">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
