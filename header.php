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
	<!-- Favicon - Optimizovan -->
	<link rel="icon" type="image/webp" href="<?php echo esc_url(get_template_directory_uri() . '/dist/img/favicon.webp'); ?>" sizes="any">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- Site Overlay for menu -->
	<div class="site-overlay" aria-hidden="true"></div>

	<!-- Slide Push Menu -->
	<nav class="slide-push-menu" aria-label="<?php esc_attr_e('Main Navigation', 'smitasmile'); ?>">
		<!-- Menu Header -->
		<div class="slide-push-menu__header">
			<div class="slide-push-menu__logo">
				<?php
				if (has_custom_logo()) {
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
					$site_title = get_bloginfo('name');
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr($site_title); ?>">
						<img src="<?php echo esc_url($logo[0]); ?>"
							alt="<?php echo esc_attr($site_title); ?>"
							width="128"
							height="50"
							loading="eager"
							decoding="async">
					</a>
				<?php
				} else {
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-white text-decoration-none">
						<strong>SMITA</strong>
					</a>
				<?php
				}
				?>
			</div>
			<button type="button" class="slide-push-menu__close" aria-label="<?php esc_attr_e('Close menu', 'smitasmile'); ?>"></button>
		</div>

		<!-- Menu Body - WordPress Menu -->
		<div class="slide-push-menu__body">
			<?php
			if (has_nav_menu('header_menu')) {
				wp_nav_menu(array(
					'theme_location'  => 'header_menu',
					'depth'           => 2,
					'container'       => false,
					'menu_class'      => 'slide-push-menu__nav',
					'fallback_cb'     => false,
					'walker'          => new Slide_Push_Menu_Walker(),
				));
			}
			?>
		</div>

		<!-- Menu Footer -->
		<div class="slide-push-menu__footer">
			<!-- CTA Buttons -->
			<div class="slide-push-menu__cta">
				<?php
				// Booking page
				$booking_page_id = function_exists('pll_get_post') ? pll_get_post(484) : 484;
				$booking_url = get_permalink($booking_page_id);
				$booking_title = get_the_title($booking_page_id);

				// Contact page
				$contact_page_id = function_exists('pll_get_post') ? pll_get_post(412) : 412;
				$contact_url = get_permalink($contact_page_id);
				?>
				<!-- Primary: Book Appointment (full width) -->
				<a href="<?php echo esc_url($booking_url); ?>" class="btn btn-primary-menu btn-primary-menu--booking">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					<?php echo esc_html($booking_title); ?>
				</a>

				<!-- Secondary row: Call Us + Contact Us -->
				<div class="slide-push-menu__cta-row">
					<a href="tel:+34622165781" class="btn btn-outline-menu">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
						</svg>
						<?php echo esc_html(function_exists('pll__') ? pll__('Call Us') : __('Call Us', 'smitasmile')); ?>
					</a>
					<a href="<?php echo esc_url($contact_url); ?>" class="btn btn-outline-menu">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
							<polyline points="22,6 12,13 2,6"></polyline>
						</svg>
						<?php echo esc_html(function_exists('pll__') ? pll__('Contact Us') : __('Contact Us', 'smitasmile')); ?>
					</a>
				</div>
			</div>

			<!-- Social Links -->
			<div class="slide-push-menu__social">
				<a href="https://www.instagram.com/smitasmile.dental/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
						<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
						<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
					</svg>
				</a>
				<a href="https://www.facebook.com/smitasmile.dental" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
					</svg>
				</a>
				<a href="mailto:info@smitasmile.com" class="social-link" aria-label="Email">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
						<polyline points="22,6 12,13 2,6"></polyline>
					</svg>
				</a>
			</div>
		</div>
	</nav>

	<!-- Header - Fixed outside site-wrapper for proper sticky behavior -->
	<header id="masthead" class="site-header sticky-header minimal-header">
		<nav class="navbar navbar-dark" role="navigation" aria-label="<?php esc_attr_e('Header', 'smitasmile'); ?>" data-sticky="true">
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
								width="163"
								height="64"
								loading="eager"
								decoding="async"
								fetchpriority="high">
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

				<!-- Header Actions - Language Dropdown + Hamburger -->
				<div class="header-actions">
					<!-- Language Dropdown (Desktop) -->
					<?php if (function_exists('pll_the_languages')) : ?>
						<div class="header-language-dropdown d-none d-md-block">
							<?php
							$languages = pll_the_languages(array('raw' => 1));
							$flag_path = content_url('/polylang/');
							$current_lang = null;
							$other_langs = array();

							// Map language slugs to flag filenames
							$flag_map = array(
								'en' => 'gb.svg',
								'es' => 'es.svg',
								'de' => 'de.svg',
								'ru' => 'ru.svg',
								'lt' => 'lt.svg',
							);

							foreach ($languages as $lang) {
								if ($lang['current_lang']) {
									$current_lang = $lang;
								} else {
									$other_langs[] = $lang;
								}
							}

							// Get current language flag
							$current_flag_file = isset($flag_map[$current_lang['slug']]) ? $flag_map[$current_lang['slug']] : $current_lang['slug'] . '.svg';
							$current_flag_url = $flag_path . $current_flag_file;
							?>
							<div class="lang-dropdown">
								<button type="button" class="lang-dropdown__toggle" aria-expanded="false" aria-haspopup="true">
									<img src="<?php echo esc_url($current_flag_url); ?>" alt="" class="lang-flag" width="24" height="16">
									<span><?php echo esc_html($current_lang['name']); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<polyline points="6 9 12 15 18 9"></polyline>
									</svg>
								</button>
								<div class="lang-dropdown__menu">
									<?php foreach ($other_langs as $lang) :
										$flag_file = isset($flag_map[$lang['slug']]) ? $flag_map[$lang['slug']] : $lang['slug'] . '.svg';
										$flag_url = $flag_path . $flag_file;
									?>
										<a href="<?php echo esc_url($lang['url']); ?>" class="lang-dropdown__item" lang="<?php echo esc_attr($lang['locale']); ?>">
											<img src="<?php echo esc_url($flag_url); ?>" alt="" class="lang-flag" width="24" height="16">
											<span><?php echo esc_html($lang['name']); ?></span>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<!-- Hamburger Toggle -->
					<button type="button" class="hamburger-toggle" aria-label="<?php esc_attr_e('Open menu', 'smitasmile'); ?>" aria-expanded="false" aria-controls="slide-push-menu">
						<span class="hamburger-toggle__icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
				</div>

			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="page" class="site site-wrapper">
		<!-- Skip to content - A11y -->
		<a class="visually-hidden-focusable skip-link" href="#primary">
			<?php esc_html_e('Skip to content', 'smitasmile'); ?>
		</a>

		<!-- Main Content Wrapper -->
		<main id="primary" class="site-main">
