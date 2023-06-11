<?php
/**
 * Definition of the default POST type.
 *
 * @package @package WP_KK_Writer_Plugin
 */

/**
 * The Post manager.
 */
class KKW_PostManager {
	/**
	 * Install and configure the News post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the taxonomies used by this post type.
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		// Register the custom fields.
		add_action( 'cmb2_admin_init', array( $this, 'register_custom_fields' ) );
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
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'blogtype' ),
		);
		register_taxonomy(
			KKW_BLOG_TYPE_TAXONOMY,
			array( KKW_DEFAULT_POST ),
			$collection_args
		);
	}

	public function register_custom_fields() {
		$prefix = KKW_POST_TYPES[ KKW_DEFAULT_POST ]['name'] . '_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . 'custom_fields',
				'title'        => __( 'Post custom data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ KKW_DEFAULT_POST ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);
		// Field: BLOG TYPE.
		$cmb->add_field(
			array(
				'id'             => $prefix . 'blog_type',
				'name'           => __( 'Type', 'kkwdomain' ),
				'desc'           => __( 'The type of the post.', 'kkwdomain' ),
				'taxonomy'       => KKW_BLOG_TYPE_TAXONOMY,
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
		// Field: Start date.
		$cmb->add_field(
			array(
				'id'             => $prefix . 'start_date',
				'name'           => __( 'Start date', 'kkwdomain' ),
				'desc'           => __( 'The start date of the event', 'kkwdomain' ),
				'type' => 'text_date',
				'date_format' => 'd-m-Y',
				'data-datepicker' => json_encode(
					array(
						'yearRange' => '-100:+0',
					)
				),
			)
		);
		// Field: End date.
		$cmb->add_field(
			array(
				'id'             => $prefix . 'end_date',
				'name'           => __( 'End date', 'kkwdomain' ),
				'desc'           => __( 'The end date of the event', 'kkwdomain' ),
				'type' => 'text_date',
				'date_format' => 'd-m-Y',
				'data-datepicker' => json_encode(
					array(
						'yearRange' => '-100:+0',
					)
				),
			)
		);
		// Field: Address.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'address',
				'name'    => __( 'Address', 'kkwdomain'),
				'desc'    => __( 'The address of the event', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Contact name.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'contact_person',
				'name'    => __( 'Contact person', 'kkwdomain'),
				'desc'    => __( 'The contact person', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Contact mail.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'contact_mail',
				'name'    => __( 'Contact mail', 'kkwdomain'),
				'desc'    => __( 'The contact mail', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Contact telephone.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'contact_phone',
				'name'    => __( 'Contact phone number', 'kkwdomain'),
				'desc'    => __( 'The contact phone number', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: External link.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'external_link',
				'name'       => __( 'External link', 'kkwdomain'),
				'desc'       => __( 'The link to the event/news', 'kkwdomain'),
				'type'       => 'text_url',
			)
		);
		// Field: Video link.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'video_link',
				'name'       => __( 'Video link', 'kkwdomain'),
				'desc'       => __( 'The link to the video', 'kkwdomain'),
				'type'       => 'text_url',
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
			)
		);
		// Field: link to a book.
		$cmb->add_field(
			array(
			'id'      => $prefix . 'book_link',
			'name'    => __( 'Book', 'kkwdomain' ),
			'before'  => __( 'Select linked books' , 'kkwdomain' ),
			'type'    => 'custom_attached_posts',
			'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
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
	}

}
