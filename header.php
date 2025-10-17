<?php

/**
 * The header for our theme
 * @package mytheme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">
		<!-- Skip to content -->
		<a class="visually-hidden-focusable skip-link" href="#primary">
			<?php esc_html_e('Skip to content', 'mytheme'); ?>
		</a>

		<!-- Header -->
		<header id="masthead" class="site-header sticky-top">
			<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
				<div class="container-lg">
					<!-- Logo / Brand -->
					<div class="navbar-brand-wrapper">
						<?php
						if (has_custom_logo()) {
							$custom_logo_id = get_theme_mod('custom_logo');
							$logo_desktop   = wp_get_attachment_image_src($custom_logo_id, 'full');
						?>
							<a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<img
									src="<?php echo esc_url($logo_desktop[0]); ?>"
									alt="<?php bloginfo('name'); ?>"
									class="logo-desktop"
									height="50"
									loading="eager"
									decoding="async">
							</a>
						<?php
						} else {
						?>
							<a class="navbar-brand fw-bold" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a>
						<?php
						}
						?>
					</div>

					<!-- Mobile Toggler -->
					<button
						class="navbar-toggler"
						type="button"
						data-bs-toggle="collapse"
						data-bs-target="#navbarNavigation"
						aria-controls="navbarNavigation"
						aria-expanded="false"
						aria-label="<?php esc_attr_e('Toggle navigation', 'mytheme'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- Navigation Menu -->
					<div class="collapse navbar-collapse" id="navbarNavigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'depth'           => 2,
								'container'       => false,
								'menu_class'      => 'navbar-nav ms-auto',
								'fallback_cb'     => 'wp_page_menu',
								'walker'          => new WP_Bootstrap_NavWalker(),
							)
						);
						?>
					</div>

					<!-- CTA Button -->
					<div class="header-cta ms-auto ms-lg-3">
						<a
							href="<?php echo esc_url(home_url('/book-appointment')); ?>"
							class="btn btn-primary btn-sm"
							target="_self">
							<?php esc_html_e('Book Appointment', 'mytheme'); ?>
						</a>
					</div>
				</div>
			</nav>
		</header><!-- #masthead -->

		<!-- Main Content Wrapper -->
		<main id="primary" class="site-main">