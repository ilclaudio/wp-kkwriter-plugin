<?php
/**
 * Definition of the COLLECTION post type.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Collections manager.
 */
class KKW_CollectionsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Collection post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => __( 'Collections', 'kkwdomain' ),
			'singular_name' => __( 'Collection', 'kkwdomain' ),
			'add_new'       => __( 'Add a collection', 'kkwdomain' ),
			'add_new_item'  => __( 'Add a collection', 'kkwdomain' ),
			'edit_item'     => __( 'Edit a collection', 'kkwdomain' ),
			'view_item'     => __( 'View a collection', 'kkwdomain' ),
		);

		$args = array(
			'label'        => __( 'Collection', 'kkwdomain' ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_COLLECTION ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => true,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_COLLECTION ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_TAGS ),
			// 'menu_position' => 6,
		);

		register_post_type( KKW_POST_TYPES[ ID_PT_COLLECTION ]['name'], $args );

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

}
