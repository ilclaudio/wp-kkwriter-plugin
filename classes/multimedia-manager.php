<?php
/**
 * Definition of the MULTIMEDIA post type.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Sections manager.
 */
class KKW_MultimediaManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

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
			'name'          => __( 'MultiMedia', 'kkwdomain' ),
			'singular_name' => __( 'MultiMedia', 'kkwdomain' ),
			'add_new'       => __( 'Add a media', 'kkwdomain' ),
			'add_new_item'  => __( 'Add a media', 'kkwdomain' ),
			'edit_item'     => __( 'Edit a media', 'kkwdomain' ),
			'view_item'     => __( 'View a media', 'kkwdomain' ),
		);
		$args = array(
			'label'        => __( 'Section', 'kkwdomain' ),
			'labels'       => $labels,
			'supports'     => KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['supports'],
			'hierarchical' => false,
			'public'       => true,
			'show_in_menu' => false,
			'menu_icon'    => KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['icon'],
			'has_archive'  => true,
			'show_in_rest' => true,
			'taxonomies'   => array( KKW_DEFAULT_TAGS ),
		);
		register_post_type( KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name'], $args );
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
				'id'           => $prefix . KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name'] . '_custom_fields',
				'title'        => __( 'Multimedia data', 'kkwdomain'),
				'object_types' => array( KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name'] ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);
		// Field: Media category.
		$cmb->add_field(
			array(
				'id'               => $prefix . 'media_category',
				'name'             => __( 'Media Category', 'kkwdomain'),
				'desc'             => __( 'Select an option', 'kkwdomain'),
				'type'             => 'select',
				'show_option_none' => true,
				'default'          => 'custom',
				'options'          => array(
						'article'   => __( 'Article', 'kkwdomain' ),
						'doc'       => __( 'Documentary', 'kkwdomain' ),
						'interview' => __( 'Interview', 'kkwdomain' ),
						'piece'     => __( 'Piece', 'kkwdomain' ),
				),
			)
		);
		// Field: Media type.
		$cmb->add_field(
			array(
				'id'               => $prefix . 'media_type',
				'name'             => __( 'Media Type', 'kkwdomain'),
				'desc'             => __( 'Select an option', 'kkwdomain'),
				'type'             => 'select',
				'show_option_none' => true,
				'default'          => 'custom',
				'options'          => array(
						'mp3'       => __( 'Audio MP3', 'kkwdomain' ),
						'image'     => __( 'Image', 'kkwdomain' ),
						'linkimage' => __( 'Link Image', 'kkwdomain' ),
						'youtube'   => __( 'Link Youtube', 'kkwdomain' ),
						'mp4'       => __( 'Video MP4', 'kkwdomain' ),
				),
			)
		);
		// Field: Media link.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'media_link',
				'name'       => __( 'Media link', 'kkwdomain'),
				'desc'       => __( 'The link to the media', 'kkwdomain'),
				'type'       => 'text_url',
			)
		);
		// Field: Audio media file.
		$cmb->add_field(
			array(
				'id'      => 'upload_media_audio',
				'name'    => __( 'Audio file', 'kkwdomain'),
				'desc'    => __( 'Upload the audio media file', 'kkwdomain'),
				'type'    => 'file',
				// query_args are passed to wp.media's library query.
				'query_args' => array(
						'type' => array(
						'audio/mpeg',
						'audio/mp4',
						'audio/basic',
						'audio/vnd.wav',
						),
					),
				)
		);
		// Field: Video media file.
		$cmb->add_field(
			array(
				'id'      => 'upload_media_video',
				'name'    => __( 'Video file', 'kkwdomain'),
				'desc'    => __( 'Upload the video media file', 'kkwdomain'),
				'type'    => 'file',
				'query_args' => array(
						'type' => array(
						'video/mp4',
						'video/webm',
						),
					),
				)
		);
		// Field: Image media file.
		$cmb->add_field(
			array(
				'id'      => 'upload_media_image',
				'name'    => __( 'Image file', 'kkwdomain'),
				'desc'    => __( 'Upload the image media file', 'kkwdomain'),
				'type'    => 'file',
				'query_args' => array(
						'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
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
