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

		<!-- Header - Sticky -->
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
							<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr($site_title); ?>">
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

					<!-- Desktop Navigation - Centered -->
					<div class="navbar-nav-desktop">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'depth'           => 2,
								'container'       => false,
								'menu_class'      => 'navbar-nav gap-lg-1 gap-xl-3',
								'fallback_cb'     => 'wp_page_menu',
								'walker'          => new WP_Bootstrap_NavWalker(),
								'aria_label'      => __('Main navigation', 'smitasmile'),
							)
						);
						?>
					</div>

					<!-- CTA Button - Desktop -->
					<div class="d-none d-lg-flex gap-1 justify-content-end">
						<a
							href="<?php echo esc_url(home_url('/book-appointment')); ?>"
							class="btn btn-outline-light phone"
							aria-label="<?php esc_attr_e('Book Your Appointment', 'smitasmile'); ?>">
							<?php
							$svg_path = get_template_directory() . '/dist/img/phone.svg';
							if (file_exists($svg_path)) {
								echo file_get_contents($svg_path);
							}
							?>
						</a>
						<a
							href="<?php echo esc_url(home_url('/book-appointment')); ?>"
							class="btn btn-outline-light"
							aria-label="<?php echo esc_attr(pll__('Book Your Appointment')); ?>">
							<?php echo esc_html(pll__('Book Your Appointment')); ?>
						</a>
					</div>

					<!-- Mobile Offcanvas Toggle -->
					<button
						class="navbar-toggler d-lg-none"
						type="button"
						data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasNavbar"
						aria-controls="offcanvasNavbar"
						aria-label="<?php esc_attr_e('Toggle navigation', 'smitasmile'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

				</div>
			</nav>
		</header><!-- #masthead -->

		<!-- Offcanvas Mobile Menu -->
		<div class="offcanvas offcanvas-start offcanvas-mobile" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

			<!-- Offcanvas Header -->
			<div class="offcanvas-header">
				<?php
				if (has_custom_logo()) {
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
					$site_title = get_bloginfo('name');
				?>
					<a class="navbar-brand-offcanvas" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr($site_title); ?>">
						<img
							src="<?php echo esc_url($logo[0]); ?>"
							alt="<?php echo esc_attr($site_title); ?>"
							width="auto"
							height="50"
							loading="eager"
							decoding="async">
					</a>
				<?php
				} else {
				?>
					<a class="navbar-brand fw-bold text-white" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						SMITA
					</a>
				<?php
				}
				?>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>

			<!-- Offcanvas Body -->
			<div class="offcanvas-body">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'depth'           => 2,
						'container'       => false,
						'menu_class'      => 'navbar-nav flex-column gap-0',
						'fallback_cb'     => 'wp_page_menu',
						'walker'          => new WP_Bootstrap_NavWalker(),
						'aria_label'      => __('Main navigation', 'smitasmile'),
					)
				);
				?>

				<!-- CTA Button in Offcanvas -->
				<div class="offcanvas-cta mt-4 pt-3 border-top border-secondary-subtle">
					<a
						href="<?php echo esc_url(home_url('/book-appointment')); ?>"
						class="btn btn-outline-light"
						aria-label="<?php esc_attr_e('Book Your Appointment', 'smitasmile'); ?>"
						data-bs-dismiss="offcanvas">
						<?php esc_html_e('Book Your Appointment', 'smitasmile'); ?>
					</a>
				</div>

			</div>
			<div class="offcanvas-footer py-3 border-top border-secondary-subtle">
				<div class="socials d-flex justify-content-center">
					<?php
					if (is_active_sidebar('footer-logo-social')):
						dynamic_sidebar('footer-logo-social');
					endif;
					?>
				</div>
			</div>

		</div>

		<!-- Main Content Wrapper -->
		<main id="primary" class="site-main" style="min-height:100vh;">