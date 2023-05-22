<?php
/**
 * This are the core theme functions 
 *
 * @package InnovateX
 * 
 */

 /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function innovate_x_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on InnovateX, use a find and replace
		* to change 'innovate_x' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'innovate_x', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'innovate_x' ),
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
			'innovate_x_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'innovate_x_setup' );

function get_google_fonts_list() {
		$api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBJK7drEdS7YspgPIS0vwI2KOK0kF2tjAU';
		$response = wp_remote_get($api_url);

		if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
			$fonts = json_decode(wp_remote_retrieve_body($response));
			$font_families = array();

			foreach ($fonts->items as $font) {
				$font_families[] = $font->family;
			}

			return $font_families;
		}

		return array();
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function innovate_x_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'innovate_x_content_width', 640 );
}
add_action( 'after_setup_theme', 'innovate_x_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function innovate_x_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'innovate_x' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'innovate_x' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'innovate_x_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function innovate_x_scripts() {
	wp_enqueue_style( 'innovate_x-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'innovate_x-style', 'rtl', 'replace' );

	wp_enqueue_script( 'innovate_x-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'innovate_x_scripts' );

/**
 * Get option value from get_option for Theme Option
 */
function innovatex_options($option_name) {
    return get_option($option_name, '');
}

function innovatex_404_redirect() {
    if (is_404()) {
        $redirect_url = innovatex_options('innovatexOptions__404error_page');
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'innovatex_404_redirect');
