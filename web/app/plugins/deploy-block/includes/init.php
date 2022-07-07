<?php

/**
 * Blocks Initializer
 *
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Adds the deploy Blocks block category.
 *
 * @param array $categories Array of categories for block types.
 * @return array Updated block categories.
 */
function deploy_blocks_add_custom_block_category($categories)
{
	return array_merge(
		array(
			array(
				'slug'  => 'dp-blocks',
				'title' => __('dp Blocks', 'deploy-blocks'),
			),
		),
		$categories
	);
}

add_filter('block_categories_all', 'deploy_blocks_add_custom_block_category', 10, 2 );


function deploy_change_colour_palette_default() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => 'Main Colour',
			'slug'  => 'main-colour',
			'color' => '#DFB853',
		),
		array(
			'name'  => 'White Colour',
			'slug'  => 'white-colour',
			'color' => '#FFF',
		),
		array(
			'name'  => 'Black Colour',
			'slug'  => 'black-colour',
			'color' => '#000',
		),

	) );
}

add_action( 'after_setup_theme', 'deploy_change_colour_palette_default' );



if ( ! function_exists( 'dp_icon_post' ) ) {

	/**
	 * @param $icon
	 *
	 * @return mixed|string
	 */
	function dp_icon_post( $icon ) {
		
		$icons = require( __DIR__ . '/icon_svg.php' );
		return $icons[ $icon ] ? $icons[ $icon ] : 'Icon not support!';
	}
}
