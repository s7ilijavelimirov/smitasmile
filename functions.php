<?php

/**
 * Theme Setup - Osnovna konfiguracija teme
 */
// Define tema verzija
if (! defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}
require_once get_template_directory() . '/inc/smitateam.php';

// Theme Support
function smitasmile_setup()
{
	load_theme_textdomain('smitasmile', get_template_directory() . '/languages');

	// Osnovna podrška
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	add_theme_support('responsive-embeds');

	// Logo
	add_theme_support('custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	));

	// Meni
	register_nav_menus(array(
		'header_menu'   => __('Header Navigation', 'smitasmile'),
		'footer_menu'   => __('Footer Navigation', 'smitasmile'),
	));

	// Samo default featured image
	set_post_thumbnail_size(1200, 800, true);
}
add_action('after_setup_theme', 'smitasmile_setup');

// Disable Gutenberg (Block Editor) - koristi Classic Editor
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false');

// Disable Block Widgets - koristi Classic Widget Editor
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

// Disable Gutenberg styles
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('classic-theme-styles');
});

// ============================================
// PERFORMANCE OPTIMIZATIONS - INLINE CRITICAL CSS
// ============================================
add_action('wp_head', function () {
?>
	<style>
		:root {
			--primary: #000000;
			--secondary: #ffffff;
			--accent: #1f1f1f;
		}

		html {
			scroll-behavior: smooth;
		}

		body {
			margin: 0;
			padding: 0;
			font-family: Poppins, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
			line-height: 1.5;
		}

		img {
			max-width: 100%;
			height: auto;

		}

		.site-header {
			background: var(--primary);
		}

		.hero-section {
			background: var(--primary);
			color: var(--secondary);
		}

		.hero-headline {
			font-size: clamp(1.5rem, 5vw, 3.5rem);
			line-height: 1.2;
			font-weight: 700;
		}

		.navbar-dark .navbar-nav .nav-link {
			color: var(--secondary);
		}

		.btn-outline-light {
			border-color: var(--secondary);
			color: var(--secondary);
		}
	</style>
<?php
}, 3);

// ============================================
// PRECONNECT I DNS PREFETCH - UBRZA SPOLJNE RESURSE
// ============================================
add_action('wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	echo '<link rel="dns-prefetch" href="//' . esc_attr(wp_parse_url(home_url(), PHP_URL_HOST)) . '">';
}, 2);

// ============================================
// DEFER BOOTSTRAP I SWIPER CSS - ASINKRIONI LOAD
// ============================================
add_action('wp_head', function () {
	$bootstrap_url = get_template_directory_uri() . '/dist/css/bootstrap.min.css';
	$swiper_url = get_template_directory_uri() . '/dist/css/swiper-bundle.min.css';

	echo '<link rel="preload" as="style" href="' . esc_url($bootstrap_url) . '" onload="this.onload=null;this.rel=\'stylesheet\'">';
	echo '<link rel="preload" as="style" href="' . esc_url($swiper_url) . '" onload="this.onload=null;this.rel=\'stylesheet\'">';

	echo '<noscript>';
	echo '<link rel="stylesheet" href="' . esc_url($bootstrap_url) . '">';
	echo '<link rel="stylesheet" href="' . esc_url($swiper_url) . '">';
	echo '</noscript>';
}, 1);

// ============================================
// OPTIMIZOVANI ENQUEUE SCRIPTS I STYLES
// ============================================
function smitasmile_enqueue_scripts()
{
	wp_enqueue_style('smitasmile-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _S_VERSION);

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true);
	wp_script_add_data('bootstrap-js', 'strategy', 'defer');

	wp_enqueue_script('swiper-js', get_template_directory_uri() . '/dist/js/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_script_add_data('swiper-js', 'strategy', 'defer');

	wp_enqueue_script('smitasmile-main', get_template_directory_uri() . '/dist/js/main.min.js', array('bootstrap-js', 'swiper-js'), _S_VERSION, true);
	wp_script_add_data('smitasmile-main', 'strategy', 'defer');

	wp_localize_script('smitasmile-main', 'smitasmileAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('smitasmile_nonce'),
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'smitasmile_enqueue_scripts');

// ============================================
// DISABLE JQUERY MIGRATE - NEMA POTREBE
// ============================================
add_action('wp_default_scripts', function (&$scripts) {
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, array('jquery-migrate'));
	}
});



// ============================================
// LAZY LOAD SLIKE - NATIVNI HTML LOADING
// ============================================
add_filter('wp_img_tag_add_loading_attr', '__return_true');

// ============================================
// SMART IMAGE LOADING STRATEGY
// ============================================
add_filter('wp_get_attachment_image_attributes', function ($atts, $attachment, $size) {
	if (isset($atts['class'])) {
		// Hero slike - eager load sa high priority
		if (
			strpos($atts['class'], 'hero-slide-img') !== false ||
			strpos($atts['class'], 'hero-banner') !== false
		) {
			$atts['loading'] = 'eager';
			$atts['decoding'] = 'async';
			$atts['fetchpriority'] = 'high';
		}
		// Logo - eager load
		else if (strpos($atts['class'], 'logo') !== false) {
			$atts['loading'] = 'eager';
			$atts['decoding'] = 'async';
		}
		// Sve ostale slike - lazy load
		else {
			$atts['loading'] = 'lazy';
			$atts['decoding'] = 'async';
		}
	}
	return $atts;
}, 10, 3);

// ============================================
// REMOVE WORDPRESS EMOJIS
// ============================================
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_action('wp_print_styles', function () {
	wp_dequeue_style('print-emoji-styles');
}, 1);

// ============================================
// CLEAN WP HEAD
// ============================================
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

// ============================================
// RESOURCE HINTS
// ============================================


// ============================================
// TEMPLATE TAGS I UTILITIES
// ============================================
require_once get_template_directory() . '/inc/template-tags.php';

// ============================================
// BOOTSTRAP MENU WALKER
// ============================================
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// ============================================
// SLIDE PUSH MENU WALKER
// ============================================
require_once get_template_directory() . '/class-slide-push-menu-walker.php';

// ============================================
// SIDEBAR-OVI / WIDGETI
// ============================================
function smitasmile_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Primarna sidebara', 'smitasmile'),
		'id'            => 'primary-sidebar',
		'description'   => __('Glavna sidebara', 'smitasmile'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer - Logo & Social', 'smitasmile'),
		'id'            => 'footer-logo-social',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer - Contact Info', 'smitasmile'),
		'id'            => 'footer-contact',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer - Address', 'smitasmile'),
		'id'            => 'footer-address',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer - Google Maps', 'smitasmile'),
		'id'            => 'footer-maps',
		'before_widget' => '<div id="%1$s" class="footer-widget footer-maps-widget %2$s">',
		'after_widget'  => '</div>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Mobile footer widget', 'smitasmile'),
		'id'            => 'mobile-footer-widget',
		'before_widget' => '<div id="%1$s" class="mobile-footer-widget %2$s">',
		'after_widget'  => '</div>',
	));
}
add_action('widgets_init', 'smitasmile_widgets_init');

// ============================================
// PRILAGOĐENE VELIČINE POSTOVA
// ============================================
function smitasmile_custom_excerpt_length()
{
	return 20;
}
add_filter('excerpt_length', 'smitasmile_custom_excerpt_length');

function smitasmile_custom_excerpt_more()
{
	return ' ... <a href="' . esc_url( get_permalink() ) . '">' . __('Read more', 'smitasmile') . '</a>';
}
add_filter('excerpt_more', 'smitasmile_custom_excerpt_more');

// ============================================
// POLYLANG STRINGS REGISTRATION
// ============================================
function smitasmile_register_pll_strings()
{
	pll_register_string('treatments_faq', __('FAQ', 'smitasmile'), 'Treatments');
	pll_register_string('book_appointment_btn', __('Book Your Appointment', 'smitasmile'), 'Buttons');
	pll_register_string('call_us_btn', __('Call Us', 'smitasmile'), 'Buttons');
	pll_register_string('contact_us_btn', __('Contact Us', 'smitasmile'), 'Buttons');
	pll_register_string('instagram_feed_title', __('Instagram Feed', 'smitasmile'), 'General');
	pll_register_string('testimonials_title', __('Testimonials', 'smitasmile'), 'General');

	// Blog-related strings
	pll_register_string('blog_read_more', __('Read More', 'smitasmile'), 'Blog');
	pll_register_string('blog_no_posts', __('No posts available.', 'smitasmile'), 'Blog');
	pll_register_string('blog_back_to_blog', __('Back to Blog', 'smitasmile'), 'Blog');
	pll_register_string('blog_pagination_previous', __('Previous', 'smitasmile'), 'Blog');
	pll_register_string('blog_pagination_next', __('Next', 'smitasmile'), 'Blog');
	pll_register_string('latest_news_title', __('Latest News', 'smitasmile'), 'General');
	pll_register_string('view_all_posts', __('View all posts', 'smitasmile'), 'General');
	pll_register_string('blog_under_development', __('Under development', 'smitasmile'), 'Blog');
	pll_register_string('blog_under_development_message', __('We are working on creating content for you. Please check back soon!', 'smitasmile'), 'Blog');

	// Team page strings
	pll_register_string('team_more_button', __('More', 'smitasmile'), 'Team');
	pll_register_string('team_less_button', __('Less', 'smitasmile'), 'Team');

	// Booking portal strings
	pll_register_string('booking_back_to_website', __('Back to Website', 'smitasmile'), 'Booking');
	pll_register_string('booking_title', __('Book Your Appointment', 'smitasmile'), 'Booking');
	pll_register_string('booking_subtitle', __('Schedule your visit in just a few simple steps', 'smitasmile'), 'Booking');
	pll_register_string('booking_step1_title', __('Select Service', 'smitasmile'), 'Booking');
	pll_register_string('booking_step1_desc', __('Choose the treatment you need', 'smitasmile'), 'Booking');
	pll_register_string('booking_step2_title', __('Pick Date & Time', 'smitasmile'), 'Booking');
	pll_register_string('booking_step2_desc', __('Select your preferred slot', 'smitasmile'), 'Booking');
	pll_register_string('booking_step3_title', __('Confirm Booking', 'smitasmile'), 'Booking');
	pll_register_string('booking_step3_desc', __('Enter your details and confirm', 'smitasmile'), 'Booking');
	pll_register_string('booking_need_help', __('Need help?', 'smitasmile'), 'Booking');

	// Smile transformations strings
	pll_register_string('smile_after', __('After', 'smitasmile'), 'Smile Transformations');
	pll_register_string('smile_before', __('Before', 'smitasmile'), 'Smile Transformations');
	pll_register_string('smile_tap', __('Tap', 'smitasmile'), 'Smile Transformations');
}
add_action('init', 'smitasmile_register_pll_strings');

// ============================================
// POLYLANG MENU DINAMIČKI FILTER
// ============================================
add_filter('wp_nav_menu_args', function ($args) {
	if (!function_exists('pll_current_language')) {
		return $args;
	}

	$current_lang = pll_current_language();

	// Mapiranje: Lokacija → Jezici → Menu imena
	$menu_map = array(
		'header_menu' => array(
			'en' => 'Header Menu EN',
			'es' => 'Header Menu ES',
			'de' => 'Header Menu DE',
			'ru' => 'Header Menu RU',
			'lt' => 'Header Menu LT'
		),
		'footer_menu' => array(
			'en' => 'Footer Menu EN',
			'es' => 'Footer Menu ES',
			'de' => 'Footer Menu DE',
			'ru' => 'Footer Menu RU',
			'lt' => 'Footer Menu LT'
		)
	);

	// Pronađi mapiranje za trenutnu lokaciju i jezik
	if (isset($args['theme_location']) && isset($menu_map[$args['theme_location']])) {
		$menus_for_location = $menu_map[$args['theme_location']];

		// Fallback na EN ako jezika nema
		$menu_name = isset($menus_for_location[$current_lang])
			? $menus_for_location[$current_lang]
			: $menus_for_location['en'];

		// Pronađi menu po imenu
		$menu = get_term_by('name', $menu_name, 'nav_menu');
		if ($menu && isset($menu->term_id)) {
			$args['menu'] = $menu->term_id;
		}
	}

	return $args;
}, 10);

// ============================================
// POLYLANG LANGUAGE SWITCHER - UNESCAPE HTML
// ============================================
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {
	if (isset($item->object) && 'pll_language' === $item->object) {
		$title = wp_kses_post($title);
	}
	return $title;
}, 10, 4);

// ============================================
// HTTPS FAVICON FIX
// ============================================
function smitasmile_secure_favicon()
{
	$favicon_id = get_theme_mod('custom_favicon');
	if ($favicon_id) {
		$favicon_url = wp_get_attachment_url($favicon_id);
		$favicon_url = str_replace('http://', 'https://', $favicon_url);
		echo '<link rel="icon" type="image/webp" href="' . esc_url($favicon_url) . '">';
	}
}
add_action('wp_head', 'smitasmile_secure_favicon', 5);

// ============================================
// BLOG PAGE META BOX - UNDER DEVELOPMENT
// ============================================
function smitasmile_blog_meta_box()
{
	// Samo na stranici koja je postavljena kao Posts Page
	$posts_page_id = get_option('page_for_posts');
	if (!$posts_page_id) {
		return;
	}

	add_meta_box(
		'smitasmile_blog_settings',
		__('Blog Settings', 'smitasmile'),
		'smitasmile_blog_meta_box_html',
		'page',
		'side',
		'high'
	);
}
add_action('add_meta_boxes', 'smitasmile_blog_meta_box');

// Meta box HTML
function smitasmile_blog_meta_box_html($post)
{
	// Prikaži samo na Blog stranici (Posts Page)
	$posts_page_id = get_option('page_for_posts');
	if ($post->ID != $posts_page_id) {
		echo '<p>' . esc_html__('This setting is only available on the Posts Page.', 'smitasmile') . '</p>';
		return;
	}

	$value = get_post_meta($post->ID, '_blog_under_development', true);
	wp_nonce_field('smitasmile_blog_meta_box', 'smitasmile_blog_meta_box_nonce');
?>
	<p>
		<label for="blog_under_development">
			<input type="checkbox" name="blog_under_development" id="blog_under_development" value="1" <?php checked($value, '1'); ?> />
			<?php _e('Under Development', 'smitasmile'); ?>
		</label>
	</p>
	<p class="description">
		<?php _e('Show "Under Development" message instead of blog posts.', 'smitasmile'); ?>
	</p>
<?php
}

// ============================================
// GOOGLE ADS CONVERSION TRACKING - GLOBAL TAG
// ============================================
// NAPOMENA: Zakomentarisano na lokalnom okruzenju.
// Na produkciji ukloni /* i */ oko echo bloka.
add_action('wp_head', function () {
	/*
	echo '<!-- Google tag (gtag.js) -->';
	echo '<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17534135386"></script>';
	echo '<script>';
	echo 'window.dataLayer = window.dataLayer || [];';
	echo 'function gtag(){dataLayer.push(arguments);}';
	echo 'gtag(\'js\', new Date());';
	echo 'gtag(\'config\', \'AW-17534135386\');';
	echo '</script>';
	*/
}, 1);

// ============================================
// GOOGLE ADS CONVERSION TRACKING - BOOKING SUCCESS
// Ucitava se samo na stranicama sa booking widgetom
// (homepage i booking template stranica)
// NAPOMENA: Zakomentarisano na lokalnom okruzenju.
// Na produkciji ukloni /* i */ oko echo bloka.
// ============================================
add_action('wp_footer', function () {
	if (!is_front_page() && !is_page_template('template-booking.php')) {
		return;
	}
	/*
	echo '<script>';
	echo 'document.addEventListener("DOMContentLoaded", function() {';
	echo '  var successStep = document.querySelector(".dentalink-step[data-step=\'success\']");';
	echo '  if (!successStep) return;';
	echo '  var observer = new MutationObserver(function(mutations) {';
	echo '    mutations.forEach(function(mutation) {';
	echo '      if (mutation.type === "attributes" && mutation.attributeName === "class") {';
	echo '        if (successStep.classList.contains("active")) {';
	echo '          gtag("event", "conversion", { "send_to": "AW-17534135386/OeiCCIjy64IcENrY9qhB" });';
	echo '          observer.disconnect();';
	echo '        }';
	echo '      }';
	echo '    });';
	echo '  });';
	echo '  observer.observe(successStep, { attributes: true });';
	echo '});';
	echo '</script>';
	*/
});

// Save meta box
function smitasmile_save_blog_meta_box($post_id)
{
	// Verify nonce
	if (!isset($_POST['smitasmile_blog_meta_box_nonce']) || !wp_verify_nonce($_POST['smitasmile_blog_meta_box_nonce'], 'smitasmile_blog_meta_box')) {
		return;
	}

	// Check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save
	$value = isset($_POST['blog_under_development']) ? '1' : '0';
	update_post_meta($post_id, '_blog_under_development', $value);
}
add_action('save_post', 'smitasmile_save_blog_meta_box');
