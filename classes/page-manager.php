<?php
/**
 * Definition of the default PAGE type.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Page manager.
 */
class KKW_PageManager {
	/**
	 * Configure the Page's additional fields.
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
				'id'            => $prefix . 'page_type_metabox',
				'title'         => __( 'Page custom data', 'kkwdomain'),
				'object_types'  => array( KKW_DEFAULT_PAGE ),
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true,
			)
		);
		// Field: Prologue.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'prologue_text',
				'name'    => __( 'A prologue for this page', 'kkwdomain'),
				'desc'    => __( 'A short text that will be shown above the body of the page', 'kkwdomain'),
				'default' => '',
				'type'    => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 5,
					'media_buttons' => false,
					'teeny'         => true,
					'quicktags'     => false,
					'tinymce'       => array(
						'toolbar1'       => 'bold,italic,link,unlink,undo,redo,formatselect,bullist,numlist',
						'valid_elements' => 'a[href],strong,em,p,br,h1,h2,h3,h4,h5,ul,ol,li',
						'block_formats'  => 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5',
					),
				),
			)
		);
		// Field: Epilogue.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'epilogue_text',
				'name'    => __( 'An epilogue for this page', 'kkwdomain'),
				'desc'    => __( 'A short text that will be shown below the body of the page', 'kkwdomain'),
				'default' => '',
				'type'    => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 5,
					'media_buttons' => false,
					'teeny'         => true,
					'quicktags'     => false,
					'tinymce'       => array(
						'toolbar1'       => 'bold,italic,link,unlink,undo,redo,formatselect,bullist,numlist',
						'valid_elements' => 'a[href],strong,em,p,br,h1,h2,h3,h4,h5,ul,ol,li',
						'block_formats'  => 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5',
					),
				),
			)
		);
		// Quote field.
		$cmb->add_field(
			array(
				'id'      => $prefix . 'quote_text',
				'name'    => __( 'A quote', 'kkwdomain'),
				'desc'    => __( 'A quote for this page', 'kkwdomain'),
				'default' => '',
				'type'    => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 1,
					'media_buttons' => false,
					'teeny'         => true,
					'quicktags'     => true,
					'tinymce'       => array(
						'toolbar1'       => 'bold,italic,link,unlink,undo,redo,formatselect,bullist,numlist',
						'valid_elements' => 'a[href],strong,em,p,br,h1,h2,h3,h4,h5,ul,ol,li',
						'block_formats'  => 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5',
					),
				),
			)
		);
	}

}
