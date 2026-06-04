<?php
/**
 * Plugin Name: GSAP Background Elementor Widget
 * Description: Custom Elementor widget.
 * Version: 1.0.0
 * Author: wp-desgn-lab
 * Text Domain: gsap-background
 *
 * @package GsapBackground
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GSAP_BACKGROUND_VERSION', '1.0.0' );
define( 'GSAP_BACKGROUND_FILE', __FILE__ );
define( 'GSAP_BACKGROUND_PATH', plugin_dir_path( __FILE__ ) );
define( 'GSAP_BACKGROUND_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register plugin assets.
 */
function gsap_background_register_assets() {
	wp_register_style(
		'gsap-background-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Space+Mono:wght@400;700&display=swap',
		array(),
		null
	);

	wp_register_style(
		'gsap-background-widget',
		GSAP_BACKGROUND_URL . 'assets/css/gsap-background-widget.css',
		array( 'gsap-background-fonts' ),
		GSAP_BACKGROUND_VERSION
	);

	wp_register_script(
		'gsap',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	wp_register_script(
		'gsap-scrolltrigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	wp_register_script(
		'gsap-background-widget',
		GSAP_BACKGROUND_URL . 'assets/js/gsap-background-widget.js',
		array( 'jquery', 'gsap', 'gsap-scrolltrigger' ),
		GSAP_BACKGROUND_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'gsap_background_register_assets' );
add_action( 'elementor/editor/before_enqueue_scripts', 'gsap_background_register_assets' );

/**
 * Register the Elementor widget.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function gsap_background_register_widget( $widgets_manager ) {
	require_once GSAP_BACKGROUND_PATH . 'includes/widgets/class-gsap-background-widget.php';

	$widgets_manager->register( new \GsapBackground\Widgets\Gsap_Background_Widget() );
}
add_action( 'elementor/widgets/register', 'gsap_background_register_widget' );

