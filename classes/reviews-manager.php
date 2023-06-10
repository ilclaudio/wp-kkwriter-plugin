<?php

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
			'name'          => _x( 'Reviews', 'Post Type General Name', 'kkwdomain' ),
			'singular_name' => _x( 'Review', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new'       => _x( 'Add a review', 'Post Type Singular Name', 'kkwdomain' ),
			'add_new_item'  => _x( 'Add a review', 'Post Type Singular Name', 'kkwdomain' ),
			'edit_item'     => _x( 'Edit a review', 'Post Type Singular Name', 'kkwdomain' ),
			'view_item'     => _x( 'View a review', 'Post Type Singular Name', 'kkwdomain' ),
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
			'taxonomies'   => array( KKW_DEFAULT_CATEGORY ),
		);

		register_post_type( KKW_POST_TYPES[ ID_PT_REVIEW ]['name'], $args );
	}

	/**
	 * Register the custom fields.
	 *
	 * @return void
	 */
	public function register_custom_fields() {
		$prefix = KKW_POST_TYPES[ ID_PT_REVIEW ]['name'] . '_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . 'custom_fields',
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

		// Field: Author.
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

	}
}
