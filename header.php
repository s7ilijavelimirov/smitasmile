<?php

/**
 * The header for our theme
 * @package smitasmile
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php if (is_singular('page')) : ?>
		<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
	<?php endif; ?>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/webp" href="<?php echo esc_url(get_template_directory_uri() . '/dist/img/favicon.webp'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">
		<!-- Skip to content - A11y -->
		<a class="visually-hidden-focusable skip-link" href="#primary">
			<?php esc_html_e('Skip to content', 'smitasmile'); ?>
		</a>

		<!-- Header - Transparent with Dark Overlay + Sticky Hide/Show -->
		<header id="masthead" class="site-header sticky-header">
			<nav class="navbar navbar-expand-lg navbar-dark" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'smitasmile'); ?>" data-sticky="true">
				<div class="container-fluid header-container">
					<!-- Logo / Brand -->
					<div class="navbar-brand-wrapper">
						<?php
						if (has_custom_logo()) {
							$custom_logo_id = get_theme_mod('custom_logo');
							$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
							$site_title = get_bloginfo('name');
						?>
							<a class="navbar-brand d-flex align-items-center flex-column" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr($site_title); ?>">
								<img
									src="<?php echo esc_url($logo[0]); ?>"
									alt="<?php echo esc_attr($site_title); ?>"
									class="logo-desktop"
									width="auto"
									height="64"
									loading="eager"
									decoding="async">
							</a>
						<?php
						} else {
						?>
							<a class="navbar-brand fw-bold text-white" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<span class="d-block">SMITA</span>
								<small class="d-block text-uppercase">Advanced Smile Design</small>
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
						aria-label="<?php esc_attr_e('Toggle navigation', 'smitasmile'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- Navigation Menu - Centered -->
					<div class="collapse navbar-collapse justify-content-center" id="navbarNavigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'depth'           => 2,
								'container'       => false,
								'menu_class'      => 'navbar-nav gap-3',
								'fallback_cb'     => 'wp_page_menu',
								'walker'          => new WP_Bootstrap_NavWalker(),
								'aria_label'      => __('Main navigation', 'smitasmile'),
							)
						);
						?>
					</div>

					<!-- CTA Button - Right Side -->
					<div class="ms-lg-auto">
						<a
							href="<?php echo esc_url(home_url('/book-appointment')); ?>"
							class="btn btn-outline-light btn-sm fw-600"
							aria-label="<?php esc_attr_e('Book Your Appointment', 'smitasmile'); ?>">
							<?php esc_html_e('Book Your Appointment', 'smitasmile'); ?>
						</a>
					</div>
				</div>
			</nav>
		</header><!-- #masthead -->

		<!-- Main Content Wrapper -->
		<main id="primary" class="site-main" style="min-height:100vh;">