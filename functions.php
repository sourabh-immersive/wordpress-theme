<?php
/**
 * Innovatex Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Innovatex_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function innovatex_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Innovatex Theme, use a find and replace
		* to change 'innovatex_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'innovatex_theme', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'innovatex_theme' ),
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
			'innovatex_theme_custom_background_args',
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
add_action( 'after_setup_theme', 'innovatex_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function innovatex_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'innovatex_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'innovatex_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function innovatex_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'innovatex_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'innovatex_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'innovatex_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function innovatex_theme_scripts() {
	wp_enqueue_style( 'innovatex_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'innovatex_theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'innovatex_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'innovatex_theme_scripts' );

/**
 * Implement the Enqueue Google Fonts.
 */
function innovatex_theme_enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Font1|Font2', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'innovatex_theme_enqueue_google_fonts');

function get_google_fonts_list() {
    $api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBJK7drEdS7YspgPIS0vwI2KOK0kF2tjAU';
    $response = wp_remote_get($api_url);
    
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $fonts = json_decode(wp_remote_retrieve_body($response));
        return $fonts->items;
    }
    
    return array();
}


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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_action( 'wp_head', 'innovatex_theme_global_css' );
function innovatex_theme_global_css() {
	?>
		<style>
			:root {
				--i-global-color-primary: #BF0000;
				--i-global-color-secondary: #54595F;
				--i-global-color-text: #333333;
				--i-global-color-accent: #9D1318;
				--i-global-color-1ba453a: #FFFFFFB3;
				--i-global-color-e80ec6f: #BF0000;
				--i-global-color-ec7017a: #FFFFE0C2;
				--i-global-color-745310b: #333333;
				--i-global-color-55d201c: #1274E1;
				--i-global-typography-primary-font-family: "Roboto";
				--i-global-typography-primary-font-weight: 600;
				--i-global-typography-secondary-font-family: "Roboto Slab";
				--i-global-typography-secondary-font-weight: 400;
				--i-global-typography-text-font-family: "Roboto";
				--i-global-typography-text-font-weight: 400;
				--i-global-typography-accent-font-family: "Roboto";
				--i-global-typography-accent-font-weight: 500;
				color: #333333;
				font-family: "Roboto", Sans-serif;
				font-size: 18px;
				font-weight: normal;
				line-height: 1.4em;
				background-color: #FFFFE0C2;
			}
		</style>
	<?php
}

function innovatex_theme_create_and_enqueue_global_css() {
    $file_path = get_template_directory() . '/assets/css/global-style.css';  // Replace with the desired file path and name
    $css_content = ':root {
        		--i-global-color-primary: #BF0000;
				--i-global-color-secondary: #54595F;
				--i-global-color-text: #333333;
				--i-global-color-accent: #9D1318;
				--i-global-color-1ba453a: #FFFFFFB3;
				--i-global-color-e80ec6f: #BF0000;
				--i-global-color-ec7017a: #FFFFE0C2;
				--i-global-color-745310b: #333333;
				--i-global-color-55d201c: #1274E1;
				--i-global-typography-primary-font-family: "Roboto";
				--i-global-typography-primary-font-weight: 600;
				--i-global-typography-secondary-font-family: "Roboto Slab";
				--i-global-typography-secondary-font-weight: 400;
				--i-global-typography-text-font-family: "Roboto";
				--i-global-typography-text-font-weight: 400;
				--i-global-typography-accent-font-family: "Roboto";
				--i-global-typography-accent-font-weight: 500;
				color: #333333;
				font-family: "Roboto", Sans-serif;
				font-size: 18px;
				font-weight: normal;
				line-height: 1.4em;
				background-color: #FFFFE0C2;
    }';

    // Create the CSS file and write the content
    $result = file_put_contents($file_path, $css_content);

    if ($result !== false) {
        // File creation successful, enqueue the CSS file
		wp_enqueue_style( 'innovatex-global-style', get_template_directory() . '/assets/css/global-style.css' );
        
    }
}
// add_action( 'wp_enqueue_scripts', 'innovatex_theme_create_and_enqueue_global_css' );