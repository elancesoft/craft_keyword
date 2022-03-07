<?php

/**
 * VAIV Keyword functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package VAIV_Keyword
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vaiv_keyword_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on VAIV Keyword, use a find and replace
		* to change 'vaiv-keyword' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('vaiv-keyword', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'vaiv-keyword'),
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
			'vaiv_keyword_custom_background_args',
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
add_action('after_setup_theme', 'vaiv_keyword_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vaiv_keyword_content_width()
{
	$GLOBALS['content_width'] = apply_filters('vaiv_keyword_content_width', 640);
}
add_action('after_setup_theme', 'vaiv_keyword_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vaiv_keyword_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'vaiv-keyword'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'vaiv-keyword'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'vaiv_keyword_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function vaiv_keyword_scripts()
{

	// JQuery
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '', true);

	// Load bootstrap first
	// wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css');
	// wp_enqueue_style( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style('bootstrap-icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css');
	// wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/bootstrap-5.1.3-dist/js/bootstrap.bundle.js', array(), '', true);

	// Slick
	// wp_enqueue_style('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	// wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
	// wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '', true);

	// Owl Carousel
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css');
	wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/assets/owlcarousel/owl.theme.default.min.css');
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', array(), '', true);

	// AOS
	wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
	wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '', true);

	//wp_enqueue_style( 'vaiv-keyword-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('maincss', get_template_directory_uri() . '/style.css?v=' . time(), array(), false, 'all');
	wp_enqueue_style('maincss-extend', get_template_directory_uri() . '/style-extend.css?v=' . time(), array(), false, 'all');

	wp_style_add_data('vaiv-keyword-style', 'rtl', 'replace');

	// wp_enqueue_script('vaiv-keyword-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('vaiv-keyword-navigation', get_template_directory_uri() . '/js/navigation.js?v=' . time(), array(), false, true);
	wp_enqueue_script('customizer', get_template_directory_uri() . '/js/customizer.js?v=' . time(), array(), false, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'vaiv_keyword_scripts');

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

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Website Settings',
			'menu_title' => 'Website Settings',
			'menu_slug' => 'website-settings',
			'capability' => 'edit_posts'
		)
	);
}


/**
 * Custom query var for search
 */

function add_query_vars_filter($vars)
{
	// add custom query vars that will be public
	// https://codex.wordpress.org/WordPress_Query_Vars
	$vars[] .= 'all';
	$vars[] .= 'title_content';
	$vars[] .= 'tag';
	return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');
