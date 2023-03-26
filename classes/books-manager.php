<?php

/**
 * The Books manager.
 */
class BooksManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Book post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );

		// Register the template of the detail page of the post type.
		add_filter( 'single_template', array( $this, 'register_single_template' ) );

		// Register the template for the archive page of the post type.
		add_filter( 'archive_template', array( $this, 'register_archive_template' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => _x( 'Books', 'Post Type General Name', KKW_DOMAIN ),
			'singular_name' => _x( 'Book', 'Post Type Singular Name', KKW_DOMAIN ),
			'add_new'       => _x( 'Add a book', 'Post Type Singular Name', KKW_DOMAIN ),
			'add_new_item'  => _x( 'Add a book', 'Post Type Singular Name', KKW_DOMAIN ),
			'edit_item'     => _x( 'Edit a book', 'Post Type Singular Name', KKW_DOMAIN ),
			'view_item'     => _x( 'View a book', 'Post Type Singular Name', KKW_DOMAIN ),
		);

		$args = array(
			'label'        => __( 'Book', KKW_DOMAIN ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_BOOK ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => true,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_BOOK ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( WP_DEFAULT_CATEGORY ),
			// 'menu_position' => 6,
		);

		register_post_type( KKW_POST_TYPES[ ID_PT_BOOK ]['name'], $args );

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

	/**
	 * Finds the template of the post type.
	 *
	 * @param [String] $single - The path of the template found.
	 * @return [String] - The path of the template to use.
	 */
	public function register_single_template( $single ) {
		$result = kkw_register_single_template( ID_PT_BOOK, $single );
		return $result;
	}

	/**
	 * Finds the template for the archive of the post type.
	 *
	 * @param [String] $archive - The path of the template found.
	 * @return [String] - The path of the template to use.
	 */
	public function register_archive_template( $archive ) {
		$result = kkw_register_archive_template( ID_PT_BOOK, $archive );
		return $result;


	}
}
