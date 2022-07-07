<?php

add_action( 'wp_enqueue_scripts', function () {
	

	//wp_enqueue_media();
	wp_enqueue_style( 'flip-wptoolkit-style', get_stylesheet_uri(), [], FLIP_WP_TOOLKIT_VER );
	wp_enqueue_style( 'flip-wptoolkit-site-styles', get_template_directory_uri() . '/dist/app.css', [], FLIP_WP_TOOLKIT_VER );
	wp_enqueue_script( 'flip-wptoolkit-scripts', get_template_directory_uri() . '/dist/functions.js', [
		'jquery',
		'wp-util'
	], FLIP_WP_TOOLKIT_VER, true );

	wp_localize_script( 'flip-wptoolkit-scripts', 'php_data', [
		'admin_logged' => in_array( 'administrator', wp_get_current_user()->roles ) ? 'yes' : 'no',
		'ajax_url'     => admin_url( 'admin-ajax.php' ),
		'tpd_uri'      => get_template_directory_uri(),
		'site_url'     => site_url(),
		'rest_url'     => get_rest_url(),
	] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

if ( ! function_exists( 'deploy_load_fonts' ) ) {
	/**
	 * Load custom font family
	 */
	function deploy_load_fonts() {
		wp_enqueue_style( 'josefinsans-font', get_stylesheet_directory_uri() . '/resources/assets/fonts/JosefinSans/stylesheet.css', false, FLIP_WP_TOOLKIT_VER );
		wp_enqueue_style( 'bellefair-font', get_stylesheet_directory_uri() . '/resources/assets/fonts/Bellefair/stylesheet.css', false, FLIP_WP_TOOLKIT_VER );
		wp_enqueue_style( 'cormorant-garamond-font', get_stylesheet_directory_uri() . '/resources/assets/fonts/CormorantGaramond/stylesheet.css', false, FLIP_WP_TOOLKIT_VER );	}
}

//add_action( 'wp_enqueue_scripts', 'deploy_load_fonts' );
add_action( 'admin_enqueue_scripts', 'deploy_load_fonts' );


add_filter( 'script_loader_src', 'rm_add_filter_script_loader_src', 10, 2 );
function rm_add_filter_script_loader_src( $src, $handle ) {
	if ( $handle === 'wp-polyfill-formdata' ) {
		$src = get_template_directory_uri() . '/dist/formdata-polyfill.js';
	}

	return $src;
}
