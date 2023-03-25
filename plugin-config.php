<?php

define( 'WP_DEFAULT_CATEGORY', 'category' );
define( 'KKW_DEFAULT_SUPPORTS', array( 'title', 'editor', 'thumbnail' ) );
define( 'KKW_DOMAIN', 'kk_writer_plugin' );

define(
	'KKW_POST_TYPES',
	array(
		'section'    => array(
			'name'            => 'kkw_section',
			'archive_page_en' => 'sections',
			'archive_page_it' => 'sezioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-open-folder',
		),
		'book'       => array(
			'name'            => 'kkw_book',
			'archive_page_en' => 'books',
			'archive_page_it' => 'libri',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-book',
		),
		'event'      => array(
			'name'            => 'kkw_event',
			'archive_page_en' => 'events',
			'archive_page_it' => 'eventi',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-book',
		),
		'news'       => array(
			'name'            => 'kkw_news',
			'archive_page_en' => 'news',
			'archive_page_it' => 'notizie',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => 'dashicons-book',
		),
		'excerpt'    => array(
			'name'            => 'kkw_excerpt',
			'archive_page_en' => 'excerpts',
			'archive_page_it' => 'brani',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => '',
		),
		'audio'      => array(
			'name'            => 'kkw_audio',
			'archive_page_en' => 'audios',
			'archive_page_it' => 'audio',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => '',
		),
		'review'     => array(
			'name'            => 'kkw_review',
			'archive_page_en' => 'reviews',
			'archive_page_it' => 'recensioni',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => '',
		),
		'interview'  => array(
			'name'            => 'kkw_interview',
			'archive_page_en' => 'interviews',
			'archive_page_it' => 'interviste',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => '',
		),
		'collection' => array(
			'name'            => 'kkw_collection',
			'archive_page_en' => 'collections',
			'archive_page_it' => 'raccolte',
			'supports'        => KKW_DEFAULT_SUPPORTS,
			'icon'            => '',
		),
	)
);
