<?php
/**
 * InnovateX functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package InnovateX
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Implement the theme core functions.
 */
require get_template_directory() . '/inc/admin/theme-core.php';

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
 * Load tgm class file.
 */
require_once get_template_directory() . '/inc/admin/tgm/class-tgm-plugin-activation.php';

require_once get_template_directory() . '/inc/admin/tgm/tgm-install.php';

/**
 * Theme options file.
 */
require_once get_template_directory() . '/inc/admin/theme-options.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/* Create Custom Endpoint */
add_action( 'rest_api_init', 'create_custon_endpoint' );

function create_theme_verify_endpoint(){
	register_rest_route(
		'wp/v3',
		'/verify-theme',
		array(
			'methods' => 'GET',
			'callback' => 'verify_theme',
		)
	);
}

function verify_theme() {
// 	get_option('innovatexOptions__preloader');
	return get_option('innovatexOptions__preloader');
}

add_shortcode('data2', function() {
	echo get_option('innovatexOptions__primary-color-1');
	
});