<?php
/**
 * Definition of the INTERVIEW post type.
 *
 * @package @package WP_KK_Writer_Plugin
 */

/**
 * The Sections manager.
 */
class KKW_InterviewsManager {

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
			'show_in_menu' => false,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_INTERVIEW ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_TAGS ),
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'], $args );
	}

	public function register_custom_fields() {
		$prefix = KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'] . '_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . 'custom_fields',
				'title'        => __( 'Interview data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);
		// Field: Date.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'date',
				'name'    => __( 'Date', 'kkwdomain'),
				'desc'    => __( 'The date of the interview', 'kkwdomain'),
				'default' => '',
				'type'    => 'text_small',
			)
		);
		// Field: Author.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'author',
				'name'    => __( 'Author', 'kkwdomain'),
				'desc'    => __( 'The author of the interview', 'kkwdomain'),
				'default' => '',
				'type'    => 'text',
			)
		);
		// Field: Source description.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'source_description',
				'name'    => __( 'Source description', 'kkwdomain'),
				'desc'    => __( 'The description of the source of the interview', 'kkwdomain'),
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
				'desc'    => __( 'A short excerpt from the interview', 'kkwdomain'),
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
		// Field: Link to the interview.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'link',
				'name'       => __( 'Interview link', 'kkwdomain'),
				'desc'       => __( 'The link to the interview', 'kkwdomain'),
				'type'       => 'text_url',
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
	}

}
