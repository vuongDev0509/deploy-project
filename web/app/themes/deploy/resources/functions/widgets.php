<?php
/**
 * Created by PhpStorm
 * Date: 7/29/20 - 09:30
 * Project Name: nationalgroup
 */

/**
 * Load widgets
 */
require( __DIR__ . '/widget/loaded.php' );

/**
 * Register sidebars
 */
add_action( 'widgets_init', 'wonderkarma_widgets_init' );
function wonderkarma_widgets_init() {
	register_sidebar( array(
		'name'          => 'News page',
		'id'            => 'news-sidebar',
		'before_widget' => '<div class="wg-wrap">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="wg-title">',
		'after_title'   => '</h2>',
	) );
}

