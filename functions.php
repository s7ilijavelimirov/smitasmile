<?php

/**
 * Smitasmile functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Smitasmile
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.2');
}

if (! function_exists('Smitasmile_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function Smitasmile_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Smitasmile, use a find and replace
		 * to change 'Smitasmile' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('Smitasmile', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');
		add_filter('show_admin_bar', '__return_false');
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		add_image_size('apartment-square', 700, 700, true); // Large Thumbnail.
		add_image_size('apartment-rectangle-vertical', 700, 1005, true); // Large Thumbnail.
		add_image_size('apartment-rectangle-horizontal', 1000, 500, true); // Large Thumbnail.

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'Smitasmile'),
				'menu-2' => esc_html__('Secondary', 'Smitasmile')
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'Smitasmile_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'Smitasmile_setup');
add_filter('use_widgets_block_editor', '__return_false');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function Smitasmile_content_width()
{
	$GLOBALS['content_width'] = apply_filters('Smitasmile_content_width', 640);
}
add_action('after_setup_theme', 'Smitasmile_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function Smitasmile_widgets_init()
{

}
add_action('widgets_init', 'Smitasmile_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function Smitasmile_scripts()
{
	wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/main.min.css', array(), _S_VERSION);
	wp_enqueue_style('Smitasmile-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('Smitasmile-style', 'rtl', 'replace');

	// jQuery - OSTAVI ako ti treba za Slick i druge plugine
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery-script', get_template_directory_uri() . '/dist/js/jquery.min.js', array(), _S_VERSION, true);

	// ❌ UKLONI bootstrap-script ako nećeš koristiti BS JS komponente
	// Bootstrap 5 JS (bez jQuery dependency)
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true);

	wp_enqueue_script('slick-script', get_template_directory_uri() . '/dist/js/slick.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('slick-lightbox-script', get_template_directory_uri() . '/dist/js/slick-lightbox.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('lity-script', get_template_directory_uri() . '/dist/js/lity.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('datepicker-script', get_template_directory_uri() . '/dist/js/bootstrap-datepicker.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('main-script', get_template_directory_uri() . '/dist/js/main.min.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'Smitasmile_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Set ACF WYSIWYG height
function acf_wysiwyg_height()
{
?>
	<style>
		.acf-editor-wrap iframe {
			min-height: 0;
		}
	</style>
	<script>
		(function($) {
			// (filter called before the tinyMCE instance is created)
			acf.add_filter('wysiwyg_tinymce_settings', function(mceInit, id, $field) {
				// enable autoresizing of the WYSIWYG editor
				mceInit.wp_autoresize_on = true;
				return mceInit;
			});
			// (action called when a WYSIWYG tinymce element has been initialized)
			acf.add_action('wysiwyg_tinymce_init', function(ed, id, mceInit, $field) {
				// reduce tinymce's min-height settings
				ed.settings.autoresize_min_height = 100;
				// reduce iframe's 'height' style to match tinymce settings
				$('.acf-editor-wrap iframe').css('height', '100px');
			});
		})(jQuery)
	</script>
<?php
}
add_action('acf/input/admin_footer', 'acf_wysiwyg_height');

// Register Custom Navigation Walker
function register_navwalker()
{
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

// Changing excerpt length
function new_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Changing excerpt more
function new_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


// remove p and span from cf7
add_filter('wpcf7_autop_or_not', '__return_false');