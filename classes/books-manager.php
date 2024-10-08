<?php
/**
 * Definition of the BOOK post type.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Books manager.
 */
class KKW_BooksManager {

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
	}


	/**
	 * Add taxonomies used by this post type.
	 *
	 * @return void
	 */
	public function register_taxonomies() {
		// Section taxonomy.
		$tax_labels = array(
			'name'              => __( 'Section', 'kkwdomain' ),
			'singular_name'     => __( 'Section', 'kkwdomain' ),
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
			'taxonomies'        => array( KKW_DEFAULT_TAGS ),
		);
		register_taxonomy(
			KKW_SECTION_TAXONOMY,
			array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
			$tax_args
		);

		// Collection taxonomy.
		$tax_labels = array(
			'name'              => __( 'Collection', 'kkwdomain' ),
			'singular_name'     => __( 'Collection', 'kkwdomain' ),
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
			'name'              => __( 'Author', 'kkwdomain' ),
			'singular_name'     => __( 'Author', 'kkwdomain' ),
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
			'name'              => __( 'Publisher', 'kkwdomain' ),
			'singular_name'     => __( 'Publisher', 'kkwdomain' ),
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
			'name'          => __( 'Books', 'kkwdomain' ),
			'singular_name' => __( 'Book', 'kkwdomain' ),
			'add_new'       => __( 'Add a book', 'kkwdomain' ),
			'add_new_item'  => __( 'Add a book', 'kkwdomain' ),
			'edit_item'     => __( 'Edit a book', 'kkwdomain' ),
			'view_item'     => __( 'View a book', 'kkwdomain' ),
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
			'taxonomies'   => array( KKW_DEFAULT_CATEGORY, KKW_DEFAULT_TAGS ),
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_BOOK ]['name'], $args );
	}

	/**
	 * Register the custom fields.
	 *
	 * @return void
	 */
	public function register_custom_fields() {
		$prefix = 'kkw_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . KKW_POST_TYPES[ ID_PT_BOOK ]['name'] . '_custom_fields',
				'title'        => __( 'Book data', 'kkwdomain' ),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_BOOK ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);
		// Field: Short description.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'short_description',
				'name'    => __( 'Short description', 'kkwdomain' ),
				'desc'    => __( 'A short description of the book', 'kkwdomain' ),
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
		// Field: Presentation Author.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'presentation_author',
				'name'    => __( 'Presentation author', 'kkwdomain' ),
				'desc'    => __( 'The author of the presentation of the book', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Series.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'series',
				'name'    => __( 'Series', 'kkwdomain' ),
				'desc'    => __( 'The series of the book', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Year.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'year',
				'name'    => __( 'Year', 'kkwdomain' ),
				'desc'    => __( 'The publication year', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text_small',
			)
		);
		// Field: Pages.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'pages',
				'name'    => __( 'Pages', 'kkwdomain' ),
				'desc'    => __( 'The number of pages', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text_small',
			)
		);
		// Field: Format.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'format',
				'name'    => __( 'Format', 'kkwdomain' ),
				'desc'    => __( 'The format of the book (dimensions)', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text_small',
			)
		);
		// Field: Show the price.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'show_price',
				'name'    => __( 'Show price', 'kkwdomain' ),
				'desc'    => __( 'Show the the price of the book', 'kkwdomain' ),
				'default' => false,
				'type'    => 'checkbox',
			)
		);
		// Field: Price.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'price',
				'name'    => __( 'Price', 'kkwdomain' ),
				'desc'    => __( 'The price of the book with the currency.', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text_small',
			)
		);
		// Field: Link to the publisher site.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'publisher_page',
				'name'       => __( 'Publisher site', 'kkwdomain' ),
				'desc'       => __( 'The link to the publisher site', 'kkwdomain' ),
				'type'       => 'text_url',
			)
		);
		// Field: Link to the book on the publisher site.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'publisher_book_page',
				'name'       => __( 'Link of the book on the publisher site', 'kkwdomain' ),
				'desc'       => __( 'The link to the book page on the publisher site', 'kkwdomain' ),
				'type'       => 'text_url',
			)
		);
		// Field: Link where to buy the book.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'shop_page',
				'name'       => __( 'Link to buy the book', 'kkwdomain' ),
				'desc'       => __( 'The link to buy the book', 'kkwdomain' ),
				'type'       => 'text_url',
			)
		);
		// Field: ISBN.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'isbn',
				'name'    => __( 'ISBN', 'kkwdomain' ),
				'desc'    => __( 'The ISBN code', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: EAN.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'ean',
				'name'    => __( 'EAN', 'kkwdomain' ),
				'desc'    => __( 'The EAN code', 'kkwdomain' ),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Back cover.
		$cmb->add_field(
			array(
				'id'           => $prefix . 'back_cover',
				'name'         => __( 'Back cover', 'kkwdomain' ),
				'desc'         => __( 'The back cover of the book', 'kkwdomain' ),
				'type'         => 'file',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				'query_args'   => array( 'type' => 'image' ), // Only images attachment.
			)
		);
		// Field: Image gallery.
		$cmb->add_field(
			array(
				'id'           => $prefix . 'gallery',
				'name'         => __( 'Gallery', 'kkwdomain' ),
				'desc'         => __( 'Images and photos of the book', 'kkwdomain' ),
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				'query_args'   => array( 'type' => 'image' ), // Only images attachment.
			)
		);
		// Field: link to a book.
		$cmb->add_field(
			array(
				'id'      => $prefix . BOOK_LINK_SUFFIX,
				'name'    => __( 'Book', 'kkwdomain' ),
				'before'  => __( 'Select linked books' , 'kkwdomain' ),
				'type'    => 'custom_attached_posts',
				'column'  => true,
				'options' => array(
					'show_thumbnails' => false, // Show thumbnails on the left
					'filter_boxes'    => true, // Show a text box for filtering the results
					'query_args'      => array(
							'posts_per_page' => -1,
							'post_type'      => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
					),
					),
			)
		);
		// Field Show in carousel.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'show_in_carousel',
				'name'    => __( 'Show in the Carousel', 'kkwdomain' ),
				'desc'    => __( 'Show the book in the Carousel', 'kkwdomain' ),
				'default' => '',
				'type'    => 'checkbox',
			)
		);
		// Field Show in the Featured Contents section.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'show_in_evidence',
				'name'    => __( 'Show in the Featured Contents', 'kkwdomain' ),
				'desc'    => __( 'Show the book in the Featured Contents section', 'kkwdomain' ),
				'default' => '',
				'type'    => 'checkbox',
			)
		);
	}

}
