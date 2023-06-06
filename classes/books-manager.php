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

		// Register the taxonomies used by this post type.
		add_action( 'init', array( $this, 'add_taxonomies' ) );

		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );

		// Register the custom fields.
		add_action( 'cmb2_admin_init', array( $this, 'register_custom_fields' ) );

		// Register the template of the detail page of the post type.
		add_filter( 'single_template', array( $this, 'register_single_template' ) );

		// Register the template for the archive page of the post type.
		add_filter( 'archive_template', array( $this, 'register_archive_template' ) );
	}


	public function add_taxonomies() {

		// Author taxonomy.
		$author_labels = array(
			'name'              => _x( 'Author', 'taxonomy general name', 'kkwdomain' ),
			'singular_name'     => _x( 'Author', 'taxonomy singular name', 'kkwdomain' ),
			'search_items'      => __( 'Search author', 'kkwdomain' ),
			'all_items'         => __( 'All the authors', 'kkwdomain' ),
			'edit_item'         => __( 'Edit author', 'kkwdomain' ),
			'update_item'       => __( 'Update author', 'kkwdomain' ),
			'add_new_item'      => __( 'Add an author', 'kkwdomain' ),
			'new_item_name'     => __( 'New author', 'kkwdomain' ),
			'menu_name'         => __( 'Authors', 'kkwdomain' ),
		);

		$author_args = array(
			'hierarchical'      => false,
			'labels'            => $author_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'author' ),
		);

		register_taxonomy(
			KKW_AUTHOR_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$author_args
		);

		// Publisher taxonomy.
		$publisher_labels = array(
			'name'              => _x( 'Publisher', 'taxonomy general name', 'kkwdomain' ),
			'singular_name'     => _x( 'Publisher', 'taxonomy singular name', 'kkwdomain' ),
			'search_items'      => __( 'Search Publisher', 'kkwdomain' ),
			'all_items'         => __( 'All the Publishers', 'kkwdomain' ),
			'edit_item'         => __( 'Edit Publisher', 'kkwdomain' ),
			'update_item'       => __( 'Update Publisher', 'kkwdomain' ),
			'add_new_item'      => __( 'Add a Publisher', 'kkwdomain' ),
			'new_item_name'     => __( 'New Publisher', 'kkwdomain' ),
			'menu_name'         => __( 'Publishers', 'kkwdomain' ),
		);

		$publisher_args = array(
			'hierarchical'      => false,
			'labels'            => $publisher_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'publisher' ),
		);

		register_taxonomy(
			KKW_PUBLISHER_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$publisher_args
		);

	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => _x( 'Books', 'Post Type General Name', 'kkwdomain' ),
			'singular_name' => _x( 'Book', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new'       => _x( 'Add a book', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new_item'  => _x( 'Add a book', 'Post Type Singular Name', 'kkwdomain' ),
			'edit_item'     => _x( 'Edit a book', 'Post Type Singular Name', 'kkwdomain' ),
			'view_item'     => _x( 'View a book', 'Post Type Singular Name', 'kkwdomain' ),
		);

		$args = array(
			'label'        => __( 'Book', 'kkwdomain' ),
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

	/**
	 * Register the custom fields.
	 *
	 * @return void
	 */
	public function register_custom_fields() {
		$prefix = KKW_POST_TYPES[ ID_PT_BOOK ]['name'] . '_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . 'custom_fields',
				'title'        => __( 'Book data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);

		// AUTHOR.
		$cmb->add_field(
			array(
				'id'             => $prefix . 'author',
				'name'           => __( 'Author', 'kkwdomain' ),
				'desc'           => __( 'The author of the book.', 'kkwdomain' ),
				'taxonomy'       => KKW_AUTHOR_TAXONOMY,
				'type'           => 'taxonomy_select',
				'remove_default' => 'true',
				'query_args' => array(
					'orderby'    => 'slug',
					// 'hide_empty' => true,
				),
				'attributes'     => array(
					'required' => 'required',
				),
			)
		);

		$cmb->add_field(
			array(
				'id'             => $prefix . 'publisher',
				'name'           => __( 'Publisher', 'kkwdomain' ),
				'desc'           => __( 'The publisher of the book.', 'kkwdomain' ),
				'taxonomy'       => KKW_PUBLISHER_TAXONOMY,
				'type'           => 'taxonomy_select',
				'remove_default' => 'true',
				'query_args' => array(
					'orderby'    => 'slug',
					// 'hide_empty' => true,
				),
				'attributes'     => array(
					'required' => 'required',
				),
			)
		);

	}

}
