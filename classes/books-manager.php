<?php
/**
 * Definition of the BOOK post type.
 *
 * @package @package WP_KK_Writer_Plugin
 */

/**
 * The Books manager.
 */
class KKW_BooksManager {
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
		add_action( 'init', array( $this, 'register_taxonomies' ) );

		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );

		// Register the custom fields.
		add_action( 'cmb2_admin_init', array( $this, 'register_custom_fields' ) );

		// Register the template of the detail page of the post type.
		add_filter( 'single_template', array( $this, 'register_single_template' ) );

		// Register the template for the archive page of the post type.
		add_filter( 'archive_template', array( $this, 'register_archive_template' ) );
	}


	/**
	 * Add taxonomies used by this post type.
	 *
	 * @return void
	 */
	public function register_taxonomies() {

		// Section taxonomy.
		$tax_labels = array(
			'name'              => _x( 'Section', 'taxonomy general name', 'kkwdomain' ),
			'singular_name'     => _x( 'Section', 'taxonomy singular name', 'kkwdomain' ),
			'search_items'      => __( 'Search Section', 'kkwdomain' ),
			'all_items'         => __( 'All the Sections', 'kkwdomain' ),
			'edit_item'         => __( 'Edit Section', 'kkwdomain' ),
			'update_item'       => __( 'Update Section', 'kkwdomain' ),
			'add_new_item'      => __( 'Add a Section', 'kkwdomain' ),
			'new_item_name'     => __( 'New Section', 'kkwdomain' ),
			'menu_name'         => __( 'Sections', 'kkwdomain' ),
		);
		$tax_args = array(
			'hierarchical'      => false,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'section' ),
		);
		register_taxonomy(
			KKW_SECTION_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$tax_args
		);

		// Collection taxonomy.
		$tax_labels = array(
			'name'              => _x( 'Collection', 'taxonomy general name', 'kkwdomain' ),
			'singular_name'     => _x( 'Collection', 'taxonomy singular name', 'kkwdomain' ),
			'search_items'      => __( 'Search Collection', 'kkwdomain' ),
			'all_items'         => __( 'All the Collections', 'kkwdomain' ),
			'edit_item'         => __( 'Edit Collection', 'kkwdomain' ),
			'update_item'       => __( 'Update Collection', 'kkwdomain' ),
			'add_new_item'      => __( 'Add a Collection', 'kkwdomain' ),
			'new_item_name'     => __( 'New Collection', 'kkwdomain' ),
			'menu_name'         => __( 'Collections', 'kkwdomain' ),
		);
		$tax_args = array(
			'hierarchical'      => false,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'collection' ),
		);
		register_taxonomy(
			KKW_COLLECTION_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$tax_args
		);

		// Author taxonomy.
		$tax_labels = array(
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
		$tax_args = array(
			'hierarchical'      => false,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'author' ),
		);
		register_taxonomy(
			KKW_AUTHOR_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$tax_args
		);

		// Publisher taxonomy.
		$tax_labels = array(
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
		$tax_args = array(
			'hierarchical'      => false,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'publisher' ),
		);
		register_taxonomy(
			KKW_PUBLISHER_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$tax_args
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
			'show_in_menu' => false,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_BOOK ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_CATEGORY ),
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

		// Field: Short description.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'short_description',
				'name'    => __( 'Short description', 'kkwdomain'),
				'desc'    => __( 'A short description of the book', 'kkwdomain'),
				'default' => '',
				'type'    => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 1,
					'media_buttons' => false,
					'teeny'         => true,
					'quicktags'     => false,
					'tinymce'       => array(
						'toolbar1'       => 'bold,italic,link,unlink,undo,redo',
						'valid_elements' => 'a[href],strong,em,p,br',
					),
				),
			)
		);

		// Field: Series.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'series',
				'name'    => __( 'Series', 'kkwdomain'),
				'desc'    => __( 'The series of the book', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);

		// Field: Year.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'year',
				'name'    => __( 'Year', 'kkwdomain'),
				'desc'    => __( 'The publication year', 'kkwdomain'),
				'default' => '',
				'type'    => 'text_small',
			)
		);

		// Field: Pages.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'pages',
				'name'    => __( 'Pages', 'kkwdomain'),
				'desc'    => __( 'The number of pages', 'kkwdomain'),
				'default' => '',
				'type'    => 'text_small',
			)
		);

		// Field: Price.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'price',
				'name'    => __( 'Price', 'kkwdomain'),
				'desc'    => __( 'The price of the book with the currency.', 'kkwdomain'),
				'default' => '',
				'type'    => 'text_small',
			)
		);

		// Field: ISBN.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'isbn',
				'name'    => __( 'ISBN', 'kkwdomain'),
				'desc'    => __( 'The ISBN code', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);

		// Field: EAN.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'ean',
				'name'    => __( 'EAN', 'kkwdomain'),
				'desc'    => __( 'The EAN code', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);

		// Field: Image gallery.
		$cmb->add_field(
			array(
				'id'           => $prefix . 'gallery',
				'name'         => __( 'Gallery', 'kkwdomain'),
				'desc'         => __( 'Images and photos of the book', 'kkwdomain'),
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				'query_args'   => array( 'type' => 'image' ), // Only images attachment.
				// 'text'         => array(
				// 	'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files".
				// 	'remove_image_text' => 'Replacement', // default: "Remove Image".
				// 	'file_text' => 'Replacement', // default: "File:".
				// 	'file_download_text' => 'Replacement', // default: "Download".
				// 	'remove_text' => 'Replacement', // default: "Remove".
				// ),
			)
		);
	}
}
