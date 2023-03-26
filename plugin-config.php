<?php

define( 'KKW_PLUGIN_NAME', 'wp-kkwriter-plugin' );
define( 'WP_DEFAULT_CATEGORY', 'category' );
define( 'KKW_DEFAULT_SUPPORTS', array( 'title', 'editor', 'thumbnail' ) );
define( 'KKW_DOMAIN', 'kk_writer_plugin' );
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


define(
	'KKW_POST_TYPES',
	array(
		ID_PT_SECTION    => array(
			'name'            => 'kkw_section',
			'archive_page_en' => 'sections',
			'archive_page_it' => 'sezioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-open-folder',
		),
		ID_PT_COLLECTION => array(
			'name'            => 'kkw_collection',
			'archive_page_en' => 'collections',
			'archive_page_it' => 'raccolte',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-open-folder',
		),
		ID_PT_BOOK       => array(
			'name'            => 'kkw_book',
			'archive_page_en' => 'books',
			'archive_page_it' => 'libri',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-book',
			'single-page'     => 'single-kkw_book.php',
			'archive-page'    => 'archive-kkw_book.php',
		),
		ID_PT_REVIEW     => array(
			'name'            => 'kkw_review',
			'archive_page_en' => 'reviews',
			'archive_page_it' => 'recensioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-cover-image',
		),
		ID_PT_EXCERPT    => array(
			'name'            => 'kkw_excerpt',
			'archive_page_en' => 'excerpts',
			'archive_page_it' => 'brani',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-media-text',
		),
		ID_PT_MULTIMEDIA => array(
			'name'            => 'kkw_multimedia',
			'archive_page_en' => 'multimedia_en',
			'archive_page_it' => 'multimedia_it',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-admin-media',
		),
		ID_PT_INTERVIEW  => array(
			'name'            => 'kkw_interview',
			'archive_page_en' => 'interviews',
			'archive_page_it' => 'interviste',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-microphone',
		),
		ID_PT_EVENT      => array(
			'name'            => 'kkw_event',
			'archive_page_en' => 'events',
			'archive_page_it' => 'eventi',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-calendar',
		),
		ID_PT_NEWS       => array(
			'name'            => 'kkw_news',
			'archive_page_en' => 'news',
			'archive_page_it' => 'notizie',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-admin-site',
		),
	)
);
