<?php

/**
 * The Sections manager.
 */
class MultimediaManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Section post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => _x( 'MultiMedia', 'Post Type General Name', KKW_DOMAIN ),
			'singular_name' => _x( 'MultiMedia', 'Post Type Singular Name', KKW_DOMAIN ),
			'add_new'       => _x( 'Add a media', 'Post Type Singular Name', KKW_DOMAIN ),
			'add_new_item'  => _x( 'Add a media', 'Post Type Singular Name', KKW_DOMAIN ),
			'edit_item'     => _x( 'Edit a media', 'Post Type Singular Name', KKW_DOMAIN ),
			'view_item'     => _x( 'View a media', 'Post Type Singular Name', KKW_DOMAIN ),
		);

		$args = array(
			'label'        => __( 'Section', KKW_DOMAIN ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES['multimedia']['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => true,
			'menu_icon'    => KKW_POST_TYPES['multimedia']['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( WP_DEFAULT_CATEGORY ),
			// 'menu_position' => 6,
		);

		register_post_type( KKW_POST_TYPES['multimedia']['name'], $args );

		// Add the custom fields.
		$this->add_fields();
	}

	/**
	 * Add the custom fields of the custom post-type.
	 *
	 * @return void
	 */
	public function add_fields() {

	}

}