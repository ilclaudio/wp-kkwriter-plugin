<?php

/**
 * The Sections manager.
 */
class InterviewsManager {
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
			'name'          => _x( 'Interviews', 'Post Type General Name', 'kkwdomain' ),
			'singular_name' => _x( 'Interview', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new'       => _x( 'Add an interview', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new_item'  => _x( 'Add an interview', 'Post Type Singular Name', 'kkwdomain' ),
			'edit_item'     => _x( 'Edit an interview', 'Post Type Singular Name', 'kkwdomain' ),
			'view_item'     => _x( 'View an interview', 'Post Type Singular Name', 'kkwdomain' ),
		);

		$args = array(
			'label'        => __( 'Interview', 'kkwdomain' ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_INTERVIEW ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => true,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_INTERVIEW ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_CATEGORY ),
			// 'menu_position' => 6,
		);

		register_post_type( KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'], $args );

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
