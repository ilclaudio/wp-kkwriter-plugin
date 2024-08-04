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
	 * Install and configure the Post/Event/News post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the taxonomies used by this post type.
		// Register the custom fields.
		add_action( 'cmb2_admin_init', array( $this, 'register_custom_fields' ) );
	}

	public function register_custom_fields() {
		$prefix = 'kkw_';
		$cmb = new_cmb2_box(
			array(
				'id'            => $prefix . 'post_type_metabox',
				'title'         => __( 'Post custom data', 'kkwdomain'),
				'object_types'  => array( KKW_DEFAULT_POST ),
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true,
			)
		);
		// Field: Post type: article, event, news, ecc.
		$cmb->add_field(
			array(
				'id'            => $prefix . 'group',
				'name'          => __( 'Type', 'kkwdomain' ),
				'type'          => 'select',
				'options'       => array(
						'article'   => __( 'Article', 'kkwdomain' ),
						'event'     => __( 'Event', 'kkwdomain' ),
						'news'      => __( 'News', 'kkwdomain' ),
				),
				'default'       => 'article',
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
		// Field: Start hour.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'start_hour',
				'name'       => __( 'Start hour', 'kkwdomain' ),
				'type'       => 'text_time',
				'attributes' => array(
					'data-timepicker' => json_encode( array(
					'timeOnlyTitle' => __( 'Start hour', 'kkwdomain' ),
					'timeFormat' => 'HH:mm',
					'stepMinute' => 5,
					)
				),
			),
			'time_format' => 'h:i:s A',
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
		// Field: End hour.
		$cmb->add_field(
			array(
				'id'         => $prefix . 'end_hour',
				'name'       => __( 'End hour', 'kkwdomain' ),
				'type'       => 'text_time',
				'attributes' => array(
					'data-timepicker' => json_encode( array(
					'timeOnlyTitle' => __( 'End hour', 'kkwdomain' ),
					'timeFormat' => 'HH:mm',
					'stepMinute' => 5,
					)
				),
			),
			'time_format' => 'h:i:s A',
			)
		);
		// Field: Address.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'address',
				'name'    => __( 'Address', 'kkwdomain'),
				'desc'    => __( 'The full address of the event', 'kkwdomain'),
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
				'id'      => $prefix . BOOK_LINK_SUFFIX,
				'name'    => __( 'Book', 'kkwdomain' ),
				'before'  => __( 'Select linked books' , 'kkwdomain' ),
				'type'    => 'custom_attached_posts',
				'column'  => true,
				// Output in the admin post-listing as a custom column .
				// ( https://github.com/CMB2/CMB2/wiki/Field-Parameters#column) .
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
		// Field Show in carousel.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'show_in_carousel',
				'name'    => __( 'Show in carousel', 'kkwdomain'),
				'desc'    => __( 'Show the book in the carousel', 'kkwdomain'),
				'default' => '',
				'type'    => 'checkbox',
			)
		);
		// Field Show in evidence section.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'show_in_evidence',
				'name'    => __( 'Show in evidence', 'kkwdomain'),
				'desc'    => __( "Show the book in the 'in evidence' section", 'kkwdomain'),
				'default' => '',
				'type'    => 'checkbox',
			)
		);
	}

}
