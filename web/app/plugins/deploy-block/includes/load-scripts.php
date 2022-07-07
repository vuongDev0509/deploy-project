<?php

/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function deploy_block_assets()
{ // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'deploy-block-style-css', // Handle.
		plugins_url('dist/blocks.style.build.css', dirname(__FILE__)), // Block style CSS.
		is_admin() ? array('wp-editor') : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'deploy-block-js', // Handle.
		plugins_url('/dist/blocks.build.js', dirname(__FILE__)), // Block.build.js: We register the block here. Built with Webpack.
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);
	
	// 'assets/js/function-admin.js', ['jquery'], null, true)
	// wp_register_script('deploy-block-js', plugins_url('/dist/blocks.build.js', dirname(__FILE__)), ['jquery'], null, true);
	// 	array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), // Dependencies, defined above.
	// 	null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
	// 	true // Enqueue the script in the footer.
	// );

	// Register block editor styles for backend.
	wp_register_style(
		'deploy-block-editor-css', // Handle.
		plugins_url('dist/blocks.editor.build.css', dirname(__FILE__)), // Block editor CSS.
		array('wp-edit-blocks'), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.


	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'deploy/block-deploy-block',
		array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'deploy-block-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'deploy-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'deploy-block-editor-css',
		)
	);
}

// Hook: Block assets.
add_action('init', 'deploy_block_assets');


/**
 * Enqueue assets for frontend
 *
 * @since 1.0.0
 */
function deploy_blocks_frontend_assets()
{
	if (!is_front_page() && !is_home()) {
		wp_enqueue_script('dp-owl-carousel-min', PLUGIN_DIR_URL . 'assets/lib/owl/owl.carousel.min.js', ['jquery'], null, true);
		wp_enqueue_script('dp-easypiechart', PLUGIN_DIR_URL . 'assets/lib/jquery.easypiechart.min.js', ['jquery'], null, true);

		wp_enqueue_style('dp-owl-carousel-min', PLUGIN_DIR_URL . 'assets/lib/owl/owl.carousel.min.css', false, '3.5.7');
		wp_enqueue_style('dp-owl-theme-default', PLUGIN_DIR_URL . 'assets/lib/owl/owl.theme.default.min.css', false, '1.8.1');
	}
	
	// Load the dismissible notice js.

	wp_enqueue_script(
		'dp-player-vimeo-async',
		'https://player.vimeo.com/api/player.js',
		['jquery'],
		null,
		true
	);

	wp_enqueue_script(
		'dp-lottie-async', 
		plugins_url('/assets/js/lottie.js', dirname(__FILE__)),
		['jquery'], 
		null, 
		true
	);

	wp_enqueue_script(
		'deploy-blocks-dismiss-defer',
		plugins_url('/assets/js/functions.min.js', dirname(__FILE__)),
		array(),
		null,
		true
	);

	
}
add_action('wp_enqueue_scripts', 'deploy_blocks_frontend_assets');


/**
 * deploy Async Tagger appends the async prop to scripts when required.
 *
 * @param string $tag Tag name.
 * @param string $handle Script handle provided by wp_enqueue.
 *
 * @return string Maybe modified script.
 */
function deploy_async_tagger($tag, $handle)
{

	// if the unique handle/name of the registered script has 'async' in it
	if (strpos($handle, 'async') !== false) {
		// return the tag with the async attribute
		return str_replace( '<script ', '<script async ', $tag );
	}
	// if the unique handle/name of the registered script has 'defer' in it
	else if (strpos($handle, 'defer') !== false) {
		// return the tag with the defer attribute
		return str_replace( '<script ', '<script defer ', $tag );
	}
	// otherwise skip
	else {
		return $tag;
	}
}
add_filter('script_loader_tag', 'deploy_async_tagger', 10, 2);

function dp_enqueue_admin_script( $hook ) {
    wp_enqueue_script( 'my_custom_script', PLUGIN_DIR_URL . 'assets/js/function-admin.js', ['jquery'], null, true);
}
add_action( 'admin_enqueue_scripts', 'dp_enqueue_admin_script' );
