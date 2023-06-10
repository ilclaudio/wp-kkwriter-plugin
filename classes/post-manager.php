<?php

/**
 * The Post manager.
 */
class KKW_PostManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the News post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the taxonomies used by this post type.
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}

	/**
	 * Add taxonomies used by this post type.
	 *
	 * @return void
	 */
	public function register_taxonomies() {
		// Blog Type taxonomy.
		$tax_labels = array(
			'name'              => _x( 'Blog type', 'taxonomy general name', 'kkwdomain' ),
			'singular_name'     => _x( 'Blog type', 'taxonomy singular name', 'kkwdomain' ),
			'search_items'      => __( 'Search Blog type', 'kkwdomain' ),
			'all_items'         => __( 'All Blog types', 'kkwdomain' ),
			'edit_item'         => __( 'Edit Blog type', 'kkwdomain' ),
			'update_item'       => __( 'Update Blog type', 'kkwdomain' ),
			'add_new_item'      => __( 'Add a Blog type', 'kkwdomain' ),
			'new_item_name'     => __( 'New Blog type', 'kkwdomain' ),
			'menu_name'         => __( 'Blog types', 'kkwdomain' ),
		);
		$collection_args = array(
			'hierarchical'      => false,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'blogtype' ),
		);
		register_taxonomy(
			KKW_BLOG_TYPE_TAXONOMY,
			array( KKW_DEFAULT_POST ),
			$collection_args
		);
	}

}
