<?php

/**
 * Use this file to register any custom post types you wish to create.
 */
if ( ! function_exists( 'deploy_create_custom_post_type' ) ) {
	// Register Custom Post Type
	function deploy_create_custom_post_type() {
		register_post_type( 'work', array(
			'label'               => __( 'Work', 'deploy' ),
			'description'         => __( 'Work', 'deploy' ),
			//'labels'                => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'revisions' ),
			'taxonomies'          => array('post_tag'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
		) );
	}

	add_action( 'init', 'deploy_create_custom_post_type', 0 ); // Register Custom Taxonomy
}

if ( ! function_exists( 'deploy_create_custom_taxonomy' ) ) {
	function deploy_create_custom_taxonomy() {
		register_taxonomy('client', array('work'), array(
			'labels'            => array(
				'name'          => _x('Client', 'Taxonomy General Name', 'deploy'),
				'singular_name' => _x('Client', 'Taxonomy Singular Name', 'deploy'),
				'menu_name'     => __('Client', 'deploy'),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => true,
		));
	}

	add_action( 'init', 'deploy_create_custom_taxonomy', 0 );
}
