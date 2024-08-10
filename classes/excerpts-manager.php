<?php
/**
 * Definition of the EXCERPT post type.
 *
 * @package @package WP_KK_Writer_Plugin
 */

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
			'taxonomies'   => array( KKW_DEFAULT_TAGS ),
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_EXCERPT ]['name'], $args );
	}

	public function register_custom_fields() {
		$prefix = 'kkw_';
		$cmb    = new_cmb2_box(
			array(
				'id'           => $prefix . KKW_POST_TYPES[ ID_PT_EXCERPT ]['name'] . '_custom_fields',
				'title'        => __( 'Interview data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_EXCERPT ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
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
		// Priority.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'pages',
				'name'    => __( 'Priority', 'kkwdomain'),
				'desc'    => __( 'The priority of this item', 'kkwdomain'),
				'default' => '1',
				'type'    => 'text_small',
				'column'  => true,
			)
		);
	}

}
