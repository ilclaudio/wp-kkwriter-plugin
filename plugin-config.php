<?php
/**
 * Configuration data of the plugin.
 *
 * @package @package WP_KK_Writer_Plugin
 */

define( 'KKW_PLUGIN_NAME', 'wp-kkwriter-plugin' );
define( 'KKW_DEFAULT_CATEGORY', 'category' );
define( 'KKW_DEFAULT_POST', 'post' );
define( 'KKW_DEFAULT_PAGE', 'page' );
define( 'KKW_DEFAULT_SUPPORTS', array( 'title', 'editor', 'thumbnail' ) );
define( 'KKW_PLUGIN_PATH', WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . KKW_PLUGIN_NAME );

define( 'ID_PT_SECTION', 'section' );
define( 'ID_PT_COLLECTION', 'section' );
define( 'ID_PT_BOOK', 'book' );
define( 'ID_PT_REVIEW', 'review' );
define( 'ID_PT_EXCERPT', 'excerpt' );
define( 'ID_PT_MULTIMEDIA', 'multimedia' );
define( 'ID_PT_INTERVIEW', 'interview' );
define( 'ID_PT_EVENT', 'event' );
define( 'ID_PT_NEWS', 'news' );

define( 'KKW_SECTION_TAXONOMY', 'section' );
define( 'KKW_COLLECTION_TAXONOMY', 'collection' );
define( 'KKW_BLOG_TYPE_TAXONOMY', 'blogtype' );
define( 'KKW_AUTHOR_TAXONOMY', 'author' );
define( 'KKW_PUBLISHER_TAXONOMY', 'publisher' );

define(
	'KKW_CUSTOM_BOOK_TAXONOMIES',
	array(
		KKW_SECTION_TAXONOMY,
		KKW_COLLECTION_TAXONOMY,
		KKW_AUTHOR_TAXONOMY,
		KKW_PUBLISHER_TAXONOMY,
	)
);

define(
	'KKW_POST_TYPES',
	array(
		ID_PT_SECTION    => array(
			'name'            => 'kkw_section',
			'plural_label'    => 'sections',
			'singular_label'  => 'Section',
			'archive_page_en' => 'Sections',
			'archive_page_it' => 'sezioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-open-folder',
		),
		ID_PT_COLLECTION => array(
			'name'            => 'kkw_collection',
			'plural_label'    => 'Collections',
			'singular_label'  => 'Collection',
			'archive_page_en' => 'collections',
			'archive_page_it' => 'raccolte',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-open-folder',
		),
		ID_PT_BOOK       => array(
			'name'            => 'kkw_book',
			'plural_label'    => 'Books',
			'singular_label'  => 'Book',
			'archive_page_en' => 'books',
			'archive_page_it' => 'libri',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-book',
			'single-page'     => 'single-kkw_book.php',
			'archive-page'    => 'archive-kkw_book.php',
		),
		ID_PT_REVIEW     => array(
			'name'            => 'kkw_review',
			'plural_label'    => 'Reviews',
			'singular_label'  => 'Review',
			'archive_page_en' => 'reviews',
			'archive_page_it' => 'recensioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-cover-image',
		),
		ID_PT_EXCERPT    => array(
			'name'            => 'kkw_excerpt',
			'plural_label'    => 'Excerpts',
			'singular_label'  => 'Excerpt',
			'archive_page_en' => 'excerpts',
			'archive_page_it' => 'brani',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-media-text',
		),
		ID_PT_MULTIMEDIA => array(
			'name'            => 'kkw_multimedia',
			'plural_label'    => 'Multimedia',
			'singular_label'  => 'Multimedia',
			'archive_page_en' => 'multimedia_en',
			'archive_page_it' => 'multimedia_it',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-admin-media',
		),
		ID_PT_INTERVIEW  => array(
			'name'            => 'kkw_interview',
			'plural_label'    => 'Interviews',
			'singular_label'  => 'Interview',
			'archive_page_en' => 'interviews',
			'archive_page_it' => 'interviste',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-microphone',
		),
	)
);

/* */
define( 'KKW_MAX_TAXONOMY_LENGTH', 60 );

/* MENU */
define( 'KKW_SLUG_MAIN_MENU', 'kkw_main_menu' );

// ROLES AND PERMISSIONS.
define( 'KKW_EDIT_PERMISSION', 'edit_posts' );
