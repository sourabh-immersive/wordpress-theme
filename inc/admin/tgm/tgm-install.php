<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme InnovateX for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action( 'tgmpa_register', 'innovatex__register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function innovatex__register_required_plugins() {
	/*
	 * List of plugin required for theme.
	 */
	$plugins = array(

		array(
			'name' => esc_html__('One Click Demo Import', 'innovatex'),
			'slug' => 'one-click-demo-import',
			'required' => false,
		),

		array(
			'name' => esc_html__('Elementor Website Builder', 'innovatex'),
			'slug' => 'elementor',
			'required' => true,
		),

		array(
			'name' => esc_html__('Contact Form 7', 'innovatex'),
			'slug' => 'contact-form-7',
			'required' => false,
		),

		array(
			'name' => esc_html__('WooCommerce', 'innovatex'),
			'slug' => 'woocommerce',
			'required' => false,
		),

		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

	);

	$config = array(
		'id'           => 'innovatex',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug' => 'innovatex',              // Parent theme slug
		'capability' => 'manage_options',          // Capability or access
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}