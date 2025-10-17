<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Smitasmile
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri()); ?>/dist/img/favicon.png" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'Smitasmile'); ?></a>

		<header id="masthead" class="site-header">
			<nav class="container navbar navbar-expand-xl navbar-dark fixed-top bg-dark rounded-3">
				<div class="container">
					<?php
					if (has_custom_logo()) {
						$custom_logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
						$favicon_url = get_template_directory_uri() . '/dist/img/favicon.png';
					?>
						<a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="custom-logo logo-full">
							<img src="<?php echo esc_url($favicon_url); ?>" alt="<?php bloginfo('name'); ?>" class="custom-logo logo-mobile">
						</a>
					<?php } else { ?>
						<a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<span><?php bloginfo('name'); ?></span>
						</a>
					<?php } ?>

					<div class="language-switcher d-xl-none ms-auto me-3">
						<ul class="d-flex align-items-center list-unstyled mb-0">
							<?php pll_the_languages(); ?>
						</ul>
					</div>

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobilnaNavigacija" aria-controls="mobilnaNavigacija" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'mobilnaNavigacija',
							'menu_class'      => 'navbar-nav ms-auto',
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'walker'          => new WP_Bootstrap_Navwalker()
						)
					);
					?>

					<div class="language-switcher d-xl-block d-none ms-4">
						<ul class="d-flex align-items-center list-unstyled mb-0">
							<?php pll_the_languages(); ?>
						</ul>
					</div>

					<div class="header-kontakt">
						<div class="d-flex align-items-center">
							<?php
							$currentlang = get_bloginfo('language');
							if ($currentlang == "en-US"):
							?>
								<span class="d-none d-md-block me-3">Contact us today:</span>
							<?php else: ?>
								<span class="d-none d-md-block me-3">Kontaktieren Sie uns heute:</span>
							<?php endif; ?>
							<a href="mailto:info@Smitasmile.de" class="btn btn-secondary btn-header-contact" data-hover="info@Smitasmile.de">
								<span>
									<i class="far fa-envelope-open"></i>
									info@Smitasmile.de
								</span>
							</a>
						</div>
					</div>


				</div>
			</nav>
		</header><!-- #masthead -->