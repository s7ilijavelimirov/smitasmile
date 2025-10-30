<?php

/**
 * Theme Setup - Osnovna konfiguracija teme
 */
// Define tema verzija
if (! defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}
// ============================================
// TEAM CPT
// ============================================
require_once get_template_directory() . '/inc/smitateam.php';
// Theme Support
function theme_setup()
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
		'primary'   => __('Glavni meni', 'smitasmile'),
		'footer'    => __('Footer meni', 'smitasmile'),
	));

	// Samo default featured image
	set_post_thumbnail_size(1200, 800, true);
}
add_action('after_setup_theme', 'theme_setup');
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
});
// Logo + Favicon
function theme_custom_logo_setup()
{
	// Custom logo
	$custom_logo_id = get_theme_mod('custom_logo');
	$logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');

	// Favicon
	$favicon_id = get_theme_mod('custom_favicon');
	if ($favicon_id) {
		$favicon_url = wp_get_attachment_url($favicon_id);
		echo '<link rel="icon" type="image/png" href="' . esc_url($favicon_url) . '">';
	}
}
add_action('wp_head', 'theme_custom_logo_setup');
// Uključi CSS i JS
function theme_enqueue_scripts()
{
	// CSS - Redosled je bitan: Bootstrap → Swiper → Tvoj custom style
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/dist/css/bootstrap.min.css', array(), _S_VERSION);
	wp_enqueue_style('swiper-css', get_template_directory_uri() . '/dist/css/swiper-bundle.min.css', array(), _S_VERSION);
	wp_enqueue_style('smitasmile-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _S_VERSION);

	// JS
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('swiper-js', get_template_directory_uri() . '/dist/js/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('smitasmile-main', get_template_directory_uri() . '/dist/js/main.min.js', array('swiper-js'), _S_VERSION, true);
	wp_localize_script('smitasmile-main', 'smitasmileAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('smitasmile_nonce'),
	));


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Sidebar-ovi / Widgeti
function theme_widgets_init()
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

	// Widget 1: Logo & Social (ostaje hardkodiran, slike se menjaju iz Customizer-a)
	register_sidebar(array(
		'name'          => esc_html__('Footer - Logo & Social', 'smitasmile'),
		'id'            => 'footer-logo-social',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
	));

	// Widget 2: Contact Info (tekstualni sadržaj - za prevode)
	register_sidebar(array(
		'name'          => esc_html__('Footer - Contact Info', 'smitasmile'),
		'id'            => 'footer-contact',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	));

	// Widget 3: Address (tekstualni - za prevode)
	register_sidebar(array(
		'name'          => esc_html__('Footer - Address', 'smitasmile'),
		'id'            => 'footer-address',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	));

	// Widget 4: Google Maps (zakucan iframe)
	register_sidebar(array(
		'name'          => esc_html__('Footer - Google Maps', 'smitasmile'),
		'id'            => 'footer-maps',
		'before_widget' => '<div id="%1$s" class="footer-widget footer-maps-widget %2$s">',
		'after_widget'  => '</div>',
	));
}
add_action('widgets_init', 'theme_widgets_init');

// Prilagođene veličine postova
function theme_custom_excerpt_length()
{
	return 20;
}
add_filter('excerpt_length', 'theme_custom_excerpt_length');

// Prilagođeni excerpt više
function theme_custom_excerpt_more()
{
	return ' ... <a href="' . get_permalink() . '">' . __('Read more', 'smitasmile') . '</a>';
}
add_filter('excerpt_more', 'theme_custom_excerpt_more');

// Učitaj Bootstrap Menu Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Remove WordPress Emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Clean WP Head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
require_once get_template_directory() . '/inc/template-tags.php';
function smitasmile_register_pll_strings()
{
	pll_register_string('treatments_faq', __('FAQ', 'smitasmile'), 'Treatments');
	pll_register_string('book_appointment_btn', __('Book Your Appointment', 'smitasmile'), 'Buttons');
}
add_action('init', 'smitasmile_register_pll_strings');


