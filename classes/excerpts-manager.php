<?php

/**
 * The Excerpts manager.
 */
class KKW_ExcerptsManager {

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
			'name'          => _x( 'Excerpts', 'Post Type General Name', 'kkwdomain' ),
			'singular_name' => _x( 'Excerpt', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new'       => _x( 'Add a excerpt', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new_item'  => _x( 'Add a excerpt', 'Post Type Singular Name', 'kkwdomain' ),
			'edit_item'     => _x( 'Edit a excerpt', 'Post Type Singular Name', 'kkwdomain' ),
			'view_item'     => _x( 'View a excerpt', 'Post Type Singular Name', 'kkwdomain' ),
		);
		$args = array(
			'label'        => __( 'Section', 'kkwdomain' ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_EXCERPT ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => false,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_EXCERPT ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_CATEGORY ),
			// 'menu_position' => 6,
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_EXCERPT ]['name'], $args );
	}

}
