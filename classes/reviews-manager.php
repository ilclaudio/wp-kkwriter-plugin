<?php
/**
 * Definition of the REVIEW post type.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Reviews manager.
 */
class KKW_ReviewsManager {

	/**
	 * Install and configure the Section post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );
		// Register the custom fields.
		add_action( 'cmb2_admin_init', array( $this, 'register_custom_fields' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {
		$labels = array(
			'name'          => __( 'Reviews', 'kkwdomain' ),
			'singular_name' => __( 'Review', 'kkwdomain' ),
			'add_new'       => __( 'Add a review', 'kkwdomain' ),
			'add_new_item'  => __( 'Add a review', 'kkwdomain' ),
			'edit_item'     => __( 'Edit a review', 'kkwdomain' ),
			'view_item'     => __( 'View a review', 'kkwdomain' ),
		);
		$args = array(
			'label'        => __( 'Section', 'kkwdomain' ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_REVIEW ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => false,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_REVIEW ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_TAGS ),
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_REVIEW ]['name'], $args );
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
				'id'           => $prefix . KKW_POST_TYPES[ ID_PT_REVIEW ]['name'] . '_custom_fields',
				'title'        => __( 'Review data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_REVIEW ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);
		// Field: Author.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'author',
				'name'    => __( 'Author', 'kkwdomain'),
				'desc'    => __( 'The author of the review', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Source description.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'source_description',
				'name'    => __( 'Source description', 'kkwdomain'),
				'desc'    => __( 'The description of the source of the review', 'kkwdomain'),
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
		// Field: Short description.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'short_description',
				'name'    => __( 'Short description', 'kkwdomain'),
				'desc'    => __( 'A short excerpt from the review', 'kkwdomain'),
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
		// Field: link to a book.
		$cmb->add_field(
			array(
				'id'      => $prefix . BOOK_LINK_SUFFIX,
				'name'    => __( 'Book', 'kkwdomain' ),
				'before'  => __( 'Select linked books' , 'kkwdomain' ),
				'type'    => 'custom_attached_posts',
				'column'  => true,
				'options' => array(
					'show_thumbnails' => false, // Show thumbnails on the left.
					'filter_boxes'    => true, // Show a text box for filtering the results.
					'query_args'      => array(
							'posts_per_page' => -1,
							'post_type'      => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
					),
				),
			)
		);
		// Order.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'order',
				'name'    => __( 'Order', 'kkwdomain'),
				'desc'    => __( 'The position of this item', 'kkwdomain'),
				'default' => '1',
				'type'    => 'text_small',
				'column'  => true,
			)
		);
	}

}
